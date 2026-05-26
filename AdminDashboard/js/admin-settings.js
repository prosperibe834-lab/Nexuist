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
// NEXUIST RISK CORE - ACCESS MATRIX FUNCTIONAL ENGINE PIPELINE
// =========================================================================

document.addEventListener("DOMContentLoaded", function () {
    
    const provisionAdminForm = document.getElementById("provision-admin-form");
    const newAdminInputHandle = document.getElementById("new-admin-user");
    const newAdminSelectRole = document.getElementById("new-admin-role");
    const registryLogTargetTbody = document.getElementById("registry-log-target-tbody");
    const adminTotalCounterBadge = document.getElementById("admin-total-badge");

    if (provisionAdminForm) {
        provisionAdminForm.addEventListener("submit", function (event) {
            event.preventDefault(); 

            const handleValueClean = newAdminInputHandle.value.trim();
            const chosenRoleScope = newAdminSelectRole.value;

            if (handleValueClean === "" || !chosenRoleScope) {
                alert("[PROVISION ERROR] Enter an administrative node identity handle name and select an operational jurisdiction level.");
                return;
            }

            const submitButtonNode = document.getElementById("btn-create-admin");
            const baselineBtnHtmlBackup = submitButtonNode.innerHTML;

            submitButtonNode.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Synthesizing Token...";
            submitButtonNode.style.pointerEvents = "none";

            setTimeout(() => {
                const clockObj = new Date();
                const logTimeString = `0${clockObj.getHours()}`.slice(-2) + ":" + 
                                      `0${clockObj.getMinutes()}`.slice(-2) + ":" + 
                                      `0${clockObj.getSeconds()}`.slice(-2);
                
                const randomIpNodeSeed = `192.168.${Math.floor(Math.random() * 254) + 1}.${Math.floor(Math.random() * 254) + 1}`;
                
                let computedRoleCssClassPill = "pill-support";
                if (chosenRoleScope === "Superuser") computedRoleCssClassPill = "pill-super";
                if (chosenRoleScope === "Compliance Auditor") computedRoleCssClassPill = "pill-compliance";

                const newlyGeneratedRowNode = document.createElement("tr");
                newlyGeneratedRowNode.className = "new-row-entry-flash"; 
                
                newlyGeneratedRowNode.innerHTML = `
                    <td><span class="admin-handle-cell"><i class='bx bx-user-circle'></i> ${handleValueClean}</span></td>
                    <td><span class="role-pill ${computedRoleCssClassPill}">${chosenRoleScope}</span></td>
                    <td class="font-mono">${randomIpNodeSeed}</td>
                    <td>Provisioned credentials token node & initialized isolated system ring profile.</td>
                    <td class="text-muted">${logTimeString}</td>
                `;

                if (registryLogTargetTbody) {
                    registryLogTargetTbody.insertBefore(newlyGeneratedRowNode, registryLogTargetTbody.firstChild);
                }

                if (adminTotalCounterBadge) {
                    let currentNumericalAdminTotal = parseInt(adminTotalCounterBadge.innerText);
                    adminTotalCounterBadge.innerText = currentNumericalAdminTotal + 1;
                }

                alert(`[INJECTION SUCCESSFUL] Privilege Token Node allocated safely for handle: ${handleValueClean}. Configuration records successfully synchronized.`);
                
                provisionAdminForm.reset();
                submitButtonNode.innerHTML = baselineBtnHtmlBackup;
                submitButtonNode.style.pointerEvents = "auto";
            }, 1200); 
        });
    }
});