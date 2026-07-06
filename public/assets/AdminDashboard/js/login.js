document.addEventListener("DOMContentLoaded", () => {
    // 1. Isolated Theme Engine Node
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

    // 2. Preloader Lifespan Control
    const loader = document.getElementById("login-preloader");
    if (loader) { window.addEventListener("load", () => loader.classList.add("hide")); setTimeout(() => loader.classList.add("hide"), 800); }

    // 3. Cipher Mask Multi-state Handling
    const eye = document.querySelector(".visibility-toggle");
    if (eye) {
        eye.addEventListener("click", () => {
            const input = document.getElementById("login-password");
            if (input.type === "password") {
                input.type = "text"; eye.className = "bx bx-show visibility-toggle";
            } else {
                input.type = "password"; eye.className = "bx bx-hide visibility-toggle";
            }
        });
    }

});

// Main section starts here

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("adminLoginForm");
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

    // Form Interception & Core Validation Controls
    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();
        
        const identifier = document.getElementById("loginIdentifier").value.trim();
        const pwd = document.getElementById("password").value;
        const pin = document.getElementById("adminPin").value;

        if (!identifier) {
            alert("Authentication Error: Identity reference field cannot be blank.");
            return;
        }

        if (!pwd) {
            alert("Authentication Error: Password token required.");
            return;
        }

        if (pin.length !== 6 || isNaN(pin)) {
            alert("Security Target Mismatch: Authority PIN must be exactly 6 numeric digits.");
            return;
        }

        console.log("Terminal verification targets verified. Submitting login form...");
        // Submit the native form so Laravel receives the POST (CSRF token already in form)
        loginForm.submit();
    });
});

// Main section ends here