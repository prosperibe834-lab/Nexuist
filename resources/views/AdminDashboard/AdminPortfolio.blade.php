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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/portfolio.css') }}">
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
            <li class="active">
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
                <h1 id="page-title-display">Portfolio Analytics</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nx-hub-container nx-hub-animate-fade-in">

            <div class="nx-hub-header">
                <div class="nx-hub-title-block">
                    <h2><i class='bx bx-group'></i> Investor Profile Management</h2>
                    <p class="nx-hub-subtitle">Select individual user nodes to inspect their identity credentials,
                        platform deposits, active investments, and PnL metrics.</p>
                </div>
            </div>

            <div class="nx-hub-layout">

                <div class="nx-hub-sidebar">
                    <div class="nx-hub-search-wrapper">
                        <i class='bx bx-search search-icon-input'></i>
                        <input type="text" placeholder="Search user by UID, name..." id="user-hub-search">
                    </div>

                    <div class="nx-hub-user-list" id="hub-user-nodes-container">
                        <div class="nx-hub-user-card active-hub-node" data-uid="#NEX-10942" data-name="Alexander Mercer"
                            data-email="a.mercer@nexus.io" data-net-worth="$15,420.50" data-pending-deposit="$5,000.00"
                            data-total-invested="$10,420.50" data-roi="+34.82%" data-win-rate="78.4%"
                            data-profit-factor="2.41" data-investment-pool="BTC Core Mirror & ETH Scalper"
                            data-txid="TXN-90812401" data-tx-gateway="Crypto (BTC)" data-tx-amount="$5,000.00"
                            data-tx-date="2026-05-24 14:32" data-tx-status="Pending">
                            <div class="hub-avatar bg-gradient-blue">AM</div>
                            <div class="hub-user-meta">
                                <strong class="hub-user-name">Alexander Mercer</strong>
                                <span class="hub-user-uid">UID: #NEX-10942</span>
                                <span class="hub-user-balance">Net Capital: $15,420.50</span>
                            </div>
                        </div>

                        <div class="nx-hub-user-card" data-uid="#NEX-20481" data-name="Amara Kalu"
                            data-email="amara.k@domain.com" data-net-worth="$48,920.00" data-pending-deposit="$0.00"
                            data-total-invested="$48,920.00" data-roi="+42.10%" data-win-rate="81.2%"
                            data-profit-factor="3.05" data-investment-pool="Solana Delta Volatility Pool"
                            data-txid="TXN-90761102" data-tx-gateway="Crypto (USDT)" data-tx-amount="$12,000.00"
                            data-tx-date="2026-05-20 09:15" data-tx-status="Successful">
                            <div class="hub-avatar bg-gradient-purple">AK</div>
                            <div class="hub-user-meta">
                                <strong class="hub-user-name">Amara Kalu</strong>
                                <span class="hub-user-uid">UID: #NEX-20481</span>
                                <span class="hub-user-balance">Net Capital: $48,920.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nx-hub-main-workspace">

                    <div class="nx-hub-profile-banner">
                        <div class="profile-banner-identity">
                            <span class="banner-eyebrow">INSPECTING ACCOUNT PROFILE</span>
                            <h3 id="dyn-user-name">Alexander Mercer</h3>
                            <p><span id="dyn-user-uid">UID: #NEX-10942</span> • <span
                                    id="dyn-user-email">a.mercer@nexus.io</span></p>
                        </div>

                        <div class="profile-banner-actions">
                            <button class="btn-hub-action secondary"><i class='bx bx-envelope'></i> Message</button>
                            <button class="btn-hub-action danger"><i class='bx bx-block'></i> Suspend</button>
                        </div>

                    </div>

                    <div class="nx-hub-metrics-grid">
                        <div class="nx-hub-stat-card">
                            <div class="stat-card-header"><span>NET PLATFORM CAPITAL</span><i class='bx bx-wallet'></i>
                            </div>
                            <h2 id="dyn-net-worth">$15,420.50</h2>
                        </div>
                        <div class="nx-hub-stat-card warning-glow">
                            <div class="stat-card-header"><span>PENDING DEPOSITS VOLUME</span><i
                                    class='bx bx-time-five'></i></div>
                            <h2 id="dyn-pending-deposit">$5,000.00</h2>
                        </div>
                        <div class="nx-hub-stat-card success-glow">
                            <div class="stat-card-header"><span>TOTAL INVESTED POOLS</span><i class='bx bx-chart'></i>
                            </div>
                            <h2 id="dyn-total-invested">$10,420.50</h2>
                        </div>
                    </div>

                    <div class="nx-hub-details-split">

                        <div class="nx-hub-panel">
                            <div class="panel-header-block">
                                <h3><i class='bx bx-trending-up'></i> User Performance Analytics</h3>
                            </div>
                            <div class="portfolio-active-pool-box">
                                <span class="pool-tag">Active Strategy Allocation</span>
                                <h4 id="dyn-investment-pool">BTC Core Mirror & ETH Scalper</h4>

                                <div class="pool-stats-row">
                                    <div>
                                        <span>Net Account ROI</span>
                                        <strong class="txt-green" id="dyn-roi">+34.82%</strong>
                                    </div>
                                    <div>
                                        <span>Win Rate Complexity</span>
                                        <strong id="dyn-win-rate">78.4%</strong>
                                    </div>
                                    <div>
                                        <span>Profit Factor Ratio</span>
                                        <strong id="dyn-profit-factor" class="txt-purple">2.41</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nx-hub-panel">
                            <div class="panel-header-block">
                                <h3><i class='bx bx-receipt'></i> User Deposit Pipeline Records</h3>
                            </div>
                            <div class="nx-hub-table-wrapper">
                                <table class="nx-hub-table">
                                    <thead>
                                        <tr>
                                            <th>Transaction Hash / ID</th>
                                            <th>Funding Gateway</th>
                                            <th>Deposit Amount</th>
                                            <th>Submission Timestamp</th>
                                            <th>Verification State</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code id="dyn-txid" class="code-hash">TXN-90812401</code></td>
                                            <td><span id="dyn-tx-gateway" class="gateway-cell"><i
                                                        class='bx bxl-bitcoin'></i> Crypto (BTC)</span></td>
                                            <td><strong id="dyn-tx-amount" class="txt-amount">$5,000.00</strong></td>
                                            <td id="dyn-tx-date" class="txt-time">2026-05-24 14:32</td>
                                            <td><span id="dyn-tx-status"
                                                    class="status-pill state-pending">Pending</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="hub-message-modal" class="hub-modal-overlay" style="display: none;">
                            <div class="hub-modal-content">
                                <h3><i class='bx bx-envelope'></i> Send Direct Message to <span
                                        id="modal-msg-username">User</span></h3>
                                <textarea id="hub-message-text"
                                    placeholder="Type your administration or verification message here..."></textarea>
                                <div class="modal-actions-row">
                                    <button id="close-msg-modal" class="btn-modal-cancel">Cancel</button>
                                    <button id="send-msg-submit" class="btn-modal-confirm success">Send Message</button>
                                </div>
                            </div>
                        </div>

                        <div id="hub-suspend-modal" class="hub-modal-overlay" style="display: none;">
                            <div class="hub-modal-content">
                                <h3><i class='bx bx-error-circle'></i> Restrict Account Privileges?</h3>
                                <p>Are you sure you want to suspend <strong id="modal-susp-username">User</strong>? This
                                    will freeze their portfolio growth and lock their asset withdrawals.</p>
                                <div class="modal-actions-row">
                                    <button id="close-susp-modal" class="btn-modal-cancel">Cancel Account</button>
                                    <button id="confirm-susp-submit" class="btn-modal-confirm danger">Confirm
                                        Suspension</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/portfolio.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
</body>

</html>