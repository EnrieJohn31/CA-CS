@extends('home.index')
@section('content')
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
                                    <li class="breadcrumb-item active">Cash Disbursement</li>
                                </ul>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-auto float-right ml-auto">
                                            <div class="btn-group btn-group-sm">

                                                <button class="btn btn-dark"><i class="fa fa-print fa-lg"></i><a
                                                        onClick="printdiv('printable_div_id');"> Print</a></button>

                                            </div>
                                        </div>

                                        <!-- <div class="row"> -->

                                        <div class="col-lg-13">
                                                <form method="POST" action="{{ route('cashless.total') }}">
                                                    @csrf
                                                    <!-- <div class="row"> -->
                                                    <div class="row justify-content-center mb-3">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Start Date:</label>
                                                                <div class="form-group input-group date"
                                                                    id="reservationdate" data-target-input="nearest">
                                                                    <input name="startdate" id="startdate" type="date"
                                                                        value="{{ $start_date }}"
                                                                        style="color-scheme: dark;"
                                                                        class="form-control datetimepicker-input"
                                                                        data-target="#reservationdate" required />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>End Date:</label>
                                                                <div class="form-group input-group date"
                                                                    id="reservationdate" data-target-input="nearest">
                                                                    <input name="enddate" id="enddate" type="date"
                                                                        value="{{ $end_date }}"
                                                                        style="color-scheme: dark;"
                                                                        class="form-control datetimepicker-input"
                                                                        data-target="#reservationdate" required />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <!-- <div class="row"> -->
                                                        <div class="row justify-content-center mb-3">
                                                            <div class="col-md-3">
                                                                <label>Salaries Fee</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="form-group input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="&#8369;">&#8369;</i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" id="sal_fee" name="sal_fee"
                                                                        value=" {{ $sal_fee }}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Pag-Ibig Fee</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="form-group input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="&#8369;">&#8369;</i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" id="pagibig_fee"
                                                                        name="pagibig_fee" value=" {{ $pagibig_fee }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>SSS Fee</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="form-group input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="&#8369;">&#8369;</i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" id="sss_fee" name="sss_fee"
                                                                        value="{{ $sss_fee }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center mb-3">
                                                            <div class="col-md-3">
                                                                <label>Electric and Water Fee</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="form-group input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="&#8369;">&#8369;</i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" id="ew_fee" name="ew_fee"
                                                                        value="{{ $ew_fee }}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Seminar Fee</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="form-group input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="&#8369;">&#8369;</i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" id="seminar_fee"
                                                                        name="seminar_fee" value="{{ $seminar_fee }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Payable Fee</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="form-group input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            <i class="&#8369;">&#8369;</i>
                                                                        </span>
                                                                    </div>
                                                                    <input type="text" id="payable_fee"
                                                                        name="payable_fee" value="{{ $payable_fee }}"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <!-- <div class="col-sm-3 pt-4 ps-4">
                                                                <div class="input-group mb-3 pt-2"> -->
                                                                <div class="row justify-content-center">
                                                                    <div class="col-md-2">
                                                                    <button type="submit" class="btn btn-success"
                                                                        id="generate"><strong>Generate</strong></button>
                                                                </div>
                                                            </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- --------------- -->
                                <div class="row">
                            <div class="col-md-12">
                                <div class="card container-fluid">
                                    <div class="card-body">

                                <div class="modal-body custom-modal custom-modal-content">
                                <div id='printable_div_id' >
                                    <div class="row">

                                        <div class="container d-flex justify-content-center">
                                            <div>
                                                <img src="{{ asset('assets/img/system/12.png') }}" alt="header" width="1115" height="325" class="header-image">
                                                <!-- <img src="{{ asset('assets/img/Logo.png') }}"
                                                    class="d-flex justify-content-start p-4" alt=""> -->
                                            </div>
                                            <!-- <div class="pt-4"><br>
                                                <h2 class="text-uppercase">Carmel Academy</h2>
                                                <h3 class="text-uppercase">Balilihan Bohol</h3>
                                            </div> -->
                                        </div>

                                        <div class="col-sm-12 m-b-20 d-flex justify-content-center">
                                            <div class="invoice-details"> <br>
                                                <h3 class="text-uppercase">Disbursement Statement</h3>
                                                {{-- <ul class="list-unstyled d-flex justify-content-center">
                                                    <li>For the Month Ended
                                                        <span>{{ $end_date }} </span>
                                                    </li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                        <div class="col-sm-12 m-b-20 d-flex justify-content-center" >
                                            <div class="invoice-details" hidden>
                                                <ul class="list-unstyled">
                                                    <li>Cash Beginning <span>
                                                            {{ $start_date }} </span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-lg-12 m-b-20 d-flex justify-content-center">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <h5 class="mb-0"><strong></strong></h5>
                                                </li>
                                                <li><span></span></li>
                                                <li>Official Receipt Number
                                                <li>From:<u>{{ $or_start }} </u> </li>
                                                <li>To:

                                                    <u>{{ $or_end }} </u>
                                                </li>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> --}}

                                    <div class="d-flex justify-content-center" style="padding-top: 100px;">
                                        <div>
                                            <h4 class="m-b-10"><strong>LESS: CASH DISBURSEMENTS:</strong></h4>
                                            <table class="table table-bordered" style="width: 500px;">
                                                <tbody>

                                                    <tr>
                                                        <td><strong>Cash Beginning</strong><span class="float-right">₱
                                                                {{ $total_sum }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Salaries Fees</strong> <span class="float-right">₱
                                                                {{ $sal_fee }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>SSS Fees</strong> <span class="float-right">₱
                                                                {{ $sss_fee }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Pag-Ibig Fees</strong> <span class="float-right">₱
                                                                {{ $pagibig_fee }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Light and Water</strong> <span class="float-right">₱
                                                                {{ $ew_fee }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Seminar</strong> <span class="float-right">₱
                                                                {{ $seminar_fee }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Payable Fees</strong> <span class="float-right">₱
                                                                {{ $payable_fee }}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Total</strong> <span class="float-right">₱
                                                                {{ $total_cashdisbursement }}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <section class="m-4">

                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-12 text-center mb-4 px-4" style="padding-top: 100px;">
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

    <style>


        /* Custom CSS to set the modal background color to white */
        .custom-modal {
            background-color: white; /* Set the background color to white */
        }

        .custom-modal-content {
            color: black; /* Set the text color to black */
        }

    </style>

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

            document.body.innerHTML = header_str + new_str + footer_str;

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
        allowOnlyNumbersWithDecimal('sal_fee');
        allowOnlyNumbersWithDecimal('pagibig_fee');
        allowOnlyNumbersWithDecimal('sss_fee');
        allowOnlyNumbersWithDecimal('ew_fee');
        allowOnlyNumbersWithDecimal('seminar_fee');
        allowOnlyNumbersWithDecimal('payable_fee');

    </script>
    <script>
        <!-- Bootstrap JavaScript and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </script>
@endsection
