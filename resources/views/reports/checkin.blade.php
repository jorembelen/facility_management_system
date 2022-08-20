@extends('layouts.master')

@section('title', 'Checkin Report')
@section('content') 

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('search.checkin')
                    <h3>Total Records: {{ $buildings->count() }}</h3>
                </div>
                <div class="card-body">
                    <table id="datatables-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Badge</th>
                                <th>Name</th>
                                <th>Villa #</th>
                                <th>Lot Villa #</th>
                                <th>RC Bldg. #</th>
                                <th>IFC Bldg. #</th>
                                <th>Flat Unit #</th>
                                <th>Block #</th>
                                <th>Street</th>
                                <th>Type</th>
                                <th>Checkin Date</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @forelse ($buildings as $facilities)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $facilities->tenant->badge }}</td>
                                    <td>{{ $facilities->tenant->name }}</td>
                                    <td>{{ $facilities->building->villa_no }}</td>
                                    <td>{{ $facilities->building->lot_no }}</td>
                                    <td>{{ $facilities->building->rc_no }}</td>
                                    <td>{{ $facilities->building->ifc_no }}</td>
                                    <td>{{ $facilities->building->flat_no }}</td>
                                    <td>{{ $facilities->building->block_no }}</td>
                                    <td>{{ $facilities->building->street }}</td>
                                    <td>{{ $facilities->building->type->name }}</td>
                                    <td>{{ date('M-d-Y', strtotime($facilities->checkin_date)) }}</td>
                            </tr>
                            @empty
                            <tr>
                                @if (request('start_date'))
                                <h3 class="text-center">No Available Data from:  {{ date('M-d-Y', strtotime(request('start_date'))) }} to {{ date('M-d-Y', strtotime(request('end_date'))) }}</h3>
                                @else  
                                @endif
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection