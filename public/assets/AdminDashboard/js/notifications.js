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
/**
 * ==========================================================================
 * NEXUIST COMPLIANCE NOTIFICATIONS & AUDIT LEDGER LOGIC ENGINE
 * ==========================================================================
 */

// Comprehensive Mock Data Seed containing all requested fintech categories and variations
let NEXUIST_NOTIF_DATASET = [
    {
        id: "ALR-40192",
        category: "deposit",
        username: "Alexander Mercer",
        uid: "NEX-10942",
        avatar: "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&q=80&w=150",
        title: "New Crypto Inbound Deposit Received",
        message: "Inbound blockchain transfer transaction waiting for processing ledger approvals.",
        timestamp: "Just Now",
        timeGroup: "today",
        status: "Pending",
        meta: { amount: "2.450 BTC", routing: "Bitcoin Network", target: "Internal Escrow Wallet", tracking: "0x7a89bc2d4e5f6102ab3c49" },
        actions: ["approve", "reject"]
    },
    {
        id: "ALR-40185",
        category: "security",
        username: "Amara Kalu",
        uid: "NEX-20481",
        avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=150",
        title: "Suspicious Login Parameters Triggered",
        message: "Security framework flagged login outside typical geolocation ranges with active VPN presence.",
        timestamp: "12 mins ago",
        timeGroup: "today",
        status: "Failed",
        meta: { ipAddress: "185.220.101.4", platform: "Mozilla / Linux x86_64", location: "Frankfurt, Germany (VPN Detected)", riskIndex: "HIGH ALERT" },
        actions: []
    },
    {
        id: "ALR-40171",
        category: "withdrawal",
        username: "Chen Wei",
        uid: "NEX-30194",
        avatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150",
        title: "Large Scale Withdrawal Payout Request",
        message: "User initiated a wallet balance clearance transaction exceeding standard automated compliance tracking caps.",
        timestamp: "2 hours ago",
        timeGroup: "today",
        status: "Pending",
        meta: { amount: "$14,500.00 USD", channel: "USDT-TRC20 Wire", destination: "TYvG8yZpX4fS2u9Kq7NmB1jLwQZhaCEpRx" },
        actions: ["approve", "reject"]
    },
    {
        id: "ALR-40150",
        category: "kyc",
        username: "Elena Rostova",
        uid: "NEX-44921",
        avatar: "https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=150",
        title: "New KYC Verification Submission",
        message: "Investor uploaded international passport files to access tier-2 capital funding loans.",
        timestamp: "5 hours ago",
        timeGroup: "today",
        status: "Pending",
        meta: { document: "International Passport", country: "Germany", expiryCheck: "2032-11-14", riskMatrix: "Clear (0% PEP matches)" },
        actions: ["approve", "reject"]
    },
    {
        id: "ALR-39942",
        category: "investment",
        username: "Liam O'Connor",
        uid: "NEX-51102",
        avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=150",
        title: "Investment Pool Maturity Complete",
        message: "Automated crypto trading portfolio closed cycle successfully. Yield returns credited to account profile balance.",
        timestamp: "Yesterday",
        timeGroup: "week",
        status: "Completed",
        meta: { pool: "AI Trading Bot Alpha", principal: "$5,000.00", netProfit: "+$625.00 (12.5% ROI)", duration: "30 Days Term" },
        actions: []
    },
    {
        id: "ALR-39821",
        category: "message",
        username: "Marcus Vance",
        uid: "NEX-88214",
        avatar: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=150",
        title: "User Complaint Ticket Reply Received",
        message: "Urgent response received regarding internal loan transfer verification delays.",
        timestamp: "2 days ago",
        timeGroup: "week",
        status: "Completed",
        meta: { ticketId: "TKT-8842", category: "Verification Question", messageSnippet: "'I uploaded my documents over 24 hours ago, please expedite...'" },
        actions: []
    },
    {
        id: "ALR-39710",
        category: "log",
        username: "SYSTEM CORE",
        uid: "NEX-00000",
        avatar: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=150",
        title: "CRON Job Automation Success Logs",
        message: "Global interest rate processing distribution loop executed smoothly across active modules.",
        timestamp: "3 days ago",
        timeGroup: "week",
        status: "Completed",
        meta: { task: "Daily Profit Yield Accrual Routing", recordsProcessed: "1,420 accounts", duration: "14.22 seconds", memoryLoad: "42.1 MB" },
        actions: []
    }
];

// Memory variables tracking live filter selections
let activeSelectedCategory = "all";
let viewedUnreadSet = new Set(["ALR-40192", "ALR-40185", "ALR-40171", "ALR-40150"]);

document.addEventListener("DOMContentLoaded", () => {
    executeSystemFeedRefresh();
});

/**
 * Triggers re-calculations of statistics and repaints content rows
 */
function executeSystemFeedRefresh() {
    evaluateMetricCardsCounters();
    renderNotificationAlertStream();
}

/**
 * Parses dataset arrays to evaluate statistics metric counts dynamically
 */
function evaluateMetricCardsCounters() {
    document.getElementById("stat-total").textContent = NEXUIST_NOTIF_DATASET.length;
    document.getElementById("stat-unread").textContent = viewedUnreadSet.size;
    
    let securityAlertsCount = NEXUIST_NOTIF_DATASET.filter(item => item.category === "security").length;
    document.getElementById("stat-security").textContent = securityAlertsCount;
    
    let pendingKycCount = NEXUIST_NOTIF_DATASET.filter(item => item.category === "kyc" && item.status === "Pending").length;
    document.getElementById("stat-kyc").textContent = pendingKycCount;
    
    let newDepositsCount = NEXUIST_NOTIF_DATASET.filter(item => item.category === "deposit" && item.status === "Pending").length;
    document.getElementById("stat-deposits").textContent = newDepositsCount;
}

/**
 * Builds and injects HTML rows based on current search and filter selections
 */
function renderNotificationAlertStream() {
    const targetMount = document.getElementById("notifFeedMountPoint");
    if (!targetMount) return;

    targetMount.innerHTML = "";

    const searchKeyword = document.getElementById("notifGlobalSearch").value.toLowerCase().trim();
    const targetTimeline = document.getElementById("notifTimeFilter").value;
    const targetState = document.getElementById("notifStateFilter").value;

    // Filter array log loops
    let filteredResults = NEXUIST_NOTIF_DATASET.filter(item => {
        // Tab check
        if (activeSelectedCategory !== "all" && item.category !== activeSelectedCategory) return false;
        
        // Timeline check
        if (targetTimeline !== "all" && item.timeGroup !== targetTimeline) return false;
        
        // Status state check
        if (targetState !== "all" && item.status !== targetState) return false;
        
        // Global search string matching
        if (searchKeyword !== "") {
            const matchName = item.username.toLowerCase().includes(searchKeyword);
            const matchUid = item.uid.toLowerCase().includes(searchKeyword);
            const matchId = item.id.toLowerCase().includes(searchKeyword);
            const matchHash = item.meta.tracking ? item.meta.tracking.toLowerCase().includes(searchKeyword) : false;
            
            if (!matchName && !matchUid && !matchId && !matchHash) return false;
        }

        return true;
    });

    // Handle structural empty grid states cleanly
    if (filteredResults.length === 0) {
        targetMount.innerHTML = `
            <div class="feed-empty-panel">
                <i class='bx bx-data-orange text-muted' style="font-size: 3.5rem;"></i>
                <h5>No Match Profiles Discovered</h5>
                <p class="text-secondary small mb-0">Adjust filter settings or keywords to display matched transaction ledger events.</p>
            </div>
        `;
        return;
    }

    // Map rows arrays into displayable rows
    filteredResults.forEach(item => {
        const isUnread = viewedUnreadSet.has(item.id);
        const unreadHighlightClass = isUnread ? "unread-highlight" : "";
        const statusBadgeClass = item.status.toLowerCase();
        
        // Assign categories icon indicators directly from Boxicons
        let catIcon = "bx-bell";
        if (item.category === "deposit") catIcon = "bx-wallet";
        if (item.category === "withdrawal") catIcon = "bx-money-withdraw";
        if (item.category === "kyc") catIcon = "bx-user-check";
        if (item.category === "security") catIcon = "bx-shield-x";
        if (item.category === "investment") catIcon = "bx-line-chart";
        if (item.category === "message") catIcon = "bx-message-square-dots";
        if (item.category === "log") catIcon = "bx-code-block";

        // Build contextual technical data boxes dynamically
        let metaHtmlFields = "";
        Object.entries(item.meta).forEach(([key, val]) => {
            // Reformat string layout keys beautifully (e.g., ipAddress -> IP Address)
            let formattedKey = key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
            metaHtmlFields += `<div class="meta-field-item">${formattedKey}: <strong>${val}</strong></div>`;
        });

        // Build context flow action buttons arrays
        let actionsHtmlRow = "";
        
        if (isUnread) {
            actionsHtmlRow += `
                <button type="button" class="row-action-btn primary-accent" onclick="singleAlertMarkAsRead('${item.id}')">
                    <i class='bx bx-envelope'></i> Mark Read
                </button>
            `;
        }

        if (item.actions.includes("approve")) {
            actionsHtmlRow += `
                <button type="button" class="row-action-btn success-accent" onclick="dispatchComplianceAction('${item.id}', 'Completed')">
                    <i class='bx bx-check-circle'></i> Approve
                </button>
            `;
        }
        if (item.actions.includes("reject")) {
            actionsHtmlRow += `
                <button type="button" class="row-action-btn danger-accent" onclick="dispatchComplianceAction('${item.id}', 'Failed')">
                    <i class='bx bx-x-circle'></i> Reject
                </button>
            `;
        }

        // Add uniform base management controls (Profile inspection and erasure)
        actionsHtmlRow += `
            <button type="button" class="row-action-btn" onclick="inspectUserProfileTarget('${item.uid}')">
                <i class='bx bx-user-voice'></i> Profile
            </button>
            <button type="button" class="row-action-btn danger-accent" onclick="purgeNotificationRow('${item.id}')" title="Delete Notification">
                <i class='bx bx-trash'></i>
            </button>
        `;

        const finalRowTemplate = `
            <div class="notif-alert-row ${unreadHighlightClass}" id="row-target-${item.id}">
                <div class="notif-avatar-frame">
                    <img src="${item.avatar}" class="user-avatar-img') }}" alt="${item.username}">
                    <div class="category-icon-indicator ${item.category}"><i class='bx ${catIcon}'></i></div>
                </div>
                <div class="notif-body-content">
                    <div class="notif-meta-row">
                        <span class="user-title-meta">${item.username} <span class="uid-tag">UID: #${item.uid}</span></span>
                        <div class="time-badge-flex">
                            <span class="timestamp-text">${item.timestamp}</span>
                            <span class="status-pill ${statusBadgeClass}">${item.status}</span>
                        </div>
                    </div>
                    <h5 class="alert-message-text" style="font-weight: 700; color: var(--text-primary); margin-bottom: 2px;">${item.title}</h5>
                    <p class="alert-message-text">${item.message}</p>
                    
                    <div class="meta-data-box">
                        ${metaHtmlFields}
                    </div>
                    
                    <div class="action-buttons-flex">
                        ${actionsHtmlRow}
                    </div>
                </div>
            </div>
        `;
        targetMount.insertAdjacentHTML("beforeend", finalRowTemplate);
    });
}

/**
 * Handles toggling tab focus parameters and shifts category targets
 */
function switchCategoryTab(tabDOMNode) {
    document.querySelectorAll(".category-tab").forEach(tab => tab.classList.remove("active"));
    tabDOMNode.classList.add("active");
    
    activeSelectedCategory = tabDOMNode.getAttribute("data-category");
    renderNotificationAlertStream();
}

/**
 * Evaluates filter values and updates the active list view
 */
function evaluateFeedFilters() {
    renderNotificationAlertStream();
}

/**
 * Clears an alert item's unread badge status pointer
 */
function singleAlertMarkAsRead(alertId) {
    viewedUnreadSet.delete(alertId);
    executeSystemFeedRefresh();
}

/**
 * Clears all current unread status indices simultaneously
 */
function markAllAlertsAsRead() {
    viewedUnreadSet.clear();
    executeSystemFeedRefresh();
}

/**
 * Changes transaction data parameters on administrative approvals/rejections
 */
function dispatchComplianceAction(alertId, targetStateOutcome) {
    let targetedItem = NEXUIST_NOTIF_DATASET.find(item => item.id === alertId);
    if (!targetedItem) return;

    targetedItem.status = targetStateOutcome;
    
    // Remove pending user actions once resolved
    targetedItem.actions = [];
    viewedUnreadSet.delete(alertId);

    executeSystemFeedRefresh();
}

/**
 * Simulates routing to user management sub-pages
 */
function inspectUserProfileTarget(userUid) {
    alert(`System Redirection Action Issued:\nNavigating to deep profile administration files associated with account registration ID: ${userUid}`);
}

/**
 * Clears records directly from the live operational session array
 */
function purgeNotificationRow(alertId) {
    NEXUIST_NOTIF_DATASET = NEXUIST_NOTIF_DATASET.filter(item => item.id !== alertId);
    viewedUnreadSet.delete(alertId);
    executeSystemFeedRefresh();
}