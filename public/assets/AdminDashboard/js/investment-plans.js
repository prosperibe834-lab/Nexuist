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
/* ============================
   NEXUIST ADMIN MODULE JS
============================ */

/* ============================
   MODALS
============================ */

const expertModal = document.getElementById("expertModal");
const planModal = document.getElementById("planModal");
const toast = document.getElementById("toast");

function openExpertModal() {
    expertModal.style.display = "flex";
}

function closeExpertModal() {
    expertModal.style.display = "none";
}

function openPlanModal() {
    planModal.style.display = "flex";
}

function closePlanModal() {
    planModal.style.display = "none";
}

/* ============================
   CLOSE MODAL ON BACKDROP
============================ */

window.addEventListener("click", (e) => {

    if (e.target === expertModal) {
        closeExpertModal();
    }

    if (e.target === planModal) {
        closePlanModal();
    }

});

/* ============================
   TOAST SYSTEM
============================ */

function showToast(message, type = "success") {

    toast.innerText = message;

    if (type === "success") {
        toast.style.background = "#22c55e";
    }

    if (type === "error") {
        toast.style.background = "#ef4444";
    }

    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000);
}

/* ============================
   SAVE EXPERT
============================ */

document.addEventListener("click", function (e) {

    if (e.target.innerText === "Save Expert") {

        showToast("Expert Created Successfully");

        closeExpertModal();
    }

});

/* ============================
   SAVE PLAN
============================ */

document.addEventListener("click", function (e) {

    if (e.target.innerText === "Save Plan") {

        showToast("Investment Plan Created Successfully");

        closePlanModal();
    }

});

/* ============================
   DELETE BUTTONS
============================ */

document.addEventListener("click", function (e) {

    if (e.target.classList.contains("delete")) {

        const confirmDelete = confirm(
            "Are you sure you want to delete this item?"
        );

        if (confirmDelete) {

            const row = e.target.closest("tr");

            if (row) {
                row.remove();
            }

            showToast("Deleted Successfully");
        }

    }

});

/* ============================
   VIEW BUTTON
============================ */

document.addEventListener("click", function (e) {

    if (e.target.classList.contains("view")) {

        alert(
            "Trader Details Modal\n\nThis will open full trader profile, ROI, Followers, Copiers, Risk Level, AUM and Biography."
        );

    }

});

/* ============================
   EDIT BUTTON
============================ */

document.addEventListener("click", function (e) {

    if (e.target.classList.contains("edit")) {

        openExpertModal();

        showToast("Edit Mode Enabled");

    }

});

/* ============================
   LIVE SEARCH
============================ */

const searchInput = document.getElementById("expertSearch");

if (searchInput) {

    searchInput.addEventListener("keyup", function () {

        let value = this.value.toLowerCase();

        let rows = document.querySelectorAll(".admin-table tbody tr");

        rows.forEach(row => {

            let text = row.innerText.toLowerCase();

            if (text.includes(value)) {

                row.style.display = "";

            } else {

                row.style.display = "none";

            }

        });

    });

}

/* ============================
   SORT BY ROI
============================ */

function sortExpertsByROI() {

    let table = document.querySelector(".admin-table tbody");

    let rows = Array.from(table.querySelectorAll("tr"));

    rows.sort((a, b) => {

        let roiA = parseFloat(
            a.children[3].innerText.replace("%", "")
        );

        let roiB = parseFloat(
            b.children[3].innerText.replace("%", "")
        );

        return roiB - roiA;

    });

    rows.forEach(row => table.appendChild(row));
}

/* ============================
   FEATURE EXPERT
============================ */

function featureExpert(button) {

    button.classList.toggle("featured");

    if (button.classList.contains("featured")) {

        button.innerText = "Featured";

        showToast("Expert Added To Featured");

    } else {

        button.innerText = "Feature";

        showToast("Expert Removed From Featured");

    }

}

/* ============================
   ACTIVATE PLAN
============================ */

function activatePlan(button) {

    button.innerText = "Active";

    button.style.background = "#22c55e";

    showToast("Plan Activated");

}

/* ============================
   DEACTIVATE PLAN
============================ */

function deactivatePlan(button) {

    button.innerText = "Inactive";

    button.style.background = "#ef4444";

    showToast("Plan Deactivated");

}

/* ============================
   LOADING SKELETON
============================ */

window.addEventListener("load", () => {

    document.querySelectorAll(".skeleton").forEach(el => {

        el.classList.remove("skeleton");

    });

});

/* ============================
   EXPERT STATS COUNTER
============================ */

document.querySelectorAll(".stat-card span").forEach(counter => {

    let target = parseInt(
        counter.innerText.replace(/[^0-9]/g, "")
    );

    if (!isNaN(target)) {

        let current = 0;

        let increment = target / 60;

        let timer = setInterval(() => {

            current += increment;

            if (current >= target) {

                current = target;

                clearInterval(timer);

            }

            counter.innerText = Math.floor(current);

        }, 20);

    }

});

/* ============================
   FUTURE API PLACEHOLDERS
============================ */

/*

CREATE EXPERT API

fetch('/admin/create-expert')

EDIT EXPERT API

fetch('/admin/edit-expert')

DELETE EXPERT API

fetch('/admin/delete-expert')

CREATE PLAN API

fetch('/admin/create-plan')

LOAD EXPERTS API

fetch('/admin/experts')

LOAD PLANS API

fetch('/admin/plans')

*/

const realEstateModal = document.getElementById("realEstateModal");
const botModal = document.getElementById("botModal");
const signalModal = document.getElementById("signalModal");

function openRealEstateModal() {
    realEstateModal.style.display = "flex";
}

function closeRealEstateModal() {
    realEstateModal.style.display = "none";
}

function openBotModal() {
    botModal.style.display = "flex";
}

function closeBotModal() {
    botModal.style.display = "none";
}

function openSignalModal() {
    signalModal.style.display = "flex";
}

function closeSignalModal() {
    signalModal.style.display = "none";
}

// 







/* ==========================================
   SUBSCRIPTION MODAL
========================================== */

const subscriptionModal =
document.getElementById("subscriptionModal");

function openSubscriptionModal() {

    subscriptionModal.style.display = "flex";

}

function closeSubscriptionModal() {

    subscriptionModal.style.display = "none";

}

/* ==========================================
   APPROVE
========================================== */

document.addEventListener("click", e => {

    if (e.target.classList.contains("approve")) {

        showToast(
            "Investment Approved Successfully"
        );

    }

});

/* ==========================================
   COMPLETE
========================================== */

document.addEventListener("click", e => {

    if (e.target.classList.contains("complete")) {

        showToast(
            "Investment Completed Successfully"
        );

    }

});

/* ==========================================
   DETAILS
========================================== */

document.addEventListener("click", e => {

    if (
        e.target.innerText === "Details"
    ) {

        openSubscriptionModal();

    }

});

/* ==========================================
   BULK ACTIONS
========================================== */

function bulkApprove() {

    showToast(
        "Selected Investments Approved"
    );

}

function bulkComplete() {

    showToast(
        "Selected Investments Completed"
    );

}

function bulkDelete() {

    if (
        confirm(
            "Delete selected investments?"
        )
    ) {

        showToast(
            "Investments Deleted"
        );

    }

}








//

/* ==========================================
   FEATURED PLAN
========================================== */

document.addEventListener("change", e => {

    if (
        e.target.type === "checkbox"
    ) {

        showToast(
            "Plan Updated Successfully"
        );

    }

});

/* ==========================================
   FILTER BUTTON
========================================== */

document.addEventListener("click", e => {

    if (
        e.target.innerText ===
        "Apply Filters"
    ) {

        showToast(
            "Filters Applied"
        );

    }

});

/* ==========================================
   CHART PLACEHOLDER
========================================== */

window.addEventListener(
    "load",
    () => {

        console.log(
            "Charts Ready"
        );

    }
);