@extends('layouts.admin-main')

@section('content')
<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Edit active hire</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.hires.update', ['hire' => $hire->name]) }}" method="post">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="name" class="control-label col-sm-4">Belongs to</label>
            <div class="col-sm-6">
              {{ Form::text('vehicle', $vehicle->full_name, array('class' => 'form-control', 'disabled' => 'true')) }}
            </div>
          </div>
            <div class="form-group{{ $errors->hires->has('start_date') ? ' has-error' : '' }}">
              <label for="start_date_readonly" class="control-label col-sm-4">Start Date</label>
              <div class="col-sm-6">
                <div class="input-group">
                  <input id="start_date_readonly" class="form-control" type="text" name="start_date" value="{{ $hire->start_date }}" readonly/>
                  <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                @if( $errors->hires->has('start_date'))
                  @include('admin.common.alert-danger', ['error' => $errors->hires->first('start_date')])
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->hires->has('end_date') ? ' has-error' : '' }}">
              <label for="end_date" class="control-label col-sm-4">End Date*</label>
              <div class="col-sm-6">
                <div class="input-group">
                  {{ Form::text('end_date', $hire->end_date, array(
                    'class' => 'form-control', 'autocomplete' => 'off', 'readonly' => 'readonly',
                    'placeholder' => 'e.g. '.date('Y-m-d', strtotime(date('Y-m-d') . ' +3 days')), 'id' => 'end_date'))
                  }}
                  <span class="input-group-addon" id="end_date_calender"> <span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                @if( $errors->hires->has('end_date'))
                  <div class="help-block">
                    @include('admin.common.alert-danger', ['error' => $errors->hires->first('end_date')])
                  </div>
                @endif
              </div>
            </div>
            @if( $errors->hires->has('reservation') ?? $errors->hires->has('hire'))
              <div class="form-group has-error">
                <div class="col-sm-6 col-sm-offset-4">
                  <div class="alert alert-danger" role="alert">
                    <div class="help-block">
                      <div class="row">
                        @if($errors->hires->has('reservation'))
                          <div class="col-md-12">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                            <strong>Start date = {{ $errors->hires->get('reservation')['start_date'] }}</strong><br>
                            <strong>End date = {{ $errors->hires->get('reservation')['end_date'] }}</strong>
                          </div>
                        @endif
                        @if($errors->hires->has('hire'))
                          <div class="col-md-12">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Current active hire</strong><br>
                            <strong>Start date = {{ $errors->hires->get('hire')['start_date'] }}</strong><br>
                            <strong>End date = {{ $errors->hires->get('hire')['end_date'] }}</strong>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            <div class="row">
              <div class="col-sm-6 col-sm-offset-4">
                <div class="btn-group">
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                  <a href="{{ Session::get('url') }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection