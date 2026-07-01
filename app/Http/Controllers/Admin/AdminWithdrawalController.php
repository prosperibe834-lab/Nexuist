<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWithdrawalController extends Controller
{
    // List all withdrawals
    public function index()
    {
        $withdrawals = Withdrawal::with('user')
            ->where('amount', '>', 0)
            ->whereNotNull('wallet_address')
            ->where('wallet_address', '!=', '')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(15);

        $stats = [
            'pending' => Withdrawal::where('status', 'pending')->count(),
            'approved' => Withdrawal::where('status', 'approved')->count(),
            'rejected' => Withdrawal::where('status', 'rejected')->count(),
            'completed' => Withdrawal::where('status', 'completed')->count(),
            'total_pending_amount' => Withdrawal::where('status', 'pending')->sum('amount'),
            'total_approved_amount' => Withdrawal::where('status', 'approved')->sum('amount'),
        ];

        return view('AdminDashboard.withdrawals', [
            'withdrawals' => $withdrawals,
            'stats' => $stats
        ]);
    }

    // Get withdrawal details
    public function show($id)
    {
        $withdrawal = Withdrawal::with('user')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $withdrawal
        ]);
    }

    // Approve withdrawal
    public function approve(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $withdrawal = Withdrawal::findOrFail($id);
            
            // Check if already processed
            if ($withdrawal->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Withdrawal has already been processed'
                ], 422);
            }

            // Ensure withdrawal has a valid amount
            if (empty($withdrawal->amount) || floatval($withdrawal->amount) <= 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Withdrawal amount not set. User must complete settlement before approval.'
                ], 422);
            }

            $user = $withdrawal->user;

            // Re-check user balance before approving
            if ($user->balance < $withdrawal->amount) {
                // mark as rejected due to insufficient funds
                $withdrawal->update([
                    'status' => 'rejected',
                    'rejected_at' => now(),
                    'admin_notes' => 'Rejected: insufficient user balance'
                ]);

                UserNotification::create([
                    'user_id' => $user->id,
                    'type' => 'withdrawal_rejected',
                    'message' => 'Your withdrawal request of $' . number_format($withdrawal->amount, 2) . ' could not be processed because your account balance is insufficient.',
                    'status' => 'unread',
                    'meta' => json_encode([
                        'withdrawal_id' => $withdrawal->id,
                        'transaction_id' => $withdrawal->transaction_id,
                        'reason' => 'Insufficient balance'
                    ])
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'User has insufficient balance; withdrawal rejected'
                ], 422);
            }

            // Deduct from user's balance
            $user->update([
                'balance' => $user->balance - $withdrawal->amount
            ]);

            // Update withdrawal status
            $withdrawal->update([
                'status' => 'approved',
                'approved_at' => now(),
                'admin_notes' => $request->input('admin_notes', '')
            ]);

            // Send notification to user
            UserNotification::create([
                'user_id' => $user->id,
                'type' => 'withdrawal',
                'message' => 'Your withdrawal of $' . number_format($withdrawal->amount, 2) . ' has been approved. Transaction ID: ' . $withdrawal->transaction_id,
                'status' => 'unread',
                'meta' => json_encode([
                    'withdrawal_id' => $withdrawal->id,
                    'transaction_id' => $withdrawal->transaction_id,
                    'amount' => $withdrawal->amount,
                    'method' => $withdrawal->method
                ])
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Withdrawal approved successfully',
                'withdrawal' => $withdrawal
            ]);
        });
    }

    // Reject withdrawal
    public function reject(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $request->validate([
                'reason' => 'required|string|max:500'
            ]);

            $withdrawal = Withdrawal::findOrFail($id);
            
            // Check if already processed
            if ($withdrawal->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Withdrawal has already been processed'
                ], 422);
            }

            $user = $withdrawal->user;

            // Update withdrawal status
            $withdrawal->update([
                'status' => 'rejected',
                'rejected_at' => now(),
                'admin_notes' => $request->input('reason')
            ]);

            // Send notification to user
            UserNotification::create([
                'user_id' => $user->id,
                'type' => 'withdrawal_rejected',
                'message' => 'Your withdrawal request of $' . number_format($withdrawal->amount, 2) . ' has been rejected. Reason: ' . $request->input('reason'),
                'status' => 'unread',
                'meta' => json_encode([
                    'withdrawal_id' => $withdrawal->id,
                    'transaction_id' => $withdrawal->transaction_id,
                    'reason' => $request->input('reason')
                ])
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Withdrawal rejected successfully',
                'withdrawal' => $withdrawal
            ]);
        });
    }

    // Get statistics
    public function getStats()
    {
        $thirtyDaysAgo = now()->subDays(30);

        // Pending outflow volume
        $pendingOutflowVolume = Withdrawal::where('status', 'pending')->sum('amount');

        // Settled (approved/completed) in last 30 days
        $settledQuery = Withdrawal::whereIn('status', ['approved', 'completed'])
            ->where('updated_at', '>=', $thirtyDaysAgo);

        $settledCount30d = (clone $settledQuery)->count();
        $settledSum30d = (clone $settledQuery)->sum('amount');

        // Dominant routing endpoint (most common method for approved withdrawals in 30d)
        $dominantRouting = Withdrawal::select('method', DB::raw('COUNT(*) as cnt'))
            ->whereIn('status', ['approved', 'completed'])
            ->where('updated_at', '>=', $thirtyDaysAgo)
            ->groupBy('method')
            ->orderByDesc('cnt')
            ->first();

        $stats = [
            'total_pending' => Withdrawal::where('status', 'pending')->count(),
            'total_approved' => Withdrawal::where('status', 'approved')->count(),
            'total_rejected' => Withdrawal::where('status', 'rejected')->count(),
            'pending_amount' => $pendingOutflowVolume,
            'approved_amount' => Withdrawal::where('status', 'approved')->sum('amount'),
            'rejected_amount' => Withdrawal::where('status', 'rejected')->sum('amount'),
            'settled_count_30d' => $settledCount30d,
            'settled_sum_30d' => $settledSum30d,
            'dominant_routing_endpoint' => $dominantRouting ? $dominantRouting->method : null,
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }

    // Search withdrawals
    public function search(Request $request)
    {
        $query = Withdrawal::with('user');

        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhere('wallet_address', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('status') && !empty($request->input('status'))) {
            $query->where('status', $request->input('status'));
        }

        if ($request->has('method') && !empty($request->input('method'))) {
            $query->where('method', $request->input('method'));
        }

        $withdrawals = $query->orderByDesc('created_at')->orderByDesc('id')->paginate(15);

        return response()->json([
            'success' => true,
            'withdrawals' => $withdrawals
        ]);
    }
}
