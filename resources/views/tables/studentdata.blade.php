@extends('home.index')

@section('content')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('body.js')
    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Cash Collection</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" hidden>
                    <h3 class="card-title">Student Data</h3>
                    <button class="btn btn-sm btn-success float-right" id="cashform">Cashier Form</button>
                </div>

                <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered table-striped" id="student-table">
                        <thead>
                            <th><input type="checkbox" name="main_checkbox"><label></label></th>
                            <th>No</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Level</th>
                            <th>SY</th>
                            <th>Strand</th>
                            <th>OR No.</th>
                            <th>Date Paid</th>
                            <th>Total Fee</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            <th>Actions <button class="btn btn-sm btn-warning d-none" id="archiveAllBtn">Archive</button>
                            </th>
                        </thead>
                        <tbody></tbody>
                        {{-- <tbody>
                            @foreach ($students as $student)
                                <tr class="h-25">

                                    <td>{{ $student->Id_num }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->section }}</td>
                                    <td>{{ $student->lvl }}</td>
                                    <td>{{ $student->ay }}</td>
                                    <td>{{ $student->strand }}</td>
                                    <td>{{ $student->or_no }}</td>
                                    <td>{{ $student->datepaid }}</td>
                                    <td>{{ $student->total_fee }}</td>
                                    <td>{{ $student->amount_paid }}</td>
                                    <td>{{ $student->balance }}</td>

                                    <td>
                                        <a class="btn editbtn btn-app">
                                            <i class="fas fa-edit fa-xs"></i> Edit
                                        </a>

                                        <a class="btn btn-app">
                                            <i class="fas fa-trash fa-xs"></i> Delete
                                        </a>
                                        <a class="btn btn-app">
                                            <i class="fas fa-trash fa-xs"></i> View
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>

                    {{-- @include('modal.cashier_form') --}}
                    @include('modal.payment')
                    @include('modal.payment_summary')

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </section>
    <script>
        toastr.options.preventDuplicates = true;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(function() {
            //GET ALL Students
            var table = $('#student-table').DataTable({
                processing: true,
                info: true,
                ajax: "{{ route('get.student.list') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'section',
                        name: 'section'
                    },
                    {
                        data: 'lvl',
                        name: 'lvl'
                    },
                    {
                        data: 'ay',
                        name: 'ay'
                    },
                    {
                        data: 'strand',
                        name: 'strand'
                    },
                    {
                        data: 'or_no',
                        name: 'or_no'
                    },
                    {
                        data: 'datepaid',
                        name: 'datepaid'
                    },
                    {
                        data: 'total_fee',
                        name: 'total_fee'
                    },
                    {
                        data: 'amount_paid',
                        name: 'amount_paid'
                    },
                    {
                        data: 'balance',
                        name: 'balance'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            }).on('draw', function() {
                $('input[name="student_checkbox"]').each(function() {
                    this.checked = false;
                });
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#archiveAllBtn').addClass('d-none');
            });

            $(document).on('click', '#editbtn', function() {
                var student_id = $(this).data('id');
                $('.editStudent').find('form')[0].reset();
                $('.editStudent').find('span.error-text').text('');
                $.post('<?= route('get.show.payment') ?>', {
                    student_id: student_id
                }, function(data) {
                    $('.editStudent').find('input[name="sid"]').val(data.details.id);
                    $('.editStudent').find('input[name="datep"]').val(data.details.datepaid);
                    $('.editStudent').find('input[name="or_num"]').val(data.details.or_no);

                    $('.editStudent').find('input[name="tuition_fee"]').val(data.details.tuition_fee);
                    // $('.editStudent').find('input[name="tui_fee"]').val(data.details.tui_fee);
                    $('.editStudent').find('input[name="uni_fee"]').val(data.details.uniform_fee);
                    $('.editStudent').find('input[name="regs_fee"]').val(data.details
                        .registration_fee);
                 if (data.details.uni_fee !== null && data.details.uni_fee !== 0){
                        $("#uni_fee").val("Paid");
                        $("#uni_fee").prop("readonly", true);
                    } else {
                        $("#uni_fee").prop("readonly", false); // Show the checkbox
                    }
                    $('.editStudent').find('input[name="oth_fee"]').val(data.details.oth_fee);
                    $('.editStudent').find('input[name="totalf"]').val(data.details.total_fee);
                    $('.editStudent').find('input[name="fulltotalf"]').val(data.details.total_fee);
                    $('.editStudent').find('input[name="amountp"]').val(data.details.amount_paid);
                    $('.editStudent').find('input[name="balance"]').val(data.details.balance);
                    //Testing
                    //Update the checkbox based on the existence of the value
                    // $("#Medical").prop('checked', data.details.Medical !== null && data.details.Medical !== 0);
                    // $("#Insurance").prop('checked', data.details.Insurance !== null && data.details.Insurance !== 0);
                    // $("#Death").prop('checked', data.details.Death !== null && data.details.Death !== 0);
                    // $("#Library").prop('checked', data.details.Library !== null && data.details.Library !== 0);
                    // $("#School_Pub").prop('checked', data.details.School_Pub !== null && data.details.School_Pub !== 0);
                    // $("#Athlet").prop('checked', data.details.Athlet !== null && data.details.Athlet !== 0);
                    // $("#BACS").prop('checked', data.details.BACS !== null && data.details.BACS !== 0);
                    // $("#Book").prop('checked', data.details.Book !== null && data.details.Book !== 0);
                    // $("#Laboratory").prop('checked', data.details.Laboratory !== null && data.details.Laboratory !== 0);
                    // $("#StudentID").prop('checked', data.details.StudentID !== null && data.details.StudentID !== 0);
                    // $("#Passbook").prop('checked', data.details.Passbook !== null && data.details.Passbook !== 0);
                    // $("#Handbook").prop('checked', data.details.Handbook !== null && data.details.Handbook !== 0);
                    // $("#Dental").prop('checked', data.details.Dental !== null && data.details.Dental !== 0);
                    // $("#Completers_Fee").prop('checked', data.details.Completers_Fee !== null && data.details.Completers_Fee !== 0);
                    // $("#graduation").prop('checked', data.details.Graduation_Fee !== null && data.details.Graduation_Fee !== 0);

                    // Registration
                    if (data.details.reg_fee !== null && data.details.reg_fee !== 0) {
                        $("#reg_fee").prop('checked', false);
                        $("#reg_fee").parent()
                    .hide(); // Hide the entire parent element containing the checkbox
                    } else {
                        $("#reg_fee").prop('checked',
                        false); // Ensure the checkbox is unchecked if there's no value
                        $("#reg_fee").parent().show(); // Show the checkbox
                    }
                    // Medical
                    if (data.details.Medical !== null && data.details.Medical !== 0) {
                        $("#Medical").prop('checked', false);
                        $("#Medical").parent()
                    .hide(); // Hide the entire parent element containing the checkbox
                    } else {
                        $("#Medical").prop('checked',
                        false); // Ensure the checkbox is unchecked if there's no value
                        $("#Medical").parent().show(); // Show the checkbox
                    }

                    // Insurance
                    if (data.details.Insurance !== null && data.details.Insurance !== 0) {
                        $("#Insurance").prop('checked', false);
                        $("#Insurance").parent().hide();
                    } else {
                        $("#Insurance").prop('checked', false);
                        $("#Insurance").parent().show();
                    }

                    // Death
                    if (data.details.Death !== null && data.details.Death !== 0) {
                        $("#Death").prop('checked', false);
                        $("#Death").parent().hide();
                    } else {
                        $("#Death").prop('checked', false);
                        $("#Death").parent().show();
                    }

                    // Library
                    if (data.details.Library !== null && data.details.Library !== 0) {
                        $("#Library").prop('checked', false);
                        $("#Library").parent().hide();
                    } else {
                        $("#Library").prop('checked', false);
                        $("#Library").parent().show();
                    }

                    // School_Pub
                    if (data.details.School_Pub !== null && data.details.School_Pub !== 0) {
                        $("#School_Pub").prop('checked', false);
                        $("#School_Pub").parent().hide();
                    } else {
                        $("#School_Pub").prop('checked', false);
                        $("#School_Pub").parent().show();
                    }

                    // Athlet
                    if (data.details.Athlet !== null && data.details.Athlet !== 0) {
                        $("#Athlet").prop('checked', false);
                        $("#Athlet").parent().hide();
                    } else {
                        $("#Athlet").prop('checked', false);
                        $("#Athlet").parent().show();
                    }

                    // BACS
                    if (data.details.BACS !== null && data.details.BACS !== 0) {
                        $("#BACS").prop('checked', false);
                        $("#BACS").parent().hide();
                    } else {
                        $("#BACS").prop('checked', false);
                        $("#BACS").parent().show();
                    }

                    // Book
                    if (data.details.Book !== null && data.details.Book !== 0) {
                        $("#Book").prop('checked', false);
                        $("#Book").parent().hide();
                    } else {
                        $("#Book").prop('checked', false);
                        $("#Book").parent().show();
                    }

                    // Laboratory
                    if (data.details.Laboratory !== null && data.details.Laboratory !== 0) {
                        $("#Laboratory").prop('checked', false);
                        $("#Laboratory").parent().hide();
                    } else {
                        $("#Laboratory").prop('checked', false);
                        $("#Laboratory").parent().show();
                    }

                    // StudentID
                    if (data.details.StudentID !== null && data.details.StudentID !== 0) {
                        $("#StudentID").prop('checked', false);
                        $("#StudentID").parent().hide();
                    } else {
                        $("#StudentID").prop('checked', false);
                        $("#StudentID").parent().show();
                    }

                    // Passbook
                    if (data.details.Passbook !== null && data.details.Passbook !== 0) {
                        $("#Passbook").prop('checked', false);
                        $("#Passbook").parent().hide();
                    } else {
                        $("#Passbook").prop('checked', false);
                        $("#Passbook").parent().show();
                    }

                    // Handbook
                    if (data.details.Handbook !== null && data.details.Handbook !== 0) {
                        $("#Handbook").prop('checked', false);
                        $("#Handbook").parent().hide();
                    } else {
                        $("#Handbook").prop('checked', false);
                        $("#Handbook").parent().show();
                    }

                    // Dental
                    if (data.details.Dental !== null && data.details.Dental !== 0) {
                        $("#Dental").prop('checked', false);
                        $("#Dental").parent().hide();
                    } else {
                        $("#Dental").prop('checked', false);
                        $("#Dental").parent().show();
                    }

                    // Completers_Fee
                    if (data.details.Completers_Fee !== null && data.details.Completers_Fee !== 0) {
                        $("#Completers_Fee").prop('checked', false);
                        $("#Completers_Fee").parent().hide();
                    } else {
                        $("#Completers_Fee").prop('checked', false);
                        $("#Completers_Fee").parent().show();
                    }

                    // graduation
                    if (data.details.Graduation_Fee !== null && data.details.Graduation_Fee !== 0) {
                        $("#graduation").prop('checked', false);
                        $("#graduation").parent().hide();
                    } else {
                        $("#graduation").prop('checked', false);
                        $("#graduation").parent().show();
                    }

                    //Monthly payments

                    if (data.details.january !== null && data.details.january !== 0) {
                        $("#january").prop('checked', false);
                        $("#january").parent().hide();
                    } else {
                        $("#january").prop('checked', false);
                        $("#january").parent().show();
                    }
                    if (data.details.february !== null && data.details.february !== 0) {
                        $("#february").prop('checked', false);
                        $("#february").parent().hide();
                    } else {
                        $("#february").prop('checked', false);
                        $("#february").parent().show();
                    }
                    if (data.details.march !== null && data.details.march !== 0) {
                        $("#march").prop('checked', false);
                        $("#march").parent().hide();
                    } else {
                        $("#march").prop('checked', false);
                        $("#march").parent().show();
                    }
                    if (data.details.april !== null && data.details.april !== 0) {
                        $("#april").prop('checked', false);
                        $("#april").parent().hide();
                    } else {
                        $("#april").prop('checked', false);
                        $("#april").parent().show();
                    }
                    if (data.details.may !== null && data.details.may !== 0) {
                        $("#may").prop('checked', false);
                        $("#may").parent().hide();
                    } else {
                        $("#may").prop('checked', false);
                        $("#may").parent().show();
                    }
                    if (data.details.june !== null && data.details.june !== 0) {
                        $("#june").prop('checked', false);
                        $("#june").parent().hide();
                    } else {
                        $("#june").prop('checked', false);
                        $("#june").parent().show();
                    }
                    if (data.details.july !== null && data.details.july !== 0) {
                        $("#july").prop('checked', false);
                        $("#july").parent().hide();
                    } else {
                        $("#july").prop('checked', false);
                        $("#july").parent().show();
                    }
                    if (data.details.august !== null && data.details.august !== 0) {
                        $("#august").prop('checked', false);
                        $("#august").parent().hide();
                    } else {
                        $("#august").prop('checked', false);
                        $("#august").parent().show();
                    }
                    if (data.details.september !== null && data.details.september !== 0) {
                        $("#september").prop('checked', false);
                        $("#september").parent().hide();
                    } else {
                        $("#september").prop('checked', false);
                        $("#september").parent().show();
                    }
                    if (data.details.october !== null && data.details.october !== 0) {
                        $("#october").prop('checked', false);
                        $("#october").parent().hide();
                    } else {
                        $("#october").prop('checked', false);
                        $("#october").parent().show();
                    }
                    if (data.details.november !== null && data.details.november !== 0) {
                        $("#november").prop('checked', false);
                        $("#november").parent().hide();
                    } else {
                        $("#november").prop('checked', false);
                        $("#november").parent().show();
                    }
                    if (data.details.december !== null && data.details.december !== 0) {
                        $("#december").prop('checked', false);
                        $("#december").parent().hide();
                    } else {
                        $("#december").prop('checked', false);
                        $("#december").parent().show();
                    }

                    $('#modal-default').modal('show');
                }, 'json');
            });

            $(document).on('click', '#historybtn', function() {
                var student_id = $(this).data('id');

                // Send an AJAX request to the server to fetch payment details
                $.ajax({
                    type: 'GET',
                    url: '{{ route('moreinfo.payment_summary') }}',
                    data: {
                        student_id: student_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Clear existing rows in the table
                        $('#payment-table-body').empty();

                        // Display student's name
                        $('#student-name').text(data.name);
                        $('#student-section').text(data.section);
                        $('#student-id').text(data.stud_id);

                        $('#total-amount').text(data.fulltotalf);

                        // $('#student-id').text(data.Medical);
                        // $('#student-id').text(data.Insurance);
                        // $('#student-id').text(data.Death);
                        // $('#student-id').text(data.Library);
                        // $('#student-id').text(data.School_Pub);
                        // $('#student-id').text(data.Athlet);
                        // $('#student-id').text(data.BACS);
                        // $('#student-id').text(data.Book);
                        // $('#student-id').text(data.Laboratory);
                        // $('#student-id').text(data.StudentID);
                        // $('#student-id').text(data.Passbook);
                        // $('#student-id').text(data.Handbook);
                        // $('#student-id').text(data.Dental);
                        // $('#student-id').text(data.Completers_Fee);
                        // $('#student-id').text(data.graduation);
                        // $('#student-id').text(data.fulltotalf);
                        // $('#student-id').text(data.amountp);

                        // Medical

                        if (data.Medical == null && data.Medical == 0) {
                            $("#Medical").prop('checked', true);
                            $("#Medical").parent()
                        .hide(); // Hide the entire parent element containing the checkbox
                        } else {
                            $("#Medical").prop('checked',
                            false); // Ensure the checkbox is unchecked if there's no value
                            $("#Medical").parent().show(); // Show the checkbox
                        }

                        // Insurance
                        if (data.Insurance !== null && data.Insurance !== 0) {
                            $("#Insurance").prop('checked', true);
                            $("#Insurance").parent().hide();
                        } else {
                            $("#Insurance").prop('checked', false);
                            $("#Insurance").parent().show();
                        }

                        // Death
                        if (data.Death !== null && data.Death !== 0) {
                            $("#Death").prop('checked', true);
                            $("#Death").parent().hide();
                        } else {
                            $("#Death").prop('checked', false);
                            $("#Death").parent().show();
                        }

                        // Library
                        if (data.Library !== null && data.Library !== 0) {
                            $("#Library").prop('checked', true);
                            $("#Library").parent().hide();
                        } else {
                            $("#Library").prop('checked', false);
                            $("#Library").parent().show();
                        }

                        // School_Pub
                        if (data.School_Pub !== null && data.School_Pub !== 0) {
                            $("#School_Pub").prop('checked', true);
                            $("#School_Pub").parent().hide();
                        } else {
                            $("#School_Pub").prop('checked', false);
                            $("#School_Pub").parent().show();
                        }

                        // Athlet
                        if (data.Athlet !== null && data.Athlet !== 0) {
                            $("#Athlet").prop('checked', true);
                            $("#Athlet").parent().hide();
                        } else {
                            $("#Athlet").prop('checked', false);
                            $("#Athlet").parent().show();
                        }

                        // BACS
                        if (data.BACS !== null && data.BACS !== 0) {
                            $("#BACS").prop('checked', true);
                            $("#BACS").parent().hide();
                        } else {
                            $("#BACS").prop('checked', false);
                            $("#BACS").parent().show();
                        }

                        // Book
                        if (data.Book !== null && data.Book !== 0) {
                            $("#Book").prop('checked', true);
                            $("#Book").parent().hide();
                        } else {
                            $("#Book").prop('checked', false);
                            $("#Book").parent().show();
                        }

                        // Laboratory
                        if (data.Laboratory !== null && data.Laboratory !== 0) {
                            $("#Laboratory").prop('checked', true);
                            $("#Laboratory").parent().hide();
                        } else {
                            $("#Laboratory").prop('checked', false);
                            $("#Laboratory").parent().show();
                        }

                        // StudentID
                        if (data.StudentID !== null && data.StudentID !== 0) {
                            $("#StudentID").prop('checked', true);
                            $("#StudentID").parent().hide();
                        } else {
                            $("#StudentID").prop('checked', false);
                            $("#StudentID").parent().show();
                        }

                        // Passbook
                        if (data.Passbook !== null && data.Passbook !== 0) {
                            $("#Passbook").prop('checked', true);
                            $("#Passbook").parent().hide();
                        } else {
                            $("#Passbook").prop('checked', false);
                            $("#Passbook").parent().show();
                        }

                        // Handbook
                        if (data.Handbook !== null && data.Handbook !== 0) {
                            $("#Handbook").prop('checked', true);
                            $("#Handbook").parent().hide();
                        } else {
                            $("#Handbook").prop('checked', false);
                            $("#Handbook").parent().show();
                        }

                        // Dental
                        if (data.Dental !== null && data.Dental !== 0) {
                            $("#Dental").prop('checked', true);
                            $("#Dental").parent().hide();
                        } else {
                            $("#Dental").prop('checked', false);
                            $("#Dental").parent().show();
                        }

                        // Completers_Fee
                        if (data.Completers_Fee !== null && data.Completers_Fee !== 0) {
                            $("#Completers_Fee").prop('checked', true);
                            $("#Completers_Fee").parent().hide();
                        } else {
                            $("#Completers_Fee").prop('checked', false);
                            $("#Completers_Fee").parent().show();
                        }

                        // graduation
                        if (data.Graduation_Fee !== null && data.Graduation_Fee !== 0) {
                            $("#graduation").prop('checked', true);
                            $("#graduation").parent().hide();
                        } else {
                            $("#graduation").prop('checked', false);
                            $("#graduation").parent().show();
                        }



                        // Populate the table with the received payment details
                        $.each(data.details, function(index, payment_summary) {
                            var row = '<tr class="h-25">' +
                                // '<td>' + payment_summary.stud_id + '</td>' +
                                '<td>' + payment_summary.or_num + '</td>' +
                                '<td>' + payment_summary.datepaid + '</td>' +
                                '<td>' + payment_summary.total_fee + '</td>' +
                                '<td>' + payment_summary.amount_paid + '</td>' +
                                '<td>' + payment_summary.balance + '</td>' +
                                // '<td>' + payment_summary.updated_at + '</td>' +
                                // '<td>' + payment_summary.created_at + '</td>' +
                                '</tr>';
                            $('#payment-table-body').append(row);
                        });

                        // Show the modal with the populated table
                        $('#modal-summary').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors if any
                        console.error(error);
                    }
                });
            });

            // $(document).on('click', '#historybtn', function() {
            //     var student_id = $(this).data('id');moreinfo.payment_summary

            //     // Define the table variable
            //     var table = $('#payment-table').DataTable();

            //     // Destroy existing DataTable instance
            //     if ($.fn.DataTable.isDataTable('#payment-table')) {
            //         table.destroy();
            //     }

            //     $('#modal-summary').modal('show');

            //     // Initialize DataTable with the new configuration
            //     table = $('#payment-table').DataTable({
            //         processing: true,
            //         info: true,
            //         ajax: {
            //             url: "{{ route('get.payments.history') }}",
            //             type: "GET",
            //             data: {
            //                 student_id: student_id
            //             },
            //         },
            //         pageLength: 5,
            //         lengthMenu: [
            //             [5, 10, 25, 50, -1],
            //             [5, 10, 25, 50, "All"]
            //         ],
            //         columns: [
            //             //  {data:'id', name:'id'},Id_num }}</
            //             {
            //                 data: 'DT_RowIndex',
            //                 name: 'DT_RowIndex'
            //             },
            //             {
            //                 data: 'stud_id',
            //                 name: 'stud_id'
            //             },
            //             {
            //                 data: 'or_num',
            //                 name: 'or_num'
            //             },
            //             {
            //                 data: 'datepaid',
            //                 name: 'datepaid'
            //             },
            //             {
            //                 data: 'amount_paid',
            //                 name: 'amount_paid'
            //             },
            //             {
            //                 data: 'balance',
            //                 name: 'balance'
            //             },
            //             {
            //                 data: 'updated_at',
            //                 name: 'updated_at'
            //             },
            //             {
            //                 data: 'created_at',
            //                 name: 'created_at'
            //             },
            //         ]
            //     })
            //     $('#modal-summary').modal('show');
            // });

            //UPDATE STUDENT DETAILS
            $('#update-student-payment').on('submit', function(e) {
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
                            $('#student-table').DataTable().ajax.reload(null, false);
                            $('.editStudent').modal('hide');
                            $('.editStudent').find('form')[0].reset();
                            toastr.success(data.msg);
                        }
                    }
                });
            });

            //DELETE STUDENT RECORD
            $(document).on('click', '#archivebtn', function() {
                var student_id = $(this).data('id');
                var url = '<?= route('archive.student') ?>';

                swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to <b>Archive</b> this Student',
                    showCancelButton: true,
                    showCloseButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, Archive',
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
                                $('#student-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            } else {
                                toastr.error(data.msg);
                            }
                        }, 'json');
                    }
                });

            });

            $(document).on('click', 'input[name="main_checkbox"]', function() {
                if (this.checked) {
                    $('input[name="student_checkbox"]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[name="student_checkbox"]').each(function() {
                        this.checked = false;
                    });
                }
                toggleArchiveAllBtn();
            });

            $(document).on('change', 'input[name="student_checkbox"]', function() {

                if ($('input[name="student_checkbox"]').length == $(
                        'input[name="student_checkbox"]:checked').length) {
                    $('input[name="main_checkbox"]').prop('checked', true);
                } else {
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                toggleArchiveAllBtn();
            });


            function toggleArchiveAllBtn() {
                if ($('input[name="student_checkbox"]:checked').length > 0) {
                    $('button#archiveAllBtn').text('Archive (' + $('input[name="student_checkbox"]:checked')
                        .length +
                        ')').removeClass('d-none');
                } else {
                    $('button#archiveAllBtn').addClass('d-none');
                }
            }


            $(document).on('click', 'button#archiveAllBtn', function() {
                var checkedStudents = [];
                $('input[name="student_checkbox"]:checked').each(function() {
                    checkedStudents.push($(this).data('id'));
                });

                var url = '{{ route('archive.selected.students') }}';
                if (checkedStudents.length > 0) {
                    swal.fire({
                        title: 'Are you sure?',
                        html: 'You want to Archive <b>(' + checkedStudents.length +
                            ')</b> Students',
                        showCancelButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'Yes, Archive',
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
                                    $('#student-table').DataTable().ajax.reload(null,
                                        true);
                                    toastr.success(data.msg);
                                }
                            }, 'json');
                        }
                    })
                }
            });
        });

        $(document).on('click', '#cashform', function() {
            var student_id = $(this).data('id');
            $('.cashierform').find('form')[0].reset();
            $('.cashierform').find('span.error-text').text('');
            $.post('<?= route('get.show.payment') ?>', {
                student_id: student_id
            }, function(data) {
                //   alert(data.details.name);

                $('#cashier-form').modal('show');
            }, 'json');
        });



        //     $(document).on('click', '.editbtn', function () {
        //         var stud_id = $(this).val();

        //         $('#modal-default').modal('show');

        //         $.ajax({
        //             type: "GET",
        //             url: "/students/edit/"+student_id,
        //             success: function (response) {
        //                 console.log(response);
        //                 $('#id').val(response.students.id);
        //                 $('#or_num').val(response.students.or_no);
        //                 $('#datep').val(response.students.datepaid);
        //                 $('#totalf').val(response.students.total_fee);
        //                 $('#amountp').val(response.students.amount_paid);
        //                 $('#balance').val(response.students.balance);
        //             }
        //         })
        //     });

        //     $(document).on('click','.editbtn', function(){
        //         $('#modal-default').modal('show');
        //             var stud_id = $(this).data('id');
        //             $('.editStudent').find('form')[0].reset();
        //             $('.editStudent').find('span.error-text').text('');
        //             $.post('<?= route('get.show.payment') ?>',{stud_id:stud_id}, function(data){
        //                 //  alert(data.details.country_name);
        //                 $('.editStudent').find('input[name="id"]').val(data.details.id);
        //                 $('.editStudent').find('input[name="or_num"]').val(data.details.or_no);
        //                 $('.editStudent').find('input[name="datep"]').val(data.details.datepaid);
        //                 $('.editStudent').find('input[name="totalf"]').val(data.details.total_fee);
        //                 $('.editStudent').find('input[name="amountp"]').val(data.details.amount_paid);
        //                 $('.editStudent').find('input[name="balance"]').val(data.details.balance);
        //                 $('.editStudent').modal('show');
        //             },'json');
        //         });

        //     //UPDATE COUNTRY DETAILS
        //     $('#update-student-payment').on('submit', function(e){
        //             e.preventDefault();
        //             var form = this;
        //             $.ajax({
        //                 url:$(form).attr('action'),
        //                 method:$(form).attr('method'),
        //                 data:new FormData(form),
        //                 processData:false,
        //                 dataType:'json',
        //                 contentType:false,
        //                 beforeSend: function(){
        //                      $(form).find('span.error-text').text('');
        //                 },
        //                 success: function(data){
        //                       if(data.code == 0){
        //                           $.each(data.error, function(prefix, val){
        //                               $(form).find('span.'+prefix+'_error').text(val[0]);
        //                           });
        //                       }else{
        //                           $('#student-table').DataTable().ajax.reload(null, false);
        //                           $('.editStudent').modal('hide');
        //                           $('.editStudent').find('form')[0].reset();
        //                           toastr.success(data.msg);
        //                       }
        //                 }
        //             });
        //         });
    </script>
@endsection
