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

if (qtDropdownBtn && qtDropdownMenu) {
    qtDropdownBtn.addEventListener("click", () => {
        qtDropdownMenu.classList.toggle("active");
        qtDropdownBtn.classList.toggle("active");
    });

    window.addEventListener("click", (e) => {
        if (!qtDropdownBtn.contains(e.target) && !qtDropdownMenu.contains(e.target)) {
            qtDropdownMenu.classList.remove("active");
            qtDropdownBtn.classList.remove("active");
        }
    });
}

const acmVerifyBtn = document.getElementById("acmVerifyBtn");
const acmVerifyMenu = document.getElementById("acmVerifyMenu");

if (acmVerifyBtn && acmVerifyMenu) {
    acmVerifyBtn.addEventListener("click", () => {
        acmVerifyBtn.classList.toggle("active");
        acmVerifyMenu.classList.toggle("active");
    });
}


// Main section starts here
document.addEventListener("DOMContentLoaded", () => {
    console.log('stockMarket.js DOMContentLoaded fired');
    const stockPlansData = JSON.parse(document.getElementById('stockPlansData')?.textContent || '[]');
    const stockPostsData = JSON.parse(document.getElementById('stockPostsData')?.textContent || '[]');
    const stockBalance = parseFloat(document.getElementById('stockUserBalanceData')?.textContent || 0);
    const plansGrid = document.getElementById("stockPlansGrid");
    const isAuthenticated = window.stockMarketAuth === true;
    const appBaseUrl = window.stockMarketBaseUrl || '';
    const investEndpoint = window.stockMarketInvestUrl || `${appBaseUrl}/stock-market/invest`;
    const loginUrl = `${appBaseUrl}/login`;
    const deployBotUrl = window.stockMarketDeployUrl || `${appBaseUrl}/deploybot`;

    console.log('stockMarket.js loaded', { stockPlansDataLength: stockPlansData.length, plansGridExists: !!plansGrid, isAuthenticated, investEndpoint, loginUrl, deployBotUrl });

    const defaultPlans = [
        { id: 101, name: "Stock Starter Eco", tier: "Starter", icon: "bx-layer", min: 100, max: 500, dailyRoi: 2.1, monthlyRoi: 63.0, yearlyRoi: 766.5, durationDays: 14, bonus: 0, tag: "Balanced Growth" },
        { id: 102, name: "Stock Yield Spark", tier: "Starter", icon: "bx-bolt-circle", min: 500, max: 2000, dailyRoi: 3.5, monthlyRoi: 105.0, yearlyRoi: 1277.5, durationDays: 21, bonus: 10, tag: "Balanced Growth" },
        { id: 103, name: "Velocity Growth Loop", tier: "Active Pro", icon: "bx-line-chart", min: 2000, max: 5000, dailyRoi: 5.2, monthlyRoi: 156.0, yearlyRoi: 1898.0, durationDays: 21, bonus: 50, tag: "Growth Position", isHot: true },
        { id: 104, name: "DeFi Harvest Matrix", tier: "Active Pro", icon: "bx-radar", min: 5000, max: 10000, dailyRoi: 7.8, monthlyRoi: 234.0, yearlyRoi: 2847.0, durationDays: 30, bonus: 120, tag: "Growth Position", isHot: true },
        { id: 105, name: "Quantum Scalper Edge", tier: "Active Pro", icon: "bx-scatter-chart", min: 10000, max: 25000, dailyRoi: 10.5, monthlyRoi: 315.0, yearlyRoi: 3832.5, durationDays: 30, bonus: 300, tag: "Growth Position", isHot: true },
        { id: 106, name: "Blue Chip Premier Vault", tier: "Institutional", icon: "bx-crown", min: 25000, max: 50000, dailyRoi: 15.0, monthlyRoi: 450.0, yearlyRoi: 5475.0, durationDays: 45, bonus: 800, tag: "Capital Preservation" },
        { id: 107, name: "Vanguard Sovereign Block", tier: "Institutional", icon: "bx-diamond", min: 50000, max: 100000, dailyRoi: 19.5, monthlyRoi: 585.0, yearlyRoi: 7120.5, durationDays: 60, bonus: 2000, tag: "Capital Preservation" },
        { id: 108, name: "Apex Eternity Infinite", tier: "Institutional", icon: "bx-infinite", min: 100000, max: 250000, dailyRoi: 25.0, monthlyRoi: 750.0, yearlyRoi: 9125.0, durationDays: 90, bonus: 5000, tag: "Capital Preservation" },
        { id: 109, name: "Emerging Tech Alpha", tier: "Institutional", icon: "bx-chip", min: 250000, max: 500000, dailyRoi: 30.0, monthlyRoi: 900.0, yearlyRoi: 10950.0, durationDays: 120, bonus: 12000, tag: "Growth Position" },
        { id: 110, name: "Legacy Dividend Stronghold", tier: "Institutional", icon: "bx-buildings", min: 500000, max: 1000000, dailyRoi: 35.0, monthlyRoi: 1050.0, yearlyRoi: 12775.0, durationDays: 180, bonus: 30000, tag: "Dividend Income" }
    ];

    const plans = stockPlansData.length ? stockPlansData : defaultPlans;
    const cardTermOrder = ['daily', 'monthly', 'yearly'];
    const planCards = plans.map((plan, index) => ({
        ...plan,
        termType: cardTermOrder[index] || 'monthly'
    }));

    renderStockPlans(planCards);
    renderStockPosts(stockPostsData);

    function renderStockPlans(plans) {
        if (!plansGrid) return;
        plansGrid.innerHTML = '';

        plans.forEach(plan => {
            const defaultValue = Math.min(Math.max(((plan.minimum_investment || plan.min) + (plan.maximum_investment || plan.max)) / 2, plan.minimum_investment || plan.min), plan.maximum_investment || plan.max);
            const minAmount = plan.minimum_investment || plan.min;
            const maxAmount = plan.maximum_investment || plan.max;
            const roi = getRateForTerm(plan, plan.termType);
            const termLabel = plan.termType.charAt(0).toUpperCase() + plan.termType.slice(1);

            const investButtonLabel = isAuthenticated ? 'Allocate Funds' : 'Login to Invest';
            const cardHTML = `
                <div class="plan-card ${plan.isHot ? 'hot-plan' : ''}">
                    <div class="plan-header">
                        <i class="bx ${plan.icon || 'bx-layer'} stock-brand-icon"></i>
                        <span class="plan-tier">${plan.tier || 'Tier'} Tier</span>
                        <h2>${plan.name}</h2>
                        <p class="p-range">$${minAmount.toLocaleString()} - $${maxAmount.toLocaleString()}</p>
                    </div>
                    <div class="plan-body">
                        <div class="data-strip">
                            <span class="d-muted">${termLabel} Yield</span>
                            <span class="d-roi">+${roi}%</span>
                        </div>
                        <div class="data-strip">
                            <span class="d-muted">Term Bonus</span>
                            <span class="d-val" style="color:#c084fc;">+$${plan.bonus || 0} Cash</span>
                        </div>
                        <div class="term-select-block">
                            <span class="term-badge">${termLabel} Plan</span>
                        </div>
                        <div class="calc-module">
                            <label class="p-amount-label">Allocation Threshold ($)</label>
                            <div class="input-frame">
                                <span>$</span>
                                <input type="number" class="investment-numeric-input" id="inp-${plan.id}" min="${minAmount}" max="${maxAmount}" value="${defaultValue}">
                            </div>
                            <input type="range" class="amount-slider" id="sld-${plan.id}" min="${minAmount}" max="${maxAmount}" value="${defaultValue}">
                            <div class="calc-summary">
                                <div><span class="term-label" id="term-label-${plan.id}">${termLabel} Return</span> <span class="v-out" id="v-return-${plan.id}">$0.00</span></div>
                                <div>Total Net Profit <span class="v-out" id="v-total-${plan.id}">$0.00</span></div>
                            </div>
                        </div>
                        <button type="button" class="invest-now-btn" data-stock-plan-id="${plan.id}" ${!isAuthenticated ? 'data-guest-action="login"' : ''}>
                            ${investButtonLabel} <i class="bx bx-chevron-right"></i>
                        </button>
                    </div>
                </div>
            `;
            plansGrid.insertAdjacentHTML('beforeend', cardHTML);

            const inputField = document.getElementById(`inp-${plan.id}`);
            const sliderField = document.getElementById(`sld-${plan.id}`);
            const investButton = plansGrid.querySelector(`.invest-now-btn[data-stock-plan-id="${plan.id}"]`);

            updateCardCalculations(plan, defaultValue, plan.termType);

            if (inputField) {
                inputField.addEventListener('input', (e) => {
                    let val = parseFloat(e.target.value) || minAmount;
                    if (val < minAmount) val = minAmount;
                    if (val > maxAmount) val = maxAmount;
                    if (sliderField) sliderField.value = val;
                    updateCardCalculations(plan, val, plan.termType);
                });
            }

            if (sliderField) {
                sliderField.addEventListener('input', (e) => {
                    let val = parseFloat(e.target.value) || minAmount;
                    if (inputField) inputField.value = val;
                    updateCardCalculations(plan, val, plan.termType);
                });
            }

            if (investButton) {
                console.log('attaching invest listener for plan', plan.id);
                investButton.addEventListener('click', () => {
                    handlePlanInvestment(plan.id);
                });
            }
        });

        if (plansGrid) {
            plansGrid.addEventListener('click', (e) => {
                const clickedBtn = e.target.closest('.invest-now-btn');
                if (!clickedBtn) return;
                const planId = clickedBtn.getAttribute('data-stock-plan-id');
                if (clickedBtn.dataset.guestAction === 'login') {
                    window.location.href = loginUrl;
                    return;
                }
                console.log('delegated invest click for plan', planId);
                handlePlanInvestment(planId);
            });
        }
    }

    function renderStockPosts(posts) {
        const postsContainer = document.getElementById('stockPostsContainer');
        if (!postsContainer || posts.length === 0) {
            return;
        }

        postsContainer.innerHTML = posts.map(post => `
            <article class="stock-post-card">
                <div class="stock-post-image" style="background-image:url('${post.image_url || 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=900&q=80'}')"></div>
                <div class="stock-post-content">
                    <h4>${post.title}</h4>
                    <p>${post.body}</p>
                </div>
            </article>
        `).join('');
    }

    function updateCardCalculations(plan, amount, term) {
        const outputField = document.getElementById(`v-return-${plan.id}`);
        const labelField = document.getElementById(`term-label-${plan.id}`);
        const totalField = document.getElementById(`v-total-${plan.id}`);

        const safeAmount = Math.min(Math.max(amount, plan.minimum_investment || plan.min), plan.maximum_investment || plan.max);
        const rate = getRateForTerm(plan, term);
        const profit = safeAmount * (rate / 100);
        const totalProfit = profit + (plan.bonus || 0);

        if (outputField) {
            outputField.textContent = `$${profit.toFixed(2)}`;
        }
        if (totalField) {
            totalField.textContent = `$${totalProfit.toFixed(2)}`;
        }
        if (labelField) {
            labelField.textContent = `${term.charAt(0).toUpperCase() + term.slice(1)} Return`;
        }
    }

    function getRateForTerm(plan, term) {
        const daily = parseFloat(plan.daily_roi || plan.dailyRoi || 0);
        const monthly = parseFloat(plan.monthly_roi || plan.monthlyRoi || (daily * 30).toFixed(2));
        const yearly = parseFloat(plan.yearly_roi || plan.yearlyRoi || (daily * 365).toFixed(2));

        return term === 'daily' ? daily : term === 'yearly' ? yearly : monthly;
    }

    function handlePlanInvestment(planId) {
        if (!isAuthenticated) {
            alert('Please login to invest.');
            window.location.href = loginUrl;
            return;
        }

        const plan = plans.find(p => p.id == parseInt(planId, 10));
        if (!plan) {
            console.error('Selected plan not found:', planId);
            alert('Unable to locate the selected investment plan.');
            return;
        }

        const amountInput = document.getElementById(`inp-${planId}`);
        if (!amountInput) {
            console.error('Amount input not found for plan:', planId);
            alert('Unable to read the investment amount.');
            return;
        }

        let amount = parseFloat(amountInput.value) || (plan.minimum_investment || plan.min);
        if (amount < (plan.minimum_investment || plan.min)) {
            amount = plan.minimum_investment || plan.min;
        }
        if (amount > (plan.maximum_investment || plan.max)) {
            amount = plan.maximum_investment || plan.max;
        }

        const term = plan.termType || 'monthly';
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        console.log('Investing in plan:', planId, 'amount:', amount, 'term:', term);

        fetch(investEndpoint, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                plan_id: planId,
                amount: amount,
                term: term
            }),
        })
            .then(async response => {
                const contentType = response.headers.get('content-type') || '';
                const isJson = contentType.includes('application/json');
                const data = isJson ? await response.json().catch(() => ({})) : {};
                console.log('Invest response', response.status, response.statusText, data);

                if (response.ok) {
                    alert(data.message || 'Investment created successfully.');
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return;
                    }
                    window.location.href = deployBotUrl;
                    return;
                }

                if (response.status === 401 || response.status === 419) {
                    window.location.href = loginUrl;
                    return;
                }

                if (!isJson) {
                    alert('Unable to create investment. Please login or try again.');
                    return;
                }

                alert(data.message || 'Unable to create investment. Please login or try again.');
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            })
            .catch((error) => {
                console.error('Investment request failed:', error);
                alert('Network error. Please try again.');
            });
    }

    function getCurrencyDisplay(amount) {
        return `$${parseFloat(amount || 0).toFixed(2)}`;
    }

    // 5. Portfolio Allocation Visualization (Simulation)
    const allocationChartElement = document.getElementById('allocationChart');

    if (allocationChartElement && typeof Chart !== 'undefined') {
        const ctx = allocationChartElement.getContext('2d');
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
    } else if (typeof Chart === 'undefined') {
        console.warn("Chart.js library is not loaded. Allocation chart will not render.");
    }
});