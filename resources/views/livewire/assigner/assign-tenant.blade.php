@section('title', 'Assign Tenant')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Total Vacant Facilities: {{ $total }}</h3>
                 </div>


                    <div class="col-sm-12 col-md-6 text-sm-end">
                        <div id="datatable_filter" class="dataTables_filter"><label>Search:
                            <input type="search" class="form-control form-control-sm" placeholder="Search Type or ID here ..." aria-controls="datatable" wire:model.debounce.500ms="query"></label>
                        </div>
                    </div>
                <div class="card-body">
                    <table   class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Villa #</th>
                                <th>Lot Villa #</th>
                                <th>RC Bldg. #</th>
                                <th>IFC Bldg. #</th>
                                <th>Flat Unit #</th>
                                <th>Block #</th>
                                <th>Street</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($buildings as $building)
                            <tr>
                                <td>{{ $building->id }}</td>
                                <td>{{ $building->villa_no }}</td>
                                <td>{{ $building->lot_no }}</td>
                                <td>{{ $building->rc_no }}</td>
                                <td>{{ $building->ifc_no }}</td>
                                <td>{{ $building->flat_no }}</td>
                                <td>{{ $building->block_no }}</td>
                                <td>{{ $building->street }}</td>
                                <td>{{ $building->type->name }}</td>
                                <td>
                                    @if ($building->status == 1)
                                    <span class="badge badge-primary">Occupied</span>
                                    @else
                                    <span class="badge badge-danger">Vacant</span>
                                    @endif
                                </td>
                                <td>
                                    <div wire:loading wire:target="assign('{{ $building->id }}')">
                                        <div class="spinner-border text-danger mr-2" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <div wire:loading.remove wire:target="assign('{{ $building->id }}')">
                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to Assign {{ $building->id }}" href="#" wire:click.prevent="assign('{{ $building->id }}')"><span class="badge badge-primary">Assign</span></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $buildings->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Assign modal content -->
    <div id="assignStaff" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Assign {{ $buildingId }} - {{ $facilityType }}</h4>
                    <button type="button" class="close" wire:click.prevent="close">×</button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" wire:submit.prevent="submit('{{ $buildingId }}')" type="multipart">

                        <div class="form-group">
                            <label class="form-label">Tenant Name</label>
                            <div wire:ignore>
                                <select wire:change="$emit('classChanged', $event.target.value)" class="form-control select2" id="tenant" >
                                    <option value="">Choose Tenant</option>
                                    @foreach ($tenants as $item)
                                    <option value="{{ $item->badge }}">{{ $item->badge }} - {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('tenant')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="form-label">Assign Date</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control" id="flatpickr" wire:model="assigned_date" placeholder="select date">
                                </div>
                                @error('assigned_date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Remarks</label>
                            <textarea wire:model.defer="remarks" class="form-control" cols="30" rows="6"></textarea>
                            @error('remarks')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>


                <div class="modal-footer">
                    <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="close,submit">
                        <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </div>
            </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


</div>

    @push('assign-js')

    <script src="/assets/plugins/flatpickr/flatpickr.js"></script>
    <script>
        var f1 = flatpickr(document.getElementById('flatpickr'), {
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: new Date().fp_incr(14) // 14 days from now
        });
    </script>
    <script>
        $('form').submit(function() {
            @this.set('tenant', $('#tenant').val());
        })
        window.addEventListener('show-form', function (event) {
            $('#assignStaff').modal('show');
        });
        window.addEventListener('hide-form', function (event) {
            $('#assignStaff').modal('hide');
        });
    </script>
    @endpush

