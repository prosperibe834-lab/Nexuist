// Preloader starts here
document.addEventListener("DOMContentLoaded", () => {
    const preloader = document.getElementById("fintech-preloader");
    const loadBar = document.getElementById("load-bar");
    const statusText = document.getElementById("status-text");

    const messages = [
        "Initializing encrypted connection...",
        "Fetching live market data...",
        "Securing wallet protocols...",
        "Synchronizing portfolio stats...",
        "Welcome to Nexuist"
    ];

    let progress = 0;
    let messageIndex = 0;

    // Simulate real loading behavior
    const interval = setInterval(() => {
        progress += Math.random() * 15; // Random jump for realism
        
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);
            
            // Fade out the preloader
            setTimeout(() => {
                preloader.classList.add("preloader-hidden");
                // Optional: Remove from DOM after transition
                setTimeout(() => preloader.remove(), 600);
            }, 500);
        }

        // Update bar and text
        loadBar.style.width = progress + "%";
        
        // Update status message based on progress
        if (progress > (messageIndex + 1) * 20 && messageIndex < messages.length - 1) {
            messageIndex++;
            statusText.innerText = messages[messageIndex];
        }
    }, 150);
});


document.addEventListener('DOMContentLoaded', () => {
    
    // Top 50 Global Economies Array Assets List
    const globalTopCountries = [
        { name: "United States", code: "us", dial: "+1" },
        { name: "China", code: "cn", dial: "+86" },
        { name: "Japan", code: "jp", dial: "+81" },
        { name: "Germany", code: "de", dial: "+49" },
        { name: "India", code: "in", dial: "+91" },
        { name: "United Kingdom", code: "gb", dial: "+44" },
        { name: "France", code: "fr", dial: "+33" },
        { name: "Italy", code: "it", dial: "+39" },
        { name: "Canada", code: "ca", dial: "+1" },
        { name: "Brazil", code: "br", dial: "+55" },
        { name: "Russia", code: "ru", dial: "+7" },
        { name: "South Korea", code: "kr", dial: "+82" },
        { name: "Australia", code: "au", dial: "+61" },
        { name: "Spain", code: "es", dial: "+34" },
        { name: "Mexico", code: "mx", dial: "+52" },
        { name: "Indonesia", code: "id", dial: "+62" },
        { name: "Netherlands", code: "nl", dial: "+31" },
        { name: "Saudi Arabia", code: "sa", dial: "+966" },
        { name: "Turkey", code: "tr", dial: "+90" },
        { name: "Switzerland", code: "ch", dial: "+41" },
        { name: "Taiwan", code: "tw", dial: "+886" },
        { name: "Poland", code: "pl", dial: "+48" },
        { name: "Sweden", code: "se", dial: "+46" },
        { name: "Belgium", code: "be", dial: "+32" },
        { name: "Argentina", code: "ar", dial: "+54" },
        { name: "Norway", code: "no", dial: "+47" },
        { name: "Austria", code: "at", dial: "+43" },
        { name: "Nigeria", code: "ng", dial: "+234" },
        { name: "United Arab Emirates", code: "ae", dial: "+971" },
        { name: "Ireland", code: "ie", dial: "+353" },
        { name: "Israel", code: "il", dial: "+972" },
        { name: "South Africa", code: "za", dial: "+27" },
        { name: "Singapore", code: "sg", dial: "+65" },
        { name: "Hong Kong", code: "hk", dial: "+852" },
        { name: "Denmark", code: "dk", dial: "+45" },
        { name: "Malaysia", code: "my", dial: "+60" },
        { name: "Colombia", code: "co", dial: "+57" },
        { name: "Philippines", code: "ph", dial: "+63" },
        { name: "Bangladesh", code: "bd", dial: "+880" },
        { name: "Chile", code: "cl", dial: "+56" },
        { name: "Finland", code: "fi", dial: "+358" },
        { name: "Vietnam", code: "vn", dial: "+84" },
        { name: "Czech Republic", code: "cz", dial: "+420" },
        { name: "Portugal", code: "pt", dial: "+351" },
        { name: "Romania", code: "ro", dial: "+40" },
        { name: "New Zealand", code: "nz", dial: "+64" },
        { name: "Peru", code: "pe", dial: "+51" },
        { name: "Greece", code: "gr", dial: "+30" },
        { name: "Iraq", code: "iq", dial: "+964" },
        { name: "Kazakhstan", code: "kz", dial: "+7" }
    ];

    const phoneOptionsContainer = document.getElementById('phone-options-container');
    const jurOptionsContainer = document.getElementById('jurisdiction-options-container');

    // Dynamic dropdown generator engine
    function populateLists() {
        globalTopCountries.forEach(country => {
            // Dial codes list items builder
            const pLi = document.createElement('li');
            pLi.className = 'dropdown-option-item';
            pLi.setAttribute('data-dial', country.dial);
            pLi.setAttribute('data-code', country.code);
            pLi.setAttribute('data-search', country.name.toLowerCase() + " " + country.dial);
            pLi.innerHTML = `
                <img src="https://flagcdn.com/w20/${country.code}.png" alt="${country.name}">
                <span>${country.name}</span>
                <span class="dial-code-span">${country.dial}</span>
            `;
            phoneOptionsContainer.appendChild(pLi);

            // Country regions option builder
            const jLi = document.createElement('li');
            jLi.className = 'dropdown-option-item';
            jLi.setAttribute('data-name', country.name);
            jLi.setAttribute('data-code', country.code);
            jLi.setAttribute('data-search', country.name.toLowerCase());
            jLi.innerHTML = `
                <img src="https://flagcdn.com/w20/${country.code}.png" alt="${country.name}">
                <span>${country.name}</span>
            `;
            jurOptionsContainer.appendChild(jLi);
        });
    }
    populateLists();

    // Setup interactive events for drop selectors
    bindDropdownEvents('phone-dropdown-trigger', 'phone-dropdown-listbox', (selected) => {
        document.getElementById('phone-active-flag').src = selected.querySelector('img').src;
        document.getElementById('phone-active-code').textContent = selected.getAttribute('data-dial');
    });

    bindDropdownEvents('jurisdiction-trigger', 'jurisdiction-listbox', (selected) => {
        const flagImg = document.getElementById('jur-active-flag');
        const iconPlace = document.getElementById('jur-placeholder-icon');
        
        iconPlace.style.display = 'none';
        flagImg.src = selected.querySelector('img').src;
        flagImg.style.display = 'inline-block';
        document.getElementById('jur-active-name').textContent = selected.getAttribute('data-name');
    });

    function bindDropdownEvents(triggerId, listboxId, callback) {
        const trigger = document.getElementById(triggerId);
        const listbox = document.getElementById(listboxId);
        const searchInput = listbox.querySelector('.listbox-search-input');
        const options = listbox.querySelectorAll('.dropdown-option-item');

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const opened = listbox.classList.contains('active-view-open');
            closeAllSelectors();
            if(!opened) {
                listbox.classList.add('active-view-open');
                trigger.setAttribute('aria-expanded', 'true');
                if(searchInput) { searchInput.value = ''; searchInput.focus(); }
                options.forEach(o => o.style.display = 'flex');
            }
        });

        if(searchInput) {
            searchInput.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                options.forEach(o => {
                    o.style.display = o.getAttribute('data-search').includes(term) ? 'flex' : 'none';
                });
            });
            searchInput.addEventListener('click', (e) => e.stopPropagation());
        }

        options.forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.stopPropagation();
                callback(opt);
                listbox.classList.remove('active-view-open');
                trigger.setAttribute('aria-expanded', 'false');
            });
        });
    }

    function closeAllSelectors() {
        document.querySelectorAll('.custom-dropdown-listbox').forEach(box => box.classList.remove('active-view-open'));
        document.querySelectorAll('[role="combobox"]').forEach(com => com.setAttribute('aria-expanded', 'false'));
    }

    document.addEventListener('click', closeAllSelectors);

    // --- SECURE MULTI-PANEL PAGE ROUTING NAVIGATION ---
    const stepPanels = document.querySelectorAll('.form-step-panel');
    const stepNodes = document.querySelectorAll('.step-node');
    const nextBtns = document.querySelectorAll('.next-step-trigger');
    const prevBtns = document.querySelectorAll('.prev-step-trigger');
    let currentStep = 0;

    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (validatePanelInputs(currentStep)) {
                navigateToStep(currentStep + 1);
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            navigateToStep(currentStep - 1);
        });
    });

    function navigateToStep(targetStep) {
        stepPanels[currentStep].classList.remove('active');
        stepNodes[currentStep].classList.remove('active');
        
        if(targetStep > currentStep) {
            stepNodes[currentStep].classList.add('completed');
        }

        currentStep = targetStep;
        stepPanels[currentStep].classList.add('active');
        stepNodes[currentStep].classList.add('active');
        stepNodes[currentStep].classList.remove('completed');
    }

    function validatePanelInputs(stepIndex) {
        let isValid = true;
        const currentPanel = stepPanels[stepIndex];
        
        // Handle Step 2 verification case specially
        if (stepIndex === 1) {
            const countrySelectedName = document.getElementById('jur-active-name').textContent;
            if (countrySelectedName === "Select your country") {
                alert("Please select your country of jurisdiction before proceeding.");
                return false;
            }
            return true;
        }

        const inputs = currentPanel.querySelectorAll('input[required]');
        inputs.forEach(input => {
            const group = input.closest('.input-field-group');
            if(!input.value.trim()) {
                if(group) group.classList.add('validated-error');
                isValid = false;
            } else {
                if(group) {
                    group.classList.remove('validated-error');
                    group.classList.add('validated-success');
                }
            }
        });
        return isValid;
    }

    // --- REALTIME PASSWORD COMPLEXITY VALIDATORS ---
    const pass = document.getElementById('reg-password');
    if(pass) {
        pass.addEventListener('input', (e) => {
            const str = e.target.value;
            toggleRule('rule-length', str.length >= 8);
            toggleRule('rule-case', (/[a-z]/.test(str) && /[A-Z]/.test(str)));
            toggleRule('rule-number', (/[0-9]/.test(str) || /[^A-Za-z0-9]/.test(str)));
        });
    }

    function toggleRule(id, isPassed) {
        const li = document.getElementById(id);
        if(li) {
            li.className = isPassed ? 'valid' : 'invalid';
            li.querySelector('i').className = isPassed ? 'bx bx-check-circle' : 'bx bx-check';
        }
    }

    // EYE VISIBILITY CONTROLS
    document.querySelectorAll('.password-visibility-toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = btn.closest('.interactive-input-container').querySelector('input');
            const icon = btn.querySelector('i');
            if(input.type === 'password') {
                input.type = 'text';
                icon.className = 'bx bx-show';
            } else {
                input.type = 'password';
                icon.className = 'bx bx-hide';
            }
        });
    });

    // MASTER SIGNUP REGISTRATION EVENT
    const form = document.getElementById('nexuist-signup-form');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const captchaAnswer = document.getElementById('reg-captcha-input').value;
        const checkedBox = document.getElementById('reg-consent-terms').checked;

        if (parseInt(captchaAnswer) !== 16) {
            alert("Incorrect math challenge value entry.");
            return;
        }
        if (!checkedBox) {
            alert("Please accept the terms and conditions strategy map.");
            return;
        }

        const submitBtn = document.getElementById('submit-btn-loader');
        submitBtn.disabled = true;
        submitBtn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Syncing Profile...";

        setTimeout(() => {
            alert("Welcome to Nexuist! Profile created successfully.");
            window.location.reload();
        }, 1500);
    });
});