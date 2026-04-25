<style>
/* ══════════════════════════════════════════
   Topbar — full revamp
   ══════════════════════════════════════════ */
.main-header.app-topbar {
    height: 60px !important;
    min-height: 60px !important;
    background: var(--ct-header-bg) !important;
    border-bottom: 1px solid var(--ct-border) !important;
    box-shadow: 0 1px 0 var(--ct-border) !important;
    padding: 0 16px !important;
    display: flex !important;
    align-items: center !important;
}

/* ── Hamburger ── */
.sb-hamburger {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 5px;
    width: 38px; height: 38px;
    border-radius: 10px;
    border: 1px solid var(--ct-border);
    background: transparent;
    cursor: pointer;
    transition: background .15s, border-color .15s;
    flex-shrink: 0;
    padding: 0;
}
.sb-hamburger:hover {
    background: var(--ct-sidebar-hover);
    border-color: var(--ct-primary);
}
.sb-hamburger__bar {
    display: block;
    width: 16px; height: 2px;
    border-radius: 2px;
    background: var(--ct-text-muted);
    transition: transform .25s, opacity .25s, width .25s;
}
.sb-hamburger__bar:nth-child(1) { width: 16px; }
.sb-hamburger__bar:nth-child(2) { width: 12px; }
.sb-hamburger__bar:nth-child(3) { width: 8px; }
.sb-hamburger:hover .sb-hamburger__bar { background: var(--ct-primary); }
.sb-hamburger:hover .sb-hamburger__bar:nth-child(1) { width: 16px; }
.sb-hamburger:hover .sb-hamburger__bar:nth-child(2) { width: 16px; }
.sb-hamburger:hover .sb-hamburger__bar:nth-child(3) { width: 16px; }

/* Open state — all bars become primary colour */
body.sidebar-open .sb-hamburger { background: rgba(79,70,229,.1); border-color: var(--ct-primary); }
body.sidebar-open .sb-hamburger .sb-hamburger__bar { background: var(--ct-primary); width: 16px !important; }
body.sidebar-open .sb-hamburger .sb-hamburger__bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
body.sidebar-open .sb-hamburger .sb-hamburger__bar:nth-child(2) { opacity: 0; transform: scaleX(0); }
body.sidebar-open .sb-hamburger .sb-hamburger__bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* ── App title area ── */
.sb-topbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-left: 14px;
}
.sb-topbar-brand__dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    flex-shrink: 0;
}
.sb-topbar-brand__name {
    font-size: .82rem;
    font-weight: 700;
    color: var(--ct-text);
    white-space: nowrap;
}
.sb-topbar-brand__sep { color: var(--ct-border); margin: 0 2px; }
.sb-topbar-brand__page {
    font-size: .78rem;
    color: var(--ct-text-muted);
    font-weight: 500;
    white-space: nowrap;
}

/* ── Right controls ── */
.sb-topbar-right {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: auto;
}

/* Theme toggle */
.theme-toggle-btn {
    width: 36px; height: 36px;
    border-radius: 9px;
    border: 1px solid var(--ct-border);
    background: transparent;
    color: var(--ct-text-muted) !important;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: background .15s, border-color .15s, color .15s;
}
.theme-toggle-btn:hover {
    background: var(--ct-sidebar-hover);
    border-color: var(--ct-primary);
    color: var(--ct-primary) !important;
    transform: none;
}
.theme-toggle-btn i { font-size: .85rem; }

/* User menu trigger */
.app-user-menu__trigger {
    display: inline-flex !important;
    align-items: center;
    gap: 8px;
    padding: 5px 10px 5px 6px !important;
    border-radius: 10px;
    border: 1px solid var(--ct-border);
    background: transparent;
    transition: background .15s, border-color .15s;
}
.app-user-menu__trigger:hover {
    background: var(--ct-sidebar-hover);
    border-color: var(--ct-primary);
}

/* User avatar initials */
.app-user-menu__avatar-wrap {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem; font-weight: 800; color: #fff;
    flex-shrink: 0;
}
.app-user-menu__name {
    font-size: .8rem;
    font-weight: 600;
    color: var(--ct-text);
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.app-user-menu__caret { font-size: .6rem; color: var(--ct-text-muted); }

/* User dropdown panel */
.app-user-menu__panel {
    min-width: 210px;
    padding: 6px !important;
    border-radius: 12px !important;
    border: 1px solid var(--ct-border) !important;
    box-shadow: 0 12px 30px rgba(0,0,0,.15) !important;
    background: var(--ct-surface) !important;
    margin-top: 6px !important;
}
.app-user-menu__header {
    padding: 10px 12px 8px !important;
    border-radius: 8px;
    background: var(--ct-surface-alt);
    margin-bottom: 4px;
}
.app-user-menu__header-name {
    font-weight: 700;
    font-size: .85rem;
    color: var(--ct-text);
}
.app-user-menu__header-email {
    font-size: .73rem;
    color: var(--ct-text-muted);
    margin-top: 1px;
}
.app-user-menu__panel .dropdown-item {
    border-radius: 8px !important;
    padding: 8px 12px !important;
    font-size: .82rem !important;
    font-weight: 500 !important;
    color: var(--ct-text) !important;
    transition: background .12s !important;
    display: flex;
    align-items: center;
    gap: 8px;
}
.app-user-menu__panel .dropdown-item:hover { background: var(--ct-sidebar-hover) !important; }
.app-user-menu__panel .dropdown-item.text-danger { color: #ef4444 !important; }
.app-user-menu__panel .dropdown-item.text-danger:hover { background: rgba(239,68,68,.08) !important; }
.app-user-menu__panel .dropdown-divider { border-color: var(--ct-border) !important; margin: 4px 0 !important; }
</style>

<!-- Topbar -->
<nav class="main-header navbar navbar-expand navbar-dark app-topbar" role="banner">

    <!-- Left: custom hamburger -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a data-widget="pushmenu" href="#" role="button" aria-label="Toggle sidebar"
               class="nav-link p-0 ml-1" style="line-height:1;">
                <button class="sb-hamburger" type="button" tabindex="-1" aria-hidden="true">
                    <span class="sb-hamburger__bar"></span>
                    <span class="sb-hamburger__bar"></span>
                    <span class="sb-hamburger__bar"></span>
                </button>
            </a>
        </li>
        <li class="nav-item d-none d-sm-flex">
            <div class="sb-topbar-brand">
                <span class="sb-topbar-brand__dot"></span>
                <span class="sb-topbar-brand__name">Carmel Academy</span>
                <span class="sb-topbar-brand__sep">›</span>
                <span class="sb-topbar-brand__page">Cashier System</span>
            </div>
        </li>
    </ul>

    <!-- Right: theme toggle + user menu -->
    <div class="sb-topbar-right">

        <!-- Theme toggle -->
        <button id="themeToggleBtn" class="theme-toggle-btn" type="button"
                title="Toggle light / dark mode" aria-label="Toggle theme">
            <i class="fas fa-sun icon-sun"></i>
            <i class="fas fa-moon icon-moon"></i>
        </button>

        @auth
        <!-- User menu -->
        <div class="nav-item dropdown app-user-menu">
            <a class="nav-link app-user-menu__trigger" data-toggle="dropdown" href="#"
               aria-haspopup="true" aria-expanded="false">
                <div class="app-user-menu__avatar-wrap">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <span class="app-user-menu__name d-none d-md-block">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down app-user-menu__caret"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right app-user-menu__panel">
                <div class="dropdown-header app-user-menu__header">
                    <div class="app-user-menu__header-name">{{ Auth::user()->name }}</div>
                    @if(!empty(Auth::user()->email))
                        <div class="app-user-menu__header-email">{{ Auth::user()->email }}</div>
                    @endif
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#"
                   onclick="event.preventDefault(); document.getElementById('app-logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Sign out
                </a>
                <form id="app-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        @endauth

    </div>
</nav>
