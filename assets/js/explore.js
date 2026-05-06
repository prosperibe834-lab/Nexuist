document.addEventListener('DOMContentLoaded', () => {

    // Core Navigation Elements
    const navbar = document.getElementById('navbar');
    const menuToggle = document.getElementById('mobile-menu');
    const navMenu = document.getElementById('nav-menu');

    // Mobile Breakpoint (must match CSS)
    const MOBILE_BP = 1024;

    /**
     * 1. THE MOBILE MENU TOGGLE
     */
    menuToggle.addEventListener('click', () => {
        // Toggle 'active' state on the toggle button
        menuToggle.classList.toggle('is-active');
        // Toggle 'open' state on the menu container
        navMenu.classList.toggle('is-open');
        // Toggle class on body/navbar to handle burger animation and scroll lock
        navbar.classList.toggle('menu-is-active');

        const isOpen = navMenu.classList.contains('is-open');
        menuToggle.setAttribute('aria-expanded', isOpen);

        // Prevent body from scrolling when menu is open
        document.body.style.overflow = isOpen ? 'hidden' : 'initial';
    });

    /**
     * 2. MOBILE-SPECIFIC DROPDOWN HANDLER
     * Ensures tapping opens the dropdown instead of navigating.
     */
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        // The main link (.nav-link) must be the click trigger
        const triggerLink = dropdown.querySelector('.nav-link');

        triggerLink.addEventListener('click', (event) => {

            // IF we are in mobile view...
            if (window.innerWidth <= MOBILE_BP) {
                // ...Prevent the main link from navigating immediately
                event.preventDefault();

                // --- Premium behavior: Close other open dropdowns first ---
                dropdowns.forEach(other => {
                    if (other !== dropdown) other.classList.remove('is-expanded');
                });

                // Toggle visibility on the current dropdown
                const isExpanding = dropdown.classList.toggle('is-expanded');

                // Option: If we actually want to navigate, we need a 
                // different mechanism or just treat these as folders.
                // Currently, this logic treats parents as simple folders.
            }
        });
    });

    /**
     * 3. UX FINISHING TOUCHES
     */
    // If the window is resized larger while the mobile menu is open, clean up states.
    window.addEventListener('resize', () => {
        if (window.innerWidth > MOBILE_BP) {
            navMenu.classList.remove('is-open');
            navbar.classList.remove('menu-is-active');
            document.body.style.overflow = 'initial';
        }
    });

    // Option: Close mobile menu if a direct link (non-dropdown) is clicked.
    const directLinks = document.querySelectorAll('.nav-menu > .nav-item > .nav-link:not(.dropdown .nav-link)');
    directLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= MOBILE_BP) {
                navMenu.classList.remove('is-open');
                navbar.classList.remove('menu-is-active');
                document.body.style.overflow = 'initial';
            }
        });
    });
});

////////////////////////////////////////////////////////////
// ✅ ACTIVE NAV LINK + MOBILE FIX (PASTE AT BOTTOM)
////////////////////////////////////////////////////////////

document.addEventListener('DOMContentLoaded', () => {

    // ===== ACTIVE LINK =====
    const currentPage = window.location.pathname.split("/").pop();

    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        const linkPage = link.getAttribute('href');

        if (linkPage === currentPage) {
            link.classList.add('active');

            // Highlight dropdown parent too
            const parentDropdown = link.closest('.dropdown');
            if (parentDropdown) {
                parentDropdown.classList.add('active');
            }
        }
    });

    // Fix for homepage (index.html)
    if (currentPage === "") {
        const homeLink = document.querySelector('a[href="index.html"]');
        if (homeLink) homeLink.classList.add('active');
    }

});


// Global Trade starts here
new TradingView.widget({
    "autosize": true,
    "symbol": "BITSTAMP:BTCUSD",
    "interval": "D",
    "timezone": "Etc/UTC",
    "theme": "dark",
    "style": "1", // Candlesticks
    "locale": "en",
    "toolbar_bg": "#131722",
    "enable_publishing": false,
    "hide_top_toolbar": false,
    "hide_legend": false,
    "save_image": false,
    "container_id": "tradingview_widget",
    "studies": [
        "RSI@tv-basicstudies",
        "MACD@tv-basicstudies"
    ],
    "colors": {
        "upColor": "#26a69a",
        "downColor": "#ef5350",
        "borderUpColor": "#26a69a",
        "borderDownColor": "#ef5350",
        "wickUpColor": "#26a69a",
        "wickDownColor": "#ef5350"
    }
});





// Market Analysis & Insights starts here

const injectTradingView = () => {
    const container = document.getElementById('tradingview-wrapper');
    if (!container) return;

    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js';
    script.async = true;

    // This is where your design settings go
    script.innerHTML = JSON.stringify({
        "colorTheme": "dark",
        "dateRange": "12M",
        "showChart": true,
        "locale": "en",
        "width": "100%",
        "height": "100%",
        "largeChartUrl": "",
        "isTransparent": true,
        "showSymbolLogo": true,
        "showFloatingTooltip": true,
        "gridLineColor": "rgba(41, 98, 255, 0)",
        "plotLineColorGrowing": "rgba(0, 255, 136, 1)",
        "plotLineColorFalling": "rgba(255, 51, 85, 1)",
        "topColor": "rgba(0, 112, 243, 0.12)",
        "bottomColor": "rgba(0, 112, 243, 0)",
        "tabs": [
            {
                "title": "Indices",
                "symbols": [
                    { "s": "FOREXCOM:SPX500", "d": "S&P 500" },
                    { "s": "NASDAQ:IXIC", "d": "Nasdaq 100" },
                    { "s": "FOREXCOM:DJI", "d": "Dow 30" },
                    { "s": "INDEX:NKY", "d": "Nikkei 225" },
                    { "s": "INDEX:DEU40", "d": "DAX Index" }
                ]
            },
            {
                "title": "Futures",
                "symbols": [
                    { "s": "CME_MINI:ES1!", "d": "S&P 500" },
                    { "s": "CME:6E1!", "d": "Euro" },
                    { "s": "COMEX:GC1!", "d": "Gold" },
                    { "s": "NYMEX:CL1!", "d": "Crude Oil" }
                ]
            },
            {
                "title": "Bonds",
                "symbols": [
                    { "s": "CME:GE1!", "d": "Eurodollar" },
                    { "s": "CBOT:ZB1!", "d": "T-Bond" },
                    { "s": "CBOT:ZN1!", "d": "10Y Note" }
                ]
            },
            {
                "title": "Forex",
                "symbols": [
                    { "s": "FX:EURUSD", "d": "EUR/USD" },
                    { "s": "FX:GBPUSD", "d": "GBP/USD" },
                    { "s": "FX:USDJPY", "d": "USD/JPY" },
                    { "s": "FX:AUDUSD", "d": "AUD/USD" }
                ]
            }
        ]
    });

    container.appendChild(script);
};

// Run the function when the page loads
document.addEventListener('DOMContentLoaded', injectTradingView);


// Diverse Trading Products starts here
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.ft-product-card');
    
    // Set staggered delays for the entrance animation
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.15}s`;
    });

    // Optional: Add a subtle tilt effect or hover tracking
    cards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
});


// Popular Asset Class Cryptocurrency Trading starts here 