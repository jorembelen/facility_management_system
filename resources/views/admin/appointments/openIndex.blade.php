@extends('layouts.master')

@section('title', 'Open Appointments List')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->role == 'scheduler')
                        <a class="btn btn-primary float-right" role="button" href="{{ route('scheduler.create') }}"><i class="fas fa-plus-circle"></i> Create Appointment</a>
                    @endif

                     </div>
                <div class="card-body">
                    <table id="datatables-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>Work Order No.</th>
                                <th>Badge No.</th>
                                <th>Clients Name</th>
                                <th>Facilities Info</th>
                                <th>Work Category</th>
                                <th>Scheduled Date</th>
                                <th>Scheduled Time</th>
                                <th>Job Description</th>
                                <th>Status</th>
                                <th>Submitted On</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>
                                        {{ $appointment->client->badge ?? null }}
                                    </td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Tenant Info" href="{{ route('appointments.show', $appointment->id) }}">{{ $appointment->client->name ?? null }}</a>
                                    </td>
                                    <td>
                                        {{ $appointment->building->block_no ? $appointment->building->buildingInfo() : $appointment->building->street .' (' .$appointment->building->type->name .')' }}
                                    </td>
                                    <td>{{ $appointment->category->name }}</td>
                                    <td>{{ $appointment->date->format('Y-m-d') }}</td>
                                    <td>{{ $appointment->schedule_time }}</td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Appointment Details" href="{{ route('appointment.info', $appointment->id) }}">{{ Str::limit($appointment->job_description, 200) }}</a>
                                        {{-- <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Appointment Details" href="{{ route('client-appointments.show', $appointment->id) }}">{{ Str::limit($appointment->job_description, 200) }}</a> --}}
                                    </td>
                                    <td>
                                        @if (in_array(auth()->user()->role, ['scheduler', 'supervisor']))
                                            @if ($appointment->status == 0)
                                                <a href="{{ route('job-orders.info', $appointment->id) }}">  <span class="badge badge-primary">Open</span></a>
                                                @elseif ($appointment->status == 1)
                                                <span class="badge badge-success">Closed</span>
                                                @else
                                                <span class="badge badge-danger">Cancelled</span>
                                                @endif
                                                <a href="{{ route('print.jo', $appointment->id) }}">
                                                    <span class="badge badge-info"><i class="fas fa-fw fa-print"></i> Print</span>
                                                </a>
                                        @else
                                            <span class="badge badge-primary">Open</span>
                                        @endif
                                    </td>
                                    <td>{{ $appointment->created_at->format('Y-m-d, h:i a') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection
