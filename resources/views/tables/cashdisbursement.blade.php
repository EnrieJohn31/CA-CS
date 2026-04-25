@extends('home.index')
@section('content')

<style>
/* ── Shared page components ── */
.pg-hero {
    border-radius: var(--ct-radius); padding: 24px 28px 20px;
    margin-bottom: 20px; position:relative; overflow:hidden; color:#fff;
}
.pg-hero::after {
    content:''; position:absolute; right:-40px; top:-40px;
    width:180px; height:180px; border-radius:50%;
    background:rgba(255,255,255,.07); pointer-events:none;
}
.pg-hero__eyebrow {
    display:inline-flex; align-items:center; gap:7px;
    background:rgba(255,255,255,.18); border-radius:999px;
    padding:4px 12px; font-size:.7rem; font-weight:700;
    letter-spacing:.5px; text-transform:uppercase; margin-bottom:10px;
}
.pg-hero__title { font-size:1.45rem; font-weight:800; letter-spacing:-.4px; margin-bottom:3px; }
.pg-hero__sub   { font-size:.82rem; opacity:.85; }

.pg-card {
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius); box-shadow:var(--ct-shadow);
    overflow:hidden; margin-bottom:16px;
}
.pg-card__header {
    display:flex; align-items:center; gap:12px;
    padding:14px 20px; background:var(--ct-surface-alt);
    border-bottom:1px solid var(--ct-border);
}
.pg-card__icon {
    width:36px; height:36px; border-radius:9px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center; font-size:.9rem;
}
.pg-card__title { font-size:.88rem; font-weight:700; color:var(--ct-text); }
.pg-card__sub   { font-size:.72rem; color:var(--ct-text-muted); margin-top:1px; }
.pg-card__body  { padding:20px; }

.pg-label {
    display:block; font-size:.75rem; font-weight:600;
    color:var(--ct-text); margin-bottom:5px; letter-spacing:.1px;
}
.pg-label i { margin-right:5px; opacity:.7; }

/* Expense input tile */
.exp-tile {
    background:var(--ct-surface-alt); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius-sm); padding:14px 16px;
}
.exp-tile__label {
    font-size:.72rem; font-weight:700; text-transform:uppercase;
    letter-spacing:.5px; color:var(--ct-text-muted); margin-bottom:8px;
    display:flex; align-items:center; gap:6px;
}
.exp-tile__label i { font-size:.75rem; }

/* Total box */
.cd-total-box {
    background:linear-gradient(135deg,rgba(239,68,68,.08),rgba(220,38,38,.04));
    border:1px solid rgba(239,68,68,.2); border-radius:var(--ct-radius);
    padding:16px 20px; display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:8px; margin-top:4px;
}
.cd-total-box__label { font-size:.78rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; color:var(--ct-text-muted); }
.cd-total-box__value { font-size:1.6rem; font-weight:800; letter-spacing:-1px; color:#ef4444; font-variant-numeric:tabular-nums; }

/* Print doc */
#printable_div_id {
    background:#fff; color:#000;
    padding:32px 40px;
    font-family:'Segoe UI','Source Sans Pro',Arial,sans-serif;
    max-width:860px; margin:0 auto;
}
.cd-doc-header { text-align:center; margin-bottom:20px; }
.cd-doc-header img { max-width:100%; height:auto; max-height:130px; object-fit:contain; }
.cd-doc-title { text-align:center; margin:20px 0 6px; font-size:1.1rem; font-weight:800; text-transform:uppercase; color:#111; letter-spacing:.4px; }
.cd-doc-period-wrap { text-align:center; margin-bottom:24px; }
.cd-doc-period { font-size:.8rem; color:#555; padding:6px 18px; background:#fef2f2; border-radius:999px; border:1px solid #fecaca; display:inline-block; }
.cd-table { width:100%; border-collapse:collapse; font-size:.85rem; margin-bottom:24px; }
.cd-table th { background:#7f1d1d; color:#fff; padding:10px 14px; font-weight:700; text-align:left; font-size:.75rem; text-transform:uppercase; }
.cd-table th.amt { text-align:right; }
.cd-table td { padding:9px 14px; border-bottom:1px solid #e5e7eb; color:#1f2937; }
.cd-table td.amt { text-align:right; font-weight:600; font-variant-numeric:tabular-nums; }
.cd-table .begin-row td { background:#fef2f2; font-weight:700; }
.cd-table .total-row td { background:#7f1d1d; color:#fff; font-weight:800; font-size:.9rem; padding:12px 14px; }
.cd-table .total-row td.amt { color:#fca5a5; font-size:1rem; }
.cd-sigs { display:flex; justify-content:space-around; flex-wrap:wrap; gap:20px; margin-top:36px; }
.cd-sig { text-align:center; min-width:160px; }
.cd-sig__lbl { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.4px; color:#7f1d1d; margin-bottom:28px; }
.cd-sig__line { width:190px; height:1px; background:#374151; margin:0 auto 5px; }
.cd-sig__name { font-size:.8rem; font-weight:700; color:#111; }
.cd-sig__role { font-size:.7rem; color:#555; }

/* Toolbar */
.pg-toolbar {
    display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:10px; padding:14px 20px;
    background:var(--ct-surface-alt); border-bottom:1px solid var(--ct-border);
}
.pg-toolbar__title { font-size:.82rem; font-weight:700; color:var(--ct-text); display:flex; align-items:center; gap:8px; }
.pg-toolbar__dot { width:9px; height:9px; border-radius:50%; background:#ef4444; box-shadow:0 0 0 3px rgba(239,68,68,.2); flex-shrink:0; }

.btn-cd-gen {
    height:40px; padding:0 20px; font-weight:700; font-size:.85rem;
    background:linear-gradient(135deg,#dc2626,#ef4444) !important;
    border:none !important; color:#fff !important;
    box-shadow:0 4px 12px rgba(239,68,68,.3) !important;
    border-radius:var(--ct-radius-sm) !important;
    transition:box-shadow .15s, transform .15s !important;
}
.btn-cd-gen:hover { box-shadow:0 6px 18px rgba(239,68,68,.4) !important; transform:translateY(-1px) !important; }
.btn-cd-print {
    height:40px; padding:0 18px; font-weight:600; font-size:.85rem;
    background:var(--ct-surface-alt) !important;
    border:1px solid var(--ct-border) !important; color:var(--ct-text) !important;
    border-radius:var(--ct-radius-sm) !important;
    transition:background .15s, border-color .15s !important;
}
.btn-cd-print:hover { background:rgba(239,68,68,.06) !important; border-color:#ef4444 !important; color:#ef4444 !important; }

@media print {
    .main-sidebar,.main-header,.main-footer,.pg-hero,.pg-card,.pg-toolbar { display:none !important; }
    html,body { margin:0 !important; padding:0 !important; background:#fff !important; }
    .content-wrapper,.wrapper,.content,.container-fluid { margin:0 !important; padding:0 !important; }
    #printable_div_id { position:static !important; width:100% !important; max-width:100% !important; padding:18mm 18mm 14mm !important; box-shadow:none !important; border:none !important; }
    .cd-table th { background:#7f1d1d !important; color:#fff !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .cd-table .total-row td { background:#7f1d1d !important; color:#fff !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .cd-table .begin-row td { background:#fef2f2 !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    @page { margin:14mm; size:A4; }
}
</style>

<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3">

    {{-- Hero --}}
    <div class="pg-hero" style="background:linear-gradient(135deg,#b91c1c 0%,#dc2626 50%,#f97316 100%);">
        <div class="pg-hero__eyebrow"><i class="fas fa-money-bill-wave"></i> Data · Cash Disbursement</div>
        <div class="pg-hero__title">Cash Disbursement Statement</div>
        <div class="pg-hero__sub">Enter disbursement amounts for a period, generate the statement, and print for records.</div>
    </div>

    {{-- Filter + Expense Form --}}
    <div class="pg-card">
        <div class="pg-card__header">
            <div class="pg-card__icon" style="background:rgba(239,68,68,.12);color:#ef4444;"><i class="fas fa-filter"></i></div>
            <div>
                <div class="pg-card__title">Period &amp; Expense Entry</div>
                <div class="pg-card__sub">Select a date range and enter the disbursement amounts, then click Generate</div>
            </div>
        </div>
        <div class="pg-card__body">
            <form method="POST" action="{{ route('cashless.total') }}" id="cdForm">
                @csrf

                {{-- Date Range --}}
                <div class="row mb-4">
                    <div class="col-md-4 col-sm-6 mb-3">
                        <label class="pg-label" for="startdate"><i class="fas fa-calendar-plus" style="color:#ef4444;"></i>Start Date</label>
                        <input type="date" name="startdate" id="startdate" class="form-control" value="{{ $start_date }}" required>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <label class="pg-label" for="enddate"><i class="fas fa-calendar-check" style="color:#ef4444;"></i>End Date</label>
                        <input type="date" name="enddate" id="enddate" class="form-control" value="{{ $end_date }}" required>
                    </div>
                </div>

                {{-- Expense tiles --}}
                <div style="font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.8px;color:var(--ct-text-muted);margin-bottom:12px;display:flex;align-items:center;gap:8px;">
                    <i class="fas fa-minus-circle" style="color:#ef4444;"></i> Disbursement Items
                    <span style="flex:1;height:1px;background:var(--ct-border);display:block;"></span>
                </div>
                <div class="row g-3">
                    @php
                    $expFields = [
                        ['id'=>'sal_fee',     'name'=>'sal_fee',     'label'=>'Salaries',         'icon'=>'fa-users',       'color'=>'#ef4444', 'val'=>$sal_fee],
                        ['id'=>'pagibig_fee', 'name'=>'pagibig_fee', 'label'=>'Pag-Ibig',         'icon'=>'fa-home',        'color'=>'#f97316', 'val'=>$pagibig_fee],
                        ['id'=>'sss_fee',     'name'=>'sss_fee',     'label'=>'SSS',              'icon'=>'fa-shield-alt',  'color'=>'#dc2626', 'val'=>$sss_fee],
                        ['id'=>'ew_fee',      'name'=>'ew_fee',      'label'=>'Electric &amp; Water','icon'=>'fa-bolt',    'color'=>'#f59e0b', 'val'=>$ew_fee],
                        ['id'=>'seminar_fee', 'name'=>'seminar_fee', 'label'=>'Seminar',          'icon'=>'fa-chalkboard', 'color'=>'#8b5cf6', 'val'=>$seminar_fee],
                        ['id'=>'payable_fee', 'name'=>'payable_fee', 'label'=>'Payables',         'icon'=>'fa-receipt',    'color'=>'#06b6d4', 'val'=>$payable_fee],
                    ];
                    @endphp
                    @foreach($expFields as $f)
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                        <div class="exp-tile">
                            <div class="exp-tile__label">
                                <i class="fas {{ $f['icon'] }}" style="color:{{ $f['color'] }};"></i>
                                {!! $f['label'] !!}
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="font-weight:700;">₱</span>
                                </div>
                                <input type="text" id="{{ $f['id'] }}" name="{{ $f['name'] }}"
                                       class="form-control" style="text-align:right;font-variant-numeric:tabular-nums;"
                                       value="{{ trim($f['val']) }}" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Total display --}}
                <div class="cd-total-box mt-3">
                    <div>
                        <div class="cd-total-box__label"><i class="fas fa-calculator mr-1"></i> Total Disbursement</div>
                        <div style="font-size:.75rem;color:var(--ct-text-muted);margin-top:2px;">Sum of all expense fields above</div>
                    </div>
                    <div class="cd-total-box__value" id="liveTotalDisb">₱ {{ number_format((float)$total_cashdisbursement, 2) }}</div>
                </div>

                <div class="d-flex mt-4" style="gap:10px;flex-wrap:wrap;">
                    <button type="submit" class="btn btn-cd-gen" id="cdGenBtn">
                        <i class="fas fa-sync-alt mr-2"></i>Generate Statement
                    </button>
                    <button type="button" class="btn btn-cd-print" onclick="window.print()">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Report Preview --}}
    <div class="pg-card">
        <div class="pg-toolbar">
            <div class="pg-toolbar__title">
                <span class="pg-toolbar__dot"></span>
                Disbursement Statement Preview
                <span style="font-size:.72rem;color:var(--ct-text-muted);font-weight:500;">
                    @if($start_date && $end_date) {{ $start_date }} — {{ $end_date }} @endif
                </span>
            </div>
            <button class="btn btn-cd-print btn-sm" onclick="window.print()">
                <i class="fas fa-print mr-1"></i> Print / Save PDF
            </button>
        </div>

        <div id="printable_div_id" style="padding:0;">
            <div class="cd-doc-header">
                <img src="{{ asset('assets/img/system/12.png') }}" alt="Carmel Academy">
            </div>
            <div class="cd-doc-title">Cash Disbursement Statement</div>
            <div class="cd-doc-period-wrap">
                <span class="cd-doc-period">
                    <i class="fas fa-calendar-alt" style="margin-right:5px;color:#dc2626;"></i>
                    Period: <strong>{{ $start_date ?? '—' }}</strong> to <strong>{{ $end_date ?? '—' }}</strong>
                </span>
            </div>

            <table class="cd-table">
                <thead>
                    <tr>
                        <th style="width:70%;">Description</th>
                        <th class="amt" style="width:30%;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="begin-row">
                        <td><strong>Cash Beginning (Total Collection)</strong></td>
                        <td class="amt">₱ {{ number_format((float)$total_sum, 2) }}</td>
                    </tr>
                    <tr><td>Salaries</td>       <td class="amt">₱ {{ number_format((float)$sal_fee, 2) }}</td></tr>
                    <tr><td>Pag-Ibig</td>       <td class="amt">₱ {{ number_format((float)$pagibig_fee, 2) }}</td></tr>
                    <tr><td>SSS</td>            <td class="amt">₱ {{ number_format((float)$sss_fee, 2) }}</td></tr>
                    <tr><td>Electric &amp; Water</td><td class="amt">₱ {{ number_format((float)$ew_fee, 2) }}</td></tr>
                    <tr><td>Seminar</td>        <td class="amt">₱ {{ number_format((float)$seminar_fee, 2) }}</td></tr>
                    <tr><td>Payables</td>       <td class="amt">₱ {{ number_format((float)$payable_fee, 2) }}</td></tr>
                    <tr class="total-row">
                        <td><strong>TOTAL CASH DISBURSEMENT</strong></td>
                        <td class="amt"><strong>₱ {{ number_format((float)$total_cashdisbursement, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="cd-sigs">
                <div class="cd-sig">
                    <div class="cd-sig__lbl">Prepared By</div>
                    <div class="cd-sig__line"></div>
                    <div class="cd-sig__name">JENNIFER S. DISPO</div>
                    <div class="cd-sig__role">Cashier</div>
                </div>
                <div class="cd-sig">
                    <div class="cd-sig__lbl">Verified By</div>
                    <div class="cd-sig__line"></div>
                    <div class="cd-sig__name">EMETERIO C. JAVINEZ JR., LPT, MAED</div>
                    <div class="cd-sig__role">Principal</div>
                </div>
                <div class="cd-sig">
                    <div class="cd-sig__lbl">Approved By</div>
                    <div class="cd-sig__line"></div>
                    <div class="cd-sig__name">REV. FR. AGERIO V. PAÑA</div>
                    <div class="cd-sig__role">Director</div>
                </div>
            </div>
        </div>
    </div>

</div>
</section>

<script>
function allowOnlyNumbersWithDecimal(id) {
    document.getElementById(id).addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9.]/g,'').replace(/^0+(?=\d)/,'');
        if (this.value.split('.').length > 2) this.value = this.value.slice(0, this.value.lastIndexOf('.'));
        updateLiveTotal();
    });
}
['sal_fee','pagibig_fee','sss_fee','ew_fee','seminar_fee','payable_fee'].forEach(allowOnlyNumbersWithDecimal);

function updateLiveTotal() {
    var ids = ['sal_fee','pagibig_fee','sss_fee','ew_fee','seminar_fee','payable_fee'];
    var total = ids.reduce(function(s,id){ return s + (parseFloat(document.getElementById(id).value)||0); }, 0);
    document.getElementById('liveTotalDisb').textContent = '₱ ' + total.toLocaleString('en-PH',{minimumFractionDigits:2,maximumFractionDigits:2});
}

document.getElementById('cdGenBtn').addEventListener('click', function () {
    this.disabled = true;
    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating…';
});
</script>
@endsection
