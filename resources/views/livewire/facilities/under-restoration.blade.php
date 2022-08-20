@section('title', 'Under Restoration')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Total: {{ $total }}</h4>
                </div>
                <div class="card-body">
                    <table id="datatables-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Facility Information</th>
                                <th>Checkout Date</th>
                                <th>Facility Availability</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($buildings as $building)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $building->block_no ? $building->buildingInfo() : $building->street .' (' .$building->type->name .')' }}
                                </td>
                                <td>{{ date('M-d-Y', strtotime($building->checkout->checkout_date)) }}</td>
                                <td>{{ $building->availabiltyDate() }}</td>
                                <td>{{ $building->restorationNotes() }}</td>
                                <td>
                                    <span class="badge badge-warning">Under Restoration</span>
                                </td>
                                <td>
                                    @if ($building->restorationUpdatedCount() === 0 && auth()->user()->role == 'supervisor')
                                    <a href="#" wire:click.prevent="showUpdate('{{ $building->id }}')">
                                        <span class="btn btn-primary btn-sm">Update Availability</span>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Job Order -->
<div class="modal fade" id="update" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-edit"></i> Update Availability </h3>
                <button type="button" class="close" wire:click.prevent="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form wire:submit.prevent="update('{{ $buildingId }}')">
                <div class="form-group row">
                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Availability Date</label>
                    <div class="col-md-11 ml-3">
                        <div wire:ignore>
                            <input type="text" class="form-control flatpickr flatpickr-input active" id="datepicker" wire:model.defer="availability_date" placeholder="select availability date">
                        </div>
                        @error('availability_date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Notes</label>
                    <div class="col-md-11 ml-3">
                        <textarea wire:model.defer="notes" class="form-control" cols="30" rows="3">{{ $notes }}</textarea>
                    </div>
                    @error('notes')
                    <div class="text-danger ml-4">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="remove" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Deleting . . .</div>
                <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove wire:target="remove, close">
                    <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                    <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

</div>


@push('restoration-js')

<script src="/assets/plugins/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('datepicker'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
</script>
<script>
    window.addEventListener('refreshComponent', event => {
          var datatablesButtons = $("#export-buttons").DataTable({
            responsive: true,
            lengthChange: !1,
            buttons: 'copy'
        });
        datatablesButtons.buttons().container().appendTo("#export-buttons_wrapper .col-md-6:eq(0)");

    })
</script>

<script>
    window.addEventListener('show-modal', function (event) {
        $('#update').modal('show');
    });
    window.addEventListener('hide-modal', function (event) {
        $('#update').modal('hide');
    });
</script>
@endpush
