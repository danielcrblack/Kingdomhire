@extends('layouts.admin-main')

@section('content')
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif
  <div class="container-fluid">
  {{--<div class="row">--}}
    <div class="col-md-5 col-sm-5 col-xs-12">
      @include('admin.vehicle.list')
    </div>
    <div class="col-md-4 col-sm-7 col-xs-12">
      {{--<div class="row">--}}
        {{--<div class="col-md-7">--}}
          {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading panel-title-text">--}}
              {{--<h3>Hires per month for {{ date('Y') }}</h3>--}}
            {{--</div>--}}
            {{--<div class="panel-body" style="padding: unset">--}}
              <h3>Hires per month for {{ date('Y') }}</h3>
              <div id="hires_per_month"></div>
              @columnchart('Hires per month', 'hires_per_month')
            {{--</div>--}}
          {{--</div>--}}
          {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading panel-title-text">--}}
              {{--<h3>Number of reservations per vehicle</h3>--}}
            {{--</div>--}}
            {{--<div class="panel-body" style="padding: unset">--}}
              <h3>Reservations per vehicle</h3>
              <div id="vehicle_reservations"></div>
              @barchart('Vehicle Reservations', 'vehicle_reservations')
              @include('admin.vehicle-rate.list')
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}
    </div>
  </div>
  {{--</div>--}}
@endsection
