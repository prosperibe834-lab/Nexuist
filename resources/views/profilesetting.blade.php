<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/profilesetting.css') }}">
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
                    <a href="/profilesetting" class="acm-nav-link active">

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
         
        <div class="nex-profile-wrapper animate-fade-in">
    <header class="nex-header">
        <div class="header-meta">
            <h1>Account Settings</h1>
            <p>Manage your digital identity and security preferences</p>
        </div>
        <button class="btn-back" onclick="history.back()">
            <i class='bx bx-left-arrow-alt'></i> Back to Dashboard
        </button>
    </header>

    <div class="nex-grid">
        <aside class="nex-sidebar">
            <div class="profile-card glass-card">
                <div class="avatar-wrapper">
                    <div class="avatar-main">MM</div>
                    <button class="edit-avatar"><i class='bx bxs-camera'></i></button>
                </div>
                <div class="user-meta">
                    <h3>Marine Military</h3>
                    <span>marinemilitary80@gmail.com</span>
                </div>
                <div class="security-meter">
                    <div class="meter-header">
                        <span>Security Level: <strong>Strong</strong></span>
                        <span>85%</span>
                    </div>
                    <div class="meter-bar"><div class="fill" style="width: 85%"></div></div>
                </div>
            </div>

            <nav class="nex-nav glass-card">
                <button class="nav-item active"><i class='bx bx-user'></i> Personal Info</button>
                <button class="nav-item"><i class='bx bx-shield-quarter'></i> Security & 2FA</button>
                <button class="nav-item"><i class='bx bx-bell'></i> Notifications</button>
                <button class="nav-item text-danger"><i class='bx bx-log-out'></i> Terminate Sessions</button>
            </nav>

        </aside>

        <main class="nex-main">
            <div class="glass-card form-container">
                <div class="form-header">
                    <h2>Personal Information</h2>
                    <p>Verified account details for Nexuist services.</p>
                </div>

                <form id="profileForm" class="nex-form">
                    <div class="input-row">
                        <div class="input-group">
                            <label>Full Name</label>
                            <div class="input-wrap">
                                <i class='bx bx-user'></i>
                                <input type="text" value="Marine Military" placeholder="Enter full name">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Username</label>
                            <div class="input-wrap readonly">
                                <i class='bx bx-at'></i>
                                <input type="text" value="Tokyo">
                                <i class='bx bx-lock-alt lock-icon'></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label>Email Address</label>
                            <div class="input-wrap readonly">
                                <i class='bx bx-envelope'></i>
                                <input type="email" value="marinemilitary80@gmail.com">
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Phone Number</label>
                            <div class="input-wrap">
                                <i class='bx bx-phone'></i>
                                <input type="tel" value="+1 023 979 5648">
                            </div>
                        </div>
                    </div>

                    <div class="input-group full-width">
                        <label>Country / Region</label>
                        <div class="input-wrap">
                            <i class='bx bx-globe'></i>
                            <select class="country-select">
                                <option selected>United States of America</option>
                                <option>United Kingdom</option>
                                <option>Canada</option>
                                <option>Germany</option>
                                <option>Spain</option>
                                <option>Mexico</option>
                                <option>Brazil</option>
                                <option>Japan</option>
                                <option>Taiwan</option>
                                <option>Italy</option>
                                <option>China</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save">
                            <span>Save Changes</span>
                            <i class='bx bx-check-double'></i>
                        </button>
                    </div>
                </form>
            </div><br>

            <div class="glass-card activity-container">
                <div class="activity-header">
                    <h3>Recent Activity</h3>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="act-icon login"><i class='bx bx-log-in-circle'></i></div>
                        <div class="act-info">
                            <p>Account Login</p>
                            <span>Detected from 192.110.102.83 • 55 mins ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="act-icon update"><i class='bx bx-refresh'></i></div>
                        <div class="act-info">
                            <p>Profile Updated</p>
                            <span>Settings changed successfully • Tue, May 3, 2026</span>
                        </div>
                    </div>
                </div>
            </div>


        </main>
    </div>
</div>
    </div>

    <script src="{{ asset('assets/Frontend/js/profilesetting.js') }}"></script>
</body>

</html>