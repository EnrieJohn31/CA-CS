@extends('home.index')

@section('content')
@php
    $h        = (int) date('H');
    $greeting = $h < 12 ? 'Good morning' : ($h < 18 ? 'Good afternoon' : 'Good evening');
    $paidPct  = $count > 0 ? round(($no_balance / $count) * 100) : 0;
    $balPct   = $count > 0 ? round(($has_balance / $count) * 100) : 0;
    $today    = date('l, F j, Y');
@endphp

<style>
/* ── Hero ── */
.db-hero {
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    border-radius: var(--ct-radius);
    padding: 28px 32px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
    color: #fff;
}
.db-hero::after {
    content: '';
    position: absolute;
    right: -60px; top: -60px;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
    pointer-events: none;
}
.db-hero::before {
    content: '';
    position: absolute;
    right: 60px; bottom: -80px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    pointer-events: none;
}
.db-hero__greeting {
    font-size: 1.6rem;
    font-weight: 800;
    letter-spacing: -.5px;
    margin-bottom: 4px;
}
.db-hero__date {
    font-size: .82rem;
    opacity: .8;
    margin-bottom: 20px;
}
.db-hero__cta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: rgba(255,255,255,.18);
    border: 1px solid rgba(255,255,255,.35);
    border-radius: 8px;
    color: #fff !important;
    font-size: .88rem;
    font-weight: 600;
    text-decoration: none !important;
    backdrop-filter: blur(6px);
    transition: background .18s;
}
.db-hero__cta:hover { background: rgba(255,255,255,.28); }
.db-hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    background: rgba(255,255,255,.15);
    border-radius: 999px;
    font-size: .75rem;
    font-weight: 600;
    color: #fff;
    margin-bottom: 16px;
}

/* ── Metric cards ── */
.db-metric {
    background: var(--ct-surface);
    border: 1px solid var(--ct-border);
    border-radius: var(--ct-radius);
    box-shadow: var(--ct-shadow);
    padding: 20px 22px;
    display: flex;
    align-items: center;
    gap: 18px;
    text-decoration: none !important;
    color: var(--ct-text) !important;
    transition: box-shadow .18s, transform .18s;
    position: relative;
    overflow: hidden;
    height: 100%;
}
.db-metric:hover { box-shadow: var(--ct-shadow-lg); transform: translateY(-2px); }
.db-metric__accent {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 4px;
    border-radius: 4px 0 0 4px;
}
.db-metric__icon {
    width: 52px; height: 52px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
}
.db-metric__body { flex: 1; min-width: 0; }
.db-metric__value {
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -1px;
    color: var(--ct-text);
}
.db-metric__label {
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--ct-text-muted);
    margin-top: 4px;
}
.db-metric__arrow {
    font-size: .8rem;
    color: var(--ct-text-muted);
    opacity: .6;
}
.db-metric:hover .db-metric__arrow { opacity: 1; color: inherit; }

/* ── Progress card ── */
.db-progress-card {
    background: var(--ct-surface);
    border: 1px solid var(--ct-border);
    border-radius: var(--ct-radius);
    box-shadow: var(--ct-shadow);
    padding: 22px 24px;
    height: 100%;
}
.db-progress-card__title {
    font-size: .82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--ct-text-muted);
    margin-bottom: 18px;
    display: flex; align-items: center; gap: 8px;
}
.db-progress-card__title i { color: var(--ct-primary); }
.db-track {
    display: flex;
    height: 10px;
    border-radius: 999px;
    overflow: hidden;
    background: var(--ct-surface-alt);
    border: 1px solid var(--ct-border);
    margin-bottom: 14px;
}
.db-track__fill {
    border-radius: 999px;
    transition: width .6s cubic-bezier(.2,.8,.2,1);
}
.db-legend {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.db-legend-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: .82rem;
}
.db-legend-row__left { display: flex; align-items: center; gap: 8px; }
.db-legend-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}
.db-legend-row__label { color: var(--ct-text); font-weight: 500; }
.db-legend-row__count { font-weight: 700; color: var(--ct-text); }
.db-legend-row__pct   { font-size: .72rem; color: var(--ct-text-muted); margin-left: 4px; }

/* ── Quick action grid ── */
.db-actions-card {
    background: var(--ct-surface);
    border: 1px solid var(--ct-border);
    border-radius: var(--ct-radius);
    box-shadow: var(--ct-shadow);
    padding: 22px 24px;
    height: 100%;
}
.db-actions-card__title {
    font-size: .82rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--ct-text-muted);
    margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
}
.db-actions-card__title i { color: var(--ct-primary); }
.db-actions-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.db-action-btn {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    padding: 16px 14px;
    border-radius: 10px;
    border: 1px solid var(--ct-border);
    background: var(--ct-surface-alt);
    text-decoration: none !important;
    color: var(--ct-text) !important;
    transition: border-color .18s, box-shadow .18s, transform .18s;
}
.db-action-btn:hover {
    border-color: var(--ct-primary);
    box-shadow: 0 4px 14px rgba(79,70,229,.14);
    transform: translateY(-2px);
}
.db-action-btn__icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: .9rem;
}
.db-action-btn__label { font-size: .82rem; font-weight: 700; line-height: 1.2; }
.db-action-btn__sub   { font-size: .7rem; color: var(--ct-text-muted); }

/* ── Workflow strip ── */
.db-workflow {
    background: var(--ct-surface);
    border: 1px solid var(--ct-border);
    border-radius: var(--ct-radius);
    box-shadow: var(--ct-shadow);
    overflow: hidden;
    margin-top: 24px;
}
.db-workflow__header {
    padding: 14px 22px;
    background: var(--ct-surface-alt);
    border-bottom: 1px solid var(--ct-border);
    font-size: .78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .7px;
    color: var(--ct-text-muted);
    display: flex; align-items: center; gap: 8px;
}
.db-workflow__header i { color: var(--ct-primary); }
.db-workflow__list {
    display: flex;
    align-items: stretch;
    padding: 0;
}
.db-wf-item {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 20px;
    border-right: 1px solid var(--ct-border);
    text-decoration: none !important;
    color: var(--ct-text) !important;
    transition: background .18s;
    position: relative;
}
.db-wf-item:last-child { border-right: none; }
.db-wf-item:hover { background: var(--ct-sidebar-hover); }
.db-wf-item__num {
    width: 26px; height: 26px;
    border-radius: 50%;
    background: var(--ct-primary);
    color: #fff;
    font-size: .72rem;
    font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(79,70,229,.3);
}
.db-wf-item__icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: .88rem;
    flex-shrink: 0;
}
.db-wf-item__body { min-width: 0; }
.db-wf-item__title { font-size: .85rem; font-weight: 700; color: var(--ct-text); white-space: nowrap; }
.db-wf-item__desc  { font-size: .72rem; color: var(--ct-text-muted); line-height: 1.4; margin-top: 2px; }

@media (max-width: 767px) {
    .db-workflow__list { flex-direction: column; }
    .db-wf-item { border-right: none; border-bottom: 1px solid var(--ct-border); }
    .db-wf-item:last-child { border-bottom: none; }
    .db-hero__greeting { font-size: 1.3rem; }
    .db-actions-grid { grid-template-columns: 1fr 1fr; }
}
</style>

<section class="content" style="padding-top:0;" aria-label="Dashboard">
<div class="container-fluid pt-3">

    {{-- ── Hero Banner ── --}}
    <div class="db-hero">
        <div class="db-hero__badge">
            <i class="fas fa-circle" style="font-size:.45rem;opacity:.7;"></i>
            Carmel Academy — Cashier System
        </div>
        <div class="db-hero__greeting">{{ $greeting }}, {{ Str::title(Auth::user()->name ?? 'User') }} 👋</div>
        <div class="db-hero__date">{{ $today }}</div>
        <div class="d-flex flex-wrap" style="gap:10px;">
            <a href="{{ route('cashier.mainform') }}" class="db-hero__cta">
                <i class="fas fa-money-check-alt"></i> Collect Payment
            </a>
            <a href="{{ route('form.student') }}" class="db-hero__cta">
                <i class="fas fa-user-plus"></i> Add Student
            </a>
        </div>
    </div>

    {{-- ── Metric Cards ── --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <a href="{{ route('moreinfo.registered') }}" class="db-metric">
                <div class="db-metric__accent" style="background:#4f46e5;"></div>
                <div class="db-metric__icon" style="background:rgba(79,70,229,.12);color:#4f46e5;">
                    <i class="fas fa-users"></i>
                </div>
                <div class="db-metric__body">
                    <div class="db-metric__value">{{ number_format($count) }}</div>
                    <div class="db-metric__label">Total Registered</div>
                </div>
                <i class="fas fa-chevron-right db-metric__arrow"></i>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <a href="{{ route('moreinfo.paid_students') }}" class="db-metric">
                <div class="db-metric__accent" style="background:#10b981;"></div>
                <div class="db-metric__icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="db-metric__body">
                    <div class="db-metric__value">{{ number_format($no_balance) }}</div>
                    <div class="db-metric__label">Fully Paid</div>
                </div>
                <i class="fas fa-chevron-right db-metric__arrow"></i>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <a href="{{ route('moreinfo.withbalance_students') }}" class="db-metric">
                <div class="db-metric__accent" style="background:#ef4444;"></div>
                <div class="db-metric__icon" style="background:rgba(239,68,68,.12);color:#ef4444;">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="db-metric__body">
                    <div class="db-metric__value">{{ number_format($has_balance) }}</div>
                    <div class="db-metric__label">With Balance</div>
                </div>
                <i class="fas fa-chevron-right db-metric__arrow"></i>
            </a>
        </div>
    </div>

    {{-- ── Middle Row: Progress + Quick Actions ── --}}
    <div class="row mb-0">

        {{-- Payment Progress ── --}}
        <div class="col-lg-5 col-md-12 mb-4">
            <div class="db-progress-card">
                <div class="db-progress-card__title">
                    <i class="fas fa-chart-pie"></i> Payment Overview
                </div>

                {{-- Stacked bar --}}
                <div class="db-track">
                    <div class="db-track__fill" style="width:{{ $paidPct }}%;background:#10b981;"></div>
                    <div class="db-track__fill" style="width:{{ $balPct }}%;background:#ef4444;"></div>
                </div>

                <div class="db-legend">
                    <div class="db-legend-row">
                        <div class="db-legend-row__left">
                            <span class="db-legend-dot" style="background:#10b981;"></span>
                            <span class="db-legend-row__label">Fully Paid</span>
                        </div>
                        <div>
                            <span class="db-legend-row__count">{{ number_format($no_balance) }}</span>
                            <span class="db-legend-row__pct">{{ $paidPct }}%</span>
                        </div>
                    </div>
                    <div class="db-legend-row">
                        <div class="db-legend-row__left">
                            <span class="db-legend-dot" style="background:#ef4444;"></span>
                            <span class="db-legend-row__label">Has Balance</span>
                        </div>
                        <div>
                            <span class="db-legend-row__count">{{ number_format($has_balance) }}</span>
                            <span class="db-legend-row__pct">{{ $balPct }}%</span>
                        </div>
                    </div>
                    <div class="db-legend-row">
                        <div class="db-legend-row__left">
                            <span class="db-legend-dot" style="background:var(--ct-border);"></span>
                            <span class="db-legend-row__label">Total Students</span>
                        </div>
                        <div>
                            <span class="db-legend-row__count">{{ number_format($count) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions ── --}}
        <div class="col-lg-7 col-md-12 mb-4">
            <div class="db-actions-card">
                <div class="db-actions-card__title">
                    <i class="fas fa-bolt"></i> Quick Actions
                </div>
                <div class="db-actions-grid">
                    <a href="{{ route('form.student') }}" class="db-action-btn">
                        <div class="db-action-btn__icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <div class="db-action-btn__label">Add Student</div>
                            <div class="db-action-btn__sub">Register new enrollment</div>
                        </div>
                    </a>
                    <a href="{{ route('cashier.mainform') }}" class="db-action-btn">
                        <div class="db-action-btn__icon" style="background:rgba(79,70,229,.12);color:#4f46e5;">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div>
                            <div class="db-action-btn__label">Collect Payment</div>
                            <div class="db-action-btn__sub">Process student fees</div>
                        </div>
                    </a>
                    <a href="{{ route('student.batch_upload') }}" class="db-action-btn">
                        <div class="db-action-btn__icon" style="background:rgba(6,182,212,.12);color:#06b6d4;">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <div>
                            <div class="db-action-btn__label">Batch Upload</div>
                            <div class="db-action-btn__sub">Import student roster</div>
                        </div>
                    </a>
                    <a href="{{ route('forms.reports') }}" class="db-action-btn">
                        <div class="db-action-btn__icon" style="background:rgba(245,158,11,.14);color:#f59e0b;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <div class="db-action-btn__label">View Reports</div>
                            <div class="db-action-btn__sub">Generate payment reports</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Workflow Guide strip ── --}}
    <div class="db-workflow">
        <div class="db-workflow__header">
            <i class="fas fa-route"></i> How to use this system — follow steps in order
        </div>
        <div class="db-workflow__list">
            <a href="{{ route('setting.cashier') }}" class="db-wf-item">
                <div class="db-wf-item__num">1</div>
                <div class="db-wf-item__icon" style="background:rgba(79,70,229,.1);color:#4f46e5;">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="db-wf-item__body">
                    <div class="db-wf-item__title">Configure Fees</div>
                    <div class="db-wf-item__desc">Set grade-level &amp; annual fees first</div>
                </div>
            </a>
            <a href="{{ route('form.student') }}" class="db-wf-item">
                <div class="db-wf-item__num">2</div>
                <div class="db-wf-item__icon" style="background:rgba(16,185,129,.1);color:#10b981;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="db-wf-item__body">
                    <div class="db-wf-item__title">Register Student</div>
                    <div class="db-wf-item__desc">Enter LRN, name, grade &amp; section</div>
                </div>
            </a>
            <a href="{{ route('cashier.mainform') }}" class="db-wf-item">
                <div class="db-wf-item__num">3</div>
                <div class="db-wf-item__icon" style="background:rgba(6,182,212,.1);color:#06b6d4;">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <div class="db-wf-item__body">
                    <div class="db-wf-item__title">Process Payment</div>
                    <div class="db-wf-item__desc">Look up by LRN, tick fees, save receipt</div>
                </div>
            </a>
            <a href="{{ route('table.student') }}" class="db-wf-item">
                <div class="db-wf-item__num">4</div>
                <div class="db-wf-item__icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <div class="db-wf-item__body">
                    <div class="db-wf-item__title">Monitor &amp; Report</div>
                    <div class="db-wf-item__desc">View collections, balances &amp; reports</div>
                </div>
            </a>
        </div>
    </div>

</div>
</section>
@endsection
