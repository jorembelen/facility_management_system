
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome</title>

    <link rel="canonical" href="#" />
    <link rel="shortcut icon" href="/assets/img/favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <link href="/assets/css/light.css" rel="stylesheet">
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="default">
    <div class="wrapper">


        <div class="main">



            <main class="content">
                <div class="container-fluid p-0">

                    <div class="col-auto ml-auto text-right mt-n1">
                        <span class="dropdown mr-2">

                        <a class="btn btn-primary shadow-sm" href="{{ route('logout') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out align-middle mr-2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                Logout
                        </a>
                    </div>

                    <h1 class="h3 mb-3">@yield('title')</h1>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="text-center">
                            </div><br>
                            <h3 class="text-center"><strong>{{ auth()->user()->userGreetings() }}</strong></h3>
                            <h3 class="text-center">Welcome to</h3>
                            <h3 class="text-center">SADARA Alwaha Facility Management System</h3>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <img src="assets/img/guest.svg" alt="" class="img-fluid">
                    </div>

                </div>
            </main>

            @include('includes.footer')

        </div>
    </div>

    <script src="/assets/js/app.js"></script>

</body>

</html>
