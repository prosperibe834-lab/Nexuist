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
            sidebar.classList.toggle('active');
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
        if (window.innerWidth <= 900 && sidebar.classList.contains('active')) {
            if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                sidebar.classList.remove('active');
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
    const originalBalanceText = balanceAmount ? balanceAmount.textContent.trim() : '';

    if (toggleBalanceBtn && balanceAmount) {
        toggleBalanceBtn.addEventListener('click', () => {
            isHidden = !isHidden;
            if (isHidden) {
                balanceAmount.textContent = '*******';
                eyeIcon?.setAttribute('data-icon', 'ri:eye-off-line');
            } else {
                balanceAmount.textContent = originalBalanceText || '$0.00';
                eyeIcon?.setAttribute('data-icon', 'ri:eye-line');
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
function getJson(url) {
    return fetch(url, { credentials: 'same-origin', headers: { Accept: 'application/json' } })
        .then(response => {
            if (!response.ok) throw new Error('Failed to load portfolio data');
            return response.json();
        });
}

document.addEventListener("DOMContentLoaded", () => {
    const emptyState = document.getElementById("emptyStateContainer");
    const tableContent = document.getElementById("tableContentContainer");
    const tableBody = document.getElementById("holdingsTableBody");
    const btnClear = document.getElementById("btnClearStorage");

    const displayTotal = document.getElementById("statTotalInvested");
    const displayProfit = document.getElementById("statTotalProfit");
    const displayCount = document.getElementById("statActiveCount");
    const displayAvgApy = document.getElementById("statAvgApy");
    const displayTokens = document.getElementById("statTotalTokens");

    const premiumBtn = document.querySelector(".btn-premium-action");
    const toast = document.getElementById("compoundingToast");

    function formatMoney(value) {
        return `$${Number(value || 0).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
    }

    function renderPortfolio(items, summary = {}) {
        if (!tableBody || !displayTotal || !displayProfit || !displayCount || !displayAvgApy || !displayTokens) {
            return;
        }

        if (!items || items.length === 0) {
            if (emptyState) emptyState.classList.remove("hidden");
            if (tableContent) tableContent.classList.add("hidden");
            displayTotal.innerText = "$0.00";
            displayProfit.innerText = "$0.00";
            displayCount.innerText = "0 Properties";
            displayTokens.innerText = "0.00 Total Tokens Owned";
            displayAvgApy.innerText = "0.0% Avg. Estimated APY";
            tableBody.innerHTML = "";
            return;
        }

        if (emptyState) emptyState.classList.add("hidden");
        if (tableContent) tableContent.classList.remove("hidden");
        tableBody.innerHTML = "";

        let totalInvested = 0;
        let totalTokens = 0;
        let totalApy = 0;

        items.forEach(item => {
            const amount = Number(item.investment_amount || item.amount || 0);
            const tokens = Number(item.tokens_purchased || item.tokens || 0);
            const apy = Number(item.apy || 0);

            totalInvested += amount;
            totalTokens += tokens;
            totalApy += apy;

            const row = document.createElement("tr");
            row.innerHTML = `
                <td>
                    <div style="font-weight: 600; color: #fff;">${item.property?.property_name || item.title || 'Real Estate Asset'}</div>
                    <div style="font-size: 0.78rem; color: #8492a6;"><i class='bx bx-map'></i> ${item.property?.city || item.location || 'Unknown'}</div>
                </td>
                <td style="font-weight: 600;">${formatMoney(amount)}</td>
                <td style="color: #3b82f6; font-weight: 500;">${tokens.toFixed(2)} tokens</td>
                <td style="color: #10b981;">${apy.toFixed(1)}% APY</td>
                <td><span class="status-badge active"><i class='bx bx-check-circle'></i> Earning</span></td>
            `;
            tableBody.appendChild(row);
        });

        const averageApy = items.length ? (totalApy / items.length).toFixed(1) : '0.0';
        const profit = summary.total_accrued_profit ?? summary.total_profit ?? (totalInvested * (Number(averageApy) / 100) * 0.045);

        displayTotal.innerText = formatMoney(summary.total_invested ?? totalInvested);
        displayProfit.innerText = formatMoney(profit);
        displayCount.innerText = `${items.length} ${items.length === 1 ? 'Property' : 'Properties'}`;
        displayTokens.innerText = `${totalTokens.toLocaleString(undefined, { maximumFractionDigits: 2 })} Total Tokens Owned`;
        displayAvgApy.innerText = `${summary.average_apy?.toFixed(1) ?? averageApy}% Avg. Estimated APY`;
    }

    async function loadPortfolio() {
        try {
            const response = await getJson('/api/real-estate/portfolio');
            const items = Array.isArray(response.investments) ? response.investments : [];
            renderPortfolio(items, response.summary || {});
        } catch (error) {
            console.warn('Portfolio fetch failed, falling back to local simulation.', error);
            const fallback = JSON.parse(localStorage.getItem("portfolioHoldings")) || [];
            renderPortfolio(fallback, {});
        }
    }

    if (btnClear) {
        btnClear.addEventListener("click", () => {
            localStorage.removeItem("portfolioHoldings");
            loadPortfolio();
        });
    }

    if (premiumBtn && toast) {
        premiumBtn.addEventListener("click", () => {
            const isActive = premiumBtn.classList.toggle("compounding-active");
            premiumBtn.innerText = isActive ? "Disable Auto-Compounding" : "Enable Auto-Compounding";
            toast.classList.toggle("show-toast", isActive);
            if (isActive) {
                setTimeout(() => toast.classList.remove("show-toast"), 4000);
            }
        });
    }

    loadPortfolio();
});