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
document.addEventListener("DOMContentLoaded", function() {
    // Collect all dynamic text components 
    const dynName = document.getElementById("dyn-kyc-name");
    const dynNat = document.getElementById("dyn-kyc-nat");
    const dynEmail = document.getElementById("dyn-kyc-email");
    const dynRisk = document.getElementById("dyn-kyc-risk");
    const dynExpiry = document.getElementById("dyn-kyc-expiry");
    const dynPep = document.getElementById("dyn-kyc-pep");
    const dynFname = document.getElementById("dyn-kyc-fname");
    const dynLname = document.getElementById("dyn-kyc-lname");
    const dynDob = document.getElementById("dyn-kyc-dob");
    const dynDocId = document.getElementById("dyn-kyc-docid");
    const dynAddress = document.getElementById("dyn-kyc-address");
    const dynDocName = document.getElementById("dyn-kyc-docname");
    const dynDocSize = document.getElementById("dyn-kyc-docsize");
    const dynDocImg = document.getElementById("dyn-kyc-doc-img");

    // Profile Click Switch Engine Logic
    const cards = document.querySelectorAll(".nx-kyc-user-card");
    cards.forEach(card => {
        card.addEventListener("click", function() {
            // Remove active classes everywhere else
            cards.forEach(c => c.classList.remove("active-kyc-node"));
            // Set current node to active
            this.classList.add("active-kyc-node");

            // Extract values from clicked target's data attributes
            dynName.innerText = this.getAttribute("data-name");
            dynNat.innerText = this.getAttribute("data-nationality");
            dynEmail.innerText = this.getAttribute("data-email");
            dynExpiry.innerText = this.getAttribute("data-expiry");
            dynFname.innerText = this.getAttribute("data-fname");
            dynLname.innerText = this.getAttribute("data-lname");
            dynDob.innerText = this.getAttribute("data-dob");
            dynDocId.innerText = this.getAttribute("data-docid");
            dynAddress.innerText = this.getAttribute("data-address");
            dynDocName.innerText = this.getAttribute("data-docname");
            dynDocSize.innerText = this.getAttribute("data-docsize");
            
            // Swap abstract document matrix textures smoothly
            dynDocImg.src = this.getAttribute("data-img");

            // Handle Risk Element Styling Modifiers
            dynRisk.innerText = this.getAttribute("data-risk");
            dynRisk.className = ""; // clear old rules
            dynRisk.classList.add(this.getAttribute("data-risk-class"));

            // Handle PEP Element Styling Modifiers
            dynPep.innerText = this.getAttribute("data-pep");
            dynPep.className = ""; 
            dynPep.classList.add(this.getAttribute("data-pep-class"));
        });
    });

    // Filtering & Searching Module
    const searchInput = document.getElementById("kyc-user-search");
    searchInput.addEventListener("input", function() {
        const value = this.value.toLowerCase().trim();
        cards.forEach(card => {
            const name = card.getAttribute("data-name").toLowerCase();
            const uid = card.getAttribute("data-uid").toLowerCase();
            if(name.includes(value) || uid.includes(value)) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    });

    // Action Trigger Dialog Alerts
    document.getElementById("btn-kyc-reject").addEventListener("click", function() {
        alert("Compliance Action: Triggering file rejection notice pipeline for " + dynName.innerText + ". An automated revision email has been structured.");
    });

    document.getElementById("btn-kyc-approve").addEventListener("click", function() {
        alert("Success: Credentials approved. Access parameters granted inside vault clearance logs for " + dynName.innerText + ".");
    });

    document.getElementById("btn-kyc-fullscreen").addEventListener("click", function() {
        alert("Opening Secure Viewer: Displaying raw resolution layout of " + dynDocName.innerText);
    });

    document.getElementById("btn-kyc-download").addEventListener("click", function() {
        alert("Audit Log: Downloading high-resolution encrypted asset package (" + dynDocName.innerText + ") to local administration hardware storage.");
    });
});