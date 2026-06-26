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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/transactions.css') }}">
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
                <a href="{{ url('/admin-notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/admin-notifications">Notifications</a></li>
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
            <li class="active">
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
                <h1 id="page-title-display">Transactions</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->

        <div class="support-container">

            <div class="support-header">
                <div class="header-title-block">
                    <h1>Transaction Logs</h1>
                    <p>Monitor, audit, and authorize network-wide asset movements across wallets and bank rails.</p>
                </div>
                <div class="alert-pill-badge" id="fraud-alert-banner">
                    <i class='bx bxs-shield-quarter-boost bx-flash'></i>
                    <span>Fraud Risk: 0 Anomalies Flagged</span>
                </div>
            </div>

            <div class="support-stats-grid">
                <div class="support-stat-card border-primary">
                    <div class="card-metric-info">
                        <span class="metric-label">Total Transactions Volume</span>
                        <span class="metric-value" id="stat-total-volume">$3,842,910.50</span>
                        <span class="metric-trend color-success"><i class='bx bx-trending-up'></i> +14.2% this
                            month</span>
                    </div>
                    <div class="card-icon-box bg-primary-glow">
                        <i class='bx bx-coin-stack'></i>
                    </div>
                </div>

                <div class="support-stat-card border-success">
                    <div class="card-metric-info">
                        <span class="metric-label">Successful Logs</span>
                        <span class="metric-value" id="stat-success-count">41,205</span>
                        <span class="metric-trend color-success">94.8% success rate</span>
                    </div>
                    <div class="card-icon-box bg-success-glow">
                        <i class='bx bx-check-circle'></i>
                    </div>
                </div>

                <div class="support-stat-card border-warning">
                    <div class="card-metric-info">
                        <span class="metric-label">Pending Verifications</span>
                        <span class="metric-value" id="stat-pending-count">142</span>
                        <span class="metric-trend color-warning">Requires manual approval</span>
                    </div>
                    <div class="card-icon-box bg-warning-glow">
                        <i class='bx bx-time-five'></i>
                    </div>
                </div>

                <div class="support-stat-card border-danger">
                    <div class="card-metric-info">
                        <span class="metric-label">Failed / Reverted Logs</span>
                        <span class="metric-value" id="stat-failed-count">84</span>
                        <span class="metric-trend color-danger">Blocked by system rules</span>
                    </div>
                    <div class="card-icon-box bg-danger-glow">
                        <i class='bx bx-x-circle'></i>
                    </div>
                </div>
            </div>

            <div class="table-frame-container" style="padding: 1.5rem;">
                <h3
                    style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class='bx bx-bar-chart-square' style='color: var(--secondary-color);'></i> Transaction Analytics
                    & Growth Flow
                </h3>
                <div class="chart-canvas-container">
                    <canvas id="nexuistTransactionChart"></canvas>
                </div>
            </div>

            <div class="filter-console-wrapper">
                <div class="search-input-box">
                    <i class='bx bx-search'></i>
                    <input type="text" id="tx-search-input" placeholder="Search by ID, Name, Wallet, or Ref Number...">
                </div>
                <div class="filter-dropdown-group">
                    <select class="console-select" id="filter-type">
                        <option value="">All Types</option>
                        <option value="Deposit">Deposit</option>
                        <option value="Withdrawal">Withdrawal</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Loan">Loan</option>
                        <option value="Investment">Investment</option>
                    </select>
                    <select class="console-select" id="filter-status">
                        <option value="">All Statuses</option>
                        <option value="Successful">Successful</option>
                        <option value="Pending">Pending</option>
                        <option value="Failed">Failed</option>
                        <select class="console-select" id="filter-date">
                            <option value="">Any Time</option>
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="week">Past 7 Days</option>
                        </select>
                    </select>
                    <button class="action-btn-trigger bg-primary" id="btn-export-pdf"
                        style="height: 100%; padding: 0 1rem;">
                        <i class='bx bxs-file-pdf'></i> Export Data
                    </button>
                </div>
            </div>

            <div class="table-frame-container">
                <div class="table-inner-scroller">
                    <table class="fintech-support-table" id="tx-master-table">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>User Profile</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Gateway / Method</th>
                                <th>Rail / Bank Address</th>
                                <th>Status</th>
                                <th>Reference Number</th>
                                <th>Timestamp</th>
                                <th style="text-align: right;">Action Matrix</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-tbody">
                        </tbody>
                    </table>
                </div>

                <div class="pagination-footer-bar">
                    <span class="pagination-records-count" id="pagination-info">Showing 1 to 3 of 3 entries</span>
                    <div class="pagination-btn-cluster">
                        <button class="table-control-btn" id="prev-page"><i class='bx bx-chevron-left'></i></button>
                        <button class="table-control-btn active">1</button>
                        <button class="table-control-btn" id="next-page"><i class='bx bx-chevron-right'></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="nexuist-modal-overlay" id="tx-details-modal">
            <div class="nexuist-modal-card">
                <div class="modal-card-header">
                    <h3><i class='bx bx-receipt color-secondary'></i> Full Transaction Audit Record</h3>
                    <button class="modal-close-trigger" onclick="closeTxModal()"><i class='bx bx-x'></i></button>
                </div>
                <div class="modal-card-body" id="modal-extended-details">
                </div>
            </div>
        </div>

    </main>

    <script src="{{ asset('assets/AdminDashboard/js/transactions.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js') }}"></script>

</body>

</html>