@extends('layouts.second')

@section('title', 'Login')

@section('content')
    <div class="hold-transition login-page">

    <div class="login-box">

        <div class="login-logo">
            <img src="public/img/ace.png" width="100px" height="100px" alt="ACE Logo" align="centre">
           <!-- <a href=""><b>Student Management Dashbord</b></a>-->
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login To SMD & Start Your Session</p>
                @if (session()->has('errors'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ session('errors') }}</li>
                        </ul>
                    </div>
                @endif


                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="offset-4 col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    </div>
    <!-- /.login-box -->
@endsection
