@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<!-- Preloader -->
<div class="preloader preloader-dark">
    <div class="lds-ellipsis">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- Preloader End -->
  
  <div id="main-wrapper" class="oxyy-login-register">
    <div class="hero-wrap min-vh-100">
      <div class="hero-mask opacity-4 bg-secondary"></div>
      <div class="hero-bg hero-bg-scroll" style="background-image:url('{{asset('assets/images/download.jpg')}}');"></div>
      <div class="hero-content d-flex min-vh-100">
        <div class="container my-auto">
          <div class="row">
            <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
              <div class="hero-wrap rounded shadow-lg p-4 py-sm-5 px-sm-5 my-4">
                <div class="hero-mask opacity-9 bg-dark"></div>
                <div class="hero-content">
                  <div class="logo mb-4"> 
                    <a class="d-flex justify-content-center" href="#" title="">
                      <!-- <img src="images/logo-lg-light.png" alt="Oxyy">  -->
                        <h2 class="text-light">{{ __('Login') }}</h2>
                    </a> 
                    @include('inc.flash')
                </div>
                  <form id="loginForm" class="form-dark" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group icon-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address" required autocomplete="email" autofocus>
                      <span class="icon-inside"><i class="fas fa-envelope"></i></span> 
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    </div>
                    <div class="form-group icon-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                      <span class="icon-inside"><i class="fas fa-lock"></i></span> 
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block shadow-none mt-4 mb-3" type="submit"> {{ __('Login') }}</button>
                    <div class="row text-2 mt-4">
                      <div class="col-sm">
                        <div class="form-check custom-control custom-checkbox">
                          <input id="remember-me" name="remember" class="custom-control-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                          <label class="custom-control-label text-light" for="remember-me"> {{ __('Remember Me') }}</label>
                        </div>
                      </div>
                        <div class="col-sm text-right">
                            @if (Route::has('password.request'))
                          <a class="btn-link text-light" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}
                          </a>
                            @endif
                    
                        </div>
                    </div>
                  </form>
                  <div class="d-flex align-items-center mt-2 mb-3">
                    <hr class="flex-grow-1 border-dark">
                    <span class="mx-2 text-muted text-2">Or Login with</span>
                    <hr class="flex-grow-1 border-dark">
                  </div>
                  <div class="d-flex  flex-column align-items-center mb-3">
                    <ul class="social-icons social-icons-rounded">
                      <li class="social-icons-facebook"><a href="#" data-toggle="tooltip" data-original-title="Log In with Facebook"><i class="fab fa-facebook-f"></i></a></li>
                      <li class="social-icons-twitter"><a href="#" data-toggle="tooltip" data-original-title="Log In with Twitter"><i class="fab fa-twitter"></i></a></li>
                      <li class="social-icons-google"><a href="#" data-toggle="tooltip" data-original-title="Log In with Google"><i class="fab fa-google"></i></a></li>
                      <li class="social-icons-linkedin"><a href="#" data-toggle="tooltip" data-original-title="Log In with Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                  </div>
                  <p class="text-2 text-muted text-center mb-0"> <a class="btn-link text-light text-3" href="{{route('register')}}">Sign up now</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Styles Switcher -->
  <!-- <div id="styles-switcher" class="left">
    <h5>Color Switcher</h5>
    <hr>
    <ul class="mb-0">
      <li class="blue" data-toggle="tooltip" title="Blue" data-path="#"></li>
      <li class="indigo" data-toggle="tooltip" title="Indigo" data-path="css/color-indigo.css"></li>
      <li class="purple" data-toggle="tooltip" title="Purple" data-path="css/color-purple.css"></li>
      <li class="pink" data-toggle="tooltip" title="Pink" data-path="css/color-pink.css"></li>
      <li class="red" data-toggle="tooltip" title="Red" data-path="css/color-red.css"></li>
      <li class="orange" data-toggle="tooltip" title="Orange" data-path="css/color-orange.css"></li>
      <li class="yellow" data-toggle="tooltip" title="Yellow" data-path="css/color-yellow.css"></li>
      <li class="teal" data-toggle="tooltip" title="Teal" data-path="css/color-teal.css"></li>
      <li class="green" data-toggle="tooltip" title="Green" data-path="css/color-green.css"></li>
      <li class="cyan" data-toggle="tooltip" title="Cyan" data-path="css/color-cyan.css"></li>
      <li class="brown" data-toggle="tooltip" title="Brown" data-path="css/color-brown.css"></li>
    </ul>
    <button class="btn switcher-toggle"><i class="fas fa-cog"></i></button>
  </div> -->
  <!-- Styles Switcher End --> 
@endsection
