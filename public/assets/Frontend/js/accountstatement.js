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


// Main Section starts here
let transactionData = [];

async function fetchStatementData() {
    try {
        const res = await fetch('/api/account/statement', { credentials: 'same-origin', headers: { Accept: 'application/json' } });
        if (!res.ok) throw new Error('Failed to fetch');
        const payload = await res.json();
        if (!payload.success) throw new Error(payload.message || 'Error');
        transactionData = payload.records || [];

        // populate currency filter options dynamically
        const currencySelect = document.getElementById('currencyFilter');
        if (currencySelect && payload.currencies) {
            // clear existing (keep 'all')
            const base = currencySelect.querySelector('option[value="all"]');
            currencySelect.innerHTML = '';
            currencySelect.appendChild(base);
            payload.currencies.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c; opt.text = c; currencySelect.appendChild(opt);
            });
        }
    } catch (err) {
        console.error('Statement fetch failed', err);
        // fallback to empty dataset and surface an inline error later
        transactionData = [];
        // remove preloader if present so user can see the page
        try {
            const pre = document.getElementById('fintech-preloader');
            if (pre) {
                pre.classList.add('preloader-hidden');
                setTimeout(() => pre.remove(), 600);
            }
        } catch (e) {
            console.error('Failed to remove preloader', e);
        }
    }
}

async function initTable() {
    const tableBody = document.getElementById('statementTableBody');
    const searchInput = document.getElementById('tableSearch');
    
    // --- STATE MANAGEMENT ---
    let currentPage = 1;
    const rowsPerPage = 5; 
    
    let currentFilters = {
        type: 'all',
        currency: 'all',
        status: 'all',
        search: '',
        dateRange: 'all'
    };

    // --- CORE RENDERING ENGINE ---
    function renderTable() {
        const now = new Date();

        // 1. Filter Logic
        const filteredData = transactionData.filter(item => {
            // Date Filter
            let matchesDate = true;
            if (currentFilters.dateRange !== 'all') {
                const itemDate = new Date(item.date);
                const diffTime = Math.abs(now - itemDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                matchesDate = diffDays <= parseInt(currentFilters.dateRange);
            }
            
            // Search, Type, Currency, Status Filters
            const matchesSearch = item.category.toLowerCase().includes(currentFilters.search) || 
                                 item.ref.toLowerCase().includes(currentFilters.search) ||
                                 item.destination.toLowerCase().includes(currentFilters.search);
            
            const matchesType = currentFilters.type === 'all' || item.type === currentFilters.type;
            const matchesCurrency = currentFilters.currency === 'all' || item.currency === currentFilters.currency;
            const matchesStatus = currentFilters.status === 'all' || item.status === currentFilters.status;

            return matchesDate && matchesSearch && matchesType && matchesCurrency && matchesStatus;
        });

        // 2. Pagination Math
        const totalPages = Math.ceil(filteredData.length / rowsPerPage) || 1;
        if (currentPage > totalPages) currentPage = totalPages;

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedData = filteredData.slice(start, end);

        // 3. Build Table HTML
        tableBody.innerHTML = paginatedData.length > 0 ? paginatedData.map(item => `
            <tr class="fade-in">
                <td class="icon-cell"><span class="iconify" data-icon="${item.icon}"></span></td>
                <td>${item.date}</td>
                <td><strong>${item.category}</strong></td>
                <td style="color: ${item.type === 'deposit' ? 'var(--color-green)' : 'var(--color-red)'}; font-weight: 600;">
                    ${item.type === 'deposit' ? '+' : '-'}${item.amount}
                </td>
                <td>${item.currency}</td>
                <td class="text-secondary">${item.destination}</td>
                <td style="font-family: monospace; font-size: 12px;">${item.ref}</td>
                <td><span class="status-pill status-${item.status}">${item.status}</span></td>
            </tr>
        `).join('') : `<tr><td colspan="8" style="text-align:center; padding: 50px; color: var(--text-secondary);">No records found.</td></tr>`;

        // 4. Update UI Elements
        document.getElementById('showing-count').innerText = `Showing ${paginatedData.length} of ${filteredData.length} transactions`;
        updatePaginationUI(totalPages);
    }

    // --- PAGINATION UI GENERATOR ---
    function updatePaginationUI(totalPages) {
        const paginationContainer = document.querySelector('.pagination');
        if (!paginationContainer) return;

        let html = `
            <button class="page-link" ${currentPage === 1 ? 'disabled' : ''} id="prevPage">
                <span class="iconify" data-icon="ri:arrow-left-s-line"></span>
            </button>
        `;

        for (let i = 1; i <= totalPages; i++) {
            html += `<button class="page-link ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }

        html += `
            <button class="page-link" ${currentPage === totalPages ? 'disabled' : ''} id="nextPage">
                <span class="iconify" data-icon="ri:arrow-right-s-line"></span>
            </button>
        `;

        paginationContainer.innerHTML = html;

        // Re-attach Events
        paginationContainer.querySelectorAll('.page-link[data-page]').forEach(btn => {
            btn.addEventListener('click', () => {
                currentPage = parseInt(btn.dataset.page);
                renderTable();
            });
        });

        document.getElementById('prevPage').onclick = () => { if(currentPage > 1) { currentPage--; renderTable(); } };
        document.getElementById('nextPage').onclick = () => { if(currentPage < totalPages) { currentPage++; renderTable(); } };
    }

    // --- GLOBAL EVENT LISTENERS ---
    
    // Search
    searchInput.addEventListener('input', (e) => {
        currentFilters.search = e.target.value.toLowerCase();
        currentPage = 1;
        renderTable();
    });

    // Category Tabs
    document.querySelectorAll('.type-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelector('.type-tab.active').classList.remove('active');
            tab.classList.add('active');
            currentFilters.type = tab.dataset.type;
            currentPage = 1;
            renderTable();
        });
    });

    // Dropdown Selects
    document.getElementById('dateFilter').addEventListener('change', (e) => { currentFilters.dateRange = e.target.value; currentPage = 1; renderTable(); });
    document.getElementById('currencyFilter').addEventListener('change', (e) => { currentFilters.currency = e.target.value; currentPage = 1; renderTable(); });
    document.getElementById('statusFilter').addEventListener('change', (e) => { currentFilters.status = e.target.value; currentPage = 1; renderTable(); });

    // Reset Button
    const resetBtn = document.getElementById('resetFilters');
    if(resetBtn) {
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            currentFilters = { type: 'all', currency: 'all', status: 'all', search: '', dateRange: 'all' };
            document.querySelectorAll('select').forEach(s => s.value = 'all');
            document.querySelectorAll('.type-tab').forEach(t => t.classList.remove('active'));
            document.querySelector('.type-tab[data-type="all"]').classList.add('active');
            currentPage = 1;
            renderTable();
        });
    }

    // First load data from backend then render (defensive)
    try {
        await fetchStatementData();
        renderTable();
    } catch (err) {
        console.error('Error initializing statement table', err);
        const container = document.querySelector('.statement-container');
        if (container) {
            container.insertAdjacentHTML('afterbegin', `<div class="js-error" style="padding:16px; background:#2b2730; color:#fff; border-radius:8px; margin-bottom:12px;">An error occurred while loading your statement. Check console for details.</div>`);
        }
        // ensure preloader hidden
        const pre = document.getElementById('fintech-preloader');
        if (pre) { pre.classList.add('preloader-hidden'); setTimeout(() => pre.remove(), 600); }
    }
}

// Initialize on Load
document.addEventListener('DOMContentLoaded', initTable);