@extends('layouts.master')

@section('title', 'Checkout History')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Total Records: {{ $checkout->count() }}</h3>
            </div>
            <div class="card-body">

                <table id="datatables-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Badge No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Facilities Info</th>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Download Attachment</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($checkout as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tenant->badge }}</td>
                            <td>{{ $item->tenant->name }}</td>
                            <td>{{ $item->tenant->email }}</td>
                            <td>{{ $item->tenant->mobile }}</td>
                            <td>
                                {{ $item->building->id }} - {{ $item->building->rc_no }} {{ $item->building->ifc_no }} {{ $item->building->flat_no }}
                                {{ $item->building->villa_no }} {{ $item->building->lot_no }} {{ $item->building->block_no }}
                                {{ $item->building->street }} - {{ $item->building->type->name }}
                            </td>
                            <td>{{ date('M-d-Y', strtotime($item->checkin_date)) }}</td>
                            <td>{{ date('M-d-Y', strtotime($item->checkout_date)) }}</td>
                            <td>
                                @if ($item->attachment)
                                <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to download this attachment!" href="{{ Storage::disk('s3')->url('uploads/documents/'.$item->attachment) }}" target="_blank" rel="noopener noreferrer">
                                    <button class="btn btn-danger mb-2 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        Download attachment</button>
                                    </a>
                                @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <p>No Data</p>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection
