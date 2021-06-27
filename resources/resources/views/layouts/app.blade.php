<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Parts Finder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="content for search" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables/jquery.dataTables.min.css')}}">
    @yield('style-script')
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap-datepicker.min.js')}}"></script>

    <script src="{{ asset('/plugins/notify/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>

</head>


<body>
<div class="container-fluid">
    @yield('header')
    @yield('content')
    @yield('footer')
</div>
</body>

</html>
