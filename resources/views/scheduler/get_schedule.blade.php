@extends('layouts.master')

@section('title', 'Create Appointment')
@section('content')

<div class="row">
    <div class="col-xl-3"></div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <a href="{{ \URL::previous() }}" type="button"class="btn btn-dark mb-2 float-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                    Back
                </a>
                <h2 class="text-center">Create Appointment</h2>
            </div>

            <div class="card-body">
                <div class="alert alert-primary alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        <strong>Hello there!</strong> Please select work category and date to proceed!
                    </div>
                </div>

                <form class="form-horizontal" method="get" action="{{ route('scheduler.search') }}" id="req-scheduler">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="form-group">
                        <label class="form-label">Tenant Name</label>
                        <select name="tenant_id" class="form-control select-tenant" id="appointment_frm" >
                            <option value="">Select ...</option>
                            @foreach ($tenants as $tenant)
                            <option value="{{ $tenant->id }}" @if (old('tenant_id') == $tenant->id) selected="selected" @endif>{{ $tenant->badge }} - {{ $tenant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Work Category</label>
                        <select name="category" class="form-control select2">
                            <option value="">Select Work Category</option>
                            @foreach ($categories as $category)
                            @if ($category->id != 8)
                            <option value="{{ $category->id }}" @if (old('category') == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                            @endif
                            @endforeach
                       </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date</label>
                       <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" name="date" placeholder="select date">
                    </div>
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light disabled-button-prevent">Check Schedule</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-3"></div>
</div>

@include('scripts.get_appointment')
@endsection
