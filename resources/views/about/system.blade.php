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
                                    <li class="breadcrumb-item active">System Information</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <!-- Image and Logos Section -->
                    <div class="row justify-content-center logo-container">
                        <div class="col-md-3 col-sm-10">
                            <img src="{{ asset('assets/img/system/BISU-LOGO.png') }}" alt="Logo 1" class="img-fluid">
                        </div>
                        <div class="col-md-2 col-sm-10">
                            <img src="{{ asset('assets/img/system/sword.png') }}" style="padding-top:110px;" alt="Logo 2" class="img-fluid">
                        </div>
                        <div class="col-md-3 col-sm-10">
                            <img src="{{ asset('assets/img/system/carmel.png') }}" alt="Logo 3" class="img-fluid">
                        </div>
                    </div>
                    <!-- /Image and Logos Section -->
                    <br>
                    <!-- Content Paragraph -->
                    <div class="content-paragraph">
                        <p class="text-justify">
                            In a noteworthy collaboration, researchers from Bohol Island State University - Balilihan Campus are teaming up with Carmel Academy for the development of the Carmel Academy Cashier System (CACS).
                            This joint effort signifies the collective expertise of BISU's researchers, who are dedicated to creating a specialized cashiering system tailored to meet the unique needs of Carmel Academy.
                            This partnership underscores the shared commitment of both institutions to innovation and the improvement of administrative processes.
                             With BISU's researchers leading the way, this collaboration aims to integrate academic insight and technological prowess to enhance the efficiency of financial transactions and contribute to the modernization of administrative systems through the Carmel Academy Cashier System.
                        </p>
                    </div>
                    <!-- /Content Paragraph -->

                </div>
                <!-- /Page Content -->
            </div>
            <!-- /Page Wrapper -->
        </div>
    </section>

    {{-- Additional Styles --}}
    @push('styles')
        <style>
            /* Image and Logos Section Styles */
            .logo-container img {
                max-width: 10%; /* Adjusted max-width for smaller logos */
                height: auto;
                margin-bottom: 10px;
            }

            /* Content Paragraph Styles */
            .content-paragraph {
                text-align: justify;
            }
            .col-md-1 col-sm-10{
                margin-top: 200px
            }

            /* Mobile Responsiveness */
            @media (max-width: 767px) {
                .logo-container img {
                    max-width: 30%; /* Ensure full width on small screens */
                }
            }
        </style>
    @endpush
@endsection
