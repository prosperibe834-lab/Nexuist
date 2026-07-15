<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
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

    @include('layouts.frontend-header-sidebar')



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
                        <p>Total Profits</p>
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