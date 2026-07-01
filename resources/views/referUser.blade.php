<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/referUser.css') }}">
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
        <main class="nexuist-referral-portal">
            <div class="referral-container animate-fade-in">
                <header class="ref-header">
                    <div class="brand-badge">Nexuist Network</div>
                    <h1>Invite & Earn Rewards</h1>
                    <p>Grow the ecosystem and earn up to 15% commission on every trade your referrals make.</p>
                </header>

                <div class="stats-grid">
                    <div class="stat-card glass-morph">
                        <div class="stat-icon blue"><i class='bx bx-group'></i></div>
                        <div class="stat-info">
                            <span class="label">Total Referrals</span>
                            <h2 class="value">{{ number_format($totalReferrals) }}</h2>
                            <span class="trend up"><i class='bx bx-trending-up'></i> {{ $totalReferrals > 0 ? '+' . round(($totalReferrals / max($totalReferrals, 1)) * 10, 1) . '% this month' : 'No referrals yet' }}</span>
                        </div>
                    </div>
                    <div class="stat-card glass-morph">
                        <div class="stat-icon green"><i class='bx bx-wallet'></i></div>
                        <div class="stat-info">
                            <span class="label">Total Earnings</span>
                            <h2 class="value">${{ number_format($totalEarnings, 2) }}</h2>
                            <span class="trend up"><i class='bx bx-trending-up'></i> {{ $totalEarnings > 0 ? '+'.round(($totalEarnings / max($totalEarnings, 1)) * 5, 1).'% this month' : 'Start earning today' }}</span>
                        </div>
                    </div>
                    <div class="stat-card glass-morph">
                        <div class="stat-icon purple"><i class='bx bx-medal'></i></div>
                        <div class="stat-info">
                            <span class="label">Current Tier</span>
                            <h2 class="value">{{ $currentTier }}</h2>
                            <div class="tier-progress">
                                <div class="progress-bar" style="width: {{ $progressWidth }}%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="ref-tools glass-morph">

                    <div class="qr-trigger-wrapper glass-morph">
                        <div class="tools-header">
                            <div class="tools-text">
                                <h3>Share via QR Code</h3>
                                <p>Invite friends by letting them scan your unique code.</p>
                            </div>
                            <button class="btn-qr-main" onclick="openQRModal()">
                                <i class='bx bx-qr-scan'></i> Generate QR
                            </button>
                        </div>
                    </div>

                    <div id="referralQRModal" class="nexuist-modal-overlay">
                        <div class="qr-modal-card animate-pop-in">
                            <button class="close-x" onclick="closeQRModal()">&times;</button>

                            <div class="modal-body">
                                <div class="qr-brand-icon">
                                    <i class='bx bxs-user-plus'></i>
                                </div>
                                <h2>Your Referral QR</h2>
                                <p>Scanning this link will automatically apply your referral ID: <strong>{{ $referralCode }}</strong>
                                </p>

                                <div class="qr-secure-zone">
                                    <div id="qrcode-canvas"></div>
                                    <div class="qr-id-tag">REF: {{ $referralCode }}</div>
                                </div>

                                <div class="qr-modal-actions">
                                    <button class="btn-download-qr" onclick="downloadReferralQR()">
                                        <i class='bx bxs-download'></i> Save to Gallery
                                    </button>
                                    <button class="btn-copy-fallback" onclick="copyRefLink()">
                                        <i class='bx bx-link-alt'></i> Copy Link
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer-brand">
                                <i class='bx bxs-shield-checked'></i> Nexuist Secure Referral
                            </div>
                        </div>
                    </div>


                    <div class="link-box">
                        <div class="input-wrapper">
                            <label>Unique Referral Link</label>
                            <div class="copy-input">
                                <input type="text" value="{{ $referralLink }}" id="refLink" readonly>
                                <button onclick="copyRefLink()" id="copyBtn"><i class='bx bx-copy'></i></button>
                            </div>
                        </div>
                        <div class="input-wrapper">
                            <label>Referral ID</label>
                            <div class="copy-input">
                                <input type="text" value="{{ $referralCode }}" id="refID" readonly>
                                <button onclick="copyRefID()"><i class='bx bx-copy'></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="share-socials">
                        <span>Direct Share:</span>
                        <div class="social-icons">
                            <a href="https://api.whatsapp.com/send?text=Join%20Nexuist%20and%20start%20earning!%20Use%20my%20link:%20{{ urlencode($referralLink) }}"
                                target="_blank" class="social-link" title="Share on WhatsApp">
                                <i class='bx bxl-whatsapp' onclick="shareToSocial('whatsapp')"></i> </a>

                            <a href="https://t.me/share/url?url={{ urlencode($referralLink) }}&text=Join%20Nexuist%20and%20start%20earning%20rewards!"
                                target="_blank" class="social-link" title="Share on Telegram">
                                <i class='bx bxl-telegram' onclick="shareToSocial('telegram')"></i> </a>

                            <a href="https://twitter.com/intent/tweet?text=Join%20the%20Nexuist%20ecosystem%20and%20earn%20rewards.%20Sign%20up%20here:%20{{ urlencode($referralLink) }}"
                                target="_blank" class="social-link" title="Share on X">
                                <i class='bx bxl-twitter' onclick="shareToSocial('twitter')"></i> </a>
                        </div>
                    </div>
                </section>

                <section class="tier-section glass-morph">
                    <h3>Commission Tiers</h3>
                    <div class="tier-list">
                        @foreach ($globalTierData as $tier)
                            <div class="tier-item {{ $tier['active'] ? 'active' : '' }}">
                                <div class="tier-rank">
                                    <i class='bx bxs-bolt-circle'></i> {{ $tier['name'] }}
                                </div>
                                <div class="tier-req">{{ $tier['range'] }}</div>
                                <div class="tier-reward">{{ $tier['reward'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

        </main>


    </div>

    <script src="{{ asset('assets/Frontend/js/referUser.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</body>

</html>