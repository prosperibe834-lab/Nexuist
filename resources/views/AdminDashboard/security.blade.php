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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/security.css') }}">
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
                <h1 id="page-title-display">Security</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
<div class="security-page-container">
    
    <div class="security-page-header">
        <div class="security-title-block">
            <h1>Security & Compliance Control Matrix</h1>
            <p>Enforce system encryption parameters, orchestrate AI-powered threat classification engines, manage network firewalls, and audit active platform vulnerabilities.</p>
        </div>
        <div class="security-status-badge secure-state" id="global-threat-pill">
            <i class='bx bx-shield-quarter'></i>
            <span id="threat-status-text">Shield Status: Enforced & Threat-Free</span>
        </div>
    </div>

    <div class="security-metrics-grid">
        <div class="metric-card-glass">
            <div class="card-icon-wrapper purple-glow">
                <i class='bx bx-fingerprint'></i>
            </div>
            <div class="metric-data-block">
                <span class="metric-label">2FA Adoption Velocity</span>
                <h3>94.8%</h3>
                <p class="metric-trend up"><i class='bx bx-trending-up'></i> +2.4% compliance rate</p>
            </div>
        </div>

        <div class="metric-card-glass">
            <div class="card-icon-wrapper neon-glow">
                <i class='bx bx-radar'></i>
            </div>
            <div class="metric-data-block">
                <span class="metric-label">AI Fraud Blocks (Today)</span>
                <h3 id="counter-fraud-blocks">142</h3>
                <p class="metric-trend fine"><i class='bx bx-check-shield'></i> 0 false positives logged</p>
            </div>
        </div>

        <div class="metric-card-glass">
            <div class="card-icon-wrapper accent-glow">
                <i class='bx bx-block'></i>
            </div>
            <div class="metric-data-block">
                <span class="metric-label">Active Blacklisted IPs</span>
                <h3>1,842</h3>
                <p class="metric-trend warning"><i class='bx bx-error-alt'></i> 14 added past hour</p>
            </div>
        </div>
    </div>

    <div class="security-content-grid">
        
        <div class="security-controls-panel">
            <div class="panel-section-title">
                <h2><i class='bx bx-slider-alt'></i> Protection Parameters Configurations</h2>
                <p>Modify structural access parameters and threshold limits across system sessions.</p>
            </div>
            
            <form id="security-configuration-form" class="security-form-layout">
                <div class="security-control-row">
                    <div class="control-meta">
                        <label>Enforce Strict Administrative Two-Factor Authentication (2FA)</label>
                        <p>Mandates secondary OTP validation tokens for all credential profiles authenticated with access clearance roles.</p>
                    </div>
                    <div class="control-action-switch">
                        <label class="switch-primitive">
                            <input type="checkbox" id="param-2fa-toggle" checked>
                            <span class="switch-slider"></span>
                        </label>
                    </div>
                </div>

                <div class="security-control-row">
                    <div class="control-meta">
                        <label>Real-Time AI Fraud Detection Behavioral Analytics Shield</label>
                        <p>Engages autonomous neural classification checking parameters to evaluate outbox ledger volume patterns across user wallets.</p>
                    </div>
                    <div class="control-action-switch">
                        <label class="switch-primitive">
                            <input type="checkbox" id="param-fraud-toggle" checked>
                            <span class="switch-slider"></span>
                        </label>
                    </div>
                </div>

                <div class="form-inputs-group-row">
                    <div class="form-input-box">
                        <label for="param-login-limits">Consecutive Failed Login Intrusion Limit</label>
                        <input type="number" id="param-login-limits" class="security-input-field" value="3" min="1" max="10">
                    </div>
                    <div class="form-input-box">
                        <label for="param-session-timeout">Framework Session Auto Expiry (Seconds)</label>
                        <input type="number" id="param-session-timeout" class="security-input-field" value="1800" min="60">
                    </div>
                </div>

                <div class="form-inputs-group-row">
                    <div class="form-input-box full-width">
                        <label for="param-kyc-tier">KYC Regulatory Compliance Constraints Threshold</label>
                        <select id="param-kyc-tier" class="security-select-field">
                            <option value="strict">Mandatory Identity Verification Loop Completion Prior to Any Financial Transaction Launch</option>
                            <option value="lenient">Verification Triggered Exclusively at Outbound Settlement Threshold Milestones</option>
                        </select>
                    </div>
                </div>

                <div class="form-inputs-group-row">
                    <div class="form-input-box full-width">
                        <label for="param-ip-blacklist">Global Blacklisted Network IP Node Addresses (Comma Delimited Matrix)</label>
                        <textarea id="param-ip-blacklist" class="security-textarea-field font-mono" rows="3">192.168.1.105, 45.22.11.90, 185.200.11.4, 203.0.113.50</textarea>
                    </div>
                </div>

                <div class="form-inputs-group-row">
                    <div class="form-input-box full-width">
                        <label for="param-alert-tier">Security Breaches Notification Notification Tier</label>
                        <select id="param-alert-tier" class="security-select-field">
                            <option value="critical">Broadcast WebSocket Push, PHPMailer SMTP Log Engine & Critical SMS Gateway Dispatch</option>
                            <option value="internal">Internal Admin Activity Log Stream Collection Pipeline Only</option>
                        </select>
                    </div>
                </div>

                <div class="security-button-cluster">
                    <button type="button" class="sec-btn btn-sec-outline" id="btn-reset-security">
                        <i class='bx bx-refresh'></i> Reset Fields
                    </button>
                    <button type="submit" class="sec-btn btn-sec-gradient" id="btn-save-security">
                        <i class='bx bx-check-shield'></i> Commit Security Policies
                    </button>
                </div>
            </form>
        </div>

        <div class="security-logs-panel">
            <div class="panel-section-title">
                <h2><i class='bx bx-terminal'></i> Real-Time Audit Activity Log Stream</h2>
                <p>Live monitored ledger events and threat interception operations from security subsystems.</p>
            </div>
            
            <div class="log-stream-box-outer">
                <div class="log-stream-header-bar">
                    <div class="terminal-dots"><span></span><span></span><span></span></div>
                    <div class="terminal-title">nexuist-firewalld-logs</div>
                </div>
                <div class="log-stream-terminal-inner" id="live-log-scroller">
                    <div class="log-entry system-alert">
                        <span class="log-time">[17:14:02]</span>
                        <span class="log-tag tag-info">[SYS]</span>
                        <p class="log-msg">Nexuist Core Ledger Firewall Subsystem Initialized. Zero actively leaking routing pathways.</p>
                    </div>
                    <div class="log-entry">
                        <span class="log-time">[17:10:45]</span>
                        <span class="log-tag tag-auth">[AUTH]</span>
                        <p class="log-msg">Admin Profile Session validation token passed successfully for node handle: <strong class="text-white">Admin_Master_01</strong> via IP (102.16.89.211).</p>
                    </div>
                    <div class="log-entry intercept-alert">
                        <span class="log-time">[16:58:19]</span>
                        <span class="log-tag tag-block">[BLOCKED]</span>
                        <p class="log-msg">Brute-Force intrusion footprint flagged. Request dropped from IP node 45.22.11.90. Access blocked.</p>
                    </div>
                    <div class="log-entry">
                        <span class="log-time">[16:45:12]</span>
                        <span class="log-tag tag-kyc">[KYC]</span>
                        <p class="log-msg">Identity loop status shift: Account UID <strong class="text-white">#NEX-10942</strong> transitioned to Approved.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    </main>

    <script src="{{ asset('assets/AdminDashboard/js/security.js') }}"></script>
</body>

</html>