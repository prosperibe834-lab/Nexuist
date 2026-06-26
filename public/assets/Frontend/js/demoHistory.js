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
        filterForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            await fetchDemoHistory();
        });
    }

    // 3. Clear Controls Functional Operation
    if (resetFiltersBtn) {
        resetFiltersBtn.addEventListener('click', async () => {
            filterForm.reset();
            await fetchDemoHistory();
        });
    }

    fetchDemoHistory();

    async function getCsrfToken() {
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        return tokenMeta ? tokenMeta.content : '';
    }

    async function fetchDemoHistory() {
        try {
            const filterStatus = document.getElementById('filter-status').value;
            const filterType = document.getElementById('filter-type').value;
            const filterAsset = document.getElementById('filter-asset').value;
            const filterResult = document.getElementById('filter-result').value;
            const perPage = document.getElementById('filter-per-page').value;

            const params = new URLSearchParams();
            if(filterStatus && filterStatus !== 'all') params.append('status', filterStatus);
            if(filterType && filterType !== 'all') params.append('direction', filterType.toUpperCase());
            if(filterAsset) params.append('asset', filterAsset);
            if(filterResult && filterResult !== 'all') params.append('result', filterResult);
            params.append('per_page', perPage);

            const response = await fetch('/api/demo/history?' + params.toString(), { headers: { 'Accept': 'application/json' } });
            const data = await response.json();
            if (!response.ok) {
                throw new Error(data.message || 'Unable to load demo history.');
            }

            if (data.trades && Array.isArray(data.trades)) {
                renderHistoryRows(data.trades);
                updateTableMeta(data.trades.length);
            }

            const statsActive = document.getElementById('stat-active-trades');
            const statWin = document.getElementById('stat-win-rate');
            const statPnl = document.getElementById('stat-total-pnl');
            if (statsActive) statsActive.textContent = data.statistics?.active_trades ?? '0';
            if (statWin) statWin.textContent = data.statistics?.win_rate ?? '0%';
            if (statPnl) statPnl.textContent = data.statistics?.total_pnl ?? '$0.00';

            const demoBalanceDisplay = document.getElementById('demoBalanceDisplay');
            if (demoBalanceDisplay) {
                demoBalanceDisplay.textContent = `$${Number(data.demo_balance).toFixed(2)}`;
            }
        } catch (error) {
            console.warn('Demo history load failed:', error.message);
        }
    }

    function renderHistoryRows(trades) {
        tableBody.innerHTML = '';

        if (!trades.length) {
            const noRecordRow = document.createElement('tr');
            noRecordRow.className = 'no-records-row';
            noRecordRow.innerHTML = `<td colspan="10" class="no-records-row">No demo trades found.</td>`;
            tableBody.appendChild(noRecordRow);
            return;
        }

        trades.forEach(trade => {
            const row = document.createElement('tr');
            const statusLabel = trade.status === 'OPEN' ? 'Active' : 'Closed';
            const statusClass = trade.status === 'OPEN' ? 'status-active' : 'status-closed';
            const resultLabel = trade.result ? trade.result.replace('_', ' ') : 'Pending';
            const pnlValue = trade.pnl !== null ? Number(trade.pnl).toFixed(2) : '0.00';
            const pnlClass = trade.pnl > 0 ? 'success-text' : trade.pnl < 0 ? 'error-text' : 'neutral';
            const entryPrice = trade.entry_price ?? trade.notional_value ? `$${Number(trade.notional_value).toFixed(2)}` : '$0.00';

            row.setAttribute('data-asset', trade.asset || '');
            row.setAttribute('data-type', trade.direction ? trade.direction.toLowerCase() : '');
            row.setAttribute('data-status', trade.status ? trade.status.toLowerCase() : '');
            row.setAttribute('data-pnl', pnlValue);

            row.innerHTML = `
                <td>
                    <div class="asset-cell">
                        <i class='bx bx-coin-stack'></i>
                        <span>${trade.asset || 'N/A'}</span>
                    </div>
                </td>
                <td><span class="badge ${trade.direction === 'BUY' ? 'badge-success' : 'badge-danger'}">${trade.direction || 'N/A'}</span></td>
                <td><strong>$${Number(trade.amount).toFixed(2)}</strong></td>
                <td class="text-secondary">${trade.leverage}x</td>
                <td>${entryPrice}</td>
                <td>${entryPrice}</td>
                <td>
                    <div class="pnl-cell ${pnlClass}">
                        <span class="pnl-amount">${trade.pnl !== null ? (trade.pnl >= 0 ? '+' : '') + '$' + pnlValue : '$0.00'}</span>
                        <span class="pnl-percent">(${trade.result ?? 'PENDING'})</span>
                    </div>
                </td>
                <td><span class="status-indicator ${statusClass}">${statusLabel}</span></td>
                <td class="date-cell">
                    <span>${trade.opened_at ? new Date(trade.opened_at).toLocaleDateString() : 'N/A'}</span>
                    <small>${trade.opened_at ? new Date(trade.opened_at).toLocaleTimeString() : ''}</small>
                </td>
                <td class="text-right">
                    <button class="btn-table-action btn-close-trade" data-id="${trade.id}" ${trade.status === 'CLOSED' ? 'disabled' : ''} title="Close Position">
                        <i class='bx bx-x-circle'></i> Close
                    </button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    // 4. Live Actions: Closing Out Position Entries
    if (tableBody) {
        tableBody.addEventListener('click', async (e) => {
            const closeBtn = e.target.closest('.btn-close-trade');
            if (closeBtn) {
                const tradeId = closeBtn.getAttribute('data-id');
                const token = await getCsrfToken();
                try {
                    const response = await fetch(`/api/demo/trade/${tradeId}/close`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                    });
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Unable to close trade.');
                    }

                    alert('Trade closed successfully. Demo balance updated.');
                    fetchDemoHistory();
                } catch (error) {
                    alert(error.message || 'Unable to close trade.');
                }
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