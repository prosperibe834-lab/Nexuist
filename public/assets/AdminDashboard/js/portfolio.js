// Preloader starts here

// =========================================================
// HIGH-FIDELITY AUTOMATED PRELOADER ENGINE
// =========================================================
(function() {
    const preloaderElement = document.getElementById("nexuist-preloader");
    
    if (preloaderElement) {
        // Core removal helper function
        const dismissLoader = () => {
            if (!preloaderElement.classList.contains("loaded")) {
                preloaderElement.classList.add("loaded");
                console.log("System Initialized: Nexuist environment online.");
            }
        };

        // 1. DISMISS ON WINDOW COMPLETE LOAD (Standard Behavior)
        window.addEventListener("load", dismissLoader);

        // 2. DISMISS AUTOMATICALLY AFTER 2 SECONDS (Failsafe Backup Loop)
        // This guarantees that if a script or chart fails, the loader still drops away.
        setTimeout(dismissLoader, 2000);
    }
})();
// Preloader ends here 

document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("sidebar-toggle-btn");
    const mobileMenuBtn = document.getElementById("mobile-hamburger-btn");
    const modeToggle = document.querySelector(".mode-toggle-wrapper");
    const modeIcon = document.querySelector(".mode-icon-indicator");
    const modeLabel = document.querySelector(".mode-label");
    const navLinks = document.querySelectorAll(".nav-links > li:not(.control-items)");
    const pageTitle = document.getElementById("page-title-display");

    // =========================================
    // DESKTOP SIDEBAR COLLAPSE TOGGLE
    // =========================================
    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    }

    // =========================================
    // MOBILE DRAWER HAMBURGER TRIGGER
    // =========================================
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            sidebar.classList.toggle("open");
        });
    }

    // Close mobile menu if clicked outside the sidebar drawer area
    document.addEventListener("click", (e) => {
        if (window.innerWidth <= 576 && !sidebar.contains(e.target) && sidebar.classList.contains("open")) {
            sidebar.classList.remove("open");
        }
    });

    // =========================================
    // PERSISTENT LIGHT & DARK THEME ENGINE
    // =========================================
    const savedTheme = localStorage.getItem("theme") || "dark";
    document.documentElement.setAttribute("data-theme", savedTheme);
    updateThemeUI(savedTheme);

    if (modeToggle) {
        modeToggle.addEventListener("click", () => {
            const currentTheme = document.documentElement.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";
            
            document.documentElement.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);
            updateThemeUI(newTheme);
        });
    }

    function updateThemeUI(theme) {
        if (!modeIcon || !modeLabel) return;
        if (theme === "light") {
            modeIcon.className = "bx bx-sun mode-icon-indicator";
            modeLabel.textContent = "Light Mode";
        } else {
            modeIcon.className = "bx bx-moon mode-icon-indicator";
            modeLabel.textContent = "Dark Mode";
        }
    }

    // =========================================
    // ACTIVE ROUTE ROUTING HANDLING
    // =========================================
    navLinks.forEach(linkItem => {
        const anchor = linkItem.querySelector("a");
        if (!anchor) return;

        anchor.addEventListener("click", function(e) {
            // Remove active tags styling across alternate nodes
            navLinks.forEach(item => item.classList.remove("active"));
            
            // Highlight current clicked node
            linkItem.classList.add("active");

            // Extract text string to dynamic header element
            const textSpan = linkItem.querySelector(".link_name");
            if (textSpan && pageTitle) {
                pageTitle.textContent = textSpan.textContent;
            }

            // Close mobile tray automatically if route fired
            if (window.innerWidth <= 576) {
                sidebar.classList.remove("open");
            }
        });
    });
});

// Main Section starts here
document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById('user-hub-search');

    function applyUserSearchFilter() {
        const query = searchInput?.value.toLowerCase() || '';
        document.querySelectorAll('.nx-hub-user-card').forEach(card => {
            const name = card.getAttribute('data-name')?.toLowerCase() || '';
            const uid = card.getAttribute('data-uid')?.toLowerCase() || '';
            if (name.includes(query) || uid.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', applyUserSearchFilter);
    }

    function bindUserCardEvents() {
        const userCards = document.querySelectorAll('.nx-hub-user-card');
        userCards.forEach(card => {
            card.addEventListener('click', () => {
                userCards.forEach(c => c.classList.remove('active-hub-node'));
                card.classList.add('active-hub-node');

                const name = card.getAttribute('data-name');
                const uid = card.getAttribute('data-uid');
                const email = card.getAttribute('data-email');
                const netWorth = card.getAttribute('data-net-worth');
                const pendingDep = card.getAttribute('data-pending-deposit');
                const totalInv = card.getAttribute('data-total-invested');
                const roi = card.getAttribute('data-roi');
                const winRate = card.getAttribute('data-win-rate');
                const profitFactor = card.getAttribute('data-profit-factor');
                const pool = card.getAttribute('data-investment-pool');
                const txid = card.getAttribute('data-txid');
                const txGateway = card.getAttribute('data-tx-gateway');
                const txAmt = card.getAttribute('data-tx-amount');
                const txDate = card.getAttribute('data-tx-date');
                const txStatus = card.getAttribute('data-tx-status');

                document.getElementById('dyn-user-name').textContent = name;
                document.getElementById('dyn-user-uid').textContent = `UID: ${uid}`;
                document.getElementById('dyn-user-email').textContent = email;
                document.getElementById('dyn-net-worth').textContent = netWorth;
                document.getElementById('dyn-pending-deposit').textContent = pendingDep;
                document.getElementById('dyn-total-invested').textContent = totalInv;
                document.getElementById('dyn-investment-pool').textContent = pool;
                document.getElementById('dyn-roi').textContent = roi;
                document.getElementById('dyn-win-rate').textContent = winRate;
                document.getElementById('dyn-profit-factor').textContent = profitFactor;
                document.getElementById('dyn-txid').textContent = txid;
                document.getElementById('dyn-tx-gateway').innerHTML = `<i class='bx bxl-bitcoin'></i> ${txGateway}`;
                document.getElementById('dyn-tx-amount').textContent = txAmt;
                document.getElementById('dyn-tx-date').textContent = txDate;
                const statusBadge = document.getElementById('dyn-tx-status');
                statusBadge.textContent = txStatus;
                statusBadge.className = `status-pill state-${txStatus.toLowerCase()}`;
            });
        });
    }

    window.bindUserCardEvents = bindUserCardEvents;
    window.applyUserSearchFilter = applyUserSearchFilter;
});

document.addEventListener("DOMContentLoaded", () => {
    // Existing elements
    const messageBtn = document.querySelector('.btn-hub-action.secondary');
    const suspendBtn = document.querySelector('.btn-hub-action.danger');
    
    // Modal structural nodes
    const msgModal = document.getElementById('hub-message-modal');
    const suspModal = document.getElementById('hub-suspend-modal');
    
    // --- OPEN MESSAGE MODAL ---
    if (messageBtn && msgModal) {
        messageBtn.addEventListener('click', () => {
            const currentUserName = document.getElementById('dyn-user-name').textContent;
            document.getElementById('modal-msg-username').textContent = currentUserName;
            msgModal.style.display = 'flex'; // show the modal window
        });
    }

    // Close Message Modal
    document.getElementById('close-msg-modal')?.addEventListener('click', () => {
        msgModal.style.display = 'none';
    });

    // Handle sending the message
    document.getElementById('send-msg-submit')?.addEventListener('click', () => {
        const text = document.getElementById('hub-message-text').value;
        const currentUserName = document.getElementById('dyn-user-name').textContent;
        
        if (!text.trim()) {
            alert('Please type a message before submitting.');
            return;
        }

        // Action confirmation simulation
        alert(`System Alert: Direct Message securely transmitted to ${currentUserName}!`);
        document.getElementById('hub-message-text').value = ''; // clear input
        msgModal.style.display = 'none';
    });


    // --- OPEN SUSPEND MODAL ---
    if (suspendBtn && suspModal) {
        suspendBtn.addEventListener('click', () => {
            const currentUserName = document.getElementById('dyn-user-name').textContent;
            document.getElementById('modal-susp-username').textContent = currentUserName;
            suspModal.style.display = 'flex';
        });
    }

    // Close Suspend Modal
    document.getElementById('close-susp-modal')?.addEventListener('click', () => {
        suspModal.style.display = 'none';
    });

    // Handle executing the user suspension
    document.getElementById('confirm-susp-submit')?.addEventListener('click', () => {
        const currentUserName = document.getElementById('dyn-user-name').textContent;
        
        // Visual indicator update: update status badge color instantly to show it worked
        const activeNodeInSidebar = document.querySelector('.nx-hub-user-card.active-hub-node');
        if (activeNodeInSidebar) {
            const balanceSubtext = activeNodeInSidebar.querySelector('.hub-user-balance');
            balanceSubtext.innerHTML = `<span style="color: #ef4444; font-weight: bold;">[ SUSPENDED ]</span>`;
        }

        alert(`Administrative Notice: ${currentUserName}'s credentials have been blacklisted.`);
        suspModal.style.display = 'none';
    });
});

function initializeUserCards() {
    const userCards = document.querySelectorAll('.nx-hub-user-card');
    userCards.forEach(card => {
        card.addEventListener('click', () => {
            userCards.forEach(c => c.classList.remove('active-hub-node'));
            card.classList.add('active-hub-node');

            const name = card.getAttribute('data-name');
            const uid = card.getAttribute('data-uid');
            const email = card.getAttribute('data-email');
            const netWorth = card.getAttribute('data-net-worth');
            const pendingDep = card.getAttribute('data-pending-deposit');
            const totalInv = card.getAttribute('data-total-invested');
            const roi = card.getAttribute('data-roi');
            const winRate = card.getAttribute('data-win-rate');
            const profitFactor = card.getAttribute('data-profit-factor');
            const pool = card.getAttribute('data-investment-pool');
            const txid = card.getAttribute('data-txid');
            const txGateway = card.getAttribute('data-tx-gateway');
            const txAmt = card.getAttribute('data-tx-amount');
            const txDate = card.getAttribute('data-tx-date');
            const txStatus = card.getAttribute('data-tx-status');

            document.getElementById('dyn-user-name').textContent = name;
            document.getElementById('dyn-user-uid').textContent = `UID: ${uid}`;
            document.getElementById('dyn-user-email').textContent = email;
            document.getElementById('dyn-net-worth').textContent = netWorth;
            document.getElementById('dyn-pending-deposit').textContent = pendingDep;
            document.getElementById('dyn-total-invested').textContent = totalInv;
            document.getElementById('dyn-investment-pool').textContent = pool;
            document.getElementById('dyn-roi').textContent = roi;
            document.getElementById('dyn-win-rate').textContent = winRate;
            document.getElementById('dyn-profit-factor').textContent = profitFactor;
            document.getElementById('dyn-txid').textContent = txid;
            document.getElementById('dyn-tx-gateway').innerHTML = `<i class='bx bxl-bitcoin'></i> ${txGateway}`;
            document.getElementById('dyn-tx-amount').textContent = txAmt;
            document.getElementById('dyn-tx-date').textContent = txDate;
            const statusBadge = document.getElementById('dyn-tx-status');
            statusBadge.textContent = txStatus;
            statusBadge.className = `status-pill state-${txStatus.toLowerCase()}`;
        });
    });
}

async function fetchAdminPortfolioData() {
    try {
        const response = await fetch('/api/admin/portfolio', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        const data = await response.json();

        if (!data.success) {
            console.error('Failed loading admin portfolio', data.message || data);
            return;
        }

        const container = document.getElementById('hub-user-nodes-container');
        if (!container) return;

        container.innerHTML = data.users.map(user => `
            <div class="nx-hub-user-card" data-uid="${user.uid}" data-name="${user.name}" data-email="${user.email}"
                data-net-worth="${user.net_worth}" data-pending-deposit="${user.pending_deposit}"
                data-total-invested="${user.total_invested}" data-roi="${user.roi}" data-win-rate="${user.win_rate}"
                data-profit-factor="${user.profit_factor}" data-investment-pool="${user.investment_pool}"
                data-txid="${user.pending_transaction.txid}" data-tx-gateway="${user.pending_transaction.gateway}"
                data-tx-amount="${user.pending_transaction.amount}" data-tx-date="${user.pending_transaction.date}"
                data-tx-status="${user.pending_transaction.status}">
                <div class="hub-avatar bg-gradient-blue">${user.name.split(' ').map(n => n[0]).join('').slice(0,2).toUpperCase()}</div>
                <div class="hub-user-meta">
                    <strong class="hub-user-name">${user.name}</strong>
                    <span class="hub-user-uid">UID: ${user.uid}</span>
                    <span class="hub-user-balance">Net Capital: ${user.net_worth}</span>
                </div>
            </div>
        `).join('');

        initializeUserCards();
        document.querySelector('.nx-hub-user-card')?.click();
    } catch (error) {
        console.error('Admin portfolio load failed', error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    fetchAdminPortfolioData();
});