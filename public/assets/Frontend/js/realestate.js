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

    // --- 1. Mobile Sidebar Toggle ---
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');

    if (mobileMenuBtn && sidebar) {
        mobileMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('show');
        });
    }

    // --- 2. Sidebar Submenu Toggle (Investment Plans) ---
    const investPlansBtn = document.getElementById('investPlansBtn');
    const investPlansMenu = document.getElementById('investPlansMenu');

    if (investPlansBtn && investPlansMenu) {
        investPlansBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent standard link jump
            investPlansMenu.classList.toggle('show');
            // Rotate Arrow
            const arrow = investPlansBtn.querySelector('.arrow');
            if (investPlansMenu.classList.contains('show')) {
                arrow.style.transform = 'rotate(180deg)';
            } else {
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    }

    // --- 3. Header Dropdowns (Notifications & Profile) ---
    function setupDropdown(btnId, menuId) {
        const btn = document.getElementById(btnId);
        const menu = document.getElementById(menuId);

        if (btn && menu) {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();

                // Close all other dropdowns first
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m.id !== menuId) m.classList.remove('show');
                });

                menu.classList.toggle('show');
            });
        }
    }

    setupDropdown('notifBtn', 'notifMenu');
    setupDropdown('profileBtn', 'profileMenu');

    // Close Dropdowns & Sidebar on clicking outside
    document.addEventListener('click', (e) => {
        // Close Dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });

        // Close Sidebar on Mobile if clicking outside
        if (window.innerWidth <= 900 && sidebar.classList.contains('show')) {
            if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                sidebar.classList.remove('show');
            }
        }
    });

    // Prevent clicks inside dropdown from closing it
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });


    // --- 4. Toggle Account Balance Visibility ---
    const toggleBalanceBtn = document.getElementById('toggleBalanceBtn');
    const balanceAmount = document.getElementById('balanceAmount');
    const eyeIcon = document.getElementById('eyeIcon');
    let isHidden = false;

    if (toggleBalanceBtn && balanceAmount) {
        toggleBalanceBtn.addEventListener('click', () => {
            isHidden = !isHidden;
            if (isHidden) {
                balanceAmount.textContent = '*******';
                eyeIcon.setAttribute('data-icon', 'ri:eye-off-line');
            } else {
                balanceAmount.textContent = '$0.00';
                eyeIcon.setAttribute('data-icon', 'ri:eye-line');
            }
        });
    }

    // --- 5. Close Promo Card ---
    const closePromoBtn = document.getElementById('closePromoBtn');
    const promoCard = document.getElementById('promoCard');

    if (closePromoBtn && promoCard) {
        closePromoBtn.addEventListener('click', () => {
            promoCard.style.display = 'none';
        });
    }

});


const qtDropdownBtn = document.getElementById("qtDropdownBtn");
const qtDropdownMenu = document.getElementById("qtDropdownMenu");

if (qtDropdownBtn && qtDropdownMenu) {
    qtDropdownBtn.addEventListener("click", () => {
        qtDropdownMenu.classList.toggle("active");
        qtDropdownBtn.classList.toggle("active");
    });

    window.addEventListener("click", (e) => {
        if (!qtDropdownBtn.contains(e.target) && !qtDropdownMenu.contains(e.target)) {
            qtDropdownMenu.classList.remove("active");
            qtDropdownBtn.classList.remove("active");
        }
    });
}

const acmVerifyBtn = document.getElementById("acmVerifyBtn");
const acmVerifyMenu = document.getElementById("acmVerifyMenu");

if (acmVerifyBtn && acmVerifyMenu) {
    acmVerifyBtn.addEventListener("click", () => {
        acmVerifyBtn.classList.toggle("active");
        acmVerifyMenu.classList.toggle("active");
    });
}


// Main section starts here
const apiBaseUrl = '/api/real-estate';

function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    if (meta) {
        return meta.content;
    }
    const match = document.cookie.match(new RegExp('(^| )XSRF-TOKEN=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
}

async function fetchJson(url, options = {}) {
    const response = await fetch(url, {
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            ...(options.headers || {}),
        },
        ...options,
    });

    const json = await response.json();
    if (!response.ok) {
        throw new Error(json.message || 'Request failed');
    }
    return json;
}

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("investmentModal");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const investInput = document.getElementById("investAmountInput");
    const presetChipsContainer = document.getElementById("presetChipsContainer");
    const calcTokensDisplay = document.getElementById("calcTokens");
    const propertyGrid = document.querySelector(".property-grid");
    const confirmBtn = document.getElementById("confirmInvestmentBtn");

    // Structural dynamic pointers inside Modal
    const mTitle = document.getElementById("modalPropertyTitle");
    const mMeta = document.getElementById("modalPropertyMeta");
    const mLimit = document.getElementById("modalLimitLabel");

    // Active working dataset scope memory
    let currentCardData = null;

    async function loadProperties() {
        if (!propertyGrid) return;

        try {
            const response = await fetchJson(`${apiBaseUrl}/properties`);
            const properties = Array.isArray(response.data) ? response.data : [];
            renderPropertyCards(properties);
        } catch (error) {
            console.error('Failed to load properties', error);
            propertyGrid.innerHTML = '<p class="error-message">Unable to load properties at this time. Please refresh the page.</p>';
        }
    }

    function renderPropertyCards(properties) {
        if (!propertyGrid) return;

        if (properties.length === 0) {
            propertyGrid.innerHTML = '<p class="empty-state">No active real estate properties are available right now.</p>';
            return;
        }

        propertyGrid.innerHTML = properties.map((property) => {
            const soldTokens = Number(property.sold_tokens || property.total_tokens - property.available_tokens || 0);
            const totalTokens = Number(property.total_tokens || 0);
            const progress = totalTokens > 0 ? Math.min(100, Math.round((soldTokens / totalTokens) * 100)) : 0;
            const imageUrl = property.main_image || property.galleries?.[0]?.image || 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=600&q=80';
            const statusBadge = property.property_status === 'Sold Out' ? 'badge-soldout' : (property.property_status === 'Active' ? 'badge-hot' : 'badge-new');
            const minInvestment = Number(property.minimum_investment || 0);
            const maxInvestment = Number(property.maximum_investment || 0);
            const tokenPrice = Number(property.token_price || 0);
            const propertyLocation = [property.city, property.state, property.country].filter(Boolean).join(', ');

            return `
                <div class="property-card" data-id="${property.id}" data-slug="${property.slug}" data-title="${property.property_name}" data-location="${propertyLocation}" data-apy="${property.estimated_apy}" data-price="${tokenPrice}" data-min="${minInvestment}" data-max="${maxInvestment}">
                    <div class="card-image-wrapper">
                        <img src="${imageUrl}" alt="${property.property_name}">
                        <span class="${statusBadge}">${property.property_status}</span>
                        <span class="badge-apy">${Number(property.estimated_apy || 0).toFixed(1)}% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>${property.property_name}</h3>
                            <span class="total-value">$${Number(property.market_value || 0).toLocaleString()}</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> ${propertyLocation}</p>
                        <p class="description">${property.description || 'Tokenized fractional ownership with consistent rental yield potential.'}</p>
                        <div class="tags">
                            <span><i class='bx bx-money'></i> ${property.token_price ? `$${property.token_price}` : 'N/A'}</span>
                            <span><i class='bx bx-building'></i> ${property.property_type || 'Property'}</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: ${progress}%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>${soldTokens.toLocaleString()} tokens sold</span>
                            <span>${Number(property.available_tokens || 0).toLocaleString()} available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$${tokenPrice.toFixed(2)}</strong></div>
                            <div><small>Min. Investment</small><strong>$${minInvestment.toFixed(2)}</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal" ${property.property_status === 'Sold Out' || property.available_tokens <= 0 ? 'disabled' : ''}>Invest Now</button>
                    </div>
                </div>
            `;
        }).join('');

        attachCardListeners();
    }

    function attachCardListeners() {
        document.querySelectorAll(".btn-trigger-modal").forEach((button) => {
            button.addEventListener("click", (e) => {
                const card = e.target.closest(".property-card");
                if (!card) return;

                currentCardData = {
                    id: card.getAttribute("data-id"),
                    title: card.getAttribute("data-title"),
                    location: card.getAttribute("data-location"),
                    apy: parseFloat(card.getAttribute("data-apy")) || 0,
                    tokenPrice: parseFloat(card.getAttribute("data-price")) || 0,
                    minInvest: parseFloat(card.getAttribute("data-min")) || 0,
                    maxInvest: parseFloat(card.getAttribute("data-max")) || 0,
                };

                mTitle.innerText = `Invest in ${currentCardData.title}`;
                mMeta.innerText = `${currentCardData.location} • ${currentCardData.apy}% APY`;
                mLimit.innerText = `Min: $${currentCardData.minInvest.toLocaleString()} • Max: $${currentCardData.maxInvest.toLocaleString()}`;

                investInput.value = currentCardData.minInvest;
                investInput.min = currentCardData.minInvest;
                investInput.max = currentCardData.maxInvest;

                generateDynamicChips(currentCardData.minInvest, currentCardData.maxInvest);
                recalculateTokens();
                modal.classList.add("active");
            });
        });
    }

    function generateDynamicChips(min, max) {
        if (!presetChipsContainer) return;
        presetChipsContainer.innerHTML = "";

        const steps = [min, min * 2, min * 5, max];
        const cleanUniqueSteps = [...new Set(steps)].filter(val => val <= max && val > 0);

        cleanUniqueSteps.forEach((amount) => {
            const chipElement = document.createElement("button");
            chipElement.className = "chip";
            chipElement.type = 'button';
            chipElement.innerText = `$${Math.floor(amount).toLocaleString()}`;
            chipElement.addEventListener("click", () => {
                investInput.value = Math.floor(amount);
                recalculateTokens();
            });
            presetChipsContainer.appendChild(chipElement);
        });
    }

    function recalculateTokens() {
        if (!currentCardData || !calcTokensDisplay) return;
        const amountEntered = parseFloat(investInput.value) || 0;
        const exactTokens = currentCardData.tokenPrice > 0 ? amountEntered / currentCardData.tokenPrice : 0;
        calcTokensDisplay.innerText = `${exactTokens.toFixed(2)} tokens`;
    }

    async function submitInvestment() {
        if (!currentCardData) return;

        const amountEntered = parseFloat(investInput.value) || 0;
        if (amountEntered < currentCardData.minInvest) {
            alert(`Minimum investment for this asset is $${currentCardData.minInvest}`);
            return;
        }
        if (amountEntered > currentCardData.maxInvest) {
            alert(`Maximum investment capacity reached for this asset is $${currentCardData.maxInvest}`);
            return;
        }

        try {
            await fetchJson(`${apiBaseUrl}/invest`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken() || ''
                },
                body: JSON.stringify({
                    property_id: currentCardData.id,
                    investment_amount: amountEntered
                })
            });

            alert(`Investment of $${amountEntered.toLocaleString()} in ${currentCardData.title} was processed successfully!`);
            window.location.href = '/myRealEstateinvestment';
        } catch (error) {
            console.error(error);
            if (/insufficient|balance/i.test(error.message || '')) {
                alert(error.message || 'Insufficient funds. Redirecting to deposit page.');
                window.location.href = '/deposit';
                return;
            }
            alert(error.message || 'Could not process investment. Please try again.');
        }
    }

    if (confirmBtn) {
        confirmBtn.addEventListener("click", submitInvestment);
    }

    if (investInput) {
        investInput.addEventListener("input", recalculateTokens);
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", () => modal.classList.remove("active"));
    }

    window.addEventListener("click", (e) => {
        if (e.target === modal) modal.classList.remove("active");
    });

    const myInvestmentBtn = document.querySelector('.btn-my-investments');
    if (myInvestmentBtn) {
        myInvestmentBtn.addEventListener('click', () => {
            window.location.href = '/myRealEstateinvestment';
        });
    }

    loadProperties();
});