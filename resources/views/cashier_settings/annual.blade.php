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
                            <h3 class="card-title">Annual Fees</h3>
                            <button class="btn btn-sm btn-success float-right" id="payadbleForm"><strong>Update Annual
                                    Fee</strong></button>
                        </div>
                        <div class="card-body">

                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="Id_num1">Medical</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Medical" name="Medical"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num1">Insurance</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num1" name="Id_num1"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Death</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Library</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">School Publication</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>

                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="Id_num1">Athlete</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num1" name="Id_num1"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num1">BACS</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num1" name="Id_num1"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Book</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Laboratory</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Student ID</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>

                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="Id_num1">Passbook</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num1" name="Id_num1"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num1">HandBook</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num1" name="Id_num1"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Dental</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Completers Fee</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>
                                        <br>
                                        <label for="Id_num2">Graduation Fee</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="Id_num2" name="Id_num2"
                                                oninput="validateIdNum(this)">
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
