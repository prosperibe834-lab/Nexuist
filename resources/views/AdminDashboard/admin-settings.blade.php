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
                <a href="{{ url('/portfolio') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="link_name">Portfolio Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/portfolio">Portfolio Analytics</a></li>
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
                <a href="{{ url('/support') }}">
                    <i class='bx bx-support'></i>
                    <span class="link_name">Messages & Support</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="/support">Messages & Support</a></li>
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
            <li class="active">
                <a href="/admin-settings">
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