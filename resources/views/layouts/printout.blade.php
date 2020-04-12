<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RetroApps</title>
        <link href="{{ asset('asstes/favicon.png') }}" rel="shortcut icon">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <style>
            @page{
            margin: 2em 0.5em;
            }

            body {
                font-family: "Times New Roman", Times, serif !important;
            }
        </style>
    </head>
    <body onload="window.print();">
    <div class="wrapper">
        <section class="invoice">
            @yield('content')
        </section>
    </div>
    </body>
</html>
