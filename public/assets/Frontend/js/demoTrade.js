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
    // 1. DOM Form Node Extractions
    const demoTradeForm = document.getElementById("demoTradeForm");
    const assetSelector = document.getElementById("assetSelector");
    const leverageSelector = document.getElementById("leverageSelector");
    const tradeAmountInput = document.getElementById("tradeAmountInput");
    const tradeDirectionInput = document.getElementById("tradeDirectionInput");
    
    const directionNodes = document.querySelectorAll(".direction-node");
    
    // Receipt Elements
    const summaryAsset = document.getElementById("summaryAsset");
    const summaryNotionalValue = document.getElementById("summaryNotionalValue");
    const summaryMaxRisk = document.getElementById("summaryMaxRisk");
    
    // Reset triggers
    const terminalResetBtn = document.getElementById("terminalResetBtn");
    const terminalAvailableBalance = document.getElementById("terminalAvailableBalance");

    // 2. Interactive Vectors Toggle Setup
    directionNodes.forEach(node => {
        node.addEventListener("click", () => {
            // Drop selected nodes arrays validation layout
            directionNodes.forEach(n => n.classList.remove("is-active", "is-selected"));
            
            // Add custom visual state triggers
            node.classList.add("is-selected");
            const directionValue = node.getAttribute("data-direction");
            tradeDirectionInput.value = directionValue;
            
            triggerReceiptCalculations();
        });
    });

    // 3. Attach Change Listener Matrix Loops
    if(assetSelector) assetSelector.addEventListener("change", triggerReceiptCalculations);
    if(leverageSelector) leverageSelector.addEventListener("change", triggerReceiptCalculations);
    if(tradeAmountInput) tradeAmountInput.addEventListener("input", triggerReceiptCalculations);

    // 4. Mathematical Equation Matrix Calculations Engine
    function triggerReceiptCalculations() {
        const selectedOption = assetSelector.options[assetSelector.selectedIndex];
        const assetCode = assetSelector.value;
        const amount = parseFloat(tradeAmountInput.value) || 0;
        const leverage = parseFloat(leverageSelector.value) || 1;
        
        // Output code tag string visibility
        if(assetCode) {
            summaryAsset.textContent = `TICKET: ${assetCode} / USD`;
        } else {
            summaryAsset.textContent = "ASSET: NONE";
        }

        // Calculate Notional Size (Principal Allocation multiplied by selected Leverage)
        let notionalSize = amount * leverage;
        summaryNotionalValue.textContent = `$${notionalSize.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;

        // Maximum Margin Risk mapping calculations parameters
        let localizedRisk = amount; // In regular options structures, risk isolation equals initial allocation margin
        summaryMaxRisk.textContent = `$${localizedRisk.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    }

    // 5. Submit Order Interceptor
    if(demoTradeForm) {
        demoTradeForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            
            if(!tradeDirectionInput.value) {
                alert("Execution Refused: Please configure your trade vector direction (BUY/SELL).");
                return;
            }

            const asset = assetSelector.value;
            const amount = parseFloat(tradeAmountInput.value) || 0;
            const leverage = parseFloat(leverageSelector.value) || 1;
            const durationValue = document.getElementById('durationSelector').value;

            if (!asset) {
                alert("Execution Refused: Please select an asset instrument.");
                return;
            }

            if (amount < 10) {
                alert("Execution Refused: Minimum demo allocation is $10.");
                return;
            }

            if (amount > 100000) {
                alert("Execution Refused: Maximum demo allocation is $100,000.");
                return;
            }

            const payload = {
                asset,
                direction: tradeDirectionInput.value,
                amount,
                leverage,
                duration_minutes: parseInt(durationValue, 10) || 15,
            };

            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const token = tokenMeta ? tokenMeta.content : '';

            try {
                const response = await fetch('/api/demo/trade', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.message || 'Trade request failed.');
                }

                alert(`Order Dispatched Successfully!\nInstrument: ${asset}\nDirection: ${tradeDirectionInput.value}\nMargin Allocation: $${amount.toFixed(2)}\nLeverage: ${leverage.toFixed(0)}x`);

                if (terminalAvailableBalance) {
                    terminalAvailableBalance.textContent = `$${Number(data.demo_balance).toFixed(2)}`;
                }
                const demoBalanceDisplay = document.getElementById('demoBalanceDisplay');
                if (demoBalanceDisplay) {
                    demoBalanceDisplay.textContent = `$${Number(data.demo_balance).toFixed(2)}`;
                }

                demoTradeForm.reset();
                directionNodes.forEach(n => n.classList.remove("is-selected"));
                tradeDirectionInput.value = "";
                triggerReceiptCalculations();
            } catch (error) {
                alert(error.message || 'Unable to place demo trade at this time.');
            }
        });
    }

    // 6. Interactive Simulator Reset Engine 
    if(terminalResetBtn) {
        terminalResetBtn.addEventListener("click", async () => {
            if(confirm("Are you sure you want to completely restore the virtual execution simulation matrix?")) {
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                const token = tokenMeta ? tokenMeta.content : '';

                try {
                    const response = await fetch('/api/demo/reset', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                    });

                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Reset failed.');
                    }

                    if(terminalAvailableBalance) {
                        terminalAvailableBalance.textContent = `$${Number(data.demo_balance).toFixed(2)}`;
                        terminalAvailableBalance.style.color = "#10b981";
                        setTimeout(() => { terminalAvailableBalance.style.color = ""; }, 500);
                    }
                    const demoBalanceDisplay = document.getElementById('demoBalanceDisplay');
                    if (demoBalanceDisplay) {
                        demoBalanceDisplay.textContent = `$${Number(data.demo_balance).toFixed(2)}`;
                    }

                    if(demoTradeForm) demoTradeForm.reset();
                    directionNodes.forEach(n => n.classList.remove("is-selected"));
                    if(tradeDirectionInput) tradeDirectionInput.value = "";
                    triggerReceiptCalculations();
                } catch (error) {
                    alert(error.message || 'Unable to reset demo account at this time.');
                }
            }
        });
    }
});