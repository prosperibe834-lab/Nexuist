<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/botTrading.css') }}">
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
        <main class="main-content">
            <!-- PAGE 1: BOT STRATEGY HUB -->
            <section id="bot-hub-page">
                <header class="hub-header">
                    <div class="header-main-content">
                        <div class="badge-ai"><i class='bx bxs-zap'></i> AI-Powered Trading Active</div>
                        <h1 class="gradient-text">Bot Strategy Hub</h1>
                        <p class="subtitle">Deploy institutional-grade algorithms to maximize your portfolio performance
                            across global markets.</p>

                        <div class="hero-stats-row">
                            <div class="glass-stat-card">
                                <div class="stat-icon" style="color: var(--color-blue);"><i
                                        class='bx bx-target-lock'></i></div>
                                <div class="stat-info">
                                    <small>Avg. Success Rate</small>
                                    <span id="avgSuccessRate" class="stat-value">84.0%</span>
                                </div>
                                <div class="stat-graph-mini up"></div>
                            </div>

                            <div class="glass-stat-card">
                                <div class="stat-icon" style="color: var(--color-green);"><i class='bx bx-wallet'></i>
                                </div>
                                <div class="stat-info">
                                    <small>Total Net Profit</small>
                                    <span id="totalNetProfit" class="stat-value">$0.00</span>
                                </div>
                            </div>

                            <div class="glass-stat-card">
                                <div class="stat-icon" style="color: var(--color-orange);"><i
                                        class='bx bx-line-chart-down'></i></div>
                                <div class="stat-info">
                                    <small>Expected ROI</small>
                                    <span id="expectedROI" class="stat-value">1.8%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="market-pulse-premium">
                        <div class="pulse-grid">
                            <!-- Always visible items -->
                            <div class="pulse-asset">
                                <div class="asset-info"><strong>S&P 500</strong><small>Stock Index</small></div>
                                <div class="asset-change up">+1.12%</div>
                            </div>
                            <div class="pulse-asset">
                                <div class="asset-info"><strong>NASDAQ</strong><small>Tech Index</small></div>
                                <div class="asset-change down">-2.02%</div>
                            </div>

                            <!-- Hidden items that appear on click -->
                            <div id="extraAssets" class="hidden-content">
                                <div class="pulse-asset">
                                    <div class="asset-info"><strong>DOW JONES</strong><small>Industrial</small></div>
                                    <div class="asset-change up">+0.45%</div>
                                </div>
                                <div class="pulse-asset">
                                    <div class="asset-info"><strong>RUSSELL 2000</strong><small>Small Cap</small></div>
                                    <div class="asset-change down">-0.10%</div>
                                </div>
                            </div>
                        </div>

                        <!-- The Button -->
                        <button id="viewMoreBtn" class="btn-pulse-view">View Full Market</button>
                    </div>
                </header>

                <div class="bot-search-wrapper">
                    <div class="bot-search-box">
                        <span class="iconify" data-icon="bx:bx-search"></span>
                        <input type="text" id="botSearchInput"
                            placeholder="Search bots by name, strategy, or market...">
                    </div>
                </div>

                <!-- Filter System -->
                <nav class="filter-nav">
                    <button class="filter-btn active" data-filter="all"><i class='bx bx-grid-alt'></i> All Bots</button>
                    <button class="filter-btn" data-filter="forex"><i class='bx bx-trending-up'></i> Forex</button>
                    <button class="filter-btn" data-filter="crypto"><i class='bx bxl-bitcoin'></i> Crypto</button>
                    <button class="filter-btn" data-filter="stocks"><i class='bx bx-line-chart'></i> Stocks</button>
                    <button class="filter-btn" data-filter="commodities"><i class='bx bx-diamond'></i>
                        Commodities</button>
                </nav>

                <div class="bot-grid" id="botGrid">
                    <!-- Bots will be injected here by JS (18+ items) -->
                </div>
            </section>

            <!-- PAGE 2: ADVANCED TRADING TERMINAL -->
            <section id="trading-terminal-page" class="hidden">
                <div class="terminal-container">
                    <header class="terminal-header">
                        <button onclick="showPage('bot-hub-page')" class="back-link">
                            <i class='bx bx-left-arrow-alt'></i>
                            <span>Back to Bots</span>
                        </button>
                        <h2 id="selectedBotName"></h2>

                        <p id="selectedBotDesc"></p>

                        <div class="bot-terminal-stats">

                            <div class="terminal-stat">
                                <small>Daily ROI</small>
                                <strong id="selectedBotROI"></strong>
                            </div>

                            <div class="terminal-stat">
                                <small>Duration</small>
                                <strong id="selectedBotDays"></strong>
                            </div>

                            <div class="terminal-stat">
                                <small>Risk Level</small>
                                <strong id="selectedBotRisk"></strong>
                            </div>

                        </div>
                    </header>

                    <div class="terminal-grid">
                        <!-- Left: Analysis -->
                        <div class="terminal-left">
                            <div class="card chart-card">
                                <div class="card-label">Performance</div>

                                <!-- TradingView Widget -->
                                <div class="tradingview-widget-container">
                                    <div id="tradingview_chart"></div>
                                </div>
                            </div>

                            <div class="card strategy-card">
                                <div class="card-label">Strategy Visual Workflow</div>
                                <div class="workflow-container">

                                    <div class="workflow-step active">
                                        <div class="workflow-icon">
                                            <i class='bx bx-search-alt'></i>
                                        </div>

                                        <div class="workflow-content">
                                            <h4>Market Scanner</h4>
                                            <p>Scanning global markets...</p>
                                        </div>

                                        <span class="workflow-status live"></span>
                                    </div>

                                    <div class="workflow-line"></div>

                                    <div class="workflow-step">
                                        <div class="workflow-icon">
                                            <i class='bx bx-brain'></i>
                                        </div>

                                        <div class="workflow-content">
                                            <h4>AI Analysis</h4>
                                            <p>Analyzing trading signals...</p>
                                        </div>

                                        <span class="workflow-status"></span>
                                    </div>

                                    <div class="workflow-line"></div>

                                    <div class="workflow-step">
                                        <div class="workflow-icon">
                                            <i class='bx bx-transfer'></i>
                                        </div>

                                        <div class="workflow-content">
                                            <h4>Trade Execution</h4>
                                            <p>Executing optimized entries...</p>
                                        </div>

                                        <span class="workflow-status"></span>
                                    </div>

                                    <div class="workflow-line"></div>

                                    <div class="workflow-step">
                                        <div class="workflow-icon">
                                            <i class='bx bx-shield-quarter'></i>
                                        </div>

                                        <div class="workflow-content">
                                            <h4>Risk Protection</h4>
                                            <p>Managing exposure levels...</p>
                                        </div>

                                        <span class="workflow-status"></span>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Right: Execution -->
                        <div class="terminal-right">
                            <div class="card invest-details-card">
                                <div class="success-circle">
                                    <svg viewBox="0 0 36 36" class="circular-chart">
                                        <path class="circle-bg"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        <path class="circle" stroke-dasharray="84, 100"
                                            d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        <text id="svgPercentage" x="18" y="20.35" class="percentage">84%</text>
                                    </svg>
                                </div>
                                <div class="input-group">
                                    <label>Investment Amount</label>
                                    <input type="number" placeholder="$ 200" id="investAmountInput">
                                    <div id="investRangeInfo" class="range-info">Min: $200.00 • Max: $15,000</div>
                                </div>
                                <div class="risk-selector">
                                    <label>Risk Level</label>
                                    <div class="risk-track">
                                        <div class="risk-thumb"></div>
                                    </div>
                                </div>
                                <!-- <button class="btn-deploy" id="deployBotBtn">
                                    Deploy Bot
                                </button> -->
                                <button class="btn-deploy" id="deployBotBtn" data-botid="">
                                    Deploy Bot
                                </button>

                            </div>
                        </div>


                    </div>
                </div>
            </section>
        </main>

    </div>


    <div id="laravel-bot-data" data-bots='@json($bots)' style="display: none;"></div>

    <script src="{{ asset('assets/Frontend/js/botTrading-fixed.js') }}"></script>

    <script src="https://s3.tradingview.com/tv.js"></script>

    <script>
        new TradingView.widget({
            "container_id": "tradingview_chart",
            "width": "100%",
            "height": 320,
            "symbol": "BINANCE:BTCUSDT",
            "interval": "15",
            "timezone": "Etc/UTC",
            "theme": "dark",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "#0f172a",
            "enable_publishing": false,
            "hide_top_toolbar": true,
            "hide_legend": false,
            "save_image": false,
            "withdateranges": true,
            "allow_symbol_change": true,
            "studies": [
                "RSI@tv-basicstudies",
                "MACD@tv-basicstudies"
            ]
        });

        const workflowSteps = document.querySelectorAll('.workflow-step');

        let activeStep = 0;

        setInterval(() => {

            workflowSteps.forEach(step => {
                step.classList.remove('active');

                const status = step.querySelector('.workflow-status');

                status.classList.remove('live');
            });

            workflowSteps[activeStep].classList.add('active');

            workflowSteps[activeStep]
                .querySelector('.workflow-status')
                .classList.add('live');

            activeStep++;

            if (activeStep >= workflowSteps.length) {
                activeStep = 0;
            }

        }, 2500);
    </script>
</body>

</html>