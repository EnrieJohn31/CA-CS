@extends('home.index')
@section('content')

<style>
/* ══════════════════════════════════
   Reports page — screen styles
   ══════════════════════════════════ */

/* Hero */
.rp-hero {
    background: linear-gradient(135deg,#7c3aed 0%,#4f46e5 50%,#06b6d4 100%);
    border-radius: var(--ct-radius); padding: 24px 28px 20px;
    margin-bottom: 20px; position:relative; overflow:hidden; color:#fff;
}
.rp-hero::after {
    content:''; position:absolute; right:-40px; top:-40px;
    width:180px; height:180px; border-radius:50%;
    background:rgba(255,255,255,.07); pointer-events:none;
}
.rp-hero__eyebrow {
    display:inline-flex; align-items:center; gap:7px;
    background:rgba(255,255,255,.18); border-radius:999px;
    padding:4px 12px; font-size:.7rem; font-weight:700;
    letter-spacing:.5px; text-transform:uppercase; margin-bottom:10px;
}
.rp-hero__title { font-size:1.45rem; font-weight:800; letter-spacing:-.4px; margin-bottom:3px; }
.rp-hero__sub   { font-size:.82rem; opacity:.85; }

/* Filter card */
.rp-filter {
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius); box-shadow:var(--ct-shadow);
    margin-bottom:20px; overflow:hidden;
}
.rp-filter__header {
    display:flex; align-items:center; gap:12px;
    padding:14px 20px; background:var(--ct-surface-alt);
    border-bottom:1px solid var(--ct-border);
}
.rp-filter__icon {
    width:36px; height:36px; border-radius:9px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center; font-size:.9rem;
    background:rgba(124,58,237,.12); color:#7c3aed;
}
.rp-filter__title { font-size:.88rem; font-weight:700; color:var(--ct-text); }
.rp-filter__sub   { font-size:.72rem; color:var(--ct-text-muted); margin-top:1px; }
.rp-filter__body  { padding:20px; }

.rp-date-label {
    display:block; font-size:.76rem; font-weight:600;
    color:var(--ct-text); margin-bottom:5px; letter-spacing:.1px;
}
.rp-date-label i { color:#7c3aed; margin-right:5px; }
input[type="date"].form-control { height:42px; font-size:.88rem; }

.btn-generate {
    height:42px; padding:0 22px; font-weight:700; font-size:.88rem;
    background:linear-gradient(135deg,#7c3aed,#4f46e5) !important;
    border:none !important; color:#fff !important;
    box-shadow:0 4px 14px rgba(124,58,237,.3) !important;
    transition:box-shadow .15s,transform .15s !important;
    border-radius:var(--ct-radius-sm) !important;
}
.btn-generate:hover { box-shadow:0 6px 20px rgba(124,58,237,.4) !important; transform:translateY(-1px) !important; }

.btn-print-rp {
    height:42px; padding:0 22px; font-weight:700; font-size:.88rem;
    background:var(--ct-surface-alt) !important;
    border:1px solid var(--ct-border) !important;
    color:var(--ct-text) !important;
    border-radius:var(--ct-radius-sm) !important;
    transition:background .15s, border-color .15s !important;
}
.btn-print-rp:hover {
    background:rgba(124,58,237,.06) !important;
    border-color:#7c3aed !important;
    color:#7c3aed !important;
}

/* Quick-stat strip */
.rp-stats {
    display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px;
}
.rp-stat {
    flex:1 1 140px;
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius); box-shadow:var(--ct-shadow);
    padding:16px 18px;
}
.rp-stat__label {
    font-size:.68rem; font-weight:700; text-transform:uppercase;
    letter-spacing:.5px; color:var(--ct-text-muted); margin-bottom:6px;
    display:flex; align-items:center; gap:6px;
}
.rp-stat__value {
    font-size:1.35rem; font-weight:800; letter-spacing:-.5px;
    font-variant-numeric:tabular-nums; color:var(--ct-text);
}

/* Report preview card */
.rp-preview {
    background:var(--ct-surface); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius); box-shadow:var(--ct-shadow);
    overflow:hidden;
}
.rp-preview__toolbar {
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;
    gap:10px; padding:14px 20px;
    background:var(--ct-surface-alt); border-bottom:1px solid var(--ct-border);
}
.rp-preview__toolbar-left {
    display:flex; align-items:center; gap:10px;
}
.rp-preview__dot { width:10px;height:10px;border-radius:50%; flex-shrink:0; }
.rp-preview__label { font-size:.82rem; font-weight:700; color:var(--ct-text); }
.rp-preview__period { font-size:.75rem; color:var(--ct-text-muted); margin-left:4px; }

/* ══════════════════════════════════
   Printable document styles (screen)
   ══════════════════════════════════ */
#printable_div_id {
    background:#fff;
    color:#000;
    padding:32px 40px;
    font-family:'Segoe UI','Source Sans Pro',Arial,sans-serif;
    max-width:900px;
    margin:0 auto;
}
.rp-doc-header { text-align:center; margin-bottom:24px; }
.rp-doc-header img { max-width:100%; height:auto; max-height:140px; object-fit:contain; }

.rp-doc-title   { text-align:center; margin:24px 0 4px; }
.rp-doc-title h2 {
    font-size:1.1rem; font-weight:800; text-transform:uppercase;
    color:#111; letter-spacing:.5px; margin:0;
}
.rp-doc-title p  { font-size:.82rem; color:#555; margin:4px 0 0; }

.rp-doc-period {
    text-align:center; font-size:.8rem; color:#444;
    margin-bottom:28px;
    padding:8px 20px;
    display:inline-block;
    background:#f5f3ff;
    border-radius:999px;
    border:1px solid #ede9fe;
}
.rp-doc-period-wrap { text-align:center; margin-bottom:28px; }

/* Income table */
.rp-income-table {
    width:100%; border-collapse:collapse;
    font-size:.82rem; margin-bottom:24px;
}
.rp-income-table th {
    background:#1e1b4b; color:#fff;
    padding:10px 14px; font-weight:700;
    text-align:left; font-size:.75rem;
    text-transform:uppercase; letter-spacing:.5px;
}
.rp-income-table th.amt-col { text-align:right; }
.rp-income-table td {
    padding:9px 14px; border-bottom:1px solid #e5e7eb;
    color:#1f2937; vertical-align:middle;
}
.rp-income-table td.amt-col {
    text-align:right; font-weight:600;
    font-variant-numeric:tabular-nums; color:#111;
}
.rp-income-table tbody tr:last-child td { border-bottom:none; }
.rp-income-table tbody tr:hover td { background:#faf5ff; }
.rp-income-table .section-row td {
    background:#f5f3ff; font-weight:700; font-size:.72rem;
    text-transform:uppercase; letter-spacing:.5px; color:#7c3aed;
    padding:6px 14px; border-bottom:1px solid #ede9fe;
}
.rp-income-table .total-row td {
    background:#1e1b4b; color:#fff; font-weight:800;
    font-size:.9rem; padding:12px 14px;
    border-top:2px solid #4f46e5;
}
.rp-income-table .total-row td.amt-col { color:#a5b4fc; font-size:1rem; }

/* Signature block */
.rp-signatures {
    display:flex; justify-content:space-around;
    flex-wrap:wrap; gap:20px; margin-top:36px;
}
.rp-sig {
    text-align:center; min-width:180px;
}
.rp-sig__line {
    width:200px; height:1px; background:#374151;
    margin:0 auto 6px;
}
.rp-sig__name  { font-size:.82rem; font-weight:700; color:#111; }
.rp-sig__title { font-size:.72rem; color:#555; margin-top:2px; }
.rp-sig__label { font-size:.7rem; font-weight:700; color:#7c3aed; text-transform:uppercase; letter-spacing:.4px; margin-bottom:32px; }

/* ══════════════════════════════════
   PRINT media — clean document
   ══════════════════════════════════ */
@media print {
    /* Hide everything */
    .main-sidebar, .main-header, .main-footer,
    .app-sidebar, .app-topbar,
    .rp-hero, .rp-filter, .rp-stats,
    .rp-preview__toolbar,
    .btn, .breadcrumb, .content-header { display:none !important; }

    /* Full-page doc */
    html, body { margin:0 !important; padding:0 !important; background:#fff !important; }
    .content-wrapper, .wrapper, .content, .container-fluid { margin:0 !important; padding:0 !important; }
    #printable_div_id {
        position:static !important; width:100% !important; max-width:100% !important;
        padding:20mm 20mm 16mm !important;
        box-shadow:none !important; border:none !important;
        font-size:10pt !important;
    }
    .rp-preview { box-shadow:none !important; border:none !important; background:#fff !important; }
    .rp-income-table th { background:#1e1b4b !important; color:#fff !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .rp-income-table .section-row td { background:#f5f3ff !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .rp-income-table .total-row td { background:#1e1b4b !important; color:#fff !important; -webkit-print-color-adjust:exact; print-color-adjust:exact; }
    .rp-income-table tbody tr:hover td { background:transparent !important; }
    @page { margin:15mm; size:A4; }
}
</style>

<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3">

    {{-- ── Hero ── --}}
    <div class="rp-hero">
        <div class="rp-hero__eyebrow"><i class="fas fa-chart-pie"></i> Financial Reports</div>
        <div class="rp-hero__title">Income Statement Report</div>
        <div class="rp-hero__sub">Generate a full cash collection summary for any date range and print or save as PDF.</div>
    </div>

    {{-- ── Filter card ── --}}
    <div class="rp-filter">
        <div class="rp-filter__header">
            <div class="rp-filter__icon"><i class="fas fa-filter"></i></div>
            <div>
                <div class="rp-filter__title">Report Filter</div>
                <div class="rp-filter__sub">Select a date range then click Generate</div>
            </div>
        </div>
        <div class="rp-filter__body">
            <form method="POST" action="{{ route('forms.total') }}" id="reportForm">
                @csrf
                <div class="row align-items-end">

                    <div class="col-lg-4 col-md-5 col-sm-6 mb-3">
                        <label class="rp-date-label" for="startdate">
                            <i class="fas fa-calendar-plus"></i> Start Date
                        </label>
                        <input type="date" name="startdate" id="startdate"
                               class="form-control" required
                               value="{{ request('startdate') ?? '' }}">
                    </div>

                    <div class="col-lg-4 col-md-5 col-sm-6 mb-3">
                        <label class="rp-date-label" for="enddate">
                            <i class="fas fa-calendar-check"></i> End Date
                        </label>
                        <input type="date" name="enddate" id="enddate"
                               class="form-control" required
                               value="{{ request('enddate') ?? '' }}">
                    </div>

                    <div class="col-lg-4 col-md-2 col-sm-12 mb-3">
                        <div class="d-flex" style="gap:8px;flex-wrap:wrap;">
                            <button type="submit" class="btn btn-generate" id="generateBtn">
                                <i class="fas fa-sync-alt mr-2"></i>Generate
                            </button>
                            <button type="button" class="btn btn-print-rp" onclick="printReport()" title="Print report">
                                <i class="fas fa-print mr-2"></i>Print
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- ── Quick stats ── --}}
    @php
        $fees = [
            'tui_sum'       => $tui_sum       ?? 0,
            'reg_sum'       => $reg_sum       ?? 0,
            'uni_sum'       => $uni_sum       ?? 0,
            'Medical'       => $Medical       ?? 0,
            'Insurance'     => $Insurance     ?? 0,
            'Death'         => $Death         ?? 0,
            'Library'       => $Library       ?? 0,
            'School_Pub'    => $School_Pub    ?? 0,
            'Athlet'        => $Athlet        ?? 0,
            'BACS'          => $BACS          ?? 0,
            'Book'          => $Book          ?? 0,
            'Laboratory'    => $Laboratory    ?? 0,
            'StudentID'     => $StudentID     ?? 0,
            'Passbook'      => $Passbook      ?? 0,
            'Handbook'      => $Handbook      ?? 0,
            'Dental'        => $Dental        ?? 0,
            'Completers_Fee'=> $Completers_Fee ?? 0,
            'graduation'    => $graduation    ?? 0,
            'oth_sum'       => $oth_sum       ?? 0,
        ];
        $totalSum   = $total_sum ?? 0;
        $gradeTotal = ($fees['tui_sum'] + $fees['reg_sum'] + $fees['uni_sum']);
        $annualTotal= $totalSum - $gradeTotal - $fees['oth_sum'];
    @endphp
    <div class="rp-stats">
        <div class="rp-stat">
            <div class="rp-stat__label"><i class="fas fa-peso-sign" style="color:#7c3aed;"></i> Total Collection</div>
            <div class="rp-stat__value" style="color:#7c3aed;">₱ {{ number_format((float)$totalSum,2) }}</div>
        </div>
        <div class="rp-stat">
            <div class="rp-stat__label"><i class="fas fa-layer-group" style="color:#4f46e5;"></i> Grade Fees</div>
            <div class="rp-stat__value">₱ {{ number_format((float)$gradeTotal,2) }}</div>
        </div>
        <div class="rp-stat">
            <div class="rp-stat__label"><i class="fas fa-calendar-alt" style="color:#06b6d4;"></i> Annual Fees</div>
            <div class="rp-stat__value">₱ {{ number_format((float)$annualTotal,2) }}</div>
        </div>
        <div class="rp-stat">
            <div class="rp-stat__label"><i class="fas fa-coins" style="color:#10b981;"></i> Other Income</div>
            <div class="rp-stat__value">₱ {{ number_format((float)$fees['oth_sum'],2) }}</div>
        </div>
    </div>

    {{-- ── Report preview card ── --}}
    <div class="rp-preview">
        <div class="rp-preview__toolbar">
            <div class="rp-preview__toolbar-left">
                <span class="rp-preview__dot" style="background:#10b981;box-shadow:0 0 0 3px rgba(16,185,129,.2);"></span>
                <span class="rp-preview__label">Income Statement Preview</span>
                <span class="rp-preview__period">
                    @if(isset($start_date) && isset($end_date))
                        {{ $start_date }} — {{ $end_date }}
                    @else
                        Generate a report to view the income statement
                    @endif
                </span>
            </div>
            <button type="button" class="btn btn-print-rp btn-sm" onclick="printReport()">
                <i class="fas fa-print mr-1"></i> Print / Save PDF
            </button>
        </div>

        {{-- ══ PRINTABLE DOCUMENT ══ --}}
        <div id="printable_div_id">

            {{-- Letterhead --}}
            <div class="rp-doc-header">
                <img src="{{ asset('assets/img/system/heading.png') }}" alt="Carmel Academy Letterhead">
            </div>

            {{-- Report title --}}
            <div class="rp-doc-title">
                <h2>Cash Collection Income Statement</h2>
            </div>
            <div class="rp-doc-period-wrap">
                <span class="rp-doc-period">
                    <i class="fas fa-calendar-alt" style="margin-right:6px;color:#7c3aed;"></i>
                    Period: <strong>{{ $start_date ?? '—' }}</strong> &nbsp;to&nbsp; <strong>{{ $end_date ?? '—' }}</strong>
                </span>
            </div>

            {{-- Income table --}}
            <table class="rp-income-table">
                <thead>
                    <tr>
                        <th style="width:70%;">Description</th>
                        <th class="amt-col" style="width:30%;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Grade Fees --}}
                    <tr class="section-row"><td colspan="2">Grade Level Fees</td></tr>
                    <tr>
                        <td>Tuition Fee</td>
                        <td class="amt-col">₱ {{ number_format((float)$fees['tui_sum'],2) }}</td>
                    </tr>
                    <tr>
                        <td>Registration / Enrollment Fee</td>
                        <td class="amt-col">₱ {{ number_format((float)$fees['reg_sum'],2) }}</td>
                    </tr>
                    <tr>
                        <td>Uniform Fee</td>
                        <td class="amt-col">₱ {{ number_format((float)$fees['uni_sum'],2) }}</td>
                    </tr>

                    {{-- Annual Fees --}}
                    <tr class="section-row"><td colspan="2">Annual Fees</td></tr>
                    <tr><td>Medical Fee</td>         <td class="amt-col">₱ {{ number_format((float)$fees['Medical'],2) }}</td></tr>
                    <tr><td>Insurance Fee</td>       <td class="amt-col">₱ {{ number_format((float)$fees['Insurance'],2) }}</td></tr>
                    <tr><td>Death Aid Fee</td>       <td class="amt-col">₱ {{ number_format((float)$fees['Death'],2) }}</td></tr>
                    <tr><td>Library Fee</td>         <td class="amt-col">₱ {{ number_format((float)$fees['Library'],2) }}</td></tr>
                    <tr><td>School Publication Fee</td><td class="amt-col">₱ {{ number_format((float)$fees['School_Pub'],2) }}</td></tr>
                    <tr><td>Athlete Fee</td>         <td class="amt-col">₱ {{ number_format((float)$fees['Athlet'],2) }}</td></tr>
                    <tr><td>BACS Fee</td>            <td class="amt-col">₱ {{ number_format((float)$fees['BACS'],2) }}</td></tr>
                    <tr><td>Book Fee</td>            <td class="amt-col">₱ {{ number_format((float)$fees['Book'],2) }}</td></tr>
                    <tr><td>Laboratory Fee</td>      <td class="amt-col">₱ {{ number_format((float)$fees['Laboratory'],2) }}</td></tr>
                    <tr><td>Student ID Fee</td>      <td class="amt-col">₱ {{ number_format((float)$fees['StudentID'],2) }}</td></tr>
                    <tr><td>Passbook Fee</td>        <td class="amt-col">₱ {{ number_format((float)$fees['Passbook'],2) }}</td></tr>
                    <tr><td>Handbook Fee</td>        <td class="amt-col">₱ {{ number_format((float)$fees['Handbook'],2) }}</td></tr>
                    <tr><td>Dental Fee</td>          <td class="amt-col">₱ {{ number_format((float)$fees['Dental'],2) }}</td></tr>

                    {{-- Milestone --}}
                    <tr class="section-row"><td colspan="2">Milestone Fees</td></tr>
                    <tr><td>Completers Fee</td>      <td class="amt-col">₱ {{ number_format((float)$fees['Completers_Fee'],2) }}</td></tr>
                    <tr><td>Graduation Fee</td>      <td class="amt-col">₱ {{ number_format((float)$fees['graduation'],2) }}</td></tr>

                    {{-- Other --}}
                    <tr class="section-row"><td colspan="2">Other Income</td></tr>
                    <tr><td>Other Fees</td>          <td class="amt-col">₱ {{ number_format((float)$fees['oth_sum'],2) }}</td></tr>

                    {{-- Total --}}
                    <tr class="total-row">
                        <td><strong>TOTAL CASH COLLECTION</strong></td>
                        <td class="amt-col"><strong>₱ {{ number_format((float)$totalSum,2) }}</strong></td>
                    </tr>
                </tbody>
            </table>

            {{-- Signature block --}}
            <div class="rp-signatures">
                <div class="rp-sig">
                    <div class="rp-sig__label">Prepared By</div>
                    <div class="rp-sig__line"></div>
                    <div class="rp-sig__name">JENNIFER S. DISPO</div>
                    <div class="rp-sig__title">Cashier</div>
                </div>
                <div class="rp-sig">
                    <div class="rp-sig__label">Verified By</div>
                    <div class="rp-sig__line"></div>
                    <div class="rp-sig__name">EMETERIO C. JAVINEZ JR., LPT, MAED</div>
                    <div class="rp-sig__title">Principal</div>
                </div>
                <div class="rp-sig">
                    <div class="rp-sig__label">Approved By</div>
                    <div class="rp-sig__line"></div>
                    <div class="rp-sig__name">REV. FR. AGERIO V. PAÑA</div>
                    <div class="rp-sig__title">Director</div>
                </div>
            </div>

        </div>{{-- /#printable_div_id --}}
    </div>{{-- /.rp-preview --}}

</div>
</section>

<script>
function printReport() {
    window.print();
}

/* Auto-set end date max to today */
document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('enddate').max   = today;
    document.getElementById('startdate').max = today;

    /* Validate start ≤ end */
    document.getElementById('startdate').addEventListener('change', function () {
        const end = document.getElementById('enddate');
        if (end.value && this.value > end.value) end.value = this.value;
        end.min = this.value;
    });

    /* Generate button spinner */
    document.getElementById('reportForm').addEventListener('submit', function () {
        const btn = document.getElementById('generateBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Generating…';
    });
});
</script>
@endsection
