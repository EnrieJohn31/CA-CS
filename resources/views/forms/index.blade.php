@extends('home.index')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>General Form</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">General Form</li>
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
                            <h3 class="card-title">Basic Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('store.student') }}" method="POST" id="save-student-form">
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-md-2">
                                    <label for="Id_num">LRN </label>
                                    <input type="text" class="form-control" id="Id_num" name="Id_num"
                                        placeholder="LRN " oninput="validateIdNum(this)">
                                    <span class="text-danger error-text Id_num_error"></span>
                                </div>

                                {{-- <div class="form-group col-md-5">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Student Name" oninput="validateName(this)">
                                    <span class="text-danger error-text name_error"></span>
                                </div> --}}

                                <div class="form-group col-md-2">
                                    <label for="name">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname"
                                        placeholder="First Name" oninput="validateName(this)">
                                    <span class="text-danger error-text fname_error"></span>
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="name">Middle Initial</label>
                                    <input type="text" class="form-control" id="mname" name="mname"
                                    placeholder="MI"  oninput="validateName(this)">
                                    <span class="text-danger error-text mname_error"></span>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname"
                                        placeholder="Last Name" oninput="validateName(this)">
                                    <span class="text-danger error-text lname_error"></span>
                                </div>



                                <div class="col-sm-2">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Grade Level</label>
                                        <select class="form-control" id="lvl" name="lvl"
                                            onchange="toggleStrandInput(); populateSections(); updateRegistrationFee()">
                                            <option value="0" selected disabled>Choose</option>
                                            <option value="Nursery">Nursery</option>
                                            {{-- <option value="Kinder">Kinder 1</option> --}}
                                            {{-- <option value="Kinder2">Kinder 2</option> --}}
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
                                <div class="form-group col-md-3">
                                    <label for="section">Section</label>
                                    <select class="form-control" id="section" name="section" placeholder="Section" >
                                        <option value="" selected disabled>Choose</option>
                                    </select>
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

                                <div class="form-group col-md-3" hidde>
                                    <label for="phonenumber">Phone Number</label>
                                    <input type="text" class="form-control" id="phonenumber" name="phonenumber"
                                        placeholder="Phone Number" maxlength="11" pattern="[0-9]{11}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="ay">Academic Year</label>
                                    <input type="text" class="form-control" id="ay" name="ay"
                                        placeholder="YYYY-YYYY" oninput="validateSchoolYear(this)">
                                </div>

                                <div class="form-group col-md-3"hidden >
                                    <label for="reg_fee">Registration Fee</label>
                                    <input type="text" class="form-control" id="reg_fee" name="reg_fee"
                                        placeholder="" readonly>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                    <script>

                            const gradeSections = {
                                'Nursery': ["A", "B"],
                                'Kinder': ["1-A", "1-B"],
                                'Kinder2': ["2-A", "2-B"],
                                '1': ["1-A"],
                                '2': ["2-A"],
                                '3': ["3-A"],
                                '4': ["4-A"],
                                '5': ["5-A"],
                                '6': ["6-A"],
                                '7': ["Humility", "Generosity"],
                                '8': ["Honesty", "Resilience",],
                                '9': ["Loyalty", "Hope"],
                                '10': ["Love", "Charity"],
                                '11': ["Fortitude", "Unity", "Prosperity"],
                                '12': ["Courage", "Integrity"],
                            };

                        function populateSections() {
                            const gradeLevel = document.getElementById("lvl").value;
                            const sectionDropdown = document.getElementById("section");

                            // Clear existing options
                            sectionDropdown.innerHTML = '<option value="" selected disabled>Choose</option>';

                            // Check if the selected grade level exists in the map
                            if (gradeSections.hasOwnProperty(gradeLevel)) {
                                addSections(sectionDropdown, gradeSections[gradeLevel]);
                            }
                        }

                        function addSections(selectElement, sections) {
                            // Populate options based on sections
                            sections.forEach(section => {
                                const option = document.createElement("option");
                                option.value = section;
                                option.text = section;
                                selectElement.add(option);
                            });
                        }



                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

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



                        // Function to update the registration fee based on the selected grade level
                        function updateRegistrationFee() {
                            const gradeLevelSelect = document.getElementById('lvl');
                            const registrationFeeInput = document.getElementById('reg_fee');
                            const selectedValue = parseInt(gradeLevelSelect.value);

                            if (selectedValue >= 7 && selectedValue <= 10) {
                                registrationFeeInput.value = '600';
                            } else if (selectedValue >= 11 && selectedValue <= 12) {
                                registrationFeeInput.value = '925';
                            } else if (selectedValue === 0) { // Check for "Choose" option
                                registrationFeeInput.value = ''; // Set it to blank or empty
                            } else {
                                registrationFeeInput.value = '1175';
                            }
                        }

                        // Attach the function to the "Grade Level" dropdown change event
                        document.getElementById('lvl').addEventListener('change', updateRegistrationFee);

                        // Call the function initially to set the initial registration fee value
                        updateRegistrationFee();

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
                    </script>
                </div>
            </div>
        </div>
    </section>
@endsection
