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

        <div class="row col-lg-6 offset-lg-3 ">
            <!-- Basic Table starts -->
            <div class="card m-t-3">
                <div class="card-header">
                    <h5 class="card-header-text">Edit Employee</h5>
                </div>
                <div class="card-block">
                    <label for="">Name</label>
                    <span>{{ $employee->username }}</span>

                    <form action="{{ route('update') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" value="{{ $employee->id }}" name="employee_id">
                            <input type="text" class="form-control" name="hourly_rate" placeholder="Hourly Rate" value="{{ $employee->hourly_rate }}" />
                        </div>

                        <div class="form-group">
                            <select name="leader_id" class="form-control">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if($user->id == $employee->leader_id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
