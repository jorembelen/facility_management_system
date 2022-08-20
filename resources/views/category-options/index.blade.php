@extends('layouts.master')

@section('title', 'Work Category Options')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{-- @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                <a class="btn btn-primary float-right" role="button" href="#" data-toggle="modal" data-target="#create"><i class="fas fa-plus-circle"></i> Add</a>
               @endif --}}
            </div>
            <div class="card-body">
                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Work Category Name</th>
                            <th>Issue / Concern</th>
                            <th>Arabic</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($options as $option)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $option->category->name }}</td>
                                <td>{{ $option->name }}</td>
                                <td>{{ $option->arabic }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('work-categories.create')
@endsection
