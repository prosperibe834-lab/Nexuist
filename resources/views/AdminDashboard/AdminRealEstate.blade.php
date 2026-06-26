<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/AdminRealEstate.css') }}">
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
                <a href="{{ url('/AdminRealEstate') }}">
                    <i class='bx bx-home-alt'></i>
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
                <a href="{{ url('/admin-notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/admin-notifications">Notifications</a></li>
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
                <h1 id="page-title-display">Real Estate</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nx-admin-dashboard">
            <div class="nx-admin-subnav">
                <button class="nx-subnav-btn active" data-view="overview">
                    <i class='bx bxs-pie-chart-alt-2'></i> Platform Overview
                </button>
                <button class="nx-subnav-btn" data-view="properties">
                    <i class='bx bxs-building-house'></i> Manage Properties (<span id="propertyCountBadge">0</span>)
                </button>
                <button class="nx-subnav-btn" data-view="investments">
                    <i class='bx bxs-coupon'></i> Investor Ledger
                </button>
                <div class="nx-notif-center-wrapper">
                    <button class="nx-notif-trigger" id="nxNotifBtn">
                        <i class='bx bxs-bell'></i>
                        <span class="nx-notif-dot"></span>
                    </button>
                    <div class="nx-notif-dropdown" id="nxNotifDropdown">
                        <div class="nx-dropdown-header">
                            <h4>Platform Alerts</h4>
                            <button id="nxMarkAllRead">Clear All</button>
                        </div>
                        <div class="nx-notif-list" id="nxNotificationList">
                        </div>
                    </div>
                </div>
            </div>

            <div class="nx-view-panel active" id="view-overview">
                <div class="nx-summary-grid">
                    <div class="nx-premium-card">
                        <div class="nx-card-glow"></div>
                        <div class="nx-card-top">
                            <span class="nx-card-label">Total Asset Value</span>
                            <div class="nx-card-icon prim"><i class='bx bxs-bank'></i></div>
                        </div>
                        <h2 id="cardTotalPropertiesValue">$0.00</h2>
                        <div class="nx-card-footer">
                            <span class="nx-trend up"><i class='bx bx-trending-up'></i> +12.4%</span>
                            <span class="nx-foot-lbl">Global Value Traced</span>
                        </div>
                    </div>
                    <div class="nx-premium-card">
                        <div class="nx-card-glow"></div>
                        <div class="nx-card-top">
                            <span class="nx-card-label">Active Listed Assets</span>
                            <div class="nx-card-icon sec"><i class='bx bxs-business'></i></div>
                        </div>
                        <h2 id="cardActiveCount">0 / 0</h2>
                        <div class="nx-card-footer">
                            <span class="nx-trend up"><i class='bx bx-check-double'></i> Stable</span>
                            <span class="nx-foot-lbl">Properties Active</span>
                        </div>
                    </div>
                    <div class="nx-premium-card">
                        <div class="nx-card-glow"></div>
                        <div class="nx-card-top">
                            <span class="nx-card-label">Total Capital Invested</span>
                            <div class="nx-card-icon acc"><i class='bx bxs-wallet'></i></div>
                        </div>
                        <h2 id="cardTotalInvested">$0.00</h2>
                        <div class="nx-card-footer">
                            <span class="nx-trend up"><i class='bx bx-trending-up'></i> +8.2%</span>
                            <span class="nx-foot-lbl">From Local Wallets</span>
                        </div>
                    </div>
                    <div class="nx-premium-card">
                        <div class="nx-card-glow"></div>
                        <div class="nx-card-top">
                            <span class="nx-card-label">Tokens Transacted</span>
                            <div class="nx-card-icon out"><i class='bx bxs-shapes'></i></div>
                        </div>
                        <h2 id="cardTokensSold">0.00</h2>
                        <div class="nx-card-footer">
                            <span class="nx-trend dynamic" id="cardTokensAvailable">0 Available</span>
                        </div>
                    </div>
                    <div class="nx-premium-card">
                        <div class="nx-card-glow"></div>
                        <div class="nx-card-top">
                            <span class="nx-card-label">Unique Platform Investors</span>
                            <div class="nx-card-icon prim"><i class='bx bxs-group'></i></div>
                        </div>
                        <h2 id="cardInvestorCount">0</h2>
                        <div class="nx-card-footer">
                            <span class="nx-trend up"><i class='bx bx-user-plus'></i> Organic</span>
                            <span class="nx-foot-lbl">Active Addresses</span>
                        </div>
                    </div>
                    <div class="nx-premium-card">
                        <div class="nx-card-glow"></div>
                        <div class="nx-card-top">
                            <span class="nx-card-label">Calculated Average APY</span>
                            <div class="nx-card-icon sec"><i class='bx bxs-tachometer'></i></div>
                        </div>
                        <h2 id="cardAvgApy">0.0%</h2>
                        <div class="nx-card-footer">
                            <span class="nx-trend safe"><i class='bx bxs-shield-quarter-on'></i> Verified</span>
                            <span class="nx-foot-lbl">Yield Vector</span>
                        </div>
                    </div>
                </div>

                <div class="nx-analytics-split">
                    <div class="nx-glass-card" id="analyticsDataCard">
                        <div class="nx-card-title-bar">
                            <h3><i class='bx bx-analyse'></i> Core Platform Telemetry Metrics</h3>
                            <span class="nx-pill-badge active-pill">Live Synced</span>
                        </div>

                        <div class="nx-charts-layout">
                            <div class="nx-chart-box">
                                <h5>Token Transacted Velocity (Sold vs Available)</h5>
                                <div class="nx-svg-chart-container">
                                    <svg viewBox="0 0 400 200" class="nx-svg-graph">
                                        <g class="grid-lines">
                                            <line x1="40" y1="20" x2="380" y2="20" stroke="var(--border-color)"
                                                stroke-dasharray="4" />
                                            <line x1="40" y1="70" x2="380" y2="70" stroke="var(--border-color)"
                                                stroke-dasharray="4" />
                                            <line x1="40" y1="120" x2="380" y2="120" stroke="var(--border-color)"
                                                stroke-dasharray="4" />
                                            <line x1="40" y1="170" x2="380" y2="170" stroke="var(--border-color)" />
                                        </g>
                                        <g id="svgBarGroup">
                                            <rect x="70" y="60" width="25" height="110" fill="url(#primGlow)" rx="4"
                                                class="chart-anim-bar" />
                                            <rect x="100" y="90" width="25" height="80" fill="url(#secGlow)" rx="4"
                                                class="chart-anim-bar" />

                                            <rect x="180" y="40" width="25" height="130" fill="url(#primGlow)" rx="4"
                                                class="chart-anim-bar" />
                                            <rect x="210" y="110" width="25" height="60" fill="url(#secGlow)" rx="4"
                                                class="chart-anim-bar" />

                                            <rect x="290" y="30" width="25" height="140" fill="url(#primGlow)" rx="4"
                                                class="chart-anim-bar" />
                                            <rect x="320" y="130" width="25" height="40" fill="url(#secGlow)" rx="4"
                                                class="chart-anim-bar" />
                                        </g>
                                        <defs>
                                            <linearGradient id="primGlow" x1="0" y1="0" x2="0" y2="1">
                                                <stop offset="0%" stop-color="var(--primary-color)" />
                                                <stop offset="100%" stop-color="rgba(108, 99, 255, 0.1)" />
                                            </linearGradient>
                                            <linearGradient id="secGlow" x1="0" y1="0" x2="0" y2="1">
                                                <stop offset="0%" stop-color="var(--secondary-color)" />
                                                <stop offset="100%" stop-color="rgba(0, 212, 255, 0.1)" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="nx-chart-legends">
                                    <span class="legend-item"><span class="dot prim"></span> Minted Tokens Sold</span>
                                    <span class="legend-item"><span class="dot sec"></span> Available Liquidity
                                        Pool</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="nx-glass-card nx-empty-view hidden" id="analyticsEmptyState">
                        <div class="nx-empty-center">
                            <div class="nx-empty-icon-box"><i class='bx bx-line-chart-down'></i></div>
                            <h4>No Analytical Matrix Feed Available</h4>
                            <p>Deploy standard real estate configurations to populate local data points.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nx-view-panel" id="view-properties">
                <div class="nx-section-header">
                    <div>
                        <h3>Platform Asset Inventory</h3>
                        <p class="nx-subtext-muted">Deploy, update and manage live properties on the interface
                            architecture.</p>
                    </div>
                    <button class="nx-action-btn primary-action" id="nxOpenCreateModalBtn">
                        <i class='bx bx-plus-circle'></i> Add New Property
                    </button>
                </div>

                <div class="nx-glass-card" id="propertiesTableWrapper">
                    <div class="nx-table-responsive">
                        <table class="nx-master-table">
                            <thead>
                                <tr>
                                    <th>Property Name</th>
                                    <th>Type</th>
                                    <th>APY</th>
                                    <th>Token Price</th>
                                    <th>Available Tokens</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="nxPropertiesTableBody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="nx-glass-card nx-empty-view hidden" id="propertiesEmptyState">
                    <div class="nx-empty-center">
                        <div class="nx-empty-icon-box"><i class='bx bx-layer-plus'></i></div>
                        <h4>Property Vault Empty</h4>
                        <p>No active properties currently found on the terminal system pipeline. Start by deploying an
                            asset.</p>
                        <button class="nx-action-btn primary-action" id="nxEmptyStateCreateBtn"><i
                                class='bx bx-plus'></i> Create First Asset</button>
                    </div>
                </div>
            </div>

            <div class="nx-view-panel" id="view-investments">
                <div class="nx-section-header">
                    <div>
                        <h3>Global Investment Directory</h3>
                        <p class="nx-subtext-muted">Real-time terminal ledger detailing investor smart tracking metrics.
                        </p>
                    </div>
                    <button class="nx-action-btn secondary-action" id="nxExportLedgerBtn">
                        <i class='bx bx-export'></i> Export Matrix CSV
                    </button>
                </div>

                <div class="nx-search-filter-bar">
                    <div class="nx-search-box-input">
                        <i class='bx bx-search'></i>
                        <input type="text" id="nxSearchInvestorInput"
                            placeholder="Search investor name or property allocation...">
                    </div>
                    <div class="nx-filter-dropdowns">
                        <select id="nxFilterStatus">
                            <option value="all">All States</option>
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <div class="nx-glass-card" id="investmentsTableWrapper">
                    <div class="nx-table-responsive">
                        <table class="nx-master-table">
                            <thead>
                                <tr>
                                    <th>Investor Profile</th>
                                    <th>Allocated Property</th>
                                    <th>Capital Placed</th>
                                    <th>Tokens Allocated</th>
                                    <th>Yield Apex</th>
                                    <th>Execution Date</th>
                                    <th>State</th>
                                </tr>
                            </thead>
                            <tbody id="nxInvestmentsTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="nx-table-pagination">
                        <span class="nx-pag-stats">Showing active dynamic ledger loops</span>
                        <div class="nx-pag-btns">
                            <button disabled class="nx-pag-nav-btn"><i class='bx bx-chevron-left'></i></button>
                            <button class="nx-pag-nav-btn active">1</button>
                            <button disabled class="nx-pag-nav-btn"><i class='bx bx-chevron-right'></i></button>
                        </div>
                    </div>
                </div>

                <div class="nx-glass-card nx-empty-view hidden" id="investmentsEmptyState">
                    <div class="nx-empty-center">
                        <div class="nx-empty-icon-box"><i class='bx bx-receipt'></i></div>
                        <h4>No Investor Traces Located</h4>
                        <p>No investment actions have triggered on your platform configurations yet.</p>
                    </div>
                </div>
            </div>

            <div class="nx-view-panel" id="view-details-page">
                <button class="nx-back-link-btn" id="nxBackToPropertiesBtn"><i class='bx bx-left-arrow-alt'></i> Return
                    to Master Management List</button>

                <div class="nx-details-layout-engine" id="nxDetailsOutputContainer">
                </div>
            </div>

            <div class="nx-modal-overlay" id="nxPropertyFormModal">
                <div class="nx-modal-window">
                    <div class="nx-modal-header">
                        <h3 id="nxModalTitleHeader">Deploy Real Estate Token Asset</h3>
                        <button class="nx-modal-close-trigger" id="nxCloseModalBtn"><i class='bx bx-x'></i></button>
                    </div>
                    <div class="nx-modal-body-scroll">
                        <form id="nxPropertyMasterForm">
                            <input type="hidden" id="formPropertyId">

                            <div class="nx-form-section-title">
                                <h5><i class='bx bx-info-square'></i> Primary Asset Metadata</h5>
                            </div>
                            <div class="nx-input-row double">
                                <div class="nx-control-group">
                                    <label>Property Name Identification *</label>
                                    <input type="text" id="propName" required
                                        placeholder="e.g. Apex Horizon Skyscraper">
                                </div>
                                <div class="nx-control-group">
                                    <label>Property Category Type *</label>
                                    <select id="propType" required>
                                        <option value="Apartment">Apartment</option>
                                        <option value="Duplex">Duplex</option>
                                        <option value="Villa">Villa</option>
                                        <option value="Condo">Condo</option>
                                        <option value="Commercial">Commercial Building</option>
                                        <option value="Land">Land Parcel</option>
                                    </select>
                                </div>
                            </div>

                            <div class="nx-control-group">
                                <label>Asset Structural Overview Narrative *</label>
                                <textarea id="propDescription" rows="3" required
                                    placeholder="Detailed descriptions and growth value targets..."></textarea>
                            </div>

                            <div class="nx-input-row triple">
                                <div class="nx-control-group">
                                    <label>Street Address *</label>
                                    <input type="text" id="propAddress" required placeholder="e.g. 24 Kofo Abayomi St">
                                </div>
                                <div class="nx-control-group">
                                    <label>City Hub *</label>
                                    <input type="text" id="propCity" required placeholder="e.g. Owerri">
                                </div>
                                <div class="nx-control-group">
                                    <label>State / Region *</label>
                                    <input type="text" id="propState" required placeholder="e.g. Imo State">
                                </div>
                            </div>

                            <div class="nx-input-row double">
                                <div class="nx-control-group">
                                    <label>Country Destination Vector *</label>
                                    <input type="text" id="propCountry" required placeholder="e.g. Nigeria">
                                </div>
                                <div class="nx-control-group">
                                    <label>Initial Asset Status Configuration *</label>
                                    <select id="propStatus" required>
                                        <option value="Active">Active (Live for Sale)</option>
                                        <option value="Upcoming">Upcoming Listing</option>
                                        <option value="Sold Out">Sold Out Profile</option>
                                        <option value="Under Review">Under Review</option>
                                        <option value="Suspended">Suspended / Locked</option>
                                    </select>
                                </div>
                            </div>

                            <div class="nx-form-section-title">
                                <h5><i class='bx bx-slider'></i> Structural Blueprints & Metrics</h5>
                            </div>
                            <div class="nx-input-row quad">
                                <div class="nx-control-group">
                                    <label>Bedrooms</label>
                                    <input type="number" id="featBeds" min="0" value="0">
                                </div>
                                <div class="nx-control-group">
                                    <label>Bathrooms</label>
                                    <input type="number" id="featBaths" min="0" value="0">
                                </div>
                                <div class="nx-control-group">
                                    <label>Living Rooms</label>
                                    <input type="number" id="featLiving" min="0" value="0">
                                </div>
                                <div class="nx-control-group">
                                    <label>Kitchen Units</label>
                                    <input type="number" id="featKitchens" min="0" value="0">
                                </div>
                            </div>
                            <div class="nx-input-row triple">
                                <div class="nx-control-group">
                                    <label>Parking Lots</label>
                                    <input type="number" id="featParking" min="0" value="0">
                                </div>
                                <div class="nx-control-group">
                                    <label>Total Dimensions (sq ft)</label>
                                    <input type="number" id="featSize" min="0" placeholder="e.g. 4500">
                                </div>
                                <div class="nx-control-group">
                                    <label>Year Constructed</label>
                                    <input type="number" id="featYear" min="1800" max="2030" placeholder="2026">
                                </div>
                            </div>

                            <div class="nx-form-section-title">
                                <h5><i class='bx bx-image-add'></i> Asset Graphical Assets</h5>
                            </div>
                            <div class="nx-input-row double">
                                <div class="nx-control-group">
                                    <label>Primary Thumbnail Link *</label>
                                    <input type="text" id="mediaMainImg" required
                                        placeholder="https://images.unsplash.com/... or local assets path">
                                </div>
                                <div class="nx-control-group">
                                    <label>Gallery Array Links (Comma separated values)</label>
                                    <input type="text" id="mediaGallery" placeholder="url1, url2, url3">
                                </div>
                            </div>

                            <div class="nx-form-section-title">
                                <h5><i class='bx bx-coin-stack'></i> Tokenomics & Financial Target Matrices</h5>
                            </div>
                            <div class="nx-input-row triple">
                                <div class="nx-control-group">
                                    <label>Asset Market Evaluation ($) *</label>
                                    <input type="number" id="finMarketValue" required placeholder="e.g. 750000">
                                </div>
                                <div class="nx-control-group">
                                    <label>Nominal Price Per Token ($) *</label>
                                    <input type="number" id="finTokenPrice" required placeholder="e.g. 50">
                                </div>
                                <div class="nx-control-group">
                                    <label>Total Cap Token Volume *</label>
                                    <input type="number" id="finTotalTokens" required placeholder="e.g. 15000">
                                </div>
                            </div>
                            <div class="nx-input-row quad">
                                <div class="nx-control-group">
                                    <label>Min Tokens Buy</label>
                                    <input type="number" id="finMinInvest" value="1">
                                </div>
                                <div class="nx-control-group">
                                    <label>Max Tokens Buy</label>
                                    <input type="number" id="finMaxInvest" value="2000">
                                </div>
                                <div class="nx-control-group">
                                    <label>Estimated APY % *</label>
                                    <input type="number" id="finApy" step="0.1" required placeholder="12.5">
                                </div>
                                <div class="nx-control-group">
                                    <label>Expected Return ($/Yr)</label>
                                    <input type="number" id="finAnnualReturn" placeholder="e.g. 85000">
                                </div>
                            </div>

                            <div class="nx-form-section-title">
                                <h5><i class='bx bx-check-square'></i> Included Structural Amenities</h5>
                            </div>
                            <div class="nx-amenities-checkbox-flex">
                                <label class="nx-check-lbl"><input type="checkbox" id="amenPool"> Swimming Pool</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenGym"> Fitness Gym</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenElevator"> Elevator
                                    Shafts</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenSecurity"> Master Security
                                    Guard</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenCctv"> CCTV Array
                                    Coverage</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenInternet"> Optical Fibre
                                    Internet</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenGarden"> Sculpted
                                    Garden</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenPlay"> Recreational
                                    Center</label>
                                <label class="nx-check-lbl"><input type="checkbox" id="amenPower"> 24/7 Heavy Power
                                    Backup</label>
                            </div>

                            <div class="nx-modal-footer-actions">
                                <button type="button" class="nx-action-btn neutral-action" id="nxCancelModalBtn">Abort
                                    Operation</button>
                                <button type="submit" class="nx-action-btn primary-action" id="nxSubmitFormBtn">Commit
                                    Data Matrix</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="nx-toast-alert" id="nxAdminToastBox">
                <i class='bx bxs-check-shield nx-toast-alert-icon'></i>
                <span id="nxToastAlertText">Operation successfully recorded across local systems.</span>
            </div>
        </div>

    </main>

    <script src="{{ asset('assets/AdminDashboard/js/AdminRealEstate.js') }}"></script>
</body>

</html>

