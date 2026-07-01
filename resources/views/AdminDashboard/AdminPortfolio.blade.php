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

        @include('AdminDashboard.layouts.admin-sidebar')


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
                        <!-- User list will be loaded from backend -->
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