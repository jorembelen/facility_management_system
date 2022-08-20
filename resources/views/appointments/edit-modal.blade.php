
<!-- Update Job Order -->
<div class="modal fade" id="edit{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-smile"></i> Update Appointment </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('job-orders.update', $schedule->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Technician Name</label>
                        <div class="col-md-11 ml-3">
                            <h5>{{ $schedule->technicians }}</h5>
                            <select name="technicians[]" class="form-control basic" multiple>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->badge }} - {{ $employee->name }}">{{ $employee->badge }} - {{ $employee->name }} ({{ $employee->designation }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Date</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" value="{{ $schedule->date->format('M-d-Y') }}" name="date" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Time</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" value="{{ $schedule->time }}" class="form-control" name="time" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Notes</label>
                        <div class="col-md-11 ml-3">
                            <textarea name="notes" class="form-control" cols="30" rows="3">{{ $schedule->notes }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Update</button>
                    <button type="button" class="btn btn-danger waves-effect disabled-button-prevent" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Job Order -->
<div class="modal fade" id="delete{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown"></i> Delete Appointment </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal" method="POST" action="{{ route('job-orders.destroy', $schedule->id) }}">
                    @csrf
                    @method('DELETE')

                    <h4>Are you sure? This data will be lost forever.</h4>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
