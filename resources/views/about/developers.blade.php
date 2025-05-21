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
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">About Us</a></li>
                                    <li class="breadcrumb-item active">Developers Info</li>
                                </ul>
                            </div>
                        </div>

                        <h3 class="mt-4 mb-4">Development Team</h3>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-info"
                                        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/img/developers/devbackground.png') }}') center center; ">
                                        <h3 class="widget-user-username">Marjanne Aninao</h3>
                                        <h5 class="widget-user-desc">Developer</h5>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="{{ asset('assets/img/developers/marj.png') }}"
                                            alt="User Avatar">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Course:</h5>
                                                    <span class="description-text">Information Technology </span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Age</h5>
                                                    <span class="description-text">21</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">Contact No.</h5>
                                                    <span class="description-text">09164660602</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-info"
                                        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/img/developers/uibackground.png') }}') center center;">
                                        <h3 class="widget-user-username">Aivannah Marie Lopena</h3>
                                        <h5 class="widget-user-desc">Developer</h5>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="{{ asset('assets/img/developers/van.png') }}"
                                            alt="User Avatar">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Course:</h5>
                                                    <span class="description-text">Information Technology</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Age</h5>
                                                    <span class="description-text">21</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">Contact No.</h5>
                                                    <span class="description-text">09457629991</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                               <div class="col-md-6">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-info"
                                        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/img/developers/docubackground.png') }}') center center;">
                                        <h3 class="widget-user-username">Raymond Ganancial</h3>
                                        <h5 class="widget-user-desc">Documentary</h5>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="{{ asset('assets/img/developers/mon.png') }}"
                                            alt="User Avatar">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Course</h5>
                                                    <span class="description-text">Information Technology</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Age</h5>
                                                    <span class="description-text">21</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">Contact No.</h5>
                                                    <span class="description-text">09304286691</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-info"
                                        style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('assets/img/developers/docubackground.png') }}') center center;">
                                        <h3 class="widget-user-username">Francis Jubane</h3>
                                        <h5 class="widget-user-desc ">Documentary</h5>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="{{ asset('assets/img/developers/fran.png') }}" alt="User Avatar">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Course:</h5>
                                                    <span class="description-text">Information Technology</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Age</h5>
                                                    <span class="description-text">21</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                                <div class="description-block">
                                                    <h5 class="description-header">Contact No.</h5>
                                                    <span class="description-text">09632750979</span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>


                        </div>
                        <!-- /.row -->


                    </div>
                </div>
                <!-- /Page Content -->
            </div>
            <!-- /Page Wrapper -->
        </div>
    </section>
@endsection
