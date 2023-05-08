@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Giriş Yap')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo" href="#">
      <h2 class="brand-text text-primary ms-1">KCTEK</h2>
    </a>
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
          <img class="img-fluid" src="{{asset('images/pages/login-v2-dark.svg')}}" alt="Login V2" />
          @else
          <img class="img-fluid" src="{{asset('images/pages/login-v2.svg')}}" alt="Login V2" />
          @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Login-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title fw-bold mb-1">KCTEK</h2>
        <p class="card-text mb-2">KCTEK CRM uygulamasına Hoş Geldiniz</p>
        <form method="POST" action="{{ route('login') }}" class="auth-login-form mt-2">
        @csrf
          <div class="mb-1">
            <label class="form-label" for="login-email">E-mail</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" tabindex="1" />
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="login-password">Parola</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password" type="password" name="password" required autocomplete="current-password" tabindex="2" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" tabindex="3" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
              <label class="form-check-label" for="remember-me"> Beni Hatırla</label>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="4" type="submit">{{ __('Giriş Yap') }}</button>
        </form>
      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
@endsection


{{-- <form method="POST" action="{{ route('login') }}">
    @csrf
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <button type="submit" class="btn btn-primary">
        {{ __('Login') }}
    </button> --}}
