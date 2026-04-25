@extends('home.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3 pb-4">

    {{-- Hero --}}
    <div class="pg-hero" style="background:linear-gradient(135deg,#0891b2 0%,#06b6d4 55%,#10b981 100%);margin-bottom:20px;">
        <div class="pg-hero__eyebrow"><i class="fas fa-file-upload"></i> Forms · Batch Upload</div>
        <div class="pg-hero__title">Student Batch Upload</div>
        <div class="pg-hero__sub">Download the template, fill in student data, then import the Excel file to register multiple students at once.</div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-md-10 col-12">

            {{-- Download template card --}}
            <div class="pg-card" style="margin-bottom:16px;">
                <div class="pg-card__header">
                    <div class="pg-card__icon" style="background:rgba(6,182,212,.12);color:#06b6d4;">
                        <i class="fas fa-download"></i>
                    </div>
                    <div>
                        <div class="pg-card__title">Step 1 — Download Template</div>
                        <div class="pg-card__sub">Get the Excel template with the correct column structure</div>
                    </div>
                </div>
                <div class="pg-card__body">
                    <p style="font-size:.85rem;color:var(--ct-text-muted);margin-bottom:14px;">
                        Download the student data template, fill in the required fields (LRN, name, grade, section, academic year), then upload it below.
                    </p>
                    <a href="{{ route('download.student.data') }}" class="btn btn-sm"
                       style="background:rgba(6,182,212,.1);border:1px solid rgba(6,182,212,.25);color:#06b6d4;font-weight:600;border-radius:8px;padding:8px 18px;">
                        <i class="fas fa-file-excel mr-2"></i> Download Student Data Template
                    </a>
                </div>
            </div>

            {{-- Upload card --}}
            <div class="pg-card">
                <div class="pg-card__header">
                    <div class="pg-card__icon" style="background:rgba(79,70,229,.12);color:var(--ct-primary);">
                        <i class="fas fa-file-import"></i>
                    </div>
                    <div>
                        <div class="pg-card__title">Step 2 — Import Excel File</div>
                        <div class="pg-card__sub">Select the filled template and click Import</div>
                    </div>
                </div>
                <div class="pg-card__body">

                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center gap-2" style="gap:10px;">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center" style="gap:10px;">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('student.Import') }}" method="POST"
                          enctype="multipart/form-data" id="importForm">
                        @csrf
                        <div class="mb-3">
                            <label style="display:block;font-size:.78rem;font-weight:600;color:var(--ct-text);margin-bottom:6px;">
                                Select Excel File <span style="color:var(--ct-danger);">*</span>
                            </label>
                            <div style="border:2px dashed var(--ct-border);border-radius:var(--ct-radius);padding:24px;text-align:center;background:var(--ct-surface-alt);cursor:pointer;transition:border-color .15s;"
                                 id="dropZoneArea">
                                <i class="fas fa-cloud-upload-alt" style="font-size:2rem;color:var(--ct-text-muted);margin-bottom:10px;display:block;"></i>
                                <p style="font-size:.82rem;color:var(--ct-text-muted);margin-bottom:10px;">
                                    Click to select or drag & drop your Excel file here
                                </p>
                                <span id="fileLabel" style="font-size:.78rem;color:var(--ct-primary);font-weight:600;">No file chosen</span>
                                <input id="file" type="file" name="file" accept=".xlsx,.xls,.csv"
                                       style="position:absolute;opacity:0;width:0;height:0;">
                            </div>
                        </div>
                        <div class="d-flex" style="gap:10px;flex-wrap:wrap;margin-top:16px;">
                            <button type="submit" class="btn btn-primary px-4" id="importBtn">
                                <span class="import-lbl"><i class="fas fa-file-import mr-2"></i>Import Excel</span>
                                <span class="import-spin d-none"><i class="fas fa-spinner fa-spin mr-2"></i>Importing…</span>
                            </button>
                            <button type="reset" class="btn btn-outline-secondary" onclick="document.getElementById('fileLabel').textContent='No file chosen';">
                                <i class="fas fa-undo mr-1"></i> Clear
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        {{-- Tips sidebar --}}
        <div class="col-lg-5 col-md-12">
            <div class="pg-card">
                <div class="pg-card__header">
                    <div class="pg-card__icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div>
                        <div class="pg-card__title">Import Guidelines</div>
                    </div>
                </div>
                <div class="pg-card__body">
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;">
                        @foreach([
                            ['icon'=>'fa-columns','color'=>'#4f46e5','text'=>'Do not change or reorder the column headers in the template.'],
                            ['icon'=>'fa-id-card','color'=>'#06b6d4','text'=>'The LRN must be exactly 12 digits and unique per student.'],
                            ['icon'=>'fa-layer-group','color'=>'#10b981','text'=>'Grade Level values: Nursery, Kinder, Kinder2, or 1 to 12.'],
                            ['icon'=>'fa-calendar-alt','color'=>'#f59e0b','text'=>'Academic Year must follow the format YYYY-YYYY (e.g. 2024-2025).'],
                            ['icon'=>'fa-file-excel','color'=>'#10b981','text'=>'Only .xlsx, .xls and .csv files are accepted.'],
                        ] as $tip)
                        <li style="display:flex;gap:10px;align-items:flex-start;">
                            <span style="width:22px;height:22px;border-radius:50%;background:rgba({{$tip['color']=='#4f46e5'?'79,70,229':($tip['color']=='#06b6d4'?'6,182,212':($tip['color']=='#10b981'?'16,185,129':'245,158,11'))}}, .12);color:{{$tip['color']}};display:flex;align-items:center;justify-content:center;font-size:.6rem;flex-shrink:0;margin-top:1px;">
                                <i class="fas {{ $tip['icon'] }}"></i>
                            </span>
                            <span style="font-size:.8rem;color:var(--ct-text-muted);line-height:1.5;">{{ $tip['text'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
</section>

<script>
var dropZone = document.getElementById('dropZoneArea');
var fileInput = document.getElementById('file');
var fileLabel = document.getElementById('fileLabel');

dropZone.addEventListener('click', function () { fileInput.click(); });
fileInput.addEventListener('change', function () {
    fileLabel.textContent = this.files.length ? this.files[0].name : 'No file chosen';
    dropZone.style.borderColor = this.files.length ? 'var(--ct-primary)' : 'var(--ct-border)';
});

['dragover','dragenter'].forEach(function(ev) {
    dropZone.addEventListener(ev, function(e) { e.preventDefault(); dropZone.style.borderColor='var(--ct-primary)'; });
});
dropZone.addEventListener('dragleave', function() { dropZone.style.borderColor='var(--ct-border)'; });
dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    fileInput.files = e.dataTransfer.files;
    fileLabel.textContent = fileInput.files.length ? fileInput.files[0].name : 'No file chosen';
    dropZone.style.borderColor = fileInput.files.length ? 'var(--ct-primary)' : 'var(--ct-border)';
});

document.getElementById('importForm').addEventListener('submit', function() {
    var btn = document.getElementById('importBtn');
    btn.disabled = true;
    btn.querySelector('.import-lbl').classList.add('d-none');
    btn.querySelector('.import-spin').classList.remove('d-none');
});
</script>
@endsection
