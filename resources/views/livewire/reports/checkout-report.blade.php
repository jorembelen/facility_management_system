@section('title', 'Checkout Report')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <form wire:submit.prevent="filter">
                        <div class="form-row">
                            @if ($result == false)
                            <div class="col-md-2"></div>
                            <div class="form-group col-md-4 sm-4">
                                <div wire:ignore>
                                    <input type="text" id="datepicker" wire:model.defer="start_date" class="form-control" placeholder="start date">
                                </div>
                                @error('start_date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 sm-4">
                                <div wire:ignore>
                                    <input type="text" id="datepicker2" wire:model.defer="end_date" class="form-control"  placeholder="end date">
                                </div>
                                @error('end_date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            @endif
                            <div class="col-md-2"></div>
                            <div class="col-auto ml-auto text-right mt-n1" wire:loading.remove wire:target="filter">
                                <button class="btn btn-primary" type="submit" {{ $result ? 'disabled' : null }}><i class="fas fa-fw fa-filter"></i> Filter</button>
                                <button class="btn btn-success" wire:click.prevent="refresh" {{ $result ? null : 'disabled' }}><i class="fas fa-fw fa-redo"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body" >
                    <div wire:loading wire:target="filter" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
                    @if ($result)
                    <h3>Total Records: {{ $total }}</h3>
                    <table id="export-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Badge No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Facilities Info</th>
                                <th>Check In Date</th>
                                <th>Check Out Date</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($checkout as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tenant->badge }}</td>
                                <td>{{ $item->tenant->name }}</td>
                                <td>{{ $item->tenant->email }}</td>
                                <td>{{ $item->tenant->mobile }}</td>
                                <td>
                                    {{ $item->building->id }} - {{ $item->building->rc_no }} {{ $item->building->ifc_no }} {{ $item->building->flat_no }}
                                    {{ $item->building->villa_no }} {{ $item->building->lot_no }} {{ $item->building->block_no }}
                                    {{ $item->building->street }} - {{ $item->building->type->name }}
                                </td>
                                <td>{{ date('M-d-Y ', strtotime($item->checkin_date)) }}</td>
                                <td>{{ date('M-d-Y ', strtotime($item->checkout_date)) }}</td>
                                <td>
                                    @if ($item->attachment)
                                    <a class="bs-tooltip" title="Click to download this attachment!" href="{{ Storage::disk('s3')->url('uploads/documents/'.$item->attachment) }}" target="_blank" rel="noopener noreferrer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        Click to download attached document
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>


@push('appointment-report-js')
<script src="/assets/plugins/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('datepicker'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
    var f2 = flatpickr(document.getElementById('datepicker2'), {
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
    document.addEventListener('livewire:load', function () {
        $('#datepicker').flatpickr();
        $('#datepicker2').flatpickr();
    });
    window.addEventListener('refreshDate', event => {
        $(event.detail.componentDate).flatpickr()
        // console.log('Updated date : ' + event.detail.componentDate)
    })
</script>
@endpush
