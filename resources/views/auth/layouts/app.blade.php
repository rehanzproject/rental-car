<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>WheelsRent</title>
        <link rel="shortcut icon" href="{{ asset('img/Logo.png') }}">

        {{-- My CSS --}}
        <link id="colors" href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap">
        <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" type="text/css" id="mdb">
        <link href="{{ asset('css/layouts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/coloring.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        @stack('styles')
    </head>

    <body class="dark-scheme">
        <div id="app">
            <div id="wrapper">

                {{-- Navbar --}}
                @include('layouts.navbar')

                {{-- Page Preloader --}}
                <div id="de-preloader"></div>

                {{-- Content --}}
                <main class="py-4">
                    @yield('content')
                </main>

                {{-- Footer --}}
                @include('layouts.footer')

                {{-- Back to Top --}}
                <a href="#" id="back-to-top"></a>

            </div>
        </div>

        {{-- Admin LTE --}}
        <script src="{{ asset('vendor/admin-lte/adminlte.min.js') }}"></script>

        {{-- JQuery --}}
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

        {{-- My Javascript --}}
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <script src="{{ asset('js/submit.js') }}"></script>

        @stack('scripts')
    </body>
</html>
