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
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/statements.css') }}">
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
            <li class="active">
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
                <h1 id="page-title-display">Statements</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="nx-kyc-container nx-kyc-animate-fade-in">

            <div class="nx-kyc-header">
                <div class="nx-kyc-title-block">
                    <h2><i class='bx bx-shield-quarter'></i> KYC & Identity Compliance Vault</h2>
                    <p class="nx-kyc-subtitle">Review incoming investor verification documents, evaluate risk
                        frameworks, and update processing states.</p>
                </div>
            </div>

            <div class="nx-kyc-layout">

                <div class="nx-kyc-sidebar">
                    <div class="nx-kyc-search-wrapper">
                        <i class='bx bx-search kyc-search-icon'></i>
                        <input type="text" placeholder="Filter by user ID or name..." id="kyc-user-search">
                    </div>

                    <div class="nx-kyc-queue-list" id="kyc-nodes-container">

                        <div class="nx-kyc-user-card active-kyc-node" data-uid="#NEX-10942" data-name="Alexander Mercer"
                            data-nationality="United Kingdom" data-email="a.mercer@nexus.io" data-risk="LOW RISK (12%)"
                            data-risk-class="risk-low" data-expiry="2031-10-15" data-pep="PASSED SECURE"
                            data-pep-class="check-passed" data-fname="Alexander" data-lname="Mercer"
                            data-dob="1994-03-12" data-docid="GBR-892104B"
                            data-address="74 Finchley Road, London, NW3 6EF, UK"
                            data-docname="International_Passport_Page.jpg" data-docsize="Encrypted JPEG Matrix • 2.4 MB"
                            data-avatar="AM" data-avatar-color="bg-gradient-blue"
                            data-img="https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&w=600&q=80">
                            <div class="kyc-avatar bg-gradient-blue">AM</div>
                            <div class="kyc-user-meta">
                                <strong class="kyc-user-name">Alexander Mercer</strong>
                                <span class="kyc-user-uid">UID: #NEX-10942 • Passport</span>
                                <span class="kyc-status-pill status-pending-alert">Pending Review</span>
                            </div>
                        </div>

                        <div class="nx-kyc-user-card" data-uid="#NEX-20481" data-name="Amara Kalu"
                            data-nationality="Nigeria" data-email="amara.k@domain.com" data-risk="LOW RISK (08%)"
                            data-risk-class="risk-low" data-expiry="2029-04-22" data-pep="PASSED SECURE"
                            data-pep-class="check-passed" data-fname="Amara" data-lname="Kalu" data-dob="1989-11-03"
                            data-docid="NGA-004812A" data-address="12 Leopold Street, Ikoyi, Lagos, Nigeria"
                            data-docname="Drivers_License_Front.jpg" data-docsize="Encrypted JPEG Matrix • 1.8 MB"
                            data-avatar="AK" data-avatar-color="bg-gradient-purple"
                            data-img="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=600&q=80">
                            <div class="kyc-avatar bg-gradient-purple">AK</div>
                            <div class="kyc-user-meta">
                                <strong class="kyc-user-name">Amara Kalu</strong>
                                <span class="kyc-user-uid">UID: #NEX-20481 • Driver's License</span>
                                <span class="kyc-status-pill status-pending-alert">Pending Review</span>
                            </div>
                        </div>

                        <div class="nx-kyc-user-card" data-uid="#NEX-30194" data-name="Chen Wei"
                            data-nationality="Singapore" data-email="c.wei@nexus.io" data-risk="HIGH RISK (74%)"
                            data-risk-class="risk-high" data-expiry="2028-08-19" data-pep="WARNING: PEP MATCH"
                            data-pep-class="check-warning" data-fname="Wei" data-lname="Chen" data-dob="1975-06-25"
                            data-docid="SGP-990142C" data-address="88 Marina Boulevard, Tower 3, Singapore"
                            data-docname="National_Identity_Card.png" data-docsize="Encrypted PNG Matrix • 3.1 MB"
                            data-avatar="CW" data-avatar-color="bg-gradient-orange"
                            data-img="https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&w=600&q=80">
                            <div class="kyc-avatar bg-gradient-orange">CW</div>
                            <div class="kyc-user-meta">
                                <strong class="kyc-user-name">Chen Wei</strong>
                                <span class="kyc-user-uid">UID: #NEX-30194 • ID Card</span>
                                <span class="kyc-status-pill status-pending-alert">Pending Review</span>
                            </div>
                        </div>

                        <div class="nx-kyc-user-card" data-uid="#NEX-44921" data-name="Elena Rostova"
                            data-nationality="Germany" data-email="e.rostova@berlin-capital.de"
                            data-risk="MEDIUM RISK (38%)" data-risk-class="risk-medium" data-expiry="2033-02-11"
                            data-pep="PASSED SECURE" data-pep-class="check-passed" data-fname="Elena"
                            data-lname="Rostova" data-dob="1991-09-14" data-docid="DEU-661047F"
                            data-address="14 Kurfürstendamm, Charlottenburg, Berlin, Germany"
                            data-docname="EU_Passport_Scan.jpg" data-docsize="Encrypted JPEG Matrix • 2.9 MB"
                            data-avatar="ER" data-avatar-color="bg-gradient-green"
                            data-img="https://images.unsplash.com/photo-1614850523459-c2f4c699c52e?auto=format&fit=crop&w=600&q=80">
                            <div class="kyc-avatar bg-gradient-green">ER</div>
                            <div class="kyc-user-meta">
                                <strong class="kyc-user-name">Elena Rostova</strong>
                                <span class="kyc-user-uid">UID: #NEX-44921 • Passport</span>
                                <span class="kyc-status-pill status-pending-alert">Pending Review</span>
                            </div>
                        </div>

                        <div class="nx-kyc-user-card" data-uid="#NEX-51102" data-name="Liam O'Connor"
                            data-nationality="Ireland" data-email="liam@oconnor.ie" data-risk="LOW RISK (05%)"
                            data-risk-class="risk-low" data-expiry="2035-05-30" data-pep="PASSED SECURE"
                            data-pep-class="check-passed" data-fname="Liam" data-lname="O'Connor" data-dob="1985-01-20"
                            data-docid="IRL-409122X" data-address="44 Grafton Street, Dublin 2, Ireland"
                            data-docname="Government_ID_Card.jpg" data-docsize="Encrypted JPEG Matrix • 2.1 MB"
                            data-avatar="LO" data-avatar-color="bg-gradient-teal"
                            data-img="https://images.unsplash.com/photo-1528459801416-a9e53bbf4e17?auto=format&fit=crop&w=600&q=80">
                            <div class="kyc-avatar bg-gradient-teal">LO</div>
                            <div class="kyc-user-meta">
                                <strong class="kyc-user-name">Liam O'Connor</strong>
                                <span class="kyc-user-uid">UID: #NEX-51102 • ID Card</span>
                                <span class="kyc-status-pill status-pending-alert">Pending Review</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="nx-kyc-main-workspace">

                    <div class="nx-kyc-profile-banner">
                        <div class="kyc-banner-identity">
                            <span class="kyc-eyebrow">VERIFICATION DOSSIER IN PROGRESS</span>
                            <h3 id="dyn-kyc-name">Alexander Mercer</h3>
                            <p>Nationality: <strong id="dyn-kyc-nat">United Kingdom</strong> • Email: <strong
                                    id="dyn-kyc-email">a.mercer@nexus.io</strong></p>
                        </div>
                        <div class="kyc-banner-actions">
                            <button class="btn-kyc-action secondary" id="btn-kyc-reject"><i class='bx bx-dislike'></i>
                                Reject Dossier</button>
                            <button class="btn-kyc-action primary" id="btn-kyc-approve"><i
                                    class='bx bx-check-shield'></i> Approve Verification</button>
                        </div>
                    </div>

                    <div class="nx-kyc-metrics-grid">
                        <div class="nx-kyc-stat-card">
                            <div class="kyc-stat-header"><span>RISK ASSESSMENT INDEX</span><i class='bx bx-radar'></i>
                            </div>
                            <h2 id="dyn-kyc-risk" class="risk-low">LOW RISK (12%)</h2>
                        </div>
                        <div class="nx-kyc-stat-card">
                            <div class="kyc-stat-header"><span>DOCUMENT EXPIRY CHECK</span><i
                                    class='bx bx-calendar-event'></i></div>
                            <h2 id="dyn-kyc-expiry">2031-10-15</h2>
                        </div>
                        <div class="nx-kyc-stat-card">
                            <div class="kyc-stat-header"><span>PEP & SANCTIONS CHECK</span><i
                                    class='bx bx-fingerprint'></i></div>
                            <h2 id="dyn-kyc-pep" class="check-passed">PASSED SECURE</h2>
                        </div>
                    </div>

                    <div class="nx-kyc-details-split">

                        <div class="nx-kyc-panel">
                            <div class="kyc-panel-header">
                                <h3><i class='bx bx-id-card'></i> Attested Registration Information</h3>
                            </div>
                            <div class="kyc-data-field-grid">
                                <div class="kyc-data-box">
                                    <span>Legal First Name</span>
                                    <strong id="dyn-kyc-fname">Alexander</strong>
                                </div>
                                <div class="kyc-data-box">
                                    <span>Legal Last Name</span>
                                    <strong id="dyn-kyc-lname">Mercer</strong>
                                </div>
                                <div class="kyc-data-box">
                                    <span>Date of Birth</span>
                                    <strong id="dyn-kyc-dob">1994-03-12</strong>
                                </div>
                                <div class="kyc-data-box">
                                    <span>Document ID Reference</span>
                                    <strong class="font-mono" id="dyn-kyc-docid">GBR-892104B</strong>
                                </div>
                                <div class="kyc-data-box full-width-field">
                                    <span>Residential Address Declaration</span>
                                    <strong id="dyn-kyc-address">74 Finchley Road, London, NW3 6EF, UK</strong>
                                </div>
                            </div>
                        </div>

                        <div class="nx-kyc-panel">
                            <div class="kyc-panel-header">
                                <h3><i class='bx bx-image'></i> Attested Document Proof Vault</h3>
                            </div>
                            <div class="kyc-document-preview-box">
                                <div class="kyc-image-layer-frame">
                                    <img src="https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&w=600&q=80"
                                        id="dyn-kyc-doc-img') }}" alt="KYC Document Proof">
                                </div>
                                <div class="kyc-doc-placeholder">
                                    <span class="doc-title-string"
                                        id="dyn-kyc-docname">International_Passport_Page.jpg</span>
                                    <span class="doc-sub-text" id="dyn-kyc-docsize">Encrypted JPEG Matrix • 2.4 MB
                                        Spatial File Size</span>
                                    <div class="kyc-preview-actions">
                                        <button class="btn-kyc-utility" id="btn-kyc-fullscreen"><i
                                                class='bx bx-zoom-in'></i> Inspect Fullscreen</button>
                                        <button class="btn-kyc-utility" id="btn-kyc-download"><i
                                                class='bx bx-download'></i> Secure Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


    </main>

    <script src="{{ asset('assets/AdminDashboard/js/statements.js') }}"></script>
</body>

</html>