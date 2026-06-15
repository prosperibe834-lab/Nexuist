<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/kyc.css') }}">
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
            <li class="active">
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
                <h1 id="page-title-display">Kyc</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="kyc-dashboard-wrapper">
            <div class="kyc-header mb-4 animate-fade-in">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="kyc-badge-icon">
                        <i class='bx bx-shield-quarter'></i>
                    </div>
                    <h1 class="kyc-title">KYC & Identity Compliance Vault</h1>
                </div>
                <p class="kyc-subtitle">Review incoming investor verification documents, evaluate risk frameworks, and
                    update processing states.</p>
            </div>

            <div class="kyc-layout-grid">

                <div class="kyc-users-sidebar animate-slide-up">
                    <div class="search-box-container mb-3">
                        <i class='bx bx-search search-icon'></i>
                        <input type="text" id="userSearchInput" class="kyc-search-input"
                            placeholder="Filter by user ID or name..." oninput="filterUserQueue()">
                    </div>

                    <div class="users-queue-list" id="usersQueueContainer">
                    </div>
                </div>

                <div class="kyc-vault-panel animate-slide-up" id="complianceDetailVault">
                    <div class="vault-empty-state text-center py-5">
                        <i class='bx bx-user-check text-muted mb-3' style="font-size: 4rem;"></i>
                        <h4>Select an Investor Profile</h4>
                        <p class="text-secondary small">Choose an applicant from the ingestion queue stream to inspect
                            uploaded identity credentials and process compliance status.</p>
                    </div>
                </div>

            </div>
        </div>
    </main>

<div id="kyc-data" style="display:none;">
    {!! json_encode($kycs) !!}
</div>

    <script src="{{ asset('assets/AdminDashboard/js/kyc.js') }}"></script>

</body>

</html>