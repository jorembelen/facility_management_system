@extends('layouts.master')

@section('title', 'Facilities List')
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
                                <th>Villa #</th>
                                <th>Lot Villa #</th>
                                <th>RC Bldg. #</th>
                                <th>IFC Bldg. #</th>
                                <th>Flat Unit #</th>
                                <th>Block #</th>
                                <th>Street</th>
                                <th>Type</th>
                                <th>Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($buildings as $building)
                                <tr>
                                    <td>{{ $building->id }}</td>
                                    <td>{{ $building->villa_no }}</td>
                                    <td>{{ $building->lot_no }}</td>
                                    <td>{{ $building->rc_no }}</td>
                                    <td>{{ $building->ifc_no }}</td>
                                    <td>{{ $building->flat_no }}</td>
                                    <td>{{ $building->block_no }}</td>
                                    <td>{{ $building->street }}</td>
                                    <td>{{ $building->type->name }}</td>
                                    <td>
                                        @if ($building->status == 1)
                                            <span class="badge badge-success">Assigned</span>
                                            @elseif ($building->status == 2)
                                            <span class="badge badge-primary">Occupied</span>
                                                @elseif ($building->status == 3)
                                                <span class="badge badge-warning">Applied for Checkout</span>
                                                    @elseif ($building->status == 4)
                                                    {{-- <span class="badge badge-warning">Approved for Checkout</span>
                                                        @elseif ($building->status == 5) --}}
                                                        <span class="badge badge-warning">Under Restoration</span>
                                        @else
                                            <span class="badge badge-danger">Vacant</span>
                                        @endif
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
