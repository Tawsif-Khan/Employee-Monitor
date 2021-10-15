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

    <!-- Row start -->

    <!-- Row end -->

    <!-- Main content starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="main-header">
                <h4>Dashboard</h4>
            </div>

        </div>
        <!-- 4-blocks row start -->
        <div class="row dashboard-header">

            <div class="card-block col-lg-6 col-md-12">
                <form action="/search" method="GET" class="form-inline">
                    {{-- @csrf --}}
                    <div class="form-group m-r-15">
                        <label for="inline3mail" class="block form-control-label">Select Username</label>
                        <select class="form-control p-r-55" tabindex="-1" aria-hidden="true" name="employee_id" style="width:100%;">
                            <option value="">-- Select Employee --</option>
                            @if ($employees)

                            @foreach ($employees as $employee)

                            <option @if($employee_id==$employee->id) selected @endif value="{{ $employee->id}}">{{ $employee->username }}</option>

                            @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="form-group m-r-15">
                        <label for="date" class="block form-control-label">Select Date</label>

                        <input type="date" id="date" class="form-control floating-label" name="date" value="{{explode(" ",$date)[0]}}" placeholder="Date">
                    </div>
                    <div class="form-check p-t-30">
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card dashboard-product">
                    <span>Earnings(This month)</span>
                    <h2 class="dashboard-total-products">{{ number_format($earnings, 2, '.', '')}}</h2>
                    <div class="side-box">
                        <i class="ti-money text-success-color"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card dashboard-product">
                    <span>Websites</span>
                    <h2 class="dashboard-total-products">{{ count($chart) }}</h2>
                    <div class="side-box">
                        <i class="ti-world text-warning-color"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <div class="card dashboard-product">
                    <span>Activities</span>
                    <h2 class="dashboard-total-products">
                        {{ ($activities->total()) }}+</h2>
                    <div class="side-box ">
                        <i class="ti-stats-up text-primary-color"></i>
                    </div>
                </div>
            </div>



        </div>
        <!-- 4-blocks row end -->

        <!-- 1-3-block row start -->
        <div class="row">
            <div class="col-md-5">
                <div class="card mb-4 h-100">
                    <div class="card-header">
                        <h5 class="card-header-text">Duration per website ({{ number_format($totalTime/60, 0, '.', '') }} Hours
                            {{ number_format($totalTime%60, 2, '.', '') }} minutes)</h5>
                    </div>
                    <div class="card-block bg-lignt">
                        <div id="placeholder3" class="demo-placeholder" style="height: 500px;margin-top:75px;"></div>
                    </div>
                    <!-- Donut Hole end -->
                </div>
            </div>
            <div class="col-xl-7 col-lg-12">
                <!-- Nav tabs -->

                <ul class="nav nav-tabs  tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home1" role="tab">Activity</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile1" role="tab">Screenshots</a>
                    </li>


                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div class="tab-pane active" id="home1" role="tabpanel">
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table m-b-0 photo-table">
                                        <thead>
                                            <tr class="text-uppercase">
                                                <th>Username</th>
                                                <th>Domain</th>
                                                <th>Duration( minutes )</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($activities as $activity)
                                            <tr>
                                                <td>
                                                    {{ $activity->username }}
                                                </td>
                                                <td>
                                                    <a href="{{ $activity->domain }}">{{ $activity->domain }}</a>

                                                </td>
                                                <td>
                                                    {{ $activity->duration }}
                                                </td>
                                                <td>
                                                    {{ date('h:i A', strtotime(explode(" ",$activity->created_at)[1])) }}
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $activities->render() }}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile1" role="tabpanel">
                        <div class="row">

                            <!-- Images gallery starts -->
                            <div class="col-md-12">
                                <div class="card">

                                    <div class="card-block">
                                        <div class="row">

                                            @foreach ($images as $image)

                                            <div class="col-xl-2 col-lg-3 col-sm-3 col-xs-12">
                                                <a href="images/{{ $image->image }}" data-toggle="lightbox" data-gallery="example-gallery">
                                                    <img src="images/{{ $image->image }}" class="img-fluid" alt="">
                                                </a>

                                                <span class="m-b-20 text-muted">{{ date('h:i A', strtotime(explode(" ",$image->created_at)[1])) }}</span>
                                            </div>
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Images gallery ends -->

                        </div>
                    </div>

                </div>

            </div>
            <!-- Donut Hole start -->

        </div>
        <!-- 1-3-block row end -->

        <!-- 2-1 block start -->

        <!-- 2-1 block end -->
    </div>
    <!-- Main content ends -->
    <!-- Container-fluid ends -->


    @include('scripts')
    <script>
        "use strict";
        $(document).ready(function() {
            $(window).resize(function() {
                donutChart();
            });

            donutChart();

            /*Donut Hole*/
            function donutChart() {

                var data2 = @php
                echo json_encode($chart);
                @endphp

                $.plot("#placeholder3", data2, {
                    series: {
                        pie: {
                            innerRadius: 0.2
                            , show: true
                        , }
                        , legend: {
                            show: true
                        , }
                    , }
                , });
            }
        });

    </script>

</div>

@endsection
