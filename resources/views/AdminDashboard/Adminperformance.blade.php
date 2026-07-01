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

        @include('AdminDashboard.layouts.admin-sidebar')


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