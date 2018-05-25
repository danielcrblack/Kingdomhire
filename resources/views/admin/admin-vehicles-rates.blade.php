@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Vehicle Rates Dashboard</h1></div>
    <div class="panel-body">
      <ul class="nav navbar-nav">
        <a href="{{ route('vehicle-rate.add') }}" class="btn btn-primary" role="button" aria-pressed="true">Add A Vehicle Rate</a>
      </ul>
    </div>
  </div>
  <div class="col-md-12">
    @include('admin.vehicle-rate.list')
  </div>
@endsection