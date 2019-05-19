@extends('layouts.admin-vehicle-dashboard')

@section('content')
  <div class="row">
    @if($gantt != null)
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Schedule</h3>
            <h5>R = Reservation</h5>
            <h5>H = Active hire</h5>
            <h5>{{Route::current()->getName()}}</h5>
          </div>
          {!! $gantt !!}
        </div>
      </div>
    @endif
    <div class="col-lg-6 col-md-12">
      @include('admin.vehicle.hires.show-active')
      @include('admin.vehicle.reservations.show-all')
    </div>
    <div class="col-lg-6 col-md-12">
      @include('admin.vehicle.reservations.create')
      <div class="row">
        <div class="col-lg-12">
          @include('admin.vehicle.charts.yearly-hires-graph')
          @include('admin.vehicle.charts.yearly-hires')
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12">
      <!-- @if($gantt != null)
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>Schedule</h3>
                <h5>R = Reservation</h5>
                <h5>H = Active hire</h5>
              </div>
              {!! $gantt !!}
            </div>
          </div>
        </div>
      @endif -->
      <!-- <div class="row">
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-12">
              @include('admin.vehicle.charts.yearly-hires')
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          @include('admin.vehicle.charts.yearly-hires-graph')
        </div>
      </div> -->
    </div>
  </div>
@endsection