@extends('custom-layout.master')
@section('title', 'Client Dashboard Settings')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/ionicons/css/ionicons.min.css') }}">
    <script src="{{ asset('js/frappe-gantt.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/frappe-gantt.css') }}">

    <style>
        .matrix-title {
            min-height: 70px;
        }

        .matrix-body {
            min-height: 70px;
        }

        .logo-size {
            max-height: 200px;
            width: auto;
        }

        .activity-icon i {
            font-size: 20px;
        }

        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        input[type="text"] {
            border: 1px dashed #ddd !important;
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
                            <a class="dropdown-item {{ $single_project->id == $project?->id ? 'active' : '' }}" href="{{ route('settings.element', array_merge(request()->query(), ['project' => $single_project->id])) }}">
                                {{ $single_project->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($project)
        <form action="{{ route('settings.element.store', $project->id) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary h-90">
                        <div class="card-statistic-4">
                            <div class="matrix-title">
                                <div class="form-row">
                                    <div class="col-7">
                                        <input type="text" name="elements[0][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[0]['element_name'] ?? 'Project Completion' }}" required>
                                    </div>
                                    <div class="col-5 text-right">
                                        <div class="selectgroup">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[0][is_enabled]" value="1" class="enabled-select-0 selectgroup-input-radio" {{ !isset($elements[0]['is_enabled']) || $elements[0]['is_enabled'] ? 'checked' : '' }}>
                                                <span class="selectgroup-button" data-class="bg-success">Show</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[0][is_enabled]" value="0" class="enabled-select-0 selectgroup-input-radio" {{ !isset($elements[0]['is_enabled']) || $elements[0]['is_enabled'] ? '' : 'checked' }}>
                                                <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="matrix-body">
                                <div class="progress-text font-20 font-weight-bold col-green">50%</div>
                                <div class="progress mt-2" data-height="6">
                                    <div class="progress-bar bg-success" data-width="50%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--            FINAL BUDGET-->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary h-90">
                        <div class="card-statistic-4">
                            <div class="matrix-title">
                                <div class="form-row">
                                    <div class="col-7">
                                        <input type="text" name="elements[1][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[1]['element_name'] ?? 'Project Budget' }}" required>
                                    </div>
                                    <div class="col-5 text-right">
                                        <div class="selectgroup">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[1][is_enabled]" value="1" class="enabled-select-1 selectgroup-input-radio" {{ !isset($elements[1]['is_enabled']) || $elements[1]['is_enabled'] ? 'checked' : '' }}>
                                                <span class="selectgroup-button" data-class="bg-success">Show</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[1][is_enabled]" value="0" class="enabled-select-1 selectgroup-input-radio" {{ !isset($elements[1]['is_enabled']) || $elements[1]['is_enabled'] ? '' : 'checked' }}>
                                                <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="matrix-body">
                                <h2 class="font-18">$50,000</h2>
                                <p class="col-orange mb-0"><span class="col-orange font-20">50%</span>
                                    Increase
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--            PAYMENT COMPLETION-->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary h-90">
                        <div class="card-statistic-4">
                            <div class="matrix-title">
                                <div class="form-row">
                                    <div class="col-7">
                                        <input type="text" name="elements[2][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[2]['element_name'] ?? 'Payments' }}" required>
                                    </div>
                                    <div class="col-5 text-right">
                                        <div class="selectgroup">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[2][is_enabled]" value="1" class="enabled-select-2 selectgroup-input-radio" {{ !isset($elements[2]['is_enabled']) || $elements[2]['is_enabled'] ? 'checked' : '' }}>
                                                <span class="selectgroup-button" data-class="bg-success">Show</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[2][is_enabled]" value="0" class="enabled-select-2 selectgroup-input-radio" {{ !isset($elements[2]['is_enabled']) || $elements[2]['is_enabled'] ? '' : 'checked' }}>
                                                <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="matrix-body">
                                <h2 class="font-18">$25,000</h2>
                                <p class="mb-0"><span class="col-green font-20">50%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--         PROJECT TIMELINE-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-block">
                            <div class="form-row">
                                <div class="col-8">
                                    <input type="text" name="elements[3][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[3]['element_name'] ?? 'Project Timeline' }}" required>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="selectgroup">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[3][is_enabled]" value="1" class="enabled-select-3 selectgroup-input-radio" {{ !isset($elements[3]['is_enabled']) || $elements[3]['is_enabled'] ? 'checked' : '' }}>
                                            <span class="selectgroup-button" data-class="bg-success">Show</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[3][is_enabled]" value="0" class="enabled-select-3 selectgroup-input-radio" {{ !isset($elements[3]['is_enabled']) || $elements[3]['is_enabled'] ? '' : 'checked' }}>
                                            <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                                                    <p><h6 class="col-black">Task {{ $value }}</h6></p>
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
                        <div class="card-header d-block">
                            <div class="form-row">
                                <div class="col-8">
                                    <input type="text" name="elements[4][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[4]['element_name'] ?? 'Project Schedule' }}" required>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="selectgroup">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[4][is_enabled]" value="1" class="enabled-select-4 selectgroup-input-radio" {{ !isset($elements[4]['is_enabled']) || $elements[4]['is_enabled'] ? 'checked' : '' }}>
                                            <span class="selectgroup-button" data-class="bg-success">Show</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[4][is_enabled]" value="0" class="enabled-select-4 selectgroup-input-radio" {{ !isset($elements[4]['is_enabled']) || $elements[4]['is_enabled'] ? '' : 'checked' }}>
                                            <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <div class="card-header d-block">
                            <div class="form-row">
                                <div class="col-8">
                                    <input type="text" name="elements[5][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[5]['element_name'] ?? 'Payment History' }}" required>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="selectgroup">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[5][is_enabled]" value="1" class="enabled-select-5 selectgroup-input-radio" {{ !isset($elements[5]['is_enabled']) || $elements[5]['is_enabled'] ? 'checked' : '' }}>
                                            <span class="selectgroup-button" data-class="bg-success">Show</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[5][is_enabled]" value="0" class="enabled-select-5 selectgroup-input-radio" {{ !isset($elements[5]['is_enabled']) || $elements[5]['is_enabled'] ? '' : 'checked' }}>
                                            <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                                            <td>Task 1</td>
                                            <td>2023-06-15</td>
                                            <td>$25,000</td>
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
                        <div class="card-header d-block">
                            <div class="form-row">
                                <div class="col-8">
                                    <input type="text" name="elements[6][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[6]['element_name'] ?? 'Tasks' }}" required>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="selectgroup">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[6][is_enabled]" value="1" class="enabled-select-6 selectgroup-input-radio" {{ !isset($elements[6]['is_enabled']) || $elements[6]['is_enabled'] ? 'checked' : '' }}>
                                            <span class="selectgroup-button" data-class="bg-success">Show</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="elements[6][is_enabled]" value="0" class="enabled-select-6 selectgroup-input-radio" {{ !isset($elements[6]['is_enabled']) || $elements[6]['is_enabled'] ? '' : 'checked' }}>
                                            <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                                            <td>task 1</td>
                                            <td class="align-middle">
                                                <div class="progress" data-height="6">
                                                    <div class="progress-bar bg-success" data-width="50%"></div>
                                                </div>
                                            </td>
                                            <td>2023-03-15</td>
                                            <td>2023-09-15</td>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>task 2</td>
                                            <td class="align-middle">
                                                <div class="progress" data-height="6">
                                                    <div class="progress-bar bg-success" data-width="50%"></div>
                                                </div>
                                            </td>
                                            <td>2023-03-15</td>
                                            <td>2023-09-15</td>
                                            <td>task 1</td>
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
                        <div class="card-header d-block">
                            <div class="form-row">
                                <div class="col-8">
                                    <input type="text" name="elements[7][element_name]" class="border-0 form-control p-0 font-20" value="{{ $elements[7]['element_name'] ?? 'Pie Chart' }}" required>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="form-group">
                                        <div class="selectgroup">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[7][is_enabled]" value="1" class="enabled-select-7 selectgroup-input-radio" {{ !isset($elements[7]['is_enabled']) || $elements[7]['is_enabled'] ? 'checked' : '' }}>
                                                <span class="selectgroup-button" data-class="bg-success">Show</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="elements[7][is_enabled]" value="0" class="enabled-select-7 selectgroup-input-radio" {{ !isset($elements[7]['is_enabled']) || $elements[7]['is_enabled'] ? '' : 'checked' }}>
                                                <span class="selectgroup-button" data-class="bg-danger">Hide</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="recent-report__chart">
                                <div id="pieChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="floating-button">
                <button type="submit" class="btn btn-warning btn-lg mb-3 shadow-lg">Update Dashboard</button>
            </div>
        </form>
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
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>

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

            selectButtonBgChange('.enabled-select-0');
            selectButtonBgChange('.enabled-select-1');
            selectButtonBgChange('.enabled-select-2');
            selectButtonBgChange('.enabled-select-3');
            selectButtonBgChange('.enabled-select-4');
            selectButtonBgChange('.enabled-select-5');
            selectButtonBgChange('.enabled-select-6');
            selectButtonBgChange('.enabled-select-7');
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
                        "amount": singleData.amount,
                        "payment": singleData.name,
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
