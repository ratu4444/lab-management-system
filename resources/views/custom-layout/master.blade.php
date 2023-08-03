<!DOCTYPE html>
<html lang="en">
<head>
    @include('custom-layout.header')
</head>

<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">

{{--        @auth--}}
            @include('custom-layout.navbar')

            @include('custom-layout.sidebar')
{{--        @endauth--}}

{{--        @include('custom-layout.alert')--}}
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    @yield('content')
                </div>
            </section>
{{--            @yield('modal')--}}
        </div>
        {{--        <footer class="main-footer">--}}
        {{--            <div class="footer-left">--}}
        {{--                <a href="templateshub.net">Templateshub</a></a>--}}
        {{--            </div>--}}
        {{--            <div class="footer-right">--}}
        {{--            </div>--}}
        {{--        </footer>--}}
    </div>
</div>

@include('custom-layout.footer')
</body>
</html>
