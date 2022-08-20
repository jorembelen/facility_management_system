@section('title', 'Create Job Order')
<div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route('appointments.open') }}" class="btn btn-secondary float-right d-print-none "><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                    <h2 class="text-center">Appointments for {{ $jobOrder->id }}</h2><hr><br>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Tenant Name:</dt>
                        @if ($jobOrder->user_id != '')
                        <h4>{{ $jobOrder->client->badge }} - {{ $jobOrder->client->name }}</h4>
                        @endif
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Facility Info: </dt>
                        <h4>  {{ $jobOrder->building->block_no ? $jobOrder->building->buildingInfo() : $jobOrder->building->street .' (' .$jobOrder->building->type->name .')' }}  </h4>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Work Category:</dt>
                        <h4>{{ $jobOrder->category->name }}</h4>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Scheduled Date & Time:</dt>
                        <h4>{{ date('M-d-Y', strtotime($jobOrder->date)) }} ({{ $jobOrder->schedule_time }})</h4>
                    </dl>
                    @if ($jobOrder->status == 0)
                    <a class="btn btn-primary" href="#" wire:click.prevent="create('{{ $appId }}')"><i class="fas fa-plus-circle"></i> Create</a>
                    @else
                    <button class="btn btn-outline-danger">Job Order Closed</button>
                    @endif
                </div>
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>Appointment ID</th>
                                <th>Technician</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->id }}</td>
                                <td>{{ $schedule->technicians }}</td>
                                <td>{{ date('M-d-Y', strtotime($schedule->date)) }}</td>
                                <td>{{ $schedule->time }}</td>
                                <td>{{ $schedule->notes }}</td>
                                <td class="table-action">
                                    @if ($jobOrder->status != 1)
                                    <a href="#" wire:click.prevent="edit({{ $schedule->id }})"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    <a href="#" wire:click.prevent="delete({{ $schedule->id }})"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                    @else
                                    Closed
                                    @endif
                                </td>
                            </tr>
                            @include('appointments.edit-modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($jobOrder->work_category_id == 13)
            @if ($schedules->count() > 0)
            @if ($jobOrder->status != 1)
            <a class="btn btn-secondary float-right" wire:click.prevent="restorationShow('{{ $jobOrder->id }}')"><i class="fas fa-times-circle"></i> Close Restoration</a>
            @endif
            @endif
            @else
            @if ($schedules->count() > 0)
            @if ($jobOrder->status != 1)
            <a class="btn btn-secondary float-right" href="#" wire:click.prevent="closeJobOrder('{{ $jobOrder->id }}')"><i class="fas fa-times-circle"></i> Close Appointment</a>
            @endif
            @endif
            @endif
        </div>
    </div>

    @include('livewire.scheduler.jo-modal')
    @include('scripts.job-orders')
</div>

@push('jo-js')
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#technicians').select2();
            $('#eTechnicians').select2();
        });
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('technicians', $('#technicians').val());
        @this.set('eTechnicians', $('#eTechnicians').val());
    })
</script>


@endpush

