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


const portfolioState = {
    summary: {
        current_portfolio_value: 0,
        total_invested: 0,
        open_positions: 0,
        closed_positions: 0,
        total_profit: 0,
    },
    positions: [],
};

function formatCurrency(value) {
    return '$' + Number(value || 0).toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    });
}

function renderPortfolioView() {
    const list = document.getElementById('activeTradersList');
    if (!list) return;

    if (portfolioState.positions.length === 0) {
        list.innerHTML = `<div class="empty-state">No active positions found. Open a trade to populate your portfolio.</div>`;
        return;
    }

    list.innerHTML = portfolioState.positions.map((position) => {
        const closeButton = position.closeable
            ? `<button class="btn-close-trade" onclick="closePortfolioTrade(${position.id})">Close Position</button>`
            : '';

        return `
            <div class="active-trader-card">
                <div class="trader-info-mini">
                    <div>
                        <strong>${position.title}</strong>
                        <small>${position.type.replace('_', ' ').toUpperCase()}</small>
                    </div>
                </div>
                <div class="sparkline-container"></div>
                <div class="gain-indicator">
                    <h4>${formatCurrency(position.current_value)}</h4>
                    <small>${position.status === 'OPEN' ? 'Open' : 'Closed'} • Profit ${formatCurrency(position.profit)}</small>
                </div>
                ${closeButton}
            </div>
        `;
    }).join('');
}

function renderPortfolioSummary() {
    const summary = portfolioState.summary;
    const totalEquity = document.getElementById('total-equity');
    const totalInvested = document.getElementById('total-invested');
    const openPositions = document.getElementById('open-positions');
    const closedPositions = document.getElementById('closed-positions');
    const totalProfit = document.getElementById('total-profit');
    const portfolioChange = document.getElementById('portfolio-change');

    if (totalEquity) totalEquity.innerText = formatCurrency(summary.current_portfolio_value);
    if (totalInvested) totalInvested.innerText = formatCurrency(summary.total_invested);
    if (openPositions) openPositions.innerText = summary.open_positions;
    if (closedPositions) closedPositions.innerText = summary.closed_positions;
    if (totalProfit) totalProfit.innerText = formatCurrency(summary.total_profit);

    if (portfolioChange) {
        const percent = summary.total_invested > 0 ? (summary.total_profit / Math.max(summary.total_invested, 1)) * 100 : 0;
        portfolioChange.innerHTML = `<i class="fas fa-caret-${percent >= 0 ? 'up' : 'down'}"></i> ${percent.toFixed(1)}% Today`;
        portfolioChange.classList.toggle('txt-green', percent >= 0);
        portfolioChange.classList.toggle('txt-red', percent < 0);
    }
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
}

async function fetchPortfolioData() {
    try {
        const response = await fetch('/api/portfolio', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        const data = await response.json();

        if (!data.success) {
            console.error('Portfolio fetch failed', data.message || data);
            return;
        }

        portfolioState.summary = data.summary || portfolioState.summary;
        portfolioState.positions = data.positions || [];

        renderPortfolioSummary();
        renderPortfolioView();
    } catch (error) {
        console.error('Unable to load portfolio data', error);
    }
}

async function closePortfolioTrade(tradeId) {
    if (!confirm('Close this trade position? This action is irreversible.')) {
        return;
    }

    try {
        const response = await fetch(`/api/demo/trade/${tradeId}/close`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'X-Requested-With': 'XMLHttpRequest',
            },
        });

        const data = await response.json();
        if (!data.success) {
            alert(data.message || 'Could not close the trade.');
            return;
        }

        await fetchPortfolioData();
    } catch (error) {
        console.error('Close trade failed', error);
        alert('Failed to close trade. Try again later.');
    }
}

function startLiveFeed() {
    const feed = document.getElementById('liveFeed');
    const names = ['Sarah J.', 'Mike T.', 'Elena R.', 'Liam H.'];

    setInterval(() => {
        if (!feed) return;
        const name = names[Math.floor(Math.random() * names.length)];
        const profit = (Math.random() * 50).toFixed(2);
        const div = document.createElement('div');
        div.className = 'feed-item fade-in';
        div.innerHTML = `
            <span>${name} just closed a trade</span>
            <span class="profit">+$${profit}</span>
        `;
        feed.prepend(div);
        if (feed.children.length > 15) {
            feed.lastChild.remove();
        }
    }, 3000);
}

fetchPortfolioData();
startLiveFeed();