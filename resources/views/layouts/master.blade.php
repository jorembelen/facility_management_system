
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FMS | @yield('title')</title>

    <link rel="canonical" href="pages-blank.html" />
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">


    <link href="{{ asset('assets/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/lightbox/custom-photswipe.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/lightbox/photoswipe.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/lightbox/default-skin/default-skin.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/switches.css') }}">
    <!-- Choose your prefered color scheme -->
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/light.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/prevent.css') }}" rel="stylesheet">
    <link href="{{ asset('css/file-upload.css') }}" rel="stylesheet">
    <style>
        @media all and (min-width: 480px) {
            .deskContent {display:block;}
            .phoneContent {display:none;}
        }

        @media all and (max-width: 479px) {
            .deskContent {display:none;}
            .phoneContent {display:block;}
        }
        .clock {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            color: #3F80EA;
            font-size: 60px;
            font-family: Orbitron;
            letter-spacing: 7px;
        }
    </style>


    @livewireStyles
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="default">
    <div class="wrapper">

        @include('includes.sidebar.index')

        <div class="main">

            @include('includes.navbar')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">@yield('title')</h1>

                    @yield('content')
                    @include('sweetalert::alert')
                    @include('scripts.sweet-alert')

                </div>
            </main>

            @include('includes.footer')

        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/lightbox/photoswipe.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/lightbox/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/lightbox/custom-photswipe.js') }}"></script>

    <script src="{{ asset('assets/js/prevent.js') }}"></script>
    <script src="{{ asset('js/modal-video.js') }}"></script>


    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\UserStoreRequest', '#user-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\UserUpdateRequest', '#user-update'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\OccupantStoreRequest', '#occ-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\JobOrderStoreRequest', '#job-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\AppointmentStoreRequest', '#app-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\EmployeeStoreRequest', '#emp-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\EmployeeUpdateRequest', '#emp-update'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ClientGetAppointmentRequest', '#req-get'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\SchedulerGetAppointmentRequest', '#req-scheduler'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ClientAppointmentRequest', '#client-app-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\SchedulerAppointmentRequest', '#scheduler-app-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\SurveyRequest', '#survey-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\CancelAppointmentRequest', '#cancel-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\RestorationStoreRequest', '#restoration-create'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\CheckoutRequest', '#checkout'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\CheckinRequest', '#checkin'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\AssignRequest', '#assign'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ResetpasswordRequest', '#reset'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ClosedJobOrder', '#closed-jo'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ClosedRestorationRequest', '#closed-restoration'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\ProfileUpdateRequest', '#profile-update'); !!}
    {!! JsValidator::formRequest('App\Http\Requests\StaffStoreRequest', '#staff-create'); !!}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select2
            $(".select2").each(function() {
                $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    // placeholder: "Select value",
                    dropdownParent: $(this).parent()
                });
            })

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables with Buttons
            var datatablesButtons = $("#datatables-buttons").DataTable({
                responsive: true,
                lengthChange: !1,
                buttons:'copy'
            });
            datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
        });
    </script>



    @include('scripts.avatar')
    @include('scripts.modal')
    @include('scripts.clock')
    @stack('prev-maint-js')
    @stack('create-js')
    @stack('jo-js')
    @stack('score-js')
    @stack('users-js')
    @stack('upgrade-js')
    @stack('assign-js')
    @stack('appointment-js')
    @stack('emergency-js')
    @stack('sched-create-js')
    @stack('appointment-report-js')
    @stack('restoration-js')


    @livewireScripts

</body>

</html>
