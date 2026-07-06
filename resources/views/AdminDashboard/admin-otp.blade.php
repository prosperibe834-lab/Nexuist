<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Security Ring - Multi-Layer Validation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/otp.css') }}">


</head>

<body>

    <div id="otp-preloader" class="gate-preloader">
        <div class="loader-box">
            <i class='bx bx-cube-alt loader-icon'></i>
            <span class="loader-text">INITIALIZING CRYPTOGRAPHIC MONITOR...</span>
        </div>
    </div>

    <div class="theme-anchor" id="theme-toggle"><i class='bx bx-moon'></i></div>

   
<!-- Main section starts here -->

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-badge">
                <i class="bx bxs-message-square-dots"></i>
            </div>
            <h2>Security Token Verification</h2>
            <p>We sent a time-sensitive 6-digit confirmation key to your administrative communications channel.</p>
        </div>

        @if ($errors->any())
            <div class="alert error-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert success-alert">
                {{ session('success') }}
            </div>
        @endif

        <form id="adminOtpForm" class="auth-form" autocomplete="off" novalidate method="POST" action="/admin/reset">
            @csrf
            <div class="input-group">
                <label for="email">Registered Email Address</label>
                <div class="input-wrapper">
                    <i class="bx bx-envelope input-icon"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@terminal.com" required>
                </div>
            </div>

            <div class="otp-fields-group">
                <input type="text" name="otp_digit_1" class="otp-field" maxlength="1" pattern="\d*" inputmode="numeric" required>
                <input type="text" name="otp_digit_2" class="otp-field" maxlength="1" pattern="\d*" inputmode="numeric" required>
                <input type="text" name="otp_digit_3" class="otp-field" maxlength="1" pattern="\d*" inputmode="numeric" required>
                <input type="text" name="otp_digit_4" class="otp-field" maxlength="1" pattern="\d*" inputmode="numeric" required>
                <input type="text" name="otp_digit_5" class="otp-field" maxlength="1" pattern="\d*" inputmode="numeric" required>
                <input type="text" name="otp_digit_6" class="otp-field" maxlength="1" pattern="\d*" inputmode="numeric" required>
            </div>

            <div class="timer-wrapper">
                <p id="otpCountdownMessage">Token expires in <span id="countdownClock">02:00</span></p>
                <button type="button" id="btnResendOtp" class="btn-resend" disabled>Resend Code</button>
            </div>

            <div class="input-group">
                <label for="password">New Password</label>
                <div class="input-wrapper">
                    <i class="bx bx-lock input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="New secure password" required>
                </div>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-wrapper">
                    <i class="bx bx-lock input-icon"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required>
                </div>
            </div>

            <input type="hidden" id="otp" name="otp" />

            <button type="submit" class="btn-submit">
                <span>Verify Access Token</span>
                <i class="bx bx-check-shield"></i>
            </button>
        </form>

        <div class="auth-footer">
            <p>Using the wrong profile? <a href="admin-login" class="auth-link">Return to Login</a></p>
        </div>
    </div>
</div>

<!-- Main section ends here -->

    <script src="{{ asset('assets/AdminDashboard/js/otp.js') }}"></script>
</body>

</html>