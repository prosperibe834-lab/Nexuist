<?php

namespace App\Http\Controllers;

use App\Models\DemoTrade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DemoTradeController extends Controller
{
    /**
     * Store a new demo trade
     */
    public function store(Request $request)
    {
        $request->validate([
            'asset' => 'required|string',
            'direction' => 'required|in:BUY,SELL',
            'amount' => 'required|numeric|min:10|max:100000',
            'leverage' => 'required|numeric|min:1|max:50',
            'duration_minutes' => 'required|in:5,15,60,1440',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        $user->demo_balance = $user->demo_balance ?? 0;

        $amount = round($request->amount, 2);
        $leverage = round($request->leverage, 2);
        $notionalValue = round($amount * $leverage, 2);
        $durationMinutes = $request->duration_minutes;

        // Check demo balance
        if (($user->demo_balance ?? 0) < $amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient demo balance. Available: $' . number_format($user->demo_balance ?? 0, 2),
            ], 400);
        }

        try {
            DB::transaction(function () use ($user, $amount, $request, $notionalValue, $durationMinutes) {
                // Deduct from demo balance
                $user->decrement('demo_balance', $amount);

                // Create demo trade record (initially OPEN)
                $trade = DemoTrade::create([
                    'user_id' => $user->id,
                    'asset' => $request->asset,
                    'direction' => $request->direction,
                    'amount' => $amount,
                    'leverage' => $request->leverage,
                    'duration_minutes' => $durationMinutes,
                    'notional_value' => $notionalValue,
                    'status' => 'OPEN',
                    'opened_at' => now(),
                ]);

                // Refresh the model so the response has the latest demo balance
                $user->refresh();
            });

            return response()->json([
                'success' => true,
                'message' => 'Demo trade executed successfully.',
                'demo_balance' => $user->demo_balance,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Trade execution failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get user's demo trades history with filtering
     */
    public function history(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        $query = DemoTrade::where('user_id', $user->id);

        // Filtering
        if ($request->filled('status')) {
            $query->where('status', strtoupper($request->status));
        }

        if ($request->filled('direction')) {
            $query->where('direction', strtoupper($request->direction));
        }

        if ($request->filled('asset')) {
            $query->where('asset', strtoupper($request->asset));
        }

        if ($request->filled('result')) {
            $query->whereNotNull('result')->where('result', strtoupper($request->result));
        }

        $trades = $query->latest()->paginate($request->get('per_page', 15));

        // Compute statistics
        $allTrades = DemoTrade::where('user_id', $user->id)->get();
        $closedTrades = $allTrades->where('status', 'CLOSED');
        $totalPnL = $closedTrades->sum('pnl');
        $winCount = $closedTrades->where('result', 'WIN')->count();
        $winRate = $closedTrades->isNotEmpty() ? round(($winCount / $closedTrades->count()) * 100, 1) : 0;
        $activeTrades = $allTrades->where('status', 'OPEN')->count();

        return response()->json([
            'success' => true,
            'trades' => $trades->items(),
            'pagination' => [
                'current_page' => $trades->currentPage(),
                'per_page' => $trades->perPage(),
                'total' => $trades->total(),
                'last_page' => $trades->lastPage(),
            ],
            'statistics' => [
                'total_trades' => $allTrades->count(),
                'win_rate' => $winRate . '%',
                'total_pnl' => '$' . number_format($totalPnL, 2),
                'active_trades' => $activeTrades,
            ],
            'demo_balance' => $user->demo_balance,
        ]);
    }

    /**
     * Close a demo trade and calculate P&L
     */
    public function close(Request $request, $tradeId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        $trade = DemoTrade::where('id', $tradeId)->where('user_id', $user->id)->first();
        if (!$trade) {
            return response()->json(['success' => false, 'message' => 'Trade not found.'], 404);
        }

        if ($trade->status === 'CLOSED') {
            return response()->json(['success' => false, 'message' => 'Trade already closed.'], 400);
        }

        // Calculate P&L (mock calculation)
        // In a real scenario, you'd use actual market data for the close price
        $pnlPercentage = (rand(-50, 100) / 100); // Random P&L for demo purposes
        $pnl = round($trade->notional_value * $pnlPercentage, 2);

        // Determine result
        $result = $pnl > 0 ? 'WIN' : ($pnl < 0 ? 'LOSS' : 'BREAK_EVEN');

        // Update trade
        $trade->update([
            'status' => 'CLOSED',
            'pnl' => $pnl,
            'result' => $result,
            'closed_at' => now(),
        ]);

        // Add P&L back to demo balance
        $user->increment('demo_balance', $trade->amount + $pnl);
        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Trade closed successfully.',
            'trade' => $trade,
            'demo_balance' => $user->demo_balance,
        ]);
    }

    /**
     * Get dashboard metrics for demo page
     */
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        $trades = DemoTrade::where('user_id', $user->id)->get();
        $closedTrades = $trades->where('status', 'CLOSED');
        $openTrades = $trades->where('status', 'OPEN');

        $totalPnL = $closedTrades->sum('pnl');
        $winCount = $closedTrades->where('result', 'WIN')->count();
        $winRate = $closedTrades->isNotEmpty() ? round(($winCount / $closedTrades->count()) * 100, 1) : 0;

        return response()->json([
            'success' => true,
            'demo_balance' => $user->demo_balance,
            'total_trades' => $trades->count(),
            'win_rate' => $winRate,
            'total_pnl' => $totalPnL,
            'active_trades' => $openTrades->count(),
        ]);
    }

    /**
     * Reset demo account to initial balance
     */
    public function reset()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 401);
        }

        DB::transaction(function () use ($user) {
            // Reset demo balance to $100,000
            $user->update(['demo_balance' => 100000.00]);

            // Close all open trades with LOSS (forfeited)
            DemoTrade::where('user_id', $user->id)
                ->where('status', 'OPEN')
                ->update([
                    'status' => 'CLOSED',
                    'result' => 'LOSS',
                    'pnl' => DB::raw('amount * -1'),
                    'closed_at' => now(),
                ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Demo account reset successfully.',
            'demo_balance' => 100000.00,
        ]);
    }
}
