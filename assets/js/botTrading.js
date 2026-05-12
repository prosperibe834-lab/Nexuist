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
const bots = [

    {
        name: "ForexMaster Pro",
        cat: "forex",
        roi: "0.80-2.50%",
        days: 30,
        risk: "Moderate",
        symbol: "FX:EURUSD",
        desc: "Advanced forex AI focused on EUR/USD liquidity movements.",
        icon: "bx-trending-up"
    },

    {
        name: "CryptoGain Elite",
        cat: "crypto",
        roi: "1.20-4.50%",
        days: 45,
        risk: "High",
        symbol: "BINANCE:BTCUSDT",
        desc: "High-frequency crypto bot using AI momentum detection.",
        icon: "bxl-bitcoin"
    },

    {
        name: "StockTrader AI",
        cat: "stocks",
        roi: "0.50-2.00%",
        days: 60,
        risk: "Low",
        symbol: "NASDAQ:AAPL",
        desc: "AI stock trader optimized for large-cap tech equities.",
        icon: "bx-line-chart"
    },

    {
        name: "GoldRush Bot",
        cat: "commodities",
        roi: "1.00-3.00%",
        days: 15,
        risk: "Moderate",
        symbol: "OANDA:XAUUSD",
        desc: "Institutional gold trading strategy for commodity markets.",
        icon: "bx-diamond"
    },

    {
        name: "Ethereum Sniper",
        cat: "crypto",
        roi: "2.00-5.20%",
        days: 20,
        risk: "High",
        symbol: "BINANCE:ETHUSDT",
        desc: "Ethereum volatility AI trading engine.",
        icon: "bxl-ethereum"
    },

    {
        name: "Nasdaq Hunter",
        cat: "stocks",
        roi: "0.70-2.40%",
        days: 40,
        risk: "Moderate",
        symbol: "NASDAQ:TSLA",
        desc: "AI bot focused on Nasdaq momentum trades.",
        icon: "bx-bar-chart"

    },

    {
        name: "Ethereum Sniper",
        cat: "crypto",
        roi: "1.80-5.40%",
        days: 25,
        risk: "High",
        symbol: "BINANCE:ETHUSDT",
        desc: "Advanced Ethereum AI bot using volatility breakout strategies.",
        icon: "bxl-ethereum"
    },

    {
        name: "Forex Titan",
        cat: "forex",
        roi: "0.90-2.80%",
        days: 35,
        risk: "Moderate",
        symbol: "FX:GBPUSD",
        desc: "Institutional forex trading AI focused on GBP/USD liquidity zones.",
        icon: "bx-trending-up"
    },

    {
        name: "OilFlow AI",
        cat: "commodities",
        roi: "1.10-3.60%",
        days: 20,
        risk: "Moderate",
        symbol: "TVC:USOIL",
        desc: "AI-powered crude oil trading system using macroeconomic momentum.",
        icon: "bx-droplet"
    },

    {
        name: "S&P Alpha Bot",
        cat: "stocks",
        roi: "0.60-2.10%",
        days: 50,
        risk: "Low",
        symbol: "SP:SPX",
        desc: "Smart AI strategy tracking S&P 500 institutional flows.",
        icon: "bx-line-chart"
    },

    {
        name: "Bitcoin Velocity",
        cat: "crypto",
        roi: "2.20-6.00%",
        days: 18,
        risk: "High",
        symbol: "BINANCE:BTCUSDT",
        desc: "Ultra-fast Bitcoin AI trader optimized for breakout scalping.",
        icon: "bxl-bitcoin"
    },

    {
        name: "SilverEdge Bot",
        cat: "commodities",
        roi: "0.85-2.90%",
        days: 28,
        risk: "Moderate",
        symbol: "OANDA:XAGUSD",
        desc: "Silver market AI designed for safe commodity accumulation.",
        icon: "bx-medal"
    },

    {
        name: "Tesla Quantum AI",
        cat: "stocks",
        roi: "1.00-3.40%",
        days: 32,
        risk: "High",
        symbol: "NASDAQ:TSLA",
        desc: "AI stock engine specialized in Tesla momentum trading.",
        icon: "bx-bar-chart-alt"
    },

    {
        name: "EuroWave FX",
        cat: "forex",
        roi: "0.75-2.20%",
        days: 45,
        risk: "Low",
        symbol: "FX:EURJPY",
        desc: "Forex AI bot analyzing Euro-Yen institutional movements.",
        icon: "bx-transfer-alt"
    },

];

// Generate 18 bots dynamically
const fullBotList = bots;



function renderBots(filter = 'all') {
    const grid = document.getElementById('botGrid');
    grid.innerHTML = '';

    fullBotList.forEach(bot => {
        if (filter !== 'all' && bot.cat !== filter) return;

        const card = document.createElement('div');
        card.className = 'bot-card';
        card.innerHTML = `
            <span class="status-chip">Verifying</span>
            <h3><i class='bx ${bot.icon}'></i> ${bot.name}</h3>
            <div class="card-stats">
                <div><small>Daily ROI</small><br><strong>${bot.roi}</strong></div>
                <div><small>Duration</small><br><strong>${bot.days} Days</strong></div>
            </div>
            <button class="btn-invest" onclick="openTerminal('${bot.name}', '${bot.cat}')">Details & Invest →</button>
        `;
        grid.appendChild(card);
    });
}

function openTerminal(name) {

    const bot = fullBotList.find(b => b.name === name);

    if (!bot) return;

    // Update terminal details
    document.getElementById('selectedBotName').innerText =
        bot.name;

    document.getElementById('selectedBotDesc').innerText =
        bot.desc;

    document.getElementById('selectedBotROI').innerText =
        bot.roi;

    document.getElementById('selectedBotDays').innerText =
        bot.days + " Days";

    document.getElementById('selectedBotRisk').innerText =
        bot.risk;

    // Update TradingView Chart
    document.getElementById('tradingview_chart').innerHTML = "";

    new TradingView.widget({
        container_id: "tradingview_chart",
        width: "100%",
        height: 320,
        symbol: bot.symbol,
        interval: "15",
        timezone: "Etc/UTC",
        theme: "dark",
        style: "1",
        locale: "en",
        toolbar_bg: "#0f172a",
        enable_publishing: false,
        hide_top_toolbar: true,
        save_image: false
    });

    showPage('trading-terminal-page');
}

function showPage(pageId) {
    document.getElementById('bot-hub-page').classList.add('hidden');
    document.getElementById('trading-terminal-page').classList.add('hidden');
    document.getElementById(pageId).classList.remove('hidden');
    window.scrollTo(0, 0);
}

// Filter Clicks
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.filter-btn.active').classList.remove('active');
        btn.classList.add('active');
        renderBots(btn.dataset.filter);
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggleMarketBtn');
    const extraAssets = document.getElementById('extraMarketAssets');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            extraAssets.classList.toggle('show');
            this.classList.toggle('active');

            const btnText = this.querySelector('.btn-text');
            btnText.innerText = extraAssets.classList.contains('show') ? "Show Less" : "View Full Market";
        });
    }
});

document.getElementById('viewMoreBtn').addEventListener('click', function () {
    const extraContent = document.getElementById('extraAssets');

    // Toggle the 'show' class to expand/collapse
    extraContent.classList.toggle('show');

    // Change button text based on state
    if (extraContent.classList.contains('show')) {
        this.textContent = "Show Less";
    } else {
        this.textContent = "View Full Market";
    }
});



document.addEventListener("DOMContentLoaded", () => {

    const deployBtn = document.getElementById("deployBotBtn");

    if (deployBtn) {

        deployBtn.addEventListener("click", () => {

            const amount =
                document.getElementById("investmentAmount").value || 200;

            const botData = {

                name:
                    document.getElementById("selectedBotName").innerText,

                desc:
                    document.getElementById("selectedBotDesc").innerText,

                roi:
                    document.getElementById("selectedBotROI").innerText,

                duration:
                    document.getElementById("selectedBotDays").innerText,

                risk:
                    document.getElementById("selectedBotRisk").innerText,

                amount:
                    amount

            };

            // Save bot data
            localStorage.setItem(
                "activeBotInvestment",
                JSON.stringify(botData)
            );

            // Redirect
            window.location.href = "deploybot.html";

        });

    }

});


// Initialize
renderBots();

window.onload = function () {

    const deployBtn =
        document.getElementById("deployBotBtn");

    console.log(deployBtn);

    if (!deployBtn) {
        console.error("Deploy button not found");
        return;
    }

    deployBtn.onclick = function () {

        console.log("Deploy button clicked");

        const amountInput =
            document.getElementById("investmentAmount");

        const botData = {

            name:
                document.getElementById("selectedBotName")?.innerText || "",

            desc:
                document.getElementById("selectedBotDesc")?.innerText || "",

            roi:
                document.getElementById("selectedBotROI")?.innerText || "",

            duration:
                document.getElementById("selectedBotDays")?.innerText || "",

            risk:
                document.getElementById("selectedBotRisk")?.innerText || "",

            amount:
                amountInput ? amountInput.value : 200

        };

        localStorage.setItem(
            "activeBotInvestment",
            JSON.stringify(botData)
        );

        window.location.href = "./deploybot.html";

    };

};