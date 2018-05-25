<div class="col-md-4 col-sm-6 col-xs-12">
  @foreach($vehicle->images as $image)
    @if($loop->first) <img src="{{ $image->image_uri }}" style="width: 100%; height: 225px;"/> @endif
  @endforeach
  <table class="table">
    <tr>
      <th>Vehicle</th>
      <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model, 'id' => $vehicle->id]) }}">{{ $vehicle->name() }}</a></td>
    </tr>
    <tr>
      <th>Status</th>
      <td>{{ $vehicle->status }}</td>
    </tr>
    <tr>
      <th>Active</th>
      @if($vehicle->is_active == true)
        <td>Yes</td>
      @else
        <td>No</td>
      @endif
    </tr>
  </table>
</div>