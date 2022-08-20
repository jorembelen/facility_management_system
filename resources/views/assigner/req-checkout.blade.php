@extends('layouts.master')

@section('title', 'Tenant Checkout Request')
@section('content') 

<div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Total Request: {{ $total }}</h3>
                </div>
                <div class="card-body">
                    
                    <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Badge No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Facilities Info</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach ($buildings as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tenant->badge }}</td>
                                    <td>{{ $item->tenant->name }}</td>
                                    <td>{{ $item->tenant->email }}</td>
                                    <td>{{ $item->tenant->mobile }}</td>
                                    <td>
                                        {{ $item->id }} - {{ $item->type->name }}
                                    </td>
                                    <td>{{ date('M-d-Y', strtotime($item->updated_at)) }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#approve{{$item->tenant->id}}"><span class="badge badge-success">Approve</span></a>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($buildings as $item)
     <!-- Checkout Tenant Modal -->
<div class="modal fade" id="approve{{ $item->tenant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-smile" style="color:blue"></i> Approve Checkout?</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body m-3">
            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('appCheckout.submit', $item->tenant->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="tenant_id" value="{{ $item->tenant->id }}">
                <input type="hidden" name="building_id" value="{{ $item->id }}">
                <h4 class="mb-0 text-center">If you are sure, please click submit to proceed!</h4><br>
        </div>
        <div class="modal-footer">
            <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
            <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach


@endsection