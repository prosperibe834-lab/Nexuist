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
   NEXUIST FINTECH CORE MAIN HANDLER
========================================= */
document.addEventListener("DOMContentLoaded", () => {
    initTabModuleNavigation();
    initNotificationFormListeners();
    initLiveOrderTransmissions();
    initPackageFormSubmission();
    initPreviewCardActions();
    initSubscriberActionButtons();
});

/**
 * Tab Navigation Controller Logic
 * Switches target modules smoothly without page refreshes
 */
function initTabModuleNavigation() {
    const tabButtons = document.querySelectorAll(".nexuist-tab-container .tab-btn");
    const moduleViews = document.querySelectorAll(".nexuist-dashboard-container .module-view");

    tabButtons.forEach(button => {
        button.addEventListener("click", () => {
            const targetId = button.getAttribute("data-target");

            // Deactivate existing control signatures
            tabButtons.forEach(btn => btn.classList.remove("active"));
            moduleViews.forEach(view => view.classList.remove("active-view"));

            // Commit active structural layers
            button.classList.add("active");
            const targetView = document.getElementById(targetId);
            if (targetView) {
                targetView.classList.add("active-view");
            }
        });
    });
}

/**
 * Toast Alerts Engine Object Model
 */
function showFintechToast(title, description, isWarning = false) {
    const toastNode = document.getElementById("nexuist-toast");
    const titleNode = document.getElementById("toast-title-node");
    const descNode = document.getElementById("toast-desc-node");
    const iconNode = toastNode.querySelector(".toast-content-wrapper i");

    titleNode.textContent = title;
    descNode.textContent = description;

    if (isWarning) {
        toastNode.style.borderColor = "#ef4444";
        iconNode.className = "bx bx-error-circle text-red";
    } else {
        toastNode.style.borderColor = "var(--primary-color)";
        iconNode.className = "bx bx-check-shield text-green";
    }

    toastNode.className = "toast-visible";

    setTimeout(() => {
        toastNode.className = "toast-hidden";
    }, 4000);
}

/**
 * Live Broadcast Order Signal System Form Mapping
 */
function initLiveOrderTransmissions() {
    const liveSignalForm = document.getElementById("live-signal-form");
    if (!liveSignalForm) return;

    liveSignalForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const action = liveSignalForm.action;
        const token = document.querySelector('meta[name="csrf-token"]').content;

        const formData = new FormData(liveSignalForm);

        try {
            const response = await fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showFintechToast('Live Signal Created', 'Live signal has been submitted successfully.');
                liveSignalForm.reset();
                return;
            }

            showFintechToast('Error Sending Signal', data.message || 'Unable to create live signal.', true);
        } catch (error) {
            showFintechToast('Network Error', error.message || 'Please try again.', true);
        }
    });
}

function initPackageFormSubmission() {
    const packageForm = document.getElementById("create-package-form");
    if (!packageForm) return;

    packageForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const action = packageForm.action;
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const formData = new FormData(packageForm);

        try {
            const response = await fetch(action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const data = await response.json();
            if (response.ok && data.success) {
                showFintechToast('Package Created', 'Your new signal package is saved and live.');
                packageForm.reset();
                return;
            }

            showFintechToast('Error Saving Package', data.message || 'Unable to save the package.', true);
        } catch (error) {
            showFintechToast('Network Error', error.message || 'Please try again.', true);
        }
    });
}

function initPreviewCardActions() {
    const previewCard = document.getElementById('live-package-preview-card');
    if (!previewCard) return;

    const editButton = previewCard.querySelector('.edit-m');
    const deleteButton = previewCard.querySelector('.delete-m');
    const title = previewCard.querySelector('h5');
    const subtitle = previewCard.querySelector('span');

    if (editButton) {
        editButton.addEventListener('click', () => {
            const newName = prompt('Enter a new package name:', title.textContent.trim());
            if (newName) {
                title.textContent = newName;
                showFintechToast('Preview Updated', 'Package preview has been updated locally.');
            }
        });
    }

    if (deleteButton) {
        deleteButton.addEventListener('click', () => {
            previewCard.remove();
            showFintechToast('Package Removed', 'Preview card has been removed.');
        });
    }
}

function initSubscriberActionButtons() {
    const subscriberRows = document.querySelectorAll('.view-subscriber-btn, .edit-subscriber-btn, .delete-subscriber-btn');
    if (!subscriberRows.length) return;
    const token = document.querySelector('meta[name="csrf-token"]').content;

    subscriberRows.forEach((button) => {
        button.addEventListener('click', async () => {
            const investmentId = button.getAttribute('data-investment-id');
            const row = button.closest('tr');

            if (button.classList.contains('view-subscriber-btn')) {
                const userName = row.querySelector('td strong')?.textContent || 'Subscriber';
                const userEmail = row.querySelector('td span')?.textContent || '';
                showFintechToast('Subscriber Info', `${userName} ${userEmail}`);
                return;
            }

            if (button.classList.contains('edit-subscriber-btn')) {
                const url = button.dataset.toggleUrl || `/admin/premium/subscriber/${investmentId}/toggle-status`;
                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({})
                    });
                    const data = await response.json();
                    if (response.ok && data.success) {
                        const statusCell = row.querySelector('td span.badge-status');
                        if (statusCell) {
                            statusCell.textContent = data.status;
                            statusCell.classList.toggle('active-st', data.status === 'Active');
                            statusCell.classList.toggle('pending-st', data.status !== 'Active');
                        }
                        showFintechToast('Status Updated', data.message);
                        return;
                    }
                    showFintechToast('Error Updating Status', data.message || 'Unable to update subscriber status.', true);
                } catch (error) {
                    showFintechToast('Network Error', error.message || 'Please try again.', true);
                }
                return;
            }

            if (button.classList.contains('delete-subscriber-btn')) {
                if (!confirm('Remove this subscriber record?')) return;
                const url = button.dataset.deleteUrl || `/admin/premium/subscriber/${investmentId}`;
                try {
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const data = await response.json();
                    if (response.ok && data.success) {
                        row.remove();
                        showFintechToast('Subscriber Removed', data.message);
                        return;
                    }
                    showFintechToast('Error Removing Subscriber', data.message || 'Unable to delete subscriber.', true);
                } catch (error) {
                    showFintechToast('Network Error', error.message || 'Please try again.', true);
                }
            }
        });
    });
}

/**
 * Notifications Matrix Logic
 */
function initNotificationFormListeners() {
    const audienceSelect = document.getElementById("notif-target-audience");
    const singleUserContainer = document.getElementById("single-user-input-container");
    const broadcastForm = document.getElementById("notification-broadcast-form");

    if (audienceSelect && singleUserContainer) {
        audienceSelect.addEventListener("change", (e) => {
            if (e.target.value === "single") {
                singleUserContainer.style.display = "flex";
            } else {
                singleUserContainer.style.display = "none";
            }
        });
    }

    if (broadcastForm) {
        broadcastForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const headline = broadcastForm.querySelector("input[placeholder*='Headline']").value;
            
            showFintechToast(
                "Omni-Broadcast Executed", 
                `Alert broadcast payload successfully sent to targeted user network cluster.`
            );
            broadcastForm.reset();
            if (singleUserContainer) singleUserContainer.style.display = "none";
        });
    }
}