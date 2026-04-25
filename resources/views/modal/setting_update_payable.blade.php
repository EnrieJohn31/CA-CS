<div class="modal setupdatepayable fade" id="update_payable-modal" tabindex="-1" role="dialog" aria-labelledby="updatePayableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border:1px solid var(--ct-border);border-radius:var(--ct-radius);background:var(--ct-surface);">

            {{-- ── Header ── --}}
            <div class="modal-header align-items-start" style="border-bottom:1px solid var(--ct-border);padding:20px 24px 16px;">
                <div class="d-flex align-items-center" style="gap:14px;">
                    <div style="width:42px;height:42px;border-radius:10px;background:rgba(245,158,11,.14);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-edit" style="color:#f59e0b;font-size:1.1rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-0" id="updatePayableModalLabel" style="font-weight:700;color:var(--ct-text);">Update Grade Level Payable</h5>
                        <p class="mb-0 mt-1" style="font-size:.8rem;color:var(--ct-text-muted);">Modify the fee structure for an existing grade level</p>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="color:var(--ct-text-muted);opacity:1;padding:4px 8px;margin:-4px -8px 0 auto;">
                    <i class="fas fa-times" style="font-size:.95rem;"></i>
                </button>
            </div>

            {{-- ── Body ── --}}
            <div class="modal-body" style="padding:24px;">
                <form action="{{ route('setting.update') }}" method="post" id="update-student-payable">
                    @csrf
                    <input type="hidden" name="sid" />

                    {{-- Grade Level (read-only in update context) --}}
                    <div class="mb-4">
                        <div class="section-title" style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--ct-text-muted);padding-bottom:.5rem;border-bottom:1px solid var(--ct-border);margin-bottom:14px;">
                            <i class="fas fa-layer-group mr-1" style="color:#f59e0b;"></i> Grade Level
                        </div>
                        <div class="form-group mb-0">
                            <label style="font-size:.8rem;font-weight:600;letter-spacing:.3px;color:var(--ct-text);margin-bottom:6px;display:block;">
                                Grade Level
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-graduation-cap" style="color:var(--ct-text-muted);"></i>
                                    </span>
                                </div>
                                <input type="text" name="grade_lvl" id="upd_grade_lvl"
                                       class="form-control"
                                       style="font-weight:600;background:var(--ct-surface-alt)!important;"
                                       readonly>
                            </div>
                            <span class="text-danger error-text or_no_error d-block mt-1" style="font-size:.78rem;"></span>
                        </div>
                    </div>

                    {{-- Fee Breakdown --}}
                    <div class="mb-4">
                        <div class="section-title" style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:var(--ct-text-muted);padding-bottom:.5rem;border-bottom:1px solid var(--ct-border);margin-bottom:14px;">
                            <i class="fas fa-coins mr-1" style="color:#f59e0b;"></i> Update Fee Amounts
                        </div>

                        <div class="row">
                            {{-- Registration Fee --}}
                            <div class="col-md-4 mb-3">
                                <div style="background:var(--ct-surface-alt);border:1px solid var(--ct-border);border-radius:var(--ct-radius-sm);padding:14px;">
                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                        <div style="width:28px;height:28px;border-radius:6px;background:rgba(16,185,129,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-clipboard-check" style="color:#10b981;font-size:.75rem;"></i>
                                        </div>
                                        <label for="upd_reg_fee" style="font-size:.8rem;font-weight:600;color:var(--ct-text);margin:0;">
                                            Registration Fee
                                        </label>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-weight:700;">₱</span>
                                        </div>
                                        <input type="number" min="0" step="0.01"
                                               id="upd_reg_fee" name="registration_fee"
                                               class="form-control"
                                               style="text-align:right;font-variant-numeric:tabular-nums;"
                                               placeholder="0.00"
                                               oninput="calcUpdatePayable()">
                                    </div>
                                </div>
                            </div>

                            {{-- Tuition Fee --}}
                            <div class="col-md-4 mb-3">
                                <div style="background:var(--ct-surface-alt);border:1px solid var(--ct-border);border-radius:var(--ct-radius-sm);padding:14px;">
                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                        <div style="width:28px;height:28px;border-radius:6px;background:rgba(79,70,229,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-book" style="color:var(--ct-primary);font-size:.75rem;"></i>
                                        </div>
                                        <label for="upd_tui_fee" style="font-size:.8rem;font-weight:600;color:var(--ct-text);margin:0;">
                                            Tuition Fee
                                        </label>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-weight:700;">₱</span>
                                        </div>
                                        <input type="number" min="0" step="0.01"
                                               id="upd_tui_fee" name="tuition_fee"
                                               class="form-control"
                                               style="text-align:right;font-variant-numeric:tabular-nums;"
                                               placeholder="0.00"
                                               oninput="calcUpdatePayable()">
                                    </div>
                                </div>
                            </div>

                            {{-- Uniform Fee --}}
                            <div class="col-md-4 mb-3">
                                <div style="background:var(--ct-surface-alt);border:1px solid var(--ct-border);border-radius:var(--ct-radius-sm);padding:14px;">
                                    <div class="d-flex align-items-center mb-2" style="gap:8px;">
                                        <div style="width:28px;height:28px;border-radius:6px;background:rgba(6,182,212,.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                            <i class="fas fa-tshirt" style="color:#06b6d4;font-size:.75rem;"></i>
                                        </div>
                                        <label for="upd_uni_fee" style="font-size:.8rem;font-weight:600;color:var(--ct-text);margin:0;">
                                            Uniform Fee
                                        </label>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="font-weight:700;">₱</span>
                                        </div>
                                        <input type="number" min="0" step="0.01"
                                               id="upd_uni_fee" name="uniform_fee"
                                               class="form-control"
                                               style="text-align:right;font-variant-numeric:tabular-nums;"
                                               placeholder="0.00"
                                               oninput="calcUpdatePayable()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Live Total Summary --}}
                    <div style="background:linear-gradient(135deg,rgba(245,158,11,.08),rgba(245,158,11,.04));border:1px solid rgba(245,158,11,.25);border-radius:var(--ct-radius);padding:16px 20px;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap:8px;">
                            <div>
                                <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--ct-text-muted);margin-bottom:2px;">
                                    <i class="fas fa-calculator mr-1"></i> Updated Total Payable
                                </div>
                                <div style="font-size:.8rem;color:var(--ct-text-muted);">
                                    Registration + Tuition + Uniform
                                </div>
                            </div>
                            <div id="upd_total_display"
                                 style="font-size:1.75rem;font-weight:800;color:#f59e0b;font-variant-numeric:tabular-nums;letter-spacing:-1px;">
                                ₱ 0.00
                            </div>
                        </div>
                        <input type="hidden" id="totalf" name="totalf" value="0">
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex justify-content-end mt-4 pt-3" style="gap:10px;border-top:1px solid var(--ct-border);">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </button>
                        <button type="submit" id="btnSave" class="btn btn-warning px-4" style="color:#fff;">
                            <i class="fas fa-save mr-2"></i> Update Payable
                        </button>
                    </div>

                </form>
            </div>{{-- /.modal-body --}}

        </div>
    </div>
</div>

<script>
    function calcUpdatePayable() {
        var reg = parseFloat(document.getElementById('upd_reg_fee').value) || 0;
        var tui = parseFloat(document.getElementById('upd_tui_fee').value) || 0;
        var uni = parseFloat(document.getElementById('upd_uni_fee').value) || 0;
        var total = reg + tui + uni;
        document.getElementById('totalf').value = total.toFixed(2);
        document.getElementById('upd_total_display').textContent =
            '₱ ' + total.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    /* Reset display when modal closes */
    $('#update_payable-modal').on('hidden.bs.modal', function () {
        document.getElementById('upd_total_display').textContent = '₱ 0.00';
    });
</script>
