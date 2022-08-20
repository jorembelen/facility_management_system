<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="/assets/css/light.css" rel="stylesheet">


    <livewire:styles />
</head>
<body>
    <div class="font-sans text-gray-900 antialiased">

        <main class="content d-flex p-0">
            <div class="container d-flex flex-column">
                <div class="row h-100">
                    <div class="col-sm-10 col-md-8 col-lg-8 mx-auto d-table h-100 mb-4">
                        <div class="d-table-cell align-middle">

                            @yield('content')
                            @include('scripts.sweet-alert')

                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

       <!-- Scripts -->
       <script src="{{ mix('js/app.js') }}" defer></script>
    <livewire:scripts />
</body>
</html>
