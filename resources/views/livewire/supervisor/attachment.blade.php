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


                    @section('content')



                    <div class="row mb-2 mb-xl-3 d-print-none">

                        <div class="col-auto ml-auto text-right mt-n1">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="align-middle mr-2 fas fa-fw fa-arrow-alt-circle-left"></i> Back</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1>Sadara COSL</h1>
                                    <h3>Sadara Chemical Company | Community Services</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="logo-align-right">
                                        <img src="/assets/img/sadara.png" height="70">
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">

                            <br><br><br>
                            <h1 class="text-center mt-4" style="font-size: 30px">ACKNOWLEDGEMENT LETTER FOR COMPLIANCE WITH CONTRACT TERMS AND CONDITIONS</h1>
                            <br><br><br><br>

                            <div>
                                <p class="text-justify" style="font-size: 20px">I, <u class="ml-2 mr-2">{{ $user->name }}</u> do hereby acknowledge that unit # <u class="ml-2 mr-2">{{ $user->building->flat_no }}</u>
                                    has been assigned to me and I have read and fully understood all terms and conditions of housing assignment agreement. <br> <br>
                                    Therefore, I confirm, I will not lease or sublease full or part of the unit assigned to me, failure to which will raise disciplinary action against me according
                                    to Sadara rules and regulations and vacate unit accordingly.
                                </p>
                            </div>

                            <br><br><br><br><br>

                            <div class="row text-center">
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Employees Signature</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text" value="{{ $user->badge }}" class="no-border" disabled></h4></u>
                                    <p>Badge Number</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Date</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p style="page-break-after: always;">&nbsp;</p>
                    <p style="page-break-before: always;">&nbsp;</p>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1>Sadara COSL</h1>
                                    <h3>Sadara Chemical Company | Community Services</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="logo-align-right">
                                        <img src="/assets/img/sadara.png" height="70">
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <br><br><br>
                            <h1 class="text-center mt-4" style="font-size: 30px">ACKNOWLEDGEMENT FOR TV CHANNELS PROVISION</h1>
                            <br><br><br><br>

                            <div>
                                <p class="text-justify" style="font-size: 20px">I, <u class="ml-2 mr-2">{{ $user->name }}</u> resident of unit # <u class="ml-2 mr-2">{{ $user->building->flat_no }},</u>
                                    Street address: <u class="ml-2 mr-2">{{ $user->building->buildingAddress() }}</u> do hereby acknowledge my understanding that: <br><br>

                                    That Royal Commission along with the lease agreement with GOSI prohibits the installation of Dishes Antennas over the roof of the housing units in order
                                    to prevent water proofing damage and to maintain nice appurtenance to the community. <br><br>

                                    However, for the convenience of entertainment of the residents, the Royal Commission provides TV channels to all GOSI housing units. Moreover, you can
                                    alternatively subscribe with STC to get required channel package on payment which will be provided by STC through telephony board located on each unit. <br><br>

                                    Therefore, you are kindly requested to strictly adhere to this procedure.
                                </p>
                            </div>

                            <br><br><br><br><br>

                            <div class="row text-center">
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Employees Signature</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text" value="{{ $user->badge }}" class="no-border" disabled readonly></h4></u>
                                    <p>Badge Number</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Date</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p style="page-break-after: always;">&nbsp;</p>
                    <p style="page-break-before: always;">&nbsp;</p>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1>Sadara COSL</h1>
                                    <h3>Sadara Chemical Company | Community Services</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="logo-align-right">
                                        <img src="/assets/img/sadara.png" height="70">
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <br><br><br>
                            <h1 class="text-center" style="font-size: 30px">FIRESYSTEM PERIODIC INSPECTION</h1>
                            <h1 class="text-center" style="font-size: 30px">&</h1>
                            <h1 class="text-center" style="font-size: 30px">MAINTENANCE ACKNOWLEDGEMENT</h1>
                            <br><br><br><br>

                            <div>
                                <p class="text-justify" style="font-size: 20px">I, <u class="ml-2 mr-2">{{ $user->name }}</u> resident of unit # <u class="ml-2 mr-2">{{ $user->building->flat_no }},</u>
                                    Street address: <u class="ml-2 mr-2">{{ $user->building->buildingAddress() }}</u> do hereby acknowledge that I have no objection for Sadara assigned contractor
                                    to periodically inspect and maintain fire systems (fire alarm, fire extinguishers, fire hydrant, etc.) inside and outside  of my unit as mentioned above. <br><br>

                                    Therefore, I confirm, should there be a periodic plan communicated to me/us for fire system inspection and maintenance, I will provide access and extend
                                    my cooperation to contractor to complete their task according to schedule.


                                </p>
                            </div>

                            <br><br><br><br><br>

                            <div class="row text-center">
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Employees Signature</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text" value="{{ $user->badge }}" class="no-border" disabled readonly></h4></u>
                                    <p>Badge Number</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Date</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p style="page-break-after: always;">&nbsp;</p>
                    <p style="page-break-before: always;">&nbsp;</p>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1>Sadara COSL</h1>
                                    <h3>Sadara Chemical Company | Community Services</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="logo-align-right">
                                        <img src="/assets/img/sadara.png" height="70">
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <br><br><br>
                            <h1 class="text-center" style="font-size: 30px">APPLIANCE INVENTORY LIST</h1>
                            <br><br><br><br>

                            <div>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:10%;">SN</th>
                                            <th style="width:30%">ITEM TO CHECK</th>
                                            <th style="width:15%">QUANTITY (NOS.)</th>
                                            <th style="width:5%" class="text-center">Y</th>
                                            <th style="width:5%" class="text-center">N</th>
                                            <th style="width:35%">REMARKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>AIR CONDITIONING UNIT</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>TOILETS - WATER HEATER</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>KITCHEN APPLIANCE - WATER HEATER</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td>KITCHEN APPLIANCE - REFRIGERATOR</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td>KITCHEN APPLIANCE - COOKING RANGE</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td>KITCHEN APPLIANCE - HOOD</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>7.</td>
                                            <td>LAUNDRY - WASHER</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>8.</td>
                                            <td>LAUNDRY - DRYER</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <br><br><br><br><br>

                            <div class="row text-center">
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Employees Signature</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text" value="{{ $user->badge }}" class="no-border" disabled readonly></h4></u>
                                    <p>Badge Number</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Date</p>
                                </div>
                            </div>
                            <br><br>
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>COSL Representative</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Badge ID</p>
                                </div>
                                <div class="col-md-4">
                                    <u><h4 class="underline"><input type="text"  class="no-border" disabled></h4></u>
                                    <p>Date</p>
                                </div>
                            </div>


                        </div>
                    </div>

                    <p style="page-break-after: always;">&nbsp;</p>
                    <p style="page-break-before: always;">&nbsp;</p>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h1>Sadara COSL</h1>
                                    <h3>Sadara Chemical Company | Community Services</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="logo-align-right">
                                        <img src="/assets/img/sadara.png" height="70">
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <br><br><br>
                            <h1 style="font-size: 25px">Dear Alwaha Resident</h1>
                            <br><br><br>

                            <div>

                                <p class="text-justify" style="font-size: 25px">
                                    To initiate a Maintenance Request, through COSL Maintenance Contractor (Rezayat), please follow the below steps:
                                </p>
                                <ul>
                                    <p style="font-size: 25px">1. Mobile # 0503809171, Telephone # (013) 341-5775 ext. 4116 or via email   <a href="mailto:iam@joreb.net">sadara.servicedesk@rezayat.net</a> </p>
                                    <p style="font-size: 25px">2. State your Name, Badge number, House Address, and Contact number. </p>
                                    <p style="font-size: 25px">3. State your Maintenance Request. </p>
                                    <p style="font-size: 25px">4. Schedule an appointment for maintenance. </p>
                                    <p style="font-size: 25px">5. After rectification, acknowledge completion of the job in the Maintenance Order Form. </p>
                                </ul>
                                <br><br>
                                <p class="text-justify" style="font-size: 25px">
                                    Your cooperation will be appreciated regarding this matter. Thank you.
                                </p>
                            </div>




                        </div>
                    </div>
                    <p style="page-break-after: always;">&nbsp;</p>
                    <p style="page-break-before: always;">&nbsp;</p>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 text-center">
                                    <h1 style="font-size: 30px" dir="rtl">اتفاقية الإسكان (الواحة)</h1>
                                    <h1 style="font-size: 30px">Housing Agreement (AL-WAHA)</h1>
                                </div>
                                <div class="col-md-2">
                                    <div class="logo-align-right">
                                        <img src="/assets/img/sadara.png" width="200">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="text-left ml-6" style="font-size: 20px">C&LSD - Housing Services</h1>
                                </div>
                                <div class="col-md-6">
                                    <h1 class="text-right mr-6" style="font-size: 20px">HS-F-007-04/2019</h1>
                                </div>
                            </div>
                            <div>
                                <div class="ml-3 mr-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:40%;" class="colorfy">Assignee Name (Last, First MI)</th>
                                                <th style="width:20%">ID/Badge No.:</th>
                                                <th style="width:15%">Contact No.</th>
                                                <th style="width:25%">Housing Unit Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @php
                                                $name = explode(' ', $user->name);
                                                $last_name = array_pop($name);
                                                $first_name = substr($user->name, 0, strripos($user->name, ' '));
                                                $tenantName = $last_name .', ' .$first_name;
                                                @endphp
                                                <td style="font-size: 18px">{{ $tenantName }}</td>
                                                <td style="font-size: 18px">{{ $user->badge }}</td>
                                                <td style="font-size: 18px">{{ $user->mobile }}</td>
                                                <td style="font-size: 18px">{{ $user->building->type->name }}</td>
                                            </tr>

                                        </tbody>
                                        <thead>
                                            <tr>
                                                <th style="width:40%;">Assigned House/Room No.:</th>
                                                <th style="width:20%">Acceptance Date:</th>
                                                <th style="width:15%" colspan="2">Occupancy Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 18px">{{ $user->building->buildingDetails() }}</td>
                                                <td></td>
                                                <td colspan="2"></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="mb-4">
                                    <img src="{{ asset('assets/img/contract1.jpg') }}" alt="" width="100%">
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/contract2.jpg') }}" alt="" width="100%">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/contract3.jpg') }}" alt="" width="100%">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('assets/img/contract4.jpg') }}" alt="" width="100%">
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

                <script src="/assets/js/app.js"></script>

                <script>
                    function myFunction() {
                        window.print();
                    }
                </script>
            </body>

            </html>
