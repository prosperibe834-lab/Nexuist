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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/users.css') }}">
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
                <a href="{{ url('/dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/dashboard') }}">Dashboard</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="{{ url('/users') }}">
                    <i class='bx bx-user-pin'></i>
                    <span class="link_name">Users Management</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/users') }}">Users Management</a></li>
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
                    <li><a class="link_name" href="{{ url('/withdrawals') }}">Withdrawals</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/investment-plans') }}">
                    <i class='bx bx-layer'></i>
                    <span class="link_name">Investment Plans</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/investment-plans') }}">Investment Plans</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/ai-bot') }}">
                    <i class='bx bx-bot'></i>
                    <span class="link_name">AI Bot Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/ai-bot') }}">AI Bot Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/copy-trading') }}">
                    <i class='bx bx-copy-alt'></i>
                    <span class="link_name">Copy Trading</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/copy-trading') }}">Copy Trading</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/internal-transfers') }}">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="link_name">Internal Transfers</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/internal-transfers') }}">Internal Transfers</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/performance') }}">
                    <i class='bx bx-line-chart-down'></i>
                    <span class="link_name">Performance History</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/performance') }}">Performance History</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/portfolio') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Portfolio Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/portfolio') }}">Portfolio Analytics</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/statements') }}">
                    <i class='bx bx-file-find'></i>
                    <span class="link_name">Account Statements</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/statements') }}">Account Statements</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/kyc') }}">
                    <i class='bx bx-id-card'></i>
                    <span class="link_name">KYC Verification</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/kyc') }}">KYC Verification</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/loans') }}">
                    <i class='bx bx-money'></i>
                    <span class="link_name">Loan Requests</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/loans') }}">Loan Requests</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/admin-notifications') }}">
                    <i class='bx bx-bell'></i>
                    <span class="link_name">Notifications</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/admin-notifications') }}">Notifications</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/support') }}">
                    <i class='bx bx-support'></i>
                    <span class="link_name">Messages & Support</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/support') }}">Messages & Support</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/transactions') }}">
                    <i class='bx bx-receipt'></i>
                    <span class="link_name">Transaction Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/transactions') }}">Transaction Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/website-settings') }}">
                    <i class='bx bx-globe'></i>
                    <span class="link_name">Website Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/website-settings') }}">Website Settings</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/security') }}">
                    <i class='bx bx-shield-quarter'></i>
                    <span class="link_name">Security Logs</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/security') }}">Security Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('/admin-settings') }}">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Admin Settings</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/admin-settings') }}">Admin Settings</a></li>
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
                <a href="{{ url('/logout') }}">
                    <i class='bx bx-log-out-circle'></i>
                    <span class="link_name">Logout</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ url('/logout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">Users</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <div class="users-view-container animate-fade-in">

            <div class="users-metrics-strip">
                <div class="metric-card user-stat-card text-glow-purple">
                    <div class="card-header">
                        <span>TOTAL REGISTERED USERS</span>
                        <i class='bx bx-group token-icon-purple'></i>
                    </div>

                    <h2>
                        {{ number_format($totalUsers) }}
                        <span class="trend-up">
                            <i class='bx bx-user-plus'></i> Active
                        </span>
                    </h2>

                    <p class="text-muted">Global system network size</p>
                </div>

                <div class="metric-card user-stat-card text-glow-green">
                    <div class="card-header">
                        <span>VERIFIED CUSTOMERS (KYC)</span>
                        <i class='bx bx-shield-quarter token-icon-green'></i>
                    </div>

                    <h2>
                        {{ number_format($verifiedUsers) }}

                        <span class="trend-up status-up">
                            <i class='bx bx-check-shield'></i>
                            {{ $verifiedPercentage }}%
                        </span>
                    </h2>

                    <p class="text-muted">Completed identity check loops</p>
                </div>

                <div class="metric-card user-stat-card text-glow-cyan">
                    <div class="card-header">
                        <span>TOTAL SYSTEMS CAPITALIZATION</span>
                        <i class='bx bx-line-chart token-icon-cyan'></i>
                    </div>
                    <h2>$4,129,040 <span class="trend-up"><i class='bx bx-coin-stack'></i> Locked</span></h2>
                    <p class="text-muted">Combined network liquidity state</p>
                </div>
                
            </div>

            <div class="users-table-panel-card">
                <div class="panel-header user-panel-header">
                    <div class="header-title-wrapper">
                        <h3><i class='bx bx-user-pin'></i> Core Account Registries</h3>
                        <p class="text-muted subheader-text">Modify account permissions, handle wallets, and track
                            verification tiers</p>
                    </div>

                    <div class="table-actions-filter-bar" style="position: relative;">
                        <div class="search-box-wrapper">
                            <i class='bx bx-search search-bar-icon'></i>
                            <input type="text" placeholder="Search by UID, email, phone, or country..."
                                id="user-search-input">
                        </div>
                        <button class="btn-filter-glass" id="action-btn-filter"><i class='bx bx-filter-alt'></i>
                            Filter</button>
                        <button class="btn-add-primary" id="action-btn-create"><i class='bx bx-user-plus'></i> Create
                            User</button>

                        <div class="filter-dropdown-panel" id="filter-dropdown">
                            <div class="filter-group-row">
                                <label>KYC Validation Status</label>
                                <select id="filter-kyc-select">
                                    <option value="all">All Statuses</option>
                                    <option value="approved">Approved Only</option>
                                    <option value="in review">In Review Only</option>
                                    <option value="unsubmitted">Unsubmitted</option>
                                </select>
                            </div>
                            <div class="filter-group-row">
                                <label>Active Trading Systems</label>
                                <select id="filter-bot-select">
                                    <option value="all">All Clients</option>
                                    <option value="active">Active AI Bots Only</option>
                                    <option value="inactive">No Active Bots</option>
                                </select>
                            </div>
                            <div class="filter-dropdown-actions">
                                <button id="btn-reset-filters">Reset Parameters</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="dashboard-table user-table" id="nexuist-user-table">
                        <thead>
                            <tr>
                                <th>User Profile Details</th>
                                <th>UID Tracking</th>
                                <th>Contact Details</th>
                                <th>Origin Country</th>
                                <th>Wallet Balance</th>
                                <th>AI Bot Active</th>
                                <th>KYC Status</th>
                                <th style="text-align: right;">Administrative Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="user-data-row" data-uid="#NEX-{{ $user->id }}" data-name="{{ $user->name }}"
                                    data-email="{{ $user->email }}" data-phone="{{ $user->phone ?? 'N/A' }}"
                                    data-country="{{ $user->country ?? 'Not Set' }}" data-balance="{{ $user->balance }}"
                                    data-crypto="{{ $user->crypto_balance ?? '0 BTC' }}"
                                    data-bot="{{ $user->is_bot_active ? 'Yes' : 'No' }}">
                                    <td>
                                        <div class="user-profile-cell">
                                            <div class="avatar-frame"><span
                                                    class="avatar-placeholder text-glow-cyan">{{ substr($user->name, 0, 2) }}</span>
                                            </div>
                                            <div class="profile-info-text">
                                                <span class="user-display-name">{{ $user->name }}</span>
                                                <span class="user-email-text">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="uid-tag">#NEX-{{ $user->id }}</span></td>
                                    <td><span class="table-phone-txt"><i class='bx bx-phone text-muted'></i>
                                            {{ $user->phone ?? 'N/A' }}</span></td>
                                    <td>
                                        <div class="country-cell-wrapper">
                                            <i class='bx bx-map-pin country-marker-icon'></i>
                                            <span>{{ $user->country ?? 'Not Set' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="balance-cell">
                                            <span class="fiat-balance">${{ number_format($user->balance, 2) }}</span>
                                            <span class="crypto-subtext"><i class='bx bxl-bitcoin crypto-btc'></i>
                                                {{ $user->crypto_balance ?? '0 BTC' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="bot-state-wrapper">
                                            @if($user->is_bot_active)
                                                <span class="status-badge-active"><i class='bx bx-pulse bx-spin-custom'></i>
                                                    Active</span>
                                            @else
                                                <span class="text-muted">None Active</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if(strtolower($user->kyc_status) == 'approved')
                                            <span class="badge badge-success"><i class='bx bx-check-circle'></i> Approved</span>
                                        @else
                                            <span class="badge badge-warning"><i class='bx bx-time-five'></i>
                                                {{ ucfirst($user->kyc_status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-action-buttons-group">
                                            <button class="action-btn btn-view" title="View Profile Details"><i
                                                    class='bx bx-show-alt'></i></button>
                                            <button class="action-btn btn-edit" title="Adjust Financial Balances"><i
                                                    class='bx bx-wallet-alt'></i></button>
                                            <button class="action-btn btn-delete" title="Restrict Node Authentication"><i
                                                    class='bx bx-block'></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-pagination-footer">
                    <span class="pagination-counter-text" id="pagination-status">Showing 1 to 2 of 2 Entries</span>
                    <div class="pagination-controls-buttons"></div>
                </div>
            </div>
        </div>

        <div id="modal-view-profile" class="nexuist-modal-overlay">
            <div class="modal-glass-container">
                <div class="modal-header">
                    <h3><i class='bx bx-user-circle'></i> Profile Explorer</h3>
                    <button class="modal-close-btn">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="profile-modal-identity">
                        <div class="large-avatar-glow"><span id="m-avatar-txt">AM</span></div>
                        <h4 id="m-user-name">Alexander Mercer</h4>
                        <p id="m-user-email" class="text-muted">a.mercer@nexuist.io</p>
                        <span id="m-user-uid" class="uid-tag">#NEX-10942</span>
                    </div>

                    <div class="modal-meta-grid">
                        <div class="meta-item">
                            <label>Phone Number</label>
                            <span id="m-user-phone" class="value-highlight-fiat"
                                style="font-size:13px; font-weight:500;">-</span>
                        </div>
                        <div class="meta-item">
                            <label>Origin Country</label>
                            <span id="m-user-country" class="value-highlight-fiat"
                                style="font-size:13px; font-weight:500;">-</span>
                        </div>
                        <div class="meta-item">
                            <label>Wallet Capital</label>
                            <span id="m-user-balance" class="value-highlight-fiat">$0.00</span>
                        </div>
                        <div class="meta-item">
                            <label>AI Trading Status</label>
                            <span id="m-user-bot" class="value-highlight-bot">Inactive</span>
                        </div>
                    </div>

                    <div class="kyc-review-box">
                        <h5><i class='bx bx-file-blank'></i> Identity Passport / ID Verification File</h5>
                        <div class="mock-receipt-preview">
                            <i class='bx bx-id-card image-placeholder-icon'></i>
                            <span>SECURE_KYC_DOCUMENT_PASSPORT.JPG</span>
                        </div>
                        <div class="kyc-action-buttons">
                            <button class="btn-modal-action btn-approve-kyc"><i class='bx bx-check-shield'></i> Approve
                                Verification</button>
                            <button class="btn-modal-action btn-reject-kyc"><i class='bx bx-x-circle'></i> Reject
                                File</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-edit-wallet" class="nexuist-modal-overlay">
            <div class="modal-glass-container card-width-medium">
                <div class="modal-header">
                    <h3><i class='bx bx-wallet-alt'></i> Modify Account Balance</h3>
                    <button class="modal-close-btn">&times;</button>
                </div>
                <form id="wallet-adjust-form">
                    <div class="modal-body">
                        <div class="form-target-user-alert">
                            Target Node: <span id="m-wallet-username">Alexander Mercer</span>
                        </div>

                        <div class="input-field-group">
                            <label for="input-fiat-amount">Adjust Fiat Balance ($)</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-dollar'></i>
                                <input type="number" id="input-fiat-amount" step="0.01" required>
                            </div>
                        </div>

                        <div class="input-field-group">
                            <label for="input-crypto-amount">Crypto Subtext Reference Ledger</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-coin-stack'></i>
                                <input type="text" id="input-crypto-amount" placeholder="e.g. 2.14 BTC">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel modal-close-btn">Cancel</button>
                        <button type="submit" class="btn-modal-submit-save">Commit Balances</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modal-create-user" class="nexuist-modal-overlay">
            <div class="modal-glass-container card-width-medium">
                <div class="modal-header">
                    <h3><i class='bx bx-user-plus'></i> Provision New Client Node</h3>
                    <button class="modal-close-btn">&times;</button>
                </div>
                <form id="create-user-form">
                    <div class="modal-body">
                        <div class="input-field-group">
                            <label for="new-user-name">Full Display Name</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-user'></i>
                                <input type="text" id="new-user-name" placeholder="e.g. Marcus Vance" required>
                            </div>
                        </div>
                        <div class="input-field-group">
                            <label for="new-user-email">Network Email Address</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-envelope'></i>
                                <input type="email" id="new-user-email" placeholder="e.g. m.vance@nexuist.io" required>
                            </div>
                        </div>
                        <div class="input-field-group">
                            <label for="new-user-phone">Phone Number Line</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-phone'></i>
                                <input type="text" id="new-user-phone" placeholder="e.g. +1 (555) 987-6543" required>
                            </div>
                        </div>
                        <div class="input-field-group">
                            <label for="new-user-country">Origin Country Location</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-map-pin'></i>
                                <input type="text" id="new-user-country" placeholder="e.g. United Kingdom" required>
                            </div>
                        </div>
                        <div class="input-field-group">
                            <label for="new-user-balance">Initial Capital Allocation ($)</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-dollar'></i>
                                <input type="number" id="new-user-balance" step="0.01" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="input-field-group">
                            <label for="new-user-crypto">Crypto Reference Text</label>
                            <div class="modal-input-wrapper">
                                <i class='bx bx-coin-stack'></i>
                                <input type="text" id="new-user-crypto" placeholder="e.g. 0.00 BTC" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel modal-close-btn">Cancel</button>
                        <button type="submit" class="btn-modal-submit-save">Initialize Account</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modal-block-node" class="nexuist-modal-overlay">
            <div class="modal-glass-container card-width-small border-danger-glow">
                <div class="modal-header">
                    <h3 class="text-danger-flicker"><i class='bx bx-shield-x'></i> Security Restriction</h3>
                    <button class="modal-close-btn">&times;</button>
                </div>
                <div class="modal-body text-center-alignment">
                    <div class="warning-icon-shield"><i class='bx bx-error-alt'></i></div>
                    <h4>Restrict System Access?</h4>
                    <p class="text-muted">You are terminating core authentication keys and freezing current liquidity
                        assets for client account: <strong id="m-block-uid">#NEX-10942</strong>.</p>
                </div>
                <div class="modal-footer justify-center">
                    <button class="btn-modal-cancel modal-close-btn">Abort Action</button>
                    <button id="btn-confirm-node-block" class="btn-modal-action-danger">Confirm Restriction</button>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/users.js') }}"></script>
</body>

</html>