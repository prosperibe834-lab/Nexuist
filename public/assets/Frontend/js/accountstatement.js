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
    const dateFilter = document.getElementById('dateFilter');
    const currencyFilter = document.getElementById('currencyFilter');
    const statusFilter = document.getElementById('statusFilter');
    const typeTabs = Array.from(document.querySelectorAll('.type-tab'));
    const resetBtn = document.getElementById('resetFilters');

    if (!tableBody || !searchInput) {
        console.error('Account statement table or search input is missing.');
        return;
    }

    let currentPage = 1;
    const rowsPerPage = 5;

    let currentFilters = {
        type: 'all',
        currency: 'all',
        status: 'all',
        search: '',
        dateRange: 'all'
    };

    function normalize(value) {
        return String(value || '').trim().toLowerCase();
    }

    function renderTable() {
        const now = new Date();
        const searchTerm = normalize(currentFilters.search);

        const filteredData = transactionData.filter(item => {
            const itemDate = new Date(item.date);
            let matchesDate = true;

            if (currentFilters.dateRange !== 'all' && !isNaN(itemDate.getTime())) {
                const diffTime = now - itemDate;
                const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
                matchesDate = diffDays >= 0 && diffDays <= parseInt(currentFilters.dateRange, 10);
            }

            const itemType = normalize(item.type);
            const itemCurrency = normalize(item.currency);
            const itemStatus = normalize(item.status);
            const itemCategory = normalize(item.category);
            const itemDestination = normalize(item.destination);
            const itemRef = normalize(item.ref);
            const itemAmount = normalize(item.amount);
            const itemDateLabel = normalize(item.date);

            const matchesSearch = searchTerm === '' || [
                itemCategory,
                itemDestination,
                itemRef,
                itemCurrency,
                itemType,
                itemStatus,
                itemAmount,
                itemDateLabel
            ].some(value => value.includes(searchTerm));

            const matchesType = currentFilters.type === 'all'
                || (currentFilters.type === 'others' && itemType !== 'deposit' && itemType !== 'withdrawal')
                || itemType === currentFilters.type;

            const matchesCurrency = currentFilters.currency === 'all' || itemCurrency === normalize(currentFilters.currency);
            const matchesStatus = currentFilters.status === 'all' || itemStatus === normalize(currentFilters.status);

            return matchesDate && matchesSearch && matchesType && matchesCurrency && matchesStatus;
        });

        const totalPages = Math.max(1, Math.ceil(filteredData.length / rowsPerPage));
        if (currentPage > totalPages) currentPage = totalPages;

        const start = (currentPage - 1) * rowsPerPage;
        const paginatedData = filteredData.slice(start, start + rowsPerPage);

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
                <td><span class="status-pill status-${item.status.toLowerCase()}">${item.status}</span></td>
            </tr>
        `).join('') : `<tr><td colspan="8" style="text-align:center; padding: 50px; color: var(--text-secondary);">No records found.</td></tr>`;

        const countLabel = document.getElementById('showing-count');
        if (countLabel) {
            countLabel.innerText = `Showing ${paginatedData.length} of ${filteredData.length} transactions`;
        }

        updatePaginationUI(totalPages);
    }

    function updatePaginationUI(totalPages) {
        const paginationContainer = document.querySelector('.pagination');
        if (!paginationContainer) return;

        let html = `
            <button class="page-link" ${currentPage === 1 ? 'disabled' : ''} id="prevPage">
                <span class="iconify" data-icon="ri:arrow-left-s-line"></span>
            </button>
        `;

        for (let i = 1; i <= totalPages; i += 1) {
            html += `<button class="page-link ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }

        html += `
            <button class="page-link" ${currentPage === totalPages ? 'disabled' : ''} id="nextPage">
                <span class="iconify" data-icon="ri:arrow-right-s-line"></span>
            </button>
        `;

        paginationContainer.innerHTML = html;

        paginationContainer.querySelectorAll('.page-link[data-page]').forEach(btn => {
            btn.addEventListener('click', () => {
                currentPage = parseInt(btn.dataset.page, 10);
                renderTable();
            });
        });

        const prevBtn = document.getElementById('prevPage');
        const nextBtn = document.getElementById('nextPage');
        if (prevBtn) prevBtn.onclick = () => { if (currentPage > 1) { currentPage -= 1; renderTable(); } };
        if (nextBtn) nextBtn.onclick = () => { if (currentPage < totalPages) { currentPage += 1; renderTable(); } };
    }

    searchInput.addEventListener('input', (e) => {
        currentFilters.search = e.target.value.toLowerCase();
        currentPage = 1;
        renderTable();
    });

    typeTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            typeTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentFilters.type = tab.dataset.type || 'all';
            currentPage = 1;
            renderTable();
        });
    });

    if (dateFilter) {
        dateFilter.addEventListener('change', (e) => {
            currentFilters.dateRange = e.target.value;
            currentPage = 1;
            renderTable();
        });
    }

    if (currencyFilter) {
        currencyFilter.addEventListener('change', (e) => {
            currentFilters.currency = e.target.value;
            currentPage = 1;
            renderTable();
        });
    }

    if (statusFilter) {
        statusFilter.addEventListener('change', (e) => {
            currentFilters.status = e.target.value;
            currentPage = 1;
            renderTable();
        });
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            searchInput.value = '';
            currentFilters = { type: 'all', currency: 'all', status: 'all', search: '', dateRange: 'all' };
            if (dateFilter) dateFilter.value = 'all';
            if (currencyFilter) currencyFilter.value = 'all';
            if (statusFilter) statusFilter.value = 'all';
            typeTabs.forEach(t => t.classList.remove('active'));
            const defaultTab = typeTabs.find(t => t.dataset.type === 'all');
            if (defaultTab) defaultTab.classList.add('active');
            currentPage = 1;
            renderTable();
        });
    }

    try {
        await fetchStatementData();
        renderTable();
    } catch (err) {
        console.error('Error initializing statement table', err);
        const container = document.querySelector('.statement-container');
        if (container) {
            container.insertAdjacentHTML('afterbegin', `<div class="js-error" style="padding:16px; background:#2b2730; color:#fff; border-radius:8px; margin-bottom:12px;">An error occurred while loading your statement. Check console for details.</div>`);
        }
        const pre = document.getElementById('fintech-preloader');
        if (pre) { pre.classList.add('preloader-hidden'); setTimeout(() => pre.remove(), 600); }
    }
}

document.addEventListener('DOMContentLoaded', initTable);