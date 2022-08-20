@extends('layouts.master')

@section('title', 'Vacant Facilities')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                     <h3>Total: {{ $total }}</h3>
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
                                        <span class="badge badge-primary">Occupied</span>
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

    @include('occupants.create')
@endsection
