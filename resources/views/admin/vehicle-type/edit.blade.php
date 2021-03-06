@extends('layouts.admin-main')

@section('content')
<div class="col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Edit vehicle type</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.vehicle-types.update', ['vehicle_type' => $vehicleType->slug]) }}" method="post" id="vehicle_type_edit_form">
          @csrf
          @method('PATCH')
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label col-sm-4">Name*</label>
            <div class="col-sm-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $vehicleType->name }}" autocomplete="off">
              @if( $errors->has('name'))
                @include('admin.common.alert-danger', ['error' => $errors->first('name')])
              @endif
            </div>
          </div>
        </form>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-4">
                <div class="btn-group">
                  <button type="submit" form="vehicle_type_edit_form" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                  <a href="{{ route('admin.vehicle-types.index') }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
