<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/withdraw.css') }}">
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

        <div class="withdrawal-interface-wrapper">

            <aside class="withdrawal-status-aside">
                <div class="status-card current">
                    <div class="status-icon success">
                        <i class='bx bx-check-shield'></i>
                    </div>
                    <div class="status-info">
                        <h3>Security Validation</h3>
                        <p>Pending your validation code to process final release.</p>
                    </div>
                </div>

                <div class="status-card pending">
                    <div class="status-icon">
                        <i class='bx bx-time-five'></i>
                    </div>
                    <div class="status-info">
                        <h3>Compliance Review</h3>
                        <p>Verification is queued for network compliance mapping.</p>
                    </div>
                </div>

                <div class="status-card future">
                    <div class="status-icon">
                        <i class='bx bx-paper-plane'></i>
                    </div>
                    <div class="status-info">
                        <h3>Fund Dispatch</h3>
                        <p>Funds will be released upon successful validation.</p>
                    </div>
                </div>
            </aside>

            <div class="withdrawal-main-panels">

                <article class="withdrawal-advisory-card">
                    <header class="advisory-header">
                        <i class='bx bx-info-circle warning-icon'></i>
                        <h2>Validation Protocol Required</h2>
                    </header>
                    <div class="advisory-body">
                        <p>To authorize this transaction, a cryptographic verification sequence has been generated. This
                            unique protocol must be supplied directly from our dedicated institutional support
                            terminals.</p>

                        <div class="contact-block">
                            <h3>Contact Institutional Support</h3>
                            <div class="contact-links">
                                <a href="/support" class="btn-support-connect">
                                    <i class='bx bx-support'></i> Live Secure Chat
                                </a>
                                <a href="mailto:support@Nexuistcodes.site" class="btn-email-connect">
                                    <i class='bx bx-envelope'></i> support@Nexuistcodes.site
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <form id="withdrawal-verification-form" class="withdrawal-input-panel" action="{{ route('withdrawal.initiate') }}" method="POST">
                    @csrf
                    <div class="input-panel-header">
                        <i class='bx bx-lock-open-alt security-icon'></i>
                        <h2>Enter Withdrawal Transaction ID</h2>
                        <p>Enter the transaction ID shown below to continue to settlement.</p>
                    </div>

                    <div class="input-field-group">
                        <div class="interactive-input-container">
                            <i class='bx bx-dialpad field-icon'></i>
                            <input type="text" name="transaction_id" id="verification-code" placeholder="Enter your transaction ID"
                                value="{{ old('transaction_id', $currentTransactionId ?? '') }}" required autocomplete="off">
                        </div>
                        <span class="field-info">
                            <i class='bx bx-check-circle'></i> This ID is generated for your withdrawal request
                        </span>
                    </div>

                    <div class="input-panel-actions">
                        <button type="submit" class="btn-action-execute-verify" id="verify-submit-btn">
                            <i class='bx bx-check-shield'></i> Verify & Continue
                        </button>
                    </div>
                </form>

                <footer class="transaction-summary-tooltip">
                    <i class='bx bxs-coin-stack'></i>
                    <p>Current Pending Transaction ID: <strong id="current-tid">{{ $currentTransactionId ?? $withdrawal->transaction_id }}</strong></p>
                </footer>
            </div>

        </div>

    </div>

    <script src="{{ asset('assets/Frontend/js/withdraw.js') }}"></script>
</body>

</html>