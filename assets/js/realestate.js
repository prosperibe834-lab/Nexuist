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
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("investmentModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const investInput = document.getElementById("investAmountInput");
    const presetChipsContainer = document.getElementById("presetChipsContainer");
    const calcTokensDisplay = document.getElementById("calcTokens");

    // Structural dynamic pointers inside Modal
    const mTitle = document.getElementById("modalPropertyTitle");
    const mMeta = document.getElementById("modalPropertyMeta");
    const mLimit = document.getElementById("modalLimitLabel");

    // Active working dataset scope memory
    let currentCardData = null;

    // Track clicks across all property grid button assets
    document.querySelectorAll(".btn-trigger-modal").forEach((button) => {
        button.addEventListener("click", (e) => {
            const card = e.target.closest(".property-card");

            // Pull dataset bindings out of HTML card structure
            currentCardData = {
                title: card.getAttribute("data-title"),
                location: card.getAttribute("data-location"),
                apy: parseFloat(card.getAttribute("data-apy")),
                tokenPrice: parseFloat(card.getAttribute("data-price")),
                minInvest: parseFloat(card.getAttribute("data-min")),
                maxInvest: parseFloat(card.getAttribute("data-max"))
            };

            // Set explicit matching values to UI elements inside the modal
            mTitle.innerText = `Invest in ${currentCardData.title}`;
            mMeta.innerText = `${currentCardData.location} • ${currentCardData.apy}% APY`;
            mLimit.innerText = `Min: $${currentCardData.minInvest.toLocaleString()} • Max: $${currentCardData.maxInvest.toLocaleString()}`;

            // Set the input field base to exactly the property's specific minimum choice
            investInput.value = currentCardData.minInvest;
            investInput.min = currentCardData.minInvest;
            investInput.max = currentCardData.maxInvest;

            // Populate preset helper shortcut chips dynamically
            generateDynamicChips(currentCardData.minInvest, currentCardData.maxInvest);

            // Trigger standard calculation algorithm routine execution
            recalculateTokens();

            // Show modal window with a smooth CSS transition
            modal.classList.add("active");
        });
    });

    // Calculate matching chip shortcuts based on specific properties
    function generateDynamicChips(min, max) {
        presetChipsContainer.innerHTML = "";

        // Compute logical milestones between property minimums and absolute targets
        const steps = [min, min * 2, min * 5, max];
        const cleanUniqueSteps = [...new Set(steps)].filter(val => val <= max);

        cleanUniqueSteps.forEach((amount) => {
            const chipElement = document.createElement("button");
            chipElement.className = "chip";
            chipElement.innerText = `$${Math.floor(amount).toLocaleString()}`;
            chipElement.addEventListener("click", () => {
                investInput.value = Math.floor(amount);
                recalculateTokens();
            });
            presetChipsContainer.appendChild(chipElement);
        });
    }

    // Calculate token rewards dynamically based on selection pricing
    function recalculateTokens() {
        if (!currentCardData) return;
        const amountEntered = parseFloat(investInput.value) || 0;

        // Token total is defined by Amount Entered divided by Token Price
        const exactTokens = amountEntered / currentCardData.tokenPrice;

        calcTokensDisplay.innerText = `${exactTokens.toFixed(2)} tokens`;
    }

    // Handle transaction confirmation submission clicks & pass data smoothly
    document.getElementById("confirmInvestmentBtn").addEventListener("click", () => {
        if (!currentCardData) return;
        
        const amountEntered = parseFloat(investInput.value) || 0;

        if (amountEntered < currentCardData.minInvest) {
            alert(`Minimum investment for this asset is $${currentCardData.minInvest}`);
            return;
        }
        
        if (amountEntered > currentCardData.maxInvest) {
            alert(`Maximum investment capacity reached for this asset is $${currentCardData.maxInvest}`);
            return;
        }

        // Calculate tokens matching selection pricing model parameters
        const calculatedTokens = amountEntered / currentCardData.tokenPrice;

        // Build modular transaction model block package object
        const newInvestmentRecord = {
            title: currentCardData.title,
            location: currentCardData.location,
            apy: currentCardData.apy,
            amount: amountEntered,
            tokens: calculatedTokens,
            timestamp: new Date().toLocaleDateString()
        };

        // Extract ongoing state data store matrix array from localStorage
        let runningInvestments = JSON.parse(localStorage.getItem("portfolioHoldings")) || [];

        // Add the new investment to our array list
        runningInvestments.push(newInvestmentRecord);

        // Commit database storage write mutation state save
        localStorage.setItem("portfolioHoldings", JSON.stringify(runningInvestments));

        // Combined Alert Notice + Clean View Redirect
        alert(`Investment of $${amountEntered.toLocaleString()} in ${currentCardData.title} was processed successfully!`);
        
        // Forward user directly to your portfolio dashboard screen
        window.location.href = "myRealEstateInvestment.html";
    });

    // Hook live inputs up directly to calculation functions
    investInput.addEventListener("input", recalculateTokens);

    // Close interface functionality mapping
    closeModalBtn.addEventListener("click", () => modal.classList.remove("active"));

    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.classList.remove("active");
    });
});