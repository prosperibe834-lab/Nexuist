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


// Tighter Spreads. Faster Execution starts here
async function fetchMarketData() {
    const tableBody = document.getElementById('market-body');
    const url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin,ethereum,solana,cardano&order=market_cap_desc&per_page=4&page=1&sparkline=false';

    try {
        const response = await fetch(url);
        const data = await response.json();
        
        tableBody.innerHTML = ''; // Clear loading state

        data.forEach(coin => {
            const priceChange = coin.price_change_percentage_24h.toFixed(2);
            const changeClass = priceChange >= 0 ? 'ft-price-up' : 'ft-price-down';
            const changeSymbol = priceChange >= 0 ? '↑' : '↓';

            const row = `
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <img src="${coin.image}" width="24" height="24">
                            <strong>${coin.name}</strong> <span style="color:var(--text-gray); font-size:12px;">${coin.symbol.toUpperCase()}</span>
                        </div>
                    </td>
                    <td>$${coin.current_price.toLocaleString()}</td>
                    <td class="${changeClass}">${changeSymbol} ${Math.abs(priceChange)}%</td>
                    <td>$${(coin.market_cap / 1e9).toFixed(2)}B</td>
                    <td class="ft-hide-mobile">$${(coin.total_volume / 1e6).toFixed(0)}M</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    } catch (error) {
        tableBody.innerHTML = '<tr><td colspan="5" style="color:var(--accent-red)">Failed to sync market data. Please refresh.</td></tr>';
    }
}

// Initial fetch and set interval for every 60 seconds
fetchMarketData();
setInterval(fetchMarketData, 60000);


// Copy Professional Traders starts here
document.addEventListener("DOMContentLoaded", function() {
    
    // Select all elements that have the 'st-animate' class
    const animElements = document.querySelectorAll(".st-animate");

    // Configure the IntersectionObserver to detect when an element is visible
    const observerOptions = {
        root: null, // Use the viewport as the container
        rootMargin: "0px",
        threshold: 0.15 // Trigger when 15% of the element is visible
    };

    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add the active class to start the animation
                entry.target.classList.add("active");
                // Stop observing this element after it has animated in
                observer.unobserve(entry.target);
            }
        });
    };

    // Initialize the observer
    const animationObserver = new IntersectionObserver(observerCallback, observerOptions);

    // Tell the observer to watch each element
    animElements.forEach(el => {
        animationObserver.observe(el);
    });
});


// advanced charting tools starts here
document.addEventListener("DOMContentLoaded", function() {
    // Animation Trigger
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.2 });

    document.querySelectorAll('.at-animate').forEach(el => observer.observe(el));

    // Simple Professional Chart Drawing
    const canvas = document.getElementById('at-live-chart');
    if(canvas) {
        const ctx = canvas.getContext('2d');
        canvas.width = canvas.parentElement.offsetWidth;
        canvas.height = 350;

        function drawChart() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.beginPath();
            ctx.strokeStyle = '#0070f3';
            ctx.lineWidth = 3;
            ctx.moveTo(0, 200);

            for (let i = 0; i < canvas.width; i += 20) {
                const y = 150 + Math.sin(i * 0.05) * 40 + Math.random() * 30;
                ctx.lineTo(i, y);
            }
            ctx.stroke();

            // Gradient Fill
            ctx.lineTo(canvas.width, canvas.height);
            ctx.lineTo(0, canvas.height);
            const grad = ctx.createLinearGradient(0, 0, 0, 400);
            grad.addColorStop(0, 'rgba(0, 112, 243, 0.2)');
            grad.addColorStop(1, 'transparent');
            ctx.fillStyle = grad;
            ctx.fill();
        }
        drawChart();
    }
});


// why you should trade with us starts here
document.addEventListener("DOMContentLoaded", () => {
    const observerOptions = { threshold: 0.2 };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                
                // If it's the stats bar, trigger the counters
                if (entry.target.classList.contains('nx-stats-bar')) {
                    startCounters();
                }
            }
        });
    }, observerOptions);

    document.querySelectorAll('.nx-animate').forEach(el => observer.observe(el));

    function startCounters() {
        const counters = document.querySelectorAll('.nx-counter');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const increment = target / 50; // Speed of counting

            const updateCount = () => {
                const count = +counter.innerText;
                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 30);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    }
});


// how we work starts here
document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.sp-animate').forEach(el => observer.observe(el));
});


// Trade What You Want, When You Want starts here
document.addEventListener("DOMContentLoaded", function() {
    
    // Select all elements that should animate in
    const animElements = document.querySelectorAll(".dm-animate");

    // Configure the observer for detection
    const observerOptions = {
        root: null, // Use the viewport
        rootMargin: "0px",
        threshold: 0.15 // Trigger when 15% of the element is visible
    };

    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add the active class to trigger CSS animation
                entry.target.classList.add("active");
                // Stop observing after it has animated in once
                observer.unobserve(entry.target);
            }
        });
    };

    // Initialize the observer
    const animationObserver = new IntersectionObserver(observerCallback, observerOptions);

    // Observe each element
    animElements.forEach(el => {
        animationObserver.observe(el);
    });
});


// Start Trading with Nexuist starts here
document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.cs-animate').forEach((el, index) => {
        // Apply slight delay manually if not using CSS variables
        el.style.transitionDelay = `${index * 0.1}s`;
        observer.observe(el);
    });
});


// Testimonials starts here
document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.ts-animate').forEach((el, index) => {
        el.style.transitionDelay = `${index * 0.15}s`;
        observer.observe(el);
    });
});