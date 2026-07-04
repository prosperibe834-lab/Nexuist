<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Security Ring - Master Passcode Rotation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/reset.css') }}">
</head>

<body>

    <div id="reset-preloader" class="gate-preloader">
        <div class="loader-box">
            <i class='bx bx-cube-alt loader-icon'></i>
            <span class="loader-text">STAGING CIPHER MUTATION MATRIX...</span>
        </div>
    </div>

    <div class="theme-anchor" id="theme-toggle"><i class='bx bx-moon'></i></div>

    <!-- Main section starts here -->

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-badge">
                <i class="bx bxs-key"></i>
            </div>
            <h2>Reset Admin Password</h2>
            <p>Provide your admin identifier and configure a secure new password token below.</p>
        </div>

        <form id="adminResetForm" class="auth-form" autocomplete="off" novalidate>
            <!-- Account Identifier (Email or Phone) -->
            <div class="input-group">
                <label for="recoveryIdentifier">Registered Email or Phone</label>
                <div class="input-wrapper">
                    <i class="bx bx-user-check input-icon"></i>
                    <input type="text" id="recoveryIdentifier" placeholder="Enter email or phone number" required>
                </div>
            </div>

            <!-- New Password -->
            <div class="input-group">
                <label for="newPassword">New Password</label>
                <div class="input-wrapper">
                    <i class="bx bx-lock-alt input-icon"></i>
                    <input type="password" id="newPassword" placeholder="••••••••" required>
                    <i class="bx bx-hide password-toggle" data-target="newPassword"></i>
                </div>
            </div>

            <!-- Confirm New Password -->
            <div class="input-group">
                <label for="confirmPassword">Confirm New Password</label>
                <div class="input-wrapper">
                    <i class="bx bx-lock-check input-icon"></i>
                    <input type="password" id="confirmPassword" placeholder="••••••••" required>
                    <i class="bx bx-hide password-toggle" data-target="confirmPassword"></i>
                </div>
            </div>


            <!-- Admin Security PIN Verification Check -->
<div class="input-group">
    <label for="adminPin">Admin Security PIN</label>
    <div class="input-wrapper">
        <i class="bx bx-key input-icon"></i>
        <input type="password" id="adminPin" maxlength="6" pattern="\d{6}" placeholder="Enter 6-digit authority PIN" required>
    </div>
    <small class="input-hint" style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.3;">Your structural master PIN is required to authorize this credential change.</small>
</div>



            <button type="submit" class="btn-submit">
                <span>Request Verification Code</span>
                <i class="bx bx-right-arrow-alt"></i>
            </button>
        </form>

        <div class="auth-footer">
            <p>Remembered your keys? <a href="admin-login" class="auth-link">Return to Login</a></p>
        </div>
    </div>
</div>
    
    <!-- Main section ends here -->

    <script src="{{ asset('assets/AdminDashboard/js/reset.js') }}"></script>
</body>

</html>