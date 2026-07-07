<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiBot;
use App\Models\BotInvestment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AiBotController extends Controller
{
    public function index()
    {
        $bots = AiBot::latest()->paginate(20);

        $investments = BotInvestment::with(['user', 'bot'])
            ->latest()
            ->get()
            ->each(fn ($investment) => $investment->refreshEarnings());

        $stats = [

            'totalBots'         => AiBot::count(),

            'activeBots'        => AiBot::where(
                'status',
                'Active'
            )->count(),

            'inactiveBots'      => AiBot::where(
                'status',
                'Inactive'
            )->count(),

            'featuredBots'      => AiBot::where(
                'featured',
                1
            )->count(),

            'totalSubscribers'  => BotInvestment::distinct('user_id')
                ->count('user_id'),

            'activeSubscribers' => BotInvestment::where(
                'status',
                'Running'
            )->distinct('user_id')
                ->count('user_id'),

            'totalInvestments'  => BotInvestment::sum(
                'investment_amount'
            ),

            'aum'               => $investments->sum('current_balance'),

            'totalProfit'       => $investments->sum('current_profit'),

            'averageAccuracy'   => round(
                AiBot::avg('accuracy_rate'),
                2
            ),

            'mostPopularBot'    => AiBot::orderByDesc(
                'total_subscribers'
            )->first(),

            'yield24h'          => BotInvestment::whereDate(
                'created_at',
                today()
            )->sum('current_profit'),

            'inflow24h'         => BotInvestment::whereDate(
                'created_at',
                today()
            )->sum('investment_amount'),

        ];

        return view('AdminDashboard.ai-bot', compact(
            'bots',
            'stats',
            'investments'
        ));

    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'bot_name'           => 'required|string',
                'strategy_type'      => 'required|string',
                'trading_style'      => 'required|string',
                'monthly_return'     => 'required|numeric',
                'accuracy_rate'      => 'required|numeric',
                'drawdown'           => 'nullable|numeric',
                'minimum_investment' => 'nullable|numeric',
                'maximum_investment' => 'nullable|numeric',
                'annual_return'      => 'nullable|numeric',
            ]);

            $bot = new AiBot();

            $bot->bot_name           = $request->bot_name;
            $bot->strategy_type      = $request->strategy_type;
            $bot->description        = $request->description;
            $bot->monthly_return     = $request->monthly_return;
            $bot->annual_return      = $request->annual_return ?? 0;
            $bot->accuracy_rate      = $request->accuracy_rate;
            // Ensure numeric defaults to prevent DB NOT NULL constraint failures
            $bot->drawdown           = $request->filled('drawdown') ? $request->drawdown : 0;
            $bot->risk_level         = $request->risk_level;
            $bot->trading_style      = $request->trading_style;
            $bot->minimum_investment = $request->filled('minimum_investment') ? $request->minimum_investment : 0;
            $bot->maximum_investment = $request->filled('maximum_investment') ? $request->maximum_investment : ($bot->minimum_investment * 10 ?: 0);
            $bot->featured           = $request->featured ? 1 : 0;
            $bot->premium            = $request->premium ? 1 : 0;
            $bot->popular            = $request->popular ? 1 : 0;
            $bot->status             = $request->status;

            if ($request->hasFile('bot_image')) {
                $file = $request->file('bot_image');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/bots'), $name);
                $bot->bot_image = $name;
            }

            if ($request->hasFile('bot_logo')) {
                $file = $request->file('bot_logo');
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/bots'), $name);
                $bot->bot_logo = $name;
            }

            $bot->status = $request->status ?? 'Active';
            $bot->premium = $request->filled('premium') ? 1 : 0;
            $bot->featured = $request->filled('featured') ? 1 : 0;
            $bot->popular = $request->filled('popular') ? 1 : 0;

            $bot->save();

            // Return JSON for AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Bot Created Successfully',
                    'bot' => $bot
                ]);
            }

            return back()->with('success', 'Bot Created Successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Error creating bot: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $bot = AiBot::findOrFail($id);

        return response()->json($bot);
    }

    public function update(Request $request, $id)
    {
        try {
            $bot = AiBot::findOrFail($id);
            $bot->update($request->all());

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Bot Updated Successfully',
                    'bot' => $bot
                ]);
            }

            return back()->with('success', 'Bot Updated Successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Error updating bot: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $bot = AiBot::findOrFail($id);
            $bot->delete();

            return back()->with('success', 'Bot Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting bot: ' . $e->getMessage());
        }
    }

    // Search and Filter Methods can be added here
    public function search(Request $request)
    {
        $search = $request->search;

        $bots = AiBot::where(
            'bot_name',
            'LIKE',
            "%$search%"
        )
            ->orWhere(
                'strategy_type',
                'LIKE',
                "%$search%"
            )
            ->paginate(20);

        return view(
            'admin.bots.index',
            compact('bots')
        );
    }

// Filtering by risk level, status, and featured/premium/popular flags
    public function filter(Request $request)
    {
        $query = AiBot::query();

        if ($request->risk_level) {
            $query->where(
                'risk_level',
                $request->risk_level
            );
        }

        if ($request->status) {
            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->featured) {
            $query->where(
                'featured',
                1
            );
        }

        $bots = $query->paginate(20);

        return view(
            'admin.bots.index',
            compact('bots')
        );
    }

// Sorting by monthly return, accuracy rate, or total subscribers
    public function sort($type)
    {
        switch ($type) {
            case 'highest-return':

                $bots = AiBot::orderByDesc(
                    'monthly_return'
                )->paginate(20);

                break;

            case 'highest-accuracy':

                $bots = AiBot::orderByDesc(
                    'accuracy_rate'
                )->paginate(20);

                break;

            case 'most-subscribers':

                $bots = AiBot::orderByDesc(
                    'total_subscribers'
                )->paginate(20);

                break;

            default:

                $bots = AiBot::latest()
                    ->paginate(20);
        }

        return view(
            'admin.bots.index',
            compact('bots')
        );
    }

    public function botTrading()
    {
        $bots = AiBot::with('investments')->get()->map(function ($bot) {
            $bot->investments->each(fn ($investment) => $investment->refreshEarnings());
            $bot->total_net_profit = $bot->investments->sum('current_profit');
            $bot->total_subscribers = $bot->investments->count();
            $bot->total_investment = $bot->investments->sum('investment_amount');
            $bot->current_aum = $bot->investments->sum('current_balance');
            return $bot;
        });

        return view('botTrading', compact('bots'));
    }

    public function copyTrading()
    {
        $user = Auth::user();

        $activeInvestments = BotInvestment::with('bot')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        foreach ($activeInvestments as $investment) {
            $investment->refreshEarnings();
        }

        $totalInvested = $activeInvestments->sum('investment_amount');
        $currentValue = $activeInvestments->sum('current_balance');
        $totalProfit = $activeInvestments->sum('current_profit');
        $activeCopies = $activeInvestments->count();
        $roi = $totalInvested > 0 ? round(($totalProfit / max(1, $totalInvested)) * 100, 2) : 0;

        $experts = AiBot::whereRaw('LOWER(status) = ?', ['active'])
            ->orWhereNull('status')
            ->orderByDesc('total_subscribers')
            ->limit(4)
            ->get();

        if ($experts->isEmpty()) {
            $experts = AiBot::orderByDesc('total_subscribers')->limit(4)->get();
        }

        return view('copytrading', compact(
            'activeCopies',
            'totalInvested',
            'currentValue',
            'totalProfit',
            'roi',
            'activeInvestments',
            'experts'
        ));
    }

    public function experts()
    {
        $bots = AiBot::whereRaw('LOWER(status) = ?', ['active'])
            ->orWhereNull('status')
            ->orderByDesc('total_subscribers')
            ->get();

        if ($bots->isEmpty()) {
            $bots = AiBot::orderByDesc('total_subscribers')->get();
        }

        $expertsData = $bots->map(function ($bot) {
            return [
                'id' => $bot->id,
                'name' => $bot->bot_name,
                'img' => $bot->bot_image ? asset('uploads/bots/' . $bot->bot_image) : 'https://i.pravatar.cc/150?u=expert_' . $bot->id,
                'strategy' => $bot->strategy_type ?? $bot->trading_style ?? 'Copy Trading',
                'roi' => (float) ($bot->monthly_return ?? 0),
                'winRate' => (float) ($bot->accuracy_rate ?? 0),
                'equity' => (float) ($bot->total_investment ?? 0),
                'min' => (float) ($bot->minimum_investment ?? 0),
                'description' => $bot->description ?? 'Professional trading expert',
                'risk_level' => $bot->risk_level ?? 'Medium',
                'status' => $bot->status ?? 'Active',
                'monthly_return' => (float) ($bot->monthly_return ?? 0),
                'minimum_investment' => (float) ($bot->minimum_investment ?? 0),
                'maximum_investment' => (float) (($bot->maximum_investment ?? ($bot->minimum_investment * 10)) ?? 0),
            ];
        });

        return view('experts', compact('bots', 'expertsData'));
    }

    public function premiumInvestmentDashboard()
    {
        $bots = AiBot::where('premium', 1)
            ->where('status', 'Active')
            ->latest()
            ->get();

        $botIds = $bots->pluck('id');

        $investments = BotInvestment::with(['user', 'bot'])
            ->whereIn('bot_id', $botIds)
            ->latest()
            ->get()
            ->each(fn ($investment) => $investment->refreshEarnings());

        $stats = [
            'activePackages' => $bots->count(),
            'totalSubscribers' => $investments->unique('user_id')->count(),
            'totalInvestment' => $investments->sum('investment_amount'),
            'totalProfit' => $investments->sum('current_profit'),
            'averageAccuracy' => round($bots->avg('accuracy_rate') ?? 0, 2),
            'totalSignalsSent' => $investments->count(),
            'winningSignals' => $investments->where('current_profit', '>', 0)->count(),
            'losingSignals' => $investments->where('current_profit', '<', 0)->count(),
            'averageProfitTarget' => round($bots->avg('monthly_return') ?? 0, 2),
        ];

        $subscribers = $investments->groupBy('user_id')->map(function ($items) {
            $first = $items->first();

            return [
                'id' => optional($first->user)->id,
                'investment_id' => $first->id,
                'name' => optional($first->user)->name ?? 'Unknown User',
                'email' => optional($first->user)->email ?? '',
                'country' => optional($first->user)->country ?? 'Unknown',
                'activePackage' => optional($first->bot)->bot_name ?? 'Premium Signals',
                'planTier' => $items->count() > 1 ? 'Multi Plan' : 'Monthly Plan',
                'amountPaid' => $items->sum('investment_amount'),
                'status' => $items->contains(fn ($investment) => $investment->status === 'Running') ? 'Active' : 'Completed',
            ];
        })->values();

        $payments = $investments->map(function ($investment) {
            return [
                'transactionId' => 'TXN-' . str_pad($investment->id, 7, '0', STR_PAD_LEFT),
                'userName' => optional($investment->user)->name ?? 'Unknown User',
                'packageOption' => optional($investment->bot)->bot_name ?? 'Premium Signals',
                'grossValue' => $investment->investment_amount,
                'paymentGateway' => 'Wallet',
                'settlementDate' => $investment->created_at ? $investment->created_at->format('Y-m-d') : now()->toDateString(),
                'status' => $investment->status === 'Running' ? 'Settled' : ucfirst($investment->status),
            ];
        });

        return view('AdminDashboard.PremiumInvestment', compact('bots', 'stats', 'investments', 'subscribers', 'payments'));
    }

    public function copyTradingAdmin()
    {
        $traders = AiBot::withCount('investments')
            ->orderByDesc('total_subscribers')
            ->get();

        $investments = BotInvestment::with(['bot', 'user'])
            ->latest()
            ->get()
            ->each(fn ($investment) => $investment->refreshEarnings());

        $investors = User::withCount(['botInvestments as total_placements'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'country' => $user->country ?? 'Unknown',
                    'balance' => $user->balance ?? 0,
                    'placements' => $user->total_placements,
                    'yield' => BotInvestment::where('user_id', $user->id)->sum('current_profit'),
                ];
            });

        $portfolios = $traders->map(function ($bot) {
            $investments = $bot->investments()->get();
            $totalBalance = $investments->sum('current_balance');
            $totalInvested = $investments->sum('investment_amount');
            $totalProfit = $investments->sum('current_profit');

            return [
                'id' => $bot->id,
                'bot_name' => $bot->bot_name,
                'balance' => $totalBalance,
                'operations' => $investments->count(),
                'net_roi' => $totalInvested > 0 ? round(($totalProfit / $totalInvested) * 100, 2) : 0,
            ];
        });

        $stats = [
            'totalTraders' => $traders->count(),
            'activeTraders' => $traders->filter(fn($bot) => strtolower($bot->status) === 'active')->count(),
            'totalInvestors' => $investors->count(),
            'totalInvested' => $investments->sum('investment_amount'),
            'totalProfit' => $investments->sum('current_profit'),
            'todayPlacements' => BotInvestment::whereDate('created_at', today())->sum('investment_amount'),
            'pendingCount' => BotInvestment::where('status', 'Running')->count(),
        ];

        return view('AdminDashboard.copy-trading', compact(
            'stats',
            'traders',
            'investments',
            'investors',
            'portfolios'
        ));
    }

    public function copyTradingAdminData()
    {
        $traders = AiBot::withCount('investments')->orderByDesc('total_subscribers')->get();
        $investments = BotInvestment::with(['bot', 'user'])->latest()->get();
        $investors = User::withCount(['botInvestments as total_placements'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'country' => $user->country ?? 'Unknown',
                    'balance' => $user->balance ?? 0,
                    'placements' => $user->total_placements,
                    'yield' => BotInvestment::where('user_id', $user->id)->sum('current_profit'),
                ];
            });
        $portfolios = $traders->map(function ($bot) {
            $investments = $bot->investments()->get();
            $totalBalance = $investments->sum('current_balance');
            $totalInvested = $investments->sum('investment_amount');
            $totalProfit = $investments->sum('current_profit');

            return [
                'id' => $bot->id,
                'bot_name' => $bot->bot_name,
                'balance' => $totalBalance,
                'operations' => $investments->count(),
                'net_roi' => $totalInvested > 0 ? round(($totalProfit / $totalInvested) * 100, 2) : 0,
            ];
        });

        $stats = [
            'totalTraders' => $traders->count(),
            'activeTraders' => $traders->filter(fn($bot) => strtolower($bot->status) === 'active')->count(),
            'totalInvestors' => $investors->count(),
            'totalInvested' => $investments->sum('investment_amount'),
            'totalProfit' => $investments->sum('current_profit'),
            'todayPlacements' => BotInvestment::whereDate('created_at', today())->sum('investment_amount'),
            'pendingCount' => BotInvestment::where('status', 'Running')->count(),
        ];

        return response()->json(compact('traders', 'investments', 'investors', 'portfolios', 'stats'));
    }

    public function storeAdminTrader(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'strategy' => 'required|string|max:255',
            'roi' => 'nullable|numeric',
            'winRate' => 'nullable|numeric',
            'aum' => 'nullable|numeric',
            'min' => 'nullable|numeric',
            'avatar' => 'nullable|url',
            'banner' => 'nullable|url',
            'status' => 'nullable|string|max:255',
            'risk' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $bot = AiBot::create([
            'bot_name' => $request->name,
            'description' => $request->bio,
            'strategy_type' => $request->strategy,
            'trading_style' => $request->strategy,
            'monthly_return' => $request->roi ?? 0,
            'accuracy_rate' => $request->winRate ?? 0,
            'total_investment' => $request->aum ?? 0,
            'minimum_investment' => $request->min ?? 0,
            'maximum_investment' => max($request->min * 10, 0),
            'risk_level' => $request->risk,
            'status' => ucfirst($request->status ?? 'Active'),
            'bot_image' => $request->avatar,
            'bot_logo' => $request->banner,
            'total_subscribers' => 0,
            'featured' => 0,
            'premium' => 0,
            'popular' => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Expert trader onboarded successfully.',
            'bot' => $bot,
        ]);
    }

    public function calibrateTrader(Request $request)
    {
        $request->validate([
            'bot_id' => 'required|exists:ai_bots,id',
            'roi' => 'nullable|numeric',
            'winRate' => 'nullable|numeric',
            'aum' => 'nullable|numeric',
            'copiers' => 'nullable|integer',
        ]);

        $bot = AiBot::findOrFail($request->bot_id);
        $bot->monthly_return = $request->roi ?? $bot->monthly_return;
        $bot->accuracy_rate = $request->winRate ?? $bot->accuracy_rate;
        $bot->total_investment = $request->aum ?? $bot->total_investment;
        $bot->total_subscribers = $request->copiers ?? $bot->total_subscribers;
        $bot->save();

        return response()->json([
            'success' => true,
            'message' => 'Expert trader calibrated successfully.',
            'bot' => $bot,
        ]);
    }

    public function manualProfitAdjustment(Request $request)
    {
        $request->validate([
            'investment_id' => 'required|exists:bot_investments,id',
            'amount' => 'required|numeric',
            'modality' => 'required|in:ADD,DEDUCT',
        ]);

        $investment = BotInvestment::findOrFail($request->investment_id);
        $amount = $request->amount;

        if ($request->modality === 'ADD') {
            $investment->current_profit += $amount;
            $investment->current_balance += $amount;
        } else {
            $investment->current_profit -= $amount;
            $investment->current_balance -= $amount;
        }

        $investment->save();

        return response()->json([
            'success' => true,
            'message' => 'Investment profit adjusted successfully.',
            'investment' => $investment,
        ]);
    }

    public function adminCreateInvestment(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bot_id' => 'required|exists:ai_bots,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $user = User::findOrFail($request->user_id);
        $bot = AiBot::findOrFail($request->bot_id);

        if ($user->balance < $request->amount) {
            return response()->json(['success' => false, 'message' => 'User has insufficient balance'], 400);
        }

        $user->balance -= $request->amount;
        $user->save();

        DB::beginTransaction();
        try {
            $investment = BotInvestment::create([
            'user_id' => $user->id,
            'bot_id' => $bot->id,
            'investment_amount' => $request->amount,
            'current_profit' => 0,
            'current_balance' => $request->amount,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'status' => 'Running',
            ]);

            \App\Models\Transaction::create([
                'user_id' => $user->id,
                'type' => 'Investment',
                'amount' => -1 * $request->amount,
                'balance_before' => null,
                'balance_after' => $user->balance,
                'related_id' => $investment->id,
                'related_type' => BotInvestment::class,
                'transaction_id' => \App\Models\Transaction::generateTransactionId(),
                'meta' => ['bot_id' => $bot->id],
                'status' => 'completed',
            ]);

            $bot->increment('total_subscribers');
            $bot->increment('total_investment', $request->amount);

            DB::commit();

            return response()->json(['success' => true, 'investment' => $investment]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function broadcastLiveSignal(Request $request)
    {
        $request->validate([
            'asset_name' => 'required|string|max:255',
            'signal_type' => 'required|string|max:50',
            'time_frame' => 'nullable|string|max:50',
            'entry_price' => 'required|string|max:50',
            'take_profit_1' => 'required|string|max:50',
            'take_profit_2' => 'nullable|string|max:50',
            'take_profit_3' => 'nullable|string|max:50',
            'stop_loss' => 'required|string|max:50',
            'allocation' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $signal = $request->only([
            'asset_name',
            'signal_type',
            'time_frame',
            'entry_price',
            'take_profit_1',
            'take_profit_2',
            'take_profit_3',
            'stop_loss',
            'allocation',
            'notes',
        ]);

        session()->push('premium_live_signals', $signal);

        if ($request->expectsJson()) {
            return response()->json([ 'success' => true, 'message' => 'Live signal created successfully.', 'signal' => $signal ]);
        }

        return back()->with('success', 'Live signal executed successfully.');
    }

    public function togglePremiumSubscriberStatus(Request $request, BotInvestment $investment)
    {
        $investment->status = $investment->status === 'Running' ? 'Completed' : 'Running';
        $investment->save();

        return response()->json([
            'success' => true,
            'message' => 'Subscriber status updated successfully.',
            'status' => $investment->status,
            'investment_id' => $investment->id,
        ]);
    }

    public function deletePremiumSubscriber(BotInvestment $investment)
    {
        $investment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Subscriber record deleted successfully.',
            'investment_id' => $investment->id,
        ]);
    }

    public function broadcastNotification(Request $request)
    {
        $request->validate([
            'target' => 'required|string',
            'type' => 'required|string',
            'payload' => 'required|string',
            'target_user' => 'nullable|string',
        ]);

        $notice = [
            'target' => $request->target,
            'target_user' => $request->target_user,
            'type' => $request->type,
            'payload' => $request->payload,
            'created_at' => now()->toDateTimeString(),
        ];

        session()->push('copy_trading_notifications', $notice);

        return response()->json([
            'success' => true,
            'message' => 'Broadcast signal sent successfully.',
            'notice' => $notice,
        ]);
    }
}
