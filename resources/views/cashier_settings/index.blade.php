@extends('home.index')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>System Settings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">System Settings</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Grade Level Fees</h3>
                            <button class="btn btn-sm btn-success float-right" id="payadbleForm"><strong>Add Payables</strong></button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="payables-table">
                                <thead>
                                    <th><input type="checkbox" name="main_checkbox"><label></label></th>
                                    <th>No</th>
                                    <th>Grade Level</th>
                                    <th>Registration Fee</th>
                                    <th>Tuition Fee</th>
                                    <th>Uniform Fee</th>
                                    <th>Actions <button class="btn btn-sm btn-danger d-none" id="deleteAll">Delete</button></th>
                                </thead>
                                <tbody></tbody>
                            </table>

                            @include('modal.setting_payable')
                            @include('modal.setting_update_payable')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
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
        toastr.options.preventDuplicates = true;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(function() {
            //GET ALL Payables
            var table = $('#payables-table').DataTable({
                processing: true,
                info: true,
                ajax: "{{ route('settings.data.list') }}",
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
                        data: 'grade_lvl',
                        name: 'grade_lvl'
                    },
                    {
                        data: 'registration_fee',
                        name: 'registration_fee'
                    },
                    {
                        data: 'tuition_fee',
                        name: 'tuition_fee'
                    },
                    {
                        data: 'uniform_fee',
                        name: 'uniform_fee'
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
                $('button#deleteAll').addClass('d-none');
            });

            $(document).on('click', '#payadbleForm', function() {
                var student_id = $(this).data('id');
                $('.settingpay').find('form')[0].reset();
                $('.settingpay').find('span.error-text').text('');
                $.post('<?= route('get.setting.payment') ?>', {
                    student_id: student_id
                }, function(data) {
                    //   alert(data.details.name);
                    // $('.editStudent').find('input[name="sid"]').val(data.details.id);

                    $('#payable-modal').modal('show');
                }, 'json');
            });

            //DELETE Payable Setting
            $(document).on('click', '#deletebtn', function() {
                var student_id = $(this).data('id');
                var url = '<?= route('delete.payments') ?>';

                swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to <b>Delete</b> this Payable Setting',
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
                                $('#payables-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            } else {
                                toastr.error(data.msg);
                            }
                        }, 'json');
                    }
                });

            });

            $(document).on('click', '#editbtn', function() {
                var student_id = $(this).data('id');
                $('.setupdatepayable').find('form')[0].reset();
                $('.setupdatepayable').find('span.error-text').text('');
                $.post('<?= route('get.setting.payment') ?>', {
                    student_id: student_id
                }, function(data) {
                    //   alert(data.details.name);
                    $('.setupdatepayable').find('input[name="sid"]').val(data.details.id);

                    // if (data.details.lvl === 'Nursery') {
                    //     $('.setupdatepayable').find('input[name="grade_lvl"]').val('1443.50');
                    //     $('.setupdatepayable').find('input[name="grade_lvl"]').val(
                    //     '1000'); // Adjust this value as needed
                    // } else if (data.details.lvl === 'Kinder') {
                    //     $('.setupdatepayable').find('input[name="registration_fee"]').val('1443.50');
                    //     $('.setupdatepayable').find('input[name="registration_fee"]').val(
                    //     '1000'); // Adjust this value as needed
                    // } else if (data.details.lvl === '12') {
                    //     $('.setupdatepayable').find('input[name="tuition_fee"]').val('450');
                    //     $('.setupdatepayable').find('input[name="tuition_fee"]').val('1600'); // Adjust this value as needed
                    // } else if (data.details.lvl === '12') {
                    //     $('.setupdatepayable').find('input[name="uniform_fee"]').val('450');
                    //     $('.setupdatepayable').find('input[name="uniform_fee"]').val('1600'); // Adjust this value as needed
                    // }else {
                    //     // Set default values or handle other cases
                    //     $('.setupdatepayable').find('input[name="tui_fee"]').val('0');
                    //     $('.setupdatepayable').find('input[name="uni_fee"]').val('0');
                    // }

                    $('.setupdatepayable').find('input[name="grade_lvl"]').val(data.details.grade_lvl);
                    $('.setupdatepayable').find('input[name="registration_fee"]').val(data.details.registration_fee);
                    $('.setupdatepayable').find('input[name="tuition_fee"]').val(data.details.tuition_fee);
                    $('.setupdatepayable').find('input[name="uniform_fee"]').val(data.details.uniform_fee);
                    $('#update_payable-modal').modal('show');
                }, 'json');
            });

            $('#update-student-payable').on('submit', function(e) {
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
                            $('#payables-table').DataTable().ajax.reload(null, false);
                            $('.setupdatepayable').modal('hide');
                            $('.setupdatepayable').find('form')[0].reset();
                            toastr.success(data.msg);
                        }
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
                DeleteAllBtn();
            });

            function DeleteAllBtn() {
                if ($('input[name="student_checkbox"]:checked').length > 0) {
                    $('button#deleteAll').text('Delete (' + $('input[name="student_checkbox"]:checked')
                        .length +
                        ')').removeClass('d-none');
                } else {
                    $('button#deleteAll').addClass('d-none');
                }
            }

            $(document).on('change', 'input[name="student_checkbox"]', function() {

            if ($('input[name="student_checkbox"]').length == $(
                    'input[name="student_checkbox"]:checked').length) {
                $('input[name="main_checkbox"]').prop('checked', true);
            } else {
                $('input[name="main_checkbox"]').prop('checked', false);
            }
            DeleteAllBtn();
            });


            function DeleteAllBtn() {
            if ($('input[name="student_checkbox"]:checked').length > 0) {
                $('button#deleteAll').text('Delete (' + $('input[name="student_checkbox"]:checked')
                    .length +
                    ')').removeClass('d-none');
            } else {
                $('button#deleteAll').addClass('d-none');
            }
            }

            $(document).on('click', 'button#deleteAll', function() {
                var checkedStudents = [];
                $('input[name="student_checkbox"]:checked').each(function() {
                    checkedStudents.push($(this).data('id'));
                });

                var url = '{{ route('setting.delete_selected') }}';
                if (checkedStudents.length > 0) {
                    swal.fire({
                        title: 'Are you sure?',
                        html: 'You want to Delete <b>(' + checkedStudents.length +
                            ')</b> Payable Setting',
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
                                    $('#payables-table').DataTable().ajax.reload(null,
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
