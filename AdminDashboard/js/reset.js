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

    // 4. Verification Form Submission Handlers
    const form = document.getElementById("reset-form");
    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            let clear = true;

            const pass = document.getElementById("reset-password");
            const confirm = document.getElementById("reset-confirm-password");

            if (pass.value.length < 8) { pass.closest(".form-group").classList.add("invalid"); clear = false; }
            else { pass.closest(".form-group").classList.remove("invalid"); }

            if (confirm.value !== pass.value || confirm.value === "") { confirm.closest(".form-group").classList.add("invalid"); clear = false; }
            else { confirm.closest(".form-group").classList.remove("invalid"); }

            if (clear) {
                const btn = document.getElementById("btn-reset");
                btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Committing New Cryptographic Key...`;
                btn.style.pointerEvents = "none";
                console.log("Password Mutation verified safely. Dispatching to overhaul database model mapping pipelines.");
                form.submit();
            }
        });
    }
});