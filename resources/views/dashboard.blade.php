@extends('layouts.master')

@section('title', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card illustration flex-fill">
            <div class="card-body p-0 d-flex flex-fill">
                <div class="row no-gutters w-100">
                    <div class="col-sm-8">
                        <div class="illustration-text p-3 m-1">
                            <h3 class="illustration-text ml-3 text-center mt-4"> {{ auth()->user()->userGreetings() }} <i class="far fa-fw fa-smile"></i></h3>

                        </div>
                    </div>

                    <div class="col-4 align-self-end text-right">
                        <img src="assets/img/guest.svg" alt="Customer Support" class="img-fluid illustration-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(in_array(auth()->user()->role, ['super_admin', 'admin', 'supervisor', 'scheduler', 'representative']))

<div class="row">
    <div class="col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Open Work Orders</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right align-middle"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{ $open }}</span>
                <div class="mb-0">
                    <a href="{{ route('appointments.open') }}"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Closed Work Orders</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle align-middle mr-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{ $closed }}</span>
                <div class="mb-0">
                    <a href="{{ route('appointments.closed') }}"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Cancelled Work Orders</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle mr-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{ $cancelled }}</span>
                <div class="mb-0">
                    <a href="{{ route('appointments.cancelled') }}"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xxl d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Work Orders</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{ $app_created }}</span>
                <div class="mb-0">
                    <a href="/appointments"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6 col-xl-6 d-none d-xl-flex">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Facilities Status</h5>
            </div>
            <div class="card-body d-flex">

                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Building Type</th>
                            <th class="text-right">Vacant</th>
                            <th class="text-right">Occupied</th>
                            <th class="text-right">Under Restoration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <a href="{{ route('index-type', 2) }}">2 BR</a></td>
                            @if ($vacantTwoBedroom[0] == 0)
                            <td class="text-right">{{ $vacantTwoBedroom[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 2) }}">{{ $vacantTwoBedroom[0] }}</a></td>
                            @endif
                            @if ($occupiedTwoBedroom[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedTwoBedroom[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 2) }}">{{ $occupiedTwoBedroom[0] }}</a></td>
                            @endif
                            @if ($restorationTwoBedroom[0] == 0)
                            <td class="text-right text-danger">{{ $restorationTwoBedroom[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 2) }}">{{ $restorationTwoBedroom[0] }}</a></td>
                            @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 3) }}">3 BR</a></td>
                            @if ($vacantThreeBedroom[0] == 0)
                            <td class="text-right">{{ $vacantThreeBedroom[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 3) }}">{{ $vacantThreeBedroom[0] }}</a></td>
                            @endif
                            @if ($occupiedThreeBedroom[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedThreeBedroom[0] }}"</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 3) }}">{{ $occupiedThreeBedroom[0] }}</a></td>
                            @endif
                            @if ($restorationThreeBedroom[0] == 0)
                            <td class="text-right text-danger">{{ $restorationThreeBedroom[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 3) }}">{{ $restorationThreeBedroom[0] }}</a></td>
                            @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 4) }}">4 BR Attached</a></td>
                            @if ($vacantFourBedroomAttached[0] == 0)
                            <td class="text-right">{{ $vacantFourBedroomAttached[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 4) }}">{{ $vacantFourBedroomAttached[0] }}</a></td>
                            @endif
                            @if ($occupiedFourBedroomAttached[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedFourBedroomAttached[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 4) }}">{{ $occupiedFourBedroomAttached[0] }}</a></td>
                            @endif
                            @if ($restorationFourBedroomAttached[0] == 0)
                            <td class="text-right text-danger">{{ $restorationFourBedroomAttached[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 4) }}">{{ $restorationFourBedroomAttached[0] }}</a></td>
                            @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 44) }}">4 BR Detached</a></td>
                            @if ($vacantFourBedroomDetached[0] == 0)
                            <td class="text-right">{{ $vacantFourBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 44) }}">{{ $vacantFourBedroomDetached[0] }}</a></td>
                            @endif
                            @if ($occupiedFourBedroomDetached[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedFourBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 44) }}">{{ $occupiedFourBedroomDetached[0] }}</a></td>
                            @endif
                            @if ($restorationFourBedroomDetached[0] == 0)
                            <td class="text-right text-danger">{{ $restorationFourBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 44) }}">{{ $restorationFourBedroomDetached[0] }}</a></td>
                            @endif
                        </tr>
                        <tr>
                            <td> <a href="{{ route('index-type', 5) }}">5 BR</a></td>
                            @if ($vacantFiveBedroomDetached[0] == 0)
                            <td class="text-right">{{ $vacantFiveBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right"><a href="{{ route('facilities-type.vacant', 5) }}">{{ $vacantFiveBedroomDetached[0] }}</a></td>
                            @endif
                            @if ($occupiedFiveBedroomDetached[0] == 0)
                            <td class="text-right text-primary">{{ $occupiedFiveBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right text-primary"><a href="{{ route('facilities-type.occupied', 5) }}">{{ $occupiedFiveBedroomDetached[0] }}</a></td>
                            @endif
                            @if ($restorationFiveBedroomDetached[0] == 0)
                            <td class="text-right text-danger">{{ $restorationFiveBedroomDetached[0] }}</td>
                            @else
                            <td class="text-right text-danger"><a href="{{ route('restoration-type', 5) }}">{{ $restorationFiveBedroomDetached[0] }}</a></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-xl-6">
        <div class="card flex-fill w-100">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Total Facilites: {{ $totalFacilities[0] }}</h5>
                </div>
                <div class="card-body">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-pie"></canvas>
                    </div>
                </div>
                <table class="table mb-0">
                    <tbody>
                        <tr>
                            <td><i class="fas fa-square-full text-primary"></i> <a href="{{ route('facilities.vacant') }}">Vacant</a></td>
                            <td class="text-right">{{ $vacant[0] }}</td>
                            @if ($totalFacilities[0] > 0)
                            <td class="text-right text-success">{{ number_format($vacant[0] / $totalFacilities[0] * 100, 2) }}%</td>
                            @endif
                        </tr>
                        <tr>
                            <td><i class="fas fa-square-full text-warning"></i> <a href="{{ route('facilities.occupied') }}">Occupied</a></td>
                            <td class="text-right">{{ $occupied[0] }}</td>
                            @if ($totalFacilities[0] > 0)
                            <td class="text-right text-success">{{ number_format($occupied[0] / $totalFacilities[0] * 100, 2) }}%</td>
                            @endif
                        </tr>
                        <tr>
                            <td><i class="fas fa-square-full text-danger"></i> <a href="{{ route('restoration') }}">Restoration</a></td>
                            <td class="text-right">{{ $restoration[0] }}</td>
                            @if ($totalFacilities[0] > 0)
                            <td class="text-right text-success">{{ number_format($restoration[0] / $totalFacilities[0] * 100, 2) }}%</td>
                            @endif
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Appointments</h5>
            </div>
            <div class="card-body">
                <div class="chart">
                    <div id="apexcharts-column" style="min-height: 365px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    @livewire('dashboard-component')

@endif

@include('dashboard.assigner')
@include('charts.job_category')
@include('charts.facilities')

@endsection
