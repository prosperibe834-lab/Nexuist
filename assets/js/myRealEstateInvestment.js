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
            sidebar.classList.toggle('active');
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
        if (window.innerWidth <= 900 && sidebar.classList.contains('active')) {
            if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                sidebar.classList.remove('active');
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
// Inside portfolio.js (linked on myRealEstateInvestment.html)
document.addEventListener("DOMContentLoaded", () => {
  const emptyState = document.getElementById("emptyStateContainer");
  const tableContent = document.getElementById("tableContentContainer");
  const tableBody = document.getElementById("holdingsTableBody");
  const btnClear = document.getElementById("btnClearStorage");

  // DOM stat summary display pointers
  const displayTotal = document.getElementById("statTotalInvested");
  const displayProfit = document.getElementById("statTotalProfit");
  const displayCount = document.getElementById("statActiveCount");
  const displayAvgApy = document.getElementById("statAvgApy");
  const displayTokens = document.getElementById("statTotalTokens");

  function processPortfolioMatrix() {
    // Read the array list data out of persistent browser database storage
    const items = JSON.parse(localStorage.getItem("portfolioHoldings")) || [];

    // If no investment has been made yet, show the initial empty design state
    if (items.length === 0) {
      if (emptyState) emptyState.classList.remove("hidden");
      if (tableContent) tableContent.classList.add("hidden");
      
      displayTotal.innerText = "$0.00";
      displayProfit.innerText = "$0.00";
      displayCount.innerText = "0 Properties";
      displayTokens.innerText = "0.00 Total Tokens Owned";
      displayAvgApy.innerText = "0.0% Avg. Estimated APY";
      return;
    }

    // Hide empty states and reveal premium ledger boards
    if (emptyState) emptyState.classList.add("hidden");
    if (tableContent) tableContent.classList.remove("hidden");
    tableBody.innerHTML = "";

    let runningTotalCash = 0;
    let runningTotalTokens = 0;
    let combinedApyWeight = 0;

    // Loop through all investments passed from realestate.html
    items.forEach((asset) => {
      runningTotalCash += asset.amount;
      runningTotalTokens += asset.tokens;
      combinedApyWeight += asset.apy;

      // Construct an elegant table data layout matrix row dynamically
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>
          <div style="font-weight: 600; color: #fff;">${asset.title}</div>
          <div style="font-size: 0.78rem; color: #8492a6;"><i class='bx bx-map'></i> ${asset.location}</div>
        </td>
        <td style="font-weight: 600;">$${asset.amount.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</td>
        <td style="color: #3b82f6; font-weight: 500;">${asset.tokens.toFixed(2)} tokens</td>
        <td style="color: #10b981;">${asset.apy}% APY</td>
        <td><span class="status-badge active"><i class='bx bx-check-circle'></i> Earning</span></td>
      `;
      tableBody.appendChild(row);
    });

    // Compute dynamic financial metrics variables
    const accurateCalculatedAverageApy = combinedApyWeight / items.length;
    
    // Simulate expected continuous future financial dividends values vectors targets
    const simulatedAccruedYieldsDividendsEstimate = runningTotalCash * (accurateCalculatedAverageApy / 100) * 0.045; 

    // Update global top dashboard metrics fields using precise localized formatting
    displayTotal.innerText = `$${runningTotalCash.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    displayProfit.innerText = `$${simulatedAccruedYieldsDividendsEstimate.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    displayCount.innerText = `${items.length} ${items.length === 1 ? 'Property' : 'Properties'}`;
    displayTokens.innerText = `${runningTotalTokens.toLocaleString(undefined, {maximumFractionDigits: 2})} Total Tokens Owned`;
    displayAvgApy.innerText = `${accurateCalculatedAverageApy.toFixed(1)}% Avg. Estimated APY`;
  }

  // Developer clear simulation access point connection
  if (btnClear) {
    btnClear.addEventListener("click", () => {
      localStorage.removeItem("portfolioHoldings");
      processPortfolioMatrix();
    });
  }


  // --- Auto Compounding Interaction Logic ---
  const premiumBtn = document.querySelector(".btn-premium-action");
  const toast = document.getElementById("compoundingToast");

  if (premiumBtn && toast) {
    premiumBtn.addEventListener("click", () => {
      // Toggle the active class status on the button
      const isActive = premiumBtn.classList.toggle("compounding-active");
      
      if (isActive) {
        // Change button text state
        premiumBtn.innerText = "Disable Auto-Compounding";
        
        // Slide up the beautiful notification window
        toast.classList.add("show-toast");
        
        // Automatically slide the notification window back down after 4 seconds
        setTimeout(() => {
          toast.classList.remove("show-toast");
        }, 4000);
      } else {
        // Reset button state text if clicked again to disable
        premiumBtn.innerText = "Enable Auto-Compounding";
        toast.classList.remove("show-toast");
      }
    });
  }
  // Initial code engine activation hook execution
  processPortfolioMatrix();
});