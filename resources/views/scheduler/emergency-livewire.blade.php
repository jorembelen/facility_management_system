@extends('layouts.master')

@section('title', 'Preventive Maintenance')
@section('content')

{{-- <div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Create Preventive Maintenance Appointment</h2>
            </div>
            <div class="card-body">
                <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('pm-schedule.store') }}" id="scheduler-app-create" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="scheduler_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="work_category_id" value="8">

                     @livewire('prev-maintenance')

                        <div class="form-group">
                            <label class="form-label">Appointment Date</label>
                            <input type="date" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" name="date" placeholder="select date">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Appointment Time</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Start</label>
                                    <input type="time" class="form-control" name="time_start" placeholder="schedule time">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">End</label>
                                    <input type="time" class="form-control" name="time_end" placeholder="schedule time">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Job Description</label>
                            <textarea name="job_description" class="form-control" cols="30" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-group custom-file-container" data-upload-id="myImage">
                                <label>Attached Image(s)<a href="#" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file" >
                                    <input type="file" class=" form-control" name="images[]"  multiple>
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                        </div>
                        </div>
                        <div class="form-group">
                        <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                        <input type="file" class="form-control-file"  name="documents">
                        </div>
                        </div>
                    <div class="modal-footer">
                        <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light disabled-button-prevent">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-3"></div>
</div> --}}

    @livewire('scheduler.preventive-maintenance')
@endsection
