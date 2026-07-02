<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Verify Your Nexuist Recovery Code</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/forgot-style.css') }}">
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
                <p id="status-text">Preparing secure verification...</p>
            </div>
        </div>

        <div class="glow glow-1"></div>
        <div class="glow glow-2"></div>
    </div>

    <div class="nexuist-auth-wrapper">
        <div class="auth-card animate-fade-up">
            <div class="auth-brand-section">
                <div class="brand-logo">
                    <i class='bx bx-trending-up logo-icon'></i>
                    <span class="brand-text">NEXUIST</span>
                </div>
                <p class="brand-tagline">Two-step recovery verification</p>
            </div>

            <div class="recovery-panel active-panel" id="panel-otp-form">
                <div class="system-notice-card">
                    <i class='bx bx-shield-quarter system-icon-glow'></i>
                    <p>Enter the 6-digit recovery code that was generated for <strong>{{ $email }}</strong>. It expires in 10 minutes.</p>
                </div>

                @if (session('status'))
                    <div class="notice success">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="notice error">{{ $errors->first() }}</div>
                @endif

                <form id="nexuist-otp-form" method="POST" action="{{ route('password.otp.verify') }}" novalidate>
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="otp" id="otp-hidden-input">

                    <div class="form-grid-layout">
                        <div class="input-field-group">
                            <label for="otp-cell-1">Verification Code <span class="req">*</span></label>
                            <div class="interactive-input-container otp-input-row" id="otp-input-row">
                                <input type="text" class="otp-cell" id="otp-cell-1" maxlength="1" inputmode="numeric" autocomplete="one-time-code" required>
                                <input type="text" class="otp-cell" id="otp-cell-2" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="otp-cell" id="otp-cell-3" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="otp-cell" id="otp-cell-4" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="otp-cell" id="otp-cell-5" maxlength="1" inputmode="numeric" required>
                                <input type="text" class="otp-cell" id="otp-cell-6" maxlength="1" inputmode="numeric" required>
                            </div>
                        </div>
                    </div>

                    <div class="footer-step-actions-bar">
                        <button type="submit" class="btn btn-action-submit-execution" id="otp-submit-btn">
                            <span>Verify Recovery Code</span>
                            <i class='bx bx-check-shield'></i>
                        </button>
                    </div>
                </form>

                <div class="footer-step-actions-bar" style="margin-top: 0.75rem;">
                    <button type="button" class="btn btn-action-secondary" id="resend-otp-btn">
                        <i class='bx bx-refresh'></i>
                        <span>Resend Code</span>
                    </button>
                </div>
            </div>

            <footer class="auth-card-footer-links">
                <p>Need to change the email? <a href="/forgot-password" class="login-redirect-link">Try again</a></p>
                <div class="security-standards-row">
                    <span><i class='bx bx-fingerprint'></i> Secure Handshake</span>
                    <span><i class='bx bx-lock-open-alt'></i> OTP Verified</span>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/Frontend/js/otp-verification.js') }}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</body>

</html>
