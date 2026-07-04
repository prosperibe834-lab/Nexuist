<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Security Ring - Administrative Gateway</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/login.css') }}">
</head>

<body>

    <div id="login-preloader" class="gate-preloader">
        <div class="loader-box">
            <i class='bx bx-cube-alt loader-icon'></i>
            <span class="loader-text">INITIALIZING GATEWAY SECURE HANDSHAKE...</span>
        </div>
    </div>

    <div class="theme-anchor" id="theme-toggle"><i class='bx bx-moon'></i></div>

    <!-- Main section starts here -->

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-badge">
                <i class="bx bxs-shield-alt-2"></i>
            </div>
            <h2>Admin Terminal Login</h2>
            <p>Authenticate your administrator profile to access the secure console.</p>
        </div>

        <form id="adminLoginForm" class="auth-form" autocomplete="off" novalidate>
            <div class="input-group">
                <label for="loginIdentifier">Email Address or Phone Number</label>
                <div class="input-wrapper">
                    <i class="bx bx-user-pin input-icon"></i>
                    <input type="text" id="loginIdentifier" placeholder="admin@terminal.com or +234..." required>
                </div>
            </div>

            <div class="input-group">
                <div class="label-wrapper">
                    <label for="password">Password</label>
                    <a href="admin-reset" class="context-link">Forgot?</a>
                </div>
                <div class="input-wrapper">
                    <i class="bx bx-lock-alt input-icon"></i>
                    <input type="password" id="password" placeholder="••••••••" required>
                    <i class="bx bx-hide password-toggle" data-target="password"></i>
                </div>
            </div>

            <div class="input-group">
                <label for="adminPin">Admin Security PIN</label>
                <div class="input-wrapper">
                    <i class="bx bx-key input-icon"></i>
                    <input type="password" id="adminPin" maxlength="6" pattern="\d{6}" placeholder="Enter 6-digit authority PIN" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <span>Authenticate Secure Session</span>
                <i class="bx bx-log-in-circle"></i>
            </button>
        </form>

        <div class="auth-footer">
            <p>New operator? <a href="admin-signup" class="auth-link">Create an Admin Account</a></p>
        </div>
    </div>
</div>

    <!-- Main section ends here -->

    <script src="{{ asset('assets/AdminDashboard/js/login.js') }}"></script>
</body>

</html>