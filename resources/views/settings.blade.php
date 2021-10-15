@extends('master')
@section("css")
.content-wrapper {
margin-left:10px;
}
@endsection
@section('content')

@include('header')



<!-- Sidebar chat end-->
<div class="content-wrapper">
    <!-- Container-fluid starts -->

    <!-- Main content starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="main-header">
                <h4>Settings</h4>
            </div>

        </div>
        <div class="row">

            <div class="card col-md-6 offset-md-3">

                <div class="card-header">
                    <h5 class="card-header-text">Update Password</h5>
                </div>
                <form action="insert-password" method="post" class="md-float-material">
                    @csrf
                    <div class="md-input-wrapper">
                        <input type="password" class="md-form-control" required="required" name="password" value="@if($settings != null) {{ $settings->password }}@endif" />
                        <label>Password</label>
                    </div>
                    <div class="md-input-wrapper text-right">
                        <button type="submit" class="btn btn-primary ">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>


@endsection
