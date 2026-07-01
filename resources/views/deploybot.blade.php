<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/deploybot.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>


    <div id="fintech-preloader">
        <div class="loader-container">
            <div class="loader-logo">
                <div class="logo-hexagon">
                    <span class="iconify" data-icon="ri:shield-flash-line"></span>
                </div>
                <h2 class="loader-brand-name">Nexuist</h2>
            </div>

            <div class="loader-progress-wrapper">
                <div class="loader-progress-bar" id="load-bar">
                    <div class="shimmer-effect"></div>
                </div>
            </div>

            <div class="loader-status">
                <span class="status-dot"></span>
                <p id="status-text">Initializing encrypted connection...</p>
            </div>
        </div>

        <div class="glow glow-1"></div>
        <div class="glow glow-2"></div>
    </div>
    <!-- Preloader ends here -->

    @include('layouts.frontend-header-sidebar')



        <!-- Main Content -->
        <main class="dashboard-content">

            <!-- Header Hero Section -->
            <header class="hero-section reveal">

                <div class="hero-text">
                    <h1>Bot Trading Dashboard</h1>
                    <p>
                        Monitor and manage your automated trading investments
                    </p>
                </div>

                <div class="hero-stats-icon">
                    <i class="fas fa-chart-line"></i>
                </div>

            </header>

            <!-- Deployed Bot Summary -->
            <section class="nx-fintech-summary-section reveal" id="deployedSummary"
                data-investments='@json($activeInvestments)'>
                @php
                    $inv = $primaryInvestment;
                    $bot = $inv?->bot;
                    $start = $inv?->start_date ? \Carbon\Carbon::parse($inv->start_date) : null;
                    $end = $inv?->end_date ? \Carbon\Carbon::parse($inv->end_date) : null;
                    $totalDays = ($start && $end) ? $start->diffInDays($end) : null;
                    $elapsedDays = ($start) ? $start->diffInDays(now()) : null;
                    $elapsedPct = ($totalDays && $elapsedDays) ? min(100, max(0, ($elapsedDays / max(1, $totalDays)) * 100)) : null;
                @endphp

                <div class="nx-fintech-card">
                    <div class="nx-fintech-card-header">
                        <div class="nx-fintech-bot-profile">
                            <div class="nx-fintech-avatar-wrapper">
                                @if($bot && $bot->image)
                                    <img src="{{ asset($bot->image) }}" alt="{{ $bot->bot_name }}" class="nx-fintech-img">
                                @else
                                    <div class="nx-fintech-fallback-icon">
                                        <i class="bx bx-bot"></i>
                                    </div>
                                @endif
                                <span class="nx-status-pulse-badge"></span>
                            </div>
                            <div class="nx-fintech-meta">
                                <h3 class="nx-fintech-title">{{ $bot?->bot_name ?? 'Active AI Portfolio' }}</h3>
                                <span
                                    class="nx-fintech-badge">{{ $bot?->trading_style ?? $bot?->strategy_type ?? 'AI Strategy' }}</span>
                            </div>
                        </div>

                        <div class="nx-fintech-metrics-bento">
                            <div class="nx-bento-item">
                                <span class="nx-bento-label">Principal Locked</span>
                                <strong class="nx-bento-value">${{ number_format($totalInvested ?? 0, 2) }}</strong>
                            </div>
                            <div class="nx-bento-item">
                                <span class="nx-bento-label">Net Return Yield</span>
                                <strong class="nx-bento-value nx-crypto-green">+${{ number_format($totalProfit ?? 0, 2) }}</strong>
                            </div>
                            <div class="nx-bento-item">
                                <span class="nx-bento-label">Aggregate ROI</span>
                                @php
                                    $pct = ($totalInvested ?? 0) ? ($totalProfit / max(1, $totalInvested)) * 100 : 0;
                                @endphp
                                <strong class="nx-bento-value nx-crypto-green">{{ number_format($pct, 2) }}%</strong>
                            </div>
                        </div>
                    </div>

                    <hr class="nx-fintech-divider">

                    <div class="nx-fintech-card-footer">
                        <div class="nx-fintech-progress-wrapper">
                            <div class="nx-progress-meta">
                                <span class="nx-progress-title">Active Time-Horizon Duration</span>
                                <span class="nx-progress-timestamp">
                                    @if($start){{ $start->format('d M') }}@endif —
                                    @if($end){{ $end->format('d M, Y') }}@endif
                                </span>
                            </div>
                            <div class="nx-fintech-track"
                                style="background:#e6e9ef; height:12px; border-radius:8px; overflow:hidden;">
                                <!-- <div id="deployedProgressFill" class="nx-fintech-fill"
                                    style="background:#22c55e; width: {{ $elapsedPct ?? 0 }}%; height:100%; transition:width .6s ease;">
                                </div> -->
                                <div id="deployedProgressFill" class="nx-fintech-fill"
                                    data-percent="{{ $elapsedPct ?? 0 }}"></div>

                            </div>
                        </div>

                        <div class="nx-fintech-actions-wrapper">
                            <a href="/botTrading" class="nx-btn-fintech nx-btn-fintech-outline">
                                <i class="bx bx-grid-alt"></i> Systems Deck
                            </a>
                            <a href="/botTrading" class="nx-btn-fintech nx-btn-fintech-solid">
                                Control Panel <i class="bx bx-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Top Stats Cards -->
            <section class="stats-grid">

                <div class="stat-card reveal">
                    <div class="icon-box blue">
                        <i class="fas fa-wallet"></i>
                    </div>

                    <div class="stat-info">
                        <h3>
                            ${{ number_format($totalInvested ?? 0, 2) }}
                        </h3>
                        <p>Total Invested</p>
                    </div>
                </div>

                <div class="stat-card reveal">
                    <div class="icon-box green">
                        <i class="fas fa-chart-pie"></i>
                    </div>

                    <div class="stat-info">
                        <h3>
                            ${{ number_format($currentBalance ?? 0, 2) }}
                        </h3>
                        <p>Current Balance</p>
                    </div>
                </div>

                <div class="stat-card reveal">
                    <div class="icon-box green-light">
                        <i class="fas fa-arrow-up"></i>
                    </div>

                    <div class="stat-info">
                        <h3 class="text-green">
                            +${{ number_format($totalProfit ?? 0, 2) }}
                        </h3>

                        <p>Total Profit</p>
                    </div>
                </div>

                <div class="stat-card reveal">
                    <div class="icon-box red">
                        <i class="fas fa-robot"></i>
                    </div>

                    <div class="stat-info">
                        <h3>
                            {{ $activeBotsCount ?? 0 }}
                        </h3>
                        <p>Deployed Bots</p>

                        <span class="status-indicator"></span>
                    </div>
                </div>

            </section>

            <!-- Main Grid -->
            <div class="main-grid">

                <!-- ACTIVE INVESTMENTS -->
                <section class="content-card inventory-card reveal">

                    <div class="card-header">

                        <h2>My Bot Investments</h2>

                        <a href="/botTrading" class="btn-primary">
                            + New Investment
                        </a>

                    </div>

                   <div class="investment-filters">
    <button class="filter-pill active" data-filter="all" type="button">All</button>
    <button class="filter-pill" data-filter="Running" type="button">Running</button>
    <button class="filter-pill" data-filter="Completed" type="button">Completed</button>
    <button class="filter-pill" data-filter="Cancelled" type="button">Cancelled</button>
</div>

                    <div class="inventory-list">
                        @if($activeInvestments->isEmpty())
                            <div class="inventory-item empty-state">
                                <div class="item-info">
                                    <span class="bot-icon">
                                        <i class="fas fa-robot"></i>
                                    </span>
                                    <div>
                                        <h4>No Active Investments</h4>
                                        <p>Deploy a trading bot from the Systems Deck to start earning returns.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach($activeInvestments as $investment)
                                <div class="inventory-item" data-status="{{ $investment->status }}">
                                    <div class="item-info">
                                        <span class="bot-icon">
                                            <i class="fas fa-robot"></i>
                                        </span>
                                        <div>
                                            <h4>{{ $investment->bot?->bot_name ?? 'Unknown Bot' }}</h4>
                                            <p>{{ $investment->bot?->description ?? 'No description available' }}</p>
                                            <div style="margin-top:10px;">
                                                <small>
                                                    ROI: <span>{{ $investment->bot?->monthly_return ?? 0 }}%</span>
                                                </small>
                                                <br>
                                                <small>
                                                    Duration: <span>{{ $investment->start_date && $investment->end_date ? \Carbon\Carbon::parse($investment->start_date)->diffInDays(\Carbon\Carbon::parse($investment->end_date)) : 0 }} Days</span>
                                                </small>
                                                <br>
                                                <small>
                                                    Risk: <span>{{ $investment->bot?->risk_level ?? '-' }}</span>
                                                </small>
                                                <br>
                                                <small>
                                                    Investment: $<span>{{ number_format($investment->investment_amount ?? 0, 2) }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-status">
                                        <span class="badge {{ $investment->status === 'Running' ? 'success' : ($investment->status === 'Completed' ? 'neutral' : 'warning') }}">
                                            {{ $investment->status ?? 'Running' }}
                                        </span>
                                        <p class="profit">+${{ number_format($investment->current_profit ?? 0, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </section>

                <!-- Right Column -->
                <div class="side-column">

                    <!-- Recent Activity -->
                    <section class="content-card activity-card reveal">

                        <h2>Recent Activity</h2>

                        <div class="timeline">

                            @if($primaryInvestment)
                                <div class="timeline-item">
                                    <div class="time-dot"></div>
                                    <p>
                                        <strong>Bot Started:</strong>
                                        <span>{{ $primaryInvestment->created_at?->format('M d, Y h:i A') }}</span>
                                    </p>
                                    <span>Just now</span>
                                </div>
                            @else
                                <div class="timeline-item">
                                    <div class="time-dot"></div>
                                    <p>
                                        <strong>No active bot history</strong>
                                        <span>Deploy a bot to populate your timeline.</span>
                                    </p>
                                    <span>Awaiting activation</span>
                                </div>
                            @endif

                            <div class="timeline-item">

                                <div class="time-dot green"></div>

                                <p>
                                    <strong>
                                        AI Monitoring:
                                    </strong>

                                    Market analysis running successfully.
                                </p>

                                <span>
                                    Live
                                </span>

                            </div>

                        </div>

                    </section>

                    <!-- Quick Actions -->
                    <section class="content-card actions-card reveal">

                        <h2>Quick Actions</h2>

                        <div class="action-buttons">

                            <a href="/botTrading" class="action-btn">
                                <i class="fas fa-plus"></i>
                                New Investment
                            </a>

                            <a href="/withdraw" class="action-btn">
                                <i class="fas fa-download"></i>
                                Withdraw Funds
                            </a>

                            <a href="/depositfunds" class="action-btn">
                                <i class="fas fa-upload"></i>
                                Deposit Funds
                            </a>

                        </div>

                    </section>

                </div>

            </div>

        </main>

    </div>

    <!-- Crypto Investments Section -->
    <div class="main-layout" style="margin-top:32px;">
        <main class="dashboard-content">
            <section class="content-card inventory-card reveal">
                <div class="card-header">
                    <h2>My Crypto Investments</h2>
                </div>

                <div class="inventory-list">
                    @if(isset($cryptoInvestments) && $cryptoInvestments->isNotEmpty())
                        @foreach($cryptoInvestments as $inv)
                            <div class="inventory-item" data-status="{{ $inv->status }}">
                                <div class="item-info">
                                    <span class="bot-icon">
                                        <i class="fas fa-coins"></i>
                                    </span>
                                    <div>
                                        <h4>{{ $inv->plan?->name ?? 'Crypto Plan' }}</h4>
                                        <p>{{ $inv->plan?->tier ?? '' }} • {{ $inv->plan?->duration_days ?? 0 }} days</p>
                                        <div style="margin-top:10px;">
                                            <small>Investment: $<span>{{ number_format($inv->amount ?? 0, 2) }}</span></small>
                                            <br>
                                            <small>Status: <span>{{ $inv->status }}</span></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-status">
                                    <span class="badge {{ $inv->status === 'Running' ? 'success' : ($inv->status === 'Completed' ? 'neutral' : 'warning') }}">{{ $inv->status ?? 'Running' }}</span>
                                    <p class="profit">+${{ number_format($inv->current_profit ?? 0, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="inventory-item empty-state">
                            <div class="item-info">
                                <span class="bot-icon">
                                    <i class="fas fa-coins"></i>
                                </span>
                                <div>
                                    <h4>No Crypto Investments</h4>
                                    <p>Invest in a crypto plan to see it listed here.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <section class="content-card inventory-card reveal" style="margin-top:24px;">
                <div class="card-header">
                    <h2>My Stock Investments</h2>
                </div>

                <div class="inventory-list">
                    @if(isset($stockInvestments) && $stockInvestments->isNotEmpty())
                        @foreach($stockInvestments as $stockInv)
                            <div class="inventory-item" data-status="{{ $stockInv->status }}">
                                <div class="item-info">
                                    <span class="bot-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </span>
                                    <div>
                                        <h4>{{ $stockInv->plan?->name ?? 'Stock Plan' }}</h4>
                                        <p>{{ $stockInv->plan?->tier ?? '' }} • {{ $stockInv->term ?? '' }} term</p>
                                        <div style="margin-top:10px;">
                                            <small>Investment: $<span>{{ number_format($stockInv->amount ?? 0, 2) }}</span></small>
                                            <br>
                                            <small>Status: <span>{{ $stockInv->status }}</span></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-status">
                                    <span class="badge {{ $stockInv->status === 'Running' ? 'success' : ($stockInv->status === 'Completed' ? 'neutral' : 'warning') }}">
                                        {{ $stockInv->status ?? 'Running' }}
                                    </span>
                                    <p class="profit">+${{ number_format($stockInv->current_profit ?? 0, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="inventory-item empty-state">
                            <div class="item-info">
                                <span class="bot-icon">
                                    <i class="fas fa-chart-line"></i>
                                </span>
                                <div>
                                    <h4>No Stock Investments</h4>
                                    <p>Invest in a stock plan to see it listed here.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </main>
    </div>

    </div>


    <script src="{{ asset('assets/Frontend/js/deploybot.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const progressFill = document.getElementById('deployedProgressFill');
            if (progressFill) {
                const percent = Number(progressFill.dataset.percent || 0);
                progressFill.style.width = `${Math.max(0, Math.min(100, percent))}%`;
            }

            const filterButtons = document.querySelectorAll('.filter-pill');
            const investmentItems = document.querySelectorAll('.inventory-item[data-status]');

            function applyFilter(status) {
                investmentItems.forEach(item => {
                    const itemStatus = item.dataset.status || 'Running';
                    const showItem = status === 'all' || itemStatus.toLowerCase() === status.toLowerCase();
                    item.style.display = showItem ? '' : 'none';
                });
            }

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    applyFilter(button.dataset.filter);
                });
            });
        });
    </script>

</body>

</html>