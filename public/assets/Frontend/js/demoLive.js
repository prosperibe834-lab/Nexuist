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

    if(
        !qtDropdownBtn.contains(e.target) &&
        !qtDropdownMenu.contains(e.target)
    ){
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
document.addEventListener("DOMContentLoaded", () => {
    
    // --- TOP 25 ACTIVE FINANCIAL ASSETS ARCHITECTURE ARRAY ---
    const financialInstrumentsData = [
        { id: "btc", symbol: "BTC/USD", name: "Bitcoin", category: "crypto", price: 71438.00, change: "+1.38%", changePos: true, cap: "$1.41T", high: "$72,100", low: "$70,250", vol: "$24.8B", icon: "bx bx-bitcoin" },
        { id: "eth", symbol: "ETH/USD", name: "Ethereum", category: "crypto", price: 3387.20, change: "+1.05%", changePos: true, cap: "$406.2M", high: "$3,450", low: "$3,310", vol: "$14.2B", icon: "bx bx-coin" },
        { id: "sol", symbol: "SOL/USD", name: "Solana", category: "crypto", price: 183.50, change: "+1.88%", changePos: true, cap: "$81.9B", high: "$186", low: "$178", vol: "$3.5B", icon: "bx bx-cube-alt" },
        { id: "xrp", symbol: "XRP/USD", name: "Ripple", category: "crypto", price: 0.58, change: "-0.45%", changePos: false, cap: "$32.4B", high: "$0.60", low: "$0.57", vol: "$980M", icon: "bx bx-circle" },
        { id: "ada", symbol: "ADA/USD", name: "Cardano", category: "crypto", price: 0.48, change: "+0.85%", changePos: true, cap: "$17.1B", high: "$0.49", low: "$0.46", vol: "$320M", icon: "bx bx-unite" },
        
        { id: "aapl", symbol: "AAPL", name: "Apple Inc.", category: "stocks", price: 185.40, change: "+0.72%", changePos: true, cap: "$2.89T", high: "$186.2", low: "$184.0", vol: "$52M", icon: "bx bx-windows" },
        { id: "nvda", symbol: "NVDA", name: "NVIDIA Corp.", category: "stocks", price: 875.12, change: "+2.45%", changePos: true, cap: "$2.18T", high: "$880", low: "$852", vol: "$41M", icon: "bx bx-microchip" },
        { id: "tsla", symbol: "TSLA", name: "Tesla Inc.", category: "stocks", price: 174.60, change: "-1.20%", changePos: false, cap: "$556B", high: "$178", low: "$172", vol: "$84M", icon: "bx bx-car" },
        { id: "msft", symbol: "MSFT", name: "Microsoft Corp.", category: "stocks", price: 421.90, change: "+0.15%", changePos: true, cap: "$3.13T", high: "$424", low: "$419", vol: "$22M", icon: "bx bx-terminal" },
        { id: "amzn", symbol: "AMZN", name: "Amazon.com Inc.", category: "stocks", price: 180.10, change: "-0.64%", changePos: false, cap: "$1.87T", high: "$182", low: "$179", vol: "$31M", icon: "bx bx-package" },

        { id: "eurusd", symbol: "EUR/USD", name: "Euro / US Dollar", category: "forex", price: 1.0845, change: "+0.12%", changePos: true, cap: "Global Macro", high: "1.0870", low: "1.0820", vol: "$420B", icon: "bx bx-transfer" },
        { id: "gbpusd", symbol: "GBP/USD", name: "Pound / US Dollar", category: "forex", price: 1.2630, change: "-0.08%", changePos: false, cap: "Global Macro", high: "1.2670", low: "1.2590", vol: "$290B", icon: "bx bx-dollar-circle" },
        { id: "usdjpy", symbol: "USD/JPY", name: "US Dollar / Yen", category: "forex", price: 151.42, change: "+0.34%", changePos: true, cap: "Global Macro", high: "151.90", low: "150.80", vol: "$380B", icon: "bx bx-yen" },
        { id: "audusd", symbol: "AUD/USD", name: "Aussie / US Dollar", category: "forex", price: 0.6520, change: "+0.41%", changePos: true, cap: "Global Macro", high: "0.6550", low: "0.6490", vol: "$180B", icon: "bx bx-globe" },
        { id: "usdcad", symbol: "USD/CAD", name: "US Dollar / Loonie", category: "forex", price: 1.3565, change: "-0.18%", changePos: false, cap: "Global Macro", high: "1.3610", low: "1.3530", vol: "$140B", icon: "bx bx-flag" },

        { id: "gold", symbol: "XAU/USD", name: "Gold Spot", category: "commodities", price: 2178.50, change: "+0.88%", changePos: true, cap: "Physical Tier", high: "$2,195", low: "$2,160", vol: "$18B", icon: "bx bx-crown" },
        { id: "silver", symbol: "XAG/USD", name: "Silver Spot", category: "commodities", price: 24.65, change: "+1.40%", changePos: true, cap: "Physical Tier", high: "$24.90", low: "$24.20", vol: "$4.2B", icon: "bx bx-medal" },
        { id: "crude", symbol: "USOIL", name: "Crude Oil WTI", category: "commodities", price: 81.30, change: "-0.54%", changePos: false, cap: "Energy Tier", high: "$82.40", low: "$80.60", vol: "$9.5B", icon: "bx bx-droplet" },
        { id: "natgas", symbol: "NG", name: "Natural Gas", category: "commodities", price: 1.78, change: "-2.10%", changePos: false, cap: "Energy Tier", high: "$1.85", low: "$1.73", vol: "$2.1B", icon: "bx bx-wind" },
        { id: "copper", symbol: "HG", name: "Copper HG", category: "commodities", price: 4.02, change: "+0.32%", changePos: true, cap: "Industrial Tier", high: "$4.08", low: "$3.98", vol: "$850M", icon: "bx bx-anchor" },

        { id: "us10y", symbol: "US10Y", name: "US 10-Year Treasury Yield", category: "bonds", price: 4.226, change: "+0.65%", changePos: true, cap: "Sovereign Debt", high: "4.260%", low: "4.190%", vol: "Liquid", icon: "bx bx-file-blank" },
        { id: "us30y", symbol: "US30Y", name: "US 30-Year Bond Yield", category: "bonds", price: 4.382, change: "+0.42%", changePos: true, cap: "Sovereign Debt", high: "4.410%", low: "4.340%", vol: "Liquid", icon: "bx bx-folder" },
        { id: "uk10y", symbol: "UK10Y", name: "UK 10Y Gilt", category: "bonds", price: 3.985, change: "-0.15%", changePos: false, cap: "Sovereign Debt", high: "4.020%", low: "3.940%", vol: "Liquid", icon: "bx bx-task" },
        { id: "de10y", symbol: "DE10Y", name: "Germany 10Y Bund", category: "bonds", price: 2.324, change: "-0.52%", changePos: false, cap: "Sovereign Debt", high: "2.360%", low: "2.290%", vol: "Liquid", icon: "bx bx-shield" },
        { id: "jp10y", symbol: "JP10Y", name: "Japan 10Y JGB Yield", category: "bonds", price: 0.742, change: "+1.22%", changePos: true, cap: "Sovereign Debt", high: "0.755%", low: "0.725%", vol: "Liquid", icon: "bx bx-compass" }
    ];

    let globalActiveCategory = "all";
    let globalSearchFilterString = "";
    let systemSelectedAssetObj = null;
    let positionDirectionVector = "BUY";

    // --- DOM ELEMENT QUERY SELECTORS ---
    const marketTableBody = document.getElementById("marketTableBody");
    const marketSearchInput = document.getElementById("marketSearchInput");
    const categoryTabsList = document.querySelectorAll(".filter-tab");
    
    // Sub-view Screen Wrappers
    const marketsDashboardView = document.getElementById("marketsDashboardView");
    const tradingTerminalView = document.getElementById("tradingTerminalView");
    const closeTerminalBtn = document.getElementById("closeTerminalBtn");

    // Dynamic Terminal Target Bindings
    const termAssetIcon = document.getElementById("termAssetIcon");
    const termAssetName = document.getElementById("termAssetName");
    const termAssetSymbol = document.getElementById("termAssetSymbol");
    const termAssetPrice = document.getElementById("termAssetPrice");
    const termAssetChange = document.getElementById("termAssetChange");
    const termStatHigh = document.getElementById("termStatHigh");
    const termStatLow = document.getElementById("termStatLow");
    const termStatVolume = document.getElementById("termStatVolume");
    const termStatCap = document.getElementById("termStatCap");

    // Order Inputs
    const termAmountInput = document.getElementById("termAmountInput");
    const termLeverageSelector = document.getElementById("termLeverageSelector");
    const termSummaryNotional = document.getElementById("termSummaryNotional");
    const termSummaryUnits = document.getElementById("termSummaryUnits");
    const terminalBuyTab = document.getElementById("terminalBuyTab");
    const terminalSellTab = document.getElementById("terminalSellTab");
    const terminalFinalSubmitBtn = document.getElementById("terminalFinalSubmitBtn");
    const quickAllocationNodes = document.querySelectorAll(".quick-amt-node");

    // --- RENDER FLOW LOOP MATRIX ENGINE ---
    function renderMarketInterfaceRows() {
        marketTableBody.innerHTML = "";
        
        const filteredArray = financialInstrumentsData.filter(item => {
            const matchesCategory = (globalActiveCategory === "all" || item.category === globalActiveCategory);
            const matchesSearch = item.name.toLowerCase().includes(globalSearchFilterString) || 
                                  item.symbol.toLowerCase().includes(globalSearchFilterString);
            return matchesCategory && matchesSearch;
        });

        if (filteredArray.length === 0) {
            marketTableBody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding: 40px; color:#64748b;"><i class="bx bx-radar" style="font-size:2rem; display:block; margin-bottom:8px;"></i>No corresponding financial instruments found matching parameters.</td></tr>`;
            return;
        }

        filteredArray.forEach(asset => {
            const rowNode = document.createElement("tr");
            const changeClass = asset.changePos ? "change-pos" : "change-neg";
            const iconClass = `icon-${asset.category}`;

            rowNode.innerHTML = `
                <td>
                    <div class="asset-meta-cell">
                        <div class="asset-icon-box ${iconClass}"><i class="${asset.icon}"></i></div>
                        <div class="asset-symbol-block">
                            <h5>${asset.name}</h5>
                            <span>${asset.symbol}</span>
                        </div>
                    </div>
                </td>
                <td class="font-semibold">$${asset.price.toLocaleString(undefined, { minimumFractionDigits: 2 })}</td>
                <td class="${changeClass}">${asset.change}</td>
                <td>${asset.cap}</td>
                <td class="text-right">
                    <button class="table-trade-btn" data-id="${asset.id}"><i class="bx bx-bolt"></i> Trade</button>
                </td>
            `;
            marketTableBody.appendChild(rowNode);
        });

        // Bind events to the newly generated rows
        attachActionTriggersToTableButtons();
    }

    // --- INTERACTION HANDLERS AND CONTROLS ---
    function attachActionTriggersToTableButtons() {
        document.querySelectorAll(".table-trade-btn").forEach(btn => {
            btn.addEventListener("click", () => {
                const targetId = btn.getAttribute("data-id");
                const matchedAsset = financialInstrumentsData.find(a => a.id === targetId);
                if (matchedAsset) {
                    launchTerminalConsoleView(matchedAsset);
                }
            });
        });
    }

    // Interactive Core Sub-view Transition Routing Toggles
    function launchTerminalConsoleView(assetObject) {
        systemSelectedAssetObj = assetObject;
        
        // Populate static metrics text views inside structural panel containers
        termAssetIcon.innerHTML = `<i class="${assetObject.icon}"></i>`;
        termAssetIcon.className = `ticker-avatar icon-${assetObject.category}`;
        termAssetName.textContent = assetObject.name;
        termAssetSymbol.textContent = assetObject.symbol;
        termAssetPrice.textContent = `$${assetObject.price.toLocaleString()}`;
        termAssetChange.textContent = assetObject.change;
        termAssetChange.className = assetObject.changePos ? "change-pos" : "change-neg";
        
        termStatHigh.textContent = assetObject.high;
        termStatLow.textContent = assetObject.low;
        termStatVolume.textContent = assetObject.vol;
        termStatCap.textContent = assetObject.cap;

        // Reset default inputs values matrices loops
        termAmountInput.value = 100;
        termLeverageSelector.value = 1;
        positionDirectionVector = "BUY";
        terminalBuyTab.classList.add("active");
        terminalSellTab.classList.remove("active");

        calculateTerminalOrderMetrics();

        // Screen views toggles
        marketsDashboardView.classList.add("hidden-view");
        tradingTerminalView.classList.remove("hidden-view");
        window.scrollTo({ top: 0, behavior: "smooth" });
    }

    // Terminal Mathematics Loop Engine
    function calculateTerminalOrderMetrics() {
        if (!systemSelectedAssetObj) return;

        const amountInputVal = parseFloat(termAmountInput.value) || 0;
        const leverageMultiplier = parseFloat(termLeverageSelector.value) || 1;

        const totalNotionalSize = amountInputVal * leverageMultiplier;
        termSummaryNotional.textContent = `$${totalNotionalSize.toLocaleString(undefined, { minimumFractionDigits: 2 })}`;

        const estimatedAssetUnits = totalNotionalSize / systemSelectedAssetObj.price;
        let precisionDigits = estimatedAssetUnits < 1 ? 6 : 2;
        termSummaryUnits.textContent = `${estimatedAssetUnits.toLocaleString(undefined, { minimumFractionDigits: precisionDigits, maximumFractionDigits: precisionDigits })} units`;
    }

    // --- EVENT LISTENERS INITIALIZATION BINDINGS ---
    if (marketSearchInput) {
        marketSearchInput.addEventListener("input", (e) => {
            globalSearchFilterString = e.target.value.toLowerCase().trim();
            renderMarketInterfaceRows();
        });
    }

    categoryTabsList.forEach(tab => {
        tab.addEventListener("click", () => {
            categoryTabsList.forEach(t => t.classList.remove("is-active"));
            tab.classList.add("is-active");
            globalActiveCategory = tab.getAttribute("data-category");
            renderMarketInterfaceRows();
        });
    });

    if (closeTerminalBtn) {
        closeTerminalBtn.addEventListener("click", () => {
            tradingTerminalView.classList.add("hidden-view");
            marketsDashboardView.classList.remove("hidden-view");
            systemSelectedAssetObj = null;
        });
    }

    // Buy / Sell Sub-toggle Vector Buttons Loops
    if (terminalBuyTab) {
        terminalBuyTab.addEventListener("click", () => {
            positionDirectionVector = "BUY";
            terminalBuyTab.classList.add("active");
            terminalSellTab.classList.remove("active");
        });
    }
    if (terminalSellTab) {
        terminalSellTab.addEventListener("click", () => {
            positionDirectionVector = "SELL";
            terminalSellTab.classList.add("active");
            terminalBuyTab.classList.remove("active");
        });
    }

    // Live Math Changes Events
    if (termAmountInput) termAmountInput.addEventListener("input", calculateTerminalOrderMetrics);
    if (termLeverageSelector) termLeverageSelector.addEventListener("change", calculateTerminalOrderMetrics);

    // Quick Pill Amounts Deck Setup Matrix Loop
    quickAllocationNodes.forEach(node => {
        node.addEventListener("click", () => {
            termAmountInput.value = node.getAttribute("data-value");
            calculateTerminalOrderMetrics();
        });
    });

    // Final Order Submit Interceptor Dispatch Trigger
    if (terminalFinalSubmitBtn) {
        terminalFinalSubmitBtn.addEventListener("click", () => {
            const requestedPrincipal = parseFloat(termAmountInput.value) || 0;
            if (requestedPrincipal <= 0) {
                alert("Execution Refused: Investment Principal must be greater than zero.");
                return;
            }

            alert(`Order Dispatched to Simulation Clearing House Core!\nAsset: ${systemSelectedAssetObj.symbol}\nDirection Vector: ${positionDirectionVector}\nPrincipal Invested: $${requestedPrincipal}\nMultiplier Factor: ${termLeverageSelector.value}x`);
            
            // Return seamlessly to dashboard view
            closeTerminalBtn.click();
        });
    }
// Interactive Core Sub-view Transition Routing Toggles
function launchTerminalConsoleView(assetObject) {
    systemSelectedAssetObj = assetObject;
    
    // Populate static metrics text views inside structural panel containers
    termAssetIcon.innerHTML = `<i class="${assetObject.icon}"></i>`;
    termAssetIcon.className = `ticker-avatar icon-${assetObject.category}`;
    termAssetName.textContent = assetObject.name;
    termAssetSymbol.textContent = assetObject.symbol;
    termAssetPrice.textContent = `$${assetObject.price.toLocaleString()}`;
    termAssetChange.textContent = assetObject.change;
    termAssetChange.className = assetObject.changePos ? "change-pos" : "change-neg";
    
    termStatHigh.textContent = assetObject.high;
    termStatLow.textContent = assetObject.low;
    termStatVolume.textContent = assetObject.vol;
    termStatCap.textContent = assetObject.cap;

    // Reset default inputs values matrices loops
    termAmountInput.value = 100;
    termLeverageSelector.value = 1;
    positionDirectionVector = "BUY";
    terminalBuyTab.classList.add("active");
    terminalSellTab.classList.remove("active");

    calculateTerminalOrderMetrics();

    // Screen views toggles
    marketsDashboardView.classList.add("hidden-view");
    tradingTerminalView.classList.remove("hidden-view");
    window.scrollTo({ top: 0, behavior: "smooth" });

    // --- DYNAMIC TRADINGVIEW CHART MOUNT INITIALIZER ---
    // Maps the asset symbol to its correct native feed market identifier
    let tradingViewSymbolKey = "BINANCE:BTCUSDT"; // Default fallback
    
    if (assetObject.id === "btc") tradingViewSymbolKey = "BINANCE:BTCUSDT";
    else if (assetObject.id === "eth") tradingViewSymbolKey = "BINANCE:ETHUSDT";
    else if (assetObject.id === "sol") tradingViewSymbolKey = "BINANCE:SOLUSDT";
    else if (assetObject.id === "xrp") tradingViewSymbolKey = "BINANCE:XRPUSDT";
    else if (assetObject.id === "ada") tradingViewSymbolKey = "BINANCE:ADAUSDT";
    else if (assetObject.id === "aapl") tradingViewSymbolKey = "NASDAQ:AAPL";
    else if (assetObject.id === "nvda") tradingViewSymbolKey = "NASDAQ:NVDA";
    else if (assetObject.id === "tsla") tradingViewSymbolKey = "NASDAQ:TSLA";
    else if (assetObject.id === "msft") tradingViewSymbolKey = "NASDAQ:MSFT";
    else if (assetObject.id === "amzn") tradingViewSymbolKey = "NASDAQ:AMZN";
    else if (assetObject.id === "eurusd") tradingViewSymbolKey = "FX:EURUSD";
    else if (assetObject.id === "gbpusd") tradingViewSymbolKey = "FX:GBPUSD";
    else if (assetObject.id === "usdjpy") tradingViewSymbolKey = "FX:USDJPY";
    else if (assetObject.id === "gold") tradingViewSymbolKey = "OANDA:XAUUSD";
    else if (assetObject.id === "crude") tradingViewSymbolKey = "TVC:USOIL";

    // Spawns the clean premium dark charting module inside your terminal frame
    setTimeout(() => {
        new TradingView.widget({
            "autosize": true,
            "symbol": tradingViewSymbolKey,
            "interval": "H",
            "timezone": "Etc/UTC",
            "theme": "dark",
            "style": "1", // Candlesticks view matrix style template
            "locale": "en",
            "toolbar_bg": "#0f172a",
            "enable_publishing": false,
            "hide_side_toolbar": false,
            "allow_symbol_change": false,
            "container_id": "tradingview_live_chart_element"
        });
    }, 50); // Small 50ms layout tick calculation buffer to ensure your DOM view container is unhidden first
}
    // --- BOOTSTRAP EXECUTIONS ENGINE INITIALIZATION ---
    renderMarketInterfaceRows();
});