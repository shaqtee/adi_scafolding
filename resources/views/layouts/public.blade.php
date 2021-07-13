<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icon -->
    <link href="{{ asset('packages/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body id="page-top">
    @yield('public_content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('packages/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('packages/sbadmin2/js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('packages/sbadmin2/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('packages/sbadmin2/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('packages/sbadmin2/js/demo/chart-pie-demo.js') }}"></script>
    @yield('js')
</body>
</html>
