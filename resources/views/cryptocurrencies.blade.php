<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remendy Invest | Pro Markets</title>
    <!-- Modern, clean font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Link to our clean CSS -->
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/cryptocurrencies.css') }}">
</head>

<body>

    <header class="navbar" id="navbar">
        <nav class="nav-container">
            <!-- Logo - Using text to keep it crisp -->
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="assets/image/mylog.jpeg') }}" alt="Remendy Invest Logo" class="logo-img">
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
                        <li><a class="active" href="/cryptocurrencies">Cryptocurrencies</a></li>
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

    <script src="{{ asset('assets/Frontend/js/cryptocurrencies.js') }}"></script>
</body>

</html>