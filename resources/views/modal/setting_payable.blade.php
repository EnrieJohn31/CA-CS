<div class="modal settingpay fade" id="payable-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Grade Level Payable</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form action="<?= route('setting.set') ?>" method="post" id="student-payables">
                    @csrf
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
                            <span class="text-danger error-text grade_lvl_error"></span>
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
                                    <input type="text" id="registration_fee" name="registration_fee"
                                        class="form-control" onInput="calculateBalance()">
                                    <span class="text-danger error-text registration_fee_error"></span>
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
                                    <span class="text-danger error-text tuition_fee_error"></span>
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
                                    <span class="text-danger error-text uniform_fee_error"></span>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <label>Total Fee:</label>
                            <div class="input-group mb-3">
                                <div class="form-group input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="&#8369;">&#8369;</i>
                                    </span>
                                </div>
                                <input type="text" id="total_fee" class="form-control" readonly>
                            </div>
                        </div>


                    </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

        </div>


    </div>
    <!-- /.modal-content -->
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function calculateBalance() {
        // Get the values of registration, tuition, and uniform fees
        var registrationFee = parseFloat(document.getElementById('registration_fee').value) || 0;
        var tuitionFee = parseFloat(document.getElementById('tuition_fee').value) || 0;
        var uniformFee = parseFloat(document.getElementById('uniform_fee').value) || 0;

        // Calculate the total fee
        var totalFee = registrationFee + tuitionFee + uniformFee;

        // Display the total fee
        document.getElementById('total_fee').value = totalFee.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
    }

    function savePayable() {
        $('#student-payables').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            alert("Submit");
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
                        toastr.error("Payable has not been added");
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        // Clear the form
                        $(form)[0].reset();
                        // Reload your DataTable to refresh the data
                        $('#payables-table').DataTable().ajax.reload();
                        toastr.success(data.msg);
                    }
                }
            });
        });
    }

    // Call the savePayable function to bind the form submission event
    savePayable();

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
</script>
