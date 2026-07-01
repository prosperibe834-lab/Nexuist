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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/style.css') }}">
</head>

<body>

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

        @include('AdminDashboard.layouts.admin-sidebar')


    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">Dashboard</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="dashboard-grid">

            <div class="metric-card glass-panel text-glow-purple">
                <div class="card-header">
                    <span>TOTAL PORTFOLIO VALUE</span>
                    <i class='bx bx-wallet token-icon-purple'></i>
                </div>
                <h2>$124,580.32 <span class="trend-up"><i class='bx bx-trending-up'></i> +12.5%</span></h2>
                <p class="text-muted">Combined wallet & active plans</p>
            </div>

            <div class="metric-card glass-panel text-glow-green">
                <div class="card-header">
                    <span>TOTAL ROI GENERATED</span>
                    <i class='bx bx-bar-chart-alt-2 token-icon-green'></i>
                </div>
                <h2>$14,210.85 <span class="trend-up"><i class='bx bx-bolt'></i> Live</span></h2>
                <p class="text-muted">Automated fixed returns payouts</p>
            </div>

            <div class="metric-card glass-panel text-glow-cyan">
                <div class="card-header">
                    <span>ACTIVE TRADING BOTS</span>
                    <i class='bx bx-bot token-icon-cyan'></i>
                </div>
                <h2>3 <span class="status-badge-active">Running</span></h2>
                <p class="text-muted">AI engines executing market trades</p>
            </div>

            <div class="grid-col-span-2 glass-panel chart-panel">

                <div class="grid-col-span-2 glass-panel chart-panel">
                    <div class="panel-header">
                        <h3><i class='bx bx-line-chart'></i> Portfolio Growth & Market Overview</h3>
                        <div class="timeframe-selectors">
                            <span class="active" data-timeframe="1D">1D</span>
                            <span data-timeframe="1W">1W</span>
                            <span data-timeframe="1M">1M</span>
                            <span data-timeframe="1Y">1Y</span>
                        </div>
                    </div>
                    <div class="chart-viewport-real">
                        <div id="nexuist-live-chart"></div>
                    </div>
                    <p class="text-muted" id="chart-status"
                        style="margin-top: 10px; font-size: 12px; text-align: center;">
                        <i class='bx bx-pulse bx-spin-custom' style="color: var(--secondary-color);"></i> Stream via
                        AJAX Connection Active...
                    </p>
                </div>
            </div>

            <div class="glass-panel actions-panel">
                <div class="panel-header">
                    <h3><i class='bx bx-rocket'></i> Quick Actions</h3>
                </div>
                <div class="action-buttons-vertical">
                    <button class="btn btn-primary-glow" id="action-deposit"><i class='bx bx-plus-circle'></i> New
                        Deposit</button>
                    <button class="btn btn-secondary-glass" id="action-withdraw"><i
                            class='bx bx-right-top-arrow-circle'></i> Request Withdrawal</button>
                    <button class="btn btn-secondary-glass" id="action-bot"><i class='bx bx-chip'></i> Launch AI
                        Bot</button>
                </div>
            </div>

            <div class="grid-col-span-2 glass-panel table-panel">
                <div class="panel-header">
                    <h3><i class='bx bx-history'></i> Recent Financial Operations</h3>
                    <a href="transactions" class="view-all-link">View Logs <i class='bx bx-right-arrow-alt'></i></a>
                </div>
                <div class="table-responsive">
                    <table class="dashboard-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Asset</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#NEX-98210</td>
                                <td><span class="type-deposit">Deposit</span></td>
                                <td>+$5,000.00</td>
                                <td><i class='bx bxl-bitcoin crypto-btc'></i> BTC</td>
                                <td><span class="badge badge-success">Approved</span></td>
                            </tr>
                            <tr>
                                <td>#NEX-98194</td>
                                <td><span class="type-roi">ROI Payout</span></td>
                                <td>+$145.20</td>
                                <td><i class='bx bxl-tailwind-css crypto-usdt'></i> USDT</td>
                                <td><span class="badge badge-success">Automated</span></td>
                            </tr>
                            <tr>
                                <td>#NEX-98112</td>
                                <td><span class="type-withdrawal">Withdrawal</span></td>
                                <td>-$1,200.00</td>
                                <td><i class='bx bxl-ethereum crypto-eth'></i> ETH</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="glass-panel metrics-breakdown">
                <div class="panel-header">
                    <h3><i class='bx bx-pie-chart-alt'></i> Asset Allocations</h3>
                </div>
                <div class="allocation-list">
                    <div class="allocation-item">
                        <div class="asset-info"><i class='bx bxl-bitcoin crypto-btc'></i> <span>Bitcoin</span></div>
                        <span class="allocation-pct">45%</span>
                    </div>
                    <div class="allocation-item">
                        <div class="asset-info"><i class='bx bxl-ethereum crypto-eth'></i> <span>Ethereum</span></div>
                        <span class="allocation-pct">30%</span>
                    </div>
                    <div class="allocation-item">
                        <div class="asset-info"><i class='bx bxl-tailwind-css crypto-usdt'></i> <span>USDT Tether</span>
                        </div>
                        <span class="allocation-pct">25%</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>