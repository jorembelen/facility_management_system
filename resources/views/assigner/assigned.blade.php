@extends('layouts.master')

@section('title', 'Assigned Facilities')
@section('content') 

<div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Total: {{ $total }}</h3>
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
                                <th>Assigned Date</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach ($occupancies as $occupant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $occupant->tenant->badge }}</td>
                                    <td>
                                        <a href="#">{{ $occupant->tenant->name }}</a>
                                    </td>
                                    <td>{{ $occupant->rc_no }} {{ $occupant->ifc_no }} {{ $occupant->flat_no }}
                                        {{ $occupant->villa_no }} {{ $occupant->lot_no }} {{ $occupant->block_no }} 
                                        {{ $occupant->street }}</td>
                                    <td>{{ $occupant->type->name }}</td>
                                    <td>{{ $occupant->updated_at->format('M-d-Y h:i a')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection