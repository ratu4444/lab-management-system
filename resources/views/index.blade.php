@extends('custom-layout.master')
@push('css')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            @foreach($reports as $report)
                <div class="col-xl-3 col-lg-6">
                    <div class="card {{ $report['card_background'] ?? 'l-bg-cyan' }}">
                        <div class="card-statistic-3">
                            <div class="card-icon card-icon-large">
                                <i class="{{ $report['card_icon'] ?? 'fa fa-globe' }}"></i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title text-white-50" style="min-height: 60px">{{ $report['heading'] }}</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-subtitle m-0 text-light card-value">{{ $report['count'] }}</h3>
                                    @if($report['url'])
                                        <a href="{{ $report['url'] }}" class="btn btn-primary btn-sm shadow-lg" style="z-index: 999">Show</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Projects</h4>
                    </div>
                    <div class="card-body">
                        @include('custom-layout.component.project-table')
                        {{ $projects->appends(request()->except('project_page'))->links() }}
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Clients</h4>
                    </div>
                    <div class="card-body">
                        @include('custom-layout.component.client-table')
                        {{ $clients->appends(request()->except('client_page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var speed = 1000;

            $('.card-value').each(function() {
                var valueElement = $(this);
                var value = valueElement.text();

                valueElement.text(0); // set initial value to 0
                $({ value: 0 }).animate({ value: value }, {
                    duration: speed,
                    step: function() {
                        valueElement.text(Math.ceil(this.value));
                    }
                });
            });
        });
    </script>
@endpush
