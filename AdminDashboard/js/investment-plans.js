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
    // NEXUIST YIELD ENGINE INTERACTION ARCHITECTURE LOGIC
    // =========================================================
    const invTabButtons = document.querySelectorAll(".nx-inv-tab-btn");
    const invPanelViews = document.querySelectorAll(".nx-inv-panel-view");

    const calcTierSelect = document.getElementById("calc-tier-select");
    const calcAmountSlider = document.getElementById("calc-amount-slider");
    const calcAmountValueText = document.getElementById("calc-amount-value");
    
    const projTotalPayout = document.getElementById("proj-total-payout");
    const projPrincipal = document.getElementById("proj-principal");
    const projYield = document.getElementById("proj-yield");

    const modalInvestWindow = document.getElementById("modal-invest-deployment");
    const modalCloseTriggerBtn = document.querySelector(".nx-inv-modal-close-btn");
    const tierInvestmentTriggers = document.querySelectorAll(".trigger-investment-modal");

    // --- INTERACTIVE SYSTEM TAB DISPLAY ENGINE SHIFTERS ---
    if (invTabButtons.length > 0) {
        invTabButtons.forEach(button => {
            button.addEventListener("click", () => {
                invTabButtons.forEach(btn => btn.classList.remove("active"));
                invPanelViews.forEach(view => view.classList.remove("active"));

                button.classList.add("active");
                const assignedTargetId = `${button.getAttribute("data-target")}-panel`;
                const targetViewNode = document.getElementById(assignedTargetId);
                if (targetViewNode) targetViewNode.classList.add("active");
            });
        });
    }

    // --- CORE MATH RETURN PROJECTION ENGINE ---
    function recomputeYieldProjectionMatrix() {
        if (!calcTierSelect || !calcAmountSlider) return;

        const baseRoiPercentage = parseFloat(calcTierSelect.value);
        const deploymentPrincipal = parseFloat(calcAmountSlider.value);
        
        // Find active checked term runtime duration
        const activeDurationNode = document.querySelector("input[name='calc-duration']:checked");
        const termWeeksDuration = activeDurationNode ? parseInt(activeDurationNode.value) : 4;

        // Feedback structural UI content modifiers
        if (calcAmountValueText) {
            calcAmountValueText.textContent = `$${deploymentPrincipal.toLocaleString()}`;
        }

        // Linear return payout compounding calculations formulas 
        const computedYieldReturn = deploymentPrincipal * (baseRoiPercentage / 100) * termWeeksDuration;
        const totalGrossMaturityBalance = deploymentPrincipal + computedYieldReturn;

        // Render parameters values safely out to viewing grids
        if (projPrincipal) projPrincipal.textContent = `$${deploymentPrincipal.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        if (projYield) projYield.textContent = `+$${computedYieldReturn.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        if (projTotalPayout) projTotalPayout.textContent = `$${totalGrossMaturityBalance.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    }

    // Attach immediate reactive listeners loops across options anchors
    if (calcAmountSlider) calcAmountSlider.addEventListener("input", recomputeYieldProjectionMatrix);
    if (calcTierSelect) calcTierSelect.addEventListener("change", recomputeYieldProjectionMatrix);
    
    document.querySelectorAll("input[name='calc-duration']").forEach(radio => {
        radio.addEventListener("change", recomputeYieldProjectionMatrix);
    });

    // --- MODAL DEPLOYMENT INPUT CONFIGURATOR CONTRACTS ---
    if (tierInvestmentTriggers.length > 0 && modalInvestWindow) {
        tierInvestmentTriggers.forEach(trigger => {
            trigger.addEventListener("click", () => {
                const parentTierCard = trigger.closest(".nx-inv-tier-card");
                if (!parentTierCard) return;

                const tierName = parentTierCard.getAttribute("data-tier");
                const tierRoi = parentTierCard.getAttribute("data-roi");
                const rangeMin = parentTierCard.getAttribute("data-min");
                const rangeMax = parentTierCard.getAttribute("data-max");

                // Inject targeted fields assets to modal layers markup
                document.getElementById("m-inv-tier-title").textContent = `${tierName} Asset Tier`;
                document.getElementById("m-inv-tier-roi").textContent = `${tierRoi}% / Weekly Return`;
                
                const amountInputBox = document.getElementById("inv-input-amount");
                if (amountInputBox) {
                    amountInputBox.min = rangeMin;
                    amountInputBox.max = rangeMax;
                    amountInputBox.value = rangeMin; // Fast track fill tracking setups
                }

                const limitHintTag = document.getElementById("m-inv-limit-hint");
                if (limitHintTag) {
                    limitHintTag.textContent = `Allowed entry range: $${parseFloat(rangeMin).toLocaleString()} - $${parseFloat(rangeMax).toLocaleString()}`;
                }

                modalInvestWindow.classList.add("modal-active");
            });
        });
    }

    if (modalCloseTriggerBtn && modalInvestWindow) {
        modalCloseTriggerBtn.addEventListener("click", () => {
            modalInvestWindow.classList.remove("modal-active");
        });
    }

    // Close on outside framework mask overlay backdrop trigger clicks
    if (modalInvestWindow) {
        modalInvestWindow.addEventListener("click", (e) => {
            if (e.target === modalInvestWindow) modalInvestWindow.classList.remove("modal-active");
        });
    }

    // --- FORM DEPLOYMENT PROCESS VALIDATION DISPATCH CONTROLS ---
    const investmentFormElement = document.getElementById("nexuist-investment-execution-form");
    if (investmentFormElement) {
        investmentFormElement.addEventListener("submit", (e) => {
            e.preventDefault();
            
            const allocationValue = parseFloat(document.getElementById("inv-input-amount").value);
            const userBalance = parseFloat(document.getElementById("user-current-wallet-balance").textContent.replace(/[^0-9.-]+/g, ""));

            if (allocationValue > userBalance) {
                alert("Transaction Execution Failure: Allocation requested exceeds present available liquidity balances.");
                return;
            }

            alert(`Capital Asset Allocation Successful! Liquid reserves have committed to your designated Tier Strategy execution.`);
            modalInvestWindow.classList.remove("modal-active");
            investmentFormElement.reset();
        });
    }

    // Trigger calculation updates immediately on sequence loader loops
    recomputeYieldProjectionMatrix();