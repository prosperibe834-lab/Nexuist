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

    
});

// MAin section starts here

document.addEventListener("DOMContentLoaded", () => {
    const otpForm = document.getElementById("adminOtpForm");
    const fields = document.querySelectorAll(".otp-field");
    const clockElement = document.getElementById("countdownClock");
    const resendButton = document.getElementById("btnResendOtp");
    const timerMessage = document.getElementById("otpCountdownMessage");

    // Initialize Input Shifting Systems
    if (fields.length > 0) {
        fields[0].focus();

        fields.forEach((field, index) => {
            // Forward Key Focus
            field.addEventListener("input", (e) => {
                const val = e.target.value;
                if (val.length >= 1) {
                    if (index < fields.length - 1) {
                        fields[index + 1].focus();
                    }
                }
            });

            // Backward Key Focus & Backspace Trapping
            field.addEventListener("keydown", (e) => {
                if (e.key === "Backspace" && !e.target.value) {
                    if (index > 0) {
                        fields[index - 1].focus();
                    }
                }
            });

            // Block Non-Numeric Entries entirely
            field.addEventListener("keypress", (e) => {
                if (!/\d/.test(e.key)) {
                    e.preventDefault();
                }
            });
        });
    }

    // 120 Second Countdown Clock Logic
    let remainingTime = 120;
    const startCountdown = () => {
        const interval = setInterval(() => {
            let minutes = Math.floor(remainingTime / 60);
            let seconds = remainingTime % 60;

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            clockElement.textContent = `${minutes}:${seconds}`;

            if (remainingTime <= 0) {
                clearInterval(interval);
                timerMessage.style.display = "none";
                resendButton.removeAttribute("disabled");
            }
            remainingTime--;
        }, 1000);
    };
    startCountdown();

    // Trigger Resend Button Logic
    resendButton.addEventListener("click", () => {
        alert("Generating payload configuration... A new token has been dispatched.");
        remainingTime = 120;
        timerMessage.style.display = "block";
        resendButton.setAttribute("disabled", true);
        startCountdown();
        fields[0].focus();
    });

    // Form Submission Processing
    if (otpForm) {
        const otpHidden = document.getElementById('otp');

        otpForm.addEventListener("submit", (e) => {
            e.preventDefault();
            
            let combinedToken = "";
            fields.forEach(field => combinedToken += field.value);

            if (combinedToken.length !== 6) {
                alert("Security Error: Please populate all 6 verification entry characters.");
                return;
            }

            if (otpHidden) {
                otpHidden.value = combinedToken;
            }

            otpForm.submit();
        });
    }
});

// MAin section ends here