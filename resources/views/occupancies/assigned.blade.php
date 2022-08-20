@extends('layouts.master')

@section('title', 'Assigned Facilities')

@section('content')

    @livewire('supervisor.newly-assigned')

    {{-- @foreach ($occupancies as $appointment)
    <!-- Cancel Appointment -->
<div class="modal fade" id="checkIn{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-grin" style="color:#3F80EA"></i> Check In {{ $appointment->tenant->name }}?</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body m-3">
            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('checkin.store') }}" enctype="multipart/form-data" id="checkin">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="checkedinBy" value="{{ auth()->id() }}">
                <input type="hidden" name="id" value="{{ $appointment->id }}">
                <input type="hidden" name="tenant_id" value="{{ $appointment->tenant->id }}">

                 <div class="form-group mt-2">
                <h4 class="mb-2 text-center">If you are sure, please click Yes to proceed.</h4>
            </div>
            <div class="form-group mt-2">
                <label class="form-label">Assign Date</label>
                <input type="date" class="form-control" name="checkin_date" placeholder="select date">
            </div>
                 <div class="form-group mt-2">
                <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                <input type="file" class="form-control-file"  name="attachment">
            </div>
        </div>
        <div class="modal-footer">
            <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
            <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
          <button type="button" class="btn btn-danger disabled-button-prevent" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach --}}

@endsection
