<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/demoTrade.css') }}">
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
                    <span class="balance-label">DEMO BALANCE</span>
                    <span class="balance-value" id="demoBalanceDisplay">${{ number_format(Auth::user()->demo_balance ?? 0, 2) }}</span>
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
                        {{-- Avatar shows first letter of name --}}
                        <div class="avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <div class="user-info desktop-only">
                            <span class="name">{{ Auth::user()->name }}</span>
                            <span class="type">Trading Account</span>
                        </div>
                        <span class="iconify arrow desktop-only" data-icon="ri:arrow-down-s-line"></span>
                    </button>

                    <div class="dropdown-menu profile-menu" id="profileMenu">
                        <a href="/profilesetting" class="menu-item"><span class="iconify"
                                data-icon="ri:user-line"></span> My
                            Profile</a>
                        <a href="#" class="menu-item"><span class="iconify" data-icon="ri:settings-4-line"></span>
                            Settings</a>
                        <a href="#" class="menu-item text-red"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="iconify" data-icon="ri:logout-box-r-line"></span>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
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
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn"
                        style="background: none; border: none; cursor: pointer; display: flex; align-items: center; width: 100%;">
                        <i class='bx bx-log-out'></i>
                        <span style="margin-left: 8px;">Log Out</span>
                    </button>
                </form>
</div>
        </aside>

        <!-- Main Content -->
        <main class="investment-container">
            <header class="terminal-header">
                <div class="terminal-title">
                    <span class="badge-sandbox"><i class="bx bx-terminal"></i> Sandbox Environment</span>
                    <h1>Execute Virtual Trade</h1>
                    <p>Deploy hypothetical configurations to real-time market order-flow simulation paths.</p>
                </div>
                <div class="terminal-balance-capsule">
                    <div class="capsule-label">Available Balance</div>
                    <div class="capsule-value" id="terminalAvailableBalance">${{ number_format(Auth::user()->demo_balance ?? 0, 2) }}</div>
                </div>
            </header>

            <div class="terminal-grid">

                <form class="terminal-panel order-form" id="demoTradeForm" onsubmit="event.preventDefault();">
                    <h3 class="panel-heading"><i class="bx bx-slider-alt"></i> Position Parameters</h3>

                    <div class="form-group-row">
                        <label class="field-label">Select Active Instrument <span class="required">*</span></label>
                        <div class="select-input-wrapper">
                            <i class="bx bx-search-alt-2 select-left-icon"></i>
                            <select class="custom-select-field" id="assetSelector" required>
                                <option value="" disabled selected>Choose an asset to trade...</option>
                                <option value="BTC" data-price="67450">BTC / USD (Bitcoin)</option>
                                <option value="ETH" data-price="3480">ETH / USD (Ethereum)</option>
                                <option value="AAPL" data-price="185">AAPL (Apple Inc. Equity)</option>
                                <option value="NVDA" data-price="875">NVDA (NVIDIA Corporation)</option>
                                <option value="EURUSD" data-price="1.08">EUR / USD (Euro / US Dollar)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-row">
                        <label class="field-label">Execution Vector Direction <span class="required">*</span></label>
                        <div class="direction-toggle-deck">
                            <button type="button" class="direction-node node-buy" data-direction="BUY">
                                <div class="node-indicator-ring"><i class="bx bx-trending-up"></i></div>
                                <div class="node-meta">
                                    <span class="action-heading">BUY / LONG</span>
                                    <span class="action-sub">Speculate Price Appreciates</span>
                                </div>
                            </button>

                            <button type="button" class="direction-node node-sell" data-direction="SELL">
                                <div class="node-indicator-ring"><i class="bx bx-trending-down"></i></div>
                                <div class="node-meta">
                                    <span class="action-heading">SELL / SHORT</span>
                                    <span class="action-sub">Speculate Price Depreciates</span>
                                </div>
                            </button>
                        </div>
                        <input type="hidden" id="tradeDirectionInput" required>
                    </div>

                    <div class="allocation-matrix-grid">
                        <div class="form-group-row">
                            <label class="field-label">Investment Principal <span class="required">*</span></label>
                            <div class="input-addon-container">
                                <span class="addon-prefix">$</span>
                                <input type="number" class="matrix-number-input" id="tradeAmountInput" min="10"
                                    max="100000" placeholder="0.00" required>
                            </div>
                            <span class="input-hint-caption">Max Allowed Allocation: <span
                                    id="maxLabel">$100,000.00</span></span>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Leverage Multiplier <span class="required">*</span></label>
                            <div class="select-input-wrapper">
                                <i class="bx bx-shield-quarter select-left-icon"></i>
                                <select class="custom-select-field" id="leverageSelector" required>
                                    <option value="1">1x (Spot / No Leverage)</option>
                                    <option value="5">5x (Conservative Leverage)</option>
                                    <option value="10">10x (Balanced Leverage)</option>
                                    <option value="20">20x (Advanced Core Risk)</option>
                                    <option value="50">50x (Max High-Volatility Loop)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-row">
                        <label class="field-label">Contract Execution Window <span class="required">*</span></label>
                        <div class="select-input-wrapper">
                            <i class="bx bx-time-five select-left-icon"></i>
                            <select class="custom-select-field" id="durationSelector" required>
                                <option value="5">5 Minutes Contract Loop</option>
                                <option value="15">15 Minutes Contract Loop</option>
                                <option value="60">1 Hour Automated Expiry</option>
                                <option value="1440">24 Hours Standard Cycle</option>
                            </select>
                        </div>
                    </div>

                    <div class="ticket-summary-card">
                        <div class="ticket-header">
                            <span><i class="bx bx-receipt"></i> Pre-Execution Ticket</span>
                            <span class="ticker-live-dot" id="summaryAsset">ASSET: NONE</span>
                        </div>
                        <div class="ticket-body">
                            <div class="ticket-row">
                                <span class="t-lbl">Notional Position Value</span>
                                <span class="t-val" id="summaryNotionalValue">$0.00</span>
                            </div>
                            <div class="ticket-row">
                                <span class="t-lbl">Calculated Maximum System Risk</span>
                                <span class="t-val risk-alert-color" id="summaryMaxRisk">$0.00</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="execute-order-btn" id="submitOrderBtn">
                        <i class="bx bx-play-circle"></i> Transmit Order to Sandbox
                    </button>
                </form>

                <div class="terminal-side-deck">

                    <div class="terminal-panel tips-panel">
                        <h4 class="side-panel-heading"><i class="bx bx-bulb text-yellow"></i> Architecture Intelligence
                        </h4>
                        <ul class="fintech-bullet-list">
                            <li>
                                <div class="bullet-indicator dot-blue"></div>
                                <div class="bullet-content">
                                    <h6>Risk Exposure Mitigation</h6>
                                    <p>Never lock more than 5% of aggregate liquidity arrays into singular order
                                        structures, even inside isolated demo environments.</p>
                                </div>
                            </li>
                            <li>
                                <div class="bullet-indicator dot-green"></div>
                                <div class="bullet-content">
                                    <h6>Fractional Incremental Calibration</h6>
                                    <p>Scale initial operations utilizing conservative multiplier metrics to map
                                        real-time performance profiles without liquidity slippage.</p>
                                </div>
                            </li>
                            <li>
                                <div class="bullet-indicator dot-yellow"></div>
                                <div class="bullet-content">
                                    <h6>Leverage Isolation Warnings</h6>
                                    <p>Elevated multipliers scale net distributions linearly but compress absolute
                                        liquidity distances from potential liquidation limits.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="terminal-panel micro-account-panel">
                        <h4 class="side-panel-heading"><i class="bx bx-user-circle"></i> Sandbox Identity Parameters
                        </h4>
                        <div class="meta-profile-strip">
                            <span class="meta-lbl">Account Routing Mode</span>
                            <span class="meta-val mode-badge-demo">DEMO ACTIVE</span>
                        </div>
                        <div class="meta-profile-strip">
                            <span class="meta-lbl">Base Operating Currency</span>
                            <span class="meta-val">USD ($)</span>
                        </div>

                        <button type="button" class="terminal-reset-btn" id="terminalResetBtn">
                            <i class="bx bx-refresh"></i> Reset Simulator Matrix
                        </button>
                    </div>
                </div>

            </div>
        </main>

    </div>

    <script src="{{ asset('assets/Frontend/js/demoTrade.js') }}"></script>
</body>

</html>