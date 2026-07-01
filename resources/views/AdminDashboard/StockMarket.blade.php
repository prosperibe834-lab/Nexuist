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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/StockMarket.css') }}">
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
                <h1 id="page-title-display">Crypto</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
       <div class="nx-stock-dashboard">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 32px;">
        <div>
            <h1 style="font-size: 1.85rem; font-weight: 700; letter-spacing: -0.03em;">Stock Liquidity Desk</h1>
            <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 2px;">Asset structuring, equity vaults allocation, and global investor pipelines.</p>
        </div>
        <div style="display: flex; gap: 12px;">
            <button class="nxs-btn nxs-btn-secondary" onclick="exportTableToCSV('stockMainTable')"><i class="bx bx-export"></i> Export Audit</button>
            <button class="nxs-btn nxs-btn-primary" onclick="openStockModal('modalCreatePlan')"><i class="bx bx-plus-circle"></i> Create Equity Plan</button>
        </div>
    </div>

    <div class="nxs-metrics-grid">
        <div class="nxs-glass-card">
            <div class="nxs-metric-title"><span>Total Investors</span><i class="bx bx-user-voice"></i></div>
            <div class="nxs-metric-value" id="mInvestors">0</div>
            <div class="nxs-sub-metrics"><span>Today: <strong class="nxs-green">+24</strong></span><span>MoM Delta: <strong class="nxs-green">+14.2%</strong></span></div>
        </div>
        <div class="nxs-glass-card">
            <div class="nxs-metric-title"><span>Active Placements</span><i class="bx bx-objects-horizontal-left"></i></div>
            <div class="nxs-metric-value" id="mActivePlans">0</div>
            <div class="nxs-sub-metrics"><span>Contracts running seamlessly</span></div>
        </div>
        <div class="nxs-glass-card">
            <div class="nxs-metric-title"><span>Capital Invested</span><i class="bx bx-objects-vertical-bottom"></i></div>
            <div class="nxs-metric-value" id="mCapital">$0.00</div>
            <div class="nxs-sub-metrics"><span>Today: <strong class="nxs-blue">+$12.5k</strong></span><span>MoM Vaults: <strong class="nxs-blue">+$84k</strong></span></div>
        </div>
        <div class="nxs-glass-card">
            <div class="nxs-metric-title"><span>Yield Paid (ROI)</span><i class="bx bx-money-withdraw"></i></div>
            <div class="nxs-metric-value" id="mProfit paid">$0.00</div>
            <div class="nxs-sub-metrics"><span>Pending: <strong>$1.4k</strong></span><span>Payout Lane Clear</span></div>
        </div>
        <div class="nxs-glass-card">
            <div class="nxs-metric-title"><span>Settled Withdrawals</span><i class="bx bx-cloud-download"></i></div>
            <div class="nxs-metric-value" id="mWithdrawals">$0.00</div>
            <div class="nxs-sub-metrics"><span>Pending: <strong class="nxs-purple">3 Queue</strong></span><span>Rejected: <strong>0</strong></span></div>
        </div>
        <div class="nxs-glass-card">
            <div class="nxs-metric-title"><span>Platform Revenue</span><i class="bx bx-pie-chart-alt-2"></i></div>
            <div class="nxs-metric-value" id="mRevenue">$0.00</div>
            <div class="nxs-sub-metrics"><span>Monthly Target: <strong>92% Met</strong></span></div>
        </div>
    </div>

    <div class="nxs-charts-grid">
        <div class="nxs-glass-card nxs-span-8">
            <h3 style="font-size:0.95rem; font-weight:600; margin-bottom:16px;">Investment Growth & Liquidity Track Delta</h3>
            <div style="height: 280px; position: relative;"><canvas id="chartInvestmentGrowth"></canvas></div>
        </div>
        <div class="nxs-glass-card nxs-span-4">
            <h3 style="font-size:0.95rem; font-weight:600; margin-bottom:16px;">Sector Exposure Weights</h3>
            <div style="height: 280px; position: relative;"><canvas id="chartSectorExposure"></canvas></div>
        </div>
    </div>

    <div class="nxs-tab-scroller">
        <button class="nxs-tab-btn active" onclick="switchStockTab(event, 'tabPlans')">Equity Plans Matrix</button>
        <button class="nxs-tab-btn" onclick="switchStockTab(event, 'tabInvestors')">Investor Profiles</button>
        <button class="nxs-tab-btn" onclick="switchStockTab(event, 'tabMonitor')">Investment Monitor</button>
        <button class="nxs-tab-btn" onclick="switchStockTab(event, 'tabDeposits')">Deposits Queue</button>
        <button class="nxs-tab-btn" onclick="switchStockTab(event, 'tabWithdrawals')">Withdrawals Queue</button>
        <button class="nxs-tab-btn" onclick="switchStockTab(event, 'tabLiveStocks')">Live Stocks Asset Registry</button>
    </div>

    <div class="nxs-toolbar">
        <div class="nxs-search-box">
            <i class="bx bx-search"></i>
            <input type="text" class="nxs-input-field" id="stockGlobalSearch" placeholder="Filter through database streams globally..." oninput="handleGlobalStockFiltering()">
        </div>
    </div>

    <div id="tabPlans" class="nxs-view-panel">
        <div class="nxs-glass-card" style="padding:0;">
            <div class="nxs-table-frame">
                <table class="nxs-table" id="stockMainTable">
                    <thead>
                        <tr>
                            <th>Plan Name Identifier</th>
                            <th>Tier Group</th>
                            <th>Investment Range limits</th>
                            <th>Daily ROI Scale</th>
                            <th>Duration Period</th>
                            <th>Lifecycle Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="plansTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="tabInvestors" class="nxs-view-panel" style="display:none;">
        <div class="nxs-glass-card" style="padding:0;">
            <div class="nxs-table-frame"><table class="nxs-table"><thead><tr><th>User Profile</th><th>Country</th><th>Balance Mapping</th><th>Total Placed</th><th>Status</th><th style="text-align:right;">Actions</th></tr></thead><tbody id="investorsTableBody"></tbody></table></div>
        </div>
    </div>

    <div id="tabMonitor" class="nxs-view-panel" style="display:none;">
        <div class="nxs-glass-card" style="padding:0;">
            <div class="nxs-table-frame"><table class="nxs-table"><thead><tr><th>ID</th><th>Investor Identity</th><th>Plan Selected</th><th>Principal Sized</th><th>Expected Yield</th><th>Status</th><th style="text-align:right;">Action</th></tr></thead><tbody id="monitorTableBody"></tbody></table></div>
        </div>
    </div>

    <div id="tabDeposits" class="nxs-view-panel" style="display:none;">
        <div class="nxs-glass-card" style="padding:0;">
            <div class="nxs-table-frame"><table class="nxs-table"><thead><tr><th>Deposit Code</th><th>Investor</th><th>Value</th><th>Method</th><th>Timestamp</th><th>Status</th><th style="text-align:right;">Action</th></tr></thead><tbody id="depositsTableBody"></tbody></table></div>
        </div>
    </div>

    <div id="tabWithdrawals" class="nxs-view-panel" style="display:none;">
        <div class="nxs-glass-card" style="padding:0;">
            <div class="nxs-table-frame"><table class="nxs-table"><thead><tr><th>Withdrawal Code</th><th>Investor</th><th>Value Sized</th><th>Settlement Account</th><th>Status</th><th style="text-align:right;">Action</th></tr></thead><tbody id="withdrawalsTableBody"></tbody></table></div>
        </div>
    </div>

    <div id="tabLiveStocks" class="nxs-view-panel" style="display:none;">
        <div style="display:flex; justify-content:flex-end; margin-bottom:16px;"><button class="nxs-btn nxs-btn-primary" onclick="openStockModal('modalAddStock')"><i class="bx bx-add-to-queue"></i> Rig New Asset</button></div>
        <div class="nxs-glass-card" style="padding:0;">
            <div class="nxs-table-frame"><table class="nxs-table"><thead><tr><th>Company Asset Asset</th><th>Symbol</th><th>Market Price</th><th>Scale Gap %</th><th>Risk Metric</th><th style="text-align:right;">Control</th></tr></thead><tbody id="liveStocksTableBody"></tbody></table></div>
        </div>
    </div>

    <div id="modalCreatePlan" class="nxs-modal-overlay">
        <div class="nxs-modal-window">
            <div class="nxs-modal-header"><h3>Structure Equity Investment Plan</h3><i class="bx bx-x" style="cursor:pointer; font-size:1.5rem;" onclick="closeStockModal('modalCreatePlan')"></i></div>
            <div class="nxs-modal-body">
                <form id="formCreatePlan" onsubmit="executePlanCreationPipeline(event)" class="nxs-form-grid">
                    <div style="display:flex; flex-direction:column; gap:6px;"><label style="font-size:0.8rem; color:var(--text-secondary);">Plan Title Name</label><input type="text" class="nxs-input-field" id="pName" style="padding:10px;" required></div>
                    <div style="display:flex; flex-direction:column; gap:6px;"><label style="font-size:0.8rem; color:var(--text-secondary);">Tier Class</label><input type="text" class="nxs-input-field" id="pTier" placeholder="Premium Elite" style="padding:10px;" required></div>
                    <div style="display:flex; flex-direction:column; gap:6px;"><label style="font-size:0.8rem; color:var(--text-secondary);">Minimum Entry ($)</label><input type="number" class="nxs-input-field" id="pMin" style="padding:10px;" required></div>
                    <div style="display:flex; flex-direction:column; gap:6px;"><label style="font-size:0.8rem; color:var(--text-secondary);">Maximum Cap ($)</label><input type="number" class="nxs-input-field" id="pMax" style="padding:10px;" required></div>
                    <div style="display:flex; flex-direction:column; gap:6px;"><label style="font-size:0.8rem; color:var(--text-secondary);">Daily Dividend Yield (%)</label><input type="number" step="0.01" class="nxs-input-field" id="pRoi" style="padding:10px;" required></div>
                    <div style="display:flex; flex-direction:column; gap:6px;"><label style="font-size:0.8rem; color:var(--text-secondary);">Contract Term (Days)</label><input type="number" class="nxs-input-field" id="pDuration" style="padding:10px;" required></div>
                    <div style="grid-column:span 2; display:flex; justify-content:flex-end; gap:12px; margin-top:12px;"><button type="button" class="nxs-btn nxs-btn-secondary" onclick="closeStockModal('modalCreatePlan')">Abort</button><button type="submit" class="nxs-btn nxs-btn-primary">Deploy Plan Pool</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
    </main>

    <script id="adminPlansData" type="application/json">@json($plans)</script>
    <script id="adminInvestmentsData" type="application/json">@json($investments)</script>
    <script id="adminDepositsData" type="application/json">@json($deposits)</script>
    <script id="adminStatsData" type="application/json">@json($stats)</script>
    <script>
        window.adminStockPlanStoreUrl = @json(route('admin.stockmarket.plan.store'));
    </script>
    <script src="{{ asset('assets/AdminDashboard/js/StockMarket.js') }}?v=4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>