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


// Main section starts here
document.addEventListener("DOMContentLoaded", () => {
    
    // Core Layout Control Elements
    const userSearchInput = document.getElementById("user-search-input");
    const tableBody = document.querySelector("#nexuist-user-table tbody");
    const tableEmptyRow = document.getElementById("table-empty-row");
    const paginationControls = document.querySelector(".pagination-controls-buttons");
    const statusCounter = document.getElementById("pagination-status");
    
    const modalView = document.getElementById("modal-view-profile");
    const modalEdit = document.getElementById("modal-edit-wallet");
    const modalBlock = document.getElementById("modal-block-node");

    const btnFilterToggle = document.getElementById("action-btn-filter");
    const btnCreateUserToggle = document.getElementById("action-btn-create");
    const filterDropdown = document.getElementById("filter-dropdown");
    const modalCreateUser = document.getElementById("modal-create-user");
    const createUserForm = document.getElementById("create-user-form");

    // Pagination Constants
    const rowsPerPage = 5;
    let currentPage = 1;

    // Helper: Safely hide all active dashboard modal layouts
    function closeAllActiveModals() {
        document.querySelectorAll(".nexuist-modal-overlay").forEach(modal => {
            modal.classList.remove("modal-active");
        });
    }

    // Assign exit clicks to dismiss layers
    document.querySelectorAll(".modal-close-btn").forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            closeAllActiveModals();
        });
    });

    document.querySelectorAll(".nexuist-modal-overlay").forEach(overlay => {
        overlay.addEventListener("click", function(e) {
            if (e.target === this) closeAllActiveModals();
        });
    });

    // Toggle Filter Menu Panel Dropdown View
    if (btnFilterToggle && filterDropdown) {
        btnFilterToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            filterDropdown.classList.toggle("dropdown-active");
        });
    }

    // Toggle Open User Creation Modal Frame
    if (btnCreateUserToggle && modalCreateUser) {
        btnCreateUserToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            modalCreateUser.classList.add("modal-active");
        });
    }

    // Dismiss Filter Menu Dropdown on external window body actions
    document.addEventListener("click", (e) => {
        if (filterDropdown && !filterDropdown.contains(e.target) && e.target !== btnFilterToggle) {
            filterDropdown.classList.remove("dropdown-active");
        }
    });

    // =========================================================
    // PAGINATION GENERATION MATRIX
    // =========================================================
    function renderPaginationEngine() {
        const activeRows = Array.from(tableBody.querySelectorAll(".user-data-row")).filter(row => {
            return row.getAttribute("data-search-hidden") !== "true";
        });

        const totalEntries = activeRows.length;
        const totalPages = Math.ceil(totalEntries / rowsPerPage) || 1;

        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        activeRows.forEach((row, index) => {
            const startIdx = (currentPage - 1) * rowsPerPage;
            const endIdx = startIdx + rowsPerPage;
            row.style.display = (index >= startIdx && index < endIdx) ? "" : "none";
        });

        const startEntry = totalEntries === 0 ? 0 : (currentPage - 1) * rowsPerPage + 1;
        const endEntry = Math.min(currentPage * rowsPerPage, totalEntries);
        if (statusCounter) {
            statusCounter.textContent = `Showing ${startEntry} to ${endEntry} of ${totalEntries} Entries`;
        }

        if (paginationControls) {
            paginationControls.innerHTML = "";

            const prevBtn = document.createElement("button");
            prevBtn.className = `pag-btn prev-next ${currentPage === 1 ? 'disabled' : ''}`;
            prevBtn.innerHTML = "<i class='bx bx-chevron-left'></i>";
            if (currentPage !== 1) {
                prevBtn.addEventListener("click", () => { currentPage--; renderPaginationEngine(); });
            }
            paginationControls.appendChild(prevBtn);

            for (let i = 1; i <= totalPages; i++) {
                if (totalPages > 3 && (i !== 1 && i !== totalPages && Math.abs(i - currentPage) > 1)) {
                    if (i === 2 || i === totalPages - 1) {
                        const ellipsis = document.createElement("span");
                        ellipsis.className = "pag-ellipsis";
                        ellipsis.textContent = "...";
                        paginationControls.appendChild(ellipsis);
                    }
                    continue;
                }

                const numBtn = document.createElement("button");
                numBtn.className = `pag-btn num-btn ${currentPage === i ? 'active' : ''}`;
                numBtn.textContent = i;
                numBtn.addEventListener("click", () => { currentPage = i; renderPaginationEngine(); });
                paginationControls.appendChild(numBtn);
            }

            const nextBtn = document.createElement("button");
            nextBtn.className = `pag-btn prev-next ${currentPage === totalPages ? 'disabled' : ''}`;
            nextBtn.innerHTML = "<i class='bx bx-chevron-right'></i>";
            if (currentPage !== totalPages) {
                nextBtn.addEventListener("click", () => { currentPage++; renderPaginationEngine(); });
            }
            paginationControls.appendChild(nextBtn);
        }
    }

    // =========================================================
    // DYNAMIC ELEMENT DATA DATA-BINDING ROUTER FUNCTION
    // =========================================================
    function bindRowActionListeners(row) {
        const btnView = row.querySelector(".btn-view");
        const btnEdit = row.querySelector(".btn-edit");
        const btnDelete = row.querySelector(".btn-delete");

        if (btnView) {
            btnView.addEventListener("click", (e) => {
                e.stopPropagation();
                const uid = row.getAttribute("data-uid");
                const name = row.getAttribute("data-name");
                const email = row.getAttribute("data-email");
                const phone = row.getAttribute("data-phone");
                const country = row.getAttribute("data-country");
                const balance = row.getAttribute("data-balance");
                const bot = row.getAttribute("data-bot");

                document.getElementById("m-avatar-txt").textContent = name.split(' ').map(n => n[0]).join('').toUpperCase();
                document.getElementById("m-user-name").textContent = name;
                document.getElementById("m-user-email").textContent = email;
                document.getElementById("m-user-uid").textContent = uid;
                document.getElementById("m-user-phone").textContent = phone;
                document.getElementById("m-user-country").textContent = country;
                document.getElementById("m-user-balance").textContent = `$${parseFloat(balance).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                document.getElementById("m-user-bot").textContent = `${bot} Active`;
                modalView.classList.add("modal-active");
            });
        }

        if (btnEdit) {
            btnEdit.addEventListener("click", (e) => {
                e.stopPropagation();
                const uid = row.getAttribute("data-uid");
                const name = row.getAttribute("data-name");
                const balance = row.getAttribute("data-balance");
                const crypto = row.getAttribute("data-crypto");

                document.getElementById("m-wallet-username").textContent = name;
                document.getElementById("input-fiat-amount").value = parseFloat(balance);
                document.getElementById("input-crypto-amount").value = crypto;
                document.getElementById("wallet-adjust-form").setAttribute("data-active-uid", uid);
                modalEdit.classList.add("modal-active");
            });
        }

        if (btnDelete) {
            btnDelete.addEventListener("click", (e) => {
                e.stopPropagation();
                const uid = row.getAttribute("data-uid");
                const name = row.getAttribute("data-name");

                document.getElementById("m-block-uid").textContent = `${name} (${uid})`;
                document.getElementById("btn-confirm-node-block").setAttribute("data-active-uid", uid);
                modalBlock.classList.add("modal-active");
            });
        }
    }

    // Bind existing markup table elements
    document.querySelectorAll(".user-data-row").forEach(row => bindRowActionListeners(row));

    // =========================================================
    // FORMS SUBMISSIONS MUTATORS (MUTATION SIMULATIONS)
    // =========================================================
    if (walletForm = document.getElementById("wallet-adjust-form")) {
        walletForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const targetUid = this.getAttribute("data-active-uid");
            const newFiatValue = document.getElementById("input-fiat-amount").value;
            const newCryptoValue = document.getElementById("input-crypto-amount").value;

            // Extract user ID from the UID string (format: #NEX-{id})
            const userId = targetUid.split('-')[1];

            console.log('Updating user', userId, 'with balance:', newFiatValue);

            // Send update to backend
            fetch(`/users/${userId}/balance`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    balance: parseFloat(newFiatValue),
                    crypto_balance: newCryptoValue
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Server error response:', text);
                        throw new Error(`Server returned ${response.status}: ${text.substring(0, 200)}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    // Update UI
                    const matchedRow = document.querySelector(`.user-data-row[data-uid="${targetUid}"]`);
                    if (matchedRow) {
                        matchedRow.setAttribute("data-balance", newFiatValue);
                        matchedRow.setAttribute("data-crypto", newCryptoValue);
                        matchedRow.querySelector(".fiat-balance").textContent = `$${parseFloat(newFiatValue).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
                        matchedRow.querySelector(".crypto-subtext").innerHTML = `<i class='bx bxl-bitcoin crypto-btc'></i> ${newCryptoValue}`;
                    }
                    alert('Balance updated successfully!');
                } else {
                    alert('Error: ' + (data.message || 'Failed to update balance'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating balance: ' + error.message);
            })
            .finally(() => {
                closeAllActiveModals();
            });
        });
    }

    const confirmBlockBtn = document.getElementById("btn-confirm-node-block");
    if (confirmBlockBtn) {
        confirmBlockBtn.addEventListener("click", function() {
            const blockedUid = this.getAttribute("data-active-uid");
            const targetRow = document.querySelector(`.user-data-row[data-uid="${blockedUid}"]`);
            if (targetRow) {
                targetRow.style.opacity = "0.4";
                const badge = targetRow.querySelector(".badge");
                if (badge) {
                    badge.className = "badge badge-danger";
                    badge.innerHTML = "<i class='bx bx-block'></i> Suspended";
                }
            }
            closeAllActiveModals();
        });
    }

    // PROVISION ACCOUNT FORMS SUBMIT INTERCEPTOR
    if (createUserForm) {
        createUserForm.addEventListener("submit", function(e) {
            e.preventDefault();

            const name = document.getElementById("new-user-name").value;
            const email = document.getElementById("new-user-email").value;
            const phone = document.getElementById("new-user-phone").value;
            const country = document.getElementById("new-user-country").value;
            const balance = document.getElementById("new-user-balance").value;
            const crypto = document.getElementById("new-user-crypto").value;
            
            const generatedUid = `#NEX-${Math.floor(10000 + Math.random() * 90000)}`;
            const initials = name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);

            const newRowHtml = `
                <tr class="user-data-row" data-uid="${generatedUid}" data-name="${name}" data-email="${email}" data-phone="${phone}" data-country="${country}" data-balance="${balance}" data-crypto="${crypto}" data-bot="None Active" data-kyc="In Review">
                    <td>
                        <div class="user-profile-cell">
                            <div class="avatar-frame"><span class="avatar-placeholder text-glow-cyan">${initials}</span></div>
                            <div class="profile-info-text">
                                <span class="user-display-name">${name}</span>
                                <span class="user-email-text">${email}</span>
                            </div>
                        </div>
                    </td>
                    <td><span class="uid-tag">${generatedUid}</span></td>
                    <td><span class="table-phone-txt"><i class='bx bx-phone text-muted'></i> ${phone}</span></td>
                    <td>
                        <div class="country-cell-wrapper">
                            <i class='bx bx-map-pin country-marker-icon'></i>
                            <span>${country}</span>
                        </div>
                    </td>
                    <td>
                        <div class="balance-cell">
                            <span class="fiat-balance">$${parseFloat(balance).toLocaleString(undefined, {minimumFractionDigits: 2})}</span>
                            <span class="crypto-subtext"><i class='bx bxl-bitcoin crypto-btc'></i> ${crypto}</span>
                        </div>
                    </td>
                    <td><span class="text-muted text-small-italic">None Active</span></td>
                    <td><span class="badge badge-warning"><i class='bx bx-time-five'></i> In Review</span></td>
                    <td>
                        <div class="table-action-buttons-group">
                            <button class="action-btn btn-view" title="View Profile Details"><i class='bx bx-show-alt'></i></button>
                            <button class="action-btn btn-edit" title="Adjust Financial Balances"><i class='bx bx-wallet-alt'></i></button>
                            <button class="action-btn btn-delete" title="Restrict Node Authentication"><i class='bx bx-block'></i></button>
                        </div>
                    </td>
                </tr>
            `;

            tableBody.insertAdjacentHTML("afterbegin", newRowHtml);
            const newlyCreatedRow = tableBody.querySelector(".user-data-row");
            bindRowActionListeners(newlyCreatedRow);

            createUserForm.reset();
            modalCreateUser.classList.remove("modal-active");
            currentPage = 1;
            renderPaginationEngine();
        });
    }

    // =========================================================
    // SEARCH & ADVANCED FILTERS INTEGRATION
    // =========================================================
    const kycSelect = document.getElementById("filter-kyc-select");
    const botSelect = document.getElementById("filter-bot-select");
    const btnResetFilters = document.getElementById("btn-reset-filters");

    function runGlobalDataFilters() {
        const filterVal = userSearchInput ? userSearchInput.value.toLowerCase().trim() : "";
        const selectedKyc = kycSelect ? kycSelect.value.toLowerCase() : "all";
        const selectedBot = botSelect ? botSelect.value.toLowerCase() : "all";
        const allRows = tableBody.querySelectorAll(".user-data-row");
        let totalMatches = 0;

        allRows.forEach(row => {
            const textPool = row.textContent.toLowerCase();
            const rowKyc = row.getAttribute("data-kyc").toLowerCase();
            const rowBot = row.getAttribute("data-bot").toLowerCase();

            const matchesSearch = textPool.includes(filterVal);
            const matchesKyc = (selectedKyc === "all") || (rowKyc === selectedKyc);
            let matchesBot = true;
            if (selectedBot === "active") matchesBot = (rowBot !== "none active");
            else if (selectedBot === "inactive") matchesBot = (rowBot === "none active");

            if (matchesSearch && matchesKyc && matchesBot) {
                row.removeAttribute("data-search-hidden");
                totalMatches++;
            } else {
                row.setAttribute("data-search-hidden", "true");
                row.style.display = "none";
            }
        });

        if (tableEmptyRow) tableEmptyRow.style.display = totalMatches === 0 ? "" : "none";
        currentPage = 1;
        renderPaginationEngine();
    }

    if (userSearchInput) userSearchInput.addEventListener("input", runGlobalDataFilters);
    if (kycSelect) kycSelect.addEventListener("change", runGlobalDataFilters);
    if (botSelect) botSelect.addEventListener("change", runGlobalDataFilters);
    if (btnResetFilters) {
        btnResetFilters.addEventListener("click", () => {
            if (kycSelect) kycSelect.value = "all";
            if (botSelect) botSelect.value = "all";
            runGlobalDataFilters();
        });
    }

    // Run pagination calculation immediately upon initial application boot mount
    renderPaginationEngine();
});