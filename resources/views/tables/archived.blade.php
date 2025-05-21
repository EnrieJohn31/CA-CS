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
                            <li class="breadcrumb-item active">Archived Students Data</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Archived Student Data</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered table-striped" id="archivestudent-table">
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
                            <th>Actions <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete All</button>
                            </th>
                        </thead>
                        <tbody></tbody>

                    </table>

                    @include('modal.payment')

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
            var table = $('#archivestudent-table').DataTable({
                processing: true,
                info: true,
                ajax: "{{ route('data.archivedStudentList') }}",
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

            $(document).on('click', '#restorebtn', function() {
                var student_id = $(this).data('id');

                $.ajax({
                    url: '/students/restore', // Adjust the URL to match your Laravel route
                    type: 'POST',
                    data: {
                        sid: student_id
                    }, // Pass the student_id to the server
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#archivestudent-table').DataTable().ajax.reload(null, false);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            //DELETE STUDENT RECORD
            $(document).on('click', '#deletebtn', function() {
                var student_id = $(this).data('id');
                var url = '<?= route('delete.payment') ?>';

                swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to <b>delete</b> this Student',
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
                                $('#archivestudent-table').DataTable().ajax.reload(null, false);
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
                toggledeleteAllBtn();
            });

            $(document).on('change', 'input[name="student_checkbox"]', function() {

                if ($('input[name="student_checkbox"]').length == $(
                        'input[name="student_checkbox"]:checked').length) {
                    $('input[name="main_checkbox"]').prop('checked', true);
                } else {
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                toggledeleteAllBtn();
            });


            function toggledeleteAllBtn() {
                if ($('input[name="student_checkbox"]:checked').length > 0) {
                    $('button#deleteAllBtn').text('Delete (' + $('input[name="student_checkbox"]:checked').length +
                        ')').removeClass('d-none');
                } else {
                    $('button#deleteAllBtn').addClass('d-none');
                }
            }


            $(document).on('click', 'button#deleteAllBtn', function() {
                var checkedStudents = [];
                $('input[name="student_checkbox"]:checked').each(function() {
                    checkedStudents.push($(this).data('id'));
                });

                var url = '{{ route('delete.selected.students') }}';
                if (checkedStudents.length > 0) {
                    swal.fire({
                        title: 'Are you sure?',
                        html: 'You want to delete <b>(' + checkedStudents.length +
                            ')</b> Students',
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
    </script>
@endsection
