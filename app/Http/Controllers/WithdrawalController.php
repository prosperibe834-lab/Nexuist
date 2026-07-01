<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    // Show withdrawal page
    public function index()
    {
        $user = Auth::user();
        $withdrawal = $user->withdrawals()
            ->where('status', 'pending')
            ->where('amount', 0)
            ->where(function ($query) {
                $query->whereNull('wallet_address')->orWhere('wallet_address', '');
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->first();

        if (!$withdrawal) {
            $withdrawal = Withdrawal::create([
                'user_id' => $user->id,
                'transaction_id' => Withdrawal::generateTransactionId(),
                'status' => 'pending',
                'amount' => 0,
                'method' => 'bank_transfer',
                'source_wallet' => 'usdt_main',
                'wallet_address' => '',
            ]);
        }

        return view('withdraw', [
            'currentTransactionId' => $withdrawal->transaction_id,
            'withdrawal' => $withdrawal,
            'userBalance' => $user->balance,
        ]);
    }

    // Initiate withdrawal - User enters transaction ID
    public function initiateWithdrawal(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|string',
        ]);

        $withdrawal = Withdrawal::where('transaction_id', $request->transaction_id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$withdrawal) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction ID not found'
                ], 404);
            }

            return redirect()->back()->withErrors(['transaction_id' => 'Transaction ID not found']);
        }

        // If this is an AJAX/JSON request return JSON, otherwise redirect
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => route('withdrawal.settlement', ['tid' => $withdrawal->transaction_id])
            ]);
        }

        return redirect()->route('withdrawal.settlement', ['tid' => $withdrawal->transaction_id]);
    }

    // Show settlement page (choose wallet and amount)
    public function settlementRedirect()
    {
        $user = Auth::user();
        $withdrawal = $user->withdrawals()
            ->where('status', 'pending')
            ->where('amount', 0)
            ->where(function ($query) {
                $query->whereNull('wallet_address')->orWhere('wallet_address', '');
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->first();

        if (!$withdrawal) {
            return redirect()->route('withdrawal.index');
        }

        return redirect()->route('withdrawal.settlement', ['tid' => $withdrawal->transaction_id]);
    }

    public function settlement($tid)
    {
        $user = Auth::user();
        $withdrawal = $user->withdrawals()
            ->where('transaction_id', $tid)
            ->firstOrFail();

        return view('settlement', [
            'withdrawal' => $withdrawal,
            'userBalance' => $user->balance
        ]);
    }

    // Store withdrawal request
    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|string|exists:withdrawals,transaction_id',
            'amount' => 'required|numeric|min:10|max:999999',
            'method' => 'required|in:bank_transfer,crypto,debit_card',
            'source_wallet' => 'required|in:usdt_main,btc_yield',
            'wallet_address' => 'required|string',
        ]);

        $user = Auth::user();
        
        // Validate user has sufficient balance
        if ($user->balance < $request->amount) {
            // create a notification for failed withdrawal attempt
            UserNotification::create([
                'user_id' => $user->id,
                'type' => 'withdrawal_failed',
                'message' => 'Your withdrawal request of $' . number_format($request->amount, 2) . ' failed due to insufficient balance.',
                'status' => 'unread',
                'meta' => json_encode([
                    'transaction_id' => $request->transaction_id,
                    'amount' => $request->amount
                ])
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance'
                ], 422);
            }

            return redirect()->back()->withErrors(['amount' => 'Insufficient balance']);
        }

        $withdrawal = Withdrawal::where('transaction_id', $request->transaction_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $sourceWallet = $request->input('source_wallet', 'usdt_main');
        $withdrawal->update([
            'amount' => $request->amount,
            'method' => in_array($sourceWallet, ['usdt_main', 'btc_yield']) ? 'crypto' : $request->input('method', 'bank_transfer'),
            'source_wallet' => $sourceWallet,
            'wallet_address' => $request->wallet_address,
            'status' => 'pending'
        ]);

        // Notify user that withdrawal is submitted for admin review
        UserNotification::create([
            'user_id' => $user->id,
            'type' => 'withdrawal_submitted',
            'message' => 'Your withdrawal request of $' . number_format($withdrawal->amount, 2) . ' has been submitted for admin review. Transaction ID: ' . $withdrawal->transaction_id,
            'status' => 'unread',
            'meta' => json_encode([
                'withdrawal_id' => $withdrawal->id,
                'transaction_id' => $withdrawal->transaction_id,
                'amount' => $withdrawal->amount,
            ])
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Withdrawal request submitted for admin review',
                'withdrawal' => $withdrawal
            ]);
        }

        return redirect()->route('accountstatement')->with('status', 'Withdrawal submitted for review');
    }

    // Create new withdrawal request
    public function create(Request $request)
    {
        $user = Auth::user();
        
        // Create new withdrawal record
        $withdrawal = Withdrawal::create([
            'user_id' => $user->id,
            'transaction_id' => Withdrawal::generateTransactionId(),
            'status' => 'pending',
            'method' => 'bank_transfer',
            'source_wallet' => 'usdt_main',
            'wallet_address' => '',
            'amount' => 0,
        ]);

        return response()->json([
            'success' => true,
            'transaction_id' => $withdrawal->transaction_id
        ]);
    }

    // Get withdrawal history
    public function history()
    {
        return redirect()->route('accountstatement');
    }
}
