// Preloader starts here
document.addEventListener("DOMContentLoaded", () => {
    const preloader = document.getElementById("fintech-preloader");
    const loadBar = document.getElementById("load-bar");
    const statusText = document.getElementById("status-text");

    const messages = [
        "Initializing encrypted connection...",
        "Fetching live market data...",
        "Securing wallet protocols...",
        "Synchronizing portfolio stats...",
        "Welcome to Nexuist"
    ];

    let progress = 0;
    let messageIndex = 0;

    // Simulate real loading behavior
    const interval = setInterval(() => {
        progress += Math.random() * 15; // Random jump for realism

        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);

            // Fade out the preloader
            setTimeout(() => {
                preloader.classList.add("preloader-hidden");
                // Optional: Remove from DOM after transition
                setTimeout(() => preloader.remove(), 600);
            }, 500);
        }

        // Update bar and text
        loadBar.style.width = progress + "%";

        // Update status message based on progress
        if (progress > (messageIndex + 1) * 20 && messageIndex < messages.length - 1) {
            messageIndex++;
            statusText.innerText = messages[messageIndex];
        }
    }, 150);
});

document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Mobile Sidebar Toggle ---
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('show');
        });
    }

    // --- 2. Sidebar Submenu Toggle (Investment Plans) ---
    const investPlansBtn = document.getElementById('investPlansBtn');
    const investPlansMenu = document.getElementById('investPlansMenu');

    if (investPlansBtn && investPlansMenu) {
        investPlansBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent standard link jump
            investPlansMenu.classList.toggle('show');
            // Rotate Arrow
            const arrow = investPlansBtn.querySelector('.arrow');
            if (investPlansMenu.classList.contains('show')) {
                arrow.style.transform = 'rotate(180deg)';
            } else {
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    }

    // --- 3. Header Dropdowns (Notifications & Profile) ---
    function setupDropdown(btnId, menuId) {
        const btn = document.getElementById(btnId);
        const menu = document.getElementById(menuId);

        if (btn && menu) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();

                // Close all other dropdowns first
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m.id !== menuId) m.classList.remove('show');
                });

                menu.classList.toggle('show');
            });
        }
    }

    setupDropdown('notifBtn', 'notifMenu');
    setupDropdown('profileBtn', 'profileMenu');

    // Close Dropdowns & Sidebar on clicking outside
    document.addEventListener('click', (e) => {
        // Close Dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });

        // Close Sidebar on Mobile if clicking outside
        if (window.innerWidth <= 900 && sidebar.classList.contains('show')) {
            if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        }
    });

    // Prevent clicks inside dropdown from closing it
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });


    // --- 4. Toggle Account Balance Visibility ---
    const toggleBalanceBtn = document.getElementById('toggleBalanceBtn');
    const balanceAmount = document.getElementById('balanceAmount');
    const eyeIcon = document.getElementById('eyeIcon');
    let isHidden = false;

    if (toggleBalanceBtn && balanceAmount) {
        toggleBalanceBtn.addEventListener('click', () => {
            isHidden = !isHidden;
            if (isHidden) {
                balanceAmount.textContent = '*******';
                eyeIcon.setAttribute('data-icon', 'ri:eye-off-line');
            } else {
                balanceAmount.textContent = '$0.00';
                eyeIcon.setAttribute('data-icon', 'ri:eye-line');
            }
        });
    }

    // --- 5. Close Promo Card ---
    const closePromoBtn = document.getElementById('closePromoBtn');
    const promoCard = document.getElementById('promoCard');

    if (closePromoBtn && promoCard) {
        closePromoBtn.addEventListener('click', () => {
            promoCard.style.display = 'none';
        });
    }

});


const qtDropdownBtn = document.getElementById("qtDropdownBtn");
const qtDropdownMenu = document.getElementById("qtDropdownMenu");

qtDropdownBtn.addEventListener("click", () => {

    qtDropdownMenu.classList.toggle("active");
    qtDropdownBtn.classList.toggle("active");

});

window.addEventListener("click", (e) => {

    if (
        !qtDropdownBtn.contains(e.target) &&
        !qtDropdownMenu.contains(e.target)
    ) {
        qtDropdownMenu.classList.remove("active");
        qtDropdownBtn.classList.remove("active");
    }

});

const acmVerifyBtn = document.getElementById("acmVerifyBtn");
const acmVerifyMenu = document.getElementById("acmVerifyMenu");

acmVerifyBtn.addEventListener("click", () => {

    acmVerifyBtn.classList.toggle("active");

    acmVerifyMenu.classList.toggle("active");

});


// Main section starts here
const allAssets = [
    // CRYPTO
    { symbol: "BTC/USD", name: "Bitcoin", cat: "crypto", price: "64,231.50", change: "+2.4%", trend: "up" },
    { symbol: "ETH/USD", name: "Ethereum", cat: "crypto", price: "3,450.12", change: "+1.8%", trend: "up" },
    { symbol: "SOL/USD", name: "Solana", cat: "crypto", price: "145.30", change: "+12.4%", trend: "up" },
    { symbol: "BNB/USD", name: "Binance Coin", cat: "crypto", price: "590.20", change: "+0.5%", trend: "up" },
    { symbol: "DOGE/USD", name: "Dogecoin", cat: "crypto", price: "0.162", change: "-5.1%", trend: "down" },

    // STOCKS
    { symbol: "AAPL", name: "Apple Inc.", cat: "stocks", price: "189.45", change: "+1.2%", trend: "up" },
    { symbol: "TSLA", name: "Tesla Inc.", cat: "stocks", price: "172.10", change: "+7.1%", trend: "up" },
    { symbol: "NVDA", name: "NVIDIA Corp.", cat: "stocks", price: "890.12", change: "+5.2%", trend: "up" },
    { symbol: "META", name: "Meta Platforms", cat: "stocks", price: "485.30", change: "-1.9%", trend: "down" },

    // FOREX
    { symbol: "EUR/USD", name: "Euro / US Dollar", cat: "forex", price: "1.0845", change: "+0.1%", trend: "up" },
    { symbol: "GBP/USD", name: "Pound / US Dollar", cat: "forex", price: "1.2640", change: "-3.2%", trend: "down" },

    // COMMODITIES
    { symbol: "XAU/USD", name: "Gold", cat: "commodities", price: "2,341.10", change: "+0.5%", trend: "up" },
    { symbol: "Crude Oil", name: "West Texas Oil", cat: "commodities", price: "78.40", change: "-2.8%", trend: "down" }
];

let currentFilter = 'all';

function renderAssets(filter = 'all', search = '') {
    const list = document.getElementById('marketList');
    list.innerHTML = ""; // Clear current list

    const filtered = allAssets.filter(item => {
        const matchesTab = filter === 'all' || item.cat === filter;
        const matchesSearch = item.symbol.toLowerCase().includes(search.toLowerCase()) ||
            item.name.toLowerCase().includes(search.toLowerCase());
        return matchesTab && matchesSearch;
    });

    filtered.forEach(asset => {
        const trendIcon = asset.trend === 'up' ?
            'https://s3.tradingview.com/snapshots/c/chart_thumb.png' :
            'https://s3.tradingview.com/snapshots/c/chart_thumb.png'; // Use a red-tinted version if available

        list.innerHTML += `
            <div class="market-row">
                <div>
                    <span style="font-weight:bold; color:white;">${asset.symbol}</span><br>
                    <small style="color:#848e9c;">${asset.name}</small>
                </div>
                <div style="color:white; font-weight:600;">$${asset.price}</div>
                <div class="${asset.trend}">${asset.change}</div>
                <div><img src="${trendIcon}" style="width:50px; filter:${asset.trend === 'up' ? 'hue-rotate(90deg)' : 'hue-rotate(340deg) grayscale(0.5)'};"></div>
                <div><button class="btn-trade" onclick="launchTerminal('${asset.symbol}')">Trade</button></div>
            </div>
        `;
    });
}

// Filter by Tab
function filterCategory(cat, event) {
    currentFilter = cat;
    // Update Active Button UI
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    renderAssets(cat, document.getElementById('assetSearch').value);
}

// Search Logic
function searchAssets() {
    const searchValue = document.getElementById('assetSearch').value;
    renderAssets(currentFilter, searchValue);
}

// Initial Load
renderAssets();

// This function handles opening the professional chart
function launchTerminal(symbol) {
    const modal = document.getElementById('tradingTerminal');
    const title = document.getElementById('orderTitle');

    if (modal && title) {
        modal.style.display = 'block';
        title.innerText = symbol;

        // Clean up symbol for TradingView (remove slashes if they exist)
        const cleanSymbol = symbol.replace('/', '');

        // Initialize the TradingView Widget
        new TradingView.widget({
            "autosize": true,
            "symbol": cleanSymbol,
            "interval": "D",
            "timezone": "Etc/UTC",
            "theme": "dark",
            "style": "1", // 1 = Candlestick
            "locale": "en",
            "container_id": "tradingview_widget",
            "hide_side_toolbar": false,
            "allow_symbol_change": true,
            "details": true,
            "hotlist": true,
            "calendar": true,
            "show_popup_button": true,
            "popup_width": "1000",
            "popup_height": "650"
        });
    } else {
        console.error("Trading modal elements not found! Check your HTML IDs.");
    }
}

// Function to close the chart
function closeTerminal() {
    document.getElementById('tradingTerminal').style.display = 'none';
}

function renderAssets(filter = 'all', search = '') {
    const list = document.getElementById('marketList');
    list.innerHTML = "";

    const filtered = allAssets.filter(item => {
        const matchesTab = filter === 'all' || item.cat === filter;
        const matchesSearch = item.symbol.toLowerCase().includes(search.toLowerCase()) ||
            item.name.toLowerCase().includes(search.toLowerCase());
        return matchesTab && matchesSearch;
    });

    filtered.forEach(asset => {
        // Instead of a broken image, we create a beautiful CSS trend line
        const isUp = asset.trend === 'up';
        const color = isUp ? '#0ecb81' : '#f6465d';

        list.innerHTML += `
            <div class="market-row">
                <div>
                    <span style="font-weight:bold; color:white; font-size:16px;">${asset.symbol}</span><br>
                    <small style="color:#848e9c;">${asset.name}</small>
                </div>
                <div style="color:white; font-weight:600;">$${asset.price}</div>
                <div class="${asset.trend}">${asset.change}</div>
                
                <!-- NEW TREND GRAPH (No more broken images) -->
                <div>
                    <svg width="80" height="30" viewBox="0 0 80 30" fill="none">
                        <path d="${isUp ? 'M0 25 L20 20 L40 22 L60 10 L80 5' : 'M0 5 L20 15 L40 12 L60 25 L80 28'}" 
                              stroke="${color}" stroke-width="2" stroke-linecap="round"/>
                        <path d="${isUp ? 'M0 25 L20 20 L40 22 L60 10 L80 5 V30 H0 Z' : 'M0 5 L20 15 L40 12 L60 25 L80 28 V30 H0 Z'}" 
                              fill="url(#grad-${asset.trend})" opacity="0.2"/>
                        <defs>
                            <linearGradient id="grad-up" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#0ecb81"/>
                                <stop offset="100%" stop-color="transparent"/>
                            </linearGradient>
                            <linearGradient id="grad-down" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#f6465d"/>
                                <stop offset="100%" stop-color="transparent"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>

                <div><button class="btn-trade" onclick="launchTerminal('${asset.symbol}')">Trade</button></div>
            </div>
        `;
    });
}

// 1. Handle switching between Buy and Sell tabs in the Terminal
document.querySelector('.tab-buy').addEventListener('click', function () {
    this.style.background = '#0ecb81'; // Green
    this.style.color = 'white';
    document.querySelector('.tab-sell').style.background = '#1e2329'; // Dark
    document.querySelector('.tab-sell').style.color = '#848e9c';
    document.querySelector('.tab-buy-final').innerText = 'PLACE BUY ORDER';
    document.querySelector('.tab-buy-final').style.background = '#0ecb81';
});

document.querySelector('.tab-sell').addEventListener('click', function () {
    this.style.background = '#f6465d'; // Red
    this.style.color = 'white';
    document.querySelector('.tab-buy').style.background = '#1e2329'; // Dark
    document.querySelector('.tab-buy').style.color = '#848e9c';
    // Update the big button at the bottom to say Sell
    document.querySelector('.tab-buy-final').innerText = 'PLACE SELL ORDER';
    document.querySelector('.tab-buy-final').style.background = '#f6465d';
});

// 2. Handle the "Place Order" button click - submit to backend
async function handlePlaceOrder() {
    const symbol = document.getElementById('orderTitle').innerText;
    const amount = Number(document.querySelector('.form-field input[type="number"]').value);
    const btnText = document.querySelector('.tab-buy-final').innerText || '';
    const type = btnText.includes('SELL') ? 'SELL' : 'BUY';

    if (!amount || amount <= 0) {
        alert('Please enter a valid amount.');
        return;
    }

    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    try {
        const res = await fetch('/api/trades', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ symbol, amount, type })
        });

        const json = await res.json();
        if (!res.ok || !json.success) {
            alert(json.message || 'Trade failed.');
            return;
        }

        // Show Success Modal (leave terminal open until user closes)
        document.getElementById('successMessage').innerText = `Your order for ${symbol} has been executed.`;
        document.getElementById('orderSuccessModal').style.display = 'flex';

    } catch (err) {
        console.error('Trade submission error', err);
        alert('Unable to submit trade. Try again.');
    }
}

function setVal(percent) {
    const balance = 1245.89; // Replace this with your actual balance variable later
    const amountInput = document.querySelector('.form-field input[type="number"]');

    const calculatedAmount = (balance * (percent / 100)).toFixed(2);
    amountInput.value = calculatedAmount;
}

// --- 1. SUCCESS MODAL LOGIC ---
// (handled above) show success modal after backend confirmation

function closeSuccessModal() {
    document.getElementById('orderSuccessModal').style.display = 'none';
    closeTerminal(); // Closes the chart too
}

// --- 2. REFRESH PERSISTENCE LOGIC ---

// Override the launchTerminal to save the state
const originalLaunchTerminal = launchTerminal;
launchTerminal = function (symbol) {
    originalLaunchTerminal(symbol);
    // Save to browser memory
    localStorage.setItem('nexuist_last_symbol', symbol);
    localStorage.setItem('nexuist_terminal_open', 'true');
};

// Override closeTerminal to clear state
const originalCloseTerminal = closeTerminal;
closeTerminal = function () {
    originalCloseTerminal();
    localStorage.removeItem('nexuist_terminal_open');
    localStorage.removeItem('nexuist_last_symbol');
};

// Check on page load if we should be in a trade
window.addEventListener('load', () => {
    const isTerminalOpen = localStorage.getItem('nexuist_terminal_open');
    const lastSymbol = localStorage.getItem('nexuist_last_symbol');

    if (isTerminalOpen === 'true' && lastSymbol) {
        // Wait a tiny bit for TradingView library to be ready
        setTimeout(() => {
            launchTerminal(lastSymbol);
        }, 500);
    }
});