<div class="modal setupdatepayable fade" id="update_payable-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Grade Level Payable</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form action="<?= route('setting.update') ?>" method="post" id="update-student-payable">

                    <input type="hidden" id="id" name="sid" />
                    <br>
                    <!-- Date -->

                    <div class="form-group">
                        <label>Grade Level</label>
                        <div class="form-group input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="&#x23;">&#x23;</i>
                                </span>
                            </div>
                            <input type="text" id="grade_lvl" name="grade_lvl" class="form-control">
                            <span class="text-danger error-text or_no_error"></span>
                        </div>

                        <div class="row">

                            <div class="col-sm-4">
                                <label>Registration Fee</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="registration_fee" name="registration_fee" class="form-control"
                                        onInput="calculateBalance()">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Tuition Fee:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="tuition_fee" name="tuition_fee" class="form-control"
                                        onInput="calculateBalance()">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Uniform:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="uniform_fee" name="uniform_fee" class="form-control"
                                        onInput="calculateBalance()">
                                </div>
                            </div>
                        </div>

                        <label>Total Fee:</label>
                        <div class="input-group mb-3">
                            <div class="form-group input-group-prepend">
                                <span class="input-group-text">
                                    <i class="&#8369;">&#8369;</i>
                                </span>
                            </div>
                            <input type="text" id="totalf" name="totalf" class="form-control"
                                onInput="calculateBalance()" readonly>
                        </div>

                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Save changes</button>
            </div>
            </form>

        </div>


    </div>
    <!-- /.modal-content -->
</div>

