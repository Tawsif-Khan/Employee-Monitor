@extends('master')
@section("css")
.content-wrapper {
margin-left:10px;
}
@endsection
@section('content')

@include('header')

<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <!-- Header Starts -->

        <div class="row col-lg-8 offset-lg-2">
            <!-- Basic Table starts -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text">Employee List</h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Hourly rate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($employees as $employee)
                                    <tr>
                                        <td>
                                            {{ $employee->id }}
                                        </td>
                                        <td>
                                            {{ $employee->username }}
                                        </td>
                                        <td>
                                            {{ $employee->hourly_rate }}
                                        </td>
                                        <td>
                                            <a href="{{ url('employee/delete',$employee->id) }}">Delete</a> |
                                            <a href="{{ route('editEmployee',$employee->id) }}">Edit</a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            <div> {{ $employees->links() }} </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Table ends -->

        </div>


        <!-- Row end -->
        <!-- Color Picker end -->
    </div>
</div>

@endsection
