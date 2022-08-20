@extends('layouts.master')

@section('title', 'Schedule Monitoring')
@section('content') 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
               @include('scheduler.search')
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Work Category</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Available Slot</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->category->name }}</td>
                                <td>{{ date('M-d-Y', strtotime($schedule->date)) }}</td>
                                <td>{{ $schedule->time }}</td>
                                <td>{{ $schedule->slot }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
     
            </div>
        </div>
    </div>
</div>

@endsection