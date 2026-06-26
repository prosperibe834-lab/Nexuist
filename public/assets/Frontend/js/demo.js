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
    // 1. Gather Required Application DOM Nodes
    const virtualBalanceDisplay = document.getElementById("virtualBalanceDisplay");
    const statTotalTrades = document.getElementById("statTotalTrades");
    const statWinRate = document.getElementById("statWinRate");
    const statTotalPnL = document.getElementById("statTotalPnL");
    const statActiveTrades = document.getElementById("statActiveTrades");
    const positionBadgeCount = document.getElementById("positionBadgeCount");
    const resetTriggers = document.querySelectorAll(".resetAccountTrigger");

    // 2. Attach Click Action Events to All Reset Target Configurations
    resetTriggers.forEach(trigger => {
        trigger.addEventListener("click", (e) => {
            e.preventDefault();
            
            // Execute Account State Environment Wipe
            executeVirtualBalanceReset();
        });
    });

    // 3. Functional Environment Execution Logic Engine
    function executeVirtualBalanceReset() {
        // Safe check to verify display metric target layer is mounted
        if (virtualBalanceDisplay) {
            
            // Re-initialize core platform variables to factory states
            virtualBalanceDisplay.textContent = "$100,000.00";
            
            if (statTotalTrades) statTotalTrades.textContent = "0";
            if (statWinRate) statWinRate.textContent = "0%";
            if (statActiveTrades) statActiveTrades.textContent = "0";
            if (positionBadgeCount) positionBadgeCount.textContent = "0 Active";
            
            if (statTotalPnL) {
                statTotalPnL.textContent = "$0.00";
                statTotalPnL.className = "neutral-pnl"; // Clear tracking colors
            }

            // Trigger structural text flash animation
            virtualBalanceDisplay.classList.remove("balance-flash");
            void virtualBalanceDisplay.offsetWidth; // Force DOM browser reflow update
            virtualBalanceDisplay.classList.add("balance-flash");

            console.log("Demo trading profile database metrics successfully purged and re-allocated.");
        }
    }

    // --- 4. Load demo dashboard data from backend and render UI ---
    async function loadDemoDashboard() {
        try {
            const res = await fetch('/api/demo/dashboard', { method: 'GET', credentials: 'same-origin' });
            if (!res.ok) throw new Error('Failed to fetch demo dashboard');
            const data = await res.json();

            // balance
            if (virtualBalanceDisplay && data.stats && typeof data.stats.totalBalance !== 'undefined') {
                virtualBalanceDisplay.textContent = `$${Number(data.stats.totalBalance).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
            }

            // stats
            if (statTotalTrades) statTotalTrades.textContent = data.stats?.totalTrades ?? '0';
            if (statWinRate) statWinRate.textContent = (data.stats?.winRate ? `${data.stats.winRate}%` : '0%');
            if (statTotalPnL) {
                statTotalPnL.textContent = `$${Number(data.stats?.totalPnl ?? 0).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                statTotalPnL.className = data.stats?.totalPnl > 0 ? 'positive-pnl' : (data.stats?.totalPnl < 0 ? 'negative-pnl' : 'neutral-pnl');
            }
            if (statActiveTrades) statActiveTrades.textContent = data.stats?.activePositions ?? '0';
            if (positionBadgeCount) positionBadgeCount.textContent = `${data.stats?.activePositions ?? 0} Active`;

            // render live positions into panel
            const livePanel = document.querySelector('.live-positions-panel');
            const emptyWrapper = document.getElementById('emptyPositionsWrapper');
            if (Array.isArray(data.openPositions) && data.openPositions.length) {
                // remove empty state
                if (emptyWrapper) emptyWrapper.style.display = 'none';

                // create list container if not exists
                let list = document.getElementById('positionsList');
                if (!list) {
                    list = document.createElement('div');
                    list.id = 'positionsList';
                    list.className = 'positions-list';
                    list.style.padding = '12px';
                    livePanel.appendChild(list);
                }

                list.innerHTML = data.openPositions.map(pos => `
                    <div class="position-row">
                        <div class="pos-left"><strong>${pos.user}</strong> • ${pos.asset}</div>
                        <div class="pos-right">
                            <span class="dir">${pos.direction}</span>
                            <span class="amt">$${Number(pos.amount).toLocaleString(undefined, {minimumFractionDigits:2})}</span>
                        </div>
                    </div>
                `).join('');
            } else {
                if (emptyWrapper) emptyWrapper.style.display = 'block';
                const list = document.getElementById('positionsList');
                if (list) list.remove();
            }

        } catch (err) {
            console.error('Error loading demo dashboard:', err);
        }
    }

    // Call initial load
    loadDemoDashboard();

    // Replace local reset to call backend reset as well
    async function executeVirtualBalanceResetRemote() {
        try {
            const res = await fetch('/api/demo/reset', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '' }, credentials: 'same-origin' });
            if (!res.ok) throw new Error('Reset failed');
            // refresh UI
            await loadDemoDashboard();
            // small flash
            if (virtualBalanceDisplay) {
                virtualBalanceDisplay.classList.remove('balance-flash');
                void virtualBalanceDisplay.offsetWidth;
                virtualBalanceDisplay.classList.add('balance-flash');
            }
        } catch (err) {
            console.error('Remote reset failed:', err);
        }
    }

    // Override reset triggers to use remote reset when available
    resetTriggers.forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            executeVirtualBalanceResetRemote();
        });
    });
});