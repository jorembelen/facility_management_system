@extends('layouts.master')

@section('title', 'Occupied Facilities')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Total Records: {{ $buildings->count() }}</h3>
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Badge</th>
                            <th>Name</th>
                            <th>Facilities Information</th>
                            <th>Assigned Date</th>
                            <th>Checkin Date</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($buildings as $facilities)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $facilities->tenant->badge  }}</td>
                            <td>{{ $facilities->tenant->name  }}</td>
                            <td>{{ $facilities->building->buildingInfo() }}</td>
                            <td>{{ date('Y-m-d', strtotime($facilities->assigned_date)) }}</td>
                            <td>{{ date('Y-m-d', strtotime($facilities->checkin_date)) }}</td>
                            <td>
                                @if ($facilities->checkin_attachment)
                                <a class="bs-tooltip" title="Click to download this attachment!" href="{{ Storage::disk('s3')->url('uploads/documents/'.$facilities->checkin_attachment) }}" target="_blank" rel="noopener noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                         Click to download attached document
                                     </a>
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
