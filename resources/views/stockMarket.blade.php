<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/stockMarket.css') }}">
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

    @include('layouts.frontend-header-sidebar')



        <!-- Main Content -->
        <main class="investment-container">
            <header class="stock-dashboard-header">
                <div class="header-content">
                    <span class="badge-live"><i class="bx bx-pulse"></i> NYSE LIVE</span>
                    <h1>Stock Market Investment Dashboard</h1>
                    <p>Capitalize on blue-chip companies and emerging sectors through institutional-grade structured
                        portfolios.</p>
                    <div class="tag-row">
                        <span class="tag"><i class="bx bx-bar-chart-square"></i> Balanced Growth</span>
                        <span class="tag"><i class="bx bx-money"></i> Dividend Income</span>
                        <span class="tag"><i class="bx bx-shield-quarter"></i> Secured Returns</span>
                    </div>
                </div>
                <div class="header-stats">
                    <div class="stat-bubble">
                        <p>Global Cap</p>
                        <h3>$95T</h3>
                    </div>
                    <div class="stat-bubble">
                        <p>Hist. Return</p>
                        <h3>7.5%</h3>
                    </div>
                </div>
            </header>

            <section class="insights-grid">
                <div class="insights-card allocation-viewer">
                    <div class="card-title-row">
                        <h3><i class="bx bx-doughnut-chart"></i> Your Allocation Tool</h3>
                        <span class="muted">Live Breakdown</span>
                    </div>
                    <div class="allocation-canvas">
                        <div class="css-doughnut">
                            <div class="doughnut-center">
                                <span>74%</span>
                                <p>Equities</p>
                            </div>
                        </div>
                        <div class="doughnut-legend">
                            <p><span class="dot blue"></span> Tech (35%)</p>
                            <p><span class="dot green"></span> Health (20%)</p>
                            <p><span class="dot yellow"></span> Energy (19%)</p>
                        </div>
                    </div>
                </div>
                <div class="insights-card quick-stats">
                    <div class="insight-item">
                        <i class="bx bx-world icon-dim blue"></i>
                        <div>
                            <h4>60+</h4>
                            <p>Global Exchanges</p>
                        </div>
                    </div>
                    <div class="insight-item">
                        <i class="bx bx-list-ul icon-dim green"></i>
                        <div>
                            <h4>40K+</h4>
                            <p>Listed Companies</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="plans-super-grid" id="stockPlansGrid">
            </section>

            <section class="features-block">
                <h3><i class="bx bx-star"></i> Why Choose Institutional Stock Portfolios?</h3>
                <div class="features-wrapper">
                    <div class="feature-card">
                        <i class="bx bx-building icon-feat feat-blue"></i>
                        <h5>Real Equity Assets</h5>
                        <p>Direct exposure to success through fractional ownership in top-performing organizations.</p>
                    </div>
                    <div class="feature-card">
                        <i class="bx bx-trending-up icon-feat feat-green"></i>
                        <h5>Compounded Income</h5>
                        <p>Strategic reinvestment loops for sustained capital appreciation and wealth creation.</p>
                    </div>
                    <div class="feature-card">
                        <i class="bx bx-timer icon-feat feat-yellow"></i>
                        <h5>Long-term Position</h5>
                        <p>Built for resilience through market cycles, focusing on stable long-horizon growth curves.
                        </p>
                    </div>
                </div>
            </section>

            <section class="stock-post-section">
                <div class="stock-post-header">
                    <h3><i class="bx bx-news"></i> Latest Stock Market Insights</h3>
                    <p>Published directly from the Nexuist backend.</p>
                </div>
                <div class="stock-post-grid" id="stockPostsContainer"></div>
            </section>

            <footer class="sector-strip">
                <span class="strip-title">Portfolio Exposure:</span>
                <div class="sector-icons">
                    <div class="sector-icon"><i class="bx bx-chip"></i> Technology</div>
                    <div class="sector-icon"><i class="bx bx-plus-medical"></i> Healthcare</div>
                    <div class="sector-icon"><i class="bx bx-zap"></i> Energy</div>
                    <div class="sector-icon"><i class="bx bx-landmark"></i> Financial</div>
                    <div class="sector-icon"><i class="bx bx-cart"></i> Consumer</div>
                    <div class="sector-icon"><i class="bx bx-buildings"></i> Industrial</div>
                </div>
            </footer>
        </main>

    </div>

    <script id="stockPlansData" type="application/json">@json($stockPlans)</script>
    <script id="stockPostsData" type="application/json">@json($stockPosts)</script>
    <script id="stockUserBalanceData" type="application/json">{{ $userBalance }}</script>
    <script>
        window.stockMarketAuth = @json(auth()->check());
        window.stockMarketBaseUrl = @json(url(''));
        window.stockMarketInvestUrl = @json(route('stockmarket.invest'));
        window.stockMarketDeployUrl = @json(url('/deploybot'));
    </script>
    <script src="{{ asset('assets/Frontend/js/stockMarket.js') }}?v=4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>