@extends('layouts.master')

@section('title', 'Preventive Maintenance')
@section('content') 

<div class="row">
    <div class="col-xl-3"></div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Create Preventive Maintenance Appointment</h2>
            </div>
            <div class="card-body">
                <form class="form-horizontal form-disabled-button" method="get" action="{{ route('emergency.location') }}">
                    @csrf
                    <input type="hidden" name="building" value="">
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" value="{{ $type->name }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Building</label>
                        <select name="facility_id" class="form-control select2">
                            <option value=""></option>
                            @foreach ($facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->street }}</option>
                            @endforeach
                        </select>
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
</div>

@include('scripts.emergency')
@endsection