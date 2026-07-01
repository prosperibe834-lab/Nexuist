<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/verify-account.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>


    <div id="fintech-preloader">
    <div class="loader-container">
        <div class="loader-logo">
            <div class="logo-hexagon">
                <span class="iconify" data-icon="ri:shield-flash-line"></span>
            </div>
            <h2 class="loader-brand-name">Nexuist</h2>
        </div>

        <div class="loader-progress-wrapper">
            <div class="loader-progress-bar" id="load-bar">
                <div class="shimmer-effect"></div>
            </div>
        </div>

        <div class="loader-status">
            <span class="status-dot"></span>
            <p id="status-text">Initializing encrypted connection...</p>
        </div>
    </div>
    
    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>
</div>
<!-- Preloader ends here -->

    @include('layouts.frontend-header-sidebar')

 

        <!-- Main Content -->
         <main class="nexuist-kyc-hub">
    <div class="kyc-container animate-slide-in">
        <header class="kyc-dashboard-header">
            <div class="header-left">
                <div class="nexuist-badge">Nexuist Ecosystem</div>
                <h1>Identity Verification</h1>
                <p>Verify your account to access all premium features and security protocols.</p>
            </div>
            @if(strtolower(Auth::user()->kyc_status) === 'approved')
                <div class="status-indicator success">
                    <i class='bx bx-check-circle'></i> Verification Completed
                </div>
            @else
                <div class="status-indicator warning-pulse">
                    <i class='bx bx-error-alt'></i> Verification Required
                </div>
            @endif
        </header>

        <section class="kyc-main-card glass-morph">
            
            <div class="kyc-status-banner">
                <div class="banner-left">
                    <i class='bx bx-user-plus'></i>
                    <div>
                        <h3>Start Verification</h3>
                        <p>Begin the professional 3-step process to secure your account.</p>
                    </div>
                </div>
                <div class="banner-right">
                    <span class="active-step">Level 1</span>
                    <span class="step-label">Account Security</span>
                </div>
            </div>

            <div class="kyc-content-area">
                <div class="kyc-graphic">
                    <i class='bx bxs-user-account animate-pulse-icon'></i>
                </div>
                <div class="kyc-prompt">
                    <h2>Enhance Your Experience</h2>
                    <p>Unlock trading, investing, and advanced security features. A simple 3-step process to confirm your identity and secure your digital assets.</p>
                    
                    <a href="/kyc-form" class="btn-start-verification" id="startKycBtn">
                        <i class='bx bx-check-double'></i> Begin Verification
                    </a>
                </div>
            </div>

            <div class="benefits-accordion">
                <button class="accordion-trigger" id="toggleBenefits">
                    <i class='bx bx-chevron-down'></i> Learn more about Verification
                </button>
                <div class="accordion-content" id="benefitsContent">
                    <div class="benefits-grid">
                        <div class="benefit-item">
                            <i class='bx bx-shield-quarter'></i>
                            <div><h4>Security & Compliance</h4><p>Ensure regulatory compliance and account protection.</p></div>
                        </div>
                        <div class="benefit-item">
                            <i class='bx bx-bolt-circle'></i>
                            <div><h4>Full Platform Access</h4><p>Unlock trading and advanced investment features.</p></div>
                        </div>
                        <div class="benefit-item">
                            <i class='bx bx-fingerprint'></i>
                            <div><h4>Identity Protection</h4><p>Protect your digital assets with advanced protocols.</p></div>
                        </div>
                        <div class="benefit-item">
                            <i class='bx bx-tachometer'></i>
                            <div><h4>Quick Process</h4><p>A seamless, digital 3-step verification process.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="kyc-support-footer glass-morph">
            <div class="support-content">
                <i class='bx bx-support main-support-icon'></i>
                <div class="support-text">
                    <h3>Need Verification Help?</h3>
                    <p>Our dedicated support team is available 24/7 to assist you with the process.</p>
                    <div class="support-options">
                        <span><i class='bx bx-message-square-detail'></i> Live Chat</span>
                        <span><i class='bx bx-envelope'></i> Email Support</span>
                        <span><i class='bx bx-time'></i> 24/7</span>
                    </div>
                </div>
            </div>
            <a href="/support" class="btn-get-support">
                Contact Support <i class='bx bx-paper-plane'></i>
            </a>
        </footer>
    </div>
</main>
        
    </div>

    <script src="{{ asset('assets/Frontend/js/verify-account.js') }}"></script>
</body>

</html>