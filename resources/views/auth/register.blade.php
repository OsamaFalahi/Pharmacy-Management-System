@extends('layouts.app')

@section('content')
<div id="main-wrapper" class="oxyy-login-register">
    <div class="hero-wrap min-vh-100">
        <div class="hero-mask opacity-4 bg-secondary"></div>
        <div class="hero-bg hero-bg-scroll" style="background-image: url('{{ asset('assets/images/download.jpg') }}');"></div>
        <div class="hero-content d-flex min-vh-100">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                        <div class="hero-wrap rounded shadow-lg p-4 py-sm-5 px-sm-5 my-4">
                            <div class="hero-mask opacity-9 bg-dark"></div>
                            <div class="hero-content">
                                <div class="logo mb-4">
                                    <a class="d-flex justify-content-center" href="#" title="">
                                        <h2 class="text-white font-weight-bold">{{ __('Register') }}</h2>
                                    </a>
                                </div>
                                <form id="registerForm" class="form-dark" method="post" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name" class="text-white mb-2">{{ __('Full Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Full Name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email" class="text-white mb-2">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="mobile" class="text-white mb-2">{{ __('Phone Number') }}</label>
                                        <input id="mobile" type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" placeholder="{{ __('Phone Number') }}" required autocomplete="tel">
                                        @error('mobile')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="address" class="text-white mb-2">{{ __('Address') }}</label>
                                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="{{ __('Address') }}" autocomplete="address" required>
                                        @error('address')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="text-white mb-2">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="confirm_password" class="text-white mb-2">{{ __('Confirm Password') }}</label>
                                        <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                                        @error('confirm_password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg mt-3 mb-3" type="submit">{{ __('Register') }}</button>
                                </form>
                                <div class="text-center mt-4">
                                    <p class="text-white-50 mb-0">{{ __('Already a member?') }} <a class="text-white text-decoration-none font-weight-bold" href="{{ route('login') }}">{{ __('Login now') }}</a></p>
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
