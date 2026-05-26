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
/* =========================================
   NEXUIST APEXCHARTS LOAN ENGINE INITIALIZATION
========================================= */
document.addEventListener("DOMContentLoaded", function() {
    var options = {
        series: [{
            name: 'Approved Loans Issued',
            data: [31, 40, 28, 51, 42, 109, 100]
        }, {
            name: 'Recovered Account Settlement Repayments',
            data: [11, 32, 45, 32, 34, 52, 41]
        }],
        chart: {
            height: 280,
            type: 'area',
            background: 'transparent',
            toolbar: { show: false }
        },
        colors: ['#6c63ff', '#00d4ff'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        theme: { mode: 'dark' },
        grid: {
            borderColor: 'rgba(255, 255, 255, 0.05)',
            padding: { left: 10, right: 10 }
        },
        xaxis: {
            categories: ["Nov", "Dec", "Jan", "Feb", "Mar", "Apr", "May"],
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        legend: { position: 'top', horizontalAlign: 'right' }
    };

    var chart = new ApexCharts(document.querySelector("#loanAnalyticsChart"), options);
    chart.render();

    // Initialize Active Live Listeners for Search and Filters
    initTableFilters();
});

/* =========================================
   LIVE LOAN ESTIMATION CALCULATOR FUNCTION
========================================= */
function runLiveCalculator() {
    const amount = parseFloat(document.getElementById('calcAmount').value) || 0;
    const duration = parseFloat(document.getElementById('calcDuration').value) || 1;
    const annualRate = parseFloat(document.getElementById('calcRate').value) || 0;

    const totalInterest = amount * (annualRate / 100) * (duration / 12);
    const totalPayable = amount + totalInterest;
    const monthlyRepayment = totalPayable / duration;

    document.getElementById('resMonthly').innerText = "$" + monthlyRepayment.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    document.getElementById('resInterest').innerText = "$" + totalInterest.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    
    const mockROI = ((totalInterest / amount) * 100 || 0).toFixed(1);
    document.getElementById('resROI').innerText = mockROI + "% System Margin";
}

/* =========================================
   MOCK USER DATA REGISTRY (For Demo/State Management)
========================================= */
const userDatabase = {
    "Alexander Mercer": {
        uid: "#NEX-10942",
        creditScore: "742 (Low Risk)",
        walletBalance: "$84,250.00",
        investments: "$120,400.00",
        income: "$14,200 / mo",
        document: "Passport_ID.pdf",
        riskAlert: "User missed their initial repayment grace path cycle on 2026-05-15. External verification records indicate stable liquidity holdings inside platform crypto system pools."
    },
    "Sophia Kovac": {
        uid: "#NEX-10811",
        creditScore: "815 (Excellent)",
        walletBalance: "$12,940.55",
        investments: "$45,000.00",
        income: "$9,800 / mo",
        document: "EU_Passport.pdf",
        riskAlert: "No active risk metrics flagged. High portfolio health across platform collateral assets."
    }
};

/* =========================================
   INTERACTIVE USER REVIEW DISPATCH SWITCHER
========================================= */
let currentActiveUser = "Alexander Mercer"; // Global tracker for Underwriting actions

function loadUserReview(userName) {
    const userData = userDatabase[userName];
    if (!userData) return;

    currentActiveUser = userName;
    
    // Update visual elements inside the Underwriting Card
    document.getElementById('reviewTargetName').innerText = userName;
    
    const fields = document.querySelectorAll('.data-segment-row .data-item-val');
    fields[0].innerText = userData.creditScore;
    fields[0].style.color = userName === "Sophia Kovac" ? "#10b981" : "#f87171";
    
    fields[1].innerText = userData.walletBalance;
    fields[2].innerText = userData.investments;
    fields[3].innerText = userData.income;
    fields[4].innerHTML = `<i class="bx bx-link-external"></i> ${userData.document}`;
    
    // Update Risk Warning Block
    const riskBlock = document.querySelector('.profile-review-card div[style*="background"]');
    riskBlock.querySelectorAll('div')[1].innerText = userData.riskAlert;
}

/* =========================================
   REAL-TIME SEARCH & FILTER ENGINE LOGIC
========================================= */
function initTableFilters() {
    const searchInput = document.querySelector('.search-box input');
    const statusSelect = document.querySelector('.filter-select'); // Targets first select dropdown

    function filterTable() {
        const searchText = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusSelect.value.toLowerCase();
        const tableRows = document.querySelectorAll('.nexuist-table tbody tr');

        tableRows.forEach(row => {
            const userName = row.querySelector('.user-meta-cell style, div > div:first-child').innerText.toLowerCase();
            const uid = row.querySelector('.user-uid-tag').innerText.toLowerCase();
            const statusBadge = row.querySelector('.badge').innerText.toLowerCase();

            // Match Logic conditions
            const matchesSearch = userName.includes(searchText) || uid.includes(searchText);
            const matchesStatus = selectedStatus === "" || statusBadge.includes(selectedStatus);

            if (matchesSearch && matchesStatus) {
                row.style.display = ""; // Show row
            } else {
                row.style.display = "none"; // Hide row
            }
        });
    }

    // Attach Event Listeners
    searchInput.addEventListener('input', filterTable);
    statusSelect.addEventListener('change', filterTable);
}

/* =========================================
   ADMINISTRATIVE CONTROL WORKFLOW ACTIONS
========================================= */
// 1. Inline Quick Table Actions
function updateRowStatus(buttonElement, targetStatus) {
    const row = buttonElement.closest('tr');
    const badgeContainer = row.querySelector('td .badge');
    
    // Reset classes and apply new layout cleanly
    badgeContainer.className = `badge badge-${targetStatus}`;
    
    if (targetStatus === 'approved') {
        badgeContainer.innerHTML = `<i class="bx bx-check-circle"></i> Approved`;
    } else if (targetStatus === 'rejected') {
        badgeContainer.innerHTML = `<i class="bx bx-x-circle"></i> Rejected`;
    } else if (targetStatus === 'paid') {
        badgeContainer.innerHTML = `<i class="bx bx-badge-check"></i> Paid`;
    }
}

// Bind click events explicitly for demo security/feedback
document.querySelectorAll('.nexuist-table tbody tr').forEach(row => {
    const approveBtn = row.querySelector('.btn-approve');
    const rejectBtn = row.querySelector('.btn-reject');

    if (approveBtn) {
        approveBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            // Context logic: If row is overdue, let's treat it as "Mark Paid", otherwise approve it
            const isOverdue = row.querySelector('.badge').classList.contains('badge-overdue');
            updateRowStatus(this, isOverdue ? 'paid' : 'approved');
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            updateRowStatus(this, 'rejected');
        });
    }
});

// 2. Underwriting Main Deck Action Buttons
document.querySelectorAll('.profile-review-card .nexuist-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const actionText = this.innerText.trim();
        
        // Find matching table row for current user context
        const rows = document.querySelectorAll('.nexuist-table tbody tr');
        let targetRow = null;
        rows.forEach(r => {
            if(r.querySelector('.user-meta-cell div > div:first-child').innerText === currentActiveUser) {
                targetRow = r;
            }
        });

        if (!targetRow) return;

        if (actionText.includes("Authorize / Approve")) {
            const badge = targetRow.querySelector('.badge');
            badge.className = "badge badge-approved";
            badge.innerHTML = `<i class="bx bx-check-circle"></i> Approved`;
            alert(`Loan configuration authorized successfully for ${currentActiveUser}.`);
        } 
        else if (actionText.includes("Terminate / Reject")) {
            const badge = targetRow.querySelector('.badge');
            badge.className = "badge badge-rejected";
            badge.innerHTML = `<i class="bx bx-x-circle"></i> Rejected`;
            alert(`Loan access configuration suspended/rejected for ${currentActiveUser}.`);
        }
        else if (actionText.includes("Term Ext.")) {
            alert(`Grace extension period initialized for ${currentActiveUser}. Modifying Cron parameters.`);
        }
    });
});
