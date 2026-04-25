@extends('home.index')
@include('modal.extralarge-modal')
@section('content')
<script src="{{ asset('assets/js/carmeljs/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

<style>
/* ── Hero ── */
.cf-hero {
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    border-radius: var(--ct-radius);
    padding: 24px 28px 20px;
    margin-bottom: 20px;
    position: relative; overflow: hidden; color: #fff;
}
.cf-hero::after {
    content:''; position:absolute; right:-50px; top:-50px;
    width:200px; height:200px; border-radius:50%;
    background:rgba(255,255,255,.07); pointer-events:none;
}
.cf-hero__eyebrow {
    display:inline-flex; align-items:center; gap:7px;
    background:rgba(255,255,255,.18); border-radius:999px;
    padding:4px 12px; font-size:.72rem; font-weight:700;
    letter-spacing:.5px; text-transform:uppercase; margin-bottom:10px;
}
.cf-hero__title { font-size:1.45rem; font-weight:800; letter-spacing:-.4px; margin-bottom:3px; }
.cf-hero__sub   { font-size:.82rem; opacity:.85; }

/* ── Steps indicator ── */
.cf-steps {
    display:flex; align-items:stretch;
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius); box-shadow:var(--ct-shadow);
    overflow:hidden; margin-bottom:20px;
}
.cf-step {
    flex:1; display:flex; align-items:center; gap:11px;
    padding:13px 16px; border-right:1px solid var(--ct-border);
    font-size:.79rem; color:var(--ct-text-muted);
}
.cf-step:last-child { border-right:none; }
.cf-step--active { background:rgba(79,70,229,.05); }
.cf-step__badge {
    width:24px; height:24px; border-radius:50%; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    font-size:.7rem; font-weight:800;
}
.cf-step__badge--active  { background:var(--ct-primary); color:#fff; box-shadow:0 2px 6px rgba(79,70,229,.35); }
.cf-step__badge--pending { background:var(--ct-surface-alt); color:var(--ct-text-muted); border:1px solid var(--ct-border); }
.cf-step__label { font-weight:700; font-size:.8rem; color:var(--ct-text); }
.cf-step__sub   { font-size:.69rem; color:var(--ct-text-muted); margin-top:1px; }
.cf-step--active .cf-step__label { color:var(--ct-primary); }

/* ── Section card ── */
.cf-card {
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius); box-shadow:var(--ct-shadow);
    overflow:hidden; margin-bottom:16px;
}
.cf-card__header {
    display:flex; align-items:center; gap:13px;
    padding:14px 20px; background:var(--ct-surface-alt);
    border-bottom:1px solid var(--ct-border);
}
.cf-card__num {
    width:26px; height:26px; border-radius:50%; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    font-size:.74rem; font-weight:800; color:#fff;
}
.cf-card__icon {
    width:38px; height:38px; border-radius:9px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center; font-size:.95rem;
}
.cf-card__title { font-size:.9rem; font-weight:700; color:var(--ct-text); }
.cf-card__sub   { font-size:.73rem; color:var(--ct-text-muted); margin-top:2px; }
.cf-card__body  { padding:20px; }

/* ── Student info preview ── */
.student-preview {
    display:none;
    background:rgba(79,70,229,.06); border:1px solid rgba(79,70,229,.18);
    border-radius:var(--ct-radius-sm); padding:14px 16px; margin-top:14px;
}
.student-preview.visible { display:flex; gap:16px; flex-wrap:wrap; }
.student-preview__pill {
    display:inline-flex; align-items:center; gap:7px;
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:999px; padding:5px 13px; font-size:.79rem; font-weight:600;
    color:var(--ct-text);
}
.student-preview__pill i { color:var(--ct-primary); font-size:.7rem; }

/* ── Fee toggle tiles ── */
.fee-section-label {
    font-size:.7rem; font-weight:700; text-transform:uppercase;
    letter-spacing:.8px; color:var(--ct-text-muted);
    margin:16px 0 10px; display:flex; align-items:center; gap:8px;
}
.fee-section-label::after {
    content:''; flex:1; height:1px; background:var(--ct-border);
}
.fee-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(155px,1fr)); gap:8px; }

.fee-tile {
    position:relative; cursor:pointer;
    border:1.5px solid var(--ct-border); border-radius:var(--ct-radius-sm);
    background:var(--ct-surface-alt); padding:12px 13px;
    transition:border-color .15s, background .15s, box-shadow .15s;
    display:flex; flex-direction:column; gap:6px; user-select:none;
}
.fee-tile input[type="checkbox"] { position:absolute; opacity:0; width:0; height:0; }
.fee-tile:hover { border-color:var(--ct-primary); background:rgba(79,70,229,.04); }
.fee-tile.selected {
    border-color:var(--ct-primary);
    background:rgba(79,70,229,.08);
    box-shadow:0 0 0 3px rgba(79,70,229,.12);
}
.fee-tile__check {
    position:absolute; top:8px; right:9px;
    width:18px; height:18px; border-radius:50%;
    border:1.5px solid var(--ct-border);
    background:var(--ct-surface);
    display:flex; align-items:center; justify-content:center;
    font-size:.55rem; color:transparent;
    transition:all .15s;
}
.fee-tile.selected .fee-tile__check {
    background:var(--ct-primary); border-color:var(--ct-primary);
    color:#fff;
}
.fee-tile__icon {
    font-size:.88rem; color:var(--ct-text-muted);
    transition:color .15s;
}
.fee-tile.selected .fee-tile__icon { color:var(--ct-primary); }
.fee-tile__name  { font-size:.78rem; font-weight:600; color:var(--ct-text); line-height:1.3; }
.fee-tile__amt   { font-size:.8rem; font-weight:700; font-variant-numeric:tabular-nums; color:var(--ct-text-muted); }
.fee-tile.selected .fee-tile__amt { color:var(--ct-primary); }

/* ── Receipt panel ── */
.cf-receipt {
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius); box-shadow:var(--ct-shadow);
    position:sticky; top:80px; overflow:hidden;
}
.cf-receipt__header {
    padding:14px 18px; background:var(--ct-surface-alt);
    border-bottom:1px solid var(--ct-border);
    display:flex; align-items:center; gap:10px;
}
.cf-receipt__title { font-size:.85rem; font-weight:700; color:var(--ct-text); }
.cf-receipt__body  { padding:16px 18px; }

.cf-receipt__or { margin-bottom:14px; }
.cf-receipt__or label {
    font-size:.74rem; font-weight:600; color:var(--ct-text-muted);
    text-transform:uppercase; letter-spacing:.4px; display:block; margin-bottom:5px;
}

.receipt-line {
    display:flex; align-items:center; justify-content:space-between;
    padding:7px 0; border-bottom:1px solid var(--ct-border);
    font-size:.8rem; gap:8px; transition:opacity .15s;
}
.receipt-line:last-of-type { border-bottom:none; }
.receipt-line.inactive { opacity:.3; }
.receipt-line__name  { color:var(--ct-text); flex:1; }
.receipt-line__badge {
    width:16px; height:16px; border-radius:50%; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    font-size:.5rem; background:var(--ct-border); color:transparent;
    transition:all .15s;
}
.receipt-line.active .receipt-line__badge { background:var(--ct-success); color:#fff; }
.receipt-line__amount { font-weight:600; font-variant-numeric:tabular-nums; color:var(--ct-text-muted); }
.receipt-line.active .receipt-line__amount { color:var(--ct-text); }

.receipt-total {
    margin-top:14px; padding:14px 0 0;
    border-top:2px solid var(--ct-border);
    display:flex; align-items:center; justify-content:space-between;
}
.receipt-total__label { font-size:.8rem; font-weight:700; text-transform:uppercase; letter-spacing:.4px; color:var(--ct-text-muted); }
.receipt-total__value {
    font-size:1.6rem; font-weight:800; letter-spacing:-1px;
    font-variant-numeric:tabular-nums; color:var(--ct-primary);
}

.btn-pay {
    width:100%; margin-top:14px;
    background:linear-gradient(135deg,var(--ct-primary),var(--ct-primary-hover)) !important;
    border:none !important; color:#fff !important;
    font-weight:700; padding:.65rem; font-size:.92rem;
    box-shadow:0 4px 14px rgba(79,70,229,.3) !important;
    transition:transform .15s, box-shadow .15s !important;
}
.btn-pay:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(79,70,229,.4) !important; }
.btn-pay:disabled { opacity:.75; cursor:progress; }

/* ── Field label ── */
.cf-label {
    display:block; font-size:.76rem; font-weight:600;
    color:var(--ct-text); margin-bottom:5px; letter-spacing:.1px;
}
.cf-label .req { color:var(--ct-danger); margin-left:2px; }
.cf-hint { font-size:.69rem; color:var(--ct-text-muted); margin-top:3px; }
.cf-error{ font-size:.72rem; color:var(--ct-danger); margin-top:3px; }

@media(max-width:991px) {
    .cf-receipt { position:static; margin-top:16px; }
    .cf-steps { flex-direction:column; }
    .cf-step { border-right:none; border-bottom:1px solid var(--ct-border); }
    .cf-step:last-child { border-bottom:none; }
}
@media(max-width:575px) {
    .fee-grid { grid-template-columns:1fr 1fr; }
    .cf-hero__title { font-size:1.2rem; }
}
</style>

<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3">

    {{-- ── Hero ── --}}
    <div class="cf-hero">
        <div class="cf-hero__eyebrow"><i class="fas fa-money-check-alt"></i> Step 3 of 4 — Process Payment</div>
        <div class="cf-hero__title">Cashier Payment Form</div>
        <div class="cf-hero__sub">Look up a student by LRN, select the fees being paid, and record the official receipt.</div>
    </div>

    {{-- ── Step tracker ── --}}
    <div class="cf-steps">
        <div class="cf-step">
            <div class="cf-step__badge cf-step__badge--pending"><i class="fas fa-check" style="font-size:.55rem;"></i></div>
            <div><div class="cf-step__label">Configure Fees</div><div class="cf-step__sub">Done in Settings</div></div>
        </div>
        <div class="cf-step">
            <div class="cf-step__badge cf-step__badge--pending"><i class="fas fa-check" style="font-size:.55rem;"></i></div>
            <div><div class="cf-step__label">Register Student</div><div class="cf-step__sub">Student Info Form</div></div>
        </div>
        <div class="cf-step cf-step--active">
            <div class="cf-step__badge cf-step__badge--active">3</div>
            <div><div class="cf-step__label">Process Payment</div><div class="cf-step__sub">You are here</div></div>
        </div>
        <div class="cf-step">
            <div class="cf-step__badge cf-step__badge--pending">4</div>
            <div><div class="cf-step__label">Monitor &amp; Report</div><div class="cf-step__sub">Cash Collection</div></div>
        </div>
    </div>

    <form action="{{ route('store.student.info') }}" method="POST" id="save-student-form">
        @csrf

        {{-- All existing hidden fee inputs (unchanged — JS depends on these IDs) --}}
        <div id="fee_amounts_reg" hidden>
            <input type="text" id="registration"  name="reg_fee"       readonly>
            <input type="text" id="tuition"       name="tui_fee"       readonly>
            <input type="text" id="uniform"       name="uni_fee"       readonly>
            <input type="text" id="Medicals"      name="Medical"       readonly>
            <input type="text" id="Insurances"    name="Insurance"     readonly>
            <input type="text" id="Deaths"        name="Death"         readonly>
            <input type="text" id="Librarys"      name="Library"       readonly>
            <input type="text" id="School_Pubs"   name="School_Pub"    readonly>
            <input type="text" id="Athlets"       name="Athlet"        readonly>
            <input type="text" id="BACSs"         name="BACS"         readonly>
            <input type="text" id="Books"         name="Book"          readonly>
            <input type="text" id="Laboratorys"   name="Laboratory"    readonly>
            <input type="text" id="StudentIDs"    name="StudentID"     readonly>
            <input type="text" id="Passbooks"     name="Passbook"      readonly>
            <input type="text" id="Handbooks"     name="Handbook"      readonly>
            <input type="text" id="Dentals"       name="Dental"        readonly>
            <input type="text" id="Completers_Fees" name="Completers_Fee" readonly>
            <input type="text" id="Graduation_Fees" name="Graduation_Fee" readonly>
        </div>
        <div id="fee_amounts" hidden>
            <input type="text" id="total_amount" name="total_amount" readonly>
        </div>

        <div class="row">

            {{-- ══ LEFT: student info + fee selection ══ --}}
            <div class="col-lg-7 col-md-12">

                {{-- Step 1 — Student Lookup --}}
                <div class="cf-card">
                    <div class="cf-card__header">
                        <div class="cf-card__num" style="background:#4f46e5;">1</div>
                        <div class="cf-card__icon" style="background:rgba(79,70,229,.12);color:#4f46e5;">
                            <i class="fas fa-search"></i>
                        </div>
                        <div>
                            <div class="cf-card__title">Find Student</div>
                            <div class="cf-card__sub">Enter the LRN or search by name to load student details</div>
                        </div>
                    </div>
                    <div class="cf-card__body">
                        <div class="row g-3">

                            {{-- LRN + Search --}}
                            <div class="col-md-5 mb-3">
                                <label class="cf-label" for="Id_num">LRN <span class="req">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card" style="color:var(--ct-text-muted);"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="Id_num" name="Id_num"
                                           placeholder="Enter 12-digit LRN" maxlength="12"
                                           oninput="validateIdNum(this)" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" title="Search student"
                                            data-bs-toggle="modal" data-bs-target="#ExtralargeModal"
                                            onclick="openSearchStudent()">
                                            <i class="fas fa-search mr-1"></i> Search
                                        </button>
                                    </div>
                                </div>
                                <span class="cf-hint">12-digit Learner Reference Number</span>
                                <span class="cf-error Id_num_error d-block"></span>
                            </div>

                            {{-- Name --}}
                            <div class="col-md-7 mb-3">
                                <label class="cf-label" for="name">Full Name <span class="req">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Student full name" oninput="validateName(this)">
                                <span class="cf-hint">Auto-filled when searching by LRN</span>
                                <span class="cf-error name_error d-block"></span>
                            </div>

                            {{-- Grade --}}
                            <div class="col-md-3 mb-3">
                                <label class="cf-label" for="lvl">Grade Level <span class="req">*</span></label>
                                <select class="form-control" id="lvl" name="lvl"
                                        onchange="toggleStrandInput(); updateRegistrationFee()">
                                    <option value="0" selected disabled>— Select —</option>
                                    <option value="Nursery">Nursery</option>
                                    <option value="Kinder">Kinder 1</option>
                                    <option value="Kinder2">Kinder 2</option>
                                    @for ($g = 1; $g <= 12; $g++)
                                        <option value="{{ $g }}">Grade {{ $g }}</option>
                                    @endfor
                                </select>
                                <span class="cf-error lvl_error d-block"></span>
                            </div>

                            {{-- Section --}}
                            <div class="col-md-3 mb-3">
                                <label class="cf-label" for="section">Section</label>
                                <input type="text" class="form-control" id="section" name="section"
                                       placeholder="Section" oninput="validateSection(this)">
                                <span class="cf-error section_error d-block"></span>
                            </div>

                            {{-- Academic Year --}}
                            <div class="col-md-3 mb-3">
                                <label class="cf-label" for="ay">Academic Year <span class="req">*</span></label>
                                <input type="text" class="form-control" id="ay" name="ay"
                                       placeholder="2024-2025" oninput="validateSchoolYear(this)">
                                <span class="cf-hint">Format: YYYY-YYYY</span>
                                <span class="cf-error ay_error d-block"></span>
                            </div>

                            {{-- Strand (hidden until G11/12) --}}
                            <div id="strandContainer" class="col-md-3 mb-3" style="display:none;">
                                <label class="cf-label" for="strand">Academic Track</label>
                                <select class="form-control" id="strand" name="strand">
                                    <option value="0">— Choose —</option>
                                    <option value="STEM">STEM</option>
                                    <option value="ABM">ABM</option>
                                    <option value="ICT">ICT</option>
                                    <option value="HUMMS">HUMMS</option>
                                    <option value="GAS">GAS</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Step 2 — Fee Selection --}}
                <div class="cf-card">
                    <div class="cf-card__header">
                        <div class="cf-card__num" style="background:#10b981;">2</div>
                        <div class="cf-card__icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div>
                            <div class="cf-card__title">Select Fees to Collect</div>
                            <div class="cf-card__sub">Tap a fee tile to include it — the receipt updates instantly</div>
                        </div>
                    </div>
                    <div class="cf-card__body">

                        {{-- Grade Fees --}}
                        <div class="fee-section-label"><i class="fas fa-layer-group" style="color:var(--ct-primary);"></i> Grade Fees</div>
                        <div class="fee-grid">
                            @php
                            $gradeFees = [
                                ['id'=>'reg_fee',  'name'=>'reg_fee',  'val'=>'registration','label'=>'Registration','icon'=>'fa-clipboard-check','color'=>'#10b981'],
                                ['id'=>'tui_fee',  'name'=>'tui_fee',  'val'=>'tuition',     'label'=>'Tuition',     'icon'=>'fa-book',           'color'=>'#4f46e5'],
                                ['id'=>'uni_fee',  'name'=>'uni_fee',  'val'=>'uniform',     'label'=>'Uniform',     'icon'=>'fa-tshirt',         'color'=>'#06b6d4'],
                            ];
                            @endphp
                            @foreach($gradeFees as $f)
                            <label class="fee-tile" for="{{ $f['id'] }}" id="tile_{{ $f['id'] }}">
                                <input type="checkbox" id="{{ $f['id'] }}" name="fee_type[]"
                                       value="{{ $f['val'] }}" onclick="calculateTotalAmount(); syncTile(this)">
                                <div class="fee-tile__check"><i class="fas fa-check"></i></div>
                                <div class="fee-tile__icon"><i class="fas {{ $f['icon'] }}" style="color:{{ $f['color'] }};"></i></div>
                                <div class="fee-tile__name">{{ $f['label'] }} Fee</div>
                                <div class="fee-tile__amt" id="{{ $f['id'] }}_preview">₱ —</div>
                            </label>
                            @endforeach
                        </div>

                        {{-- Annual Fees --}}
                        <div class="fee-section-label"><i class="fas fa-calendar-alt" style="color:#06b6d4;"></i> Annual Fees</div>
                        <div class="fee-grid">
                            @php
                            $annualFees = [
                                ['id'=>'Medical',      'val'=>'Medical',      'label'=>'Medical',       'icon'=>'fa-heartbeat',       'color'=>'#ef4444'],
                                ['id'=>'Insurance',    'val'=>'Insurance',    'label'=>'Insurance',     'icon'=>'fa-shield-alt',      'color'=>'#f59e0b'],
                                ['id'=>'Death',        'val'=>'Death',        'label'=>'Death Aid',     'icon'=>'fa-heart',           'color'=>'#8b5cf6'],
                                ['id'=>'Library',      'val'=>'Library',      'label'=>'Library',       'icon'=>'fa-book-open',       'color'=>'#06b6d4'],
                                ['id'=>'School_Pub',   'val'=>'School_Pub',   'label'=>'School Pub',    'icon'=>'fa-newspaper',       'color'=>'#10b981'],
                                ['id'=>'Athlet',       'val'=>'Athlet',       'label'=>'Athlete',       'icon'=>'fa-running',         'color'=>'#f59e0b'],
                                ['id'=>'BACS',         'val'=>'BACS',         'label'=>'BACS',          'icon'=>'fa-users',           'color'=>'#4f46e5'],
                                ['id'=>'Book',         'val'=>'Book',         'label'=>'Book',          'icon'=>'fa-books',           'color'=>'#06b6d4'],
                                ['id'=>'Laboratory',   'val'=>'Laboratory',   'label'=>'Laboratory',    'icon'=>'fa-flask',           'color'=>'#10b981'],
                                ['id'=>'StudentID',    'val'=>'StudentID',    'label'=>'Student ID',    'icon'=>'fa-id-badge',        'color'=>'#4f46e5'],
                                ['id'=>'Passbook',     'val'=>'Passbook',     'label'=>'Passbook',      'icon'=>'fa-book',            'color'=>'#8b5cf6'],
                                ['id'=>'Handbook',     'val'=>'Handbook',     'label'=>'Handbook',      'icon'=>'fa-bookmark',        'color'=>'#ef4444'],
                                ['id'=>'Dental',       'val'=>'Dental',       'label'=>'Dental',        'icon'=>'fa-tooth',           'color'=>'#06b6d4'],
                            ];
                            @endphp
                            @foreach($annualFees as $f)
                            <label class="fee-tile" for="{{ $f['id'] }}_chk" id="tile_{{ $f['id'] }}">
                                <input type="checkbox" id="{{ $f['id'] }}_chk" name="fee_type[]"
                                       value="{{ $f['val'] }}" onclick="calculateTotalAmount(); syncTile(this)">
                                <div class="fee-tile__check"><i class="fas fa-check"></i></div>
                                <div class="fee-tile__icon"><i class="fas {{ $f['icon'] }}" style="color:{{ $f['color'] }};"></i></div>
                                <div class="fee-tile__name">{{ $f['label'] }}</div>
                                <div class="fee-tile__amt" id="{{ $f['id'] }}_preview">₱ —</div>
                            </label>
                            @endforeach
                        </div>

                        {{-- Milestone Fees --}}
                        <div class="fee-section-label"><i class="fas fa-star" style="color:#f59e0b;"></i> Milestone Fees</div>
                        <div class="fee-grid">
                            <label class="fee-tile" for="Completers_Fee_chk" id="tile_Completers_Fee">
                                <input type="checkbox" id="Completers_Fee_chk" name="fee_type[]"
                                       value="Completers_Fee" onclick="calculateTotalAmount(); syncTile(this)">
                                <div class="fee-tile__check"><i class="fas fa-check"></i></div>
                                <div class="fee-tile__icon"><i class="fas fa-medal" style="color:#f59e0b;"></i></div>
                                <div class="fee-tile__name">Completers Fee</div>
                                <div class="fee-tile__amt" id="Completers_Fee_preview">₱ —</div>
                            </label>
                            <label class="fee-tile graduation-fee-checkbox" for="graduation_chk" id="tile_graduation" style="display:none;">
                                <input type="checkbox" id="graduation_chk" name="fee_type[]"
                                       value="graduation" onclick="calculateTotalAmount(); syncTile(this)">
                                <div class="fee-tile__check"><i class="fas fa-check"></i></div>
                                <div class="fee-tile__icon"><i class="fas fa-graduation-cap" style="color:#4f46e5;"></i></div>
                                <div class="fee-tile__name">Graduation Fee</div>
                                <div class="fee-tile__amt" id="graduation_preview">₱ —</div>
                            </label>
                        </div>

                    </div>
                </div>

            </div>{{-- /.col-lg-7 --}}

            {{-- ══ RIGHT: live receipt ══ --}}
            <div class="col-lg-5 col-md-12">
                <div class="cf-receipt">
                    <div class="cf-receipt__header">
                        <div style="width:34px;height:34px;border-radius:8px;background:rgba(79,70,229,.12);color:var(--ct-primary);display:flex;align-items:center;justify-content:center;font-size:.88rem;flex-shrink:0;">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="cf-receipt__title">Official Receipt Preview</div>
                    </div>
                    <div class="cf-receipt__body">

                        {{-- OR Number --}}
                        <div class="cf-receipt__or">
                            <label class="cf-label">OR Number</label>
                            <input type="text" class="form-control form-control-sm" id="or_no" name="or_no"
                                   placeholder="Auto-generated">
                        </div>

                        {{-- Fee lines (same structure JS updates via .payment-amount[value=...]) --}}
                        <div id="receipt-lines">
                            @php
                            $receiptLines = [
                                ['desc'=>'Registration',     'val'=>'registration',  'dispId'=>'reg_fees'],
                                ['desc'=>'Tuition',          'val'=>'tuition',       'dispId'=>'tui_fees'],
                                ['desc'=>'Uniform',          'val'=>'uniform',       'dispId'=>'uni_fees'],
                                ['desc'=>'Medical',          'val'=>'Medicals',      'dispId'=>null],
                                ['desc'=>'Insurance',        'val'=>'Insurances',    'dispId'=>null],
                                ['desc'=>'Death Aid',        'val'=>'Deaths',        'dispId'=>null],
                                ['desc'=>'Library',          'val'=>'Librarys',      'dispId'=>null],
                                ['desc'=>'School Pub',       'val'=>'School_Pubs',   'dispId'=>null],
                                ['desc'=>'Athlete',          'val'=>'Athlets',       'dispId'=>null],
                                ['desc'=>'BACS',             'val'=>'BACSs',         'dispId'=>null],
                                ['desc'=>'Book',             'val'=>'Books',         'dispId'=>null],
                                ['desc'=>'Laboratory',       'val'=>'Laboratorys',   'dispId'=>null],
                                ['desc'=>'Student ID',       'val'=>'StudentIDs',    'dispId'=>null],
                                ['desc'=>'Passbook',         'val'=>'Passbooks',     'dispId'=>null],
                                ['desc'=>'Handbook',         'val'=>'Handbooks',     'dispId'=>null],
                                ['desc'=>'Dental',           'val'=>'Dentals',       'dispId'=>null],
                                ['desc'=>'Completers',       'val'=>'Completers_Fees','dispId'=>null],
                                ['desc'=>'Graduation',       'val'=>'graduations',   'dispId'=>null],
                            ];
                            @endphp
                            @foreach($receiptLines as $line)
                            <div class="receipt-line inactive" data-fee="{{ $line['val'] }}">
                                <span class="receipt-line__badge"><i class="fas fa-check"></i></span>
                                <span class="receipt-line__name">{{ $line['desc'] }}</span>
                                <span class="receipt-line__amount payment-amount" value="{{ $line['val'] }}"
                                    @if($line['dispId']) id="{{ $line['dispId'] }}" @endif>—</span>
                            </div>
                            @endforeach
                        </div>

                        {{-- Total --}}
                        <div class="receipt-total">
                            <span class="receipt-total__label">Total Due</span>
                            <span class="receipt-total__value" id="total_payment_amount">₱ 0.00</span>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-pay" id="submitPayBtn">
                            <span class="pay-label"><i class="fas fa-check-circle mr-2"></i>Set Payment</span>
                            <span class="pay-spinner d-none"><i class="fas fa-spinner fa-spin mr-2"></i>Saving…</span>
                        </button>

                        <button type="reset" class="btn btn-outline-secondary btn-block mt-2" id="resetPayBtn"
                                style="font-size:.8rem;">
                            <i class="fas fa-undo mr-1"></i> Clear All
                        </button>

                    </div>
                </div>
            </div>{{-- /.col-lg-5 --}}

        </div>{{-- /.row --}}
    </form>
</div>
</section>

<script>
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

/* ── Sync tile visual state ── */
function syncTile(checkbox) {
    const tile = checkbox.closest('.fee-tile');
    if (!tile) return;
    tile.classList.toggle('selected', checkbox.checked);
}

/* ── Sync all receipt lines ── */
function syncReceiptLines() {
    document.querySelectorAll('.receipt-line').forEach(function (line) {
        const val = line.dataset.fee;
        const amtEl = line.querySelector('.payment-amount');
        const amt = amtEl ? parseFloat(amtEl.textContent.replace(/[^0-9.]/g, '')) || 0 : 0;
        if (amt > 0) {
            line.classList.add('active');
            line.classList.remove('inactive');
        } else {
            line.classList.remove('active');
            line.classList.add('inactive');
        }
    });
}

/* ── Total display override ── */
const _origCalc = window.calculateTotalAmount;
function calculateTotalAmount() {
    // Run original logic first (defined below — hoisted via function declaration)
    _calculateTotalAmountCore();
    syncReceiptLines();
    // Update receipt total display nicely
    const raw = parseFloat(document.getElementById('total_amount').value) || 0;
    document.getElementById('total_payment_amount').textContent =
        '₱ ' + raw.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function _calculateTotalAmountCore() {
    var t=0, r=0, tu=0, u=0, g=0, me=0, ins=0, de=0, li=0, sp=0, at=0, ba=0, bo=0, la=0, si=0, pa=0, ha=0, dn=0, cf=0;

    function chk(id) { return $('#'+id); }
    function getVal(id) { return parseFloat(chk(id).val())||0; }

    if(chk('reg_fee').is(':checked'))        { r=getVal('reg_fee');   t+=r; $('#registration').val(r.toFixed(2)); }
    if(chk('tui_fee').is(':checked'))        { tu=getVal('tui_fee');  t+=tu; $('#tuition').val(tu.toFixed(2)); }
    if(chk('uni_fee').is(':checked'))        { u=getVal('uni_fee');   t+=u; $('#uniform').val(u.toFixed(2)); }

    // Annual fees use _chk suffix IDs for checkboxes
    function annualChk(base) {
        // try both id patterns
        let el = document.getElementById(base+'_chk') || document.getElementById(base);
        return el && el.checked;
    }
    function annualVal(base) {
        let el = document.getElementById(base+'_chk') || document.getElementById(base);
        return parseFloat((el&&el.value)||0)||0;
    }

    if(annualChk('Medical'))      { me=annualVal('Medical');     t+=me; $('#Medicals').val(me.toFixed(2)); }
    if(annualChk('Insurance'))    { ins=annualVal('Insurance');  t+=ins; $('#Insurances').val(ins.toFixed(2)); }
    if(annualChk('Death'))        { de=annualVal('Death');       t+=de; $('#Deaths').val(de.toFixed(2)); }
    if(annualChk('Library'))      { li=annualVal('Library');     t+=li; $('#Librarys').val(li.toFixed(2)); }
    if(annualChk('School_Pub'))   { sp=annualVal('School_Pub'); t+=sp; $('#School_Pubs').val(sp.toFixed(2)); }
    if(annualChk('Athlet'))       { at=annualVal('Athlet');      t+=at; $('#Athlets').val(at.toFixed(2)); }
    if(annualChk('BACS'))         { ba=annualVal('BACS');        t+=ba; $('#BACSs').val(ba.toFixed(2)); }
    if(annualChk('Book'))         { bo=annualVal('Book');        t+=bo; $('#Books').val(bo.toFixed(2)); }
    if(annualChk('Laboratory'))   { la=annualVal('Laboratory');  t+=la; $('#Laboratorys').val(la.toFixed(2)); }
    if(annualChk('StudentID'))    { si=annualVal('StudentID');   t+=si; $('#StudentIDs').val(si.toFixed(2)); }
    if(annualChk('Passbook'))     { pa=annualVal('Passbook');    t+=pa; $('#Passbooks').val(pa.toFixed(2)); }
    if(annualChk('Handbook'))     { ha=annualVal('Handbook');    t+=ha; $('#Handbooks').val(ha.toFixed(2)); }
    if(annualChk('Dental'))       { dn=annualVal('Dental');      t+=dn; $('#Dentals').val(dn.toFixed(2)); }
    if(annualChk('Completers_Fee')){ cf=annualVal('Completers_Fee'); t+=cf; $('#Completers_Fees').val(cf.toFixed(2)); }
    if(annualChk('graduation'))   { g=annualVal('graduation');   t+=g; $('#Graduation_Fees').val(g.toFixed(2)); }

    // Update payment-amount display spans (for receipt lines)
    function setAmt(sel,val) { $(sel).text(val>0?'₱ '+val.toFixed(2):'—'); }
    setAmt(".payment-amount[value='registration']", r);
    setAmt(".payment-amount[value='tuition']",      tu);
    setAmt(".payment-amount[value='uniform']",      u);
    setAmt(".payment-amount[value='Medicals']",     me);
    setAmt(".payment-amount[value='Insurances']",   ins);
    setAmt(".payment-amount[value='Deaths']",       de);
    setAmt(".payment-amount[value='Librarys']",     li);
    setAmt(".payment-amount[value='School_Pubs']",  sp);
    setAmt(".payment-amount[value='Athlets']",      at);
    setAmt(".payment-amount[value='BACSs']",        ba);
    setAmt(".payment-amount[value='Books']",        bo);
    setAmt(".payment-amount[value='Laboratorys']",  la);
    setAmt(".payment-amount[value='StudentIDs']",   si);
    setAmt(".payment-amount[value='Passbooks']",    pa);
    setAmt(".payment-amount[value='Handbooks']",    ha);
    setAmt(".payment-amount[value='Dentals']",      dn);
    setAmt(".payment-amount[value='Completers_Fees']",cf);
    setAmt(".payment-amount[value='graduations']",  g);

    $('#total_amount').val(t.toFixed(2));
}

/* ── Grade / strand / graduation ── */
function toggleStrandInput() {
    const val = document.getElementById('lvl').value;
    const show = ['11','12'].includes(val);
    document.getElementById('strandContainer').style.display = show ? 'block' : 'none';
    if (!show) document.getElementById('strand').value = 'Choose';
}

function toggleGraduationFee() {
    const val = document.getElementById('lvl').value;
    document.querySelectorAll('.graduation-fee-checkbox').forEach(function (el) {
        el.style.display = val === '12' ? 'flex' : 'none';
    });
    if (val !== '12') {
        const g = document.getElementById('graduation_chk');
        if (g) { g.checked = false; }
        calculateTotalAmount();
    }
}

document.getElementById('lvl').addEventListener('change', function () {
    toggleStrandInput();
    toggleGraduationFee();
    updateRegistrationFee();
});
window.addEventListener('load', toggleGraduationFee);

function updateRegistrationFee() { /* stub — kept for form.js compatibility */ }

/* ── Validation ── */
function validateIdNum(el) { el.value = el.value.replace(/[^0-9]/g,''); }
function validateName(el)   { el.value = el.value.replace(/[^A-Za-z\s.]/g,''); }
function validateSection(el){ el.value = el.value.replace(/[^A-Za-z0-9\s\-]/g,''); }
function validateSchoolYear(el) {
    const v = el.value;
    if (/^\d{4}-\d{4}$/.test(v)) {
        const [s,e] = v.split('-').map(Number);
        const err = document.querySelector('.ay_error');
        if (err) err.textContent = (s<2023||e<=s) ? 'Invalid year range.' : '';
    }
}

/* ── OR number auto-generate ── */
document.addEventListener('DOMContentLoaded', function () {
    const orNo = document.getElementById('or_no');
    if (orNo && !orNo.value) {
        let n = (parseInt(localStorage.getItem('lastNumber'))||0) + 1;
        localStorage.setItem('lastNumber', n);
        orNo.value = String(n).padStart(6,'0');
    }
});

/* ── Form submission ── */
function saveStudent() {
    $('#save-student-form').on('submit', function (e) {
        e.preventDefault();
        const form = this;
        const btn  = document.getElementById('submitPayBtn');
        btn.disabled = true;
        btn.querySelector('.pay-label').classList.add('d-none');
        btn.querySelector('.pay-spinner').classList.remove('d-none');

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData:false, dataType:'json', contentType:false,
            beforeSend: function () { $(form).find('span.error-text').text(''); },
            success: function (data) {
                btn.disabled = false;
                btn.querySelector('.pay-label').classList.remove('d-none');
                btn.querySelector('.pay-spinner').classList.add('d-none');
                if (data.code == 0) {
                    toastr.error('Payment not saved. Please check the fields.');
                    $.each(data.error, function (k,v) { $(form).find('span.'+k+'_error').text(v[0]); });
                } else {
                    form.reset();
                    document.querySelectorAll('.fee-tile').forEach(t => t.classList.remove('selected'));
                    document.querySelectorAll('.receipt-line').forEach(l => { l.classList.remove('active'); l.classList.add('inactive'); });
                    document.getElementById('total_payment_amount').textContent = '₱ 0.00';
                    $('#student-table').DataTable && $('#student-table').DataTable().ajax.reload();
                    toastr.success(data.msg);
                    // regenerate OR
                    let n=(parseInt(localStorage.getItem('lastNumber'))||0)+1;
                    localStorage.setItem('lastNumber',n);
                    document.getElementById('or_no').value=String(n).padStart(6,'0');
                }
            },
            error: function () {
                btn.disabled = false;
                btn.querySelector('.pay-label').classList.remove('d-none');
                btn.querySelector('.pay-spinner').classList.add('d-none');
                toastr.error('Server error. Please try again.');
            }
        });
    });
}
saveStudent();

/* ── Reset button ── */
document.getElementById('resetPayBtn').addEventListener('click', function () {
    setTimeout(function () {
        document.querySelectorAll('.fee-tile').forEach(t => t.classList.remove('selected'));
        document.querySelectorAll('.receipt-line').forEach(l => { l.classList.remove('active'); l.classList.add('inactive'); });
        document.querySelectorAll('.payment-amount').forEach(el => el.textContent = '—');
        document.getElementById('total_payment_amount').textContent = '₱ 0.00';
        document.getElementById('total_amount').value = '0';
        document.getElementById('strandContainer').style.display = 'none';
        document.querySelectorAll('.graduation-fee-checkbox').forEach(el => el.style.display = 'none');
    }, 10);
});
</script>
@endsection
