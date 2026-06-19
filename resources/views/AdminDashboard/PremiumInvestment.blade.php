<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/PremiumInvestment.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div id="nexuist-preloader">
        <div class="loader-terminal-box">
            <i class='bx bx-cube-alt loader-brand-icon'></i>
            <div class="glow-bars-container">
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
            </div>
            <span class="loader-status-text">CONNECTING TO SECURE NODE...</span>
        </div>
    </div>

    <nav class="sidebar" id="sidebar">
        <div class="logo-details">
            <i class='bx bx-cube-alt logo-icon'></i>
            <span class="logo_name">NEXUIST</span>
            <i class='bx bx-chevron-left' id="sidebar-toggle-btn"></i>
        </div>

        <ul class="nav-links">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/users') }}">
                    <i class='bx bx-user-pin'></i>
                    <span class="link_name">Users Management</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/users">Users Management</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/deposits') }}">
                    <i class='bx bx-credit-card'></i>
                    <span class="link_name">Deposits</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/deposits') }}">Deposits</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/withdrawals') }}">
                    <i class='bx bx-transfer'></i>
                    <span class="link_name">Withdrawals</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/withdrawals">Withdrawals</a></li>
                </ul>
            </li>

           

            <li>
                <a href="{{ url('/investment-plans') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Investment Plans</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/investment-plans">Investment Plans</a></li>
                </ul>
            </li>

            <li class="active">
                <a href="{{ url('/PremiumInvestment') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Premium Investment</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/PremiumInvestment">Premium Investment</a></li>
                </ul>
            </li>

             <li>
                <a href="{{ url('/StockMarket') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">StockMarket</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/StockMarket">StockMarket</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/Crypto') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Crypto</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/Crypto">Crypto</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/AdminRealEstate') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Real Estate</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/AdminRealEstate">Real Estate</a></li>
                </ul>
            </li>
            
            <li>
                <a href="/ai-bot">
                    <i class='bx bx-bot'></i>
                    <span class="link_name">AI Bot Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/ai-bot">AI Bot Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/copy-trading') }}">
                    <i class='bx bx-copy-alt'></i>
                    <span class="link_name">Copy Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/copy-trading">Copy Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/internal-transfers') }}">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="link_name">Internal Transfers</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/internal-transfers">Internal Transfers</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/performance') }}">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="link_name">Performance History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/performance">Performance History</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/AdminPortfolio') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Portfolio Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/AdminPortfolio">Portfolio Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/statements') }}">
                    <i class='bx bx-file-find'></i>
                    <span class="link_name">Account Statements</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/statements">Account Statements</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/kyc') }}">
                    <i class='bx bx-id-card'></i>
                    <span class="link_name">KYC Verification</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/kyc">KYC Verification</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/loans') }}">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Loan Requests</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/loans">Loan Requests</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/notifications">Notifications</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/AdminSupport') }}">
                    <i class='bx bx-support'></i>
                    <span class="link_name">Messages & Support</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/AdminSupport">Messages & Support</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/transactions') }}">
                    <i class='bx bx-receipt'></i>
                    <span class="link_name">Transaction Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/transactions">Transaction Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/website-settings') }}">
                    <i class='bx bx-globe'></i>
                    <span class="link_name">Website Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/website-settings">Website Settings</a></li>
                </ul>
            </li>
            <li>
                <a href="/security">
                    <i class='bx bx-shield-quarter'></i>
                    <span class="link_name">Security Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/security">Security Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/admin-settings') }}">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Admin Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/admin-settings">Admin Settings</a></li>
                </ul>
            </li>

            <li class="control-items">
                <div class="mode-toggle-wrapper">
                    <div class="mode-text-wrapper">
                        <i class='bx bx-moon mode-icon-indicator'></i>
                        <span class="link_name mode-label">Dark Mode</span>
                    </div>
                    <div class="toggle-switch-track">
                        <span class="switch-thumb"></span>
                    </div>
                </div>
            </li>

            <li class="logout-item">
                <a href="logout.html">
                    <i class='bx bx-log-out-circle'></i>
                    <span class="link_name">Logout</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="logout.html">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">PremiumInvestment</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nexuist-dashboard-container">
    
    <div class="nexuist-subbar">
        <div class="subbar-info">
            <h1>Nexuist Premium Signals</h1>
            <p>Institutional Trading Signals Management Control Center</p>
        </div>
        <div class="nexuist-tab-container">
            <button class="tab-btn active" data-target="overview-module"><i class="bx bx-grid-alt"></i> Overview</button>
            <button class="tab-btn" data-target="package-module"><i class="bx bx-package"></i> Signal Packages</button>
            <button class="tab-btn" data-target="live-module"><i class="bx bx-broadcast"></i> Live Signals</button>
            <button class="tab-btn" data-target="subscribers-module"><i class="bx bx-group"></i> Subscribers</button>
            <button class="tab-btn" data-target="payments-module"><i class="bx bx-credit-card"></i> Payments</button>
            <button class="tab-btn" data-target="notifications-module"><i class="bx bx-bell"></i> Alerts System</button>
        </div>
    </div>

    <section id="overview-module" class="module-view active-view">
        <div class="fintech-grid-4">
            <div class="glass-card stat-card glow-on-hover">
                <div class="stat-icon p-blue"><i class="bx bx-signal-5 animate-pulse"></i></div>
                <div class="stat-details">
                    <span class="stat-lbl">Total Active Signals</span>
                    <h3>{{ $stats['activePackages'] ?? 0 }}</h3>
                    <span class="stat-trend up"><i class="bx bx-trending-up"></i> Premium catalog</span>
                </div>
            </div>
            <div class="glass-card stat-card glow-on-hover">
                <div class="stat-icon p-purple"><i class="bx bx-user-check"></i></div>
                <div class="stat-details">
                    <span class="stat-lbl">Active Premium Members</span>
                    <h3>{{ $stats['totalSubscribers'] ?? 0 }}</h3>
                    <span class="stat-trend up"><i class="bx bx-trending-up"></i> Active subscriber base</span>
                </div>
            </div>
            <div class="glass-card stat-card glow-on-hover">
                <div class="stat-icon p-gold"><i class="bx bx-wallet"></i></div>
                <div class="stat-details">
                    <span class="stat-lbl">Monthly Revenue (MRR)</span>
                    <h3>${{ number_format($stats['totalInvestment'] ?? 0, 2) }}</h3>
                    <span class="stat-trend up"><i class="bx bx-trending-up"></i> Total investment volume</span>
                </div>
            </div>
            <div class="glass-card stat-card glow-on-hover">
                <div class="stat-icon p-green"><i class="bx bx-pie-chart-alt-2"></i></div>
                <div class="stat-details">
                    <span class="stat-lbl">Signal Success Rate</span>
                    <h3>{{ $stats['averageAccuracy'] ?? 0 }}%</h3>
                    <span class="stat-trend stable"><i class="bx bx-check-shield"></i> Average bot accuracy</span>
                </div>
            </div>
        </div>

        <div class="fintech-grid-3 mt-4">
            <div class="glass-card perf-card">
                <h4><i class="bx bx-analyse text-blue"></i> Signal Performance Tracking</h4>
                <div class="perf-metric-row"><span>Total Signals Sent</span><strong>{{ $stats['totalSignalsSent'] ?? 0 }}</strong></div>
                <div class="perf-metric-row"><span>Total Winning Signals</span><strong class="text-green">{{ $stats['winningSignals'] ?? 0 }}</strong></div>
                <div class="perf-metric-row"><span>Total Losing Signals</span><strong class="text-red">{{ $stats['losingSignals'] ?? 0 }}</strong></div>
                <div class="perf-metric-row"><span>Average Profit Target</span><strong class="text-gold">+{{ $stats['averageProfitTarget'] ?? 0 }}%</strong></div>
            </div>
            <div class="glass-card perf-card">
                <h4><i class="bx bx-medal text-gold"></i> Alpha Asset Metrics</h4>
                <div class="perf-metric-row"><span>Best Performing Signal</span><strong class="text-green">BTC/USDT (Crypto)</strong></div>
                <div class="perf-metric-row"><span>Worst Performing Signal</span><strong class="text-red">EUR/GBP (Forex)</strong></div>
                <div class="perf-metric-row"><span>Trending Sector</span><strong class="text-purple">Commodities (Gold)</strong></div>
                <div class="perf-metric-row"><span>Total Profit Generated</span><strong class="text-gold">$1.24M</strong></div>
            </div>
            <div class="glass-card chart-placeholder-card">
                <h4><i class="bx bx-line-chart text-purple"></i> Signal Accuracy History</h4>
                <div class="mock-chart-container">
                    <div class="mock-bar" style="height: 75%"><span>75%</span></div>
                    <div class="mock-bar" style="height: 82%"><span>82%</span></div>
                    <div class="mock-bar" style="height: 89%"><span>89%</span></div>
                    <div class="mock-bar active-bar" style="height: 87.4%"><span>87.4%</span></div>
                </div>
                <p class="chart-caption">Performance tracking across the last 4 structural quarters</p>
            </div>
        </div>
    </section>

    <section id="package-module" class="module-view">
        <div class="fintech-split-layout">
            <div class="glass-card form-wrapper">
                <h3><i class="bx bx-plus-circle text-primary"></i> Create New Signal Package</h3>
                <form id="create-package-form" class="fintech-form" action="{{ route('admin.premium.package.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row-3">
                        <div class="form-group">
                            <label>Signal Name</label>
                            <input type="text" name="bot_name" placeholder="e.g. Alpha Crypto VIP" required />
                        </div>
                        <div class="form-group">
                            <label>Signal Category</label>
                            <select name="strategy_type" required>
                                <option value="Crypto">Crypto</option>
                                <option value="Forex">Forex</option>
                                <option value="Stocks">Stocks</option>
                                <option value="Commodities">Commodities</option>
                                <option value="Indices">Indices</option>
                                <option value="Mining">Mining</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Trading Style</label>
                            <select name="trading_style" required>
                                <option value="">Select style</option>
                                <option value="Scalping">Scalping</option>
                                <option value="Swing">Swing</option>
                                <option value="Day Trading">Day Trading</option>
                                <option value="Position">Position</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row-3">
                        <div class="form-group">
                            <label>Monthly Price ($)</label>
                            <input type="number" name="monthly_return" placeholder="49" required />
                        </div>
                        <div class="form-group">
                            <label>Quarterly Price ($)</label>
                            <input type="number" name="quarterly_price" placeholder="129" required />
                        </div>
                        <div class="form-group">
                            <label>Yearly Price ($)</label>
                            <input type="number" name="annual_return" placeholder="399" required />
                        </div>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Target Success Rate (%)</label>
                            <input type="number" name="accuracy_rate" placeholder="85" max="100" />
                        </div>
                        <div class="form-group">
                            <label>Risk Level Level</label>
                            <select name="risk_level">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group">
                            <label>Signal Icon Upload</label>
                            <input type="file" name="bot_image" class="file-input-custom" />
                        </div>
                        <div class="form-group">
                            <label>Signal Banner Image</label>
                            <input type="file" name="bot_logo" class="file-input-custom" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Signal Description</label>
                        <textarea name="description" rows="3" placeholder="Describe the structural trading strategy..."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mb-2 block">Package Badges & Features Matrix</label>
                        <div class="checkbox-grid">
                            <label class="check-container"><input type="checkbox" checked name="real_time_notifications" /> Real Time Notifications</label>
                            <label class="check-container"><input type="checkbox" checked name="expert_analysis" /> Expert Analysis</label>
                            <label class="check-container"><input type="checkbox" checked name="entry_price_alerts" /> Entry Price Alerts</label>
                            <label class="check-container"><input type="checkbox" checked name="exit_price_alerts" /> Exit Price Alerts</label>
                            <label class="check-container"><input type="checkbox" name="stop_loss_alerts" /> Stop Loss Alerts</label>
                            <label class="check-container"><input type="checkbox" name="take_profit_alerts" /> Take Profit Alerts</label>
                            <label class="check-container"><input type="checkbox" name="vip_support" /> VIP Support</label>
                            <label class="check-container"><input type="checkbox" name="featured" /> Featured Badge</label>
                            <label class="check-container"><input type="checkbox" name="premium" /> Premium Badge</label>
                            <label class="check-container"><input type="checkbox" name="popular" /> Hot Badge</label>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit ripple"><i class="bx bx-check"></i> Generate Signal Package</button>
                </form>
            </div>
            
            <div class="preview-panel">
                <h4><i class="bx bx-show-alt text-secondary"></i> Live Frontend Sync Preview</h4>
                <div id="live-package-preview-card" class="glass-card frontend-signal-card">
                    <div class="card-badge">PREMIUM</div>
                    <div class="card-header-main">
                        <div class="mock-package-icon"><i class="bx bxl-bitcoin"></i></div>
                        <div>
                            <h5>Alpha Crypto VIP</h5>
                            <span>Crypto Assets Matrix</span>
                        </div>
                    </div>
                    <div class="card-body-metrics">
                        <div><span>Monthly</span><strong>$49/mo</strong></div>
                        <div><span>Risk</span><strong class="text-green">Low</strong></div>
                        <div><span>Accuracy</span><strong>85%</strong></div>
                    </div>
                    <div class="card-features-list">
                        <div><i class="bx bx-check-circle text-green"></i> Real-Time Notifications</div>
                        <div><i class="bx bx-check-circle text-green"></i> Expert Technical Analysis</div>
                        <div><i class="bx bx-check-circle text-green"></i> Entry/Exit Target Alerts</div>
                    </div>
                    <div class="card-actions-mock">
                        <button type="button" class="mock-action-btn edit-m"><i class="bx bx-edit"></i> Edit</button>
                        <button type="button" class="mock-action-btn delete-m"><i class="bx bx-trash"></i> Drop</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="live-module" class="module-view">
        <div class="fintech-split-layout">
            <div class="glass-card form-wrapper">
                <h3><i class="bx bx-broadcast text-secondary"></i> Send Live Order Execution Signal</h3>
                <form id="live-signal-form" class="fintech-form" action="{{ route('admin.premium.live-signal') }}" method="POST">
                    @csrf
                    <div class="form-row-3">
                        <div class="form-group">
                            <label>Asset Name</label>
                            <input type="text" name="asset_name" placeholder="e.g. BTC/USDT or EUR/USD" required />
                        </div>
                        <div class="form-group">
                            <label>Signal Type</label>
                            <select class="select-signal-type" name="signal_type">
                                <option value="BUY">BUY / LONG</option>
                                <option value="SELL">SELL / SHORT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Time Frame</label>
                            <input type="text" name="time_frame" placeholder="e.g. 15M, 1H, 4H" />
                        </div>
                    </div>
                    <div class="form-row-4">
                        <div class="form-group"><label>Entry Price</label><input type="text" name="entry_price" placeholder="67400.00" required /></div>
                        <div class="form-group"><label>Take Profit 1</label><input type="text" name="take_profit_1" placeholder="68500.00" required /></div>
                        <div class="form-group"><label>Take Profit 2</label><input type="text" name="take_profit_2" placeholder="69200.00" /></div>
                        <div class="form-group"><label>Take Profit 3</label><input type="text" name="take_profit_3" placeholder="71000.00" /></div>
                    </div>
                    <div class="form-row-2">
                        <div class="form-group"><label>Stop Loss Target</label><input type="text" name="stop_loss" placeholder="66100.00" required /></div>
                        <div class="form-group"><label>Risk Portfolio Allocation (%)</label><input type="text" name="allocation" placeholder="2.5%" /></div>
                    </div>
                    <div class="form-group"><label>Signal Notes / Directives</label><textarea name="notes" placeholder="Add entry context or chart pattern analysis notes..."></textarea></div>
                    <button type="submit" class="btn-submit btn-secondary-color ripple"><i class="bx bx-paper-plane"></i> Broadcast Live Order Execution</button>
                </form>
            </div>

            <div class="preview-panel">
                <h4><i class="bx bx-pulse text-red"></i> Active Signal Monitor Pipeline</h4>
                <div class="glass-card monitor-terminal">
                    <div class="terminal-item active-signal-node">
                        <div class="node-meta">
                            <span class="badge-buy">BUY</span><strong>BTC/USDT</strong> <span class="node-tf">(1H)</span>
                        </div>
                        <div class="node-targets">
                            <span>EP: 67400</span> | <span class="text-green">TP1: 68500</span> | <span class="text-red">SL: 66100</span>
                        </div>
                        <div class="node-actions-row">
                            <button class="node-action text-green">Hit TP1</button>
                            <button class="node-action text-green">Hit TP2</button>
                            <button class="node-action text-red">Close Loss</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="subscribers-module" class="module-view">
        <div class="table-controls-row mb-3">
            <div class="search-box-wrapper">
                <i class="bx bx-search"></i>
                <input type="text" id="subscriber-search-input" placeholder="Search system nodes by User, Email, ID or Country..." />
            </div>
            <button class="btn-utility ripple" onclick="alert('Exporting Subscriber Core Database to Excel (CSV)...')"><i class="bx bx-export"></i> Export Subscribers</button>
        </div>
        <div class="glass-card table-responsive-container">
            <table class="fintech-table">
                <thead>
                    <tr>
                        <th>Subscriber Profile</th>
                        <th>User ID</th>
                        <th>Country</th>
                        <th>Active Package</th>
                        <th>Plan Tier</th>
                        <th>Amount Paid</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscribers ?? collect() as $subscriber)
                        <tr>
                            <td>
                                <div class="table-user-cell">
                                    <div class="avatar-mock p-purple">{{ strtoupper(substr($subscriber['name'], 0, 1)) }}</div>
                                    <div><strong>{{ $subscriber['name'] }}</strong><span>{{ $subscriber['email'] }}</span></div>
                                </div>
                            </td>
                            <td><code class="node-code">NEX-{{ str_pad($subscriber['id'] ?? 0, 4, '0', STR_PAD_LEFT) }}</code></td>
                            <td>{{ $subscriber['country'] }}</td>
                            <td>{{ $subscriber['activePackage'] }}</td>
                            <td>{{ $subscriber['planTier'] }}</td>
                            <td class="text-gold">${{ number_format($subscriber['amountPaid'] ?? 0, 2) }}</td>
                            <td>
                                <span class="badge-status {{ $subscriber['status'] === 'Active' ? 'active-st' : 'pending-st' }}">{{ $subscriber['status'] }}</span>
                            </td>
                            <td class="text-right">
                                <button type="button" class="action-icon-btn text-blue view-subscriber-btn" data-investment-id="{{ $subscriber['investment_id'] }}" data-user-id="{{ $subscriber['id'] }}" title="View Details"><i class="bx bx-show"></i></button>
                                <button type="button" class="action-icon-btn text-purple edit-subscriber-btn" data-investment-id="{{ $subscriber['investment_id'] }}" data-user-id="{{ $subscriber['id'] }}" data-current-status="{{ $subscriber['status'] }}" data-toggle-url="{{ route('admin.premium.subscriber.toggle', $subscriber['investment_id']) }}" title="Edit Properties"><i class="bx bx-edit"></i></button>
                                <button type="button" class="action-icon-btn text-red delete-subscriber-btn" data-investment-id="{{ $subscriber['investment_id'] }}" data-user-id="{{ $subscriber['id'] }}" data-delete-url="{{ route('admin.premium.subscriber.delete', $subscriber['investment_id']) }}" title="Suspend Access"><i class="bx bx-block"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No premium subscribers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section id="payments-module" class="module-view">
        <div class="table-controls-row mb-3">
            <div class="search-box-wrapper"><i class="bx bx-search"></i><input type="text" placeholder="Search invoices or Transaction Hash IDs..." /></div>
            <button class="btn-utility ripple" onclick="alert('Exporting Ledger Ledger Data to Spreadsheet...')"><i class="bx bx-download"></i> Export Payments Report</button>
        </div>
        <div class="glass-card table-responsive-container">
            <table class="fintech-table">
                <thead>
                    <tr>
                        <th>Transaction Hash ID</th>
                        <th>User Node</th>
                        <th>Package Option</th>
                        <th>Gross Value</th>
                        <th>Payment Gateway</th>
                        <th>Settlement Date</th>
                        <th>Status</th>
                        <th class="text-right">Verification Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments ?? collect() as $payment)
                        <tr>
                            <td><code class="node-code">{{ $payment['transactionId'] }}</code></td>
                            <td>{{ $payment['userName'] }}</td>
                            <td>{{ $payment['packageOption'] }}</td>
                            <td class="text-green">${{ number_format($payment['grossValue'] ?? 0, 2) }}</td>
                            <td><i class="bx bx-wallet"></i> {{ $payment['paymentGateway'] }}</td>
                            <td>{{ $payment['settlementDate'] }}</td>
                            <td><span class="badge-status {{ $payment['status'] === 'Settled' ? 'active-st' : 'warning-st' }}">{{ $payment['status'] }}</span></td>
                            <td class="text-right">
                                <button class="btn-action-small approve-btn mr-1">Approve</button>
                                <button class="btn-action-small reject-btn">Reject</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No payment records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section id="notifications-module" class="module-view">
        <div class="glass-card form-wrapper max-w-700">
            <h3><i class="bx bx-paper-plane text-accent"></i> Core Notification & System Broadcast Engine</h3>
            <form id="notification-broadcast-form" class="fintech-form">
                <div class="form-row-2">
                    <div class="form-group">
                        <label>Target Audience Layer</label>
                        <select id="notif-target-audience">
                            <option value="all">All Registered Accounts (Global Broadcast)</option>
                            <option value="multiple">Premium Subscription Tier Accounts Only</option>
                            <option value="single">Single Isolated User Node ID</option>
                        </select>
                    </div>
                    <div class="form-group" id="single-user-input-container" style="display:none;">
                        <label>Target User Account ID</label>
                        <input type="text" placeholder="e.g. NEX-9082" />
                    </div>
                    <div class="form-group">
                        <label>Alert Classification Category</label>
                        <select>
                            <option>Market Alert</option>
                            <option>Signal Updates</option>
                            <option>Profit Notifications</option>
                            <option>Subscription Expiry Warnings</option>
                            <option>Promotional Messages</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Broadcast Notification Headline</label>
                    <input type="text" placeholder="e.g. Market Volatility Alert: CPI Release Looming" required />
                </div>
                <div class="form-group">
                    <label>Message Content Payload</label>
                    <textarea rows="4" placeholder="Draft your alert system message details here..." required></textarea>
                </div>
                <button type="submit" class="btn-submit btn-accent-color ripple"><i class="bx bx-broadcast"></i> Execute Global System Dispatch</button>
            </form>
        </div>
    </section>

    <div id="nexuist-toast" class="toast-hidden">
        <div class="toast-content-wrapper">
            <i class="bx bx-check-shield text-green"></i>
            <div class="toast-body-text">
                <span id="toast-title-node">System Confirmation</span>
                <p id="toast-desc-node">Transaction sequence processed successfully.</p>
            </div>
        </div>
    </div>

</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/PremiumInvestment.js') }}"></script>
</body>

</html>