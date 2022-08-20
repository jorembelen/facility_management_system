@extends('layouts.master')

@section('title', 'Approved for Checkout')
@section('content')

<div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <a class="btn btn-primary float-right" role="button" href="#" data-toggle="modal" data-target="#create"><i class="fas fa-plus-circle"></i> Add</a> --}}
                </div>
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Badge No.</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Building Type</th>
                                <th>CheckIn Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($facilities as $facility)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $facility->tenant->badge }}</td>
                                    <td>{{ $facility->tenant->name }}</td>
                                    <td>{{ $facility->rc_no }} {{ $facility->ifc_no }} {{ $facility->flat_no }}
                                        {{ $facility->villa_no }} {{ $facility->lot_no }} {{ $facility->block_no }}
                                        {{ $facility->street }}</td>
                                    <td>{{ $facility->type->name }}</td>
                                    <td>{{ $facility->tenant->occupancy->issued_date->format('M-d-Y')}}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#checkout{{$facility->tenant->id}}"><span class="badge badge-success">Check Out</span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($facilities as $facility)

    <!-- Checkout Tenant Modal -->
<div class="modal fade" id="checkout{{ $facility->tenant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown" style="color:red"></i> Check Out {{ $facility->tenant->name }}?</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body m-3">
            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('checkout.submit') }}" id="checkout" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="tenant_id" value="{{ $facility->tenant->id }}">
                <input type="hidden" name="building_id" value="{{ $facility->id }}">
                <input type="hidden" name="checkin_date" value="{{ $facility->tenant->occupancy->issued_date }}">
                <h4 class="mb-0 text-center">If you are sure, please select date & click submit to proceed!</h4><br>
            <div class="form-group mt-2">
                <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" name="checkout_date" placeholder="checkout date">
            </div>
                <div class="form-group mt-2">
                <textarea name="reason" class="form-control" cols="30" rows="3" placeholder="Reason"></textarea>
            </div>
            <div class="form-group">
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


  @endforeach

  @include('scripts.get_appointment')
@endsection
