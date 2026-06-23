<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AccountStatementController extends Controller
{
    public function data(Request $request)
    {
        if (! Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $userId = Auth::id();

        $deposits = Deposit::where('user_id', $userId)->latest()->get()->map(function ($d) {
            return [
                'id' => $d->id,
                'date' => $d->created_at->toDateString(),
                'type' => 'deposit',
                'category' => $d->method ?? 'Deposit',
                'amount' => number_format($d->amount, 2),
                'currency' => $d->currency ?? 'USD',
                'destination' => $d->txid ?? '',
                'ref' => $d->txid ?? '',
                'status' => $d->status ?? 'Pending',
                'icon' => 'ri:bank-line',
            ];
        })->values();

        $withdrawals = collect();
        // If a withdrawals table exists, pull from it
        if (Schema::hasTable('withdrawals')) {
            $rows = DB::table('withdrawals')->where('user_id', $userId)->orderByDesc('created_at')->get();
            $withdrawals = $rows->map(function ($w) {
                return [
                    'id' => $w->id,
                    'date' => isset($w->created_at) ? date('Y-m-d', strtotime($w->created_at)) : '',
                    'type' => 'withdrawal',
                    'category' => $w->method ?? 'Withdrawal',
                    'amount' => number_format($w->amount, 2),
                    'currency' => $w->currency ?? 'USD',
                    'destination' => $w->destination ?? '',
                    'ref' => $w->reference ?? ($w->txid ?? ''),
                    'status' => $w->status ?? 'Pending',
                    'icon' => 'ri:arrow-right-up-line',
                ];
            })->values();
        }

        $records = $deposits->concat($withdrawals)->sortByDesc('date')->values();

        $currencies = $records->pluck('currency')->unique()->values();

        $summary = [
            'total' => $records->count(),
            'deposits' => $deposits->count(),
            'withdrawals' => $withdrawals->count(),
        ];

        return response()->json([
            'success' => true,
            'records' => $records,
            'currencies' => $currencies,
            'summary' => $summary,
        ]);
    }
}
