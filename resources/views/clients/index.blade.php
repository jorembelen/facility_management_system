@extends('layouts.master')

@section('title', 'Appointment Manager طالب الموعد')
@section('content')


<div class="row">
    <div class="col-12">

        <div class="card">

            <div class="card-header">
                    <a class="btn btn-primary float-right mt-n1" role="button" href="{{ route('create.appointments') }}"><i class="fas fa-plus-circle"></i> Create Appointment إنشاء موعد</a>

                </div>
                <div class="card-body">
                    <table id="datatables-closed" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>ID بطاقة تعريف</th>
                                <th>Work Category فئه العمل</th>
                                <th>Scheduled Date التاريخ المقرر للموعد</th>
                                <th>Scheduled Time الوقت المقرر للموعد</th>
                                <th>Complain الشكوى</th>
                                <th>Status الحاله</th>
                                <th>Satisfaction Score نقاط الرضا</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->id }}</td>
                                <td>{{ $appointment->category->name }}</td>
                                <td>{{ date('M-d-Y', strtotime($appointment->date)) }}</td>
                                <td>{{ $appointment->schedule_time }}</td>
                                <td>
                                    <a data-toggle="tooltip" data-placement="top" title="" data-original-title="View Appointment Details" href="{{ route('appointment.info', $appointment->id) }}">{{ Str::limit($appointment->job_description, 200) }}</a>
                                </td>
                                <td>
                                    @if ($appointment->status === 0)
                                    <span class="badge badge-primary">Open فتح</span>
                                    @elseif ($appointment->status === 1)
                                    <span class="badge badge-success">Closed مغلق</span>
                                    @elseif ($appointment->status === 2)
                                    <span class="badge badge-danger">Cancelled ألغيت</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($appointment->status == 1)
                                    @if ($appointment->survey_status == 0)
                                    <a  href="{{ route('survey', $appointment->id) }}"><i class="fas fa-fw fa-star" style="color:green"></i> Give us your rating اعطنا تقييمك</a>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-closed").DataTable({
                responsive: true
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-cancelled").DataTable({
                responsive: true
            });
        });
    </script>

    @endsection
