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
// =========================================================
    // NEXUIST QUANTUM COGNITIVE BOT INTELLIGENCE ENGINE LOGIC
    // =========================================================
  /**
 * =========================================================================
 * NEXUIST SYSTEM ADVANCED MANAGEMENT PROCESS ENGINE IMPLEMENTATION RUNTIME
 * CODES ARE ENTIRELY COMPARTMENTALIZED UNDER PRIVATE ARCHITECTURE CONTEXTS
 * =========================================================================
 */
(function() {
    // 1. Data Store Systems Modeling Registries State Definitions
    let internalNeuralEngineRegistryDS = [
        { id: "SYS-NX-01", name: "Nexuist Alpha Extreme", strategy: "Scalping", monthlyReturn: 24.52, annualReturn: 294.24, accuracy: 92.41, drawdown: 3.82, subscribers: 1245, totalInvestment: 850450, riskLevel: "High", status: "Active", featured: true, premium: false, popular: true, description: "High frequency quantitative scalping platform optimization engine routing parameters directly through structural liquidity networks pools." },
        { id: "SYS-NX-02", name: "Nexuist Pro Swing", strategy: "Swing Trading", monthlyReturn: 18.71, annualReturn: 224.52, accuracy: 89.12, drawdown: 2.15, subscribers: 856, totalInvestment: 620350, riskLevel: "Medium", status: "Active", featured: false, premium: true, popular: false, description: "Macro trends velocity pattern mapping pipeline extracting directional momentum indicators from index commodities assets pools parameters." },
        { id: "SYS-NX-03", name: "Nexuist Quantum Intraday", strategy: "Day Trading", monthlyReturn: 15.34, annualReturn: 184.08, accuracy: 87.65, drawdown: 1.95, subscribers: 642, totalInvestment: 410250, riskLevel: "Medium", status: "Active", featured: false, premium: false, popular: false, description: "Micro temporal price disparity arbitrage system monitoring high density liquid blockchain trading routes networks tokens grids." },
        { id: "SYS-NX-04", name: "Nexuist Titan Rebalancer", strategy: "Long Term", monthlyReturn: 12.82, annualReturn: 153.84, accuracy: 84.22, drawdown: 0.75, subscribers: 356, totalInvestment: 280150, riskLevel: "Low", status: "Inactive", featured: false, premium: false, popular: false, description: "Low risk passive asset reallocation algorithm targeting yield optimizations via structural risk isolation parameters indices portfolio weights." },
        { id: "SYS-NX-05", name: "Nexuist Momentum Scalper", strategy: "Scalping", monthlyReturn: 22.15, annualReturn: 265.80, accuracy: 91.32, drawdown: 4.12, subscribers: 546, totalInvestment: 320750, riskLevel: "High", status: "Active", featured: true, premium: true, popular: false, description: "Order-flow momentum delta imbalances exploitation route deploying micro layer parameters inside currency derivative pairings." }
    ];

    let dynamicInvestorAllocationsDS = [
        { userId: "USR-8821", name: "Alex Mercer", email: "alex.m@nexuist.io", country: "United States", botName: "Nexuist Alpha Extreme", amount: 15000, profit: 3678, roi: 24.52, startDate: "2026-01-12", endDate: "2026-07-12", daysRemaining: 36, status: "Running", phone: "+1 (555) 234-5678", username: "amercer_quant", walletBalance: 4520, totalDeposits: 25000, totalWithdrawals: 6500, totalInvestments: 15000 },
        { userId: "USR-4402", name: "Elena Rostova", email: "elena.r@nexuist.io", country: "Germany", botName: "Nexuist Pro Swing", amount: 25000, profit: 4677, roi: 18.71, startDate: "2025-11-05", endDate: "2026-05-05", daysRemaining: 0, status: "Completed", phone: "+49 89 234567", username: "elena_quant", walletBalance: 12850, totalDeposits: 40000, totalWithdrawals: 10320, totalInvestments: 25000 },
        { userId: "USR-1094", name: "Hiroshi Tanaka", email: "tanaka@nexuist.io", country: "Japan", botName: "Nexuist Quantum Intraday", amount: 8500, profit: -230, roi: -2.70, startDate: "2026-04-20", endDate: "2026-10-20", daysRemaining: 136, status: "Cancelled", phone: "+81 3 5555 0123", username: "htanaka", walletBalance: 1420, totalDeposits: 12000, totalWithdrawals: 3270, totalInvestments: 8500 },
        { userId: "USR-6315", name: "Marcus Vance", email: "m.vance@nexuist.io", country: "United Kingdom", botName: "Nexuist Alpha Extreme", amount: 50000, profit: 12260, roi: 24.52, startDate: "2026-02-01", endDate: "2026-08-01", daysRemaining: 56, status: "Running", phone: "+44 20 7946 0192", username: "mvance_alpha", walletBalance: 24150, totalDeposits: 85000, totalWithdrawals: 10890, totalInvestments: 50000 }
    ];

    // 2. Global Scoped State Variables Trackers Flags
    let activeWizardFormStepPointer = "nx-adv-pane-basic-info";
    let targetPurgeSystemNodeHashId = null;
    let liveTickerRefreshCountdownVal = 30;
    let liveTickerIntervalTimerHost = null;

    // 3. System Entry Pipeline Hook Initializer Handler
   // 3. System Entry Pipeline Hook Initializer Handler
    function refreshDashboardDataMetrics() {
        // No-op: actual bot and investment tables are rendered server-side.
        return true;
    }

    document.addEventListener("DOMContentLoaded", () => {
        refreshDashboardDataMetrics(); // Calls database first, then renders
        bindInteractiveEventEmitters();
        initializeSimulatedLiveTickerQueue();
    });

    // 4. Interface Structural Mapping Assembly Logic Orchestration Room
    function spawnApplicationInterfaceViews() {
        renderSystemsRegistryTablePanel(internalNeuralEngineRegistryDS);
        renderActiveInvestorsTablePanel(dynamicInvestorAllocationsDS);
        recomputeStatisticsKPIsBentoMatrix();
        renderRankingLeaderboardPanel();
    }

    // 5. System Components Table Mapping Render Modules Engines
    function renderSystemsRegistryTablePanel(datasetArray) {
        const tableBody = document.getElementById("nx-adv-tbody-systems-registry");
        if(!tableBody) return;

        if (datasetArray.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="9" style="text-align: center; color: var(--text-muted); padding: 2rem;">No matching structural model signatures discovered.</td></tr>`;
            return;
        }

        tableBody.innerHTML = datasetArray.map(sys => {
            let pills = '';
            if(sys.featured) pills += `<span class="nx-adv-mini-pill-node featured">Featured</span>`;
            if(sys.premium) pills += `<span class="nx-adv-mini-pill-node premium">Premium</span>`;
            if(sys.popular) pills += `<span class="nx-adv-mini-pill-node popular">Popular</span>`;

            let specStatusClass = sys.status.toLowerCase().replace(" ", "_");

            return `
                <tr id="nx-adv-row-sys-${sys.id}">
                    <td>
                        <div class="nx-adv-cell-identity-block-flex">
                            <div class="nx-adv-avatar-mock-box"><i class="bx bx-bot"></i></div>
                            <div class="nx-adv-cell-meta-combo-labels">
                                <span class="nx-adv-cell-main-title-label-bold">${sys.name}</span>
                                <div class="nx-adv-cell-sub-pills-row">${pills}</div>
                            </div>
                        </div>
                    </td>
                    <td>${sys.strategy}</td>
                    <td><span class="nx-adv-color-green-bold">+${sys.monthlyReturn}%</span></td>
                    <td><span class="nx-adv-color-blue-bold">${sys.accuracy}%</span></td>
                    <td>${sys.subscribers.toLocaleString()} Users</td>
                    <td>$${sys.totalInvestment.toLocaleString()}</td>
                    <td><span class="nx-adv-status-capsule ${sys.riskLevel.toLowerCase()}">${sys.riskLevel}</span></td>
                    <td><span class="nx-adv-status-capsule ${specStatusClass}">${sys.status}</span></td>
                    <td style="text-align: right;">
                        <div class="nx-adv-table-action-buttons-flex-row">
                            <button class="nx-adv-action-square-trigger-btn" onclick="window.nxAdvOpenSpecProfileViewerModal('${sys.id}')" title="Inspect Telemetry Profile Spec"><i class="bx bx-show-alt"></i></button>
                            <button class="nx-adv-action-square-trigger-btn" onclick="window.nxAdvOpenEditWizardFlow('${sys.id}')" title="Modify Architecture Configurations"><i class="bx bx-slider-alt"></i></button>
                            <button class="nx-adv-action-square-trigger-btn delete-variation" onclick="window.nxAdvOpenPurgeSafetyGateModal('${sys.id}')" title="Purge Node Signature"><i class="bx bx-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    function renderActiveInvestorsTablePanel(datasetArray) {
        const tableBody = document.getElementById("nx-adv-tbody-active-investors-registry");
        if(!tableBody) return;

        if (datasetArray.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="8" style="text-align: center; color: var(--text-muted); padding: 2rem;">No structural capital investment tracks matched current filters.</td></tr>`;
            return;
        }

        tableBody.innerHTML = datasetArray.map(inv => {
            let trackingStatusClass = inv.status.toLowerCase();
            return `
                <tr>
                    <td>
                        <div class="nx-adv-cell-identity-block-flex">
                            <div class="nx-adv-avatar-user-image">${inv.name.charAt(0)}</div>
                            <div class="nx-adv-cell-meta-combo-labels">
                                <span class="nx-adv-cell-main-title-label-bold">${inv.name}</span>
                                <span style="font-size: 0.72rem; color: var(--text-muted);">${inv.email}</span>
                            </div>
                        </div>
                    </td>
                    <td>${inv.botName}</td>
                    <td><strong>$${inv.amount.toLocaleString()}</strong></td>
                    <td><span class="${inv.profit >= 0 ? 'nx-adv-color-green-bold' : 'nx-adv-btn-danger'}" style="background:transparent; font-weight:600;">$${inv.profit.toLocaleString()}</span></td>
                    <td><span class="nx-adv-color-green-bold">${inv.roi}%</span></td>
                    <td><span style="font-size: 0.78rem;">${inv.startDate} <i class="bx bx-right-arrow-alt"></i> ${inv.endDate}</span></td>
                    <td><span style="font-size: 0.78rem; font-weight:600;">${inv.daysRemaining} days left</span></td>
                    <td><span class="nx-adv-status-capsule ${trackingStatusClass}">${inv.status}</span></td>
                    <td style="text-align: right;">
                        <button class="nx-adv-btn nx-adv-btn-secondary" style="padding: 0.35rem 0.65rem; font-size: 0.75rem;" onclick="window.nxAdvOpenInvestorProfileModal('${inv.userId}')">
                            <i class="bx bx-network-chart"></i> Track
                        </button>
                    </td>
                </tr>
            `;
        }).join('');
    }

    function renderRankingLeaderboardPanel() {
        const leaderboardHost = document.getElementById("nx-adv-leaderboard-host");
        if(!leaderboardHost) return;

        let ranksSorted = [...internalNeuralEngineRegistryDS]
            .sort((a,b) => b.monthlyReturn - a.monthlyReturn)
            .slice(0, 4);

        leaderboardHost.innerHTML = ranksSorted.map((sys, idx) => `
            <div class="nx-adv-leader-item-row-node">
                <span class="nx-adv-leader-rank-idx">#${idx + 1}</span>
                <div class="nx-adv-leader-meta-wrap">
                    <div class="nx-adv-leader-icon-avatar"><i class="bx bx-bolt"></i></div>
                    <span class="nx-adv-leader-title-text">${sys.name}</span>
                </div>
                <span class="nx-adv-leader-val-metric">+${sys.monthlyReturn}% Yield</span>
            </div>
        `).join('');
    }

    // 6. Stats Recalculator Dynamic Accumulator Module
    function recomputeStatisticsKPIsBentoMatrix() {
        document.getElementById("nx-v-total-bots").innerText = internalNeuralEngineRegistryDS.length;
        document.getElementById("nx-v-active-bots").innerText = internalNeuralEngineRegistryDS.filter(b => b.status === "Active").length;
        document.getElementById("nx-v-inactive-bots").innerText = internalNeuralEngineRegistryDS.filter(b => b.status === "Inactive").length;
        document.getElementById("nx-v-featured-bots").innerText = internalNeuralEngineRegistryDS.filter(b => b.featured === true).length;
        
        let subCount = internalNeuralEngineRegistryDS.reduce((acc,curr) => acc + curr.subscribers, 0);
        document.getElementById("nx-v-total-subs").innerText = subCount.toLocaleString();

        let capSum = internalNeuralEngineRegistryDS.reduce((acc,curr) => acc + curr.totalInvestment, 0);
        document.getElementById("nx-v-total-invested").innerText = `$${capSum.toLocaleString()}`;
        document.getElementById("nx-v-aum").innerText = `$${(capSum / 1000000).toFixed(2)}M`;
    }

    // 7. Interactive Unified Search Filtering Engine Matrix
    function processUnifiedGlobalSearchFiltration() {
        const filterQuery = document.getElementById("nx-adv-unified-global-search")?.value.toLowerCase().trim() || "";
        const systemStatus = document.getElementById("nx-adv-filter-system-status")?.value || "all";
        const userStatus = document.getElementById("nx-adv-filter-user-status")?.value || "all";
        const sortingMetric = document.getElementById("nx-adv-filter-sorting-metric")?.value || "newest";

        const systemRows = Array.from(document.querySelectorAll("#nx-adv-tbody-systems-registry tr"));
        const investorRows = Array.from(document.querySelectorAll("#nx-adv-tbody-active-investors-registry tr"));

        systemRows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const statusText = row.querySelector('td:nth-child(8)')?.innerText.trim().toLowerCase() || "";
            const matchesSearch = !filterQuery || rowText.includes(filterQuery);
            const matchesStatus = systemStatus === "all" || statusText === systemStatus;
            row.style.display = matchesSearch && matchesStatus ? "" : "none";
        });

        investorRows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const statusText = row.querySelector('td:nth-child(7)')?.innerText.trim().toLowerCase() || "";
            const matchesSearch = !filterQuery || rowText.includes(filterQuery);
            const matchesStatus = userStatus === "all" || statusText === userStatus;
            row.style.display = matchesSearch && matchesStatus ? "" : "none";
        });

        if (sortingMetric !== "newest") {
            const tableBody = document.getElementById("nx-adv-tbody-systems-registry");
            if (tableBody) {
                const visibleRows = Array.from(tableBody.querySelectorAll("tr"))
                    .filter(r => r.style.display !== "none");

                visibleRows.sort((a, b) => {
                    const getNumeric = (row, index) => parseFloat(row.querySelector(`td:nth-child(${index})`)?.innerText.replace(/[^0-9.\-]/g, "")) || 0;
                    if (sortingMetric === "highest-profit") {
                        return getNumeric(b, 6) - getNumeric(a, 6);
                    }
                    if (sortingMetric === "highest-roi") {
                        return getNumeric(b, 3) - getNumeric(a, 3);
                    }
                    if (sortingMetric === "most-subs") {
                        return getNumeric(b, 5) - getNumeric(a, 5);
                    }
                    return 0;
                });

                visibleRows.forEach(row => tableBody.appendChild(row));
            }
        }
    }

    // 8. Simulated Live Streaming Ticker Generation Processing Unit Loop Pipeline
    function initializeSimulatedLiveTickerQueue() {
        const hostBody = document.getElementById("nx-adv-tbody-live-stream-ticker");
        if(!hostBody) return;

        function refreshTickerCanvas() {
            let tickerMarkups = dynamicInvestorAllocationsDS.map(inv => {
                let randomTickDelta = (Math.random() * (0.85 - (-0.45)) + (-0.45)).toFixed(2);
                let deltaColor = randomTickDelta >= 0 ? "nx-adv-color-green-bold" : "nx-adv-btn-danger";
                let deltaIcon = randomTickDelta >= 0 ? "bx-trending-up" : "bx-trending-down";

                return `
                    <tr>
                        <td><span style="font-family: monospace; font-weight:600;">${inv.userId}</span></td>
                        <td><span font-weight:600;>${inv.name}</span></td>
                        <td><span style="font-size: 0.78rem; font-weight:600; color: var(--text-muted);"><i class="bx bx-code-block"></i> ${inv.botName}</span></td>
                        <td><strong>$${inv.amount.toLocaleString()}</strong></td>
                        <td><span class="nx-adv-color-green-bold">$${(inv.profit + parseFloat(randomTickDelta) * 10).toFixed(2)}</span></td>
                        <td><span class="${deltaColor}" style="background:transparent; font-weight:700;"><i class="bx ${deltaIcon}"></i> ${randomTickDelta > 0 ? '+' : ''}${randomTickDelta}%</span></td>
                        <td><span style="font-size:0.75rem; color: var(--text-muted); font-weight:500;">Just now updated</span></td>
                    </tr>
                `;
            }).join('');
            hostBody.innerHTML = tickerMarkups;
        }

        refreshTickerCanvas();

        liveTickerIntervalTimerHost = setInterval(() => {
            liveTickerRefreshCountdownVal--;
            const labelNode = document.getElementById("nx-adv-live-ticker-countdown");
            if(labelNode) labelNode.innerText = `Next Refresh: ${liveTickerRefreshCountdownVal}s`;

            if (liveTickerRefreshCountdownVal <= 0) {
                liveTickerRefreshCountdownVal = 30;
                refreshTickerCanvas();
                showNotificationToastBannerInstance("Live Stream Telemetry Channel metrics synchronized successfully.", "success");
            }
        }, 1000);
    }

    // 9. Interactive Forms Wizard Multi-Tab Switch Panels Logic Actions
    function rerouteWizardTabActiveStatePane(targetPaneId) {
        activeWizardFormStepPointer = targetPaneId;
        
        document.querySelectorAll(".nx-adv-tab-navigation-node").forEach(btn => {
            btn.classList.toggle("active", btn.getAttribute("data-target-pane") === targetPaneId);
        });
        document.querySelectorAll(".nx-adv-modal-form-tab-content-pane").forEach(pane => {
            pane.classList.toggle("active", pane.getAttribute("id") === targetPaneId);
        });

        const bBack = document.getElementById("nx-adv-btn-wizard-back");
        const bNext = document.getElementById("nx-adv-btn-wizard-next");
        const bSubmit = document.getElementById("nx-adv-btn-wizard-submit");

        if (targetPaneId === "nx-adv-pane-basic-info") {
            bBack.style.display = "none"; bNext.style.display = "block"; bSubmit.style.display = "none";
        } else if (targetPaneId === "nx-adv-pane-performance") {
            bBack.style.display = "block"; bNext.style.display = "block"; bSubmit.style.display = "none";
        } else if (targetPaneId === "nx-adv-pane-execution") {
            bBack.style.display = "block"; bNext.style.display = "none"; bSubmit.style.display = "block";
        }
    }

    // 10. Forms Actions Submission Payloads Verification Routers
    function executeFormSubmissionProcessing(e) {
        e.preventDefault();

        const targetedHashId = document.getElementById("nx-adv-form-field-bot-target-hash-id").value;
        const nameInputVal = document.getElementById("nx-adv-input-name").value.trim();
        const monthlyRoiVal = parseFloat(document.getElementById("nx-adv-input-monthly-roi").value) || 0;
        const backtestAccuracyVal = parseFloat(document.getElementById("nx-adv-input-accuracy").value) || 0;

        if (!nameInputVal) { showNotificationToastBannerInstance("Structural Identification Model Name cannot be blank.", "error"); return; }
        if (monthlyRoiVal <= 0 || backtestAccuracyVal <= 0) { showNotificationToastBannerInstance("Yield Targets or Accuracy Bounds metrics invalid.", "error"); return; }

        // Prepare form data for backend submission
        const form = document.getElementById("nx-adv-form-quantum-bot-configuration-payload");
        const formData = new FormData(form);

        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (targetedHashId) {
            // Edit Profile Processing Route - Send UPDATE request to backend
            fetch(`/admin/bots/update/${targetedHashId}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message === "Bot Updated Successfully") {
                    showNotificationToastBannerInstance(`System node '${nameInputVal}' configuration metrics updated.`, "success");
                    // Reload the page to reflect changes
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotificationToastBannerInstance(data.message || "Error updating bot", "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showNotificationToastBannerInstance("Error updating bot: " + error.message, "error");
            });
        } else {
            // New Core Insertion Initialization Route - Send CREATE request to backend
            fetch(`/admin/bots/store`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message === "Bot Created Successfully") {
                    showNotificationToastBannerInstance(`System Core Model '${nameInputVal}' initialized and loaded into cluster registries.`, "success");
                    document.getElementById("nx-adv-modal-system-creation-wizard").classList.remove("active-frame-node");
                    // Reload the page to reflect new bot
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotificationToastBannerInstance(data.message || "Error creating bot", "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showNotificationToastBannerInstance("Error creating bot: " + error.message, "error");
            });
        }
    }

    // 11. Purge Node Deletion Engine Task Processors
    function authorizeTargetNodePurgeExecution() {
        if (!targetPurgeSystemNodeHashId) return;

        internalNeuralEngineRegistryDS = internalNeuralEngineRegistryDS.filter(b => b.id !== targetPurgeSystemNodeHashId);
        showNotificationToastBannerInstance(`Model signature hash target reference node '${targetPurgeSystemNodeHashId}' dropped.`, "error");
        
        document.getElementById("nx-adv-modal-safety-gate-deletion").classList.remove("active-frame-node");
        targetPurgeSystemNodeHashId = null;
        
        spawnApplicationInterfaceViews();
    }

    // 12. Global Events Listeners Command Declarations Hookups
    function bindInteractiveEventEmitters() {
        // Dropdown Toggle Event Emitters
        const exportTrigger = document.getElementById("nx-adv-export-trigger");
        if(exportTrigger) {
            exportTrigger.addEventListener("click", (e) => {
                e.stopPropagation();
                document.getElementById("nx-adv-export-menu").classList.toggle("active-dropdown");
            });
        }
        document.addEventListener("click", () => {
            const menu = document.getElementById("nx-adv-export-menu");
            if(menu) menu.classList.remove("active-dropdown");
        });

        // Search Processing Listeners
        document.getElementById("nx-adv-unified-global-search").addEventListener("keyup", processUnifiedGlobalSearchFiltration);
        document.getElementById("nx-adv-filter-system-status").addEventListener("change", processUnifiedGlobalSearchFiltration);
        document.getElementById("nx-adv-filter-user-status").addEventListener("change", processUnifiedGlobalSearchFiltration);
        document.getElementById("nx-adv-filter-sorting-metric").addEventListener("change", processUnifiedGlobalSearchFiltration);

        // Core Window Trigger Framework Nodes Hookups
        document.getElementById("nx-adv-open-create-modal").addEventListener("click", () => {
            document.getElementById("nx-adv-form-quantum-bot-configuration-payload").reset();
            document.getElementById("nx-adv-form-field-bot-target-hash-id").value = "";
            document.getElementById("nx-adv-wizard-panel-main-title-label").innerText = "Initialize Quantum Algorithm Node";
            rerouteWizardTabActiveStatePane("nx-adv-pane-basic-info");
            document.getElementById("nx-adv-modal-system-creation-wizard").classList.add("active-frame-node");
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', async () => {
                const botId = btn.dataset.id;
                if (!botId) return;

                try {
                    const response = await fetch(`/admin/bots/edit/${botId}`);
                    if (!response.ok) throw new Error('Unable to fetch bot data');
                    const bot = await response.json();

                    document.getElementById("nx-adv-form-quantum-bot-configuration-payload").reset();
                    document.getElementById("nx-adv-form-field-bot-target-hash-id").value = bot.id;
                    document.getElementById("nx-adv-input-name").value = bot.bot_name || "";
                    document.getElementById("nx-adv-input-strategy").value = bot.strategy_type || "Scalping";
                    document.getElementById("nx-adv-input-trading-style").value = bot.trading_style || "Forex";
                    document.getElementById("nx-adv-input-description").value = bot.description || "";
                    document.getElementById("nx-adv-input-risk").value = bot.risk_level || "Low";
                    document.getElementById("nx-adv-input-status").value = bot.status || "Active";
                    document.getElementById("nx-adv-input-monthly-roi").value = bot.monthly_return ?? "";
                    document.getElementById("nx-adv-input-annual-roi").value = bot.annual_return ?? "";
                    document.getElementById("nx-adv-input-accuracy").value = bot.accuracy_rate ?? "";
                    document.getElementById("nx-adv-input-drawdown").value = bot.drawdown ?? "";
                    document.getElementById("nx-adv-input-min-inv").value = bot.minimum_investment ?? "";
                    document.getElementById("nx-adv-input-max-inv").value = bot.maximum_investment ?? "";
                    document.getElementById("nx-adv-check-featured").checked = bot.featured == 1;
                    document.getElementById("nx-adv-check-premium").checked = bot.premium == 1;
                    document.getElementById("nx-adv-check-popular").checked = bot.popular == 1;

                    document.getElementById("nx-adv-wizard-panel-main-title-label").innerText = "Edit Quantum Algorithm Node";
                    rerouteWizardTabActiveStatePane("nx-adv-pane-basic-info");
                    document.getElementById("nx-adv-modal-system-creation-wizard").classList.add("active-frame-node");
                } catch (error) {
                    console.error('Edit bot failed:', error);
                    showNotificationToastBannerInstance('Unable to load bot details for editing.', 'error');
                }
            });
        });

        document.getElementById("nx-adv-btn-close-wizard-modal").addEventListener("click", () => {
            document.getElementById("nx-adv-modal-system-creation-wizard").classList.remove("active-frame-node");
        });
        document.getElementById("nx-adv-btn-wizard-cancel").addEventListener("click", () => {
            document.getElementById("nx-adv-modal-system-creation-wizard").classList.remove("active-frame-node");
        });
        document.getElementById("nx-adv-btn-cancel-purge-action").addEventListener("click", () => {
            document.getElementById("nx-adv-modal-safety-gate-deletion").classList.remove("active-frame-node");
        });

        // Tab Strip Buttons Ingestion Click Iterators loops
        document.querySelectorAll(".nx-adv-tab-navigation-node").forEach(btn => {
            btn.addEventListener("click", (e) => {
                rerouteWizardTabActiveStatePane(e.target.getAttribute("data-target-pane"));
            });
        });

        // Form Wizard Multi-Step Navigation Controls Mapping Action Commands
        document.getElementById("nx-adv-btn-wizard-next").addEventListener("click", () => {
            if(activeWizardFormStepPointer === "nx-adv-pane-basic-info") rerouteWizardTabActiveStatePane("nx-adv-pane-performance");
            else if(activeWizardFormStepPointer === "nx-adv-pane-performance") rerouteWizardTabActiveStatePane("nx-adv-pane-execution");
        });
        document.getElementById("nx-adv-btn-wizard-back").addEventListener("click", () => {
            if(activeWizardFormStepPointer === "nx-adv-pane-execution") rerouteWizardTabActiveStatePane("nx-adv-pane-performance");
            else if(activeWizardFormStepPointer === "nx-adv-pane-performance") rerouteWizardTabActiveStatePane("nx-adv-pane-basic-info");
        });

        // Form Submissions Hook Event Wire Ups
        document.getElementById("nx-adv-form-quantum-bot-configuration-payload").addEventListener("submit", executeFormSubmissionProcessing);
        document.getElementById("nx-adv-btn-confirm-purge-action").addEventListener("click", authorizeTargetNodePurgeExecution);
    }

    // 13. High Fidelity Global Toast Notification Alert Engine Hub Component
    function showNotificationToastBannerInstance(messageContentText, typeStyleString = "success") {
        const rootHost = document.getElementById("nx-adv-toast-notifications-host-root");
        if(!rootHost) return;

        const cardNode = document.createElement("div");
        cardNode.className = `nx-adv-toast-alert-card-node ${typeStyleString}-variant-node`;
        
        let graphicVectorIconGlyph = (typeStyleString === "success") ? "bx-badge-check" : "bx-shield-x";
        cardNode.innerHTML = `
            <i class="bx ${graphicVectorIconGlyph}"></i>
            <span>${messageContentText}</span>
        `;

        rootHost.appendChild(cardNode);

        setTimeout(() => {
            cardNode.classList.add("nx-adv-toast-fading-out-phase");
            setTimeout(() => { cardNode.remove(); }, 300);
        }, 3500);
    }

    // 14. Global API Interface Scope Bridging Mechanisms for Dynamic Inline Operations Bindings
    window.nxAdvOpenSpecProfileViewerModal = function(systemId) {
        const targetObj = internalNeuralEngineRegistryDS.find(b => b.id === systemId);
        if(!targetObj) return;

        const hostCanvas = document.getElementById("nx-adv-profile-viewer-render-canvas-host");
        hostCanvas.innerHTML = `
            <div class="nx-adv-profile-sheet-identity-hero-box-wrap">
                <div class="nx-adv-profile-sheet-avatar-icon"><i class="bx bx-file-find"></i></div>
                <div class="nx-adv-profile-sheet-headings">
                    <h4>${targetObj.name}</h4>
                    <p>System Hash Tracking Code Signature: <strong>${targetObj.id}</strong></p>
                </div>
            </div>
            <p class="nx-adv-profile-sheet-description-card">${targetObj.description}</p>
            <div class="nx-adv-profile-sheet-metrics-matrix-bento-grid">
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Strategy Class Mapping</span><strong>${targetObj.strategy}</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Targeted Monthly ROI</span><strong style="color:#10b981;">+${targetObj.monthlyReturn}%</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Annualized Yield Target</span><strong style="color:#10b981;">+${targetObj.annualReturn}%</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Calculated Accuracy Rating</span><strong style="color:var(--secondary-color);">${targetObj.accuracy}%</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Max Peak Drawdown Bound</span><strong style="color:#ef4444;">${targetObj.drawdown}%</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Total User Subscribers</span><strong>${targetObj.subscribers.toLocaleString()} Accounts</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Operational Risk Parameter</span><strong>${targetObj.riskLevel} Risk</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Current Asset Allocations</span><strong>$${targetObj.totalInvestment.toLocaleString()}</strong></div>
            </div>
        `;
        
        document.getElementById("nx-adv-modal-telemetry-specifications-profile").classList.add("active-frame-node");
        
        document.getElementById("nx-adv-btn-close-profile-viewer-modal").onclick = function() {
            document.getElementById("nx-adv-modal-telemetry-specifications-profile").classList.remove("active-frame-node");
        };
    };

    window.nxAdvOpenEditWizardFlow = function(systemId) {
        const targetObj = internalNeuralEngineRegistryDS.find(b => b.id === systemId);
        if(!targetObj) return;

        document.getElementById("nx-adv-form-field-bot-target-hash-id").value = targetObj.id;
        document.getElementById("nx-adv-wizard-panel-main-title-label").innerText = `Edit Model Profile Parameters: ${targetObj.id}`;
        
        // Input Fields Value Preload Assignments Maps
        document.getElementById("nx-adv-input-name").value = targetObj.name;
        document.getElementById("nx-adv-input-strategy").value = targetObj.strategy;
        document.getElementById("nx-adv-input-description").value = targetObj.description;
        document.getElementById("nx-adv-input-risk").value = targetObj.riskLevel;
        document.getElementById("nx-adv-input-status").value = targetObj.status;
        document.getElementById("nx-adv-input-monthly-roi").value = targetObj.monthlyReturn;
        document.getElementById("nx-adv-input-annual-roi").value = targetObj.annualReturn;
        document.getElementById("nx-adv-input-accuracy").value = targetObj.accuracy;
        document.getElementById("nx-adv-input-drawdown").value = targetObj.drawdown;
        
        document.getElementById("nx-adv-check-featured").checked = targetObj.featured;
        document.getElementById("nx-adv-check-premium").checked = targetObj.premium;
        document.getElementById("nx-adv-check-popular").checked = targetObj.popular;

        rerouteWizardTabActiveStatePane("nx-adv-pane-basic-info");
        document.getElementById("nx-adv-modal-system-creation-wizard").classList.add("active-frame-node");
    };

    window.nxAdvOpenPurgeSafetyGateModal = function(systemId) {
        targetPurgeSystemNodeHashId = systemId;
        document.getElementById("nx-adv-modal-safety-gate-deletion").classList.add("active-frame-node");
    };

    window.nxAdvOpenInvestorProfileModal = function(userId) {
        const targetInv = dynamicInvestorAllocationsDS.find(u => u.userId === userId);
        if(!targetInv) return;

        const hostCanvas = document.getElementById("nx-adv-investor-modal-render-canvas-host");
        hostCanvas.innerHTML = `
            <div class="nx-adv-profile-sheet-identity-hero-box-wrap">
                <div class="nx-adv-profile-sheet-avatar-icon" style="color:var(--secondary-color);"><i class="bx bx-user-pin"></i></div>
                <div class="nx-adv-profile-sheet-headings">
                    <h4>${targetInv.name} (${targetInv.username})</h4>
                    <p>Internal Registry User Reference Token ID: <strong>${targetInv.userId}</strong></p>
                </div>
            </div>
            <div class="nx-adv-profile-sheet-metrics-matrix-bento-grid">
                <div class="nx-adv-profile-sheet-metric-card-node"><span>E-Mail Contact Link</span><strong style="text-transform:none; font-size:0.75rem;">${targetInv.email}</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Country Origin</span><strong>${targetInv.country}</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Allocated Quant Bot</span><strong>${targetInv.botName}</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Principal Locked Investment</span><strong>$${targetInv.amount.toLocaleString()}</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Net Yield Realized Return</span><strong style="color:#10b981;">$${targetInv.profit.toLocaleString()}</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Calculated Yield ROI</span><strong style="color:#10b981;">+${targetInv.roi}%</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Current Account Balance</span><strong>$${targetInv.walletBalance.toLocaleString()}</strong></div>
                <div class="nx-adv-profile-sheet-metric-card-node"><span>Aggregate Platform Deposits</span><strong>$${targetInv.totalDeposits.toLocaleString()}</strong></div>
            </div>
        `;

        document.getElementById("nx-adv-modal-investor-account-profile-details").classList.add("active-frame-node");
        
        document.getElementById("nx-adv-btn-close-investor-modal").onclick = function() {
            document.getElementById("nx-adv-modal-investor-account-profile-details").classList.remove("active-frame-node");
        };
    };

    window.nxAdvEmitExport = function(formatType) {
        showNotificationToastBannerInstance(`Compiling system dataset ledger reports records into requested [.${formatType}] packaging container file structure...`, "success");
        setTimeout(() => {
            showNotificationToastBannerInstance(`Report compilation complete. System Ledger Output data file package pipeline transmitted successfully.`, "success");
        }, 1500);
    };


    /**
 * NEXUIST ADVANCED ANALYTICS GRAPHICS ENGINE
 */
document.addEventListener("DOMContentLoaded", () => {
    // 1. Core Data Matrix Feeds (Can be replaced with real API JSON responses easily)
    const engineDistributionData = [
        { name: "Alpha Extreme Engine", value: 1118655, percentage: 45, color: "var(--primary-color)" },
        { name: "Pro Macro Swing", value: 745770, percentage: 30, color: "var(--secondary-color)" },
        { name: "Quantum Intraday Multi", value: 372885, percentage: 15, color: "var(--accent-color)" },
        { name: "Others", value: 248590, percentage: 10, color: "#eab308" }
    ];

    const historicalGrowthData = [12000, 24000, 18500, 31000, 22000, 45000, 52000];
    const historicalTimelineLabels = ["WK 01", "WK 02", "WK 03", "WK 04", "WK 05", "WK 06", "WK 07"];

    // 2. Invoke Graphic Pipeline Render Cycles
    renderNexuistDonutChart(engineDistributionData);
    renderNexuistSparklineChart(historicalGrowthData, historicalTimelineLabels);
});

/**
 * COMPUTES METRIC RINGS AND ASSEMBLES THE DYNAMIC DONUT SVG
 */
function renderNexuistDonutChart(dataArray) {
    const donutContainer = document.getElementById("nx-dynamic-donut-target");
    const legendContainer = document.getElementById("nx-dynamic-donut-legend");
    const aumDisplay = document.getElementById("nx-dynamic-donut-total-aum");

    if (!donutContainer || !legendContainer) return;

    let totalAUMCalculated = 0;
    let strokeOffsetTracker = 100; // SVG circle stroke percentages track from 100 backwards

    // Prepare container string wrapper
    let svgMarkupString = `
        <svg viewBox="0 0 42 42" class="nx-adv-donut-svg-canvas" style="transform: rotate(-90deg); display: block; width: 100%; height: auto;">
            <circle cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="rgba(255, 255, 255, 0.05)" stroke-width="4.5"></circle>
    `;

    // Reset layout contents
    legendContainer.innerHTML = "";

    dataArray.forEach(item => {
        totalAUMCalculated += item.value;

        // Compile custom mathematical ring vectors
        svgMarkupString += `
            <circle cx="21" cy="21" r="15.91549430918954" 
                    fill="transparent" 
                    stroke="${item.color}" 
                    stroke-width="4.5" 
                    stroke-dasharray="${item.percentage} ${100 - item.percentage}" 
                    stroke-dashoffset="${strokeOffsetTracker}">
            </circle>
        `;
        strokeOffsetTracker -= item.percentage;

        // Build matching HTML indicator legend row dynamically
        const templateLegendRow = `
            <div class="nx-adv-legend-row-item">
                <span class="nx-adv-indicator" style="background: ${item.color};"></span> 
                <span class="nx-adv-lbl">${item.name}</span>
                <strong>${item.percentage}%</strong>
            </div>
        `;
        legendContainer.insertAdjacentHTML("beforeend", templateLegendRow);
    });

    svgMarkupString += `</svg>`;

    // Inject compiled nodes directly to view structures
    donutContainer.insertAdjacentHTML("afterbegin", svgMarkupString);
    
    // Format numeric data safely to a currency structure (e.g. $2.48M)
    if (aumDisplay) {
        aumDisplay.innerText = `$${(totalAUMCalculated / 1000000).toFixed(2)}M`;
    }
}

/**
 * SCALES VECTOR INTERPOLATIONS AND ASSEMBLES THE TREND SPARKLINE SVG
 */
function renderNexuistSparklineChart(dataSet, timelineLabels) {
    const canvasContainer = document.getElementById("nx-dynamic-sparkline-target");
    if (!canvasContainer || dataSet.length < 2) return;

    const canvasWidth = 500;
    const canvasHeight = 100;
    const offsetPadding = 15;
    const functionalGraphHeight = canvasHeight - (offsetPadding * 2);

    const maximumPeak = Math.max(...dataSet);
    const minimumFloor = Math.min(...dataSet);
    const extremeAmplitude = (maximumPeak - minimumFloor) === 0 ? 1 : (maximumPeak - minimumFloor);

    const pointCoordinatesX = [];
    const pointCoordinatesY = [];
    const absoluteItemsCount = dataSet.length;
    const proportionalStepX = canvasWidth / (absoluteItemsCount - 1);

    for (let i = 0; i < absoluteItemsCount; i++) {
        pointCoordinatesX.push(i * proportionalStepX);
        const normalScaledY = canvasHeight - offsetPadding - ((dataSet[i] - minimumFloor) / extremeAmplitude) * functionalGraphHeight;
        pointCoordinatesY.push(normalScaledY);
    }

    // Build Cubic Bezier geometric strings
    let vectorPathString = `M ${pointCoordinatesX[0]},${pointCoordinatesY[0]}`;
    for (let i = 1; i < absoluteItemsCount; i++) {
        const controlAnchorX1 = pointCoordinatesX[i - 1] + proportionalStepX / 2;
        const controlAnchorY1 = pointCoordinatesY[i - 1];
        const controlAnchorX2 = pointCoordinatesX[i - 1] + proportionalStepX / 2;
        const controlAnchorY2 = pointCoordinatesY[i];
        
        vectorPathString += ` C ${controlAnchorX1},${controlY1 = controlAnchorY1} ${controlAnchorX2},${controlY2 = controlAnchorY2} ${pointCoordinatesX[i]},${pointCoordinatesY[i]}`;
    }

    const enclosedGradientFillPath = `${vectorPathString} L ${canvasWidth},${canvasHeight} L 0,${canvasHeight} Z`;
    
    const nodePulseX = pointCoordinatesX[absoluteItemsCount - 1];
    const nodePulseY = pointCoordinatesY[absoluteItemsCount - 1];

    let footerTimelineAxisHTML = `<div class="nx-adv-sparkline-timeline-x-axis-footer-labels">`;
    timelineLabels.forEach(label => {
        footerTimelineAxisHTML += `<span>${label}</span>`;
    });
    footerTimelineAxisHTML += `</div>`;

    const masterSparklineSVGPayload = `
        <svg viewBox="0 0 ${canvasWidth} ${canvasHeight}" class="nx-adv-sparkline-svg-vector-node" style="width: 100%; height: auto; display: block;">
            <defs>
                <linearGradient id="nx-adv-sparkline-dynamic-gradient" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="var(--primary-color, #7c3aed)" stop-opacity="0.35"/>
                    <stop offset="100%" stop-color="var(--primary-color, #7c3aed)" stop-opacity="0.0"/>
                </linearGradient>
            </defs>
            <path d="${enclosedGradientFillPath}" fill="url(#nx-adv-sparkline-dynamic-gradient)"></path>
            <path d="${vectorPathString}" fill="none" stroke="var(--primary-color, #7c3aed)" stroke-width="2.5" stroke-linecap="round"></path>
            <circle cx="${nodePulseX}" cy="${nodePulseY}" r="4" fill="var(--secondary-color, #10b981)"></circle>
        </svg>
        ${footerTimelineAxisHTML}
    `;

    canvasContainer.innerHTML = masterSparklineSVGPayload;
}

})();


