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

    const loginForm = document.getElementById('nexuist-login-form');
    const identityInput = document.getElementById('login-identity');
    const passwordInput = document.getElementById('login-password');
    const submitBtn = document.getElementById('login-submit-btn');

    // Password field visibility mask toggle engine
    document.querySelectorAll('.password-visibility-toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            const icon = btn.querySelector('i');
            icon.className = isPassword ? 'bx bx-show' : 'bx bx-hide';
        });
    });

    // Form submission processing interface
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            const identityValue = identityInput.value.trim();
            const passwordValue = passwordInput.value.trim();

            // Check if basic fields are empty before proceeding
            if (!identityValue || !passwordValue) {
                e.preventDefault(); // Stop form only if validation fails
                alert("Please fill out all required secure login credentials.");
                return;
            }

            // Animate button element state into processing configuration
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.8';
            submitBtn.innerHTML = `<span>Verifying Identity...</span> <i class='bx bx-loader-alt bx-spin'></i>`;

            // DO NOT use e.preventDefault() or setTimeout here. 
            // Let the form submit naturally to the action URL!
        });
    }
});