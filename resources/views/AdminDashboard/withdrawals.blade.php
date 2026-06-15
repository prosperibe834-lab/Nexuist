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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/withdrawals.css') }}">
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
            <li class="active">
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
                <a href="ai-bot">
                    <i class='bx bx-bot'></i>
                    <span class="link_name">AI Bot Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="ai-bot">AI Bot Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="copy-trading">
                    <i class='bx bx-copy-alt'></i>
                    <span class="link_name">Copy Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="copy-trading">Copy Trading</a></li>
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
                <a href="notifications">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="notifications">Notifications</a></li>
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
                <h1 id="page-title-display">withdrawals</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="withdraw-workspace-container nx-w-animate-fade-in">

    <div class="nx-w-metrics-grid">
        <div class="nx-w-card glow-border-primary">
            <div class="nx-w-card-header">
                <span>PENDING OUTFLOW VOLUME</span>
                <i class='bx bx-time-five icon-w-warn'></i>
            </div>
            <div class="nx-w-card-body">
                <h2>$28,450.00</h2>
                <div class="nx-w-pill pill-warn">
                    <i class='bx bx-git-pull-request'></i> 5 Pending Sign-offs
                </div>
            </div>
            <p class="nx-w-meta">Awaiting administrative clearance authorization</p>
        </div>

        <div class="nx-w-card glow-border-secondary">
            <div class="nx-w-card-header">
                <span>SETTLED WITHDRAWALS (30D)</span>
                <i class='bx bx-check-shield icon-w-success'></i>
            </div>
            <div class="nx-w-card-body">
                <h2>$412,050.00</h2>
                <div class="nx-w-pill pill-success">
                    <i class='bx bx-trending-down'></i> -8.2% Outflow Rate
                </div>
            </div>
            <p class="nx-w-meta">Successfully debited system liquidity reserves</p>
        </div>

        <div class="nx-w-card glow-border-accent">
            <div class="nx-w-card-header">
                <span>DOMINANT ROUTING ENDPOINT</span>
                <i class='bx bx-bank icon-w-accent'></i>
            </div>
            <div class="nx-w-card-body">
                <h2>Bank Wire</h2>
                <div class="nx-w-pill pill-accent">
                    <i class='bx bx-shuffle'></i> 52% Selection
                </div>
            </div>
            <p class="nx-w-meta">Primary client payout pipeline choice</p>
        </div>
    </div>

    <div class="nx-w-panel-workspace">
        <div class="nx-w-panel-header">
            <div class="nx-w-title-block">
                <h3><i class='bx bx-export'></i> Withdrawal Settlement Pipeline</h3>
                <p class="nx-w-subtitle">Audit outgoing debit instructions, verify client destination details, and update settlement flags</p>
            </div>
            
            <div class="nx-w-filter-action-bar">
                <div class="nx-w-search-box">
                    <i class='bx bx-search search-w-icon'></i>
                    <input type="text" placeholder="Search by Batch TXID, Node ID, Destination..." id="withdraw-search-input">
                </div>
                <div class="nx-w-dropdown-anchor">
                    <button class="nx-w-btn-glass" id="withdraw-btn-filter">
                        <i class='bx bx-filter-alt'></i> Filter Matrix
                    </button>

                    <div class="nx-w-floating-dropdown" id="withdraw-filter-dropdown">
                        <div class="nx-w-field-row">
                            <label>Processing State</label>
                            <select id="filter-withdraw-status">
                                <option value="all">All States</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="nx-w-field-row">
                            <label>Payout Channel</label>
                            <select id="filter-withdraw-method">
                                <option value="all">All Channels</option>
                                <option value="bank transfer">Bank Transfer</option>
                                <option value="crypto">Crypto Network</option>
                                <option value="debit card">Debit Card</option>
                            </select>
                        </div>
                        <div class="nx-w-dropdown-footer">
                            <button id="btn-reset-withdraw-filters"><i class='bx bx-refresh'></i> Reset Parameters</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nx-w-table-responsive">
            <table class="nx-w-fintech-table" id="nexuist-withdraw-table">
                <thead>
                    <tr>
                        <th>Debit Reference ID</th>
                        <th>User Target Node</th>
                        <th>Payout Channel</th>
                        <th>Withdrawal Amount</th>
                        <th>Target Destination Address</th>
                        <th>Settlement State</th>
                        <th style="text-align: right;">Review Management</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nx-w-data-row" data-txid="WTH-77402911" data-uid="#NEX-20349" data-name="Marcus Vance" data-method="Bank Transfer" data-amount="12500.00" data-destination="Chase Bank •••• 8841" data-status="Pending">
                        <td><span class="nx-w-hash-tag">WTH-77402911</span></td>
                        <td>
                            <div class="nx-w-profile-cell">
                                <div class="nx-w-avatar avatar-purple">MV</div>
                                <div class="nx-w-profile-info">
                                    <span class="nx-w-username">Marcus Vance</span>
                                    <span class="nx-w-uid">#NEX-20349</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="nx-w-method-text"><i class='bx bx-bank text-muted'></i> Bank Transfer</span></td>
                        <td><span class="nx-w-value-negative">$12,500.00</span></td>
                        <td><span class="nx-w-dest-text">Chase Bank •••• 8841</span></td>
                        <td><span class="nx-w-status status-w-pending"><i class='bx bx-time-five'></i> Pending</span></td>
                        <td>
                            <div class="nx-w-actions-group">
                                <button class="nx-w-action-btn withdraw-action-review" title="Process Outflow Instruction"><i class='bx bx-slider-alt'></i></button>
                            </div>
                        </td>
                    </tr>

                    <tr class="nx-w-data-row" data-txid="WTH-11940293" data-uid="#NEX-39401" data-name="Elena Rostova" data-method="Crypto" data-amount="4310.00" data-destination="0x71C...49Ba (USDT)" data-status="Approved">
                        <td><span class="nx-w-hash-tag">WTH-11940293</span></td>
                        <td>
                            <div class="nx-w-profile-cell">
                                <div class="nx-w-avatar avatar-cyan">ER</div>
                                <div class="nx-w-profile-info">
                                    <span class="nx-w-username">Elena Rostova</span>
                                    <span class="nx-w-uid">#NEX-39401</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="nx-w-method-text"><i class='bx bxl-bitcoin crypto-usdt'></i> Crypto (USDT)</span></td>
                        <td><span class="nx-w-value-negative">$4,310.00</span></td>
                        <td><span class="nx-w-dest-text monospace-font">0x71C...49Ba</span></td>
                        <td><span class="nx-w-status status-w-approved"><i class='bx bx-check-circle'></i> Approved</span></td>
                        <td>
                            <div class="nx-w-actions-group">
                                <button class="nx-w-action-btn withdraw-action-review" title="Process Outflow Instruction"><i class='bx bx-slider-alt'></i></button>
                            </div>
                        </td>
                    </tr>

                    <tr id="withdraw-empty-row" style="display: none;">
                        <td colspan="7" class="nx-w-empty-fallback">
                            <i class='bx bx-transfer-alt empty-w-icon'></i>
                            <p>No withdrawal logs cross-intersect your active parameter configuration.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="nx-w-pagination-footer">
            <span class="nx-w-pagination-info" id="withdraw-pagination-status">Showing 1 to 2 of 2 Entries</span>
            <div class="nx-w-pagination-controls" id="withdraw-pagination-controls"></div>
        </div>
    </div>
</div>

<div id="modal-audit-withdraw" class="nx-w-modal-overlay">
    <div class="nx-w-modal-container">
        <div class="nx-w-modal-header">
            <h3><i class='bx bx-shield-quarter'></i> Authorize Outbound Payout</h3>
            <button class="nx-w-modal-close">&times;</button>
        </div>
        <div class="nx-w-modal-body">
            <div class="nx-w-modal-user-profile">
                <span id="m-withdraw-txid" class="nx-w-hash-tag spacing-b">WTH-00000000</span>
                <h4 id="m-withdraw-user">Target Client User</h4>
                <p id="m-withdraw-meta" class="nx-w-text-muted">Account key mapping framework</p>
            </div>
            
            <div class="nx-w-modal-grid">
                <div class="nx-w-modal-box">
                    <label>Debiting Amount</label>
                    <span id="m-withdraw-amount" class="nx-w-modal-val text-neon-red">$0.00</span>
                </div>
                <div class="nx-w-modal-box">
                    <label>Payout Route Channel</label>
                    <span id="m-withdraw-method" class="nx-w-modal-val">Channel</span>
                </div>
            </div>

            <div class="nx-w-destination-container">
                <label class="nx-w-destination-header"><i class='bx bx-git-commit'></i> Terminal Destination Endpoint</label>
                <div class="nx-w-destination-display-box" id="m-withdraw-destination">
                    System processing endpoint link address...
                </div>
                
                <div class="nx-w-security-notice">
                    <i class='bx bx-info-circle'></i>
                    <span>Ensure target destination checks match ledger profile routes before authorizing payouts. Executed actions are instant.</span>
                </div>

                <div class="nx-w-modal-actions" id="withdraw-workflow-actions">
                    <button class="nx-w-act-btn w-approve-btn" id="btn-withdraw-approve">
                        <i class='bx bx-check-shield'></i> Approve Payout
                    </button>
                    <button class="nx-w-act-btn w-reject-btn" id="btn-withdraw-reject">
                        <i class='bx bx-error-alt'></i> Decline Request
                    </button>
                </div>
                <div id="withdraw-status-locked-notice" class="nx-w-locked-banner" style="display:none;">
                    This transaction allocation state has been processed and locked.
                </div>
            </div>
        </div>
    </div>
</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/withdrawals.js') }}"></script>
</body>

</html>