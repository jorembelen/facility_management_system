<!DOCTYPE html>
<html lang="en">

<head>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FMS | Report</title>

    <link rel="canonical" href="pages-blank.html" />
    <link rel="shortcut icon" href="/assets/img/favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <link rel="canonical" href="https://appstack.bootlab.io/tables-datatables-responsive.html" />
    <link rel="canonical" href="https://appstack.bootlab.io/forms-advanced-inputs.html" />
    <link rel="canonical" href="https://appstack.bootlab.io/charts-chartjs.html" />
    <!-- Choose your prefered color scheme -->
    <link href="/assets/css/light.css" rel="stylesheet">
    <link href="/css/prevent.css" rel="stylesheet" />
    <link href="/css/chat.css" rel="stylesheet">
    <link href="/css/print.css" rel="stylesheet">

</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="default">
    <div class="wrapper">

        {{-- @include('includes.sidebar.index') --}}

        <div class="main">

            @include('includes.navbar')

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="row mb-2 mb-xl-3">

                        <div class="col-auto ml-auto text-right mt-n1 d-print-none">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="align-middle mr-2 fas fa-fw fa-arrow-alt-circle-left"></i> Back</a>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="logo-align-left">
                                        <img src="/assets/img/logo.png" height="80">
                                        <h5>Rezayat Company Limited</h5>
                                        <h4><strong>Sadara Al Waha O & M Project</strong></h4>
                                    </div>
                                    {{-- <div class="logo-align-right">
                                        <img src="/assets/img/sadara.png" height="70">
                                    </div> --}}
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="text-center">
                                        <h2><strong>SERVICE ORDER</strong></h2>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="text-right">
                                            <h2>Job Order No. :<strong> {{ $appointment->id }}</strong></h2>
                                        </div>


                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="panel-header">Resident Name:
                                                    @if ($appointment->user_id != '')
                                                    <strong>{{ $appointment->client->name }}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-header">Address:</strong></div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="panel-header">Badge #:
                                                    @if ($appointment->user_id != '')
                                                    <strong>{{ $appointment->client->badge }}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                            @if (in_array($appointment->building->facility_type_id, [1,2,3,4]))
                                            <div class="col-md-6">
                                                <div class="panel-heading">
                                                    <strong>RC Bldg.: {{ $appointment->building->rc_no }} IFC Bldg.: {{ $appointment->building->ifc_no }} Flat Unit: {{ $appointment->building->flat_no }} Block: {{ $appointment->building->block_no }} Street: {{ $appointment->building->street }}</strong>
                                                </div>

                                            </div>
                                            @else
                                            <div class="col-md-6">
                                                <div class="panel-heading">
                                                    <strong>Villa No.: {{ $appointment->building->villa_no }} Lot: {{ $appointment->building->lot_no }} Block: {{ $appointment->building->block_no }} Street: {{ $appointment->building->street }}</strong>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-md-6">
                                                <div class="panel-header">Mobile #:
                                                    @if ($appointment->user_id != '')
                                                    <strong>{{ $appointment->client->mobile }}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-header">Email:
                                                    @if ($appointment->user_id != '')
                                                    <strong>{{ $appointment->client->email }}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <div class="panel-header">Work Category: <strong>{{ $appointment->category->name }}</strong></div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <div class="panel-header">Appointment Date: <strong>{{ date('M-d-Y', strtotime($appointment->date)) }}</strong></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-header"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-header">Appointment Time: <strong>{{ $appointment->schedule_time }}</strong></div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <div class="panel-header">Request Date: <strong>{{ date('M-d-Y', strtotime($appointment->created_at)) }}</strong></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-header"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-header">Location: <strong>{{ $appointment->job_location }}</strong></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="panel-header"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="panel-header text-justify">Job Description:</div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="panel-header text-justify"><strong>{{ $appointment->job_description }}</strong></div>
                                            </div>

                                            <div class="col-md-12 mt-4">
                                                <div class="panel-heading">Technician Note:</div>
                                            </div>
                                            <div class="col-md-12 boxed ml-2 mr-2">
                                            </div>
                                            <div class="col-md-6 mt-4 ">
                                                <div class="panel-heading line">Technician Signature and Date: </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <div class="panel-heading line">Supervisor Signature and Date: </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="panel-heading">Job Done:  </div>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <span class="form-check-label">
                                                        Yes
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="">
                                                    <span class="form-check-label">
                                                        No
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <div class="panel-heading">Occupant Remarks:</div>
                                            </div>
                                            <div class="col-md-12 boxed ml-2 mr-2">
                                            </div>
                                            <div class="col-md-6 mt-4 ">

                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <div class="panel-heading line">Occupant Signature and Date: </div>
                                            </div>
                                            <div class="col-md-12 mt-4">
                                                <h5>* Note: Material Used will be in a separate sheet</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <h5>* Satisfaction Survey will be through online</h5>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <a href="javascript:window.print()" class="float d-print-none">
                            <svg class="my-float" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer align-middle mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                        </a>
                        <div class="label-container d-print-none">
                            <div class="label-text">Print</div>
                            <i class="fa fa-play label-arrow"></i>
                        </div>

                    </main>
                    <div id="bottom"><p class="printable">Ref#: RCL-MDH-FM-01 | Ver: 1.0 Rev Date: April 4, 2021</p></div>

                    <script src="/assets/js/app.js"></script>

                    <script>
                        function myFunction() {
                            window.print();
                        }
                    </script>
                </body>

                </html>
