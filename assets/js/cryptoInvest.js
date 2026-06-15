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
    // 1. Data Schema for the 9 Beautiful Premium Investment Plans
    const plansData = [
        { id: 1, name: "Crypto Starter Eco", tier: "Starter", icon: "bx-layer", min: 50, max: 300, dailyRoi: 4.5, duration: 14, bonus: 0, badgeClass: "badge-tier-1" },
        { id: 2, name: "Crypto Yield Spark", tier: "Starter", icon: "bx-bolt-circle", min: 300, max: 1000, dailyRoi: 5.8, duration: 14, bonus: 5, badgeClass: "badge-tier-1" },
        { id: 3, name: "Alpha Contract Plus", tier: "Starter", icon: "bx-shuffle", min: 1000, max: 2500, dailyRoi: 7.2, duration: 21, bonus: 15, badgeClass: "badge-tier-1" },
        
        { id: 4, name: "Crypto Velocity Loop", tier: "Active Pro", icon: "bx-line-chart", min: 2500, max: 5000, dailyRoi: 10.5, duration: 21, bonus: 40, badgeClass: "badge-tier-2", isHot: true },
        { id: 5, name: "DeFi Harvest Matrix", tier: "Active Pro", icon: "bx-radar", min: 5000, max: 10000, dailyRoi: 14.0, duration: 30, bonus: 85, badgeClass: "badge-tier-2", isHot: true },
        { id: 6, name: "Quantum Scalper Edge", tier: "Active Pro", icon: "bx-scatter-chart", min: 10000, max: 25000, dailyRoi: 18.5, duration: 30, bonus: 150, badgeClass: "badge-tier-2", isHot: true },
        
        { id: 7, name: "Institutional Prime Vault", tier: "High Net", icon: "bx-crown", min: 25000, max: 50000, dailyRoi: 24.0, duration: 45, bonus: 350, badgeClass: "badge-tier-3" },
        { id: 8, name: "Vanguard Sovereign Block", tier: "High Net", icon: "bx-diamond", min: 50000, max: 100000, dailyRoi: 32.5, duration: 60, bonus: 800, badgeClass: "badge-tier-3" },
        { id: 9, name: "Apex Eternity Infinite", tier: "High Net", icon: "bx-infinite", min: 100000, max: 250000, dailyRoi: 40.0, duration: 90, bonus: 2500, badgeClass: "badge-tier-3" }
    ];

    const gridContainer = document.getElementById("investmentPlansGrid");

    // 2. Render Loop for Plans
    plansData.forEach(plan => {
        let defaultVal = Math.floor((plan.min + plan.max) / 2);
        let cardHTML = `
            <div class="plan-card ${plan.isHot ? 'hot-plan' : ''} ${plan.tier === 'High Net' ? 'premium-plan' : ''}">
                <div class="plan-header">
                    <span class="plan-badge ${plan.badgeClass}">${plan.tier}</span>
                    <i class="bx ${plan.icon} crypto-brand-icon"></i>
                    <h2>${plan.name}</h2>
                    <span class="plan-duration-pill">${plan.duration} Trading Days</span>
                </div>
                <div class="plan-body">
                    <div class="data-row">
                        <span class="label-muted">Investment Window</span>
                        <span class="value-highlight">$${plan.min.toLocaleString()} - $${plan.max.toLocaleString()}</span>
                    </div>
                    <div class="data-row">
                        <span class="label-muted">Yield Parameter</span>
                        <span class="value-roi">+${plan.dailyRoi}% Daily</span>
                    </div>
                    <div class="data-row">
                        <span class="label-muted">Contract Multiplier Bonus</span>
                        <span class="value-highlight" style="color:#c084fc;">+$${plan.bonus} Cash</span>
                    </div>

                    <div class="calc-block">
                        <label>Allocation Threshold ($)</label>
                        <div class="input-container">
                            <span>$</span>
                            <input type="number" class="investment-input" id="input-${plan.id}" min="${plan.min}" max="${plan.max}" value="${defaultVal}">
                        </div>
                        <input type="range" class="range-slider" id="slider-${plan.id}" min="${plan.min}" max="${plan.max}" value="${defaultVal}">
                        
                        <div class="live-output-box">
                            <div>
                                <p class="label-muted">Daily Return</p>
                                <p id="daily-val-${plan.id}">$0.00</p>
                            </div>
                            <div>
                                <p class="label-muted">Total Net Profit</p>
                                <p id="total-val-${plan.id}">$0.00</p>
                            </div>
                        </div>
                    </div>

                    <button class="invest-btn" data-plan-id="${plan.id}">
                        Invest In Contract <i class="bx bx-chevron-right"></i>
                    </button>
                </div>
            </div>
        `;
        gridContainer.insertAdjacentHTML('beforeend', cardHTML);

        // Bind DOM Elements Contextually
        const inputField = document.getElementById(`input-${plan.id}`);
        const sliderField = document.getElementById(`slider-${plan.id}`);
        
        // Initial Calculation Trigger
        calculateMetrics(plan, defaultVal);

        // Synchronize Sliders and Inputs
        inputField.addEventListener("input", (e) => {
            let value = parseFloat(e.target.value) || 0;
            sliderField.value = value;
            calculateMetrics(plan, value);
        });

        sliderField.addEventListener("input", (e) => {
            let value = parseFloat(e.target.value);
            inputField.value = value;
            calculateMetrics(plan, value);
        });
    });

    // 3. Precision Calculator Engine
    function calculateMetrics(plan, amount) {
        const dailyOut = document.getElementById(`daily-val-${plan.id}`);
        const totalOut = document.getElementById(`total-val-${plan.id}`);

        // Keep within metrics boundary natively for calculation updates
        let safeAmount = amount;
        if (amount < plan.min) safeAmount = plan.min;
        if (amount > plan.max) safeAmount = plan.max;

        let dailyYield = (safeAmount * (plan.dailyRoi / 100));
        let totalYield = (dailyYield * plan.duration) + plan.bonus;

        dailyOut.textContent = `$${dailyYield.toFixed(2)}`;
        totalOut.textContent = `$${totalYield.toFixed(2)}`;
    }

    // 4. Navigation & Value Redirection Logic Interceptor
    gridContainer.addEventListener("click", (e) => {
        const button = e.target.closest(".invest-btn");
        if (!button) return;

        const planId = button.getAttribute("data-plan-id");
        const selectedPlan = plansData.find(p => p.id == planId);
        const inputVal = document.getElementById(`input-${planId}`).value;

        // Force minimum/maximum corrections before redirecting variables 
        let finalAmount = parseFloat(inputVal) || selectedPlan.min;
        if (finalAmount < selectedPlan.min) finalAmount = selectedPlan.min;
        if (finalAmount > selectedPlan.max) finalAmount = selectedPlan.max;

        // Structured URL queries passed systematically to depositfunds.html
        window.location.href = `depositfunds.html?amount=${finalAmount}&planId=${planId}&planName=${encodeURIComponent(selectedPlan.name)}`;
    });
});