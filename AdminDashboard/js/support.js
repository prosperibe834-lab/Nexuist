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
   NEXUIST CUSTOMER SUPPORT DESK LOGIC CORE
========================================= */

// Local Database Record Mock for Case File Data Management
const supportTicketDatabase = {
    "TCK-9902": {
        username: "Marcus Vance",
        uid: "#NEX-88219",
        restrictionStatus: "Active (Unrestricted)",
        collateral: "$14,850.00",
        txReference: "TXN-902188412-NEX",
        complaint: "I initiated an external USDT deposit of $5,000 via the TRC-20 network over 4 hours ago. The blockchain transaction status shows as successful, but my main Nexuist dashboard balance hasn't updated. Please check the transaction log.",
        documentName: "blockchain_receipt_screenshot.png",
        history: [
            { text: "Hello, I really need help with my deposit issue. It has been outstanding for hours and my trading bot is paused.", type: "user", time: "15:32 PM" },
            { text: "Welcome to Nexuist Support Desk. I am tracking your TRC-20 transaction payload right now. Please hold on while we sync with the local node infrastructure.", type: "admin", time: "15:35 PM" }
        ]
    },
    "TCK-9841": {
        username: "Elena Rostova",
        uid: "#NEX-41029",
        restrictionStatus: "Review Pending",
        collateral: "$65,000.00",
        txReference: "LOAN-EXT-40291",
        complaint: "My line of credit repayment parameters specify a 30-day grace modification window under catastrophic market events. My portfolio was impacted by the weekend pool slippage, and I need an extra 14 days manual confirmation.",
        documentName: "Slippage_Proof_Report.pdf",
        history: [
            { text: "System flagged an extension reject notice automatically. Please verify my active margin collateral logs.", type: "user", time: "Yesterday" }
        ]
    }
};

let activeSelectedTicketId = "TCK-9902"; // Tracking focus variable

document.addEventListener("DOMContentLoaded", function() {
    initSearchAndFilterSystem();
    initChatTransmissionHub();
});

/* ===== CASE INTERACTIVE DATA SELECTION SWITCHER ===== */
function selectTicket(ticketId) {
    const targetData = supportTicketDatabase[ticketId];
    if (!targetData) return;

    activeSelectedTicketId = ticketId;

    // Synchronize Left Panel Case Deck Visual Layouts
    document.getElementById('deck-username').innerText = targetData.username;
    
    const statusField = document.getElementById('deck-status');
    statusField.innerText = targetData.restrictionStatus;
    statusField.className = targetData.restrictionStatus.includes("Active") ? "detail-value text-success" : "detail-value color-warning";
    
    // Update internal fields safely
    document.querySelector('.deck-account-details .details-row-grid:last-of-type div:first-child .detail-value').innerText = targetData.collateral;
    document.querySelector('.deck-account-details .details-row-grid:last-of-type div:last-child .detail-value').innerText = targetData.txReference;
    
    document.getElementById('deck-complaint').innerText = targetData.complaint;
    document.querySelector('.attachment-preview-box span').innerText = targetData.documentName;

    // Synchronize Right Panel Chat stream view components
    document.getElementById('chat-header-title').innerText = `Live Chat Stream: ${ticketId}`;
    
    const messageStreamWindow = document.getElementById('chatMessageStream');
    messageStreamWindow.innerHTML = ""; // Wipe older view frame references cleanly

    targetData.history.forEach(msg => {
        appendMessageToStreamView(msg.text, msg.type, msg.time);
    });
    
    scrollChatStreamToBottom();
}

/* ===== REAL-TIME SELECTION FILTER CONSOLE INTERFACES ===== */
function initSearchAndFilterSystem() {
    const searchInput = document.getElementById('ticketSearch');
    const statusSelect = document.getElementById('statusFilter');
    const categorySelect = document.getElementById('categoryFilter');
    const prioritySelect = document.getElementById('priorityFilter');

    function applyFilters() {
        const query = searchInput.value.toLowerCase().trim();
        const filterStatus = statusSelect.value.toLowerCase();
        const filterCategory = categorySelect.value.toLowerCase();
        const filterPriority = prioritySelect.value.toLowerCase();

        const tableRows = document.querySelectorAll('#ticketTableBody tr');

        tableRows.forEach(row => {
            const userName = row.getAttribute('data-user').toLowerCase();
            const uid = row.getAttribute('data-uid').toLowerCase();
            const ticketId = row.querySelector('.ticket-id-tag').innerText.toLowerCase();
            
            const subjectText = row.querySelector('.ticket-subject-text').innerText.toLowerCase();
            const catText = row.querySelector('.ticket-cat-sub').innerText.toLowerCase();
            
            const priorityText = row.querySelector('.priority-badge').innerText.toLowerCase();
            const statusText = row.querySelector('.status-badge').innerText.toLowerCase();

            // Match checks
            const matchesQuery = userName.includes(query) || uid.includes(query) || ticketId.includes(query) || subjectText.includes(query);
            const matchesStatus = filterStatus === "" || statusText === filterStatus;
            const matchesCategory = filterCategory === "" || catText === filterCategory;
            const matchesPriority = filterPriority === "" || priorityText === filterPriority;

            if (matchesQuery && matchesStatus && matchesCategory && matchesPriority) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchInput.addEventListener('input', applyFilters);
    statusSelect.addEventListener('change', applyFilters);
    categorySelect.addEventListener('change', applyFilters);
    prioritySelect.addEventListener('change', applyFilters);
}

/* ===== MESSAGE TRANSMISSION STREAM MANAGEMENT MODULES ===== */
function initChatTransmissionHub() {
    const sendButton = document.getElementById('chatSendButton');
    const inputField = document.getElementById('chatInputField');

    function processMessageSend() {
        const text = inputField.value.trim();
        if (text === "") return;

        const timeString = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        // Save entry internally to database cache registry configuration profile object
        if (supportTicketDatabase[activeSelectedTicketId]) {
            supportTicketDatabase[activeSelectedTicketId].history.push({
                text: text,
                type: "admin",
                time: timeString
            });
        }

        // Output to active user stream window frame layout view panel
        appendMessageToStreamView(text, "admin", timeString + " \u2022 Seen");
        inputField.value = "";
        scrollChatStreamToBottom();
    }

    sendButton.addEventListener('click', processMessageSend);
    inputField.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') processMessageSend();
    });
}

function appendMessageToStreamView(text, type, timeString) {
    const stream = document.getElementById('chatMessageStream');
    const bubbleRow = document.createElement('div');
    bubbleRow.className = `chat-bubble-row ${type}-bubble`;

    // Dynamic badge template configurations
    const checkIcon = type === 'admin' ? '<i class="bx bx-check-double"></i>' : '<i class="bx bx-check-double text-secondary"></i>';

    bubbleRow.innerHTML = `
        <div class="bubble-content-text">
            ${text}
            <div class="bubble-timestamp-meta">${timeString} ${type === 'admin' ? checkIcon : ''}</div>
        </div>
    `;
    stream.appendChild(bubbleRow);
}

function scrollChatStreamToBottom() {
    const stream = document.getElementById('chatMessageStream');
    stream.scrollTop = stream.scrollHeight;
}

/* ===== ADMINISTRATIVE OPERATIONAL ACCESS CONTROL ACTION DISPATCHERS ===== */
function modifyActiveTicketStatus(targetStatusLabel) {
    // Locate the dynamic table row reference target matrix match safely
    const rows = document.querySelectorAll('#ticketTableBody tr');
    rows.forEach(row => {
        const rowTicketId = row.querySelector('.ticket-id-tag').innerText;
        if (rowTicketId === activeSelectedTicketId) {
            const statusBadge = row.querySelector('.status-badge');
            
            // Reapply layout state css tokens dynamically
            statusBadge.className = `status-badge s-${targetStatusLabel.toLowerCase().replace(' ', '')}`;
            statusBadge.innerText = targetStatusLabel;
        }
    });

    alert(`Ticket Registry reference parameters updated cleanly to: ${targetStatusLabel}`);
}

function suspendUserAccount() {
    const userTarget = supportTicketDatabase[activeSelectedTicketId].username;
    const confirmAction = confirm(`WARNING: Are you sure you want to initialize complete security restrictions and account suspension triggers for customer ${userTarget}?`);
    
    if (confirmAction) {
        document.getElementById('deck-status').innerText = "Suspended (Restricted)";
        document.getElementById('deck-status').className = "detail-value color-danger";
        alert(`Account security boundaries applied. Core authorization parameters disabled for ${userTarget}.`);
    }
}