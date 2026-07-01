<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/premiumSignals.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.__USER_BALANCE = {{ $balance ?? 0 }};</script>

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
        <!-- BASIC SIDE NAV (Provided) -->
        <nav class="side-nav">
            <a href="#" class="logo">Nexuist</a>
            <ul class="nav-links">
                <li><a href="#" class="nav-link"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
                <li><a href="#" class="nav-link active"><i class='bx bx-trending-up'></i> Trading Signals</a></li>
                <li><a href="#" class="nav-link"><i class='bx bx-coin-stack'></i> Portfolio</a></li>
                <li><a href="#" class="nav-link"><i class='bx bx-credit-card'></i> Subscription</a></li>
            </ul>
        </nav>

        <!-- MAIN CONTENT -->
        <div class="nexuist-main-content">
            <!-- Header Section -->
            <div class="signals-header">
                <div class="header-left">
                    <div class="title-with-icon">
                        <i class='bx bx-bar-chart-alt-2 main-icon'></i>
                        <h1>Premium Trading Signals</h1>
                    </div>
                    <p>Subscribe to professional trading signals and enhance your trading success</p>
                </div>
                <div class="available-badge">
                    <i class='bx bx-trending-up'></i>
                    <div class="badge-text">
                        <span class="count">{{ $signalCount ?? ($signals->count() ?? 0) }}</span>
                        <span class="label">Available Signals</span>
                    </div>
                </div>
            </div>

            <!-- Grid Section -->
            <div class="signals-grid">
                @foreach($signals ?? collect() as $signal)
                    <div class="sig-card" data-id="{{ $signal->id }}" data-name="{{ $signal->bot_name }}"
                        data-price="{{ number_format($signal->minimum_investment, 2, '.', '') }}">
                        <div class="card-header">
                            <i class='bx bx-broadcast'></i>
                            <h3>{{ $signal->bot_name }}</h3>
                            <span class="premium-tag"><i class='bx bxs-star'></i> Premium</span>
                        </div>
                        <div class="card-price">
                            <span class="currency">$</span>
                            <span class="amount">{{ number_format($signal->minimum_investment, 2) }}</span>
                            <span class="period">/month</span>
                        </div>
                        <p class="sub-text">
                            {{ Str::limit($signal->description ?? 'Premium trading signal subscription', 80) }}</p>
                        <ul class="feat-list">
                            <li><i class='bx bx-check'></i> Success Rate: {{ $signal->accuracy_rate ?? 0 }}%</li>
                            <li><i class='bx bx-check'></i> Real-time notifications</li>
                            <li><i class='bx bx-check'></i> Expert analysis</li>
                            <li><i class='bx bx-check'></i> 24/7 support</li>
                        </ul>
                        <button class="btn-subscribe"><i class='bx bx-plus-circle'></i> Subscribe Now</button>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal Section (Outside main flow to avoid sidebar interference) -->
        <div class="modal-overlay" id="subModal">
            <div class="modal-container">
                <div class="modal-header">
                    <div class="modal-title-group">
                        <div class="modal-icon"><i class='bx bx-pulse'></i></div>
                        <div>
                            <h2>Subscribe to Signal</h2>
                            <span id="display-name" class="modal-subtitle">Trend Signal</span>
                        </div>
                    </div>
                    <button class="close-modal" id="closeBtn"><i class='bx bx-x'></i></button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <label><i class='bx bx-credit-card'></i> Payment Method</label>
                        <select class="modal-select">
                            <option>Bank Transfer</option>
                            <option>USDT (Tether)</option>
                            <option>Bitcoin</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label><i class='bx bx-dollar'></i> Subscription Amount ($)</label>
                        <div class="price-input-box">
                            <input type="text" id="display-price" readonly>
                            <span class="freq">/month</span>
                        </div>
                    </div>
                    <div class="modal-notice">
                        <i class='bx bx-info-circle'></i> Recurring monthly subscription. Cancel anytime.
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" id="cancelBtn">Cancel</button>
                    <button class="btn-complete"><i class='bx bx-check-circle'></i> Complete Subscription</button>
                </div>


            </div>
        </div>

    </div>

    <script src="{{ asset('assets/Frontend/js/premiumSignals.js') }}"></script>
</body>

</html>