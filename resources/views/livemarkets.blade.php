<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/livemarkets.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="main-wrapper">
            <div class="market-controls">
                <h1>Live Markets <span class="live-dot"></span></h1>

                <div class="tabs">
                    <button class="filter-btn active" onclick="filterCategory('all', event)">All Markets</button>
                    <button class="filter-btn" onclick="filterCategory('crypto', event)">Cryptocurrency</button>
                    <button class="filter-btn" onclick="filterCategory('stocks', event)">Stocks</button>
                    <button class="filter-btn" onclick="filterCategory('forex', event)">Forex</button>
                    <button class="filter-btn" onclick="filterCategory('commodities', event)">Commodities</button>
                </div>

                <div class="search-container">
                    <i class='bx bx-search'></i>
                    <input type="text" id="assetSearch" placeholder="Search Assets..." onkeyup="searchAssets()">
                </div>
            </div>

            <div class="market-table-container">
                <div class="market-row market-header">
                    <div>Asset</div>
                    <div>Price</div>
                    <div>24h Change</div>
                    <div>Trend</div>
                    <div>Action</div>
                </div>
                <div id="marketList">
                    <!-- JS will populate this -->
                </div>
            </div>
        </div>

        <!-- 4. Trading Terminal -->
        <div id="tradingTerminal" class="trading-modal">
            <div class="terminal-container">
                <div class="chart-section">
                    <!-- Inside your trading terminal header or top corner -->
                    <div class="close-terminal" onclick="closeTerminal()">
                        <i class='bx bx-x'></i>
                    </div>
                    <!-- Real TradingView Widget -->
                    <div id="tradingview_widget" style="height: 100%;"></div>
                </div>

                <div class="order-section">
                    <h3 id="orderTitle">BTC/USD</h3>
                    <div class="order-tabs">
                        <button class="tab-buy">BUY</button>
                        <button class="tab-sell">SELL</button>
                    </div>

                    <div class="form-field">
                        <label>ORDER TYPE</label>
                        <select>
                            <option>Market Order</option>
                            <option>Limit Order</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label>LEVERAGE</label>
                        <select>
                            <option>1:10</option>
                            <option>1:50</option>
                            <option>1:100</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label>AMOUNT ($)</label>
                        <input type="number" placeholder="0.00">
                        <div style="display:flex; justify-content:space-between; margin-top:5px; font-size:10px;">
                            <span onclick="setVal(25)">25%</span><span onclick="setVal(50)">50%</span><span
                                onclick="setVal(100)">MAX</span>
                        </div> <br>
                        <button class="success-confirm-btn tab-buy-final" onclick="handlePlaceOrder()"
                            style="height:55px;">PLACE BUY ORDER</button>
                    </div>

                    <div id="orderSuccessModal" class="success-overlay">
                        <div class="success-card">
                            <!-- Success Icon with Glow -->
                            <div class="success-icon-wrapper">
                                <div class="icon-pulse"></div>
                                <i class='bx bx-check-circle'></i>
                            </div>

                            <div class="success-content">
                                <h2>Order Executed</h2>
                                <p id="successMessage">Your market order has been processed. The assets will reflect in
                                    your portfolio momentarily.</p>
                            </div>

                            <!-- Detail Summary (Makes it look pro) -->
                            <div class="success-summary">
                                <div class="summary-item">
                                    <span>Status</span>
                                    <span class="status-badge">Completed</span>
                                </div>
                                <div class="summary-item">
                                    <span>Network</span>
                                    <span>Nexuist Secure</span>
                                </div>
                            </div>

                            <button class="success-confirm-btn" onclick="closeSuccessModal()">Done</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- TradingView Library -->
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script src="{{ asset('assets/Frontend/js/livemarkets.js') }}"></script>
    
</body>

</html>