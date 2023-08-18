@extends('custom-layout.master')
@section('title', 'Project Details')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/ionicons/css/ionicons.min.css') }}">
    <script src="{{ asset('js/frappe-gantt.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/frappe-gantt.css') }}">

    <style>
        .matrix-title {
            min-height: 50px;
        }

        .logo-size {
            max-height: 200px;
            width: auto;
        }

        .activity-icon i {
            font-size: 20px;
        }
    </style>
@endpush

@section('content')
    @if($all_projects->count() > 1)
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="dropdown mb-4">
                    <button class="btn btn-primary dropdown-toggle btn-lg" type="button" data-toggle="dropdown">
                        {{ $project ? 'Project : '.$project->name : 'Select Another Project' }}
                    </button>
                    <div class="dropdown-menu" style="max-height: 500px; min-width: fit-content; overflow-y: auto">
                        @foreach($all_projects as $single_project)
                            <a class="dropdown-item {{ $single_project->id == $project?->id ? 'active' : '' }}" href="{{ route('dashboard.client-index', array_merge(request()->query(), ['project' => $single_project->id])) }}">
                                {{ $single_project->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($project)
        <!-- Main Content -->
        <div class="row">
            @if(!isset($elements[0]['is_enabled']) || $elements[0]['is_enabled'])
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary h-90">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-12 py-3">
                                        <div class="card-content ">
                                            <h5 class="matrix-title">{{ $elements[0]['element_name'] ?? 'Project Completion' }}</h5>
                                        </div>

                                        <div>
                                            <div class="progress-text font-20 font-weight-bold {{ $project->completion_percentage < 50 ? 'col-red' : 'col-green' }}">{{ $project->completion_percentage.'%' }}</div>
                                            <div class="progress mt-2" data-height="6">
                                                <div class="progress-bar {{ $project->completion_percentage < 50 ? 'bg-danger' : 'bg-success' }}" data-width="{{ $project->completion_percentage.'%' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!--            FINAL BUDGET-->
            @if(!isset($elements[1]['is_enabled']) || $elements[1]['is_enabled'])
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary h-90">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row">
                                    <div class="col-12 pt-3">
                                        <div class="card-content">
                                            <h5 class="matrix-title"> {{ $elements[1]['element_name'] ?? 'Project Budget' }} </h5>
                                            <div>
                                                <h2 class="font-18">{{ '$'.(number_format($project->total_budget)) }}</h2>
                                                <p class="col-orange mb-0"><span class="col-orange font-20">{{ abs($project->budget_increament_percentage).'%' }}</span>
                                                    {{ $project->budget_increament_percentage < 0 ? 'Decrease' : 'Increase'}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!--            PAYMENT COMPLETION-->
            @if(!isset($elements[2]['is_enabled']) || $elements[2]['is_enabled'])
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary h-90">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-12 pt-3">
                                        <div class="card-content">
                                            <h5 class="matrix-title"> {{ $elements[2]['element_name'] ?? 'Payments' }} </h5>
                                        </div>
                                        <div>
                                            <h2 class="font-18">{{ '$'.number_format($project->paid_amount) }}</h2>
                                            <p class="mb-0"><span class="col-green font-20">{{ $project->paid_amount_percentage.'%' }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!--         PROJECT TIMELINE-->
        @if(!isset($elements[3]['is_enabled']) || $elements[3]['is_enabled'])
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $elements[3]['element_name'] ?? 'Project Timeline' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 px-5">
                                    @if($project->tasks->count())
                                        <div class="activities">
                                            @foreach($project->tasks->sortBy('estimated_completion_date')->sortBy('estimated_start_date') as $task)
                                                @php
                                                    $status = array_search($task->status, config('app.STATUSES'));
                                                    $status_color = config("app.STATUSES_COLORS.$status");
                                                    $status_icon = config("app.STATUSES_ICONS.$status");
                                                @endphp
                                                <div class="activity">
                                                    <div class="activity-icon text-white {{ 'bg-'.$status_color }} d-flex align-items-center justify-content-center">
                                                        {!! $status_icon !!}
                                                    </div>
                                                    <div class="activity-detail width-per-50">
                                                        <div><p class="{{ 'text-'.$status_color }}">{{ $status }}</p></div>
                                                        <div class="mb-2">
                                                            <span class="text-job">Deadline : {{ $task->estimated_completion_date }} </span>
                                                            {{--                                                <span class="bullet"></span>--}}
                                                            {{--                                                <a class="text-job" href="#">View</a>--}}
                                                        </div>
                                                        <p><h6 class="col-black">{{ $task->name }}</h6></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="font-weight-bold text-center text-muted">No Data Found</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

{{--        Project schedule --}}
        @if(!isset($elements[4]['is_enabled']) || $elements[4]['is_enabled'])
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $elements[4]['element_name'] ?? 'Project Schedule' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="recent-report__chart">
                                @if($project->tasks->count())
                                    <div id="gantt"></div>
                                @else
                                    <div class="font-weight-bold text-center text-muted">No Data Found</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!--          PAYMENT HISTORY-->
        @if(!isset($elements[5]['is_enabled']) || $elements[5]['is_enabled'])
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $elements[5]['element_name'] ?? 'Payment History' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Paid For</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($project->payments->count())
                                            @foreach($project->payments as $payment)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $payment->name }}</td>
                                                    <td>{{ $payment->tasks->pluck('name')->implode(', ') }}</td>
                                                    <td>{{ $payment->date }}</td>
                                                    <td>{{ '$'.number_format($payment->amount) }}</td>
                                                    <td>{{ $payment->payment_method }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="100%" class="text-center text-muted font-weight-bold">No Payment Data Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       @endif

        <!--          TASK DETAILS-->
        @if(!isset($elements[6]['is_enabled']) || $elements[6]['is_enabled'])
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $elements[6]['element_name'] ?? 'Tasks' }} </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Estimated Start Date</th>
                                            <th>Estimated Completion Date</th>
                                            <th>Dependencies</th>
    {{--                                        <th>Action</th>--}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($project->tasks->where('status', '!=', config('app.STATUSES.Canceled'))->count())
                                            @foreach($project->tasks->where('status', '!=', config('app.STATUSES.Canceled')) as $task)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $task->name }}</td>
                                                    <td class="align-middle">
                                                        <div class="progress-text">{{ $task->completion_percentage.'%' }}</div>
                                                        <div class="progress" data-height="6">
                                                            <div class="progress-bar bg-success" data-width="{{ $task->completion_percentage.'%' }}"></div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $task->estimated_start_date }}</td>
                                                    <td>{{ $task->estimated_completion_date }}</td>
                                                    <td>{{ $task->dependentTasks->pluck('name')->implode(', ') }}</td>
    {{--                                                <td><a href="#" class="btn btn-outline-primary">Detail</a></td>--}}
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="100%" class="text-center text-muted font-weight-bold">No Tasks Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       @endif

        <!--          PIE CHART-->
        @if(!isset($elements[7]['is_enabled']) || $elements[7]['is_enabled'])
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $elements[7]['element_name'] ?? 'Pie Chart' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="recent-report__chart">
                                @if($project->payments->count())
                                    <div id="pieChart"></div>
                                @else
                                    <div class="font-weight-bold text-center text-muted">No Data Found</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="text-center">
            <span class="text-muted font-weight-bold">Project Not Found</span>
        </div>
    @endif
@endsection

@push('js')
    <!--  FOR PIE CHART-->
    <script src="{{ asset('assets/bundles/amcharts4/core.js') }}"></script>
    <script src="{{ asset('assets/bundles/amcharts4/charts.js') }}"></script>
    <script src="{{ asset('assets/bundles/amcharts4/animated.js') }}"></script>
    <!--  ION SIGN-->
    <script src="{{ asset('assets/js/page/ion-icons.js') }}"></script>

    <script>
        $(document).ready(function() {
            var tasks = @json($project?->tasks->where('status', '!=', config('app.STATUSES.Canceled')) ?? []);
            var payments = @json($project?->payments ?? []);

            console.log(payments);
            if (tasks.length > 0) {
                ganttChart(tasks);
            }

            if (payments.length > 0) {
                pieChart(payments);
            }
        });

        function ganttChart(tasks) {
            var chartTasks = [];
            tasks.forEach(function (task) {
                chartTasks.push(
                    {
                        id: task.id,
                        name: task.name,
                        start: task.estimated_start_date,
                        end: task.estimated_completion_date,
                        progress: task.completion_percentage,
                        // dependencies: 'Task 2, Task 3',
                        // custom_class: 'bar-milestone' // optional
                    }
                );
            });

            var gantt = new Gantt("#gantt", chartTasks);
            gantt.change_view_mode('Week');
        }

        function pieChart(data) {
            am4core.useTheme(am4themes_animated);
            // Create chart instance
            var chart = am4core.create("pieChart", am4charts.PieChart);

            var chartData = [];
            data.forEach(function (singleData) {
                chartData.push(
                    {
                        "payment": singleData.name,
                        "amount": singleData.amount,
                    }
                );
            });

            // Add data
            chart.data = chartData;

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "amount";
            pieSeries.dataFields.category = "payment";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;
            pieSeries.labels.template.fill = am4core.color("#9aa0ac");

            // This creates initial animation
            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;
        }
    </script>
@endpush
