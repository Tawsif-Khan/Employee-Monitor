@extends('master')

@section('content')


<section class="login p-fixed d-flex text-center bg-primary ">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="login-card card-block">
                    <form class="md-float-material" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center">
                            {{-- <img src="assets/images/logo-black.png" alt="logo"> --}}
                        </div>
                        <h3 class="text-center txt-primary">
                            Sign In to your account
                        </h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-input-wrapper">
                                    <input type="email" class="md-form-control" required="required" name="email" />
                                    <label>Email</label>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="md-input-wrapper">
                                    <input type="password" class="md-form-control" required="required" name="password" />
                                    <label>Password</label>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="rkmd-checkbox checkbox-rotate checkbox-ripple m-b-25">
                                    <label class="input-checkbox checkbox-primary">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="checkbox"></span>
                                    </label>
                                    <div class="captions">Remember Me</div>

                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 forgot-phone text-right">

                                @if (Route::has('password.request'))
                                <a href="forgot-password.html" class="text-right f-w-600" href="{{ route('password.request') }}">
                                    Forget Password?
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 offset-xs-1">
                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                            </div>
                        </div>
                        <!-- <div class="card-footer"> -->
                        <div class="col-sm-12 col-xs-12 text-center">
                            <span class="text-muted">Don't have an account?</span>
                            <a href="{{ url('register') }}" class="f-w-600 p-l-5">Sign up Now</a>
                        </div>

                        <!-- </div> -->
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of login-card -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>

@endsection
