document.addEventListener('DOMContentLoaded', () => {

    // Core Navigation Elements
    const navbar = document.getElementById('navbar');
    const menuToggle = document.getElementById('mobile-menu');
    const navMenu = document.getElementById('nav-menu');

    // Mobile Breakpoint (must match CSS)
    const MOBILE_BP = 1024;

    /**
     * 1. THE MOBILE MENU TOGGLE
     */
    menuToggle.addEventListener('click', () => {
        // Toggle 'active' state on the toggle button
        menuToggle.classList.toggle('is-active');
        // Toggle 'open' state on the menu container
        navMenu.classList.toggle('is-open');
        // Toggle class on body/navbar to handle burger animation and scroll lock
        navbar.classList.toggle('menu-is-active');

        const isOpen = navMenu.classList.contains('is-open');
        menuToggle.setAttribute('aria-expanded', isOpen);

        // Prevent body from scrolling when menu is open
        document.body.style.overflow = isOpen ? 'hidden' : 'initial';
    });

    /**
     * 2. MOBILE-SPECIFIC DROPDOWN HANDLER
     * Ensures tapping opens the dropdown instead of navigating.
     */
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        // The main link (.nav-link) must be the click trigger
        const triggerLink = dropdown.querySelector('.nav-link');

        triggerLink.addEventListener('click', (event) => {

            // IF we are in mobile view...
            if (window.innerWidth <= MOBILE_BP) {
                // ...Prevent the main link from navigating immediately
                event.preventDefault();

                // --- Premium behavior: Close other open dropdowns first ---
                dropdowns.forEach(other => {
                    if (other !== dropdown) other.classList.remove('is-expanded');
                });

                // Toggle visibility on the current dropdown
                const isExpanding = dropdown.classList.toggle('is-expanded');

                // Option: If we actually want to navigate, we need a 
                // different mechanism or just treat these as folders.
                // Currently, this logic treats parents as simple folders.
            }
        });
    });

    /**
     * 3. UX FINISHING TOUCHES
     */
    // If the window is resized larger while the mobile menu is open, clean up states.
    window.addEventListener('resize', () => {
        if (window.innerWidth > MOBILE_BP) {
            navMenu.classList.remove('is-open');
            navbar.classList.remove('menu-is-active');
            document.body.style.overflow = 'initial';
        }
    });

    // Option: Close mobile menu if a direct link (non-dropdown) is clicked.
    const directLinks = document.querySelectorAll('.nav-menu > .nav-item > .nav-link:not(.dropdown .nav-link)');
    directLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= MOBILE_BP) {
                navMenu.classList.remove('is-open');
                navbar.classList.remove('menu-is-active');
                document.body.style.overflow = 'initial';
            }
        });
    });
});

////////////////////////////////////////////////////////////
// ✅ ACTIVE NAV LINK + MOBILE FIX (PASTE AT BOTTOM)
////////////////////////////////////////////////////////////

document.addEventListener('DOMContentLoaded', () => {

    // ===== ACTIVE LINK =====
    const currentPage = window.location.pathname.split("/").pop();

    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        const linkPage = link.getAttribute('href');

        if (linkPage === currentPage) {
            link.classList.add('active');

            // Highlight dropdown parent too
            const parentDropdown = link.closest('.dropdown');
            if (parentDropdown) {
                parentDropdown.classList.add('active');
            }
        }
    });

    // Fix for homepage (/)
    if (currentPage === "") {
        const homeLink = document.querySelector('a[href="/"]');
        if (homeLink) homeLink.classList.add('active');
    }

});