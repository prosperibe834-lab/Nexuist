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
    // NEXUIST COPY TRADING PROTOCOL INTERACTION AUTOMATION LOGIC
    // =========================================================
    const ctSearchBoxInput = document.getElementById("trader-search-input");
    const ctFilterTabButtons = document.querySelectorAll(".nx-ct-tab-btn");
    const ctMasterTraderCards = document.querySelectorAll(".nx-ct-trader-card");
    const ctLivePositionsFeed = document.getElementById("live-positions-feed");

    const modalCopyWindow = document.getElementById("modal-copy-execution");
    const modalCloseTriggerBtn = document.querySelector(".nx-ct-modal-close-btn");
    const openCopyModalButtons = document.querySelectorAll(".trigger-copy-modal");

    const modalAllocationSlider = document.getElementById("modal-allocation-slider");
    const modalAllocationFeedback = document.getElementById("modal-allocation-feedback");
    const routingExecutionForm = document.getElementById("nexuist-copy-routing-form");

    // --- LIVE SEARCH AND RISKS PARAMETER FILTER ENGINE ---
    function filterMasterTradersMatrix() {
        const structuralQuery = ctSearchBoxInput ? ctSearchBoxInput.value.toLowerCase().trim() : "";
        const activeTabFilter = document.querySelector(".nx-ct-tab-btn.active").getAttribute("data-filter");

        ctMasterTraderCards.forEach(card => {
            const masterRiskProfile = card.getAttribute("data-risk");
            const masterName = card.getAttribute("data-name").toLowerCase();
            
            const matchSearch = masterName.includes(structuralQuery);
            const matchFilter = (activeTabFilter === "all" || masterRiskProfile === activeTabFilter);

            if (matchSearch && matchFilter) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    }

    if (ctSearchBoxInput) {
        ctSearchBoxInput.addEventListener("input", filterMasterTradersMatrix);
    }

    if (ctFilterTabButtons.length > 0) {
        ctFilterTabButtons.forEach(button => {
            button.addEventListener("click", () => {
                ctFilterTabButtons.forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");
                filterMasterTradersMatrix();
            });
        });
    }

    // --- LIVE MIRROR ORDER REPLICATION SIMULATOR ---
    const simulatedOrdersPool = [
        { master: "@apex-algo", action: "opened BUY ETH/USDT", result: "Replicated", type: "sync" },
        { master: "@eth-whale", action: "closed BUY BTC/USDT", result: "+$890.10", type: "profit" },
        { master: "@delta-neutral", action: "opened SELL SOL/USDT", result: "Replicated", type: "sync" },
        { master: "@apex-algo", action: "closed SELL LINK/USDT", result: "+$124.00", type: "profit" }
    ];

    setInterval(() => {
        if (!ctLivePositionsFeed) return;

        const dateObject = new Date();
        const timestamp = dateObject.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        const pickRandomOrder = simulatedOrdersPool[Math.floor(Math.random() * simulatedOrdersPool.length)];

        const outputRow = document.createElement("div");
        outputRow.className = "terminal-log-row position-entry-animation";

        const tagClass = pickRandomOrder.type === "profit" ? "log-tag-green" : "log-tag-muted";

        outputRow.innerHTML = `
            <span class="log-timestamp">${timestamp}</span>
            <div class="log-body">
                <strong>${pickRandomOrder.master}</strong> ${pickRandomOrder.action}
                <span class="${tagClass}">${pickRandomOrder.result}</span>
            </div>
        `;

        ctLivePositionsFeed.insertBefore(outputRow, ctLivePositionsFeed.firstChild);

        // Cap log rows count inside the stream layout block to avoid memory leaks
        if (ctLivePositionsFeed.children.length > 15) {
            ctLivePositionsFeed.removeChild(ctLivePositionsFeed.lastChild);
        }
    }, 7000); // Poll fresh mirror events sequentially every 7 seconds

    // --- ALLOCATION PARAMETERS INTERACTIVE MODAL OVERLAY ---
    if (openCopyModalButtons.length > 0 && modalCopyWindow) {
        openCopyModalButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                const masterName = btn.getAttribute("data-master");
                const masterRoi = btn.getAttribute("data-roi");
                const masterRisk = btn.getAttribute("data-risk");

                document.getElementById("modal-trader-name").textContent = masterName;
                document.getElementById("modal-trader-roi").textContent = `+${masterRoi}%`;
                
                const riskPillNode = document.getElementById("modal-trader-risk");
                riskPillNode.textContent = masterRisk;
                riskPillNode.className = `badge-pill ${masterRisk.includes("Low") ? "label-low" : "label-high"}`;

                modalCopyWindow.classList.add("modal-active");
            });
        });
    }

    if (modalCloseTriggerBtn && modalCopyWindow) {
        modalCloseTriggerBtn.addEventListener("click", () => {
            modalCopyWindow.classList.remove("modal-active");
        });
    }

    if (modalCopyWindow) {
        modalCopyWindow.addEventListener("click", (e) => {
            if (e.target === modalCopyWindow) modalCopyWindow.classList.remove("modal-active");
        });
    }

    // Interactive slider text output formatter link
    if (modalAllocationSlider && modalAllocationFeedback) {
        modalAllocationSlider.addEventListener("input", () => {
            const numericValue = parseInt(modalAllocationSlider.value);
            modalAllocationFeedback.textContent = `$${numericValue.toLocaleString()}`;
        });
    }

    // --- FORM SUBSCRIPTION DISPATCH PROCESSOR ---
    if (routingExecutionForm) {
        routingExecutionForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const inputCapital = parseFloat(modalAllocationSlider.value);
            const userLiquidity = parseFloat(document.getElementById("ct-user-liquidity-pool").textContent.replace(/[^0-9.-]+/g, ""));

            if (inputCapital > userLiquidity) {
                alert("Syndication Aborted: Requested allocation value exceeds available wallet pool balance reserves.");
                return;
            }

            alert(`Mirror Protocol Initialized successfully! Trades executed by your target master pipeline are now synchronized to your allocation.`);
            modalCopyWindow.classList.remove("modal-active");
        });
    }