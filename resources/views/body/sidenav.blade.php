@php
    $isActive = fn(...$names) => collect($names)->contains(fn($n) => request()->routeIs($n)) ? 'active' : '';
    $isOpen   = fn(...$names) => collect($names)->contains(fn($n) => request()->routeIs($n));
    $menuOpen = fn(...$names) => $isOpen(...$names) ? 'menu-open' : '';
    $parentActive = fn(...$names) => $isOpen(...$names) ? 'active' : '';
@endphp

<style>
/* ══════════════════════════════════════════
   Sidebar — full revamp
   ══════════════════════════════════════════ */

/* Reset AdminLTE base */
.main-sidebar.app-sidebar {
    width: 260px !important;
    background: #0f1623 !important;
    box-shadow: 4px 0 24px rgba(0,0,0,.35) !important;
    border-right: none !important;
    display: flex !important;
    flex-direction: column;
    transition: width 260ms cubic-bezier(.2,.8,.2,1) !important;
}

/* ── Brand ── */
.sb-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 18px 20px 16px;
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    text-decoration: none !important;
    flex-shrink: 0;
}
.sb-brand__logo {
    width: 38px; height: 38px;
    border-radius: 10px;
    object-fit: contain;
    background: rgba(255,255,255,.15);
    padding: 4px;
    flex-shrink: 0;
}
.sb-brand__text { flex: 1; min-width: 0; }
.sb-brand__name {
    font-size: .95rem; font-weight: 800;
    color: #fff; letter-spacing: -.2px;
    white-space: nowrap; overflow: hidden;
    line-height: 1.2;
}
.sb-brand__sub {
    font-size: .65rem; font-weight: 600;
    color: rgba(255,255,255,.7);
    text-transform: uppercase; letter-spacing: .8px;
    margin-top: 1px;
}

/* ── User chip ── */
.sb-user {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px;
    border-bottom: 1px solid rgba(255,255,255,.06);
    flex-shrink: 0;
}
.sb-user__avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: linear-gradient(135deg,#4f46e5,#06b6d4);
    display: flex; align-items: center; justify-content: center;
    font-size: .85rem; font-weight: 700; color: #fff;
    flex-shrink: 0;
    border: 2px solid rgba(255,255,255,.15);
}
.sb-user__info { flex: 1; min-width: 0; }
.sb-user__name {
    font-size: .8rem; font-weight: 700; color: #e2e8f0;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.sb-user__role {
    display: inline-flex; align-items: center;
    gap: 4px; margin-top: 2px;
    font-size: .64rem; font-weight: 600;
    color: rgba(255,255,255,.5);
    text-transform: uppercase; letter-spacing: .5px;
}
.sb-user__dot {
    width: 6px; height: 6px;
    border-radius: 50%; background: #10b981;
    flex-shrink: 0;
    box-shadow: 0 0 0 2px rgba(16,185,129,.25);
}

/* ── Scrollable nav area ── */
.main-sidebar .sidebar {
    flex: 1 1 auto;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 10px 0 4px;
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,.08) transparent;
}
.main-sidebar .sidebar::-webkit-scrollbar { width: 4px; }
.main-sidebar .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 4px; }

/* ── Section divider ── */
.sb-section {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 14px 20px 6px;
    font-size: .6rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: rgba(255,255,255,.25);
}
.sb-section::after {
    content: '';
    flex: 1; height: 1px;
    background: rgba(255,255,255,.06);
}

/* ── Nav items ── */
.nav-sidebar .nav-link {
    display: flex !important;
    align-items: center;
    gap: 10px;
    padding: 10px 20px !important;
    margin: 1px 10px !important;
    border-radius: 10px !important;
    color: rgba(255,255,255,.55) !important;
    font-size: .82rem !important;
    font-weight: 500 !important;
    transition: background .15s, color .15s !important;
    white-space: nowrap;
    overflow: hidden;
    position: relative;
}
.nav-sidebar .nav-link:hover {
    background: rgba(255,255,255,.07) !important;
    color: rgba(255,255,255,.9) !important;
    transform: none !important;
}
.nav-sidebar .nav-link.active {
    background: rgba(79,70,229,.25) !important;
    color: #fff !important;
    box-shadow: none !important;
}
.nav-sidebar .nav-link.active::before {
    content: '';
    position: absolute;
    left: 0; top: 20%; bottom: 20%;
    width: 3px;
    border-radius: 0 3px 3px 0;
    background: #4f46e5;
}

/* Nav icon */
.nav-sidebar .nav-link .nav-icon {
    width: 32px !important; height: 32px !important;
    border-radius: 8px !important;
    display: flex !important; align-items: center !important; justify-content: center !important;
    font-size: .8rem !important;
    flex-shrink: 0 !important;
    margin-right: 0 !important;
    background: rgba(255,255,255,.06);
    transition: background .15s !important;
}
.nav-sidebar .nav-link:hover .nav-icon,
.nav-sidebar .nav-link.active .nav-icon {
    background: rgba(79,70,229,.3) !important;
    color: #818cf8 !important;
}
.nav-sidebar .nav-link.active .nav-icon { color: #a5b4fc !important; }

/* Nav label */
.nav-sidebar .nav-link > p {
    flex: 1; margin: 0 !important;
    font-size: .82rem !important;
    font-weight: 500 !important;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Chevron */
.nav-sidebar .nav-link > p > .right,
.nav-sidebar .nav-link .fa-angle-left {
    margin-left: auto !important;
    font-size: .7rem !important;
    opacity: .5;
    transition: transform .2s !important;
}
.nav-sidebar .nav-item.menu-open > .nav-link > p > .right,
.nav-sidebar .nav-item.menu-open > .nav-link .fa-angle-left {
    transform: rotate(-90deg) !important;
    opacity: .8;
}

/* ── Submenu ── */
.nav-treeview {
    padding-left: 0 !important;
    margin: 2px 0 4px !important;
    border-left: none !important;
    position: relative !important;
}
.nav-treeview::before {
    content: '';
    position: absolute;
    left: 35px; top: 0; bottom: 0;
    width: 1px;
    background: rgba(255,255,255,.07);
}
.nav-treeview .nav-item .nav-link {
    padding: 8px 20px 8px 52px !important;
    margin: 1px 10px !important;
    font-size: .79rem !important;
    color: rgba(255,255,255,.45) !important;
    border-radius: 8px !important;
    gap: 8px !important;
}
.nav-treeview .nav-item .nav-link:hover {
    background: rgba(255,255,255,.06) !important;
    color: rgba(255,255,255,.8) !important;
}
.nav-treeview .nav-item .nav-link.active {
    background: rgba(79,70,229,.2) !important;
    color: #a5b4fc !important;
}
.nav-treeview .nav-item .nav-link.active::before {
    display: none;
}
.nav-treeview .nav-item .nav-link .nav-icon {
    width: 20px !important; height: 20px !important;
    background: transparent !important;
    font-size: .7rem !important;
    border-radius: 4px !important;
}

/* ── Logout item ── */
.sb-logout-link {
    color: rgba(239,68,68,.7) !important;
}
.sb-logout-link:hover {
    background: rgba(239,68,68,.1) !important;
    color: #fca5a5 !important;
}
.sb-logout-link .nav-icon {
    background: rgba(239,68,68,.12) !important;
}
.sb-logout-link:hover .nav-icon {
    background: rgba(239,68,68,.2) !important;
    color: #fca5a5 !important;
}

/* ── Footer toggle ── */
.sidebar-footer {
    flex-shrink: 0;
    background: #0f1623;
    border-top: 1px solid rgba(255,255,255,.06);
}
.sidebar-arrow-toggle {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    width: 100%;
    padding: 12px 20px !important;
    height: 48px;
    cursor: pointer;
    background: transparent;
    border: none;
    color: rgba(255,255,255,.35);
    font-size: .78rem;
    font-weight: 600;
    transition: background .15s, color .15s;
    outline: none;
}
.sidebar-arrow-toggle:hover {
    background: rgba(255,255,255,.05);
    color: rgba(255,255,255,.7);
}
.arrow-icon {
    width: 28px; height: 28px;
    border-radius: 7px;
    background: rgba(255,255,255,.06);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem;
    flex-shrink: 0;
    transition: transform 260ms cubic-bezier(.2,.8,.2,1), background .15s;
}
.sidebar-arrow-toggle:hover .arrow-icon { background: rgba(255,255,255,.1); }
body.sidebar-collapse .arrow-icon { transform: rotate(180deg); }

/* ── Collapsed (mini) state ── */
.sidebar-mini.sidebar-collapse .main-sidebar.app-sidebar { width: 70px !important; }

.sidebar-mini.sidebar-collapse .main-sidebar .sb-brand { padding: 18px 16px 16px; justify-content: center; }
.sidebar-mini.sidebar-collapse .main-sidebar .sb-brand__text { display: none; }
.sidebar-mini.sidebar-collapse .main-sidebar .sb-user { padding: 12px 16px; justify-content: center; }
.sidebar-mini.sidebar-collapse .main-sidebar .sb-user__info { display: none; }
.sidebar-mini.sidebar-collapse .main-sidebar .sb-section { padding: 12px 0 4px; justify-content: center; font-size: 0; }
.sidebar-mini.sidebar-collapse .main-sidebar .sb-section::after { display: none; }
.sidebar-mini.sidebar-collapse .main-sidebar .sb-section::before { content: ''; display: block; width: 24px; height: 1px; background: rgba(255,255,255,.1); }

.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link {
    padding: 10px !important;
    margin: 2px 9px !important;
    justify-content: center;
    gap: 0;
}
.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link > p,
.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link .fa-angle-left,
.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link > p > .right {
    display: none !important;
}
.sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link .nav-icon {
    width: 36px !important; height: 36px !important;
    font-size: .88rem !important;
}
.sidebar-mini.sidebar-collapse .main-sidebar .nav-treeview { display: none !important; }
.sidebar-mini.sidebar-collapse .main-sidebar .sidebar-arrow-toggle { justify-content: center; padding: 12px !important; }
.sidebar-mini.sidebar-collapse .main-sidebar .arrow-label { display: none; }

/* ── Hover-expand DISABLED (MutationObserver in JS handles sidebar-focused) ── */
.sidebar-mini.sidebar-collapse .main-sidebar:hover,
.sidebar-mini.sidebar-collapse.sidebar-focused .main-sidebar {
    width: 70px !important;
    overflow: hidden !important;
}
.sidebar-mini.sidebar-collapse .main-sidebar:hover .sb-brand__text,
.sidebar-mini.sidebar-collapse.sidebar-focused .sb-brand__text,
.sidebar-mini.sidebar-collapse .main-sidebar:hover .sb-user__info,
.sidebar-mini.sidebar-collapse.sidebar-focused .sb-user__info,
.sidebar-mini.sidebar-collapse .main-sidebar:hover .nav-link > p,
.sidebar-mini.sidebar-collapse.sidebar-focused .nav-link > p,
.sidebar-mini.sidebar-collapse .main-sidebar:hover .nav-link .fa-angle-left,
.sidebar-mini.sidebar-collapse.sidebar-focused .nav-link .fa-angle-left,
.sidebar-mini.sidebar-collapse .main-sidebar:hover .arrow-label,
.sidebar-mini.sidebar-collapse.sidebar-focused .arrow-label {
    display: none !important;
}

/* ── Mobile overlay ── */
@media(max-width:991.98px) {
    body .main-sidebar.app-sidebar {
        width: 270px !important;
        transform: translateX(-100%);
        transition: transform 260ms cubic-bezier(.2,.8,.2,1) !important;
    }
    body.sidebar-open .main-sidebar.app-sidebar { transform: translateX(0) !important; }
    body .content-wrapper, body .main-header, body .main-footer { margin-left: 0 !important; }
    body.sidebar-open::after {
        content: ''; position: fixed; inset: 0;
        background: rgba(0,0,0,.55); z-index: 1049;
    }
    .sidebar-mini.sidebar-collapse .main-sidebar.app-sidebar { width: 270px !important; transform: translateX(-100%); }
    .sidebar-mini.sidebar-collapse.sidebar-open .main-sidebar.app-sidebar { transform: translateX(0) !important; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sb-brand { padding: 18px 20px 16px; justify-content: flex-start; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sb-brand__text { display: block; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sb-user { padding: 14px 20px; justify-content: flex-start; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sb-user__info { display: block; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sb-section { padding: 14px 20px 6px; font-size: .6rem; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sb-section::after { display: block; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sb-section::before { display: none; }
    .sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link { padding: 10px 20px !important; margin: 1px 10px !important; justify-content: flex-start; gap: 10px; }
    .sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link > p { display: block !important; }
    .sidebar-mini.sidebar-collapse .main-sidebar .nav-sidebar .nav-link .nav-icon { width: 32px !important; height: 32px !important; font-size: .8rem !important; }
    .sidebar-mini.sidebar-collapse .main-sidebar .nav-treeview { display: block !important; }
    .sidebar-mini.sidebar-collapse .main-sidebar .sidebar-arrow-toggle { justify-content: flex-start; padding: 12px 20px !important; }
    .sidebar-mini.sidebar-collapse .main-sidebar .arrow-label { display: inline; }
    .d-lg-block.sidebar-footer { display: block !important; }
}
</style>

<aside class="main-sidebar app-sidebar sidebar-dark-primary" role="navigation" aria-label="Primary navigation">

    {{-- ── Brand ── --}}
    <a href="{{ route('dashboard') }}" class="sb-brand">
        <img src="{{ asset('assets/img/Logo.png') }}" alt="Carmel Academy" class="sb-brand__logo">
        <div class="sb-brand__text">
            <div class="sb-brand__name">Carmel Academy</div>
            <div class="sb-brand__sub">Cashier System</div>
        </div>
    </a>

    {{-- ── User chip ── --}}
    @auth
    <div class="sb-user">
        <div class="sb-user__avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        <div class="sb-user__info">
            <div class="sb-user__name">{{ Auth::user()->name }}</div>
            <div class="sb-user__role"><span class="sb-user__dot"></span> Cashier</div>
        </div>
    </div>
    @endauth

    {{-- ── Nav ── --}}
    <div class="sidebar">
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- MAIN --}}
                <div class="sb-section">Main</div>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ $isActive('dashboard') }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- OPERATIONS --}}
                <div class="sb-section">Operations</div>

                <li class="nav-item {{ $menuOpen('student.batch_upload','form.student','cashier.mainform','forms.reports') }}">
                    <a href="#" class="nav-link {{ $parentActive('student.batch_upload','form.student','cashier.mainform','forms.reports') }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Forms <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('student.batch_upload') }}" class="nav-link {{ $isActive('student.batch_upload') }}">
                                <i class="fas fa-file-upload nav-icon"></i>
                                <p>Batch Upload</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('form.student') }}" class="nav-link {{ $isActive('form.student') }}">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Student Info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cashier.mainform') }}" class="nav-link {{ $isActive('cashier.mainform') }}">
                                <i class="fas fa-money-check-alt nav-icon"></i>
                                <p>Cashier Form</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('forms.reports') }}" class="nav-link {{ $isActive('forms.reports') }}">
                                <i class="fas fa-chart-bar nav-icon"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $menuOpen('table.student','data.cashdisbursement','data.other_income','data.archive') }}">
                    <a href="#" class="nav-link {{ $parentActive('table.student','data.cashdisbursement','data.other_income','data.archive') }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('table.student') }}" class="nav-link {{ $isActive('table.student') }}">
                                <i class="fas fa-coins nav-icon"></i>
                                <p>Cash Collection</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('data.cashdisbursement') }}" class="nav-link {{ $isActive('data.cashdisbursement') }}">
                                <i class="fas fa-money-bill-wave nav-icon"></i>
                                <p>Disbursement</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('data.other_income') }}" class="nav-link {{ $isActive('data.other_income') }}">
                                <i class="fas fa-cash-register nav-icon"></i>
                                <p>Other Income</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('data.archive') }}" class="nav-link {{ $isActive('data.archive') }}">
                                <i class="fas fa-archive nav-icon"></i>
                                <p>Archive</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- CONFIGURATION --}}
                <div class="sb-section">Configuration</div>

                <li class="nav-item {{ $menuOpen('setting.cashier','setting.annual') }}">
                    <a href="#" class="nav-link {{ $parentActive('setting.cashier','setting.annual') }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('setting.cashier') }}" class="nav-link {{ $isActive('setting.cashier') }}">
                                <i class="fas fa-layer-group nav-icon"></i>
                                <p>Grade Fees</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.annual') }}" class="nav-link {{ $isActive('setting.annual') }}">
                                <i class="fas fa-calendar-alt nav-icon"></i>
                                <p>Annual Fees</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $menuOpen('about.developer','about.system') }}">
                    <a href="#" class="nav-link {{ $parentActive('about.developer','about.system') }}">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>About <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('about.developer') }}" class="nav-link {{ $isActive('about.developer') }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Developers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about.system') }}" class="nav-link {{ $isActive('about.system') }}">
                                <i class="fas fa-tools nav-icon"></i>
                                <p>System Info</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- SESSION --}}
                <div class="sb-section">Session</div>

                <li class="nav-item">
                    <a class="nav-link sb-logout-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('sidenav-logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Sign Out</p>
                    </a>
                    <form id="sidenav-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
    </div>

    {{-- ── Collapse toggle ── --}}
    <div class="sidebar-footer">
        <button type="button" id="sidebarArrowToggle" class="sidebar-arrow-toggle"
                title="Toggle sidebar" aria-label="Toggle sidebar">
            <span class="arrow-icon"><i class="fas fa-chevron-left"></i></span>
            <span class="arrow-label" data-expanded="Collapse sidebar" data-collapsed="Expand sidebar">Collapse sidebar</span>
        </button>
    </div>

</aside>
