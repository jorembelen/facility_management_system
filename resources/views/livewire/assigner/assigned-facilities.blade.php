<div>

    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Total: {{ $total }}</h3>
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Badge No.</th>
                            <th>Name</th>
                            <th>Facilities Information</th>
                            <th>Assigned Date</th>
                            @if (auth()->user()->isAssigner())
                            <th>Contract</th>
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($occupancies as $occupant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $occupant->tenant->badge }}</td>
                                <td>{{ $occupant->tenant->name }}</td>
                                <td>{{ $occupant->buildingInfo() }}</td>
                                <td>{{ $occupant->updated_at->format('M-d-Y')}}</td>
                                @if (auth()->user()->isAssigner())
                                <td>
                                    <a href="{{ route('checkin.attachment', $occupant->tenant->badge) }}" >Click to print contract</a>
                                </td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to Cancel" href="#" wire:click.prevent="alertConfirm('{{ $occupant->id }}')"><span class="badge badge-danger">Cancel</span></a>
                                </td>
                                @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
