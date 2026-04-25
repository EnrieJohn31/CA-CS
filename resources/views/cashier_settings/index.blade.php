@extends('home.index')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

    <section class="content" style="padding-top:0;">
    <div class="container-fluid pt-3 pb-4">

    {{-- Hero --}}
    <div class="pg-hero" style="background:linear-gradient(135deg,#4f46e5 0%,#6366f1 55%,#06b6d4 100%);margin-bottom:20px;">
        <div class="pg-hero__eyebrow"><i class="fas fa-cog"></i> Settings · Grade Fees</div>
        <div class="pg-hero__title">Grade Level Fees</div>
        <div class="pg-hero__sub">Configure registration, tuition and uniform fees per grade level</div>
    </div>

    <style>
        /* ── Quick-stat strip ── */
        .grade-stat-strip {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .grade-stat-item {
            flex: 1 1 140px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: var(--ct-surface);
            border: 1px solid var(--ct-border);
            border-radius: var(--ct-radius);
            box-shadow: var(--ct-shadow);
        }
        .grade-stat-item__icon {
            width: 38px; height: 38px;
            border-radius: var(--ct-radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: .95rem;
            flex-shrink: 0;
        }
        .grade-stat-item__value {
            font-size: 1.45rem;
            font-weight: 800;
            line-height: 1;
            color: var(--ct-text);
        }
        .grade-stat-item__label {
            font-size: .72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
            color: var(--ct-text-muted);
            margin-top: 2px;
        }

        /* ── Table toolbar ── */
        .settings-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            padding: 16px 20px;
            border-bottom: 1px solid var(--ct-border);
            background: var(--ct-surface);
        }
        .settings-toolbar__left { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
        .settings-toolbar__title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--ct-text);
        }
        .settings-toolbar__subtitle {
            font-size: .78rem;
            color: var(--ct-text-muted);
        }

        /* ── Table polish ── */
        #payables-table thead th {
            white-space: nowrap;
        }
        #payables-table tbody td {
            vertical-align: middle;
        }
        .fee-cell {
            font-variant-numeric: tabular-nums;
            font-weight: 600;
            color: var(--ct-text);
        }
        .grade-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
            background: rgba(79,70,229,.1);
            color: var(--ct-primary);
            border: 1px solid rgba(79,70,229,.2);
        }

        /* ── Bulk-delete bar ── */
        .bulk-action-bar {
            display: none;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            background: rgba(239,68,68,.08);
            border-bottom: 1px solid rgba(239,68,68,.2);
        }
        .bulk-action-bar.visible { display: flex; }
        .bulk-action-bar__count {
            font-size: .85rem;
            font-weight: 600;
            color: var(--ct-danger);
        }
    </style>

            {{-- ── Quick-stat strip ── --}}
            <div class="grade-stat-strip">
                <div class="grade-stat-item">
                    <div class="grade-stat-item__icon" style="background:rgba(79,70,229,.1);color:var(--ct-primary);">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <div class="grade-stat-item__value" id="stat-total">—</div>
                        <div class="grade-stat-item__label">Configured Levels</div>
                    </div>
                </div>
                <div class="grade-stat-item">
                    <div class="grade-stat-item__icon" style="background:rgba(16,185,129,.1);color:#10b981;">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div>
                        <div class="grade-stat-item__value" id="stat-reg">—</div>
                        <div class="grade-stat-item__label">Avg Registration</div>
                    </div>
                </div>
                <div class="grade-stat-item">
                    <div class="grade-stat-item__icon" style="background:rgba(6,182,212,.1);color:#06b6d4;">
                        <i class="fas fa-book"></i>
                    </div>
                    <div>
                        <div class="grade-stat-item__value" id="stat-tui">—</div>
                        <div class="grade-stat-item__label">Avg Tuition</div>
                    </div>
                </div>
                <div class="grade-stat-item">
                    <div class="grade-stat-item__icon" style="background:rgba(245,158,11,.12);color:#f59e0b;">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <div>
                        <div class="grade-stat-item__value" id="stat-uni">—</div>
                        <div class="grade-stat-item__label">Avg Uniform</div>
                    </div>
                </div>
            </div>

            {{-- ── Main Card ── --}}
            <div class="card card-outline card-primary" style="margin-bottom:0;">

                {{-- Toolbar --}}
                <div class="settings-toolbar">
                    <div>
                        <div class="settings-toolbar__title">
                            <i class="fas fa-coins mr-1" style="color:var(--ct-primary);"></i>
                            Fee Schedule
                        </div>
                        <div class="settings-toolbar__subtitle">Manage per-grade registration, tuition and uniform fees</div>
                    </div>
                    <button class="btn btn-primary btn-sm" id="payadbleForm">
                        <i class="fas fa-plus mr-1"></i> Add Grade Level
                    </button>
                </div>

                {{-- Bulk-delete bar (shown when rows are selected) --}}
                <div class="bulk-action-bar" id="bulkActionBar">
                    <i class="fas fa-exclamation-circle" style="color:var(--ct-danger);"></i>
                    <span class="bulk-action-bar__count" id="bulkCount">0 selected</span>
                    <button class="btn btn-sm btn-danger ml-2" id="deleteAll">
                        <i class="fas fa-trash mr-1"></i> Delete Selected
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="clearSelection">
                        <i class="fas fa-times mr-1"></i> Clear
                    </button>
                </div>

                {{-- Table --}}
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="payables-table">
                            <thead>
                                <tr>
                                    <th style="width:40px;padding:12px 16px;">
                                        <input type="checkbox" name="main_checkbox" id="main_checkbox"
                                               style="width:16px;height:16px;accent-color:var(--ct-primary);cursor:pointer;">
                                    </th>
                                    <th style="width:50px;">#</th>
                                    <th><i class="fas fa-layer-group mr-1" style="color:var(--ct-primary);opacity:.6;"></i> Grade Level</th>
                                    <th><i class="fas fa-clipboard-check mr-1" style="color:#10b981;opacity:.7;"></i> Registration Fee</th>
                                    <th><i class="fas fa-book mr-1" style="color:#06b6d4;opacity:.7;"></i> Tuition Fee</th>
                                    <th><i class="fas fa-tshirt mr-1" style="color:#f59e0b;opacity:.7;"></i> Uniform Fee</th>
                                    <th style="width:120px;text-align:center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>

            @include('modal.setting_payable')
            @include('modal.setting_update_payable')

    <script>
        toastr.options.preventDuplicates = true;

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        /* ── Format as PHP peso ── */
        function peso(n) {
            return '₱ ' + parseFloat(n || 0).toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        /* ── Update summary stat strip ── */
        function updateStats(data) {
            var rows = data.data || [];
            var count = rows.length;
            document.getElementById('stat-total').textContent = count;
            if (count === 0) {
                document.getElementById('stat-reg').textContent = '—';
                document.getElementById('stat-tui').textContent = '—';
                document.getElementById('stat-uni').textContent = '—';
                return;
            }
            var sumR = 0, sumT = 0, sumU = 0;
            rows.forEach(function(r) {
                sumR += parseFloat(r.registration_fee) || 0;
                sumT += parseFloat(r.tuition_fee) || 0;
                sumU += parseFloat(r.uniform_fee) || 0;
            });
            document.getElementById('stat-reg').textContent = '₱' + (sumR / count).toLocaleString('en-PH', { maximumFractionDigits: 0 });
            document.getElementById('stat-tui').textContent = '₱' + (sumT / count).toLocaleString('en-PH', { maximumFractionDigits: 0 });
            document.getElementById('stat-uni').textContent = '₱' + (sumU / count).toLocaleString('en-PH', { maximumFractionDigits: 0 });
        }

        /* ── Bulk selection bar ── */
        function syncBulkBar() {
            var checked = $('input[name="student_checkbox"]:checked').length;
            var total   = $('input[name="student_checkbox"]').length;

            $('input[name="main_checkbox"]').prop('checked', checked > 0 && checked === total);
            $('input[name="main_checkbox"]').prop('indeterminate', checked > 0 && checked < total);

            if (checked > 0) {
                $('#bulkActionBar').addClass('visible');
                $('#bulkCount').text(checked + ' row' + (checked > 1 ? 's' : '') + ' selected');
            } else {
                $('#bulkActionBar').removeClass('visible');
            }
        }

        $(function () {

            /* ── DataTable ── */
            var table = $('#payables-table').DataTable({
                processing: true,
                info: true,
                ajax: {
                    url: "{{ route('settings.data.list') }}",
                    dataSrc: function (json) {
                        updateStats(json);
                        return json.data;
                    }
                },
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All']],
                language: {
                    processing: '<i class="fas fa-spinner fa-spin mr-1"></i> Loading…',
                    emptyTable: '<div class="empty-state py-4"><div class="empty-state__icon"><i class="fas fa-coins"></i></div><div class="empty-state__title">No fee schedules yet</div><p class="empty-state__text">Click <strong>Add Grade Level</strong> to create the first payable.</p></div>',
                    zeroRecords: '<div class="empty-state py-3"><div class="empty-state__icon"><i class="fas fa-search"></i></div><div class="empty-state__title">No matching records</div></div>'
                },
                columns: [
                    { data: 'checkbox',          name: 'checkbox',         orderable: false, searchable: false },
                    { data: 'DT_RowIndex',        name: 'DT_RowIndex',      orderable: false, searchable: false },
                    {
                        data: 'grade_lvl', name: 'grade_lvl',
                        render: function (d) {
                            return '<span class="grade-badge"><i class="fas fa-graduation-cap" style="font-size:.65rem;"></i> ' + d + '</span>';
                        }
                    },
                    {
                        data: 'registration_fee', name: 'registration_fee',
                        render: function (d) { return '<span class="fee-cell">' + peso(d) + '</span>'; }
                    },
                    {
                        data: 'tuition_fee', name: 'tuition_fee',
                        render: function (d) { return '<span class="fee-cell">' + peso(d) + '</span>'; }
                    },
                    {
                        data: 'uniform_fee', name: 'uniform_fee',
                        render: function (d) { return '<span class="fee-cell">' + peso(d) + '</span>'; }
                    },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center' }
                ]
            }).on('draw', function () {
                $('input[name="student_checkbox"]').each(function () { this.checked = false; });
                $('input[name="main_checkbox"]').prop('checked', false);
                $('#bulkActionBar').removeClass('visible');
            });

            /* ── Add payable ── */
            $(document).on('click', '#payadbleForm', function () {
                $('.settingpay').find('form')[0].reset();
                $('.settingpay').find('span.error-text').text('');
                document.getElementById('add_total_display') && (document.getElementById('add_total_display').textContent = '₱ 0.00');
                $.post('<?= route('get.setting.payment') ?>', {}, function () {
                    $('#payable-modal').modal('show');
                }, 'json');
            });

            /* ── Edit payable ── */
            $(document).on('click', '#editbtn', function () {
                var id = $(this).data('id');
                $('.setupdatepayable').find('form')[0].reset();
                $('.setupdatepayable').find('span.error-text').text('');
                $.post('<?= route('get.setting.payment') ?>', { student_id: id }, function (data) {
                    $('.setupdatepayable').find('input[name="sid"]').val(data.details.id);
                    $('.setupdatepayable').find('input[name="grade_lvl"]').val(data.details.grade_lvl);
                    $('.setupdatepayable').find('input[name="registration_fee"]').val(data.details.registration_fee);
                    $('.setupdatepayable').find('input[name="tuition_fee"]').val(data.details.tuition_fee);
                    $('.setupdatepayable').find('input[name="uniform_fee"]').val(data.details.uniform_fee);
                    if (typeof calcUpdatePayable === 'function') calcUpdatePayable();
                    $('#update_payable-modal').modal('show');
                }, 'json');
            });

            /* ── Update payable submit ── */
            $('#update-student-payable').on('submit', function (e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false, dataType: 'json', contentType: false,
                    beforeSend: function () { $(form).find('span.error-text').text(''); },
                    success: function (data) {
                        if (data.code == 0) {
                            toastr.error(data.msg);
                            $.each(data.error, function (k, v) { $(form).find('span.' + k + '_error').text(v[0]); });
                        } else {
                            $('#payables-table').DataTable().ajax.reload(null, false);
                            $('#update_payable-modal').modal('hide');
                            $(form)[0].reset();
                            toastr.success(data.msg);
                        }
                    }
                });
            });

            /* ── Delete single ── */
            $(document).on('click', '#deletebtn', function () {
                var id  = $(this).data('id');
                var url = '<?= route('delete.payments') ?>';
                swal.fire({
                    title: 'Delete this payable?',
                    html: 'This action <b>cannot be undone</b>.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-trash mr-1"></i> Yes, Delete',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    buttonsStyling: true
                }).then(function (r) {
                    if (r.isConfirmed) {
                        $.post(url, { student_id: id }, function (data) {
                            if (data.code == 1) {
                                $('#payables-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            } else {
                                toastr.error(data.msg);
                            }
                        }, 'json');
                    }
                });
            });

            /* ── Select all checkbox ── */
            $(document).on('click', '#main_checkbox', function () {
                $('input[name="student_checkbox"]').prop('checked', this.checked);
                syncBulkBar();
            });
            $(document).on('change', 'input[name="student_checkbox"]', function () { syncBulkBar(); });

            /* ── Clear selection ── */
            $(document).on('click', '#clearSelection', function () {
                $('input[name="student_checkbox"]').prop('checked', false);
                $('input[name="main_checkbox"]').prop('checked', false);
                syncBulkBar();
            });

            /* ── Delete selected ── */
            $(document).on('click', '#deleteAll', function () {
                var ids = [];
                $('input[name="student_checkbox"]:checked').each(function () { ids.push($(this).data('id')); });
                if (!ids.length) return;
                swal.fire({
                    title: 'Delete ' + ids.length + ' payable' + (ids.length > 1 ? 's' : '') + '?',
                    html: 'This action <b>cannot be undone</b>.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-trash mr-1"></i> Delete All',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280'
                }).then(function (r) {
                    if (r.isConfirmed) {
                        $.post('{{ route('setting.delete_selected') }}', { Student_ids: ids }, function (data) {
                            if (data.code == 1) {
                                $('#payables-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            }
                        }, 'json');
                    }
                });
            });

        });
    </script>

    </div>{{-- /.container-fluid --}}
    </section>
@endsection
