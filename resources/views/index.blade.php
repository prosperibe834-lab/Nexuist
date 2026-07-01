<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
                <span class="ticker-item">BTC: <strong class="red" id="btc-price">$80,898</strong></span>
                <span class="ticker-item">ETH: <strong class="red" id="eth-price">$2,329</strong></span>
            </div>
        </div>

        <div class="header-right">
            <div class="top-balance-box desktop-only">
                <span class="balance-label">ACCOUNT BALANCE</span>

                <span class="balance-value"> ${{ number_format(Auth::user()->balance, 2) }}

                </span>
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

                        <a href="/depositfunds" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:wallet-money-outline"></span>
                            <span>Deposit Funds</span>
                        </a>

                        <a href="/withdraw" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:card-send-outline"></span>
                            <span>Withdraw Funds</span>
                        </a>

                        <a href="/livemarkets" class="qt-dropdown-item">
                            <span class="iconify qt-menu-icon" data-icon="solar:chart-square-outline"></span>
                            <span>Trade Markets</span>
                        </a>


                    </div>

                </div>

                <div class="notification-wrapper">
                    <button class="icon-btn" id="notifBtn">
                        <span class="iconify" data-icon="ri:notification-3-line"></span>
                        <span class="badge red-badge" id="notification-count">{{ $unreadCount ?? 0 }}</span>
                    </button>
                    <div class="dropdown-menu notif-menu" id="notifMenu">
                        <div class="menu-header">Notifications</div>
                        <a href="/notification" class="menu-item">View all notifications</a>
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
                        <a href="/verify-account" class="menu-item"><span class="iconify"
                                data-icon="ri:settings-4-line"></span>
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
                    <a href="/" class="nav-item active">
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
                        <a href="" class="nav-item has-dropdown" id="investPlansBtn">
                            <div class="item-left">
                                <span class="iconify" data-icon="ri:focus-3-line"></span> Investment Plans
                            </div>
                            <span class="iconify arrow" data-icon="ri:arrow-down-s-line"></span>
                        </a>
                        <div class="sidebar-submenu" id="investPlansMenu">

                            <!-- <a href="plans.html" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:layers-outline"></span>
                                All Plans
                            </a> -->

                            <a href="/stockMarket" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:chart-square-outline"></span>
                                Stock Market
                            </a>

                            <a href="/cryptoInvest" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="mdi:currency-btc"></span>
                                Crypto Investment
                            </a>

                            <a href="/realestate" class="nav-item sub-item">
                                <span class="iconify submenu-icon" data-icon="solar:buildings-2-outline"></span>
                                Real Estate
                            </a>

                        </div>
                    </div>
                    <a href="/portfolio" class="nav-item">
                        <span class="iconify" data-icon="ri:pie-chart-line"></span> My Portfolio
                    </a>
                    <!-- <a href="/performance" class="nav-item">
                        <span class="iconify" data-icon="ri:line-chart-line"></span> Performance History
                    </a> -->
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:stock-line"></span> TRADING & MARKETS</h3>
                    <a href="/demo" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:graduation-cap-line"></span> Demo
                            Trading</div>
                        <span class="badge outline-green">Practice</span>
                    </a>
                    <a href="/livemarkets" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:bar-chart-box-line"></span> Live
                            Markets</div>
                        <span class="badge solid-red"><span class="dot"></span> Live</span>
                    </a>
                    <a href="/copytrading" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:user-follow-line"></span> Copy
                            Trading</div>
                        <span class="badge solid-purple">Pro</span>
                    </a>
                    <a href="/botTrading" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:robot-2-line"></span> AI Trading Bots
                        </div>
                        <span class="badge solid-blue">AI</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:radar-line"></span> MARKET INTELLIGENCE
                    </h3>
                    <a href="/premiumSignals" class="nav-item">
                        <div class="item-left"><span class="iconify" data-icon="ri:flashlight-fill"></span> Premium
                            Signals</div>
                        <span class="badge solid-orange">Premium</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-title"><span class="iconify" data-icon="ri:wallet-3-line"></span> WALLET & FUNDS</h3>
                    <a href="/depositfunds" class="nav-item">
                        <span class="iconify" data-icon="ri:add-circle-line"></span> Deposit Funds
                    </a>
                    <a href="/withdraw" class="nav-item">
                        <span class="iconify" data-icon="solar:card-send-outline"></span>
                        Withdraw Funds
                    </a>
                    <!-- <a href="internal-/transfer" class="nav-item">
                        <span class="iconify" data-icon="ri:arrow-left-right-line"></span> Internal Transfer
                    </a> -->
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

                            <a href="/verify-account" class="acm-verify-link">

                                <span class="iconify" data-icon="solar:shield-check-outline"></span>

                                Verify Identity

                            </a>

                        </div>

                    </div>



                    <!-- PROFILE SETTINGS -->
                    <a href="/profilesetting" class="acm-nav-link">

                        <span class="iconify" data-icon="solar:settings-outline"></span>

                        Profile Settings

                    </a>

                </div>

                <div class="nav-section">
                    <h3 class="nav-title">
                        <span class="iconify" data-icon="solar:gift-outline"></span>
                        Growth & Rewards
                    </h3>

                    <a href="/referUser" class="nav-item">
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

                    <a href="/support" class="nav-item">
                        <div class="item-left">
                            <span class="iconify" data-icon="solar:chat-round-dots-outline"></span>
                            Support Center
                        </div>
                    </a>
                </div>

            </nav>

            <!-- <div class="sidebar-footer">

                <a href="/loan" class="apply-credit">
                    <span class="iconify" data-icon="ri:add-box-line"></span> Apply for Credit
                    <span class="badge solid-green">Fast</span>
                </a>

                <a href="/loanHistory" class="apply-credit">
                    <span class="iconify" data-icon="ri:file-list-3-line"></span> Credit History
                </a>
            </div> -->

            <div class="contact-wrapper">

                <a href="/support" class="contact-btn">

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

        <main class="content-area">
            <div class="page-header">

                <div class="welcome-text">
                    <h1>Welcome back, {{ Auth::user()->name }}!</h1>
                    <p>Your investment dashboard overview</p>
                </div>

                <div class="header-buttons">
                    <a href="wallet.html" class="btn btn-outline-purple">
                        <span class="iconify" data-icon="ri:link"></span> Connect Wallet
                    </a>
                    <a href="invest.html" class="btn btn-solid-green">
                        <span class="iconify" data-icon="ri:line-chart-line"></span> Invest Now
                    </a>
                </div>
            </div>

            <div class="banner demo-banner">
                <div class="banner-left">
                    <div class="icon-box"><span class="iconify" data-icon="ri:graduation-cap-line"></span></div>
                    <div>
                        <h2>Demo Account Active</h2>
                        <p>Demo Balance: $100,000.00</p>
                    </div>
                </div>
                <a href="/demo" class="btn btn-white">
                    <span class="iconify" data-icon="ri:play-line"></span> Switch to Demo Trading
                </a>
            </div>

            <div class="stats-grid">
                <div class="card balance-card">
                    <div class="card-head">
                        <div class="title">
                            <span class="iconify" data-icon="ri:wallet-3-line"></span>
                            <h3>Account Balance</h3>
                        </div>
                        <button class="icon-btn" id="toggleBalanceBtn">
                            <span class="iconify" id="eyeIcon" data-icon="ri:eye-line"></span>
                        </button>
                    </div>
                    <p class="subtitle">Your available funds</p>

                    <h1 class="main-amount" id="balanceAmount">
                        ${{ number_format(Auth::user()->balance, 2) }}
                    </h1>

                    <div class="status-tags">
                        <span class="tag tag-success"><span class="iconify" data-icon="ri:checkbox-circle-line"></span>
                            Available for Withdrawal</span>
                        @if(strtolower(Auth::user()->kyc_status) === 'approved')
                            <span class="tag tag-success"><span class="iconify" data-icon="ri:checkbox-circle-line"></span>
                                Verified</span>
                        @else
                            <span class="tag tag-danger"><span class="iconify" data-icon="ri:error-warning-line"></span>
                                Unverified</span>
                        @endif
                    </div>



                    <p class="last-updated" id="last-updated-text"
                        data-timestamp="{{ Auth::user()->updated_at->toIso8601String() }}">
                        Last updated: Loading...
                    </p>

                    <div class="card-actions">
                        <a href="/depositfunds" class="btn btn-dark"><span class="iconify"
                                data-icon="ri:add-circle-line"></span> Deposit</a>
                        <a href="/withdraw" class="btn btn-dark"><span class="iconify"
                                data-icon="ri:arrow-right-up-line"></span> Withdraw</a>
                    </div>
                </div>

                <div class="card mini-card">
                    <div class="mini-card-top">
                        <p>Total Profit</p>
                        <div class="icon-circle"><span class="iconify" data-icon="ri:money-dollar-circle-line"></span>
                        </div>
                    </div>
                    <h2 id="totalProfitAmount">${{ number_format($totalProfit, 2) }}</h2>
                    <p class="bottom-text"><span class="iconify" data-icon="ri:calendar-line"></span> Last period</p>
                </div>

                <div class="card mini-card">
                    <div class="mini-card-top">
                        <p>Total Deposit</p>
                        <div class="icon-circle"><span class="iconify" data-icon="ri:arrow-down-line"></span></div>
                    </div>
                    <h2>${{ number_format($totalDeposit, 2) }}</h2>
                    <p class="bottom-text"><span class="iconify" data-icon="ri:calendar-line"></span> All time</p>
                </div>

                <div class="card mini-card">
                    <div class="mini-card-top">
                        <p>Bonus</p>
                        <div class="icon-circle"><span class="iconify" data-icon="ri:gift-line"></span></div>
                    </div>
                    <h2 id="bonusAmount">${{ number_format($bonus, 2) }}</h2>
                    <p class="bottom-text"><span class="iconify" data-icon="ri:calendar-line"></span> All time</p>
                </div>

                <div class="card mini-card">
                    <div class="mini-card-top">
                        <p>Total Withdrawal</p>
                        <div class="icon-circle"><span class="iconify" data-icon="ri:arrow-up-line"></span></div>
                    </div>
                    <h2>${{ number_format($totalWithdrawal ?? 0, 2) }}</h2>
                    <p class="bottom-text"><span class="iconify" data-icon="ri:calendar-line"></span> All time</p>
                </div>


            </div>

            <div class="card flex-card">
                <div class="flex-left">
                    <div class="icon-box dark-box"><span class="iconify" data-icon="ri:shield-check-line"></span></div>
                    <div>
                        <h3>Identity Verification</h3>
                        <p>Complete verification to access all features</p>
                    </div>
                </div>
                <a href="/verify-account" class="btn btn-blue">View Details <span class="iconify"
                        data-icon="ri:arrow-down-s-line" style="transform: rotate(-90deg);"></span></a>
            </div>

            <div class="card flex-card promo-card" id="promoCard">
                <button class="close-promo" id="closePromoBtn"><span class="iconify"
                        data-icon="ri:close-line"></span></button>
                <div class="flex-left">
                    <div class="icon-box dark-box border-purple"><span class="iconify text-purple"
                            data-icon="ri:wallet-3-fill"></span></div>
                    <div>
                        <h3>Connect Your Wallet to Start Earning</h3>
                        <p class="text-purple-light">Connect your cryptocurrency wallet to unlock daily earning
                            opportunities of up to <strong>$3000 per day</strong>.</p>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="{{ asset('assets/Frontend/js/script.js') }}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>


</body>

</html>