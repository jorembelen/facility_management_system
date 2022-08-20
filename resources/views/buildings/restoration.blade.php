@extends('layouts.master')

@section('title', 'Facilities Under Restoration')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Total: {{ $total }}</h4>
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Facility Information</th>
                            <th>Facility Availability</th>
                            <th>Notes</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($buildings as $building)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $building->id }}</td>
                            <td>
                                {{ $building->block_no ? $building->buildingInfo() : $building->street .' (' .$building->type->name .')' }}
                            </td>
                            <td>{{ $building->availabiltyDate() }}</td>
                            <td>{{ $building->restorationNotes() }}</td>
                            <td>
                                <span class="badge badge-warning">Under Restoration</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($buildings as $building)
<!-- Release Modal -->
<div class="modal fade" id="release{{ $building->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-smile" style="color:blue"></i> Release {{ $building->id }} - {{ $building->type->name }} ?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal" method="POST" action="{{ route('release.submit') }}" >
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="building_id" value="{{ $building->id }}">
                    <h4 class="mb-0 text-center">If you are sure, please click submit to proceed!</h4>
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

@include('scripts.get_appointment')
@endsection
