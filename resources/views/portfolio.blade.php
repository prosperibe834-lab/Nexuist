<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/portfolio.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css') }}">
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
        <section id="view-portfolio" class="dashboard-viewport">
            <div class="portfolio-grid-layout">

                <div class="portfolio-main">
                    <header class="portfolio-header-pro">
                        <div>
                            <h1>Investment Portfolio</h1>
                            <p>Manage your active copy strategies and equity.</p>
                        </div>
                        <div class="header-balance">
                            <small>Total Equity</small>
                            <h2 id="total-equity">$0.00</h2>
                            <span class="success-text" id="portfolio-change"><i class="fas fa-caret-up"></i> +0.0% Today</span>
                        </div>
                    </header>

                    <div class="portfolio-summary-grid">
                        <div class="summary-card">
                            <small>Total Invested</small>
                            <strong id="total-invested">$0.00</strong>
                        </div>
                        <div class="summary-card">
                            <small>Open Positions</small>
                            <strong id="open-positions">0</strong>
                        </div>
                        <div class="summary-card">
                            <small>Closed Positions</small>
                            <strong id="closed-positions">0</strong>
                        </div>
                        <div class="summary-card">
                            <small>Total Profit</small>
                            <strong id="total-profit">$0.00</strong>
                        </div>
                    </div>

                    <div class="active-traders-list" id="activeTradersList">
                    </div>
                </div>

                <div class="live-feed-sidebar">
                    <h3>Live Trading Feed</h3>
                    <div class="feed-scroll" id="liveFeed">
                    </div>
                </div>

            </div>
        </section>

    </div>

    <script src="{{ asset('assets/Frontend/js/portfolio.js') }}"></script>
</body>

</html>