@extends('home.index')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('body.js')
<script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

<style>
/* Re-use pg-hero / pg-card from disbursement — defined inline here for isolation */
.pg-hero { border-radius:var(--ct-radius); padding:24px 28px 20px; margin-bottom:20px; position:relative; overflow:hidden; color:#fff; }
.pg-hero::after { content:''; position:absolute; right:-40px; top:-40px; width:180px; height:180px; border-radius:50%; background:rgba(255,255,255,.07); pointer-events:none; }
.pg-hero__eyebrow { display:inline-flex; align-items:center; gap:7px; background:rgba(255,255,255,.18); border-radius:999px; padding:4px 12px; font-size:.7rem; font-weight:700; letter-spacing:.5px; text-transform:uppercase; margin-bottom:10px; }
.pg-hero__title { font-size:1.45rem; font-weight:800; letter-spacing:-.4px; margin-bottom:3px; }
.pg-hero__sub   { font-size:.82rem; opacity:.85; }
.pg-card { background:var(--ct-surface); border:1px solid var(--ct-border); border-radius:var(--ct-radius); box-shadow:var(--ct-shadow); overflow:hidden; margin-bottom:16px; }
.pg-card__header { display:flex; align-items:center; gap:12px; padding:14px 20px; background:var(--ct-surface-alt); border-bottom:1px solid var(--ct-border); }
.pg-card__icon { width:36px; height:36px; border-radius:9px; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-size:.9rem; }
.pg-card__title { font-size:.88rem; font-weight:700; color:var(--ct-text); }
.pg-card__sub   { font-size:.72rem; color:var(--ct-text-muted); margin-top:1px; }
.pg-card__body  { padding:20px; }
.pg-toolbar { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; padding:14px 20px; background:var(--ct-surface-alt); border-bottom:1px solid var(--ct-border); }
.pg-toolbar__title { font-size:.82rem; font-weight:700; color:var(--ct-text); display:flex; align-items:center; gap:8px; }
.pg-toolbar__dot  { width:9px; height:9px; border-radius:50%; flex-shrink:0; }

/* Product card for entry */
.oi-product {
    background:var(--ct-surface-alt); border:1px solid var(--ct-border);
    border-radius:var(--ct-radius-sm); padding:16px;
    display:flex; flex-direction:column; gap:10px; height:100%;
}
.oi-product__icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; }
.oi-product__name { font-size:.85rem; font-weight:700; color:var(--ct-text); }
.oi-product__price {
    display:inline-flex; align-items:center; gap:4px;
    background:rgba(16,185,129,.1); border:1px solid rgba(16,185,129,.2);
    border-radius:999px; padding:3px 10px;
    font-size:.72rem; font-weight:700; color:#10b981;
}
.oi-product__hint { font-size:.7rem; color:var(--ct-text-muted); }
.oi-product .input-group-text { font-weight:700; }

.btn-oi-submit {
    width:100%; height:44px; font-weight:700; font-size:.88rem;
    background:linear-gradient(135deg,#059669,#10b981) !important;
    border:none !important; color:#fff !important;
    box-shadow:0 4px 12px rgba(16,185,129,.3) !important;
    border-radius:var(--ct-radius-sm) !important;
    transition:box-shadow .15s, transform .15s !important;
}
.btn-oi-submit:hover { box-shadow:0 6px 18px rgba(16,185,129,.4) !important; transform:translateY(-1px) !important; }

/* Table toolbar */
.tbl-toolbar {
    display:flex; align-items:center; justify-content:space-between;
    flex-wrap:wrap; gap:10px; padding:14px 20px;
    background:var(--ct-surface-alt); border-bottom:1px solid var(--ct-border);
}
.bulk-bar {
    display:none; align-items:center; gap:12px;
    padding:10px 20px; background:rgba(239,68,68,.07);
    border-bottom:1px solid rgba(239,68,68,.18);
}
.bulk-bar.visible { display:flex; }
.bulk-bar__count { font-size:.82rem; font-weight:600; color:var(--ct-danger); }
</style>

<section class="content" style="padding-top:0;">
<div class="container-fluid pt-3">

    {{-- Hero --}}
    <div class="pg-hero" style="background:linear-gradient(135deg,#065f46 0%,#059669 55%,#10b981 100%);">
        <div class="pg-hero__eyebrow"><i class="fas fa-cash-register"></i> Data · Other Income</div>
        <div class="pg-hero__title">Other Income Records</div>
        <div class="pg-hero__sub">Record CA Paper, Green Book and Mass Card sales, then view all recent income entries below.</div>
    </div>

    <div class="row">
        {{-- LEFT: Quick entry --}}
        <div class="col-lg-4 col-md-12 mb-3">
            <div class="pg-card" style="height:100%;">
                <div class="pg-card__header">
                    <div class="pg-card__icon" style="background:rgba(16,185,129,.12);color:#10b981;"><i class="fas fa-plus-circle"></i></div>
                    <div>
                        <div class="pg-card__title">Record Sale</div>
                        <div class="pg-card__sub">Enter quantity sold per item</div>
                    </div>
                </div>
                <div class="pg-card__body">
                    <form action="{{ route('store.income') }}" method="POST" id="save-income-form">
                        @csrf

                        {{-- Info notice --}}
                        <div style="display:flex;gap:9px;padding:10px 13px;background:rgba(16,185,129,.07);border:1px solid rgba(16,185,129,.18);border-radius:var(--ct-radius-sm);font-size:.78rem;color:var(--ct-text-muted);margin-bottom:16px;">
                            <i class="fas fa-info-circle" style="color:#10b981;margin-top:1px;flex-shrink:0;"></i>
                            <span>Enter the <strong>quantity</strong> sold. The system auto-calculates the amount from the unit price.</span>
                        </div>

                        <div class="row g-3">
                            {{-- CA Paper --}}
                            <div class="col-12 mb-3">
                                <div class="oi-product">
                                    <div class="d-flex align-items-center gap-3" style="gap:10px;">
                                        <div class="oi-product__icon" style="background:rgba(79,70,229,.1);color:#4f46e5;"><i class="fas fa-file-alt"></i></div>
                                        <div>
                                            <div class="oi-product__name">CA Paper</div>
                                            <span class="oi-product__price"><i class="fas fa-tag" style="font-size:.6rem;"></i> ₱1.00 / piece</span>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-hashtag" style="font-size:.7rem;"></i></span></div>
                                        <input type="text" class="form-control" id="ca_paper" name="ca_paper" placeholder="Qty sold">
                                    </div>
                                    <div class="oi-product__hint">Amount = Qty × ₱1.00</div>
                                </div>
                            </div>

                            {{-- Green Book --}}
                            <div class="col-12 mb-3">
                                <div class="oi-product">
                                    <div class="d-flex align-items-center" style="gap:10px;">
                                        <div class="oi-product__icon" style="background:rgba(16,185,129,.1);color:#10b981;"><i class="fas fa-book"></i></div>
                                        <div>
                                            <div class="oi-product__name">Green Book</div>
                                            <span class="oi-product__price"><i class="fas fa-tag" style="font-size:.6rem;"></i> ₱4.00 / piece</span>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-hashtag" style="font-size:.7rem;"></i></span></div>
                                        <input type="text" class="form-control" id="green_book" name="green_book" placeholder="Qty sold">
                                    </div>
                                    <div class="oi-product__hint">Amount = Qty × ₱4.00</div>
                                </div>
                            </div>

                            {{-- Mass Card --}}
                            <div class="col-12 mb-3">
                                <div class="oi-product">
                                    <div class="d-flex align-items-center" style="gap:10px;">
                                        <div class="oi-product__icon" style="background:rgba(245,158,11,.1);color:#f59e0b;"><i class="fas fa-praying-hands"></i></div>
                                        <div>
                                            <div class="oi-product__name">Mass Card</div>
                                            <span class="oi-product__price"><i class="fas fa-tag" style="font-size:.6rem;"></i> ₱3.00 / piece</span>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-hashtag" style="font-size:.7rem;"></i></span></div>
                                        <input type="text" class="form-control" id="mass_card" name="mass_card" placeholder="Qty sold">
                                    </div>
                                    <div class="oi-product__hint">Amount = Qty × ₱3.00</div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-oi-submit mt-2" id="incomeSubmitBtn">
                            <span class="submit-lbl"><i class="fas fa-save mr-2"></i>Save Entry</span>
                            <span class="submit-spin d-none"><i class="fas fa-spinner fa-spin mr-2"></i>Saving…</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT: DataTable --}}
        <div class="col-lg-8 col-md-12 mb-3">
            <div class="pg-card" style="height:100%;">

                <div class="tbl-toolbar">
                    <div>
                        <div style="font-size:.88rem;font-weight:700;color:var(--ct-text);">
                            <i class="fas fa-list-alt mr-1" style="color:#10b981;"></i> Recent Income Entries
                        </div>
                        <div style="font-size:.72rem;color:var(--ct-text-muted);margin-top:2px;">All recorded other income sales</div>
                    </div>
                    <button type="button" class="btn btn-sm" style="background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);color:#10b981;font-weight:600;border-radius:8px;padding:6px 14px;"
                            data-toggle="modal" data-target="#modal-xl">
                        <i class="fas fa-chart-bar mr-1"></i> Income Report
                    </button>
                </div>

                {{-- Bulk action bar --}}
                <div class="bulk-bar" id="incomeBulkBar">
                    <i class="fas fa-exclamation-circle" style="color:var(--ct-danger);"></i>
                    <span class="bulk-bar__count" id="incomeBulkCount">0 selected</span>
                    <button class="btn btn-sm btn-danger" id="DeleteAllBtn"><i class="fas fa-trash mr-1"></i>Delete Selected</button>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="income-table">
                            <thead>
                                <tr>
                                    <th style="width:40px;padding:12px 16px;">
                                        <input type="checkbox" name="income_main_chk" id="incomeMainChk"
                                               style="width:16px;height:16px;accent-color:var(--ct-primary);cursor:pointer;">
                                    </th>
                                    <th style="width:46px;">#</th>
                                    <th><i class="fas fa-file-alt mr-1" style="color:#4f46e5;opacity:.6;"></i> CA Paper</th>
                                    <th><i class="fas fa-book mr-1" style="color:#10b981;opacity:.6;"></i> Green Book</th>
                                    <th><i class="fas fa-praying-hands mr-1" style="color:#f59e0b;opacity:.6;"></i> Mass Card</th>
                                    <th><i class="fas fa-coins mr-1" style="color:#ef4444;opacity:.6;"></i> Total</th>
                                    <th><i class="fas fa-calendar mr-1" style="opacity:.5;"></i> Date</th>
                                    <th style="text-align:center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                @include('modal.incomepayment')
                @include('modal.income_report')
            </div>
        </div>
    </div>

</div>
</section>

<script>
toastr.options.preventDuplicates = true;
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(function () {
    var table = $('#income-table').DataTable({
        processing: true, info: true,
        ajax: "{{ route('get.other_income') }}",
        pageLength: 10,
        lengthMenu: [[5,10,25,50,-1],[5,10,25,50,'All']],
        language: {
            emptyTable: '<div style="padding:24px;text-align:center;color:var(--ct-text-muted);"><i class="fas fa-inbox" style="font-size:2rem;opacity:.3;display:block;margin-bottom:8px;"></i>No income entries yet</div>'
        },
        columns: [
            { data:'checkbox',    name:'checkbox',  orderable:false, searchable:false },
            { data:'DT_RowIndex', name:'DT_RowIndex', orderable:false, searchable:false },
            { data:'ca_paper',    name:'ca_paper'   },
            { data:'yellow_book', name:'yellow_book' },
            { data:'mass_card',   name:'mass_card'  },
            { data:'total',       name:'total', render: function(d){ return '₱ ' + parseFloat(d||0).toLocaleString('en-PH',{minimumFractionDigits:2}); } },
            { data:'updated_at',  name:'updated_at', render: function(d){ return moment(d).format('MMM DD, YYYY'); } },
            { data:'actions',     name:'actions', orderable:false, searchable:false, className:'text-center' }
        ]
    }).on('draw', function () {
        $('input[name="income_checkbox"]').prop('checked', false);
        $('#incomeBulkBar').removeClass('visible');
    });

    /* Save income */
    $('#save-income-form').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        var btn  = document.getElementById('incomeSubmitBtn');
        if ($('#ca_paper').val()==='' && $('#green_book').val()==='' && $('#mass_card').val()==='') {
            toastr.warning('Please enter a quantity in at least one field.');
            return;
        }
        btn.disabled = true;
        btn.querySelector('.submit-lbl').classList.add('d-none');
        btn.querySelector('.submit-spin').classList.remove('d-none');
        $.ajax({
            url: $(form).attr('action'), method: $(form).attr('method'),
            data: new FormData(form), processData:false, dataType:'json', contentType:false,
            success: function (data) {
                btn.disabled = false;
                btn.querySelector('.submit-lbl').classList.remove('d-none');
                btn.querySelector('.submit-spin').classList.add('d-none');
                if (data.code == 0) {
                    toastr.error('Entry not saved.');
                } else {
                    toastr.success(data.msg);
                    form.reset();
                    $('#income-table').DataTable().ajax.reload();
                }
            }
        });
    });

    /* Edit */
    $(document).on('click', '#editbtn', function () {
        var id = $(this).data('id');
        $('.editIncome').find('form')[0].reset();
        $.post('<?= route('get.show.income') ?>', { student_id: id }, function (data) {
            $('.editIncome').find('input[name="sid"]').val(data.details.id);
            $('.editIncome').find('input[name="ca_paper"]').val(data.details.ca_paper);
            $('.editIncome').find('input[name="green_book"]').val(data.details.yellow_book);
            $('.editIncome').find('input[name="mass_card"]').val(data.details.mass_card);
            $('.editIncome').find('input[name="total"]').val(data.details.total);
            $('#modal-default').modal('show');
        }, 'json');
    });

    $('#update-income-payment').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'), method: $(form).attr('method'),
            data: new FormData(form), processData:false, dataType:'json', contentType:false,
            success: function (data) {
                if (data.code == 0) { toastr.error(data.msg); }
                else { $('#income-table').DataTable().ajax.reload(null,false); $('.editIncome').modal('hide'); form.reset(); toastr.success(data.msg); }
            }
        });
    });

    /* Delete single */
    $(document).on('click', '#deletebtn', function () {
        var id = $(this).data('id');
        swal.fire({ title:'Delete this entry?', html:'This action cannot be undone.', icon:'warning',
            showCancelButton:true, confirmButtonText:'Yes, Delete', cancelButtonText:'Cancel',
            confirmButtonColor:'#ef4444', cancelButtonColor:'#6b7280'
        }).then(function (r) {
            if (r.isConfirmed) {
                $.post('<?= route('delete.payments') ?>', { student_id:id }, function (data) {
                    if (data.code==1) { $('#income-table').DataTable().ajax.reload(null,false); toastr.success(data.msg); }
                    else toastr.error(data.msg);
                }, 'json');
            }
        });
    });

    /* Bulk selection */
    function syncIncomeBulk() {
        var n = $('input[name="income_checkbox"]:checked').length;
        if (n > 0) { $('#incomeBulkBar').addClass('visible'); $('#incomeBulkCount').text(n + ' row' + (n>1?'s':'')+' selected'); }
        else $('#incomeBulkBar').removeClass('visible');
    }
    $('#incomeMainChk').on('click', function () { $('input[name="income_checkbox"]').prop('checked', this.checked); syncIncomeBulk(); });
    $(document).on('change', 'input[name="income_checkbox"]', syncIncomeBulk);

    /* Delete selected */
    $('#DeleteAllBtn').on('click', function () {
        var ids = [];
        $('input[name="income_checkbox"]:checked').each(function () { ids.push($(this).data('id')); });
        if (!ids.length) return;
        swal.fire({ title:'Delete '+ids.length+' entr'+(ids.length>1?'ies':'y')+'?', html:'Cannot be undone.', icon:'warning',
            showCancelButton:true, confirmButtonText:'Delete', cancelButtonText:'Cancel',
            confirmButtonColor:'#ef4444', cancelButtonColor:'#6b7280'
        }).then(function (r) {
            if (r.isConfirmed) {
                $.post('{{ route('delete.selected.payment') }}', { Student_ids:ids }, function (data) {
                    if (data.code==1) { $('#income-table').DataTable().ajax.reload(null,true); toastr.success(data.msg); }
                }, 'json');
            }
        });
    });
});

function allowOnlyNumbersWithDecimal(id) {
    document.getElementById(id).addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9.]/g,'').replace(/^0+(?=\d)/,'');
        if (this.value.split('.').length > 2) this.value = this.value.slice(0, this.value.lastIndexOf('.'));
    });
}
['ca_paper','green_book','mass_card'].forEach(allowOnlyNumbersWithDecimal);
</script>
@endsection
