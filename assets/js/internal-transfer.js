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

    if(
        !qtDropdownBtn.contains(e.target) &&
        !qtDropdownMenu.contains(e.target)
    ){
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
function calculateFees() {
    const amount = document.getElementById('amountInput').value;
    const feeDisplay = document.getElementById('feeDisplay');
    const receiveDisplay = document.getElementById('receiveDisplay');

    if (amount > 0) {
        // Example: 0.1% fee
        const fee = (amount * 0.001).toFixed(2);
        const receive = (amount - fee).toFixed(2);

        feeDisplay.innerText = `$${fee}`;
        receiveDisplay.innerText = `$${receive}`;
    } else {
        feeDisplay.innerText = `$0.00`;
        receiveDisplay.innerText = `$0.00`;
    }
}
function handleTransfer(e) {
    e.preventDefault();
    
    // 1. Capture the form and modal elements
    const form = document.getElementById('transferForm');
    const modal = document.getElementById('progressModal');
    const amountInput = document.getElementById('amountInput');
    
    // 2. Show the modal immediately
    modal.style.display = 'flex';

    // 3. Start the "Processing" timer (Simulating 3 seconds of work)
    setTimeout(() => {
        
        /* --- THE CLEARING ACTION --- */
        // Wipe the form completely
        form.reset(); 
        
        // Reset the dynamic fee displays back to zero
        document.getElementById('feeDisplay').innerText = '$0.00';
        document.getElementById('receiveDisplay').innerText = '$0.00';
        
        /* --- THE UI TRANSFORMATION --- */
        // Change modal to Success Mode
        const modalTitle = modal.querySelector('h2');
        const modalText = modal.querySelector('p');
        const loaderContainer = modal.querySelector('.loader-container');
        const progressBar = modal.querySelector('.progress-fill');

        modalTitle.innerText = "Transfer Successful";
        modalTitle.style.color = "#10b981"; // Success Green
        modalText.innerText = "The funds have been sent. The recipient will see them shortly.";
        
        // Swap spinner for a Big Green Checkmark
        loaderContainer.innerHTML = "<i class='bx bx-check-circle' style='font-size: 80px; color: #10b981; animation: zoomIn 0.3s ease;'></i>";
        
        // Pause the progress bar at 100%
        progressBar.style.animation = "none";
        progressBar.style.width = "100%";
        progressBar.style.background = "#10b981";

        /* --- THE FINAL EXIT --- */
        // Automatically close everything after 2.5 seconds of showing the success
        setTimeout(() => {
            closeModal();
            
            // RESET MODAL FOR NEXT TIME (So it's not green when reopened)
            modalTitle.innerText = "Transaction in Progress";
            modalTitle.style.color = "#fff";
            modalText.innerText = "Nexuist Secure Verification is underway. Please wait...";
            loaderContainer.innerHTML = "<div class='nexus-loader'></div><i class='bx bx-lock-alt'></i>";
            progressBar.style.animation = "progressAnim 2s infinite ease-in-out";
            progressBar.style.background = "#2563eb";
        }, 2500);

    }, 3500); // 3.5 seconds of "Loading"
}

function closeModal() {
    document.getElementById('progressModal').style.display = 'none';
}

function closeModal() {
    document.getElementById('progressModal').style.display = 'none';
}