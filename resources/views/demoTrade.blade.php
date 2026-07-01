<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/demoTrade.css') }}">
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
            <header class="terminal-header">
                <div class="terminal-title">
                    <span class="badge-sandbox"><i class="bx bx-terminal"></i> Sandbox Environment</span>
                    <h1>Execute Virtual Trade</h1>
                    <p>Deploy hypothetical configurations to real-time market order-flow simulation paths.</p>
                </div>
                <div class="terminal-balance-capsule">
                    <div class="capsule-label">Available Balance</div>
                    <div class="capsule-value" id="terminalAvailableBalance">${{ number_format(Auth::user()->demo_balance ?? 0, 2) }}</div>
                </div>
            </header>

            <div class="terminal-grid">

                <form class="terminal-panel order-form" id="demoTradeForm" onsubmit="event.preventDefault();">
                    <h3 class="panel-heading"><i class="bx bx-slider-alt"></i> Position Parameters</h3>

                    <div class="form-group-row">
                        <label class="field-label">Select Active Instrument <span class="required">*</span></label>
                        <div class="select-input-wrapper">
                            <i class="bx bx-search-alt-2 select-left-icon"></i>
                            <select class="custom-select-field" id="assetSelector" required>
                                <option value="" disabled selected>Choose an asset to trade...</option>
                                <option value="BTC" data-price="67450">BTC / USD (Bitcoin)</option>
                                <option value="ETH" data-price="3480">ETH / USD (Ethereum)</option>
                                <option value="AAPL" data-price="185">AAPL (Apple Inc. Equity)</option>
                                <option value="NVDA" data-price="875">NVDA (NVIDIA Corporation)</option>
                                <option value="EURUSD" data-price="1.08">EUR / USD (Euro / US Dollar)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-row">
                        <label class="field-label">Execution Vector Direction <span class="required">*</span></label>
                        <div class="direction-toggle-deck">
                            <button type="button" class="direction-node node-buy" data-direction="BUY">
                                <div class="node-indicator-ring"><i class="bx bx-trending-up"></i></div>
                                <div class="node-meta">
                                    <span class="action-heading">BUY / LONG</span>
                                    <span class="action-sub">Speculate Price Appreciates</span>
                                </div>
                            </button>

                            <button type="button" class="direction-node node-sell" data-direction="SELL">
                                <div class="node-indicator-ring"><i class="bx bx-trending-down"></i></div>
                                <div class="node-meta">
                                    <span class="action-heading">SELL / SHORT</span>
                                    <span class="action-sub">Speculate Price Depreciates</span>
                                </div>
                            </button>
                        </div>
                        <input type="hidden" id="tradeDirectionInput" required>
                    </div>

                    <div class="allocation-matrix-grid">
                        <div class="form-group-row">
                            <label class="field-label">Investment Principal <span class="required">*</span></label>
                            <div class="input-addon-container">
                                <span class="addon-prefix">$</span>
                                <input type="number" class="matrix-number-input" id="tradeAmountInput" min="10"
                                    max="100000" placeholder="0.00" required>
                            </div>
                            <span class="input-hint-caption">Max Allowed Allocation: <span
                                    id="maxLabel">$100,000.00</span></span>
                        </div>

                        <div class="form-group-row">
                            <label class="field-label">Leverage Multiplier <span class="required">*</span></label>
                            <div class="select-input-wrapper">
                                <i class="bx bx-shield-quarter select-left-icon"></i>
                                <select class="custom-select-field" id="leverageSelector" required>
                                    <option value="1">1x (Spot / No Leverage)</option>
                                    <option value="5">5x (Conservative Leverage)</option>
                                    <option value="10">10x (Balanced Leverage)</option>
                                    <option value="20">20x (Advanced Core Risk)</option>
                                    <option value="50">50x (Max High-Volatility Loop)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-row">
                        <label class="field-label">Contract Execution Window <span class="required">*</span></label>
                        <div class="select-input-wrapper">
                            <i class="bx bx-time-five select-left-icon"></i>
                            <select class="custom-select-field" id="durationSelector" required>
                                <option value="5">5 Minutes Contract Loop</option>
                                <option value="15">15 Minutes Contract Loop</option>
                                <option value="60">1 Hour Automated Expiry</option>
                                <option value="1440">24 Hours Standard Cycle</option>
                            </select>
                        </div>
                    </div>

                    <div class="ticket-summary-card">
                        <div class="ticket-header">
                            <span><i class="bx bx-receipt"></i> Pre-Execution Ticket</span>
                            <span class="ticker-live-dot" id="summaryAsset">ASSET: NONE</span>
                        </div>
                        <div class="ticket-body">
                            <div class="ticket-row">
                                <span class="t-lbl">Notional Position Value</span>
                                <span class="t-val" id="summaryNotionalValue">$0.00</span>
                            </div>
                            <div class="ticket-row">
                                <span class="t-lbl">Calculated Maximum System Risk</span>
                                <span class="t-val risk-alert-color" id="summaryMaxRisk">$0.00</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="execute-order-btn" id="submitOrderBtn">
                        <i class="bx bx-play-circle"></i> Transmit Order to Sandbox
                    </button>
                </form>

                <div class="terminal-side-deck">

                    <div class="terminal-panel tips-panel">
                        <h4 class="side-panel-heading"><i class="bx bx-bulb text-yellow"></i> Architecture Intelligence
                        </h4>
                        <ul class="fintech-bullet-list">
                            <li>
                                <div class="bullet-indicator dot-blue"></div>
                                <div class="bullet-content">
                                    <h6>Risk Exposure Mitigation</h6>
                                    <p>Never lock more than 5% of aggregate liquidity arrays into singular order
                                        structures, even inside isolated demo environments.</p>
                                </div>
                            </li>
                            <li>
                                <div class="bullet-indicator dot-green"></div>
                                <div class="bullet-content">
                                    <h6>Fractional Incremental Calibration</h6>
                                    <p>Scale initial operations utilizing conservative multiplier metrics to map
                                        real-time performance profiles without liquidity slippage.</p>
                                </div>
                            </li>
                            <li>
                                <div class="bullet-indicator dot-yellow"></div>
                                <div class="bullet-content">
                                    <h6>Leverage Isolation Warnings</h6>
                                    <p>Elevated multipliers scale net distributions linearly but compress absolute
                                        liquidity distances from potential liquidation limits.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="terminal-panel micro-account-panel">
                        <h4 class="side-panel-heading"><i class="bx bx-user-circle"></i> Sandbox Identity Parameters
                        </h4>
                        <div class="meta-profile-strip">
                            <span class="meta-lbl">Account Routing Mode</span>
                            <span class="meta-val mode-badge-demo">DEMO ACTIVE</span>
                        </div>
                        <div class="meta-profile-strip">
                            <span class="meta-lbl">Base Operating Currency</span>
                            <span class="meta-val">USD ($)</span>
                        </div>

                        <button type="button" class="terminal-reset-btn" id="terminalResetBtn">
                            <i class="bx bx-refresh"></i> Reset Simulator Matrix
                        </button>
                    </div>
                </div>

            </div>
        </main>

    </div>

    <script src="{{ asset('assets/Frontend/js/demoTrade.js') }}"></script>
</body>

</html>