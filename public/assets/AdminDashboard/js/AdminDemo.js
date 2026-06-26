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

const adminDemoData = (() => {
    const script = document.getElementById('adminDemoData');
    if (!script) return {};
    try {
        return JSON.parse(script.textContent || '{}');
    } catch (error) {
        console.error('Failed to parse admin demo data:', error);
        return {};
    }
})();

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

// =========================================================================
// NEXUIST ADMINISTRATIVE FRAMEWORK - CORE WEBSITE SETTINGS RUNTIME LOGIC
// =========================================================================

/* ==========================================================================
   NEXUIST DASHBOARD SYSTEM CORE LOGIC RUNTIME
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initializeInternalRouterTabs();
    initializeAnimatedCounters();
    initializeSparklineCharts();
    initializeCoreAnalyticsCharts();
    initializeDynamicDataTables();
    initializeFilterControls();
    initializeLiveActivityStream();
    initializeGlobalSearchEngine();
    setupEscapeKeyBinding();
});

// --- 1. INTERNAL ROUTER TAB SWITCHER ENGINE ---
function initializeInternalRouterTabs() {
    const tabs = document.querySelectorAll('.nav-tab-btn');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content-pane').forEach(p => p.classList.remove('active'));
            
            tab.classList.add('active');
            const target = tab.getAttribute('data-target');
            document.getElementById(target).classList.add('active');
        });
    });
}

// --- 2. PREMIUM COUNT UP SYSTEM ANIMATIONS ---
function initializeAnimatedCounters() {
    const counters = document.querySelectorAll('.counter-value');
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        let current = 0;
        const increment = target / 60; // 60 frame cycle execution
        
        const updateFrame = () => {
            current += increment;
            if (current < target) {
                counter.innerText = Math.ceil(current).toLocaleString();
                requestAnimationFrame(updateFrame);
            } else {
                counter.innerText = target.toLocaleString();
            }
        };
        requestAnimationFrame(updateFrame);
    });
}

// --- 3. DUMMY SPARKLINE LOGIC (APEXCHARTS) ---
function initializeSparklineCharts() {
    const sparkOptions = {
        chart: { type: 'area', height: 50, sparkline: { enabled: true }, animations: { enabled: true } },
        stroke: { curve: 'smooth', width: 2 },
        fill: { opacity: 0.1 },
        colors: ['#00d4ff'],
        tooltip: { enabled: false }
    };

    const ids = ['#sparkline-users', '#sparkline-active', '#sparkline-deposits', '#sparkline-bots'];
    ids.forEach(id => {
        if(document.querySelector(id)) {
            const key = id.replace('#', '');
            const data = adminDemoData.sparklineData?.[key] ?? Array.from({length: 10}, () => Math.floor(Math.random() * 100));
            const chart = new ApexCharts(document.querySelector(id), {
                ...sparkOptions,
                series: [{ data }]
            });
            chart.render();
        }
    });
}

// --- 4. DATA VISUALIZATION SYSTEMS (APEXCHARTS & CHART.JS) ---
let globalApexRevenueChartInstance = null;

function initializeCoreAnalyticsCharts() {
    // A. Revenue Stream Matrix (ApexCharts Area View)
    const revenueLabels = adminDemoData.revenueLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
    const revenueSeries = adminDemoData.revenueSeries ?? [31000, 40000, 28000, 51000, 42000, 109000, 148000];
    const revOptions = {
        chart: { type: 'area', height: '100%', toolbar: { show: false }, background: 'transparent' },
        series: [{ name: 'Ecosystem Revenue ($)', data: revenueSeries }],
        xaxis: { categories: revenueLabels, labels: { style: { colors: '#64748b' } } },
        yaxis: { labels: { style: { colors: '#64748b' } } },
        stroke: { curve: 'smooth', width: 3 },
        colors: ['#6c63ff'],
        grid: { borderColor: 'rgba(255,255,255,0.04)' },
        theme: { mode: 'dark' }
    };
    globalApexRevenueChartInstance = new ApexCharts(document.querySelector("#apexRevenueChart"), revOptions);
    globalApexRevenueChartInstance.render();

    // B. User Acquisition Vectors (ApexCharts Bar View)
    const acquisitionSeries = adminDemoData.acquisitionSeries ?? [400, 550, 750, 810, 600, 950, 1200];
    const acquisitionLabels = revenueLabels;
    const growthOptions = {
        chart: { type: 'bar', height: '100%', toolbar: { show: false } },
        series: [{ name: 'Registrations', data: acquisitionSeries }],
        xaxis: { categories: acquisitionLabels, labels: { style: { colors: '#64748b' } } },
        colors: ['#8b5cf6'],
        grid: { borderColor: 'rgba(255,255,255,0.04)' },
        theme: { mode: 'dark' }
    };
    const growthChart = new ApexCharts(document.querySelector("#apexGrowthChart"), growthOptions);
    growthChart.render();

    // C. Clearing Spread (Chart.js Mix)
    const depositWithdrawSeries = adminDemoData.depositWithdrawSeries ?? null;
    const ctxDep = document.getElementById('ctxDepositWithdrawChart');
    if(ctxDep) {
        new Chart(ctxDep.getContext('2d'), {
            type: 'line',
            data: {
                labels: depositWithdrawSeries?.labels ?? ['W1', 'W2', 'W3', 'W4'],
                datasets: [
                    { label: 'Deposits', data: depositWithdrawSeries?.deposits ?? [50000, 85000, 60000, 120000], borderColor: '#10b981', tension: 0.3 },
                    { label: 'Withdrawals', data: depositWithdrawSeries?.withdrawals ?? [30000, 40000, 35000, 70000], borderColor: '#ef4444', tension: 0.3 }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { labels: { color: '#94a3b8' } } } }
        });
    }

    // D. AI Quant Allocation Share (Chart.js Doughnut)
    const botShare = adminDemoData.botShare ?? [{ label: 'Alpha Bot', value: 55 }, { label: 'Shadow Grid', value: 30 }, { label: 'Arbitrage Unit', value: 15 }];
    const ctxBot = document.getElementById('ctxBotPerformanceChart');
    if(ctxBot) {
        new Chart(ctxBot.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: botShare.map(item => item.label),
                datasets: [{ data: botShare.map(item => item.value), backgroundColor: ['#6c63ff', '#00d4ff', '#8b5cf6'], borderWidth: 0 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'right', labels: { color: '#94a3b8' } } } }
        });
    }
}

// --- 5. DATA INJECTION INTERFACES MOCK LEDGERS ---
function initializeDynamicDataTables() {
    const userBody = document.getElementById('usersTableBody');
    if(userBody) {
        userBody.innerHTML = '';
        const users = adminDemoData.users || [];
        if (users.length === 0) {
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = '<td colspan="8" class="text-center">No users available.</td>';
            userBody.appendChild(emptyRow);
        } else {
            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="checkbox" class="user-row-checkbox" value="${user.id}"></td>
                    <td>
                        <div class="user-profile-td">
                            <img src="https://api.dicebear.com/7.x/bottts/svg?seed=${user.username}" alt="avatar">
                            <div><strong>${user.name}</strong><br><small style="color:var(--text-muted)">@${user.username}</small></div>
                        </div>
                    </td>
                    <td>${user.email}</td>
                    <td>${user.country}</td>
                    <td><strong>$${Number(user.balance).toLocaleString(undefined, {minimumFractionDigits: 2})}</strong></td>
                    <td><span class="status-badge ${user.status}">${user.status?.toUpperCase() ?? 'N/A'}</span></td>
                    <td>${user.joined}</td>
                    <td class="txt-right">
                        <div class="action-row-buttons">
                            <button class="btn btn-secondary" style="padding: 6px 12px;" onclick="openUserProfileDiagnosticModal(${user.id})"><i class="bx bx-show"></i> Inspect</button>
                        </div>
                    </td>
                `;
                userBody.appendChild(row);
            });
        }
    }

    const depBody = document.getElementById('depositsTableBody');
    if(depBody) {
        const deposits = adminDemoData.deposits || [];
        depBody.innerHTML = deposits.length ? deposits.map(deposit => `
            <tr>
                <td>${deposit.user}</td>
                <td><strong>$${Number(deposit.amount).toLocaleString(undefined, {minimumFractionDigits: 2})}</strong></td>
                <td>${deposit.method}</td>
                <td><small class="id-lbl">${deposit.txid}</small></td>
                <td><span class="status-badge ${deposit.status.toLowerCase()}">${deposit.status}</span></td>
                <td class="txt-right"><button class="btn btn-primary" style="padding:4px 10px;" onclick="approveDeposit('${deposit.txid}')">Clear</button></td>
            </tr>
        `).join('') : '<tr><td colspan="6" class="text-center">No deposit records available.</td></tr>';
    }

    const witBody = document.getElementById('withdrawalsTableBody');
    if(witBody) {
        const withdrawals = adminDemoData.withdrawals || [];
        witBody.innerHTML = withdrawals.length ? withdrawals.map(withdrawal => `
            <tr>
                <td>${withdrawal.user}</td>
                <td><strong>$${Number(withdrawal.amount).toLocaleString(undefined, {minimumFractionDigits: 2})}</strong></td>
                <td>${withdrawal.destination}</td>
                <td><span class="status-badge ${withdrawal.status.toLowerCase()}">${withdrawal.status}</span></td>
                <td class="txt-right"><i class="bx bx-check-shield text-up"></i> ${withdrawal.status === 'Approved' ? 'Cleared' : 'Pending'}</td>
            </tr>
        `).join('') : '<tr><td colspan="5" class="text-center">No withdrawal requests found.</td></tr>';
    }

    const plansBody = document.getElementById('plansTableBody');
    if(plansBody) {
        const plans = adminDemoData.plans || [];
        plansBody.innerHTML = plans.length ? plans.map(plan => `
            <tr>
                <td><strong>${plan.name}</strong></td>
                <td class="text-up"><strong>${plan.roi}</strong></td>
                <td>${plan.duration}</td>
                <td>${plan.limits}</td>
                <td><span class="status-badge active">${plan.risk}</span></td>
                <td class="txt-right"><button class="btn btn-secondary" style="padding:4px 8px;">Modify</button></td>
            </tr>
        `).join('') : '<tr><td colspan="6" class="text-center">No investment plans available.</td></tr>';
    }

    const botsGrid = document.getElementById('aiBotsGrid');
    if(botsGrid) {
        const bots = adminDemoData.bots || [];
        botsGrid.innerHTML = bots.length ? bots.map(bot => `
            <div class="bot-profile-card">
                <img src="https://api.dicebear.com/7.x/identicon/svg?seed=${bot.name}" alt="bot">
                <h4>${bot.name}</h4>
                <p style="font-size:0.8rem; color:var(--text-secondary); margin:6px 0;">Accuracy Rate: <strong>${bot.accuracy}%</strong></p>
                <span class="status-badge ${bot.status}">${bot.status.toUpperCase()}</span>
            </div>
        `).join('') : '<div class="empty-state">No AI bots available.</div>';
    }

    renderOpenPositions();
}

function renderOpenPositions(positions = null) {
    const openBody = document.getElementById('openPositionsTableBody');
    if(!openBody) return;

    const openPositions = positions ?? adminDemoData.openPositions ?? [];
    openBody.innerHTML = openPositions.length ? openPositions.map(position => `
        <tr>
            <td>${position.user}</td>
            <td>${position.asset}</td>
            <td>${position.direction}</td>
            <td><strong>$${Number(position.amount).toLocaleString(undefined, {minimumFractionDigits: 2})}</strong></td>
            <td>${position.country}</td>
            <td>${position.tier}</td>
            <td>${position.opened_at}</td>
            <td><span class="status-badge ${position.status.toLowerCase()}">${position.status}</span></td>
        </tr>
    `).join('') : '<tr><td colspan="8" class="text-center">No live positions currently tracked.</td></tr>';
}

function initializeFilterControls() {
    const btnApplyFilters = document.getElementById('btnApplyFilters');
    const btnResetFilters = document.getElementById('btnResetFilters');
    if(btnApplyFilters) {
        btnApplyFilters.addEventListener('click', () => {
            const dateStart = document.getElementById('filterDateStart')?.value;
            const country = document.getElementById('filterCountry')?.value;
            const tier = document.getElementById('filterTier')?.value;

            const filtered = (adminDemoData.openPositions || []).filter(position => {
                const matchesDate = !dateStart || position.opened_at >= dateStart;
                const matchesCountry = country === 'ALL' || position.country === country;
                const matchesTier = tier === 'ALL' || position.tier === tier;
                return matchesDate && matchesCountry && matchesTier;
            });

            renderOpenPositions(filtered);
        });
    }

    if(btnResetFilters) {
        btnResetFilters.addEventListener('click', () => {
            const dateInput = document.getElementById('filterDateStart');
            const countryInput = document.getElementById('filterCountry');
            const tierInput = document.getElementById('filterTier');

            if(dateInput) dateInput.value = '';
            if(countryInput) countryInput.value = 'ALL';
            if(tierInput) tierInput.value = 'ALL';
            renderOpenPositions();
        });
    }
}

// --- 6. REALTIME EVENT STREAM EMULATION ---
function initializeLiveActivityStream() {
    const stream = document.getElementById('liveActivityStream');
    if(!stream) return;

    const activityLog = adminDemoData.activityLog && adminDemoData.activityLog.length ? adminDemoData.activityLog : [
        { message: "User @johndoe requested a vault liquidation balance map update.", time: 'Just now' },
        { message: "System Automaton 'Alpha Arbitrage' routed 4.12 BTC into clearing nodes.", time: '2m ago' },
        { message: "Inbound wire confirmation received for validation block #90123.", time: '5m ago' },
        { message: "Support Ticket #4301 prioritization assigned to Tier 3 clearance desk.", time: '8m ago' }
    ];

    activityLog.slice(0, 6).forEach(item => {
        const node = document.createElement('div');
        node.className = 'feed-node-item';
        node.innerHTML = `<strong>[KERNEL LOG]</strong> ${item.message} <br><small style="color:var(--text-muted)">${item.time}</small>`;
        stream.appendChild(node);
    });

    setInterval(() => {
        const event = activityLog[Math.floor(Math.random() * activityLog.length)];
        const node = document.createElement('div');
        node.className = 'feed-node-item';
        node.innerHTML = `<strong>[KERNEL LOG]</strong> ${event.message} <br><small style="color:var(--text-muted)">${event.time}</small>`;
        stream.prepend(node);
        if(stream.children.length > 6) stream.lastChild.remove();
    }, 6000);
}

// --- 7. COMMAND SEARCH INTERFACE MATRIX ---
function initializeGlobalSearchEngine() {
    const input = document.getElementById('globalSearchInput');
    const dropdown = document.getElementById('searchSuggestions');
    if(!input) return;

    input.addEventListener('input', () => {
        const val = input.value.trim().toLowerCase();
        if(val.length < 2) { dropdown.style.display = 'none'; return; }

        dropdown.innerHTML = `
            <div class="search-suggestion-item" onclick="executeSuggestionClick('User Node: John Doe')"><i class="bx bx-user"></i> Core Profile Match: <strong>${val}</strong></div>
            <div class="search-suggestion-item" onclick="executeSuggestionClick('Transaction ID Matching Block')"><i class="bx bx-hash"></i> Vault Ledger Block containing: <strong>${val}</strong></div>
        `;
        dropdown.style.display = 'block';
    });

    document.addEventListener('click', (e) => {
        if(!input.contains(e.target)) dropdown.style.display = 'none';
    });
}

window.executeSuggestionClick = function(text) {
    Swal.fire({ title: 'Omni-Search Target Located', text: `Routing workspace viewport engine allocation to: ${text}`, icon: 'info', confirmButtonColor: '#6c63ff' });
    document.getElementById('searchSuggestions').style.display = 'none';
};

// --- 8. SYSTEM DYNAMIC MODALS MANIPULATION LAYER ---
window.openUserProfileDiagnosticModal = function(id) {
    const user = (adminDemoData.users || []).find(u => u.id === id);
    if(!user) return;

    const target = document.getElementById('modalRenderTarget');
    document.getElementById('modalTitleContainer').innerText = `Diagnostic Ledger for User Ref: @${user.username}`;
    
    target.innerHTML = `
        <div class="modal-tabs-strip">
            <button class="modal-tab-trigger active">Profile Metrics</button>
            <button class="modal-tab-trigger">Vault Actions</button>
            <button class="modal-tab-trigger">Risk Profile</button>
        </div>
        <div style="display:flex; flex-direction:column; gap:14px; font-size:0.9rem;">
            <p>Formal Identity Designation: <strong>${user.name}</strong></p>
            <p>Federated Email Boundary: <strong>${user.email}</strong></p>
            <p>Ecosystem Cleared Capital Base: <strong style="color:var(--secondary-color)">$${Number(user.balance).toLocaleString(undefined, {minimumFractionDigits: 2})}</strong></p>
            <div style="display:flex; gap:10px; margin-top:14px;">
                <button class="btn btn-primary" onclick="adjustUserVaultBalance('${user.name}', 'CREDIT')">Credit Vault</button>
                <button class="btn btn-secondary" onclick="adjustUserVaultBalance('${user.name}', 'DEBIT')">Debit Vault</button>
                <button class="btn" style="background:#ef4444; color:#fff;" onclick="closeSystemModal()">Freeze Node Account</button>
            </div>
        </div>
    `;
    document.getElementById('nexuistMasterModal').classList.add('active');
};

window.closeSystemModal = function() {
    document.getElementById('nexuistMasterModal').classList.remove('active');
};

function setupEscapeKeyBinding() {
    document.addEventListener('keydown', (e) => {
        if(e.key === 'Escape') closeSystemModal();
    });
}

// --- 9. AUXILIARY ADMINISTRATIVE FUNCTIONS ---
window.adjustUserVaultBalance = function(name, action) {
    Swal.fire({
        title: `Configure Balance Adjustment Parameter`,
        text: `Define financial vector allocation adjustment to ${action} for ${name}`,
        input: 'number',
        inputAttributes: { step: '0.01' },
        showCancelButton: true,
        confirmButtonText: 'Commit Change',
        confirmButtonColor: '#6c63ff'
    }).then((result) => {
        if(result.isConfirmed) {
            Swal.fire('Ecosystem Matrix Balance Updated', `Value of $${result.value} processed successfully.`, 'success');
            closeSystemModal();
        }
    });
};

window.approveDeposit = function(id) {
    Swal.fire({
        title: 'Approve Clearing Settlement?',
        text: `Inbound Ledger Transaction Reference ${id} will be settled into the target wallet allocation.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        confirmButtonText: 'Authorize Clear Session'
    }).then((res) => {
        if(res.isConfirmed) Swal.fire('Settled', 'Transaction state marked as completed.', 'success');
    });
};

window.triggerSystemExport = function(ledgerName, format) {
    Swal.fire({
        title: 'Assembling Secure Export File Stream',
        text: `Compiling data structure mapping for ${ledgerName} array block directly into .${format}`,
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
};

window.exportChartData = function(chartName, format) {
    Swal.fire('Chart Layer Stream Extracted', `Rendering visual map into file descriptor format: ${format.toUpperCase()}`, 'success');
};

window.toggleFullscreenChart = function(wrapperId) {
    const wrapper = document.getElementById(wrapperId);
    if(!document.fullscreenElement) {
        wrapper.requestFullscreen().catch(err => {
            console.error(`Error forcing full matching screen interface layers: ${err.message}`);
        });
    } else {
        document.exitFullscreen();
    }
};