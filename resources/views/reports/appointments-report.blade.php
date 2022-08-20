@extends('layouts.master')

@section('title', 'Appointments Report')
@section('content')

{{-- <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @include('search.appointment')
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-12">

        @livewire('reports.appointments-report')

    </div>
</div>

@endsection
