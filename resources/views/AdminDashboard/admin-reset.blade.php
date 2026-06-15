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

    <div class="viewport-wrapper">
        <div class="auth-card">
            <div class="card-header">
                <div class="brand-logo"><i class='bx bx-refresh'></i></div>
                <h2>Overhaul Master Cipher</h2>
                <p>Commit a new high-entropy system entry password into the security validation network layers.</p>
            </div>

            <form id="reset-form" novalidate>
                <div class="form-group">
                    <label for="reset-password">New Account Master Password</label>
                    <div class="input-wrapper">
                        <i class='bx bx-lock-open-alt'></i>
                        <input type="password" id="reset-password" class="cipher-input" placeholder="••••••••••••"
                            required>
                        <i class='bx bx-hide visibility-toggle'></i>
                    </div>
                    <span class="error-msg">Complexity threshold bounds not reached (Minimum 8 symbols)</span>
                </div>

                <div class="form-group">
                    <label for="reset-confirm-password">Confirm Mutated Password String</label>
                    <div class="input-wrapper">
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" id="reset-confirm-password" class="cipher-input"
                            placeholder="••••••••••••" required>
                        <i class='bx bx-hide visibility-toggle'></i>
                    </div>
                    <span class="error-msg">Verification confirmation boundary fails to equate matching keys</span>
                </div>

                <button type="submit" class="submit-btn" id="btn-reset">
                    <i class='bx bx-shield-quarter'></i> Commit New Cipher Configuration
                </button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/AdminDashboard/js/reset.js') }}"></script>
</body>

</html>