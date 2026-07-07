<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/copytrading.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

    @include('layouts.frontend-header-sidebar')



        <!-- Main Content -->
        <section class="dashboard-container">
            <div class="dashboard-header">
                <div class="header-text">
                    <h1>Copy Trading Dashboard</h1>
                    <p>Manage your copy trading portfolio and track performance</p>
                </div>
                <div class="header-actions">
                    <a href="/experts" class="btn btn-primary"><i class="fas fa-users"></i> Browse Experts</a>
                    <button class="btn btn-secondary" id="refresh-btn">
                        <i class="fas fa-sync-alt" id="refresh-icon"></i> Refresh
                    </button>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card fade-in">
                    <div class="stat-info">
                        <span class="stat-label">Active Copies</span>
                        <h2 class="stat-value">{{ $activeCopies ?? 0 }}</h2>
                        <span class="stat-sub">Experts being copied</span>
                    </div>
                    <div class="stat-icon icon-blue"><i class="fas fa-user-friends"></i></div>
                </div>

                <div class="stat-card fade-in">
                    <div class="stat-info">
                        <span class="stat-label">Total Invested</span>
                        <h2 class="stat-value">${{ number_format($totalInvested ?? 0, 2) }}</h2>
                        <span class="stat-sub">Capital deployed</span>
                    </div>
                    <div class="stat-icon icon-green"><i class="fas fa-dollar-sign"></i></div>
                </div>

                <div class="stat-card fade-in">
                    <div class="stat-info">
                        <span class="stat-label">Current Value</span>
                        <h2 class="stat-value">${{ number_format($currentValue ?? 0, 2) }}</h2>
                        <span class="stat-sub">Portfolio value</span>
                    </div>
                    <div class="stat-icon icon-purple"><i class="fas fa-wallet"></i></div>
                </div>

                <div class="stat-card fade-in">
                    <div class="stat-info">
                        <span class="stat-label">Total P&L</span>
                        <h2 class="stat-value success">{{ $totalProfit >= 0 ? '+' : '-' }}${{ number_format(abs($totalProfit ?? 0), 2) }}</h2>
                        <span class="stat-sub">{{ number_format($roi ?? 0, 2) }}% ROI</span>
                    </div>
                    <div class="stat-icon icon-green-light"><i class="fas fa-chart-line"></i></div>
                </div>
            </div>

            @if(!empty($activeCopies) && $activeCopies > 0)
                

 <section class="active-copies-section">
                    <div class="section-header">
                        <h2 class="section-title">Your Active Copying Positions</h2>
                        <a href="/deploybot" class="btn btn-outline">View Deployment</a>
                    </div>
                    <div class="active-copies-grid">
                        @foreach($activeInvestments as $investment)
                            <div class="copy-card">
                                <div class="copy-card-body">
                                    <h3 class="copy-card-title">{{ $investment->bot->bot_name ?? 'AI Copy Bot' }}</h3>
                                    <p class="copy-card-description">{{ $investment->bot->strategy_type ?? $investment->bot->trading_style ?? 'Copy Trading Strategy' }}</p>
                                    <div class="copy-card-stats">
                                        <span class="stat-item">Principal: ${{ number_format($investment->investment_amount, 2) }}</span>
                                        <span class="stat-item">Current Value: ${{ number_format($investment->current_balance, 2) }}</span>
                                        <span class="stat-item">Profit: ${{ number_format($investment->current_profit, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @else
                <div class="empty-state-card scale-up">
                    <div class="empty-icon">
                        <i class="fas fa-copy"></i>
                    </div>
                    <h2>Start Copy Trading</h2>
                    <p>You haven't started copying any traders yet. Browse our expert traders and start copying their
                        winning strategies to earn profits automatically.</p>

                    <div class="feature-highlights">
                    <div class="feature-item">
                        <div class="f-icon icon-blue"><i class="fas fa-user-tie"></i></div>
                        <h4>Expert Traders</h4>
                        <p>Copy from verified professional traders</p>
                    </div>
                    <div class="feature-item">
                        <div class="f-icon icon-green"><i class="fas fa-bolt"></i></div>
                        <h4>Auto Trading</h4>
                        <p>Trades executed automatically 24/7</p>
                    </div>
                    <div class="feature-item">
                        <div class="f-icon icon-purple"><i class="fas fa-shield-alt"></i></div>
                        <h4>Risk Management</h4>
                        <p>Set your own limits and stop-loss</p>
                    </div>
                </div>

                <div class="empty-actions">
                    <a href="/experts" class="btn btn-primary btn-lg">Browse Expert Traders</a>


                    <button class="btn btn-outline" id="openHowItWorksBtn">
                        <i class="bx bx-help-circle"></i> How It Works
                    </button>

                    <div class="fin-modal-overlay" id="howItWorksModal">
                        <div class="fin-modal-window">

                            <header class="fin-modal-header">
                                <div class="header-title-group">
                                    <div class="header-icon-glow"><i class="bx bx-analyse"></i></div>
                                    <h3>How Copy Trading Works</h3>
                                </div>
                                <button class="close-modal-x" id="closeHowItWorksBtn">&times;</button>
                            </header>

                            <div class="fin-modal-grid">

                                <div class="steps-lane">
                                    <div class="step-card-node">
                                        <div class="node-number num-blue">1</div>
                                        <div class="node-text">
                                            <h5>Choose an Expert</h5>
                                            <p>Browse through our verified expert traders and select one based on
                                                performance historical charts, strategy tags, and calibrated risk
                                                profiles.</p>
                                        </div>
                                    </div>

                                    <div class="step-card-node">
                                        <div class="node-number num-green">2</div>
                                        <div class="node-text">
                                            <h5>Set Your Investment</h5>
                                            <p>Decide your threshold allocations and lock in protective safety settings
                                                including automated stop-loss and real-time take-profit margins.</p>
                                        </div>
                                    </div>

                                    <div class="step-card-node">
                                        <div class="node-number num-purple">3</div>
                                        <div class="node-text">
                                            <h5>Auto-Copy Trades</h5>
                                            <p>Our execution engine mirrors the expert's market trades instantly into
                                                your terminal array, directly proportional to your funding weight.</p>
                                        </div>
                                    </div>

                                    <div class="step-card-node">
                                        <div class="node-number num-orange">4</div>
                                        <div class="node-text">
                                            <h5>Monitor & Profit</h5>
                                            <p>Track live execution metrics on your unified analytics workspace and
                                                watch equity distributions update alongside master exchange loops.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="benefits-lane">
                                    <div class="benefits-glass-wrapper">
                                        <h4>Benefits of Copy Trading</h4>
                                        <ul class="premium-check-list">
                                            <li><i class="bx bx-check-circle"></i> Zero previous market exposure or
                                                trade analysis required</li>
                                            <li><i class="bx bx-check-circle"></i> Reverse-engineer professional hedge
                                                structures automatically</li>
                                            <li><i class="bx bx-check-circle"></i> Instantly diversify across
                                                uncorrelated digital asset layers</li>
                                            <li><i class="bx bx-check-circle"></i> 24/7 autonomous order-flow scaling
                                                completely hands-free</li>
                                            <li><i class="bx bx-check-circle"></i> Retain total balance custody with
                                                absolute withdrawal agency</li>
                                        </ul>
                                    </div>

                                    <div class="advisory-warning-card">
                                        <div class="advisory-header">
                                            <i class="bx bx-info-circle"></i>
                                            <span>Risk Advisory Warning</span>
                                        </div>
                                        <p>Copy trading involves inherent systemic market risks. Past execution metrics
                                            and historical performances are not predictive indexes for future yield
                                            generation loops. Invest responsibly.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

                @endif

    <script src="{{ asset('assets/Frontend/js/copytrading.js') }}"></script>
</body>

</html>