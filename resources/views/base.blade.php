<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/alertifyjs/alertify.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/alertifyjs/css/alertify.min.css') }}">
    @yield('style')
</head>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<body>
    <div>
        <div class="container">
            @include('customer/header')
        </div>
        @include('customer/navbar')
        <div class="container">
            @yield('content')
        </div>
        <div class="mt-5"></div>
        @include('customer/footer')
        @yield('script')
    </div>
</body>
</html>
