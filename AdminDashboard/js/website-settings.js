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

document.addEventListener("DOMContentLoaded", function () {
    
    // --- 1. HORIZONTAL & VERTICAL NAVIGATION TAB ENGINE ---
    const tabButtons = document.querySelectorAll(".nav-tab-btn");
    const settingsPanels = document.querySelectorAll(".settings-panel");

    tabButtons.forEach(button => {
        button.addEventListener("click", function () {
            const targetPanelId = this.getAttribute("data-target");

            // Toggle Tab States
            tabButtons.forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");

            // Toggle Target Viewports
            settingsPanels.forEach(panel => {
                panel.classList.remove("active");
                if (panel.getAttribute("id") === targetPanelId) {
                    panel.classList.add("active");
                }
            });
        });
    });

    // --- 2. MULTI-NODE IMAGE UPLOAD LIVE GRAPHICS PREVIEW PIPELINE ---
    function initializeImagePreview(inputId, previewId) {
        const fileInput = document.getElementById(inputId);
        const previewImg = document.getElementById(previewId);

        if (!fileInput || !previewImg) return;

        fileInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove("hidden");
                    
                    // Hide the dropzone text label icons overlay if present
                    const dropzone = fileInput.closest('.upload-dropzone');
                    if (dropzone) {
                        const placeholder = dropzone.querySelector('.upload-placeholder');
                        if (placeholder) placeholder.style.opacity = "0";
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    initializeImagePreview("upload-logo", "preview-logo");
    initializeImagePreview("upload-favicon", "preview-favicon");
    initializeImagePreview("upload-banner", "preview-banner");

    // --- 3. HARD RECOVERY CORE MAINTENANCE SWITCH HUB ---
    const maintenanceToggle = document.getElementById("cfg-maintenance-toggle");
    const maintenanceLabel = document.getElementById("lbl-maintenance-state");
    const globalStatusPill = document.getElementById("global-status-pill");
    const statusText = document.getElementById("status-text");

    if (maintenanceToggle && maintenanceLabel) {
        maintenanceToggle.addEventListener("change", function () {
            if (this.checked) {
                maintenanceLabel.innerText = "WARNING: ENFORCED - Public App Endpoints Locked Out";
                maintenanceLabel.style.color = "#ef4444";
                
                // Shift Global Cluster Indicators
                if (globalStatusPill) {
                    globalStatusPill.classList.add("alert-triggered");
                    statusText.innerText = "Platform Status: Maintenance Lockdown";
                }
            } else {
                maintenanceLabel.innerText = "DEACTIVATED - Public Endpoints Fully Accessible";
                maintenanceLabel.style.color = "#f59e0b";
                
                if (globalStatusPill) {
                    globalStatusPill.classList.remove("alert-triggered");
                    statusText.innerText = "Platform Status: Live & Secure";
                }
            }
        });
    }

    // --- 4. DATA MATRIX INTELLIGENT SEARCH FILTER ENGAGEMENT ---
    const settingsSearchInput = document.getElementById("settings-search");
    
    if (settingsSearchInput) {
        settingsSearchInput.addEventListener("input", function () {
            const searchQuery = this.value.toLowerCase().trim();
            const formGroups = document.querySelectorAll(".settings-panel .form-group");

            formGroups.forEach(group => {
                const labelElement = group.querySelector("label");
                if (!labelElement) return;

                const textContent = labelElement.innerText.toLowerCase();
                
                if (searchQuery === "") {
                    group.style.display = "flex"; // Restore layout structure state
                } else if (textContent.includes(searchQuery)) {
                    group.style.display = "flex";
                    // Enforce structural visibility on the parent module frame layout container wrapper 
                    const parentPanel = group.closest(".settings-panel");
                    if (parentPanel && !parentPanel.classList.contains("active")) {
                        const panelId = parentPanel.getAttribute("id");
                        document.querySelector(`[data-target="${panelId}"]`).click();
                    }
                } else {
                    group.style.display = "none";
                }
            });
        });
    }

    // --- 5. REAL-TIME INPUT BOUNDARY & DATA VALIDATION PIPELINE ---
    const emailFields = document.querySelectorAll(".validate-email");
    
    emailFields.forEach(field => {
        field.addEventListener("blur", function () {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(this.value)) {
                this.classList.add("input-error-state");
            } else {
                this.classList.remove("input-error-state");
            }
        });
    });

    // --- 6. USER PRIVILEGE PROVISION INJECTION ENGINE MOCK ---
    const createAdminBtn = document.getElementById("btn-create-admin");
    if (createAdminBtn) {
        createAdminBtn.addEventListener("click", function () {
            const usernameInput = document.getElementById("new-admin-user");
            const roleSelect = document.getElementById("new-admin-role");

            if (!usernameInput || usernameInput.value.trim() === "") {
                alert("[NEXUIST SECURITY SYSTEM] The identity handle string name cannot be blank.");
                if (usernameInput) usernameInput.classList.add("input-error-state");
                return;
            }
            usernameInput.classList.remove("input-error-state");

            const tbody = document.querySelector(".audit-log-table tbody");
            const newRow = document.createElement("tr");

            const timestamp = new Date().toISOString().replace('T', ' ').substring(0, 19);
            const roleClass = roleSelect.value === "super" ? "badge-super" : "badge-audit";
            const roleLabel = roleSelect.options[roleSelect.selectedIndex].text.split(" ")[0];

            newRow.innerHTML = `
                <td><strong style="color:var(--text-primary)">${usernameInput.value}</strong></td>
                <td><span class="badge ${roleClass}">${roleLabel}</span></td>
                <td class="font-mono">127.0.0.1 (Local Node)</td>
                <td>Generated New Secure Privilege Token Array Vector Record</td>
                <td>${timestamp}</td>
            `;

            if (tbody) {
                tbody.insertBefore(newRow, tbody.firstChild);
                alert(`[SUCCESS] Privileged profile registry token provisioned for ${usernameInput.value}.`);
                usernameInput.value = ""; // Flush field data inputs
            }
        });
    }

    // --- 7. CONFIGURATION JSON SERIALIZATION EXPORT CONTROLLER ---
    const exportConfigBtn = document.getElementById("btn-export-config");
    if (exportConfigBtn) {
        exportConfigBtn.addEventListener("click", function () {
            const systemConfigurationState = {
                platformBrandingName: document.getElementById("cfg-site-name")?.value || "Nexuist Platform",
                supportDestinationEmail: document.getElementById("cfg-support-email")?.value || "",
                systemActiveCurrencyToken: document.getElementById("cfg-currency")?.value || "USD",
                bitcoinTargetLiquidityNode: document.getElementById("cfg-btc-wallet")?.value || "",
                enforcedDualAuthenticationFactor: document.getElementById("cfg-2fa-toggle")?.checked || false,
                automatedFraudShieldActive: document.getElementById("cfg-fraud-toggle")?.checked || false,
                globalQuantitativeTradingBotState: document.getElementById("cfg-bot-toggle")?.checked || false,
                activeEmergencyMaintenanceLockout: document.getElementById("cfg-maintenance-toggle")?.checked || false,
                exportCompilationClockTimestamp: new Date().toLocaleString()
            };

            const dataBlobStream = new Blob([JSON.stringify(systemConfigurationState, null, 4)], { type: "application/json" });
            const temporaryAnchorElement = document.createElement("a");
            
            temporaryAnchorElement.href = URL.createObjectURL(dataBlobStream);
            temporaryAnchorElement.download = `nexuist_core_config_registry_${Date.now()}.json`;
            document.body.appendChild(temporaryAnchorElement);
            temporaryAnchorElement.click();
            document.body.removeChild(temporaryAnchorElement);
        });
    }

    // --- 8. CENTRAL MASTER COMPILATION SAVE TRIGGER EVENT ---
    const saveMasterBtn = document.getElementById("btn-save-master");
    if (saveMasterBtn) {
        saveMasterBtn.addEventListener("click", function () {
            // Check for processing entry blocks in validation error states prior to writing changes
            const errorDetections = document.querySelectorAll(".input-error-state");
            if (errorDetections.length > 0) {
                alert("[NEXUIST ARCHITECTURE ERROR] Unable to compile configuration state arrays. Rectify invalid form fields highlighted in red.");
                return;
            }

            // Simulate server network serialization callback latency block
            saveMasterBtn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Syncing Matrix...";
            saveMasterBtn.style.pointerEvents = "none";

            setTimeout(() => {
                saveMasterBtn.innerHTML = "<i class='bx bx-check-circle'></i> Settings Saved";
                alert("[SUCCESS SYSTEM MESSAGE] Core configuration profiles committed safely to MySQL ledger schema blocks successfully.");
                
                setTimeout(() => {
                    saveMasterBtn.innerHTML = "<i class='bx bx-save'></i> Save Changes";
                    saveMasterBtn.style.pointerEvents = "auto";
                }, 1500);
            }, 1200);
        });
    }
});