@extends('layouts.master')

@section('title', 'Checkin Report')
@section('content')

{{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @include('search.checkin')

                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div> --}}

    @livewire('reports.checkin-report')

@endsection
