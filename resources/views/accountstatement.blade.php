<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/accountstatement.css') }}">


    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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



        <!-- Main section starts here -->
        <main class="content-area">
            <div class="statement-header">
                <div class="header-icon">
                    <span class="iconify" data-icon="ri:bank-card-fill"></span>
                </div>
                <div class="header-title">
                    <h1>Account Statement</h1>
                    <p>Monitor all your financial activities and filter specific transaction types.</p>
                </div>
            </div>

            <div class="card statement-container">
                <div class="control-row">
                    <div class="type-tabs">
                        <button class="type-tab active" data-type="all">All</button>
                        <button class="type-tab" data-type="deposit"><span class="iconify"
                                data-icon="ri:arrow-left-down-line"></span> Deposits</button>
                        <button class="type-tab" data-type="withdrawal"><span class="iconify"
                                data-icon="ri:arrow-right-up-line"></span> Withdrawals</button>
                        <button class="type-tab" data-type="others">Others</button>
                    </div>
                    <div class="search-box">
                        <span class="iconify" data-icon="ri:search-line"></span>
                        <input type="text" id="tableSearch" placeholder="Search deposits, wire, or bank...">
                    </div>
                </div>

                <div class="filter-row">
                    <div class="filter-group">
                        <label>Date Range</label>
                        <select id="dateFilter">
                            <option value="all">All Time</option>
                            <option value="30">Last 30 Days</option>
                            <option value="60">Last 60 Days</option>
                            <option value="90">Last 90 Days</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Currency</label>
                        <select id="currencyFilter">
                            <option value="all">All Currencies</option>
                            <option value="USD">USD</option>
                            <option value="USDC">USDC</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select id="statusFilter">
                            <option value="all">All Status</option>
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Failed">Failed</option>
                        </select>
                    </div>
                    <button class="btn-filter" id="resetFilters">Reset</button>
                </div>

                <div class="table-responsive">
                    <table class="fintech-table">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Currency</th>
                                <th>Source/Destination</th>
                                <th>Reference</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="statementTableBody">
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <p id="showing-count">Showing 0 transactions</p>
                    <div class="pagination">
                        <button class="page-link"><span class="iconify"
                                data-icon="ri:arrow-left-s-line"></span></button>
                        <button class="page-link active">1</button>
                        <button class="page-link">2</button>
                        <button class="page-link"><span class="iconify"
                                data-icon="ri:arrow-right-s-line"></span></button>
                    </div>
                </div>
                
            </div>
        </main>

    </div>

    <script src="{{ asset('assets/Frontend/js/accountstatement.js') }}"></script>
</body>

</html>