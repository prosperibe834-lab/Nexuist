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
            <li class="active">
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