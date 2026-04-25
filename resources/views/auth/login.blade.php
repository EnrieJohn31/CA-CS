@extends('layouts.app')

@section('content')
<section class="hold-transition login-page login-page--enterprise" style="background-image: url({{ URL::asset('/assets/frontend/bg.JPG') }}); background-size: cover;">
  <div class="login-box login-box--enterprise">
    <div class="card card-outline card-primary login-card">
      <div class="card-header text-center login-card__header">
        <a href="{{ route('login') }}" class="login-card__brand">
          <img src="{{ asset('assets/img/system/carmel.png') }}" alt="Carmel Academy" class="login-card__logo" onerror="this.style.display='none'">
          <span class="login-card__title"><b>Carmel</b> Academy</span>
        </a>
        <p class="login-card__subtitle">Cashier System</p>
      </div>

      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to continue</p>

        @if ($errors->any())
          <div class="alert alert-danger login-alert" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span>{{ $errors->first() }}</span>
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
          @csrf

          <div class="form-group login-field">
            <label for="name" class="login-label">Username <span class="required">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input id="name" type="text"
                     class="form-control @error('name') is-invalid @enderror"
                     name="name"
                     value="{{ old('name') }}"
                     placeholder="Enter your username"
                     required
                     autocomplete="username"
                     autofocus
                     autocapitalize="off"
                     spellcheck="false">
            </div>
            @error('name')
              <div class="invalid-feedback d-block">
                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-group login-field">
            <label for="password" class="login-label">Password <span class="required">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input id="password" type="password"
                     class="form-control @error('password') is-invalid @enderror"
                     name="password"
                     placeholder="Enter your password"
                     required
                     autocomplete="current-password">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary password-toggle" id="togglePassword"
                        aria-label="Show password" title="Show password">
                  <i class="fas fa-eye" aria-hidden="true"></i>
                </button>
              </div>
            </div>
            @error('password')
              <div class="invalid-feedback d-block">
                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
              </div>
            @enderror
            <small id="capsLockWarning" class="login-hint text-warning d-none">
              <i class="fas fa-exclamation-circle mr-1"></i>Caps Lock is on
            </small>
          </div>

          <div class="login-actions">
            <button type="submit" class="btn btn-primary btn-block login-submit" id="loginSubmit">
              <span class="login-submit__label">
                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
              </span>
              <span class="login-submit__spinner d-none">
                <i class="fas fa-spinner fa-spin mr-2"></i>Signing in...
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  var form = document.getElementById('loginForm');
  var submit = document.getElementById('loginSubmit');
  var passwordInput = document.getElementById('password');
  var toggleBtn = document.getElementById('togglePassword');
  var capsWarn = document.getElementById('capsLockWarning');

  if (toggleBtn && passwordInput) {
    toggleBtn.addEventListener('click', function () {
      var isPwd = passwordInput.type === 'password';
      passwordInput.type = isPwd ? 'text' : 'password';
      toggleBtn.setAttribute('aria-label', isPwd ? 'Hide password' : 'Show password');
      toggleBtn.setAttribute('title', isPwd ? 'Hide password' : 'Show password');
      toggleBtn.querySelector('i').className = isPwd ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
  }

  if (passwordInput && capsWarn) {
    passwordInput.addEventListener('keyup', function (e) {
      var on = e.getModifierState && e.getModifierState('CapsLock');
      capsWarn.classList.toggle('d-none', !on);
    });
    passwordInput.addEventListener('blur', function () {
      capsWarn.classList.add('d-none');
    });
  }

  if (form && submit) {
    form.addEventListener('submit', function () {
      submit.disabled = true;
      submit.querySelector('.login-submit__label').classList.add('d-none');
      submit.querySelector('.login-submit__spinner').classList.remove('d-none');
    });
  }
})();
</script>
@endsection
