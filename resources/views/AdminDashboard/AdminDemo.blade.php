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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/AdminDemo.css') }}">
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
                    <span class="link_name">Das             hboard</span>
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

            <li  class="active">
                <a href="{{ url('/AdminDemo') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">AdminDemo</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/AdminDemo">AdminDemo</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/Adminlivemarket') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Adminlivemarket</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/Adminlivemarket">Adminlivemarket</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/PremiumInvestment') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Premium Investment</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/PremiumInvestment">Premium Investment</a></li>
                </ul>
            </li>

             <li>
                <a href="{{ url('/StockMarket') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">StockMarket</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/StockMarket">StockMarket</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/Crypto') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Crypto</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/Crypto">Crypto</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/AdminRealEstate') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Real Estate</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/AdminRealEstate">Real Estate</a></li>
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
            <li>
                <a href="{{ url('/performance') }}">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="link_name">Performance History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/performance">Performance History</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/AdminPortfolio') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Portfolio Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/AdminPortfolio">Portfolio Analytics</a></li>
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
                <a href="{{ url('/admin-notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/admin-notifications">Notifications</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/AdminSupport') }}">
                    <i class='bx bx-support'></i>
                    <span class="link_name">Messages & Support</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/AdminSupport">Messages & Support</a></li>
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
                <h1 id="page-title-display">AdminDemo</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
       <div class="nexuist-dashboard-wrapper">

    <header class="dashboard-action-header glass-panel">
        <div class="global-search-shell">
            <i class="bx bx-search search-icon"></i>
            <input type="text" id="globalSearchInput" placeholder="Command Search users, transactions, AI bots, tickets..." autocomplete="off">
            <div class="search-suggestions-dropdown" id="searchSuggestions"></div>
        </div>
        
        <div class="header-navigation-tabs">
            <button class="nav-tab-btn active" data-target="view-overview"><i class="bx bx-grid-alt"></i> Overview</button>
            <button class="nav-tab-btn" data-target="view-users"><i class="bx bx-user"></i> Users</button>
            <button class="nav-tab-btn" data-target="view-ledger"><i class="bx bx-wallet"></i> Ledger</button>
            <button class="nav-tab-btn" data-target="view-ai-plans"><i class="bx bx-bot"></i> Systems & Plans</button>
            <button class="nav-tab-btn" data-target="view-settings"><i class="bx bx-cog"></i> Settings</button>
        </div>
    </header>

    <div id="view-overview" class="tab-content-pane active">
        <section class="fintech-ticker-grid">
            <div class="ticker-card glass-panel animate-fade-up">
                <div class="ticker-meta">
                    <span class="ticker-label">Total Users</span>
                    <h2 class="counter-value" data-target="{{ $adminDemoData['stats']['totalUsers'] ?? 0 }}">0</h2>
                    <span class="ticker-delta text-up"><i class="bx bx-trending-up"></i> +12.3%</span>
                </div>
                <div class="ticker-visual">
                    <div class="sparkline-container" id="sparkline-users"></div>
                </div>
            </div>
            <div class="ticker-card glass-panel animate-fade-up">
                <div class="ticker-meta">
                    <span class="ticker-label">Active Positions</span>
                    <h2 class="counter-value" data-target="{{ $adminDemoData['stats']['activePositions'] ?? 0 }}">0</h2>
                    <span class="ticker-delta text-up"><i class="bx bx-trending-up"></i> +8.1%</span>
                </div>
                <div class="ticker-visual">
                    <div class="sparkline-container" id="sparkline-active"></div>
                </div>
            </div>
            <div class="ticker-card glass-panel animate-fade-up">
                <div class="ticker-meta">
                    <span class="ticker-label">Total Deposits</span>
                    <h2>$<span class="counter-value" data-target="{{ $adminDemoData['stats']['totalDeposits'] ?? 0 }}">0</span></h2>
                    <span class="ticker-delta text-up"><i class="bx bx-trending-up"></i> +24.5%</span>
                </div>
                <div class="ticker-visual">
                    <div class="sparkline-container" id="sparkline-deposits"></div>
                </div>
            </div>
            <div class="ticker-card glass-panel animate-fade-up">
                <div class="ticker-meta">
                    <span class="ticker-label">AI Bot Subscribers</span>
                    <h2 class="counter-value" data-target="{{ $adminDemoData['stats']['aiBotSubscribers'] ?? 0 }}">0</h2>
                    <span class="ticker-delta text-down"><i class="bx bx-trending-down"></i> -1.4%</span>
                </div>
                <div class="ticker-visual">
                    <div class="sparkline-container" id="sparkline-bots"></div>
                </div>
            </div>
        </section>

        <fieldset class="advanced-filter-panel glass-panel">
            <legend>Advanced Audit Filtering Matrice</legend>
            <div class="filter-inputs-row">
                <div class="input-group">
                    <label>Date Range Window</label>
                    <input type="date" id="filterDateStart">
                </div>
                <div class="input-group">
                    <label>Country Domain</label>
                    <select id="filterCountry">
                        <option value="ALL">All Nations</option>
                        <option value="NG">Nigeria</option>
                        <option value="US">United States</option>
                        <option value="DE">Germany</option>
                        <option value="UK">United Kingdom</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Account Vector Level</label>
                    <select id="filterTier">
                        <option value="ALL">All Accounts</option>
                        <option value="VIP">VIP Tier</option>
                        <option value="STANDARD">Standard</option>
                    </select>
                </div>
                <div class="filter-actions">
                    <button class="btn btn-primary" id="btnApplyFilters"><i class="bx bx-filter-alt"></i> Execute</button>
                    <button class="btn btn-secondary" id="btnResetFilters"><i class="bx bx-refresh"></i> Reset</button>
                </div>
            </div>
        </fieldset>

        <section class="analytics-charts-grid">
            <div class="chart-container-card glass-panel">
                <div class="chart-header">
                    <h3><i class="bx bx-area"></i> Revenue Stream Allocation Ledger</h3>
                    <div class="chart-tools">
                        <button class="chart-tool-btn" onclick="exportChartData('revenueChart', 'png')">PNG</button>
                        <button class="chart-tool-btn" onclick="toggleFullscreenChart('rev-wrapper')"><i class="bx bx-fullscreen"></i></button>
                    </div>
                </div>
                <div class="chart-body" id="rev-wrapper">
                    <div id="apexRevenueChart"></div>
                </div>
            </div>

            <div class="chart-container-card glass-panel">
                <div class="chart-header">
                    <h3><i class="bx bx-bar-chart-alt-2"></i> User Acquisition Vectors vs Activity</h3>
                </div>
                <div class="chart-body">
                    <div id="apexGrowthChart"></div>
                </div>
            </div>

            <div class="chart-container-card glass-panel">
                <div class="chart-header">
                    <h3><i class="bx bx-transfer"></i> Clearing Spread: Deposits vs Withdrawals</h3>
                </div>
                <div class="chart-body">
                    <canvas id="ctxDepositWithdrawChart"></canvas>
                </div>
            </div>

            <div class="chart-container-card glass-panel">
                <div class="chart-header">
                    <h3><i class="bx bx-pie-chart-alt"></i> AI Quant Execution & Systems Share</h3>
                </div>
                <div class="chart-body">
                    <canvas id="ctxBotPerformanceChart"></canvas>
                </div>
            </div>
        </section>

        <section class="split-activity-export-grid">
            <div class="activity-feed-panel glass-panel">
                <div class="panel-header">
                    <h3><i class="bx bx-pulse animate-pulse icon-glow"></i> Real-time System Kernel Ledger</h3>
                </div>
                <div class="activity-feed-scroller" id="liveActivityStream"></div>
            </div>

            <div class="open-positions-panel glass-panel">
                <div class="panel-header">
                    <h3><i class="bx bx-line-chart"></i> Monitored Live Positions</h3>
                </div>
                <div class="responsive-table-scroller">
                    <table class="nexuist-core-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Asset</th>
                                <th>Direction</th>
                                <th>Amount</th>
                                <th>Country</th>
                                <th>Tier</th>
                                <th>Opened On</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="openPositionsTableBody"></tbody>
                    </table>
                </div>
            </div>

            <div class="export-center-panel glass-panel">
                <div class="panel-header">
                    <h3><i class="bx bx-cloud-download"></i> Centralized Vault Data Export Center</h3>
                </div>
                <div class="export-matrix-grid">
                    <button class="export-btn" onclick="triggerSystemExport('Users', 'csv')"><i class="bx bxs-file-csv"></i> Export Users Ledger (CSV)</button>
                    <button class="export-btn" onclick="triggerSystemExport('Transactions', 'xlsx')"><i class="bx bxs-file-json"></i> Export Trades Matrix (Excel)</button>
                    <button class="export-btn" onclick="triggerSystemExport('Vault Audit', 'pdf')"><i class="bx bxs-file-pdf"></i> Generate Financial Balance (PDF)</button>
                </div>
            </div>
        </section>
    </div>

    <div id="view-users" class="tab-content-pane">
        <section class="table-view-container glass-panel">
            <div class="table-utility-header">
                <h3>User Core Structural Profiles</h3>
                <div class="table-bulk-actions">
                    <select id="bulkActionSelector" class="table-select">
                        <option value="">Bulk Operations</option>
                        <option value="SUSPEND">Suspend Selected</option>
                        <option value="ACTIVATE">Activate Selected</option>
                    </select>
                    <button class="btn btn-secondary" onclick="executeBulkAction()">Run</button>
                </div>
            </div>
            <div class="responsive-table-scroller">
                <table class="nexuist-core-table" id="usersTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="masterSelectUsers"></th>
                            <th>Identity Profile</th>
                            <th>Email Context</th>
                            <th>Nationality</th>
                            <th>Vault Balance</th>
                            <th>Status Badge</th>
                            <th>Joined Matrix</th>
                            <th class="txt-right">Operational Actions</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        </tbody>
                </table>
            </div>
        </section>
    </div>

    <div id="view-ledger" class="tab-content-pane">
        <section class="split-activity-export-grid">
            <div class="table-view-container glass-panel">
                <div class="table-utility-header">
                    <h3>Fiat & Crypto Deposits Management</h3>
                </div>
                <div class="responsive-table-scroller">
                    <table class="nexuist-core-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Valuation</th>
                                <th>Method</th>
                                <th>Txn Identification</th>
                                <th>Status</th>
                                <th class="txt-right">Control</th>
                            </tr>
                        </thead>
                        <tbody id="depositsTableBody"></tbody>
                    </table>
                </div>
            </div>

            <div class="table-view-container glass-panel">
                <div class="table-utility-header">
                    <h3>Withdrawal Clearance Matrix</h3>
                </div>
                <div class="responsive-table-scroller">
                    <table class="nexuist-core-table">
                        <thead>
                            <tr>
                                <th>User Target</th>
                                <th>Valuation</th>
                                <th>Destination Node</th>
                                <th>Status</th>
                                <th class="txt-right">Control</th>
                            </tr>
                        </thead>
                        <tbody id="withdrawalsTableBody"></tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div id="view-ai-plans" class="tab-content-pane">
        <section class="table-view-container glass-panel">
            <div class="table-utility-header">
                <h3>High-Yield Investment Matrix Rule-sets</h3>
                <button class="btn btn-primary" onclick="openPlanModal('CREATE')"><i class="bx bx-plus"></i> Initialize Investment Architecture</button>
            </div>
            <div class="responsive-table-scroller">
                <table class="nexuist-core-table">
                    <thead>
                        <tr>
                            <th>Plan Allocation Target</th>
                            <th>ROI Delta</th>
                            <th>Time Horizon</th>
                            <th>Operational Boundary Limits</th>
                            <th>Risk Vector Matrix</th>
                            <th class="txt-right">Control Layer</th>
                        </tr>
                    </thead>
                    <tbody id="plansTableBody"></tbody>
                </table>
            </div>
        </section>

        <section class="table-view-container glass-panel" style="margin-top: 24px;">
            <div class="table-utility-header">
                <h3>Neural AI Quantum Trading Modules</h3>
                <button class="btn btn-secondary" onclick="openBotModal('CREATE')"><i class="bx bx-plus"></i> Inject AI Automaton Unit</button>
            </div>
            <div class="ai-bot-display-grid" id="aiBotsGrid"></div>
        </section>
    </div>

    <div id="view-settings" class="tab-content-pane">
        <div class="settings-layout-grid">
            <div class="settings-card glass-panel">
                <h3>General Identity Configurations</h3>
                <div class="settings-field-group">
                    <label>Platform Ecosystem Name</label>
                    <input type="text" value="NEXUIST CAPITAL LTD" class="settings-input">
                </div>
                <div class="settings-field-group">
                    <label>Operational Fee Vector (%)</label>
                    <input type="number" step="0.01" value="0.25" class="settings-input">
                </div>
                <button class="btn btn-primary" onclick="saveConfigurationParameters()">Commit Network Variable Space</button>
            </div>

            <div class="settings-card glass-panel">
                <h3>Platform Security Policy Matrix</h3>
                <div class="settings-toggle-row">
                    <div>
                        <strong>Enforce Multi-Factor Network Mandate (MFA)</strong>
                        <p>Requires validation step on structural node adjustments.</p>
                    </div>
                    <label class="switch-wrapper">
                        <input type="checkbox" checked>
                        <span class="slider-rail"></span>
                    </label>
                </div>
                <div class="settings-toggle-row">
                    <div>
                        <strong>Autonomous Liquidation Auto-Circuit Breaker</strong>
                        <p>Halts matching nodes if volatility moves out of bounds.</p>
                    </div>
                    <label class="switch-wrapper">
                        <input type="checkbox">
                        <span class="slider-rail"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal-shroud" id="nexuistMasterModal">
    <div class="modal-viewport glass-panel">
        <div class="modal-header">
            <h3 id="modalTitleContainer">System Context Engine</h3>
            <button class="modal-close-btn" onclick="closeSystemModal()"><i class="bx bx-x"></i></button>
        </div>
        <div class="modal-render-target" id="modalRenderTarget"></div>
    </div>
</div>
    </main>

    <script id="adminDemoData" type="application/json">@json($adminDemoData ?? [])</script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/AdminDashboard/js/AdminDemo.js') }}"></script>
</body>

</html>