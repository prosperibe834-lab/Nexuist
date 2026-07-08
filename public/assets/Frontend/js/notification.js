// Preloader starts here
document.addEventListener("DOMContentLoaded", () => {
    const preloader = document.getElementById("fintech-preloader");
    const loadBar = document.getElementById("load-bar");
    const statusText = document.getElementById("status-text");

    const messages = [
        "Initializing encrypted connection...",
        "Fetching live market data...",
        "Securing wallet protocols...",
        "Synchronizing portfolio stats...",
        "Welcome to Nexuist"
    ];

    let progress = 0;
    let messageIndex = 0;

    // Simulate real loading behavior
    const interval = setInterval(() => {
        progress += Math.random() * 15; // Random jump for realism
        
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);
            
            // Fade out the preloader
            setTimeout(() => {
                preloader.classList.add("preloader-hidden");
                // Optional: Remove from DOM after transition
                setTimeout(() => preloader.remove(), 600);
            }, 500);
        }

        // Update bar and text
        loadBar.style.width = progress + "%";
        
        // Update status message based on progress
        if (progress > (messageIndex + 1) * 20 && messageIndex < messages.length - 1) {
            messageIndex++;
            statusText.innerText = messages[messageIndex];
        }
    }, 150);
});

document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Mobile Sidebar Toggle ---
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('show');
        });
    }

    // --- 2. Sidebar Submenu Toggle (Investment Plans) ---
    const investPlansBtn = document.getElementById('investPlansBtn');
    const investPlansMenu = document.getElementById('investPlansMenu');

    if (investPlansBtn && investPlansMenu) {
        investPlansBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent standard link jump
            investPlansMenu.classList.toggle('show');
            // Rotate Arrow
            const arrow = investPlansBtn.querySelector('.arrow');
            if (investPlansMenu.classList.contains('show')) {
                arrow.style.transform = 'rotate(180deg)';
            } else {
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    }

    // --- 3. Header Dropdowns (Notifications & Profile) ---
    function setupDropdown(btnId, menuId) {
        const btn = document.getElementById(btnId);
        const menu = document.getElementById(menuId);
        
        if (btn && menu) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                
                // Close all other dropdowns first
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m.id !== menuId) m.classList.remove('show');
                });
                
                menu.classList.toggle('show');
            });
        }
    }

    setupDropdown('notifBtn', 'notifMenu');
    setupDropdown('profileBtn', 'profileMenu');

    // Close Dropdowns & Sidebar on clicking outside
    document.addEventListener('click', (e) => {
        // Close Dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });

        // Close Sidebar on Mobile if clicking outside
        if (window.innerWidth <= 900 && sidebar.classList.contains('show')) {
            if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        }
    });

    // Prevent clicks inside dropdown from closing it
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });


    // --- 4. Toggle Account Balance Visibility ---
    const toggleBalanceBtn = document.getElementById('toggleBalanceBtn');
    const balanceAmount = document.getElementById('balanceAmount');
    const eyeIcon = document.getElementById('eyeIcon');
    let isHidden = false;

    if (toggleBalanceBtn && balanceAmount) {
        toggleBalanceBtn.addEventListener('click', () => {
            isHidden = !isHidden;
            if (isHidden) {
                balanceAmount.textContent = '*******';
                eyeIcon.setAttribute('data-icon', 'ri:eye-off-line');
            } else {
                balanceAmount.textContent = '$0.00';
                eyeIcon.setAttribute('data-icon', 'ri:eye-line');
            }
        });
    }

    // --- 5. Close Promo Card ---
    const closePromoBtn = document.getElementById('closePromoBtn');
    const promoCard = document.getElementById('promoCard');

    if (closePromoBtn && promoCard) {
        closePromoBtn.addEventListener('click', () => {
            promoCard.style.display = 'none';
        });
    }

});


const qtDropdownBtn = document.getElementById("qtDropdownBtn");
const qtDropdownMenu = document.getElementById("qtDropdownMenu");

if (qtDropdownBtn && qtDropdownMenu) {
    qtDropdownBtn.addEventListener("click", () => {
        qtDropdownMenu.classList.toggle("active");
        qtDropdownBtn.classList.toggle("active");
    });

    window.addEventListener("click", (e) => {
        if (
            !qtDropdownBtn.contains(e.target) &&
            !qtDropdownMenu.contains(e.target)
        ) {
            qtDropdownMenu.classList.remove("active");
            qtDropdownBtn.classList.remove("active");
        }
    });
}

const acmVerifyBtn = document.getElementById("acmVerifyBtn");
const acmVerifyMenu = document.getElementById("acmVerifyMenu");

if (acmVerifyBtn && acmVerifyMenu) {
    acmVerifyBtn.addEventListener("click", () => {
        acmVerifyBtn.classList.toggle("active");
        acmVerifyMenu.classList.toggle("active");
    });
}


// Main section starts here
document.addEventListener("DOMContentLoaded", function () {
    // DOM Cache Elements Selection
    const notificationsWrapper = document.getElementById("notifications-wrapper");
    if (!notificationsWrapper) {
        return;
    }

    const searchInput = document.getElementById("noti-search");
    const tabButtons = document.querySelectorAll(".filter-tabs .tab-btn");
    const unreadCountBadge = document.getElementById("unread-count");
    const showingCountText = document.getElementById("showing-count-text");
    const markAllBtn = document.getElementById("mark-all-read-btn");

    let currentFilter = "all";
    let searchQuery = "";

    // Run Calculations on Initialization Sequence
    updateStatusMetrics();

    // 1. Search Query Input Event Listener
    if (searchInput) {
        searchInput.addEventListener("input", function (e) {
            searchQuery = e.target.value.toLowerCase().trim();
            evaluateVisibilityFilterEngine();
        });
    }

    // 2. Tab Filter Switching Listener Loop
    if (tabButtons.length) {
        tabButtons.forEach(button => {
            button.addEventListener("click", function () {
                tabButtons.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
                currentFilter = this.getAttribute("data-filter");
                evaluateVisibilityFilterEngine();
            });
        });
    }

    // 3. Row Action Controllers (Mark Read/Delete Toggle)
    notificationsWrapper.addEventListener("click", async function (e) {
        const item = e.target.closest(".noti-item");
        if (!item) return;

        const notificationId = item.dataset.id;
        if (!notificationId) return;

        if (e.target.closest(".read-toggle-btn")) {
            const currentStatus = item.dataset.status === "unread" ? "read" : "unread";
            await toggleNotificationRead(notificationId, currentStatus, item);
            return;
        }

        if (e.target.closest(".delete-btn")) {
            await deleteNotification(notificationId, item);
            return;
        }
    });

    // 4. Global Bulk State Action Configuration
    if (markAllBtn) {
        markAllBtn.addEventListener("click", async function () {
            await markAllNotificationsRead();
        });
    }

    // Core Filtering Engine Rule Calculator Matrix
    function evaluateVisibilityFilterEngine() {
        let visibleCount = 0;
        const totalItems = document.querySelectorAll(".noti-list .noti-item");

        totalItems.forEach(item => {
            const statusMatch = (currentFilter === "all") || (item.getAttribute("data-status") === currentFilter);
            const messageEl = item.querySelector(".noti-message");
            const tagEl = item.querySelector(".noti-type-tag");
            const textContent = messageEl ? messageEl.textContent.toLowerCase() : '';
            const tagContent = tagEl ? tagEl.textContent.toLowerCase() : '';
            const searchMatch = textContent.includes(searchQuery) || tagContent.includes(searchQuery);

            if (statusMatch && searchMatch) {
                item.style.display = "flex";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        if (showingCountText) {
            showingCountText.textContent = `Showing ${visibleCount} of ${totalItems.length} notifications`;
        }
    }

    // Badge Metric Updates Counter Utility
    function updateStatusMetrics() {
        const activeUnreadCount = document.querySelectorAll(".noti-list .noti-item.unread").length;
        const currentTotalItems = document.querySelectorAll(".noti-list .noti-item").length;
        
        if (unreadCountBadge) {
            unreadCountBadge.textContent = activeUnreadCount;
        }
        if (showingCountText) {
            showingCountText.textContent = `Showing ${currentTotalItems} of ${currentTotalItems} notifications`;
        }
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    async function toggleNotificationRead(notificationId, status, item) {
        try {
            const response = await fetch(`/notifications/${notificationId}/toggle-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({ status }),
            });

            const data = await response.json();
            if (!data.success) {
                throw new Error(data.message || 'Unable to update notification status');
            }

            const btnIcon = item.querySelector('.read-toggle-btn i');
            const actionButton = item.querySelector('.read-toggle-btn');

            if (status === 'read') {
                item.classList.remove('unread');
                item.setAttribute('data-status', 'read');
                if (btnIcon) { btnIcon.className = 'bx bx-undo'; }
                if (actionButton) { actionButton.setAttribute('title', 'Mark as unread'); }
            } else {
                item.classList.add('unread');
                item.setAttribute('data-status', 'unread');
                if (btnIcon) { btnIcon.className = 'bx bx-check'; }
                if (actionButton) { actionButton.setAttribute('title', 'Mark as read'); }
            }

            unreadCountBadge.textContent = data.unreadCount;
            updateStatusMetrics();
            evaluateVisibilityFilterEngine();
        } catch (error) {
            console.error(error);
            alert('Unable to update notification status. Please try again.');
        }
    }

    async function deleteNotification(notificationId, item) {
        if (!confirm('Delete this notification? This cannot be undone.')) {
            return;
        }

        try {
            const response = await fetch(`/notifications/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const data = await response.json();
            if (!data.success) {
                throw new Error(data.message || 'Unable to delete notification');
            }

            item.remove();
            unreadCountBadge.textContent = data.unreadCount;
            updateStatusMetrics();
            evaluateVisibilityFilterEngine();
        } catch (error) {
            console.error(error);
            alert('Unable to delete notification. Please try again.');
        }
    }

    async function markAllNotificationsRead() {
        try {
            const response = await fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getCsrfToken(),
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const data = await response.json();
            if (!data.success) {
                throw new Error(data.message || 'Unable to mark all notifications as read');
            }

            document.querySelectorAll('.noti-list .noti-item').forEach(item => {
                item.classList.remove('unread');
                item.setAttribute('data-status', 'read');
                const btnIcon = item.querySelector('.read-toggle-btn i');
                const actionButton = item.querySelector('.read-toggle-btn');
                if (btnIcon) { btnIcon.className = 'bx bx-undo'; }
                if (actionButton) { actionButton.setAttribute('title', 'Mark as unread'); }
            });

            unreadCountBadge.textContent = data.unreadCount;
            updateStatusMetrics();
            evaluateVisibilityFilterEngine();
        } catch (error) {
            console.error(error);
            alert('Unable to mark all notifications as read. Please try again.');
        }
    }
});