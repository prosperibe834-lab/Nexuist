<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/withdrawals.css') }}">
</head>

<body>

    <!-- Preloader starts here -->

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

    <!-- Preloader ends here -->

        @include('AdminDashboard.layouts.admin-sidebar')


    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">withdrawals</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="withdraw-workspace-container nx-w-animate-fade-in">

    <div class="nx-w-metrics-grid">
        <div class="nx-w-card glow-border-primary">
            <div class="nx-w-card-header">
                <span>PENDING OUTFLOW VOLUME</span>
                <i class='bx bx-time-five icon-w-warn'></i>
            </div>
            <div class="nx-w-card-body">
                <h2>${{ number_format($stats['total_pending_amount'] ?? 0, 2) }}</h2>
                <div class="nx-w-pill pill-warn">
                    <i class='bx bx-git-pull-request'></i> {{ $stats['pending'] ?? 0 }} Pending Sign-offs
                </div>
            </div>
            <p class="nx-w-meta">Awaiting administrative clearance authorization</p>
        </div>

        <div class="nx-w-card glow-border-secondary">
            <div class="nx-w-card-header">
                <span>SETTLED WITHDRAWALS (30D)</span>
                <i class='bx bx-check-shield icon-w-success'></i>
            </div>
            <div class="nx-w-card-body">
                <h2>${{ number_format($stats['total_approved_amount'] ?? 0, 2) }}</h2>
                <div class="nx-w-pill pill-success">
                    <i class='bx bx-trending-down'></i> -8.2% Outflow Rate
                </div>
            </div>
            <p class="nx-w-meta">Successfully debited system liquidity reserves</p>
        </div>

        <div class="nx-w-card glow-border-accent">
            <div class="nx-w-card-header">
                <span>DOMINANT ROUTING ENDPOINT</span>
                <i class='bx bx-bank icon-w-accent'></i>
            </div>
            <div class="nx-w-card-body">
                <h2>{{ !empty($stats['dominant_routing_endpoint']) ? ucfirst(str_replace('_', ' ', $stats['dominant_routing_endpoint'])) : 'No Data' }}</h2>
                <div class="nx-w-pill pill-accent">
                    <i class='bx bx-shuffle'></i> 52% Selection
                </div>
            </div>
            <p class="nx-w-meta">Primary client payout pipeline choice</p>
        </div>
    </div>

    <div class="nx-w-panel-workspace">
        <div class="nx-w-panel-header">
            <div class="nx-w-title-block">
                <h3><i class='bx bx-export'></i> Withdrawal Settlement Pipeline</h3>
                <p class="nx-w-subtitle">Audit outgoing debit instructions, verify client destination details, and update settlement flags</p>
            </div>
            
            <div class="nx-w-filter-action-bar">
                <div class="nx-w-search-box">
                    <i class='bx bx-search search-w-icon'></i>
                    <input type="text" placeholder="Search by Batch TXID, Node ID, Destination..." id="withdraw-search-input">
                </div>
                <div class="nx-w-dropdown-anchor">
                    <button class="nx-w-btn-glass" id="withdraw-btn-filter">
                        <i class='bx bx-filter-alt'></i> Filter Matrix
                    </button>

                    <div class="nx-w-floating-dropdown" id="withdraw-filter-dropdown">
                        <div class="nx-w-field-row">
                            <label>Processing State</label>
                            <select id="filter-withdraw-status">
                                <option value="all">All States</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="nx-w-field-row">
                            <label>Payout Channel</label>
                            <select id="filter-withdraw-method">
                                <option value="all">All Channels</option>
                                <option value="bank transfer">Bank Transfer</option>
                                <option value="crypto">Crypto Network</option>
                                <option value="debit card">Debit Card</option>
                            </select>
                        </div>
                        <div class="nx-w-dropdown-footer">
                            <button id="btn-reset-withdraw-filters"><i class='bx bx-refresh'></i> Reset Parameters</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nx-w-table-responsive">
            <table class="nx-w-fintech-table" id="nexuist-withdraw-table">
                <thead>
                    <tr>
                        <th>Debit Reference ID</th>
                        <th>User Target Node</th>
                        <th>Payout Channel</th>
                        <th>Withdrawal Amount</th>
                        <th>Target Destination Address</th>
                        <th>Settlement State</th>
                        <th style="text-align: right;">Review Management</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($withdrawals as $withdrawal)
                    <tr class="nx-w-data-row" data-id="{{ $withdrawal->id }}" data-txid="{{ $withdrawal->transaction_id }}" data-uid="#NEX-{{ $withdrawal->user->id }}" data-name="{{ $withdrawal->user->name }}" data-method="{{ ucfirst(str_replace('_', ' ', $withdrawal->method)) }}" data-amount="{{ number_format($withdrawal->amount, 2, '.', '') }}" data-destination="{{ $withdrawal->wallet_address }}" data-status="{{ ucfirst($withdrawal->status) }}">
                        <td><span class="nx-w-hash-tag">{{ $withdrawal->transaction_id }}</span></td>
                        <td>
                            <div class="nx-w-profile-cell">
                                <div class="nx-w-avatar avatar-purple">{{ strtoupper(substr($withdrawal->user->name, 0, 2)) }}</div>
                                <div class="nx-w-profile-info">
                                    <span class="nx-w-username">{{ $withdrawal->user->name }}</span>
                                    <span class="nx-w-uid">#NEX-{{ $withdrawal->user->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="nx-w-method-text"><i class='bx {{ $withdrawal->source_wallet === 'btc_yield' ? 'bxl-bitcoin' : ($withdrawal->source_wallet === 'usdt_main' ? 'bx-wallet' : 'bx-bank') }} text-muted'></i> {{ $withdrawal->source_wallet === 'btc_yield' ? 'Bitcoin Vault' : ($withdrawal->source_wallet === 'usdt_main' ? 'USDT Balance' : ucfirst(str_replace('_', ' ', $withdrawal->method))) }}</span></td>
                        <td><span class="nx-w-value-negative">${{ number_format($withdrawal->amount, 2) }}</span></td>
                        <td><span class="nx-w-dest-text">{{ $withdrawal->wallet_address }}</span></td>
                        <td><span class="nx-w-status status-w-{{ strtolower($withdrawal->status) }}"><i class='bx bx-time-five'></i> {{ ucfirst($withdrawal->status) }}</span></td>
                        <td>
                            <div class="nx-w-actions-group">
                                <button class="nx-w-action-btn withdraw-action-review" title="Process Outflow Instruction"><i class='bx bx-slider-alt'></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="withdraw-empty-row">
                        <td colspan="7" class="nx-w-empty-fallback">
                            <i class='bx bx-transfer-alt empty-w-icon'></i>
                            <p>No withdrawal logs cross-intersect your active parameter configuration.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="nx-w-pagination-footer">
            <span class="nx-w-pagination-info" id="withdraw-pagination-status">Showing 1 to 2 of 2 Entries</span>
            <div class="nx-w-pagination-controls" id="withdraw-pagination-controls"></div>
        </div>
    </div>
</div>

<div id="modal-audit-withdraw" class="nx-w-modal-overlay">
    <div class="nx-w-modal-container">
        <div class="nx-w-modal-header">
            <h3><i class='bx bx-shield-quarter'></i> Authorize Outbound Payout</h3>
            <button class="nx-w-modal-close">&times;</button>
        </div>
        <div class="nx-w-modal-body">
            <div class="nx-w-modal-user-profile">
                <span id="m-withdraw-txid" class="nx-w-hash-tag spacing-b">WTH-00000000</span>
                <h4 id="m-withdraw-user">Target Client User</h4>
                <p id="m-withdraw-meta" class="nx-w-text-muted">Account key mapping framework</p>
            </div>
            
            <div class="nx-w-modal-grid">
                <div class="nx-w-modal-box">
                    <label>Debiting Amount</label>
                    <span id="m-withdraw-amount" class="nx-w-modal-val text-neon-red">$0.00</span>
                </div>
                <div class="nx-w-modal-box">
                    <label>Payout Route Channel</label>
                    <span id="m-withdraw-method" class="nx-w-modal-val">Channel</span>
                </div>
            </div>

            <div class="nx-w-destination-container">
                <label class="nx-w-destination-header"><i class='bx bx-git-commit'></i> Terminal Destination Endpoint</label>
                <div class="nx-w-destination-display-box" id="m-withdraw-destination">
                    System processing endpoint link address...
                </div>
                
                <div class="nx-w-security-notice">
                    <i class='bx bx-info-circle'></i>
                    <span>Ensure target destination checks match ledger profile routes before authorizing payouts. Executed actions are instant.</span>
                </div>

                <div class="nx-w-modal-actions" id="withdraw-workflow-actions">
                    <button class="nx-w-act-btn w-approve-btn" id="btn-withdraw-approve">
                        <i class='bx bx-check-shield'></i> Approve Payout
                    </button>
                    <button class="nx-w-act-btn w-reject-btn" id="btn-withdraw-reject">
                        <i class='bx bx-error-alt'></i> Decline Request
                    </button>
                </div>
                <div id="withdraw-status-locked-notice" class="nx-w-locked-banner" style="display:none;">
                    This transaction allocation state has been processed and locked.
                </div>
            </div>
        </div>
    </div>
</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/withdrawals.js') }}"></script>
</body>

</html>