// Preloader starts here

// =========================================================
// HIGH-FIDELITY AUTOMATED PRELOADER ENGINE
// =========================================================
(function () {
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

        anchor.addEventListener("click", function (e) {
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
// NEXUIST DATAGRID LEDGER PROCESSING CORE ENGINE
// =========================================================
const depSearchInput = document.getElementById("deposit-search-input");
const depTableBody = document.querySelector("#nexuist-deposit-table tbody");
const depEmptyRow = document.getElementById("deposit-empty-row");
const depPaginationContainer = document.getElementById("deposit-pagination-controls");
const depPaginationStatusText = document.getElementById("deposit-pagination-status");

const modalAuditWindow = document.getElementById("modal-audit-deposit");
const btnDepFilterToggle = document.getElementById("deposit-btn-filter");
const depFilterDropdownMenu = document.getElementById("deposit-filter-dropdown");

const depRowsPerPageLimit = 5;
let depCurrentActivePage = 1;
let targetRowActiveScope = null;

// Toggle Dropdown Panel Visibility State
if (btnDepFilterToggle && depFilterDropdownMenu) {
    btnDepFilterToggle.addEventListener("click", (e) => {
        e.stopPropagation();
        depFilterDropdownMenu.classList.toggle("dropdown-active");
    });
}

// Click Away Dismissal Loop Configuration
document.addEventListener("click", (e) => {
    if (depFilterDropdownMenu && !depFilterDropdownMenu.contains(e.target) && e.target !== btnDepFilterToggle) {
        depFilterDropdownMenu.classList.remove("dropdown-active");
    }
});

// --- INTEGRATED MATRIX SYSTEM PAGINATION RUNNER ---
function executePaginationEngine() {
    if (!depTableBody) return;

    const visibleRows = Array.from(depTableBody.querySelectorAll(".nx-deposit-row")).filter(row => {
        return row.getAttribute("data-filter-hidden") !== "true";
    });

    const grossTotal = visibleRows.length;
    const pageCountMax = Math.ceil(grossTotal / depRowsPerPageLimit) || 1;

    if (depCurrentActivePage > pageCountMax) depCurrentActivePage = pageCountMax;
    if (depCurrentActivePage < 1) depCurrentActivePage = 1;

    visibleRows.forEach((row, index) => {
        const indexMin = (depCurrentActivePage - 1) * depRowsPerPageLimit;
        const indexMax = indexMin + depRowsPerPageLimit;
        row.style.display = (index >= indexMin && index < indexMax) ? "" : "none";
    });

    const boundaryStart = grossTotal === 0 ? 0 : (depCurrentActivePage - 1) * depRowsPerPageLimit + 1;
    const boundaryEnd = Math.min(depCurrentActivePage * depRowsPerPageLimit, grossTotal);

    if (depPaginationStatusText) {
        depPaginationStatusText.textContent = `Showing ${boundaryStart} to ${boundaryEnd} of ${grossTotal} Ledger Entries`;
    }

    if (depPaginationContainer) {
        depPaginationContainer.innerHTML = "";

        // Left Chevron Button Control Anchor
        const prevButton = document.createElement("button");
        prevButton.className = `nx-pag-btn ${depCurrentActivePage === 1 ? 'disabled' : ''}`;
        prevButton.innerHTML = "<i class='bx bx-chevron-left'></i>";
        if (depCurrentActivePage !== 1) {
            prevButton.addEventListener("click", () => { depCurrentActivePage--; executePaginationEngine(); });
        }
        depPaginationContainer.appendChild(prevButton);

        // Real Time Numeric Pagination Map Generative Loops
        for (let i = 1; i <= pageCountMax; i++) {
            const numericButton = document.createElement("button");
            numericButton.className = `nx-pag-btn ${depCurrentActivePage === i ? 'active' : ''}`;
            numericButton.textContent = i;
            numericButton.addEventListener("click", () => { depCurrentActivePage = i; executePaginationEngine(); });
            depPaginationContainer.appendChild(numericButton);
        }

        // Right Chevron Button Control Anchor
        const nextButton = document.createElement("button");
        nextButton.className = `nx-pag-btn ${depCurrentActivePage === pageCountMax ? 'disabled' : ''}`;
        nextButton.innerHTML = "<i class='bx bx-chevron-right'></i>";
        if (depCurrentActivePage !== pageCountMax) {
            nextButton.addEventListener("click", () => { depCurrentActivePage++; executePaginationEngine(); });
        }
        depPaginationContainer.appendChild(nextButton);
    }
}

// --- OVERLAY INTERACTION BINDING ENGINE MODULE ---
function initializeRowClickEvents(rowItem) {
    const structuralTrigger = rowItem.querySelector(".deposit-action-review");
    if (structuralTrigger && modalAuditWindow) {
        structuralTrigger.addEventListener("click", (e) => {
            e.stopPropagation();
            targetRowActiveScope = rowItem;

            const transId = rowItem.getAttribute("data-txid");
            const userName = rowItem.getAttribute("data-name");
            const nodeUid = rowItem.getAttribute("data-uid");
            const gateMethod = rowItem.getAttribute("data-method");
            const cashAmount = rowItem.getAttribute("data-amount");
            const currentStatus = rowItem.getAttribute("data-status");
            const proofImage = rowItem.getAttribute("data-proof");
            document.getElementById("deposit-proof-image").src = proofImage;

            // Inject targeted datasets across the structural modal form views
            document.getElementById("m-deposit-txid").textContent = transId;
            document.getElementById("m-deposit-user").textContent = userName;
            document.getElementById("m-deposit-meta").textContent = `Account Tracking Node: ${nodeUid}`;
            document.getElementById("m-deposit-gateway").textContent = gateMethod;
            document.getElementById("m-deposit-amount").textContent = `$${parseFloat(cashAmount).toLocaleString(undefined, { minimumFractionDigits: 2 })}`;

            const modalActionsArea = document.getElementById("deposit-workflow-actions");
            const modalStaticNotice = document.getElementById("deposit-status-locked-notice");

            if (currentStatus.toLowerCase() === "pending") {
                if (modalActionsArea) modalActionsArea.style.display = "flex";
                if (modalStaticNotice) modalStaticNotice.style.display = "none";
            } else {
                if (modalActionsArea) modalActionsArea.style.display = "none";
                if (modalStaticNotice) {
                    modalStaticNotice.style.display = "block";
                    modalStaticNotice.innerHTML = `This ledger line allocation was verified and <strong>${currentStatus}</strong>.`;
                }
            }

            modalAuditWindow.classList.add("modal-active");
        });
    }
}

// Bind initial transaction matrix entries 
if (depTableBody) {
    depTableBody.querySelectorAll(".nx-deposit-row").forEach(row => initializeRowClickEvents(row));
}

// --- WORKFLOW TRANSITION DISPATCH SHIFTERS ---
const btnConfirmApprove = document.getElementById("btn-deposit-approve");
const btnConfirmReject = document.getElementById("btn-deposit-reject");

if (btnConfirmApprove) {
    btnConfirmApprove.addEventListener("click", () => {
        updateDepositStatus("Approved");
    });
}

if (btnConfirmReject) {
    btnConfirmReject.addEventListener("click", () => {
        updateDepositStatus("Rejected");
    });
}

// Close button modal actions engine triggers
const modalCloseTriggerBtn = document.querySelector(".nx-modal-close-trigger");
if (modalCloseTriggerBtn && modalAuditWindow) {
    modalCloseTriggerBtn.addEventListener("click", () => {
        modalAuditWindow.classList.remove("modal-active");
    });
}

// --- INTEGRATED CONDITIONAL FILTER PIPELINE MATRIX ---
const filterStatusOption = document.getElementById("filter-deposit-status");
const filterMethodOption = document.getElementById("filter-deposit-method");
const btnResetSystemFilters = document.getElementById("btn-reset-deposit-filters");

function executeLiveSearchFilters() {
    if (!depTableBody) return;

    const stringSearchInput = depSearchInput ? depSearchInput.value.toLowerCase().trim() : "";
    const activeStatusSelect = filterStatusOption ? filterStatusOption.value.toLowerCase() : "all";
    const activeMethodSelect = filterMethodOption ? filterMethodOption.value.toLowerCase() : "all";

    const executionRows = depTableBody.querySelectorAll(".nx-deposit-row");
    let activeMatchCounter = 0;

    executionRows.forEach(row => {
        const blockDataPool = row.textContent.toLowerCase();
        const stateAttr = row.getAttribute("data-status").toLowerCase();
        const gateAttr = row.getAttribute("data-method").toLowerCase();

        const queryValid = blockDataPool.includes(stringSearchInput);
        const statusValid = (activeStatusSelect === "all") || (stateAttr === activeStatusSelect);
        const methodValid = (activeMethodSelect === "all") || (gateAttr === activeMethodSelect);

        if (queryValid && statusValid && methodValid) {
            row.removeAttribute("data-filter-hidden");
            activeMatchCounter++;
        } else {
            row.setAttribute("data-filter-hidden", "true");
            row.style.display = "none";
        }
    });

    if (depEmptyRow) depEmptyRow.style.display = (activeMatchCounter === 0) ? "" : "none";
    depCurrentActivePage = 1;
    executePaginationEngine();
}

// Attach Pipeline Evaluators across interface controls
if (depSearchInput) depSearchInput.addEventListener("input", executeLiveSearchFilters);
if (filterStatusOption) filterStatusOption.addEventListener("change", executeLiveSearchFilters);
if (filterMethodOption) filterMethodOption.addEventListener("change", executeLiveSearchFilters);

if (btnResetSystemFilters) {
    btnResetSystemFilters.addEventListener("click", () => {
        if (filterStatusOption) filterStatusOption.value = "all";
        if (filterMethodOption) filterMethodOption.value = "all";
        if (depSearchInput) depSearchInput.value = "";
        executeLiveSearchFilters();
    });
}

// Boot execution initial sequence
executePaginationEngine();
// --- FILTER MATRIX & LIVE SEARCH ENGINE ---
const applyFilters = () => {
    const searchTerm = depSearchInput.value.toLowerCase();
    const statusFilter = document.getElementById("filter-deposit-status").value;
    const methodFilter = document.getElementById("filter-deposit-method").value;

    document.querySelectorAll(".nx-deposit-row").forEach(row => {
        const txid = row.getAttribute("data-txid").toLowerCase();
        const uid = row.getAttribute("data-uid").toLowerCase();
        const name = row.getAttribute("data-name").toLowerCase();
        const status = row.getAttribute("data-status").toLowerCase();
        const method = row.getAttribute("data-method").toLowerCase();

        const matchesSearch = txid.includes(searchTerm) || uid.includes(searchTerm) || name.includes(searchTerm);
        const matchesStatus = statusFilter === "all" || status === statusFilter.toLowerCase();
        const matchesMethod = methodFilter === "all" || method.includes(methodFilter.toLowerCase());

        if (matchesSearch && matchesStatus && matchesMethod) {
            row.setAttribute("data-filter-hidden", "false");
            row.style.display = "";
        } else {
            row.setAttribute("data-filter-hidden", "true");
            row.style.display = "none";
        }
    });

    // Trigger pagination update after filtering
    depCurrentActivePage = 1;
    executePaginationEngine();
};

// Event Listeners for Filters
depSearchInput.addEventListener("input", applyFilters);
document.getElementById("filter-deposit-status").addEventListener("change", applyFilters);
document.getElementById("filter-deposit-method").addEventListener("change", applyFilters);

// Reset Filter Logic
document.getElementById("btn-reset-deposit-filters")?.addEventListener("click", () => {
    depSearchInput.value = "";
    document.getElementById("filter-deposit-status").value = "all";
    document.getElementById("filter-deposit-method").value = "all";
    applyFilters();
});


// --- SERVER SYNC & STATUS UPDATE ENGINE ---
function updateDepositStatus(status) {
    if (!targetRowActiveScope) return;
    window.location.reload();
    const txid = targetRowActiveScope.getAttribute("data-txid");

    // Assuming you have the CSRF token in your header as mentioned
    fetch(`/admin/deposits/update-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
        },
        body: JSON.stringify({
            txid: txid,
            status: status
        })
    })


        .then(async response => {
            const text = await response.text();
            console.log(text);

            try {
                return JSON.parse(text);
            } catch (e) {
                throw new Error(text);
            }
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error(error);
        });


}

// --- INITIALIZATION ---
// Make sure these are at the very end of your script
document.querySelectorAll(".nx-deposit-row").forEach(initializeRowClickEvents);
executePaginationEngine();


console.log(document.querySelector('meta[name="csrf-token"]').content);


