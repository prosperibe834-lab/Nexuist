<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/premiumPayment.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

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
         
        <main class="payment-portal">
    <div class="payment-container animate-slide-up">
        <!-- Status Bar -->
        <div class="secure-header">
            <div class="secure-pill">
                <i class='bx bxs-lock-alt'></i>
                <span>Secure Payment Gateway</span>
            </div>
        </div>

        <!-- Hero Branding -->
        <div class="payment-hero">
            <h1>Complete Your Deposit</h1>
            <p>Securely deposit funds using <span id="displayMethod" class="neon-text">Ethereum</span> to start trading</p>
            
            <div class="stepper-ui">
                <div class="step-item completed">
                    <div class="step-circle"><i class='bx bx-check'></i></div>
                    <span>Method</span>
                </div>
                <div class="step-connector active"></div>
                <div class="step-item active">
                    <div class="step-circle">2</div>
                    <span>Payment</span>
                </div>
                <div class="step-connector"></div>
                <div class="step-item">
                    <div class="step-circle">3</div>
                    <span>Verify</span>
                </div>
            </div>
        </div>

        <!-- Main Glass Card -->
        <section class="checkout-card glass-morph">
            <div class="card-inner">
                
                <!-- Deposit Info Header -->
                <div class="deposit-details-header">
                    <div class="details-left">
                        <i class='bx bx-wallet-alt'></i>
                        <div>
                            <h3>Payment Details</h3>
                            <p id="sub-title">Ethereum Deposit</p>
                        </div>
                    </div>
                    <div class="details-right">
                        <span class="badge-ssl"><i class='bx bx-shield-quarter'></i> SSL Secured</span>
                    </div>
                </div>

                <!-- Price Banner -->
                <div class="amount-hero">
                    <span class="label">Amount to Deposit</span>
                    <div class="price-display">
                        <span class="symbol">$</span>
                        <span id="displayPrice">5,300</span>
                        <span class="cents">.00</span>
                    </div>
                    <div class="warning-banner">
                        <i class='bx bx-info-circle'></i>
                        <span>Send exact amount to avoid delays</span>
                    </div>
                </div>

                <!-- Three-Step Instructions -->
                <div class="instruction-grid">
                    <div class="ins-card">
                        <div class="ins-num">1</div>
                        <div class="ins-content">
                            <h4>Send Payment</h4>
                            <p>Transfer to the wallet address</p>
                        </div>
                    </div>
                    <div class="ins-card">
                        <div class="ins-num">2</div>
                        <div class="ins-content">
                            <h4>Upload Proof</h4>
                            <p>Take a screenshot of receipt</p>
                        </div>
                    </div>
                    <div class="ins-card">
                        <div class="ins-num">3</div>
                        <div class="ins-content">
                            <h4>Submit & Wait</h4>
                            <p>Verification in 1-30 mins</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Assets Grid -->
                <div class="assets-grid">
                    <!-- QR Panel -->
                    <div class="asset-panel qr-panel">
                        <label><i class='bx bx-qr-scan'></i> QR Code Payment</label>
                        <div class="qr-container">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=0xddae7bc4abc0f8866c893255bca368df6d8a513') }}" alt="QR Code">
                        </div>
                        <p class="qr-hint">Scan with your wallet app instantly</p>
                    </div>

                    <!-- Input Panel -->
                    <div class="asset-panel input-panel">
                        <div class="input-wrap">
                            <label>Wallet Address</label>
                            <div class="copy-field">
                                <input type="text" value="0xddae7bc4abc0f8866c893255bca368df6d8a513" id="walletAddr" readonly>
                                <button onclick="copyAddr()" class="copy-btn">
                                    <i class='bx bx-copy-alt'></i> Copy
                                </button>
                            </div>
                        </div>

                        <div class="input-wrap mt-20">
                            <label>Upload Payment Proof</label>
                            <div class="drop-zone" id="dropZone">
                                <input type="file" id="fileInput" hidden accept="image/*">
                                <div class="dz-content">
                                    <i class='bx bx-cloud-upload'></i>
                                    <p>Choose file or drag & drop</p>
                                    <span>PNG, JPG up to 10MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Final Action -->
                <button class="btn-primary-payment" id="submitBtn">
                    <i class='bx bx-paper-plane'></i> Submit Payment Proof
                </button>
                
                <p class="encryption-note">
                    <i class='bx bx-lock-open-alt'></i> Protected by 256-bit SSL encryption
                </p>
            </div>
        </section>

        <!-- Trust Indicators -->
        <footer class="trust-footer">
            <div class="trust-box">
                <i class='bx bx-headphone'></i>
                <div>
                    <h4>24/7 Support</h4>
                    <p>Live help available</p>
                </div>
            </div>
            <div class="trust-box">
                <i class='bx bx-bolt-circle'></i>
                <div>
                    <h4>Instant Processing</h4>
                    <p>Verified within minutes</p>
                </div>
            </div>
            <div class="trust-box">
                <i class='bx bx-shield-alt-2'></i>
                <div>
                    <h4>Bank-Grade Security</h4>
                    <p>Enterprise protection</p>
                </div>
            </div>
        </footer>
    </div>
</main>
    </div>

    <script src="{{ asset('assets/Frontend/js/premiumPayment.js') }}"></script>
</body>

</html>