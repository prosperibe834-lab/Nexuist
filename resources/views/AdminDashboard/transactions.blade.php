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

        @include('AdminDashboard.layouts.admin-sidebar')


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