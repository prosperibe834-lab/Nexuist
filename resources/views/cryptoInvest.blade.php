<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/cryptoInvest.css') }}">
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
         <main class="investment-container">
    <section class="market-insights-hero">
        <div class="hero-left">
            <span class="badge-pulsing"><i class="bx bx-trending-up"></i> Live ROI Engine</span>
            <h1>Cryptocurrency Investment Plans</h1>
            <p>Capitalize on the digital currency revolution with high-yield, automated smart contracts.</p>
            <div class="tag-group">
                <span class="tag-pill text-green"><i class="bx bx-shield-quarter"></i> Secure Trading</span>
                <span class="tag-pill text-blue"><i class="bx bx-bolt-circle"></i> Instant Yields</span>
                <span class="tag-pill text-purple"><i class="bx bx-globe"></i> Global Access</span>
            </div>
        </div>
        <div class="hero-right">
            <div class="stat-banner">
                <span class="stat-label">Daily Returns Range</span>
                <span class="stat-value">4.5% - 40.0%</span>
            </div>
        </div>
    </section>

    <div class="insights-grid">
        <div class="insight-card">
            <div class="insight-icon bg-blue-dim"><i class="bx bx-data"></i></div>
            <div>
                <h4>$1.2T</h4>
                <p>Total Market Cap</p>
            </div>
        </div>
        <div class="insight-card">
            <div class="insight-icon bg-green-dim"><i class="bx bx-time-five"></i></div>
            <div>
                <h4>24/7</h4>
                <p>Trading Hours</p>
            </div>
        </div>
        <div class="insight-card">
            <div class="insight-icon bg-purple-dim"><i class="bx bx-chip"></i></div>
            <div>
                <h4>12K+</h4>
                <p>Active Contracts</p>
            </div>
        </div>
        <div class="insight-card">
            <div class="insight-icon bg-orange-dim"><i class="bx bx-user-check"></i></div>
            <div>
                <h4>150M+</h4>
                <p>Global Investors</p>
            </div>
        </div>
    </div>

    <section class="plans-grid" id="investmentPlansGrid">
        </section>

    <section class="features-wrapper">
        <h3 class="section-title"><i class="bx bx-star"></i> Institutional Grade Features</h3>
        <div class="features-grid">
            <div class="feature-item">
                <i class="bx bx-lock-alt icon-feature text-blue"></i>
                <h5>Secured Cryptographic Escrow</h5>
                <p>Your capital is locked safely using cold-storage multi-signature smart contracts until maturity loops end.</p>
            </div>
            <div class="feature-item">
                <i class="bx bx-analyse icon-feature text-green"></i>
                <h5>AI-Driven Scalping</h5>
                <p>Automated high-frequency bots continuously hedge trades across 40+ exchanges ensuring stable daily ROI targets.</p>
            </div>
            <div class="feature-item">
                <i class="bx bx-support icon-feature text-purple"></i>
                <h5>24/7 Dedicated Liquidity Desk</h5>
                <p>Instant withdrawal operations handled directly by decentralized liquidity bridges without human delay.</p>
            </div>
        </div>
    </section>

    <section class="portfolio-strip">
        <span class="portfolio-title">Supported Networks:</span>
        <div class="asset-nodes">
            <div class="node"><i class="bx bxl-bitcoin"></i> Bitcoin</div>
            <div class="node"><i class="bx bxl-ethereum"></i> Ethereum</div>
            <div class="node"><i class="bx bx-dollar-circle"></i> Tether USDT</div>
            <div class="node"><i class="bx bxl-stripe"></i> Solana</div>
            <div class="node"><i class="bx bx-coin"></i> BNB Chain</div>
            <div class="node"><i class="bx bx-shape-polygon"></i> Cardano</div>
        </div>
    </section>
    
</main>
        
    </div>

    <script>
        window.cryptoMarketAuth = {!! json_encode(auth()->check() ? ['id' => auth()->id()] : null) !!};
        window.baseUrl = "{{ url('') }}";
        window.csrfToken = "{{ csrf_token() }}";
        window.userBalance = {{ auth()->check() ? auth()->user()->balance : 0 }};
        window.cryptoPlansData = {!! json_encode(\App\Models\CryptoPlan::orderBy('id')->get()->map(function($p){
            return [
                'id' => $p->id,
                'name' => $p->name,
                'tier' => $p->tier,
                'min' => (float) $p->minimum_investment,
                'max' => (float) $p->maximum_investment,
                'dailyRoi' => (float) $p->daily_roi,
                'duration' => (int) $p->duration_days,
                'bonus' => (float) $p->bonus,
            ];
        })) !!};
    </script>
    <script src="{{ asset('assets/Frontend/js/cryptoInvest.js') }}"></script>
</body>

</html>