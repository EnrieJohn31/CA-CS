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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Registered Students</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Data</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered table-striped" id="student-table">
                        <thead>
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Level</th>
                            <th>SY</th>
                            <th>Strand</th>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="h-25">
                                    <td>{{ $student->Id_num }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->section }}</td>
                                    <td>{{ $student->lvl }}</td>
                                    <td>{{ $student->ay }}</td>
                                    <td>{{ $student->strand }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pt-4 d-flex justify-content-center">
                        {{ $students->links() }}
                    </div>


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
@endsection
