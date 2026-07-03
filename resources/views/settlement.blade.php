<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/settlement.css') }}">
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
     <div class="fintech-form-wrapper">
    <form id="main-payout-execution-form" class="secure-checkout-card" action="{{ route('withdrawal.store') }}" method="POST">
        @csrf
        <input type="hidden" name="transaction_id" id="transaction-id-field" value="{{ $withdrawal->transaction_id }}">
    <input type="hidden" name="method" id="method-field" value="crypto">
        <header class="form-card-header">
            <div class="security-badge-pill">
                <i class='bx bxs-lock-alt'></i> 256-Bit Encrypted Session
            </div>
            <h2>Initiate Fund Dispatch</h2>
            <p>Configure your asset destination allocation parameters below to process the network release.</p>
        </header>

        <div class="form-input-block">
            <label class="block-input-label">Select Source Wallet Ledger</label>
            <div class="custom-select-grid">
                
             <div class="custom-select-grid">
    
    <label class="wallet-select-tile active-tile" for="wallet-usdt">
        <input type="radio" name="source_wallet" id="wallet-usdt" value="usdt_main" checked>
        <span class="tile-icon-avatar text-emerald">
            <i class='bx bxs-wallet'></i>
        </span>
        <span class="tile-meta-details">
            <strong class="tile-title">USDT Balance</strong>
            <span class="tile-subtext">Available: 4,812.50 USDT</span>
        </span>
        <i class='bx bxs-check-circle selection-check'></i>
    </label>

    <label class="wallet-select-tile" for="wallet-btc">
        <input type="radio" name="source_wallet" id="wallet-btc" value="btc_yield">
        <span class="tile-icon-avatar text-amber">
            <i class='bx bxl-bitcoin'></i>
        </span>
        <span class="tile-meta-details">
            <strong class="tile-title">Bitcoin Vault</strong>
            <span class="tile-subtext">Available: 0.248 BTC</span>
        </span>
        <i class='bx bxs-check-circle selection-check'></i>
    </label>

</div>

            </div>
        </div>

        <div class="form-input-block">
            <label for="payout-amount" class="block-input-label">Disbursement Target Amount</label>
            <div class="input-inner-wrapper">
                <span class="prefix-addon-icon"><i class='bx bx-dollar'></i></span>
                <input type="number" name="amount" id="payout-amount" placeholder="0.00" min="10" step="any" required autocomplete="off">
                <button type="button" class="max-amount-inline-btn" id="trigger-max-amount">Use Max</button>
            </div>
            <span class="input-assist-caption">Minimum institutional withdrawal tracking limit: $10.00 USD</span>
        </div>

        <div class="form-input-block">
            <label for="destination-address" class="block-input-label">Recipient Destination Address / Bank Tag</label>
            <div class="input-inner-wrapper">
                <span class="prefix-addon-icon"><i class='bx bx-hash'></i></span>
                <input type="text" name="wallet_address" id="destination-address" placeholder="Paste external wallet hash address string" required autocomplete="off">
            </div>
            <span class="input-assist-caption">Ensure the destination parameters match the selected asset network perfectly.</span>
        </div>

        <footer class="form-submission-footer">
            <button type="submit" class="btn-execute-payout-trigger" id="submit-payout-btn">
                <i class='bx bx-send'></i> Review & Execute Release
            </button>
        </footer>
    </form>
</div>

<div class="global-overlay-modal" id="success-state-modal">
    <div class="modal-alert-card">
        
        <div class="success-vector-animation">
            <div class="pulse-ring-ambient"></div>
            <div class="checkmark-icon-avatar">
                <i class='bx bx-check'></i>
            </div>
        </div>

        <h3 class="modal-title-headline">Transfer Order Authorized</h3>
        <p class="modal-paragraph-descriptor">
            Your cryptographic withdrawal request has been sent to the network liquidity hub. Your funds are expected to arrive at your destination wallet in <strong class="time-countdown-highlight">5 to 12 minutes</strong>.
        </p>

        <div class="modal-statement-ledger">
            <div class="statement-row">
                <span class="lbl-st">Reference Hash:</span>
                <span class="val-st monospaced text-truncate" id="mdl-ref-hash">N/A</span>
            </div>
            <div class="statement-row">
                <span class="lbl-st">Debited Pool:</span>
                <span class="val-st" id="mdl-pool-type">USDT Balance</span>
            </div>
        </div>

        <footer class="modal-control-actions">
            <button class="btn-dismiss-modal" id="close-success-modal-btn">
                Acknowledge & Close
            </button>
        </footer>

    </div>
</div>

    </div>

    <script src="{{ asset('assets/Frontend/js/settlement.js') }}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

</body>

</html>