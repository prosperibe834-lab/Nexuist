<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/experts.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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

        <div class="experts-wrapper">
            <section id="marketplaceView">
                <header class="experts-header">
                    <div class="header-intro">
                        <span class="badge-live"><i class="fas fa-signal"></i> 25 Experts Online</span>
                        <h1>Copy Expert Traders</h1>
                        <p>Mirror the trades of world-class professionals automatically.</p>
                    </div>

                    <div class="search-filter-container">
                        <div class="search-group">
                            <i class="fas fa-search"></i>
                            <input type="text" id="expertSearch" placeholder="Search by name or strategy...">
                        </div>
                        <div class="filter-group">
                            <select id="sortFilter" class="fintech-select">
                                <option value="roi">Sort by: ROI</option>
                                <option value="winRate">Win Rate</option>
                                <option value="copiers">Popularity</option>
                            </select>
                        </div>
                    </div>
                </header>

                <div class="experts-grid" id="expertsGrid">
                </div>
            </section>

            <section id="copyDetailView" class="hidden">
                <button class="back-btn" onclick="showMarketplace()"><i class="fas fa-arrow-left"></i> Back to
                    Dashboard</button>
                <div class="detail-container">
                    <div class="detail-card scale-up">
                        <div class="trader-hero">
                            <img id="detailImg" src="') }}" alt="">
                            <h2 id="detailName">Trader Name</h2>
                            <p id="detailStrategy">Strategy Category</p>
                        </div>

                        <div class="detail-stats">
                            <div class="d-stat"><span>Monthly ROI</span>
                                <h3 class="success" id="detailRoi">+0%</h3>
                            </div>
                            <div class="d-stat"><span>Win Rate</span>
                                <h3 id="detailWin">0%</h3>
                            </div>
                            <div class="d-stat"><span>AUM</span>
                                <h3 id="detailEquity">$0</h3>
                            </div>
                        </div>

                        <div class="investment-form">
                            <label>Amount to Invest ($)</label>
                            <input type="number" id="investAmount" placeholder="Min. $100">
                            <small id="minLimit" class="input-hint">Min: $0</small>
                            <p class="input-hint">Funds will be locked in this copy strategy.</p>
                            <button class="confirm-btn" onclick="confirmInvestment()">Confirm & Start Copying</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        window.APP_EXPERTS = @json($expertsData ?? []);
    </script>
    <script src="{{ asset('assets/Frontend/js/experts.js') }}"></script>
</body>

</html>