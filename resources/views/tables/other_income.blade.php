@extends('home.index')

@section('content')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('body.js')

    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">

                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Other Income</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-4">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Other Incomes</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('store.income') }}" method="POST" id="save-income-form">
                            @csrf

                                {{-- <div class="form-group col-md-4" hidden>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">CA Paper</label>
                                      </div>
                                </div>

                                <div class="form-group col-md-4" hidden>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Green Book</label>
                                      </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-check" hidden>
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Mass Card</label>
                                      </div>
                                </div> --}}

                            <div class="card-body row">
                                <div class="form-group col-md-4">
                                    <label for="ca_paper">CA Paper <br> <i>₱ 1</i></label>
                                    <input type="text" class="form-control" id="ca_paper" name="ca_paper">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="green_book">Green Book <br> <i>₱ 4</i></label>
                                    <input type="text" class="form-control" id="green_book" name="green_book">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="mass_card">Mass Card <br> <i>₱ 3</i></label>
                                    <input type="text" class="form-control" id="mass_card" name="mass_card">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.container-fluid -->

                <div class="col-md-8">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Recent Income</h3>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-xl">
                                    Generate Income Report
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="income-table">
                                <thead>
                                    <th><input type="checkbox" name="income_checkbox"><label></label></th>
                                    <th>No</th>
                                    <th>CA Paper</th>
                                    <th>Green Book</th>
                                    <th>Mass Card</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Actions <button class="btn btn-sm btn-danger d-none" id="DeleteAllBtn">Delete
                                            All</button></th>
                                </thead>
                                <tbody></tbody>
                            </table>

                            @include('modal.incomepayment')
                            @include('modal.income_report')
                        </div>
                    </div>
                    <!-- /.card -->

                </div>



            </div>
        </div>
    </section>

    <script>
        toastr.options.preventDuplicates = true;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Attach event listener to the form submission
            $('#generate').submit(function(event) {
                event.preventDefault();

                // Perform client-side validation
                var startDate = $('#startdate').val();
                var endDate = $('#enddate').val();

                if (!startDate || !endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Please Select Date',
                        text: 'Start date and end date are required.',
                    });
                    return; // Stop further execution if validation fails
                }

                // Perform the form submission using AJAX
                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.show.report') }}",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // Handle success response if needed
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        });

                        // Perform calculations on the client-side
                        var caPaperQuantity = response.ca_paper_quantity;
                        var yellowBookQuantity = response.yellow_book_quantity;
                        var massCardQuantity = response.mass_card_quantity;

                        var caPaperMultiplier = 1;
                        var yellowBookMultiplier = 4;
                        var massCardMultiplier = 3;

                        var caPaperSales = caPaperQuantity * caPaperMultiplier;
                        var yellowBookSales = yellowBookQuantity * yellowBookMultiplier;
                        var massCardSales = massCardQuantity * massCardMultiplier;

                        var totalSales = caPaperSales + yellowBookSales + massCardSales;

                        // Update the UI with the calculated values
                        $('#ca_paper_sales').val(caPaperSales);
                        $('#yellow_book_sales').val(yellowBookSales);
                        $('#mass_card_sales').val(massCardSales);
                        $('#total_sales').val(totalSales);

                    },
                    error: function(xhr, status, error) {
                        // Handle error response with validation errors (if any)
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            var errorMessage = "Please Check:\n";
                            for (var key in errors) {
                                errorMessage += errors[key].join('\n') + '\n';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: errorMessage,
                            });
                        } else {
                            // Handle other types of errors
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred during the request.',
                            });
                        }
                    }
                });
            });
        });



        $(function() {
            //GET ALL Students
            var table = $('#income-table').DataTable({
                processing: true,
                info: true,
                ajax: "{{ route('get.other_income') }}",
                "pageLength": 5,
                "aLengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columns: [
                    //  {data:'id', name:'id'},Id_num }}</
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'ca_paper',
                        name: 'ca_paper'
                    },
                    {
                        data: 'yellow_book',
                        name: 'yellow_book'
                    },
                    {
                        data: 'mass_card',
                        name: 'mass_card'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        // render: function(data, type, full, meta) {
                        //     // Assuming 'updated_at' is in a standard date format
                        //     return moment(data).format(
                        //         'YYYY-MM-DD HH:mm:ss');
                        // },
                        render: function(data, type, full, meta) {
                            // Assuming 'updated_at' is in a standard date format
                            return moment(data).format(
                                'MM-DD-YYYY');
                        },
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            }).on('draw', function() {
                $('input[name="income_checkbox"]').each(function() {
                    this.checked = false;
                });
                $('input[name="income_checkbox"]').prop('checked', false);
                $('button#DeleteAllBtn').addClass('d-none');
            });

            $('#save-income-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;

                // Check if all three fields are empty
                var ca_paper_value = $(form).find('#ca_paper').val();
                var green_book_value = $(form).find('#green_book').val();
                var mass_card_value = $(form).find('#mass_card').val();

                if (ca_paper_value === "" && green_book_value === "" && mass_card_value === "") {
                    // Display warning message and exit the function
                    toastr.warning("Please enter any value in at least one field.");
                    return;
                }

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
                            toastr.error("Payment has not been added");
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            // Clear the form
                            toastr.success(data.msg);
                            $(form)[0].reset();
                            // Reload your DataTable to refresh the data
                            toastr.success(data.msg);
                            $('#income-table').DataTable().ajax.reload();
                        }
                    }
                });
            });


            $(document).on('click', '#editbtn', function() {
                var student_id = $(this).data('id');
                $('.editIncome').find('form')[0].reset();
                $('.editIncome').find('span.error-text').text('');
                $.post('<?= route('get.show.income') ?>', {
                    student_id: student_id
                }, function(data) {
                    //   alert(data.details.name);
                    $('.editIncome').find('input[name="sid"]').val(data.details.id);
                    $('.editIncome').find('input[name="ca_paper"]').val(data.details.ca_paper);
                    $('.editIncome').find('input[name="green_book"]').val(data.details.yellow_book);
                    $('.editIncome').find('input[name="mass_card"]').val(data.details.mass_card);
                    $('.editIncome').find('input[name="total"]').val(data.details.total);
                    $('#modal-default').modal('show');
                }, 'json');
            });

            //UPDATE STUDENT DETAILS
            $('#update-income-payment').on('submit', function(e) {
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
                            toastr.error(data.msg);
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('#income-table').DataTable().ajax.reload(null, false);
                            $('.editIncome').modal('hide');
                            $('.editIncome').find('form')[0].reset();
                            toastr.success(data.msg);
                        }
                    }
                });
            });

            //DELETE Payment RECORD
            $(document).on('click', '#deletebtn', function() {
                var student_id = $(this).data('id');
                var url = '<?= route('delete.payments') ?>';

                swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to <b>Delete</b> this Sale Income',
                    showCancelButton: true,
                    showCloseButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#556ee6',
                    width: 300,
                    allowOutsideClick: false
                }).then(function(result) {
                    if (result.value) {
                        $.post(url, {
                            student_id: student_id
                        }, function(data) {
                            if (data.code == 1) {
                                $('#income-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            } else {
                                toastr.error(data.msg);
                            }
                        }, 'json');
                    }
                });
            });

            $(document).on('click', 'input[name="income_checkbox"]', function() {
                if (this.checked) {
                    $('input[name="income_checkbox]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[name="income_checkbox"]').each(function() {
                        this.checked = false;
                    });
                }
                toggleDeleteAllBtn();
            });

            $(document).on('change', 'input[name="income_checkbox]', function() {

                if ($('input[name="income_checkbox]').length == $(
                        'input[name="income_checkbox]:checked').length) {
                    $('input[name="income_checkbox"]').prop('checked', true);
                } else {
                    $('input[name="income_checkbox"]').prop('checked', false);
                }
                toggleDeleteAllBtn();
            });

            function toggleDeleteAllBtn() {
                if ($('input[name="income_checkbox]:checked').length > 0) {
                    $('button#DeleteAllBtn').text('Delete (' + $('input[name="income_checkbox]:checked')
                        .length +
                        ')').removeClass('d-none');
                } else {
                    $('button#DeleteAllBtn').addClass('d-none');
                }
            }

            $(document).on('click', 'button#DeleteAllBtn', function() {
                var checkedStudents = [];
                $('input[name="income_checkbox]:checked').each(function() {
                    checkedStudents.push($(this).data('id'));
                });

                var url = '{{ route('delete.selected.payment') }}';
                if (checkedStudents.length > 0) {
                    swal.fire({
                        title: 'Are you sure?',
                        html: 'You want to Delete <b>(' + checkedStudents.length +
                            ')</b> Income Sales',
                        showCancelButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'Yes, Delete',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#556ee6',
                        cancelButtonColor: '#d33',
                        width: 300,
                        allowOutsideClick: false
                    }).then(function(result) {
                        if (result.value) {
                            $.post(url, {
                                Student_ids: checkedStudents
                            }, function(data) {
                                if (data.code == 1) {
                                    $('#income-table').DataTable().ajax.reload(null, true);
                                    toastr.success(data.msg);
                                }
                            }, 'json');
                        }
                    })
                }
            });
        });

        function allowOnlyNumbersWithDecimal(inputId) {
            var input = document.getElementById(inputId);
            input.addEventListener('input', function() {
                // Remove non-numeric and non-decimal characters
                this.value = this.value.replace(/[^0-9.]/g, '');

                // Remove leading zeros
                this.value = this.value.replace(/^0+(?=\d)/, '');

                // Allow only one decimal point
                if (this.value.split('.').length > 2) {
                    this.value = this.value.slice(0, this.value.lastIndexOf('.'));
                }
            });
        }

        // Call the function for each input field
        allowOnlyNumbersWithDecimal('ca_paper');
        allowOnlyNumbersWithDecimal('green_book');
        allowOnlyNumbersWithDecimal('mass_card');

        function printdiv(elem) {
            var header_str = '<html><head><title>' + document.title + '</title>';

            // Add style for dark text
            header_str += '<style type="text/css">';
            header_str += '@media print { body { color: #000 !important; } }';
            header_str += '</style>';

            header_str += '</head><body>';

            var footer_str = '</body></html>';
            var new_str = document.getElementById(elem).innerHTML;
            var old_str = document.body.innerHTML;

            document.body.innerHTML = header_str + new_str + footer_str;

            window.print();

            document.body.innerHTML = old_str;

            return false;
        }
    </script>
@endsection
