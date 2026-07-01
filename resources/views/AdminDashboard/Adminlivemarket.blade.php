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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/Adminlivemarket.css') }}">
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
                <h1 id="page-title-display">Adminlivemarket</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="market-monitor-viewport">

    <section class="overview-metrics-grid">
        <div class="metric-glass-card">
            <div class="card-meta">
                <span class="label">Total Trades Today</span>
                <h2 class="counter-val" id="stat-total">148</h2>
            </div>
            <div class="card-icon-frame color-primary"><i class="bx bx-transfer-alt"></i></div>
        </div>
        <div class="metric-glass-card">
            <div class="card-meta">
                <span class="label">Active Trades</span>
                <h2 class="counter-val txt-cyan" id="stat-active">42</h2>
            </div>
            <div class="card-icon-frame color-cyan"><i class="bx bx-radio-circle-marked animate-pulse"></i></div>
        </div>
        <div class="metric-glass-card">
            <div class="card-meta">
                <span class="label">Closed Trades</span>
                <h2 class="counter-val" id="stat-closed">106</h2>
            </div>
            <div class="card-icon-frame color-muted"><i class="bx bx-package"></i></div>
        </div>
        <div class="metric-glass-card">
            <div class="card-meta">
                <span class="label">Buy / Sell Split</span>
                <h2><span id="stat-buys" class="txt-up">89</span><span class="split-slash">/</span><span id="stat-sells" class="txt-down">59</span></h2>
            </div>
            <div class="card-icon-frame color-purple"><i class="bx bx-unite"></i></div>
        </div>
        <div class="metric-glass-card">
            <div class="card-meta">
                <span class="label">Total Trading Volume</span>
                <h2 class="counter-val" id="stat-volume">$1,482,900</h2>
            </div>
            <div class="card-icon-frame color-gold"><i class="bx bx-coin-stack"></i></div>
        </div>
        <div class="metric-glass-card">
            <div class="card-meta">
                <span class="label">Total User Profit</span>
                <h2 class="counter-val txt-up" id="stat-profit">+$64,250</h2>
            </div>
            <div class="card-icon-frame color-up"><i class="bx bx-trending-up"></i></div>
        </div>
        <div class="metric-glass-card">
            <div class="card-meta">
                <span class="label">Total User Loss</span>
                <h2 class="counter-val txt-down" id="stat-loss">-$22,140</h2>
            </div>
            <div class="card-icon-frame color-down"><i class="bx bx-trending-down"></i></div>
        </div>
    </section>

    <section class="charts-row-layout">
        <div class="chart-glass-box">
            <div class="box-heading">
                <h3><i class="bx bx-chart icon-brand"></i> Profit & Loss Distribution Ledger</h3>
            </div>
            <div class="chart-canvas-wrapper">
                <canvas id="profitLossChart"></canvas>
            </div>
        </div>
        <div class="chart-glass-box">
            <div class="box-heading">
                <h3><i class="bx bx-pie-chart-alt-2 icon-secondary"></i> Volumetric Trading Pairs Share</h3>
            </div>
            <div class="chart-canvas-wrapper">
                <canvas id="pairsVolumeChart"></canvas>
            </div>
        </div>
    </section>

    <section class="rankings-and-feed-row">
        <div class="rankings-panel glass-panel">
            <div class="panel-heading"><h3><i class="bx bx-award icon-gold"></i> Top Volume Traders</h3></div>
            <div class="ranking-list" id="topTradersLeaderboard">
                </div>
        </div>

        <div class="rankings-panel glass-panel">
            <div class="panel-heading"><h3><i class="bx bx-bolt icon-cyan"></i> Most Active Asset Pairs</h3></div>
            <div class="ranking-list" id="mostTradedPairsList">
                </div>
        </div>

        <div class="feed-panel glass-panel">
            <div class="panel-heading">
                <h3><i class="bx bx-pulse icon-purple animate-pulse"></i> Live Execution Terminal Stream</h3>
            </div>
            <div class="scrolling-activity-stream" id="activityStreamFeed">
                </div>
        </div>
    </section>

    <section class="main-table-glass-card glass-panel">
        <div class="table-action-header">
            <div class="title-block">
                <h3>Centralized Order Pipeline Log</h3>
                <p>Real-time audit control layer of active and closed transactions across matching systems.</p>
            </div>
            <div class="filter-controls-group">
                <div class="search-input-shell">
                    <i class="bx bx-search"></i>
                    <input type="text" id="ledgerSearchInput" placeholder="Filter by User, Email, or Pair...">
                </div>
                <select id="statusFilterSelect" class="table-custom-select">
                    <option value="ALL">All States</option>
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="CLOSED">CLOSED</option>
                </select>
                <select id="typeFilterSelect" class="table-custom-select">
                    <option value="ALL">All Directions</option>
                    <option value="BUY">BUY</option>
                    <option value="SELL">SELL</option>
                </select>
            </div>
        </div>

        <div class="table-scroller">
            <table class="nexuist-monitor-table">
                <thead>
                    <tr>
                        <th>Trade ID</th>
                        <th>Trader Identity</th>
                        <th>Asset Pair</th>
                        <th>Type</th>
                        <th>Invested Capital</th>
                        <th>Leverage</th>
                        <th>Execution Strike</th>
                        <th>Spot Value</th>
                        <th>P&L Spread</th>
                        <th>State</th>
                        <th>Timestamp</th>
                        <th class="txt-right">Operational Logs</th>
                    </tr>
                </thead>
                <tbody id="masterTradeLedgerBody">
                    </tbody>
            </table>
        </div>
    </section>

</div>

<div class="modal-dim-shroud" id="tradeDetailModal">
    <div class="modal-window-viewport glass-panel">
        <div class="modal-view-header">
            <h3><i class="bx bx-terminal txt-brand"></i> Detailed Trade Diagnostic Framework</h3>
            <button class="modal-close-trigger" onclick="closeTradeDiagnosticModal()"><i class="bx bx-x"></i></button>
        </div>
        <div class="modal-grid-content" id="modalDynamicOutput">
            </div>
    </div>
</div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/AdminDashboard/js/Adminlivemarket.js') }}"></script>

</body>

</html>