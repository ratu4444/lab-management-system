@extends('custom-layout.master')
@section('title', 'Dashboard')
@push('css')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            @foreach($reports as $report)
                <div class="col-xl-4 col-lg-6">
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
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var speed = 1000;

            $('.card-value').each(function() {
                var valueElement = $(this);
                var value = valueElement.text();

                animateValue(valueElement, value, speed);
            });
        });
    </script>
@endpush
