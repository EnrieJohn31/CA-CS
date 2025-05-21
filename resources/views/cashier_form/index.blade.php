@extends('home.index')
@include('modal.extralarge-modal')
@section('content')
    <style>
        .payment-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            /* Optional: add a border between rows */
            padding: 10px 0;
        }

        .payment-rows {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .payment-description {
            flex: 1;
        }

        .payment-amount {
            flex: 0 0 auto;
        }
    </style>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <script src="{{ asset('assets/js/carmeljs/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cashier Main Form</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Cashier Form</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Payment Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('store.student.info') }}" method="POST" id="save-student-form">
                            @csrf
                            <div class="card-body row">

                                <div class="form-group col-md-2">
                                    <label for="Id_num">LRN-ID</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="Id_num" name="Id_num"
                                            placeholder="LRN-ID" oninput="validateIdNum(this)">
                                        <button type="button" class="btn btn-success editable" title="Lookup Students"
                                            data-bs-toggle="modal" data-bs-target="#ExtralargeModal"
                                            OnClick="openSearchStudent()">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- <div id="student-details" style="display: none;"> --}}

                                    <div class="form-group col-md-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" oninput="validateName(this)">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>

                                    <div class="col-sm-2">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Grade Level</label>
                                            <select class="form-control" id="lvl" name="lvl"
                                                onchange="toggleStrandInput(); updateRegistrationFee()">
                                                <option value="0" selected disabled>Choose</option>
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
                                            <span class="text-danger error-text lvl_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="section">Section</label>
                                        <input type="text" class="form-control" id="section" name="section"
                                            placeholder="Section" oninput="validateSection(this)">
                                        <span class="text-danger error-text section_error"></span>
                                    </div>

                                    <div id="strandContainer" class="form-group col-md-3" style="display:none">
                                        <label for="strand" id="strandlbl">Academic Track</label>
                                        <select class="form-control" id="strand" name="strand">
                                            <option value="0">Choose</option>
                                            <option value="STEM">STEM</option>
                                            <option value="ABM">ABM</option>
                                            <option value="ICT">ICT</option>
                                            <option value="HUMMS">HUMMS</option>
                                            <option value="GAS">GAS</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3" readonly>
                                        <label for="ay">Academic Year</label>
                                        <input type="text" class="form-control" id="ay" name="ay"
                                            placeholder="YYYY-YYYY" oninput="validateSchoolYear(this)">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="or_no">Official Receipt</label>
                                        <input type="text" class="form-control" id="or_no" name="or_no">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <div class="card card-outline card-primary collapsed-card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Fee Type</h3>

                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse">
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
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="reg_fee">
                                                                Registration Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="tui_fee" name="fee_type[]" value="tuition"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="tui_fee">
                                                                Tuition Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="uni_fee" name="fee_type[]" value="uniform"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="uni_fee">
                                                                Uniform Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Medical" name="fee_type[]" value="Medical"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Medical">
                                                                Medical Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Insurance" name="fee_type[]" value="Insurance"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Insurance">
                                                                Insurance Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Death" name="fee_type[]" value="Death"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Death">
                                                                Death Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Library" name="fee_type[]" value="Library"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Library">
                                                                Library Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="School_Pub" name="fee_type[]" value="School_Pub"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="School_Pub">
                                                                School-Pub Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Athlet" name="fee_type[]" value="Athlet"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Athlet">
                                                                Athlete Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="BACS" name="fee_type[]" value="BACS"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="BACS">
                                                                BACS Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Book" name="fee_type[]" value="Book"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Book">
                                                                Book Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Laboratory" name="fee_type[]" value="Laboratory"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Laboratory">
                                                                Laboratory Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="StudentID" name="fee_type[]" value="StudentID"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="StudentID">
                                                                StudentID Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Passbook" name="fee_type[]" value="Passbook"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Passbook">
                                                                Passbook Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Handbook" name="fee_type[]" value="Handbook"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Handbook">
                                                                Handbook Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Dental" name="fee_type[]" value="Dental"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Dental">
                                                                Dental Fee
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Completers_Fee" name="fee_type[]" value="Completers_Fee"
                                                                onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="Completers_Fee">
                                                                Completers Fee
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="graduation" name="fee_type[]" value="graduation" onclick="calculateTotalAmount()">
                                                            <label class="form-check-label" for="graduation">Graduation Fee</label>
                                                        </div>


                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>

                                            <div class="form-group col-md-4">
                                                <div class="card card-outline card-primary collapsed-card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Payment Details</h3>

                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="payment-row">
                                                            <div class="payment-description">Registration Fee</div>
                                                            <div class="payment-amount" id="reg_fees" name="reg_fee" value="registration"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Tuition Fee</div>
                                                            <div class="payment-amount" id="tui_fees" value="tuition"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Uniform Fee</div>
                                                            <div class="payment-amount" id="uni_fees" value="uniform"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Medical Fee</div>
                                                            <div class="payment-amount" id="Medical" name="Medical" value="Medicals"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Insurance Fee</div>
                                                            <div class="payment-amount" id="Insurance" name="Insurance" value="Insurances"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Sudden Death Fee</div>
                                                            <div class="payment-amount" id="Death" name="Death" value="Deaths"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Library Fee</div>
                                                            <div class="payment-amount" id="Library" name="Library" value="Librarys"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">School Publication Fee</div>
                                                            <div class="payment-amount" id="School_Pub" name="School_Pub" value="School_Pubs"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Athlete Fee</div>
                                                            <div class="payment-amount" id="Athlet" name="Athlet" value="Athlets"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">BACS Fee</div>
                                                            <div class="payment-amount" id="BACS" name="BACS" value="BACSs"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Book Fee</div>
                                                            <div class="payment-amount" id="Book" name="Book" value="Books"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Laboratory Fee</div>
                                                            <div class="payment-amount" id="Laboratory" name="Laboratory" value="Laboratorys"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">StudentID Fee</div>
                                                            <div class="payment-amount" id="StudentID" name="StudentID" value="StudentIDs"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Passbook Fee</div>
                                                            <div class="payment-amount" id="Passbook" name="Passbook" value="Passbooks"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Handbook Fee</div>
                                                            <div class="payment-amount" id="Handbook" name="Handbook" value="Handbooks"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Dental Fee</div>
                                                            <div class="payment-amount" id="Dental" name="Dental" value="Dentals"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Completers Fee</div>
                                                            <div class="payment-amount" id="Completers_Fee" name="Completers_Fee" value="Completers_Fees"></div>
                                                        </div>
                                                        <div class="payment-row">
                                                            <div class="payment-description">Graduation Fee</div>
                                                            <input type="text" class="form-control" id="graduation" name="graduation" placeholder="" hidden>
                                                            <div class="payment-amount" id="graduation" name="graduation" value="graduations"></div>
                                                        </div>
                                                        <div class="payment-rows">
                                                            <div class="payment-description">Total Amount</div>
                                                            <div class="payment-amount" id="total_payment_amount"></div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                            <div class="form-group col-md-2" id="fee_amounts_reg" hidden>
                                                <input type="text" class="form-control" id="registration" name="reg_fee" readonly>

                                                <input type="text" class="form-control" id="tuition" name="tui_fee" readonly>

                                                <input type="text" class="form-control" id="uniform" name="uni_fee" readonly>

                                                <input type="text" class="form-control" id="Medicals" name="Medical"  readonly>

                                                <input type="text" class="form-control" id="Insurances" name="Insurance" readonly>

                                                <input type="text" class="form-control" id="Deaths" name="Death" readonly>

                                                <input type="text" class="form-control" id="Librarys" name="Library" readonly>

                                                <input type="text" class="form-control" id="School_Pubs" name="School_Pub" readonly>

                                                <input type="text" class="form-control" id="Athlets" name="Athlet" readonly>

                                                <input type="text" class="form-control" id="BACSs" name="BACS" readonly>

                                                <input type="text" class="form-control" id="Books" name="Book" readonly>

                                                <input type="text" class="form-control" id="Laboratorys" name="Laboratory" readonly>

                                                <input type="text" class="form-control" id="StudentIDs" name="StudentID" readonly>

                                                <input type="text" class="form-control" id="Passbooks" name="Passbook" readonly>

                                                <input type="text" class="form-control" id="Handbooks" name="Handbook" readonly>

                                                <input type="text" class="form-control" id="Dentals" name="Dental" readonly>

                                                <input type="text" class="form-control" id="Completers_Fees" name="Completers_Fee" readonly>

                                                <input type="text" class="form-control" id="Graduation_Fees" name="Graduation_Fee" readonly>
                                            </div>


                                            <div class="form-group col-md-2" id="fee_amounts" hidden>
                                                <label for="total_amount">Total Amount</label>
                                                <input type="text" class="form-control" id="total_amount"
                                                    name="total_amount" placeholder="" readonly>
                                            </div>

                                        </div>
                                    </div>

                                {{-- </div> --}}
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Set Payment</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function toggleGraduationFee() {
        var selectedGrade = document.getElementById('lvl').value;
        var graduationFeeCheckbox = document.querySelector('.graduation-fee-checkbox');

        // If Grade 12 is selected, show the graduation fee checkbox; otherwise, hide it
        if (selectedGrade === '12') {
            graduationFeeCheckbox.style.display = 'block';
        } else {
            graduationFeeCheckbox.style.display = 'none';
        }
    }

    // Call toggleGraduationFee() when the grade level selection changes
    document.getElementById('lvl').addEventListener('change', toggleGraduationFee);

    // Call toggleGraduationFee() once the page loads
    window.addEventListener('load', toggleGraduationFee);


        function toggleStudentDetailsVisibility() {
            var studentDetails = document.getElementById('student-details');
            var lrnInput = document.getElementById('Id_num');

            if (lrnInput.value !== '') {
                studentDetails.style.display = 'block';
            } else {
                studentDetails.style.display = 'none';
            }
        }


        document.getElementById('Id_num').addEventListener('input', toggleStudentDetailsVisibility);

        function calculateTotalAmount() {
            var totalAmount = 0;

            // Initialize payment amounts to 0
            var registrationAmount = 0;
            var tuitionAmount = 0;
            var uniformAmount = 0;
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
                registrationAmount = parseFloat($("#reg_fee").val()) || 0;
                totalAmount += registrationAmount;
                $("#registration").val(parseFloat($("#reg_fee").val()).toFixed(2));
            }
            if ($("#tui_fee").is(":checked")) {
                tuitionAmount = parseFloat($("#tui_fee").val()) || 0;
                totalAmount += tuitionAmount;
                $("#tuition").val(parseFloat($("#tui_fee").val()).toFixed(2));
            }
            if ($("#uni_fee").is(":checked")) {
                uniformAmount = parseFloat($("#uni_fee").val()) || 0;
                totalAmount += uniformAmount;
                $("#uniform").val(parseFloat($("#uni_fee").val()).toFixed(2));
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
                totalAmount += deathAmount;
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
                passbookAmount  = parseFloat($("#Passbook").val()) || 0;
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
            $(".payment-amount[value='tuition']").text(tuitionAmount.toFixed(2));
            $(".payment-amount[value='uniform']").text(uniformAmount.toFixed(2));
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
            $(".payment-amount[value='Passbooks']").text(passbookAmount .toFixed(2));
            $(".payment-amount[value='Handbooks']").text(handbookAmount .toFixed(2));
            $(".payment-amount[value='Dentals']").text(dentalAmount.toFixed(2));
            $(".payment-amount[value='Completers_Fees']").text(completersFeeAmount.toFixed(2));
            $(".payment-amount[value='graduations']").text(graduationAmount.toFixed(2));

            // Update total amount in payment details
            $("#total_payment_amount").text(totalAmount.toFixed(2));

            $("#registration").val(registrationAmount.toFixed(2));
            $("#tuition").val(tuitionAmount.toFixed(2));
            $("#uniform").val(uniformAmount.toFixed(2));
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

        // Trigger calculation on checkbox change
        $('input[name="fee_type[]"]').on('change', calculateTotalAmount);

        function restrictToDigits(phonenumber) {
            const element = document.getElementById(phonenumber);

            element.addEventListener('input', function() {
                // Remove non-digit characters
                this.value = this.value.replace(/\D/g, '');
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            restrictToDigits('phonenumber');
        });

        function toggleStrandInput() {
            const gradeLevelSelect = document.getElementById('lvl');
            const strandContainer = document.getElementById('strandContainer');
            const selectedValue = gradeLevelSelect.value;

            // Define an array of grade levels that should show the strand input
            const showStrandLevels = ['11', '12'];

            // Check if the selected grade level is in the showStrandLevels array
            if (showStrandLevels.includes(selectedValue)) {
                // Show the "Strand" input field
                strandContainer.style.display = 'block';
            } else {
                // Hide the "Strand" input field
                strandContainer.style.display = 'none';
                // Clear the strand input value
                document.getElementById('strand').value = 'Choose';
            }
        }

        function saveStudent() {
            $('#save-student-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.code == 0) {
                            toastr.error("Student has not been added");
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            // Clear the form
                            $(form)[0].reset();
                            // Reload your DataTable to refresh the data
                            $('#student-table').DataTable().ajax.reload();
                            toastr.success(data.msg);
                        }
                    }
                });
            });
        }

        function validateIdNum(inputField) {
            var inputValue = inputField.value;
            var numericValue = inputValue.replace(/[^0-9]/g, ''); // Remove non-numeric characters

            // Update the input field value to contain only numeric characters
            inputField.value = numericValue;

            // Display an error message if non-numeric characters were entered
            var errorText = document.querySelector('.Id_num_error');
            if (inputValue !== numericValue) {
                errorText.textContent = "Only numeric characters are allowed.";
            } else {
                errorText.textContent = ""; // Clear the error message
            }
        }

        function validateName(inputField) {
            var inputValue = inputField.value;
            var alphabeticValue = inputValue.replace(/[^A-Za-z\s.]/g, ''); // Remove non-alphabetic characters and spaces

            // Update the input field value to contain only alphabetic characters and spaces
            inputField.value = alphabeticValue;

            // Display an error message if non-alphabetic characters or numbers were entered
            var errorText = document.querySelector('.name_error');
            if (inputValue !== alphabeticValue) {
                errorText.textContent = "Only letters and spaces are allowed.";
            } else {
                errorText.textContent = ""; // Clear the error message
            }
        }

        function validateSection(inputField) {
            var inputValue = inputField.value;
            var alphabeticValue = inputValue.replace(/[^A-Za-z\s.]/g, ''); // Remove non-alphabetic characters and spaces

            // Update the input field value to contain only alphabetic characters and spaces
            inputField.value = alphabeticValue;

            // Display an error message if non-alphabetic characters or numbers were entered
            var errorText = document.querySelector('.section_error');
            if (inputValue !== alphabeticValue) {
                errorText.textContent = "Only letters and spaces are allowed.";
            } else {
                errorText.textContent = ""; // Clear the error message
            }
        }


        function validateSchoolYear(inputField) {
            var inputValue = inputField.value;
            var currentYear = new Date().getFullYear(); // Get the current year

            // Check if the input matches the expected format (YYYY-YYYY)
            if (!/^\d{4}-\d{4}$/.test(inputValue)) {
                // If the input doesn't match the format, set it to a default value
                inputField.value = "2023-2024"; // Set it to the initial year
            } else {
                var years = inputValue.split('-');
                var startYear = parseInt(years[0]);
                var endYear = parseInt(years[1]);

                // Check if the input is earlier than the current year or has the end year earlier than the start year
                if (startYear < 2023 || endYear < 2023 || endYear <= startYear) {
                    inputField.value = "2023-2024"; // Set it to the initial year
                }
            }
            // Display an error message if the input is not in the correct format or has years earlier than 2023 or the end year earlier than the start year
            var errorText = document.querySelector('.ay_error');
            if (!/^\d{4}-\d{4}$/.test(inputField.value) || startYear < 2023 || endYear < 2023 || endYear <= startYear) {
                errorText.textContent =
                    "Enter a valid academic year (YYYY-YYYY) starting from 2023 and in the correct format.";
            } else {
                errorText.textContent = ""; // Clear the error message
            }
        }
        // Call the saveStudent function to bind the form submission event
        saveStudent();

        function generateSequentialNumber() {
            var lastNumber = localStorage.getItem('lastNumber'); // Get the last used number from localStorage
            var currentNumber = parseInt(lastNumber) ||
            0; // Convert the last used number to integer, or start at 0 if it's null

            currentNumber++; // Increment the current number
            localStorage.setItem('lastNumber', currentNumber); // Store the updated number in localStorage

            return currentNumber.toString().padStart(6, '0'); // Pad the number with leading zeros to ensure 6 digits
        }

        // Set the value of or_no field to a sequential number on page load
        document.addEventListener('DOMContentLoaded', function() {
            var orNoInput = document.getElementById('or_no');
            orNoInput.value = generateSequentialNumber();
        });
    </script>
@endsection
