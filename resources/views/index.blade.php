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
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>
                            Running Projects
                            <sup class="text-success">({{ $running_projects->count() }})</sup>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Researchers Name</th>
                                        <th>Progress</th>
                                        <th>Estimated Completion Date</th>
{{--                                        Changes--}}
{{--                                        <th>Estimated Budget</th>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($running_projects->count())
                                        @foreach($running_projects as $project)
                                            <tr>
                                                <td>{{ $project->name }}</td>
                                                <td>{{ $project->client?->name }}</td>
                                                <td class="align-middle" style="min-width: 200px">
                                                    <div class="progress" data-height="6" data-toggle="tooltip" title="{{ $project->completion_percentage.'% Completed' }}">
                                                        <div class="progress-bar {{ $project->completion_percentage < 50 ? 'bg-danger' : 'bg-success' }}" data-width="{{ $project->completion_percentage.'%' }}"></div>
                                                    </div>
                                                </td>
                                                <td>{{ $project->estimated_completion_date }}</td>
{{--                                                Changes--}}
{{--                                                <td>{{ '$'.number_format($project->estimated_budget) }}</td>--}}
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Project Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

{{--Changes--}}
{{--            <div class="col-12">--}}
{{--                <div class="card card-primary">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4>--}}
{{--                            Upcoming Inspections--}}
{{--                            <sup class="text-success">({{ $upcoming_inspections->count() }})</sup>--}}
{{--                        </h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-striped">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Inspection Name</th>--}}
{{--                                    <th>Project Name</th>--}}
{{--                                    <th>Scheduled Date</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @if($upcoming_inspections->count())--}}
{{--                                    @foreach($upcoming_inspections as $inspection)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $inspection->name }}</td>--}}
{{--                                            <td>{{ $inspection->project?->name }}</td>--}}
{{--                                            <td>{{ $inspection->scheduled_date }}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @else--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="100%" class="text-center text-muted font-weight-bold">No Upcoming Inspections Found</td>--}}
{{--                                    </tr>--}}
{{--                                @endif--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-12">--}}
{{--                <div class="card card-primary">--}}
{{--                    <div class="card-header d-flex justify-content-between">--}}
{{--                        <h4>All Projects</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        @include('custom-layout.component.project-table')--}}
{{--                        {{ $projects->appends(request()->except('project_page'))->links() }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-12">--}}
{{--                <div class="card card-primary">--}}
{{--                    <div class="card-header d-flex justify-content-between">--}}
{{--                        <h4>All Clients</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        @include('custom-layout.component.client-table')--}}
{{--                        {{ $clients->appends(request()->except('client_page'))->links() }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
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
