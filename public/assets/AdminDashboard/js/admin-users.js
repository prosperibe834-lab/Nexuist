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

// =========================================================================
// NEXUIST ADMINISTRATIVE FRAMEWORK - CORE WEBSITE SETTINGS RUNTIME LOGIC
// =========================================================================
// Master Local State Database Engine
let nexDbArray = [
    { id: "NX-70291", username: "cyber_boss", fullName: "Prosper Ibe", email: "admin@nexuist.com", phone: "+234 810 000 1111", gender: "Male", role: "Super Admin", status: "Active", regDate: "2026-01-10", lastLogin: "2026-07-06 14:22", ip: "102.89.44.18", config: "Chrome/Win10", country: "Nigeria", activity: "Created User Account" },
    { id: "NX-44810", username: "monica_h", fullName: "Monica Hughes", email: "monica@nexuist.com", phone: "+234 901 222 3333", gender: "Female", role: "Admin", status: "Active", regDate: "2026-03-14", lastLogin: "2026-07-06 09:15", ip: "197.210.64.5", config: "Safari/iOS17", country: "Nigeria", activity: "Approved Settlement Node" },
    { id: "NX-10294", username: "dev_alpha", fullName: "John Doe", email: "john@nexuist.com", phone: "+1 415 555 2671", gender: "Male", role: "Admin", status: "Suspended", regDate: "2025-11-05", lastLogin: "2026-06-20 18:40", ip: "64.233.160.10", config: "Firefox/Linux", country: "United States", activity: "Logged Out" },
    { id: "NX-30912", username: "ops_sec", fullName: "Sarah Connor", email: "sarah@nexuist.com", phone: "+44 20 7946 0192", gender: "Female", role: "Admin", status: "Pending", regDate: "2026-06-29", lastLogin: "---", ip: "---", config: "---", country: "United Kingdom", activity: "System Onboarding Verification" }
];

let nexTargetRowId = null;

document.addEventListener("DOMContentLoaded", () => {
    bindNexTableRecords(nexDbArray);
    initNexFilterListeners();
});

// Master Table Builder Loop
function bindNexTableRecords(dataset) {
    const tBody = document.getElementById("nexTableBody");
    const tWrapper = document.getElementById("nexTableWrapper");
    const emptyCard = document.getElementById("nexEmptyState");

    tBody.innerHTML = "";

    if (!dataset || dataset.length === 0) {
        tWrapper.classList.add("nex-hidden");
        emptyCard.classList.remove("nex-hidden");
        return;
    }

    tWrapper.classList.remove("nex-hidden");
    emptyCard.classList.add("nex-hidden");

    dataset.forEach(row => {
        const seedAvatar = `https://api.dicebear.com/7.x/adventurer/svg?seed=${row.username}`;
        const sClass = row.status.toLowerCase();
        const rClass = row.role.toLowerCase().replace(" ", "-");

        const rowTemplate = `
            <tr>
                <td><img src="${seedAvatar}" class="nex-avatar-frame"></td>
                <td><strong>${row.id}</strong></td>
                <td>@${row.username}</td>
                <td>${row.fullName}</td>
                <td>${row.email}</td>
                <td>${row.phone}</td>
                <td>${row.gender}</td>
                <td><span class="nex-badge ${rClass}">${row.role}</span></td>
                <td><span class="nex-badge ${sClass}">${row.status}</span></td>
                <td>${row.regDate}</td>
                <td>${row.lastLogin}</td>
                <td>${row.config}</td>
                <td>${row.country}</td>
                <td>${row.activity}</td>
                <td class="nex-action-cell">
                    <button class="nex-btn-action view" onclick="openNexProfileView('${row.id}')" title="Inspect Profile"><i class="bx bx-show"></i></button>
                    <button class="nex-btn-action edit" onclick="openNexProfileEdit('${row.id}')" title="Modify Parameters"><i class="bx bx-edit-alt"></i></button>
                    <button class="nex-btn-action delete" onclick="triggerPipelineIntercept('delete', '${row.id}')" title="Delete Profile"><i class="bx bx-trash"></i></button>
                    ${row.status === 'Active' ? 
                        `<button class="nex-btn-action suspend" onclick="triggerPipelineIntercept('suspend', '${row.id}')" title="Suspend Access"><i class="bx bx-block"></i></button>` :
                        `<button class="nex-btn-action activate" onclick="triggerPipelineIntercept('activate', '${row.id}')" title="Activate Access"><i class="bx bx-check-circle"></i></button>`
                    }
                    <button class="nex-btn-action" onclick="openNexPasswordDeck('${row.id}')" title="Credential Lifecycle"><i class="bx bx-key"></i></button>
                    <button class="nex-btn-action" onclick="openNexTimelineLogs('${row.username}')" title="Audit Log Timeline"><i class="bx bx-history"></i></button>
                </td>
            </tr>
        `;
        tBody.insertAdjacentHTML("beforeend", rowTemplate);
    });
}

// Search and Filter Handling Pipeline Elements
function initNexFilterListeners() {
    const search = document.getElementById("nexSearch");
    const roleF = document.getElementById("nexRoleFilter");
    const sortF = document.getElementById("nexSortFilter");

    const execFilterRoutine = () => {
        const query = search.value.toLowerCase().trim();
        const role = roleF.value;

        let trackingPool = nexDbArray.filter(item => {
            const hitSearch = item.id.toLowerCase().includes(query) ||
                              item.username.toLowerCase().includes(query) ||
                              item.fullName.toLowerCase().includes(query) ||
                              item.email.toLowerCase().includes(query);
            
            let hitRole = true;
            if (role === "active") hitRole = item.status === "Active";
            else if (role === "suspended") hitRole = item.status === "Suspended";
            else if (role === "pending") hitRole = item.status === "Pending";
            else if (role === "super") hitRole = item.role === "Super Admin";

            return hitSearch && hitRole;
        });

        if (sortF.value === "oldest") {
            trackingPool.sort((a,b) => new Date(a.regDate) - new Date(b.regDate));
        } else {
            trackingPool.sort((a,b) => new Date(b.regDate) - new Date(a.regDate));
        }
        bindNexTableRecords(trackingPool);
    };

    search.addEventListener("input", execFilterRoutine);
    roleF.addEventListener("change", execFilterRoutine);
    sortF.addEventListener("change", execFilterRoutine);
}

// Modal Animation Drivers
function openNexModal(id) { document.getElementById(id).classList.add("open"); }
function closeNexModal(id) { document.getElementById(id).classList.remove("open"); }

// Data Parsing Profiles Into Modal Views
function openNexProfileView(id) {
    const target = nexDbArray.find(a => a.id === id);
    if (!target) return;

    document.getElementById("vAvatar").src = `https://api.dicebear.com/7.x/adventurer/svg?seed=${target.username}`;
    document.getElementById("vFullName").textContent = target.fullName;
    document.getElementById("vAdminId").textContent = target.id;
    document.getElementById("vUsername").textContent = `@${target.username}`;
    document.getElementById("vEmail").textContent = target.email;
    document.getElementById("vPhone").textContent = target.phone;
    document.getElementById("vGender").textContent = target.gender;
    document.getElementById("vRegDate").textContent = target.regDate;
    document.getElementById("vLastLogin").textContent = target.lastLogin;
    document.getElementById("vIp").textContent = target.ip;
    document.getElementById("vConfig").textContent = target.config;
    document.getElementById("vCountry").textContent = target.country;

    document.getElementById("vRoleBadge").className = `nex-badge ${target.role.toLowerCase().replace(" ", "-")}`;
    document.getElementById("vRoleBadge").textContent = target.role;
    document.getElementById("vStatusBadge").className = `nex-badge ${target.status.toLowerCase()}`;
    document.getElementById("vStatusBadge").textContent = target.status;

    document.getElementById("vEditTriggerBtn").onclick = () => { closeNexModal("viewAdminModal"); openNexProfileEdit(id); };
    openNexModal("viewAdminModal");
}

function openNexProfileEdit(id) {
    const target = nexDbArray.find(a => a.id === id);
    if (!target) return;

    document.getElementById("eRowId").value = target.id;
    document.getElementById("eUsername").value = target.username;
    document.getElementById("eFullName").value = target.fullName;
    document.getElementById("eEmail").value = target.email;
    document.getElementById("ePhone").value = target.phone;
    document.getElementById("eGender").value = target.gender;
    document.getElementById("eRole").value = target.role;
    document.getElementById("eStatus").value = target.status;

    openNexModal("editAdminModal");
}

function commitNexFormEdit(e) {
    e.preventDefault();
    const id = document.getElementById("eRowId").value;
    const index = nexDbArray.findIndex(a => a.id === id);

    if (index !== -1) {
        nexDbArray[index].username = document.getElementById("eUsername").value;
        nexDbArray[index].fullName = document.getElementById("eFullName").value;
        nexDbArray[index].email = document.getElementById("eEmail").value;
        nexDbArray[index].phone = document.getElementById("ePhone").value;
        nexDbArray[index].gender = document.getElementById("eGender").value;
        nexDbArray[index].role = document.getElementById("eRole").value;
        nexDbArray[index].status = document.getElementById("eStatus").value;

        bindNexTableRecords(nexDbArray);
        closeNexModal("editAdminModal");
        fireNexToast("Admin Updated Successfully", "success");
    }
}

// Core Confirmation Pipelines Control Drivers
function triggerPipelineIntercept(type, id) {
    nexTargetRowId = id;
    const title = document.getElementById("dialogHeadline");
    const subtext = document.getElementById("dialogSubtext");
    const confirmBtn = document.getElementById("dialogConfirmActionBtn");
    const iconBox = document.getElementById("dialogIconBox");

    iconBox.className = "nex-dialog-icon " + (type === 'delete' ? 'danger' : '');
    iconBox.innerHTML = type === 'delete' ? `<i class="bx bx-trash"></i>` : `<i class="bx bx-shield-x"></i>`;

    if (type === 'delete') {
        title.textContent = "Permanently Delete Account?";
        subtext.textContent = "Are you absolutely sure? This action will wipe this administrator's profile completely out of records.";
        confirmBtn.onclick = runDeleteExecution;
    } else if (type === 'suspend') {
        title.textContent = "Suspend Access Token Clearance?";
        subtext.textContent = "This configuration shuts off access to terminal portals until authorization parameters are rolled back.";
        confirmBtn.onclick = runSuspendExecution;
    } else if (type === 'activate') {
        title.textContent = "Activate Access Token Clearance?";
        subtext.textContent = "Restores status to active baseline, allowing the user full entry to designated infrastructure maps.";
        confirmBtn.onclick = runActivateExecution;
    }
    openNexModal("confirmActionModal");
}

function runDeleteExecution() {
    nexDbArray = nexDbArray.filter(a => a.id !== nexTargetRowId);
    bindNexTableRecords(nexDbArray);
    closeNexModal("confirmActionModal");
    fireNexToast("Admin Deleted Successfully", "error");
}

function runSuspendExecution() {
    const match = nexDbArray.find(a => a.id === nexTargetRowId);
    if (match) { match.status = "Suspended"; bindNexTableRecords(nexDbArray); }
    closeNexModal("confirmActionModal");
    fireNexToast("Admin Suspended", "info");
}

function runActivateExecution() {
    const match = nexDbArray.find(a => a.id === nexTargetRowId);
    if (match) { match.status = "Active"; bindNexTableRecords(nexDbArray); }
    closeNexModal("confirmActionModal");
    fireNexToast("Admin Activated", "success");
}

// Password Component Logic Actions
function openNexPasswordDeck(id) {
    const target = nexDbArray.find(a => a.id === id);
    if (!target) return;
    document.getElementById("pwdAdminName").textContent = target.fullName;
    document.getElementById("pwdAdminEmail").textContent = target.email;
    document.getElementById("tempGeneratedPassword").value = "";
    openNexModal("passwordResetModal");
}

function generateSecureRandomTokenString() {
    const chars = "ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789!@#$";
    let token = "";
    for (let i = 0; i < 14; i++) token += chars.charAt(Math.floor(Math.random() * chars.length));
    document.getElementById("tempGeneratedPassword").value = token;
    fireNexToast("Password Reset Successfully", "success");
}

function copyPasswordTokenToClipboard() {
    const field = document.getElementById("tempGeneratedPassword");
    if (!field.value) return;
    field.select();
    navigator.clipboard.writeText(field.value);
    fireNexToast("Token copied onto device secure clipboard layer.", "success");
}

// Timeline Dynamic Builders Engine
function openNexTimelineLogs(username) {
    const box = document.getElementById("nexTimelineBox");
    box.innerHTML = "";

    const trails = [
        { icon: "bx-log-in-circle", action: "Logged In", time: "Just Now", color: "#10b981" },
        { icon: "bx-user-check", action: "Approved Settlement Node", time: "2 hours ago", color: "#00d4ff" },
        { icon: "bx-cog", action: "Edited System Profile Configurations", time: "Yesterday", color: "#f59e0b" }
    ];

    trails.forEach(t => {
        box.insertAdjacentHTML("beforeend", `
            <div class="nex-timeline-node">
                <div class="nex-node-dot" style="border-color:${t.color}; color:${t.color}"><i class="bx ${t.icon}"></i></div>
                <div class="nex-node-info"><h5>${t.action}</h5><span>${t.time}</span></div>
            </div>
        `);
    });
    openNexModal("activityLogModal");
}

// Database Refresh Simulator Routine
function triggerNexRefresh() {
    const icon = document.getElementById("nexRefreshIcon");
    const loader = document.getElementById("nexSkeleton");
    const table = document.getElementById("nexTableWrapper");

    icon.style.transform = "rotate(360deg)";
    icon.style.transition = "transform 0.7s cub-bezier(0.4, 0, 0.2, 1)";
    table.classList.add("nex-hidden");
    loader.classList.remove("nex-hidden");

    setTimeout(() => {
        icon.style.transform = "rotate(0deg)";
        icon.style.transition = "none";
        loader.classList.add("nex-hidden");
        table.classList.remove("nex-hidden");
        bindNexTableRecords(nexDbArray);
        fireNexToast("Cache records synchronization matching live parameters.", "success");
    }, 1100);
}

// Custom Premium Notification System Component
function fireNexToast(text, profile = "success") {
    const container = document.getElementById("toastHub");
    const toast = document.createElement("div");
    toast.className = `nex-toast ${profile}`;
    toast.innerHTML = `<i class="bx bx-check-shield"></i><span>${text}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = "0";
        toast.style.transform = "translateY(-12px)";
        toast.style.transition = "all 0.3s ease";
        setTimeout(() => toast.remove(), 300);
    }, 3200);
}