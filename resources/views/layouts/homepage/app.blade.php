<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Store') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('css/HeroicFeatures.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">

        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>

        {{--noty--}}
        <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/noty/noty.css') }}">
        <script src="{{ asset('dashboard_files/plugins/noty/noty.min.js') }}"></script>

    </head>
    <body>
        <div id="app">
            <main>
                @yield('content')
            </main>

            <!-- Navbar -->
            @include('layouts.homepage._navbar')

            <!-- partials session -->
            @include('partials._session')

            <!-- sweet alert -->
             {{-- @include('sweetalert::alert') --}}

        </div>

        <!-- Footer -->
        @include('layouts.homepage._footer')

        {{--<!-- jQuery 3 -->--}}
        {{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}

        <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

        {{--jquery number--}}
        <script src="{{ asset('dashboard_files/js/jquery.number.min.js') }}"></script>

        {{--print this--}}
        <script src="{{ asset('dashboard_files/js/printThis.js') }}"></script>

        {{--order js--}}
        <script src="{{ asset('js/order.js') }}" defer></script>


        {{-- <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2700
            });
        </script> --}}
    </body>

</html>