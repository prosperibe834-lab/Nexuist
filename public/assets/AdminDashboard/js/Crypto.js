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
   NEXUIST STOCK MARKET ENGINE - OPERATIONS HYDRATION CORE
   ========================================================================== */

// --- DATA SEED STREAMS ---
// --- DATA SEED STREAMS ---
// Prefer backend-provided data when available (injected at view render time)
let systemPlans = (window.adminCryptoPlansData && Array.isArray(window.adminCryptoPlansData) && window.adminCryptoPlansData.length)
    ? window.adminCryptoPlansData.map(p => ({
        id: p.id,
        name: p.name,
        tier: p.tier || 'Custom',
        min: parseFloat(p.minimum_investment || 0),
        max: parseFloat(p.maximum_investment || 0),
        roi: parseFloat(p.daily_roi || 0),
        duration: parseInt(p.duration_days || 30),
        investorsCount: p.investments_count || p.investors_count || 0,
        totalDeposited: p.total_deposited || 0,
        totalProfit: p.total_profit || 0,
        status: p.status || 'Active'
    }))
    : [
        { id: "P-01", name: "Crypto Starter Eco", tier: "Retail Base", min: 100, max: 2000, roi: 1.15, duration: 15, investorsCount: 142, totalDeposited: 184500, totalProfit: 31800, status: "Active" },
        { id: "P-02", name: "Alpha Contract Plus", tier: "Institutional Growth", min: 10000, max: 100000, roi: 2.45, duration: 90, investorsCount: 38, totalDeposited: 1240000, totalProfit: 456000, status: "Active" },
        { id: "P-03", name: "Institutional Prime Vault", tier: "Hedge High-Yield", min: 100000, max: 5000000, roi: 3.80, duration: 365, investorsCount: 9, totalDeposited: 8900000, totalProfit: 2145000, status: "Active" }
    ];

// Investors derived from backend-provided investments when available
let systemInvestors = [];
if (window.adminCryptoInvestmentsData && Array.isArray(window.adminCryptoInvestmentsData)) {
    const grouped = {};
    window.adminCryptoInvestmentsData.forEach(inv => {
        const user = inv.user || { id: null, name: 'Unknown', email: '', country: '', phone: '' };
        const uid = user.id || ('u-' + (inv.user_id || Math.random().toString(36).slice(2,8)));
        if (!grouped[uid]) {
            grouped[uid] = {
                uuid: 'UX-' + uid,
                name: user.name || 'User',
                email: user.email || '',
                phone: user.phone || '',
                country: user.country || 'Unknown',
                regDate: user.created_at ? new Date(user.created_at).toISOString().split('T')[0] : '',
                activePlan: inv.plan ? inv.plan.name : '',
                investedAmount: 0,
                totalProfit: 0,
                balance: user.balance || 0,
                status: user.status || 'Active',
                kyc: user.kyc_status || (user.kyc ? 'Verified' : 'Unverified')
            };
        }
        grouped[uid].investedAmount += Number(inv.amount || inv.investment_amount || 0);
        grouped[uid].totalProfit += Number(inv.current_profit || 0);
    });
    systemInvestors = Object.values(grouped);
} else {
    systemInvestors = [];
}

// Deposits from backend if available
let systemDeposits = [];
if (window.adminDepositsData && Array.isArray(window.adminDepositsData)) {
    systemDeposits = window.adminDepositsData.map(d => ({
        depId: d.id || d.depId || 'DEP-' + (d.id || Math.random().toString(36).slice(2,6)),
        investorName: d.user_name || d.investor_name || (d.user ? d.user.name : ''),
        amount: Number(d.amount || 0),
        plan: d.plan_name || (d.plan ? d.plan.name : ''),
        date: d.created_at ? new Date(d.created_at).toISOString().split('T')[0] : '',
        method: d.method || d.channel || 'Unknown',
        status: d.status || 'Pending'
    }));
}

// Withdrawals - no backend injection yet, keep empty or derive if available
let systemWithdrawals = [];

// Signals & News - could be wired to backend 'signals' table in future; for now use injected stats or empty
let systemSignals = [];
if (window.adminCryptoStats && window.adminCryptoStats.signals && Array.isArray(window.adminCryptoStats.signals)) {
    systemSignals = window.adminCryptoStats.signals;
}

// --- LIFECYCLE REVOLUTION INIT ---
document.addEventListener("DOMContentLoaded", () => {
    renderSystemMetricCounters();
    renderActivePanelViews();
    spinUpOperationalCharts();
});

function getCsrfToken() {
    const m = document.querySelector('meta[name="csrf-token"]');
    if (m && m.getAttribute) return m.getAttribute('content');
    if (window.csrfToken) return window.csrfToken;
    return '';
}

// --- RENDER COUNTERS CALCULATION ---
function renderSystemMetricCounters() {
    const elInvestors = document.getElementById("statInvestors"); if (elInvestors) elInvestors.innerText = systemInvestors.length;
    const elActive = document.getElementById("statActiveInvestments"); if (elActive) elActive.innerText = systemInvestors.filter(i => i.investedAmount > 0).length;

    let cumulativeDeposits = systemDeposits.reduce((sum, d) => sum + d.amount, 0);
    const elDeposits = document.getElementById("statDeposits"); if (elDeposits) elDeposits.innerText = `$${cumulativeDeposits.toLocaleString()}`;

    let pendingDepCount = systemDeposits.filter(d => d.status === "Pending").length;
    const elPending = document.getElementById("statPendingDep"); if (elPending) elPending.innerText = `${pendingDepCount} Pending`;

    let totalYieldPaid = systemInvestors.reduce((sum, i) => sum + i.totalProfit, 0);
    const elProfit = document.getElementById("statProfitPaid"); if (elProfit) elProfit.innerText = `$${totalYieldPaid.toLocaleString()}`;

    const elRevenue = document.getElementById("statRevenue"); if (elRevenue) elRevenue.innerText = `$${(cumulativeDeposits * 0.045).toLocaleString(undefined, {maximumFractionDigits: 2})}`;
}

// --- MASTER PANEL BINDINGS ---
function renderActivePanelViews() {
    // 1. Asset Plans Tier Frame Rendering
    const tbodyPlans = document.getElementById("tbodyPlans");
    tbodyPlans.innerHTML = systemPlans.map(p => `<tr>
        <td><strong>${p.name}</strong><br><span style="font-size:0.75rem; color:var(--text-muted);">${p.tier}</span></td>
        <td>$${p.min.toLocaleString()} - $${p.max.toLocaleString()}</td>
        <td style="color:#10b981; font-weight:600;">+${p.roi}%</td>
        <td>${p.duration} Days</td>
        <td><strong>${p.investorsCount}</strong> Users</td>
        <td><span class="nx-badge ${p.status === 'Active' ? 'up' : 'idle'}">${p.status}</span></td>
        <td style="text-align:right; display:flex; gap:8px; justify-content:flex-end;">
            <button class="nx-btn nx-btn-s" style="padding:4px 8px;" onclick="decommissionPlan('${p.id}')">Toggle</button>
            <button class="nx-btn nx-btn-danger" style="padding:4px 8px;" onclick="deletePlan('${p.id}')">Delete</button>
        </td>
    </tr>`).join('');

    // 2. Client Management Profiles Rendering
    const tbodyInvestors = document.getElementById("tbodyInvestors");
    tbodyInvestors.innerHTML = systemInvestors.map(i => `<tr>
        <td><strong>${i.name}</strong><br><span style="font-size:0.72rem; color:var(--text-muted);">${i.email}</span></td>
        <td>${i.country}</td>
        <td style="font-weight:600;">$${i.balance.toLocaleString()}</td>
        <td>$${i.investedAmount.toLocaleString()}</td>
        <td style="color:#10b981;">+$${i.totalProfit.toLocaleString()}</td>
        <td><span class="nx-badge up">${i.kyc}</span></td>
        <td style="text-align:right;"><button class="nx-btn nx-btn-p" style="padding:4px 8px;" onclick="viewInvestorDeepProfile('${i.uuid}')">Drilldown</button></td>
    </tr>`).join('');

    // 3. Deposit Flow Frame Rendering
    const tbodyDeposits = document.getElementById("tbodyDeposits");
    tbodyDeposits.innerHTML = systemDeposits.map(d => `<tr>
        <td><strong>${d.investorName}</strong></td>
        <td style="font-weight:600; color:var(--secondary-color);">$${d.amount.toLocaleString()}</td>
        <td>${d.plan}</td>
        <td><span style="font-family:monospace; font-size:0.8rem;">${d.method}</span></td>
        <td><span style="color:var(--text-muted); font-size:0.78rem;">${d.date}</span></td>
        <td><span class="nx-badge ${d.status === 'Approved' ? 'up' : 'idle'}">${d.status}</span></td>
        <td style="text-align:right;">
            ${d.status === 'Pending' ? `<button class="nx-btn nx-btn-p" style="padding:3px 6px; font-size:0.75rem;" onclick="mutateDepositStatus('${d.depId}', 'Approved')">Approve</button>` : `<i class="bx bx-check-shield" style="color:#10b981; font-size:1.2rem;"></i>`}
        </td>
    </tr>`).join('');

    // 4. Outbound Withdrawal Verification Tracks
    const tbodyWithdrawals = document.getElementById("tbodyWithdrawals");
    tbodyWithdrawals.innerHTML = systemWithdrawals.map(w => `<tr>
        <td><strong>${w.investorName}</strong></td>
        <td style="font-weight:600; color:#ef4444;">$${w.amount.toLocaleString()}</td>
        <td>${w.method}</td>
        <td><span style="font-family:monospace; font-size:0.78rem; background:rgba(255,255,255,0.03); padding:2px 4px; border-radius:4px;">${w.address}</span></td>
        <td><span style="color:var(--text-muted); font-size:0.78rem;">${w.date}</span></td>
        <td><span class="nx-badge up">${w.status}</span></td>
        <td style="text-align:right;"><i class="bx bx-lock-alt" style="color:var(--text-muted);"></i></td>
    </tr>`).join('');

    // 5. Manual Yield Mutation Track Records
    const tbodyEarnings = document.getElementById("tbodyEarnings");
    tbodyEarnings.innerHTML = systemInvestors.map(i => `<tr>
        <td><strong>${i.name}</strong></td>
        <td><span style="font-size:0.8rem; color:var(--secondary-color);">${i.activePlan}</span></td>
        <td>$${i.investedAmount.toLocaleString()}</td>
        <td style="font-weight:600; color:#10b981;">$${i.totalProfit.toLocaleString()}</td>
        <td>2.45%</td>
        <td style="text-align:right; display:flex; gap:6px; justify-content:flex-end;">
            <button class="nx-btn" style="padding:4px 8px; background:rgba(16,185,129,0.1); color:#10b981;" onclick="adjustClientYield('${i.uuid}', 2500)">+ Profit</button>
            <button class="nx-btn" style="padding:4px 8px; background:rgba(239,68,68,0.1); color:#ef4444;" onclick="adjustClientYield('${i.uuid}', -1000)">- Deduct</button>
        </td>
    </tr>`).join('');

    // 6. Signals and News Mapping Frame
    const tbodyMarketFeeds = document.getElementById("tbodyMarketFeeds");
    tbodyMarketFeeds.innerHTML = systemSignals.map(s => `<tr>
        <td><strong>${s.title}</strong></td>
        <td><span class="nx-badge idle">${s.type}</span></td>
        <td><span style="font-family:monospace; font-size:0.8rem; color:var(--text-secondary);">${s.value}</span></td>
        <td><span style="color:var(--text-muted); font-size:0.78rem;">${s.date}</span></td>
        <td style="text-align:right;"><button class="nx-btn" style="padding:4px;" onclick="purgeSignalFeed('${s.id}')"><i class="bx bx-trash" style="color:#ef4444;"></i></button></td>
    </tr>`).join('');
}

// --- INTERACTIVE OPERATIONAL METHOD LOGICS ---
function toggleEngineView(e, targetPanelId) {
    document.querySelectorAll(".nx-nav-tab").forEach(tab => tab.classList.remove("active"));
    document.querySelectorAll(".nx-engine-panel").forEach(panel => panel.style.display = "none");
    e.target.classList.add("active");
    document.getElementById(targetPanelId).style.display = "block";
}

function viewInvestorDeepProfile(uuid) {
    let client = systemInvestors.find(i => i.uuid === uuid);
    if (!client) return;
    
    let content = `
        <div class="nx-investor-card">
            <div class="nx-pfp-avatar">${client.name.charAt(0)}</div>
            <div>
                <h4>${client.name}</h4>
                <p style="color:var(--text-muted); font-size:0.8rem;">UUID Node Reference: ${client.uuid}</p>
                <p style="color:var(--text-secondary); font-size:0.82rem;">Registration Timestamp: ${client.regDate}</p>
            </div>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
            <div style="background:rgba(255,255,255,0.01); padding:12px; border-radius:6px; border:1px solid var(--border-color);">
                <span style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase;">Liquid Vault Balance</span>
                <h3 style="margin-top:4px; color:var(--secondary-color); font-size:1.4rem;">$${client.balance.toLocaleString()}</h3>
            </div>
            <div style="background:rgba(255,255,255,0.01); padding:12px; border-radius:6px; border:1px solid var(--border-color);">
                <span style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase;">Contract Sized Allotment</span>
                <h3 style="margin-top:4px; font-size:1.4rem;">$${client.investedAmount.toLocaleString()}</h3>
            </div>
        </div>
        <div style="display:flex; flex-direction:column; gap:8px;">
            <p style="font-size:0.85rem;"><strong>Email Address Line:</strong> ${client.email}</p>
            <p style="font-size:0.85rem;"><strong>Secure Phone Connection:</strong> ${client.phone}</p>
            <p style="font-size:0.85rem;"><strong>Country Node Origin:</strong> ${client.country}</p>
            <p style="font-size:0.85rem;"><strong>Active Tier Allocation:</strong> ${client.activePlan}</p>
        </div>
        <div style="margin-top:20px; display:flex; gap:10px;">
            <button class="nx-btn nx-btn-p" style="background:#ef4444;" onclick="alert('Account user suspend procedure committed.')">Suspend Account Node</button>
            <button class="nx-btn nx-btn-s" onclick="closeEngineModal('modalInvestorProfile')">Close Terminal</button>
        </div>
    `;
    document.getElementById("profileModalContent").innerHTML = content;
    openEngineModal("modalInvestorProfile");
}

function deployNewPlanAssetStream(e) {
    e.preventDefault();
    const payload = {
        name: document.getElementById("formPlanName").value,
        tier: document.getElementById("formPlanTier").value,
        description: document.getElementById("formPlanDescription") ? document.getElementById("formPlanDescription").value : null,
        minimum_investment: parseFloat(document.getElementById("formPlanMin").value),
        maximum_investment: parseFloat(document.getElementById("formPlanMax").value),
        daily_roi: parseFloat(document.getElementById("formPlanRoi").value),
        duration_days: parseInt(document.getElementById("formPlanDuration").value),
        bonus: parseFloat(document.getElementById("formPlanBonus") ? document.getElementById("formPlanBonus").value : 0)
    };

    // Attempt to persist to backend admin endpoint
    fetch('/admin/crypto/plans', {
        method: 'POST',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: JSON.stringify(payload)
    }).then(res => res.json()).then(data => {
        if (data && data.success && data.plan) {
            // map to client shape used in this mock UI
            const p = data.plan;
            const mapped = {
                id: p.id,
                name: p.name,
                tier: p.tier || 'Custom',
                min: parseFloat(p.minimum_investment),
                max: parseFloat(p.maximum_investment),
                roi: parseFloat(p.daily_roi),
                duration: parseInt(p.duration_days),
                investorsCount: 0,
                totalDeposited: 0,
                totalProfit: 0,
                status: p.status || 'Active'
            };
            systemPlans.unshift(mapped);
            closeEngineModal("modalPlanForm");
            e.target.reset();
            renderActivePanelViews();
            return;
        }

        // fallback to local mutation if backend fails
        throw new Error('Failed to persist plan');
    }).catch(() => {
        let nPlan = {
            id: "P-" + (systemPlans.length + 1),
            name: payload.name,
            tier: payload.tier,
            min: payload.minimum_investment,
            max: payload.maximum_investment,
            roi: payload.daily_roi,
            duration: payload.duration_days,
            investorsCount: 0, totalDeposited: 0, totalProfit: 0, status: "Active"
        };
        systemPlans.unshift(nPlan);
        closeEngineModal("modalPlanForm");
        e.target.reset();
        renderActivePanelViews();
    });
}

function adjustClientYield(uuid, amount) {
    let client = systemInvestors.find(i => i.uuid === uuid);
    if(client) {
        client.totalProfit += amount;
        client.balance += amount;
        renderSystemMetricCounters();
        renderActivePanelViews();
    }
}

function mutateDepositStatus(depId, nextStatus) {
    let deposit = systemDeposits.find(d => d.depId === depId);
    if(deposit) {
        deposit.status = nextStatus;
        renderSystemMetricCounters();
        renderActivePanelViews();
    }
}

function decommissionPlan(planId) {
    if (!confirm('Toggle plan status?')) return;
    fetch(`/admin/crypto/plans/${planId}/toggle`, {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': getCsrfToken() }
    }).then(r => r.json()).then(data => {
        if (data && data.success && data.plan) {
            // update local copy
            systemPlans = systemPlans.map(p => p.id == data.plan.id ? Object.assign(p, { status: data.plan.status }) : p);
            renderActivePanelViews();
        }
    }).catch(err => console.error('Toggle failed', err));
}

function deletePlan(planId) {
    if (!confirm('Delete this plan permanently?')) return;
    fetch(`/admin/crypto/plans/${planId}`, {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': getCsrfToken() }
    }).then(r => r.json()).then(data => {
        if (data && data.success) {
            systemPlans = systemPlans.filter(p => p.id != planId);
            renderActivePanelViews();
        }
    }).catch(err => console.error('Delete failed', err));
}

function purgeSignalFeed(id) {
    systemSignals = systemSignals.filter(s => s.id !== id);
    renderActivePanelViews();
}

// --- REALTIME DATA CSV EXPORT EXTRACTOR ---
function triggerReportGenerator() {
    let csvString = "data:text/csv;charset=utf-8,Plan,Min,Max,ROI,Investors,Deposited\r\n";
    systemPlans.forEach(p => { csvString += `${p.name},${p.min},${p.max},${p.roi}%,${p.investorsCount},${p.totalDeposited}\r\n`; });
    let downloadAnchor = document.createElement("a");
    downloadAnchor.setAttribute("href", encodeURI(csvString));
    downloadAnchor.setAttribute("download", `Nexuist_Asset_Audit_${new Date().toISOString().split('T')[0]}.csv`);
    document.body.appendChild(downloadAnchor);
    downloadAnchor.click();
    document.body.removeChild(downloadAnchor);
}

// --- ENGINE MODAL TOGGLERS ---
function openEngineModal(id) { document.getElementById(id).classList.add("active"); }
function closeEngineModal(id) { document.getElementById(id).classList.remove("active"); }

// --- DATA PIPELINE FILTER ENGINE ---
function executeLiveSubfiltering() {
    let query = document.getElementById("engineFilterInput").value.toLowerCase();
    document.querySelectorAll(".nx-table tbody tr").forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(query) ? "" : "none";
    });
}

// --- CHART KINETICS RENDER ---
function spinUpOperationalCharts() {
    const ctxG = document.getElementById("canvasGrowthTrack").getContext("2d");
    new Chart(ctxG, {
        type: 'line',
        data: {
            labels: ['Jun 10', 'Jun 11', 'Jun 12', 'Jun 13', 'Jun 14', 'Jun 15', 'Jun 16'],
            datasets: [{
                label: 'Inbound Value Matrix ($)',
                data: [120000, 185000, 142000, 290000, 310000, 240000, 415000],
                borderColor: '#6c63ff',
                backgroundColor: 'rgba(108, 99, 255, 0.03)',
                borderWidth: 2, tension: 0.38, fill: true
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });

    const ctxD = document.getElementById("canvasAssetDistribution").getContext("2d");
    new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ['Crypto Tier', 'Alpha Layer', 'Prime Vault'],
            datasets: [{
                data: [35, 45, 20],
                backgroundColor: ['#00d4ff', '#8b5cf6', '#6c63ff'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { color: '#94a3b8', font: { size: 10 } } } } }
    });
}