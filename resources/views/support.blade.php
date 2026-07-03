<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/support.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.NEXUIST_BASE_URL = @json(url(''));
    </script>
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

        <main class="nexuist-support-portal">
            <div class="support-container animate-fade-in">
                <header class="support-header">
                    <div class="brand-badge">Nexuist Ecosystem</div>
                    <h1>Support Hub</h1>
                    <p>Get expert assistance for your Nexuist account and trading queries.</p>
                </header>

                <div class="support-card email-card-glass">
                    <div class="card-icon">
                        <i class='bx bx-envelope-open'></i>
                    </div>
                    <div class="card-info">
                        <h3>Email Support</h3>
                        <p>Direct communication for detailed inquiries and technical requests.</p>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=support@nexuist.com" target="_blank"
                            class="email-link">
                            support@nexuist.com <i class='bx bx-link-external'></i>
                        </a>
                    </div>
                </div>

                <section class="support-card form-card-glass">
                    <div class="form-title">
                        <h2>Send us a Message</h2>
                        <p>Fill out the form below and our team will get back to you shortly.</p>
                    </div>

                    <form id="supportForm" class="nexuist-form">
                        <div class="input-row">
                            <div class="input-group">
                                <label>Your Name</label>
                                <div class="input-wrapper">
                                    <i class='bx bx-user'></i>
                                    <input type="text" id="userName" placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label>Your Email</label>
                                <div class="input-wrapper">
                                    <i class='bx bx-at'></i>
                                    <input type="email" id="userEmail" placeholder="name@example.com" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-group full-width">
                            <label>Message <span class="required">*</span></label>
                            <div class="input-wrapper textarea-wrapper">
                                <textarea id="userMessage" rows="5"
                                    placeholder="Please describe your issue in detail..." required></textarea>
                            </div>
                            <div class="char-count"><span id="currentChars">0</span>/1000</div>
                        </div>

                        <button type="submit" id="sendBtn" class="btn-send disabled" disabled>
                            <span>Send Message</span>
                            <i class='bx bx-paper-plane'></i>
                        </button>
                    </form>
                    <p class="response-time"><i class='bx bx-time'></i> We typically respond within 24 hours.</p>
                </section>
            </div>
        </main>

        <div id="successModal" class="modal-overlay">
            <div class="modal-content glass-morph animate-zoom">
                <div class="success-icon-wrap">
                    <i class='bx bx-check-double animate-check'></i>
                </div>
                <h2>Message Sent!</h2>
                <p>Your inquiry has been successfully transmitted to the Nexuist support team. Check your email for
                    updates.</p>
                <button onclick="closeSupportModal()" class="btn-close-modal">Back to Hub</button>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/Frontend/js/support.js') }}"></script>
</body>

</html>