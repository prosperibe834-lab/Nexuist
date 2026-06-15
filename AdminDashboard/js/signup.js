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

    // 4. Strict Signup Engine Validation Metrics
    const form = document.getElementById("signup-form");
    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            let secure = true;

            const name = document.getElementById("signup-name");
            const email = document.getElementById("signup-email");
            const role = document.getElementById("signup-role");
            const token = document.getElementById("signup-token");
            const pass = document.getElementById("signup-password");
            const confirm = document.getElementById("signup-confirm-password");

            if (name.value.trim().length < 2) { name.closest(".form-group").classList.add("invalid"); secure = false; }
            else { name.closest(".form-group").classList.remove("invalid"); }

            if (!email.value.includes("@")) { email.closest(".form-group").classList.add("invalid"); secure = false; }
            else { email.closest(".form-group").classList.remove("invalid"); }

            if (!role.value) { role.closest(".form-group").classList.add("invalid"); secure = false; }
            else { role.closest(".form-group").classList.remove("invalid"); }

            if (token.value.trim() === "") { token.closest(".form-group").classList.add("invalid"); secure = false; }
            else { token.closest(".form-group").classList.remove("invalid"); }

            if (pass.value.length < 8) { pass.closest(".form-group").classList.add("invalid"); secure = false; }
            else { pass.closest(".form-group").classList.remove("invalid"); }

            if (confirm.value !== pass.value || confirm.value === "") { confirm.closest(".form-group").classList.add("invalid"); secure = false; }
            else { confirm.closest(".form-group").classList.remove("invalid"); }

            if (secure) {
                const btn = document.getElementById("btn-signup");
                btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Provisioning Privileged Node...`;
                btn.style.pointerEvents = "none";
                console.log("Signup parameters validated safely. Processing endpoint submission pipeline.");
                form.submit();
            }
        });
    }
});