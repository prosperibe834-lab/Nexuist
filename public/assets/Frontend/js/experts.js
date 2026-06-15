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
        if (
            !qtDropdownBtn.contains(e.target) &&
            !qtDropdownMenu.contains(e.target)
        ) {
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
const traders = window.APP_EXPERTS || [];
const grid = document.getElementById('expertsGrid');
const searchInput = document.getElementById('expertSearch');
const sortFilter = document.getElementById('sortFilter');
let selectedExpertId = null;

function render(data) {
    if (!grid) return;
    if (!data.length) {
        grid.innerHTML = `<div style="grid-column: 1/-1; text-align: center; padding: 50px; color: var(--text-secondary);">No traders found.</div>`;
        return;
    }

    grid.innerHTML = data.map((t, index) => `
        <div class="expert-card" style="animation-delay: ${index * 0.03}s">
            <div class="card-top">
                <div class="avatar-container">
                    <img src="${t.img}" alt="${t.name}">
                    <div class="online-status"></div>
                </div>
                <div>
                    <h3>${t.name}</h3>
                    <small class="strategy-badge">${t.strategy}</small>
                </div>
            </div>
            <div class="card-stats">
                <div class="stat-box">
                    <small>ROI</small>
                    <strong class="success">+${Number(t.roi).toFixed(1)}%</strong>
                </div>
                <div class="stat-box">
                    <small>Win Rate</small>
                    <strong>${Number(t.winRate).toFixed(0)}%</strong>
                </div>
            </div>
            <button class="copy-btn" onclick="openCopyDetail(${t.id})">
                <i class="fas fa-bolt" style="margin-right: 8px;"></i> Start Copy Trading
            </button>
        </div>
    `).join('');
}

if (sortFilter) {
    sortFilter.addEventListener('change', () => {
        const sortBy = sortFilter.value;
        let sorted = [...traders];
        if (sortBy === 'roi') sorted.sort((a, b) => b.roi - a.roi);
        if (sortBy === 'winRate') sorted.sort((a, b) => b.winRate - a.winRate);
        if (sortBy === 'copiers') sorted.sort((a, b) => (b.total_subscribers || 0) - (a.total_subscribers || 0));
        render(sorted);
    });
}

if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const val = e.target.value.toLowerCase();
        const filtered = traders.filter(t =>
            t.name.toLowerCase().includes(val) ||
            t.strategy.toLowerCase().includes(val) ||
            (t.description || '').toLowerCase().includes(val)
        );
        render(filtered);
    });
}

function openCopyDetail(id) {
    const trader = traders.find(t => t.id === id);
    if (!trader) return;

    selectedExpertId = trader.id;

    const marketplaceView = document.getElementById('marketplaceView');
    const copyDetailView = document.getElementById('copyDetailView');

    if (marketplaceView) marketplaceView.classList.add('hidden');
    if (copyDetailView) copyDetailView.classList.remove('hidden');

    document.getElementById('detailName').innerText = trader.name;
    document.getElementById('detailImg').src = trader.img;
    document.getElementById('detailRoi').innerText = `+${Number(trader.roi).toFixed(1)}%`;
    document.getElementById('detailWin').innerText = `${Number(trader.winRate).toFixed(0)}%`;
    document.getElementById('detailEquity').innerText = `$${Number(trader.equity).toLocaleString()}`;
    document.getElementById('detailStrategy').innerText = trader.strategy;
    document.getElementById('minLimit').innerText = `Min: $${Number(trader.min).toLocaleString()}`;
    document.getElementById('investAmount').value = trader.min || 0;
}

function showMarketplace() {
    const marketplaceView = document.getElementById('marketplaceView');
    const copyDetailView = document.getElementById('copyDetailView');

    if (copyDetailView) copyDetailView.classList.add('hidden');
    if (marketplaceView) marketplaceView.classList.remove('hidden');
}

function confirmInvestment() {
    const amountInput = document.getElementById('investAmount');
    const amount = amountInput ? amountInput.value : '';
    const btn = document.querySelector('.confirm-btn');

    if (!selectedExpertId) {
        alert('Please select an expert to copy.');
        return;
    }

    if (!amount || Number(amount) <= 0) {
        alert('Please enter a valid investment amount.');
        return;
    }

    if (btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing Assets...';
        btn.style.opacity = '0.7';
        btn.style.pointerEvents = 'none';
    }

    fetch(`/bot/invest/${selectedExpertId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ amount })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.href = data.redirect || '/deploybot';
            return;
        }

        alert(data.message || 'Unable to process the investment.');
        if (data.redirect) {
            window.location.href = data.redirect;
        }
    })
    .catch(error => {
        console.error('Investment error:', error);
        alert('An error occurred while placing the investment. Please try again.');
    })
    .finally(() => {
        if (btn) {
            btn.innerHTML = 'Confirm & Start Copying';
            btn.style.opacity = '1';
            btn.style.pointerEvents = 'auto';
        }
    });
}

render(traders);

