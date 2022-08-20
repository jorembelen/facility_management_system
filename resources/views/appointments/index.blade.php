@extends('layouts.master')

@section('title', 'Job Order')
@section('content')

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}" class="btn btn-secondary float-right d-print-none "><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                <h2 class="text-center">Appointments for {{ $jobOrder->id }}</h2><hr><br>
                <dl class="row">
                    <dt class="col-4 col-xxl-3">Tenant Name:</dt>
                    @if ($jobOrder->user_id != '')
                    <h4>{{ $jobOrder->client->badge }} - {{ $jobOrder->client->name }}</h4>
                    @endif
                </dl>
                <dl class="row">
                    <dt class="col-4 col-xxl-3">Facility Info:</dt>
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
                <a class="btn btn-primary" role="button" href="#" data-toggle="modal" data-target="#create"><i class="fas fa-plus-circle"></i> Create</a>
                @else
                <button class="btn btn-outline-danger">Job Order Closed</button>
                @endif
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>Appointment</th>
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
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $schedule->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    <a href="#" data-toggle="modal" data-target="#delete{{ $schedule->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
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
        @if ($jobOrder->work_category_id == 10)
        @if ($schedules->count() > 0)
        @if ($jobOrder->status != 1)
        <a class="btn btn-secondary float-right" role="button" href="#" data-toggle="modal" data-target="#restoration{{ $jobOrder->id }}"><i class="fas fa-times-circle"></i> Close Restoration</a>
        @endif
        @endif
        @else
        @if ($schedules->count() > 0)
        @if ($jobOrder->status != 1)
        <a class="btn btn-secondary float-right" role="button" href="#" data-toggle="modal" data-target="#closed{{ $jobOrder->id }}"><i class="fas fa-times-circle"></i> Close Appointment</a>
        @endif
        @endif
        @endif
    </div>
    <div class="col-md-1"></div>
</div>

<!-- sample modal content -->
<div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Assign Technician</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal form-disabled-button"  method="POST" action="{{ route('job-orders.store') }}" id="job-create">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="client_appointment_id" value="{{ $jobOrder->id }}">
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Technician Name</label>
                        <div class="col-md-11 ml-3">
                            <select name="technicians[]" class="form-control select2" multiple>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->badge }} - {{ $employee->name }}">{{ $employee->badge }} - {{ $employee->name }} ({{ $employee->designation }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($schedules->count() > 0)
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Date</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" name="new_date" placeholder="select date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Time</label>
                        <div class="col-md-11 ml-3">
                            <input type="text"  class="form-control" name="new_time">
                        </div>
                    </div>
                    @else
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Date</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" value="{{ $jobOrder->date->format('M-d-Y') }}" name="date" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Time</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" value="{{ $jobOrder->schedule_time }}" class="form-control" name="time" readonly>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Notes</label>
                        <div class="col-md-11 ml-3">
                            <textarea name="notes" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect disabled-button-prevent" data-dismiss="modal">Close</button>

                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Close Appointment -->
<div class="modal fade" id="closed{{ $jobOrder->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown" style="color:red"></i> Close Job Order {{ $jobOrder->id }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('appointment.closed', $jobOrder->id) }}" id="closed-jo" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $jobOrder->id }}">
                    <h4 class="mb-0 text-center">Are you sure? If Yes please submit to proceed!</h4>
                    <hr>
                    <div class="form-group">
                        <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                        <input type="file" class="form-control-file"  name="closing_attachment">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect disabled-button-prevent" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Close Restoration -->
<div class="modal fade" id="restoration{{ $jobOrder->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-happy" style="color:red"></i> Close Job Order {{ $jobOrder->id }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('restoration.closed', $jobOrder->id) }}" id="closed-restoration" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $jobOrder->id }}">
                    <input type="hidden" name="building_id" value="{{ $jobOrder->building_id }}">
                    <h4 class="mb-0 text-center">Are you sure? If Yes please submit to proceed!</h4>
                    <hr>
                    <div class="form-group">
                        <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                        <input type="file" class="form-control-file"  name="closing_attachment">
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect disabled-button-prevent" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>



@include('scripts.get_appointment')
@endsection
