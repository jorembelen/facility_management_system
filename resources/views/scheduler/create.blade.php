@extends('layouts.master')

@section('title', 'Create Appointment')
@section('content')

<div class="row">
    <div class="col-xl-3"></div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Create Appointment</h2>
            </div>
            <div class="card-body">
                <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('schedule.store') }}" enctype="multipart/form-data" id="scheduler-app-create">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $tenant->badge }}">
                    <input type="hidden" name="work_category_id" value="{{ $category->id }}">
                    <input type="hidden" name="building_id" value="{{ $category->id }}">
                    <input type="hidden" name="date" value="{{ $date }}">
                    <div class="form-group">
                        <label class="form-label">Tenant Information</label>
                        <h4>{{ $tenant->name }}  </h4>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <h4>{{ $tenant->building->buildingInfo() }}</h4>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Work Category</label>
                        <h4>{{ $category->name }}</h4>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Date</label>
                       <h4>{{ date('M-d-Y', strtotime($date)) }}</h4>
                    </div><hr>
                    <div class="form-group">
                        @if ($schedules->count() > 0)
                            <label class="form-label">Select appointment time</label>
                        @foreach ($schedules as $item)
                        <label class="custom-control custom-radio">
                            @if ($item->slot <= 0)
                            <fieldset disabled>
                                <input name="schedule_time" type="radio" value="{{ $item->time }}" class="custom-control-input">
                                <span class="custom-control-label disabled">{{ date('M-d-Y', strtotime($item->date)) }} ( {{ $item->time }} ) - <span class="badge badge-danger">Appointment is Full</span></span>
                            </fieldset>
                            @else
                                <input name="schedule_time" type="radio" value="{{ $item->time }}" class="custom-control-input">
                                <span class="custom-control-label">{{ date('M-d-Y', strtotime($item->date)) }} ( {{ $item->time }} )</span>
                            @endif
                          </label>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label class="form-label">Job Description</label>
                        <select name="job_description" class="form-control select2" id="appointment_frm" >
                            <option value="">Select ...</option>
                            @foreach ($options as $option)
                            <option value="{{ $option->name }}" @if (old('job_description') == $option->name) selected="selected" @endif>{{ $option->name }}</option>
                            @endforeach
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group app-div" id="appOthers" style="display:none">
                        <label class="form-label">Others</label>
                        <textarea name="other_description" class="form-control" value="{{ old('other_description') }}" cols="30" rows="3" placeholder="Please provide other description"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <select name="job_location" class="form-control select-location">
                            <option value="">Select ...</option>
                            @foreach ($locations as $item)
                            <option value="{{ $item->location }}" @if (old('job_location') == $item->location) selected="selected" @endif>{{ $item->location }}</option>
                            @endforeach
                        </select>
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
                    @else
                    <label class="form-label">No Available Schedule</label>
                @endif
                <div class="form-group">
                    <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                    <input type="file" class="form-control-file"  name="documents">
                </div>

                    </div>
                    <div class="modal-footer">
                        <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                        <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                        <a href="open-appointments" type="button" class="btn btn-danger waves-effect disabled-button-prevent">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-3"></div>
</div>

@include('scripts.client_appointment')
@endsection




