document.addEventListener("DOMContentLoaded", () => {
    // 1. Isolated System Theme Toggle Configuration
    const toggle = document.getElementById("theme-toggle");
    const activeTheme = localStorage.getItem("theme") || "dark";
    document.documentElement.setAttribute("data-theme", activeTheme);
    if (toggle) toggle.querySelector("i").className = activeTheme === "light" ? "bx bx-sun" : "bx bx-moon";

    if (toggle) {
        toggle.addEventListener("click", () => {
            const current = document.documentElement.getAttribute("data-theme");
            const next = current === "dark" ? "light" : "dark";
            document.documentElement.setAttribute("data-theme", next);
            localStorage.setItem("theme", next);
            toggle.querySelector("i").className = next === "light" ? "bx bx-sun" : "bx bx-moon";
        });
    }

    // 2. Preloader Lifecycle Framework Termination Guard
    const loader = document.getElementById("reset-preloader");
    if (loader) { window.addEventListener("load", () => loader.classList.add("hide")); setTimeout(() => loader.classList.add("hide"), 800); }

    // 3. Multi-field Mask Toggles
    const masks = document.querySelectorAll(".visibility-toggle");
    masks.forEach(trigger => {
        trigger.addEventListener("click", () => {
            const field = trigger.parentElement.querySelector(".cipher-input");
            if (field.type === "password") {
                field.type = "text"; trigger.className = "bx bx-show visibility-toggle";
            } else {
                field.type = "password"; trigger.className = "bx bx-hide visibility-toggle";
            }
        });
    });

});

// main section starts here

document.addEventListener("DOMContentLoaded", () => {
    const resetForm = document.getElementById("adminResetForm");
    const toggleElements = document.querySelectorAll(".password-toggle");

    // Smooth Eye Toggle Logic
    toggleElements.forEach(toggle => {
        toggle.addEventListener("click", function() {
            const targetId = this.getAttribute("data-target");
            const passwordInput = document.getElementById(targetId);
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.classList.replace("bx-hide", "bx-show");
            } else {
                passwordInput.type = "password";
                this.classList.replace("bx-show", "bx-hide");
            }
        });
    });

    // Form Interception and Password Auditing
    if (resetForm) {
        const recoveryIdentifier = document.getElementById("recoveryIdentifier");
        const newPasswordInput = document.getElementById("newPassword");
        const confirmPasswordInput = document.getElementById("confirmPassword");
        const adminPinInput = document.getElementById("adminPin");

        if (recoveryIdentifier && newPasswordInput && confirmPasswordInput && adminPinInput) {
            resetForm.addEventListener("submit", (e) => {
                e.preventDefault();

                const identifier = recoveryIdentifier.value.trim();
                const newPwd = newPasswordInput.value;
                const confirmPwd = confirmPasswordInput.value;
                const pin = adminPinInput.value;

                if (!identifier) {
                    alert("Validation Error: Account identifier target cannot be empty.");
                    return;
                }

                if (!newPwd || !confirmPwd) {
                    alert("Validation Error: Password configurations must be fully populated.");
                    return;
                }

                if (newPwd !== confirmPwd) {
                    alert("Security Error: Passwords do not match. Please verify configurations.");
                    return;
                }

                if (pin.length !== 6 || isNaN(pin)) {
                    alert("Security Configuration Exception: Authorization requires an exact 6-digit numeric Master PIN.");
                    return;
                }

                console.log("Credentials and Security PIN verified. Routing payload to OTP verification pipeline...");
                // Proceed to OTP verification stage here
            });
        }
    }
});

// main section ends here