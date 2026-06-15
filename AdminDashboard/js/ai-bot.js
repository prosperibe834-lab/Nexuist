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

        anchor.addEventListener("click", function(e) {
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

// Main Section starts here
// =========================================================
    // NEXUIST QUANTUM COGNITIVE BOT INTELLIGENCE ENGINE LOGIC
    // =========================================================
    const aiFormElement = document.getElementById("nexuist-ai-input-form-execution");
    const aiTextFieldInput = document.getElementById("ai-user-prompt-text-field");
    const aiChatStreamContainer = document.getElementById("ai-chat-stream-viewport");
    const aiProcessingLoaderNode = document.getElementById("ai-processing-loader-indicator");
    const aiDirectPromptChipsList = document.querySelectorAll(".nx-ai-chip");

    // Dynamic Database of System Responses to Simulate High-End Fintech Functionality
    const aiSimulationKnowledgeBase = {
        "audit": "System Log Matrix Verification: All operational nodes checked. Pending outbound volume stands at $28,450.00 across 5 sign-offs. Settled monthly liquidity outflows equal $412,050.00. Asset reserves remain 100% backed and balanced.",
        "plans": "Yield Contract Scanning: 3 priority options are deployed. 1) Alpha Core strategy yielding 4.5%/wk, 2) Nexus Premium tracking at 7.2%/wk (optimal performance tier), and 3) Apex Quant generating 11.5%/wk bound to high-net institutional routing parameters.",
        "report": "Market Risk Cross-Intersection Data: Global liquidity spreads indicate slight volatility contractions within Layer-2 pools. The current recommendation is to leave risk tolerances at Conservative for automated script runs, protecting ledger margins.",
        "default": "Directive mapped successfully. Core instruction processed by Nexus ledger engines. Performance parameters are optimal and trading routines continue uninterrupted."
    };

    // --- APPEND MESSAGE SYSTEM BUBBLE COMPONENT LINK ---
    function appendChatBubbleToStream(senderType, narrativeText) {
        if (!aiChatStreamContainer) return;

        const dateObject = new Date();
        const formattedTimeString = dateObject.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        const componentBubble = document.createElement("div");
        componentBubble.className = `nx-chat-bubble item-${senderType}-type`;

        const vectorIcon = senderType === "bot" ? "bx-bot" : "bx-user";

        componentBubble.innerHTML = `
            <div class="avatar-box"><i class='bx ${vectorIcon}'></i></div>
            <div class="message-content-wrapper">
                <div class="meta-sender">${senderType === "bot" ? "NEXUS AI SYSTEM" : "OPERATOR CLIENT"} • <span class="time-stamp">${formattedTimeString}</span></div>
                <div class="message-body">${narrativeText}</div>
            </div>
        `;

        aiChatStreamContainer.appendChild(componentBubble);
        
        // Auto Scroll to Terminal Bottom Baseline
        aiChatStreamContainer.scrollTop = aiChatStreamContainer.scrollHeight;
    }

    // --- DISPATCH SIMULATED COGNITIVE BRAIN RESPONSE RUNNER ---
    function executeBotSystemBrainSimulation(userPromptText) {
        if (!aiProcessingLoaderNode) return;

        // Display Loading Core State
        aiProcessingLoaderNode.style.display = "flex";
        if (aiChatStreamContainer) aiChatStreamContainer.scrollTop = aiChatStreamContainer.scrollHeight;

        // Parse query criteria loops
        const lookupKey = userPromptText.toLowerCase();
        let targetResolution = aiSimulationKnowledgeBase["default"];

        if (lookupKey.includes("audit") || lookupKey.includes("balance")) {
            targetResolution = aiSimulationKnowledgeBase["audit"];
        } else if (lookupKey.includes("plan") || lookupKey.includes("investment")) {
            targetResolution = aiSimulationKnowledgeBase["plans"];
        } else if (lookupKey.includes("report") || lookupKey.includes("volatility") || lookupKey.includes("market")) {
            targetResolution = aiSimulationKnowledgeBase["report"];
        }

        // Simulate Network Processing Wait Delay Latency Periods
        setTimeout(() => {
            aiProcessingLoaderNode.style.display = "none";
            appendChatBubbleToStream("bot", targetResolution);
        }, 1200);
    }

    // --- TRANSMIT USER FORM INTERACTION DIRECTIVES ---
    if (aiFormElement && aiTextFieldInput) {
        aiFormElement.addEventListener("submit", (e) => {
            e.preventDefault();
            
            const clientNarrative = aiTextFieldInput.value.trim();
            if (!clientNarrative) return;

            // Push User Message to Terminal Stream Screen Viewport
            appendChatBubbleToStream("user", clientNarrative);
            aiTextFieldInput.value = "";

            // Invoke automated brain response parser
            executeBotSystemBrainSimulation(clientNarrative);
        });
    }

    // --- BIND INTERACTIVE SMART DIRECTIONAL SUGGESTIONS CHIPS ---
    if (aiDirectPromptChipsList.length > 0) {
        aiDirectPromptChipsList.forEach(chip => {
            chip.addEventListener("click", () => {
                const embeddedDirectiveText = chip.getAttribute("data-directive");
                if (!embeddedDirectiveText) return;

                // Directly write code pipeline instructions and fire processing routine sequences
                appendChatBubbleToStream("user", embeddedDirectiveText);
                executeBotSystemBrainSimulation(embeddedDirectiveText);
            });
        });
    }