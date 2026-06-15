<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/demoLive.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>


    <div id="fintech-preloader">
        <div class="loader-container">
            <div class="loader-logo">
                <div class="logo-hexagon">
                    <span class="iconify" data-icon="ri:shield-flash-line"></span>
                </div>
                <h2 class="loader-brand-name">Nexuist</h2>
            </div>

            <div class="loader-progress-wrapper">
                <div class="loader-progress-bar" id="load-bar">
                    <div class="shimmer-effect"></div>
                </div>
            </div>

            <div class="loader-status">
                <span class="status-dot"></span>
                <p id="status-text">Initializing encrypted connection...</p>
            </div>
        </div>

        <div class="glow glow-1"></div>
        <div class="glow glow-2"></div>
    </div>
    <!-- Preloader ends here -->

    <header class="top-header">
        <div class="header-left">
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <span class="iconify" data-icon="ri:menu-line"></span>
            </button>
            <a href="/" class="logo-area">
                <img src="{{ asset('assets/Frontend/image/mylog.jpeg') }}" alt="Nexuist Logo" class="logo-img">
                <div class="logo-text">
                    <h2>Nexuist</h2>
                    <p>Professional Trading</p>
                </div>
            </a>

            <div class="crypto-ticker desktop-only">
                <span class="live-indicator"><span class="dot"></span> LIVE</span>
                <span class="ticker-item">BTC: <strong class="red">$80,898</strong></span>
                <span class="ticker-item">ETH: <strong class="red">$2,329</strong></span>
            </div>
        </div>

        <div class="header-right">
            <div class="top-balance-box desktop-only">
                <span class="balance-label">ACCOUNT BALANCE</span>
                <span class="balance-value">$0.00</span>
            </div>

            <div class="header-actions">

                <div class="qt-dropdown-wrapper">

                    <button class="qt-dropdown-btn" id="qtDropdownBtn">

                        <div class="qt-user-details">
                            <span class="qt-user-title">Quick Trade</span>
                            <small class="qt-user-sub">Trading Panel</small>
                        </div>

                        <span class="iconify qt-arrow-icon" data-icon="solar:alt-arrow-down-outline"></span>

                    </button>

                    <div class="qt-dropdown-menu" id="qtDropdownMenu">

                        <a href="#" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:wallet-money-outline"></span>
                            <span>Deposit Funds</span>
                        </a>

                        <a href="#" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:card-send-outline"></span>
                            <span>Withdraw Funds</span>
                        </a>

                        <a href="#" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:chart-square-outline"></span>
                            <span>Trade Markets</span>
                        </a>


                    </div>

                </div>

                <div class="notification-wrapper">
                    <button class="icon-btn" id="notifBtn">
                        <span class="iconify" data-icon="ri:notification-3-line"></span>
                        <span class="badge red-badge">4</span>
                    </button>
                    <div class="dropdown-menu notif-menu" id="notifMenu">
                        <div class="menu-header">Notifications</div>
                        <a href="#" class="menu-item">System update complete</a>
                        <a href="#" class="menu-item">Check new live markets</a>
                    </div>
                </div>



                <div class="user-profile">
                    <button class="profile-btn" id="profileBtn">
                        <div class="avatar">M</div>
                        <div class="user-info desktop-only">
                            <span class="name">marine military</span>
                            <span class="type">Trading Account</span>
                        </div>
                        <span class="iconify arrow desktop-only" data-icon="ri:arrow-down-s-line"></span>
                    </button>
                    <div class="dropdown-menu profile-menu" id="profileMenu">
                        <a href="#" class="menu-item"><span class="iconify" data-icon="ri:user-line"></span> My
                            Profile</a>
                        <a href="#" class="menu-item"><span class="iconify" data-icon="ri:settings-4-line"></span>
                            Settings</a>
                        <a href="#" class="menu-item text-red"><span class="iconify"
                                data-icon="ri:logout-box-r-line"></span> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <span>LIVE MARKET</span>
                <span class="live-tag"><span class="dot green-dot"></span> LIVE</span>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:layout-grid-line"></span> OVERVIEW</h3>
                    <a href="/" class="nav-item">
                        <span class="iconify" data-icon="solar:widget-2-outline"></span>
                        Dashboard
                    </a>
                    <a href="/accountstatement" class="nav-item">
                        <span class="iconify" data-icon="ri:file-list-3-line"></span> Account Statement
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:briefcase-line"></span> PORTFOLIO &
                        INVESTMENTS</h3>
                    <div class="nav-dropdown-container">
                        <a href="#" class="nav-item has-dropdown" id="investPlansBtn">
                            <div class="item-left">
                                <span class="iconify" data-icon="ri:focus-3-line"></span> Investment Plans
                            </div>
                            <span class="iconify arrow" data-icon="ri:arrow-down-s-line"></span>
                        </a>
                        <div class="sidebar-submenu" id="investPlansMenu">

                            <a href="plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:layers-outline"></span>
                                All Plans
                            </a>

                            <a href="active-plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:chart-square-outline"></span>
                                Stock Market
                            </a>

                            <a href="active-plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="mdi:currency-btc"></span>
                                Crypto Investment
                            </a>

                            <a href="active-plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:buildings-2-outline"></span>
                                Real Estate
                            </a>

                        </div>
                    </div>
                    <a href="/portfolio" class="nav-item">
                        <span class="iconify" data-icon="ri:pie-chart-line"></span> My Portfolio
                    </a>
                    <a href="/performance" class="nav-item">
                        <span class="iconify" data-icon="ri:line-chart-line"></span> Performance History
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:stock-line"></span> TRADING & MARKETS</h3>
                    <a href="/demo" class="nav-item active">
                        <div class="item-left"><span class="iconify" data-icon="ri:graduation-cap-line"></span> Demo
                            Trading</div>
                        <span class="badge outline-green">Practice</span>
                    </a>
                    <a href="/livemarkets" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:bar-chart-box-line"></span> Live
                            Markets</div>
                        <span class="badge solid-red"><span class="dot"></span> Live</span>
                    </a>
                    <a href="copy.html" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:user-follow-line"></span> Copy
                            Trading</div>
                        <span class="badge solid-purple">Pro</span>
                    </a>
                    <a href="ai.html" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:robot-2-line"></span> AI Trading Bots
                        </div>
                        <span class="badge solid-blue">AI</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:radar-line"></span> MARKET INTELLIGENCE
                    </h3>
                    <a href="signals.html" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:flashlight-fill"></span> Premium
                            Signals</div>
                        <span class="badge solid-orange">Premium</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:wallet-3-line"></span> WALLET & FUNDS</h3>
                    <a href="/deposit" class="nav-item">
                        <span class="iconify" data-icon="ri:add-circle-line"></span> Deposit Funds
                    </a>
                    <a href="/withdraw" class="nav-item">
                        <span class="iconify" data-icon="solar:card-send-outline"></span>
                        Withdraw Funds
                    </a>
                    <a href="/transfer" class="nav-item">
                        <span class="iconify" data-icon="ri:arrow-left-right-line"></span> Internal Transfer
                    </a>
                </div>

                <div class="acm-section">

                    <h3 class="acm-title">
                        <span class="iconify" data-icon="solar:shield-user-outline"></span>
                        Account Management
                    </h3>

                    <!-- DROPDOWN -->
                    <div class="acm-dropdown-wrap">

                        <button class="acm-dropdown-btn" id="acmVerifyBtn">

                            <div class="acm-btn-left">
                                <span class="iconify acm-main-icon" data-icon="solar:user-id-outline"></span>

                                <span>Identity Verification</span>
                            </div>

                            <span class="iconify acm-arrow" data-icon="solar:alt-arrow-down-outline"></span>

                        </button>

                        <!-- SUBMENU -->
                        <div class="acm-dropdown-menu" id="acmVerifyMenu">

                            <div class="acm-info-box">

                                <span class="iconify acm-info-icon" data-icon="solar:verified-check-outline"></span>

                                <div class="acm-info-text">
                                    <h4>Identity Verification</h4>

                                    <p>
                                        Complete your identity verification to unlock
                                        full trading and withdrawal features.
                                    </p>
                                </div>

                            </div>

                            <a href="verification.html" class="acm-verify-link">

                                <span class="iconify" data-icon="solar:shield-check-outline"></span>

                                Verify Identity

                            </a>

                        </div>

                    </div>



                    <!-- PROFILE SETTINGS -->
                    <a href="/portfolio" class="acm-nav-link">

                        <span class="iconify" data-icon="solar:settings-outline"></span>

                        Profile Settings

                    </a>

                </div>

                <div class="nav-section">
                    <h3 class="nav-title">
                        <span class="iconify" data-icon="solar:gift-outline"></span>
                        Growth & Rewards
                    </h3>

                    <a href="signals.html" class="nav-item">
                        <div class="item-left">
                            <span class="iconify" data-icon="solar:users-group-rounded-outline"></span>
                            Referral Program
                        </div>

                        <span class="badge solid-orange">5%</span>
                    </a>
                </div>
                <div class="nav-section">
                    <h3 class="nav-title">
                        <span class="iconify" data-icon="solar:headphones-round-sound-outline"></span>
                        Support Center
                    </h3>

                    <a href="signals.html" class="nav-item">
                        <div class="item-left">
                            <span class="iconify" data-icon="solar:chat-round-dots-outline"></span>
                            Support Center
                        </div>
                    </a>
                </div>

            </nav>

            <div class="sidebar-footer">

                <a href="credit.html" class="apply-credit">
                    <span class="iconify" data-icon="ri:add-box-line"></span> Apply for Credit
                    <span class="badge solid-green">Fast</span>
                </a>
            </div>

            <div class="contact-wrapper">

                <a href="contact.html" class="contact-btn">

                    <span class="iconify contact-icon" data-icon="solar:phone-calling-outline"></span>

                    <span>Contact Support</span>

                </a>

            </div>

            <div class="logout-wrapper">

                <a href="/explore" class="logout-btn">

                    <span class="iconify logout-icon" data-icon="solar:logout-2-outline"></span>

                    <span>Log Out</span>

                </a>

            </div>
        </aside>

        <!-- Main Content -->
        <main class="investment-container">
            <div id="marketsDashboardView">
                <header class="terminal-header">
                    <div class="terminal-title">
                        <span class="badge-sandbox"><i class="bx bx-globe"></i> Live Institutional Feed</span>
                        <h1>Trading Markets</h1>
                        <p>Monitor real-time price discovery loops and execute high-fidelity order flows.</p>
                    </div>
                    <div class="search-input-wrapper">
                        <i class="bx bx-search search-left-icon"></i>
                        <input type="text" id="marketSearchInput" placeholder="Search instruments by symbol or name...">
                    </div>
                </header>

                <div class="category-filter-deck">
                    <button class="filter-tab is-active" data-category="all"><i class="bx bx-grid-alt"></i> All
                        Markets</button>
                    <button class="filter-tab" data-category="crypto"><i class="bx bx-bitcoin"></i>
                        Cryptocurrency</button>
                    <button class="filter-tab" data-category="stocks"><i class="bx bx-trending-up"></i> Stocks</button>
                    <button class="filter-tab" data-category="forex"><i class="bx bx-dollar"></i> Forex</button>
                    <button class="filter-tab" data-category="commodities"><i class="bx bx-gold"></i>
                        Commodities</button>
                    <button class="filter-tab" data-category="bonds"><i class="bx bx-file"></i> Bonds</button>
                </div>

                <div class="market-table-container">
                    <table class="fintech-market-table">
                        <thead>
                            <tr>
                                <th>Asset Name</th>
                                <th>Live Spot Price</th>
                                <th>24h Change</th>
                                <th>Market Dynamic Cap</th>
                                <th class="text-right">Action Vector</th>
                            </tr>
                        </thead>
                        <tbody id="marketTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tradingTerminalView" class="hidden-view">
                <header class="terminal-back-bar">
                    <button id="closeTerminalBtn" class="back-link-btn"><i class="bx bx-arrow-back"></i> Back to Live
                        Markets</button>
                </header>

                <div class="terminal-workspace-layout">
                    <div class="terminal-left-column">
                        <div class="asset-ticker-banner">
                            <div class="ticker-identity">
                                <div class="ticker-avatar" id="termAssetIcon"><i class="bx bx-coin-stack"></i></div>
                                <div>
                                    <h2 id="termAssetName">Bitcoin</h2>
                                    <span id="termAssetSymbol">BTC/USD</span>
                                </div>
                            </div>
                            <div class="ticker-pricing text-right">
                                <h2 id="termAssetPrice">$71,438.00</h2>
                                <span id="termAssetChange" class="change-pos">+1.38%</span>
                            </div>
                        </div>

                        <div class="technical-chart-box">
                            <div id="tradingview_live_chart_element" style="width: 100%; height: 100%;"></div>
                        </div>

                        <div class="market-statistics-panel">
                            <div class="stat-capsule">
                                <span class="cap-lbl">24h High</span>
                                <span class="cap-val text-green" id="termStatHigh">$72,100.00</span>
                            </div>
                            <div class="stat-capsule">
                                <span class="cap-lbl">24h Low</span>
                                <span class="cap-val text-red" id="termStatLow">$70,250.00</span>
                            </div>
                            <div class="stat-capsule">
                                <span class="cap-lbl">24h Volume</span>
                                <span class="cap-val" id="termStatVolume">$24.8B</span>
                            </div>
                            <div class="stat-capsule">
                                <span class="cap-lbl">Market Cap</span>
                                <span class="cap-val" id="termStatCap">$1.4T</span>
                            </div>
                        </div>
                    </div>

                    <div class="terminal-panel order-execution-panel">
                        <h3 class="panel-heading"><i class="bx bx-transfer-alt"></i> Route Position Order</h3>

                        <div class="order-type-tabs">
                            <button type="button" class="order-dir-btn btn-buy active" id="terminalBuyTab">Buy /
                                Long</button>
                            <button type="button" class="order-dir-btn btn-sell" id="terminalSellTab">Sell /
                                Short</button>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Order Routing Protocol</label>
                            <div class="select-input-wrapper">
                                <select class="custom-select-field no-arrow-icon">
                                    <option>Market Execution (Instant Sync)</option>
                                    <option>Limit Order Array Protocol</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Leverage Multiplier Bracket</label>
                            <div class="select-input-wrapper">
                                <select class="custom-select-field no-arrow-icon" id="termLeverageSelector">
                                    <option value="1">1x (Spot Margin Isolated)</option>
                                    <option value="5">5x Allocation Multiplier</option>
                                    <option value="10">10x Balanced Execution Bracket</option>
                                    <option value="20">20x High Velocity Loop Risk</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Investment Principal Amount</label>
                            <div class="input-addon-container">
                                <span class="addon-prefix">$</span>
                                <input type="number" class="matrix-number-input" id="termAmountInput" min="5"
                                    placeholder="0.00" value="100">
                            </div>
                        </div>

                        <div class="quick-allocation-deck">
                            <button type="button" class="quick-amt-node" data-value="100">$100</button>
                            <button type="button" class="quick-amt-node" data-value="500">$500</button>
                            <button type="button" class="quick-amt-node" data-value="1000">$1,000</button>
                            <button type="button" class="quick-amt-node" data-value="5000">$5,000</button>
                        </div>

                        <div class="ticket-summary-card">
                            <div class="ticket-row">
                                <span class="t-lbl">Notional Multiplied Volume</span>
                                <span class="t-val" id="termSummaryNotional">$100.00</span>
                            </div>
                            <div class="ticket-row">
                                <span class="t-lbl">Contract Estimated Units</span>
                                <span class="t-val" id="termSummaryUnits">0.0014 units</span>
                            </div>
                        </div>

                        <button type="button" class="execute-order-btn" id="terminalFinalSubmitBtn">
                            Confirm & Transmit Order
                        </button>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <script src="{{ asset('assets/Frontend/js/demoLive.js') }}"></script>
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js') }}"></script>
</body>

</html>