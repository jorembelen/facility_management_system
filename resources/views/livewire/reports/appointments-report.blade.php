@section('title', 'Appointment Report')

<div>


    <div class="card">
        <div class="card-header">
            <form wire:submit.prevent="filter">
                <div class="form-row">
                        @if ($result == false)
                        <div class="form-group col-md-3 sm-3">
                            <div wire:ignore>
                                <select wire:model="category" id="category" class="form-control select2">
                                    <option value="{{ $category }}">Choose Work Category</option>
                                    @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3 sm-3">
                            <div wire:ignore>
                                <input type="text" id="datepicker" wire:model.defer="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="start date">
                            </div>
                            @error('start_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3 sm-3">
                            <div wire:ignore>
                                <input type="text" id="datepicker2" wire:model.defer="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="end date">
                            </div>
                            @error('end_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3 sm-3">
                            <select wire:model.defer="status"  class="form-control">
                                <option>Choose Status</option>
                                <option value="3">Open</option>
                                <option value="1">Closed</option>
                                <option value="2">Cancelled</option>
                            </select>
                        </div>
                        @endif
                        <div class="col-auto ml-auto text-right mt-n1" wire:loading.remove wire:target="filter">
                            <button class="btn btn-primary" type="submit" {{ $result ? 'disabled' : null }}><i class="fas fa-fw fa-filter"></i> Filter</button>
                            <button class="btn btn-success" wire:click.prevent="refresh" {{ $result ? null : 'disabled' }}><i class="fas fa-fw fa-redo"></i> Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        <div class="card-body">
            <div wire:loading wire:target="filter" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
            @if ($result)
            <h3>Total Records: {{ $appointments->count() }}</h3>
            <div class="responsive-table" wire:ignore>
                <table id="export-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Badge No.</th>
                            <th>Tenants Name</th>
                            <th>Facilities Info</th>
                            <th>Work Category</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Job Description</th>
                            <th>Status</th>
                            <th>Satisfaction Score</th>
                            @if (in_array(auth()->user()->role, ['scheduler', 'supervisor']))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($appointments as $appointment)
                        <tr>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Tenant Info" href="{{ route('appointments.show', $appointment->id) }}">{{ $appointment->id }}</a>
                            </td>
                            <td>
                                @if ($appointment->user_id)
                                {{ $appointment->client->badge }}
                                @endif
                            </td>
                            <td>
                                @if ($appointment->user_id)
                                {{ $appointment->client->name }}
                                @endif
                            </td>
                            <td>
                                {{ $appointment->building->buildingInfo() }}
                            </td>
                            <td>{{ $appointment->category->name }}</td>
                            <td>{{ date('M-d-Y', strtotime($appointment->date)) }}</td>
                            <td>{{ $appointment->schedule_time }}</td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Appointment Details" href="{{ route('appointment.info', $appointment->id) }}">{{ Str::limit($appointment->job_description, 200) }}</a>
                            </td>
                            <td>
                                @if ($appointment->status == 0)
                                <span class="badge badge-primary">Open</span>
                                @elseif ($appointment->status == 1)
                                <span class="badge badge-danger">Closed</span>
                                @else
                                <span class="badge badge-warning">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                @if ($appointment->status == 1)
                                @if ($appointment->survey_status == 0)
                                @if (auth()->user()->role == 'tenant')
                                    <a  href="{{ route('survey', $appointment->id) }}"><i class="fas fa-fw fa-star" style="color:green"></i> Give us your rating</a>
                                    @else
                                    <a  href="#"><i class="fas fa-fw fa-star" style="color:green"></i> No Rating</a>
                                    @endif
                                    @else
                                    <a href="{{ route('survey.show', $appointment) }}"> {{ $appointment->survey_score }} - {{ $appointment->surveyScore() }}</a>
                                    @endif
                            @endif
                            </td>
                            @if (in_array(auth()->user()->role, ['scheduler', 'supervisor']))
                            <td>
                                <a href="{{ route('print.jo', $appointment->id) }}" target="_blank" rel="noopener noreferrer">
                                    <span class="badge badge-info"><i class="fas fa-fw fa-print"></i> Print</span>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
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
    function myFunction(){
        document.getElementById("category").value = "";
        document.getElementById("datepicker").value = "";
        document.getElementById("datepicker2").value = "";
    }
</script>
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#category').select2();
        });
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('category', $('#category').val());
    })
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
