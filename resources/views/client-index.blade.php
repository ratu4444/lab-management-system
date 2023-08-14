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
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="dropdown mb-4">
                <button class="btn btn-primary dropdown-toggle btn-lg" type="button" id="projectSelectButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $project ? 'Project : '.$project->name : 'Select Another Project' }}
                </button>
                <div class="dropdown-menu" aria-labelledby="projectSelectButton">
                    @foreach($all_projects as $single_project)
                        <a class="dropdown-item {{ $single_project->id == $project?->id ? 'active' : '' }}" href="{{ route('dashboard.client-index', ['project' => $single_project->id]) }}">
                            {{ $single_project->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($project)
        <!-- Main Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card h-90">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content ">
                                        <h5 class="font-15 matrix-title"> Project Completion </h5>
                                    </div>
                                    <div>
                                        <h2 class="font-18"></h2>
                                    </div>
                                    <div class="progress-text font-20 font-weight-bold {{ $project->completion_percentage < 50 ? 'col-red' : 'col-green' }}">{{ $project->completion_percentage.'%' }}</div>
                                    <div class="progress mt-2" data-height="6">
                                        <div class="progress-bar {{ $project->completion_percentage < 50 ? 'bg-danger' : 'bg-success' }}" data-width="{{ $project->completion_percentage.'%' }}"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/3.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            FINAL BUDGET-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card h-90">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15 matrix-title">Final Budget</h5>
                                        <div>
                                            <h2 class="font-18">{{ '$'.(number_format($project->total_budget ?? $project->estimated_budget)) }}</h2>
                                            <p class="col-orange mb-0"><span class="col-orange font-20">{{ abs($project->budget_increament_percentage).'%' }}</span>
                                                {{ $project->budget_increament_percentage < 0 ? 'Decrease' : 'Increase'}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/4.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            PAYMENT COMPLETION-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card h-90">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content ">
                                        <h5 class="font-15 matrix-title">Payment Completion</h5>
                                    </div>
                                    <div>
                                        <h2 class="font-18">{{ '$'.number_format($project->paid_amount) }}</h2>
                                        <p class="mb-0"><span class="col-green font-20">{{ $project->paid_amount_percentage.'%' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="{{ asset('assets/img/banner/4.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                <div class="card">
                    <div class="card-header"><h4>Gantt Chart</h4></div>
                    <div class="card-body">
                        <div class="recent-report__chart">
                            <div id="gantt"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--          PAYMENT HISTORY-->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Payment History</h4>
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
                                                <td>{{ $payment->dependentTasks->pluck('name')->implode(', ') }}</td>
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

        <!--          TASK DETAILS-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tasks</h4>
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
                                    @if($project->tasks->count())
                                        @foreach($project->tasks as $task)
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

        <!--          PIE CHART-->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                <div class="card">
                    <div class="card-header"><h4>Pie Chart</h4></div>
                    <div class="card-body">
                        <div class="recent-report__chart">
                            <div id="pieChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--         PROJECT TIMELINE-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Project Timeline</h4>
                    </div>
                    <div class="card-body"></div>

                    <div class="ml-5 mb-4"><h5>Project Name</h5></div>
                    <div class="row">
                        <div class="col-12 px-5">
                            <div class="activities">

                                <!--                FIRST ACTIVITY-->
                                <div class="activity">
                                    <div class="activity-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="activity-detail width-per-50">
                                        <div>
                                            <p class="text-success">Completed</p>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-job ">Deadline 2023-08-12 </span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#">View</a>
                                        </div>
                                        <p><b class="col-black">Contract Review.</b><a href="#"></a></p>
                                    </div>
                                </div>

                                <!--                  SECOND ACTIVITY-->
                                <div class="activity">
                                    <div class="activity-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="activity-detail width-per-50">
                                        <div>
                                            <p class="text-success">Completed</p>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-job ">Deadline 2023-08-15</span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#">View</a>
                                        </div>
                                        <p><b class="col-black">Mobilization.</b><a href="#"></a></p>
                                    </div>
                                </div>

                                <!--               THIRD ACTIVITY-->
                                <div class="activity">
                                    <div class="activity-icon bg-orange text-white">
                                        <i class="ion-android-checkmark-circle"></i>
                                    </div>
                                    <div class="activity-detail width-per-50">
                                        <div>
                                            <p class="col-orange">In Progress</p>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-job ">Deadline 2023-08-19</span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#">View</a>
                                        </div>
                                        <p><b class="col-black">Demolition.</b><a href="#"></a></p>
                                    </div>
                                </div>

                                <!--                  FOURTH ACTIVITY-->
                                <div class="activity">
                                    <div class="activity-icon bg-orange text-white">
                                        <i class="ion-android-checkmark-circle"></i>
                                    </div>
                                    <div class="activity-detail width-per-50">
                                        <div>
                                            <p class="col-orange">In Progress</p>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-job ">Deadline 2023-08-31</span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#">View</a>
                                        </div>
                                        <p><b class="col-black">Earth Work.</b><a href="#"></a></p>
                                    </div>
                                </div>

                                <!--                  FIFTH ACTIVITY-->
                                <div class="activity">
                                    <div class="activity-icon bg-danger text-white">
                                        <i class="ion-android-time"></i>
                                    </div>
                                    <div class="activity-detail width-per-50">
                                        <div>
                                            <p class="text-danger">Pending</p>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-job ">Deadline 2023-08-26</span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#">View</a>
                                        </div>
                                        <p><b class="col-black">Utility Connections.</b><a href="#"></a></p>
                                    </div>
                                </div>

                                <!--                  SIXTH ACTIVITY-->
                                <div class="activity">
                                    <div class="activity-icon bg-danger text-white">
                                        <i class="ion-android-time"></i>
                                    </div>
                                    <div class="activity-detail width-per-50">
                                        <div>
                                            <p class="text-danger">Pending</p>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-job ">Deadline 2023-09-15</span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#">View</a>
                                        </div>
                                        <p><b class="col-black">Concrete.</b><a href="#"></a></p>
                                    </div>
                                </div>

                                <!--                  SEVENT ACTIVITY-->
                                <div class="activity">
                                    <div class="activity-icon bg-danger text-white">
                                        <b class="ion-android-time"></b>
                                    </div>
                                    <div class="activity-detail width-per-50">
                                        <div>
                                            <p class="text-danger">Pending</p>
                                        </div>
                                        <div class="mb-2">
                                            <span class="text-job ">Deadline 2023-09-30</span>
                                            <span class="bullet"></span>
                                            <a class="text-job" href="#">View</a>
                                        </div>
                                        <p><b class="col-black">Framing.</b><a href="#"></a></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            var tasks = @json($project?->tasks ?? []);

            ganttChart(tasks);
            pieChart(tasks);
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

        function pieChart(tasks) {
            am4core.useTheme(am4themes_animated);

            // Create chart instance
            var chart = am4core.create("pieChart", am4charts.PieChart);

            var chartTasks = [];
            tasks.forEach(function (task) {
                chartTasks.push(
                    {
                        "task": task.name,
                        "budget": task.total_budget,
                    }
                );
            });

            console.log(chartTasks);

            // Add data
            chart.data = chartTasks;

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "budget";
            pieSeries.dataFields.category = "task";
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
