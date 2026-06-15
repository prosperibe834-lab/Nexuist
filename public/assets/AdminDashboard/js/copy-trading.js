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
        if (window.innerWidth <= 991 && !sidebar.contains(e.target) && sidebar.classList.contains("open")) {
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
// =========================================================
    // NEXUIST COPY TRADING PROTOCOL INTERACTION AUTOMATION LOGIC
    // =========================================================
  /* ==========================================================================
   NEXUIST EXPERT TRADING ENGINE - REACTIVE DATABASE MOCK MANAGEMENT
   ========================================================================== */

// --- GLOBAL DATABASES MATRIX SEED ENGINE ---
let expertTraders = [];
let investments = [];
let investors = [];
let portfolios = [];

function hydrateAdminData() {
    const data = window.NEXU_COPY_TRADING || {};

    expertTraders = (data.traders || []).map(bot => ({
        id: bot.id || `EXP-${Math.floor(Math.random() * 10000)}`,
        name: bot.bot_name || 'Expert Trader',
        country: bot.country || 'Unknown',
        strategy: bot.strategy_type || bot.trading_style || 'Copy Trading',
        experience: bot.experience ?? 5,
        roi: Number(bot.monthly_return ?? 0),
        winRate: Number(bot.accuracy_rate ?? 0),
        aum: Number(bot.total_investment ?? 0),
        minInvest: Number(bot.minimum_investment ?? 0),
        maxInvest: Number(bot.maximum_investment ?? 0),
        copiers: Number(bot.total_subscribers ?? 0),
        risk: bot.risk_level || 'Medium',
        status: bot.status || 'Active',
        live: (bot.status || 'Active').toLowerCase() === 'active' ? 'online' : 'offline',
        banner: bot.bot_logo || bot.bot_image || 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=600&q=80',
        avatar: bot.bot_image || `https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80`,
        bio: bot.description || 'Managed copy trading expert profile.',
        total_investment: Number(bot.total_investment ?? 0),
    }));

    investments = (data.investments || []).map(inv => ({
        id: inv.id || `INV-${Math.floor(Math.random() * 100000)}`,
        userId: inv.user?.id || inv.user_id || 'UNKNOWN',
        userName: inv.user?.name || inv.user?.email || 'Unknown Investor',
        userEmail: inv.user?.email || 'unknown@nexuist.com',
        expertId: inv.bot?.id || inv.bot_id || 'UNKNOWN',
        amount: Number(inv.investment_amount ?? inv.amount ?? 0),
        profit: Number(inv.current_profit ?? inv.profit ?? 0),
        dateOpened: inv.created_at ? new Date(inv.created_at).toLocaleDateString() : (inv.dateOpened || 'N/A'),
        status: inv.status || 'Running',
    }));

    investors = (data.investors || []).map(inv => ({
        id: inv.id || `NX-USR-${Math.floor(Math.random() * 10000)}`,
        photo: inv.photo || `https://i.pravatar.cc/100?u=${encodeURIComponent(inv.name || inv.id)}`,
        name: inv.name || `Investor ${inv.id}`,
        email: inv.email || 'unknown@nexuist.com',
        phone: inv.phone || '+0000000000',
        country: inv.country || 'Unknown',
        balance: Number(inv.balance ?? 0),
        totalInvestments: Number(inv.placements ?? 0),
        activeCount: investments.filter(i => i.userId === inv.id && i.status === 'Active').length,
        profitEarned: Number(inv.yield ?? 0),
        status: inv.status || 'Active',
    }));

    portfolios = (data.portfolios || []).map(portfolio => ({
        id: portfolio.id || `PORT-${Math.floor(Math.random() * 10000)}`,
        bot_name: portfolio.bot_name || 'Portfolio Asset',
        balance: Number(portfolio.balance ?? 0),
        operations: Number(portfolio.operations ?? 0),
        net_roi: Number(portfolio.net_roi ?? 0),
    }));
}

// --- INITIALIZATION RUNWAY ---
document.addEventListener("DOMContentLoaded", () => {
    hydrateAdminData();
    recalculateFinancialGlobalMetrics();
    renderExpertTradersGrid();
    renderInvestmentsLedger();
    renderInvestorsDirectory();
    renderPortfoliosConsole();

    const notifTarget = document.getElementById('notifTarget');
    if (notifTarget) {
        notifTarget.addEventListener('change', function() {
            const specific = document.getElementById('notifSpecificUserWrap');
            if (specific) {
                specific.style.display = this.value === 'SINGLE' ? 'block' : 'none';
            }
        });
    }
});

// --- CORE SYSTEM METRIC MATHEMATICAL SYNC ---
function recalculateFinancialGlobalMetrics() {
    document.getElementById("statTotalTraders").innerText = expertTraders.length;
    document.getElementById("statActiveTraders").innerText = expertTraders.filter(t => t.status === "Active").length;
    document.getElementById("statTotalInvestors").innerText = investors.length;
    
    let totalInvested = investments.reduce((acc, curr) => acc + curr.amount, 0);
    let totalProfit = investments.reduce((acc, curr) => acc + curr.profit, 0);
    
    document.getElementById("statTotalInvested").innerText = `$${totalInvested.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
    document.getElementById("statTotalProfit").innerText = `$${totalProfit.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
    document.getElementById("statTodayInvestments").innerText = `$${(totalInvested * 0.12).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
    document.getElementById("statPendingCount").innerText = `${investments.filter(i => i.status === 'Pending').length} Operations Pending`;
    document.getElementById("statTotalWithdrawals").innerText = `$${(totalProfit * 0.4).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
}

// --- RENDERING PIPELINE FOR EXPERT TRADERS GRID ---
function renderExpertTradersGrid(targetData = expertTraders) {
    const grid = document.getElementById("nxtTraderContainerGrid");
    grid.innerHTML = "";
    
    targetData.forEach(t => {
        const card = document.createElement("div");
        card.className = "nxt-glass-card nxt-trader-card";
        card.innerHTML = `
            <div class="nxt-trader-banner" style="background-image: url('${t.banner}')">
                <div class="nxt-trader-avatar-wrap"><img src="${t.avatar}" alt="Avatar"></div>
            </div>
            <div class="nxt-trader-body">
                <div class="nxt-trader-meta">
                    <div>
                        <h3 class="nxt-trader-name">${t.name}</h3>
                        <p class="nxt-trader-strat">${t.strategy} (${t.experience} Yrs Exp)</p>
                    </div>
                    <span class="nxt-status-badge ${t.live}">${t.live}</span>
                </div>
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-top:10px; line-height:1.4; height:40px; overflow:hidden;">${t.bio}</p>
                
                <div class="nxt-metric-matrix">
                    <div class="nxt-matrix-item"><div class="nxt-matrix-lbl">Mo. ROI</div><div class="nxt-matrix-val" style="color: #10b981;">${t.roi}%</div></div>
                    <div class="nxt-matrix-item"><div class="nxt-matrix-lbl">Win Rate</div><div class="nxt-matrix-val" style="color: var(--secondary-color);">${t.winRate}%</div></div>
                    <div class="nxt-matrix-item"><div class="nxt-matrix-lbl">Copiers</div><div class="nxt-matrix-val">${t.copiers}</div></div>
                </div>

                <div style="font-size:0.8rem; color:var(--text-secondary); display:flex; flex-direction:column; gap:4px; border-bottom:1px solid var(--border-color); padding-bottom:12px; margin-bottom:12px;">
                    <div style="display:flex; justify-content:space-between;"><span>AUM Allocation:</span><strong style="color:#fff;">$${t.aum.toLocaleString()}</strong></div>
                    <div style="display:flex; justify-content:space-between;"><span>Risk Level:</span><span style="font-weight:600; color:${t.risk === 'High' ? '#ef4444' : '#10b981'}">${t.risk}</span></div>
                </div>

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <button class="nxt-btn nxt-btn-secondary" style="padding:6px 12px; font-size:0.75rem;" onclick="triggerCalibrationModal('${t.id}')"><i class="bx bx-slider-alt"></i> Calibrate</button>
                    <div style="display:flex; gap:6px;">
                        <button class="nxt-btn" style="padding:6px; background:${t.status==='Active'?'rgba(239,68,68,0.1)':'rgba(16,185,129,0.1)'}; color:${t.status==='Active'?'#ef4444':'#10b981'}" onclick="toggleTraderStatus('${t.id}')">
                            <i class="bx ${t.status==='Active'?'bx-block':'bx-check-shield'}"></i>
                        </button>
                        <button class="nxt-btn" style="padding:6px; background:rgba(239,68,68,0.15); color:#ef4444;" onclick="executeTraderPurge('${t.id}')"><i class="bx bx-trash"></i></button>
                    </div>
                </div>
            </div>
        `;
        grid.appendChild(card);
    });
}

// --- RENDERING PIPELINE FOR INVESTMENTS LEDGER ---
function renderInvestmentsLedger(targetData = investments) {
    const tbody = document.getElementById("nxtInvestmentsTableBody");
    tbody.innerHTML = "";
    
    targetData.forEach(i => {
        const trader = expertTraders.find(t => t.id == i.expertId) || { name: "System Managed" };
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td><span style="font-family: monospace; color: var(--text-secondary);">${i.id}</span></td>
            <td><div><strong>${i.userName}</strong><br><span style="font-size:0.75rem; color:var(--text-muted);">${i.userEmail}</span></div></td>
            <td><span style="color: var(--secondary-color); font-weight:500;">${trader.name}</span></td>
            <td style="font-weight:600;">$${i.amount.toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
            <td style="color:#10b981; font-weight:600;">+$${i.profit.toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
            <td><span class="nxt-status-badge online">${i.status}</span></td>
            <td><span style="font-size:0.8rem; color:var(--text-muted);">${i.dateOpened}</span></td>
            <td style="text-align: right;">
                <button class="nxt-btn nxt-btn-secondary" style="padding:5px 10px; font-size:0.75rem;" onclick="triggerProfitModal('${i.id}')"><i class="bx bx-dollar-circle"></i> Yield Profit</button>
                <button class="nxt-btn" style="padding:5px; background:rgba(239,68,68,0.1); color:#ef4444; margin-left:4px;" onclick="terminateInvestmentPlacement('${i.id}')"><i class="bx bx-power-off"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// --- RENDERING PIPELINE FOR INVESTOR DIRECTORY ---
function renderInvestorsDirectory(targetData = investors) {
    const tbody = document.getElementById("nxtInvestorsTableBody");
    tbody.innerHTML = "";
    
    targetData.forEach(user => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td><span style="font-family:monospace;">${user.id}</span></td>
            <td>
                <div style="display:flex; align-items:center; gap:10px;">
                    <img src="${user.photo}" style="width:32px; height:32px; border-radius:50%; object-fit:cover;">
                    <div><strong>${user.name}</strong><br><span style="font-size:0.75rem; color:var(--text-muted);">${user.email}</span></div>
                </div>
            </td>
            <td><span style="font-size:0.85rem;">${user.country}</span></td>
            <td style="font-weight:600;">$${user.balance.toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
            <td style="text-align:center;">${user.totalInvestments}</td>
            <td style="color:#10b981; font-weight:600;">+$${user.profitEarned.toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
            <td style="text-align: right;">
                <button class="nxt-btn nxt-btn-secondary" style="padding:4px 8px; font-size:0.75rem;" onclick="alert('Viewing profile context for: ${user.name}')">Profile</button>
                <button class="nxt-btn" style="padding:4px 6px; background:rgba(239,68,68,0.1); color:#ef4444;" onclick="executeInvestorPurge('${user.id}')"><i class="bx bx-user-x"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// --- RENDERING PIPELINE FOR PORTFOLIOS MANAGEMENT ---
function renderPortfoliosConsole() {
    const tbody = document.getElementById("nxtPortfoliosTableBody");
    if (!tbody) return;
    tbody.innerHTML = "";

    portfolios.forEach(portfolio => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td><span style="font-family:monospace; font-weight:600;">PTF-${portfolio.id}</span></td>
            <td style="font-weight:600; color:var(--secondary-color);">$${portfolio.balance.toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
            <td><span class="nxt-status-badge trading">${portfolio.operations} Active Positions</span></td>
            <td><span style="font-size:0.85rem; color:var(--text-secondary);">${portfolio.bot_name}</span></td>
            <td style="color:#10b981; font-weight:600;">+${portfolio.net_roi}%</td>
            <td style="text-align: right;">
                <button class="nxt-btn nxt-btn-secondary" style="padding:4px 8px; font-size:0.75rem;" onclick="alert('Portfolio adjustment workflow not enabled yet.')"><i class="bx bx-edit-alt"></i> Adjust</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// --- INTERACTIVE FORM LOGIC PROCESSORS ---

function processTraderOnboarding(e) {
    e.preventDefault();

    const payload = {
        name: document.getElementById("ctName").value,
        country: document.getElementById("ctCountry").value,
        strategy: document.getElementById("ctStrategy").value,
        roi: document.getElementById("ctRoi").value,
        winRate: document.getElementById("ctWinRate").value,
        aum: document.getElementById("ctAum").value,
        min: document.getElementById("ctMin").value,
        avatar: document.getElementById("ctAvatar").value,
        banner: document.getElementById("ctBanner").value,
        status: document.getElementById("ctStatus").value,
        risk: document.getElementById("ctRisk").value,
        bio: document.getElementById("ctBio").value
    };

    fetch('/admin/copy-trading/traders', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeTradingModal('modalCreateTrader');
            document.getElementById("formOnboardTrader").reset();
            hydrateAdminData();
            executeDataUIRefresh();
        } else {
            alert(data.message || 'Unable to onboard expert trader.');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Unable to onboard expert trader.');
    });
}

function triggerCalibrationModal(id) {
    const trader = expertTraders.find(t => t.id == id);
    if (!trader) return;
    document.getElementById("calTargetTraderId").value = trader.id;
    document.getElementById("calRoi").value = trader.roi;
    document.getElementById("calWin").value = trader.winRate;
    document.getElementById("calAum").value = trader.aum;
    document.getElementById("calCopiers").value = trader.copiers;
    openTradingModal('modalCalibratePerformance');
}

function processPerformanceCalibration(e) {
    e.preventDefault();
    const payload = {
        bot_id: document.getElementById("calTargetTraderId").value,
        roi: document.getElementById("calRoi").value,
        winRate: document.getElementById("calWin").value,
        aum: document.getElementById("calAum").value,
        copiers: document.getElementById("calCopiers").value,
    };

    fetch('/admin/copy-trading/calibrate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeTradingModal('modalCalibratePerformance');
            hydrateAdminData();
            executeDataUIRefresh();
        } else {
            alert(data.message || 'Unable to calibrate trader.');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Unable to calibrate trader.');
    });
}

function triggerProfitModal(id) {
    document.getElementById("profTargetInvestmentId").value = id;
    openTradingModal('modalManualProfitCredit');
}

function processManualProfitInjection(e) {
    e.preventDefault();
    const payload = {
        investment_id: document.getElementById("profTargetInvestmentId").value,
        amount: document.getElementById("profAmount").value,
        modality: document.getElementById("profModality").value,
    };

    fetch('/admin/copy-trading/profit-adjust', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeTradingModal('modalManualProfitCredit');
            document.getElementById("formManualProfit").reset();
            hydrateAdminData();
            executeDataUIRefresh();
        } else {
            alert(data.message || 'Unable to adjust profit.');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Unable to adjust profit.');
    });
}

function processBroadcastDistribution(e) {
    e.preventDefault();
    const payload = {
        target: document.getElementById('notifTarget').value,
        target_user: document.getElementById('notifTargetUser').value,
        type: document.getElementById('notifType').value,
        payload: document.getElementById('notifPayload').value,
    };

    fetch('/admin/copy-trading/notify', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeTradingModal('modalNotification');
            document.getElementById("formBroadcastMessage").reset();
        } else {
            alert(data.message || 'Unable to send notification.');
        }
    })
    .catch(error => {
        console.error(error);
        alert('Unable to send notification.');
    });
}

// --- UTILITY REACTION SYSTEMS ---
function toggleTraderStatus(id) {
    const trader = expertTraders.find(t => t.id === id);
    if (trader) trader.status = trader.status === "Active" ? "Inactive" : "Active";
    executeDataUIRefresh();
}

function executeTraderPurge(id) {
    if (confirm("Confirm structural deletion of this expert trader from the core execution cluster?")) {
        expertTraders = expertTraders.filter(t => t.id !== id);
        executeDataUIRefresh();
    }
}

function executeInvestorPurge(id) {
    if (confirm("Confirm hard account suspension?")) {
        investors = investors.filter(i => i.id !== id);
        executeDataUIRefresh();
    }
}

function terminateInvestmentPlacement(id) {
    if (confirm("Force contract closure on this copy-allocation record?")) {
        const inv = investments.find(i => i.id === id);
        if (inv) inv.status = "Completed";
        executeDataUIRefresh();
    }
}

function executeTerminalDataFiltering() {
    const query = document.getElementById("nxtGlobalSearch").value.toLowerCase().trim();
    const filter = document.getElementById("nxtFilterStatus").value;

    // Filter Traders Database
    let filteredTraders = expertTraders.filter(t => {
        const matchesQuery = t.name.toLowerCase().includes(query) || t.strategy.toLowerCase().includes(query) || t.country.toLowerCase().includes(query);
        const matchesFilter = filter === "ALL" || (filter === "ONLINE" && t.live === "online") || (filter === "OFFLINE" && t.live === "offline");
        return matchesQuery && matchesFilter;
    });

    // Filter Investments Database
    let filteredInvestments = investments.filter(i => {
        const matchesQuery = i.userName.toLowerCase().includes(query) || i.userEmail.toLowerCase().includes(query) || i.id.toLowerCase().includes(query);
        const matchesFilter = filter === "ALL" || (filter === "ACTIVE" && i.status === "Active") || (filter === "COMPLETED" && i.status === "Completed");
        return matchesQuery && matchesFilter;
    });

    renderExpertTradersGrid(filteredTraders);
    renderInvestmentsLedger(filteredInvestments);
}

function executeDataUIRefresh() {
    recalculateFinancialGlobalMetrics();
    executeTerminalDataFiltering();
    renderInvestorsDirectory();
    renderPortfoliosConsole();
}

// --- UI EVENT INTERACTION FRAMEWORK HANDLING ---
function switchTradingTab(e, tabId) {
    document.querySelectorAll(".nxt-tab-btn").forEach(b => b.classList.remove("active"));
    document.querySelectorAll(".nxt-tab-content-panel").forEach(p => p.style.display = "none");
    
    e.target.classList.add("active");
    document.getElementById(tabId).style.display = "block";
}

function openTradingModal(id) { document.getElementById(id).classList.add("active"); }
function closeTradingModal(id) { document.getElementById(id).classList.remove("active"); }