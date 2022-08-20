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
                            <h3 class="illustration-text text-left mt-4 deskContent"> {{ auth()->user()->userGreetings() }} <i class="far fa-fw fa-smile"></i></h3>
                            <h3 class="illustration-text ml-3 text-center mt-4 phoneContent"> {{ auth()->user()->userGreetings() }} <i class="far fa-fw fa-smile"></i></h3>
                            <hr>
                            <h5>Email: {{ auth()->user()->email }}</h5>
                            <h5>Mobile No: {{ auth()->user()->mobile }}</h5>
                            <h5>Badge Number: {{ auth()->user()->badge }}</h5>
                            <h5>Facilities Info: {{ $houseInfo->building->buildingInfo() }} </h5>
                            <h5>Check In Date: {{ date('M-d-Y', strtotime($houseInfo->checkin_date)) }}</h5>
                            @if ($houseInfo->building->status == 2)
                            <a class="btn btn-dark" href="#" data-toggle="modal" data-target="#checkout{{ auth()->id() }}">Request Checkout</a>
                            @elseif ($houseInfo->building->status == 3)
                            <p><i class="align-middle mr-2 fas fa-fw fa-check-circle"></i> Request for checkout on process</p>
                            <a class="btn btn-dark" href="#" data-toggle="modal" data-target="#checkout-cancel{{ auth()->id() }}">Cancel Request</a>
                            @else
                            <a class="btn btn-success"><i class="align-middle mr-2 fas fa-fw fa-check-circle"></i> Request for checkout approved</a>
                            @endif
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

<div class="card-body">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="alert-message">
            <strong>  {{ session('success') }}</strong>
        </div>
    </div>
    @elseif (session()->has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <div class="alert-message">
            <strong>  {{ session('error') }}</strong>
        </div>
    </div>
    @endif
</div>


@if (auth()->user()->isTenant())
<div class="row">
    <div class="col-12 col-lg-6 col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Open Appointments فتح مواعيد</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right align-middle"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{$open}}</span>
                <div class="mb-0">
                    <a href="{{ route('tenant.appointments', 0) }}"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Closed Appointments إغلاق مواعيد</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle align-middle mr-2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{$closed}}</span>
                <div class="mb-0">
                    <a href="{{ route('tenant.appointments', 1) }}"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Cancelled Appointments إلغاء مواعيد</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle mr-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{$cancelled}}</span>
                <div class="mb-0">
                    <a href="{{ route('tenant.appointments', 2) }}"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-md-6">
        <div class="card flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col mt-0">
                        <h5 class="card-title">Total Appointments جميع المواعيد</h5>
                    </div>

                    <div class="col-auto">
                        <div class="stat stat-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info align-middle mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        </div>
                    </div>
                </div>
                <span class="h1 d-inline-block mt-1 mb-4">{{$app_created}}</span>
                <div class="mb-0">
                    <a href="{{ route('tenant.appointments', 3) }}"><p class="mb-2">View Details</p></a>
                </div>
            </div>
        </div>
    </div>


</div>
{{-- Score Survey Table --}}
@if ($surveyScores->count() > 0)
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Please Rate Us ارجوك قم بتقييمنا</h5>
            </div>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Job Category</th>
                        <th>Date</th>
                        <th>Scheduled Time</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($surveyScores as $surveyScore)
                    <tr>
                        <td>{{ $surveyScore->category->name }}</td>
                        <td>{{ date('M-d-Y', strtotime($surveyScore->date)) }}</td>
                        <td>{{ $surveyScore->schedule_time }}</td>
                        <td>  <span class="badge badge-success">Closed</span></td>
                        <td><a  href="{{ route('survey', $surveyScore->id) }}"><i class="fas fa-fw fa-star" style="color:green"></i> Give us your rating</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- Checkout Tenant Modal -->
<div class="modal fade" id="checkout{{ auth()->id() }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown" style="color:red"></i> Request for Checkout?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('reqCheckout.submit', auth()->id()) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="building_id" value="{{ $houseInfo->building->id }}">
                    <h4 class="mb-0 text-center">If you are sure, please click submit to proceed!</h4><br>
                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Checkout Tenant Modal -->
<div class="modal fade" id="checkout-cancel{{ auth()->id() }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-smile" style="color:blue"></i> Cancel Request for Checkout?</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('cancel-checkout.submit', auth()->id()) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="building_id" value="{{ $houseInfo->building->id }}">
                    <h4 class="mb-0 text-center">If you are sure, please click submit to proceed!</h4><br>
                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endif

@endsection
