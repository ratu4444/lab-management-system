<!DOCTYPE html>
<html lang="en">
<head>
    @include('custom-layout.header')
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            @auth
                @include('custom-layout.navbar')
                @include('custom-layout.sidebar')
            @endauth

    {{--        @include('custom-layout.alert')--}}
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>

                @include('custom-layout.create-modal')
            </div>
        </div>
    </div>

@include('custom-layout.footer')
</body>
</html>
