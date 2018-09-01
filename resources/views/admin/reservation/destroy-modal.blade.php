<div class="modal fade" id="reservation-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cancel Reservation</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to cancel this reservation?
      </div>
      {{ Form::open(['route' => ['admin.reservations.destroy', $reservation->id], 'method' => 'delete', 'id' => 'reservation-'.$reservation->id.'-cancel-form']) }}
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;No</button>
        <button type="submit" form="reservation-{{ $reservation->id }}-cancel-form" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Yes</button>
      </div>
    </div>
  </div>
</div>