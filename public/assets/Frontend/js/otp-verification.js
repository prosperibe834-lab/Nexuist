document.addEventListener('DOMContentLoaded', () => {
    const preloader = document.getElementById('fintech-preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.classList.add('preloader-hidden');
            setTimeout(() => preloader.remove(), 600);
        }, 500);
    }

    const cells = Array.from(document.querySelectorAll('.otp-cell'));
    const hiddenInput = document.getElementById('otp-hidden-input');
    const form = document.getElementById('nexuist-otp-form');
    const resendBtn = document.getElementById('resend-otp-btn');

    if (!cells.length || !hiddenInput || !form) {
        return;
    }

    cells.forEach((cell, index) => {
        cell.addEventListener('input', (event) => {
            const value = event.target.value.replace(/\D/g, '').slice(0, 1);
            event.target.value = value;

            if (value && index < cells.length - 1) {
                cells[index + 1].focus();
            }

            syncOtpValue();
        });

        cell.addEventListener('keydown', (event) => {
            if (event.key === 'Backspace' && !cell.value && index > 0) {
                cells[index - 1].focus();
                cells[index - 1].value = '';
                syncOtpValue();
            }
        });

        cell.addEventListener('paste', (event) => {
            event.preventDefault();
            const pasted = (event.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0, 6);
            pasted.split('').forEach((char, pastedIndex) => {
                if (cells[pastedIndex]) {
                    cells[pastedIndex].value = char;
                }
            });
            cells[Math.min(pasted.length, cells.length - 1)].focus();
            syncOtpValue();
        });
    });

    function syncOtpValue() {
        hiddenInput.value = cells.map(cell => cell.value).join('');
    }

    form.addEventListener('submit', (event) => {
        syncOtpValue();
        if (hiddenInput.value.length !== 6) {
            event.preventDefault();
            alert('Please enter the full 6-digit recovery code.');
        }
    });

    if (resendBtn) {
        resendBtn.addEventListener('click', () => {
            resendBtn.disabled = true;
            resendBtn.innerHTML = '<i class=\'bx bx-loader-alt bx-spin\'></i> <span>Sending new code...</span>';
            setTimeout(() => {
                resendBtn.disabled = false;
                resendBtn.innerHTML = '<i class=\'bx bx-refresh\'></i> <span>Resend Code</span>';
                alert('A new recovery code has been sent.');
            }, 1200);
        });
    }
});
