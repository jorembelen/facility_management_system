

{{-- @if (auth()->user()->role == 'representative')
<div class="row">
    <div class="col-12 col-sm-6 col-xxl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-2">{{ $open }}</h3>
                        <a href="{{ route('appointments.open') }}"><p class="mb-2">Open Work Orders</p></a>
                    </div>
                    <div class="d-inline-block ml-3">
                        <div class="stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-circle align-middle mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="12" x2="16" y2="12"></line></svg></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xxl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-2">{{ $closed }}</h3>
                        <a href="{{ route('appointments.closed') }}"><p class="mb-2">Closed Work Orders</p></a>
                    </div>
                    <div class="d-inline-block ml-3">
                     <div class="d-inline-block ml-3">
                        <div class="stat"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle align-middle mr-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xxl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-2">{{ $cancelled }}</h3>
                        <a href="{{ route('appointments.cancelled') }}"><p class="mb-2">Cancelled Work Orders</p></a>
                    </div>
                    <div class="d-inline-block ml-3">
                     <div class="d-inline-block ml-3">
                        <div class="stat">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle mr-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xxl d-flex">
        <div class="card flex-fill">
            <div class="card-body py-4">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-2">{{ $app_created }}</h3>
                        <a href="{{ route('appointments.index') }}"><p class="mb-2">Total Work Orders</p></a>
                    </div>
                    <div class="d-inline-block ml-3">
                        <div class="d-inline-block ml-3">
                            <div class="stat">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info align-middle mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
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

    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Facilites Chart</h5>
                <h5 class="card-subtitle text-muted">Total Facilties: <strong>{{ $totalFacilities[0] }}</strong></h5>
            </div>
            <div class="card-body">
                <div class="chart chart-sm">
                    <canvas id="chartjs-pie"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endif --}}
