<div class="modal settingpay fade" id="payable-modal" tabindex="-1" role="dialog" aria-labelledby="payableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border:1px solid var(--ct-border);border-radius:var(--ct-radius);background:var(--ct-surface);">

            {{-- ── Header ── --}}
            <div class="modal-header align-items-start" style="border-bottom:1px solid var(--ct-border);padding:20px 24px 16px;">
                <div class="d-flex align-items-center" style="gap:14px;">
                    <div style="width:42px;height:42px;border-radius:10px;background:rgba(79,70,229,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-plus-circle" style="color:var(--ct-primary);font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0" id="payableModalLabel" style="font-weight:700;color:var(--ct-text);">Add Grade Level Payable</h5>
                        <p class="mb-0 mt-1" style="font-size:.8rem;color:var(--ct-text-muted);">Configure the fee structure for a specific grade level</p>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="color:var(--ct-text-muted);opacity:1;padding:4px 8px;margin:-4px -8px 0 auto;">
                    <i class="fas fa-times" style="font-size:.95rem;"></i>
                </button>
            </div>

            {{-- ── Body ── --}}
            <div class="modal-body" style="padding:24px;">
                <form action="{{ route('setting.set') }}" method="post" id="student-payables">
                    @csrf
                    <input type="hidden" name="sid" />

                    {{-- Grade Level --}}
                    <div class="mb-4">
                        <div class="section-title" style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--ct-text-muted);padding-bottom:.5rem;border-bottom:1px solid var(--ct-border);margin-bottom:14px;">
                            <i class="fas fa-layer-group mr-1" style="color:var(--ct-primary);"></i> Step 1 — Select Grade Level
                        </div>
                        <div class="form-group mb-0">
                            <label style="font-size:.8rem;font-weight:600;letter-spacing:.3px;color:var(--ct-text);margin-bottom:6px;display:block;">
                                Grade Level <span style="color:var(--ct-danger);">*</span>
                            </label>
                            <select id="grade_lvl_add" name="grade_lvl" class="form-control"
                                    style="height:42px;font-size:.95rem;">
                                <option value="" selected disabled>— Choose a grade level —</option>
                                <option value="Nursery">Nursery</option>
                                <option value="Kinder">Kinder 1</option>
                                <option value="Kinder2">Kinder 2</option>
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
                            <span class="text-danger error-text grade_lvl_error d-block mt-1" style="font-size:.78rem;"></span>
                        </div>
                    </div>

                    {{-- Fee Breakdown --}}
                    <div class="mb-4">
                        <div class="section-title" style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--ct-text-muted);padding-bottom:.5rem;border-bottom:1px solid var(--ct-border);margin-bottom:14px;">
                            <i class="fas fa-coins mr-1" style="color:var(--ct-primary);"></i> Step 2 — Enter Fee Amounts
                        </div>

                        <div class="row">
                            {{-- Registration Fee --}}
                            <div class="col-md-4 mb-3">
                                <div style="background:var(--ct-surface-alt);border:1px solid var(--ct-border);border-radius:var(--ct-radius-sm);padding:14px;">
                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                        <div style="width:28px;height:28px;border-radius:6px;background:rgba(16,185,129,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-clipboard-check" style="color:#10b981;font-size:.75rem;"></i>
                                        </div>
                                        <label for="add_reg_fee" style="font-size:.8rem;font-weight:600;color:var(--ct-text);margin:0;">
                                            Registration Fee
                                        </label>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-weight:700;">₱</span>
                                        </div>
                                        <input type="number" min="0" step="0.01"
                                               id="add_reg_fee" name="registration_fee"
                                               class="form-control"
                                               style="text-align:right;font-variant-numeric:tabular-nums;"
                                               placeholder="0.00"
                                               oninput="calcAddPayable()">
                                    </div>
                                    <span class="text-danger error-text registration_fee_error d-block mt-1" style="font-size:.75rem;"></span>
                                </div>
                            </div>

                            {{-- Tuition Fee --}}
                            <div class="col-md-4 mb-3">
                                <div style="background:var(--ct-surface-alt);border:1px solid var(--ct-border);border-radius:var(--ct-radius-sm);padding:14px;">
                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                        <div style="width:28px;height:28px;border-radius:6px;background:rgba(79,70,229,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-book" style="color:var(--ct-primary);font-size:.75rem;"></i>
                                        </div>
                                        <label for="add_tui_fee" style="font-size:.8rem;font-weight:600;color:var(--ct-text);margin:0;">
                                            Tuition Fee
                                        </label>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-weight:700;">₱</span>
                                        </div>
                                        <input type="number" min="0" step="0.01"
                                               id="add_tui_fee" name="tuition_fee"
                                               class="form-control"
                                               style="text-align:right;font-variant-numeric:tabular-nums;"
                                               placeholder="0.00"
                                               oninput="calcAddPayable()">
                                    </div>
                                    <span class="text-danger error-text tuition_fee_error d-block mt-1" style="font-size:.75rem;"></span>
                                </div>
                            </div>

                            {{-- Uniform Fee --}}
                            <div class="col-md-4 mb-3">
                                <div style="background:var(--ct-surface-alt);border:1px solid var(--ct-border);border-radius:var(--ct-radius-sm);padding:14px;">
                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                        <div style="width:28px;height:28px;border-radius:6px;background:rgba(6,182,212,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-tshirt" style="color:#06b6d4;font-size:.75rem;"></i>
                                        </div>
                                        <label for="add_uni_fee" style="font-size:.8rem;font-weight:600;color:var(--ct-text);margin:0;">
                                            Uniform Fee
                                        </label>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-weight:700;">₱</span>
                                        </div>
                                        <input type="number" min="0" step="0.01"
                                               id="add_uni_fee" name="uniform_fee"
                                               class="form-control"
                                               style="text-align:right;font-variant-numeric:tabular-nums;"
                                               placeholder="0.00"
                                               oninput="calcAddPayable()">
                                    </div>
                                    <span class="text-danger error-text uniform_fee_error d-block mt-1" style="font-size:.75rem;"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Live Total Summary --}}
                    <div style="background:linear-gradient(135deg,rgba(79,70,229,.08),rgba(79,70,229,.04));border:1px solid rgba(79,70,229,.2);border-radius:var(--ct-radius);padding:16px 20px;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:8px;">
                            <div>
                                <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--ct-text-muted);margin-bottom:2px;">
                                    <i class="fas fa-calculator mr-1"></i> Total Payable Amount
                                </div>
                                <div style="font-size:.8rem;color:var(--ct-text-muted);">
                                    Registration + Tuition + Uniform
                                </div>
                            </div>
                            <div id="add_total_display"
                                 style="font-size:1.75rem;font-weight:800;color:var(--ct-primary);font-variant-numeric:tabular-nums;letter-spacing:-1px;">
                                ₱ 0.00
                            </div>
                        </div>
                        <input type="hidden" id="total_fee" name="total_fee" value="0">
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex justify-content-end mt-4 pt-3" style="gap:10px;border-top:1px solid var(--ct-border);">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save mr-2"></i> Save Payable
                        </button>
                    </div>

                </form>
            </div>{{-- /.modal-body --}}

        </div>
    </div>
</div>

<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    function calcAddPayable() {
        var reg = parseFloat(document.getElementById('add_reg_fee').value) || 0;
        var tui = parseFloat(document.getElementById('add_tui_fee').value) || 0;
        var uni = parseFloat(document.getElementById('add_uni_fee').value) || 0;
        var total = reg + tui + uni;
        document.getElementById('total_fee').value = total.toFixed(2);
        document.getElementById('add_total_display').textContent =
            '₱ ' + total.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    /* keep legacy name for any external calls */
    function calculateBalance() { calcAddPayable(); }

    function savePayable() {
        $('#student-payables').on('submit', function (e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () { $(form).find('span.error-text').text(''); },
                success: function (data) {
                    if (data.code == 0) {
                        toastr.error('Payable has not been added');
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        document.getElementById('add_total_display').textContent = '₱ 0.00';
                        $('#payables-table').DataTable().ajax.reload();
                        $('#payable-modal').modal('hide');
                        toastr.success(data.msg);
                    }
                }
            });
        });
    }
    savePayable();

    /* Reset total display when modal closes */
    $('#payable-modal').on('hidden.bs.modal', function () {
        document.getElementById('add_total_display').textContent = '₱ 0.00';
        document.getElementById('total_fee').value = '0';
    });
</script>
