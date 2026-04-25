/* ==========================================================================
   Theme Toggle — Light / Dark mode with localStorage persistence
   ========================================================================== */
(function () {
    var STORAGE_KEY = 'cashier_theme';
    var DEFAULT_THEME = 'dark';

    function applyTheme(theme) {
        var body = document.body;
        if (!body) return;

        if (theme === 'light') {
            body.classList.remove('dark-mode');
            body.classList.add('light-mode');

            // AdminLTE sidebar variant
            var sidebar = document.querySelector('.main-sidebar');
            if (sidebar) {
                sidebar.classList.remove('sidebar-dark-primary');
                sidebar.classList.add('sidebar-light-primary');
            }

            var navbar = document.querySelector('.main-header.navbar');
            if (navbar) {
                navbar.classList.remove('navbar-dark');
                navbar.classList.add('navbar-light', 'navbar-white');
            }
        } else {
            body.classList.remove('light-mode');
            body.classList.add('dark-mode');

            var sidebar = document.querySelector('.main-sidebar');
            if (sidebar) {
                sidebar.classList.remove('sidebar-light-primary');
                sidebar.classList.add('sidebar-dark-primary');
            }

            var navbar = document.querySelector('.main-header.navbar');
            if (navbar) {
                navbar.classList.remove('navbar-light', 'navbar-white');
                navbar.classList.add('navbar-dark');
            }
        }
    }

    function getSavedTheme() {
        try {
            return localStorage.getItem(STORAGE_KEY) || DEFAULT_THEME;
        } catch (e) {
            return DEFAULT_THEME;
        }
    }

    function saveTheme(theme) {
        try { localStorage.setItem(STORAGE_KEY, theme); } catch (e) {}
    }

    // Apply as early as possible to avoid FOUC
    document.addEventListener('DOMContentLoaded', function () {
        applyTheme(getSavedTheme());

        var toggle = document.getElementById('themeToggleBtn');
        if (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                var current = getSavedTheme();
                var next = current === 'dark' ? 'light' : 'dark';
                saveTheme(next);
                applyTheme(next);
            });
        }
    });

    // Expose for manual calls if needed
    window.CashierTheme = { apply: applyTheme, get: getSavedTheme, set: function (t) { saveTheme(t); applyTheme(t); } };

    /* ======================================================================
       KILL AdminLTE sidebar hover-expand permanently.
       AdminLTE's PushMenu JS adds `sidebar-focused` to <body> on mouseenter.
       Its CSS then widens the sidebar. We use a MutationObserver to strip
       that class the moment it appears while the sidebar is collapsed —
       faster than any CSS transition can fire.
       ====================================================================== */
    (function () {
        function killSidebarFocused() {
            if (
                document.body.classList.contains('sidebar-collapse') &&
                document.body.classList.contains('sidebar-focused')
            ) {
                document.body.classList.remove('sidebar-focused');
            }
        }

        var observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (m) {
                if (m.type === 'attributes' && m.attributeName === 'class') {
                    killSidebarFocused();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
            killSidebarFocused(); // run once immediately on load
        });
    })();

    /* ======================================================================
       Desktop sidebar arrow toggle — bottom-of-sidebar chevron button
       Delegates to AdminLTE's pushmenu widget so sidebar width / content
       margin transitions are handled by AdminLTE natively.
       ====================================================================== */
    document.addEventListener('DOMContentLoaded', function () {
        var arrowBtn  = document.getElementById('sidebarArrowToggle');
        var pushmenu  = document.querySelector('[data-widget="pushmenu"]');

        if (arrowBtn && pushmenu) {
            var arrowLabel = arrowBtn.querySelector('.arrow-label');

            function syncArrowLabel() {
                if (!arrowLabel) return;
                var collapsed = document.body.classList.contains('sidebar-collapse');
                arrowLabel.textContent = collapsed
                    ? (arrowLabel.dataset.collapsed || 'Expand')
                    : (arrowLabel.dataset.expanded || 'Collapse');
            }

            arrowBtn.addEventListener('click', function () {
                pushmenu.click();
                // AdminLTE toggles the class asynchronously, wait one tick
                setTimeout(syncArrowLabel, 50);
            });

            syncArrowLabel(); // Set correct label on page load
        }
    });

    /* ======================================================================
       Mobile sidebar UX — backdrop tap & link tap close the overlay
       ====================================================================== */
    var MOBILE_BP = 992; // px — matches our CSS breakpoint

    function isMobile() { return window.innerWidth < MOBILE_BP; }

    function closeSidebar() {
        document.body.classList.remove('sidebar-open');
        document.body.classList.add('sidebar-collapse');
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Close when user taps the darkened backdrop outside the sidebar
        document.addEventListener('click', function (e) {
            if (!isMobile()) return;
            if (!document.body.classList.contains('sidebar-open')) return;

            var sidebar = document.querySelector('.main-sidebar, .app-sidebar');
            var toggler = e.target.closest('[data-widget="pushmenu"]');
            if (toggler) return; // pushmenu button handles its own toggle
            if (sidebar && !sidebar.contains(e.target)) {
                closeSidebar();
            }
        });

        // Auto-close when a nav link is tapped on mobile
        var sidebar = document.querySelector('.main-sidebar, .app-sidebar');
        if (sidebar) {
            sidebar.addEventListener('click', function (e) {
                if (!isMobile()) return;
                var link = e.target.closest('a.nav-link');
                if (!link) return;
                // Ignore tree-parent toggles (hash links that just open sub-menus)
                var href = link.getAttribute('href') || '';
                if (href === '#' || href === '' || link.classList.contains('has-treeview')) return;
                // Slight delay so AdminLTE's own treeview handler can settle
                setTimeout(closeSidebar, 120);
            });
        }

        // Close with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && document.body.classList.contains('sidebar-open')) {
                closeSidebar();
            }
        });
    });
})();
