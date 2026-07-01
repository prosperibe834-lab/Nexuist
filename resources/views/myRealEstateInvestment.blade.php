<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/myRealEstateInvestment.css') }}">
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
        <div class="dashboard-layout">
            <main class="main-content-area">
                <div class="portfolio-header animate-fade-in">
                    <div class="header-left">

                        <div class="breadcrumb-container">
                            <div class="breadcrumb">
                                <a href="/" class="breadcrumb-item">
                                    <i class='bx bx-home-alt icon-main'></i>
                                    <span>Home</span>
                                </a>

                                <i class='bx bx-chevron-right separator'></i>

                                <a href="/realestate" class="breadcrumb-item">
                                    <i class='bx bx-building-house icon-main'></i>
                                    <span>Real Estate</span>
                                </a>

                                <i class='bx bx-chevron-right separator'></i>

                                <div class="breadcrumb-item active-page">
                                    <i class='bx bx-wallet icon-main'></i>
                                    <span>My Investments</span>
                                </div>
                            </div>
                        </div>
                        <h2>My Real Estate Investments</h2>
                        <p>Track, manage, and optimize your tokenized property portfolio allocation.</p>
                    </div>
                    <a href="/realestate" class="btn-browse-properties">
                        <i class='bx bx-plus'></i> Browse Properties
                    </a>
                </div>

                <div class="metrics-grid">
                    <div class="metric-card card-slide-up" style="--delay: 1;">
                        <div class="metric-icon-wrapper blue-bg">
                            <i class='bx bx-wallet'></i>
                        </div>
                        <div class="metric-data">
                            <span class="label">Total Invested</span>
                            <h3 id="statTotalInvested">$0.00</h3>
                            <span class="subtext text-green"><i class='bx bx-trending-up'></i> Live Portfolio</span>
                        </div>
                    </div>

                    <div class="metric-card card-slide-up" style="--delay: 2;">
                        <div class="metric-icon-wrapper green-bg">
                            <i class='bx bx-line-chart'></i>
                        </div>
                        <div class="metric-data">
                            <span class="label">Total Profit Earned</span>
                            <h3 id="statTotalProfit" class="text-green">$0.00</h3>
                            <span class="subtext" id="statAvgApy">0.0% Avg. Estimated APY</span>
                        </div>
                    </div>

                    <div class="metric-card card-slide-up" style="--delay: 3;">
                        <div class="metric-icon-wrapper purple-bg">
                            <i class='bx bx-pie-chart-alt-2'></i>
                        </div>
                        <div class="metric-data">
                            <span class="label">Active Assets</span>
                            <h3 id="statActiveCount">0 Properties</h3>
                            <span class="subtext" id="statTotalTokens">0.00 Total Tokens Owned</span>
                        </div>
                    </div>
                </div>

                <div class="portfolio-split-frame">

                    <div class="frame-left-column animate-fade-in">

                        <div class="fintech-panel panel-chart">
                            <div class="panel-header">
                                <h4><i class='bx bx-pulse'></i> Portfolio Yield Growth projection</h4>
                                <span class="timeline-pill">12 Month Forecast</span>
                            </div>
                            <div class="chart-mockup-container">
                                <div class="chart-track-line"></div>
                                <div class="chart-node highlight-blue" style="left: 10%; bottom: 20%;"
                                    data-tip="Month 1"></div>
                                <div class="chart-node highlight-blue" style="left: 30%; bottom: 35%;"
                                    data-tip="Month 4"></div>
                                <div class="chart-node highlight-blue" style="left: 50%; bottom: 42%;"
                                    data-tip="Month 6"></div>
                                <div class="chart-node highlight-blue" style="left: 75%; bottom: 68%;"
                                    data-tip="Month 9"></div>
                                <div class="chart-node highlight-main-node" style="left: 95%; bottom: 85%;"
                                    data-tip="Target Compound"></div>

                                <div class="grid-line" style="bottom: 25%;"></div>
                                <div class="grid-line" style="bottom: 50%;"></div>
                                <div class="grid-line" style="bottom: 75%;"></div>
                            </div>
                            <div class="chart-labels">
                                <span>Jan</span><span>Apr</span><span>Jul</span><span>Oct</span><span>Dec</span>
                            </div>
                        </div>

                        <div class="fintech-panel">
                            <div class="panel-header">
                                <h4><i class='bx bx-list-ul'></i> Active Asset Ledger</h4>
                                <button class="btn-panel-action" id="btnClearStorage">Clear Simulation</button>
                            </div>

                            <div class="empty-state-wrapper hidden" id="emptyStateContainer">
                                <div class="empty-house-icon">
                                    <i class='bx bx-home-alt-validate'></i>
                                </div>
                                <h5>No investments active yet</h5>
                                <p>Start building your modern tokenized fractional property real estate portfolio today.
                                </p>
                                <a href="/realestate" class="btn-action-primary">Browse Active Asset Markets</a>
                            </div>

                            <div class="table-responsive-wrapper" id="tableContentContainer">
                                <table class="holdings-data-table">
                                    <thead>
                                        <tr>
                                            <th>Property Name</th>
                                            <th>Amount Deposited</th>
                                            <th>Tokens Minted</th>
                                            <th>Estimated APY</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="holdingsTableBody">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="frame-right-column animate-fade-in">
                        <div class="fintech-panel">
                            <div class="panel-header">
                                <h4><i class='bx bx-shield-quarter'></i> Security & Compliance Verification</h4>
                            </div>
                            <div class="compliance-badge-item">
                                <i class='bx bx-check-shield text-green'></i>
                                <div>
                                    <h6>Smart Contract Audited</h6>
                                    <p>Fractional tokenization allocation vault fully verified.</p>
                                </div>
                            </div>
                            <div class="compliance-badge-item">
                                <i class='bx bx-refresh text-blue'></i>
                                <div>
                                    <h6>Daily Yield Disbursal</h6>
                                    <p>Accrued dividend values refresh on balance structures at 00:00 UTC.</p>
                                </div>
                            </div>
                        </div>

                        <div class="fintech-panel balance-multiplier-panel">
                            <h5>Maximize Passive Returns</h5>
                            <p>Compound your earned rewards instantly back into high-yield property tokens
                                automatically.</p>
                            <button class="btn-premium-action">Enable Auto-Compounding</button>
                        </div>

                    </div>

                </div>
            </main>
        </div>

    </div>


    <div class="toast-notification" id="compoundingToast">
        <div class="toast-content">
            <i class='bx bx-check-circle toast-icon'></i>
            <div class="toast-text">
                <h5>Auto-Compounding Enabled</h5>
                <p>Your daily rental yields will now automatically reinvest!</p>
            </div>
        </div>
    </div>

    
    <script src="{{ asset('assets/Frontend/js/myRealEstateInvestment.js') }}"></script>
</body>

</html>