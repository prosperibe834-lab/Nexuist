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

const acmVerifyBtn = document.getElementById("acmVerifyBtn");
const acmVerifyMenu = document.getElementById("acmVerifyMenu");

acmVerifyBtn.addEventListener("click", () => {

    acmVerifyBtn.classList.toggle("active");

    acmVerifyMenu.classList.toggle("active");

});


// Main section starts here
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('subModal');
    const closeBtn = document.getElementById('closeBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const displayName = document.getElementById('display-name');
    const displayPrice = document.getElementById('display-price');

    // Attach click to all subscribe buttons
    document.querySelectorAll('.btn-subscribe').forEach(button => {
        button.addEventListener('click', () => {
            const card = button.closest('.sig-card');
            const name = card.getAttribute('data-name');
            const price = card.getAttribute('data-price');

            // If user doesn't have enough balance, redirect to deposit page
            const userBal = window.__USER_BALANCE || 0;
            const required = parseFloat(price) || 0;
            if (parseFloat(userBal) < required) {
                window.location.href = '/depositfunds';
                return;
            }

            displayName.innerText = name;
            displayPrice.value = price;

            modal.style.display = 'flex';
        });
    });

    const closeModal = () => { modal.style.display = 'none'; };

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Close on clicking outside the box
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // Complete Subscription Button
const completeBtn = document.querySelector('.btn-complete');

let selectedName = '';
let selectedPrice = '';

// Attach click to all subscribe buttons
document.querySelectorAll('.btn-subscribe').forEach(button => {
    button.addEventListener('click', () => {
        const card = button.closest('.sig-card');

        selectedName = card.getAttribute('data-name');
        selectedPrice = card.getAttribute('data-price');

        // If user doesn't have enough balance, redirect to deposit page
        const userBal = window.__USER_BALANCE || 0;
        const required = parseFloat(selectedPrice) || 0;
        if (parseFloat(userBal) < required) {
            window.location.href = '/depositfunds';
            return;
        }

        displayName.innerText = selectedName;
        displayPrice.value = selectedPrice;

        modal.style.display = 'flex';
    });
});

// Complete subscription: POST to server invest endpoint
completeBtn.addEventListener('click', async () => {
    const paymentMethod = document.querySelector('.modal-select').value;

    const modal = document.getElementById('subModal');
    const selectedCard = document.querySelector(`.sig-card[data-name="${selectedName}"]`);
    const botId = selectedCard ? selectedCard.getAttribute('data-id') : null;
    const amount = selectedPrice;

    if (!botId) {
        alert('Invalid selection');
        return;
    }

    try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const res = await fetch(`/bot/invest/${botId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ amount: amount })
        });

        const data = await res.json();

        if (data.success) {
            // Redirect if backend provided a redirect route
            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }
            alert(data.message || 'Subscription successful');
            modal.style.display = 'none';
            // Optionally reload to show updated balances
            setTimeout(() => location.reload(), 800);
        } else {
            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }
            alert(data.message || 'Subscription failed');
        }
    } catch (e) {
        console.error(e);
        alert('Network error while placing investment');
    }
});

});





