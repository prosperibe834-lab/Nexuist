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
document.addEventListener("DOMContentLoaded", function () {
    const payoutForm = document.getElementById("main-payout-execution-form");
    const tileRadioGroup = document.querySelectorAll("input[name='source_wallet']");
    const useMaxBtn = document.getElementById("trigger-max-amount");
    const amountInput = document.getElementById("payout-amount");
    const submitBtn = document.getElementById("submit-payout-btn");
    
    // Modal Selectors
    const successModal = document.getElementById("success-state-modal");
    const closeModalBtn = document.getElementById("close-success-modal-btn");
    const modalRefHash = document.getElementById("mdl-ref-hash");
    const modalPoolType = document.getElementById("mdl-pool-type");

    // 1. Dynamic Toggle States styling tracking for custom select tiles
    tileRadioGroup.forEach(radio => {
        radio.addEventListener("change", function () {
            // Drop current active structural layouts tags on alternate selections
            document.querySelectorAll(".wallet-select-tile").forEach(tile => {
                tile.classList.remove("active-tile");
            });
            // Assign active layout identifier back onto target visual node
            if (this.checked) {
                this.closest(".wallet-select-tile").classList.add("active-tile");
            }
        });
    });

    // 2. Inline Utility Button Max Value Assignment Handler Logic
    if (useMaxBtn && amountInput) {
        useMaxBtn.addEventListener("click", function () {
            const activeWallet = document.querySelector("input[name='source_wallet']:checked").value;
            if (activeWallet === "usdt_main") {
                amountInput.value = "4812.50";
            } else {
                amountInput.value = "0.248";
            }
        });
    }

    // 3. Form Dispatch Interception Sequence Implementation
    if (payoutForm) {
        payoutForm.addEventListener("submit", function (e) {
            e.preventDefault();

            // Read operational parameters states 
            const selectedWalletInput = document.querySelector("input[name='source_wallet']:checked");
            const walletLabel = selectedWalletInput.closest(".wallet-select-tile").querySelector(".tile-title").textContent;
            const targetAddressValue = document.getElementById("destination-address").value.trim();

            // Set UI processing load state markers 
            submitBtn.disabled = true;
            submitBtn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Routing to Clearing Network...";

            // Simulate financial data round-trip communication payload matrix latency
            setTimeout(() => {
                // Populate custom modal payload elements dynamically before execution opening array
                if (modalRefHash) modalRefHash.textContent = targetAddressValue || "N/A";
                if (modalPoolType) modalPoolType.textContent = walletLabel || "USDT Balance";

                // Open overlay window cleanly
                if (successModal) {
                    successModal.classList.add("modal-open");
                }

                // Reset processing button state variables configuration
                submitBtn.disabled = false;
                submitBtn.innerHTML = "<i class='bx bx-send'></i> Review & Execute Release";
                payoutForm.reset();
                
                // Keep structural layout classes active normalized matching fallback defaults
                document.querySelectorAll(".wallet-select-tile").forEach((tile, index) => {
                    if (index === 0) tile.classList.add("active-tile");
                });
            }, 2000);
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
    const walletTiles = document.querySelectorAll(".wallet-select-tile");

    walletTiles.forEach(tile => {
        tile.addEventListener("click", function (e) {
            // Find the embedded radio button within this specific card frame
            const targetRadio = this.querySelector("input[type='radio']");
            
            if (targetRadio) {
                // Check the radio input track programmatically
                targetRadio.checked = true;

                // Scrub the active styling layer off all options in the module container
                walletTiles.forEach(item => item.classList.remove("active-tile"));

                // Affix the active dashboard visual properties onto the chosen option card
                this.classList.add("active-tile");
                
                // Fire an optional tracking event to sync up max balance utility calculations
                targetRadio.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    });
});

    // 4. Modal Window Termination Mechanics
    if (closeModalBtn && successModal) {
        closeModalBtn.addEventListener("click", function () {
            successModal.classList.remove("modal-open");
        });
    }

});