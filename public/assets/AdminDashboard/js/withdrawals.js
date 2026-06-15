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

// Main Section Starts here
// =========================================================
    // NEXUIST WITHDRAWAL DATAGRID LEDGER PIPELINE ENGINE
    // =========================================================
    const wthSearchInput = document.getElementById("withdraw-search-input");
    const wthTableBody = document.querySelector("#nexuist-withdraw-table tbody");
    const wthEmptyRow = document.getElementById("withdraw-empty-row");
    const wthPaginationContainer = document.getElementById("withdraw-pagination-controls");
    const wthPaginationStatusText = document.getElementById("withdraw-pagination-status");

    const wthModalAuditWindow = document.getElementById("modal-audit-withdraw");
    const btnWthFilterToggle = document.getElementById("withdraw-btn-filter");
    const wthFilterDropdownMenu = document.getElementById("withdraw-filter-dropdown");

    const wthRowsPerPageLimit = 5;
    let wthCurrentActivePage = 1;
    let wthTargetRowScope = null;

    // Toggle Dropdown Filter Visibility State
    if (btnWthFilterToggle && wthFilterDropdownMenu) {
        btnWthFilterToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            wthFilterDropdownMenu.classList.toggle("dropdown-active");
        });
    }

    // Dismiss Dropdown On Outside Container Clicks
    document.addEventListener("click", (e) => {
        if (wthFilterDropdownMenu && !wthFilterDropdownMenu.contains(e.target) && e.target !== btnWthFilterToggle) {
            wthFilterDropdownMenu.classList.remove("dropdown-active");
        }
    });

    // --- WITHDRAWAL MODULE METRICS PAGINATION RUNNER ---
    function executeWithdrawalPagination() {
        if (!wthTableBody) return;

        const visibleRows = Array.from(wthTableBody.querySelectorAll(".nx-w-data-row")).filter(row => {
            return row.getAttribute("data-filter-hidden") !== "true";
        });

        const grossTotal = visibleRows.length;
        const pageCountMax = Math.ceil(grossTotal / wthRowsPerPageLimit) || 1;

        if (wthCurrentActivePage > pageCountMax) wthCurrentActivePage = pageCountMax;
        if (wthCurrentActivePage < 1) wthCurrentActivePage = 1;

        visibleRows.forEach((row, index) => {
            const indexMin = (wthCurrentActivePage - 1) * wthRowsPerPageLimit;
            const indexMax = indexMin + wthRowsPerPageLimit;
            row.style.display = (index >= indexMin && index < indexMax) ? "" : "none";
        });

        const boundaryStart = grossTotal === 0 ? 0 : (wthCurrentActivePage - 1) * wthRowsPerPageLimit + 1;
        const boundaryEnd = Math.min(wthCurrentActivePage * wthRowsPerPageLimit, grossTotal);
        
        if (wthPaginationStatusText) {
            wthPaginationStatusText.textContent = `Showing ${boundaryStart} to ${boundaryEnd} of ${grossTotal} Ledger Entries`;
        }

        if (wthPaginationContainer) {
            wthPaginationContainer.innerHTML = "";

            // Left Chevron Control Anchor Button
            const prevButton = document.createElement("button");
            prevButton.className = `nx-w-pag-btn ${wthCurrentActivePage === 1 ? 'disabled' : ''}`;
            prevButton.innerHTML = "<i class='bx bx-chevron-left'></i>";
            if (wthCurrentActivePage !== 1) {
                prevButton.addEventListener("click", () => { wthCurrentActivePage--; executeWithdrawalPagination(); });
            }
            wthPaginationContainer.appendChild(prevButton);

            // Numeric Pagination Buttons Dynamic Injection
            for (let i = 1; i <= pageCountMax; i++) {
                const numericButton = document.createElement("button");
                numericButton.className = `nx-w-pag-btn ${wthCurrentActivePage === i ? 'active' : ''}`;
                numericButton.textContent = i;
                numericButton.addEventListener("click", () => { wthCurrentActivePage = i; executeWithdrawalPagination(); });
                wthPaginationContainer.appendChild(numericButton);
            }

            // Right Chevron Control Anchor Button
            const nextButton = document.createElement("button");
            nextButton.className = `nx-w-pag-btn ${wthCurrentActivePage === pageCountMax ? 'disabled' : ''}`;
            nextButton.innerHTML = "<i class='bx bx-chevron-right'></i>";
            if (wthCurrentActivePage !== pageCountMax) {
                nextButton.addEventListener("click", () => { wthCurrentActivePage++; executeWithdrawalPagination(); });
            }
            wthPaginationContainer.appendChild(nextButton);
        }
    }

    // --- BIND ROW ACTION POPUP OVERLAYS ---
    function initializeWithdrawalRowEvents(rowItem) {
        const reviewTrigger = rowItem.querySelector(".withdraw-action-review");
        if (reviewTrigger && wthModalAuditWindow) {
            reviewTrigger.addEventListener("click", (e) => {
                e.stopPropagation();
                wthTargetRowScope = rowItem;

                const transId = rowItem.getAttribute("data-txid");
                const userName = rowItem.getAttribute("data-name");
                const nodeUid = rowItem.getAttribute("data-uid");
                const payMethod = rowItem.getAttribute("data-method");
                const cashAmount = rowItem.getAttribute("data-amount");
                const destination = rowItem.getAttribute("data-destination");
                const currentStatus = rowItem.getAttribute("data-status");

                // Populate Target Data Fields Inside the Modal Window
                document.getElementById("m-withdraw-txid").textContent = transId;
                document.getElementById("m-withdraw-user").textContent = userName;
                document.getElementById("m-withdraw-meta").textContent = `Account Profile: ${nodeUid}`;
                document.getElementById("m-withdraw-method").textContent = payMethod;
                document.getElementById("m-withdraw-amount").textContent = `$${parseFloat(cashAmount).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                document.getElementById("m-withdraw-destination").textContent = destination;

                const modalActionsArea = document.getElementById("withdraw-workflow-actions");
                const modalStaticNotice = document.getElementById("withdraw-status-locked-notice");

                if (currentStatus.toLowerCase() === "pending") {
                    if (modalActionsArea) modalActionsArea.style.display = "flex";
                    if (modalStaticNotice) modalStaticNotice.style.display = "none";
                } else {
                    if (modalActionsArea) modalActionsArea.style.display = "none";
                    if (modalStaticNotice) {
                        modalStaticNotice.style.display = "block";
                        modalStaticNotice.innerHTML = `This withdrawal allocation path has been processed and flagged as <strong>${currentStatus}</strong>.`;
                    }
                }

                wthModalAuditWindow.classList.add("modal-active");
            });
        }
    }

    // Initialize existing document rows on initial execution sequence
    if (wthTableBody) {
        wthTableBody.querySelectorAll(".nx-w-data-row").forEach(row => initializeWithdrawalRowEvents(row));
    }

    // --- WITHDRAWAL SETTLE OPERATION DISPATCH TRIGGER CLICKS ---
    const btnWthConfirmApprove = document.getElementById("btn-withdraw-approve");
    const btnWthConfirmReject = document.getElementById("btn-withdraw-reject");

    if (btnWthConfirmApprove) {
        btnWthConfirmApprove.addEventListener("click", () => {
            if (wthTargetRowScope) {
                wthTargetRowScope.setAttribute("data-status", "Approved");
                const visualBadge = wthTargetRowScope.querySelector(".nx-w-status");
                if (visualBadge) {
                    visualBadge.className = "nx-w-status status-w-approved";
                    visualBadge.innerHTML = "<i class='bx bx-check-circle'></i> Approved";
                }
                wthModalAuditWindow.classList.remove("modal-active");
            }
        });
    }

    if (btnWthConfirmReject) {
        btnWthConfirmReject.addEventListener("click", () => {
            if (wthTargetRowScope) {
                wthTargetRowScope.setAttribute("data-status", "Rejected");
                const visualBadge = wthTargetRowScope.querySelector(".nx-w-status");
                if (visualBadge) {
                    visualBadge.className = "nx-w-status status-w-rejected";
                    visualBadge.innerHTML = "<i class='bx bx-x-circle'></i> Rejected";
                }
                wthModalAuditWindow.classList.remove("modal-active");
            }
        });
    }

    // Bind Close Actions
    const modalCloseTriggerBtn = document.querySelector(".nx-w-modal-close");
    if (modalCloseTriggerBtn && wthModalAuditWindow) {
        modalCloseTriggerBtn.addEventListener("click", () => {
            wthModalAuditWindow.classList.remove("modal-active");
        });
    }

    // --- LIVE LOOKUP QUERY PARAMETER FILTERS ---
    const wthStatusSelectField = document.getElementById("filter-withdraw-status");
    const wthMethodSelectField = document.getElementById("filter-withdraw-method");
    const btnResetWthFilters = document.getElementById("btn-reset-withdraw-filters");

    function executeWithdrawalLiveSearch() {
        if (!wthTableBody) return;

        const searchVal = wthSearchInput ? wthSearchInput.value.toLowerCase().trim() : "";
        const selectedStatus = wthStatusSelectField ? wthStatusSelectField.value.toLowerCase() : "all";
        const selectedMethod = wthMethodSelectField ? wthMethodSelectField.value.toLowerCase() : "all";

        const executionRows = wthTableBody.querySelectorAll(".nx-w-data-row");
        let validMatchCounter = 0;

        executionRows.forEach(row => {
            const dataTextPool = row.textContent.toLowerCase();
            const stateAttr = row.getAttribute("data-status").toLowerCase();
            const gateAttr = row.getAttribute("data-method").toLowerCase();

            const matchSearch = dataTextPool.includes(searchVal);
            const matchStatus = (selectedStatus === "all") || (stateAttr === selectedStatus);
            const matchMethod = (selectedMethod === "all") || (gateAttr === selectedMethod);

            if (matchSearch && matchStatus && matchMethod) {
                row.removeAttribute("data-filter-hidden");
                validMatchCounter++;
            } else {
                row.setAttribute("data-filter-hidden", "true");
                row.style.display = "none";
            }
        });

        if (wthEmptyRow) wthEmptyRow.style.display = (validMatchCounter === 0) ? "" : "none";
        wthCurrentActivePage = 1;
        executeWithdrawalPagination();
    }

    if (wthSearchInput) wthSearchInput.addEventListener("input", executeWithdrawalLiveSearch);
    if (wthStatusSelectField) wthStatusSelectField.addEventListener("change", executeWithdrawalLiveSearch);
    if (wthMethodSelectField) wthMethodSelectField.addEventListener("change", executeWithdrawalLiveSearch);

    if (btnResetWthFilters) {
        btnResetWthFilters.addEventListener("click", () => {
            if (wthStatusSelectField) wthStatusSelectField.value = "all";
            if (wthMethodSelectField) wthMethodSelectField.value = "all";
            if (wthSearchInput) wthSearchInput.value = "";
            executeWithdrawalLiveSearch();
        });
    }

    // Fire up pagination on load initialization sequence
    executeWithdrawalPagination();