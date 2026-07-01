<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/internal-transfer.css') }}">
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

 

        <!-- Main Content starts here -->

<div class="transfer-container">
    <div class="transfer-header">
        <div class="header-left">
            <h1>Transfer Funds</h1>
            <p>Send funds securely to other Nexuist platform users.</p>
        </div>
        <button class="back-dashboard">
            <i class='bx bx-arrow-back'></i> Back to Dashboard
        </button>
    </div>

    <div class="balance-card-mini">
        <div class="b-icon"><i class='bx bx-wallet-alt'></i></div>
        <div class="b-info">
            <span>Available Balance</span>
            <h3>$1,245.89</h3>
        </div>
        <div class="b-glow"></div>
    </div>

    <div class="transfer-card">
        <div class="card-title">
            <div class="title-icon"><i class='bx bx-paper-plane'></i></div>
            <div class="title-text">
                <h2>Nexuist Send</h2>
                <p>Internal peer-to-peer transfer</p>
            </div>
        </div>

        <form id="transferForm" onsubmit="handleTransfer(event)">
            <div class="input-group-v2">
                <label>Recipient Email or Username <span>*</span></label>
                <div class="input-wrapper">
                    <i class='bx bx-user'></i>
                    <input type="text" placeholder="Enter recipient's details" required>
                </div>
            </div>

            <div class="input-group-v2">
                <label>Amount ($) <span>*</span></label>
                <div class="input-wrapper">
                    <i class='bx bx-dollar'></i>
                    <input type="number" id="amountInput" placeholder="0.00" min="50" step="0.01" required oninput="calculateFees()">
                </div>
                <small class="limit-text">Minimum transfer amount: $50.00</small>
            </div>

            <div class="summary-box">
                <div class="summary-header">
                    <i class='bx bx-info-circle'></i>
                    <span>Transfer Information</span>
                </div>
                <div class="summary-row">
                    <span>Transfer fee (0%)</span>
                    <span id="feeDisplay">$0.00</span>
                </div>
                <div class="summary-row total">
                    <span>Recipient will receive</span>
                    <span id="receiveDisplay">$0.00</span>
                </div>
            </div>

            <button type="submit" class="main-transfer-btn">
                <i class='bx bx-send'></i> Transfer Funds
            </button>
        </form>
    </div>
</div>

<div id="progressModal" class="modal-overlay">
    <div class="modal-card-v2">
        <div class="loader-container">
            <div class="nexus-loader"></div>
            <i class='bx bx-lock-alt'></i>
        </div>
        <h2>Transaction in Progress</h2>
        <p>Nexuist Secure Verification is underway. Please wait. Verification expected in 1-60 minutes.</p>
        <div class="progress-bar-container">
            <div class="progress-fill"></div>
        </div>
        <button class="close-modal-btn" onclick="closeModal()">Close</button>
    </div>
</div>
         
        
    </div>

    <script src="{{ asset('assets/Frontend/js/internal-transfer.js') }}"></script>
</body>

</html>