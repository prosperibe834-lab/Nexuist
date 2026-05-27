document.addEventListener("DOMContentLoaded", () => {
    // 1. Theme Configuration Hook
    const toggle = document.getElementById("theme-toggle");
    const activeTheme = localStorage.getItem("theme") || "dark";
    document.documentElement.setAttribute("data-theme", activeTheme);
    if(toggle) toggle.querySelector("i").className = activeTheme === "light" ? "bx bx-sun" : "bx bx-moon";

    if(toggle) {
        toggle.addEventListener("click", () => {
            const current = document.documentElement.getAttribute("data-theme");
            const next = current === "dark" ? "light" : "dark";
            document.documentElement.setAttribute("data-theme", next);
            localStorage.setItem("theme", next);
            toggle.querySelector("i").className = next === "light" ? "bx bx-sun" : "bx bx-moon";
        });
    }

    // 2. Clear Preloader Staging Matrix
    const loader = document.getElementById("otp-preloader");
    if(loader) { window.addEventListener("load", () => loader.classList.add("hide")); setTimeout(() => loader.classList.add("hide"), 800); }

    // 3. Automated Segmented Text Input Shift Matrix
    const cells = document.querySelectorAll(".otp-cell");
    const aggregateInput = document.getElementById("otp-aggregate");

    cells.forEach((cell, idx) => {
        cell.addEventListener("input", () => {
            cell.value = cell.value.replace(/[^0-9]/g, ""); // Allow numeric integers only
            if(cell.value.length > 0 && idx < cells.length - 1) {
                cells[idx + 1].focus();
            }
            compileOtpCells();
        });

        cell.addEventListener("keydown", (e) => {
            if(e.key === "Backspace" && cell.value.length === 0 && idx > 0) {
                cells[idx - 1].focus();
            }
        });
    });

    function compileOtpCells() {
        let text = "";
        cells.forEach(c => text += c.value);
        aggregateInput.value = text;
    }

    // 4. Recovery Token Lifecycle Countdown Timer Module
    const clock = document.getElementById("clock");
    const resendBtn = document.getElementById("btn-resend");
    let remaining = 120;

    const timerInterval = setInterval(() => {
        remaining--;
        let min = Math.floor(remaining / 60);
        let sec = remaining % 60;
        clock.innerText = `0${min}`.slice(-2) + ":" + `0${sec}`.slice(-2);

        if(remaining <= 0) {
            clearInterval(timerInterval);
            resendBtn.removeAttribute("disabled");
            clock.parentElement.innerText = "Transient Key Lifetime Expired.";
        }
    }, 1000);

    // 5. Form Submission Flow
    const form = document.getElementById("otp-form");
    if(form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();
            if(aggregateInput.value.length < 6) {
                form.classList.add("invalid");
            } else {
                form.classList.remove("invalid");
                const btn = document.getElementById("btn-otp-submit");
                btn.innerHTML = `<i class='bx bx-loader-alt bx-spin'></i> Authenticating Signature...`;
                btn.style.pointerEvents = "none";
                console.log("OTP collection validation matched successfully. Transmitting to validation controllers.");
                form.submit();
            }
        });
    }
});