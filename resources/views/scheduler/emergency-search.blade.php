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
                <form class="form-horizontal form-disabled-button" method="get" action="{{ route('emergency.building') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Select Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select ...</option>
                            <option value="9">Fire Fighting System</option>
                            <option value="10">Elevator</option>
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