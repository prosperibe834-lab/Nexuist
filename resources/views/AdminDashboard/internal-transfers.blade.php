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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/internal-transfers.css') }}">
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
            <li class="active">
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
                <h1 id="page-title-display">Internal Transfers</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
<div class="nx-it-workspace-container nx-it-animate-fade-in">

    <div class="nx-it-metrics-grid">
        <div class="nx-it-stat-card border-glow-primary">
            <div class="nx-it-card-header">
                <span>INTRA-SYSTEM VOLUME (24H)</span>
                <i class='bx bx-shuffle icon-it-primary'></i>
            </div>
            <div class="nx-it-card-body">
                <h2>$184,920.00</h2>
                <div class="nx-it-action-badge primary-glow">
                    <i class='bx bx-check-double'></i> 142 Clear Loops
                </div>
            </div>
            <p class="nx-it-meta-text">Total balances migrated across node layers</p>
        </div>

        <div class="nx-it-stat-card border-glow-secondary">
            <div class="nx-it-card-header">
                <span>SYSTEM LIQUIDITY BUFFER</span>
                <i class='bx bx-shield-quarter icon-it-secondary'></i>
            </div>
            <div class="nx-it-card-body">
                <h2>$2,140,850.00</h2>
                <div class="nx-it-action-badge secondary-glow">
                    <i class='bx bx-lock-alt'></i> Secure Core
                </div>
            </div>
            <p class="nx-it-meta-text">Combined off-chain liquidity clearing house pool</p>
        </div>

        <div class="nx-it-stat-card border-glow-accent">
            <div class="nx-it-card-header">
                <span>PENDING RECONCILIATIONS</span>
                <i class='bx bx-git-pull-request icon-it-accent'></i>
            </div>
            <div class="nx-it-card-body">
                <h2>0 Actions</h2>
                <div class="nx-it-action-badge accent-glow">
                    <i class='bx bx-refresh bx-spin-slow'></i> Synced
                </div>
            </div>
            <p class="nx-it-meta-text">All asset migration queries fully cleared</p>
        </div>
    </div>

    <div class="nx-it-split-layout">
        
        <div class="nx-it-form-panel">
            <div class="nx-it-panel-title-block">
                <h3><i class='bx bx-transfer-alt'></i> Execute Balance Migration</h3>
                <p>Instantly clear off-chain balance swaps between registered profiles</p>
            </div>

            <form id="nexuist-internal-transfer-form">
                <div class="nx-it-field-group">
                    <label for="it-sender-uid">Sender Account Node (UID)</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-log-out-circle text-muted'></i>
                        <input type="text" id="it-sender-uid" placeholder="e.g. #NEX-10942" autocomplete="off" required>
                    </div>
                    <div id="sender-lookup-preview" class="node-lookup-preview-box" style="display: none;">
                        <i class='bx bx-user-circle'></i> <span id="sender-preview-name">-</span> (Available: <strong id="sender-preview-balance">$0.00</strong>)
                    </div>
                </div>

                <div class="nx-it-field-group">
                    <label for="it-recipient-uid">Recipient Account Node (UID)</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-log-in-circle text-muted'></i>
                        <input type="text" id="it-recipient-uid" placeholder="e.g. #NEX-10811" autocomplete="off" required>
                    </div>
                    <div id="recipient-lookup-preview" class="node-lookup-preview-box" style="display: none;">
                        <i class='bx bx-user-circle'></i> <span id="recipient-preview-name">-</span>
                    </div>
                </div>

                <div class="nx-it-field-group">
                    <label for="it-transfer-amount">Migration Amount ($)</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-dollar text-muted'></i>
                        <input type="number" id="it-transfer-amount" step="0.01" min="1" placeholder="0.00" required>
                    </div>
                </div>

                <div class="nx-it-field-group">
                    <label for="it-transfer-memo">Administrative Routing Reference Memo</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-notepad text-muted'></i>
                        <input type="text" id="it-transfer-memo" placeholder="e.g. Internal Capital Balancing Pool Adjustment">
                    </div>
                </div>

                <button type="submit" class="nx-it-submit-btn" id="btn-execute-migration">
                    <i class='bx bx-check-shield'></i> Authorize Balance Swap
                </button>
            </form>
        </div>

        <div class="nx-it-table-panel">
            <div class="nx-it-panel-header-row">
                <div class="nx-it-panel-title-block">
                    <h3><i class='bx bx-list-ul'></i> System Audit Trail Logs</h3>
                    <p>Archived history of intra-ledger profile clearings</p>
                </div>
                
                <div class="nx-it-search-box-frame">
                    <i class='bx bx-search'></i>
                    <input type="text" id="it-search-input" placeholder="Search by UID, Batch ID, or Memo...">
                </div>
            </div>

            <div class="nx-it-table-responsive-box">
                <table class="nx-it-premium-table" id="internal-transfer-audit-log-table">
                    <thead>
                        <tr>
                            <th>Batch ID</th>
                            <th>Sender Node</th>
                            <th>Recipient Node</th>
                            <th>Asset Volume</th>
                            <th>Settlement State</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="nx-it-row" data-batch="TXN-IT-4820194" data-sender="#NEX-10942" data-recipient="#NEX-10811" data-amount="2500.00">
                            <td><span class="nx-it-hash-tag">TXN-IT-4820194</span></td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-10942</span>
                                    <span class="nx-it-subtext-email">Alexander Mercer</span>
                                </div>
                            </td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-10811</span>
                                    <span class="nx-it-subtext-email">Sophia Kovac</span>
                                </div>
                            </td>
                            <td><span class="nx-it-value-delta">$2,500.00</span></td>
                            <td><span class="nx-it-status badge-success"><i class='bx bx-check-circle'></i> Committed</span></td>
                        </tr>

                        <tr class="nx-it-row" data-batch="TXN-IT-1094823" data-sender="#NEX-09754" data-recipient="#NEX-10942" data-amount="310.20">
                            <td><span class="nx-it-hash-tag">TXN-IT-1094823</span></td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-09754</span>
                                    <span class="nx-it-subtext-email">Ryan Elric</span>
                                </div>
                            </td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-10942</span>
                                    <span class="nx-it-subtext-email">Alexander Mercer</span>
                                </div>
                            </td>
                            <td><span class="nx-it-value-delta">$310.20</span></td>
                            <td><span class="nx-it-status badge-success"><i class='bx bx-check-circle'></i> Committed</span></td>
                        </tr>

                        <tr id="it-empty-row" style="display: none;">
                            <td colspan="5" class="nx-it-empty-fallback-td">
                                <i class='bx bx-git-commit empty-icon-it-glow'></i>
                                <p>No internal transfer sequences match your keyword query inputs.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="nx-it-pagination-footer">
                <span class="nx-it-pagination-counter" id="it-pagination-status">Showing 1 to 2 of 2 Logs</span>
                <div class="nx-it-pagination-buttons-group" id="it-pagination-controls"></div>
            </div>
        </div>

    </div>
</div>

<div id="modal-it-compliance-signoff" class="nx-it-modal-overlay">
    <div class="nx-it-modal-card-container">
        <div class="nx-it-modal-header">
            <h3><i class='bx bx-shield-quarter-toggle'></i> Compliance Sign-off Authorization</h3>
            <button class="nx-it-modal-close-trigger">&times;</button>
        </div>
        <div class="nx-it-modal-body">
            <div class="nx-it-modal-summary-matrix">
                <div class="summary-node-item">
                    <span class="label">SENDER SOURCE</span>
                    <strong id="m-it-sender-display">#NEX-00000</strong>
                </div>
                <div class="summary-arrow-vector">
                    <i class='bx bx-right-arrow-alt bx-fade-right'></i>
                </div>
                <div class="summary-node-item">
                    <span class="label">RECIPIENT TARGET</span>
                    <strong id="m-it-recipient-display">#NEX-00000</strong>
                </div>
            </div>

            <div class="nx-it-modal-valuation-strip">
                <label>PRINCIPAL TRANSACTION BALANCE SWAP VALUE</label>
                <h2 id="m-it-amount-display">$0.00</h2>
            </div>

            <div class="nx-it-security-clause-card">
                <i class='bx bx-info-circle'></i>
                <div>
                    <strong>Irreversible Ledger Mutation Action Notice</strong>
                    <p>Executing this balance swap overrides profile standard parameters. Capital parameters will adjust instantly inside system core databases.</p>
                </div>
            </div>

            <div class="nx-it-modal-footer-actions">
                <button class="nx-it-cancel-btn nx-it-modal-close-trigger">Abort Transaction</button>
                <button class="nx-it-commit-btn" id="btn-confirm-it-mutation"><i class='bx bx-check-shield'></i> Commit Balance Mutation</button>
            </div>
        </div>
    </div>
</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/internal-transfers.js') }}"></script>
</body>

</html>