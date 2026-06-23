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
/* ==========================================================================
   NEXUIST RUNTIME CLIENT PIPELINE - BACKEND-DRIVEN LIVE MARKET
   ========================================================================== */

const apiEndpoint = '/admin/live-market/data';
let liveTradeRecords = [];
let profitLossChartInstance = null;
let pairsVolumeChartInstance = null;

const ledgerBody = document.getElementById('masterTradeLedgerBody');
const searchInput = document.getElementById('ledgerSearchInput');
const statusFilter = document.getElementById('statusFilterSelect');
const typeFilter = document.getElementById('typeFilterSelect');
const activityFeed = document.getElementById('activityStreamFeed');
const detailModal = document.getElementById('tradeDetailModal');

async function fetchLiveMarketData() {
    try {
        const response = await fetch(apiEndpoint, {
            credentials: 'same-origin',
            headers: { Accept: 'application/json' }
        });

        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }

        const payload = await response.json();

        liveTradeRecords = payload.records || [];
        updateOverviewCards(payload.summary || {});
        renderTradeLedger();
        populateLeaderboards(payload.topTraders || []);
        populateMostTradedPairs(payload.mostTradedPairs || []);
        populateActivityStream(payload.activityFeed || []);
        initializeCharts(payload.profitLossChart, payload.pairsVolumeChart);
    } catch (error) {
        console.error('Unable to load live market data:', error);
        renderTradeLedger();
        initChartLayoutModules();
        triggerStreamInjection();
    }
}

function updateOverviewCards(summary) {
    document.getElementById('stat-total').textContent = summary.totalTradesToday ?? '0';
    document.getElementById('stat-active').textContent = summary.activeTrades ?? '0';
    document.getElementById('stat-closed').textContent = summary.closedTrades ?? '0';
    document.getElementById('stat-buys').textContent = summary.buys ?? '0';
    document.getElementById('stat-sells').textContent = summary.sells ?? '0';
    document.getElementById('stat-volume').textContent = summary.volume ?? '$0';
    document.getElementById('stat-profit').textContent = summary.profit ?? '$0';
    document.getElementById('stat-loss').textContent = summary.loss ?? '$0';
}

function renderTradeLedger() {
    ledgerBody.innerHTML = '';
    const searchTerm = searchInput.value.toLowerCase();
    const selectedStatus = statusFilter.value;
    const selectedType = typeFilter.value;

    liveTradeRecords.forEach(record => {
        const matchesSearch = record.user.toLowerCase().includes(searchTerm) ||
                              record.email.toLowerCase().includes(searchTerm) ||
                              record.pair.toLowerCase().includes(searchTerm);
        const matchesStatus = selectedStatus === 'ALL' || record.status === selectedStatus;
        const matchesType = selectedType === 'ALL' || record.type === selectedType;

        if (!matchesSearch || !matchesStatus || !matchesType) {
            return;
        }

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><span class="id-lbl">${record.id}</span></td>
            <td>
                <div class="rank-identity">
                    <h4>${record.user}</h4>
                    <p>${record.email}</p>
                </div>
            </td>
            <td><strong>${record.pair}</strong><br><small style="color:var(--text-muted)">${record.asset}</small></td>
            <td><span class="direction-pill ${record.type.toLowerCase()}">${record.type}</span></td>
            <td><strong>$${Number(record.amount).toLocaleString()}</strong></td>
            <td><span class="category-pill">${record.leverage}</span></td>
            <td><span class="price-display">$${Number(record.entryPrice).toLocaleString()}</span></td>
            <td><span class="price-display">$${Number(record.currentPrice).toLocaleString()}</span></td>
            <td><span class="trend-indicator ${record.pnl >= 0 ? 'up' : 'down'}">${record.pnl >= 0 ? '+' : ''}$${Number(record.pnl).toFixed(2)}</span></td>
            <td><span class="status-lbl ${record.status.toLowerCase()}"><i class="bx bxs-circle"></i> ${record.status}</span></td>
            <td><small style="color:var(--text-muted)">${record.opened}</small></td>
            <td class="txt-right">
                <button class="action-inspect-btn" onclick="inspectTradeContext('${record.id}')"><i class="bx bx-show-alt"></i> View</button>
            </td>
        `;
        ledgerBody.appendChild(tr);
    });
}

window.inspectTradeContext = function(id) {
    const record = liveTradeRecords.find(t => t.id === id);
    if (!record) return;

    document.getElementById('modalDynamicOutput').innerHTML = `
        <div class="detail-block-node full-width"><span>Trader Account Information</span><p>${record.user} (${record.email})</p></div>
        <div class="detail-block-node"><span>Ticker Instrument Pair</span><p>${record.pair} / ${record.asset}</p></div>
        <div class="detail-block-node"><span>Position Vector</span><p class="${record.type === 'BUY' ? 'txt-up' : 'txt-down'}">${record.type}</p></div>
        <div class="detail-block-node"><span>Invested Principal</span><p>$${Number(record.amount).toLocaleString()}</p></div>
        <div class="detail-block-node"><span>Leverage Ratio Range</span><p>${record.leverage}</p></div>
        <div class="detail-block-node"><span>Strike Booking Valuation</span><p>$${Number(record.entryPrice).toLocaleString()}</p></div>
        <div class="detail-block-node"><span>Current Live Spot</span><p>$${Number(record.currentPrice).toLocaleString()}</p></div>
        <div class="detail-block-node full-width"><span>Floating Profit / Loss Margin</span><p class="${record.pnl >= 0 ? 'txt-up' : 'txt-down'}">${record.pnl >= 0 ? '+' : ''}$${Number(record.pnl).toFixed(2)}</p></div>
        <div class="detail-block-node"><span>Timestamp Opened</span><p>${record.opened}</p></div>
        <div class="detail-block-node"><span>Lifecycle Status</span><p class="txt-cyan">${record.status}</p></div>
    `;
    detailModal.classList.add('active');
};

window.closeTradeDiagnosticModal = function() {
    detailModal.classList.remove('active');
};

function populateLeaderboards(traders) {
    const tradersBox = document.getElementById('topTradersLeaderboard');
    tradersBox.innerHTML = '';

    traders.forEach(trader => {
        tradersBox.innerHTML += `
            <div class="ranking-item-row">
                <div class="rank-profile">
                    <div class="rank-avatar">${trader.initial}</div>
                    <div class="rank-identity"><h4>${trader.name}</h4><p>${trader.count} Executed Orders</p></div>
                </div>
                <div class="rank-stats-data"><span class="val txt-up">$${Number(trader.profit).toLocaleString()}</span><span class="sub">${trader.winRate}% WR</span></div>
            </div>`;
    });
}

function populateMostTradedPairs(pairs) {
    const pairsBox = document.getElementById('mostTradedPairsList');
    pairsBox.innerHTML = '';

    pairs.forEach(pair => {
        pairsBox.innerHTML += `
            <div class="ranking-item-row">
                <div class="rank-profile">
                    <div class="rank-avatar" style="color:var(--secondary-color)"><i class="bx bx-line-chart"></i></div>
                    <div class="rank-identity"><h4>${pair.pair}</h4><p>Win Ratio: ${pair.rate}%</p></div>
                </div>
                <div class="rank-stats-data"><span class="val">${pair.count} Trades</span><span class="sub">Vol: $${pair.volume}</span></div>
            </div>`;
    });
}

function populateActivityStream(lines) {
    activityFeed.innerHTML = '';
    lines.forEach(line => {
        const node = document.createElement('div');
        node.className = 'stream-notif-node';
        node.innerHTML = `${line} <span>At ${new Date().toLocaleTimeString()}</span>`;
        activityFeed.prepend(node);
    });
}

function initializeCharts(profitLossData = null, pairsVolumeData = null) {
    const profitCtx = document.getElementById('profitLossChart').getContext('2d');
    const pairsCtx = document.getElementById('pairsVolumeChart').getContext('2d');

    if (profitLossChartInstance) {
        profitLossChartInstance.destroy();
    }
    if (pairsVolumeChartInstance) {
        pairsVolumeChartInstance.destroy();
    }

    const profitLabels = profitLossData?.labels || ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    const profitSeries = profitLossData?.profit || [12000, 19000, 3000, 5000, 2000, 14000, 9250];
    const lossSeries = profitLossData?.loss || [4000, 2000, 6000, 8000, 1000, 3000, 2140];

    profitLossChartInstance = new Chart(profitCtx, {
        type: 'bar',
        data: {
            labels: profitLabels,
            datasets: [
                { label: 'Aggregated Profits ($)', data: profitSeries, backgroundColor: '#10b981', borderRadius: 4 },
                { label: 'Aggregated Losses ($)', data: lossSeries, backgroundColor: '#ef4444', borderRadius: 4 }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { labels: { color: '#94a3b8' } } },
            scales: { x: { grid: { display: false }, ticks: { color: '#64748b' } }, y: { grid: { color: 'rgba(255,255,255,0.04)' }, ticks: { color: '#64748b' } } }
        }
    });

    const volumeLabels = pairsVolumeData?.labels || ['BTC/USD', 'ETH/USD', 'SOL/USD', 'EUR/USD', 'Gold Spot', 'Tesla'];
    const volumeData = pairsVolumeData?.data || [45, 25, 12, 8, 7, 3];

    pairsVolumeChartInstance = new Chart(pairsCtx, {
        type: 'doughnut',
        data: {
            labels: volumeLabels,
            datasets: [{ data: volumeData, backgroundColor: ['#6c63ff', '#00d4ff', '#8b5cf6', '#f59e0b', '#10b981', '#ef4444'], borderWidth: 0 }] 
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'right', labels: { color: '#94a3b8', boxWidth: 12 } } }
        }
    });
}

const activitiesArray = [
    'Real-time trade stream temporarily unavailable.',
    'Waiting for backend execution feed...',
];

function triggerStreamInjection() {
    const randomAction = activitiesArray[Math.floor(Math.random() * activitiesArray.length)];
    const container = document.createElement('div');
    container.className = 'stream-notif-node';
    container.innerHTML = `${randomAction} <span>At ${new Date().toLocaleTimeString()}</span>`;
    activityFeed.prepend(container);
    if (activityFeed.children.length > 20) activityFeed.lastChild.remove();
}

document.addEventListener('DOMContentLoaded', () => {
    fetchLiveMarketData();

    if (searchInput) searchInput.addEventListener('input', renderTradeLedger);
    if (statusFilter) statusFilter.addEventListener('change', renderTradeLedger);
    if (typeFilter) typeFilter.addEventListener('change', renderTradeLedger);

    setInterval(() => {
        fetchLiveMarketData();
    }, 30000);
});