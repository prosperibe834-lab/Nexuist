<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/ai-bot.css') }}">
</head>

<body>

    <!-- Preloader starts here -->

    <div id="nexuist-preloader">
        <div class="loader-terminal-box">
            <i class='bx bx-cube-alt loader-brand-icon'></i>
            <div class="glow-bars-container">
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
            </div>
            <span class="loader-status-text">CONNECTING TO SECURE NODE...</span>
        </div>
    </div>

    <!-- Preloader ends here -->

    <nav class="sidebar" id="sidebar">
        <div class="logo-details">
            <i class='bx bx-cube-alt logo-icon'></i>
            <span class="logo_name">NEXUIST</span>
            <i class='bx bx-chevron-left' id="sidebar-toggle-btn"></i>
        </div>

        <ul class="nav-links">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/users') }}">
                    <i class='bx bx-user-pin'></i>
                    <span class="link_name">Users Management</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users">Users Management</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/deposits') }}">
                    <i class='bx bx-credit-card'></i>
                    <span class="link_name">Deposits</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/deposits') }}">Deposits</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/withdrawals') }}">
                    <i class='bx bx-transfer'></i>
                    <span class="link_name">Withdrawals</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/withdrawals">Withdrawals</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/investment-plans') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Investment Plans</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/investment-plans">Investment Plans</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="/ai-bot">
                    <i class='bx bx-bot'></i>
                    <span class="link_name">AI Bot Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/ai-bot">AI Bot Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/copy-trading') }}">
                    <i class='bx bx-copy-alt'></i>
                    <span class="link_name">Copy Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/copy-trading">Copy Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="internal-transfers">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="link_name">Internal Transfers</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="internal-transfers">Internal Transfers</a></li>
                </ul>
            </li>
            <li>
                <a href="performance">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="link_name">Performance History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="performance">Performance History</a></li>
                </ul>
            </li>
            <li>
                <a href="portfolio">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Portfolio Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="portfolio">Portfolio Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="statements">
                    <i class='bx bx-file-find'></i>
                    <span class="link_name">Account Statements</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="statements">Account Statements</a></li>
                </ul>
            </li>
            <li>
                <a href="kyc">
                    <i class='bx bx-id-card'></i>
                    <span class="link_name">KYC Verification</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="kyc">KYC Verification</a></li>
                </ul>
            </li>
            <li>
                <a href="loans">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Loan Requests</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="loans">Loan Requests</a></li>
                </ul>
            </li>
            <li>
                <a href="admin-notifications">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="admin-notifications">Notifications</a></li>
                </ul>
            </li>
            <li>
                <a href="support">
                    <i class='bx bx-support'></i>
                    <span class="link_name">Messages & Support</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="support">Messages & Support</a></li>
                </ul>
            </li>
            <li>
                <a href="transactions">
                    <i class='bx bx-receipt'></i>
                    <span class="link_name">Transaction Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="transactions">Transaction Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="website-settings">
                    <i class='bx bx-globe'></i>
                    <span class="link_name">Website Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="website-settings">Website Settings</a></li>
                </ul>
            </li>
            <li>
                <a href="security">
                    <i class='bx bx-shield-quarter'></i>
                    <span class="link_name">Security Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="security">Security Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="admin-settings">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Admin Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="admin-settings">Admin Settings</a></li>
                </ul>
            </li>

            <li class="control-items">
                <div class="mode-toggle-wrapper">
                    <div class="mode-text-wrapper">
                        <i class='bx bx-moon mode-icon-indicator'></i>
                        <span class="link_name mode-label">Dark Mode</span>
                    </div>
                    <div class="toggle-switch-track">
                        <span class="switch-thumb"></span>
                    </div>
                </div>
            </li>

            <li class="logout-item">
                <a href="logout">
                    <i class='bx bx-log-out-circle'></i>
                    <span class="link_name">Logout</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">AI-Bot</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nx-adv-dashboard-scope">

            <div class="nx-adv-app-control-header">
                <div class="nx-adv-header-meta-zone">
                    <span class="nx-adv-header-pre-title">NEXUIST QUANT ALGO UTILITY</span>
                    <h1 class="nx-adv-header-main-title">AI Trading Systems Command</h1>
                </div>
                <div class="nx-adv-header-buttons-cluster">
                    <div class="nx-adv-export-dropdown-wrapper">
                        <button class="nx-adv-btn nx-adv-btn-secondary" id="nx-adv-export-trigger">
                            <i class="bx bx-export"></i> Export Intelligence <i class="bx bx-chevron-down"></i>
                        </button>
                        <div class="nx-adv-dropdown-panel" id="nx-adv-export-menu">
                            <a href="#" onclick="window.nxAdvEmitExport('PDF')"><i class="bx bxs-file-pdf"></i> Export
                                as PDF Format</a>
                            <a href="#" onclick="window.nxAdvEmitExport('Excel')"><i class="bx bxs-spreadsheet"></i>
                                Export as Excel Ledger</a>
                            <a href="#" onclick="window.nxAdvEmitExport('CSV')"><i class="bx bx-file"></i> Export
                                Comma-Separated (CSV)</a>
                        </div>
                    </div>
                    <button class="nx-adv-btn nx-adv-btn-primary" id="nx-adv-open-create-modal">
                        <i class="bx bx-plus-circle"></i> Initialize Core Model
                    </button>
                </div>
            </div>

            <div class="nx-adv-bento-kpi-matrix">
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Total AI Systems</span>
                        <div class="nx-adv-kpi-badge nx-adv-purple"><i class="bx bx-chip"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value" id="nx-v-total-bots">
                        {{ $stats['totalBots'] }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up"><i class="bx bx-trending-up"></i> +4.2%</span>
                        <span class="nx-adv-trend-context">vs macro model</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Active Deployments</span>
                        <div class="nx-adv-kpi-badge nx-adv-green"><i class="bx bx-play-circle"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value" id="nx-v-active-bots">
                        {{ $stats['activeBots'] }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up"><i class="bx bx-pulse"></i> Stable</span>
                        <span class="nx-adv-trend-context">98.4% uptime</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Inactive / Cold</span>
                        <div class="nx-adv-kpi-badge nx-adv-muted"><i class="bx bx-stop-circle"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value" id="nx-v-inactive-bots">
                        {{ $stats['inactiveBots'] }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-neutral">Isolated</span>
                        <span class="nx-adv-trend-context">Resource optimized</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Featured Models</span>
                        <div class="nx-adv-kpi-badge nx-adv-gold"><i class="bx bx-crown"></i></div>
                    </div>

                    <h3 class="nx-adv-kpi-value" id="nx-v-featured-bots">
                        {{ $stats['featuredBots'] }}
                    </h3>

                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up"><i class="bx bx-star"></i> Prime</span>
                        <span class="nx-adv-trend-context">Top tier exposure</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Total Subscribers</span>
                        <div class="nx-adv-kpi-badge nx-adv-blue"><i class="bx bx-group"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value" id="nx-v-total-subs">
                        {{ number_format($stats['totalSubscribers']) }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up"><i class="bx bx-trending-up"></i> +12.4%</span>
                        <span class="nx-adv-trend-context">MoM velocity</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Active Pools Allocation</span>
                        <div class="nx-adv-kpi-badge nx-adv-green"><i class="bx bx-user-check"></i></div>
                    </div>

                    <h3 class="nx-adv-kpi-value" id="nx-v-active-subs">
                        {{ number_format($stats['activeSubscribers']) }}
                    </h3>

                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up">87.5%</span>
                        <span class="nx-adv-trend-context">Conversion rate</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Total Investments</span>
                        <div class="nx-adv-kpi-badge nx-adv-purple"><i class="bx bx-wallet"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value" id="nx-v-total-invested">
                        ${{ number_format($stats['totalInvestments'], 2) }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up"><i class="bx bx-trending-up"></i> +18.2%</span>
                        <span class="nx-adv-trend-context">Net incoming capital</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Assets Under Management</span>
                        <div class="nx-adv-kpi-badge nx-adv-gold"><i class="bx bx-line-chart"></i></div>
                    </div>

                    <h3 class="nx-adv-kpi-value" id="nx-v-aum">
                        ${{ number_format($stats['aum'], 2) }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up">Liquidity Vault</span>
                        <span class="nx-adv-trend-context">Real-time valuation</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Total Alpha Generated</span>
                        <div class="nx-adv-kpi-badge nx-adv-green"><i class="bx bx-money"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value" style="color:#10b981;">
                        ${{ number_format($stats['totalProfit'], 2) }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up"><i class="bx bx-trending-up"></i> +24.1%</span>
                        <span class="nx-adv-trend-context">Payout distribution</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Inflow Velocity (24h)</span>
                        <div class="nx-adv-kpi-badge nx-adv-blue"><i class="bx bx-time-five"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value">
                        ${{ number_format($stats['inflow24h'], 2) }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up"><i class="bx bx-bolt"></i> Intense</span>
                        <span class="nx-adv-trend-context">New dynamic accounts</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Yield Velocity (24h)</span>
                        <div class="nx-adv-kpi-badge nx-adv-green"><i class="bx bx-area"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value" style="color:#10b981;">
                        ${{ number_format($stats['yield24h'], 2) }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up">Avg 14.2%</span>
                        <span class="nx-adv-trend-context">Compounded scale</span>
                    </div>
                </div>
                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Dominant Core Engine</span>
                        <div class="nx-adv-kpi-badge nx-adv-purple"><i class="bx bx-pie-chart-alt"></i></div>
                    </div>
                    <h3 class="nx-adv-kpi-value"
                        style="font-size: 1.15rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding: 0.2rem 0;">
                        {{ $stats['mostPopularBot']->bot_name ?? 'No Bot Yet' }}
                    </h3>
                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up">45% Volume</span>
                        <span class="nx-adv-trend-context">Allocation dominance</span>
                    </div>
                </div>

                <div class="nx-adv-kpi-node nx-adv-glass">
                    <div class="nx-adv-kpi-head">
                        <span class="nx-adv-kpi-label">Average Accuracy</span>
                        <div class="nx-adv-kpi-badge nx-adv-green">
                            <i class="bx bx-target-lock"></i>
                        </div>
                    </div>

                    <h3 class="nx-adv-kpi-value">
                        {{ $stats['averageAccuracy'] }}%
                    </h3>

                    <div class="nx-adv-kpi-footer">
                        <span class="nx-adv-trend nx-adv-up">
                            <i class="bx bx-trending-up"></i>
                            AI Performance
                        </span>
                        <span class="nx-adv-trend-context">Across all active bots</span>
                    </div>
                </div>
            </div>

            <div class="nx-adv-filter-dashboard-deck nx-adv-glass">
                <div class="nx-adv-search-input-box-wrapper">
                    <i class="bx bx-search-alt nx-adv-search-icon"></i>
                    <input type="text" id="nx-adv-unified-global-search"
                        placeholder="Filter by System ID, Email, User Name, Strategy Pattern...">
                </div>
                <div class="nx-adv-filters-actions-row">
                    <select id="nx-adv-filter-system-status" class="nx-adv-select-field">
                        <option value="all">System Status (All)</option>
                        <option value="active">Active Status</option>
                        <option value="inactive">Inactive Status</option>
                        <option value="coming soon">Coming Soon</option>
                    </select>
                    <select id="nx-adv-filter-user-status" class="nx-adv-select-field">
                        <option value="all">Investor Strategy (All)</option>
                        <option value="running">Running Models</option>
                        <option value="completed">Completed Term</option>
                        <option value="cancelled">Terminated Position</option>
                    </select>
                    <select id="nx-adv-filter-sorting-metric" class="nx-adv-select-field">
                        <option value="newest">Sort Rule: Newest Deployments</option>
                        <option value="highest-profit">Sort Rule: Highest System Profit</option>
                        <option value="highest-roi">Sort Rule: Maximum Historical ROI</option>
                        <option value="most-subs">Sort Rule: High Subscriber Base</option>
                    </select>
                </div>
            </div>

            <div class="nx-adv-split-workspace-layout-matrix">

                <div class="nx-adv-primary-stack-workspace-area">

                    <div class="nx-adv-component-card nx-adv-glass">
                        <div class="nx-adv-card-header-bar">
                            <div class="nx-adv-card-header-titles">
                                <h2>System Registry Models Ledger</h2>
                                <p>Core neural intelligence matrix allocations status paths</p>
                            </div>
                        </div>
                        <div class="nx-adv-data-table-viewport-scroller">
                            <table class="nx-adv-master-data-table">
                                <thead>
                                    <tr>
                                        <th>System Signature ID</th>
                                        <th>Strategy Engine Pattern</th>
                                        <th>Expected Yield (Mo)</th>
                                        <th>System Accuracy</th>
                                        <th>Subscriber Allocation</th>
                                        <th>Total Capital AUM</th>
                                        <th>Risk Limit</th>
                                        <th>Deployment Status</th>
                                        <th style="text-align: right;">System Command Operations</th>
                                    </tr>
                                </thead>
                                <tbody id="nx-adv-tbody-systems-registry">

                                    @foreach($bots as $bot)

                                        <tr>

                                            <td>#{{ $bot->id }}</td>

                                            <td>{{ $bot->bot_name }}</td>

                                            <td>{{ $bot->monthly_return }}%</td>

                                            <td>{{ $bot->accuracy_rate }}%</td>

                                            <td>{{ number_format($bot->total_subscribers) }}</td>

                                            <td>${{ number_format($bot->total_investment, 2) }}</td>

                                            <td>{{ $bot->risk_level }}</td>

                                            <td>
                                                <span class="badge">
                                                    {{ $bot->status }}
                                                </span>
                                            </td>

                                            <td style="text-align:right">

                                                <button class="edit-btn" data-id="{{ $bot->id }}">
                                                    Edit
                                                </button>

                                                <form action="{{ route('admin.bots.delete', $bot->id) }}" method="POST"
                                                    style="display:inline">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit">
                                                        Delete
                                                    </button>

                                                </form>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="nx-adv-component-card nx-adv-glass">
                        <div class="nx-adv-card-header-bar">
                            <div class="nx-adv-card-header-titles">
                                <h2>Active System Allocations</h2>
                                <p>Real-time cross-sectional analysis of all running capital accounts</p>
                            </div>
                        </div>
                        <div class="nx-adv-data-table-viewport-scroller">
                            <table class="nx-adv-master-data-table">
                                <thead>
                                    <tr>
                                        <th>Investor Account</th>
                                        <th>Allocated Algorithm</th>
                                        <th>Principal Capital</th>
                                        <th>Net Yield Realized</th>
                                        <th>ROI Output</th>
                                        <th>Term Window Span</th>
                                        <th>Position Tracker</th>
                                        <th style="text-align: right;">Telemetry Control</th>
                                    </tr>
                                </thead>
                                <tbody id="nx-adv-tbody-active-investors-registry">

@foreach($investments as $investment)

<tr>

    <td>
        {{ $investment->user->name ?? 'Unknown User' }}
    </td>

    <td>
        {{ $investment->bot->bot_name ?? 'Unknown Bot' }}
    </td>

    <td>
        ${{ number_format($investment->investment_amount,2) }}
    </td>

    <td style="color:#10b981;">
        ${{ number_format($investment->current_profit,2) }}
    </td>

    <td>

        @php

            $roi = $investment->investment_amount > 0
                ? ($investment->current_profit / $investment->investment_amount) * 100
                : 0;

        @endphp

        {{ number_format($roi,2) }}%

    </td>

    <td>
        {{ $investment->start_date }}
        <br>
        →
        <br>
        {{ $investment->end_date }}
    </td>

    <td>

        <span class="badge">

            {{ $investment->status }}

        </span>

    </td>

    <td style="text-align:right">

        <button
            class="view-investor-btn"
            data-id="{{ $investment->id }}"
        >
            View
        </button>

    </td>

</tr>

@endforeach

</tbody>
                            </table>
                        </div>
                    </div>

                    <div class="nx-adv-component-card nx-adv-glass">
                        <div class="nx-adv-card-header-bar">
                            <div class="nx-adv-card-header-titles">
                                <div class="nx-adv-live-pulsar-title-wrap">
                                    <span class="nx-adv-live-ping-node"></span>
                                    <h2>Live Stream Order Pipeline Telemetry</h2>
                                </div>
                                <p>Automated transactional throughput logs (Auto-refreshing every 30s queue intervals)
                                </p>
                            </div>
                            <span class="nx-adv-timestamp-counter-tracker" id="nx-adv-live-ticker-countdown">Next
                                Refresh: 30s</span>
                        </div>
                        <div class="nx-adv-data-table-viewport-scroller">
                            <table class="nx-adv-master-data-table style-ticker-compact">
                                <thead>
                                    <tr>
                                        <th>User Index ID</th>
                                        <th>Profile Entity</th>
                                        <th>Target Model</th>
                                        <th>Capital Load</th>
                                        <th>Accumulated Net Return</th>
                                        <th>Velocity Stream Delta</th>
                                        <th>Last Pulse Update</th>
                                    </tr>
                                </thead>
                                <tbody id="nx-adv-tbody-live-stream-ticker">

@foreach($investments as $investment)

<tr>

    <td>
        #{{ $investment->user->id ?? 'N/A' }}
    </td>

    <td>
        {{ $investment->user->name ?? 'Unknown User' }}
    </td>

    <td>
        {{ $investment->bot->bot_name ?? 'Unknown Bot' }}
    </td>

    <td>
        ${{ number_format($investment->investment_amount,2) }}
    </td>

    <td style="color:#10b981">
        ${{ number_format($investment->current_profit,2) }}
    </td>

    <td>

        @php

        $delta = $investment->investment_amount > 0
        ? ($investment->current_profit / $investment->investment_amount) * 100
        : 0;

        @endphp

        {{ number_format($delta,2) }}%

    </td>

    <td>
        {{ $investment->updated_at->diffForHumans() }}
    </td>

</tr>

@endforeach

</tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="nx-adv-secondary-stack-analytics-area">

                    <div class="nx-adv-component-card nx-adv-glass">
                        <div class="nx-adv-card-header-bar">
                            <div class="nx-adv-card-header-titles">
                                <h2>Structural Capital Distribution</h2>
                                <p>Aggregate assets under management pool architecture mapping allocation values</p>
                            </div>
                        </div>
                        <div class="nx-adv-donut-visualization-chart-mock">
                            <div class="nx-adv-donut-canvas-frame" id="nx-dynamic-donut-target">
                                <div class="nx-adv-donut-inner-metrics-text">
                                    <h3 id="nx-dynamic-donut-total-aum">$0.00</h3>
                                    <p>Active AUM</p>
                                </div>
                            </div>
                        </div>
                        <div class="nx-adv-legend-list-stack-group" id="nx-dynamic-donut-legend"></div>
                    </div>

                    <div class="nx-adv-component-card nx-adv-glass">
                        <div class="nx-adv-card-header-bar">
                            <div class="nx-adv-card-header-titles">
                                <h2>Capital Growth Index Velocity</h2>
                                <p>Net asset incoming load vectors real-time charts projection</p>
                            </div>
                        </div>
                        <div class="nx-adv-sparkline-graphical-card-wrapper" id="nx-dynamic-sparkline-target">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="nx-adv-modal-backdrop-overlay-layer" id="nx-adv-modal-system-creation-wizard">
            <div class="nx-adv-modal-window-container nx-adv-glass">
                <div class="nx-adv-modal-window-toolbar-header">
                    <h3 id="nx-adv-wizard-panel-main-title-label">Initialize Quantum Algorithm Node</h3>
                    <button class="nx-adv-modal-close-window-trigger-btn" id="nx-adv-btn-close-wizard-modal">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="nx-adv-modal-tab-segment-navigation-strip">
                    <button class="nx-adv-tab-navigation-node active" data-target-pane="nx-adv-pane-basic-info">1.
                        Architecture Identity</button>
                    <button class="nx-adv-tab-navigation-node" data-target-pane="nx-adv-pane-performance">2.
                        Quantitative Targets</button>
                    <button class="nx-adv-tab-navigation-node" data-target-pane="nx-adv-pane-execution">3. Execution
                        Safeguards</button>
                </div>

                <form id="nx-adv-form-quantum-bot-configuration-payload" action="{{ route('admin.bots.store') }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" id="nx-adv-form-field-bot-target-hash-id" value="">

                    <div class="nx-adv-modal-form-tab-content-pane active" id="nx-adv-pane-basic-info">
                        <div class="nx-adv-form-grid-layout-double-columns">
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-name">Algorithmic Model Name *</label>

                                <input type="text" id="nx-adv-input-name" name="bot_name" required
                                    placeholder="e.g. Nexuist Black Core V1">

                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-strategy">Strategy Route Template *</label>
                                <select id="nx-adv-input-strategy" name="strategy_type"
                                    class="nx-adv-select-field form-override-styled">
                                    <option value="Scalping">Neural Grid Scalping Pipeline</option>
                                    <option value="Swing Trading">Macro Vector Trend Swing</option>
                                    <option value="Day Trading">High Density Intraday Momentum</option>
                                    <option value="Long Term">Asynchronous Value Rebalancer</option>
                                </select>
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-trading-style">Market Pair Category *</label>
                                <select id="nx-adv-input-trading-style" name="trading_style"
                                    class="nx-adv-select-field form-override-styled">
                                    <option value="Forex">Forex</option>
                                    <option value="Crypto">Crypto</option>
                                    <option value="Stocks">Stocks</option>
                                    <option value="Commodities">Commodities</option>
                                </select>
                            </div>
                        </div>
                        <div class="nx-adv-form-input-element-wrap margin-top-field">
                            <label for="nx-adv-input-description">Engine Processing Logic & Arbitrage Architecture Model
                                Overview</label>
                            <textarea id="nx-adv-input-description" name="description" rows="3"
                                placeholder="Detail standard quantitative routes, operational execution pairs and computational neural path constraints..."></textarea>
                        </div>
                        <div class="nx-adv-form-grid-layout-triple-columns margin-top-field">
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-risk">Risk Assessment Profile</label>
                                <select id="nx-adv-input-risk" name="risk_level"
                                    class="nx-adv-select-field form-override-styled">
                                    <option value="Low">Low Volatility Structural Guard</option>
                                    <option value="Medium">Medium Balanced Index Profile</option>
                                    <option value="High">High Leverage Alpha Optimization</option>
                                </select>
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-status">Initial State</label>
                                <select id="nx-adv-input-status" name="status"
                                    class="nx-adv-select-field form-override-styled">
                                    <option value="Active">Active Operational Pipeline</option>
                                    <option value="Inactive">Cold Offline Standby Stasis</option>
                                    <option value="Coming Soon">Pre-alpha Test Sandbox Pipeline</option>
                                </select>
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label>Promotional Badges Assignment</label>
                                <div class="nx-adv-checkbox-row-alignment-flex-wrap">
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox"
                                            name="featured" value="1" id="nx-adv-check-featured">
                                        <span>Featured</span></label>
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox"
                                            id="nx-adv-check-premium" name="premium" value="1">
                                        <span>Premium</span></label>
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox"
                                            id="nx-adv-check-popular" name="popular" value="1">
                                        <span>Popular</span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nx-adv-modal-form-tab-content-pane" id="nx-adv-pane-performance">
                        <div class="nx-adv-form-grid-layout-triple-columns">
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-monthly-roi">Target Monthly Yield Return %</label>
                                <input type="number" step="0.01" id="nx-adv-input-monthly-roi" placeholder="e.g. 24.50"
                                    name="monthly_return">
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-annual-roi">Target Annualized Return %</label>
                                <input type="number" step="0.01" id="nx-adv-input-annual-roi" placeholder="e.g. 294.00"
                                    name="annual_return">
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-accuracy">Backtested Accuracy Rating %</label>
                                <input type="number" step="0.01" id="nx-adv-input-accuracy" placeholder="e.g. 91.24"
                                    name="accuracy_rate">
                            </div>
                        </div>
                        <div class="nx-adv-form-grid-layout-triple-columns margin-top-field">
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-drawdown">Maximum Peak Drawdown Bound %</label>
                                <input type="number" step="0.01" id="nx-adv-input-drawdown" placeholder="e.g. 4.12"
                                    name="drawdown">
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-min-inv">Minimum Entry Threshold ($)</label>
                                <input type="number" id="nx-adv-input-min-inv" placeholder="e.g. 500"
                                    name="minimum_investment">
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label for="nx-adv-input-max-inv">Maximum Risk Allocation Cap ($)</label>
                                <input type="number" id="nx-adv-input-max-inv" placeholder="e.g. 250000"
                                    name="maximum_investment">
                            </div>

                            <div class="nx-adv-form-input-element-wrap">
                                <label>Bot Image</label>

                                <input type="file" name="bot_image" accept="image/*">
                            </div>

                        </div>
                    </div>

                    <div class="nx-adv-modal-form-tab-content-pane" id="nx-adv-pane-execution">
                        <div class="nx-adv-form-grid-layout-double-columns">
                            <div class="nx-adv-form-input-element-wrap">
                                <label>Target Execution Liquid Assets Arenas</label>
                                <div class="nx-adv-vertical-checkbox-panel-card-list">
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox" checked
                                            disabled> <span>Spot Foreign Exchange Matrix Routes</span></label>
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox" checked>
                                        <span>Crypto Derivatives Asset Pairs Pipelines</span></label>
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox">
                                        <span>Equity Index Futures Leverage Routes</span></label>
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox">
                                        <span>Hard Commodities Spot Arbitrage Systems</span></label>
                                </div>
                            </div>
                            <div class="nx-adv-form-input-element-wrap">
                                <label>Integrated Safeguards Hardcoded Architecture Flags</label>
                                <div class="nx-adv-vertical-checkbox-panel-card-list">
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox" checked>
                                        <span>Automated Position Stop Pipeline Mechanics</span></label>
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox" checked>
                                        <span>Continuous Machine Learning Pattern Recalibration</span></label>
                                    <label class="nx-adv-checkbox-styled-label-element"><input type="checkbox" checked>
                                        <span>Circuit-Breaker Emergency Interoperability Vaults</span></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nx-adv-modal-window-actions-footer-toolbar-tray">
                        <button type="button" class="nx-adv-btn nx-adv-btn-secondary"
                            id="nx-adv-btn-wizard-cancel">Terminate Wizard</button>
                        <div class="nx-adv-wizard-step-progression-alignment-group-flex">
                            <button type="button" class="nx-adv-btn nx-adv-btn-secondary" id="nx-adv-btn-wizard-back"
                                style="display: none;">Previous Step</button>
                            <button type="button" class="nx-adv-btn nx-adv-btn-primary" id="nx-adv-btn-wizard-next">Next
                                Phase</button>
                            <button type="submit" class="nx-adv-btn nx-adv-btn-primary" id="nx-adv-btn-wizard-submit"
                                style="display: none;">Commit Pipeline Config</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="nx-adv-modal-backdrop-overlay-layer" id="nx-adv-modal-safety-gate-deletion">
            <div class="nx-adv-modal-window-container delete-panel-override-style nx-adv-glass">
                <div class="nx-adv-deletion-graphic-alert-shield-icon-wrapper">
                    <i class="bx bx-shield-quarter"></i>
                </div>
                <h3>Verify System Node Purge</h3>
                <p>You are requesting a permanent purge of this AI model registry pipeline node. Continuous automated
                    data streams will instantly sever, affecting connected test user instances.</p>
                <div class="nx-adv-deletion-panel-buttons-flex-row-alignment">
                    <button class="nx-adv-btn nx-adv-btn-secondary" id="nx-adv-btn-cancel-purge-action">Abort
                        Operation</button>
                    <button class="nx-adv-btn nx-adv-btn-danger" id="nx-adv-btn-confirm-purge-action">Authorize Node
                        Deletion</button>
                </div>
            </div>
        </div>

        <div class="nx-adv-modal-backdrop-overlay-layer" id="nx-adv-modal-telemetry-specifications-profile">
            <div class="nx-adv-modal-window-container extended-profile-override-style nx-adv-glass">
                <div class="nx-adv-modal-window-toolbar-header">
                    <h3>System Telemetry Profile Spec Sheet</h3>
                    <button class="nx-adv-modal-close-window-trigger-btn" id="nx-adv-btn-close-profile-viewer-modal">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="nx-adv-profile-viewer-interior-wrapper-body" id="nx-adv-profile-viewer-render-canvas-host">
                </div>
            </div>
        </div>

        <div class="nx-adv-modal-backdrop-overlay-layer" id="nx-adv-modal-investor-account-profile-details">
            <div class="nx-adv-modal-window-container extended-profile-override-style nx-adv-glass">
                <div class="nx-adv-modal-window-toolbar-header">
                    <h3>Investor Allocation Node Intelligence</h3>
                    <button class="nx-adv-modal-close-window-trigger-btn" id="nx-adv-btn-close-investor-modal">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="nx-adv-profile-viewer-interior-wrapper-body" id="nx-adv-investor-modal-render-canvas-host">
                </div>
            </div>
        </div>

        <div class="nx-adv-toast-notifications-pipeline-global-stack-host" id="nx-adv-toast-notifications-host-root">
        </div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/ai-bot.js') }}"></script>
</body>

</html>


