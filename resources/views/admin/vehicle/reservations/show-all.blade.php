<div class="panel panel-default">
    @if($vehicle->reservations->isNotEmpty())
    <div class="panel-heading">
      <h3>Reservations</h3>
      <h5>{{ count($vehicle->reservations) }} reservation(s) in total</h5>
    </div>  
    @else
    <div class="panel-body">
      <h3>No reservations</h3>
    </div>
    @endif
  @if($vehicle->reservations->isNotEmpty())
    <div class="scrollable-table">
      <table class="table table-condensed panel-table">
        <thead>
          <tr>
            <th class="first">ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($vehicle->reservations->sortBy('end_date') as $reservation)
            @include('admin.reservation.destroy-modal')
            <tr>
              <td class="first">{{ $reservation->name ? $reservation->name : 'N/A'  }}</td>
              <td>{{ date('j/M/Y', strtotime($reservation->start_date)) }}</td>
              <td>{{ date('j/M/Y', strtotime($reservation->end_date)) }}</td>
              <td>
                <div class="btn-group btn-group-vertical" style="width: 100%">
                  <div class="btn-group btn-group-sm">
                    <a href="{{ route('admin.reservations.edit', ['reservation' => $reservation->name]) }}"
                      class="btn btn-primary" style="width: 100%" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit
                    </a>
                  </div>
                  <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reservation-{{ $reservation->name }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Cancel</button>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>