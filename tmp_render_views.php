<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';
$kernel = app()->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

function tryRender($view, $data = []) {
    echo "Rendering {$view}...\n";
    try {
        echo view($view, $data)->render();
        echo "\n--- OK ---\n";
    } catch (Throwable $e) {
        echo get_class($e).': '.$e->getMessage()."\n";
        echo $e->getTraceAsString()."\n";
    }
}

tryRender('experts', ['bots' => App\Models\AiBot::all()]);
tryRender('AdminDashboard.copy-trading', [
    'stats' => [],
    'traders' => App\Models\AiBot::withCount('investments')->get(),
    'investments' => App\Models\BotInvestment::with(['bot','user'])->latest()->get(),
    'investors' => App\Models\User::withCount(['botInvestments as total_placements'])->get()->map(function($user){ return [
        'id' => $user->id,
        'name' => $user->name,
        'country' => $user->country ?? 'Unknown',
        'balance' => $user->balance ?? 0,
        'placements' => $user->total_placements,
        'yield' => App\Models\BotInvestment::where('user_id',$user->id)->sum('current_profit'),
    ];}),
    'portfolios' => [],
]);
