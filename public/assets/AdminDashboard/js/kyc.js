// Preloader starts here

// =========================================================
// HIGH-FIDELITY AUTOMATED PRELOADER ENGINE
// =========================================================
(function () {
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

        anchor.addEventListener("click", function (e) {
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
let currentSelectedUid = null;

// Tracks the current selected user object in memory space

document.addEventListener('DOMContentLoaded', () => {
    renderUserQueueFeed();
    // Default system initialization auto-loads the first pending application item
    if (kycData.length > 0) {
        loadUserComplianceVault(kycData[0].uid);
    }
});

/**
 * Builds and renders user cards on the left sidebar
 */
function renderUserQueueFeed() {
    const queueContainer = document.getElementById('usersQueueContainer');
    if (!queueContainer) return;

    queueContainer.innerHTML = "";

    kycData.forEach(user => {
        const initials = `${user.first_name.charAt(0)}${user.last_name.charAt(0)}`.toUpperCase();
        const activeClass = user.id === currentSelectedUid ? "active" : "";

        let statusBadgeClass = "badge-pending-review";
        if (user.status === "Approved") statusBadgeClass += " badge-approved";
        if (user.status === "Rejected") statusBadgeClass += " badge-rejected";

        const cardHtml = `
            <div class="user-queue-card ${activeClass}" id="card-${user.id}" onclick="loadUserComplianceVault('${user.id}')">
                <div class="avatar-initials">${initials}</div>
                <div class="card-profile-info">
                    <h4 class="profile-fullname">${user.first_name} ${user.last_name}</h4>
                    <p class="profile-meta-row">UID: #${user.id} &bull; ${user.docType}</p>
                    <span class="${statusBadgeClass}" id="badge-state-${user.id}">${user.status}</span>
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

    const search = document
        .getElementById("userSearchInput")
        .value
        .toLowerCase();

    document.querySelectorAll('.user-queue-card')
        .forEach(card => {

            const text = card.innerText.toLowerCase();

            card.style.display =
                text.includes(search)
                    ? "flex"
                    : "none";

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
    const user = kycData.find(u => u.id == uid);

    if (!targetPanel || !user) return;

    // Repaint workspace with user parameters, active credential media files, and actions
    targetPanel.innerHTML = `
        <div class="vault-header-split">
            <div>
                <span class="dossier-tag">Verification Dossier In Progress</span>
                <h3 class="dossier-username">${user.first_name} ${user.last_name}</h3>
                <p class="dossier-sub-info">Nationality: <strong style="color: var(--primary-color);">${user.nationality}</strong> &bull; Email: <span class="text-secondary">${user.email}</span></p>
            </div>
            
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn-kyc-reject" onclick="processAdministrativeDecision('${user.id}', 'Rejected')">
                    <i class='bx bx-dislike'></i> Reject Dossier
                </button>
                <button type="button" class="btn-kyc-approve" onclick="processAdministrativeDecision('${user.id}', 'Approved')">
                    <i class='bx bx-check-shield'></i> Approve Verification
                </button>
            </div>
        </div>

        <div class="vault-workspace-split">
            <div class="attested-info-sheet">
                <h4 class="panel-sub-title"><i class='bx bx-id-card'></i> Attested Registration Information</h4>
                
                <div class="info-display-field">
                    <span class="field-label">Legal First Name</span>
                    <p class="field-value">${user.first_name}</p>
                </div>
                <div class="info-display-field">
                    <span class="field-label">Legal Last Name</span>
                    <p class="field-value">${user.last_name}</p>
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
                       <img
    src="/storage/${user.front_image}"
    class="vault-img-render"
    alt="Attested Asset ${user.id}"
    id="activeVaultImage">

                    </div>
                    <div class="vault-footer">
                        <h5 class="vault-filename" title="${user.document_type}">${user.document_type}</h5>
                        <p class="vault-file-meta">Secure Asset Matrix &bull; KYC Document</p>
                        
                        <div class="vault-actions-row">
                            <button class="vault-btn" onclick="launchFullscreenInspector('/storage/${user.front_image}', '${user.document_type}')">
                                <i class='bx bx-fullscreen'></i> Inspect Fullscreen
                            </button>
                            <button class="vault-btn primary-action" onclick="executeSecureAuditDownload('${user.id}', '${user.document_type}')">
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

    const modal = document.createElement('div');

    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.background = 'rgba(0,0,0,.9)';
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    modal.style.zIndex = '99999';

    modal.innerHTML = `
        <img src="${src}"
             style="max-width:90%;max-height:90%;object-fit:contain;">
    `;

    modal.onclick = () => modal.remove();

    document.body.appendChild(modal);
}
/**
 * Action tracking: Executes downloads and saves files directly to the device
 */
function executeSecureAuditDownload(uid, filename) {
    console.log(`Administrative security download triggered. UID reference: ${uid}, targeted file token: ${filename}`);

    // Create an anchor node link to download the actual image asset
    const user = kycData.find(u => u.id == uid);
    if (!user) return;

    const secureLink = document.createElement('a');
    secureLink.href = `/storage/${user.front_image}`;    // Enforces saving files with explicit naming architecture configurations
    secureLink.download = `NEXUIST_AUDIT_${uid}_${filename}`;
    secureLink.target = '_blank';
    document.body.appendChild(secureLink);
    secureLink.click();
    document.body.removeChild(secureLink);
}

/**
 * Handles workflow outcomes (Approving / Rejecting identity tokens)
 */
async function processAdministrativeDecision(uid, decisionOutcome) {

    try {

        const response = await fetch(`/admin/kyc/${uid}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]'
                ).content
            },
            body: JSON.stringify({
                status: decisionOutcome
            })
        });

        if (!response.ok) {
            throw new Error('Server Error');
        }

        const data = await response.json();

        if (data.success) {

            alert(`User ${decisionOutcome} successfully`);

            // Reload page
            window.location.reload();

        } else {

            alert(data.message || 'Operation failed');

        }

    } catch (error) {

        console.error(error);

        alert(error.message);

    }
}


// 
let kycData = [];

async function loadKycData() {
    try {

        const response = await fetch('/admin/kyc/data');

        kycData = await response.json();

        renderUserQueueFeed();

        if (kycData.length > 0) {
            loadUserComplianceVault(kycData[0].id);
        }

    } catch (error) {

        console.error(error);

    }
}

loadKycData();



