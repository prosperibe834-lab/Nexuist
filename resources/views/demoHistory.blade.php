<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/demoHistory.css') }}">
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
        <div class="nexuist-dashboard-container">
            <header class="nexuist-main-header">
                <div class="header-title-block">
                    <h1>Demo Trading History</h1>
                    <p>Review your past demo trades and track your performance</p>
                </div>
                <div class="header-actions">
                    <div class="balance-display">
                        <i class='bx bx-wallet'></i>
                        <span>Balance: <strong id="header-balance">$100,000.97</strong></span>
                    </div>
                    <a href="/demo" class="btn btn-primary">
                        <i class='bx bx-plus-circle'></i> New Trade
                    </a>
                    <a href="/" class="btn btn-secondary">
                        <i class='bx bx-grid-alt'></i> Dashboard
                    </a>
                </div>
            </header>

            <section class="metrics-grid">
                <div class="metric-card animate-fade-in">
                    <div class="metric-info">
                        <span class="metric-label">Total Trades</span>
                        <h3 class="metric-value" id="stat-total-trades">1</h3>
                    </div>
                    <div class="metric-icon icon-blue">
                        <i class='bx bx-trending-up'></i>
                    </div>
                </div>
                <div class="metric-card animate-fade-in">
                    <div class="metric-info">
                        <span class="metric-label">Win Rate</span>
                        <h3 class="metric-value" id="stat-win-rate">0%</h3>
                    </div>
                    <div class="metric-icon icon-green">
                        <i class='bx bx-target-lock'></i>
                    </div>
                </div>
                <div class="metric-card animate-fade-in">
                    <div class="metric-info">
                        <span class="metric-label">Total P&L</span>
                        <h3 class="metric-value success-text" id="stat-total-pnl">$0.00</h3>
                    </div>
                    <div class="metric-icon icon-emerald">
                        <i class='bx bx-dollar'></i>
                    </div>
                </div>
                <div class="metric-card animate-fade-in">
                    <div class="metric-info">
                        <span class="metric-label">Active Trades</span>
                        <h3 class="metric-value" id="stat-active-trades">1</h3>
                    </div>
                    <div class="metric-icon icon-orange">
                        <i class='bx bx-pulse'></i>
                    </div>
                </div>
            </section>

            <section class="filter-panel animate-fade-in">
                <div class="filter-panel-header">
                    <div class="panel-title">
                        <i class='bx bx-filter-alt'></i>
                        <span>Advanced Search Filters</span>
                    </div>
                    <button type="button" class="toggle-filters-btn" id="toggle-filter-view">
                        <span class="btn-text">Hide Filters</span>
                        <i class='bx bx-chevron-up'></i>
                    </button>
                </div>

                <form id="filter-form" class="filter-form-content">
                    <div class="filter-inputs-grid">
                        <div class="form-group">
                            <label for="filter-status">Status</label>
                            <select id="filter-status" name="status">
                                <option value="all">All Status</option>
                                <option value="active">Active</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter-type">Trade Type</label>
                            <select id="filter-type" name="type">
                                <option value="all">All Types</option>
                                <option value="buy">Buy</option>
                                <option value="sell">Sell</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter-result">Result</label>
                            <select id="filter-result" name="result">
                                <option value="all">All Results</option>
                                <option value="profit">Profit</option>
                                <option value="loss">Loss</option>
                                <option value="break-even">Break Even</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="filter-per-page">Per Page</label>
                            <select id="filter-per-page" name="perPage">
                                <option value="10">10</option>
                                <option value="20" selected>20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="form-group md-col-2">
                            <label for="filter-asset">Asset Pair</label>
                            <div class="input-with-icon">
                                <i class='bx bx-search-alt'></i>
                                <input type="text" id="filter-asset" placeholder="e.g., BTC, ETH, BSC-USD">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="filter-from-date">From Date</label>
                            <input type="date" id="filter-from-date">
                        </div>
                        <div class="form-group">
                            <label for="filter-to-date">To Date</label>
                            <input type="date" id="filter-to-date">
                        </div>
                    </div>
                    <div class="filter-actions-footer">
                        <button type="submit" class="btn btn-action-primary">
                            <i class='bx bx-check-double'></i> Apply Filters
                        </button>
                        <button type="button" id="reset-filters-btn" class="btn btn-action-secondary">
                            <i class='bx bx-refresh'></i> Clear Filters
                        </button>
                    </div>
                </form>
            </section>

            <section class="table-container-wrapper animate-fade-in">
                <div class="table-header-meta">
                    <h3>Execution Records</h3>
                    <span class="badge" id="trade-count-badge">1 Trade Found</span>
                </div>

                <div class="responsive-table-scroller">
                    <table class="nexuist-table" id="trading-table">
                        <thead>
                            <tr>
                                <th>Asset</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Leverage</th>
                                <th>Entry Price</th>
                                <th>Current Price</th>
                                <th>P&L</th>
                                <th>Status</th>
                                <th>Date Execution</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-target">
                            <tr data-asset="BSC-USD/USD" data-type="sell" data-status="active" data-date="2026-05-20"
                                data-pnl="0.00">
                                <td>
                                    <div class="asset-cell">
                                        <i class='bx bx-coin-stack'></i>
                                        <span>BSC-USD/USD</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-danger">Sell</span></td>
                                <td><strong>$1.03</strong></td>
                                <td class="text-secondary">1x</td>
                                <td>$1.0010</td>
                                <td>$1.0010</td>
                                <td>
                                    <div class="pnl-cell neutral">
                                        <span class="pnl-amount">+$0.00</span>
                                        <span class="pnl-percent">(+0.00%)</span>
                                    </div>
                                </td>
                                <td><span class="status-indicator status-active">Active</span></td>
                                <td class="date-cell">
                                    <span>May 20, 2026</span>
                                    <small>15:28</small>
                                </td>
                                <td class="text-right">
                                    <button class="btn-table-action btn-close-trade" title="Close Position">
                                        <i class='bx bx-x-circle'></i> Close
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer-pagination">
                    <span id="pagination-info">Showing 1 trade record</span>
                </div>
            </section>
        </div>

    </div>

    <script src="{{ asset('assets/Frontend/js/demoHistory.js') }}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

</body>

</html>