@extends('layouts.master')

@section('title', 'Schedule')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{-- @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                <a class="btn btn-primary float-right" role="button" href="#" data-toggle="modal" data-target="#create"><i class="fas fa-plus-circle"></i> Add</a>
               @endif --}}
               @include('schedules.search')
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Work Category</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Slot</th>
                            <th>Action</th>
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
                                <td class="table-action">
                                    <a href="#" data-toggle="modal" data-target="#edit{{ $schedule->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    {{-- <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a> --}}
                                </td>
                        </tr>

                                                <!-- sample modal content -->
                        <div id="edit{{ $schedule->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="myModalLabel">Update this slot?</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                            <form class="form-horizontal form-disabled-button"  method="POST" action="{{ route('schedules.update', $schedule->id) }}" id="job-create">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Work Category</label>
                                                    <div class="col-md-11 ml-3">
                                                        <input type="text" value="{{ $schedule->category->name }}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Date</label>
                                                    <div class="col-md-11 ml-3">
                                                        <input type="text" value="{{ date('M-d-Y', strtotime($schedule->date)) }}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Time</label>
                                                    <div class="col-md-11 ml-3">
                                                        <input type="text" value="{{ $schedule->time }}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Slot</label>
                                                    <div class="col-md-11 ml-3">
                                                        <input type="number" min="0" value="{{ $schedule->slot }}" class="form-control" name="slot">
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

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection


