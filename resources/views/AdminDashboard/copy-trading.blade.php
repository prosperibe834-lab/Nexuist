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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/copy-trading.css') }}">
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
                <h1 id="page-title-display">Copy- Trading</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nx-trade-dashboard">
            <div
                style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; letter-spacing: -0.03em;">Expert Trading Desk</h1>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 4px;">Institutional
                        copy-allocation & expert risk ledger management.</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <button class="nxt-btn nxt-btn-secondary" onclick="openTradingModal('modalNotification')">
                        <i class="bx bx-bell"></i> Send Notification
                    </button>
                    <button class="nxt-btn nxt-btn-primary" onclick="openTradingModal('modalCreateTrader')">
                        <i class="bx bx-plus-circle"></i> Onboard Expert Trader
                    </button>
                </div>
            </div>

            <div class="nxt-metrics-grid" style="margin-top: 24px;">
                <div class="nxt-glass-card nxt-stat-card">
                    <div class="nxt-stat-header"><span>Total Expert Traders</span><i class="bx bx-shield-quarter"></i>
                    </div>
                    <div class="nxt-stat-value" id="statTotalTraders">0</div>
                    <div class="nxt-stat-footer"><span class="nxt-trend-up"><i class="bx bx-trending-up"></i> +2
                            Vaults</span> this month</div>
                </div>
                <div class="nxt-glass-card nxt-stat-card">
                    <div class="nxt-stat-header"><span>Active Expert Traders</span><i class="bx bx-analyse"></i></div>
                    <div class="nxt-stat-value" id="statActiveTraders">0</div>
                    <div class="nxt-stat-footer">Allocated risk execution pools</div>
                </div>
                <div class="nxt-glass-card nxt-stat-card">
                    <div class="nxt-stat-header"><span>Total Investors</span><i class="bx bx-group"></i></div>
                    <div class="nxt-stat-value" id="statTotalInvestors">0</div>
                    <div class="nxt-stat-footer"><span class="nxt-trend-up"><i class="bx bx-trending-up"></i>
                            +14.2%</span> scaling delta</div>
                </div>
                <div class="nxt-glass-card nxt-stat-card">
                    <div class="nxt-stat-header"><span>Total Invested</span><i class="bx bx-wallet"></i></div>
                    <div class="nxt-stat-value" id="statTotalInvested">$0.00</div>
                    <div class="nxt-stat-footer">AUM institutional liquidity</div>
                </div>
                <div class="nxt-glass-card nxt-stat-card">
                    <div class="nxt-stat-header"><span>Total Profit Generated</span><i
                            class="bx bx-pie-chart-alt-2"></i></div>
                    <div class="nxt-stat-value" id="statTotalProfit"
                        style="background: linear-gradient(120deg, #10b981, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        $0.00</div>
                    <div class="nxt-stat-footer">Net matching system rewards</div>
                </div>
                <div class="nxt-glass-card nxt-stat-card">
                    <div class="nxt-stat-header"><span>Today's Placements</span><i class="bx bx-timer"></i></div>
                    <div class="nxt-stat-value" id="statTodayInvestments">$0.00</div>
                    <div class="nxt-stat-footer" id="statPendingCount">0 Operations Pending</div>
                </div>
                <div class="nxt-glass-card nxt-stat-card">
                    <div class="nxt-stat-header"><span>Total Withdrawals</span><i class="bx bx-cloud-download"></i>
                    </div>
                    <div class="nxt-stat-value" id="statTotalWithdrawals">$0.00</div>
                    <div class="nxt-stat-footer">Settled outbound conversions</div>
                </div>
            </div>

            <div class="nxt-tab-container" style="margin-top: 32px;">
                <button class="nxt-tab-btn active" onclick="switchTradingTab(event, 'tabTraders')">Expert
                    Ledger</button>
                <button class="nxt-tab-btn" onclick="switchTradingTab(event, 'tabInvestments')">Copy Trading
                    Operations</button>
                <button class="nxt-tab-btn" onclick="switchTradingTab(event, 'tabInvestors')">Investor Profiles</button>
                <button class="nxt-tab-btn" onclick="switchTradingTab(event, 'tabPortfolios')">Portfolio
                    Bundles</button>
            </div>

            <div class="nxt-control-bar">
                <div class="nxt-search-wrapper">
                    <i class="bx bx-search-alt"></i>
                    <input type="text" class="nxt-search-input" id="nxtGlobalSearch"
                        placeholder="Filter profiles by identity, location, terminal asset identifier..."
                        oninput="executeTerminalDataFiltering()">
                </div>
                <div class="nxt-filter-group">
                    <select class="nxt-select-custom" id="nxtFilterStatus" onchange="executeTerminalDataFiltering()">
                        <option value="ALL">All Lifecycle Statuses</option>
                        <option value="ACTIVE">Active Pools</option>
                        <option value="RUNNING">Running Placements</option>
                        <option value="ONLINE">Traders Online</option>
                        <option value="OFFLINE">Traders Offline</option>
                        <option value="COMPLETED">Completed Terminations</option>
                    </select>
                </div>
            </div>

            <div id="tabTraders" class="nxt-tab-content-panel" style="margin-top: 24px;">
                <div class="nxt-trader-grid" id="nxtTraderContainerGrid">
                </div>
            </div>

            <div id="tabInvestments" class="nxt-tab-content-panel" style="margin-top: 24px; display: none;">
                <div class="nxt-glass-card">
                    <div class="nxt-table-wrapper">
                        <table class="nxt-table">
                            <thead>
                                <tr>
                                    <th>Placement ID</th>
                                    <th>Investor Identity</th>
                                    <th>Allocated Expert</th>
                                    <th>Principal Value</th>
                                    <th>Yield Output</th>
                                    <th>Status Badge</th>
                                    <th>Date Opened</th>
                                    <th style="text-align: right;">Execution Parameters</th>
                                </tr>
                            </thead>
                            <tbody id="nxtInvestmentsTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="tabInvestors" class="nxt-tab-content-panel" style="margin-top: 24px; display: none;">
                <div class="nxt-glass-card">
                    <div class="nxt-table-wrapper">
                        <table class="nxt-table">
                            <thead>
                                <tr>
                                    <th>Investor ID</th>
                                    <th>Full Profile Identity</th>
                                    <th>Geographic Frame</th>
                                    <th>Ledger Balance</th>
                                    <th>Cumulative Placements</th>
                                    <th>Yield Accrued</th>
                                    <th style="text-align: right;">Administrative Control</th>
                                </tr>
                            </thead>
                            <tbody id="nxtInvestorsTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="tabPortfolios" class="nxt-tab-content-panel" style="margin-top: 24px; display: none;">
                <div class="nxt-glass-card">
                    <div class="nxt-table-wrapper">
                        <table class="nxt-table">
                            <thead>
                                <tr>
                                    <th>Portfolio Target ID</th>
                                    <th>Aggregate Balance Valuation</th>
                                    <th>Active Operations Count</th>
                                    <th>Assigned Expert Asset</th>
                                    <th>Net ROI Return Rate</th>
                                    <th style="text-align: right;">Portfolio Adjustment</th>
                                </tr>
                            </thead>
                            <tbody id="nxtPortfoliosTableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="modalCreateTrader" class="nxt-modal-overlay">
                <div class="nxt-modal-window">
                    <div class="nxt-modal-header">
                        <h3 style="font-weight: 600;">Onboard Expert Trading Asset</h3>
                        <i class="bx bx-x" style="cursor:pointer; font-size: 1.5rem;"
                            onclick="closeTradingModal('modalCreateTrader')"></i>
                    </div>
                    <div class="nxt-modal-body">
                        <form id="formOnboardTrader" onsubmit="processTraderOnboarding(event)" class="nxt-form-grid">
                            <div class="nxt-field-wrap"><label class="nxt-label">Expert Trader Name</label><input
                                    type="text" class="nxt-input" id="ctName" required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Country Grid</label><input type="text"
                                    class="nxt-input" id="ctCountry" value="Nigeria" required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Trading
                                    Philosophy/Strategy</label><input type="text" class="nxt-input" id="ctStrategy"
                                    placeholder="Scalping Algorithm V4" required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Experience Horizon
                                    (Years)</label><input type="number" class="nxt-input" id="ctExperience" value="5"
                                    required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Expected Monthly ROI Target
                                    (%)</label><input type="number" step="0.01" class="nxt-input" id="ctRoi"
                                    value="24.5" required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Calibrated Win Rate (%)</label><input
                                    type="number" step="0.01" class="nxt-input" id="ctWinRate" value="88" required>
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">AUM Framework Allocation
                                    ($)</label><input type="number" class="nxt-input" id="ctAum" value="750000"
                                    required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Minimum Entrance Limit
                                    ($)</label><input type="number" class="nxt-input" id="ctMin" value="500" required>
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Avatar Asset Image (URL)</label><input
                                    type="text" class="nxt-input" id="ctAvatar"
                                    value="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80">
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Banner Image Backdrop
                                    (URL)</label><input type="text" class="nxt-input" id="ctBanner"
                                    value="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=600&q=80">
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Initial Calibrated Operational
                                    Status</label>
                                <select class="nxt-input" id="ctStatus">
                                    <option value="online">Online</option>
                                    <option value="trading">Trading</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Risk Profile Classification</label>
                                <select class="nxt-input" id="ctRisk">
                                    <option value="Low">Low Risk Framework</option>
                                    <option value="Medium">Medium Balanced Profile</option>
                                    <option value="High">High Alpha Vector</option>
                                </select>
                            </div>
                            <div class="nxt-field-wrap full-width"><label class="nxt-label">Professional Asset
                                    Biography</label><textarea class="nxt-input" id="ctBio"
                                    style="height: 70px; resize: none;">Quantitative arbitrage operational manager scaling decentralized execution lines.</textarea>
                            </div>
                            <div class="nxt-field-wrap full-width"
                                style="margin-top: 12px; display:flex; flex-direction:row; justify-content: flex-end; gap: 12px;">
                                <button type="button" class="nxt-btn nxt-btn-secondary"
                                    onclick="closeTradingModal('modalCreateTrader')">Cancel</button>
                                <button type="submit" class="nxt-btn nxt-btn-primary">Execute Authorization</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="modalCalibratePerformance" class="nxt-modal-overlay">
                <div class="nxt-modal-window" style="max-width: 450px;">
                    <div class="nxt-modal-header">
                        <h3 style="font-weight: 600;">Calibrate Operational Vectors</h3>
                        <i class="bx bx-x" style="cursor:pointer; font-size: 1.5rem;"
                            onclick="closeTradingModal('modalCalibratePerformance')"></i>
                    </div>
                    <div class="nxt-modal-body">
                        <form id="formCalibratePerformance" onsubmit="processPerformanceCalibration(event)"
                            class="nxt-form-grid" style="grid-template-columns: 1fr;">
                            <input type="hidden" id="calTargetTraderId">
                            <div class="nxt-field-wrap"><label class="nxt-label">Adjust Real-time Monthly ROI
                                    (%)</label><input type="number" step="0.01" class="nxt-input" id="calRoi" required>
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Calibrate Live Win Rate
                                    (%)</label><input type="number" step="0.01" class="nxt-input" id="calWin" required>
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Total Current AUM Capital
                                    ($)</label><input type="number" class="nxt-input" id="calAum" required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Active Platform Copiers
                                    Count</label><input type="number" class="nxt-input" id="calCopiers" required></div>
                            <div class="nxt-field-wrap"
                                style="margin-top: 12px; display:flex; justify-content: flex-end; gap: 12px;">
                                <button type="button" class="nxt-btn nxt-btn-secondary"
                                    onclick="closeTradingModal('modalCalibratePerformance')">Dismiss</button>
                                <button type="submit" class="nxt-btn nxt-btn-primary">Commit Dynamic Vector</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="modalManualProfitCredit" class="nxt-modal-overlay">
                <div class="nxt-modal-window" style="max-width: 420px;">
                    <div class="nxt-modal-header">
                        <h3 style="font-weight: 600;">Inject Portfolio Profit Stream</h3>
                        <i class="bx bx-x" style="cursor:pointer; font-size: 1.5rem;"
                            onclick="closeTradingModal('modalManualProfitCredit')"></i>
                    </div>
                    <div class="nxt-modal-body">
                        <form id="formManualProfit" onsubmit="processManualProfitInjection(event)" class="nxt-form-grid"
                            style="grid-template-columns: 1fr;">
                            <input type="hidden" id="profTargetInvestmentId">
                            <div class="nxt-field-wrap"><label class="nxt-label">Transactional Profit Delta Value
                                    ($)</label><input type="number" step="0.01" class="nxt-input" id="profAmount"
                                    placeholder="e.g. 250.00" required></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Accounting Modality Override</label>
                                <select class="nxt-input" id="profModality">
                                    <option value="ADD">Credit Portfolio Return</option>
                                    <option value="DEDUCT">Debit System Deficit Rollback</option>
                                </select>
                            </div>
                            <div class="nxt-field-wrap"
                                style="margin-top: 12px; display:flex; justify-content: flex-end; gap: 12px;">
                                <button type="button" class="nxt-btn nxt-btn-secondary"
                                    onclick="closeTradingModal('modalManualProfitCredit')">Cancel</button>
                                <button type="submit" class="nxt-btn nxt-btn-primary">Apply Settlement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="modalNotification" class="nxt-modal-overlay">
                <div class="nxt-modal-window" style="max-width: 500px;">
                    <div class="nxt-modal-header">
                        <h3 style="font-weight: 600;">Broadcast Pipeline Message</h3>
                        <i class="bx bx-x" style="cursor:pointer; font-size: 1.5rem;"
                            onclick="closeTradingModal('modalNotification')"></i>
                    </div>
                    <div class="nxt-modal-body">
                        <form id="formBroadcastMessage" onsubmit="processBroadcastDistribution(event)"
                            class="nxt-form-grid" style="grid-template-columns: 1fr;">
                            <div class="nxt-field-wrap"><label class="nxt-label">Audience Focus Target Routing</label>
                                <select class="nxt-input" id="notifTarget">
                                    <option value="ALL">All Active Network Terminals</option>
                                    <option value="SINGLE">Target Unique Operational ID</option>
                                </select>
                            </div>
                            <div class="nxt-field-wrap" id="notifSpecificUserWrap" style="display: none;"><label
                                    class="nxt-label">Target Account Reference Address Code</label><input type="text"
                                    class="nxt-input" id="notifTargetUser" placeholder="NX-USR-9921"></div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Signal Header Classification</label>
                                <select class="nxt-input" id="notifType">
                                    <option value="Profit Alert">Profit Accrual Warning Alert</option>
                                    <option value="Investment Update">Placement Milestone Structural Update</option>
                                    <option value="System">System Infrastructure Maintenance Log</option>
                                </select>
                            </div>
                            <div class="nxt-field-wrap"><label class="nxt-label">Signal Communication Payload
                                    Description</label><textarea class="nxt-input" id="notifPayload"
                                    style="height: 80px; resize:none;" required
                                    placeholder="Asset allocation parameter execution threshold confirmation notification statement..."></textarea>
                            </div>
                            <div class="nxt-field-wrap"
                                style="margin-top: 12px; display:flex; justify-content: flex-end; gap: 12px;">
                                <button type="button" class="nxt-btn nxt-btn-secondary"
                                    onclick="closeTradingModal('modalNotification')">Close</button>
                                <button type="submit" class="nxt-btn nxt-btn-primary">Broadcast Signal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.NEXU_COPY_TRADING = {!! json_encode([
            'stats' => $stats,
            'traders' => $traders->toArray(),
            'investments' => $investments->toArray(),
            'investors' => $investors->toArray(),
            'portfolios' => $portfolios->toArray(),
        ], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!};
    </script>
    <script src="{{ asset('assets/AdminDashboard/js/copy-trading.js') }}"></script>
</body>

</html>