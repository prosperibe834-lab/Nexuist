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
 * ==========================================================
 * NEXUIST COMPLIANCE CORE & INTERACTIVE DOSSIER ENGINE
 * ==========================================================
 */

// Global User Verification Application Queue State Dataset
const K_COMPLIANCE_DATASET = [
    {
        uid: "NEX-10942",
        firstName: "Alexander",
        lastName: "Mercer",
        nationality: "United Kingdom",
        email: "a.mercer@nexus.io",
        dob: "1994-03-12",
        docType: "Passport",
        docRef: "GBR-892104B",
        address: "74 Finchley Road, London, NW3 6EF, UK",
        riskIndex: "LOW RISK",
        riskScore: "12%",
        riskClass: "text-success",
        expiryDate: "2031-10-15",
        pepCheck: "PASSED SECURE",
        fileName: "International_Passport_Page.jpg",
        fileSize: "2.4 MB",
        // Simulated premium canvas fallback gradient image proxy string
        imageSrc: "https://images.unsplash.com/photo-1554774853-aae0a22c8aa4?auto=format&fit=crop&q=80&w=600",
        status: "Pending Review"
    },
    {
        uid: "NEX-20481",
        firstName: "Amara",
        lastName: "Kalu",
        nationality: "Nigeria",
        email: "a.kalu@nexuist.com",
        dob: "1989-08-24",
        docType: "Driver's License",
        docRef: "NGA-77312A9",
        address: "12 Ikoyi Crescent, Lagos, Nigeria",
        riskIndex: "LOW RISK",
        riskScore: "08%",
        riskClass: "text-success",
        expiryDate: "2029-04-11",
        pepCheck: "PASSED SECURE",
        fileName: "Drivers_License_Front.png",
        fileSize: "1.8 MB",
        imageSrc: "https://images.unsplash.com/photo-1557683316-973673baf926?auto=format&fit=crop&q=80&w=600",
        status: "Pending Review"
    },
    {
        uid: "NEX-30194",
        firstName: "Chen",
        lastName: "Wei",
        nationality: "China",
        email: "c.wei@nexus.io",
        dob: "1991-11-02",
        docType: "National ID Card",
        docRef: "CHN-220195X",
        address: "Xuhui Financial District, Shanghai, China",
        riskIndex: "EVALUATING",
        riskScore: "45%",
        riskClass: "text-warning",
        expiryDate: "2035-07-19",
        pepCheck: "SCREENING LOOP",
        fileName: "National_ID_Gold_Mesh.jpg",
        fileSize: "3.1 MB",
        imageSrc: "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=600",
        status: "Pending Review"
    },
    {
        uid: "NEX-44921",
        firstName: "Elena",
        lastName: "Rostova",
        nationality: "Germany",
        email: "e.rostova@proton.me",
        dob: "1995-05-14",
        docType: "Passport",
        docRef: "DEU-441029C",
        address: "Karl-Marx-Allee 44, Berlin, Germany",
        riskIndex: "LOW RISK",
        riskScore: "15%",
        riskClass: "text-success",
        expiryDate: "2032-12-05",
        pepCheck: "PASSED SECURE",
        fileName: "Germany_Passport_Scan.pdf",
        fileSize: "4.7 MB",
        imageSrc: "https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?auto=format&fit=crop&q=80&w=600",
        status: "Pending Review"
    },
    {
        uid: "NEX-51102",
        firstName: "Liam",
        lastName: "O'Connor",
        nationality: "Ireland",
        email: "l.oconnor@nexus.io",
        dob: "1987-01-30",
        docType: "National ID Card",
        docRef: "IRL-992314M",
        address: "22 Grafton Street, Dublin, Ireland",
        riskIndex: "LOW RISK",
        riskScore: "11%",
        riskClass: "text-success",
        expiryDate: "2030-02-28",
        pepCheck: "PASSED SECURE",
        fileName: "Irish_ID_Card_Data.png",
        fileSize: "2.1 MB",
        imageSrc: "https://images.unsplash.com/photo-1614741118887-7a4ee193a5fa?auto=format&fit=crop&q=80&w=600",
        status: "Pending Review"
    }
];

// Tracks the current selected user object in memory space
let currentSelectedUid = null;

document.addEventListener('DOMContentLoaded', () => {
    renderUserQueueFeed();
    // Default system initialization auto-loads the first pending application item
    if (K_COMPLIANCE_DATASET.length > 0) {
        loadUserComplianceVault(K_COMPLIANCE_DATASET[0].uid);
    }
});

/**
 * Builds and renders user cards on the left sidebar
 */
function renderUserQueueFeed() {
    const queueContainer = document.getElementById('usersQueueContainer');
    if (!queueContainer) return;

    queueContainer.innerHTML = "";

    K_COMPLIANCE_DATASET.forEach(user => {
        const initials = `${user.firstName.charAt(0)}${user.lastName.charAt(0)}`.toUpperCase();
        const activeClass = user.uid === currentSelectedUid ? "active" : "";
        
        let statusBadgeClass = "badge-pending-review";
        if (user.status === "Approved") statusBadgeClass += " badge-approved";
        if (user.status === "Rejected") statusBadgeClass += " badge-rejected";

        const cardHtml = `
            <div class="user-queue-card ${activeClass}" id="card-${user.uid}" onclick="loadUserComplianceVault('${user.uid}')">
                <div class="avatar-initials">${initials}</div>
                <div class="card-profile-info">
                    <h4 class="profile-fullname">${user.firstName} ${user.lastName}</h4>
                    <p class="profile-meta-row">UID: #${user.uid} &bull; ${user.docType}</p>
                    <span class="${statusBadgeClass}" id="badge-state-${user.uid}">${user.status}</span>
                </div>
            </div>
        `;
        queueContainer.insertAdjacentHTML('beforeend', cardHtml);
    });
}

/**
 * Filter mechanism to scan ingestion requests in real time
 */
function filterUserQueue() {
    const searchVal = document.getElementById('userSearchInput').value.toLowerCase().trim();
    K_COMPLIANCE_DATASET.forEach(user => {
        const cardElement = document.getElementById(`card-${user.uid}`);
        if (!cardElement) return;

        const matchesName = `${user.firstName} ${user.lastName}`.toLowerCase().includes(searchVal);
        const matchesUid = user.uid.toLowerCase().includes(searchVal);

        if (matchesName || matchesUid) {
            cardElement.style.display = "flex";
        } else {
            cardElement.style.display = "none";
        }
    });
}

/**
 * Master-Detail Linkage: Gathers user properties and paints the document vault frame on the right
 */
function loadUserComplianceVault(uid) {
    currentSelectedUid = uid;
    
    // Update active visual selections inside the left sidebar list
    document.querySelectorAll('.user-queue-card').forEach(card => card.classList.remove('active'));
    const targetCard = document.getElementById(`card-${uid}`);
    if (targetCard) targetCard.classList.add('active');

    const targetPanel = document.getElementById('complianceDetailVault');
    const user = K_COMPLIANCE_DATASET.find(u => u.uid === uid);
    
    if (!targetPanel || !user) return;

    // Repaint workspace with user parameters, active credential media files, and actions
    targetPanel.innerHTML = `
        <div class="vault-header-split">
            <div>
                <span class="dossier-tag">Verification Dossier In Progress</span>
                <h3 class="dossier-username">${user.firstName} ${user.lastName}</h3>
                <p class="dossier-sub-info">Nationality: <strong style="color: var(--primary-color);">${user.nationality}</strong> &bull; Email: <span class="text-secondary">${user.email}</span></p>
            </div>
            
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn-kyc-reject" onclick="processAdministrativeDecision('${user.uid}', 'Rejected')">
                    <i class='bx bx-dislike'></i> Reject Dossier
                </button>
                <button type="button" class="btn-kyc-approve" onclick="processAdministrativeDecision('${user.uid}', 'Approved')">
                    <i class='bx bx-check-shield'></i> Approve Verification
                </button>
            </div>
        </div>

        <div class="vault-workspace-split">
            <div class="attested-info-sheet">
                <h4 class="panel-sub-title"><i class='bx bx-id-card'></i> Attested Registration Information</h4>
                
                <div class="info-display-field">
                    <span class="field-label">Legal First Name</span>
                    <p class="field-value">${user.firstName}</p>
                </div>
                <div class="info-display-field">
                    <span class="field-label">Legal Last Name</span>
                    <p class="field-value">${user.lastName}</p>
                </div>
                <div class="info-display-field">
                    <span class="field-label">Date of Birth</span>
                    <p class="field-value">${user.dob}</p>
                </div>
                <div class="info-display-field">
                    <span class="field-label">Document ID Reference (${user.docType})</span>
                    <p class="field-value">${user.docRef}</p>
                </div>
                <div class="info-display-field">
                    <span class="field-label">Residential Address Declaration</span>
                    <p class="field-value">${user.address}</p>
                </div>

                <div class="compliance-metrics-stack">
                    <div class="metric-strip-card">
                        <span class="metric-strip-label"><i class='bx bx-globe-alt'></i> Risk Assessment Index</span>
                        <span class="metric-strip-value ${user.riskClass}">${user.riskIndex} <small class="text-muted">(${user.riskScore})</small></span>
                    </div>
                    <div class="metric-strip-card">
                        <span class="metric-strip-label"><i class='bx bx-calendar-check'></i> Document Expiry Check</span>
                        <span class="metric-strip-value font-monospace">${user.expiryDate}</span>
                    </div>
                    <div class="metric-strip-card">
                        <span class="metric-strip-label"><i class='bx bx-shield-check'></i> PEP & Sanctions Check</span>
                        <span class="metric-strip-value text-success">${user.pepCheck}</span>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="panel-sub-title"><i class='bx bx-images'></i> Attested Document Proof Vault</h4>
                <div class="document-vault-box">
                    <div class="vault-media-display">
                        <img src="${user.imageSrc}" class="vault-img-render" alt="Attested Asset ${user.uid}" id="activeVaultImage">
                    </div>
                    <div class="vault-footer">
                        <h5 class="vault-filename" title="${user.fileName}">${user.fileName}</h5>
                        <p class="vault-file-meta">Secure Asset Matrix &bull; ${user.fileSize}</p>
                        
                        <div class="vault-actions-row">
                            <button class="vault-btn" onclick="launchFullscreenInspector('${user.imageSrc}', '${user.fileName}')">
                                <i class='bx bx-fullscreen'></i> Inspect Fullscreen
                            </button>
                            <button class="vault-btn primary-action" onclick="executeSecureAuditDownload('${user.uid}', '${user.fileName}')">
                                <i class='bx bx-download'></i> Secure Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

/**
 * Triggers full asset modal rendering / simulation loops 
 */
function launchFullscreenInspector(src, name) {
    alert(`Launching System Media Inspector Window:\nOpening secure container view for file [ ${name} ]\nSource URL target: ${src}`);
}

/**
 * Action tracking: Executes downloads and saves files directly to the device
 */
function executeSecureAuditDownload(uid, filename) {
    console.log(`Administrative security download triggered. UID reference: ${uid}, targeted file token: ${filename}`);
    
    // Create an anchor node link to download the actual image asset
    const user = K_COMPLIANCE_DATASET.find(u => u.uid === uid);
    if (!user) return;
    
    const secureLink = document.createElement('a');
    secureLink.href = user.imageSrc;
    // Enforces saving files with explicit naming architecture configurations
    secureLink.download = `NEXUIST_AUDIT_${uid}_${filename}`;
    secureLink.target = '_blank';
    document.body.appendChild(secureLink);
    secureLink.click();
    document.body.removeChild(secureLink);
}

/**
 * Handles workflow outcomes (Approving / Rejecting identity tokens)
 */
function processAdministrativeDecision(uid, decisionOutcome) {
    const user = K_COMPLIANCE_DATASET.find(u => u.uid === uid);
    if (!user) return;

    // Mutate state matrix settings directly
    user.status = decisionOutcome;

    // Instantly update badge components on the left sidebar list
    const sidebarBadge = document.getElementById(`badge-state-${uid}`);
    if (sidebarBadge) {
        sidebarBadge.textContent = decisionOutcome;
        sidebarBadge.className = "badge-pending-review"; // Reset classes
        if (decisionOutcome === "Approved") sidebarBadge.classList.add("badge-approved");
        if (decisionOutcome === "Rejected") sidebarBadge.classList.add("badge-rejected");
    }

    // Display confirmation alert
    alert(`System Operation Dispatched:\nInvestor entity file associated with ${user.firstName} ${user.lastName} (#${uid}) has been updated to state [ ${decisionOutcome.toUpperCase()} ].`);
    
    // Reload active viewport panel to update view tracking elements seamlessly
    loadUserComplianceVault(uid);
}