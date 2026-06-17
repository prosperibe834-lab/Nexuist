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
/* ==========================================================================
   NEXUIST STOCK MARKET DASHBOARD - DATA HYDRATION ENGINE
   ========================================================================== */

// --- SEED DATABASE STATE CHANNELS ---
let stockDeposits = [];

const stockWithdrawals = [
    { id: "WTH-STK-009", user: "Gabriel Owerri", amount: 15000, wallet: "0x71...C44a", bank: "N/A", status: "Approved" }
];

const activeRegistryStocks = [
    { company: "Apple Inc.", symbol: "AAPL", price: 182.41, growth: 1.45, risk: "Low" },
    { company: "Tesla Motors", symbol: "TSLA", price: 174.60, growth: -3.12, risk: "High" },
    { company: "NVIDIA Corp.", symbol: "NVDA", price: 924.11, growth: 5.84, risk: "Medium" }
];

let stockPlans = [];
let stockInvestors = [];
let stockInvestments = [];
let stats = {};

document.addEventListener("DOMContentLoaded", () => {
    const plansData = document.getElementById("adminPlansData")?.textContent || '[]';
    const investmentsData = document.getElementById("adminInvestmentsData")?.textContent || '[]';
    const depositsData = document.getElementById("adminDepositsData")?.textContent || '[]';
    const statsData = document.getElementById("adminStatsData")?.textContent || '{}';

    try {
        stockPlans = JSON.parse(plansData);
    } catch (error) {
        console.warn('Unable to parse admin plans data:', error);
        stockPlans = [];
    }

    try {
        stockInvestments = JSON.parse(investmentsData);
    } catch (error) {
        console.warn('Unable to parse admin investments data:', error);
        stockInvestments = [];
    }

    try {
        stockDeposits = JSON.parse(depositsData);
    } catch (error) {
        console.warn('Unable to parse admin deposits data:', error);
        stockDeposits = [];
    }

    try {
        stats = JSON.parse(statsData);
    } catch (error) {
        console.warn('Unable to parse admin stats data:', error);
        stats = {};
    }

    stockInvestors = [...new Map(
        stockInvestments
            .filter(i => i.user && i.user.id)
            .map(i => [i.user.id, {
                id: i.user.id,
                name: i.user.name || `${i.user.first_name || ''} ${i.user.last_name || ''}`.trim(),
                email: i.user.email || '',
                country: i.user.country || 'N/A',
                balance: i.user.balance || 0,
                totalInvested: 0,
                status: i.user.status || 'Active'
            }])
    ).values()];

    stockInvestors.forEach(inv => {
        const invested = stockInvestments
            .filter(i => i.user && i.user.id === inv.id)
            .reduce((sum, invt) => sum + parseFloat(invt.amount || 0), 0);
        inv.totalInvested = invested;
    });

    initializeChartsSystem();
    computeUnifiedSystemMetrics();
    renderAllDashboardDataPanels();
});

// --- CORE CHART.JS VISUAL LINKING ---
function initializeChartsSystem() {
    if (typeof Chart === 'undefined') {
        console.warn('Chart.js not available for admin stock charts.');
        return;
    }

    const chartGrowthElement = document.getElementById('chartInvestmentGrowth');
    if (chartGrowthElement) {
        const ctxGrowth = chartGrowthElement.getContext('2d');
        new Chart(ctxGrowth, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Capital Flow Placement ($)',
                    data: [42000, 58000, 49000, 72000, 85000, 64000, 91000],
                    borderColor: '#00d4ff',
                    backgroundColor: 'rgba(0, 212, 255, 0.05)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    }

    const chartSectorElement = document.getElementById('chartSectorExposure');
    if (chartSectorElement) {
        const ctxSector = chartSectorElement.getContext('2d');
        new Chart(ctxSector, {
            type: 'doughnut',
            data: {
                labels: ['Tech', 'Energy', 'Financial', 'Healthcare'],
                datasets: [{
                    data: [45, 15, 25, 15],
                    backgroundColor: ['#6c63ff', '#00d4ff', '#8b5cf6', '#10b981'],
                    borderWidth: 0
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#94a3b8' } } } }
        });
    }
}

// --- DYNAMIC RUNTIME COMPUTATION ---
function computeUnifiedSystemMetrics() {
    document.getElementById("mInvestors").innerText = stockInvestors.length;
    document.getElementById("mActivePlans").innerText = stockInvestments.filter(i => ['Running', 'Active'].includes((i.status || '').toString())).length;
    
    let totalInvested = stockInvestments.reduce((acc, c) => acc + parseFloat(c.amount || 0), 0);
    document.getElementById("mCapital").innerText = `$${totalInvested.toLocaleString()}`;
    
    let totalPaid = stockInvestments.reduce((acc, c) => acc + parseFloat(c.current_profit || 0), 0);
    document.getElementById("mProfit paid").innerText = `$${totalPaid.toLocaleString(undefined, {maximumFractionDigits:2})}`;
    
    let totalWithdrawn = parseFloat(stats.withdrawals || 0);
    document.getElementById("mWithdrawals").innerText = `$${totalWithdrawn.toLocaleString()}`;
    
    let revenueValue = stats.revenue !== undefined ? parseFloat(stats.revenue) : totalInvested * 0.03;
    document.getElementById("mRevenue").innerText = `$${revenueValue.toLocaleString(undefined, {maximumFractionDigits:2})}`;
}

// --- RENDER REACTION CHANNELS ---
function renderAllDashboardDataPanels() {
    // Render Plans Matrix
    const plansBody = document.getElementById("plansTableBody");
    if (plansBody) {
        plansBody.innerHTML = "";
        stockPlans.forEach(p => {
            const minAmount = parseFloat(p.minimum_investment || p.min || 0);
            const maxAmount = parseFloat(p.maximum_investment || p.max || 0);
            const dailyRoi = parseFloat(p.daily_roi || p.roi || 0).toFixed(2);
            const durationCycles = p.duration_days || p.duration || 0;
            const subscriberCount = parseInt(p.investments_count || 0, 10);
            plansBody.innerHTML += `<tr>
                <td><strong>${p.name || 'Unnamed Plan'}</strong><br><small style="color:var(--text-muted);">${subscriberCount} subscribers</small></td>
                <td><span class="nxs-blue">${p.tier || 'Standard'}</span></td>
                <td>$${minAmount.toLocaleString()} - $${maxAmount.toLocaleString()}</td>
                <td class="nxs-green">${dailyRoi}%</td>
                <td>${durationCycles} Cycles</td>
                <td><span class="nxs-badge ${p.status === 'Inactive' ? 'suspended' : 'active'}">${p.status || 'Active'}</span></td>
                <td style="text-align:right;">
                    <button class="nxs-btn nxs-btn-secondary" style="padding:4px 8px; font-size:0.75rem;" onclick="togglePlanState(${p.id})">Toggle</button>
                </td>
            </tr>`;
        });
    }

    // Render Investors Directory
    const invBody = document.getElementById("investorsTableBody");
    invBody.innerHTML = "";
    stockInvestors.forEach(i => {
        invBody.innerHTML += `<tr>
            <td><div><strong>${i.name}</strong><br><span style="font-size:0.75rem; color:var(--text-muted);">${i.email}</span></div></td>
            <td>${i.country}</td>
            <td style="font-weight:600;">$${i.balance.toLocaleString()}</td>
            <td>$${i.totalInvested.toLocaleString()}</td>
            <td><span class="nxs-badge active">${i.status}</span></td>
            <td style="text-align:right;"><button class="nxs-btn" style="padding:4px 8px; background:rgba(108,99,255,0.1); color:var(--primary-color);" onclick="alert('Crediting panel operational workflow.')">Credit</button></td>
        </tr>`;
    });

    // Render Monitor Array
    const monBody = document.getElementById("monitorTableBody");
    if (monBody) {
        monBody.innerHTML = "";
        stockInvestments.forEach(m => {
            const investorName = m.user?.name || `${m.user?.first_name || ''} ${m.user?.last_name || ''}`.trim() || 'Unknown Investor';
            const planName = m.plan?.name || m.plan || 'Unknown Plan';
            const amountValue = parseFloat(m.amount || 0);
            const expectedValue = parseFloat(m.current_profit || 0);
            monBody.innerHTML += `<tr>
                <td><span style="font-family:monospace;">${m.id || 'N/A'}</span></td>
                <td><strong>${investorName}</strong></td>
                <td>${planName}</td>
                <td style="font-weight:600;">$${amountValue.toLocaleString()}</td>
                <td class="nxs-green">+$${expectedValue.toLocaleString()}</td>
                <td><span class="nxs-badge pending">${m.status || 'Pending'}</span></td>
                <td style="text-align:right;"><button class="nxs-btn" style="padding:4px 6px; background:rgba(16,185,129,0.1); color:#10b981;" onclick="alert('Contract execution terminal locked.')"><i class="bx bx-check-double"></i></button></td>
            </tr>`;
        });
    }

    // Render Deposits Queue
    const depBody = document.getElementById("depositsTableBody");
    if (depBody) {
        if (stockDeposits.length === 0) {
            depBody.innerHTML = `<tr><td colspan="7" style="text-align:center; color:var(--text-muted); padding:20px;">No backend deposit records found.</td></tr>`;
        } else {
            depBody.innerHTML = "";
            stockDeposits.forEach(d => {
                const investorName = d.user?.name || `${d.user?.first_name || ''} ${d.user?.last_name || ''}`.trim() || 'Unknown Investor';
                const depositCode = d.txid || d.id || 'N/A';
                const depositDate = d.created_at ? new Date(d.created_at).toLocaleDateString() : (d.date || 'N/A');
                const statusClass = d.status === 'Approved' ? 'active' : (d.status === 'Pending' ? 'pending' : 'suspended');

                depBody.innerHTML += `<tr>
                    <td><span style="font-family:monospace;">${depositCode}</span></td>
                    <td><strong>${investorName}</strong></td>
                    <td style="font-weight:600; color:var(--secondary-color);">$${parseFloat(d.amount || 0).toLocaleString()}</td>
                    <td>${d.method || 'N/A'}</td>
                    <td><span style="font-size:0.8rem; color:var(--text-muted);">${depositDate}</span></td>
                    <td><span class="nxs-badge ${statusClass}">${d.status || 'Unknown'}</span></td>
                    <td style="text-align:right;"><button class="nxs-btn" style="padding:4px 6px; background:rgba(16,185,129,0.15); color:#10b981;" onclick="alert('Deposit record from backend loaded.')"><i class="bx bx-badge-check"></i></button></td>
                </tr>`;
            });
        }
    }

    // Render Withdrawals Queue
    const wthBody = document.getElementById("withdrawalsTableBody");
    wthBody.innerHTML = "";
    stockWithdrawals.forEach(w => {
        wthBody.innerHTML += `<tr>
            <td><span style="font-family:monospace;">${w.id}</span></td>
            <td><strong>${w.user}</strong></td>
            <td style="font-weight:600; color:#ef4444;">$${w.amount.toLocaleString()}</td>
            <td><span style="font-family:monospace; font-size:0.8rem;">${w.wallet}</span></td>
            <td><span class="nxs-badge active">${w.status}</span></td>
            <td style="text-align:right;"><i class="bx bx-check-shield" style="color:#10b981; font-size:1.2rem;"></i></td>
        </tr>`;
    });

    // Render Live Stocks Asset Registry
    const stockBody = document.getElementById("liveStocksTableBody");
    stockBody.innerHTML = "";
    activeRegistryStocks.forEach(s => {
        stockBody.innerHTML += `<tr>
            <td><strong>${s.company}</strong></td>
            <td><span style="font-family:monospace; background:rgba(255,255,255,0.05); padding:2px 6px; border-radius:4px;">${s.symbol}</span></td>
            <td style="font-weight:600;">$${s.price.toLocaleString()}</td>
            <td class="${s.growth >= 0 ? 'nxs-green' : 'nxs-red'}" style="color:${s.growth >=0 ? '#10b981':'#ef4444'}">${s.growth >=0 ? '+':''}${s.growth}%</td>
            <td><span class="nxs-badge ${s.risk==='High'?'suspended':'active'}">${s.risk} Risk</span></td>
            <td style="text-align:right;"><button class="nxs-btn" style="padding:4px;" onclick="executeAssetRemoval('${s.symbol}')"><i class="bx bx-trash" style="color:#ef4444;"></i></button></td>
        </tr>`;
    });
}

// --- LOGIC MUTATION OPERATORS ---
function executePlanCreationPipeline(e) {
    e.preventDefault();
    const url = window.adminStockPlanStoreUrl || '/admin/stock-market/plans';
    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    const payload = {
        name: document.getElementById("pName").value,
        tier: document.getElementById("pTier").value,
        minimum_investment: parseFloat(document.getElementById("pMin").value),
        maximum_investment: parseFloat(document.getElementById("pMax").value),
        daily_roi: parseFloat(document.getElementById("pRoi").value),
        duration_days: parseInt(document.getElementById("pDuration").value, 10),
        status: "Active"
    };

    if (!token) {
        alert('Unable to submit plan: CSRF token is missing.');
        return;
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token,
        },
        body: JSON.stringify(payload)
    })
    .then(async response => {
        const data = await response.json().catch(() => ({}));
        if (response.ok) {
            const plan = data.plan || payload;
            plan.id = plan.id || data.id || plan.id || Math.floor(Date.now() / 1000);
            plan.investments_count = plan.investments_count ?? 0;
            plan.minimum_investment = plan.minimum_investment || plan.min;
            plan.maximum_investment = plan.maximum_investment || plan.max;
            plan.daily_roi = plan.daily_roi || plan.roi;
            plan.duration_days = plan.duration_days || plan.duration;

            if (data.plan || Object.keys(plan).length > 0) {
                stockPlans.unshift(plan);
                closeStockModal('modalCreatePlan');
                document.getElementById("formCreatePlan").reset();
                computeUnifiedSystemMetrics();
                renderAllDashboardDataPanels();
                alert(data.message || 'Equity plan created successfully.');
                window.location.reload();
                return;
            }

            window.location.reload();
            return;
        }

        alert(data.message || 'Unable to create equity plan. Please check the form and try again.');
    })
    .catch(error => {
        console.error('Admin plan creation failed:', error);
        alert('Network error while creating plan. Please try again.');
    });
}

function togglePlanState(planId) {
    const plan = stockPlans.find(p => p.id === planId);
    if (!plan) {
        alert('Plan not found.');
        return;
    }

    const token = document.querySelector('meta[name="csrf-token"]')?.content;
    const url = `/admin/stock-market/plans/${planId}/toggle`;

    if (!token) {
        alert('Unable to update plan status: CSRF token missing.');
        return;
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token,
        },
    })
    .then(async response => {
        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data.message || 'Unable to update plan status.');
        }
        plan.status = data.plan?.status || (plan.status === 'Active' ? 'Inactive' : 'Active');
        renderAllDashboardDataPanels();
        alert(data.message || 'Plan status updated.');
    })
    .catch(error => {
        console.error('Plan toggle failed:', error);
        alert(error.message || 'Network error while updating the plan.');
    });
}

function executeAssetRemoval(sym) {
    activeRegistryStocks = activeRegistryStocks.filter(s => s.symbol !== sym);
    renderAllDashboardDataPanels();
}

// --- EXPORT TABLE INFRASTRUCTURE MACHINE ---
function exportTableToCSV(tableId) {
    let rows = document.querySelectorAll(`#${tableId} tr`);
    let csvContent = "data:text/csv;charset=utf-8,";
    rows.forEach(row => {
        let cols = row.querySelectorAll("td, th");
        let rowData = [];
        cols.forEach(col => rowData.push(col.innerText.replace(/,/g, '')));
        csvContent += rowData.join(",") + "\r\n";
    });
    let encodedUri = encodeURI(csvContent);
    let link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `Nexuist_Stock_Audit_${new Date().toISOString().split('T')[0]}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// --- SYSTEM TAB STRATIFICATION ---
function switchStockTab(e, panelId) {
    document.querySelectorAll(".nxs-tab-btn").forEach(b => b.classList.remove("active"));
    document.querySelectorAll(".nxs-view-panel").forEach(p => p.style.display = "none");
    e.target.classList.add("active");
    document.getElementById(panelId).style.display = "block";
}

// --- MODAL VISIBILITY MECHANICS ---
function openStockModal(id) { document.getElementById(id).classList.add("active"); }
function closeStockModal(id) { document.getElementById(id).classList.remove("remove"); document.getElementById(id).classList.remove("active"); }