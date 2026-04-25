@extends('home.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('body.js')
<script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

<style>
.pg-hero { border-radius:var(--ct-radius); padding:24px 28px 20px; margin-bottom:20px; position:relative; overflow:hidden; color:#fff; }
.pg-hero::after { content:''; position:absolute; right:-40px; top:-40px; width:180px; height:180px; border-radius:50%; background:rgba(255,255,255,.07); pointer-events:none; }
.pg-hero__eyebrow { display:inline-flex; align-items:center; gap:7px; background:rgba(255,255,255,.18); border-radius:999px; padding:4px 12px; font-size:.7rem; font-weight:700; letter-spacing:.5px; text-transform:uppercase; margin-bottom:10px; }
.pg-hero__title { font-size:1.45rem; font-weight:800; letter-spacing:-.4px; margin-bottom:3px; }
.pg-hero__sub   { font-size:.82rem; opacity:.85; }
.pg-card { background:var(--ct-surface); border:1px solid var(--ct-border); border-radius:var(--ct-radius); box-shadow:var(--ct-shadow); overflow:hidden; }
.tbl-toolbar { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; padding:14px 20px; background:var(--ct-surface-alt); border-bottom:1px solid var(--ct-border); }
.bulk-bar { display:none; align-items:center; gap:12px; padding:10px 20px; background:rgba(239,68,68,.07); border-bottom:1px solid rgba(239,68,68,.18); }
.bulk-bar.visible { display:flex; }
.bulk-bar__count { font-size:.82rem; font-weight:600; color:var(--ct-danger); }

/* Archive notice */
.arc-notice {
    display:flex; align-items:flex-start; gap:12px;
    padding:14px 18px; border-radius:var(--ct-radius-sm);
    background:rgba(245,158,11,.09); border:1px solid rgba(245,158,11,.25);
    margin-bottom:16px; font-size:.82rem; color:var(--ct-text); line-height:1.5;
}
.arc-notice i { color:#f59e0b; font-size:1rem; margin-top:1px; flex-shrink:0; }
.arc-notice strong { color:var(--ct-text); }
.arc-notice a { color:var(--ct-primary); font-weight:600; }

/* Badge chips */
.balance-chip { display:inline-flex; align-items:center; gap:4px; padding:3px 9px; border-radius:999px; font-size:.72rem; font-weight:700; }
.balance-chip--zero { background:rgba(16,185,129,.1); color:#10b981; border:1px solid rgba(16,185,129,.2); }
.balance-chip--pos  { background:rgba(239,68,68,.1);  color:#ef4444;  border:1px solid rgba(239,68,68,.2); }
</style>

<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3">

    {{-- Hero --}}
    <div class="pg-hero" style="background:linear-gradient(135deg,#78350f 0%,#b45309 50%,#f59e0b 100%);">
        <div class="pg-hero__eyebrow"><i class="fas fa-archive"></i> Data · Archive</div>
        <div class="pg-hero__title">Archived Student Records</div>
        <div class="pg-hero__sub">Archived records are removed from active collections. You can restore or permanently delete them here.</div>
    </div>

    {{-- Info notice --}}
    <div class="arc-notice">
        <i class="fas fa-exclamation-triangle"></i>
        <div>
            <strong>What is archived data?</strong>
            Records moved here were manually archived from the
            <a href="{{ route('table.student') }}">Cash Collection</a> table.
            Use <strong>Restore</strong> to return a record to active status, or <strong>Delete</strong> to permanently remove it.
        </div>
    </div>

    {{-- Main table card --}}
    <div class="pg-card">

        <div class="tbl-toolbar">
            <div>
                <div style="font-size:.88rem;font-weight:700;color:var(--ct-text);">
                    <i class="fas fa-box-open mr-1" style="color:#f59e0b;"></i> Archived Records
                </div>
                <div style="font-size:.72rem;color:var(--ct-text-muted);margin-top:2px;">All records previously archived from Cash Collection</div>
            </div>
        </div>

        {{-- Bulk action bar --}}
        <div class="bulk-bar" id="archiveBulkBar">
            <i class="fas fa-exclamation-circle" style="color:var(--ct-danger);"></i>
            <span class="bulk-bar__count" id="archiveBulkCount">0 selected</span>
            <button class="btn btn-sm btn-danger" id="deleteAllBtn">
                <i class="fas fa-trash mr-1"></i>Delete Selected
            </button>
            <button class="btn btn-sm btn-outline-secondary" id="clearArcSelection">
                <i class="fas fa-times mr-1"></i>Clear
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="archivestudent-table">
                    <thead>
                        <tr>
                            <th style="width:40px;padding:12px 16px;">
                                <input type="checkbox" name="main_checkbox" id="arcMainChk"
                                       style="width:16px;height:16px;accent-color:var(--ct-primary);cursor:pointer;">
                            </th>
                            <th style="width:46px;">#</th>
                            <th><i class="fas fa-user mr-1" style="opacity:.5;"></i> Name</th>
                            <th><i class="fas fa-users mr-1" style="opacity:.5;"></i> Section</th>
                            <th><i class="fas fa-layer-group mr-1" style="color:var(--ct-primary);opacity:.6;"></i> Level</th>
                            <th><i class="fas fa-calendar mr-1" style="opacity:.5;"></i> SY</th>
                            <th>Strand</th>
                            <th>OR No.</th>
                            <th>Date Paid</th>
                            <th><i class="fas fa-file-invoice-dollar mr-1" style="color:#4f46e5;opacity:.6;"></i> Total Fee</th>
                            <th><i class="fas fa-check-circle mr-1" style="color:#10b981;opacity:.6;"></i> Paid</th>
                            <th><i class="fas fa-exclamation-circle mr-1" style="color:#ef4444;opacity:.6;"></i> Balance</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        @include('modal.payment')
    </div>

</div>
</section>

<script>
toastr.options.preventDuplicates = true;
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(function () {
    var table = $('#archivestudent-table').DataTable({
        processing: true, info: true,
        ajax: "{{ route('data.archivedStudentList') }}",
        pageLength: 10,
        lengthMenu: [[5,10,25,50,-1],[5,10,25,50,'All']],
        language: {
            emptyTable: '<div style="padding:28px;text-align:center;color:var(--ct-text-muted);"><i class="fas fa-box-open" style="font-size:2rem;opacity:.3;display:block;margin-bottom:8px;"></i>No archived records found</div>',
            processing: '<i class="fas fa-spinner fa-spin mr-1"></i> Loading…'
        },
        columns: [
            { data:'checkbox',    name:'checkbox',    orderable:false, searchable:false },
            { data:'DT_RowIndex', name:'DT_RowIndex', orderable:false, searchable:false },
            { data:'name',        name:'name'    },
            { data:'section',     name:'section' },
            { data:'lvl',         name:'lvl'     },
            { data:'ay',          name:'ay'      },
            { data:'strand',      name:'strand'  },
            { data:'or_no',       name:'or_no'   },
            { data:'datepaid',    name:'datepaid'},
            {
                data:'total_fee', name:'total_fee',
                render: function(d){ return '₱ '+parseFloat(d||0).toLocaleString('en-PH',{minimumFractionDigits:2}); }
            },
            {
                data:'amount_paid', name:'amount_paid',
                render: function(d){ return '₱ '+parseFloat(d||0).toLocaleString('en-PH',{minimumFractionDigits:2}); }
            },
            {
                data:'balance', name:'balance',
                render: function(d){
                    var b = parseFloat(d||0);
                    var cls = b <= 0 ? 'balance-chip--zero' : 'balance-chip--pos';
                    var icon = b <= 0 ? 'fa-check' : 'fa-exclamation';
                    return '<span class="balance-chip '+cls+'"><i class="fas '+icon+'"></i> ₱ '+b.toLocaleString('en-PH',{minimumFractionDigits:2})+'</span>';
                }
            },
            { data:'actions', name:'actions', orderable:false, searchable:false, className:'text-center' }
        ]
    }).on('draw', function () {
        $('input[name="student_checkbox"]').prop('checked', false);
        $('#arcMainChk').prop('checked', false).prop('indeterminate', false);
        $('#archiveBulkBar').removeClass('visible');
    });

    /* Restore */
    $(document).on('click', '#restorebtn', function () {
        var id = $(this).data('id');
        swal.fire({ title:'Restore this record?', html:'It will be returned to the active Cash Collection list.', icon:'question',
            showCancelButton:true, confirmButtonText:'Yes, Restore', cancelButtonText:'Cancel',
            confirmButtonColor:'#10b981', cancelButtonColor:'#6b7280'
        }).then(function (r) {
            if (r.isConfirmed) {
                $.ajax({ url:'/students/restore', type:'POST', data:{ sid:id }, dataType:'json',
                    success: function (res) {
                        if (res.success) { toastr.success(res.message); $('#archivestudent-table').DataTable().ajax.reload(null,false); }
                        else toastr.error(res.message);
                    }
                });
            }
        });
    });

    /* Delete single */
    $(document).on('click', '#deletebtn', function () {
        var id = $(this).data('id');
        swal.fire({ title:'Permanently delete?', html:'This record will be <b>removed forever</b>.', icon:'warning',
            showCancelButton:true, confirmButtonText:'Yes, Delete', cancelButtonText:'Cancel',
            confirmButtonColor:'#ef4444', cancelButtonColor:'#6b7280'
        }).then(function (r) {
            if (r.isConfirmed) {
                $.post('<?= route('delete.payment') ?>', { student_id:id }, function (data) {
                    if (data.code==1) { $('#archivestudent-table').DataTable().ajax.reload(null,false); toastr.success(data.msg); }
                    else toastr.error(data.msg);
                }, 'json');
            }
        });
    });

    /* Bulk select */
    function syncArcBulk() {
        var n = $('input[name="student_checkbox"]:checked').length;
        var total = $('input[name="student_checkbox"]').length;
        $('#arcMainChk').prop('checked', n>0 && n===total).prop('indeterminate', n>0 && n<total);
        if (n>0) { $('#archiveBulkBar').addClass('visible'); $('#archiveBulkCount').text(n+' record'+(n>1?'s':'')+' selected'); }
        else $('#archiveBulkBar').removeClass('visible');
    }
    $('#arcMainChk').on('click', function () { $('input[name="student_checkbox"]').prop('checked', this.checked); syncArcBulk(); });
    $(document).on('change', 'input[name="student_checkbox"]', syncArcBulk);

    $('#clearArcSelection').on('click', function () { $('input[name="student_checkbox"]').prop('checked', false); $('#arcMainChk').prop('checked', false).prop('indeterminate', false); syncArcBulk(); });

    /* Delete selected */
    $('#deleteAllBtn').on('click', function () {
        var ids = [];
        $('input[name="student_checkbox"]:checked').each(function () { ids.push($(this).data('id')); });
        if (!ids.length) return;
        swal.fire({ title:'Delete '+ids.length+' record'+(ids.length>1?'s':'')+'?', html:'This <b>cannot be undone</b>.', icon:'warning',
            showCancelButton:true, confirmButtonText:'Delete All', cancelButtonText:'Cancel',
            confirmButtonColor:'#ef4444', cancelButtonColor:'#6b7280'
        }).then(function (r) {
            if (r.isConfirmed) {
                $.post('{{ route('delete.selected.students') }}', { Student_ids:ids }, function (data) {
                    if (data.code==1) { $('#archivestudent-table').DataTable().ajax.reload(null,true); toastr.success(data.msg); }
                }, 'json');
            }
        });
    });
});
</script>
@endsection
