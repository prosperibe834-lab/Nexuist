<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Security Ring - Admin Access Provisioning</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/signup.css') }}">
</head>

<body>

    <div id="signup-preloader" class="gate-preloader">
        <div class="loader-box">
            <i class='bx bx-cube-alt loader-icon'></i>
            <span class="loader-text">CONNECTING TO SECURE AUTH NODE...</span>
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
            <h2>Create Admin Account</h2>
            <p>Set up your administrative credentials to manage the terminal.</p>
        </div>

        <form id="adminSignupForm" class="auth-form" autocomplete="off" novalidate method="POST" action="/admin/register">
            @csrf

            @if(session('success'))
                <div class="form-alert success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="form-alert error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-grid">
                <div class="input-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class="bx bx-hash input-icon"></i>
                        <input type="text" id="username" name="username" placeholder="adminuser" value="{{ old('username') }}" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="fullName">Full Name</label>
                    <div class="input-wrapper">
                        <i class="bx bx-user input-icon"></i>
                        <input type="text" id="fullName" name="fullname" placeholder="John Doe" value="{{ old('fullname') }}" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="bx bx-envelope input-icon"></i>
                        <input type="email" id="email" name="email" placeholder="admin@terminal.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <div class="input-wrapper">
                        <i class="bx bx-phone input-icon"></i>
                        <input type="tel" id="phone" name="phone" placeholder="+234..." value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="gender">Gender</label>
                    <div class="input-wrapper">
                        <i class="bx bx-git-repo-forked input-icon"></i>
                        <select id="gender" name="gender" required>
                            <option value="" disabled {{ old('gender') ? '' : 'selected' }} hidden>Select Gender</option>
                            <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="bx bx-lock-alt input-icon"></i>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <i class="bx bx-hide password-toggle" data-target="password"></i>
                    </div>
                </div>

                <div class="input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-wrapper">
                        <i class="bx bx-lock-check input-icon"></i>
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="••••••••" required>
                        <i class="bx bx-hide password-toggle" data-target="confirmPassword"></i>
                    </div>
                </div>
            </div>

            <div class="input-group full-width">
                <label for="adminPin">Admin Security PIN</label>
                <div class="input-wrapper">
                    <i class="bx bx-key input-icon"></i>
                    <input type="password" id="adminPin" name="admin_pin" maxlength="6" pattern="\d{6}" placeholder="Enter 6-digit authority PIN" value="{{ old('admin_pin') }}" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                <span>Generate Administrator Profile</span>
                <i class="bx bx-right-arrow-alt"></i>
            </button>
        </form>

        <div class="auth-footer">
            <p>Already have an admin profile? <a href="admin-login" class="auth-link">Sign In</a></p>
        </div>
    </div>
</div>

    <!-- Main section ends here -->

    <script src="{{ asset('assets/AdminDashboard/js/signup.js') }}"></script>
</body>

</html>