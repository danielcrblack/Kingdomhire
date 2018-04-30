@foreach($vehicle->images as $image)
  @if($loop->first) <img src="{{ $image->image_uri }}" style="width: 100%; max-height: 225px;"/> @endif
@endforeach
<table class="table">
  <tr>
    <td>Vehicle</td>
    <td>{{ $vehicle->name() }}</td>
  </tr>
  <tr>
    <td>Type</td>
    <td>{{ $vehicle->type }}</td>
  </tr>
  <tr>
    <td>Fuel Type</td>
    <td>{{ $vehicle->fuel_type }}</td>
  </tr>
  <tr>
    <td>Gear Type</td>
    <td>{{ $vehicle->gear_type }}</td>
  </tr>
  <tr>
    <td>Seats</td>
    <td>{{ $vehicle->seats }}</td>
  </tr>
  <tr>
    <td>Status</td>
    <td>{{ $vehicle->status }}</td>
  </tr>
</table>
