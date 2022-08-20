@extends('layouts.master')

@section('title', 'Occupied Facilities')
@section('content') 

<div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3>Total Occupied Facilities: {{ $total }}</h3>   
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
                                <th>Check In Date</th>
                            </tr>
                        </thead>
    
                        <tbody>
                            @foreach ($occupants as $occupant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $occupant->badge }}</td>
                                    <td>{{ $occupant->name }}</td>
                                    <td>{{ $occupant->email }}</td>
                                    <td>{{ $occupant->mobile }}</td>
                                    <td>
                                        {{ $occupant->building->id }} - {{ $occupant->building->type->name }}
                                    </td>
                                    <td>{{ date('M-d-Y', strtotime($occupant->occupancy->checkin_date)) }}</td>
                         
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

 
@endsection