<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Report Generated</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Income Report</h3>
                    </div>

                    <div class="card-body">

                        <section class="content">
                            <!-- Page Wrapper -->
                            <div class="container-fluid">
                                <div class="page-wrapper">
                                    <!-- Page Content -->
                                    <div class="content container-fluid" id="app">
                                        <!-- Page Header -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="col-auto float-right ml-auto">
                                                            <div class="btn-group btn-group-sm">

                                                                <button class="btn btn-dark"><i
                                                                        class="fa fa-print fa-lg"></i><a
                                                                        onClick="printdiv('printable_div_id');">
                                                                        Print</a></button>

                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-lg-8">
                                                                <form method="POST"
                                                                    action="{{ route('get.show.report') }}">
                                                                    @csrf
                                                                    <div class="row">

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label>Start Date:</label>
                                                                                <div class="form-group input-group date"
                                                                                    id="reservationdate"
                                                                                    data-target-input="nearest">
                                                                                    <input name="startdate"
                                                                                        id="startdate" type="date"
                                                                                        style="color-scheme: dark;"
                                                                                        class="form-control datetimepicker-input"
                                                                                        data-target="#reservationdate"
                                                                                        required />

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label>End Date:</label>
                                                                                <div class="form-group input-group date"
                                                                                    id="reservationdate"
                                                                                    data-target-input="nearest">
                                                                                    <input name="enddate" id="enddate"
                                                                                        type="date"
                                                                                        style="color-scheme: dark;"
                                                                                        class="form-control datetimepicker-input"
                                                                                        data-target="#reservationdate"
                                                                                        required />

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2">
                                                                            {{-- <label>Set Date</label> --}}
                                                                            <button type="submit"
                                                                                class="btn btn-primary"
                                                                                id="generate">Generate</button>
                                                                        </div>
                                                                </form>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="container printable" id='printable_div_id'>

                                                    <div class="container d-flex justify-content-center">
                                                        <div>
                                                            <img src="{{ asset('assets/img/Logo.png') }}"
                                                                class="d-flex justify-content-start p-4"
                                                                alt="">
                                                        </div>
                                                        <div class="pt-4"><br>
                                                            <h2 class="text-uppercase">Carmel Academy</h2>
                                                            <h3 class="text-uppercase">Balilihan Bohol</h3>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-center"
                                                        style="padding-top: 50px;">
                                                        <div class="ps-4">
                                                            <h3 class="text-uppercase">Income Statement</h3>
                                                            <ul class="list-unstyled">
                                                                {{-- <li>Income <span>start</span></li>
                                                                <li>Income Month Ended <span>end</span></li> --}}
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
                                                                <li>From: <u>start</u></li>
                                                                <li>To: <u>end</u></li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-center"
                                                        style="padding-top: 100px;">
                                                        <div>
                                                            <h4 class="d-flex justify-content-center m-b-10">
                                                                <strong>Income Collection:</strong>
                                                            </h4>
                                                            <table class="table table-bordered" style="width: 500px;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td><strong>CA Paper</strong><span
                                                                                class="float-right"
                                                                                id="caPaperQuantity">
                                                                                {{ $ca_paper_quantity }}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Yellow Book</strong> <span
                                                                                class="float-right"
                                                                                id="yellowBookQuantity">
                                                                                {{ $yellow_book_quantity }}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Mass Card</strong> <span
                                                                                class="float-right"
                                                                                id="massCardQuantity">
                                                                                {{ $mass_card_quantity }}</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Total Sales</strong> <span
                                                                                class="float-right"
                                                                                id="totalSales"><strong>₱
                                                                                    {{ $total_sales }}</strong></span>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="container">
                                                        <section class="m-4">
                                                            <div class="row">
                                                                <div class="col-lg-12" style="padding-left: 150px; padding-top: 100px;">
                                                                    <div class="d-flex justify-content-between">
                                                                        <p><strong>Prepared By:</strong></p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Jennifer S. Dispo<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                         Cashier</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p></p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <div class="d-flex justify-content-center">
                                                                        <p><strong>Verified By:</strong></p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center">
                                                                        <p>EMETERIO C. JAVINEZ JR. LPT, MAED<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principal</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center">
                                                                        <p></p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-12" style="padding-left: 600px;">
                                                                    <div class="d-flex justify-content-center">
                                                                        <p><strong>Approved By:</strong></p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center">
                                                                        <p>REV. FR. AGERIO V. PAÑA <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Director</p>
                                                                        <p></p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </section>
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

                    </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" hidden>Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
