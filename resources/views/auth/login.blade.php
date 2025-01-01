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
        <div class="col-12 mb-5 text-center">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('assets/default/logo.png') }}" class="img-fluid" style="max-height: 100px" alt="{{ config('app.name') }}">
            </a>
        </div>
        <div class="card card-primary col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 py-3">
            <div class="card-body">
                <h3 class="card-title text-center">Log in</h3>
                <div class="card-text">
                    @if(session('errors'))
                        <div class="alert alert-danger fade show" role="alert">{{ session('errors')->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="email" class="">Email address <small class="text-danger">*</small></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>

                            <div class="invalid-feedback">
                                Valid email address is required
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <small class="text-danger">*</small></label>
                            <input type="password" class="form-control" id="password" name="password" required>

                            <div class="invalid-feedback">
                                Password is required
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg mt-5">Login Now</button>
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
