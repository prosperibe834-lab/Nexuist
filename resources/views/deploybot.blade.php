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

    <header class="top-header">
        <div class="header-left">
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <span class="iconify" data-icon="ri:menu-line"></span>
            </button>
            <a href="/" class="logo-area">
                <img src="{{ asset('assets/Frontend/image/mylog.jpeg') }}" alt="Nexuist Logo" class="logo-img">
                <div class="logo-text">
                    <h2>Nexuist</h2>
                    <p>Professional Trading</p>
                </div>
            </a>

            <div class="crypto-ticker desktop-only">
                <span class="live-indicator"><span class="dot"></span> LIVE</span>
                <span class="ticker-item">BTC: <strong class="red">$80,898</strong></span>
                <span class="ticker-item">ETH: <strong class="red">$2,329</strong></span>
            </div>
        </div>

        <div class="header-right">
            <div class="top-balance-box desktop-only">
                <span class="balance-label">ACCOUNT BALANCE</span>
                <span class="balance-value"> ${{ number_format(Auth::user()->balance, 2) }}

            </div>

            <div class="header-actions">

                <div class="qt-dropdown-wrapper">

                    <button class="qt-dropdown-btn" id="qtDropdownBtn">

                        <div class="qt-user-details">
                            <span class="qt-user-title">Quick Trade</span>
                            <small class="qt-user-sub">Trading Panel</small>
                        </div>

                        <span class="iconify qt-arrow-icon" data-icon="solar:alt-arrow-down-outline"></span>

                    </button>

                    <div class="qt-dropdown-menu" id="qtDropdownMenu">

                        <a href="#" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:wallet-money-outline"></span>
                            <span>Deposit Funds</span>
                        </a>

                        <a href="#" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:card-send-outline"></span>
                            <span>Withdraw Funds</span>
                        </a>

                        <a href="#" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:chart-square-outline"></span>
                            <span>Trade Markets</span>
                        </a>


                    </div>

                </div>

                <div class="notification-wrapper">
                    <button class="icon-btn" id="notifBtn">
                        <span class="iconify" data-icon="ri:notification-3-line"></span>
                        <span class="badge red-badge">4</span>
                    </button>
                    <div class="dropdown-menu notif-menu" id="notifMenu">
                        <div class="menu-header">Notifications</div>
                        <a href="#" class="menu-item">System update complete</a>
                        <a href="#" class="menu-item">Check new live markets</a>
                    </div>
                </div>



                <div class="user-profile">
                    <button class="profile-btn" id="profileBtn">
                        {{-- Avatar shows first letter of name --}}
                        <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <div class="user-info desktop-only">
                            <span class="name">{{ Auth::user()->name }}</span>
                            <span class="type">Trading Account</span>
                        </div>
                        <span class="iconify arrow desktop-only" data-icon="ri:arrow-down-s-line"></span>
                    </button>

                    <div class="dropdown-menu profile-menu" id="profileMenu">
                        <a href="/profilesetting" class="menu-item"><span class="iconify"
                                data-icon="ri:user-line"></span> My
                            Profile</a>
                        <a href="#" class="menu-item"><span class="iconify" data-icon="ri:settings-4-line"></span>
                            Settings</a>
                        <a href="#" class="menu-item text-red"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="iconify" data-icon="ri:logout-box-r-line"></span>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="main-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <span>LIVE MARKET</span>
                <span class="live-tag"><span class="dot green-dot"></span> LIVE</span>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:layout-grid-line"></span> OVERVIEW</h3>
                    <a href="/" class="nav-item">
                        <span class="iconify" data-icon="solar:widget-2-outline"></span>
                        Dashboard
                    </a>
                    <a href="/accountstatement" class="nav-item">
                        <span class="iconify" data-icon="ri:file-list-3-line"></span> Account Statement
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:briefcase-line"></span> PORTFOLIO &
                        INVESTMENTS</h3>
                    <div class="nav-dropdown-container">
                        <a href="#" class="nav-item has-dropdown" id="investPlansBtn">
                            <div class="item-left">
                                <span class="iconify" data-icon="ri:focus-3-line"></span> Investment Plans
                            </div>
                            <span class="iconify arrow" data-icon="ri:arrow-down-s-line"></span>
                        </a>
                        <div class="sidebar-submenu" id="investPlansMenu">

                            <a href="plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:layers-outline"></span>
                                All Plans
                            </a>

                            <a href="active-plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:chart-square-outline"></span>
                                Stock Market
                            </a>

                            <a href="active-plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="mdi:currency-btc"></span>
                                Crypto Investment
                            </a>

                            <a href="active-plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:buildings-2-outline"></span>
                                Real Estate
                            </a>

                        </div>
                    </div>
                    <a href="/portfolio" class="nav-item">
                        <span class="iconify" data-icon="ri:pie-chart-line"></span> My Portfolio
                    </a>
                    <a href="/performance" class="nav-item">
                        <span class="iconify" data-icon="ri:line-chart-line"></span> Performance History
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:stock-line"></span> TRADING & MARKETS</h3>
                    <a href="/demo" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:graduation-cap-line"></span> Demo
                            Trading</div>
                        <span class="badge outline-green">Practice</span>
                    </a>
                    <a href="/livemarkets" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:bar-chart-box-line"></span> Live
                            Markets</div>
                        <span class="badge solid-red"><span class="dot"></span> Live</span>
                    </a>
                    <a href="copy.html" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:user-follow-line"></span> Copy
                            Trading</div>
                        <span class="badge solid-purple">Pro</span>
                    </a>
                    <a href="/botTrading" class="nav-item active">
                        <div class="item-left"><span class="iconify" data-icon="ri:robot-2-line"></span> AI Trading Bots
                        </div>
                        <span class="badge solid-blue">AI</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:radar-line"></span> MARKET INTELLIGENCE
                    </h3>
                    <a href="signals.html" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:flashlight-fill"></span> Premium
                            Signals</div>
                        <span class="badge solid-orange">Premium</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:wallet-3-line"></span> WALLET & FUNDS</h3>
                    <a href="/deposit" class="nav-item">
                        <span class="iconify" data-icon="ri:add-circle-line"></span> Deposit Funds
                    </a>
                    <a href="/withdraw" class="nav-item">
                        <span class="iconify" data-icon="solar:card-send-outline"></span>
                        Withdraw Funds
                    </a>
                    <a href="/transfer" class="nav-item">
                        <span class="iconify" data-icon="ri:arrow-left-right-line"></span> Internal Transfer
                    </a>
                </div>

                <div class="acm-section">

                    <h3 class="acm-title">
                        <span class="iconify" data-icon="solar:shield-user-outline"></span>
                        Account Management
                    </h3>

                    <!-- DROPDOWN -->
                    <div class="acm-dropdown-wrap">

                        <button class="acm-dropdown-btn" id="acmVerifyBtn">

                            <div class="acm-btn-left">
                                <span class="iconify acm-main-icon" data-icon="solar:user-id-outline"></span>

                                <span>Identity Verification</span>
                            </div>

                            <span class="iconify acm-arrow" data-icon="solar:alt-arrow-down-outline"></span>

                        </button>

                        <!-- SUBMENU -->
                        <div class="acm-dropdown-menu" id="acmVerifyMenu">

                            <div class="acm-info-box">

                                <span class="iconify acm-info-icon" data-icon="solar:verified-check-outline"></span>

                                <div class="acm-info-text">
                                    <h4>Identity Verification</h4>

                                    <p>
                                        Complete your identity verification to unlock
                                        full trading and withdrawal features.
                                    </p>
                                </div>

                            </div>

                            <a href="verification.html" class="acm-verify-link">

                                <span class="iconify" data-icon="solar:shield-check-outline"></span>

                                Verify Identity

                            </a>

                        </div>

                    </div>



                    <!-- PROFILE SETTINGS -->
                    <a href="/portfolio" class="acm-nav-link">

                        <span class="iconify" data-icon="solar:settings-outline"></span>

                        Profile Settings

                    </a>

                </div>

                <div class="nav-section">
                    <h3 class="nav-title">
                        <span class="iconify" data-icon="solar:gift-outline"></span>
                        Growth & Rewards
                    </h3>

                    <a href="signals.html" class="nav-item">
                        <div class="item-left">
                            <span class="iconify" data-icon="solar:users-group-rounded-outline"></span>
                            Referral Program
                        </div>

                        <span class="badge solid-orange">5%</span>
                    </a>
                </div>
                <div class="nav-section">
                    <h3 class="nav-title">
                        <span class="iconify" data-icon="solar:headphones-round-sound-outline"></span>
                        Support Center
                    </h3>

                    <a href="signals.html" class="nav-item">
                        <div class="item-left">
                            <span class="iconify" data-icon="solar:chat-round-dots-outline"></span>
                            Support Center
                        </div>
                    </a>
                </div>

            </nav>

            <div class="sidebar-footer">

                <a href="credit.html" class="apply-credit">
                    <span class="iconify" data-icon="ri:add-box-line"></span> Apply for Credit
                    <span class="badge solid-green">Fast</span>
                </a>
            </div>

            <div class="contact-wrapper">

                <a href="contact.html" class="contact-btn">

                    <span class="iconify contact-icon" data-icon="solar:phone-calling-outline"></span>

                    <span>Contact Support</span>

                </a>

            </div>

            <div class="logout-wrapper">
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn"
                        style="background: none; border: none; cursor: pointer; display: flex; align-items: center; width: 100%;">
                        <i class='bx bx-log-out'></i>
                        <span style="margin-left: 8px;">Log Out</span>
                    </button>
                </form>
            </div>

        </aside>

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