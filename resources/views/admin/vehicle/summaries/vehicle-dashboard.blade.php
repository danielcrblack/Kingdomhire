<div class="col-lg-4 col-md-4 col-sm-6">
  <div class="panel panel-default">
    <div class="panel-heading vehicle-panel-dashboard-heading">
      <h2>Vehicle Dashboard</h2>
      <h4>{{ $vehicle->make_model }}</h4>
    </div>
    @if($vehicle->images->isEmpty())
    <div class="vehicle-img">
      <div class="vehicle-img-na">
        <h2 class="dashboard"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;No Image(s)</h2>
      </div>
    </div>
    @else
      <div class="vehicle-img">
        <img class="dashboard" src="{{ asset($vehicle->images->first()->image_uri) }}"/>
        <button class="btn btn-info vehicle-img-button vehicle-open-modal" data-vehicle="{{ $vehicle->slug }}">View images</button>
      </div>
    @endif
    <table class="table table-condensed vehicle-table-dashboard">
      <tr>
        <th class="first">ID</th>
        <td class="first">{{ $vehicle->name }}</td>
      </tr>
      <tr>
        <th>Status</th>
        <td>{{ $vehicle->status }}</td>
      </tr>
      <tr>
        <th>Vehicle Type</th>
        <td>@if($vehicle->type != null) {{ $vehicle->type->name }} @else N/A @endif</td>
      </tr>
      <tr>
        <th>Fuel Type</th>
        <td>@if($vehicle->fuelType != null) {{ $vehicle->fuelType->name }} @else N/A @endif</td>
      </tr>
      <tr>
        <th>Gear Type</th>
        <td>@if($vehicle->gearType != null) {{ $vehicle->gearType->name }} @else N/A @endif</td>
      </tr>
      <tr>
        <th class="last">Weekly Rate</th>
        <td class="last">@if($vehicle->weeklyRate != null) {{ $vehicle->weeklyRate->full_name }} @else N/A @endif</td>
      </tr>
      <tr>
        <th>Seats</th>
        <td>{{ $vehicle->seats }}</td>
      </tr>
      <tr>
        <th>Date Added</th>
        <td>{{ date('j/M/Y H:ia', strtotime($vehicle->created_at)) }}</td>
      </tr>
      <tr>
        @if($vehicle->trashed())
          <th>Date Discontinued</th>
          <td class="last">{{ date('j/M/Y H:ia', strtotime($vehicle->deleted_at)) }}</td>
        @else
          <th>Last Changed</th>
          <td class="last">{{ date('j/M/Y H:ia', strtotime($vehicle->updated_at)) }}</td>
        @endif
      </tr>
    </table>
    <div class="panel-footer" style="padding: 0">
      @if($vehicle->trashed())
        {{ Form::open(['route' => ['admin.vehicles.recontinue', $vehicle->slug], 'method' => 'patch', 'id' => 'vehicle_recontinue_form']) }}
        {{ Form::close() }}
      @endif
      <div class="row">
        <div class="col-lg-12">
          <div class="btn-group btn-group-justified" style="table-layout: unset">
            @if(!$vehicle->trashed())
              <div class="btn-group">
                <a class="btn btn-primary" href="{{ route('admin.vehicles.edit', ['vehicle' => $vehicle->slug]) }}"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{ $vehicle->slug }}-discontinue"><span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Discontinue</button>
              </div>
            @else
              <div class="btn-group">
                <button type="submit" form="vehicle_recontinue_form" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Re-continue</button>
              </div>
            @endif
            <div class="btn-group">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{{ $vehicle->slug }}-delete"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>