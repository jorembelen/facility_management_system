@extends('layouts.master')

@section('title', 'Closed Appointments List')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
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
                                <th>Satisfaction Score</th>
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
                                        <span class="badge badge-danger">Cancelled</span>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection
