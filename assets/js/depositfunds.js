// =======================================
// PRELOADER
// =======================================

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

    const interval = setInterval(() => {

        progress += Math.random() * 15;

        if (progress >= 100) {

            progress = 100;

            clearInterval(interval);

            setTimeout(() => {

                preloader.classList.add("preloader-hidden");

                setTimeout(() => {
                    preloader.remove();
                }, 600);

            }, 500);
        }

        loadBar.style.width = progress + "%";

        if (
            progress > (messageIndex + 1) * 20 &&
            messageIndex < messages.length - 1
        ) {
            messageIndex++;
            statusText.innerText = messages[messageIndex];
        }

    }, 150);

});

// =======================================
// MAIN APP
// =======================================

document.addEventListener("DOMContentLoaded", () => {

    const body = document.body;

    // =======================================
    // MOBILE SIDEBAR
    // =======================================

    const mobileMenuBtn = document.getElementById("mobileMenuBtn");
    const sidebar = document.getElementById("sidebar");

    // CREATE OVERLAY
    const overlay = document.createElement("div");
    overlay.classList.add("sidebar-overlay");
    body.appendChild(overlay);

    function closeSidebar() {
        sidebar.classList.remove("show");
        overlay.classList.remove("active");
        body.classList.remove("sidebar-open");
    }

    function openSidebar() {
        sidebar.classList.add("show");
        overlay.classList.add("active");
        body.classList.add("sidebar-open");
    }

    if (mobileMenuBtn && sidebar) {

        mobileMenuBtn.addEventListener("click", (e) => {

            e.stopPropagation();

            if (sidebar.classList.contains("show")) {
                closeSidebar();
            } else {
                openSidebar();
            }

        });

    }

    overlay.addEventListener("click", closeSidebar);

    // =======================================
    // INVESTMENT SUBMENU
    // =======================================

    const investPlansBtn = document.getElementById("investPlansBtn");
    const investPlansMenu = document.getElementById("investPlansMenu");

    if (investPlansBtn && investPlansMenu) {

        investPlansBtn.addEventListener("click", (e) => {

            e.preventDefault();

            investPlansMenu.classList.toggle("show");

            const arrow = investPlansBtn.querySelector(".arrow");

            if (arrow) {
                arrow.style.transform =
                    investPlansMenu.classList.contains("show")
                        ? "rotate(180deg)"
                        : "rotate(0deg)";
            }

        });

    }

    // =======================================
    // HEADER DROPDOWNS
    // =======================================

    function setupDropdown(btnId, menuId) {

        const btn = document.getElementById(btnId);
        const menu = document.getElementById(menuId);

        if (!btn || !menu) return;

        btn.addEventListener("click", (e) => {

            e.stopPropagation();

            document.querySelectorAll(".dropdown-menu").forEach(drop => {

                if (drop !== menu) {
                    drop.classList.remove("show");
                }

            });

            menu.classList.toggle("show");

        });

    }

    setupDropdown("notifBtn", "notifMenu");
    setupDropdown("profileBtn", "profileMenu");

    // =======================================
    // QUICK TRADE DROPDOWN
    // =======================================

    const qtDropdownBtn = document.getElementById("qtDropdownBtn");
    const qtDropdownMenu = document.getElementById("qtDropdownMenu");

    if (qtDropdownBtn && qtDropdownMenu) {

        qtDropdownBtn.addEventListener("click", (e) => {

            e.stopPropagation();

            qtDropdownMenu.classList.toggle("active");
            qtDropdownBtn.classList.toggle("active");

        });

    }

    // =======================================
    // ACCOUNT MANAGEMENT
    // =======================================

    const acmVerifyBtn = document.getElementById("acmVerifyBtn");
    const acmVerifyMenu = document.getElementById("acmVerifyMenu");

    if (acmVerifyBtn && acmVerifyMenu) {

        acmVerifyBtn.addEventListener("click", () => {

            acmVerifyBtn.classList.toggle("active");
            acmVerifyMenu.classList.toggle("active");

        });

    }

    // =======================================
    // CLOSE DROPDOWNS
    // =======================================

    document.addEventListener("click", () => {

        document.querySelectorAll(".dropdown-menu").forEach(menu => {
            menu.classList.remove("show");
        });

        if (qtDropdownMenu) {
            qtDropdownMenu.classList.remove("active");
        }

        if (qtDropdownBtn) {
            qtDropdownBtn.classList.remove("active");
        }

    });

    document.querySelectorAll(".dropdown-menu").forEach(menu => {

        menu.addEventListener("click", (e) => {
            e.stopPropagation();
        });

    });

    if (qtDropdownMenu) {

        qtDropdownMenu.addEventListener("click", (e) => {
            e.stopPropagation();
        });

    }

    // =======================================
    // WINDOW RESIZE FIX
    // =======================================

    window.addEventListener("resize", () => {

        if (window.innerWidth > 900) {
            closeSidebar();
        }

    });

});

// =======================================
// DEPOSIT FUNCTIONS
// =======================================

function openGateway(coin, network, addr, qr) {

    document.getElementById("coin-title").innerText = coin;
    document.getElementById("network-title").innerText = network;
    document.getElementById("addr-input").value = addr;
    document.getElementById("qr-img").src = qr;

    document.getElementById("step-selection").classList.remove("active");
    document.getElementById("step-payment").classList.add("active");

    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

}

function goBack() {

    document.getElementById("step-payment").classList.remove("active");
    document.getElementById("step-selection").classList.add("active");

}

function copyText() {

    const input = document.getElementById("addr-input");

    navigator.clipboard.writeText(input.value);

    alert("Wallet Address Copied Successfully");

}

function receiptNamed() {

    const file = document.getElementById("receipt-upload").files[0];

    if (file) {

        document.getElementById("file-name").innerText = file.name;

        document.getElementById("submit-btn").disabled = false;

    }

}

function triggerSuccess() {

    document.getElementById("finish-modal").style.display = "flex";

}

function closeFinal() {

    location.reload();

}