// Preloader starts here

// =========================================================
// HIGH-FIDELITY AUTOMATED PRELOADER ENGINE
// =========================================================
(function() {
    const preloaderElement = document.getElementById("nexuist-preloader");
    
    if (preloaderElement) {
        // Core removal helper function
        const dismissLoader = () => {
            if (!preloaderElement.classList.contains("loaded")) {
                preloaderElement.classList.add("loaded");
                console.log("System Initialized: Nexuist environment online.");
            }
        };

        // 1. DISMISS ON WINDOW COMPLETE LOAD (Standard Behavior)
        window.addEventListener("load", dismissLoader);

        // 2. DISMISS AUTOMATICALLY AFTER 2 SECONDS (Failsafe Backup Loop)
        // This guarantees that if a script or chart fails, the loader still drops away.
        setTimeout(dismissLoader, 2000);
    }
})();
// Preloader ends here 

document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("sidebar-toggle-btn");
    const mobileMenuBtn = document.getElementById("mobile-hamburger-btn");
    const modeToggle = document.querySelector(".mode-toggle-wrapper");
    const modeIcon = document.querySelector(".mode-icon-indicator");
    const modeLabel = document.querySelector(".mode-label");
    const navLinks = document.querySelectorAll(".nav-links > li:not(.control-items)");
    const pageTitle = document.getElementById("page-title-display");

    // =========================================
    // DESKTOP SIDEBAR COLLAPSE TOGGLE
    // =========================================
    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    }

    // =========================================
    // MOBILE DRAWER HAMBURGER TRIGGER
    // =========================================
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            sidebar.classList.toggle("open");
        });
    }

    // Close mobile menu if clicked outside the sidebar drawer area
    document.addEventListener("click", (e) => {
        if (window.innerWidth <= 576 && !sidebar.contains(e.target) && sidebar.classList.contains("open")) {
            sidebar.classList.remove("open");
        }
    });

    // =========================================
    // PERSISTENT LIGHT & DARK THEME ENGINE
    // =========================================
    const savedTheme = localStorage.getItem("theme") || "dark";
    document.documentElement.setAttribute("data-theme", savedTheme);
    updateThemeUI(savedTheme);

    if (modeToggle) {
        modeToggle.addEventListener("click", () => {
            const currentTheme = document.documentElement.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";

            document.documentElement.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);
            updateThemeUI(newTheme);
        });
    }

    function updateThemeUI(theme) {
        if (!modeIcon || !modeLabel) return;
        if (theme === "light") {
            modeIcon.className = "bx bx-sun mode-icon-indicator";
            modeLabel.textContent = "Light Mode";
        } else {
            modeIcon.className = "bx bx-moon mode-icon-indicator";
            modeLabel.textContent = "Dark Mode";
        }
    }

    // =========================================
    // ACTIVE ROUTE ROUTING HANDLING
    // =========================================
    navLinks.forEach(linkItem => {
        const anchor = linkItem.querySelector("a");
        if (!anchor) return;

        anchor.addEventListener("click", function (e) {
            // Remove active tags styling across alternate nodes
            navLinks.forEach(item => item.classList.remove("active"));

            // Highlight current clicked node
            linkItem.classList.add("active");

            // Extract text string to dynamic header element
            const textSpan = linkItem.querySelector(".link_name");
            if (textSpan && pageTitle) {
                pageTitle.textContent = textSpan.textContent;
            }

            // Close mobile tray automatically if route fired
            if (window.innerWidth <= 576) {
                sidebar.classList.remove("open");
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", () => {
    // ---------------------------------------------------------
    // 1. CHART DATASETS (Simulated AJAX Server Payloads)
    // ---------------------------------------------------------
    const chartData = {
        "1D": [34000, 34200, 34100, 34500, 34400, 34800, 34700, 35100, 34900, 35400, 35200, 35800],
        "1W": [32000, 32800, 31500, 33400, 34100, 33900, 35800],
        "1M": [28000, 29500, 31000, 30500, 32400, 31900, 33500, 34200, 33900, 35800],
        "1Y": [18000, 22000, 21000, 24500, 26000, 25500, 29000, 31000, 30000, 33400, 34000, 35800]
    };

    const chartCategories = {
        "1D": ["12 AM", "2 AM", "4 AM", "6 AM", "8 AM", "10 AM", "12 PM", "2 PM", "4 PM", "6 PM", "8 PM", "10 PM"],
        "1W": ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
        "1M": ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7", "Week 8", "Week 9", "Week 10"],
        "1Y": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
    };

    // ---------------------------------------------------------
    // 2. INITIALIZE APEXCHARTS
    // ---------------------------------------------------------
    const chartOptions = {
        series: [{
            name: 'Portfolio Value ($)',
            data: chartData["1D"] // Default starting dataset
        }],
        chart: {
            type: 'area',
            height: '100%',
            toolbar: { show: false }, // Hides bulky control panels for clean UI
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 600, // Smooth transition speed
            },
            background: 'transparent'
        },
        colors: ['#00d4ff'], // Your secondary-color brand hex
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.0, // Fades completely at the bottom for premium look
                stops: [0, 90, 100]
            }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        dataLabels: { enabled: false },
        grid: {
            borderColor: 'rgba(255, 255, 255, 0.05)',
            xaxis: { lines: { show: false } },
            yaxis: { lines: { show: true } }
        },
        xaxis: {
            categories: chartCategories["1D"],
            labels: { style: { colors: '#64748b', fontFamily: 'Inter' } },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                style: { colors: '#64748b', fontFamily: 'Inter' },
                formatter: (val) => '$' + val.toLocaleString()
            }
        },
        theme: { mode: 'dark' }
    };

    // Render the chart globally inside the container
    const liveChart = new ApexCharts(document.querySelector("#nexuist-live-chart"), chartOptions);
    liveChart.render();

    // ---------------------------------------------------------
    // 3. TIMEFRAME FILTERING ENGINE
    // ---------------------------------------------------------
    const timeframeSpans = document.querySelectorAll(".timeframe-selectors span");
    const chartStatusText = document.getElementById("chart-status");

    timeframeSpans.forEach(span => {
        span.addEventListener("click", function () {
            // Remove active highlight from all buttons, add to current clicked button
            timeframeSpans.forEach(s => s.classList.remove("active"));
            this.classList.add("active");

            const selectedTimeframe = this.getAttribute("data-timeframe");

            // Trigger actual chart refresh
            updateChartData(selectedTimeframe);
        });
    });

    function updateChartData(timeframe) {
        // Show interactive status update
        if (chartStatusText) {
            chartStatusText.innerHTML = `<i class='bx bx-loader-alt bx-spin' style='color:#6c63ff;'></i> Syncing ${timeframe} market vectors...`;
        }

        // Update ApexCharts series and labels with smooth data-morph animation
        liveChart.updateOptions({
            xaxis: { categories: chartCategories[timeframe] }
        });

        liveChart.updateSeries([{
            data: chartData[timeframe]
        }]);

        // Reset system status line after animation loads
        setTimeout(() => {
            if (chartStatusText) {
                chartStatusText.innerHTML = `<i class='bx bx-pulse' style='color:#22c55e;'></i> Stream via AJAX Connection Active (${timeframe})`;
            }
        }, 500);
    }
});




