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
// Mock Transaction Logs Database Model Data Array
let mockTransactions = [
    { id: "TX-90281", name: "Marcus Vance", uid: "USR-4012", type: "Deposit", amount: 4500.00, method: "Crypto (USDT)", detail: "0x71C...392A", status: "Successful", ref: "NEX-DEP-8831920", date: "2026-05-26 14:22" },
    { id: "TX-90282", name: "Emma Ryans", uid: "USR-2289", type: "Withdrawal", amount: 1250.00, method: "Bank Wire", detail: "Chase Bank (Acct: *4920)", status: "Pending", ref: "NEX-WTH-0019283", date: "2026-05-26 11:05" },
    { id: "TX-90283", name: "David Miller", uid: "USR-9910", type: "Investment", amount: 10000.00, method: "Internal Wallet", detail: "AI Trading Growth Bot Plan v4", status: "Successful", ref: "NEX-INV-7730192", date: "2026-05-25 18:40" },
    { id: "TX-90284", name: "Sophia Lopez", uid: "USR-1102", type: "Loan", amount: 3500.00, method: "Direct Escrow", detail: "SME Expansion Credit Pool", status: "Failed", ref: "NEX-LON-4410293", date: "2026-05-24 09:15" },
    { id: "TX-90285", name: "Marcus Vance", uid: "USR-4012", type: "Transfer", amount: 850.00, method: "P2P Network", detail: "Recipient ID: USR-8831", status: "Successful", ref: "NEX-TRF-5592019", date: "2026-05-23 16:34" }
];

// Initialize system analytics visual reporting graph module charts
document.addEventListener("DOMContentLoaded", function() {
    initTransactionGraph();
    renderMasterTableRows(mockTransactions);
    setupRealtimeSimulators();

    // Attach local search/filter event handlers
    document.getElementById("tx-search-input").addEventListener("input", performSystemFilters);
    document.getElementById("filter-type").addEventListener("change", performSystemFilters);
    document.getElementById("filter-status").addEventListener("change", performSystemFilters);
});

// Build responsive ChartJS canvas reporting elements
function initTransactionGraph() {
    const ctx = document.getElementById('nexuistTransactionChart').getContext('2d');
    
    // Auto pull token colors to ensure Dark Mode and Light Mode theme syncing
    const accentColor = getComputedStyle(document.documentElement).getPropertyValue('--secondary-color').trim() || '#00d4ff';
    const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary-color').trim() || '#6c63ff';

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['May 20', 'May 21', 'May 22', 'May 23', 'May 24', 'May 25', 'May 26'],
            datasets: [{
                label: 'Asset Capital Flow Vol ($)',
                data: [12000, 24000, 18000, 35000, 29000, 48000, 56000],
                borderColor: primaryColor,
                backgroundColor: 'rgba(108, 99, 255, 0.05)',
                borderWidth: 3,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { grid: { color: 'rgba(255,255,255,0.03)' }, ticks: { color: '#64748b' } },
                y: { grid: { color: 'rgba(255,255,255,0.03)' }, ticks: { color: '#64748b' } }
            }
        }
    });
}

// Map loop arrays straight into HTML table structures dynamically
function renderMasterTableRows(data) {
    const tbody = document.getElementById("transaction-tbody");
    tbody.innerHTML = "";

    if(data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="10" style="text-align:center; padding: 3rem; color: var(--text-muted);">No records discovered matching criteria filters.</td></tr>`;
        return;
    }

    data.forEach(tx => {
        let statusClass = "s-open"; 
        if(tx.status === "Successful") statusClass = "s-resolved";
        if(tx.status === "Failed") statusClass = "s-escalated";
        if(tx.status === "Pending") statusClass = "s-pending";

        tbody.innerHTML += `
            <tr>
                <td><span class="ticket-id-tag">${tx.id}</span></td>
                <td>
                    <div class="user-profile-cell">
                        <div class="avatar-circle-placeholder profile-mv">${tx.name.charAt(0)}</div>
                        <div>
                            <div class="profile-fullname">${tx.name}</div>
                            <div class="profile-uid">${tx.uid}</div>
                        </div>
                    </div>
                </td>
                <td><span style="font-weight: 500;">${tx.type}</span></td>
                <td><span style="font-weight: 700; color: ${tx.type === 'Withdrawal' ? '#f87171' : 'var(--text-primary)'}">$${tx.amount.toFixed(2)}</span></td>
                <td><span class="ticket-cat-sub">${tx.method}</span></td>
                <td><span class="font-mono" style="font-size:0.8rem; color:var(--text-secondary);">${tx.detail}</span></td>
                <td><span class="status-badge ${statusClass}">${tx.status}</span></td>
                <td><span class="font-mono" style="font-size:0.85rem;">${tx.ref}</span></td>
                <td><span style="font-size:0.8rem; color:var(--text-muted); white-space:nowrap;">${tx.date}</span></td>
                <td style="text-align: right;">
                    <div class="action-buttons-cell">
                        <button class="table-control-btn" onclick="openExtendedDetailsModal('${tx.id}')" title="View Details"><i class='bx bx-show-alt'></i></button>
                        <button class="table-control-btn" onclick="executeAdminAction('${tx.id}', 'Approve')" title="Approve Transaction" style="color:#10b981;"><i class='bx bx-check'></i></button>
                        <button class="table-control-btn" onclick="executeAdminAction('${tx.id}', 'Reject')" title="Reject Transaction" style="color:#ef4444;"><i class='bx bx-block'></i></button>
                    </div>
                </td>
            </tr>
        `;
    });
    
    document.getElementById("pagination-info").innerText = `Showing ${data.length} of ${mockTransactions.length} entries`;
}

// Perform lookups across fields to provide functional filtering options
function performSystemFilters() {
    const searchVal = document.getElementById("tx-search-input").value.toLowerCase();
    const typeVal = document.getElementById("filter-type").value;
    const statusVal = document.getElementById("filter-status").value;

    let filtered = mockTransactions.filter(tx => {
        let matchesSearch = tx.id.toLowerCase().includes(searchVal) || 
                            tx.name.toLowerCase().includes(searchVal) || 
                            tx.ref.toLowerCase().includes(searchVal) ||
                            tx.detail.toLowerCase().includes(searchVal);
        let matchesType = typeVal === "" || tx.type === typeVal;
        let matchesStatus = statusVal === "" || tx.status === statusVal;
        
        return matchesSearch && matchesType && matchesStatus;
    });

    renderMasterTableRows(filtered);
}

// Open modal containing audit and action tracking matrices
function openExtendedDetailsModal(txId) {
    const tx = mockTransactions.find(t => t.id === txId);
    if(!tx) return;

    const modalBody = document.getElementById("modal-extended-details");
    modalBody.innerHTML = `
        <div class="deck-account-details">
            <div class="details-row-grid">
                <div><div class="detail-label">System Transaction ID</div><div class="detail-value font-mono">${tx.id}</div></div>
                <div><div class="detail-label">Reference Protocol</div><div class="detail-value font-mono">${tx.ref}</div></div>
                <div><div class="detail-label">Client Component</div><div class="detail-value">${tx.name} (${tx.uid})</div></div>
                <div><div class="detail-label">Action Classification</div><div class="detail-value" style="font-weight:700;">${tx.type}</div></div>
                <div><div class="detail-label">Settlement Amount</div><div class="detail-value text-success" style="font-size:1.1rem;">$${tx.amount.toFixed(2)}</div></div>
                <div><div class="detail-label">Core Status</div><div class="detail-value">${tx.status}</div></div>
                <div><div class="detail-label">Gateway Method</div><div class="detail-value">${tx.method}</div></div>
                <div><div class="detail-label">Target Network Address / Bank Detail</div><div class="detail-value font-mono">${tx.detail}</div></div>
                <div style="grid-column: span 2;"><div class="detail-label">Authorized Creation Stamp</div><div class="detail-value">${tx.date}</div></div>
            </div>
        </div>
        
        <div class="admin-action-matrix" style="margin-top: 1.5rem;">
            <button class="action-btn-trigger bg-success" onclick="executeAdminAction('${tx.id}', 'Approve')"><i class='bx bx-check-shield'></i> Approve</button>
            <button class="action-btn-trigger bg-warning" onclick="executeAdminAction('${tx.id}', 'MarkPending')"><i class='bx bx-time'></i> Pending</button>
            <button class="action-btn-trigger btn-outline-danger" onclick="executeAdminAction('${tx.id}', 'Reject')"><i class='bx bx-x-circle'></i> Reject</button>
            <button class="action-btn-trigger btn-outline-danger" onclick="executeAdminAction('${tx.id}', 'Freeze')" style="background:#dc2626; color:#fff;"><i class='bx bx-lock-bug'></i> Freeze Account</button>
            <button class="action-btn-trigger bg-primary" onclick="executeAdminAction('${tx.id}', 'Export')"><i class='bx bx-export'></i> Export Receipt</button>
            <button class="action-btn-trigger bg-primary" onclick="executeAdminAction('${tx.id}', 'Print')"><i class='bx bx-printer'></i> Print Log</button>
            <button class="action-btn-trigger btn-outline-danger" onclick="executeAdminAction('${tx.id}', 'Delete')" style="grid-column: span 2; margin-top:0.5rem;"><i class='bx bx-trash'></i> Delete Transaction Permanently</button>
        </div>
    `;

    document.getElementById("tx-details-modal").classList.add("active");
}

function closeTxModal() {
    document.getElementById("tx-details-modal").classList.remove("active");
}

// Master Admin Workflow Controller Execution Switch
function executeAdminAction(txId, actionType) {
    let txIndex = mockTransactions.findIndex(t => t.id === txId);
    
    switch(actionType) {
        case 'Approve':
            if(txIndex > -1) mockTransactions[txIndex].status = "Successful";
            alert(`[NEXUIST LEDGER] Transaction ${txId} has been explicitly approved.`);
            break;
        case 'Reject':
            if(txIndex > -1) mockTransactions[txIndex].status = "Failed";
            alert(`[NEXUIST LEDGER] Transaction ${txId} was flagged and rejected.`);
            break;
        case 'MarkPending':
            if(txIndex > -1) mockTransactions[txIndex].status = "Pending";
            alert(`[NEXUIST LEDGER] Transaction ${txId} marked pending.`);
            break;
        case 'Freeze':
            alert(`[SECURITY CRITICAL] User profile link associated with ${txId} has been isolated and frozen.`);
            break;
        case 'Export':
            alert(`Generating signed cryptographic receipt layout for ${txId}...`);
            break;
        case 'Print':
            window.print();
            break;
        case 'Delete':
            if(txIndex > -1) {
                mockTransactions.splice(txIndex, 1);
                alert(`Transaction ${txId} deleted from records logs.`);
            }
            break;
    }
    
    closeTxModal();
    performSystemFilters();
}

// Live real-time WebSocket connection data activity simulation pipeline
function setupRealtimeSimulators() {
    setInterval(() => {
        // Randomly simulate incoming server push activities
        const types = ["Deposit", "Withdrawal", "Transfer", "Investment"];
        const names = ["Sarah Jenkins", "Robert Dow", "Clara Zhang"];
        const methods = ["Crypto (USDC)", "Visa Gateway", "Internal Vault"];
        
        const randomType = types[Math.floor(Math.random() * types.length)];
        const randomAmt = Math.floor(Math.random() * 5000) + 100;
        
        const newTx = {
            id: `TX-${Math.floor(Math.random() * 90000) + 10000}`,
            name: names[Math.floor(Math.random() * names.length)],
            uid: `USR-${Math.floor(Math.random() * 9000) + 1000}`,
            type: randomType,
            amount: randomAmt,
            method: methods[Math.floor(Math.random() * methods.length)],
            detail: "Internal Ledger Hash Routing Track",
            status: "Pending",
            ref: `NEX-LIVE-${Math.floor(Math.random() * 899999) + 100000}`,
            date: new Date().toISOString().replace('T', ' ').substring(0, 16)
        };

        // Push into local dataset array unshifted
        mockTransactions.unshift(newTx);
        performSystemFilters();
        
        // Trigger temporary security fraud badge warning flags for testing 
        if (randomAmt > 4500) {
            const banner = document.getElementById("fraud-alert-banner");
            banner.classList.add("risk-flagged");
            banner.querySelector("span").innerText = `CRITICAL FRAUD ALERT: High Vol ${newTx.id} flagged!`;
        }
    }, 25000); // Poll simulator every 25 seconds
}

// --- NEXUIST EXPORT PIPELINE AUTOMATION HUB ---
document.getElementById("btn-export-pdf").addEventListener("click", function () {
    // 1. Target the actual dynamic inner body matrix records 
    const tableBody = document.getElementById("transaction-tbody");
    
    if (!tableBody || tableBody.rows.length === 0 || tableBody.innerHTML.includes("No records discovered")) {
        alert("[NEXUIST ERROR] There are no transaction records logs available in the active grid viewport data matrix to export.");
        return;
    }

    // 2. Open up an isolated print reporting frame window instance
    const printWindow = window.open('', '', 'height=900,width=1200');
    
    // 3. Extract metadata totals securely straight from the statistics layout tags
    const totalVolume = document.getElementById("stat-total-volume")?.innerText || "$0.00";
    const successCount = document.getElementById("stat-success-count")?.innerText || "0";
    const pendingCount = document.getElementById("stat-pending-count")?.innerText || "0";
    const failedCount = document.getElementById("stat-failed-count")?.innerText || "0";

    // 4. Build a perfectly styled, printable white/dark clean vector data registry interface
    let htmlContent = `
        <html>
        <head>
            <title>Nexuist Fintech System - Master Transaction Audit Log</title>
            <style>
                body { font-family: 'Segoe UI', Arial, sans-serif; padding: 30px; color: #0f172a; background: #ffffff; }
                .report-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 30px; }
                .report-title h1 { margin: 0; font-size: 24px; color: #6c63ff; }
                .report-title p { margin: 5px 0 0 0; font-size: 13px; color: #64748b; }
                .timestamp { font-size: 12px; color: #64748b; text-align: right; }
                
                .summary-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 30px; }
                .summary-card { border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; background: #f8fafc; }
                .card-lbl { font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 600; margin-bottom: 5px; }
                .card-val { font-size: 18px; font-weight: 700; color: #0f172a; }
                
                table { width: 100%; border-collapse: collapse; text-align: left; margin-top: 10px; font-size: 12px; }
                th { background: #f1f5f9; padding: 12px; font-weight: 600; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; letter-spacing: 0.03em; color: #334155; }
                td { padding: 12px; border-bottom: 1px solid #e2e8f0; color: #334155; }
                tr:nth-child(even) { background: #f8fafc; }
                
                .status-tag { display: inline-block; padding: 3px 8px; border-radius: 12px; font-weight: 600; font-size: 11px; }
                .status-tag.Successful, .status-tag.s-resolved { background: #d1fae5; color: #065f46; }
                .status-tag.Pending, .status-tag.s-pending { background: #fef3c7; color: #92400e; }
                .status-tag.Failed, .status-tag.s-escalated { background: #fee2e2; color: #991b1b; }
                
                /* Strips administrative configuration row triggers out of printed output layout views */
                th:last-child, td:last-child { display: none !important; }
            </style>
        </head>
        <body>
            <div class="report-header">
                <div class="report-title">
                    <h1>NEXUIST FINANCIAL SYSTEM</h1>
                    <p>Ledger Database Record System Audit Registry</p>
                </div>
                <div class="timestamp">
                    <strong>Generated:</strong> ${new Date().toLocaleString()}<br>
                    <strong>Security Level:</strong> Core Admin Privileged Authorization
                </div>
            </div>

            <div class="summary-grid">
                <div class="summary-card"><div class="card-lbl">Total Ledger Volume</div><div class="card-val">${totalVolume}</div></div>
                <div class="summary-card"><div class="card-lbl">Successful Inflow/Outflow</div><div class="card-val">${successCount}</div></div>
                <div class="summary-card"><div class="card-lbl">Pending Validations</div><div class="card-val">${pendingCount}</div></div>
                <div class="summary-card"><div class="card-lbl">Blocked Anomalies</div><div class="card-val">${failedCount}</div></div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>User Profile</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Gateway Method</th>
                        <th>Rail Address Details</th>
                        <th>Status</th>
                        <th>Reference Number</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableBody.innerHTML}
                </tbody>
            </table>

            <script>
                // Format live-rendered HTML components to print correctly inside the isolated window instance
                document.querySelectorAll('td').forEach(cell => {
                    // Normalize standard structural profile data wrappers so they read perfectly on clean PDF documents
                    if(cell.querySelector('.profile-fullname')) {
                        const name = cell.querySelector('.profile-fullname').innerText;
                        const uid = cell.querySelector('.profile-uid').innerText;
                        cell.innerHTML = '<strong>' + name + '</strong> (' + uid + ')';
                    }
                    // Map active visual status CSS badge tags clean to simple printable markup representations
                    if(cell.querySelector('.status-badge')) {
                        const txt = cell.querySelector('.status-badge').innerText;
                        cell.innerHTML = '<span class="status-tag ' + txt + '">' + txt + '</span>';
                    }
                });
                
                // Fire download compilation script
                window.onload = function() {
                    window.print();
                    setTimeout(function() { window.close(); }, 500);
                };
            <\/script>
        </body>
        </html>
    `;

    // 5. Build dynamic iframe compilation assets into targeted output window object streams 
    printWindow.document.open();
    printWindow.document.write(htmlContent);
    printWindow.document.close();
});