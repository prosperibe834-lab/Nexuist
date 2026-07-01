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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/AdminReferUSer.css') }}">
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

        @include('AdminDashboard.layouts.admin-sidebar')


    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">AdminReferUSer</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
       <div class="nx-workspace-container">

    <header class="nx-page-header animate-fade-in">
        <div class="header-identity">
            <span class="header-badge"><i class="bx bx-git-branch"></i> Referral Core Matrix</span>
            <h1>Referral Management</h1>
            <p>Monitor referral performance, commissions, rewards, and network growth structures.</p>
        </div>
        <div class="header-actions-group">
            <button class="nx-action-btn variant-glass" onclick="triggerToast('info', 'Compiling CSV payload metrics...')"><i class="bx bx-file"></i> <span>Export CSV</span></button>
            <button class="nx-action-btn variant-glass" onclick="triggerToast('info', 'Structuring Excel dataset spreadsheets...')"><i class="bx bx-spreadsheet"></i> <span>Export Excel</span></button>
            <button class="nx-action-btn variant-glass" onclick="window.print()"><i class="bx bx-printer"></i> <span>Print</span></button>
            <button class="nx-action-btn variant-primary" onclick="openSystemModal('commsModal')"><i class="bx bx-slider-alt"></i> <span>Commission Ops</span></button>
        </div>
    </header>

    <section class="nx-stats-grid">
        <div class="nx-stat-card glass-panel animate-slide-up">
            <div class="card-meta-row">
                <div class="icon-frame primary-glow"><i class="bx bx-group"></i></div>
                <span class="trend-badge status-up">+14.2% <i class="bx bx-trending-up"></i></span>
            </div>
            <div class="card-numeric-data">
                <h2 class="nx-counter" data-target="{{ $totalRegisteredReferrals }}">0</h2>
                <p>Total Registered Referrals</p>
            </div>
            <div class="mini-sparkline"><div class="spark-bar" style="height:40%"></div><div class="spark-bar" style="height:55%"></div><div class="spark-bar" style="height:45%"></div><div class="spark-bar" style="height:70%"></div><div class="spark-bar" style="height:85%"></div></div>
        </div>
        <div class="nx-stat-card glass-panel animate-slide-up" style="animation-delay: 0.05s;">
            <div class="card-meta-row">
                <div class="icon-frame secondary-glow"><i class="bx bx-user-check"></i></div>
                <span class="trend-badge status-up">+8.6% <i class="bx bx-trending-up"></i></span>
            </div>
            <div class="card-numeric-data">
                <h2 class="nx-counter" data-target="{{ $activeNetworkNodes }}">0</h2>
                <p>Active Network Nodes</p>
            </div>
            <div class="mini-sparkline"><div class="spark-bar" style="height:30%"></div><div class="spark-bar" style="height:40%"></div><div class="spark-bar" style="height:60%"></div><div class="spark-bar" style="height:50%"></div><div class="spark-bar" style="height:78%"></div></div>
        </div>
        <div class="nx-stat-card glass-panel animate-slide-up" style="animation-delay: 0.1s;">
            <div class="card-meta-row">
                <div class="icon-frame accent-glow"><i class="bx bx-wallet"></i></div>
                <span class="trend-badge status-up">+22.1% <i class="bx bx-trending-up"></i></span>
            </div>
            <div class="card-numeric-data">
                <h2>$<span class="nx-counter" data-target="{{ $totalDistributedEarnings }}">0</span></h2>
                <p>Total Distributed Earnings</p>
            </div>
            <div class="mini-sparkline"><div class="spark-bar" style="height:50%"></div><div class="spark-bar" style="height:45%"></div><div class="spark-bar" style="height:70%"></div><div class="spark-bar" style="height:65%"></div><div class="spark-bar" style="height:90%"></div></div>
        </div>
        <div class="nx-stat-card glass-panel animate-slide-up" style="animation-delay: 0.15s;">
            <div class="card-meta-row">
                <div class="icon-frame"><i class="bx bx-time-five"></i></div>
                <span class="trend-badge status-down">-3.4% <i class="bx bx-trending-down"></i></span>
            </div>
            <div class="card-numeric-data">
                <h2>$<span class="nx-counter" data-target="{{ $pendingAccumulations }}">0</span></h2>
                <p>Pending Accumulations</p>
            </div>
            <div class="mini-sparkline"><div class="spark-bar" style="height:70%"></div><div class="spark-bar" style="height:60%"></div><div class="spark-bar" style="height:50%"></div><div class="spark-bar" style="height:40%"></div><div class="spark-bar" style="height:25%"></div></div>
        </div>
    </section>

    <section class="nx-analytics-split">
        <div class="nx-chart-panel glass-panel animate-slide-up">
            <div class="panel-header">
                <h3><i class="bx bx-chart icon-accent"></i> Telemetry & Network Delta Metrics</h3>
                <div class="tab-pill-group">
                    <button class="pill-btn active">Daily</button>
                    <button class="pill-btn">Weekly</button>
                    <button class="pill-btn">Monthly</button>
                </div>
            </div>
            <div class="mock-chart-container">
                <div class="mock-chart-axis-y">
                    <span>100k</span><span>50k</span><span>10k</span><span>0</span>
                </div>
                <div class="mock-chart-bars-viewport">
                    <div class="chart-bar-node" style="--bar-height: 45%;" data-label="Jan"></div>
                    <div class="chart-bar-node" style="--bar-height: 65%;" data-label="Feb"></div>
                    <div class="chart-bar-node active" style="--bar-height: 85%;" data-label="Mar"></div>
                    <div class="chart-bar-node" style="--bar-height: 55%;" data-label="Apr"></div>
                    <div class="chart-bar-node" style="--bar-height: 70%;" data-label="May"></div>
                    <div class="chart-bar-node" style="--bar-height: 95%;" data-label="Jun"></div>
                </div>
            </div>
        </div>

        <div class="nx-notifications-panel glass-panel animate-slide-up" style="animation-delay: 0.1s;">
            <div class="panel-header">
                <h3><i class="bx bx-bell animate-pulse"></i> Dynamic Operational Signals</h3>
                <span class="badge-count-pulse">Live</span>
            </div>
            <div class="notifications-stream-wrapper">
                <div class="stream-item-alert">
                    <div class="alert-indicator status-active"></div>
                    <div class="alert-content">
                        <p><strong>Node NX-9082</strong> hit Tier: Platinum Elite parameters</p>
                        <small>02 mins ago</small>
                    </div>
                </div>
                <div class="stream-item-alert">
                    <div class="alert-indicator status-pending"></div>
                    <div class="alert-content">
                        <p>Commission allocation authorization pending for <strong>Lagos-Hub-01</strong></p>
                        <small>14 mins ago</small>
                    </div>
                </div>
                <div class="stream-item-alert">
                    <div class="alert-indicator status-active"></div>
                    <div class="alert-content">
                        <p>New terminal verification cluster processed for region: <strong>Owerri Tech</strong></p>
                        <small>1 hr ago</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="nx-filter-bar glass-panel animate-slide-up">
        <div class="search-input-shell">
            <i class="bx bx-search search-lens"></i>
            <input type="text" id="tableSearchQuery" placeholder="Filter node telemetry fields by Full Name, Email, or Unique Referral ID ID..." oninput="executeTableClientSearchFilter()">
        </div>
        <div class="filter-dropdowns-row">
            <select id="filterCountryOpt" onchange="executeTableClientSearchFilter()">
                <option value="">Global Geography (All)</option>
                <option value="Nigeria">Nigeria</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Germany">Germany</option>
            </select>
            <select id="filterTierOpt" onchange="executeTableClientSearchFilter()">
                <option value="">All Account Tiers</option>
                <option value="Elite">Elite</option>
                <option value="Gold">Gold</option>
                <option value="Silver">Silver</option>
            </select>
            <button class="nx-action-btn variant-glass" onclick="resetSearchFilterMatrixFields()"><i class="bx bx-refresh"></i> Clear Matrix</button>
        </div>
    </section>

    <div class="nx-bulk-actions-strip hidden animate-fade-in" id="bulkActionsStrip">
        <div class="strip-meta"><i class="bx bx-select-multiple"></i> <span id="bulkSelectedCount">0</span> elements highlighted</div>
        <div class="strip-buttons-cluster">
            <button class="nx-action-btn variant-glass" onclick="triggerBulkToast('Approved rewards for highlighted items')"><i class="bx bx-check-shield"></i> Approve Rewards</button>
            <button class="nx-action-btn variant-glass" onclick="triggerBulkToast('Disbursed tracking payouts to selected nodes')"><i class="bx bx-money"></i> Mark Paid</button>
            <button class="nx-action-btn variant-danger-action" onclick="triggerBulkToast('Purged highlighted database rows')"><i class="bx bx-trash"></i> Drop Entries</button>
        </div>
    </div>

    <section class="nx-table-viewport-card glass-panel animate-slide-up">
        <div class="table-scroller-chassis">
            <table class="nx-core-data-table" id="referralsMasterTable">
                <thead>
                    <tr>
                        <th style="width: 40px;"><input type="checkbox" id="masterCheckboxSelector" onclick="toggleAllTableCheckboxes(this)"></th>
                        <th>User Identifier Token</th>
                        <th>Referral Vector</th>
                        <th>Network Scope</th>
                        <th>Total Yield Metrics</th>
                        <th>Status Badge</th>
                        <th style="text-align: right;">Operations Console</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($referralUsers as $user)
                        <tr class="table-data-row" data-name="{{ $user['name'] }}" data-email="{{ $user['email'] }}" data-id="{{ $user['referral_code'] }}" data-country="{{ $user['country'] }}" data-tier="{{ $user['tier'] }}">
                            <td><input type="checkbox" class="row-item-checkbox" onclick="evaluateBulkActionStripState()"></td>
                            <td>
                                <div class="user-identity-cell">
                                    <div class="avatar-thumbnail font-placeholder accent-bg">{{ strtoupper(substr($user['name'], 0, 2)) }}</div>
                                    <div class="identity-meta">
                                        <span class="user-main-title">{{ $user['name'] }}</span>
                                        <span class="user-sub-title">{{ $user['email'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="identity-meta">
                                    <span class="user-main-title">ID: <strong class="copyable-token">{{ $user['referral_code'] }}</strong></span>
                                    <span class="user-sub-title"><i class="bx bx-map-pin"></i> {{ $user['country'] ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="identity-meta">
                                    <span class="user-main-title"><strong>{{ $user['referrals_count'] }}</strong> Nodes</span>
                                    <span class="user-sub-title">Tier Level: {{ $user['tier'] }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="identity-meta">
                                    <span class="user-main-title text-success">${{ $user['total_earnings'] }}</span>
                                    <span class="user-sub-title">Pending: $0.00</span>
                                </div>
                            </td>
                            <td><span class="status-pill state-{{ $user['status'] === 'Synchronized' ? 'success' : 'warning' }}">{{ $user['status'] }}</span></td>
                            <td style="text-align: right;">
                                <div class="table-actions-menu">
                                    <button class="action-icon-btn" title="View Diagnostics" onclick="openSystemModal('viewUserModal')"><i class="bx bx-show-alt"></i></button>
                                    <button class="action-icon-btn" title="Graph Layout Tree" onclick="openSystemModal('networkTreeModal')"><i class="bx bx-git-merge"></i></button>
                                    <button class="action-icon-btn" title="Accounting Breakdown" onclick="openSystemModal('breakdownModal')"><i class="bx bx-pie-chart-alt-2"></i></button>
                                    <button class="action-icon-btn" title="Activity Logs" onclick="openSystemModal('historyModal')"><i class="bx bx-history"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="nx-empty-state-viewport hidden" id="tableEmptyStateView">
            <div class="empty-vector-shell"><i class="bx bx-unite animate-pulse"></i></div>
            <h4>No Reference Coordinates Located</h4>
            <p>Your search filters do not match any active log records in our data systems.</p>
        </div>
    </section>

    <section class="nx-tiers-and-leaderboard-grid">
        <div class="nx-leaderboard-panel glass-panel animate-slide-up">
            <div class="panel-header">
                <h3><i class="bx bx-trophy text-warning"></i> Elite Node Infrastructure Leaderboard</h3>
            </div>
            <div class="leaderboard-stack">
                <div class="leader-row-node">
                    <span class="medal-rank badge-gold">1</span>
                    <div class="leader-avatar text-avatar">CB</div>
                    <div class="leader-info"><strong>Chidi Benz</strong><small>Nigeria</small></div>
                    <div class="leader-score"><strong>42</strong> referrals</div>
                </div>
                <div class="leader-row-node">
                    <span class="medal-rank badge-silver">2</span>
                    <div class="leader-avatar text-avatar">SJ</div>
                    <div class="leader-info"><strong>Sarah Jenkins</strong><small>United Kingdom</small></div>
                    <div class="leader-score"><strong>19</strong> referrals</div>
                </div>
                <div class="leader-row-node">
                    <span class="medal-rank badge-bronze">3</span>
                    <div class="leader-avatar text-avatar">DK</div>
                    <div class="leader-info"><strong>Dieter Krause</strong><small>Germany</small></div>
                    <div class="leader-score"><strong>8</strong> referrals</div>
                </div>
            </div>
        </div>

        <div class="nx-tier-management-panel glass-panel animate-slide-up" style="animation-delay: 0.1s;">
            <div class="panel-header">
                <h3><i class="bx bx-layer icon-accent"></i> Core Network Account Tiers</h3>
            </div>
            <div class="tier-meters-stack">
                <div class="tier-meter-item">
                    <div class="meter-meta"><span>Starter Core Tier (0 - 5 Nodes)</span><strong>45% active</strong></div>
                    <div class="meter-chassis"><div class="meter-fill" style="width: 45%;"></div></div>
                </div>
                <div class="tier-meter-item">
                    <div class="meter-meta"><span>Silver / Gold Tier (5 - 25 Nodes)</span><strong>82% active</strong></div>
                    <div class="meter-chassis"><div class="meter-fill design-accent" style="width: 82%;"></div></div>
                </div>
                <div class="tier-meter-item">
                    <div class="meter-meta"><span>Platinum Elite Tier (25+ Nodes)</span><strong>94% active</strong></div>
                    <div class="meter-chassis"><div class="meter-fill design-success" style="width: 94%;"></div></div>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="nx-modal-shroud" id="viewUserModal">
    <div class="nx-modal-body glass-panel">
        <div class="modal-top-bar">
            <h3><i class="bx bx-shield-user"></i> Node Profile Verification</h3>
            <button class="close-overlay-btn" onclick="closeSystemModal('viewUserModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="modal-scroll-core">
            <div class="profile-hero-badge-card">
                <div class="hero-avatar">CB</div>
                <h3>Chidi Benz</h3>
                <span class="status-pill state-success">Identity Verified</span>
            </div>
            <div class="meta-data-properties-grid">
                <div class="prop-node"><small>Communication Anchor</small><span>chidi@nexuist.com</span></div>
                <div class="prop-node"><small>Referral Identification Token</small><span>NEX-8902</span></div>
                <div class="prop-node"><small>Assigned Tier Level</small><span>Elite Flagship</span></div>
                <div class="prop-node"><small>Network Affiliation Node</small><span>Owerri Hub Complex</span></div>
            </div>
        </div>
    </div>
</div>

<div class="nx-modal-shroud" id="networkTreeModal">
    <div class="nx-modal-body glass-panel style-wide">
        <div class="modal-top-bar">
            <h3><i class="bx bx-git-repo-forked"></i> Structural Multi-Tier Referral Map</h3>
            <button class="close-overlay-btn" onclick="closeSystemModal('networkTreeModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="modal-scroll-core">
            <div class="visual-tree-canvas">
                <div class="tree-root-node"><i class="bx bxs-user-rectangle"></i> Root Host (Chidi Benz)</div>
                <div class="tree-branch-chassis">
                    <div class="tree-child-leaf"><i class="bx bx-git-commit"></i> Tier 1: Node Alpha (Paid)</div>
                    <div class="tree-child-leaf"><i class="bx bx-git-commit"></i> Tier 1: Node Beta (Active)</div>
                    <div class="tree-child-leaf"><i class="bx bx-git-commit"></i> Tier 1: Node Gamma (Pending)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="nx-modal-shroud" id="breakdownModal">
    <div class="nx-modal-body glass-panel">
        <div class="modal-top-bar">
            <h3><i class="bx bx-pie-chart-alt"></i> Revenue Breakdown Statements</h3>
            <button class="close-overlay-btn" onclick="closeSystemModal('breakdownModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="modal-scroll-core">
            <div class="tier-meters-stack">
                <div class="tier-meter-item">
                    <div class="meter-meta"><span>Direct Referrals Level 1</span><strong>$5,200.00</strong></div>
                    <div class="meter-chassis"><div class="meter-fill" style="width: 70%;"></div></div>
                </div>
                <div class="tier-meter-item">
                    <div class="meter-meta"><span>Indirect Referrals Level 2</span><strong>$2,150.00</strong></div>
                    <div class="meter-chassis"><div class="meter-fill design-accent" style="width: 45%;"></div></div>
                </div>
                <div class="tier-meter-item">
                    <div class="meter-meta"><span>Promotional Bonuses Matrix</span><strong>$1,100.00</strong></div>
                    <div class="meter-chassis"><div class="meter-fill design-success" style="width: 30%;"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="nx-modal-shroud" id="historyModal">
    <div class="nx-modal-body glass-panel style-wide">
        <div class="modal-top-bar">
            <h3><i class="bx bx-history"></i> System Activity Audit Trail</h3>
            <button class="close-overlay-btn" onclick="closeSystemModal('historyModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="modal-scroll-core">
            <table class="nx-core-data-table">
                <thead>
                    <tr>
                        <th>Timestamp Logs</th>
                        <th>Action Protocol</th>
                        <th>Reference Variable</th>
                        <th>Yield Metric</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>2026-06-24 14:22</td><td>Level 1 Settlement</td><td>Node: Alpha Secure</td><td class="text-success">+$45.00</td></tr>
                    <tr><td>2026-06-23 09:11</td><td>System Milestone Trigger</td><td>Tier Shift: Elite Achievement</td><td class="text-success">+$250.00</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="nx-modal-shroud" id="commsModal">
    <div class="nx-modal-body glass-panel">
        <div class="modal-top-bar">
            <h3><i class="bx bx-slider-alt"></i> Manual Allocation Operations</h3>
            <button class="close-overlay-btn" onclick="closeSystemModal('commsModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="modal-scroll-core">
            <form class="modal-interactive-form" onsubmit="event.preventDefault(); triggerCommissionConfirmationAction();">
                <div class="form-input-node">
                    <label>Target Target Node Key ID</label>
                    <input type="text" value="NEX-8902" required class="form-chassis-input">
                </div>
                <div class="form-input-node">
                    <label>Adjustment Metric Amount ($)</label>
                    <input type="number" value="150" required class="form-chassis-input">
                </div>
                <div class="modal-form-actions">
                    <button type="submit" class="nx-action-btn variant-primary">Authorize Allocation Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="nx-toast-stream-anchor" id="toastContainer"></div>

    <script src="{{ asset('assets/AdminDashboard/js/AdminReferUSer.js') }}"></script>
</body>

</html>