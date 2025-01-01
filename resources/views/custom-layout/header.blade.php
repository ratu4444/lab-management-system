<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>
    @hasSection('title')
        @yield('title') |
    @endif
    {{ config('app.name') }}
</title>

<!-- General CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-social/bootstrap-social.css') }}">
<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
<!-- Custom style CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
<link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/default/logo.png') }}" />

{{-- Page Custom CSS --}}
@stack('css')
