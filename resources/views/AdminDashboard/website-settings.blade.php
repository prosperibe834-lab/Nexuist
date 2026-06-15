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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/website-settings.css') }}">
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
            <li class="active">
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
                <h1 id="page-title-display">Website-Settings</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="settings-container">

            <div class="settings-header">
                <div class="header-title-block">
                    <h1>Website Configuration Matrix</h1>
                    <p>Control platform branding, core financial architecture parameters, security protocols, and
                        integration engines.</p>
                </div>
                <div class="system-status-indicator alive" id="global-status-pill">
                    <span class="pulse-dot"></span>
                    <span id="status-text">Platform Status: Live & Secure</span>
                </div>
            </div>

            <div class="settings-control-console">
                <div class="settings-search-box">
                    <i class='bx bx-search'></i>
                    <input type="text" id="settings-search"
                        placeholder="Search across configuration parameters (e.g. 2FA, ROI, SMTP)...">
                </div>
                <div class="global-action-cluster">
                    <button class="action-btn btn-secondary" id="btn-export-config">
                        <i class='bx bx-export'></i> Export Config
                    </button>
                    <button class="action-btn btn-accent" id="btn-backup-restore">
                        <i class='bx bx-data'></i> Backup System
                    </button>
                    <button class="action-btn btn-primary" id="btn-save-master">
                        <i class='bx bx-save'></i> Save Changes
                    </button>
                </div>
            </div>

            <div class="settings-grid-layout">

                <div class="settings-nav-sidebar">
                    <button class="nav-tab-btn active" data-target="general-settings">
                        <i class='bx bx-globe'></i> General Branding
                    </button>
                    <button class="nav-tab-btn" data-target="homepage-settings">
                        <i class='bx bx-layout'></i> Homepage Content
                    </button>
                    <button class="nav-tab-btn" data-target="gateway-settings">
                        <i class='bx bx-credit-card-front'></i> Gateways & Financials
                    </button>
                    <button class="nav-tab-btn" data-target="security-settings">
                        <i class='bx bx-shield-quarter'></i> Security & Compliance
                    </button>
                    <button class="nav-tab-btn" data-target="notification-settings">
                        <i class='bx bx-bell-plus'></i> Email & SMS Alerts
                    </button>
                    <button class="nav-tab-btn" data-target="investment-settings">
                        <i class='bx bx-line-chart'></i> Investment & AI Trading
                    </button>
                    <button class="nav-tab-btn" data-target="maintenance-settings">
                        <i class='bx bx-wrench'></i> Maintenance Controls
                    </button>
                    <button class="nav-tab-btn" data-target="admin-settings">
                        <i class='bx bx-user-pin'></i> Admin Access Matrix
                    </button>
                </div>

                <div class="settings-content-wrapper">

                    <div class="settings-panel active" id="general-settings">
                        <div class="panel-header">
                            <h2>General Configuration & Branding</h2>
                            <p>Modify structural data variables, support destinations, and localization constants.</p>
                        </div>
                        <div class="panel-form-grid">
                            <div class="form-group span-2">
                                <label>Website Name</label>
                                <input type="text" class="form-input" id="cfg-site-name"
                                    value="Nexuist Fintech Platform">
                            </div>
                            <div class="form-group">
                                <label>Website Logo</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="upload-logo" accept="image/*" class="file-hidden-input">
                                    <div class="upload-dropzone"
                                        onclick="document.getElementById('upload-logo').click()">
                                        <img id="preview-logo" src="#') }}" alt="Logo Preview" class="img-preview hidden">
                                        <div class="upload-placeholder"><i class='bx bx-cloud-upload'></i><span>Select
                                                Logo</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Favicon Graphic</label>
                                <div class="file-upload-wrapper">
                                    <input type="file" id="upload-favicon" accept="image/*" class="file-hidden-input">
                                    <div class="upload-dropzone"
                                        onclick="document.getElementById('upload-favicon').click()">
                                        <img id="preview-favicon" src="#') }}" alt="Favicon Preview"
                                            class="img-preview hidden">
                                        <div class="upload-placeholder"><i class='bx bx-image'></i><span>Select
                                                Favicon</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>System Support Email</label>
                                <input type="email" class="form-input validate-email" id="cfg-support-email"
                                    value="support@nexuist.io">
                            </div>
                            <div class="form-group">
                                <label>Support Phone Number</label>
                                <input type="text" class="form-input" id="cfg-support-phone" value="+1 (555) 019-2831">
                            </div>
                            <div class="form-group span-2">
                                <label>Corporate Registry Address</label>
                                <input type="text" class="form-input" id="cfg-company-address"
                                    value="100 Cyber Avenue, Suite 404, Tech City">
                            </div>
                            <div class="form-group">
                                <label>Default Ledger Currency</label>
                                <select class="form-select" id="cfg-currency">
                                    <option value="USD">USD ($) - US Dollar</option>
                                    <option value="EUR">EUR (€) - Euro</option>
                                    <option value="BTC">BTC (₿) - Bitcoin</option>
                                    <option value="GBP">GBP (£) - British Pound</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>System Localization Timezone</label>
                                <select class="form-select" id="cfg-timezone">
                                    <option value="UTC">UTC (Coordinated Universal Time)</option>
                                    <option value="EST">EST (Eastern Standard Time)</option>
                                    <option value="GMT">GMT (Greenwich Mean Time)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Primary Active Interface Language</label>
                                <select class="form-select" id="cfg-language">
                                    <option value="en">English (US)</option>
                                    <option value="es">Español</option>
                                    <option value="fr">Français</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="settings-panel" id="homepage-settings">
                        <div class="panel-header">
                            <h2>Homepage Content Engine</h2>
                            <p>Manipulate public marketing copywriting assets and displayed statistical figures.</p>
                        </div>
                        <div class="panel-form-grid">
                            <div class="form-group span-2">
                                <label>Marketing Hero Section Text Title</label>
                                <input type="text" class="form-input" id="cfg-hero-text"
                                    value="The Future of Autonomous Wealth Management and Quantitative Assets.">
                            </div>
                            <div class="form-group span-2">
                                <label>Promotion Banner Hero Image</label>
                                <div class="file-upload-wrapper row-layout">
                                    <input type="file" id="upload-banner" accept="image/*" class="file-hidden-input">
                                    <button class="action-btn btn-secondary"
                                        onclick="document.getElementById('upload-banner').click()"><i
                                            class='bx bx-upload'></i> Choose Banner File</button>
                                    <img id="preview-banner" src="#') }}" alt="Banner Preview"
                                        class="img-preview row-preview hidden">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Promotional Slides Engine</label>
                                <select class="form-select">
                                    <option value="active">Enabled (Cycle interval: 5s)</option>
                                    <option value="disabled">Disabled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Client Testimonials Control</label>
                                <select class="form-select">
                                    <option value="moderated">Show Only Admin Approved</option>
                                    <option value="all">Display All Verified Clients</option>
                                    <option value="off">Deactivate Display Block</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Featured Investment Visibility</label>
                                <select class="form-select">
                                    <option value="high-yield">Show Maximum Yield Arrays Only</option>
                                    <option value="all">Show All Tier Matrix Selections</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Homepage Live Stats Stream Mock</label>
                                <select class="form-select" id="cfg-mock-stats">
                                    <option value="real">Stream Authentic Live Balances</option>
                                    <option value="boosted">Apply Controlled Scaling Factor (+15%)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="settings-panel" id="gateway-settings">
                        <div class="panel-header">
                            <h2>Financial Gateways & Liquidity Nodes</h2>
                            <p>Configure internal asset inflow pathways, network tracking limits, and system processing
                                deductions.</p>
                        </div>
                        <div class="panel-form-grid">
                            <div class="form-group span-2">
                                <label>Corporate Secure Bitcoin (BTC) Receiver Wallet Address</label>
                                <input type="text" class="form-input font-mono" id="cfg-btc-wallet"
                                    value="bc1qxy2kgdygjrsqtzq5qqrf4x21u3zst563atgxxy">
                            </div>
                            <div class="form-group span-2">
                                <label>Corporate Settlement Bank Credentials (JSON Structured String Wire Route)</label>
                                <textarea class="form-textarea font-mono"
                                    rows="3">{"bank":"Global Tech Clearing Corp","routing":"021000021","account":"9920192831","type":"Corporate Checking"}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Deposit Gateways Allocation Status</label>
                                <div class="checkbox-toggle-wrapper">
                                    <label class="switch-primitive">
                                        <input type="checkbox" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <span>Accept Active Multi-Asset Deposits</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Withdrawal Gateway System State</label>
                                <div class="checkbox-toggle-wrapper">
                                    <label class="switch-primitive">
                                        <input type="checkbox" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <span>Allow Instant Execution Requests</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Minimum Authorized Inflow Boundary ($)</label>
                                <input type="number" class="form-input" id="cfg-min-dep" value="100">
                            </div>
                            <div class="form-group">
                                <label>Maximum Outbound Batch Extraction Limit ($)</label>
                                <input type="number" class="form-input" id="cfg-max-with" value="50000">
                            </div>
                            <div class="form-group">
                                <label>Standard Transaction Base Fee Pool (%)</label>
                                <input type="number" step="0.01" class="form-input" id="cfg-tx-charge" value="1.50">
                            </div>
                        </div>
                    </div>

                    <div class="settings-panel" id="security-settings">
                        <div class="panel-header">
                            <h2>High-Priority Security & Encryption Matrix</h2>
                            <p>Enforce threat management configurations, network access tokens, and anti-fraud filters.
                            </p>
                        </div>
                        <div class="panel-form-grid">
                            <div class="form-group">
                                <label>Force Enforce Two-Factor Authentication (2FA)</label>
                                <div class="checkbox-toggle-wrapper">
                                    <label class="switch-primitive">
                                        <input type="checkbox" id="cfg-2fa-toggle" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <span>Mandatory For All Active Admins</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Automated Real-Time AI Fraud Detection Shield</label>
                                <div class="checkbox-toggle-wrapper">
                                    <label class="switch-primitive">
                                        <input type="checkbox" id="cfg-fraud-toggle" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <span>Active Behavior Pattern Analysis</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Consecutive Failed Login Intrusion Limit</label>
                                <input type="number" class="form-input" value="3">
                            </div>
                            <div class="form-group">
                                <label>Admin Framework Session Automatic Expiry (Seconds)</label>
                                <input type="number" class="form-input" value="1800">
                            </div>
                            <div class="form-group span-2">
                                <label>Global Blacklisted Network IP Addresses (Comma Delimited Node Matrix)</label>
                                <textarea class="form-textarea font-mono" rows="2"
                                    placeholder="192.168.1.105, 45.22.11.90, 185.200.11.4"></textarea>
                            </div>
                            <div class="form-group">
                                <label>KYC Regulatory Compliance Constraints Threshold</label>
                                <select class="form-select">
                                    <option value="strict">Mandatory Verification Prior to Financial Transaction Launch
                                    </option>
                                    <option value="lenient">Verification Triggered Exclusively at Withdrawal Thresholds
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Security Breaches Notification Tier</label>
                                <select class="form-select">
                                    <option value="max">Broadcast Push, SMTP Log Engine & Critical SMS Dispatch</option>
                                    <option value="med">Internal Admin System Activity Log Collection Stream Only
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="settings-panel" id="notification-settings">
                        <div class="panel-header">
                            <h2>Communication Rails & Broadcast Templates</h2>
                            <p>Configure outbox transaction logs mail controllers and third-party SMS telephony
                                aggregators.</p>
                        </div>
                        <div class="panel-form-grid">
                            <div class="form-group">
                                <label>SMTP Relay Outbound Gateway Address</label>
                                <input type="text" class="form-input" value="smtp.mailgun.org">
                            </div>
                            <div class="form-group">
                                <label>SMTP Port Allocation Connection Wire</label>
                                <input type="number" class="form-input" value="587">
                            </div>
                            <div class="form-group span-2">
                                <label>Third-Party Integration SMS Messaging API Payload Access Token URL</label>
                                <input type="text" class="form-input font-mono"
                                    value="https://api.twilio.com/2010-04-01/Accounts/AC71892831/Messages.json">
                            </div>
                            <div class="form-group">
                                <label>User Account Registration Intercept Action</label>
                                <div class="checkbox-toggle-wrapper"><label class="switch-primitive"><input
                                            type="checkbox" checked><span
                                            class="switch-slider"></span></label><span>Alert Admin Group Channels</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deposit Notification Action Route</label>
                                <div class="checkbox-toggle-wrapper"><label class="switch-primitive"><input
                                            type="checkbox" checked><span
                                            class="switch-slider"></span></label><span>Dispatch Confirmation
                                        Alerts</span></div>
                            </div>
                            <div class="form-group">
                                <label>Withdrawal Validation Event Target</label>
                                <div class="checkbox-toggle-wrapper"><label class="switch-primitive"><input
                                            type="checkbox" checked><span
                                            class="switch-slider"></span></label><span>Require Multi-Device
                                        Broadcasts</span></div>
                            </div>
                            <div class="form-group">
                                <label>Loan Verification State Event Trigger</label>
                                <div class="checkbox-toggle-wrapper"><label class="switch-primitive"><input
                                            type="checkbox"><span class="switch-slider"></span></label><span>Automate
                                        Outbound SMS Update</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-panel" id="investment-settings">
                        <div class="panel-header">
                            <h2>Investment Matrix Analytics & Multi-Asset Engines</h2>
                            <p>Control baseline performance parameters, automated algorithms, and referral bonuses.</p>
                        </div>
                        <div class="panel-form-grid">
                            <div class="form-group">
                                <label>Quantitative Trading AI Engine Module Status</label>
                                <div class="checkbox-toggle-wrapper">
                                    <label class="switch-primitive">
                                        <input type="checkbox" id="cfg-bot-toggle" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <span>Engage Autonomous Algorithmic Execution Threads</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Global Live Multi-User Copy Trading Mirror Status</label>
                                <div class="checkbox-toggle-wrapper">
                                    <label class="switch-primitive">
                                        <input type="checkbox" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                    <span>Propagate Signal Vectors Across Client Wallets</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Base Layer Standard ROI Growth Variable Parameter (%)</label>
                                <input type="number" step="0.05" class="form-input" value="4.25">
                            </div>
                            <div class="form-group">
                                <label>Tier 1 Multi-Level Affiliate Referral Payout Bonus (%)</label>
                                <input type="number" step="0.1" class="form-input" value="8.0">
                            </div>
                            <div class="form-group span-2">
                                <label>Broker Commission Share Matrix Array Distribution Strategy</label>
                                <select class="form-select">
                                    <option value="instant">Deduct Fee Matrix Instantly at Trading Cycle Initialization
                                    </option>
                                    <option value="delayed">Process Accumulation Batches Weekly During Market Cool Off
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="settings-panel" id="maintenance-settings">
                        <div class="panel-header">
                            <h2>Platform Operational Hard Controls</h2>
                            <p>Enforce immediate public lockouts, state shifts, and system routing barriers.</p>
                        </div>
                        <div class="panel-form-grid">
                            <div class="form-group span-2">
                                <label>Platform Maintenance Mode Status</label>
                                <div class="checkbox-toggle-wrapper alert-style-toggle">
                                    <label class="switch-primitive">
                                        <input type="checkbox" id="cfg-maintenance-toggle">
                                        <span class="switch-slider alert-slider"></span>
                                    </label>
                                    <span class="warning-text-emphasis" id="lbl-maintenance-state">DEACTIVATED - Public
                                        Endpoints Fully Accessible</span>
                                </div>
                            </div>
                            <div class="form-group span-2">
                                <label>Public System Intercept Message Content</label>
                                <input type="text" class="form-input" id="cfg-maintenance-msg"
                                    value="Nexuist Core Ledger Engines are undergoing scheduled performance optimization upgrades. Operations resume shortly.">
                            </div>
                            <div class="form-group">
                                <label>Countdown Framework Timer Limit (Minutes)</label>
                                <input type="number" class="form-input" value="120">
                            </div>
                            <div class="form-group">
                                <label>Infrastructure Health Topology Vector</label>
                                <div class="status-grid-readout">
                                    <div class="readout-item"><span class="indicator-dot g"></span><span>API Nodes:
                                            100%</span></div>
                                    <div class="readout-item"><span class="indicator-dot g"></span><span>DB Cluster:
                                            Optimal</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="settings-panel" id="admin-settings">
                        <div class="panel-header">
                            <h2>Identity Access Management & Administrative Controls</h2>
                            <p>Provision privileged execution tokens, establish role-based controls, and inspect system
                                audit paths.</p>
                        </div>

                        <div class="inner-panel-action-block">
                            <h3>Provision Superuser Profile Node</h3>
                            <div class="panel-form-grid">
                                <div class="form-group">
                                    <label>Target Admin Handle Name</label>
                                    <input type="text" class="form-input" id="new-admin-user"
                                        placeholder="e.g. Chief Risk Officer">
                                </div>
                                <div class="form-group">
                                    <label>Target Operational Privilege Class Assignment</label>
                                    <select class="form-select" id="new-admin-role">
                                        <option value="super">Superuser Complete Authorization Scope</option>
                                        <option value="compliance">Compliance Risk Auditor Level 2 Only</option>
                                        <option value="support">Customer Support Execution Specialist</option>
                                    </select>
                                </div>
                                <div class="form-group span-2 align-bottom">
                                    <button class="action-btn btn-primary" id="btn-create-admin"
                                        style="width:100%; height:46px;"><i class='bx bx-user-plus'></i> Inject Profile
                                        Token Into System</button>
                                </div>
                            </div>
                        </div>

                        <div class="audit-history-panel">
                            <h3>System Access Registry History</h3>
                            <div class="log-table-inner-scroller">
                                <table class="audit-log-table">
                                    <thead>
                                        <tr>
                                            <th>Admin Handle Profile</th>
                                            <th>Assigned Role Scope</th>
                                            <th>Access Node Origin IP</th>
                                            <th>Action Path Metric Log Data</th>
                                            <th>System Clock Metric Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong style="color:var(--text-primary)">Admin #01 (Master)</strong>
                                            </td>
                                            <td><span class="badge badge-super">Superuser</span></td>
                                            <td class="font-mono">102.16.89.211</td>
                                            <td>Modified System Processing Percentage Variables [Base ROI Array]</td>
                                            <td>2026-05-26 15:41:09</td>
                                        </tr>
                                        <tr>
                                            <td><strong style="color:var(--text-primary)">Compliance_Sec_04</strong>
                                            </td>
                                            <td><span class="badge badge-audit">Auditor</span></td>
                                            <td class="font-mono">198.220.10.45</td>
                                            <td>Authorized Internal Wallet Transfer Asset Pipeline Override ID #9021
                                            </td>
                                            <td>2026-05-26 14:10:22</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </main>

    <script src="{{ asset('assets/AdminDashboard/js/website-settings.js') }}"></script>
</body>

</html>