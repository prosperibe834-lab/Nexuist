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

    <div class="viewport-wrapper">
        <div class="auth-card">
            <div class="card-header">
                <div class="brand-logo"><i class='bx bx-lock-open-alt'></i></div>
                <h2>System Gatekeeper</h2>
                <p>Provide secure cryptographic credentials to declare an active administrative panel session handler
                    node.</p>
            </div>

            <form id="login-form" novalidate>
                <div class="form-group">
                    <label for="login-email">Admin Routing Identity Email</label>
                    <div class="input-wrapper">
                        <i class='bx bx-envelope'></i>
                        <input type="email" id="login-email" placeholder="name@nexuist.com" required>
                    </div>
                    <span class="error-msg">Account identifier mapping key missing</span>
                </div>

                <div class="form-group">
                    <label for="login-password">Session Passcode Cipher</label>
                    <div class="input-wrapper">
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" id="login-password" class="cipher-input" placeholder="••••••••••••"
                            required>
                        <i class='bx bx-hide visibility-toggle'></i>
                    </div>
                    <span class="error-msg">Account cryptographic verification string missing</span>
                </div>

                <div class="actions-row">
                    <label class="checkbox-container">
                        <input type="checkbox" id="login-remember">
                        <span class="checkbox-mock"></span>
                        <span class="checkbox-text">Maintain Node Hydration</span>
                    </label>
                    <a href="/admin-forgot" class="context-link">Recover Session Clearance</a>
                </div>

                <button type="submit" class="submit-btn" id="btn-login">
                    <i class='bx bx-log-in-circle'></i> Execute Session Handshake
                </button>
            </form>

            <div class="card-footer">
                <p>New administrative operation block assignment? <a href="admin-/signup">Request Clearance Node</a>
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/AdminDashboard/js/login.js') }}"></script>
</body>

</html>