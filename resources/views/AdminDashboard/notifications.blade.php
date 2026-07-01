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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/notifications.css') }}">
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
                <h1 id="page-title-display">Notifications</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nexuist-notif-container">

            <div class="notif-stats-grid mb-4">
                <div class="stat-glass-card">
                    <div class="stat-card-inner">
                        <div>
                            <span class="stat-label">Total Notifications</span>
                            <h3 class="stat-value" id="stat-total">0</h3>
                        </div>
                        <div class="stat-icon-wrap primary"><i class='bx bx-bell'></i></div>
                    </div>
                </div>
                <div class="stat-glass-card">
                    <div class="stat-card-inner">
                        <div>
                            <span class="stat-label">Unread Alerts</span>
                            <h3 class="stat-value text-warning" id="stat-unread">0</h3>
                        </div>
                        <div class="stat-icon-wrap warning"><i class='bx bx-envelope-open'></i></div>
                    </div>
                    <div class="glow-edge warning"></div>
                </div>
                <div class="stat-glass-card">
                    <div class="stat-card-inner">
                        <div>
                            <span class="stat-label">Security Warnings</span>
                            <h3 class="stat-value text-danger" id="stat-security">0</h3>
                        </div>
                        <div class="stat-icon-wrap danger"><i class='bx bx-shield-x'></i></div>
                    </div>
                    <div class="glow-edge danger"></div>
                </div>
                <div class="stat-glass-card">
                    <div class="stat-card-inner">
                        <div>
                            <span class="stat-label">Pending KYC</span>
                            <h3 class="stat-value text-info" id="stat-kyc">0</h3>
                        </div>
                        <div class="stat-icon-wrap info"><i class='bx bx-user-check'></i></div>
                    </div>
                </div>
                <div class="stat-glass-card">
                    <div class="stat-card-inner">
                        <div>
                            <span class="stat-label">New Deposits</span>
                            <h3 class="stat-value text-success" id="stat-deposits">0</h3>
                        </div>
                        <div class="stat-icon-wrap success"><i class='bx bx-wallet'></i></div>
                    </div>
                </div>
            </div><br><br>

            <div class="notif-utilities-card mb-4">
                <div class="utilities-flex-wrap">
                    <div class="search-input-group">
                        <i class='bx bx-search search-lens'></i>
                        <input type="text" id="notifGlobalSearch" class="notif-ctrl-input"
                            placeholder="Search username, UID, transaction hash..." oninput="evaluateFeedFilters()">
                    </div>
                    <div class="filter-dropdown-group">
                        <select id="notifTimeFilter" class="notif-ctrl-select" onchange="evaluateFeedFilters()">
                            <option value="all">All Timelines</option>
                            <option value="today">Today Only</option>
                            <option value="week">This Week</option>
                        </select>
                        <select id="notifStateFilter" class="notif-ctrl-select" onchange="evaluateFeedFilters()">
                            <option value="all">All Status Tiers</option>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed/Approved</option>
                            <option value="Failed">Failed/Rejected</option>
                        </select>
                        <button type="button" class="btn-bulk-action" onclick="markAllAlertsAsRead()">
                            <i class='bx bx-check-double'></i> Mark All Read
                        </button>
                    </div>
                </div><br><br>

                <div class="notif-tabs-scroll-wrapper mt-3">
                    <div class="notif-category-tabs">
                        <button class="category-tab active" data-category="all"
                            onclick="switchCategoryTab(this)">All</button>
                        <button class="category-tab" data-category="deposit"
                            onclick="switchCategoryTab(this)">Deposits</button>
                        <button class="category-tab" data-category="withdrawal"
                            onclick="switchCategoryTab(this)">Withdrawals</button>
                        <button class="category-tab" data-category="kyc" onclick="switchCategoryTab(this)">KYC</button>
                        <button class="category-tab" data-category="security"
                            onclick="switchCategoryTab(this)">Security</button>
                        <button class="category-tab" data-category="investment"
                            onclick="switchCategoryTab(this)">Investments</button>
                        <button class="category-tab" data-category="message"
                            onclick="switchCategoryTab(this)">Messages</button>
                        <button class="category-tab" data-category="log" onclick="switchCategoryTab(this)">System
                            Logs</button>
                    </div>
                </div>
            </div>

            <div class="notif-stream-card">
                <div class="stream-header">
                    <h4 class="stream-title"><i class='bx bx-broadcast text-primary'></i> Live Activity Ingestion Ledger
                    </h4>
                    <span class="live-pulse-wrapper"><span class="pulse-ring"></span> Live Monitoring Stream
                        Active</span>
                </div>
                <div class="notif-feed-mount" id="notifFeedMountPoint">
                </div>
            </div>

        </div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/notifications.js') }}"></script>
</body>

</html>