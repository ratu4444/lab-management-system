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

        <!-- Main Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-primary h-90">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-12 py-3">
                                    <div class="card-content ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="matrix-title"><input type="text" name="project_completion_name" class="border-0" value="name"></h5>

                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-secondary active btn-sm">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> Show
                                                </label>
                                                <label class="btn btn-secondary btn-sm">
                                                    <input type="radio" name="options" id="option2" autocomplete="off"> Hide
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="progress-text font-20 font-weight-bold col-green">50%</div>
                                        <div class="progress mt-2" data-height="6">
                                            <div class="progress-bar bg-success" data-width="50%"></div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">--}}
                                {{--                                    <div class="banner-img">--}}
                                {{--                                        <img src="{{ asset('assets/img/banner/3.png') }}" alt="">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            FINAL BUDGET-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-primary h-90">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-12 pt-3">
                                    <div class="card-content">
                                        <h5 class="matrix-title"><h4><input type="text" class="border-0" name="project_budget_name"></h4></h5>
                                        <div>
                                            <h2 class="font-18">$50000</h2>
                                            <p class="col-orange mb-0"><span class="col-orange font-20">50%</span>
                                                Increase
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">--}}
                                {{--                                    <div class="banner-img">--}}
                                {{--                                        <img src="{{ asset('assets/img/banner/4.png') }}" alt="">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--            PAYMENT COMPLETION-->
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-primary h-90">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-12 pt-3">
                                    <div class="card-content">
                                        <h5 class="matrix-title"><h4><input type="text" name="payment_completion_name " class="border-0"></h4></h5>
                                    </div>
                                    <div>
                                        <h2 class="font-18">$25000</h2>
                                        <p class="mb-0"><span class="col-green font-20">50%</span></p>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">--}}
                                {{--                                    <div class="banner-img">--}}
                                {{--                                        <img src="{{ asset('assets/img/banner/4.png') }}" alt="">--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
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
                        <h4><input type="text" name="project_timeline_name" class="border-0"></h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 px-5">
                                <div class="activities">
                                    @foreach(config('app.STATUSES') as $status => $value)
                                        @php
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
                                                    <span class="text-job">Deadline : 2023-06-15 </span>
                                                </div>
                                                <p><h6 class="col-black"> Demolition</h6></p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--        Project schedule --}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                <div class="card">
                    <div class="card-header"><h4><h4><input type="text" name="project_schedule_name" class="border-0"></h4></h4></div>
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
                        <h4><h4><input type="text" name="payment_name" class="border-0"></h4></h4>
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
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Payment 1</td>
                                        <td>Demoliation</td>
                                        <td>2023-06-15</td>
                                        <td>25000</td>
                                        <td>Paypal</td>
                                    </tr>
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
                        <h4><h4><input type="text" name="task_details_name" class="border-0"></h4></h4>
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
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Project</td>
                                        <td class="align-middle">
                                            <div class="progress-text">Active</div>
                                            <div class="progress" data-height="6">
                                                <div class="progress-bar bg-success" data-width="50%"></div>
                                            </div>
                                        </td>
                                        <td>2023-03-15</td>
                                        <td>2023-09-15</td>
                                        <td>Dependency</td>
                                    </tr>
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
                    <div class="card-header"><h4><h4><input type="text" name="pie_chart_name" class="border-0"></h4></h4></div>
                    <div class="card-body">
                        <div class="recent-report__chart">
                            <div id="pieChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            var tasks = [
                {
                    id : 1,
                    name : 'task one',
                    estimated_start_date : '2023-05-01',
                    estimated_completion_date : '2023-05-07',
                    completion_percentage : 65,
                },
                {
                    id : 2,
                    name : 'task two',
                    estimated_start_date : '2023-05-08',
                    estimated_completion_date : '2023-05-14',
                    completion_percentage : 75,
                },
                {
                    id : 3,
                    name : 'task three',
                    estimated_start_date : '2023-05-15',
                    estimated_completion_date : '2023-05-21',
                    completion_percentage : 85,
                },
                {
                    id : 4,
                    name : 'task four',
                    estimated_start_date : '2023-05-22',
                    estimated_completion_date : '2023-05-28',
                    completion_percentage : 95,
                },
            ];
            var payments = [
                {
                    name : 'payment one',
                    amount : 5000,
                },
                {
                    name : 'payment second',
                    amount : 7000,
                },
                {
                    name : 'payment Three',
                    amount : 9000,
                },
                {
                    name : 'payment Four',
                    amount : 11000,
                }

            ];

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
                        "amount": singleData.name,
                        "payment": singleData.amount,
                    }
                );
            });

            console.log(chartData);

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
