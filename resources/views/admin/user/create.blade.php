@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="well">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 style="padding-left: 5px">Create a user</h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.users.store') }}" method="post">
              @csrf
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label col-md-4">Name*</label>
                <div class="col-md-8">
                {{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Enter Name')) }}
                  @if( $errors->has('name'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('name') }}</strong>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label col-md-4">E-Mail*</label>
                <div class="col-md-8">
                  {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Enter E-Mail')) }}
                  @if( $errors->has('email'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('email') }}</strong>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label col-md-4">Password*</label>
                <div class="col-md-8">
                  {{ Form::password('password', array(
                    'class' => 'form-control', 'autocomplete' => 'off',
                    'placeholder' => 'Enter password'))
                  }}
                  @if( $errors->has('password'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('password') }}</strong>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('password_confirmed') ? ' has-error' : '' }}">
                <label for="password_confirmation" class="control-label col-md-4">Confirm password*</label>
                <div class="col-md-8">
                  {{ Form::password('password_confirmation', array(
                    'class' => 'form-control', 'autocomplete' => 'off',
                    'placeholder' => 'Confirm password'))
                  }}
                  @if( $errors->has('password_confirmation'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-xs-8 col-xs-offset-4">
                  <div class="btn-group">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Create</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection