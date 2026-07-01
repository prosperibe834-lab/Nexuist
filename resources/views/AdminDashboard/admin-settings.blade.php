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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/admin-settings.css') }}">
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
                <h1 id="page-title-display">Admin-Settings</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
<div class="admin-matrix-container" id="admin-settings">
    
    <div class="matrix-page-header">
        <div class="matrix-title-block">
            <h1>Admin Access Matrix & Privilege Allocation</h1>
            <p>Orchestrate cryptographic administrative handles, authorize specialized platform permission keys, and audit live administrative registry records.</p>
        </div>
        <div class="matrix-active-count">
            <i class='bx bx-shield-quarter'></i>
            <span>Active Administrators: <strong id="admin-total-badge">4</strong></span>
        </div>
    </div>

    <div class="role-tiers-distribution-grid">
        <div class="tier-overview-card superuser-variant">
            <div class="tier-card-header">
                <div class="tier-badge-icon"><i class='bx bx-layer'></i></div>
                <span class="tier-tag">Root Scope</span>
            </div>
            <h3>Superuser Profile</h3>
            <p>Unrestricted platform jurisdiction. Holds absolute authority over system parameters, database migrations, and financial ledger settlement configurations.</p>
            <div class="tier-footer-meta">Active Nodes: 1</div>
        </div>

        <div class="tier-overview-card compliance-variant">
            <div class="tier-card-header">
                <div class="tier-badge-icon"><i class='bx bx-check-shield'></i></div>
                <span class="tier-tag">Auditor Scope</span>
            </div>
            <h3>Compliance Auditor</h3>
            <p>Read-write authority limited to user KYC pipelines, anti-money laundering (AML) exceptions logs, fraud analytics dashboards, and risk overrides.</p>
            <div class="tier-footer-meta">Active Nodes: 1</div>
        </div>

        <div class="tier-overview-card support-variant">
            <div class="tier-card-header">
                <div class="tier-badge-icon"><i class='bx bx-support'></i></div>
                <span class="tier-tag">Specialist Scope</span>
            </div>
            <h3>Support Specialist</h3>
            <p>Operational access limited to managing user support tickets, resolving account locks, viewing transaction historical metrics, and issuing verification codes.</p>
            <div class="tier-footer-meta">Active Nodes: 2</div>
        </div>
    </div>

    <div class="matrix-split-layout">
        
        <div class="inner-panel-action-block">
            <div class="block-header-segment">
                <h2><i class='bx bx-user-plus'></i> Provision New Administrator Profile Node</h2>
                <p>Inject authorized personnel credentials into the platform encryption ring with isolated jurisdiction layers.</p>
            </div>
            
            <form id="provision-admin-form" class="panel-form-matrix">
                <div class="panel-form-grid admin-provision-row">
                    
                    <div class="form-group">
                        <label for="new-admin-user">Target Admin Handle Name</label>
                        <div class="input-wrapper-iconic">
                            <i class='bx bx-user'></i>
                            <input type="text" class="form-input" id="new-admin-user" placeholder="e.g. Chief Compliance Officer" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="new-admin-role">Operational Privilege Class Assignment</label>
                        <div class="input-wrapper-iconic">
                            <i class='bx bx-lock-open-alt'></i>
                            <select class="form-select" id="new-admin-role" required>
                                <option value="" disabled selected>Select Authorization Tier...</option>
                                <option value="Superuser">Superuser Complete Authorization Scope</option>
                                <option value="Compliance Auditor">Compliance Risk Auditor Level 2 Only</option>
                                <option value="Support Specialist">Customer Support Execution Specialist</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group button-group">
                        <button type="submit" class="action-btn btn-primary" id="btn-create-admin">
                            <i class='bx bx-plus-circle'></i> Inject Profile Token
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <div class="inner-panel-registry-logs">
            <div class="block-header-segment">
                <h2><i class='bx bx-receipt'></i> Real-Time Access Registry Log Stream</h2>
                <p>Cryptographic trail tracking administrative interactions, origin networks, and profile events.</p>
            </div>

            <div class="registry-table-outer">
                <table class="registry-data-table">
                    <thead>
                        <tr>
                            <th>Administrative Handle</th>
                            <th>Jurisdiction Tier</th>
                            <th>Origin IP Address</th>
                            <th>Action History Log</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody id="registry-log-target-tbody">
                        <tr>
                            <td><span class="admin-handle-cell"><i class='bx bx-user-circle'></i> Admin_Master_01</span></td>
                            <td><span class="role-pill pill-super">Superuser</span></td>
                            <td class="font-mono">185.200.11.4</td>
                            <td>Modified strict system session limits to 1800s</td>
                            <td class="text-muted">17:15:32</td>
                        </tr>
                        <tr>
                            <td><span class="admin-handle-cell"><i class='bx bx-user-circle'></i> Risk_Officer_Alex</span></td>
                            <td><span class="role-pill pill-compliance">Compliance Auditor</span></td>
                            <td class="font-mono">102.16.89.211</td>
                            <td>Approved identity loophole verification #NEX-10942</td>
                            <td class="text-muted">16:45:12</td>
                        </tr>
                        <tr>
                            <td><span class="admin-handle-cell"><i class='bx bx-user-circle'></i> Helpdesk_Agent_Y</span></td>
                            <td><span class="role-pill pill-support">Support Specialist</span></td>
                            <td class="font-mono">45.22.11.90</td>
                            <td>Issued password recovery email for UID #NEX-8841</td>
                            <td class="text-muted">14:22:05</td>
                        </tr>
                        <tr>
                            <td><span class="admin-handle-cell"><i class='bx bx-user-circle'></i> Helpdesk_Agent_X</span></td>
                            <td><span class="role-pill pill-support">Support Specialist</span></td>
                            <td class="font-mono">203.0.113.50</td>
                            <td>Resolved internal communication ticket #TK-402</td>
                            <td class="text-muted">11:09:44</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

    </main>

    <script src="{{ asset('assets/AdminDashboard/js/admin-settings.js') }}"></script>
</body>

</html>