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

    const forgotForm = document.getElementById('nexuist-forgot-form');
    const emailInput = document.getElementById('recovery-email');
    const submitBtn = document.getElementById('recovery-submit-btn');
    
    // Recovery panel handles
    const requestPanel = document.getElementById('panel-request-form');
    const successPanel = document.getElementById('panel-success-msg');
    const targetEmailMirror = document.getElementById('target-dispatch-mirror');
    
    // Resend configuration nodes
    const resendBtn = document.getElementById('resend-trigger-btn');
    const timerSpan = document.getElementById('resend-timer-span');
    let countdownInterval = null;

    if (forgotForm) {
        forgotForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const emailValue = emailInput.value.trim();

            // Check basic structure inputs
            if (!emailValue) {
                alert("Please declare a valid account email parameter.");
                return;
            }

            // Lock submission engines visually 
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.8';
            submitBtn.innerHTML = `<span>Compiling Pipeline...</span> <i class='bx bx-loader-alt bx-spin'></i>`;

            // Process secure authentication routing simulations
            setTimeout(() => {
                // Pass text value to confirmation prompt screen card
                targetEmailMirror.textContent = emailValue;
                
                // Flip panel interfaces smoothly
                requestPanel.classList.remove('active-panel');
                successPanel.classList.add('active-panel');
                
                // Initiate cool institutional fallback countdown clock
                startResendTimer(59);
            }, 1500);
        });
    }

    // Secondary emergency resend signal mechanics
    if (resendBtn) {
        resendBtn.addEventListener('click', () => {
            resendBtn.disabled = true;
            resendBtn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> <span>Re-routing Link...</span>`;
            
            setTimeout(() => {
                resendBtn.innerHTML = `<i class='bx bx-refresh'></i> <span>Resend Security Vector</span>`;
                alert("A new secure synchronization access vector link has been dispatched.");
                startResendTimer(30); // Decreased timeout penalty limits for subsequent attempts
            }, 1200);
        });
    }

    // Dynamic institutional countdown clock calculator module
    function startResendTimer(seconds) {
        clearInterval(countdownInterval);
        resendBtn.disabled = true;
        
        let timeLeft = seconds;
        timerSpan.textContent = `${timeLeft}s`;

        countdownInterval = setInterval(() => {
            timeLeft--;
            timerSpan.textContent = `${timeLeft}s`;

            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                timerSpan.parentNode.innerHTML = "Security terminal resend pipeline is now completely <span style='color:#10b981; font-weight:600;'>Unlocked</span>.";
                resendBtn.disabled = false;
            }
        }, 1000);
    }
});