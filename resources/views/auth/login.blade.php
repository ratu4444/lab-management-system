@extends('custom-layout.master')
@section('title', 'Login')

@push('css')
    <style type="text/css">
        .main-content {
            padding-top: 30px;
            padding-left: 30px;
        }
    </style>
@endpush

@section('content')
    <div class="container">

        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4 mb-5">
            <a href="">
                <img src="{{ asset('default/DJL-Construction_Light.png') }}" class="img-fluid w-100" alt="">
            </a>
        </div>
        <div class="card card-danger col-12 col-md-6 offset-md-3 py-3">
            <div class="card-body">
                <h3 class="card-title text-center">Log in</h3>
                <div class="card-text">
                    <!--
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                    <!-- to error: add class "has-danger" -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="">Email address <small class="text-danger">*</small></label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password <small class="text-danger">*</small></label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-danger btn-block btn-lg mt-5">Sign in</button>
                    </form>
                </div>
            </div>
            {{--                <div class="card-footer">--}}
            {{--                    <div class="text-muted text-center">--}}
            {{--                        Don't Have an Account?--}}
            {{--                        <a href="{{ route('register') }}">--}}
            {{--                            Register Now--}}
            {{--                        </a>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
        </div>
    </div>
@endsection
