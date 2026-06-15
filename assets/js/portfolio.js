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
// Sample Portfolio Data
const myPortfolio = [
    { name: "Aleksei Volkov", gain: "+$1,240.50", roi: "18.4%", img: "https://i.pravatar.cc/150?u=a" },
    { name: "Maria Rodriguez", gain: "+$840.20", roi: "12.1%", img: "https://i.pravatar.cc/150?u=m" },
    { name: "David Chen", gain: "-$120.00", roi: "-2.4%", img: "https://i.pravatar.cc/150?u=d" }
];

function renderPortfolioView() {
    const list = document.getElementById('activeTradersList');
    list.innerHTML = myPortfolio.map(t => `
        <div class="active-trader-card">
            <div class="trader-info-mini">
                <img src="${t.img}">
                <div><strong>${t.name}</strong><br><small>Copying</small></div>
            </div>
            <div class="sparkline-container">
                </div>
            <div class="gain-indicator">
                <h4>${t.gain}</h4>
                <small>${t.roi} Total Return</small>
            </div>
            <button class="btn-outline-danger" style="font-size: 10px; padding: 5px;">Close Trade</button>
        </div>
    `).join('');
}

// Live Feed Simulator
function startLiveFeed() {
    const feed = document.getElementById('liveFeed');
    const names = ["Sarah J.", "Mike T.", "Elena R.", "Liam H."];
    
    setInterval(() => {
        const name = names[Math.floor(Math.random() * names.length)];
        const profit = (Math.random() * 50).toFixed(2);
        
        const div = document.createElement('div');
        div.className = 'feed-item fade-in';
        div.innerHTML = `
            <span>${name} just closed a trade</span>
            <span class="profit">+$${profit}</span>
        `;
        
        feed.prepend(div);
        if(feed.children.length > 15) feed.lastChild.remove();
    }, 3000);
}

// 1. Updated Render Function
function renderPortfolioView() {
    const list = document.getElementById('activeTradersList');
    
    // Check if portfolio is empty
    if (myPortfolio.length === 0) {
        list.innerHTML = `<div class="empty-state">No active trades. Go to Marketplace to start.</div>`;
        return;
    }

    list.innerHTML = myPortfolio.map((t, index) => `
        <div class="active-trader-card" id="trader-card-${index}">
            <div class="trader-info-mini">
                <img src="${t.img}">
                <div><strong>${t.name}</strong><br><small>Copying</small></div>
            </div>
            <div class="sparkline-container"></div>
            <div class="gain-indicator">
                <h4>${t.gain}</h4>
                <small>${t.roi} Total Return</small>
            </div>
            <button class="btn-close-trade" onclick="closeTrade(${index})">
                <i class="fas fa-times"></i> Close Trade
            </button>
        </div>
    `).join('');
}

// 2. The Logic to Remove the Trade
function closeTrade(index) {
    const card = document.getElementById(`trader-card-${index}`);
    
    // Add a confirmation to prevent accidental clicks
    if (confirm("Are you sure you want to stop copying this trader and liquidate your position?")) {
        
        // Add the animation class
        card.classList.add('removing');

        // Wait for animation to finish, then remove data and re-render
        setTimeout(() => {
            myPortfolio.splice(index, 1); // Remove the item from the data array
            renderPortfolioView(); // Refresh the list
            updateTotalBalance(); // Update the big numbers at the top
        }, 400);
    }
}

// 3. Update the Top Summary Balance
function updateTotalBalance() {
    let total = 0;
    myPortfolio.forEach(item => {
        // Simple logic to strip the '$' and ',' to calculate
        let val = parseFloat(item.gain.replace('$', '').replace('+', '').replace(',', ''));
        total += val;
    });
    
    const equityEl = document.getElementById('total-equity');
    if(equityEl) {
        equityEl.innerText = `$${(12450 + total).toLocaleString()}`; // Base balance + gains
    }
}

// Initialize
renderPortfolioView();
startLiveFeed();