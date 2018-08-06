@if(!empty($vehicle->getActiveHire()))
  <h3>Active hire</h3>
@else
  <h3>No active hire</h3>
@endif
@if(!empty($vehicle->getActiveHire()))
  <table class="table table-condensed">
    {{--<thead>--}}
    <tr>
      <th>Hired By</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th></th>
    </tr>
    {{--</thead>--}}
    <tr>
      <td>{{ $vehicle->getActiveHire()->hired_by }}</td>
      <td>{{ date('jS F Y', strtotime($vehicle->getActiveHire()->start_date)) }}</td>
      <td>{{ date('jS F Y', strtotime($vehicle->getActiveHire()->end_date)) }}</td>
      <td>
        <a style="width: 100%" href="{{ route('hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $vehicle->getActiveHire()->id]) }}"
           class="btn btn-info" role="button" aria-pressed="true">Shorten/Extend</a>
      </td>
    </tr>
  </table>
@endif