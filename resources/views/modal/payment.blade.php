<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="modal editStudent fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Payment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Button to Enable/Disable Date Selection -->
                <button id="enableDateButton" onclick="toggleDateSelection()" class="btn btn-danger">Enable Past
                    Dates</button>

                <form action="<?= route('update.payment') ?>" method="post" id="update-student-payment">

                    <input type="hidden" id="id" name="sid" />
                    <br>

                    {{-- <div class="form-group">
                        <label>Date:</label>
                        <div class="form-group input-group date" id="reservationdate" data-target-input="nearest">
                            <input name="datep" id="datep" type="date" style="color-scheme: dark;"
                                class="form-control datetimepicker-input" data-target="#reservationdate" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label>Date:</label>
                        <div class="form-group input-group date" id="reservationdate" data-target-input="nearest">
                            <input name="datep" id="datep" type="date" style="color-scheme: dark;"
                                class="form-control datetimepicker-input" data-target="#reservationdate"
                                min="<?= date('m-d-Y') ?>" disabled />
                        </div>
                    </div>

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

                        <div class="form-group col-md-12">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <div class="card card-outline card-primary collapsed-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Fee Type</h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="reg_fee" name="fee_type[]" value="registration"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="reg_fee">
                                                    Registration Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Medical"
                                                    name="fee_type[]" value="150" onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Medical">
                                                    Medical Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Insurance"
                                                    name="fee_type[]" value="300"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Insurance">
                                                    Insurance Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Death"
                                                    name="fee_type[]" value="450" onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Death">
                                                    Death Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Library"
                                                    name="fee_type[]" value="600" onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Library">
                                                    Library Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="School_Pub"
                                                    name="fee_type[]" value="750"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="School_Pub">
                                                    School-Pub Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Athlet"
                                                    name="fee_type[]" value="950"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Athlet">
                                                    Athlete Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="BACS"
                                                    name="fee_type[]" value="1100"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="BACS">
                                                    BACS Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Book"
                                                    name="fee_type[]" value="1250"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Book">
                                                    Book Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Laboratory"
                                                    name="fee_type[]" value="1450"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Laboratory">
                                                    Laboratory Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="StudentID"
                                                    name="fee_type[]" value="1550"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="StudentID">
                                                    StudentID Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Passbook"
                                                    name="fee_type[]" value="1700"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Passbook">
                                                    Passbook Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Handbook"
                                                    name="fee_type[]" value="1850"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Handbook">
                                                    Handbook Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Dental"
                                                    name="fee_type[]" value="1900"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Dental">
                                                    Dental Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="Completers_Fee"
                                                    name="fee_type[]" value="2050"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="Completers_Fee">
                                                    Completers Fee
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="graduation"
                                                    name="fee_type[]" value="2200"
                                                    onclick="calculateTotalAmount(); calculateBalance()">
                                                <label class="form-check-label" for="graduation">Graduation
                                                    Fee</label>
                                            </div>


                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>

                                <div class="form-group col-md-2" id="fee_amounts_reg" hidden>

                                    <input type="text" class="form-control" id="registration" name="reg_fee" readonly>

                                    <input type="text" class="form-control" id="Medicals" name="Medical"
                                        readonly>

                                    <input type="text" class="form-control" id="Insurances" name="Insurance"
                                        readonly>

                                    <input type="text" class="form-control" id="Deaths" name="Death"
                                        readonly>

                                    <input type="text" class="form-control" id="Librarys" name="Library"
                                        readonly>

                                    <input type="text" class="form-control" id="School_Pubs" name="School_Pub"
                                        readonly>

                                    <input type="text" class="form-control" id="Athlets" name="Athlet"
                                        readonly>

                                    <input type="text" class="form-control" id="BACSs" name="BACS"
                                        readonly>

                                    <input type="text" class="form-control" id="Books" name="Book"
                                        readonly>

                                    <input type="text" class="form-control" id="Laboratorys" name="Laboratory"
                                        readonly>

                                    <input type="text" class="form-control" id="StudentIDs" name="StudentID"
                                        readonly>

                                    <input type="text" class="form-control" id="Passbooks" name="Passbook"
                                        readonly>

                                    <input type="text" class="form-control" id="Handbooks" name="Handbook"
                                        readonly>

                                    <input type="text" class="form-control" id="Dentals" name="Dental"
                                        readonly>

                                    <input type="text" class="form-control" id="Completers_Fees"
                                        name="Completers_Fee" readonly>

                                    <input type="text" class="form-control" id="Graduation_Fees"
                                        name="Graduation_Fee" readonly>
                                </div>

                                <div class="form-group col-md-6" id="fee_amounts">
                                    <label for="total_amount">Full Total Amount</label>
                                    <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                                </div>
                            </div>

                            {{-- This here will be the code for the monthly payment --}}
                            <div class="form-group col-md-6">
                                <div class="card card-outline card-primary collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">Select Monthly Tuition</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="january" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="january">January</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="february" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="february">February</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="march" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="march">March</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="april" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="april">April</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="may" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="may">May</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="june" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="june">June</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="july" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="july">July</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="august" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="august">August</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="september" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="september">September</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="october" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="october">October</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="november" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="november">November</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="december" name="tuition_fee"
                                            onclick="TuitionsTotalAmount(); calculateBalance()">
                                            <label class="form-check-label" for="december">December</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4" id="fee_months_reg" hidden>

                                    <input type="text" class="form-control" id="januarys" name="january" readonly>

                                    <input type="text" class="form-control" id="februarys" name="february" readonly>

                                    <input type="text" class="form-control" id="marchs" name="march" readonly>

                                    <input type="text" class="form-control" id="aprils" name="april"  readonly>

                                    <input type="text" class="form-control" id="mays" name="may" readonly>

                                    <input type="text" class="form-control" id="junes" name="june" readonly>

                                    <input type="text" class="form-control" id="julys" name="july" readonly>

                                    <input type="text" class="form-control" id="augusts" name="august" readonly>

                                    <input type="text" class="form-control" id="septembers" name="september" readonly>

                                    <input type="text" class="form-control" id="octobers" name="october" readonly>

                                    <input type="text" class="form-control" id="novembers" name="november" readonly>

                                    <input type="text" class="form-control" id="decembers" name="december" readonly>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-6">
                                <label>Tuition Fee</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="tui_fees" name="tui_fee" class="form-control"
                                        onInput="calculateBalance(); TuitionsTotalAmount()" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label>Uniform:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="uni_fee" name="uni_fee" class="form-control"
                                        onInput="calculateBalance()">
                                </div>
                            </div>

                            <div class="col-sm-4" hidden>
                                <label>Registration:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="regs_fee" name="regs_fee" class="form-control"
                                        onInput="calculateBalance()" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label>Previous Total Payment:</label>
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

                            <div class="col-sm-6">
                                <label>Other Fees:</label>
                                <div class="input-group mb-3">
                                    <div class="form-group input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="&#8369;">&#8369;</i>
                                        </span>
                                    </div>
                                    <input type="text" id="oth_fee" name="oth_fee" class="form-control"
                                        onInput="calculateBalance()">
                                </div>
                            </div>

                        </div>

                        <label>Full Total Fee:</label>
                        <div class="input-group mb-3">
                            <div class="form-group input-group-prepend">
                                <span class="input-group-text">
                                    <i class="&#8369;">&#8369;</i>
                                </span>
                            </div>
                            <input type="text" id="fulltotalf" name="fulltotalf" class="form-control"
                                onInput="calculateBalance()" readonly>
                        </div>

                        <label>Amount Paid:</label>
                        <div class="input-group mb-3">
                            <div class="form-group input-group-prepend">
                                <span class="input-group-text">
                                    <i class="&#8369;">&#8369;</i>
                                </span>
                            </div>
                            <input type="text" id="amountp" name="amountp" class="form-control"
                                onInput="calculateBalance()">
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
                        <div>
                            <label>Change:</label>
                            <div class="form-group input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="&#8369;">&#8369;</i>
                                    </span>
                                </div>
                                <input type="text" id="change" name="change" class="form-control"
                                    value="0" readonly>
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
    function calculateBalance() {
        // Get values from input fields
        var tuitionFee = parseFloat(document.getElementById('tui_fees').value) || 0;
        var totalfFee = parseFloat(document.getElementById('totalf').value) || 0;
        var otherFees = parseFloat(document.getElementById('oth_fee').value) || 0;
        var Uniform_fee = parseFloat(document.getElementById('uni_fee').value) || 0;
        var checkedFees = parseFloat(document.getElementById('total_amount').value) || 0;
        // Calculate total fee
       // var totalFee = otherFees + totalfFee + checkedFees;
       var totalFee = otherFees + tuitionFee + checkedFees + Uniform_fee;


        // Update the total fee field
        document.getElementById('fulltotalf').value = totalFee.toFixed(2); // Round to 2 decimal places

        // Get amount paid
        var amountPaid = parseFloat(document.getElementById('amountp').value) || 0;

        // Calculate balance (ensure balance is zero or positive)
        var balance = Math.max(0, totalFee - amountPaid);

        // Update the balance field
        document.getElementById('balance').value = balance.toFixed(2); // Round to 2 decimal places

        // Calculate change
        var change = amountPaid - totalFee;

        // Update the change field
        document.getElementById('change').value = Math.max(0, change.toFixed(
        2)); // Round to 2 decimal places and ensure change is zero or positive
    }

    let dateInput = document.getElementById("datep");
    let isDateSelectionEnabled = false;

    function toggleDateSelection() {
        isDateSelectionEnabled = !isDateSelectionEnabled;
        dateInput.disabled = !isDateSelectionEnabled;

        if (isDateSelectionEnabled) {
            dateInput.max = ""; // Allow selecting all past dates
        } else {
            dateInput.max = dateInput.value; // Restrict to the current date
        }
    }

    function setCurrentDate() {
        const today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
    }

    $('#modal-default').on('shown.bs.modal', function() {
        setCurrentDate();
    });
    // Function to validate the Official Receipt Number
    function validateReceiptNumber(input) {
        // Remove non-numeric characters
        var value = input.value.replace(/\D/g, '');

        // Restrict to 6 digits
        value = value.slice(0, 6);

        // Get the set of all used Official Receipt Numbers
        var allUsedOrNumbers = new Set(document.getElementById('all_used_or_numbers').value.split(','));

        // Check if the number already exists
        if (allUsedOrNumbers.has(value)) {
            alert('Official Receipt Number already entered. Please enter a different number.');
            input.value = ''; // Clear the input
            return;
        }

        // Update the input value
        input.value = value;

        // Add the number to the set of all used Official Receipt Numbers
        allUsedOrNumbers.add(value);

        // Update the hidden input with the new set of all used Official Receipt Numbers
        document.getElementById('all_used_or_numbers').value = Array.from(allUsedOrNumbers).join(',');
    }

    function calculateTotalAmount() {
        var totalAmount = 0;

        // Initialize payment amounts to 0
        var registrationAmount = 0;
        var graduationAmount = 0;
        var medicalAmount = 0;
        var insuranceAmount = 0;
        var deathAmount = 0;
        var libraryAmount = 0;
        var schoolPubAmount = 0;
        var athletAmount = 0;
        var bacsAmount = 0;
        var bookAmount = 0;
        var laboratoryAmount = 0;
        var studentIDAmount = 0;
        var passbookAmount = 0;
        var handbookAmount = 0;
        var dentalAmount = 0;
        var completersFeeAmount = 0;

        if ($("#reg_fee").is(":checked")) {
                registrationAmount = parseFloat($("#regs_fee").val()) || 0;
                totalAmount += registrationAmount;
                $("#registration").val(parseFloat($("#reg_fee").val()).toFixed(2));
            }
        if ($("#Medical").is(":checked")) {
            medicalAmount = parseFloat($("#Medical").val()) || 0;
            totalAmount += medicalAmount;
            $("#Medicals").val(parseFloat($("#Medical").val()).toFixed(2));
        }
        if ($("#Insurance").is(":checked")) {
            insuranceAmount = parseFloat($("#Insurance").val()) || 0;
            totalAmount += insuranceAmount;
            $("#Insurances").val(parseFloat($("#Insurance").val()).toFixed(2));
        }
        if ($("#Library").is(":checked")) {
            libraryAmount = parseFloat($("#Library").val()) || 0;
            totalAmount += libraryAmount;
            $("#Librarys").val(parseFloat($("#Library").val()).toFixed(2));
        }
        if ($("#Death").is(":checked")) {
            deathAmount = parseFloat($("#Death").val()) || 0;
            totalAmount += deathAmount;
            $("#Deaths").val(parseFloat($("#Death").val()).toFixed(2));
        }

        if ($("#School_Pub").is(":checked")) {
            schoolPubAmount = parseFloat($("#School_Pub").val()) || 0;
            totalAmount += schoolPubAmount;
            $("#School_Pubs").val(parseFloat($("#Medical").val()).toFixed(2));
        }
        if ($("#Athlet").is(":checked")) {
            athletAmount = parseFloat($("#Athlet").val()) || 0;
            totalAmount += athletAmount;
        }
        if ($("#BACS").is(":checked")) {
            bacsAmount = parseFloat($("#BACS").val()) || 0;
            totalAmount += bacsAmount;
        }
        if ($("#Book").is(":checked")) {
            bookAmount = parseFloat($("#Book").val()) || 0;
            totalAmount += bookAmount;
        }
        if ($("#Laboratory").is(":checked")) {
            laboratoryAmount = parseFloat($("#Laboratory").val()) || 0;
            totalAmount += laboratoryAmount;
        }
        if ($("#StudentID").is(":checked")) {
            studentIDAmount = parseFloat($("#StudentID").val()) || 0;
            totalAmount += studentIDAmount;
        }
        if ($("#Passbook").is(":checked")) {
            passbookAmount = parseFloat($("#Passbook").val()) || 0;
            totalAmount += passbookAmount;
        }
        if ($("#Handbook").is(":checked")) {
            handbookAmount = parseFloat($("#Handbook").val()) || 0;
            totalAmount += handbookAmount;
        }
        if ($("#Dental").is(":checked")) {
            dentalAmount = parseFloat($("#Dental").val()) || 0;
            totalAmount += dentalAmount;
        }
        if ($("#Completers_Fee").is(":checked")) {
            completersFeeAmount = parseFloat($("#Completers_Fee").val()) || 0;
            totalAmount += completersFeeAmount;
        }
        if ($("#graduation").is(":checked")) {
            graduationAmount = parseFloat($("#graduation").val()) || 0;
            totalAmount += graduationAmount;
        }

        // Update payment details section
        $(".payment-amount[value='registration']").text(registrationAmount.toFixed(2));
        $(".payment-amount[value='Medicals']").text(medicalAmount.toFixed(2));
        $(".payment-amount[value='Insurances']").text(insuranceAmount.toFixed(2));
        $(".payment-amount[value='Deaths']").text(deathAmount.toFixed(2));
        $(".payment-amount[value='Librarys']").text(libraryAmount.toFixed(2));
        $(".payment-amount[value='School_Pubs']").text(schoolPubAmount.toFixed(2));
        $(".payment-amount[value='Athlets']").text(athletAmount.toFixed(2));
        $(".payment-amount[value='BACSs']").text(bacsAmount.toFixed(2));
        $(".payment-amount[value='Books']").text(bookAmount.toFixed(2));
        $(".payment-amount[value='Laboratorys']").text(laboratoryAmount.toFixed(2));
        $(".payment-amount[value='StudentIDs']").text(studentIDAmount.toFixed(2));
        $(".payment-amount[value='Passbooks']").text(passbookAmount.toFixed(2));
        $(".payment-amount[value='Handbooks']").text(handbookAmount.toFixed(2));
        $(".payment-amount[value='Dentals']").text(dentalAmount.toFixed(2));
        $(".payment-amount[value='Completers_Fees']").text(completersFeeAmount.toFixed(2));
        $(".payment-amount[value='graduations']").text(graduationAmount.toFixed(2));

        // Update total amount in payment details
        $("#total_payment_amount").val(totalAmount.toFixed(2));

        $("#Medicals").val(medicalAmount.toFixed(2));
        $("#Insurances").val(insuranceAmount.toFixed(2));
        $("#Deaths").val(deathAmount.toFixed(2));
        $("#Librarys").val(libraryAmount.toFixed(2));
        $("#School_Pubs").val(schoolPubAmount.toFixed(2));
        $("#Athlets").val(athletAmount.toFixed(2));
        $("#BACSs").val(bacsAmount.toFixed(2));
        $("#Books").val(bookAmount.toFixed(2));
        $("#Laboratorys").val(laboratoryAmount.toFixed(2));

        $("#StudentIDs").val(studentIDAmount.toFixed(2));
        $("#Passbooks").val(passbookAmount.toFixed(2));
        $("#Handbooks").val(handbookAmount.toFixed(2));
        $("#Dentals").val(dentalAmount.toFixed(2));
        $("#Completers_Fees").val(completersFeeAmount.toFixed(2));
        $("#Graduation_Fees").val(graduationAmount.toFixed(2));

        // Update total amount input field
        $("#total_amount").val(totalAmount.toFixed(2));

    }

    function TuitionsTotalAmount() {
        var tuitiontotalAmount = 0;

        var januaryAmount = 0;
        var februaryAmount = 0;
        var marchAmount = 0;
        var aprilAmount = 0;
        var mayAmount = 0;
        var juneAmount = 0;
        var julyAmount = 0;
        var augustAmount = 0;
        var septemberAmount = 0;
        var OctoberAmount = 0;
        var novemberAmount = 0;
        var decemberAmount = 0;

        if ($("#january").is(":checked")) {
            januaryAmount = parseFloat($("#january").val()) || 0;
            tuitiontotalAmount += januaryAmount;
            }
        if ($("#february").is(":checked")) {
            februaryAmount = parseFloat($("#february").val()) || 0;
            tuitiontotalAmount += februaryAmount;
        }
        if ($("#march").is(":checked")) {
            marchAmount = parseFloat($("#march").val()) || 0;
            tuitiontotalAmount += marchAmount;
        }

        if ($("#april").is(":checked")) {
            aprilAmount = parseFloat($("#april").val()) || 0;
            tuitiontotalAmount += aprilAmount;
        }
        if ($("#may").is(":checked")) {
            mayAmount = parseFloat($("#may").val()) || 0;
            tuitiontotalAmount += mayAmount;
        }

        if ($("#june").is(":checked")) {
            juneAmount = parseFloat($("#june").val()) || 0;
            tuitiontotalAmount += juneAmount;
        }

        if ($("#july").is(":checked")) {
            julyAmount = parseFloat($("#july").val()) || 0;
            tuitiontotalAmount += julyAmount;
        }
        if ($("#august").is(":checked")) {
            augustAmount = parseFloat($("#august").val()) || 0;
            tuitiontotalAmount += augustAmount;
        }
        if ($("#september").is(":checked")) {
            septemberAmount = parseFloat($("#september").val()) || 0;
            tuitiontotalAmount += septemberAmount;
        }
        if ($("#october").is(":checked")) {
            OctoberAmount = parseFloat($("#october").val()) || 0;
            tuitiontotalAmount += OctoberAmount;
        }
        if ($("#november").is(":checked")) {
            novemberAmount = parseFloat($("#november").val()) || 0;
            tuitiontotalAmount += novemberAmount;
        }
        if ($("#december").is(":checked")) {
            decemberAmount = parseFloat($("#december").val()) || 0;
            tuitiontotalAmount += decemberAmount;
        }

        // Update payment details section
        $("#januarys").val(januaryAmount.toFixed(2));
        $("#februarys").val(februaryAmount.toFixed(2));
        $("#marchs").val(marchAmount.toFixed(2));
        $("#aprils").val(aprilAmount.toFixed(2));
        $("#mays").val(mayAmount.toFixed(2));
        $("#junes").val(juneAmount.toFixed(2));
        $("#julys").val(julyAmount.toFixed(2));
        $("#augusts").val(augustAmount.toFixed(2));
        $("#septembers").val(septemberAmount.toFixed(2));
        $("#octobers").val(OctoberAmount.toFixed(2));
        $("#novembers").val(novemberAmount.toFixed(2));
        $("#decembers").val(decemberAmount.toFixed(2));

        // Update total amount in payment details
        $("#tui_fees").val(tuitiontotalAmount.toFixed(2));

        // $("#januarys").val(medicalAmount.toFixed(2));
        // $("#Insurances").val(insuranceAmount.toFixed(2));
        // $("#Deaths").val(deathAmount.toFixed(2));
        // $("#Librarys").val(libraryAmount.toFixed(2));
        // $("#School_Pubs").val(schoolPubAmount.toFixed(2));
        // $("#Athlets").val(athletAmount.toFixed(2));
        // $("#BACSs").val(bacsAmount.toFixed(2));
        // $("#Books").val(bookAmount.toFixed(2));
        // $("#Laboratorys").val(laboratoryAmount.toFixed(2));

        // $("#StudentIDs").val(studentIDAmount.toFixed(2));
        // $("#Passbooks").val(passbookAmount.toFixed(2));
        // $("#Handbooks").val(handbookAmount.toFixed(2));
        // $("#Dentals").val(dentalAmount.toFixed(2));
        // $("#Completers_Fees").val(completersFeeAmount.toFixed(2));
        // $("#Graduation_Fees").val(graduationAmount.toFixed(2));

        // Update total amount input field
        // $("#total_amount").val(totalAmount.toFixed(2));

    }
</script>
