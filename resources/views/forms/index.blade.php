@extends('home.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

<style>
/* ── Hero ── */
.sf-hero {
    background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
    border-radius: var(--ct-radius);
    padding: 26px 30px 22px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
    color: #fff;
}
.sf-hero::after {
    content:'';position:absolute;right:-50px;top:-50px;
    width:220px;height:220px;border-radius:50%;
    background:rgba(255,255,255,.07);pointer-events:none;
}
.sf-hero::before {
    content:'';position:absolute;right:80px;bottom:-70px;
    width:160px;height:160px;border-radius:50%;
    background:rgba(255,255,255,.05);pointer-events:none;
}
.sf-hero__eyebrow {
    display:inline-flex;align-items:center;gap:7px;
    background:rgba(255,255,255,.18);border-radius:999px;
    padding:4px 12px;font-size:.72rem;font-weight:700;
    letter-spacing:.5px;text-transform:uppercase;margin-bottom:12px;
}
.sf-hero__title {
    font-size:1.55rem;font-weight:800;letter-spacing:-.4px;
    margin-bottom:4px;
}
.sf-hero__sub { font-size:.83rem;opacity:.85;margin-bottom:0; }

/* ── Workflow position indicator ── */
.sf-steps {
    display:flex;align-items:center;gap:0;
    background:var(--ct-surface);border:1px solid var(--ct-border);
    border-radius:var(--ct-radius);box-shadow:var(--ct-shadow);
    overflow:hidden;margin-bottom:24px;
}
.sf-step-item {
    flex:1;display:flex;align-items:center;gap:12px;
    padding:14px 18px;position:relative;
    font-size:.8rem;color:var(--ct-text-muted);
    border-right:1px solid var(--ct-border);
    transition:background .15s;
    text-decoration:none !important;
}
.sf-step-item:last-child{border-right:none;}
.sf-step-item--active {
    background:rgba(16,185,129,.06);
    color:var(--ct-text) !important;
}
.sf-step-item--done   { background:transparent; }
.sf-step-badge {
    width:26px;height:26px;border-radius:50%;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    font-size:.72rem;font-weight:800;
}
.sf-step-badge--active  { background:#10b981;color:#fff;box-shadow:0 2px 8px rgba(16,185,129,.35); }
.sf-step-badge--done    { background:#10b981;color:#fff; }
.sf-step-badge--pending { background:var(--ct-surface-alt);color:var(--ct-text-muted);border:1px solid var(--ct-border); }
.sf-step-info { line-height:1.3; }
.sf-step-label { font-weight:700;font-size:.8rem;color:var(--ct-text); }
.sf-step-sub   { font-size:.7rem;color:var(--ct-text-muted);margin-top:1px; }
.sf-step-item--active .sf-step-label { color:#10b981; }
.sf-step-arrow { color:var(--ct-border);font-size:.75rem;margin:0 -4px;flex-shrink:0;z-index:1; }

/* ── Form card ── */
.sf-card {
    background:var(--ct-surface);
    border:1px solid var(--ct-border);
    border-radius:var(--ct-radius);
    box-shadow:var(--ct-shadow);
    margin-bottom:16px;
    overflow:hidden;
}
.sf-card__header {
    display:flex;align-items:center;gap:14px;
    padding:16px 22px;
    background:var(--ct-surface-alt);
    border-bottom:1px solid var(--ct-border);
}
.sf-card__icon {
    width:40px;height:40px;border-radius:10px;
    display:flex;align-items:center;justify-content:center;
    font-size:1rem;flex-shrink:0;
}
.sf-card__num {
    width:26px;height:26px;border-radius:50%;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    font-size:.75rem;font-weight:800;color:#fff;
    box-shadow:0 2px 6px rgba(0,0,0,.2);
}
.sf-card__title { font-size:.92rem;font-weight:700;color:var(--ct-text); }
.sf-card__sub   { font-size:.74rem;color:var(--ct-text-muted);margin-top:2px; }
.sf-card__body  { padding:22px; }

/* ── Field ── */
.sf-field { margin-bottom:0; }
.sf-field-label {
    display:block;
    font-size:.78rem;font-weight:600;
    color:var(--ct-text);margin-bottom:5px;
    letter-spacing:.1px;
}
.sf-field-label .req { color:var(--ct-danger);margin-left:2px; }
.sf-field-hint {
    display:block;font-size:.7rem;
    color:var(--ct-text-muted);margin-top:4px;line-height:1.4;
}
.sf-field-error {
    display:block;font-size:.72rem;
    color:var(--ct-danger);margin-top:4px;min-height:.9em;
}

/* ── Field icon box ── */
.sf-input-icon {
    position:relative;
}
.sf-input-icon .form-control {
    padding-left:40px;
}
.sf-input-icon__i {
    position:absolute;left:12px;top:50%;transform:translateY(-50%);
    color:var(--ct-text-muted);font-size:.85rem;pointer-events:none;z-index:4;
}

/* ── Strand pill badges ── */
.strand-grid {
    display:flex;flex-wrap:wrap;gap:8px;margin-top:4px;
}
.strand-pill {
    position:relative;
}
.strand-pill input[type="radio"] {
    position:absolute;opacity:0;width:0;height:0;
}
.strand-pill label {
    display:inline-flex;align-items:center;gap:5px;
    padding:6px 14px;border-radius:999px;
    border:1.5px solid var(--ct-border);
    background:var(--ct-surface-alt);
    font-size:.78rem;font-weight:600;
    color:var(--ct-text-muted);cursor:pointer;
    transition:all .15s;user-select:none;
    margin:0;
}
.strand-pill input:checked + label {
    background:#4f46e5;border-color:#4f46e5;
    color:#fff;box-shadow:0 2px 8px rgba(79,70,229,.3);
}
.strand-pill label:hover {
    border-color:var(--ct-primary);
    color:var(--ct-primary);
}
.strand-pill input:checked + label:hover { color:#fff; }

/* ── Action footer ── */
.sf-footer {
    background:var(--ct-surface);
    border:1px solid var(--ct-border);
    border-radius:var(--ct-radius);
    box-shadow:var(--ct-shadow);
    padding:18px 22px;
    display:flex;align-items:center;
    justify-content:space-between;flex-wrap:wrap;gap:12px;
}
.sf-footer__tip {
    display:flex;align-items:flex-start;gap:10px;
    font-size:.8rem;color:var(--ct-text-muted);line-height:1.5;
    max-width:420px;
}
.sf-footer__tip i { color:#f59e0b;margin-top:2px;flex-shrink:0; }
.sf-footer__tip a { color:var(--ct-primary);font-weight:600; }
.sf-footer__btns  { display:flex;gap:8px;flex-wrap:wrap; }

.btn-register {
    background:linear-gradient(135deg,#10b981,#06b6d4) !important;
    border:none !important;color:#fff !important;
    font-weight:700;padding:.6rem 1.6rem;
    box-shadow:0 4px 14px rgba(16,185,129,.35) !important;
    transition:box-shadow .18s,transform .18s !important;
}
.btn-register:hover {
    box-shadow:0 6px 20px rgba(16,185,129,.45) !important;
    transform:translateY(-1px) !important;
}
.btn-register:disabled { opacity:.75;cursor:progress; }

@media(max-width:767px){
    .sf-steps { flex-direction:column; }
    .sf-step-item { border-right:none;border-bottom:1px solid var(--ct-border); }
    .sf-step-item:last-child { border-bottom:none; }
    .sf-step-arrow { display:none; }
    .sf-hero__title { font-size:1.25rem; }
}
</style>

<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3">

    {{-- ── Hero ── --}}
    <div class="sf-hero">
        <div class="sf-hero__eyebrow">
            <i class="fas fa-user-plus"></i> Step 2 of 4 — Register Student
        </div>
        <div class="sf-hero__title">Student Information Form</div>
        <div class="sf-hero__sub">
            Fill in the student's details carefully — this information is used across all payment records.
        </div>
    </div>

    {{-- ── Workflow position ── --}}
    <div class="sf-steps">
        <a href="{{ route('setting.cashier') }}" class="sf-step-item sf-step-item--done">
            <div class="sf-step-badge sf-step-badge--done"><i class="fas fa-check" style="font-size:.6rem;"></i></div>
            <div class="sf-step-info">
                <div class="sf-step-label">Configure Fees</div>
                <div class="sf-step-sub">Grade &amp; annual fees</div>
            </div>
        </a>
        <div class="sf-step-item sf-step-item--active">
            <div class="sf-step-badge sf-step-badge--active">2</div>
            <div class="sf-step-info">
                <div class="sf-step-label">Register Student</div>
                <div class="sf-step-sub">You are here</div>
            </div>
        </div>
        <a href="{{ route('cashier.mainform') }}" class="sf-step-item">
            <div class="sf-step-badge sf-step-badge--pending">3</div>
            <div class="sf-step-info">
                <div class="sf-step-label">Process Payment</div>
                <div class="sf-step-sub">Cashier form</div>
            </div>
        </a>
        <a href="{{ route('table.student') }}" class="sf-step-item">
            <div class="sf-step-badge sf-step-badge--pending">4</div>
            <div class="sf-step-info">
                <div class="sf-step-label">Monitor &amp; Report</div>
                <div class="sf-step-sub">Cash collection</div>
            </div>
        </a>
    </div>

    <form action="{{ route('store.student') }}" method="POST" id="save-student-form" novalidate>
        @csrf
        <input type="hidden" id="reg_fee" name="reg_fee">

        <div class="row">

            {{-- ── LEFT: form sections ── --}}
            <div class="col-lg-8 col-md-12">

                {{-- Section 1 — Student Identity --}}
                <div class="sf-card">
                    <div class="sf-card__header">
                        <div class="sf-card__num" style="background:#10b981;">1</div>
                        <div class="sf-card__icon" style="background:rgba(16,185,129,.12);color:#10b981;">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div>
                            <div class="sf-card__title">Student Identity</div>
                            <div class="sf-card__sub">LRN and full legal name as in official records</div>
                        </div>
                    </div>
                    <div class="sf-card__body">
                        <div class="row g-3">

                            {{-- LRN --}}
                            <div class="col-md-4 col-12 mb-3">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="Id_num">
                                        LRN <span class="req">*</span>
                                    </label>
                                    <div class="sf-input-icon">
                                        <i class="fas fa-barcode sf-input-icon__i"></i>
                                        <input type="text" class="form-control" id="Id_num" name="Id_num"
                                               placeholder="123456789012" maxlength="12"
                                               oninput="validateIdNum(this)" autocomplete="off">
                                    </div>
                                    <span class="sf-field-hint">12-digit Learner Reference Number</span>
                                    <span class="sf-field-error Id_num_error"></span>
                                </div>
                            </div>

                            {{-- First Name --}}
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="fname">
                                        First Name <span class="req">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="fname" name="fname"
                                           placeholder="First Name" oninput="validateName(this)">
                                    <span class="sf-field-hint">As it appears on birth certificate</span>
                                    <span class="sf-field-error fname_error"></span>
                                </div>
                            </div>

                            {{-- M.I. --}}
                            <div class="col-md-1 col-sm-2 mb-3">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="mname">M.I.</label>
                                    <input type="text" class="form-control text-center" id="mname" name="mname"
                                           placeholder="M" maxlength="2" oninput="validateName(this)">
                                    <span class="sf-field-hint">Middle initial</span>
                                    <span class="sf-field-error mname_error"></span>
                                </div>
                            </div>

                            {{-- Last Name --}}
                            <div class="col-md-3 col-sm-4 mb-3">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="lname">
                                        Last Name <span class="req">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="lname" name="lname"
                                           placeholder="Last Name" oninput="validateName(this)">
                                    <span class="sf-field-hint">Family / surname</span>
                                    <span class="sf-field-error lname_error"></span>
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-4 col-sm-6 mb-0">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="phonenumber">Phone Number</label>
                                    <div class="sf-input-icon">
                                        <i class="fas fa-phone sf-input-icon__i"></i>
                                        <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                                               placeholder="09XXXXXXXXX" maxlength="11">
                                    </div>
                                    <span class="sf-field-hint">Parent / guardian contact (optional)</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Section 2 — Academic Placement --}}
                <div class="sf-card">
                    <div class="sf-card__header">
                        <div class="sf-card__num" style="background:#4f46e5;">2</div>
                        <div class="sf-card__icon" style="background:rgba(79,70,229,.12);color:#4f46e5;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <div class="sf-card__title">Academic Placement</div>
                            <div class="sf-card__sub">Grade, section, track and school year</div>
                        </div>
                    </div>
                    <div class="sf-card__body">
                        <div class="row g-3">

                            {{-- Grade Level --}}
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="lvl">
                                        Grade Level <span class="req">*</span>
                                    </label>
                                    <div class="sf-input-icon">
                                        <i class="fas fa-layer-group sf-input-icon__i"></i>
                                        <select class="form-control" id="lvl" name="lvl" style="padding-left:40px;"
                                                onchange="toggleStrandInput(); populateSections(); updateRegistrationFee()">
                                            <option value="0" selected disabled>— Select grade —</option>
                                            <option value="Nursery">Nursery</option>
                                            <option value="1">Grade 1</option>
                                            <option value="2">Grade 2</option>
                                            <option value="3">Grade 3</option>
                                            <option value="4">Grade 4</option>
                                            <option value="5">Grade 5</option>
                                            <option value="6">Grade 6</option>
                                            <option value="7">Grade 7</option>
                                            <option value="8">Grade 8</option>
                                            <option value="9">Grade 9</option>
                                            <option value="10">Grade 10</option>
                                            <option value="11">Grade 11</option>
                                            <option value="12">Grade 12</option>
                                        </select>
                                    </div>
                                    <span class="sf-field-hint">Sets the applicable fee schedule</span>
                                    <span class="sf-field-error lvl_error"></span>
                                </div>
                            </div>

                            {{-- Section --}}
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="section">
                                        Section <span class="req">*</span>
                                    </label>
                                    <div class="sf-input-icon">
                                        <i class="fas fa-users sf-input-icon__i"></i>
                                        <select class="form-control" id="section" name="section" style="padding-left:40px;">
                                            <option value="" selected disabled>— Pick grade first —</option>
                                        </select>
                                    </div>
                                    <span class="sf-field-hint">Auto-filled when grade is selected</span>
                                    <span class="sf-field-error section_error"></span>
                                </div>
                            </div>

                            {{-- Academic Year --}}
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="sf-field">
                                    <label class="sf-field-label" for="ay">
                                        Academic Year <span class="req">*</span>
                                    </label>
                                    <div class="sf-input-icon">
                                        <i class="fas fa-calendar-alt sf-input-icon__i"></i>
                                        <input type="text" class="form-control" id="ay" name="ay"
                                               placeholder="2024-2025" style="padding-left:40px;"
                                               oninput="validateSchoolYear(this)">
                                    </div>
                                    <span class="sf-field-hint">Format: YYYY-YYYY</span>
                                    <span class="sf-field-error ay_error"></span>
                                </div>
                            </div>

                            {{-- Strand (SHS only) --}}
                            <div id="strandContainer" class="col-12 mb-0" style="display:none;">
                                <div class="sf-field">
                                    <label class="sf-field-label">
                                        Academic Track <span class="req">*</span>
                                    </label>
                                    <div class="strand-grid">
                                        @foreach(['STEM','ABM','ICT','HUMMS','GAS'] as $track)
                                        <div class="strand-pill">
                                            <input type="radio" name="strand" id="track_{{ $track }}" value="{{ $track }}">
                                            <label for="track_{{ $track }}">
                                                <i class="fas fa-circle" style="font-size:.45rem;opacity:.6;"></i>
                                                {{ $track }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <span class="sf-field-hint">Required for Grade 11 &amp; 12 only</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>{{-- /.col-lg-8 --}}

            {{-- ── RIGHT: context sidebar ── --}}
            <div class="col-lg-4 col-md-12">

                {{-- Registration fee preview --}}
                <div class="sf-card mb-3" id="feePreviewCard" style="display:none;">
                    <div class="sf-card__header" style="background:rgba(16,185,129,.06);">
                        <div class="sf-card__icon" style="background:rgba(16,185,129,.15);color:#10b981;">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div>
                            <div class="sf-card__title" style="color:#10b981;">Registration Fee</div>
                            <div class="sf-card__sub">For the selected grade level</div>
                        </div>
                    </div>
                    <div class="sf-card__body text-center" style="padding:20px;">
                        <div id="feeDisplay"
                             style="font-size:2rem;font-weight:800;letter-spacing:-1px;color:#10b981;font-variant-numeric:tabular-nums;">
                            ₱ 0.00
                        </div>
                        <div style="font-size:.72rem;color:var(--ct-text-muted);margin-top:4px;">
                            Applies to selected grade level
                        </div>
                    </div>
                </div>

                {{-- Tips card --}}
                <div class="sf-card">
                    <div class="sf-card__header">
                        <div class="sf-card__icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div>
                            <div class="sf-card__title">Helpful Tips</div>
                        </div>
                    </div>
                    <div class="sf-card__body" style="padding:18px 20px;">
                        <ul style="margin:0;padding-left:0;list-style:none;display:flex;flex-direction:column;gap:12px;">
                            <li style="display:flex;gap:10px;align-items:flex-start;">
                                <span style="width:20px;height:20px;border-radius:50%;background:rgba(16,185,129,.12);color:#10b981;display:flex;align-items:center;justify-content:center;font-size:.6rem;flex-shrink:0;margin-top:1px;">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span style="font-size:.8rem;color:var(--ct-text-muted);line-height:1.5;">
                                    Make sure grade fees are configured in <a href="{{ route('setting.cashier') }}" style="color:var(--ct-primary);font-weight:600;">Settings</a> before registering.
                                </span>
                            </li>
                            <li style="display:flex;gap:10px;align-items:flex-start;">
                                <span style="width:20px;height:20px;border-radius:50%;background:rgba(79,70,229,.1);color:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:.6rem;flex-shrink:0;margin-top:1px;">
                                    <i class="fas fa-info"></i>
                                </span>
                                <span style="font-size:.8rem;color:var(--ct-text-muted);line-height:1.5;">
                                    The <strong>LRN</strong> is the 12-digit number found on the student's Form 138 or enrollment record.
                                </span>
                            </li>
                            <li style="display:flex;gap:10px;align-items:flex-start;">
                                <span style="width:20px;height:20px;border-radius:50%;background:rgba(6,182,212,.1);color:#06b6d4;display:flex;align-items:center;justify-content:center;font-size:.6rem;flex-shrink:0;margin-top:1px;">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                                <span style="font-size:.8rem;color:var(--ct-text-muted);line-height:1.5;">
                                    After saving, go to the <a href="{{ route('cashier.mainform') }}" style="color:var(--ct-primary);font-weight:600;">Cashier Form</a> to process the student's payment.
                                </span>
                            </li>
                            <li style="display:flex;gap:10px;align-items:flex-start;">
                                <span style="width:20px;height:20px;border-radius:50%;background:rgba(245,158,11,.12);color:#f59e0b;display:flex;align-items:center;justify-content:center;font-size:.6rem;flex-shrink:0;margin-top:1px;">
                                    <i class="fas fa-file-upload"></i>
                                </span>
                                <span style="font-size:.8rem;color:var(--ct-text-muted);line-height:1.5;">
                                    Have multiple students? Use <a href="{{ route('student.batch_upload') }}" style="color:var(--ct-primary);font-weight:600;">Batch Upload</a> instead.
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>{{-- /.col-lg-4 --}}

        </div>{{-- /.row --}}

        {{-- ── Action footer ── --}}
        <div class="sf-footer mt-2">
            <div class="sf-footer__tip">
                <i class="fas fa-lightbulb"></i>
                <span>
                    After saving, head to the <a href="{{ route('cashier.mainform') }}">Cashier Form</a>
                    to process payment for this student.
                </span>
            </div>
            <div class="sf-footer__btns">
                <button type="reset" class="btn btn-outline-secondary" id="resetFormBtn">
                    <i class="fas fa-undo mr-1"></i> Clear
                </button>
                <button type="submit" class="btn btn-register px-4" id="submitStudentBtn">
                    <span class="submit-label">
                        <i class="fas fa-user-plus mr-2"></i>Register Student
                    </span>
                    <span class="submit-spinner d-none">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Saving…
                    </span>
                </button>
            </div>
        </div>

    </form>
</div>
</section>

<script>
const gradeSections = {
    'Nursery':["A","B"],'Kinder':["1-A","1-B"],'Kinder2':["2-A","2-B"],
    '1':["1-A"],'2':["2-A"],'3':["3-A"],'4':["4-A"],'5':["5-A"],'6':["6-A"],
    '7':["Humility","Generosity"],'8':["Honesty","Resilience"],
    '9':["Loyalty","Hope"],'10':["Love","Charity"],
    '11':["Fortitude","Unity","Prosperity"],'12':["Courage","Integrity"],
};

function populateSections() {
    const lvl = document.getElementById('lvl').value;
    const sec = document.getElementById('section');
    sec.innerHTML = '<option value="" selected disabled>— Choose section —</option>';
    (gradeSections[lvl] || []).forEach(s => {
        const o = document.createElement('option');
        o.value = s; o.text = s; sec.add(o);
    });
}

function toggleStrandInput() {
    const val = document.getElementById('lvl').value;
    const c = document.getElementById('strandContainer');
    const show = ['11','12'].includes(val);
    c.style.display = show ? 'block' : 'none';
    if (!show) document.querySelectorAll('input[name="strand"]').forEach(r => r.checked = false);
}

const feeMap = { Nursery:1175,Kinder:1175,Kinder2:1175,
    '1':1175,'2':1175,'3':1175,'4':1175,'5':1175,'6':1175,
    '7':600,'8':600,'9':600,'10':600,'11':925,'12':925 };

function updateRegistrationFee() {
    const val = document.getElementById('lvl').value;
    const fee = feeMap[val] || 0;
    document.getElementById('reg_fee').value = fee || '';
    const card    = document.getElementById('feePreviewCard');
    const display = document.getElementById('feeDisplay');
    if (fee) {
        display.textContent = '₱ ' + fee.toLocaleString('en-PH', {minimumFractionDigits:2});
        card.style.display = 'block';
    } else {
        card.style.display = 'none';
    }
}

document.getElementById('lvl').addEventListener('change', updateRegistrationFee);

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('phonenumber').addEventListener('input', function () {
        this.value = this.value.replace(/\D/g,'');
    });
    document.getElementById('resetFormBtn').addEventListener('click', function () {
        setTimeout(function () {
            document.getElementById('section').innerHTML =
                '<option value="" selected disabled>— Pick grade first —</option>';
            document.getElementById('strandContainer').style.display = 'none';
            document.getElementById('feePreviewCard').style.display  = 'none';
            document.querySelectorAll('.sf-field-error').forEach(el => el.textContent = '');
        }, 10);
    });
});

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

function validateIdNum(el) { el.value = el.value.replace(/[^0-9]/g,''); }
function validateName(el)   { el.value = el.value.replace(/[^A-Za-z\s.]/g,''); }
function validateSchoolYear(el) {
    const v = el.value;
    const err = document.querySelector('.ay_error');
    if (/^\d{4}-\d{4}$/.test(v)) {
        const [s,e] = v.split('-').map(Number);
        err.textContent = (s < 2023 || e <= s) ? 'End year must be after start year (min 2023).' : '';
    }
}

$('#save-student-form').on('submit', function (e) {
    e.preventDefault();
    const form = this;
    const btn  = document.getElementById('submitStudentBtn');
    btn.disabled = true;
    btn.querySelector('.submit-label').classList.add('d-none');
    btn.querySelector('.submit-spinner').classList.remove('d-none');

    $.ajax({
        url: $(form).attr('action'),
        method: $(form).attr('method'),
        data: new FormData(form),
        processData:false, dataType:'json', contentType:false,
        beforeSend: function () { $(form).find('.sf-field-error').text(''); },
        success: function (data) {
            btn.disabled = false;
            btn.querySelector('.submit-label').classList.remove('d-none');
            btn.querySelector('.submit-spinner').classList.add('d-none');
            if (data.code == 0) {
                toastr.error('Please check the highlighted fields and try again.');
                $.each(data.error, function (k,v) {
                    $(form).find('span.' + k + '_error').text(v[0]);
                });
            } else {
                form.reset();
                document.getElementById('section').innerHTML =
                    '<option value="" selected disabled>— Pick grade first —</option>';
                document.getElementById('strandContainer').style.display = 'none';
                document.getElementById('feePreviewCard').style.display  = 'none';
                toastr.success(data.msg + ' · Now open the Cashier Form to process payment.');
            }
        },
        error: function () {
            btn.disabled = false;
            btn.querySelector('.submit-label').classList.remove('d-none');
            btn.querySelector('.submit-spinner').classList.add('d-none');
            toastr.error('Server error. Please try again.');
        }
    });
});
</script>
@endsection
