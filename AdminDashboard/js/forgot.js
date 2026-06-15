document.addEventListener("DOMContentLoaded", () => {
    // 1. Theme Configuration Isolation Layer
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

    // 2. Preloader Disengagement Hook
    const loader = document.getElementById("forgot-preloader");
    if (loader) { window.addEventListener("load", () => loader.classList.add("hide")); setTimeout(() => loader.classList.add("hide"), 800); }

    // 3. Dispatch Form Verification Engine
    const form = document.getElementById("forgot-form");
    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            const email = document.getElementById("recovery-email");

            if (!email.value.includes("@") || email.value.trim() === "") {
                email.closest(".form-group").classList.add("invalid");
            } else {
                email.closest(".form-group").classList.remove("invalid");
                const btn = document.getElementById("btn-forgot");
                btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Broadcasting OTP Signal...`;
                btn.style.pointerEvents = "none";
                console.log("Forgot system match completed. Emitting routing tracking code to backend target context.");
                form.submit();
            }
        });
    }
});