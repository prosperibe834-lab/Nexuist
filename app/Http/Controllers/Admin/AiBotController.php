<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiBot;
use App\Models\BotInvestment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AiBotController extends Controller
{
    public function index()
    {
        $bots = AiBot::latest()->paginate(20);

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

            'aum'               => BotInvestment::sum(
                'current_balance'
            ),

            'totalProfit'       => BotInvestment::sum(
                'current_profit'
            ),

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

            $investments = BotInvestment::with([
            'user',
            'bot',
        ])->latest()->get();
        
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
                'bot_name'       => 'required',
                'strategy_type'  => 'required',
                'trading_style'  => 'required',
                'monthly_return' => 'required',
                'accuracy_rate'  => 'required',
            ]);

            $bot = new AiBot();

            $bot->bot_name           = $request->bot_name;
            $bot->strategy_type      = $request->strategy_type;
            $bot->description        = $request->description;
            $bot->monthly_return     = $request->monthly_return;
            $bot->annual_return      = $request->annual_return;
            $bot->accuracy_rate      = $request->accuracy_rate;
            $bot->drawdown           = $request->drawdown;
            $bot->risk_level         = $request->risk_level;
            $bot->trading_style      = $request->trading_style;
            $bot->minimum_investment = $request->minimum_investment;
            $bot->maximum_investment = $request->maximum_investment;
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
        $bots = AiBot::all()->map(function($bot) {
            $bot->total_net_profit = BotInvestment::where('bot_id', $bot->id)->sum('current_profit');
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

        $totalInvested = $activeInvestments->sum('investment_amount');
        $currentValue = $activeInvestments->sum('current_balance');
        $totalProfit = $activeInvestments->sum('current_profit');
        $activeCopies = $activeInvestments->count();
        $roi = $totalInvested > 0 ? round(($totalProfit / max(1, $totalInvested)) * 100, 2) : 0;

        return view('copytrading', compact(
            'activeCopies',
            'totalInvested',
            'currentValue',
            'totalProfit',
            'roi'
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

    public function copyTradingAdmin()
    {
        $traders = AiBot::withCount('investments')
            ->orderByDesc('total_subscribers')
            ->get();

        $investments = BotInvestment::with(['bot', 'user'])
            ->latest()
            ->get();

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

        return response()->json(compact('traders', 'investments', 'investors', 'portfolios'));
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
