@extends('layouts.main')

@section('content')
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Point of Sales</b></a>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">supported by <stong>retro</strong>AppsBali</p>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                    </div>
                </div>
            </form>

            <a href="#">Saya lupa password...</a><br>
        </div>
    </div>
@endsection