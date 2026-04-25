@extends('layouts.app')

@section('content')
    <section class="hold-transition login-page login-page--enterprise welcome-hero"
        style="background-image: linear-gradient(rgba(15,23,42,.55), rgba(79,70,229,.45)), url({{ URL::asset('assets/img/system/cover.JPG') }}); background-size: cover; background-position: center;">
        <div class="welcome-hero__inner">
            <div class="welcome-hero__logo-wrap">
                <img src="{{ asset('assets/img/system/carmel.png') }}" alt="Carmel Academy" class="welcome-hero__logo">
            </div>
            <h1 class="welcome-hero__title">Carmel Academy</h1>
            <p class="welcome-hero__subtitle">Cashier &amp; Accounting System</p>
            <a href="{{ route('login') }}" class="btn btn-primary welcome-hero__cta">
                <i class="fas fa-sign-in-alt mr-2"></i>Sign in to continue
            </a>
        </div>
    </section>

    <style>
        .welcome-hero { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .welcome-hero__inner { position: relative; z-index: 2; text-align: center; color: #fff; padding: 24px; }
        .welcome-hero__logo-wrap { display: inline-flex; padding: 10px; background: rgba(255,255,255,.08); border-radius: 50%; margin-bottom: 18px; backdrop-filter: blur(6px); }
        .welcome-hero__logo { height: 140px; width: 140px; object-fit: contain; }
        .welcome-hero__title { font-size: 2.4rem; font-weight: 700; letter-spacing: -.5px; margin-bottom: 6px; }
        .welcome-hero__subtitle { font-size: 1rem; opacity: .9; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 28px; }
        .welcome-hero__cta { padding: .75rem 1.75rem; font-size: 1rem; font-weight: 600; border-radius: 8px; box-shadow: 0 8px 20px rgba(79,70,229,.4); }
        @media (max-width: 576px) {
            .welcome-hero__title { font-size: 1.7rem; }
            .welcome-hero__logo { height: 100px; width: 100px; }
        }
    </style>
@endsection
