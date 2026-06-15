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
// =========================================================
    // NEXUIST COPY TRADING PROTOCOL INTERACTION AUTOMATION LOGIC
    // =========================================================
  /**
 * NEXUIST REAL ESTATE - CORE FRONTEND MANAGEMENT CONTROLLER
 * Synchronizes platform storage entities and drives reactive rendering engines.
 */
document.addEventListener("DOMContentLoaded", () => { return;
    
    // --- DATABASE POINTER SYNCHRONIZATION ---
    let properties = JSON.parse(localStorage.getItem("adminPropertiesVault")) || [];
    let investments = JSON.parse(localStorage.getItem("portfolioHoldings")) || [];
    let alerts = JSON.parse(localStorage.getItem("adminSystemAlerts")) || [];

    // --- INITIAL SEEDING FOR EMPTY DEMO DATABASE ---
    if (properties.length === 0 && investments.length === 0) {
        seedInitialPlatformData();
    }

    // --- CORE INTERACTION ELEMENT SELECTORS ---
    const subnavButtons = document.querySelectorAll(".nx-subnav-btn");
    const viewPanels = document.querySelectorAll(".nx-view-panel");
    const propertyCountBadge = document.getElementById("propertyCountBadge");

    // --- MODAL SELECTORS ---
    const formModal = document.getElementById("nxPropertyFormModal");
    const propertyMasterForm = document.getElementById("nxPropertyMasterForm");
    const modalTitleHeader = document.getElementById("nxModalTitleHeader");

    // --- VIEW SPECIFIC TABLE DATA ELEMENTS ---
    const propTableBody = document.getElementById("nxPropertiesTableBody");
    const investTableBody = document.getElementById("nxInvestmentsTableBody");
    const detailsContainer = document.getElementById("nxDetailsOutputContainer");

    // --- NOTIFICATION COMPONENT POINTERS ---
    const notifBtn = document.getElementById("nxNotifBtn");
    const notifDropdown = document.getElementById("nxNotifDropdown");
    const notificationList = document.getElementById("nxNotificationList");
    const markAllReadBtn = document.getElementById("nxMarkAllRead");

    // --- FILTERS & INTERACTION OBJECTS ---
    const searchInvestorInput = document.getElementById("nxSearchInvestorInput");
    const filterStatusSelect = document.getElementById("nxFilterStatus");
    const toastBox = document.getElementById("nxAdminToastBox");
    const toastText = document.getElementById("nxToastAlertText");

    // ==========================================
    // 1. TERMINAL GLOBAL ROUTING PLATFORM ENGINE
    // ==========================================
    subnavButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const targetView = btn.getAttribute("data-target") || btn.getAttribute("data-view");
            if (!targetView) return;

            subnavButtons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            viewPanels.forEach(panel => {
                panel.classList.remove("active");
                if (panel.id === `view-${targetView}`) {
                    panel.classList.add("active");
                }
            });

            // Trigger telemetry refreshes depending on focus frame area
            if (targetView === "overview") compileTelemetrySummary();
            if (targetView === "properties") renderPropertiesTable();
            if (targetView === "investments") renderInvestmentsLedger();
        });
    });

    // Back to property management view
    document.getElementById("nxBackToPropertiesBtn").addEventListener("click", () => {
        document.querySelector('[data-view="properties"]').click();
    });

    // ==========================================
    // 2. LIVE TELEMETRY LOG COMPILER PIPELINE
    // ==========================================
    function compileTelemetrySummary() {
        let totalValue = 0;
        let activeCount = 0;
        let totalCapitalRaised = 0;
        let totalTokensSold = 0;
        let totalTokensAvail = 0;
        let cumulativeApy = 0;

        properties.forEach(p => {
            totalValue += Number(p.marketValue || 0);
            if (p.status === "Active") activeCount++;
            totalTokensAvail += Number(p.availableTokens || 0);
            cumulativeApy += Number(p.apy || 0);
        });

        investments.forEach(i => {
            totalCapitalRaised += Number(i.amount || 0);
            totalTokensSold += Number(i.tokens || 0);
        });

        const avgApy = properties.length > 0 ? (cumulativeApy / properties.length).toFixed(1) : "0.0";

        // Push values onto UI
        document.getElementById("cardTotalPropertiesValue").innerText = `$${totalValue.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
        document.getElementById("cardActiveCount").innerText = `${activeCount} / ${properties.length}`;
        document.getElementById("cardTotalInvested").innerText = `$${totalCapitalRaised.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
        document.getElementById("cardTokensSold").innerText = totalTokensSold.toLocaleString(undefined, {maximumFractionDigits: 2});
        document.getElementById("cardTokensAvailable").innerText = `${totalTokensAvail.toLocaleString()} Unallocated`;
        document.getElementById("cardInvestorCount").innerText = [...new Set(investments.map(i => i.investorName || "Anonymous"))].length;
        document.getElementById("cardAvgApy").innerText = `${avgApy}%`;
        propertyCountBadge.innerText = properties.length;

        // Toggle Empty Views depending on arrays density
        toggleEmptyStateVisibility("analyticsDataCard", "analyticsEmptyState", properties.length === 0);
    }

    // ==========================================
    // 3. INVENTORY DATATABLE RENDERING ENGINE
    // ==========================================
    function renderPropertiesTable() {
        propTableBody.innerHTML = "";
        toggleEmptyStateVisibility("propertiesTableWrapper", "propertiesEmptyState", properties.length === 0);

        properties.forEach((p, index) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>
                    <div class="nx-table-prop-profile">
                        <img src="${p.mainImage}" class="nx-table-prop-avatar" alt="Property">
                        <div class="nx-table-prop-info">
                            <h5>${p.name}</h5>
                            <p><i class='bx bx-map'></i> ${p.city}, ${p.state}</p>
                        </div>
                    </div>
                </td>
                <td><span style="font-weight:500;">${p.type}</span></td>
                <td>$${Number(p.tokenPrice).toFixed(2)}</td>
                <td style="color:#10b981; font-weight:600;">${p.apy}%</td>
                <td>
                    <div style="font-size:0.82rem; color:var(--text-primary); font-weight:500;">${Number(p.availableTokens).toLocaleString()} / ${Number(p.totalTokens).toLocaleString()}</div>
                    <small style="color:var(--text-muted); font-size:0.7rem;">Tokens Left</small>
                </td>
                <td><span class="nx-status-badge ${p.status.replace(/\s+/g, '.')}"><span class="nx-badge-dot"></span>${p.status}</span></td>
                <td>
                    <div class="nx-table-actions-flex">
                        <button class="nx-row-trigger view-trigger" data-id="${p.id}" title="View Deep Analytics"><i class='bx bx-show-alt'></i></button>
                        <button class="nx-row-trigger edit-trigger" data-id="${p.id}" title="Modify Structural Fields"><i class='bx bx-edit-alt'></i></button>
                        <button class="nx-row-trigger delete-trigger" data-id="${p.id}" title="Purge Asset"><i class='bx bx-trash-alt'></i></button>
                    </div>
                </td>
            `;
            propTableBody.appendChild(tr);
        });

        attachTableActionButtonListeners();
    }

    function attachTableActionButtonListeners() {
        // VIEW DETAILS PAGE ROUTER
        propTableBody.querySelectorAll(".view-trigger").forEach(btn => {
            btn.addEventListener("click", () => {
                const targetProp = properties.find(p => p.id === btn.getAttribute("data-id"));
                if (targetProp) renderPropertyDetailsPage(targetProp);
            });
        });

        // EDIT CONSOLE POPULATE
        propTableBody.querySelectorAll(".edit-trigger").forEach(btn => {
            btn.addEventListener("click", () => {
                const targetProp = properties.find(p => p.id === btn.getAttribute("data-id"));
                if (targetProp) openFormModal(true, targetProp);
            });
        });

        // DELETE DISPATCH ENGINE
        propTableBody.querySelectorAll(".delete-trigger").forEach(btn => {
            btn.addEventListener("click", () => {
                const targetId = btn.getAttribute("data-id");
                if (confirm("Are you sure you want to permanently delete this property listing?")) {
                    properties = properties.filter(p => p.id !== targetId);
                    pushStateToDatabase();
                    renderPropertiesTable();
                    pushNotificationAlert("Property configuration permanently uninstalled.");
                }
            });
        });
    }

    // ==========================================
    // 4. DYNAMIC PROFILE PAGE STATISTICS GENERATOR
    // ==========================================
    function renderPropertyDetailsPage(p) {
        // Calculate dynamic internal investment telemetry values targets
        const totalPropertyCapitalAllocated = investments.filter(i => i.title === p.name || i.propertyName === p.name).reduce((acc, current) => acc + Number(current.amount || 0), 0);
        const totalPropertyTokensPurchased = investments.filter(i => i.title === p.name || i.propertyName === p.name).reduce((acc, current) => acc + Number(current.tokens || 0), 0);
        const totalInvestorsAllocatedCount = investments.filter(i => i.title === p.name || i.propertyName === p.name).length;
        
        const fundingRatioPercentage = p.totalTokens > 0 ? ((totalPropertyTokensPurchased / p.totalTokens) * 100).toFixed(1) : 0;

        detailsContainer.innerHTML = `
            <div class="nx-details-banner-frame">
                <img src="${p.mainImage}" class="nx-details-img" alt="Asset Landscape">
                <div class="nx-details-overlay-gradient">
                    <div class="nx-banner-meta">
                        <h2>${p.name}</h2>
                        <p><i class='bx bx-map-pin'></i> ${p.address}, ${p.city}, ${p.state}, ${p.country}</p>
                    </div>
                    <span class="nx-status-badge ${p.status.replace(/\s+/g, '.')}">${p.status}</span>
                </div>
            </div>

            <div class="nx-details-grid-split">
                <div class="nx-details-main-body">
                    <div class="nx-features-horizontal-bar">
                        <div class="nx-feat-node"><i class='bx bx-bed'></i><div>Bedrooms</div><h6>${p.bedrooms}</h6></div>
                        <div class="nx-feat-node"><i class='bx bx-bath'></i><div>Bathrooms</div><h6>${p.bathrooms}</h6></div>
                        <div class="nx-feat-node"><i class='bx bx-car'></i><div>Parking</div><h6>${p.parking}</h6></div>
                        <div class="nx-feat-node"><i class='bx bx-area'></i><div>Dimension</div><h6>${p.size} sqft</h6></div>
                    </div>

                    <div class="nx-details-text-block">
                        <h4>Platform Asset Narrative</h4>
                        <p>${p.description}</p>
                    </div>

                    <div class="nx-details-text-block">
                        <h4>Verified Structural Amenities</h4>
                        <div class="nx-amenities-list-flex" id="amenitiesGridBox">
                            </div>
                    </div>
                </div>

                <div class="nx-details-side-panel">
                    <div class="nx-glass-card">
                        <div class="nx-card-title-bar"><h5>Token Funding Velocity</h5><strong>${fundingRatioPercentage}%</strong></div>
                        <div class="nx-progress-container">
                            <div class="nx-progress-bar-fill" style="width: ${fundingRatioPercentage}%"></div>
                        </div>
                        <div class="nx-progress-meta-flex">
                            <span>${totalPropertyTokensPurchased.toLocaleString()} Sold</span>
                            <span>${Number(p.availableTokens).toLocaleString()} Available</span>
                        </div>

                        <div class="nx-side-stats-list">
                            <div class="nx-side-stat-row"><span>Estimated Yield Vector</span><span style="color:#10b981;">${p.apy}% APY</span></div>
                            <div class="nx-side-stat-row"><span>Market Capital Valuation</span><span>$${Number(p.marketValue).toLocaleString()}</span></div>
                            <div class="nx-side-stat-row"><span>Token Initial Value</span><span>$${p.tokenPrice}</span></div>
                            <div class="nx-side-stat-row"><span>Capital Placed Here</span><span>$${totalPropertyCapitalAllocated.toLocaleString()}</span></div>
                            <div class="nx-side-stat-row"><span>Tracked Investor Count</span><span>${totalInvestorsAllocatedCount} Wallet Nodes</span></div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Map array checkbox values strings visually onto the list framework container 
        const amenitiesGridBox = document.getElementById("amenitiesGridBox");
        const listItems = [
            { key: 'pool', label: 'Swimming Pool', icon: 'bx-water' },
            { key: 'gym', label: 'Fitness Gym', icon: 'bx-dumbbell' },
            { key: 'elevator', label: 'Elevator Access', icon: 'bx-up-arrow-circle' },
            { key: 'security', label: 'Master Guards', icon: 'bx-shield-quarter' },
            { key: 'cctv', label: 'CCTV Monitoring', icon: 'bx-video' },
            { key: 'internet', label: 'Fibre Internet', icon: 'bx-wifi' },
            { key: 'garden', label: 'Sculpted Yard', icon: 'bx-leaf' },
            { key: 'power', label: '24/7 Power Hub', icon: 'bx-bolt' }
        ];

        let hasAmenities = false;
        listItems.forEach(item => {
            if (p.amenities && p.amenities[item.key]) {
                hasAmenities = true;
                const pill = document.createElement("div");
                pill.className = "nx-amenity-pill";
                pill.innerHTML = `<i class='bx ${item.icon}'></i> ${item.label}`;
                amenitiesGridBox.appendChild(pill);
            }
        });

        if (!hasAmenities) {
            amenitiesGridBox.innerHTML = `<span style="color:var(--text-muted); font-size:0.8rem;">No custom amenities checked.</span>`;
        }

        // Programmatically push focus layout area view forward
        viewPanels.forEach(panel => panel.classList.remove("active"));
        document.getElementById("view-details-page").classList.add("active");
    }

    // ==========================================
    // 5. INVESTOR TRANSACTION LEDGER DISPATCHER
    // ==========================================
  function renderInvestmentsLedger() {
    investTableBody.innerHTML = "";
    
    let filteredList = [...investments];
    const searchPhrase = searchInvestorInput.value.toLowerCase().trim();
    const stateFilter = filterStatusSelect.value;

    // Filter processing
    if (searchPhrase) {
        filteredList = filteredList.filter(i => 
            (i.investorName && i.investorName.toLowerCase().includes(searchPhrase)) ||
            (i.email && i.email.toLowerCase().includes(searchPhrase)) ||
            (i.title && i.title.toLowerCase().includes(searchPhrase)) ||
            (i.propertyName && i.propertyName.toLowerCase().includes(searchPhrase))
        );
    }

    if (stateFilter !== "all") {
        filteredList = filteredList.filter(i => (i.state && i.state.toLowerCase() === stateFilter.toLowerCase()));
    }

    toggleEmptyStateVisibility("investmentsTableWrapper", "investmentsEmptyState", filteredList.length === 0);

    // Loop and render rows
    filteredList.forEach(i => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td><span class="nx-investor-id-badge">#${i.id || 'N/A'}</span></td>
            <td><strong style="color:var(--text-primary); font-weight:600;">${i.investorName || "Terminal User"}</strong></td>
            <td><span class="nx-table-email-text">${i.email || 'no-email@nexuist.com'}</span></td>
            <td><span class="nx-status-badge Upcoming">${i.state || 'Imo State'}</span></td>
            <td>${i.title || i.propertyName || "Asset Pool"}</td>
            <td style="font-weight:600; color:#fff;">$${Number(i.amount || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
            <td><span style="color:var(--secondary-color);">${Number(i.tokens || 0).toFixed(2)} units</span></td>
            <td style="color:#10b981;">${i.apy || 12.0}% APY</td>
            <td>${i.date || "June 11, 2026"}</td>
        `;
        investTableBody.appendChild(tr);
    });
}

    searchInvestorInput.addEventListener("input", renderInvestmentsLedger);
    filterStatusSelect.addEventListener("change", renderInvestmentsLedger);

    // ==========================================
    // 6. FORM DISPATCH MODAL INTERACTION CONTROLS
    // ==========================================
    const openBtn = document.getElementById("nxOpenCreateModalBtn");
    const emptyOpenBtn = document.getElementById("nxEmptyStateCreateBtn");
    const closeBtn = document.getElementById("nxCloseModalBtn");
    const cancelBtn = document.getElementById("nxCancelModalBtn");

    function openFormModal(isEditMode = false, data = null) {
        propertyMasterForm.reset();
        document.getElementById("formPropertyId").value = "";

        if (isEditMode && data) {
            modalTitleHeader.innerText = "Modify Asset Specifications Matrix";
            document.getElementById("formPropertyId").value = data.id;
            document.getElementById("propName").value = data.name;
            document.getElementById("propType").value = data.type;
            document.getElementById("propDescription").value = data.description;
            document.getElementById("propAddress").value = data.address;
            document.getElementById("propCity").value = data.city;
            document.getElementById("propState").value = data.state;
            document.getElementById("propCountry").value = data.country;
            document.getElementById("propStatus").value = data.status;
            
            document.getElementById("featBeds").value = data.bedrooms;
            document.getElementById("featBaths").value = data.bathrooms;
            document.getElementById("featLiving").value = data.livingRooms;
            document.getElementById("featKitchens").value = data.kitchens;
            document.getElementById("featParking").value = data.parking;
            document.getElementById("featSize").value = data.size;
            document.getElementById("featYear").value = data.yearBuilt;

            document.getElementById("mediaMainImg").value = data.mainImage;
            document.getElementById("mediaGallery").value = data.gallery ? data.gallery.join(", ") : "";

            document.getElementById("finMarketValue").value = data.marketValue;
            document.getElementById("finTokenPrice").value = data.tokenPrice;
            document.getElementById("finTotalTokens").value = data.totalTokens;
            document.getElementById("finMinInvest").value = data.minInvestment;
            document.getElementById("finMaxInvest").value = data.maxInvestment;
            document.getElementById("finApy").value = data.apy;
            document.getElementById("finAnnualReturn").value = data.expectedReturn;

            // Amenities flags matching checkpoints
            if (data.amenities) {
                document.getElementById("amenPool").checked = !!data.amenities.pool;
                document.getElementById("amenGym").checked = !!data.amenities.gym;
                document.getElementById("amenElevator").checked = !!data.amenities.elevator;
                document.getElementById("amenSecurity").checked = !!data.amenities.security;
                document.getElementById("amenCctv").checked = !!data.amenities.cctv;
                document.getElementById("amenInternet").checked = !!data.amenities.internet;
                document.getElementById("amenGarden").checked = !!data.amenities.garden;
                document.getElementById("amenPower").checked = !!data.amenities.power;
            }
        } else {
            modalTitleHeader.innerText = "Deploy Real Estate Token Asset";
        }
        formModal.classList.add("open");
    }

    if(openBtn) openBtn.addEventListener("click", () => openFormModal(false));
    if(emptyOpenBtn) emptyOpenBtn.addEventListener("click", () => openFormModal(false));
    
    const closeModal = () => formModal.classList.remove("open");
    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    // SUBMIT DATA STRUCT PROCESSING OPERATION
    propertyMasterForm.addEventListener("submit", (e) => {
        e.preventDefault();
        
        const existingId = document.getElementById("formPropertyId").value;
        const totalTokensVal = parseInt(document.getElementById("finTotalTokens").value);
        
        const propertyPayload = {
            id: existingId || 'prop-' + Date.now(),
            name: document.getElementById("propName").value,
            type: document.getElementById("propType").value,
            description: document.getElementById("propDescription").value,
            address: document.getElementById("propAddress").value,
            city: document.getElementById("propCity").value,
            state: document.getElementById("propState").value,
            country: document.getElementById("propCountry").value,
            status: document.getElementById("propStatus").value,
            bedrooms: parseInt(document.getElementById("featBeds").value) || 0,
            bathrooms: parseInt(document.getElementById("featBaths").value) || 0,
            livingRooms: parseInt(document.getElementById("featLiving").value) || 0,
            kitchens: parseInt(document.getElementById("featKitchens").value) || 0,
            parking: parseInt(document.getElementById("featParking").value) || 0,
            size: parseInt(document.getElementById("featSize").value) || 0,
            yearBuilt: parseInt(document.getElementById("featYear").value) || 2026,
            mainImage: document.getElementById("mediaMainImg").value || "https://images.unsplash.com/photo-1600585154340-be6161a56a0c",
            gallery: document.getElementById("mediaGallery").value.split(",").map(s => s.trim()).filter(Boolean),
            marketValue: parseFloat(document.getElementById("finMarketValue").value) || 0,
            tokenPrice: parseFloat(document.getElementById("finTokenPrice").value) || 1,
            totalTokens: totalTokensVal,
            availableTokens: totalTokensVal, // Simple dynamic logic tracking remaining properties pools
            minInvestment: parseInt(document.getElementById("finMinInvest").value) || 1,
            maxInvestment: parseInt(document.getElementById("finMaxInvest").value) || 1000,
            apy: parseFloat(document.getElementById("finApy").value) || 0,
            expectedReturn: parseFloat(document.getElementById("finAnnualReturn").value) || 0,
            amenities: {
                pool: document.getElementById("amenPool").checked,
                gym: document.getElementById("amenGym").checked,
                elevator: document.getElementById("amenElevator").checked,
                security: document.getElementById("amenSecurity").checked,
                cctv: document.getElementById("amenCctv").checked,
                internet: document.getElementById("amenInternet").checked,
                garden: document.getElementById("amenGarden").checked,
                power: document.getElementById("amenPower").checked
            }
        };

        if (existingId) {
            // Edit existing array property item inside index limits
            const targetIndex = properties.findIndex(p => p.id === existingId);
            if (targetIndex !== -1) {
                // Carry over the real remaining tracking token calculation values bounds
                propertyPayload.availableTokens = properties[targetIndex].availableTokens;
                properties[targetIndex] = propertyPayload;
                pushNotificationAlert("Platform asset configurations re-compiled.");
            }
        } else {
            // Unshift new model item payload array parameters list
            properties.unshift(propertyPayload);
            generateSystemAlert("New Asset Proposal", `Property listed for platform trading pools: ${propertyPayload.name}`);
            pushNotificationAlert("Asset successfully minted on ecosystem matrices.");
        }

        pushStateToDatabase();
        closeModal();
        renderPropertiesTable();
    });

    // ==========================================
    // 7. NOTIFICATION PIPELINE UTILITIES HANDLER
    // ==========================================
    function generateSystemAlert(type, content) {
        alerts.unshift({
            id: 'alert-' + Date.now(),
            type: type,
            message: content,
            time: 'Just Now'
        });
        localStorage.setItem("adminSystemAlerts", JSON.stringify(alerts));
        renderNotificationsCenter();
    }

    function renderNotificationsCenter() {
        notificationList.innerHTML = "";
        const alertBadgeDot = document.querySelector(".nx-notif-dot");
        
        if (alerts.length === 0) {
            notificationList.innerHTML = `<div style="padding:16px; font-size:0.78rem; color:var(--text-muted); text-align:center;"> Etherspace tranquil. No logs.</div>`;
            if (alertBadgeDot) alertBadgeDot.style.display = "none";
            return;
        }
        if (alertBadgeDot) alertBadgeDot.style.display = "block";

        alerts.forEach(a => {
            const div = document.createElement("div");
            div.className = "nx-notif-item";
            div.innerHTML = `<strong>${a.type}</strong><span>${a.message}</span><small>${a.time}</small>`;
            notificationList.appendChild(div);
        });
    }

    // Toggle dropdown overlay visibility
    notifBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        notifDropdown.classList.toggle("show");
    });
    document.addEventListener("click", () => notifDropdown.classList.remove("show"));
    notifDropdown.addEventListener("click", (e) => e.stopPropagation());

    markAllReadBtn.addEventListener("click", () => {
        alerts = [];
        localStorage.removeItem("adminSystemAlerts");
        renderNotificationsCenter();
    });

    // ==========================================
    // 8. INFRASTRUCTURE COMPONENT SUB-ROUTINES
    // ==========================================
    function pushStateToDatabase() {
        localStorage.setItem("adminPropertiesVault", JSON.stringify(properties));
    }

    function toggleEmptyStateVisibility(contentCardId, emptyViewId, isEmptyCondition) {
        const contentCard = document.getElementById(contentCardId);
        const emptyView = document.getElementById(emptyViewId);
        
        if (isEmptyCondition) {
            if (contentCard) contentCard.classList.add("hidden");
            if (emptyView) emptyView.classList.remove("hidden");
        } else {
            if (contentCard) contentCard.classList.remove("hidden");
            if (emptyView) emptyView.classList.add("hidden");
        }
    }

    function pushNotificationAlert(text, type = 'System') {
        if (!toastBox || !toastText) return;

        toastText.innerText = text;
        toastBox.classList.add("show");

        alerts.unshift({
            id: 'alert-' + Date.now(),
            type,
            message: text,
            time: 'Just Now'
        });
        localStorage.setItem("adminSystemAlerts", JSON.stringify(alerts));
        renderNotificationsCenter();

        setTimeout(() => toastBox.classList.remove("show"), 3500);
    }

    // CSV Data Stream Exporter Action
    document.getElementById("nxExportLedgerBtn").addEventListener("click", () => {
        if(investments.length === 0) return alert("Ledger matrix coordinates empty.");
        let csvContent = "data:text/csv;charset=utf-8,Investor,Property,Amount,Tokens,APY,Date\n";
        investments.forEach(i => {
            csvContent += `"${i.investorName || 'Terminal User'}","${i.title || i.propertyName}",${i.amount},${i.tokens},${i.apy},"${i.date || '2026-06-11'}"\n`;
        });
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Nexuist_Global_Investors_Ledger.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    // ==========================================
    // 9. CORES SEED MOCK SYSTEM POPULATORS
    // ==========================================
    function seedInitialPlatformData() {
        const mockInvestments = [
    { 
        id: "1001", 
        investorName: "Sir Samuel", 
        email: "samuel.owerri@nexuist.com", 
        state: "Imo State", 
        title: "Apex Horizon Skyscraper", 
        propertyName: "Apex Horizon Skyscraper", 
        amount: 15000, 
        tokens: 150, 
        apy: 16.4, 
        date: "June 04, 2026" 
    },
    { 
        id: "1002", 
        investorName: "Mrs MJ", 
        email: "mj.alpha@nexuist.com", 
        state: "Lagos", 
        title: "Apex Horizon Skyscraper", 
        propertyName: "Apex Horizon Skyscraper", 
        amount: 30000, 
        tokens: 300, 
        apy: 16.4, 
        date: "June 09, 2026" 
    }
];
        properties = mockProperties;
        investments = mockInvestments;
        alerts = mockAlerts;

        localStorage.setItem("adminPropertiesVault", JSON.stringify(properties));
        localStorage.setItem("portfolioHoldings", JSON.stringify(investments));
        localStorage.setItem("adminSystemAlerts", JSON.stringify(alerts));
    }

    // Initialize telemetry loop execution sequence instantly on console access loops
    compileTelemetrySummary();
    renderNotificationsCenter();
});

// Admin backend-driven Real Estate dashboard controller
const adminApiBaseUrl = '/admin/real-estate';

function adminGetCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    if (meta) return meta.content;
    const match = document.cookie.match(new RegExp('(^| )XSRF-TOKEN=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
}

async function adminApiFetch(path, options = {}) {
    const headers = {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': adminGetCsrfToken() || '',
        ...(options.headers || {}),
    };

    const response = await fetch(`${adminApiBaseUrl}${path}`, {
        credentials: 'same-origin',
        headers,
        ...options,
    });

    const responseData = await response.json();
    if (!response.ok) {
        throw new Error(responseData.message || 'Admin API request failed.');
    }
    return responseData;
}

document.addEventListener('DOMContentLoaded', () => {
    let properties = [];
    let investments = [];
    let adminStats = {};
    let alerts = JSON.parse(localStorage.getItem('adminSystemAlerts')) || [];

    const propTableBody = document.getElementById('nxPropertiesTableBody');
    const investTableBody = document.getElementById('nxInvestmentsTableBody');
    const detailsContainer = document.getElementById('nxDetailsOutputContainer');
    const propertyMasterForm = document.getElementById('nxPropertyMasterForm');
    const modalTitleHeader = document.getElementById('nxModalTitleHeader');
    const searchInvestorInput = document.getElementById('nxSearchInvestorInput');
    const filterStatusSelect = document.getElementById('nxFilterStatus');
    const notificationList = document.getElementById('nxNotificationList');
    const toastBox = document.getElementById('nxAdminToastBox');
    const toastText = document.getElementById('nxToastAlertText');
    const notifToggleBtn = document.getElementById('nxNotifBtn');
    const notifDropdown = document.getElementById('nxNotifDropdown');
    const markAllReadBtn = document.getElementById('nxMarkAllRead');
    const openBtn = document.getElementById('nxOpenCreateModalBtn');
    const emptyOpenBtn = document.getElementById('nxEmptyStateCreateBtn');
    const closeBtn = document.getElementById('nxCloseModalBtn');
    const cancelBtn = document.getElementById('nxCancelModalBtn');

    notifToggleBtn?.addEventListener('click', (event) => {
        event.stopPropagation();
        notifDropdown?.classList.toggle('show');
    });

    document.addEventListener('click', (event) => {
        if (
            notifDropdown &&
            notifToggleBtn &&
            !notifDropdown.contains(event.target) &&
            !notifToggleBtn.contains(event.target)
        ) {
            notifDropdown.classList.remove('show');
        }
    });

    async function loadAdminData() {
        try {
            const [stats, propertyPayload, investmentPayload] = await Promise.all([
                adminApiFetch('/properties/stats', { method: 'GET' }),
                adminApiFetch('/properties', { method: 'GET' }),
                adminApiFetch('/investments', { method: 'GET' }),
            ]);

            adminStats = stats || {};
            properties = Array.isArray(propertyPayload.data) ? propertyPayload.data : [];
            investments = Array.isArray(investmentPayload) ? investmentPayload : [];

            renderPropertiesTable();
            renderInvestmentsLedger();
            renderNotificationsCenter();
            compileTelemetrySummary(adminStats);
        } catch (err) {
            console.error(err);
            pushNotificationAlert('Could not load admin real estate data.');
        }
    }

    const subnavButtons = document.querySelectorAll('.nx-subnav-btn');
    const viewPanels = document.querySelectorAll('.nx-view-panel');

    function activateAdminView(targetView) {
        subnavButtons.forEach(btn => btn.classList.toggle('active', btn.dataset.view === targetView));
        viewPanels.forEach(panel => panel.classList.toggle('active', panel.id === `view-${targetView}`));

        if (targetView === 'overview') {
            compileTelemetrySummary();
        }
        if (targetView === 'properties') {
            renderPropertiesTable();
        }
        if (targetView === 'investments') {
            renderInvestmentsLedger();
        }
    }

    subnavButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetView = btn.dataset.view;
            if (!targetView) return;
            activateAdminView(targetView);
        });
    });

    document.getElementById('nxBackToPropertiesBtn')?.addEventListener('click', () => {
        const propertiesButton = document.querySelector('[data-view="properties"]');
        propertiesButton?.click();
    });

    function compileTelemetrySummary(stats = adminStats) {
        document.getElementById('cardTotalPropertiesValue').innerText = `$${Number(stats.total_properties_value || stats.total_properties || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
        document.getElementById('cardActiveCount').innerText = `${stats.active_properties || 0} / ${stats.total_properties || properties.length}`;
        document.getElementById('cardTotalInvested').innerText = `$${Number(stats.total_capital_raised || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}`;
        document.getElementById('cardTokensSold').innerText = Number(stats.total_tokens_sold || 0).toLocaleString(undefined, {maximumFractionDigits: 2});
        document.getElementById('cardTokensAvailable').innerText = `${Number(stats.total_tokens_available || 0).toLocaleString()} Available`;
        document.getElementById('cardInvestorCount').innerText = Number(stats.total_investors || 0).toLocaleString();
        document.getElementById('cardAvgApy').innerText = `${Number(stats.average_apy || 0).toFixed(1)}%`;
        document.getElementById('propertyCountBadge').innerText = String(stats.total_properties || properties.length);
    }

    function renderPropertiesTable() {
        if (!propTableBody) return;
        propTableBody.innerHTML = '';

        if (!properties.length) {
            document.getElementById('propertiesEmptyState')?.classList.remove('hidden');
            return;
        }
        document.getElementById('propertiesEmptyState')?.classList.add('hidden');

        properties.forEach(property => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <div class="nx-table-prop-profile">
                        <img src="${property.main_image || property.mainImage || 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=600&q=80'}" class="nx-table-prop-avatar" alt="Property">
                        <div class="nx-table-prop-info">
                            <h5>${property.property_name || property.name}</h5>
                            <p><i class='bx bx-map'></i> ${[property.city, property.state, property.country].filter(Boolean).join(', ')}</p>
                        </div>
                    </div>
                </td>
                <td><span style="font-weight:500;">${property.property_type || property.type || ''}</span></td>
                <td>${Number(property.estimated_apy || property.apy || 0).toFixed(1)}%</td>
                <td>$${Number(property.token_price || property.tokenPrice || 0).toFixed(2)}</td>
                <td>
                    <div style="font-size:0.82rem; color:var(--text-primary); font-weight:500;">${Number(property.available_tokens || property.availableTokens || 0).toLocaleString()} / ${Number(property.total_tokens || property.totalTokens || 0).toLocaleString()}</div>
                    <small style="color:var(--text-muted); font-size:0.7rem;">Tokens Left</small>
                </td>
                <td><span class="nx-status-badge ${String(property.property_status || property.status || '').replace(/\s+/g, '.')}"><span class="nx-badge-dot"></span>${property.property_status || property.status || 'Inactive'}</span></td>
                <td>
                    <div class="nx-table-actions-flex">
                        <button class="nx-row-trigger view-trigger" data-id="${property.id}"><i class='bx bx-show-alt'></i></button>
                        <button class="nx-row-trigger edit-trigger" data-id="${property.id}"><i class='bx bx-edit-alt'></i></button>
                        <button class="nx-row-trigger delete-trigger" data-id="${property.id}"><i class='bx bx-trash-alt'></i></button>
                    </div>
                </td>
            `;
            propTableBody.appendChild(row);
        });

        attachPropertyActionHandlers();
    }

    function attachPropertyActionHandlers() {
        propTableBody.querySelectorAll('.view-trigger').forEach(btn => {
            btn.addEventListener('click', () => {
                const property = properties.find(p => String(p.id) === btn.dataset.id);
                if (property) renderPropertyDetailsPage(property);
            });
        });

        propTableBody.querySelectorAll('.edit-trigger').forEach(btn => {
            btn.addEventListener('click', () => {
                const property = properties.find(p => String(p.id) === btn.dataset.id);
                if (property) populateFormForEdit(property);
            });
        });

        propTableBody.querySelectorAll('.delete-trigger').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                if (!id || !confirm('Delete this property?')) return;
                try {
                    await adminApiFetch(`/properties/${id}`, { method: 'DELETE' });
                    properties = properties.filter(p => String(p.id) !== String(id));
                    renderPropertiesTable();
                    pushNotificationAlert('Property deleted successfully.');
                } catch (error) {
                    alert(error.message || 'Could not delete property.');
                }
            });
        });
    }

    function renderPropertyDetailsPage(property) {
        const relatedInvestments = investments.filter(inv => String(inv.property?.id || inv.propertyId) === String(property.id));
        const capital = relatedInvestments.reduce((sum, item) => sum + Number(item.investment_amount || item.amount || 0), 0);
        const tokens = relatedInvestments.reduce((sum, item) => sum + Number(item.tokens_purchased || item.tokens || 0), 0);
        const ratio = Number(property.total_tokens || property.totalTokens || 0) > 0 ? ((tokens / Number(property.total_tokens || property.totalTokens || 0)) * 100).toFixed(1) : 0;

        detailsContainer.innerHTML = `
            <div class="nx-details-banner-frame">
                <img src="${property.main_image || property.mainImage || 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=600&q=80'}" class="nx-details-img" alt="Property">
                <div class="nx-details-overlay-gradient">
                    <div class="nx-banner-meta">
                        <h2>${property.property_name || property.name}</h2>
                        <p><i class='bx bx-map-pin'></i> ${[property.address, property.city, property.state, property.country].filter(Boolean).join(', ')}</p>
                    </div>
                    <span class="nx-status-badge ${String(property.property_status || property.status || 'Inactive').replace(/\s+/g, '.')}">${property.property_status || property.status || 'Inactive'}</span>
                </div>
            </div>
            <div class="nx-details-grid-split">
                <div class="nx-details-main-body">
                    <div class="nx-features-horizontal-bar">
                        <div class="nx-feat-node"><i class='bx bx-bed'></i><div>Bedrooms</div><h6>${property.bedrooms ?? '-'}</h6></div>
                        <div class="nx-feat-node"><i class='bx bx-bath'></i><div>Bathrooms</div><h6>${property.bathrooms ?? '-'}</h6></div>
                        <div class="nx-feat-node"><i class='bx bx-car'></i><div>Parking</div><h6>${property.parking_spaces || property.parking || '-'}</h6></div>
                        <div class="nx-feat-node"><i class='bx bx-area'></i><div>Dimension</div><h6>${property.property_size || property.size || '-'} sqft</h6></div>
                    </div>
                    <div class="nx-details-text-block">
                        <h4>Platform Asset Narrative</h4>
                        <p>${property.description || ''}</p>
                    </div>
                    <div class="nx-details-text-block">
                        <h4>Verified Structural Amenities</h4>
                        <div class="nx-amenities-list-flex" id="amenitiesGridBox"></div>
                    </div>
                </div>
                <div class="nx-details-side-panel">
                    <div class="nx-glass-card">
                        <div class="nx-card-title-bar"><h5>Token Funding Velocity</h5><strong>${ratio}%</strong></div>
                        <div class="nx-progress-container"><div class="nx-progress-bar-fill" style="width: ${ratio}%"></div></div>
                        <div class="nx-progress-meta-flex">
                            <span>${tokens.toLocaleString()} Sold</span>
                            <span>${Number(property.available_tokens || property.availableTokens || 0).toLocaleString()} Available</span>
                        </div>
                        <div class="nx-side-stats-list">
                            <div class="nx-side-stat-row"><span>Estimated Yield</span><span style="color:#10b981;">${Number(property.estimated_apy || property.apy || 0).toFixed(1)}% APY</span></div>
                            <div class="nx-side-stat-row"><span>Market Value</span><span>$${Number(property.market_value || property.marketValue || 0).toLocaleString()}</span></div>
                            <div class="nx-side-stat-row"><span>Token Price</span><span>$${Number(property.token_price || property.tokenPrice || 0).toFixed(2)}</span></div>
                            <div class="nx-side-stat-row"><span>Capital Allocated</span><span>$${Number(capital).toLocaleString()}</span></div>
                            <div class="nx-side-stat-row"><span>Investors</span><span>${relatedInvestments.length}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        const amenitiesGridBox = document.getElementById('amenitiesGridBox');
        const amenityList = ['pool','gym','elevator','security','cctv','internet','garden','power'];
        if (amenitiesGridBox) {
            amenitiesGridBox.innerHTML = '';
            let hasAny = false;
            amenityList.forEach(key => {
                if (property.amenities?.[key]) {
                    hasAny = true;
                    const pill = document.createElement('div');
                    pill.className = 'nx-amenity-pill';
                    pill.innerHTML = `<i class='bx bx-check'></i> ${key.charAt(0).toUpperCase() + key.slice(1)}`;
                    amenitiesGridBox.appendChild(pill);
                }
            });
            if (!hasAny) amenitiesGridBox.innerHTML = `<span style="color:var(--text-muted); font-size:0.8rem;">No custom amenities checked.</span>`;
        }

        document.querySelectorAll('.nx-view-panel').forEach(panel => panel.classList.remove('active'));
        document.getElementById('view-details-page')?.classList.add('active');
    }

    function renderInvestmentsLedger() {
        if (!investTableBody) return;
        investTableBody.innerHTML = '';

        let filtered = [...investments];
        const search = searchInvestorInput?.value.toLowerCase().trim() || '';
        const stateFilter = filterStatusSelect?.value || 'all';

        if (search) {
            filtered = filtered.filter(i => [i.user?.name, i.user?.email, i.property?.property_name, i.propertyName, i.title].filter(Boolean).join(' ').toLowerCase().includes(search));
        }
        if (stateFilter !== 'all') {
            filtered = filtered.filter(i => String(i.investment_status || i.state || '').toLowerCase() === stateFilter.toLowerCase());
        }

        if (!filtered.length) {
            document.getElementById('investmentsEmptyState')?.classList.remove('hidden');
        } else {
            document.getElementById('investmentsEmptyState')?.classList.add('hidden');
        }

        filtered.forEach(i => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><span class="nx-investor-id-badge">#${i.id || 'N/A'}</span></td>
                <td><strong style="color:var(--text-primary); font-weight:600;">${i.user?.name || i.investorName || 'Investor'}</strong></td>
                <td><span class="nx-table-email-text">${i.user?.email || i.email || ''}</span></td>
                <td><span class="nx-status-badge Upcoming">${i.investment_status || i.state || 'Active'}</span></td>
                <td>${i.property?.property_name || i.title || i.propertyName || ''}</td>
                <td style="font-weight:600; color:#fff;">$${Number(i.investment_amount || i.amount || 0).toLocaleString(undefined, {minimumFractionDigits: 2})}</td>
                <td><span style="color:var(--secondary-color);">${Number(i.tokens_purchased || i.tokens || 0).toFixed(2)} units</span></td>
                <td style="color:#10b981;">${Number(i.apy || 0).toFixed(1)}% APY</td>
                <td>${new Date(i.investment_date || i.date || Date.now()).toLocaleDateString()}</td>
            `;
            investTableBody.appendChild(row);
        });
    }

    function populateFormForEdit(property) {
        modalTitleHeader.textContent = 'Modify Asset Specifications Matrix';
        document.getElementById('formPropertyId').value = property.id;
        document.getElementById('propName').value = property.property_name || property.name || '';
        document.getElementById('propType').value = property.property_type || property.type || 'Apartment';
        document.getElementById('propDescription').value = property.description || '';
        document.getElementById('propAddress').value = property.address || '';
        document.getElementById('propCity').value = property.city || '';
        document.getElementById('propState').value = property.state || '';
        document.getElementById('propCountry').value = property.country || '';
        document.getElementById('propStatus').value = property.property_status || property.status || 'Active';
        document.getElementById('featBeds').value = property.bedrooms || 0;
        document.getElementById('featBaths').value = property.bathrooms || 0;
        document.getElementById('featLiving').value = property.living_rooms || property.livingRooms || 0;
        document.getElementById('featKitchens').value = property.kitchens || 0;
        document.getElementById('featParking').value = property.parking_spaces || property.parking || 0;
        document.getElementById('featSize').value = property.property_size || property.size || 0;
        document.getElementById('featYear').value = property.year_built || property.yearBuilt || 2026;
        document.getElementById('mediaMainImg').value = property.main_image || property.mainImage || '';
        document.getElementById('mediaGallery').value = (property.galleries || []).map(g => g.image).join(', ');
        document.getElementById('finMarketValue').value = property.market_value || property.marketValue || 0;
        document.getElementById('finTokenPrice').value = property.token_price || property.tokenPrice || 0;
        document.getElementById('finTotalTokens').value = property.total_tokens || property.totalTokens || 0;
        document.getElementById('finMinInvest').value = property.minimum_investment || property.minInvestment || 0;
        document.getElementById('finMaxInvest').value = property.maximum_investment || property.maxInvestment || 0;
        document.getElementById('finApy').value = property.estimated_apy || property.apy || 0;
        document.getElementById('finAnnualReturn').value = property.expected_annual_return || property.expectedReturn || 0;

        const amenities = property.amenities || {};
        ['Pool','Gym','Elevator','Security','Cctv','Internet','Garden','Power'].forEach(name => {
            const el = document.getElementById(`amen${name}`);
            if (el) el.checked = !!amenities[name.toLowerCase()];
        });

        document.getElementById('nxPropertyFormModal')?.classList.add('open');
    }

    async function submitPropertyForm(event) {
        event.preventDefault();
        if (!propertyMasterForm) return;

        const existingId = document.getElementById('formPropertyId').value;
        const formData = new FormData(propertyMasterForm);
        const endpoint = existingId ? `/properties/${existingId}` : '/properties';
        try {
            await adminApiFetch(endpoint, {
                method: 'POST',
                body: formData,
            });
            await loadAdminData();
            document.getElementById('nxPropertyFormModal')?.classList.remove('open');
            pushNotificationAlert(existingId ? 'Property updated.' : 'Property created.');
        } catch (err) {
            alert(err.message || 'Could not save property.');
        }
    }

    function renderNotificationsCenter() {
        if (!notificationList) return;
        notificationList.innerHTML = '';
        const alertBadgeDot = document.querySelector('.nx-notif-dot');

        if (!alerts.length) {
            notificationList.innerHTML = `<div style="padding:16px; font-size:0.78rem; color:var(--text-muted); text-align:center;">No notifications available.</div>`;
            if (alertBadgeDot) alertBadgeDot.style.display = 'none';
            return;
        }

        if (alertBadgeDot) alertBadgeDot.style.display = 'block';
        alerts.forEach(alertItem => {
            const node = document.createElement('div');
            node.className = 'nx-notif-item';
            node.innerHTML = `<strong>${alertItem.type}</strong><span>${alertItem.message}</span><small>${alertItem.time}</small>`;
            notificationList.appendChild(node);
        });
    }

    function pushNotificationAlert(message, type = 'System') {
        if (!toastBox || !toastText) return;

        toastText.innerText = message;
        toastBox.classList.add('show');

        alerts.unshift({
            id: `alert-${Date.now()}`,
            type,
            message,
            time: 'Just now',
        });

        localStorage.setItem('adminSystemAlerts', JSON.stringify(alerts));
        renderNotificationsCenter();

        setTimeout(() => toastBox.classList.remove('show'), 3500);
    }

    if (!alerts.length) {
        alerts.push({
            id: `alert-${Date.now()}`,
            type: 'System',
            message: 'Platform alerts are online. No new system warnings at the moment.',
            time: 'Just now',
        });
        localStorage.setItem('adminSystemAlerts', JSON.stringify(alerts));
    }

    openBtn?.addEventListener('click', () => document.getElementById('nxPropertyFormModal')?.classList.add('open'));
    emptyOpenBtn?.addEventListener('click', () => document.getElementById('nxPropertyFormModal')?.classList.add('open'));
    closeBtn?.addEventListener('click', () => document.getElementById('nxPropertyFormModal')?.classList.remove('open'));
    cancelBtn?.addEventListener('click', () => document.getElementById('nxPropertyFormModal')?.classList.remove('open'));
    propertyMasterForm?.addEventListener('submit', submitPropertyForm);
    searchInvestorInput?.addEventListener('input', renderInvestmentsLedger);
    filterStatusSelect?.addEventListener('change', renderInvestmentsLedger);
    markAllReadBtn?.addEventListener('click', () => { alerts = []; localStorage.removeItem('adminSystemAlerts'); renderNotificationsCenter(); });

    document.getElementById('nxExportLedgerBtn')?.addEventListener('click', () => {
        if (!investments.length) return alert('Ledger matrix coordinates empty.');
        let csvContent = 'data:text/csv;charset=utf-8,Investor,Property,Amount,Tokens,APY,Date\n';
        investments.forEach(inv => {
            csvContent += `"${inv.user?.name || inv.investorName || 'Investor'}","${inv.property?.property_name || inv.title || inv.propertyName || ''}",${Number(inv.investment_amount || inv.amount || 0)},${Number(inv.tokens_purchased || inv.tokens || 0)},${Number(inv.apy || 0).toFixed(1)},"${new Date(inv.investment_date || inv.date || Date.now()).toLocaleDateString()}"\n`;
        });
        const link = document.createElement('a');
        link.href = encodeURI(csvContent);
        link.download = 'Nexuist_Global_Investors_Ledger.csv';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    loadAdminData();
});

