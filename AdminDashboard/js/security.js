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
// NEXUIST RISK FRAMEWORK - SECURITY & COMPLIANCE SUBSYSTEM LOGIC ENGINE
// =========================================================================

document.addEventListener("DOMContentLoaded", function () {
    
    // --- 1. MOCK DATA STREAM RUNTIME INTERVAL VALUES ---
    const fraudBlockHeading = document.getElementById("counter-fraud-blocks");
    const liveLogScrollerContainer = document.getElementById("live-log-scroller");
    const globalThreatPillBadge = document.getElementById("global-threat-pill");
    const threatStatusTextSpan = document.getElementById("threat-status-text");

    // Array list containing pseudo live network anomalies to populate logs container asynchronously
    const mockThreatLogsBank = [
        { tag: "AUTH", type: "tag-auth", msg: "API token request generated for system core worker pipeline validation link verification context." },
        { tag: "BLOCKED", type: "tag-block", msg: "Outbound asset transfer validation blocked: Transaction request value exceeds current user KYC Tier maximum parameters limit balance." },
        { tag: "SYS", type: "tag-info", msg: "Secured SSH node configuration session updated internally via localized cron task cluster." },
        { tag: "BLOCKED", type: "tag-block", msg: "Cross-Site Scripting (XSS) code payload signature dropped instantly inside transaction-tbody search filtering bar request field." },
        { tag: "KYC", type: "tag-kyc", msg: "Audit trail record: Identity verification logs pulled for account identification UID handle #NEX-10811." }
    ];

    // Stream new system log occurrences dynamically into the terminal terminal frame layout window
    if (liveLogScrollerContainer) {
        setInterval(() => {
            // Select a random event item vector from data bank
            const targetLogObject = mockThreatLogsBank[Math.floor(Math.random() * mockThreatLogsBank.length)];
            const timeObj = new Date();
            const timeStampString = `[${timeObj.toTimeString().split(' ')[0]}]`;

            // Build structural entry elements markup
            const newLogEntryNode = document.createElement("div");
            newLogEntryNode.className = "log-entry";
            if (targetLogObject.tag === "BLOCKED") newLogEntryNode.className += " intercept-alert";

            newLogEntryNode.innerHTML = `
                <span class="log-time">${timeStampString}</span>
                <span class="log-tag ${targetLogObject.type}">[${targetLogObject.tag}]</span>
                <p class="log-msg">${targetLogObject.msg}</p>
            `;

            // Append row and force layout scroller to jump forward down to reveal entries instantly
            liveLogScrollerContainer.appendChild(newLogEntryNode);
            liveLogScrollerContainer.scrollTop = liveLogScrollerContainer.scrollHeight;

            // Increment matching dashboard overview data statistics counts automatically inside view
            if (targetLogObject.tag === "BLOCKED" && fraudBlockHeading) {
                let currentTotalInteger = parseInt(fraudBlockHeading.innerText);
                fraudBlockHeading.innerText = currentTotalInteger + 1;
            }
        }, 12000); // Feed data every 12 seconds
    }

    // --- 2. INTERACTIVE COMPLIANCE FORM CONTROLS MANAGEMENT ---
    const securityConfigurationFormNode = document.getElementById("security-configuration-form");
    const failedLoginInputField = document.getElementById("param-login-limits");
    const systemSessionInputField = document.getElementById("param-session-timeout");

    if (securityConfigurationFormNode) {
        securityConfigurationFormNode.addEventListener("submit", function (event) {
            event.preventDefault(); // Halt standard server callback refreshes

            let validationIncidentFlag = false;

            // Simple validation metric boundaries constraints configuration logic checking
            if (parseInt(failedLoginInputField.value) < 1 || failedLoginInputField.value === "") {
                failedLoginInputField.classList.add("input-violation");
                validationIncidentFlag = true;
            } else {
                failedLoginInputField.classList.remove("input-violation");
            }

            if (parseInt(systemSessionInputField.value) < 60 || systemSessionInputField.value === "") {
                systemSessionInputField.classList.add("input-violation");
                validationIncidentFlag = true;
            } else {
                systemSessionInputField.classList.remove("input-violation");
            }

            if (validationIncidentFlag) {
                alert("[NEXUIST ARCHITECTURE REJECTION] Structural variable constraints violation detected. Review inputs highlighted in deep red color outlines.");
                return;
            }

            // Target the interactive button block matrix representation state to indicate active save transitions
            const submitButtonNode = document.getElementById("btn-save-security");
            const structuralOriginalButtonMarkup = submitButtonNode.innerHTML;

            submitButtonNode.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Encrypting Profiles...";
            submitButtonNode.style.pointerEvents = "none";

            setTimeout(() => {
                submitButtonNode.innerHTML = "<i class='bx bx-shield-quarter'></i> Policies Committed";
                alert("[SECURITY CONTROL SUCCESS] Core encryption metrics and anti-fraud parameter records synced securely to platform configuration databases schema blocks.");
                
                // Inject configuration change confirmation notice right straight into the live text area terminal log view
                const saveTimestamp = new Date().toTimeString().split(' ')[0];
                const notificationLogNode = document.createElement("div");
                notificationLogNode.className = "log-entry system-alert";
                notificationLogNode.innerHTML = `
                    <span class="log-time">[${saveTimestamp}]</span>
                    <span class="log-tag tag-info">[SYS]</span>
                    <p class="log-msg"><strong class="text-white">System Security Level Matrix Updated:</strong> Administrative policy changes applied system-wide instantly.</p>
                `;
                if (liveLogScrollerContainer) {
                    liveLogScrollerContainer.appendChild(notificationLogNode);
                    liveLogScrollerContainer.scrollTop = liveLogScrollerContainer.scrollHeight;
                }

                setTimeout(() => {
                    submitButtonNode.innerHTML = structuralOriginalButtonMarkup;
                    submitButtonNode.style.pointerEvents = "auto";
                }, 1500);
            }, 1400);
        });
    }

    // --- 3. FIELD FORM RESET TRIGGER CONTROLLER HUB ---
    const resetFormFieldsButton = document.getElementById("btn-reset-security");
    if (resetFormFieldsButton && securityConfigurationFormNode) {
        resetFormFieldsButton.addEventListener("click", function () {
            if (confirm("[CONFIRMATION WARNING] Restore protection fields and parameters inputs back to standard platform baseline configurations defaults?")) {
                securityConfigurationFormNode.reset();
                
                // Clear any leftover validation red borders context logs indicators
                failedLoginInputField.classList.remove("input-violation");
                systemSessionInputField.classList.remove("input-violation");
                
                // Reset custom interactive tracking widgets values states if necessary
                document.getElementById("param-2fa-toggle").checked = true;
                document.getElementById("param-fraud-toggle").checked = true;
            }
        });
    }

    // --- 4. ANTI-FRAUD SWITCH HOOK FOR GLOBAL HEADER BADGES ---
    const realTimeFraudSwitchToggle = document.getElementById("param-fraud-toggle");
    if (realTimeFraudSwitchToggle && globalThreatPillBadge && threatStatusTextSpan) {
        realTimeFraudSwitchToggle.addEventListener("change", function () {
            if (!this.checked) {
                // Warning status update alert shifts triggered
                globalThreatPillBadge.classList.add("compromised-threat-state");
                threatStatusTextSpan.innerText = "Shield Status: Behavioral Analytics Offline";
                
                const toggleDisableTime = new Date().toTimeString().split(' ')[0];
                const warningLogLine = document.createElement("div");
                warningLogLine.className = "log-entry intercept-alert";
                warningLogLine.innerHTML = `
                    <span class="log-time">[${toggleDisableTime}]</span>
                    <span class="log-tag tag-block">[CRITICAL]</span>
                    <p class="log-msg">Automated AI Risk classification protection node thread deactivated manually by administrator credentials session log token.</p>
                `;
                if (liveLogScrollerContainer) {
                    liveLogScrollerContainer.appendChild(warningLogLine);
                    liveLogScrollerContainer.scrollTop = liveLogScrollerContainer.scrollHeight;
                }
            } else {
                // Secure status restored normalization updates loops
                globalThreatPillBadge.classList.remove("compromised-threat-state");
                threatStatusTextSpan.innerText = "Shield Status: Enforced & Threat-Free";
            }
        });
    }
});