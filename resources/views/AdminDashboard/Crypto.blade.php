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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/Crypto.css') }}">
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
       <div class="nx-stock-market-engine">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h2 style="font-size: 1.6rem; font-weight: 700; letter-spacing: -0.02em;">Liquidity Operations Center</h2>
            <p style="color: var(--text-secondary); font-size: 0.85rem; margin-top: 2px;">Comprehensive analytics pipeline, client accounts configuration, and plan parameters.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <button class="nx-btn nx-btn-s" onclick="triggerReportGenerator()"><i class="bx bx-download"></i> Generate Logs</button>
            <button class="nx-btn nx-btn-p" onclick="openEngineModal('modalPlanForm')"><i class="bx bx-list-plus"></i> Initialize Plan</button>
        </div>
    </div>

    <div class="nx-metrics-grid">
        <div class="nx-glass-card">
            <div class="nx-stat-header"><span>Total Investors Pool</span><i class="bx bx-group"></i></div>
            <div class="nx-stat-counter" id="statInvestors">0</div>
            <div class="nx-stat-footer"><span>Today: <strong style="color:#10b981;">+14</strong></span><span>MoM Delta: <strong>16.4%</strong></span></div>
        </div>
        <div class="nx-glass-card">
            <div class="nx-stat-header"><span>Active Assets Sized</span><i class="bx bx-line-chart"></i></div>
            <div class="nx-stat-counter" id="statActiveInvestments">0</div>
            <div class="nx-stat-footer"><span>Active Contracts Deployment</span></div>
        </div>
        <div class="nx-glass-card">
            <div class="nx-stat-header"><span>Aggregated Capital</span><i class="bx bx-wallet"></i></div>
            <div class="nx-stat-counter" id="statDeposits">$0.00</div>
            <div class="nx-stat-footer"><span>Pending Requests: <strong id="statPendingDep">0</strong></span></div>
        </div>
        <div class="nx-glass-card">
            <div class="nx-stat-header"><span>Yield Conversions</span><i class="bx bx-badge-check"></i></div>
            <div class="nx-stat-counter" id="statProfitPaid">$0.00</div>
            <div class="nx-stat-footer"><span>Platform Revenue: <span id="statRevenue" style="color:var(--secondary-color); font-weight:600;">$0</span></span></div>
        </div>
    </div>

    <div class="nx-content-grid">
        <div class="nx-glass-card nx-col-8">
            <h4 style="font-size:0.85rem; font-weight:600; margin-bottom:16px; color:var(--text-secondary); text-transform:uppercase;">Institutional Capital Flow Delta</h4>
            <div style="height: 240px; position: relative;"><canvas id="canvasGrowthTrack"></canvas></div>
        </div>
        <div class="nx-glass-card nx-col-4">
            <h4 style="font-size:0.85rem; font-weight:600; margin-bottom:16px; color:var(--text-secondary); text-transform:uppercase;">Asset Distribution Weights</h4>
            <div style="height: 240px; position: relative;"><canvas id="canvasAssetDistribution"></canvas></div>
        </div>
    </div>

    <div class="nx-workspace-nav">
        <button class="nx-nav-tab active" onclick="toggleEngineView(event, 'panelPlans')">Asset Plans Tier</button>
        <button class="nx-nav-tab" onclick="toggleEngineView(event, 'panelInvestors')">Investors Directory</button>
        <button class="nx-nav-tab" onclick="toggleEngineView(event, 'panelDeposits')">Deposits Queue</button>
        <button class="nx-nav-tab" onclick="toggleEngineView(event, 'panelWithdrawals')">Withdrawals Board</button>
        <button class="nx-nav-tab" onclick="toggleEngineView(event, 'panelEarnings')">Manual Yield Ledger</button>
        <button class="nx-nav-tab" onclick="toggleEngineView(event, 'panelMarket')">Signals & News Feed</button>
    </div>

    <div class="nx-search-frame">
        <i class="bx bx-search-alt"></i>
        <input type="text" class="nx-input" id="engineFilterInput" placeholder="Filter current active data vector records..." oninput="executeLiveSubfiltering()">
    </div>

    <div id="panelPlans" class="nx-engine-panel">
        <div class="nx-glass-card" style="padding: 0;">
            <div class="nx-table-container">
                <table class="nx-table">
                    <thead>
                        <tr>
                            <th>Plan Class Specification</th>
                            <th>Entry Caps Range</th>
                            <th>Yield Factor</th>
                            <th>Term Line</th>
                            <th>Subscribers</th>
                            <th>Status</th>
                            <th style="text-align:right;">Control</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyPlans"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="panelInvestors" class="nx-engine-panel" style="display: none;">
        <div class="nx-glass-card" style="padding: 0;">
            <div class="nx-table-container">
                <table class="nx-table">
                    <thead>
                        <tr>
                            <th>Client Identity</th>
                            <th>Country</th>
                            <th>Current Balance</th>
                            <th>Total Sized Asset</th>
                            <th>Yield Realized</th>
                            <th>Verification Status</th>
                            <th style="text-align:right;">Console</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyInvestors"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="panelDeposits" class="nx-engine-panel" style="display: none;">
        <div class="nx-glass-card" style="padding: 0;">
            <div class="nx-table-container">
                <table class="nx-table">
                    <thead>
                        <tr>
                            <th>Investor Account</th>
                            <th>Amount Value</th>
                            <th>Plan Destination</th>
                            <th>Payment Channel</th>
                            <th>Timestamp</th>
                            <th>Status</th>
                            <th style="text-align:right;">Verification</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyDeposits"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="panelWithdrawals" class="nx-engine-panel" style="display: none;">
        <div class="nx-glass-card" style="padding: 0;">
            <div class="nx-table-container">
                <table class="nx-table">
                    <thead>
                        <tr>
                            <th>Investor Account</th>
                            <th>Value Sized</th>
                            <th>Channel Mechanism</th>
                            <th>Destination Node Wallet</th>
                            <th>Timestamp</th>
                            <th>Status</th>
                            <th style="text-align:right;">Execution</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyWithdrawals"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="panelEarnings" class="nx-engine-panel" style="display: none;">
        <div class="nx-glass-card" style="padding: 0;">
            <div class="nx-table-container">
                <table class="nx-table">
                    <thead>
                        <tr>
                            <th>Client Context</th>
                            <th>Plan Active Bound</th>
                            <th>Principal Base</th>
                            <th>Current Earnings Accrued</th>
                            <th>Yield Factor %</th>
                            <th style="text-align:right;">Override Mutation Ledger Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyEarnings"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="panelMarket" class="nx-engine-panel" style="display: none;">
        <div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
            <button class="nx-btn nx-btn-p" onclick="openEngineModal('modalSignalForm')"><i class="bx bx-radio-circle-marked"></i> Wire Market Broadcast</button>
        </div>
        <div class="nx-glass-card" style="padding: 0;">
            <div class="nx-table-container">
                <table class="nx-table">
                    <thead>
                        <tr>
                            <th>Broadcast Heading</th>
                            <th>Context Category</th>
                            <th>Market Feed Metric Label</th>
                            <th>Timestamp</th>
                            <th style="text-align:right;">Control Node</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyMarketFeeds"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalInvestorProfile" class="nx-overlay-block">
        <div class="nx-modal-shell" style="max-width: 680px;">
            <div style="padding:16px 20px; border-bottom:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center;">
                <h3>Investor Ledger Analytical Profile</h3>
                <i class="bx bx-x" style="cursor:pointer; font-size:1.4rem;" onclick="closeEngineModal('modalInvestorProfile')"></i>
            </div>
            <div style="padding: 20px; overflow-y:auto;" id="profileModalContent"></div>
        </div>
    </div>

    <div id="modalPlanForm" class="nx-overlay-block">
        <div class="nx-modal-shell">
            <div style="padding:16px 20px; border-bottom:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center;">
                <h3>Configure Equity Allocation Plan</h3>
                <i class="bx bx-x" style="cursor:pointer; font-size:1.4rem;" onclick="closeEngineModal('modalPlanForm')"></i>
            </div>
            <form onsubmit="deployNewPlanAssetStream(event)" style="padding: 20px; display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                <div style="display:flex; flex-direction:column; gap:4px; grid-column: span 2;">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Plan Name Identifier</label>
                    <input type="text" class="nx-input" id="formPlanName" style="padding:8px 12px;" required>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Tier Classification</label>
                    <input type="text" class="nx-input" id="formPlanTier" placeholder="Alpha High-Yield" style="padding:8px 12px;" required>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Daily ROI (%)</label>
                    <input type="number" step="0.01" class="nx-input" id="formPlanRoi" style="padding:8px 12px;" required>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Minimum Floor ($)</label>
                    <input type="number" class="nx-input" id="formPlanMin" style="padding:8px 12px;" required>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Maximum Ceiling ($)</label>
                    <input type="number" class="nx-input" id="formPlanMax" style="padding:8px 12px;" required>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px; grid-column: span 2;">
                    <label style="font-size:0.75rem; color:var(--text-secondary);">Contract Maturity Duration (Days)</label>
                    <input type="number" class="nx-input" id="formPlanDuration" style="padding:8px 12px;" required>
                </div>
                <div style="grid-column: span 2; display:flex; justify-content:flex-end; gap:10px; margin-top:10px;">
                    <button type="button" class="nx-btn nx-btn-s" onclick="closeEngineModal('modalPlanForm')">Cancel</button>
                    <button type="submit" class="nx-btn nx-btn-p">Commit to Matrix</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </main>

    <script>
        window.csrfToken = '{{ csrf_token() }}';
        window.adminCryptoPlansData = {!! json_encode(\App\Models\CryptoPlan::withCount('investments')->orderBy('id')->get()) !!};
        window.adminCryptoInvestmentsData = {!! json_encode(\App\Models\CryptoInvestment::with('user','plan')->orderBy('id','desc')->get()) !!};
        window.adminDepositsData = {!! json_encode(\App\Models\Deposit::orderBy('id','desc')->take(50)->get()) !!};
        window.adminCryptoStats = {!! json_encode([
            'total_investors' => \App\Models\CryptoInvestment::distinct('user_id')->count('user_id'),
            'total_deposits' => \App\Models\Deposit::sum('amount'),
            'pending_deposits' => \App\Models\Deposit::where('status','Pending')->count(),
        ]) !!};
    </script>
    <script src="{{ asset('assets/AdminDashboard/js/Crypto.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>