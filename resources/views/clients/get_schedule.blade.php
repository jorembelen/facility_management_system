@extends('layouts.master')

@section('title', 'Create Appointment')
@section('content')

    @livewire('tenants.create-appointments')

@include('scripts.get_appointment')
@endsection
