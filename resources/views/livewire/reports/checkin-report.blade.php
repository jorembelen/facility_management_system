@section('title', 'Checkin Report')

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
                                    <input type="text" id="datepicker" wire:model="start_date" class="form-control"  placeholder="start date">
                                </div>
                                @error('start_date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 sm-4">
                                <div wire:ignore>
                                    <input type="text" id="datepicker2" wire:model="end_date" class="form-control"  placeholder="end date">
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
                                <th>Badge</th>
                                <th>Name</th>
                                <th>Facility Information</th>
                                <th>Assigned Date</th>
                                <th>Checkin Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($buildings as $facilities)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $facilities->tenant->badge }}</td>
                                <td>{{ $facilities->tenant->name }}</td>
                                <td>{{ $facilities->building->buildingInfo() }}</td>
                                <td>{{ date('M-d-Y', strtotime($facilities->assigned_date)) }}</td>
                                <td>{{ date('M-d-Y', strtotime($facilities->checkin_date)) }}</td>
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
    })
</script>
@endpush
