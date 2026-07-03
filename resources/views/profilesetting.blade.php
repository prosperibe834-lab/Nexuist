<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/profilesetting.css') }}">
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

        <div class="nex-profile-wrapper animate-fade-in">
            <header class="nex-header">
                <div class="header-meta">
                    <h1>Account Settings</h1>
                    <p>Manage your digital identity and security preferences</p>
                </div>
                <button class="btn-back" onclick="history.back()">
                    <i class='bx bx-left-arrow-alt'></i> Back to Dashboard
                </button>
            </header>

            <div class="nex-grid">
                <aside class="nex-sidebar">
                    <div class="profile-card glass-card">
                        <div class="avatar-wrapper">
                            <div class="avatar-main">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                            <button class="edit-avatar"><i class='bx bxs-camera'></i></button>
                        </div>
                        <div class="user-meta">
                            <h3>{{ $user->name }}</h3>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="security-meter">
                            <div class="meter-header">
                                <span>Security Level: <strong>Strong</strong></span>
                                <span>85%</span>
                            </div>
                            <div class="meter-bar">
                                <div class="fill" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <nav class="nex-nav glass-card">
                        <button class="nav-item active"><i class='bx bx-user'></i> Personal Info</button>
                        <button class="nav-item"><i class='bx bx-shield-quarter'></i> Security & 2FA</button>
                        <button class="nav-item"><i class='bx bx-bell'></i> Notifications</button>
                        <button class="nav-item text-danger"><i class='bx bx-log-out'></i> Terminate Sessions</button>
                    </nav>

                </aside>

                <main class="nex-main">
                    <div class="glass-card form-container">
                        <div class="form-header">
                            <h2>Personal Information</h2>
                            <p>Verified account details for Nexuist services.</p>
                        </div>

                        <div id="profileFeedback" class="profile-feedback">
                            @if(session('success'))
                                <div class="success-message">{{ session('success') }}</div>
                            @endif
                            @if($errors->any())
                                <div class="error-message">{{ $errors->first() }}</div>
                            @endif
                        </div>

                        <form id="profileForm" class="nex-form" method="POST" action="{{ route('user.profile.update') }}">
                            @csrf
                            <div class="input-row">
                                <div class="input-group">
                                    <label>Full Name</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-user'></i>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label>Username</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-at'></i>
                                        <input type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Enter username">
                                    </div>
                                </div>
                            </div>

                            <div class="input-row">
                                <div class="input-group">
                                    <label>Email Address</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-envelope'></i>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email address">
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label>Phone Number</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-phone'></i>
                                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group full-width">
                                <label>Country / Region</label>
                                <div class="input-wrap">
                                    <i class='bx bx-globe'></i>
                                    <select class="country-select" name="country">
                                        @foreach($countries as $country)
                                            <option value="{{ $country }}" @selected(old('country', $user->country) === $country)>{{ $country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-save">
                                    <span>Save Changes</span>
                                    <i class='bx bx-check-double'></i>
                                </button>
                            </div>
                        </form>
                    </div><br>

                    <div class="glass-card activity-container">
                        <div class="activity-header">
                            <h3>Recent Activity</h3>
                        </div>
                        <div class="activity-list">
                        @foreach($activities as $activity)
                            <div class="activity-item">
                                <div class="act-icon {{ $activity['css'] }}"><i class='bx {{ $activity['icon'] }}'></i></div>
                                <div class="act-info">
                                    <p>{{ $activity['activity'] }}</p>
                                    <span>{{ $activity['description'] }} • {{ $activity['time'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </div>


                </main>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/Frontend/js/profilesetting.js') }}"></script>
</body>

</html>