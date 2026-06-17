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

    const preloaderInterval = setInterval(() => {
        progress += Math.random() * 15;

        if (progress >= 100) {
            progress = 100;
            clearInterval(preloaderInterval);
            setTimeout(() => {
                if (preloader) {
                    preloader.classList.add("preloader-hidden");
                    setTimeout(() => preloader.remove(), 600);
                }
            }, 500);
        }

        if (loadBar) loadBar.style.width = `${progress}%`;
        if (progress > (messageIndex + 1) * 20 && messageIndex < messages.length - 1) {
            messageIndex++;
            if (statusText) statusText.innerText = messages[messageIndex];
        }
    }, 150);

    const botDataElement = document.getElementById('laravel-bot-data');
    let fullBotList = [];
    if (botDataElement && botDataElement.dataset.bots) {
        try {
            fullBotList = JSON.parse(botDataElement.dataset.bots);
        } catch (error) {
            console.error('Failed to parse bot data:', error);
            fullBotList = [];
        }
    }

    const botGrid = document.getElementById('botGrid');
    const deployBotBtn = document.getElementById('deployBotBtn');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const botSearchInput = document.getElementById('botSearchInput');
    const qtDropdownBtn = document.getElementById('qtDropdownBtn');
    const qtDropdownMenu = document.getElementById('qtDropdownMenu');
    const acmVerifyBtn = document.getElementById('acmVerifyBtn');
    const acmVerifyMenu = document.getElementById('acmVerifyMenu');
    const closePromoBtn = document.getElementById('closePromoBtn');
    const promoCard = document.getElementById('promoCard');
    const viewMoreBtn = document.getElementById('viewMoreBtn');
    const extraAssets = document.getElementById('extraAssets');
    const toggleMarketBtn = document.getElementById('toggleMarketBtn');
    const extraMarketAssets = document.getElementById('extraMarketAssets');

    function renderBots(filter = 'all') {
        if (!botGrid) return;
        botGrid.innerHTML = '';

        if (!fullBotList.length) {
            botGrid.innerHTML = '<div class="empty-state">No trading bots available yet.</div>';
            return;
        }

        const searchQuery = botSearchInput?.value.trim().toLowerCase() || '';

        fullBotList.forEach(bot => {
            const marketStyle = (bot.trading_style || bot.strategy_type || '').toLowerCase();
            const description = (bot.description || '').toLowerCase();
            const fallbackMatch = [marketStyle, description, (bot.bot_name || '').toLowerCase(), (bot.strategy_type || '').toLowerCase()];
            if (filter !== 'all' && !fallbackMatch.some(value => value.includes(filter.toLowerCase()))) return;

            const botName = bot.bot_name || '';
            const strategyType = bot.strategy_type || '';
            const matchSearch = !searchQuery || [botName, strategyType, description, marketStyle]
                .some(value => value.toLowerCase().includes(searchQuery));

            if (!matchSearch) return;

            const card = document.createElement('div');
            card.className = 'bot-card';
            card.innerHTML = `
                <span class="status-chip">${bot.status || 'Live'}</span>
                <h3><i class='bx bx-bot'></i> ${bot.bot_name || 'Unnamed Bot'}</h3>
                <p class="bot-subtitle">${bot.trading_style || bot.strategy_type || 'Strategy'}</p>
                <div class="card-stats">
                    <div><small>Daily ROI</small><br><strong>${bot.monthly_return ?? 0}%</strong></div>
                    <div><small>Duration</small><br><strong>30 Days</strong></div>
                </div>
                <button class="btn-invest" data-bot-id="${bot.id}">Details & Invest →</button>
            `;
            botGrid.appendChild(card);
        });

        botGrid.querySelectorAll('.btn-invest').forEach(button => {
            button.addEventListener('click', () => {
                const botId = button.dataset.botId;
                if (botId) openTerminal(Number(botId));
            });
        });
    }

    function openTerminal(botId) {
        const bot = fullBotList.find(b => Number(b.id) === Number(botId));
        if (!bot) {
            console.error('Bot not found:', botId);
            return;
        }

        const selectedBotName = document.getElementById('selectedBotName');
        const selectedBotDesc = document.getElementById('selectedBotDesc');
        const selectedBotROI = document.getElementById('selectedBotROI');
        const selectedBotDays = document.getElementById('selectedBotDays');
        const selectedBotRisk = document.getElementById('selectedBotRisk');
        const chartContainer = document.getElementById('tradingview_chart');

        if (selectedBotName) selectedBotName.innerText = bot.bot_name || 'Unnamed Bot';
        if (selectedBotDesc) selectedBotDesc.innerText = bot.description || 'Professional trading strategy';
        if (selectedBotROI) selectedBotROI.innerText = `${bot.monthly_return ?? 0}%`;
        if (selectedBotDays) selectedBotDays.innerText = '30 Days';
        if (selectedBotRisk) selectedBotRisk.innerText = bot.risk_level || 'N/A';
        if (deployBotBtn) deployBotBtn.dataset.botid = bot.id;

        // Populate terminal-specific UI elements from backend-provided bot fields
        const avgSuccessRateEl = document.getElementById('avgSuccessRate');
        const totalNetProfitEl = document.getElementById('totalNetProfit');
        const expectedROIEl = document.getElementById('expectedROI');
        const investRangeInfoEl = document.getElementById('investRangeInfo');
        const svgPercentText = document.getElementById('svgPercentage');
        const circlePath = document.querySelector('.success-circle .circle');

        const accuracy = bot.accuracy_rate ?? 0;
        const monthly = bot.monthly_return ?? 0;
        const minInv = typeof bot.minimum_investment !== 'undefined' ? Number(bot.minimum_investment) : 0;
        const maxInv = typeof bot.maximum_investment !== 'undefined' ? Number(bot.maximum_investment) : 0;
        const totalProfit = typeof bot.total_net_profit !== 'undefined' ? Number(bot.total_net_profit) : 0;

        if (avgSuccessRateEl) avgSuccessRateEl.innerText = `${Number(accuracy).toFixed(2)}%`;
        if (expectedROIEl) expectedROIEl.innerText = `${Number(monthly).toFixed(2)}%`;
        if (totalNetProfitEl) totalNetProfitEl.innerText = `$${totalProfit.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})}`;
        if (investRangeInfoEl) investRangeInfoEl.innerText = `Min: $${minInv.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} • Max: $${maxInv.toLocaleString(undefined, {minimumFractionDigits:0})}`;
        if (svgPercentText) svgPercentText.innerText = `${Math.round(accuracy)}%`;
        if (circlePath) circlePath.setAttribute('stroke-dasharray', `${Math.round(accuracy)}, 100`);

        if (chartContainer) {
            chartContainer.innerHTML = '';
            if (typeof TradingView !== 'undefined' && window.TradingView && window.TradingView.widget) {
                new TradingView.widget({
                    container_id: 'tradingview_chart',
                    width: '100%',
                    height: 320,
                    symbol: 'BINANCE:BTCUSDT',
                    interval: '15',
                    timezone: 'Etc/UTC',
                    theme: 'dark',
                    style: '1',
                    locale: 'en',
                    toolbar_bg: '#0f172a',
                    enable_publishing: false,
                    hide_top_toolbar: true,
                    save_image: false
                });
            }
        }

        showPage('trading-terminal-page');
    }

    window.openTerminal = openTerminal;

    if (deployBotBtn) {
        deployBotBtn.addEventListener('click', function () {
            const amountInput = document.getElementById('investAmountInput');
            const amount = amountInput ? amountInput.value : '';
            const botId = this.dataset.botid;

            if (!amount) {
                alert('Enter investment amount');
                return;
            }

            fetch(`/bot/invest/${botId}`, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ amount: Number(amount) })
            })
            .then(response => {
                if (response.status === 401) {
                    window.location.href = '/login';
                    throw new Error('Unauthorized');
                }
                if (response.status === 419) {
                    // CSRF token mismatch / session expired
                    window.location.href = '/login';
                    throw new Error('Session expired');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Investment successful');
                    window.location.href = data.redirect || '/deploybot';
                    return;
                }
                // show message and follow redirect if provided
                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }
                alert(data.message || 'Investment failed');
            })
            .catch(error => {
                console.error('Investment error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const currentActive = document.querySelector('.filter-btn.active');
            if (currentActive) currentActive.classList.remove('active');
            btn.classList.add('active');
            renderBots(btn.dataset.filter || 'all');
        });
    });
    if (botSearchInput) {
        botSearchInput.addEventListener('input', () => renderBots(document.querySelector('.filter-btn.active')?.dataset.filter || 'all'));
    }
    const toggleBalanceBtn = document.getElementById('toggleBalanceBtn');
    const balanceAmount = document.getElementById('balanceAmount');
    const eyeIcon = document.getElementById('eyeIcon');
    let isBalanceHidden = false;
    if (toggleBalanceBtn && balanceAmount && eyeIcon) {
        toggleBalanceBtn.addEventListener('click', () => {
            isBalanceHidden = !isBalanceHidden;
            balanceAmount.textContent = isBalanceHidden ? '*******' : '$0.00';
            eyeIcon.setAttribute('data-icon', isBalanceHidden ? 'ri:eye-off-line' : 'ri:eye-line');
        });
    }

    if (qtDropdownBtn && qtDropdownMenu) {
        qtDropdownBtn.addEventListener('click', (event) => {
            event.stopPropagation();
            qtDropdownMenu.classList.toggle('active');
            qtDropdownBtn.classList.toggle('active');
        });
    }

    if (acmVerifyBtn && acmVerifyMenu) {
        acmVerifyBtn.addEventListener('click', () => {
            acmVerifyBtn.classList.toggle('active');
            acmVerifyMenu.classList.toggle('active');
        });
    }

    if (closePromoBtn && promoCard) {
        closePromoBtn.addEventListener('click', () => {
            promoCard.style.display = 'none';
        });
    }

    if (viewMoreBtn && extraAssets) {
        viewMoreBtn.addEventListener('click', function () {
            extraAssets.classList.toggle('show');
            this.textContent = extraAssets.classList.contains('show') ? 'Show Less' : 'View Full Market';
        });
    }

    if (toggleMarketBtn && extraMarketAssets) {
        toggleMarketBtn.addEventListener('click', function () {
            extraMarketAssets.classList.toggle('show');
            this.classList.toggle('active');
            const btnText = this.querySelector('.btn-text');
            if (btnText) {
                btnText.innerText = extraMarketAssets.classList.contains('show') ? 'Show Less' : 'View Full Market';
            }
        });
    }

    window.addEventListener('click', (event) => {
        if (qtDropdownBtn && qtDropdownMenu && !qtDropdownBtn.contains(event.target) && !qtDropdownMenu.contains(event.target)) {
            qtDropdownMenu.classList.remove('active');
            qtDropdownBtn.classList.remove('active');
        }

        if (acmVerifyBtn && acmVerifyMenu && !acmVerifyBtn.contains(event.target) && !acmVerifyMenu.contains(event.target)) {
            acmVerifyBtn.classList.remove('active');
            acmVerifyMenu.classList.remove('active');
        }
    });

    renderBots('all');
});

function showPage(pageId) {
    const botHub = document.getElementById('bot-hub-page');
    const terminalPage = document.getElementById('trading-terminal-page');
    if (botHub) botHub.classList.add('hidden');
    if (terminalPage) terminalPage.classList.add('hidden');
    const target = document.getElementById(pageId);
    if (target) target.classList.remove('hidden');
    window.scrollTo(0, 0);
}
