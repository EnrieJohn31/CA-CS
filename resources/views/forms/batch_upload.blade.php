@extends('home.index')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('assets/js/carmeljs/form.js') }}"></script>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Student Batch Upload</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Batch Upload</li>
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
                            <h3 class="card-title">Upload File</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                            <div class="card-body">

                                <div id="information-part" class="content" role="tabpanel"
                                    aria-labelledby="information-part-trigger">

                                    <div class="pb-4">
                                        <h4>Download Student Data for Upload</h4>
                                        <p>Please download this file below for template for data upload in the database</p>
                                        <a href="{{ route('download.student.data') }}" class="btn btn-info">Download Student Data</a>
                                    </div>
                                    <form action="{{ route('student.Import') }}" method="POST" enctype="multipart/form-data" name="importform">
                                        @csrf
                                        <div class="form-group">
                                            <label for="InputFile">Batch Uploading</label>
                                            <div class="input-group">
                                                <div class="custom-file">

                                                    <input id="file" type="file" name="file">

                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Import Excel</button>
                                    </form>

                                    <br>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if(session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                            </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
