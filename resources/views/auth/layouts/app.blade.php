<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Parts Finder</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background-color: #bcbcbc; color: #000000;">

<div class="login-box">
    <div class="login-box-body" style="margin-top: 10%">
        <!-- /.login-logo -->
    @yield('content')
    <!-- /.login-box-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>

</body>
</html>

