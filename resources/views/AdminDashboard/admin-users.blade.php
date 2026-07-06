<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexuist Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/AdminDashboard/css/admin-users.css') }}">
</head>

<body>

    <!-- Preloader starts here -->

    <div id="nexuist-preloader">
        <div class="loader-terminal-box">
            <i class='bx bx-cube-alt loader-brand-icon'></i>
            <div class="glow-bars-container">
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
                <div class="glow-bar"></div>
            </div>
            <span class="loader-status-text">CONNECTING TO SECURE NODE...</span>
        </div>
    </div>

    <!-- Preloader ends here -->

        @include('AdminDashboard.layouts.admin-sidebar')


    <main class="main-content">
        <header class="top-header">
            <div class="header-left">
                <i class='bx bx-menu' id="mobile-hamburger-btn"></i>
                <h1 id="page-title-display">Admin Users</h1>
            </div>
            <div class="header-right">
            </div>
        </header>

        <!-- Main starts here -->

        <div class="nex-dashboard">
    <div id="toastHub" class="nex-toast-hub"></div>

    <header class="nex-header">
        <div class="nex-header-info">
            <h1 class="nex-page-title">Admin Users</h1>
            <p class="nex-page-subtitle">Manage administrator accounts, monitor activities, and control administrative access across the platform.</p>
        </div>
        <button class="nex-btn nex-btn-primary" onclick="openNexModal('createAdminModal')">
            <i class="bx bx-user-plus"></i>
            <span>Create Admin</span>
        </button>
    </header>

    <section class="nex-metrics-grid">
        <div class="nex-card nex-stat-card">
            <div class="nex-card-accent border-primary"></div>
            <div class="nex-stat-header">
                <span class="nex-stat-label">Total Admins</span>
                <div class="nex-icon-box text-primary"><i class="bx bx-shield-quarter"></i></div>
            </div>
            <div class="nex-stat-counter" id="totalAdminsCount">0</div>
            <div class="nex-stat-footer">
                <span class="nex-trend up"><i class="bx bx-trending-up"></i> +0%</span>
                <span class="nex-trend-label">this month</span>
            </div>
        </div>

        <div class="nex-card nex-stat-card">
            <div class="nex-card-accent border-secondary"></div>
            <div class="nex-stat-header">
                <span class="nex-stat-label">Active Admins</span>
                <div class="nex-icon-box text-secondary"><i class="bx bx-pulse"></i></div>
            </div>
            <div class="nex-stat-counter" id="activeAdminsCount">0</div>
            <div class="nex-stat-footer">
                <span class="nex-pulse-node"></span>
                <span class="nex-trend-label text-active">Live Active Sync</span>
            </div>
        </div>

        <div class="nex-card nex-stat-card">
            <div class="nex-card-accent border-error"></div>
            <div class="nex-stat-header">
                <span class="nex-stat-label">Suspended Admins</span>
                <div class="nex-icon-box text-error"><i class="bx bx-user-x"></i></div>
            </div>
            <div class="nex-stat-counter" id="suspendedAdminsCount">0</div>
            <div class="nex-stat-footer">
                <span class="nex-trend static">Stable baseline</span>
            </div>
        </div>

        <div class="nex-card nex-stat-card">
            <div class="nex-card-accent border-accent"></div>
            <div class="nex-stat-header">
                <span class="nex-stat-label">Super Admins</span>
                <div class="nex-icon-box text-accent"><i class="bx bx-crown"></i></div>
            </div>
            <div class="nex-stat-counter" id="superAdminsCount">0</div>
            <div class="nex-stat-footer">
                <span class="nex-trend up"><i class="bx bx-check-shield"></i> Root Vault</span>
            </div>
        </div>
    </section>

    <section class="nex-card nex-toolbar">
        <div class="nex-search-field">
            <i class="bx bx-search"></i>
            <input type="text" id="nexSearch" placeholder="Search by username, full name, email, phone number, Admin ID...">
        </div>
        <div class="nex-filter-group">
            <select id="nexRoleFilter" class="nex-select">
                <option value="all">All Admins</option>
                <option value="active">Active</option>
                <option value="suspended">Suspended</option>
                <option value="super">Super Admin</option>
                <option value="pending">Pending</option>
            </select>
            <select id="nexSortFilter" class="nex-select">
                <option value="recent">Recently Added</option>
                <option value="oldest">Oldest</option>
            </select>
            <button class="nex-btn-icon" onclick="triggerNexRefresh()" title="Refresh Master Database">
                <i class="bx bx-refresh" id="nexRefreshIcon"></i>
            </button>
            <button class="nex-btn-icon" onclick="fireNexToast('Data records downloaded as CSV pipeline summary.', 'info')" title="Export File Records">
                <i class="bx bx-export"></i>
            </button>
        </div>
    </section>

    <div class="nex-table-viewport nex-card">
        <div id="nexSkeleton" class="nex-skeleton-container nex-hidden">
            <div class="nex-skeleton-head"></div>
            <div class="nex-skeleton-row"></div>
            <div class="nex-skeleton-row"></div>
            <div class="nex-skeleton-row"></div>
        </div>

        <div id="nexTableWrapper" class="nex-responsive-wrapper">
            <table class="nex-table">
                <thead>
                    <tr>
                        <th><i class="bx bx-smile"></i> Avatar</th>
                        <th><i class="bx bx-fingerprint"></i> Admin ID</th>
                        <th><i class="bx bx-at"></i> Username</th>
                        <th><i class="bx bx-user"></i> Full Name</th>
                        <th><i class="bx bx-envelope"></i> Email</th>
                        <th><i class="bx bx-phone"></i> Phone Number</th>
                        <th><i class="bx bx-male-female"></i> Gender</th>
                        <th><i class="bx bx-crown"></i> Role</th>
                        <th><i class="bx bx-check-circle"></i> Status</th>
                        <th><i class="bx bx-calendar"></i> Reg Date</th>
                        <th><i class="bx bx-log-in-circle"></i> Last Login</th>
                        <th><i class="bx bx-desktop"></i> Client Config</th>
                        <th><i class="bx bx-globe"></i> Region</th>
                        <th><i class="bx bx-pulse"></i> Last Activity</th>
                        <th class="nex-sticky-header-actions">Actions</th>
                    </tr>
                </thead>
                <tbody id="nexTableBody">
                    </tbody>
            </table>
        </div>

        <div id="nexEmptyState" class="nex-empty-state nex-hidden">
            <i class="bx bx-layer-plus"></i>
            <h3>No Administrators Found</h3>
            <p>We couldn't pull any operational records corresponding to your chosen active filter scopes.</p>
            <button class="nex-btn nex-btn-primary" onclick="openNexModal('createAdminModal')">Create First Admin</button>
        </div>
    </div>

    <footer class="nex-pagination">
        <button class="nex-btn-page prev-next" disabled><i class="bx bx-chevron-left"></i> Prev</button>
        <div class="nex-page-nodes">
            <span class="nex-node active">1</span>
            <span class="nex-node">2</span>
            <span class="nex-node">3</span>
        </div>
        <button class="nex-btn-page prev-next">Next <i class="bx bx-chevron-right"></i></button>
    </footer>
</div>

<div id="viewAdminModal" class="nex-modal-overlay">
    <div class="nex-modal-box large-box">
        <div class="nex-modal-header">
            <h3><i class="bx bx-network-chart text-primary"></i> Master Administrative Record</h3>
            <button class="nex-close" onclick="closeNexModal('viewAdminModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="nex-modal-body">
            <div class="nex-hero-profile">
                <img id="vAvatar" src="" alt="Avatar">
                <div class="nex-hero-text">
                    <h2 id="vFullName">---</h2>
                    <p><span class="nex-badge" id="vRoleBadge">---</span> <span class="nex-badge" id="vStatusBadge">---</span></p>
                </div>
            </div>
            <div class="nex-details-grid">
                <div class="nex-item"><label>Admin ID</label><p id="vAdminId">---</p></div>
                <div class="nex-item"><label>Username</label><p id="vUsername">---</p></div>
                <div class="nex-item"><label>Email Address</label><p id="vEmail">---</p></div>
                <div class="nex-item"><label>Phone Number</label><p id="vPhone">---</p></div>
                <div class="nex-item"><label>Gender Orientation</label><p id="vGender">---</p></div>
                <div class="nex-item"><label>System Registration Date</label><p id="vRegDate">---</p></div>
                <div class="nex-item"><label>Last Verified Session</label><p id="vLastLogin">---</p></div>
                <div class="nex-item"><label>Client Core IP Address</label><p id="vIp">---</p></div>
                <div class="nex-item"><label>Terminal Config Architecture</label><p id="vConfig">---</p></div>
                <div class="nex-item"><label>Registered Geo Location</label><p id="vCountry">---</p></div>
                <div class="nex-item"><label>Two-Factor Auth Enforcement</label><p class="text-secondary"><i class="bx bx-shield-quarter"></i> Programmatic Enabled</p></div>
                <div class="nex-item"><label>Access Control Clear Tier</label><p class="text-accent"><i class="bx bx-lock-open-alt"></i> Master System Clearance</p></div>
            </div>
        </div>
        <div class="nex-modal-footer">
            <button class="nex-btn nex-btn-secondary" onclick="closeNexModal('viewAdminModal')">Close Viewport</button>
            <button class="nex-btn nex-btn-primary" id="vEditTriggerBtn"><i class="bx bx-edit-alt"></i> Intercept Profile</button>
        </div>
    </div>
</div>

<div id="editAdminModal" class="nex-modal-overlay">
    <div class="nex-modal-box">
        <div class="nex-modal-header">
            <h3><i class="bx bx-edit-alt text-secondary"></i> Edit Account Parameters</h3>
            <button class="nex-close" onclick="closeNexModal('editAdminModal')"><i class="bx bx-x"></i></button>
        </div>
        <form id="nexEditForm" onsubmit="commitNexFormEdit(event)">
            <input type="hidden" id="eRowId">
            <div class="nex-modal-body modal-stack">
                <div class="nex-input-container">
                    <label>Username Handle</label>
                    <input type="text" id="eUsername" required>
                </div>
                <div class="nex-input-container">
                    <label>Full Authority Identity Name</label>
                    <input type="text" id="eFullName" required>
                </div>
                <div class="nex-input-container">
                    <label>Administrative Email Address</label>
                    <input type="email" id="eEmail" required>
                </div>
                <div class="nex-input-container">
                    <label>Secure Core Communications Phone</label>
                    <input type="text" id="ePhone" required>
                </div>
                <div class="nex-input-container">
                    <label>Gender Scope</label>
                    <select id="eGender" class="nex-select full-width">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="nex-input-container">
                    <label>Authority Account Role</label>
                    <select id="eRole" class="nex-select full-width">
                        <option value="Admin">Admin</option>
                        <option value="Super Admin">Super Admin</option>
                    </select>
                </div>
                <div class="nex-input-container">
                    <label>Account System Lifecycle Status</label>
                    <select id="eStatus" class="nex-select full-width">
                        <option value="Active">Active</option>
                        <option value="Suspended">Suspended</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
            </div>
            <div class="nex-modal-footer">
                <button type="button" class="nex-btn nex-btn-secondary" onclick="closeNexModal('editAdminModal')">Dismiss</button>
                <button type="submit" class="nex-btn nex-btn-primary"><i class="bx bx-save"></i> Commit Changes</button>
            </div>
        </form>
    </div>
</div>

<div id="confirmActionModal" class="nex-modal-overlay">
    <div class="nex-modal-box dialog-box text-center">
        <div id="dialogIconBox" class="nex-dialog-icon"><i class="bx bx-info-circle"></i></div>
        <h3 id="dialogHeadline" class="margin-bottom-sm">Security Confirmation</h3>
        <p id="dialogSubtext" class="nex-page-subtitle margin-bottom-lg">Are you sure you want to execute this terminal command pipeline state parameter?</p>
        <div class="nex-modal-footer justify-center">
            <button class="nex-btn nex-btn-secondary" onclick="closeNexModal('confirmActionModal')">Cancel Action</button>
            <button class="nex-btn nex-btn-primary" id="dialogConfirmActionBtn">Confirm Execution</button>
        </div>
    </div>
</div>

<div id="passwordResetModal" class="nex-modal-overlay">
    <div class="nex-modal-box">
        <div class="nex-modal-header">
            <h3><i class="bx bx-key text-accent"></i> Credential Control Deck</h3>
            <button class="nex-close" onclick="closeNexModal('passwordResetModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="nex-modal-body modal-stack">
            <div class="nex-banner-info">
                <p><strong>Target Identity:</strong> <span id="pwdAdminName">---</span></p>
                <p><strong>Routing Mail:</strong> <span id="pwdAdminEmail">---</span></p>
            </div>
            <div class="nex-input-container">
                <label>Temporary Active Access Key Token</label>
                <div class="nex-input-action-row">
                    <input type="text" id="tempGeneratedPassword" class="nex-styled-readonly" readonly placeholder="Awaiting configuration token...">
                    <button class="nex-btn-icon" onclick="copyPasswordTokenToClipboard()" title="Copy Key Token"><i class="bx bx-copy"></i></button>
                </div>
            </div>
        </div>
        <div class="nex-modal-footer flex-column-layout">
            <button class="nex-btn nex-btn-primary industrial-width" onclick="generateSecureRandomTokenString()"><i class="bx bx-shuffle"></i> Calculate Temporary Password</button>
            <button class="nex-btn nex-btn-secondary industrial-width" onclick="fireNexToast('Encrypted security package pushed through mail server.', 'success')"><i class="bx bx-paper-plane"></i> Dispatch Password via Email</button>
        </div>
    </div>
</div>

<div id="activityLogModal" class="nex-modal-overlay">
    <div class="nex-modal-box">
        <div class="nex-modal-header">
            <h3><i class="bx bx-history text-secondary"></i> Architectural Audit Log Timeline</h3>
            <button class="nex-close" onclick="closeNexModal('activityLogModal')"><i class="bx bx-x"></i></button>
        </div>
        <div class="nex-modal-body">
            <div class="nex-timeline" id="nexTimelineBox">
                </div>
        </div>
    </div>
</div>
    </main>

    <script src="{{ asset('assets/AdminDashboard/js/admin-users.js') }}"></script>
</body>

</html>
