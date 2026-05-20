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
document.addEventListener("DOMContentLoaded", () => {
    // 1. Data Schema for 10 Premium Stock Portfolios
    const stockPlansData = [
        { id: 101, name: "Stock Starter Eco", tier: "Starter", icon: "bx-layer", min: 100, max: 500, dailyRoi: 2.1, duration: 14, bonus: 0, tag: "Balanced Growth" },
        { id: 102, name: "Stock Yield Spark", tier: "Starter", icon: "bx-bolt-circle", min: 500, max: 2000, dailyRoi: 3.5, duration: 21, bonus: 10, tag: "Balanced Growth" },

        { id: 103, name: "Velocity Growth Loop", tier: "Active Pro", icon: "bx-line-chart", min: 2000, max: 5000, dailyRoi: 5.2, duration: 21, bonus: 50, tag: "Growth Position", isHot: true },
        { id: 104, name: "DeFi Harvest Matrix", tier: "Active Pro", icon: "bx-radar", min: 5000, max: 10000, dailyRoi: 7.8, duration: 30, bonus: 120, tag: "Growth Position", isHot: true },
        { id: 105, name: "Quantum Scalper Edge", tier: "Active Pro", icon: "bx-scatter-chart", min: 10000, max: 25000, dailyRoi: 10.5, duration: 30, bonus: 300, tag: "Growth Position", isHot: true },

        { id: 106, name: "Blue Chip Premier Vault", tier: "Institutional", icon: "bx-crown", min: 25000, max: 50000, dailyRoi: 15.0, duration: 45, bonus: 800, tag: "Capital Preservation" },
        { id: 107, name: "Vanguard Sovereign Block", tier: "Institutional", icon: "bx-diamond", min: 50000, max: 100000, dailyRoi: 19.5, duration: 60, bonus: 2000, tag: "Capital Preservation" },
        { id: 108, name: "Apex Eternity Infinite", tier: "Institutional", icon: "bx-infinite", min: 100000, max: 250000, dailyRoi: 25.0, duration: 90, bonus: 5000, tag: "Capital Preservation" },

        // Add 2 extra distinct mid-to-high plans to reach 10
        { id: 109, name: "Emerging Tech Alpha", tier: "Institutional", icon: "bx-chip", min: 250000, max: 500000, dailyRoi: 30.0, duration: 120, bonus: 12000, tag: "Growth Position" },
        { id: 110, name: "Legacy Dividend Stronghold", tier: "Institutional", icon: "bx-buildings", min: 500000, max: 1000000, dailyRoi: 35.0, duration: 180, bonus: 30000, tag: "Dividend Income" }
    ];

    const plansGrid = document.getElementById("stockPlansGrid");

    // 2. Render Loop to Generate 10 Plan Cards
    stockPlansData.forEach(plan => {
        let defVal = Math.floor((plan.min + plan.max) / 2); // Default is midpoint

        let cardHTML = `
            <div class="plan-card ${plan.isHot ? 'hot-plan' : ''}">
                <div class="plan-header">
                    <i class="bx ${plan.icon} stock-brand-icon"></i>
                    <span class="plan-tier">${plan.tier} Tier</span>
                    <h2>${plan.name}</h2>
                    <p class="p-range">$${plan.min.toLocaleString()} - $${plan.max.toLocaleString()}</p>
                </div>
                <div class="plan-body">
                    <div class="data-strip">
                        <span class="d-muted">Returns Parameter</span>
                        <span class="d-roi">+${plan.dailyRoi}% Daily</span>
                    </div>
                    <div class="data-strip">
                        <span class="d-muted">Contract Multiplier Bonus</span>
                        <span class="d-val" style="color:#c084fc;">+$${plan.bonus} Cash</span>
                    </div>

                    <div class="calc-module">
                        <label class="p-amount-label">Allocation Threshold ($)</label>
                        <div class="input-frame">
                            <span>$</span>
                            <input type="number" class="investment-numeric-input" id="inp-${plan.id}" min="${plan.min}" max="${plan.max}" value="${defVal}">
                        </div>
                        <input type="range" class="amount-slider" id="sld-${plan.id}" min="${plan.min}" max="${plan.max}" value="${defVal}">
                        
                        <div class="calc-summary">
                            <div>Daily Return <span class="v-out" id="v-daily-${plan.id}">$0.00</span></div>
                            <div>Total Net Profit <span class="v-out" id="v-total-${plan.id}">$0.00</span></div>
                        </div>
                    </div>

                    <button class="invest-now-btn" data-stock-plan-id="${plan.id}">
                        Allocate Funds <i class="bx bx-chevron-right"></i>
                    </button>
                </div>
            </div>
        `;
        plansGrid.insertAdjacentHTML('beforeend', cardHTML);

        // Bind Contextual UI Elements
        const inputField = document.getElementById(`inp-${plan.id}`);
        const sliderField = document.getElementById(`sld-${plan.id}`);

        // Run Initial Calculations
        updateCardCalculations(plan, defVal);

        // Synchronize Slider & Input interaction
        inputField.addEventListener("input", (e) => {
            let val = parseFloat(e.target.value) || 0;
            sliderField.value = val;
            updateCardCalculations(plan, val);
        });

        sliderField.addEventListener("input", (e) => {
            let val = parseFloat(e.target.value);
            inputField.value = val;
            updateCardCalculations(plan, val);
        });
    });

    // 3. Mathematical Logic Engine for Returns
    function updateCardCalculations(plan, amount) {
        const d_out = document.getElementById(`v-daily-${plan.id}`);
        const t_out = document.getElementById(`v-total-${plan.id}`);

        // Safe parameter clamping for metrics accuracy
        let safe = amount;
        if (amount < plan.min) safe = plan.min;
        if (amount > plan.max) safe = plan.max;

        let dailyReturns = (safe * (plan.dailyRoi / 100));
        let totalReturns = (dailyReturns * plan.duration) + plan.bonus;

        d_out.textContent = `$${dailyReturns.toFixed(2)}`;
        t_out.textContent = `$${totalReturns.toFixed(2)}`;
    }

    // 4. Form Action & Value Transfer Interceptor to depositfunds.html
    plansGrid.addEventListener("click", (e) => {
        const button = e.target.closest(".invest-now-btn");
        if (!button) return;

        const pId = button.getAttribute("data-stock-plan-id");
        const foundPlan = stockPlansData.find(p => p.id == pId);
        const allocationVal = document.getElementById(`inp-${pId}`).value;

        // Perform final boundary checks before transmission 
        let finalAllocation = parseFloat(allocationVal) || foundPlan.min;
        if (finalAllocation < foundPlan.min) finalAllocation = foundPlan.min;
        if (finalAllocation > foundPlan.max) finalAllocation = foundPlan.max;

        // Systematic data delivery via URL queries
        window.location.href = `depositfunds.html?amount=${finalAllocation}&planId=${pId}&planName=${encodeURIComponent(foundPlan.name)}`;
    });

    // 5. Portfolio Allocation Visualization (Simulation)
    const ctx = document.getElementById('allocationChart').getContext('2d');

    // Check if Chart.js is included before rendering
    if (typeof Chart !== 'undefined') {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Technology', 'Healthcare', 'Energy', 'Sectors Mix'],
                datasets: [{
                    data: [35, 20, 15, 30],
                    backgroundColor: ['#2563eb', '#10b981', '#facc15', '#1f2937'],
                    borderColor: 'transparent',
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'right', labels: { color: '#9ca3af', font: { size: 10 } } }
                }
            }
        });
    } else {
        console.warn("Chart.js library is not loaded. Allocation chart will not render.");
    }
});