@extends('master')

@section('content')


<section class="login p-fixed d-flex text-center bg-primary ">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="login-card card-block">
                    <form class="md-float-material" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="text-center">
                        </div>
                        <h3 class="text-center txt-primary">
                            Sign Up to your account
                        </h3>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="md-input-wrapper">
                                    <input type="text" class="md-form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <label>Name</label>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="md-input-wrapper">
                                    <input type="email" class="md-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="required" />
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

                            <div class="col-md-12">

                                @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="md-input-wrapper">
                                    <input id="password" type="password" class="md-form-control @error('password') is-invalid @enderror" name="password_confirmation" required>

                                    <label>Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-10 offset-xs-1">
                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Register</button>
                            </div>
                        </div>
                        <!-- <div class="card-footer"> -->
                        <div class="col-sm-12 col-xs-12 text-center">
                            <span class="text-muted">Already have an account?</span>
                            <a href="{{ url('login') }}" class="f-w-600 p-l-5">Sign In Now</a>
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
