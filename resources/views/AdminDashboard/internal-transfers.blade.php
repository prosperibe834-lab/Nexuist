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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/internal-transfers.css') }}">
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
                <h1 id="page-title-display">Internal Transfers</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
<div class="nx-it-workspace-container nx-it-animate-fade-in">

    <div class="nx-it-metrics-grid">
        <div class="nx-it-stat-card border-glow-primary">
            <div class="nx-it-card-header">
                <span>INTRA-SYSTEM VOLUME (24H)</span>
                <i class='bx bx-shuffle icon-it-primary'></i>
            </div>
            <div class="nx-it-card-body">
                <h2>$184,920.00</h2>
                <div class="nx-it-action-badge primary-glow">
                    <i class='bx bx-check-double'></i> 142 Clear Loops
                </div>
            </div>
            <p class="nx-it-meta-text">Total balances migrated across node layers</p>
        </div>

        <div class="nx-it-stat-card border-glow-secondary">
            <div class="nx-it-card-header">
                <span>SYSTEM LIQUIDITY BUFFER</span>
                <i class='bx bx-shield-quarter icon-it-secondary'></i>
            </div>
            <div class="nx-it-card-body">
                <h2>$2,140,850.00</h2>
                <div class="nx-it-action-badge secondary-glow">
                    <i class='bx bx-lock-alt'></i> Secure Core
                </div>
            </div>
            <p class="nx-it-meta-text">Combined off-chain liquidity clearing house pool</p>
        </div>

        <div class="nx-it-stat-card border-glow-accent">
            <div class="nx-it-card-header">
                <span>PENDING RECONCILIATIONS</span>
                <i class='bx bx-git-pull-request icon-it-accent'></i>
            </div>
            <div class="nx-it-card-body">
                <h2>0 Actions</h2>
                <div class="nx-it-action-badge accent-glow">
                    <i class='bx bx-refresh bx-spin-slow'></i> Synced
                </div>
            </div>
            <p class="nx-it-meta-text">All asset migration queries fully cleared</p>
        </div>
    </div>

    <div class="nx-it-split-layout">
        
        <div class="nx-it-form-panel">
            <div class="nx-it-panel-title-block">
                <h3><i class='bx bx-transfer-alt'></i> Execute Balance Migration</h3>
                <p>Instantly clear off-chain balance swaps between registered profiles</p>
            </div>

            <form id="nexuist-internal-transfer-form">
                <div class="nx-it-field-group">
                    <label for="it-sender-uid">Sender Account Node (UID)</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-log-out-circle text-muted'></i>
                        <input type="text" id="it-sender-uid" placeholder="e.g. #NEX-10942" autocomplete="off" required>
                    </div>
                    <div id="sender-lookup-preview" class="node-lookup-preview-box" style="display: none;">
                        <i class='bx bx-user-circle'></i> <span id="sender-preview-name">-</span> (Available: <strong id="sender-preview-balance">$0.00</strong>)
                    </div>
                </div>

                <div class="nx-it-field-group">
                    <label for="it-recipient-uid">Recipient Account Node (UID)</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-log-in-circle text-muted'></i>
                        <input type="text" id="it-recipient-uid" placeholder="e.g. #NEX-10811" autocomplete="off" required>
                    </div>
                    <div id="recipient-lookup-preview" class="node-lookup-preview-box" style="display: none;">
                        <i class='bx bx-user-circle'></i> <span id="recipient-preview-name">-</span>
                    </div>
                </div>

                <div class="nx-it-field-group">
                    <label for="it-transfer-amount">Migration Amount ($)</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-dollar text-muted'></i>
                        <input type="number" id="it-transfer-amount" step="0.01" min="1" placeholder="0.00" required>
                    </div>
                </div>

                <div class="nx-it-field-group">
                    <label for="it-transfer-memo">Administrative Routing Reference Memo</label>
                    <div class="nx-it-input-wrapper">
                        <i class='bx bx-notepad text-muted'></i>
                        <input type="text" id="it-transfer-memo" placeholder="e.g. Internal Capital Balancing Pool Adjustment">
                    </div>
                </div>

                <button type="submit" class="nx-it-submit-btn" id="btn-execute-migration">
                    <i class='bx bx-check-shield'></i> Authorize Balance Swap
                </button>
            </form>
        </div>

        <div class="nx-it-table-panel">
            <div class="nx-it-panel-header-row">
                <div class="nx-it-panel-title-block">
                    <h3><i class='bx bx-list-ul'></i> System Audit Trail Logs</h3>
                    <p>Archived history of intra-ledger profile clearings</p>
                </div>
                
                <div class="nx-it-search-box-frame">
                    <i class='bx bx-search'></i>
                    <input type="text" id="it-search-input" placeholder="Search by UID, Batch ID, or Memo...">
                </div>
            </div>

            <div class="nx-it-table-responsive-box">
                <table class="nx-it-premium-table" id="internal-transfer-audit-log-table">
                    <thead>
                        <tr>
                            <th>Batch ID</th>
                            <th>Sender Node</th>
                            <th>Recipient Node</th>
                            <th>Asset Volume</th>
                            <th>Settlement State</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="nx-it-row" data-batch="TXN-IT-4820194" data-sender="#NEX-10942" data-recipient="#NEX-10811" data-amount="2500.00">
                            <td><span class="nx-it-hash-tag">TXN-IT-4820194</span></td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-10942</span>
                                    <span class="nx-it-subtext-email">Alexander Mercer</span>
                                </div>
                            </td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-10811</span>
                                    <span class="nx-it-subtext-email">Sophia Kovac</span>
                                </div>
                            </td>
                            <td><span class="nx-it-value-delta">$2,500.00</span></td>
                            <td><span class="nx-it-status badge-success"><i class='bx bx-check-circle'></i> Committed</span></td>
                        </tr>

                        <tr class="nx-it-row" data-batch="TXN-IT-1094823" data-sender="#NEX-09754" data-recipient="#NEX-10942" data-amount="310.20">
                            <td><span class="nx-it-hash-tag">TXN-IT-1094823</span></td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-09754</span>
                                    <span class="nx-it-subtext-email">Ryan Elric</span>
                                </div>
                            </td>
                            <td>
                                <div class="nx-it-user-cell">
                                    <span class="nx-it-uid">#NEX-10942</span>
                                    <span class="nx-it-subtext-email">Alexander Mercer</span>
                                </div>
                            </td>
                            <td><span class="nx-it-value-delta">$310.20</span></td>
                            <td><span class="nx-it-status badge-success"><i class='bx bx-check-circle'></i> Committed</span></td>
                        </tr>

                        <tr id="it-empty-row" style="display: none;">
                            <td colspan="5" class="nx-it-empty-fallback-td">
                                <i class='bx bx-git-commit empty-icon-it-glow'></i>
                                <p>No internal transfer sequences match your keyword query inputs.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="nx-it-pagination-footer">
                <span class="nx-it-pagination-counter" id="it-pagination-status">Showing 1 to 2 of 2 Logs</span>
                <div class="nx-it-pagination-buttons-group" id="it-pagination-controls"></div>
            </div>
        </div>

    </div>
</div>

<div id="modal-it-compliance-signoff" class="nx-it-modal-overlay">
    <div class="nx-it-modal-card-container">
        <div class="nx-it-modal-header">
            <h3><i class='bx bx-shield-quarter-toggle'></i> Compliance Sign-off Authorization</h3>
            <button class="nx-it-modal-close-trigger">&times;</button>
        </div>
        <div class="nx-it-modal-body">
            <div class="nx-it-modal-summary-matrix">
                <div class="summary-node-item">
                    <span class="label">SENDER SOURCE</span>
                    <strong id="m-it-sender-display">#NEX-00000</strong>
                </div>
                <div class="summary-arrow-vector">
                    <i class='bx bx-right-arrow-alt bx-fade-right'></i>
                </div>
                <div class="summary-node-item">
                    <span class="label">RECIPIENT TARGET</span>
                    <strong id="m-it-recipient-display">#NEX-00000</strong>
                </div>
            </div>

            <div class="nx-it-modal-valuation-strip">
                <label>PRINCIPAL TRANSACTION BALANCE SWAP VALUE</label>
                <h2 id="m-it-amount-display">$0.00</h2>
            </div>

            <div class="nx-it-security-clause-card">
                <i class='bx bx-info-circle'></i>
                <div>
                    <strong>Irreversible Ledger Mutation Action Notice</strong>
                    <p>Executing this balance swap overrides profile standard parameters. Capital parameters will adjust instantly inside system core databases.</p>
                </div>
            </div>

            <div class="nx-it-modal-footer-actions">
                <button class="nx-it-cancel-btn nx-it-modal-close-trigger">Abort Transaction</button>
                <button class="nx-it-commit-btn" id="btn-confirm-it-mutation"><i class='bx bx-check-shield'></i> Commit Balance Mutation</button>
            </div>
        </div>
    </div>
</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/internal-transfers.js') }}"></script>
</body>

</html>