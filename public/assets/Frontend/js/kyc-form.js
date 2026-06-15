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
function nextSection(step) {
    // Hide all sections
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });

    // Show targeted section
    document.getElementById('section-' + step).classList.add('active');

    // Update Stepper UI
    updateStepper(step);
}

function updateStepper(step) {
    // Reset stepper
    document.querySelectorAll('.v-step').forEach((el, index) => {
        if (index + 1 <= step) {
            el.classList.add('active');
        } else {
            el.classList.remove('active');
        }
    });

    // Update lines
    if (step >= 2) document.getElementById('line-1').classList.add('active');
    else document.getElementById('line-1').classList.remove('active');

    if (step >= 3) document.getElementById('line-2').classList.add('active');
    else document.getElementById('line-2').classList.remove('active');
}


// Function to handle image preview
function setupUploadPreview(inputId, previewId, zoneId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const zone = document.getElementById(zoneId);
    const content = zone.querySelector('.upload-content');

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Hide the original text/icon
                content.style.display = 'none';

                // Create and show the image
                preview.innerHTML = `
                    <img src="${e.target.result}" class="img-preview animate-zoom">
                    <div class="change-file"><i class='bx bx-refresh'></i> Change Image</div>
                `;

                // Add success border
                zone.style.borderColor = '#10b981';
                zone.style.background = 'rgba(16, 185, 129, 0.05)';
            }

            reader.readAsDataURL(file);
        }
    });
}

// Initialize for both front and back
setupUploadPreview('file-front', 'preview-front', 'zone-front');
setupUploadPreview('file-back', 'preview-back', 'zone-back');

document.getElementById('kycForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const submitBtn = document.querySelector('.btn-submit');

    submitBtn.innerHTML =
        "<i class='bx bx-loader-alt bx-spin'></i> Processing...";
    submitBtn.disabled = true;

    const formData = new FormData(this);

    try {

        const response = await fetch('/kyc/store', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector(
                    'input[name="_token"]'
                ).value
            },
            body: formData
        });

        const data = await response.json();

        if (response.ok && data.success) {

            // Show Success Modal
            const modal = document.getElementById('kycModal');

            modal.style.display = 'flex';

            modal.querySelector('h2').textContent =
                'KYC Submitted Successfully';

            modal.querySelector('p').textContent =
                'Your KYC application has been successfully submitted and is currently under review. Verification is typically completed within 1–60 minutes. You will receive a notification once the review is complete.';

            // Reset Form
            document.getElementById('kycForm').reset();

        } else {

            alert(data.message || 'KYC submission failed.');

        }

    } catch (error) {

        console.error('KYC Error:', error);

        alert(
            'An error occurred while submitting your KYC application. Please try again.'
        );

    } finally {

        submitBtn.disabled = false;

        submitBtn.innerHTML =
            "Submit Application <i class='bx bx-check-shield'></i>";

    }
});