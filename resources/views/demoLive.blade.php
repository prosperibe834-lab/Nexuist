<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/demoLive.css') }}">
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
            <div id="marketsDashboardView">
                <header class="terminal-header">
                    <div class="terminal-title">
                        <span class="badge-sandbox"><i class="bx bx-globe"></i> Live Institutional Feed</span>
                        <h1>Trading Markets</h1>
                        <p>Monitor real-time price discovery loops and execute high-fidelity order flows.</p>
                    </div>
                    <div class="search-input-wrapper">
                        <i class="bx bx-search search-left-icon"></i>
                        <input type="text" id="marketSearchInput" placeholder="Search instruments by symbol or name...">
                    </div>
                </header>

                <div class="category-filter-deck">
                    <button class="filter-tab is-active" data-category="all"><i class="bx bx-grid-alt"></i> All
                        Markets</button>
                    <button class="filter-tab" data-category="crypto"><i class="bx bx-bitcoin"></i>
                        Cryptocurrency</button>
                    <button class="filter-tab" data-category="stocks"><i class="bx bx-trending-up"></i> Stocks</button>
                    <button class="filter-tab" data-category="forex"><i class="bx bx-dollar"></i> Forex</button>
                    <button class="filter-tab" data-category="commodities"><i class="bx bx-gold"></i>
                        Commodities</button>
                    <button class="filter-tab" data-category="bonds"><i class="bx bx-file"></i> Bonds</button>
                </div>

                <div class="market-table-container">
                    <table class="fintech-market-table">
                        <thead>
                            <tr>
                                <th>Asset Name</th>
                                <th>Live Spot Price</th>
                                <th>24h Change</th>
                                <th>Market Dynamic Cap</th>
                                <th class="text-right">Action Vector</th>
                            </tr>
                        </thead>
                        <tbody id="marketTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tradingTerminalView" class="hidden-view">
                <header class="terminal-back-bar">
                    <button id="closeTerminalBtn" class="back-link-btn"><i class="bx bx-arrow-back"></i> Back to Live
                        Markets</button>
                </header>

                <div class="terminal-workspace-layout">
                    <div class="terminal-left-column">
                        <div class="asset-ticker-banner">
                            <div class="ticker-identity">
                                <div class="ticker-avatar" id="termAssetIcon"><i class="bx bx-coin-stack"></i></div>
                                <div>
                                    <h2 id="termAssetName">Bitcoin</h2>
                                    <span id="termAssetSymbol">BTC/USD</span>
                                </div>
                            </div>
                            <div class="ticker-pricing text-right">
                                <h2 id="termAssetPrice">$71,438.00</h2>
                                <span id="termAssetChange" class="change-pos">+1.38%</span>
                            </div>
                        </div>

                        <div class="technical-chart-box">
                            <div id="tradingview_live_chart_element" style="width: 100%; height: 100%;"></div>
                        </div>

                        <div class="market-statistics-panel">
                            <div class="stat-capsule">
                                <span class="cap-lbl">24h High</span>
                                <span class="cap-val text-green" id="termStatHigh">$72,100.00</span>
                            </div>
                            <div class="stat-capsule">
                                <span class="cap-lbl">24h Low</span>
                                <span class="cap-val text-red" id="termStatLow">$70,250.00</span>
                            </div>
                            <div class="stat-capsule">
                                <span class="cap-lbl">24h Volume</span>
                                <span class="cap-val" id="termStatVolume">$24.8B</span>
                            </div>
                            <div class="stat-capsule">
                                <span class="cap-lbl">Market Cap</span>
                                <span class="cap-val" id="termStatCap">$1.4T</span>
                            </div>
                        </div>
                    </div>

                    <div class="terminal-panel order-execution-panel">
                        <h3 class="panel-heading"><i class="bx bx-transfer-alt"></i> Route Position Order</h3>

                        <div class="order-type-tabs">
                            <button type="button" class="order-dir-btn btn-buy active" id="terminalBuyTab">Buy /
                                Long</button>
                            <button type="button" class="order-dir-btn btn-sell" id="terminalSellTab">Sell /
                                Short</button>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Order Routing Protocol</label>
                            <div class="select-input-wrapper">
                                <select class="custom-select-field no-arrow-icon">
                                    <option>Market Execution (Instant Sync)</option>
                                    <option>Limit Order Array Protocol</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Leverage Multiplier Bracket</label>
                            <div class="select-input-wrapper">
                                <select class="custom-select-field no-arrow-icon" id="termLeverageSelector">
                                    <option value="1">1x (Spot Margin Isolated)</option>
                                    <option value="5">5x Allocation Multiplier</option>
                                    <option value="10">10x Balanced Execution Bracket</option>
                                    <option value="20">20x High Velocity Loop Risk</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Investment Principal Amount</label>
                            <div class="input-addon-container">
                                <span class="addon-prefix">$</span>
                                <input type="number" class="matrix-number-input" id="termAmountInput" min="5"
                                    placeholder="0.00" value="100">
                            </div>
                        </div>

                        <div class="quick-allocation-deck">
                            <button type="button" class="quick-amt-node" data-value="100">$100</button>
                            <button type="button" class="quick-amt-node" data-value="500">$500</button>
                            <button type="button" class="quick-amt-node" data-value="1000">$1,000</button>
                            <button type="button" class="quick-amt-node" data-value="5000">$5,000</button>
                        </div>

                        <div class="ticket-summary-card">
                            <div class="ticket-row">
                                <span class="t-lbl">Notional Multiplied Volume</span>
                                <span class="t-val" id="termSummaryNotional">$100.00</span>
                            </div>
                            <div class="ticket-row">
                                <span class="t-lbl">Contract Estimated Units</span>
                                <span class="t-val" id="termSummaryUnits">0.0014 units</span>
                            </div>
                        </div>

                        <button type="button" class="execute-order-btn" id="terminalFinalSubmitBtn">
                            Confirm & Transmit Order
                        </button>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <script src="{{ asset('assets/Frontend/js/demoLive.js') }}"></script>
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js" ></script>
</body>

</html>