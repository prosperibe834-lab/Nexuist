<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/kyc.css') }}">
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
                <h1 id="page-title-display">Kyc</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->
        <div class="kyc-dashboard-wrapper">
            <div class="kyc-header mb-4 animate-fade-in">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <div class="kyc-badge-icon">
                        <i class='bx bx-shield-quarter'></i>
                    </div>
                    <h1 class="kyc-title">KYC & Identity Compliance Vault</h1>
                </div>
                <p class="kyc-subtitle">Review incoming investor verification documents, evaluate risk frameworks, and
                    update processing states.</p>
            </div>

            <div class="kyc-layout-grid">

                <div class="kyc-users-sidebar animate-slide-up">
                    <div class="search-box-container mb-3">
                        <i class='bx bx-search search-icon'></i>
                        <input type="text" id="userSearchInput" class="kyc-search-input"
                            placeholder="Filter by user ID or name..." oninput="filterUserQueue()">
                    </div>

                    <div class="users-queue-list" id="usersQueueContainer">
                    </div>
                </div>

                <div class="kyc-vault-panel animate-slide-up" id="complianceDetailVault">
                    <div class="vault-empty-state text-center py-5">
                        <i class='bx bx-user-check text-muted mb-3' style="font-size: 4rem;"></i>
                        <h4>Select an Investor Profile</h4>
                        <p class="text-secondary small">Choose an applicant from the ingestion queue stream to inspect
                            uploaded identity credentials and process compliance status.</p>
                    </div>
                </div>

            </div>
        </div>
    </main>

<div id="kyc-data" style="display:none;">
    {!! json_encode($kycs) !!}
</div>

    <script src="{{ asset('assets/AdminDashboard/js/kyc.js') }}"></script>

</body>

</html>