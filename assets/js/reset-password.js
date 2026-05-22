document.addEventListener('DOMContentLoaded', () => {

    const resetForm = document.getElementById('nexuist-reset-form');
    const passwordInput = document.getElementById('reset-password');
    const confirmInput = document.getElementById('confirm-password');
    const submitBtn = document.getElementById('reset-submit-btn');
    
    // Recovery panels targets
    const resetPanel = document.getElementById('panel-reset-form');
    const successPanel = document.getElementById('panel-success-msg');
    const timerSpan = document.getElementById('redirect-timer-span');
    
    // Live validation elements
    const reqLength = document.getElementById('req-length');
    const reqCase = document.getElementById('req-case');
    const reqNumber = document.getElementById('req-number');
    const reqMatch = document.getElementById('req-match');

    // Dual field visibility password toggle masks
    document.querySelectorAll('.password-visibility-toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            
            const isPassword = targetInput.type === 'password';
            targetInput.type = isPassword ? 'text' : 'password';
            
            const icon = btn.querySelector('i');
            icon.className = isPassword ? 'bx bx-show' : 'bx bx-hide';
        });
    });

    // Real-time live checkmark parameter matching verification
    function validatePasswords() {
        const pass = passwordInput.value;
        const confirmPass = confirmInput.value;

        // Requirement 1: Length check
        const hasLength = pass.length >= 8;
        updateMetricRule(reqLength, hasLength);

        // Requirement 2: Case sensitivity check
        const hasCase = /[a-z]/.test(pass) && /[A-Z]/.test(pass);
        updateMetricRule(reqCase, hasCase);

        // Requirement 3: Numbers or symbols check
        const hasNumberOrSymbol = /[\d\W]/.test(pass);
        updateMetricRule(reqNumber, hasNumberOrSymbol);

        // Requirement 4: Match check
        const isMatching = pass === confirmPass && pass.length > 0;
        updateMetricRule(reqMatch, isMatching);

        // Check if full stack is clean to open submission gate
        if (hasLength && hasCase && hasNumberOrSymbol && isMatching) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }

    function updateMetricRule(element, isValid) {
        if (isValid) {
            element.classList.remove('invalid');
            element.classList.add('valid');
            element.querySelector('i').className = 'bx bx-check-circle metric-bullet';
        } else {
            element.classList.remove('valid');
            element.classList.add('invalid');
            element.querySelector('i').className = 'bx bx-circle metric-bullet';
        }
    }

    // Attach immediate real-time event listeners
    passwordInput.addEventListener('input', validatePasswords);
    confirmInput.addEventListener('input', validatePasswords);

    // Form final execution update action handler
    if (resetForm) {
        resetForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Lock submission changes visually
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<span>Updating Protocol...</span> <i class='bx bx-loader-alt bx-spin'></i>`;

            // Process secure database save handshakes
            setTimeout(() => {
                resetPanel.classList.remove('active-panel');
                successPanel.classList.add('active-panel');
                
                // Fire automatic auto-routing security redirect timer
                startRedirectCountdown(5);
            }, 1800);
        });
    }

    // System automated redirect protocol wrapper
    function startRedirectCountdown(seconds) {
        let timeLeft = seconds;
        timerSpan.textContent = timeLeft;

        const countdown = setInterval(() => {
            timeLeft--;
            timerSpan.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = "login.html"; // Redirect straight back to your beautiful login interface
            }
        }, 1000);
    }
});