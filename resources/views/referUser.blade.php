<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/referUser.css') }}">
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
                 <span class="balance-value"> ${{ number_format(Auth::user()->balance, 2) }}


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

                    <a href="/referUser" class="nav-item active">
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
        <main class="nexuist-referral-portal">
            <div class="referral-container animate-fade-in">
                <header class="ref-header">
                    <div class="brand-badge">Nexuist Network</div>
                    <h1>Invite & Earn Rewards</h1>
                    <p>Grow the ecosystem and earn up to 15% commission on every trade your referrals make.</p>
                </header>

                <div class="stats-grid">
                    <div class="stat-card glass-morph">
                        <div class="stat-icon blue"><i class='bx bx-group'></i></div>
                        <div class="stat-info">
                            <span class="label">Total Referrals</span>
                            <h2 class="value">{{ number_format($totalReferrals) }}</h2>
                            <span class="trend up"><i class='bx bx-trending-up'></i> {{ $totalReferrals > 0 ? '+' . round(($totalReferrals / max($totalReferrals, 1)) * 10, 1) . '% this month' : 'No referrals yet' }}</span>
                        </div>
                    </div>
                    <div class="stat-card glass-morph">
                        <div class="stat-icon green"><i class='bx bx-wallet'></i></div>
                        <div class="stat-info">
                            <span class="label">Total Earnings</span>
                            <h2 class="value">${{ number_format($totalEarnings, 2) }}</h2>
                            <span class="trend up"><i class='bx bx-trending-up'></i> {{ $totalEarnings > 0 ? '+'.round(($totalEarnings / max($totalEarnings, 1)) * 5, 1).'% this month' : 'Start earning today' }}</span>
                        </div>
                    </div>
                    <div class="stat-card glass-morph">
                        <div class="stat-icon purple"><i class='bx bx-medal'></i></div>
                        <div class="stat-info">
                            <span class="label">Current Tier</span>
                            <h2 class="value">{{ $currentTier }}</h2>
                            <div class="tier-progress">
                                <div class="progress-bar" style="width: {{ $progressWidth }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="ref-tools glass-morph">

                    <div class="qr-trigger-wrapper glass-morph">
                        <div class="tools-header">
                            <div class="tools-text">
                                <h3>Share via QR Code</h3>
                                <p>Invite friends by letting them scan your unique code.</p>
                            </div>
                            <button class="btn-qr-main" onclick="openQRModal()">
                                <i class='bx bx-qr-scan'></i> Generate QR
                            </button>
                        </div>
                    </div>

                    <div id="referralQRModal" class="nexuist-modal-overlay">
                        <div class="qr-modal-card animate-pop-in">
                            <button class="close-x" onclick="closeQRModal()">&times;</button>

                            <div class="modal-body">
                                <div class="qr-brand-icon">
                                    <i class='bx bxs-user-plus'></i>
                                </div>
                                <h2>Your Referral QR</h2>
                                <p>Scanning this link will automatically apply your referral ID: <strong>{{ $referralCode }}</strong>
                                </p>

                                <div class="qr-secure-zone">
                                    <div id="qrcode-canvas"></div>
                                    <div class="qr-id-tag">REF: {{ $referralCode }}</div>
                                </div>

                                <div class="qr-modal-actions">
                                    <button class="btn-download-qr" onclick="downloadReferralQR()">
                                        <i class='bx bxs-download'></i> Save to Gallery
                                    </button>
                                    <button class="btn-copy-fallback" onclick="copyRefLink()">
                                        <i class='bx bx-link-alt'></i> Copy Link
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer-brand">
                                <i class='bx bxs-shield-checked'></i> Nexuist Secure Referral
                            </div>
                        </div>
                    </div>


                    <div class="link-box">
                        <div class="input-wrapper">
                            <label>Unique Referral Link</label>
                            <div class="copy-input">
                                <input type="text" value="{{ $referralLink }}" id="refLink" readonly>
                                <button onclick="copyRefLink()" id="copyBtn"><i class='bx bx-copy'></i></button>
                            </div>
                        </div>
                        <div class="input-wrapper">
                            <label>Referral ID</label>
                            <div class="copy-input">
                                <input type="text" value="{{ $referralCode }}" id="refID" readonly>
                                <button onclick="copyRefID()"><i class='bx bx-copy'></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="share-socials">
                        <span>Direct Share:</span>
                        <div class="social-icons">
                            <a href="https://api.whatsapp.com/send?text=Join%20Nexuist%20and%20start%20earning!%20Use%20my%20link:%20{{ urlencode($referralLink) }}"
                                target="_blank" class="social-link" title="Share on WhatsApp">
                                <i class='bx bxl-whatsapp' onclick="shareToSocial('whatsapp')"></i> </a>

                            <a href="https://t.me/share/url?url={{ urlencode($referralLink) }}&text=Join%20Nexuist%20and%20start%20earning%20rewards!"
                                target="_blank" class="social-link" title="Share on Telegram">
                                <i class='bx bxl-telegram' onclick="shareToSocial('telegram')"></i> </a>

                            <a href="https://twitter.com/intent/tweet?text=Join%20the%20Nexuist%20ecosystem%20and%20earn%20rewards.%20Sign%20up%20here:%20{{ urlencode($referralLink) }}"
                                target="_blank" class="social-link" title="Share on X">
                                <i class='bx bxl-twitter' onclick="shareToSocial('twitter')"></i> </a>
                        </div>
                    </div>
                </section>

                <section class="tier-section glass-morph">
                    <h3>Commission Tiers</h3>
                    <div class="tier-list">
                        @foreach ($globalTierData as $tier)
                            <div class="tier-item {{ $tier['active'] ? 'active' : '' }}">
                                <div class="tier-rank">
                                    <i class='bx bxs-bolt-circle'></i> {{ $tier['name'] }}
                                </div>
                                <div class="tier-req">{{ $tier['range'] }}</div>
                                <div class="tier-reward">{{ $tier['reward'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

        </main>


    </div>

    <script src="{{ asset('assets/Frontend/js/referUser.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</body>

</html>