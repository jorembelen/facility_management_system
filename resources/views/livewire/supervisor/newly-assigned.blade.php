<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Total: {{ $total }}</h3>
                </div>
                <div class="card-body">
                    <table id="{{ $table ? 'datatables' : 'responsive' }}"  class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Badge No.</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Building Type</th>
                                <th>Assigned Date</th>
                                <th>Remarks</th>
                                <th>Contract</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($occupancies as $occupant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $occupant->tenant->badge ?? null }}</td>
                                <td>{{ $occupant->tenant->name ?? null }}
                                    {{-- <a href="#">{{ $occupant->tenant->name }}</a> --}}
                                </td>
                                <td>{{ $occupant->buildingInfo() }}</td>
                                    <td>{{ $occupant->type->name }}</td>
                                    <td>{{ $occupant->updated_at->format('Y-m-d')}}</td>
                                    <td>{{ $occupant->occupancy->remarks }}</td>
                                    <td>
                                        <a href="{{ route('checkin.attachment', $occupant->tenant->badge) }}" >Click to print contract</a>
                                    </td>
                                    <td class="text-center">
                                        @if (auth()->user()->role == 'supervisor')
                                        <a href="#" wire:click.prevent="checkIn('{{ $occupant->id }}')"><span class="badge badge-success">Check In</span></a>
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


    <div id="assign" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-grin" style="color:#3F80EA"></i> Check In {{ $tenantName }}?</h3>

                    <button type="button" class="close" wire:click.prevent="close">×</button>
                </div>
                <div class="modal-body">

                    <div class="form-group mt-2">
                        <h4 class="mb-2 text-center">If you are sure, please click Yes to proceed.</h4>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Checkin Date</label>
                            <div wire:ignore>
                                <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" wire:model.defer="checkin_date" placeholder="select date">
                            </div>
                            @error('checkin_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                    </div>
                    <div class="form-group mt-2" wire:loading.remove wire:target="checkin_attachment">
                        <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                        <input type="file" class="form-control-file"  wire:model="checkin_attachment" id="upload{{ $iteration }}">

                        @error('checkin_attachment')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <div wire:loading wire:target="checkin_attachment" class="progress-bar progress-bar-striped progress-bar-animated mt-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Uploading . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="submit, checkin_attachment, close">
                        <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="submit('{{ $buildingId }}')">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

@include('scripts.checkin')

@push('users-js')

<script>
    document.addEventListener('livewire:load', function () {
        $('#datatables').DataTable();
    });
    window.addEventListener('hide-form', function (event) {
        $('#responsive').DataTable();
    });
</script>

@endpush
