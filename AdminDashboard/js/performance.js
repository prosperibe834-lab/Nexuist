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
document.addEventListener("DOMContentLoaded", () => {

    // =========================================================
    // NEXUIST PERFORMANCE ANALYTICS CHART INITIALIZATION ENGINE
    // =========================================================
    const performanceCtxNode = document.getElementById('nexuistPerformanceChart');
    const performancePeriodButtons = document.querySelectorAll('.nx-ph-tab-btn');
    
    if (!performanceCtxNode) return; // Exit gracefully if node is absent from the immediate view

    // Extract real-time computed styling variables directly from your root design tokens
    const rootStyleStyles = getComputedStyle(document.documentElement);
    const brandPrimary = rootStyleStyles.getPropertyValue('--primary-color').trim() || '#6c63ff';
    const brandSecondary = rootStyleStyles.getPropertyValue('--secondary-color').trim() || '#00d4ff';
    const textMutedColor = rootStyleStyles.getPropertyValue('--text-muted').trim() || '#64748b';
    const gridBorderTheme = rootStyleStyles.getPropertyValue('--border-color').trim() || 'rgba(255,255,255,0.08)';

    // Multi-dimensional data matrix for periods adjustments
    const analyticsDataPool = {
        "7d": {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            equityData: [12000, 12400, 12250, 12900, 13100, 13050, 13500],
            pnlData: [400, 400, -150, 650, 200, -50, 450],
            roi: "+12.50%", winrate: "85.7%", factor: "3.10",
            ledger: `
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">BTC/USDT</strong><span class="nx-ph-subtext-meta">Bitcoin Core Mirror</span></div></td><td>50.0%</td><td><span class="nx-ph-pnl-status pnl-up">+$1,100.00</span></td></tr>
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">ETH/USDT</strong><span class="nx-ph-subtext-meta">Ether Scalper Syndication</span></div></td><td>30.0%</td><td><span class="nx-ph-pnl-status pnl-up">+$550.00</span></td></tr>
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">SOL/USDT</strong><span class="nx-ph-subtext-meta">Delta Neutral Volatility</span></div></td><td>20.0%</td><td><span class="nx-ph-pnl-status pnl-down">-$150.00</span></td></tr>
            `
        },
        "30d": {
            labels: ['Wk 1', 'Wk 2', 'Wk 3', 'Wk 4'],
            equityData: [10000, 11400, 12800, 13500],
            pnlData: [1400, 1400, 1400, 700],
            roi: "+34.82%", winrate: "78.4%", factor: "2.41",
            ledger: `
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">BTC/USDT</strong><span class="nx-ph-subtext-meta">Bitcoin Core Mirror</span></div></td><td>45.0%</td><td><span class="nx-ph-pnl-status pnl-up">+$2,840.00</span></td></tr>
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">ETH/USDT</strong><span class="nx-ph-subtext-meta">Ether Scalper Syndication</span></div></td><td>35.0%</td><td><span class="nx-ph-pnl-status pnl-up">+$1,580.30</span></td></tr>
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">SOL/USDT</strong><span class="nx-ph-subtext-meta">Delta Neutral Volatility</span></div></td><td>20.0%</td><td><span class="nx-ph-pnl-status pnl-down">-$209.80</span></td></tr>
            `
        },
        "all": {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            equityData: [5000, 8500, 11200, 13500],
            pnlData: [3500, 2700, 2700, 2300],
            roi: "+170.00%", winrate: "74.1%", factor: "1.98",
            ledger: `
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">BTC/USDT</strong><span class="nx-ph-subtext-meta">Bitcoin Core Mirror</span></div></td><td>40.0%</td><td><span class="nx-ph-pnl-status pnl-up">+$4,900.00</span></td></tr>
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">ETH/USDT</strong><span class="nx-ph-subtext-meta">Ether Scalper Syndication</span></div></td><td>40.0%</td><td><span class="nx-ph-pnl-status pnl-up">+$3,200.00</span></td></tr>
                <tr class="nx-ph-row"><td><div class="nx-ph-asset-cell"><strong class="nx-ph-asset-ticker">SOL/USDT</strong><span class="nx-ph-subtext-meta">Delta Neutral Volatility</span></div></td><td>20.0%</td><td><span class="nx-ph-pnl-status pnl-up">+$400.00</span></td></tr>
            `
        }
    };

    // Instantiate premium high-fidelity Chart.js dual-axis visualization template
    let performanceChartInstance = new Chart(performanceCtxNode, {
        type: 'line',
        data: {
            labels: analyticsDataPool["30d"].labels,
            datasets: [
                {
                    label: 'Account Valuation (Line)',
                    data: analyticsDataPool["30d"].equityData,
                    borderColor: brandSecondary,
                    borderWidth: 3,
                    pointBackgroundColor: brandSecondary,
                    pointHoverRadius: 6,
                    tension: 0.35,
                    yAxisID: 'y'
                },
                {
                    label: 'Net Returns Periodic (Bar)',
                    type: 'bar',
                    data: analyticsDataPool["30d"].pnlData,
                    backgroundColor: 'rgba(108, 99, 255, 0.25)',
                    hoverBackgroundColor: brandPrimary,
                    borderRadius: 5,
                    barThickness: 'flex',
                    maxBarThickness: 30,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false } // Custom minimal interface aesthetics
            },
            scales: {
                x: {
                    grid: { color: gridBorderTheme },
                    ticks: { color: textMutedColor, font: { family: 'Inter' } }
                },
                y: {
                    type: 'linear',
                    position: 'left',
                    grid: { color: gridBorderTheme },
                    ticks: { color: textMutedColor, callback: value => '$' + value.toLocaleString() }
                },
                y1: {
                    type: 'linear',
                    position: 'right',
                    grid: { drawOnChartArea: false }, // Avoid duplicate inner lines clashing
                    ticks: { color: textMutedColor, callback: value => '$' + value.toLocaleString() }
                }
            }
        }
    });

    // --- TIMELINE PERIODIC TOOGLE DISPATCH ROUTINES ---
    performancePeriodButtons.forEach(button => {
        button.addEventListener('click', () => {
            performancePeriodButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const selectedPeriodKey = button.getAttribute('data-period');
            const patchData = analyticsDataPool[selectedPeriodKey];

            if (patchData) {
                // Instantly update upper DOM metrics texts
                document.getElementById('ph-kpi-roi').textContent = patchData.roi;
                document.getElementById('ph-kpi-winrate').textContent = patchData.winrate;
                document.getElementById('ph-kpi-factor').textContent = patchData.factor;

                // Re-render asset composition grid records rows
                document.getElementById('performance-history-ledger-body').innerHTML = patchData.ledger;

                // Dynamically mutate chart values and execute system render ticks
                performanceChartInstance.data.labels = patchData.labels;
                performanceChartInstance.data.datasets[0].data = patchData.equityData;
                performanceChartInstance.data.datasets[1].data = patchData.pnlData;
                performanceChartInstance.update();
            }
        });
    });
});