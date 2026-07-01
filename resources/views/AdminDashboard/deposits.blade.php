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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/deposits.css') }}">
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
                <h1 id="page-title-display">Deposit</h1>
            </div>
        </header>

        <div class="deposits-workspace-container nx-animate-fade-in">
            <div class="nx-metrics-grid-strip">
                <div class="nx-metric-card border-glow-primary">
                    <div class="nx-card-header"><span>PENDING DEPOSITS VOLUME</span><i
                            class='bx bx-time-five icon-badge-warn'></i></div>
                    <div class="nx-card-body">
                        <h2>${{ number_format($pendingVolume, 2) }}</h2>
                        <div class="nx-badge-action-pill warning-glow">
                            <i class='bx bx-git-pull-request'></i>
                            {{ $pendingCount }} Action Items
                        </div>
                    </div>
                    <p class="nx-meta-text">Awaiting administrative document verification</p>
                </div>
                
                <div class="nx-metric-card border-glow-secondary">
                    <div class="nx-card-header"><span>SUCCESSFUL INFLOWS (30D)</span><i
                            class='bx bx-wallet icon-badge-success'></i></div>
                    <div class="nx-card-body">
                        <h2>${{ number_format($successfulInflows, 2) }}</h2>
                        <div class="nx-badge-action-pill success-glow">
                            <i class='bx bx-trending-up'></i>
                            {{ $growthPercentage >= 0 ? '+' : '' }}{{ $growthPercentage }}%
                        </div>
                    </div>
                    <p class="nx-meta-text">Cleared and committed ledger injections</p>
                </div>

                <div class="nx-metric-card border-glow-accent">
                    <div class="nx-card-header"><span>MOST USED GATEWAY</span><i
                            class='bx bxl-bitcoin icon-badge-accent'></i></div>
                    <div class="nx-card-body">
                        <h2>{{ $mostUsedGateway->method ?? 'N/A' }}</h2>
                        <div class="nx-badge-action-pill accent-glow">
                            <i class='bx bx-bolt-circle'></i>
                            {{ $gatewayPercentage }}% Share
                        </div>
                    </div>
                    <p class="nx-meta-text">Preferred settlement transaction vector</p>
                </div>
            </div>

            <div class="nx-panel-card-workspace">
                <div class="nx-panel-header">
                    <div class="nx-title-block">
                        <h3><i class='bx bx-credit-card-front'></i> Deposit Pipeline Records</h3>
                        <p class="nx-panel-subtitle">Review verification receipts, process client allocations, and
                            reconcile gateway settlement exceptions</p>
                    </div>
                    <div class="nx-action-filter-strip">
                        <div class="nx-search-input-frame">
                            <i class='bx bx-search nx-search-icon'></i>
                            <input type="text" placeholder="Search by TXID, Node ID, or Name..."
                                id="deposit-search-input">
                        </div>
                        <div class="nx-dropdown-anchor-wrapper">
                            <button class="nx-btn-glass" id="deposit-btn-filter"><i class='bx bx-filter-alt'></i> Filter
                                Matrix</button>
                            <div class="nx-floating-filter-panel" id="deposit-filter-dropdown">
                                <div class="nx-filter-field-row"><label>Processing State</label><select
                                        id="filter-deposit-status">
                                        <option value="all">All States</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select></div>
                                <div class="nx-filter-field-row"><label>Payment Gateway</label><select
                                        id="filter-deposit-method">
                                        <option value="all">All Gateways</option>
                                        <option value="crypto">Crypto Network</option>
                                        <option value="bank transfer">Bank Transfer</option>
                                        <option value="debit card">Debit Card</option>
                                    </select></div>
                                <div class="nx-filter-dropdown-footer"><button id="btn-reset-deposit-filters"><i
                                            class='bx bx-refresh'></i> Reset Parameters</button></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nx-table-responsive-wrapper">
                    <table class="nx-premium-table" id="nexuist-deposit-table">
                        <thead>
                            <tr>
                                <th>Transaction Hash</th>
                                <th>User Account Node</th>
                                <th>Funding Gateway</th>
                                <th>Deposit Amount</th>
                                <th>Submission Time</th>
                                <th>Verification State</th>
                                <th style="text-align: right;">Review Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposits as $deposit)

                                <tr class="nx-deposit-row" data-txid="{{ $deposit->txid }}"
                                    data-uid="#NEX-{{ $deposit->user_id }}" data-name="{{ optional($deposit->user)->name }}"
                                    data-method="{{ $deposit->method }}" data-amount="{{ $deposit->amount }}"
                                    data-status="{{ $deposit->status }}"
                                    data-proof="{{ asset('storage/' . $deposit->proof_image) }}">
                                    <td><span class="nx-hash-tag">{{ $deposit->txid }}</span></td>
                                    <td>
                                        <div class="nx-user-profile-cell">
                                            <div class="nx-avatar-circle circle-purple">
                                                {{ substr(optional($deposit->user)->name ?? 'U', 0, 1) }}
                                            </div>
                                            <div class="nx-profile-details">
                                                <span
                                                    class="nx-user-name">{{ optional($deposit->user)->name ?? 'Unknown' }}</span>
                                                <span class="nx-user-uid">#NEX-{{ $deposit->user_id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="nx-gateway-type"><i class='bx bx-wallet'></i>
                                            {{ $deposit->method }}</span></td>
                                    <td><span class="nx-value-positive">${{ number_format($deposit->amount, 2) }}</span>
                                    </td>
                                    <td><span
                                            class="nx-timestamp-text">{{ $deposit->created_at->format('Y-m-d H:i') }}</span>
                                    </td>
                                    <td><span class="nx-badge status-{{ strtolower($deposit->status) }}"><i
                                                class='bx {{ $deposit->status == "Approved" ? "bx-check-circle" : "bx-time-five" }}'></i>
                                            {{ $deposit->status }}</span></td>
                                    <td style="text-align: right;">
                                        <div class="nx-action-buttons-group">
                                            <button class="nx-action-btn btn-audit deposit-action-review"
                                                title="Audit System Proof"><i class='bx bx-receipt'></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr id="deposit-empty-row" style="display: none;">
                                <td colspan="7" class="nx-table-empty-fallback"><i
                                        class='bx bx-receipt empty-icon-glow'></i>
                                    <p>No deposit log chains intersect your selected matrix filter state.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="nx-table-pagination-footer">
                    <span class="nx-pagination-info" id="deposit-pagination-status">Ledger entries loaded</span>
                    <div class="nx-pagination-controls" id="deposit-pagination-controls"></div>
                </div>
            </div>
        </div>


        <div id="modal-audit-deposit" class="nx-modal-system-overlay">
            <div class="nx-modal-glass-container">
                <div class="nx-modal-header">
                    <h3><i class='bx bx-shield-quarter'></i> Audit Verification Receipt</h3>
                    <button class="nx-modal-close-trigger">&times;</button>
                </div>
                <div class="nx-modal-body">
                    <div class="nx-modal-profile-header">
                        <span id="m-deposit-txid" class="nx-hash-tag text-center-inline">TXN-00000000</span>
                        <h4 id="m-deposit-user">Client User Node</h4>
                        <p id="m-deposit-meta" class="nx-text-muted">Account index mapping key</p>
                    </div>
                    <div class="nx-modal-metrics-grid">
                        <div class="nx-modal-metric-box"><label>Inflow Allocation</label><span id="m-deposit-amount"
                                class="nx-modal-highlight-val balance-glow-green">$0.00</span></div>
                        <div class="nx-modal-metric-box"><label>Settlement Gateway</label><span id="m-deposit-gateway"
                                class="nx-modal-highlight-val">Processing...</span></div>
                    </div>
                    <div class="nx-receipt-audit-container">
                        <h5><i class='bx bx-image-alt'></i> Uploaded Core Transfer Confirmation Slip</h5>
                        <!-- <div class="nx-mock-receipt-viewbox"><i class='bx bx-receipt nx-receipt-placeholder-icon'></i>
                            <p class="nx-receipt-filename-tag">SYSTEM_PROOF_RECEIPT_TRANSACTION.PNG</p>
                        </div> -->

                        <div class="nx-mock-receipt-viewbox">
                            <img id="deposit-proof-image" src="" style="max-width:100%;border-radius:10px;">
                        </div>

                        <div class="nx-modal-workflow-buttons" id="deposit-workflow-actions">
                            <button class="nx-workflow-btn approve-btn-trigger" id="btn-deposit-approve"><i
                                    class='bx bx-check-shield'></i> Authorize Inflow</button>
                            <button class="nx-workflow-btn reject-btn-trigger" id="btn-deposit-reject"><i
                                    class='bx bx-x-circle'></i> Decline Payment</button>
                        </div>
                        <div id="deposit-status-locked-notice" class="nx-status-locked-banner" style="display:none;">
                            This ledger line allocation state has been verified and committed.</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/deposits.js') }}"></script>
</body>

</html>