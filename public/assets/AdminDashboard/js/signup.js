document.addEventListener("DOMContentLoaded", () => {
    // 1. Theme Configuration Isolation
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

    // 2. Clear Preloader Staging
    const loader = document.getElementById("signup-preloader");
    if (loader) { window.addEventListener("load", () => loader.classList.add("hide")); setTimeout(() => loader.classList.add("hide"), 800); }

    
});

// Main section starts here

document.addEventListener("DOMContentLoaded", () => {
    const signupForm = document.getElementById("adminSignupForm");
    const toggleElements = document.querySelectorAll(".password-toggle");

    // Smooth Interactive Eye Toggle / Untoggle Logic
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

    // Form Interception & Basic Rules Auditing
    signupForm.addEventListener("submit", (e) => {
        e.preventDefault();
        
        const pwd = document.getElementById("password").value;
        const confirmPwd = document.getElementById("confirmPassword").value;
        const pin = document.getElementById("adminPin").value;

        if (pwd !== confirmPwd) {
            alert("Security check mismatch: Passwords do not match.");
            return;
        }

        if (pin.length !== 6 || isNaN(pin)) {
            alert("Invalid Security Target: Authority PIN must be exactly 6 numeric digits.");
            return;
        }

        console.log("System Credentials validated. Packaging payload for auth channel...");
        // Execution of your fetch endpoint request goes here
    });
});

// Main section end here