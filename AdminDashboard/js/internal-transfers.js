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
    // NEXUIST INTRA-SYSTEM TRANSFER OPERATIONS ENGINE MODULE
    // =========================================================
    const itFormElement = document.getElementById("nexuist-internal-transfer-form");
    const itSenderInput = document.getElementById("it-sender-uid");
    const itRecipientInput = document.getElementById("it-recipient-uid");
    const itAmountInput = document.getElementById("it-transfer-amount");
    const itMemoInput = document.getElementById("it-transfer-memo");
    
    const itSearchBoxInput = document.getElementById("it-search-input");
    const itTableBody = document.querySelector("#internal-transfer-audit-log-table tbody");
    const itEmptyRow = document.getElementById("it-empty-row");
    const itPaginationBox = document.getElementById("it-pagination-controls");
    const itPaginationStatusText = document.getElementById("it-pagination-status");

    const modalSignoffOverlay = document.getElementById("modal-it-compliance-signoff");
    const btnConfirmItMutation = document.getElementById("btn-confirm-it-mutation");

    // Static Mock Node Database Array for Validation Simulations
    const platformNodeMockDatabase = {
        "#NEX-10942": { name: "Alexander Mercer", balance: 84250.00, email: "a.mercer@nexuist.io" },
        "#NEX-10811": { name: "Sophia Kovac", balance: 12940.55, email: "s.kovac@proton.me" },
        "#NEX-09754": { name: "Ryan Elric", balance: 310.20, email: "ryan.elric@gmail.com" }
    };

    const itRowsPerPageLimit = 5;
    let itCurrentActivePage = 1;

    // --- INTERACTIVE INLINE PROFILE FIELD EXTRAPOLATORS ---
    if (itSenderInput) {
        itSenderInput.addEventListener("input", function() {
            const val = this.value.trim().toUpperCase();
            const previewBox = document.getElementById("sender-lookup-preview");
            const targetName = document.getElementById("sender-preview-name");
            const targetBal = document.getElementById("sender-preview-balance");

            if (platformNodeMockDatabase[val]) {
                targetName.textContent = platformNodeMockDatabase[val].name;
                targetBal.textContent = `$${platformNodeMockDatabase[val].balance.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                previewBox.style.display = "flex";
            } else {
                previewBox.style.display = "none";
            }
        });
    }

    if (itRecipientInput) {
        itRecipientInput.addEventListener("input", function() {
            const val = this.value.trim().toUpperCase();
            const previewBox = document.getElementById("recipient-lookup-preview");
            const targetName = document.getElementById("recipient-preview-name");

            if (platformNodeMockDatabase[val]) {
                targetName.textContent = platformNodeMockDatabase[val].name;
                previewBox.style.display = "flex";
            } else {
                previewBox.style.display = "none";
            }
        });
    }

    // --- FORM COMPLIANCE INTERCEPTOR ROUTINES ---
    if (itFormElement) {
        itFormElement.addEventListener("submit", function(e) {
            e.preventDefault();

            const senderUid = itSenderInput.value.trim().toUpperCase();
            const recipientUid = itRecipientInput.value.trim().toUpperCase();
            const transferAmount = parseFloat(itAmountInput.value);

            // Validation Rule 1: Validate database path links intersect accurately
            if (!platformNodeMockDatabase[senderUid] || !platformNodeMockDatabase[recipientUid]) {
                alert("Operation Aborted: One or both assigned Account Node tracking references are invalid inside current registries.");
                return;
            }

            // Validation Rule 2: Verify balance requirements are satisfied
            if (transferAmount > platformNodeMockDatabase[senderUid].balance) {
                alert("Operation Aborted: Selected Source Node has insufficient liquid token limits to clear this query allocation.");
                return;
            }

            // Validation Rule 3: Enforce circuit isolation boundary limits
            if (senderUid === recipientUid) {
                alert("Operation Aborted: Intraledger paths cannot self-terminate inside matching account index lines.");
                return;
            }

            // Populate dataset mappings out to confirmation view overlay panels
            document.getElementById("m-it-sender-display").textContent = senderUid;
            document.getElementById("m-it-recipient-display").textContent = recipientUid;
            document.getElementById("m-it-amount-display").textContent = `$${transferAmount.toLocaleString(undefined, {minimumFractionDigits: 2})}`;

            modalSignoffOverlay.classList.add("modal-active");
        });
    }

    // --- MUTATION COMMIT ARCHITECTURE MUTATION TRACE ---
    if (btnConfirmItMutation) {
        btnConfirmItMutation.addEventListener("click", function() {
            const senderUid = itSenderInput.value.trim().toUpperCase();
            const recipientUid = itRecipientInput.value.trim().toUpperCase();
            const transferAmount = parseFloat(itAmountInput.value);

            // Simulate systemic ledger mutations updates
            platformNodeMockDatabase[senderUid].balance -= transferAmount;
            platformNodeMockDatabase[recipientUid].balance += transferAmount;

            // Generate fresh tracking indices references 
            const generatedBatchId = `TXN-IT-${Math.floor(1000000 + Math.random() * 9000000)}`;
            const senderName = platformNodeMockDatabase[senderUid].name;
            const recipientName = platformNodeMockDatabase[recipientUid].name;

            // Construct full HTML table row injection node
            const constructedRowHtml = `
                <tr class="nx-it-row" data-batch="${generatedBatchId}" data-sender="${senderUid}" data-recipient="${recipientUid}" data-amount="${transferAmount}">
                    <td><span class="nx-it-hash-tag">${generatedBatchId}</span></td>
                    <td>
                        <div class="nx-it-user-cell">
                            <span class="nx-it-uid">${senderUid}</span>
                            <span class="nx-it-subtext-email">${senderName}</span>
                        </div>
                    </td>
                    <td>
                        <div class="nx-it-user-cell">
                            <span class="nx-it-uid">${recipientUid}</span>
                            <span class="nx-it-subtext-email">${recipientName}</span>
                        </div>
                    </td>
                    <td><span class="nx-it-value-delta">$${transferAmount.toLocaleString(undefined, {minimumFractionDigits: 2})}</span></td>
                    <td><span class="nx-it-status badge-success"><i class='bx bx-check-circle'></i> Committed</span></td>
                </tr>
            `;

            // Inject row string baseline straight into table structures
            if (itTableBody) {
                itTableBody.insertAdjacentHTML("afterbegin", constructedRowHtml);
            }

            // Cleanup overlays, reset form fields, reload tracking grids
            modalSignoffOverlay.classList.remove("modal-active");
            itFormElement.reset();
            document.getElementById("sender-lookup-preview").style.display = "none";
            document.getElementById("recipient-lookup-preview").style.display = "none";

            itCurrentActivePage = 1;
            executeAuditLogPagination();
            alert(`Ledger Balance Mutation Successful!\nInjected Reference Index Chain: ${generatedBatchId}`);
        });
    }

    // Modal close hooks binding loops
    document.querySelectorAll(".nx-it-modal-close-trigger").forEach(trigger => {
        trigger.addEventListener("click", (e) => {
            e.preventDefault();
            if (modalSignoffOverlay) modalSignoffOverlay.classList.remove("modal-active");
        });
    });

    // --- INTEGRATED DATA DATA-GRID PAGINATION RUNNER ---
    function executeAuditLogPagination() {
        if (!itTableBody) return;

        const visibleRows = Array.from(itTableBody.querySelectorAll(".nx-it-row")).filter(row => {
            return row.getAttribute("data-search-hidden") !== "true";
        });

        const grossTotal = visibleRows.length;
        const pageCountMax = Math.ceil(grossTotal / itRowsPerPageLimit) || 1;

        if (itCurrentActivePage > pageCountMax) itCurrentActivePage = pageCountMax;
        if (itCurrentActivePage < 1) itCurrentActivePage = 1;

        visibleRows.forEach((row, index) => {
            const indexMin = (itCurrentActivePage - 1) * itRowsPerPageLimit;
            const indexMax = indexMin + itRowsPerPageLimit;
            row.style.display = (index >= indexMin && index < indexMax) ? "" : "none";
        });

        const boundaryStart = grossTotal === 0 ? 0 : (itCurrentActivePage - 1) * itRowsPerPageLimit + 1;
        const boundaryEnd = Math.min(itCurrentActivePage * itRowsPerPageLimit, grossTotal);
        
        if (itPaginationStatusText) {
            itPaginationStatusText.textContent = `Showing ${boundaryStart} to ${boundaryEnd} of ${grossTotal} Logs`;
        }

        if (itPaginationBox) {
            itPaginationBox.innerHTML = "";

            const prevBtn = document.createElement("button");
            prevBtn.className = `nx-it-pag-btn ${itCurrentActivePage === 1 ? 'disabled' : ''}`;
            prevBtn.innerHTML = "<i class='bx bx-chevron-left'></i>";
            if (itCurrentActivePage !== 1) {
                prevBtn.addEventListener("click", () => { itCurrentActivePage--; executeAuditLogPagination(); });
            }
            itPaginationBox.appendChild(prevBtn);

            for (let i = 1; i <= pageCountMax; i++) {
                const numBtn = document.createElement("button");
                numBtn.className = `nx-it-pag-btn ${itCurrentActivePage === i ? 'active' : ''}`;
                numBtn.textContent = i;
                numBtn.addEventListener("click", () => { itCurrentActivePage = i; executeAuditLogPagination(); });
                itPaginationBox.appendChild(numBtn);
            }

            const nextBtn = document.createElement("button");
            nextBtn.className = `nx-it-pag-btn ${itCurrentActivePage === pageCountMax ? 'disabled' : ''}`;
            nextBtn.innerHTML = "<i class='bx bx-chevron-right'></i>";
            if (itCurrentActivePage !== pageCountMax) {
                nextBtn.addEventListener("click", () => { itCurrentActivePage++; executeAuditLogPagination(); });
            }
            itPaginationBox.appendChild(nextBtn);
        }
    }

    // --- ARCHIVE TRAIL KEYWORD FILTER ASSIGNOR ---
    if (itSearchBoxInput) {
        itSearchBoxInput.addEventListener("input", function() {
            const query = this.value.toLowerCase().trim();
            const allRows = itTableBody.querySelectorAll(".nx-it-row");
            let totalMatches = 0;

            allRows.forEach(row => {
                const pool = row.textContent.toLowerCase();
                if (pool.includes(query)) {
                    row.removeAttribute("data-search-hidden");
                    totalMatches++;
                } else {
                    row.setAttribute("data-search-hidden", "true");
                    row.style.display = "none";
                }
            });

            if (itEmptyRow) itEmptyRow.style.display = (totalMatches === 0) ? "" : "none";
            itCurrentActivePage = 1;
            executeAuditLogPagination();
        });
    }

    // Boot run engine immediately 
    executeAuditLogPagination();
});