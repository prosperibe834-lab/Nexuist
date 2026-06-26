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

// =========================================================================
// NEXUIST ADMINISTRATIVE FRAMEWORK - CORE WEBSITE SETTINGS RUNTIME LOGIC
// =========================================================================

/* ==========================================================================
   NEXUIST FINTECH ADMIN DASHBOARD REFERENCE MANAGEMENT CONTROLLER
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    executeCounterAnimationsPipeline();
});

/**
 * Animated UI Stepper for Statistics Numbers
 */
function executeCounterAnimationsPipeline() {
    const numericCounters = document.querySelectorAll('.nx-counter');
    
    numericCounters.forEach(counter => {
        const targetValue = parseFloat(counter.getAttribute('data-target')) || 0;
        let initialStepValue = 0;
        const totalFramesAllocation = 50; // Total computational animation frames loop count
        const frameIncrementValue = Math.ceil(targetValue / totalFramesAllocation);

        const runCountUpdate = () => {
            initialStepValue += frameIncrementValue;
            if (initialStepValue < targetValue) {
                counter.innerText = initialStepValue.toLocaleString();
                requestAnimationFrame(runCountUpdate);
            } else {
                counter.innerText = targetValue.toLocaleString();
            }
        };
        requestAnimationFrame(runCountUpdate);
    });
}

/**
 * Client-Side Real-Time Reactive Query Filtering Layer
 */
function executeTableClientSearchFilter() {
    const searchQuery = document.getElementById('tableSearchQuery').value.toLowerCase().trim();
    const targetedCountry = document.getElementById('filterCountryOpt').value;
    const targetedTier = document.getElementById('filterTierOpt').value;
    
    const dataTableRows = document.querySelectorAll('#referralsMasterTable tbody .table-data-row');
    const emptyStateView = document.getElementById('tableEmptyStateView');
    
    let visibleRowsCounter = 0;

    dataTableRows.forEach(row => {
        const rowName = row.getAttribute('data-name').toLowerCase();
        const rowEmail = row.getAttribute('data-email').toLowerCase();
        const rowId = row.getAttribute('data-id').toLowerCase();
        const rowCountry = row.getAttribute('data-country');
        const rowTier = row.getAttribute('data-tier');

        // Parameter match validation rules
        const queryMatches = !searchQuery || rowName.includes(searchQuery) || rowEmail.includes(searchQuery) || rowId.includes(searchQuery);
        const countryMatches = !targetedCountry || rowCountry === targetedCountry;
        const tierMatches = !targetedTier || rowTier === targetedTier;

        if (queryMatches && countryMatches && tierMatches) {
            row.style.display = '';
            visibleRowsCounter++;
        } else {
            row.style.display = 'none';
        }
    });

    // Evaluate structural boundary visibility
    if (visibleRowsCounter === 0) {
        emptyStateView.classList.remove('hidden');
    } else {
        emptyStateView.classList.add('hidden');
    }
}

/**
 * Reset Search and Filter Options
 */
function resetSearchFilterMatrixFields() {
    document.getElementById('tableSearchQuery').value = '';
    document.getElementById('filterCountryOpt').value = '';
    document.getElementById('filterTierOpt').value = '';
    executeTableClientSearchFilter();
    triggerToast('info', 'Data telemetry filters clear. Master matrix reset complete.');
}

/**
 * Handle Table Checked Multi-Selection Configurations
 */
function toggleAllTableCheckboxes(masterSelector) {
    const structuralCheckboxes = document.querySelectorAll('#referralsMasterTable tbody .row-item-checkbox');
    structuralCheckboxes.forEach(checkbox => {
        checkbox.checked = masterSelector.checked;
    });
    evaluateBulkActionStripState();
}

/**
 * Bulk Action Floating Confirmation Strip Pipeline
 */
function evaluateBulkActionStripState() {
    const structuralCheckboxes = document.querySelectorAll('#referralsMasterTable tbody .row-item-checkbox');
    const bulkActionsStrip = document.getElementById('bulkActionsStrip');
    const checkedIndicatorCount = document.getElementById('bulkSelectedCount');
    
    let checkedCounter = 0;
    structuralCheckboxes.forEach(cb => { if(cb.checked) checkedCounter++; });

    if (checkedCounter > 0) {
        checkedIndicatorCount.innerText = checkedCounter;
        bulkActionsStrip.classList.remove('hidden');
    } else {
        bulkActionsStrip.classList.add('hidden');
        document.getElementById('masterCheckboxSelector').checked = false;
    }
}

/**
 * Bulk Action Simulation Completion Payout Triggers
 */
function triggerBulkToast(operationSummaryText) {
    triggerToast('success', `Bulk Operation Success: ${operationSummaryText}.`);
    // Automated clear sequences
    document.getElementById('masterCheckboxSelector').checked = false;
    toggleAllTableCheckboxes(document.getElementById('masterCheckboxSelector'));
}

/**
 * Modal State Route Manager Controls
 */
function openSystemModal(modalChassisId) {
    const targetModalNode = document.getElementById(modalChassisId);
    if(targetModalNode) targetModalNode.classList.add('active');
}

function closeSystemModal(modalChassisId) {
    const targetModalNode = document.getElementById(modalChassisId);
    if(targetModalNode) targetModalNode.classList.remove('active');
}

/**
 * Manual Operational Allocation Modification Alert Confirmation
 */
function triggerCommissionConfirmationAction() {
    if(confirm("CRITICAL PROTOCOL: Authorize systemic ledger change override parameters? This action immediately commits data down onto active nodes.")) {
        closeSystemModal('commsModal');
        triggerToast('success', 'Ledger adjustment finalized. Network synchronization complete.');
    }
}

/**
 * Systemic Micro-Toast Notification Generator Engine
 */
function triggerToast(severityType, feedbackMessageText) {
    const streamContainerNode = document.getElementById('toastContainer');
    if(!streamContainerNode) return;

    const elementToastAlert = document.createElement('div');
    elementToastAlert.className = `system-toast-alert style-${severityType}`;
    elementToastAlert.innerHTML = `
        <i class='bx ${severityType === 'success' ? 'bx-check-circle' : 'bx-info-circle'}'></i>
        <span>${feedbackMessageText}</span>
    `;

    streamContainerNode.appendChild(elementToastAlert);

    // Automation routine to scrub nodes out of active DOM context loops
    setTimeout(() => {
        elementToastAlert.style.opacity = '0';
        elementToastAlert.style.transform = 'translateY(-10px)';
        setTimeout(() => { elementToastAlert.remove(); }, 300);
    }, 3500);
}