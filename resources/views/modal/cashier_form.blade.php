<div class="modal cashierform fade" id="cashier-form">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Cashier Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form action="<?= route('update.payment') ?>" method="post" id="update-student-payment">

                    <div class="form-group">
                        <label>Official Receipt Number:</label>
                        <div class="form-group input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="&#x23;">&#x23;</i>
                                </span>
                            </div>
                            <input type="text" id="or_num" name="or_num" class="form-control">
                            <span class="text-danger error-text or_no_error"></span>
                        </div>

                        <div class="row">

                            <div class="col-sm-4">
                                <label>Tuition Fee</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="tui_fee" name="tui_fee" class="form-control" onInput="calculatesBalance()" readonly>
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
                                    <input type="text" id="uni_fee" name="uni_fee" class="form-control" onInput="calculatesBalance()" readonly>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label>Other Fees:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="oth_fee" name="oth_fee" class="form-control" onInput="calculatesBalance()">
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
                            <input type="text" id="totalf" name="totalf" class="form-control" onInput="calculatesBalance()" readonly>
                        </div>

                        <label>Amount Paid:</label>
                        <div class="input-group mb-3">
                            <div class="form-group input-group-prepend">
                                <span class="input-group-text">
                                    <i class="&#8369;">&#8369;</i>
                                </span>
                            </div>
                            <input type="text" id="amountp" name="amountp" class="form-control" onInput="calculatesBalance()">
                        </div>

                        <label>Balance:</label>
                        <div class="form-group input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="&#8369;">&#8369;</i>
                                </span>
                            </div>
                            <input type="text" id="balance" name="balance" class="form-control" value="0"
                                readonly>
                        </div>

                    </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" id="btnUpdate" class="btn btn-primary">Submit</button>
            </div>
            </form>

        </div>


    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<script>
    function calculatesBalance() {
        // Get values from input fields
        var tuitionFees = parseFloat(document.getElementById('tui_fee').value) || 0;
        var uniformFees = parseFloat(document.getElementById('uni_fee').value) || 0;
        var otherFeess = parseFloat(document.getElementById('oth_fee').value) || 0;

        // Calculate total fee
        var totalFees = tuitionFees + uniformFees + otherFeess;

        // Update the total fee field
        document.getElementById('totalf').value = totalFees.toFixed(2); // Round to 2 decimal places

        // Get amount paid
        var amountPaid = parseFloat(document.getElementById('amountp').value) || 0;

        // Calculate balance
        var balance = totalFees - amountPaid;

        // Update the balance field
        document.getElementById('balance').value = balance.toFixed(2); // Round to 2 decimal places
    }
    // let dateInput = document.getElementById("datep");
    // let isDateSelectionEnabled = false;

    // function toggleDateSelection() {
    //     isDateSelectionEnabled = !isDateSelectionEnabled;
    //     dateInput.disabled = !isDateSelectionEnabled;

    //     if (isDateSelectionEnabled) {
    //         dateInput.max = ""; // Allow selecting all past dates
    //     } else {
    //         dateInput.max = dateInput.value; // Restrict to the current date
    //     }
    // }

    function setCurrentDates() {
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
    }

    $('#modal-default').on('shown.bs.modal', function() {
        setCurrentDates();
    });

</script>
