<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Invest | Pro Markets</title>
    <!-- Modern, clean font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Link to our clean CSS -->
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/explore.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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


    <header class="navbar" id="navbar">
        <nav class="nav-container">
            <!-- Logo - Using text to keep it crisp -->
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/Frontend/image/mylog.jpeg') }}" alt="Remendy Invest Logo"
                        class="logo-img">
                </a>
            </div>

            <!-- Main Navigation Links -->
            <ul class="nav-menu" id="nav-menu">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link active">Trading
                        <svg class="chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="/cryptocurrencies">Cryptocurrencies</a></li>
                        <li><a href="forex.html">Forex</a></li>
                        <li><a href="shares.html">Shares</a></li>
                        <li><a href="indices.html">Indices</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">System
                        <svg class="chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="{{ url('/copy-trading') }}">Copy Trading</a></li>
                        <li><a href="automated.html">Automated</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">Company
                        <svg class="chevron" width="10" height="6" viewBox="0 0 10 6" fill="none">
                            <path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <ul class="dropdown-content">
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/faq">FAQ</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="education.html" class="nav-link">Education</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>

                <!-- Explicit Mobile-Only Area (Fixes Button Loss) -->
                <li class="mobile-cta-area">
                    <a href="/login" class="mobile-btn-login">Log In</a>
                    <a href="/signup" class="btn-signup">Sign Up Now</a>
                </li>
            </ul>

            <!-- Desktop Right Actions -->
            <div class="nav-actions">
                <a href="/login" class="btn-login">Log In</a>
                <a href="/signup" class="btn-signup">Sign Up</a>
            </div>

            <!-- Modern, Simple Hamburger Button -->
            <button class="menu-toggle" id="mobile-menu" aria-label="Open Menu">
                <span class="bar bar-1"></span>
                <span class="bar bar-2"></span>
            </button>
        </nav>
    </header>

    <!-- Professional Crypto Marquee Ticker -->
    <div class="ticker-wrap">
        <div class="ticker">
            <div class="ticker__item">ETH <span class="white">$2,411.06</span> <span class="up">+1.42%</span></div>
            <div class="ticker__item">USDT <span class="white">$0.999799</span> <span class="down">-0.01%</span></div>
            <div class="ticker__item">XRP <span class="white">$0.5845</span> <span class="up">+3.14%</span></div>
            <div class="ticker__item">BNB <span class="white">$607.12</span> <span class="up">+3.03%</span></div>
            <div class="ticker__item">BTC <span class="white">$68,110</span> <span class="up">+2.41%</span></div>
            <!-- Duplicated for flawless looping animation -->
            <div class="ticker__item">ETH <span class="white">$2,411.06</span> <span class="up">+1.42%</span></div>
            <div class="ticker__item">USDT <span class="white">$0.999799</span> <span class="down">-0.01%</span></div>
        </div>
    </div>

    <!-- Global Trade starts here -->
    <main class="hero-section">
        <div class="container">
            <!-- Left Content -->
            <div class="hero-text">
                <span class="badge">INNOVATIVE TRADING PLATFORM</span>
                <h1>Trade Global Markets <br><span class="highlight">With Confidence</span></h1>
                <p>Access advanced trading tools for Forex, Cryptocurrencies, Commodities, Indices, and more with
                    competitive spreads and lightning-fast execution.</p>
                <div class="cta-group">
                    <a href="#" class="btn btn-primary">Create Account</a>
                    <a href="#" class="btn btn-secondary">Login</a>
                </div>
            </div>

            <!-- Right Chart Card -->
            <div class="chart-container">
                <div class="chart-card">
                    <div class="chart-header">
                        <div class="status">
                            <span class="dot"></span> LIVE 12:40:30 PM
                        </div>
                        <div class="market-status">Open 1D ▾</div>
                    </div>

                    <div class="asset-info">
                        <div class="asset-details">
                            <img src="https://cryptologos.cc/logos/bitcoin-btc-logo.png" alt="BTC" width="24">
                            <div>
                                <h3>BTC/USD $82,515.00 <span class="percent">1.97%</span></h3>
                                <p>Real-time data • Updated</p>
                            </div>
                        </div>
                        <div class="chart-tools">
                            <button>+</button>
                        </div>
                    </div>

                    <!-- TradingView Widget Container -->
                    <div id="tradingview_widget"></div>
                </div>
            </div>
        </div>
    </main>


    <!-- Professional Marquee Section -->
    <!-- 1. Top Ticker Marquee with Logos -->
    <section class="ticker-container">
        <div class="ticker-content">
            <!-- BTC -->
            <div class="ticker-item">
                <img src="https://cryptologos.cc/logos/bitcoin-btc-logo.png') }}" alt="BTC">
                <span class="symbol">BTC/USD</span>
                <span class="price">82,013</span>
                <span class="change up">+1,100.00 (+1.36%)</span>
            </div>
            <!-- EUR -->
            <div class="ticker-item">
                <img src="https://flagcdn.com/w20/eu.png') }}" alt="EUR">
                <span class="symbol">EUR/USD</span>
                <span class="price">1.17491</span>
                <span class="change up">+0.01 (+0.49%)</span>
            </div>
            <!-- ETH -->
            <div class="ticker-item">
                <img src="https://cryptologos.cc/logos/ethereum-eth-logo.png') }}" alt="ETH">
                <span class="symbol">ETH/USD</span>
                <span class="price">2,392.1</span>
                <span class="change up">+30.80 (+1.31%)</span>
            </div>
            <!-- NAS100 -->
            <div class="ticker-item">
                <span class="symbol">NAS100</span>
                <span class="price">28,282.9</span>
                <span class="change up">+197.10 (+0.70%)</span>
            </div>
            <!-- Duplicate for loop -->
            <div class="ticker-item">
                <img src="https://cryptologos.cc/logos/bitcoin-btc-logo.png') }}" alt="BTC">
                <span class="symbol">BTC/USD</span>
                <span class="price">82,013</span>
                <span class="change up">+1,100.00 (+1.36%)</span>
            </div>
        </div>
    </section>

    <!-- 2. Why Trade With Us (Centered 4-Column) -->


    <!-- MODERN BENTO WHY TRADE SECTION -->
    <section class="ft-why-section">
        <div class="ft-container">
            <!-- Section Header -->
            <div class="ft-header">
                <h2 class="ft-main-title">Why Trade With Us</h2>
                <p class="ft-main-subtitle">Everything you need for successful trading in the modern market</p>
            </div>

            <!-- Features Grid -->
            <div class="ft-feature-grid">

                <!-- Trading Tools -->
                <div class="ft-feature-card">
                    <div class="ft-icon-box ft-blue-glow">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 3v18h18" />
                            <path d="m19 9-5 5-4-4-3 3" />
                        </svg>
                    </div>
                    <h3>Trading Tools</h3>
                    <p>Plan your trades effectively with our wide range of free professional trading tools and
                        calculators.</p>
                    <div class="ft-card-bg-glow"></div>
                </div>

                <!-- Trading Products -->
                <div class="ft-feature-card">
                    <div class="ft-icon-box ft-green-glow">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <ellipse cx="12" cy="5" rx="9" ry="3" />
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" />
                            <path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3" />
                        </svg>
                    </div>
                    <h3>Trading Products</h3>
                    <p>Diverse opportunities to optimize your trading portfolio across multiple global markets and
                        assets.</p>
                    <div class="ft-card-bg-glow"></div>
                </div>

                <!-- Trading Platforms -->
                <div class="ft-feature-card">
                    <div class="ft-icon-box ft-blue-glow">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2" />
                            <line x1="8" y1="21" x2="16" y2="21" />
                            <line x1="12" y1="17" x2="12" y2="21" />
                        </svg>
                    </div>
                    <h3>Trading Platforms</h3>
                    <p>Powerful platforms to suit all trading styles and needs on any device, from web to mobile apps.
                    </p>
                    <div class="ft-card-bg-glow"></div>
                </div>

                <!-- Funding Methods -->
                <div class="ft-feature-card">
                    <div class="ft-icon-box ft-gold-glow">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="5" width="20" height="14" rx="2" />
                            <line x1="2" y1="10" x2="22" y2="10" />
                        </svg>
                    </div>
                    <h3>Funding Methods</h3>
                    <p>Multiple quick, easy and secure methods to fund your account and withdraw your profits instantly.
                    </p>
                    <div class="ft-card-bg-glow"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- Market Analysis & Insights starts here -->
    <!-- Fintech Market Analysis Section -->
    <section class="ft-market-section">
        <div class="ft-container">

            <!-- Header -->
            <div data-aos="zoom-in" class="ft-header">
                <span class="ft-badge">REAL-TIME INTELLIGENCE</span>
                <h2 class="ft-title">Market Analysis & Insights</h2>
                <p class="ft-subtitle">Stay ahead with real-time market data, AI-powered insights, and expert analysis
                </p>
            </div>

            <div class="ft-grid">
                <!-- Left: Live Market Widget -->
                <div class="ft-card ft-widget-card">
                    <h3 class="ft-card-label">Live Market Overview</h3>
                    <div class="ft-chart-container">
                        <div id="tradingview-wrapper" class="tradingview-widget-container">
                            <!-- JS will inject the widget here -->
                        </div>
                    </div>
                </div>

                <!-- Right: Expert Analysis -->
                <div data-aos="zoom-in" class="ft-card ft-analysis-card">
                    <h3 class="ft-card-label">Expert Market Analysis</h3>

                    <div class="ft-analysis-list">
                        <!-- Item 1 -->
                        <div class="ft-analysis-item">
                            <div class="ft-iconbox ft-icon-green">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                                    <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                                </svg>
                            </div>
                            <div class="ft-item-content">
                                <h4>Daily Market <span>Updates</span></h4>
                                <p>Receive daily market analysis directly to your inbox. Our team provides actionable
                                    insights on trends and major asset classes.</p>
                                <a href="#" class="ft-link-btn">Read more</a>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="ft-analysis-item">
                            <div class="ft-iconbox ft-icon-blue">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ft-item-content">
                                <h4>Premium Trading <span>Tools</span></h4>
                                <p>Access advanced trading tools designed for all experience levels. Customizable
                                    solutions to meet diverse trading styles.</p>
                                <a href="#" class="ft-link-btn">Read more</a>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="ft-analysis-item">
                            <div class="ft-iconbox ft-icon-shield">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </div>
                            <div class="ft-item-content">
                                <h4>Funds <span>Protection</span></h4>
                                <p>Your security is our priority. We provide industry-leading insurance protection for
                                    client funds up to $1,000,000.</p>
                                <a href="#" class="ft-link-btn">Read more</a>
                            </div>
                        </div>
                    </div><br>

                    <a href="#" class="ft-cta-main">Learn more about our services &rarr;</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Diverse Trading Products start here -->
    <section class="ft-products">
        <div class="ft-container">
            <div class="ft-header">
                <h2 class="ft-title">Diverse Trading Products</h2>
                <p class="ft-subtitle">Access global markets with competitive conditions</p>
            </div>

            <div class="ft-product-grid">
                <!-- Forex -->
                <div class="ft-product-card ft-forex" style="--accent: #3b82f6;">
                    <div class="ft-card-content">
                        <div class="ft-icon-circle"><i class="fas fa-globe"></i></div>
                        <h3>Forex</h3>
                        <p>Trade 70+ major, minor & exotic currency pairs with competitive spreads and conditions</p>
                        <a href="#" class="ft-explore-link">Explore Forex <span class="ft-arrow">→</span></a>
                    </div>
                    <div class="ft-card-glow"></div>
                </div>

                <!-- Shares -->
                <div class="ft-product-card ft-shares" style="--accent: #10b981;">
                    <div class="ft-card-content">
                        <div class="ft-icon-circle"><i class="fas fa-chart-line"></i></div>
                        <h3>Shares</h3>
                        <p>Access hundreds of public companies from the US, UK, Germany and more markets</p>
                        <a href="#" class="ft-explore-link">Explore Shares <span class="ft-arrow">→</span></a>
                    </div>
                    <div class="ft-card-glow"></div>
                </div>

                <!-- Energies -->
                <div class="ft-product-card ft-energies" style="--accent: #f59e0b;">
                    <div class="ft-card-content">
                        <div class="ft-icon-circle"><i class="fas fa-fire"></i></div>
                        <h3>Energies</h3>
                        <p>Discover opportunities on UK & US Crude Oil as well as Natural Gas with tight spreads</p>
                        <a href="#" class="ft-explore-link">Explore Energies <span class="ft-arrow">→</span></a>
                    </div>
                    <div class="ft-card-glow"></div>
                </div>

                <!-- Indices -->
                <div class="ft-product-card ft-indices" style="--accent: #6366f1;">
                    <div class="ft-card-content">
                        <div class="ft-icon-circle"><i class="fas fa-university"></i></div>
                        <h3>Indices</h3>
                        <p>Trade major and minor Index CFDs from around the globe with competitive conditions</p>
                        <a href="#" class="ft-explore-link">Explore Indices <span class="ft-arrow">→</span></a>
                    </div>
                    <div class="ft-card-glow"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- Popular Asset Class Cryptocurrency Trading starts here  -->

    <section class="ft-crypto-section">
        <div class="ft-container">
            <!-- Section Header -->
            <div data-aos="fade-up" class="ft-header">
                <span class="ft-badge">POPULAR ASSET CLASS</span>
                <h2 class="ft-main-title">Cryptocurrency Trading</h2>
                <p class="ft-main-subtitle">Execute trades on the world's leading digital assets with
                    institutional-grade liquidity and advanced execution tools.</p>
            </div>

            <!-- Crypto Grid -->
            <div class="ft-crypto-grid">

                <!-- Bitcoin -->
                <div data-aos="fade-up" class="ft-crypto-card" style="--card-accent: #f7931a;">
                    <div class="ft-card-banner">
                        <i class="fab fa-bitcoin ft-crypto-icon"></i>
                    </div>
                    <div class="ft-card-body">
                        <h3>Bitcoin</h3>
                        <p>The premier digital store of value. Trade BTC against major fiat currencies with ultra-low
                            latency.</p>
                        <div class="ft-card-footer">
                            <a href="#" class="ft-trade-link">Trade now <span class="ft-arrow">→</span></a>
                            <span class="ft-ticker">BTC/USD</span>
                        </div>
                    </div>
                </div>

                <!-- Ethereum -->
                <div data-aos="zoom-in" class="ft-crypto-card" style="--card-accent: #627eea;">
                    <div class="ft-card-banner">
                        <i class="fab fa-ethereum ft-crypto-icon"></i>
                    </div>
                    <div class="ft-card-body">
                        <h3>Ethereum</h3>
                        <p>The foundation of decentralized finance. Access deep liquidity pools for the leading
                            smart-contract protocol.</p>
                        <div class="ft-card-footer">
                            <a href="#" class="ft-trade-link">Trade now <span class="ft-arrow">→</span></a>
                            <span class="ft-ticker">ETH/USD</span>
                        </div>
                    </div>
                </div>

                <!-- Ripple -->
                <div data-aos="zoom-in" class="ft-crypto-card" style="--card-accent: #23292f;">
                    <div class="ft-card-banner">
                        <span class="ft-crypto-text-icon">XRP</span>
                    </div>
                    <div class="ft-card-body">
                        <h3>Ripple</h3>
                        <p>Optimized for cross-border settlements. Benefit from high-speed transaction processing and
                            tight spreads.</p>
                        <div class="ft-card-footer">
                            <a href="#" class="ft-trade-link">Trade now <span class="ft-arrow">→</span></a>
                            <span class="ft-ticker">XRP/USD</span>
                        </div>
                    </div>
                </div>

                <!-- Cardano -->
                <div data-aos="fade-down" class="ft-crypto-card" style="--card-accent: #0033ad;">
                    <div class="ft-card-banner">
                        <span class="ft-crypto-text-icon">ADA</span>
                    </div>
                    <div class="ft-card-body">
                        <h3>Cardano</h3>
                        <p>The sustainable blockchain ecosystem. Trade ADA with sophisticated risk management tools.</p>
                        <div class="ft-card-footer">
                            <a href="#" class="ft-trade-link">Trade now <span class="ft-arrow">→</span></a>
                            <span class="ft-ticker">ADA/USD</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Call to Action -->
            <div class="ft-action-wrapper">
                <a href="#" class="ft-btn-primary">View all cryptocurrencies <span class="ft-arrow">→</span></a>
            </div>
        </div>
    </section>



    <!-- Education Center starts here -->
    <!-- Fintech Education Section -->
    <section class="ft-main-container">
        <div class="ft-wrapper">
            <!-- Content Header for Mobile -->
            <div data-aos="fade-left" class="ft-mobile-header">
                <span class="ft-tag">EDUCATION CENTER</span>
                <h2 class="ft-title">Master the Markets</h2>
            </div>

            <div class="ft-grid">
                <!-- Video Column -->
                <div data-aos="fade-right" class="ft-video-column">
                    <div class="ft-video-card">
                        <a href="https://www.youtube.com/watch?v=bBC-nXj3Ng4" target="_blank">
                            <div class="video-thumbnail">
                                <img src="https://img.youtube.com/vi/bBC-nXj3Ng4/maxresdefault.jpg') }}"
                                    alt="Bitcoin Video">
                                <div class="play-btn">▶</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Text Column -->
                <div data-aos="fade-left" class="ft-info-column">
                    <div class="ft-desktop-header">
                        <span class="ft-tag">EDUCATION CENTER</span>
                        <h2 class="ft-title">Master the Markets</h2>
                    </div>

                    <p data-aos="fade-up" class="ft-description">
                        Move beyond basic holding. Transition into a profitable trader by mastering technical analysis,
                        risk management, and institutional-grade psychology.
                    </p>

                    <div data-aos="fade-left" class="ft-feature-box">
                        <h4 class="ft-feature-title">Why Bitcoin Trading?</h4>
                        <p class="ft-feature-text">
                            Bitcoin ($BTC) acts as the market's "North Star." Successful trading requires
                            understanding liquidity cycles and maintaining a strict risk-to-reward ratio.
                        </p>
                    </div>

                    <div data-aos="fade-up" class="ft-button-group">
                        <a href="#" class="ft-btn ft-btn-primary">
                            Start Learning
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </a>
                        <a href="#" class="ft-btn ft-btn-outline">
                            View Webinars
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tighter Spreads. Faster Execution starts here -->
    <section class="ft-dashboard">
        <div class="ft-container">
            <!-- Live Market Header -->
            <div data-aos="fade-right" class="ft-market-header">
                <div class="ft-text-content">
                    <span class="ft-badge">LIVE INTELLIGENCE</span>
                    <h2 class="ft-heading">Global Market Overview</h2>
                    <p class="ft-subtext">Real-time institutional data feeds providing deep liquidity insights and asset
                        performance tracking.</p>
                </div>
                <div class="ft-status">
                    <span class="ft-pulse"></span>
                    Live Market Data
                </div>
            </div>

            <!-- Market Table -->
            <div data-aos="fade-up" class="ft-table-wrapper">
                <table class="ft-market-table" id="market-table">
                    <thead>
                        <tr>
                            <th>Asset</th>
                            <th>Price (USD)</th>
                            <th>24h Change</th>
                            <th>Market Cap</th>
                            <th class="ft-hide-mobile">Volume (24h)</th>
                        </tr>
                    </thead>
                    <tbody id="market-body">
                        <!-- Data will be injected here by JS -->
                        <tr class="ft-loading-row">
                            <td colspan="5">Syncing with global exchanges...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Educational Section -->
            <div class="ft-edu-grid">
                <div data-aos="fade-left" class="ft-video-wrapper">
                    <a href="https://www.youtube.com/watch?v=rRLCTWIfY5k" target="_blank">
                        <div class="video-thumbnail">
                            <img src="https://img.youtube.com/vi/rRLCTWIfY5k/maxresdefault.jpg') }}"
                                alt="Trading Video">
                            <div class="play-btn">▶</div>
                        </div>
                    </a>
                </div>
                <div data-aos="fade-right" class="ft-edu-content">
                    <h3 class="ft-edu-title">Precision Trading Strategy</h3>
                    <p class="ft-edu-text">Transition from retail guessing to institutional precision. Master the
                        asymmetric risk models used by top-tier desks to maintain profitability in all market
                        conditions.</p>
                    <ul class="ft-list">
                        <li>Institutional Liquidity Cycles</li>
                        <li>Advanced Risk-to-Reward Modeling</li>
                        <li>Volatility Management Protocols</li>
                    </ul>
                    <a href="#" class="ft-cta-btn">Access Trading Terminal</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Copy Professional Traders starts here -->
    <!-- Fintech Copy Trading Section -->
    <section class="st-copy-trading-container">
        <div class="st-wrapper">

            <!-- Premium Header -->
            <header class="st-header st-animate st-fade-in-up">
                <div class="st-badge-row">
                    <span class="st-tag">SOCIAL ALGO TRADING</span>
                </div>
                <h1 class="st-title">Allocate Capital to Institutional Talent</h1>
                <p class="st-subtitle">Diversify your portfolio by connecting directly with verified, high-performance
                    strategy managers. Automate your execution, optimize exposure, and retain full control.</p>
            </header>

            <!-- Strategic Benefits Grid -->
            <div class="st-grid">

                <!-- Card 1 -->
                <article class="st-card st-animate st-fade-in-up" style="--st-delay: 1">
                    <div class="st-card-icon-container">
                        <!-- Dynamic Layer Icon -->
                        <svg class="st-card-icon" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                        </svg>
                    </div>
                    <h3 class="st-card-title">Access 400+ Strategy Alphas</h3>
                    <p class="st-card-text">Allocate to a diverse array of automated and discretionary strategies,
                        optimized across 1,000+ global instruments and 7 major asset classes.</p>
                    <div class="st-card-border-glow"></div>
                </article>

                <!-- Card 2 -->
                <article class="st-card st-animate st-fade-in-up" style="--st-delay: 2">
                    <div class="st-card-icon-container">
                        <!-- Performance Chart Icon -->
                        <svg class="st-card-icon" viewBox="0 0 24 24">
                            <path d="M18 20V10M12 20V4M6 20v-6"></path>
                        </svg>
                    </div>
                    <h3 class="st-card-title">Performance-Driven Selection</h3>
                    <p class="st-card-text">Utilize proprietary performance metrics and deep-dive analytics to rank
                        managers. Align your capital with strategies that match your risk tolerance.</p>
                    <div class="st-card-border-glow"></div>
                </article>

                <!-- Card 3 -->
                <article class="st-card st-animate st-fade-in-up" style="--st-delay: 3">
                    <div class="st-card-icon-container">
                        <!-- Security Shield Icon -->
                        <svg class="st-card-icon" viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h3 class="st-card-title">Risk Management Protocols</h3>
                    <p class="st-card-text">Protect your principal with robust institutional risk engines. Control
                        maximum drawdown and set bespoke stop-out levels at the strategy layer.</p>
                    <div class="st-card-border-glow"></div>
                </article>

                <!-- Card 4 -->
                <article class="st-card st-animate st-fade-in-up" style="--st-delay: 4">
                    <div class="st-card-icon-container">
                        <!-- Integration Settings Icon -->
                        <svg class="st-card-icon" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="st-card-title">Hybrid Capital Allocation</h3>
                    <p class="st-card-text">Seamlessly combine copy trading with your own manual strategies or
                        API-driven execution on a unified, low-latency infrastructure.</p>
                    <div class="st-card-border-glow"></div>
                </article>

            </div>
        </div>
    </section>


    <!-- Abou sections starts here -->
    <!-- Fintech About Us Section -->
    <section class="ab-section">
        <div class="ab-wrapper">

            <!-- Header Section -->
            <header data-aos="zoom-in" class="ab-header">
                <span class="ab-badge">OUR INSTITUTIONAL FOOTPRINT</span>
                <h1 class="ab-title">Architecting the Future of Global Wealth</h1>
                <p class="ab-lead">We bridge the gap between traditional capital markets and the digital frontier,
                    providing a unified ecosystem for high-conviction investors.</p>
            </header>

            <!-- The Narrative Grid -->
            <div class="ab-grid">
                <!-- Main Vision Card -->
                <div data-aos="fade-down-right" class="ab-card ab-vision">
                    <div class="ab-card-content">
                        <h2 class="ab-card-title">Our Vision</h2>
                        <p class="ab-card-text">In an era of rapid financial evolution, we empower our clients with a
                            multi-asset terminal that integrates the liquidity of <strong>Global Stocks</strong>, the
                            transparency of <strong>Real Estate</strong>, and the growth of <strong>Digital
                                Assets</strong>.</p>
                        <div class="ab-stats-grid">
                            <div class="ab-stat">
                                <span class="ab-stat-num">256-bit</span>
                                <span class="ab-stat-label">Encryption</span>
                            </div>
                            <div class="ab-stat">
                                <span class="ab-stat-num">99.9%</span>
                                <span class="ab-stat-label">Uptime</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Side Pillar Cards -->
                <div class="ab-pillars">
                    <div data-aos="fade-up" class="ab-pillar-item">
                        <div class="ab-icon">₿</div>
                        <div>
                            <h4 class="ab-pillar-title">Crypto Liquidity</h4>
                            <p class="ab-pillar-desc">Deep-pool access to major digital pairs with institutional-grade
                                security protocols.</p>
                        </div>
                    </div>
                    <div data-aos="fade-up" class="ab-pillar-item">
                        <div class="ab-icon">🏛</div>
                        <div>
                            <h4 class="ab-pillar-title">Real Estate Equity</h4>
                            <p class="ab-pillar-desc">Fractionalized access to premium commercial and residential real
                                estate portfolios.</p>
                        </div>
                    </div>
                    <div data-aos="fade-up" class="ab-pillar-item">
                        <div class="ab-icon">📈</div>
                        <div>
                            <h4 class="ab-pillar-title">Market Intelligence</h4>
                            <p class="ab-pillar-desc">Direct execution on global exchanges with real-time volatility
                                management.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Footer -->
            <div data-aos="fade-up" class="ab-footer">
                <p class="ab-footer-text">Registered & Regulated Asset Management • Est. 2018</p>
                <div class="ab-cta-row">
                    <a href="#" class="ab-btn-main">View Roadmap</a>
                    <a href="#" class="ab-btn-link">Meet the Executive Board →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Investment Opportunities starts here -->
    <!-- Fintech Investment Opportunities -->
    <section class="io-section">
        <div class="io-wrapper">
            <header data-aos="zoom-in" class="io-header">
                <div class="io-tag-group">
                    <span class="io-badge">PREMIUM ALLOCATIONS</span>
                    <span class="io-live-dot">LIVE UPDATES</span>
                </div>
                <h2 class="io-title">Diversify Across High-Yield Asset Classes</h2>
                <p class="io-subtitle">Access institutional-grade investment vehicles tailored for 2026 market dynamics.
                    Select your sector and deploy capital with precision.</p>
            </header>

            <div class="io-grid">
                <!-- Asset Card: Crypto -->
                <div data-aos="fade-up" class="io-card">
                    <div class="io-card-head">
                        <div class="io-icon-box">₿</div>
                        <span class="io-risk-tag io-risk-high">High Growth</span>
                    </div>
                    <h3 class="io-asset-name">Digital Asset Sovereignty</h3>
                    <p class="io-asset-desc">Direct exposure to Tier-1 blockchain protocols and DeFi liquidity pools.
                        Leverage our 2026 halving cycle models for optimized entry points.</p>
                    <div class="io-metrics">
                        <div class="io-metric"><span>Est. APY</span><strong>14.2%</strong></div>
                        <div class="io-metric"><span>Liquidity</span><strong>T+0</strong></div>
                    </div>
                    <a href="#" class="io-btn">Explore Crypto</a>
                </div>

                <!-- Asset Card: Real Estate -->
                <div data-aos="fade-up" class="io-card">
                    <div class="io-card-head">
                        <div class="io-icon-box">🏛</div>
                        <span class="io-risk-tag io-risk-low">Stability</span>
                    </div>
                    <h3 class="io-asset-name">Fractionalized Real Estate</h3>
                    <p class="io-asset-desc">Invest in prime commercial real estate without the overhead. Earn monthly
                        rental dividends backed by legally binding smart contracts.</p>
                    <div class="io-metrics">
                        <div class="io-metric"><span>Min. Entry</span><strong>$1,000</strong></div>
                        <div class="io-metric"><span>Asset Class</span><strong>A+</strong></div>
                    </div>
                    <a href="#" class="io-btn">View Portfolio</a>
                </div>

                <!-- Asset Card: Stocks -->
                <div data-aos="fade-up" class="io-card io-card-featured">
                    <div class="io-card-head">
                        <div class="io-icon-box">📈</div>
                        <span class="io-risk-tag io-risk-mid">Strategic</span>
                    </div>
                    <h3 class="io-asset-name">Global Equity Markets</h3>
                    <p class="io-asset-desc">Direct execution on NYSE, NASDAQ, and LSE. Access high-frequency automated
                        strategies and AI-driven stock picking bots.</p>
                    <div class="io-metrics">
                        <div class="io-metric"><span>Exec. Speed</span><strong>&lt;10ms</strong></div>
                        <div class="io-metric"><span>Assets</span><strong>5,000+</strong></div>
                    </div>
                    <a href="#" class="io-btn io-btn-glow">Trade Equities</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Advanced Trading Tools Section -->
    <section class="at-section">
        <div class="at-wrapper">
            <header class="at-header at-animate at-fade-in">
                <span class="at-badge">TERMINAL V3.0</span>
                <h2 class="at-title">Institutional Execution Suite</h2>
                <p class="at-subtitle">Harness the power of low-latency data feeds and algorithmic precision. Our suite
                    is designed for the professional who demands zero-slippage execution.</p>
            </header>

            <div class="at-grid">
                <!-- Left: Interactive Chart Display -->
                <div class="at-chart-container at-animate at-slide-left">
                    <div class="at-chart-header">
                        <div class="at-pair-info">
                            <strong>BTC / USDT</strong>
                            <span class="at-trend-up">+4.28%</span>
                        </div>
                        <div class="at-timeframes">
                            <span>1H</span><span class="at-active-tf">4H</span><span>1D</span><span>1W</span>
                        </div>
                    </div>
                    <!-- Real-time Lightweight Chart Mockup -->
                    <div class="at-chart-area">
                        <div class="at-price-line"></div>
                        <canvas id="at-live-chart"></canvas>
                    </div>
                    <div class="at-chart-overlay">
                        <div class="at-indicator">RSI: 58.4</div>
                        <div class="at-indicator">MACD: Bullish Cross</div>
                    </div>
                </div>

                <!-- Right: Tool Modules -->
                <div class="at-tools-list">
                    <!-- Tool 1 -->
                    <div class="at-tool-card at-animate at-slide-right" style="--at-delay: 1">
                        <div class="at-tool-icon">⚡</div>
                        <div class="at-tool-info">
                            <h4>Smart Order Routing (SOR)</h4>
                            <p>Automatically scan multiple liquidity pools to ensure your large orders are filled at the
                                best possible price with minimal impact.</p>
                        </div>
                    </div>
                    <!-- Tool 2 -->
                    <div class="at-tool-card at-animate at-slide-right" style="--at-delay: 2">
                        <div class="at-tool-icon">🤖</div>
                        <div class="at-tool-info">
                            <h4>Algo-Builder Engine</h4>
                            <p>Deploy Python-based scripts or use our visual drag-and-drop builder to automate
                                Trend-Following or Mean-Reversion strategies.</p>
                        </div>
                    </div>
                    <!-- Tool 3 -->
                    <div class="at-tool-card at-animate at-slide-right" style="--at-delay: 3">
                        <div class="at-tool-icon">📊</div>
                        <div class="at-tool-info">
                            <h4>Heatmap & Flow Analysis</h4>
                            <p>Visualize institutional "limit order" clusters and track whale movements before they hit
                                the public order book.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="nx-trust-section">
        <div class="nx-container">

            <header class="nx-header">
                <div class="nx-reveal">
                    <span class="nx-tag">THE NEXUIST STANDARD</span>
                    <h2 class="nx-title">Built on a Foundation of <span class="nx-gradient-text">Absolute
                            Integrity.</span></h2>
                    <p class="nx-description">Nexuist isn't just a platform; it's a regulated financial ecosystem. We
                        combine Swiss-level security with Silicon Valley speed to protect the world's most ambitious
                        portfolios.</p>
                </div>
            </header>

            <div class="nx-grid">

                <div class="nx-card nx-animate">
                    <div class="nx-icon-wrap">🛡️</div>
                    <h3>Military-Grade Vaulting</h3>
                    <p>98% of digital assets are held in multi-sig cold storage, protected by FIPS 140-2 Level 3
                        hardware security modules.</p>
                    <div class="nx-card-link">View Security Audit →</div>
                </div>

                <div class="nx-card nx-animate">
                    <div class="nx-icon-wrap">⚖️</div>
                    <h3>Global Compliance</h3>
                    <p>Fully licensed across 4 continents. Our rigorous KYC/AML protocols meet the highest international
                        banking standards.</p>
                    <div class="nx-card-link">Regulatory Roadmap →</div>
                </div>

                <div class="nx-card nx-animate">
                    <div class="nx-icon-wrap">💎</div>
                    <h3>Proof of Reserves</h3>
                    <p>Real-time, on-chain verification of our capital reserves. We maintain a 1:1 backing for every
                        user asset, always.</p>
                    <div class="nx-card-link">Live Audit Feed →</div>
                </div>

            </div>

            <div class="nx-stats-bar nx-animate">
                <div class="nx-stat">
                    <span class="nx-counter" data-target="12">0</span><span class="nx-plus">B+</span>
                    <p>Assets Protected</p>
                </div>
                <div class="nx-stat">
                    <span class="nx-counter" data-target="450">0</span><span class="nx-plus">K+</span>
                    <p>Global Investors</p>
                </div>
                <div class="nx-stat">
                    <span class="nx-counter" data-target="190">0</span><span class="nx-plus">+</span>
                    <p>Countries Served</p>
                </div>
            </div>
        </div>
    </section>


    <!-- How we work starts here -->
    <section class="sp-process-section">
        <div class="sp-container">

            <header class="sp-header">
                <span class="sp-tag">ONBOARDING FLOW</span>
                <h2 class="sp-title">Your Path to Market Exposure</h2>
                <p class="sp-subtitle">Experience a frictionless transition from liquid capital to diversified market
                    positions.</p>
            </header>

            <div class="sp-grid">
                <div class="sp-step-card sp-animate">
                    <div class="sp-number">01</div>
                    <div class="sp-icon-box">💳</div>
                    <h3>Capital Deployment</h3>
                    <p>Initialize your institutional account and allocate funds via 20+ secure gateway protocols,
                        including instant bank rails and crypto bridges.</p>
                    <a href="#" class="sp-action">Fund Account →</a>
                </div>

                <div class="sp-step-card sp-animate" style="--sp-delay: 1">
                    <div class="sp-number">02</div>
                    <div class="sp-icon-box">📊</div>
                    <h3>Active Execution</h3>
                    <p>Access 100+ high-liquidity assets. Utilize professional charting tools, real-time sentiment
                        analysis, and low-latency order matching.</p>
                    <a href="#" class="sp-action">Open Terminal →</a>
                </div>

                <div class="sp-step-card sp-animate" style="--sp-delay: 2">
                    <div class="sp-number">03</div>
                    <div class="sp-icon-box">🔓</div>
                    <h3>Liquidity Retrieval</h3>
                    <p>Repatriate your returns instantly. Our automated clearing house ensures secure withdrawals to
                        your global bank or digital wallet.</p>
                    <a href="#" class="sp-action">View Protocols →</a>
                </div>
            </div>

        </div>
    </section>


    <!-- Trade What You Want, When You Want starts here -->
    <section class="dm-section">
        <div class="dm-wrapper">

            <header data-aos="zoom-in" class="dm-header dm-animate dm-fade-in">
                <span class="dm-tag">MARKET ACCESS TERMINAL</span>
                <h2 class="dm-title">Asymmetric Return Drivers, Available on Demand.</h2>
                <p class="dm-subtitle">Our comprehensive ecosystem connects you directly to global capital. Experience
                    unrestricted execution across traditional and decentralized asset classes.</p>
            </header>

            <div class="dm-split-grid">

                <div data-aos="zoom-in" class="dm-image-column dm-animate dm-slide-left">
                    <div class="dm-image-card">
                        <img src="{{ asset('assets/Frontend/image/bitcoin.jpg') }}" alt="BTC Global Liquidity"
                            class="dm-asset-img">
                        <div class="dm-image-overlay"></div>
                        <div class="dm-data-status">
                            <span class="dm-pulse"></span> LIVE: Deep Liquidity Feed
                        </div>
                        <div class="dm-card-footer">
                            <small>Execution Infrastructure Fee: $0.00 | Global</small>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" class="dm-content-column dm-animate dm-slide-right">
                    <div class="dm-feature-intro">
                        <h4>Direct Market Access (DMA)</h4>
                        <p>We provide unparalleled execution quality through relationships with Tier-1 liquidity
                            providers. Our infrastructure architecture guarantees minimal slippage and optimal pricing,
                            even during peak market volatility.</p>
                    </div>

                    <div class="dm-benefits-grid">
                        <div data-aos="zoom-in" class="dm-benefit-tile">
                            <div class="dm-tile-icon">📈</div>
                            <div class="dm-tile-text">
                                <strong>Multi-Asset Allocation</strong>
                                <span>Forex, Indices, Stocks & Commodities.</span>
                            </div>
                        </div>
                        <div data-aos="zoom-in" class="dm-benefit-tile">
                            <div class="dm-tile-icon">🌐</div>
                            <div class="dm-tile-text">
                                <strong>24/7 Global Exposure</strong>
                                <span>Crypto markets and global indices on a single interface.</span>
                            </div>
                        </div>
                        <div class="dm-benefit-tile">
                            <div class="dm-tile-icon">💬</div>
                            <div class="dm-tile-text">
                                <strong>Multilingual Support</strong>
                                <span>Access professional advice in 12 languages.</span>
                            </div>
                        </div>
                        <div data-aos="zoom-in" class="dm-benefit-tile">
                            <div class="dm-tile-icon">📱</div>
                            <div class="dm-tile-text">
                                <strong>Unrestricted Mobility</strong>
                                <span>Trade from our native high-frequency apps (iOS/Android).</span>
                            </div>
                        </div>
                    </div>

                    <a data-aos="zoom-in" href="#" class="dm-action-btn">
                        Explore Our DMA Architecture
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>


    <!-- Start Trading with Nexuist starts here-->
    <section class="cs-section">
        <div class="cs-container">

            <header class="cs-header cs-animate">
                <span class="cs-badge">V4.0 ECOSYSTEM</span>
                <h2 class="cs-title">Precision Trading. <span class="cs-highlight">Institutional Results.</span></h2>
                <p class="cs-subtitle">Nexuist provides the full-stack infrastructure required to navigate the
                    complexities of modern global markets.</p>
            </header>

            <div class="cs-grid">
                <div class="cs-card cs-animate" style="--cs-delay: 1">
                    <div class="cs-card-glow"></div>
                    <div class="cs-icon-area">📡</div>
                    <h3 class="cs-card-title">Intelligence & Alpha</h3>
                    <p class="cs-card-lead">Gain an information edge with our proprietary research and live
                        institutional feeds.</p>
                    <ul class="cs-list">
                        <li>Daily Macro Intelligence Reports</li>
                        <li>Priority Access to Weekly Live Webinars</li>
                        <li>Direct Strategy Support via Quant Desk</li>
                        <li>Real-time Sentiment & Flow Analysis</li>
                    </ul>
                </div>

                <div class="cs-card cs-card-featured cs-animate" style="--cs-delay: 2">
                    <div class="cs-card-glow"></div>
                    <div class="cs-icon-area">🏆</div>
                    <h3 class="cs-card-title">Regulatory Excellence</h3>
                    <p class="cs-card-lead">Trade with the peace of mind offered by a globally recognized,
                        multi-award-winning broker.</p>
                    <ul class="cs-list">
                        <li>42+ Tier-1 Industry Awards</li>
                        <li>A+ Rated Client Fund Security Protocols</li>
                        <li>Tier-1 Liquidity Aggregation</li>
                        <li>ISO 27001 Certified Infrastructure</li>
                    </ul>
                    <div class="cs-badge-row">
                        <span class="cs-mini-badge">Top 100 Global</span>
                    </div>
                </div>

                <div class="cs-card cs-animate" style="--cs-delay: 3">
                    <div class="cs-card-glow"></div>
                    <div class="cs-icon-area">🏦</div>
                    <h3 class="cs-card-title">Capital Allocation</h3>
                    <p class="cs-card-lead">Optimize your portfolio with our passive and active investment vehicles.</p>
                    <ul class="cs-list">
                        <li>Institutional PAMM & MAM Ranking</li>
                        <li>Smart-Copy Allocation Modules</li>
                        <li>Follow High-Performance Alphas</li>
                        <li>Automated Dividend Distribution</li>
                    </ul>
                </div>
            </div>

            <div class="cs-footer cs-animate">
                <a href="#" class="cs-btn-primary">Initialize Terminal</a>
                <p class="cs-disclaimer">Zero commission on major pairs. Institutional spreads from 0.0 pips.</p>
            </div>

        </div>
    </section>


    <!-- Testimonials starts here -->
    <section class="ts-section">
        <div class="ts-wrapper">
            <header data-aos="zoom-in" class="ts-header ts-animate">
                <span class="ts-badge">GLOBAL VOICES</span>
                <h2 class="ts-title">Trusted by Professional <span class="ts-highlight">Capital Allocators.</span></h2>
                <p class="ts-subtitle">Join over 450,000 investors leveraging Nexuist’s institutional-grade
                    infrastructure for superior market execution.</p>
            </header>

            <div class="ts-grid">
                <div data-aos="zoom-in" class="ts-card ts-animate" style="--ts-delay: 1">
                    <div class="ts-quote-icon">“</div>
                    <p class="ts-text">The execution speed on Nexuist is unparalleled. Integrating their SOR (Smart
                        Order Routing) into my daily strategy has significantly reduced my slippage across
                        high-volatility crypto pairs.</p>
                    <div class="ts-author">
                        <img src="{{ asset('assets/Frontend/image/14 Trendy Caesar Haircuts Every Stylish Guy Needs to Steal from Celebs.jpeg') }}      "
                            alt="Executive" class="ts-avatar">
                        <div class="ts-meta">
                            <strong>Marcus V. Sterling</strong>
                            <span>Senior Portfolio Manager</span>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" class="ts-card ts-animate" style="--ts-delay: 2">
                    <div class="ts-quote-icon">“</div>
                    <p class="ts-text">Switching to Nexuist for my real estate equity holdings was a game-changer. The
                        fractionalized transparency and automated dividend distributions are exactly what the modern
                        investor needs.</p>
                    <div class="ts-author">
                        <img src="{{ asset('assets/Frontend/image/🌟 Mach den ersten Schritt zu deinem Karriereerfolg! 🌟 Ein professionelles Bewerbungsfoto ist der S.jpeg') }}"
                            alt="Entrepreneur" class="ts-avatar">
                        <div class="ts-meta">
                            <strong>Elena K. Richards</strong>
                            <span>Tech Entrepreneur & Angel Investor</span>
                        </div>
                    </div>
                </div>

                <div data-aos="zoom-in" class="ts-card ts-animate" style="--ts-delay: 3">
                    <div class="ts-quote-icon">“</div>
                    <p class="ts-text">As a retiree focusing on wealth preservation, Nexuist’s Risk Management Protocols
                        give me the peace of mind I couldn't find elsewhere. Their multi-asset terminal is incredibly
                        intuitive.</p>
                    <div class="ts-author">
                        <img src="{{ asset('assets/Frontend/image/Office.jpeg') }}" alt="Private Investor"
                            class="ts-avatar">
                        <div class="ts-meta">
                            <strong>Dr. Robert Harrison</strong>
                            <span>Private Wealth Client</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ln-section">
        <div class="ln-wrapper">
            <header class="ln-header ln-animate">
                <span class="ln-tag">SUPPORTED PROTOCOLS</span>
                <h2 class="ln-title">The Digital Economy, Unified.</h2>
                <p class="ln-subtitle">Our infrastructure aggregates liquidity from top-tier digital assets, ensuring
                    deep market access and institutional-grade execution.</p>
            </header>

            <div class="ln-grid">
                <div class="ln-card ln-card-featured ln-animate" style="--ln-delay: 1">
                    <div class="ln-card-glow"></div>
                    <div class="ln-asset-info">
                        <img src="https://cryptologos.cc/logos/bitcoin-btc-logo.svg?v=025') }}" alt="BTC"
                            class="ln-logo">
                        <div class="ln-text">
                            <strong>Bitcoin</strong>
                            <span>The Digital Gold Standard</span>
                        </div>
                    </div>
                    <div class="ln-metrics">
                        <div class="ln-status"><span>Live Feed</span>
                            <div class="ln-pulse"></div>
                        </div>
                        <div class="ln-metric-view"></div>
                    </div>
                </div>

                <div class="ln-card ln-animate" style="--ln-delay: 2">
                    <div class="ln-asset-info">
                        <img src="https://cryptologos.cc/logos/ethereum-eth-logo.svg?v=025') }}" alt="ETH"
                            class="ln-logo">
                        <div class="ln-text">
                            <strong>Ethereum</strong>
                            <span>Programmable Money</span>
                        </div>
                    </div>
                    <div class="ln-metrics">
                        <div class="ln-status"><span>Aggregating</span>
                            <div class="ln-pulse ln-pulse-amber"></div>
                        </div>
                    </div>
                </div>

                <div class="ln-card ln-animate" style="--ln-delay: 3">
                    <div class="ln-asset-info">
                        <img src="https://cryptologos.cc/logos/dogecoin-doge-logo.svg?v=025') }}" alt="DOGE"
                            class="ln-logo">
                        <div class="ln-text">
                            <strong>Dogecoin</strong>
                            <span>Market Sentiment Driver</span>
                        </div>
                    </div>
                    <div class="ln-metrics">
                        <div class="ln-status"><span>Stable</span>
                            <div class="ln-pulse ln-pulse-amber"></div>
                        </div>
                    </div>
                </div>

                <div class="ln-card ln-animate" style="--ln-delay: 4">
                    <div class="ln-asset-info">
                        <img src="https://cryptologos.cc/logos/bitcoin-cash-bch-logo.svg?v=025') }}" alt="BCH"
                            class="ln-logo">
                        <div class="ln-text">
                            <strong>Bitcoin Cash</strong>
                            <span>Peer-to-Peer Electronic Cash</span>
                        </div>
                    </div>
                    <div class="ln-metrics">
                        <div class="ln-status"><span>Active</span>
                            <div class="ln-pulse"></div>
                        </div>
                    </div>
                </div>

                <div class="ln-card ln-animate" style="--ln-delay: 5">
                    <div class="ln-asset-info">
                        <img src="https://cryptologos.cc/logos/tether-usdt-logo.svg?v=025') }}" alt="USDT"
                            class="ln-logo">
                        <div class="ln-text">
                            <strong>Tether (USDT)</strong>
                            <span>Global Liquidity Buffer</span>
                        </div>
                    </div>
                    <div class="ln-metrics">
                        <div class="ln-status"><span>Stable 1:1</span>
                            <div class="ln-pulse ln-pulse-green"></div>
                        </div>
                    </div>
                </div>

                <div class="ln-card ln-animate" style="--ln-delay: 6">
                    <div class="ln-asset-info">
<img src="https://upload.wikimedia.org/wikipedia/commons/5/57/Binance_Logo.png"
    alt="BNB"
    class="ln-logo">                        <div class="ln-text">
                            <strong>BNB (Chain)</strong>
                            <span>Utility & Execution Layer</span>
                        </div>
                    </div>
                    <div class="ln-metrics">
                        <div class="ln-status"><span>Live API</span>
                            <div class="ln-pulse"></div>
                        </div>
                    </div>
                </div>

                <div class="ln-card ln-animate" style="--ln-delay: 7">
                    <div class="ln-asset-info">
                        <img src="https://cryptologos.cc/logos/litecoin-ltc-logo.svg?v=025') }}" alt="LTC"
                            class="ln-logo">
                        <div class="ln-text">
                            <strong>Litecoin</strong>
                            <span>The Silver to BTC’s Gold</span>
                        </div>
                    </div>
                    <div class="ln-metrics">
                        <div class="ln-status"><span>Active</span>
                            <div class="ln-pulse"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer sections starts here -->
    <footer class="remendy-footer-wrapper">
        <div class="footer-container">
            <div class="footer-brand-section">
                <div class="footer-logo">
                    <span class="logo-text">NEXUIST</span><span class="logo-accent">INVEST</span>
                </div>
                <p class="brand-description">
                    Elevating wealth management through institutional-grade technology. Trade global equities, digital
                    assets, and premium real estate from a single, unified interface.
                </p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="footer-links-grid">
                <div class="link-group">
                    <h3>Ecosystem</h3>
                    <a href="#">Asset Management</a>
                    <a href="#">Real Estate Portfolios</a>
                    <a href="#">Crypto Index</a>
                    <a href="#">Stock Trading</a>
                </div>
                <div class="link-group">
                    <h3>Company</h3>
                    <a href="#">Institutional</a>
                    <a href="#">Security & Trust</a>
                    <a href="#">Careers</a>
                    <a href="#">Contact</a>
                </div>
                <div class="link-group">
                    <h3>Support</h3>
                    <a href="#">Help Center</a>
                    <a href="#">API Documentation</a>
                    <a href="#">Fee Schedule</a>
                    <a href="#">Demo Account</a>
                </div>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="footer-bottom">
            <div class="platform-availability">
                <span class="status-dot"></span>
                <span class="avail-text">Systems Operational: Web, iOS, Android, Windows</span>
            </div>

            <div class="legal-warning">
                <p><strong>Risk Disclosure:</strong> Digital assets and CFDs involve significant risk of loss. The value
                    of investments in real estate and equities may fluctuate. Past performance is not indicative of
                    future results. Please ensure you fully understand the risks before engaging in trading activities.
                </p>
            </div>

            <div class="footer-legal-links">
                <span>&copy; 2026 Nexuist Invest. All Rights Reserved.</span>
                <div class="legal-nav">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Essential Library for shifting charts -->
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script src="{{ asset('assets/Frontend/js/explore.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>