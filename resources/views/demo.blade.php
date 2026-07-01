<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/demo.css') }}">
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
            <header class="demo-dashboard-header">
                <div class="header-titles">
                    <div class="demo-badge"><i class="bx bx-unite"></i> Risk-Free Environment</div>
                    <h1>Demo Trading Workspace</h1>
                    <p>Practice live strategic trading maneuvers using zero-risk virtual capital matrices.</p>
                </div>
                <div class="header-action-group">
                    <a href="/demoTrade" class="fin-btn btn-primary"><i class="bx bx-plus-circle"></i> Start Demo
                        Trade</a>
                    <a href="/demoHistory" class="fin-btn btn-secondary"><i class="bx bx-history"></i> View
                        History</a>
                </div>
            </header>

            <section class="liquidity-glass-card">
                <div class="liquidity-info">
                    <span class="status-indicator"><span class="pulse-dot"></span> Demo Execution Layer Active</span>
                    <h2 id="virtualBalanceDisplay">$100,000.00</h2>
                    <p class="balance-label">Total Virtual Practice Balance (USD)</p>

                    <div class="compliance-row">
                        <span><i class="bx bx-shield-alt-2"></i> Protected Sandbox</span>
                        <span><i class="bx bx-data"></i> Live Order-Flow Sync</span>
                    </div>
                </div>
                <div class="liquidity-actions">
                    <a href="/" class="fin-btn btn-success"><i class="bx bx-transfer-alt"></i> Switch
                        to Live Trading</a>
                    <button class="fin-btn btn-dark-reset resetAccountTrigger"><i class="bx bx-refresh"></i> Reset
                        Account</button>
                </div>

                <div class="card-features-footer">
                    <span><i class="bx bx-check-double text-blue"></i> Unlimited Practice Trades</span>
                    <span><i class="bx bx-trending-up text-green"></i> Real-time Market Liquidity</span>
                    <span><i class="bx bx-lock-open-alt text-purple"></i> Full Architecture Testing</span>
                </div>
            </section>

            <section class="stats-four-column-grid">
                <div class="mini-stat-card">
                    <div class="stat-meta">
                        <p>Total Executed</p>
                        <h3 id="statTotalTrades">0</h3>
                    </div>
                    <div class="stat-icon-wrapper sh-blue"><i class="bx bx-chart"></i></div>
                </div>

                <div class="mini-stat-card">
                    <div class="stat-meta">
                        <p>Win Ratio</p>
                        <h3 id="statWinRate">0%</h3>
                    </div>
                    <div class="stat-icon-wrapper sh-green"><i class="bx bx-target-lock"></i></div>
                </div>

                <div class="mini-stat-card">
                    <div class="stat-meta">
                        <p>Accumulated P&L</p>
                        <h3 id="statTotalPnL" class="neutral-pnl">$0.00</h3>
                    </div>
                    <div class="stat-icon-wrapper sh-emerald"><i class="bx bx-dollar-circle"></i></div>
                </div>

                <div class="mini-stat-card">
                    <div class="stat-meta">
                        <p>Active Positions</p>
                        <h3 id="statActiveTrades">0</h3>
                    </div>
                    <div class="stat-icon-wrapper sh-orange"><i class="bx bx-pulse"></i></div>
                </div>
            </section>

            <section class="dashboard-split-deck">
                <div class="deck-panel quick-actions-panel">
                    <h4><i class="bx bx-grid-alt"></i> Execution Command Console</h4>
                    <div class="action-buttons-stack">
                        <a href="/demoTrade" class="fin-btn btn-primary btn-full"><i class="bx bx-plus-circle"></i>
                            Start New Position</a>
                        <a href="/demoHistory" class="fin-btn btn-secondary btn-full"><i
                                class="bx bx-receipt"></i> Audit Closed Ledgers</a>
                        <a href="/demoLive" class="fin-btn btn-success btn-full"><i class="bx bx-rocket"></i>
                            Go Live Production</a>
                        <button class="fin-btn btn-danger btn-full resetAccountTrigger"><i class="bx bx-reset"></i> Wipe
                            & Reset Environment</button>
                    </div>
                </div>

                <div class="deck-panel live-positions-panel">
                    <div class="panel-header-row">
                        <h4><i class="bx bx-list-check"></i> Monitored Live Positions</h4>
                        <span class="badge-count" id="positionBadgeCount">0 Active</span>
                    </div>

                    <div class="empty-positions-state" id="emptyPositionsWrapper">
                        <div class="radar-scan-container">
                            <i class="bx bx-radar"></i>
                        </div>
                        <h5>No Active Sandbox Positions Found</h5>
                        <p>Initialize a virtual order execution using the command buttons to see live performance
                            streams here.</p>
                    </div>
                </div>
            </section>
        </main>

    </div>

    <script src="{{ asset('assets/Frontend/js/demo.js') }}"></script>
</body>

</html>