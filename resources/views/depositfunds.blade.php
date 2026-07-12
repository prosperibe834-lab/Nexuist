<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/depositfunds.css') }}">
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




        <!-- deposit section starts here -->
        <!-- Add these to your <head> for Icons and QR -->
        <form id="depositForm" action="{{ route('deposit.store') }}" method="POST" enctype="multipart/form-data"
            onsubmit="handleFormSubmit(event)">
            @csrf
            <input type="hidden" name="method" id="selected-method-input">

            <div class="nexuist-main-content">
                <div class="deposit-header-v2">
                    <div class="header-text">
                        <h1>Deposit Funds</h1>
                        <p>Select a gateway to fund your Nexuist investment account.</p>
                    </div>
                    <div class="security-badge">
                        <i class='bx bxs-shield-quarter'></i>
                        <span>Secured by Nexuist Node</span>
                    </div>
                </div>

                <div class="deposit-card-wrapper">
                    <div class="quick-deposit-header">
                        <span class="quick-title"><i class="bx bx-bolt-circle"></i> Quick Select Allocation:</span>
                        <div class="quick-pill-container">
                            <button type="button" class="quick-amount-pill"
                                onclick="setDepositAmount(100)">$100</button>
                            <button type="button" class="quick-amount-pill"
                                onclick="setDepositAmount(500)">$500</button>
                            <button type="button" class="quick-amount-pill"
                                onclick="setDepositAmount(1000)">$1,000</button>
                            <button type="button" class="quick-amount-pill"
                                onclick="setDepositAmount(5000)">$5,000</button>
                        </div>
                    </div>

<div class="deposit-billing-card">
                            <div class="card-status-bar">
                            <h3 class="form-heading">Secure Fund Allocation</h3>
                            <span class="secure-badge"><i class="bx bx-shield-quarter"></i> End-to-End Encrypted</span>
                        </div>

                        <p class="form-subtext">The incoming capital will be initialized and bound directly to your
                            selected
                            high-yield contract layer.</p>

                        <div class="form-group">
                            <label for="depositAmount" class="custom-field-label">
                                Amount to Deposit <span class="required-asterisk">*</span>
                            </label>
                            <div class="premium-input-frame">
                                <span class="currency-symbol-addon">$</span>
                                <input type="number" name="amount" id="depositAmount" class="deposit-numeric-input"
                                    placeholder="0.00" min="1" step="any" required>
                                <span class="currency-tag-suffix">USD</span>
                            </div>
                            <p class="field-help-hint">Ensure your structural funding wallet holds sufficient gas
                                overheads
                                for deployment.</p>
                        </div>


                    </div>
                </div>

                <!-- Payment Grid (Step 1) -->
                <div id="step-selection" class="deposit-view active">
                    <div class="method-grid">
                        <!-- USDT Card -->
                        <div class="gate-card"
                            onclick="openGateway('USDT', 'Tether (TRC20)', 'TVMWtPzFwnek5DfpA5qiyRwvy3Qi8dCbpg', 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=T9xRV872vzPqW82Lkp90SvcW')">
                            <div class="gate-icon usdt"><i class='bx bxs-dollar-circle'></i></div>
                            <div class="gate-details">
                                <h3>USDT</h3>
                                <span>Instant • 0% Fee</span>
                            </div>
                            <i class='bx bx-chevron-right'></i>
                        </div>

                        <!-- BTC Card -->
                        <div class="gate-card"
                            onclick="openGateway('BTC', 'Bitcoin Network', '14xxNLpG5fdjzMJwHuFteeoZayfy63S1Lk', 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=bc1qxy2kgdy6jrsqxms6pazf')">
                            <div class="gate-icon btc"><i class='bx bxl-bitcoin'></i></div>
                            <div class="gate-details">
                                <h3>Bitcoin</h3>
                                <span>3 Confirmations</span>
                            </div>
                            <i class='bx bx-chevron-right'></i>
                        </div>

                        <!-- ETH Card -->
                        <div class="gate-card"
                            onclick="openGateway('ETH', 'Ethereum (ERC20)', '0xcd9fe862dbbbc5f38f0e86a1eed343308be7bbaa', 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=0x71C7656EC7ab88b098defB751B7401B5f6d8976F')">
                            <div class="gate-icon eth"><span class="iconify"
                                    data-icon="cryptocurrency-color:eth"></span>
                            </div>
                            <div class="gate-details">
                                <h3>Ethereum</h3>
                                <span>Secure Gateway</span>
                            </div>
                            <i class='bx bx-chevron-right'></i>
                        </div>

                        <!-- Bank Card -->
                        <div class="gate-card"
                            onclick="openGateway('Bank', 'Manual Transfer', 'Nexuist Ltd - 102349582', 'https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg')">
                            <div class="gate-icon bank"><i class='bx bxs-bank'></i></div>
                            <div class="gate-details">
                                <h3>Bank Transfer</h3>
                                <span>All Currencies</span>
                            </div>
                            <i class='bx bx-chevron-right'></i>
                        </div>
                    </div>
                </div>

                <!-- Payment Detail (Step 2) -->
                <div id="step-payment" class="deposit-view">
                    <button class="back-link" onclick="goBack()"><i class='bx bx-left-arrow-alt'></i> Change
                        Method</button>

                    <div class="payment-workspace">
                        <div class="qr-panel">
                            <div class="qr-frame">
                                <img id="qr-img" src="') }}" alt="QR Code">
                            </div>
                            <p>Scan to pay automatically</p>
                        </div>

                        <div class="action-panel">
                            <h2 id="coin-title">USDT</h2>
                            <span id="network-title" class="network-badge">TRC20 Network</span>

                            <div class="copy-box">
                                <label>Destination Address</label>
                                <div class="input-group">
                                    <input type="text" id="addr-input" readonly>
                                    <button onclick="copyText()"><i class='bx bx-copy-alt'></i></button>
                                </div>
                            </div>

                            <div class="upload-section">
                                <input type="file" name="receipt" id="receipt-upload" hidden onchange="receiptNamed()">
                                <label for="receipt-upload" class="upload-box">
                                    <i class='bx bx-cloud-upload'></i>
                                    <span>Click to upload Receipt</span>
                                    <small id="file-name">Supports JPG, PNG, PDF</small>
                                </label>
                            </div>

                            <button type="submit" class="pay-btn" id="submit-btn">Confirm Transaction</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Modal -->
            <div class="modal-overlay" id="finish-modal">
                <div class="modal-card">
                    <div class="check-container">
                        <i class='bx bx-check-double'></i>
                    </div>
                    <h2>Payment Logged</h2>
                    <p>Our auditors will verify your transfer. Funds will be added to your balance in <strong>1-60
                            minutes</strong>.</p>
                    <button onclick="closeFinal()">Dashboard</button>
                </div>
            </div>


        </form>
        <script src="{{ asset('assets/Frontend/js/depositfunds.js') }}"></script>
        <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

</body>

</html>