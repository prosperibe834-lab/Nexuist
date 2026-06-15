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
document.addEventListener('DOMContentLoaded', () => {
    // DOM Elements Configuration
    const toggleFilterBtn = document.getElementById('toggle-filter-view');
    const filterForm = document.getElementById('filter-form');
    const filterFormContainer = document.querySelector('.filter-panel');
    const resetFiltersBtn = document.getElementById('reset-filters-btn');
    const tableBody = document.getElementById('table-body-target');
    const tradeCountBadge = document.getElementById('trade-count-badge');
    const paginationInfo = document.getElementById('pagination-info');

    // 1. Interactive Collapsible Filter Box
    if (toggleFilterBtn && filterForm) {
        toggleFilterBtn.addEventListener('click', () => {
            filterForm.classList.toggle('collapsed');
            const isCollapsed = filterForm.classList.contains('collapsed');
            
            // Icon modification adjustments
            toggleFilterBtn.querySelector('.btn-text').textContent = isCollapsed ? 'Show Filters' : 'Hide Filters';
            const icon = toggleFilterBtn.querySelector('i');
            if (isCollapsed) {
                icon.className = 'bx bx-chevron-down';
            } else {
                icon.className = 'bx bx-chevron-up';
            }
        });
    }

    // 2. Client Side Dynamic Filter Processor Engine
    if (filterForm) {
        filterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Collect Current Value Snapshots
            const statusCriteria = document.getElementById('filter-status').value.toLowerCase();
            const typeCriteria = document.getElementById('filter-type').value.toLowerCase();
            const assetCriteria = document.getElementById('filter-asset').value.toLowerCase().trim();
            const resultCriteria = document.getElementById('filter-result').value;

            const tableRows = tableBody.querySelectorAll('tr:not(.no-records-row)');
            let visibleCount = 0;

            tableRows.forEach(row => {
                const rowAsset = row.getAttribute('data-asset').toLowerCase();
                const rowType = row.getAttribute('data-type').toLowerCase();
                const rowStatus = row.getAttribute('data-status').toLowerCase();
                const rowPnl = parseFloat(row.getAttribute('data-pnl') || '0');

                let matchesAsset = !assetCriteria || rowAsset.includes(assetCriteria);
                let matchesType = statusCriteria === 'all' || rowStatus === statusCriteria;
                let matchesTradeType = typeCriteria === 'all' || rowType === typeCriteria;
                
                let matchesResult = true;
                if (resultCriteria === 'profit') matchesResult = rowPnl > 0;
                else if (resultCriteria === 'loss') matchesResult = rowPnl < 0;
                else if (resultCriteria === 'break-even') matchesResult = rowPnl === 0;

                if (matchesAsset && matchesType && matchesTradeType && matchesResult) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            updateTableMeta(visibleCount);
        });
    }

    // 3. Clear Controls Functional Operation
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', () => {
            filterForm.reset();
            const tableRows = tableBody.querySelectorAll('tr:not(.no-records-row)');
            tableRows.forEach(row => row.style.display = '');
            updateTableMeta(tableRows.length);
        });
    }

    // 4. Live Actions: Closing Out Position Entries
    if (tableBody) {
        tableBody.addEventListener('click', (e) => {
            const closeBtn = e.target.closest('.btn-close-trade');
            if (closeBtn) {
                const targetRow = closeBtn.closest('tr');
                
                // Luxury dynamic drop transition prior to extraction
                targetRow.style.transition = 'all 0.3s ease';
                targetRow.style.opacity = '0';
                targetRow.style.transform = 'translateX(30px)';
                
                setTimeout(() => {
                    targetRow.remove();
                    const activeRows = tableBody.querySelectorAll('tr:not(.no-records-row)');
                    updateTableMeta(activeRows.length);
                    
                    // Adjust metrics layout dynamic update tracking sample
                    const activeStat = document.getElementById('stat-active-trades');
                    if(activeStat) {
                        let count = parseInt(activeStat.textContent) || 0;
                        if(count > 0) activeStat.textContent = count - 1;
                    }
                }, 300);
            }
        });
    }

    // UI View Meta Modifier Data Stream
    function updateTableMeta(count) {
        tradeCountBadge.textContent = `${count} Trade${count !== 1 ? 's' : ''} Found`;
        paginationInfo.textContent = `Showing ${count} trade record${count !== 1 ? 's' : ''}`;

        // Clear alternative structural state row checks
        const existingNoRecord = tableBody.querySelector('.no-records-row');
        if (existingNoRecord) existingNoRecord.remove();

        if (count === 0) {
            const noRecordRow = document.createElement('tr');
            noRecordRow.className = 'no-records-row';
            noRecordRow.innerHTML = `<td colspan="10" class="no-records-row">No history coordinates match your filters.</td>`;
            tableBody.appendChild(noRecordRow);
        }
    }
});