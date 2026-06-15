<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/performance.css') }}">
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
            <li>
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
                <a href="{{ url('/internal-transfers') }}">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="link_name">Internal Transfers</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/internal-transfers">Internal Transfers</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="{{ url('/performance') }}">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="link_name">Performance History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/performance">Performance History</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/portfolio') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Portfolio Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/portfolio">Portfolio Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/statements') }}">
                    <i class='bx bx-file-find'></i>
                    <span class="link_name">Account Statements</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/statements">Account Statements</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/kyc') }}">
                    <i class='bx bx-id-card'></i>
                    <span class="link_name">KYC Verification</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/kyc">KYC Verification</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/loans') }}">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Loan Requests</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/loans">Loan Requests</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/notifications">Notifications</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/support') }}">
                    <i class='bx bx-support'></i>
                    <span class="link_name">Messages & Support</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/support">Messages & Support</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/transactions') }}">
                    <i class='bx bx-receipt'></i>
                    <span class="link_name">Transaction Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/transactions">Transaction Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/website-settings') }}">
                    <i class='bx bx-globe'></i>
                    <span class="link_name">Website Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/website-settings">Website Settings</a></li>
                </ul>
            </li>
            <li>
                <a href="/security">
                    <i class='bx bx-shield-quarter'></i>
                    <span class="link_name">Security Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/security">Security Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/admin-settings') }}">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Admin Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/admin-settings">Admin Settings</a></li>
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
                <a href="logout.html">
                    <i class='bx bx-log-out-circle'></i>
                    <span class="link_name">Logout</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="logout.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">Performance History</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->

<div class="nx-ph-workspace-container nx-ph-animate-fade-in">
    
    <div class="nx-ph-workspace-header">
        <div class="nx-ph-title-block">
            <h2><i class='bx bx-trending-up'></i> Performance Analytics</h2>
            <p class="nx-ph-subtitle">Deep performance diagnostics, yield attribution, and trade execution telemetry</p>
        </div>
        
        <div class="nx-ph-tabs-wrapper">
            <button class="nx-ph-tab-btn" data-period="7d">7 Days</button>
            <button class="nx-ph-tab-btn active" data-period="30d">30 Days</button>
            <button class="nx-ph-tab-btn" data-period="all">All Time</button>
        </div>
    </div>

    <div class="nx-ph-metrics-grid">
        <div class="nx-ph-stat-card border-glow-secondary">
            <div class="nx-ph-card-header">
                <span>NET ACCOUNT ROI</span>
                <i class='bx bx-pie-chart-alt-2 icon-ph-secondary'></i>
            </div>
            <div class="nx-ph-card-body">
                <h2 id="ph-kpi-roi">+34.82%</h2>
                <div class="nx-ph-action-badge secondary-glow">
                    <i class='bx bx-up-arrow-alt'></i> +$4,210.50
                </div>
            </div>
            <p class="nx-ph-meta-text">Cumulative yield over chosen period</p>
        </div>

        <div class="nx-ph-stat-card border-glow-primary">
            <div class="nx-ph-card-header">
                <span>WIN RATE COMPLEXITY</span>
                <i class='bx bx-target-lock icon-ph-primary'></i>
            </div>
            <div class="nx-ph-card-body">
                <h2 id="ph-kpi-winrate">78.4%</h2>
                <div class="nx-ph-action-badge primary-glow">
                    58 / 74 Positions
                </div>
            </div>
            <p class="nx-ph-meta-text">Ratio of profit-taking closures</p>
        </div>

        <div class="nx-ph-stat-card border-glow-accent">
            <div class="nx-ph-card-header">
                <span>PROFIT FACTOR RATIO</span>
                <i class='bx bx-calculator icon-ph-accent'></i>
            </div>
            <div class="nx-ph-card-body">
                <h2 id="ph-kpi-factor">2.41</h2>
                <div class="nx-ph-action-badge accent-glow">
                    <i class='bx bx-check-shield'></i> High Alpha
                </div>
            </div>
            <p class="nx-ph-meta-text">Gross Profits divided by Gross Losses</p>
        </div>
    </div>

    <div class="nx-ph-split-layout">
        
        <div class="nx-ph-chart-panel">
            <div class="nx-ph-panel-title-block">
                <h3><i class='bx bx-line-chart'></i> Equity Curve & PnL Mapping</h3>
                <p>Visual verification of compound return growth vs daily generation spikes</p>
            </div>
            <div class="nx-ph-chart-wrapper">
                <canvas id="nexuistPerformanceChart"></canvas>
            </div>
        </div>

        <div class="nx-ph-table-panel">
            <div class="nx-ph-panel-header-row">
                <div class="nx-ph-panel-title-block">
                    <h3><i class='bx bx-history'></i> Strategy Matrix Ledger</h3>
                    <p>Attribution breakdowns grouped by asset configuration types</p>
                </div>
            </div>

            <div class="nx-ph-table-responsive-box">
                <table class="nx-ph-premium-table">
                    <thead>
                        <tr>
                            <th>Asset Node</th>
                            <th>Volume Allocation</th>
                            <th>Net Gain/Loss</th>
                        </tr>
                    </thead>
                    <tbody id="performance-history-ledger-body">
                        <tr class="nx-ph-row">
                            <td>
                                <div class="nx-ph-asset-cell">
                                    <strong class="nx-ph-asset-ticker">BTC/USDT</strong>
                                    <span class="nx-ph-subtext-meta">Bitcoin Core Mirror</span>
                                </div>
                            </td>
                            <td>45.0%</td>
                            <td><span class="nx-ph-pnl-status pnl-up">+$2,840.00</span></td>
                        </tr>
                        <tr class="nx-ph-row">
                            <td>
                                <div class="nx-ph-asset-cell">
                                    <strong class="nx-ph-asset-ticker">ETH/USDT</strong>
                                    <span class="nx-ph-subtext-meta">Ether Scalper Syndication</span>
                                </div>
                            </td>
                            <td>35.0%</td>
                            <td><span class="nx-ph-pnl-status pnl-up">+$1,580.30</span></td>
                        </tr>
                        <tr class="nx-ph-row">
                            <td>
                                <div class="nx-ph-asset-cell">
                                    <strong class="nx-ph-asset-ticker">SOL/USDT</strong>
                                    <span class="nx-ph-subtext-meta">Delta Neutral Volatility</span>
                                </div>
                            </td>
                            <td>20.0%</td>
                            <td><span class="nx-ph-pnl-status pnl-down">-$209.80</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/performance.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
</body>

</html>