<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/kyc-form.css') }}">
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

        <main class="nexuist-verification-portal">
            <div class="verification-wrapper animate-fade-in">
                <header class="v-header">
                    <div class="secure-tag"><i class='bx bxs-lock-alt'></i> Secure Verification Process</div>
                    <h1>Account Verification Hub</h1>
                    <p>Verify your identity to unlock advanced trading features and enterprise-grade security.</p>
                </header>

                <nav class="v-stepper">
                    <div class="v-step active" id="step-1-label">
                        <div class="v-circle">1</div>
                        <span>Personal Info</span>
                    </div>
                    <div class="v-line" id="line-1"></div>
                    <div class="v-step" id="step-2-label">
                        <div class="v-circle">2</div>
                        <span>Address</span>
                    </div>
                    <div class="v-line" id="line-2"></div>
                    <div class="v-step" id="step-3-label">
                        <div class="v-circle">3</div>
                        <span>Documents</span>
                    </div>
                </nav>

                <div class="v-card glass-morph">
                    <form id="kycForm" enctype="multipart/form-data">
                        @csrf

                        <div class="form-section active" id="section-1">
                            <div class="section-title">
                                <i class='bx bx-user-circle'></i>
                                <div>
                                    <h3>Personal Information</h3>
                                    <p>Provide your details exactly as they appear on your ID.</p>
                                </div>
                            </div>
                            <div class="v-grid">
                                <div class="v-input">
                                    <label>First Name *</label>
                                    <input type="text" name="first_name" placeholder="John" required>
                                </div>
                                <div class="v-input">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" placeholder="Doe" required>
                                </div>
                                <div class="v-input">
                                    <label>Email Address *</label>
                                    <input type="email" name="email" placeholder="john@example.com" required>
                                </div>
                                <div class="v-input">
                                    <label>Phone Number *</label>
                                    <input type="tel" name="phone" placeholder="+1 234 567 890" required>
                                </div>
                            </div>
                            <div class="v-actions">
                                <button type="button" class="btn-next" onclick="nextSection(2)">Continue to Address <i
                                        class='bx bx-right-arrow-alt'></i></button>
                            </div>
                        </div>

                        <div class="form-section" id="section-2">
                            <div class="section-title">
                                <i class='bx bx-map-pin'></i>
                                <div>
                                    <h3>Residential Address</h3>
                                    <p>Enter your current verified living address.</p>
                                </div>
                            </div>
                            <div class="v-grid">
                                <div class="v-input full-width">
                                    <label>Street Address *</label>
                                    <input type="text" name="street_address" placeholder="123 Fintech Way" required>
                                </div>
                                <div class="v-input">
                                    <label>City *</label>
                                    <input type="text" name="city" placeholder="New York" required>
                                </div>
                                <div class="v-input">
                                    <label>State/Province *</label>
                                    <input type="text" name="state" placeholder="NY" required>
                                </div>
                            </div>
                            <div class="v-actions">
                                <button type="button" class="btn-back" onclick="nextSection(1)">Previous</button>
                                <button type="button" class="btn-next" onclick="nextSection(3)">Continue to Documents <i
                                        class='bx bx-right-arrow-alt'></i></button>
                            </div>
                        </div>

                        <div class="form-section" id="section-3">
                            <div class="section-title">
                                <i class='bx bx-id-card'></i>
                                <div>
                                    <h3>Document Upload</h3>
                                    <p>Upload clear photos of your government-issued ID.</p>
                                </div>
                            </div>

                            <div class="doc-selector">
                                <label class="doc-option">
                                    <input type="radio" name="document_type" value="Passport" checked>
                                    <div class="doc-box">
                                        <i class='bx bx-globe'></i>
                                        <span>Passport</span>
                                        <small>Most accepted globally</small>
                                    </div>
                                </label>

                                <label class="doc-option">
                                    <input type="radio" name="document_type" value="National ID">

                                    <div class="doc-box">
                                        <i class='bx bx-credit-card-front'></i>
                                        <span>National ID</span>
                                        <small>Government issued ID</small>
                                    </div>
                                </label>

                                <label class="doc-option">
                                    <input type="radio" name="document_type" value="Driver's License">
                                    <div class="doc-box">
                                        <i class='bx bxs-id-card'></i>
                                        <span>Driver's License</span>
                                        <small>Valid driving license</small>
                                    </div>
                                </label>
                            </div>

                            <div class="upload-grid">
                                <div class="upload-zone" id="zone-front"
                                    onclick="document.getElementById('file-front').click()">
                                    <input type="file" id="file-front" name="front_document" hidden accept="image/*"
                                        required>
                                    <div class="upload-content">
                                        <i class='bx bx-cloud-upload'></i>
                                        <p>Front Side</p>
                                        <span>PNG, JPG up to 10MB</span>
                                    </div>
                                    <div class="preview-container" id="preview-front"></div>
                                </div>

                                <div class="upload-zone" id="zone-back"
                                    onclick="document.getElementById('file-back').click()">
                                    <input type="file" id="file-back" name="back_document" hidden accept="image/*"
                                        required>
                                    <div class="upload-content">
                                        <i class='bx bx-cloud-upload'></i>
                                        <p>Back Side</p>
                                        <span>PNG, JPG up to 10MB</span>
                                    </div>
                                    <div class="preview-container" id="preview-back"></div>
                                </div>
                            </div>

                            <div class="v-actions">
                                <button type="button" class="btn-back" onclick="nextSection(2)">Previous</button>
                                <button type="submit" class="btn-submit">Submit Application <i
                                        class='bx bx-check-shield'></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <p class="privacy-note"><i class='bx bx-shield-alt-2'></i> Your data is encrypted and stored securely
                    following international PCI-DSS standards.</p>
            </div>
        </main>

        <div id="kycModal" class="v-modal">
            <div class="modal-card animate-zoom">
                <div class="v-success-icon">
                    <i class='bx bx-check-circle animate-pulse'></i>
                </div>
                <h2>KYC Submitted Successfully</h2>

<p>
    Your KYC application has been successfully submitted and is currently
    under review. Verification is typically completed within 1–60 minutes.
    You will receive a notification once the review is complete.
</p>
                <button onclick="window.location.reload()" class="btn-done">Return to Dashboard</button>
            </div>
        </div>

        

    </div>

   

    <script src="{{ asset('assets/Frontend/js/kyc-form.js') }}"></script>
</body>

</html>