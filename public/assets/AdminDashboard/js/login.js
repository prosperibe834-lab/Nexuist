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

    // 4. Submission Request Matrix Pipeline
    const form = document.getElementById("login-form");
    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            let valid = true;
            const email = document.getElementById("login-email");
            const pass = document.getElementById("login-password");

            if (!email.value.includes("@") || email.value.trim() === "") {
                email.closest(".form-group").classList.add("invalid"); valid = false;
            } else { email.closest(".form-group").classList.remove("invalid"); }

            if (pass.value.trim() === "") {
                pass.closest(".form-group").classList.add("invalid"); valid = false;
            } else { pass.closest(".form-group").classList.remove("invalid"); }

            if (valid) {
                const btn = document.getElementById("btn-login");
                btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Handshaking Matrix Session...`;
                btn.style.pointerEvents = "none";
                console.log("Login form verification pass. Forwarding payload to identity controller core.");
                // Ready for backend injection mapping execution point
                form.submit();
            }
        });
    }
});