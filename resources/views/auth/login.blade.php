@extends('layouts.app')

@section('content')
<div id="main-wrapper" class="oxyy-login-register">
    <div class="hero-wrap min-vh-100">
        <div class="hero-mask opacity-4 bg-secondary"></div>
        <div class="hero-bg hero-bg-scroll" style="background-image: url('{{asset('assets/images/download.jpg')}}');"></div>
        <div class="hero-content d-flex min-vh-100">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                        <div class="hero-wrap rounded shadow-lg p-4 py-sm-5 px-sm-5 my-4">
                            <div class="hero-mask opacity-9 bg-dark"></div>
                            <div class="hero-content">
                                <div class="logo mb-4"> 
                                    <a class="d-flex justify-content-center" href="#" title="">
                                        <h2 class="text-white font-weight-bold">{{ __('Login') }}</h2>
                                    </a> 
                                    @include('inc.flash')
                                </div>
                                <form id="loginForm" class="form-dark" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email" class="text-white mb-2">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="text-white mb-2">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="form-check">
                                            <input id="remember-me" name="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-white-50" for="remember-me">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg mt-3 mb-3" type="submit">{{ __('Login') }}</button>
                                    <div class="text-center mt-3">
                                        @if (Route::has('password.request'))
                                            <a class="text-white-50 text-decoration-none" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                        @endif
                                    </div>
                                </form>
                                <div class="text-center mt-4">
                                    <p class="text-white-50 mb-0">{{ __('Don\'t have an account?') }} <a class="text-white text-decoration-none font-weight-bold" href="{{ route('register') }}">{{ __('Sign up now') }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
