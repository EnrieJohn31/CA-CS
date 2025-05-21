@extends('home.index')
@section('content')
<style>
    /* Define a printable style */
    @media print {
        body {
            visibility: hidden;
            width: auto;
        }
        .printable {
            visibility: visible;
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    /* Style for the editable div */
    .editable-div {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
        min-height: 100px;
    }

        /* Custom CSS to set the modal background color to white */
        .custom-modal {
            background-color: white; /* Set the background color to white */
        }

        .custom-modal-content {
            color: black; /* Set the text color to black */
        }

        hr {
            height: 0.5px; /* Adjust the height to make the line thicker */
            background-color: black; /* Set the color of the line */
            border: none; /* Remove the default border */
            margin: 20px 0; /* Adjust the margin as needed */
        }

</style>

    <section class="content">
        <!-- Page Wrapper -->
        <div class="container-fluid">
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container-fluid" id="app">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Report</li>
                                </ul>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="col-lg-12">
                                <div class="card container-fluid">
                                    <div class="card_body">
                                        <form method="POST" action="{{ route('forms.total') }}">
                                                    @csrf
                                            <div class="row justify-content-center pt-4">
                                                <div class="col-md-3">
                                                    <div class="f2orm-group">
                                                        <label>Start Date:</label>
                                                        <div class="form-group input-group date"
                                                            id="reservationdate" data-target-input="nearest">
                                                            <input name="startdate" id="startdate" type="date"
                                                            value style="color-scheme: dark;"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#reservationdate" required/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>End Date:</label>
                                                        <div class="form-group input-group date"
                                                            id="reservationdate" data-target-input="nearest">
                                                            <input name="enddate" id="enddate" type="date"
                                                            style="color-scheme: dark;"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#reservationdate" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center pt-4">
                                                <button type="submit" class="btn btn-success" id="generate">Generate</button>
                                                <button type="button" class="btn btn-primary" onClick="printdiv('printable_div_id');">Print</button>
                                            </div><br>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card container-fluid">
                                    <div class="card-body">
                                        <div class="modal-body custom-modal custom-modal-content">   <!--<--- no end tag -->
                                        <div class="container printable" id='printable_div_id'>
                                    <div class="container d-flex justify-content-center">
                                        <div>
                                            <img src="{{ asset('assets/img/system/heading.png') }}" alt="header" width="1000" height="325" class="header-image">
                                            <!-- <img src="{{ asset('assets/img/Logo.png') }}"
                                                class="d-flex justify-content-start p-4" alt=""> -->
                                        </div>
                                        <!-- <div class="pt-4"><br>
                                            <h2 class="text-uppercase">Carmel Academy</h2>
                                            <h3 class="text-uppercase">Balilihan Bohol</h3>
                                        </div> -->
                                    </div>

                                    <div class="d-flex justify-content-center" style="padding-top: 50px;">
                                        <div class="ps-4">
                                            <h3 class="text-uppercase">Income Statement</h3>
                                            <ul class="list-unstyled d-flex justify-content-center">
                                                <li>For the Month Ended <span>{{ $end_date }}</span></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between" style="padding-left: 200px;">
                                        <div class="invoice-details" hidden>
                                            <ul class="list-unstyled">
                                                <li>Cash Beginning <span>{{ $start_date }}</span></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-left: 200px;" hidden>
                                        <div class="col-lg-12 m-b-20">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <h5 class="mb-0"><strong></strong></h5>
                                                </li>
                                                <li><span></span></li>
                                                <li>Official Receipt Number</li>
                                                <li>From: <u>{{ $or_start }}</u></li>
                                                <li>To: <u>{{ $or_end }}</u></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- <div class="d-flex justify-content-center" style="padding-top: 100px;">
                                        <div>
                                            <h4 class="d-flex justify-content-center m-b-10"><strong>CASH Collection:</strong></h4>
                                            <table class="table table-bordered" style="width: 500px;">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Monthly Tuition</strong><span class="float-right">₱
                                                                {{ $tui_sum }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Enrollment Fee</strong> <span class="float-right">₱
                                                                {{ $reg_sum }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Uniform</strong> <span class="float-right">₱
                                                                {{ $uni_sum }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Other Fees</strong> <span class="float-right">₱
                                                                {{ $oth_sum }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Total</strong> <span class="float-right"><strong>₱
                                                                {{ $total_sum }}</strong></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> -->
                                    <!-- ------------------------------------------------------------------ -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-center" style="padding-top: 50px;">
                                                    <table class="table table-bordered" style="width: 100%;">
                                                        <tbody>
                                                            <!-- Header Row -->
                                                            <tr>
                                                                <td colspan="2" class="text-center">
                                                                    <h4 class="m-b-10"><strong>CASH Collection:</strong></h4>
                                                                </td>
                                                            </tr>

                                                            <!-- First Column -->
                                                            <tr>
                                                                <td style="width: 50%;">
                                                                <table class="table table-bordered" style="width: 100%;">
                                                                        <tbody>
                                                                            <!-- Content for the first column -->
                                                                            <strong>Monthly Tuition</strong><span class="float-right">₱ {{ $tui_sum }}</span> <hr>

                                                                            <strong>Enrollment Fee</strong> <span class="float-right">₱ {{ $reg_sum }}</span><hr>

                                                                            <strong>Uniform</strong> <span class="float-right">₱ {{ $uni_sum }}</span><hr>

                                                                            <strong>Medical Fee</strong> <span class="float-right">₱ {{ $Medical }}
                                                                                        </span><hr>
                                                                            <strong>Insurance Fee</strong> <span class="float-right">₱ {{ $Insurance }}
                                                                                        </span><hr>
                                                                            <strong>Death Fee</strong> <span class="float-right">₱  {{ $Death }}
                                                                            </span><hr>

                                                                            <strong>Library Fee</strong> <span class="float-right">₱  {{ $Library }}
                                                                            </span><hr>

                                                                            <strong>School Publication Fee</strong> <span class="float-right">₱ {{ $School_Pub }}
                                                                            </span><hr>

                                                                            <strong>Athlete Fee</strong> <span class="float-right">₱ {{ $Athlet }}
                                                                            </span><hr>

                                                                            <strong>BACS Fee</strong> <span class="float-right">₱ {{ $BACS  }}
                                                                            </span>

                                                                        </tbody>
                                                                    </table>
                                                                </td>

                                                                <!-- Second Column -->
                                                                <td style="width: 50%;">
                                                                    <table class="table table-bordered" style="width: 100%;">
                                                                        <tbody>
                                                                            <!-- Content for the second column -->

                                                                            <strong>Book Fee</strong> <span class="float-right">₱ {{ $Book  }}
                                                                            </span><hr>
                                                                            <strong>Laboratory Fee</strong> <span class="float-right">₱ {{ $Laboratory  }}
                                                                            </span><hr>
                                                                            <strong>StudentID Fee</strong> <span class="float-right">₱ {{ $StudentID  }}
                                                                            </span><hr>
                                                                            <strong>Passbook Fee</strong> <span class="float-right">₱ {{ $Passbook  }}
                                                                            </span><hr>
                                                                            <strong>Handbook Fee</strong> <span class="float-right">₱ {{ $Handbook  }}
                                                                            </span><hr>
                                                                            <strong>Dental Fee</strong> <span class="float-right">₱ {{ $Dental  }}
                                                                            </span><hr>
                                                                            <strong>Completers Fee</strong> <span class="float-right">₱ {{ $Completers_Fee }}
                                                                            </span><hr>
                                                                            <strong>Graduation Fees</strong> <span class="float-right">₱ {{ $graduation }}
                                                                            </span><hr>
                                                                            <strong>Other Fees</strong> <span class="float-right">₱ {{ $oth_sum }}</span><hr>

                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>

                                                            <!-- Footer Row -->
                                                            <tr>
                                                                <td colspan="2" class="text-right"><strong>Total:</strong> ₱ {{ $total_sum }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ------------------- -->
                                    <div class="container">
                                                        <section class="m-4">

                                                                    <div class="row justify-content-center">
                                                                        <div class="col-lg-12 text-center mb-4 px-4" style="padding-top: 10px;">
                                                                            <div class="d-flex justify-content-center">
                                                                                <p><strong>Prepared By:</strong></p>
                                                                            </div>
                                                                            <div class="d-flex justify-content-center">
                                                                                <p>JENNIFER S. DISPO<br>Cashier</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 text-right mb-4 px-4"hidden >
                                                                    <div class="d-flex justify-content-end">
                                                                        <p><strong>Verified By:</strong></p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end"hidden>
                                                                         <p>EMETERIO C. JAVINEZ JR. LPT, MAED<br>Principal</p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12 text-right mb-4 px-4"hidden>
                                                                    <div class="d-flex justify-content-end">
                                                                        <p><strong>Approved By:</strong></p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end"hidden>
                                                                        <p>REV. FR. AGERIO V. PAÑA <br> Director</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </section>
                                                    </div>
                                    <!-- ---------------- -->
                                </div>
                            </div>
                        </div>

                        </div>
                                </div>
                    </div>
                </div>
                <!-- /Page Content -->
            </div>
            <!-- /Page Wrapper -->
        </div>
    </section>

    <script>
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

            document.body.innerHTML = header_str +  new_str  +footer_str ;

            window.print();

            document.body.innerHTML = old_str;

            return false;
        }

        $(document).on('click', '#generate', function() {
            var student_id = $(this).data('id');
            $('.editStudent').find('form')[0].reset();
            $('.editStudent').find('span.error-text').text('');
            $.post('<?= route('get.show.payment') ?>', {
                student_id: student_id
            }, function(data) {
                //   alert(data.details.name);
                $('.editStudent').find('input[name="sid"]').val(data.details.id);
                $('.editStudent').find('input[name="startdate"]').val(data.details.datepaid);
                $('.editStudent').find('input[name="or_num"]').val(data.details.or_no);
            }, 'json');
        });
    </script>
@endsection
