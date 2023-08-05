@extends('custom-layout.master')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Project</h4>
                </div>
                <div class="card-body">
                    <form id="wizard_with_validation" method="POST">
                        <h3>Project</h3>

                        <fieldset>
                            <h5> <b>Client</b> </h5>

                            <div class="mt-4">
                                <button type="button" class="btn btn-primary d-flex justify-content-start" href="">Add New Client</button>
                            </div>

                            <div class="mt-3 mb-5">
                                <label>Client*</label>
                                <select class="form-control">
                                        @foreach($clients as $client)
                                    <option>{{ $client->name }}</option>
                                        @endforeach

                                </select>
                            </div>

                            <h5> <b>Project</b> </h5>

                            <div class="form-group form-float mt-4">
                                <div class="form-line">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="project_name" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Completion Date*</label>
                                    <input type="date" name="project_estimated_completion_date" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Budget*</label>
                                    <input type="number" name="project_estimated_budget" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="selectgroup w-100">
                                    @foreach(config('app.STATUSES') as $label => $status_id)
                                    <label class="selectgroup-item">
                                        <input type="radio" name="project_status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >
                                        <span class="selectgroup-button">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                        </fieldset>
{{--                        <fieldset>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label"> Client Name*</label>--}}
{{--                                    <input type="text" class="form-control" name="client_name" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Client Email*</label>--}}
{{--                                    <input type="text" class="form-control" name="client_email" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Client Mobile*</label>--}}
{{--                                    <input type="number" class="form-control" name="client_mobile">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Client Password*</label>--}}
{{--                                    <input type="password" class="form-control" name="client_password" id="password" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Company Name</label>--}}
{{--                                    <input type="text" class="form-control" name="client_company_name">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Name*</label>--}}
{{--                                    <input type="text" name="project_name" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Estimated Completion Date*</label>--}}
{{--                                    <input type="date" name="project_estimated_completion_date" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Estimated Budget*</label>--}}
{{--                                    <input type="number" name="project_estimated_budget" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Total Budget*</label>--}}
{{--                                    <input name="project_total_budget" type="text" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Status*</label>--}}
{{--                                    <input  type="text" name="project_status" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="section-title">Select Group Button</div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Button Input</label>--}}
{{--                                <div class="selectgroup w-100">--}}
{{--                                    <label class="selectgroup-item">--}}
{{--                                        <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>--}}
{{--                                        <span class="selectgroup-button">S</span>--}}
{{--                                    </label>--}}
{{--                                    <label class="selectgroup-item">--}}
{{--                                        <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">--}}
{{--                                        <span class="selectgroup-button">M</span>--}}
{{--                                    </label>--}}
{{--                                    <label class="selectgroup-item">--}}
{{--                                        <input type="radio" name="radio1" value="3" class="selectgroup-input-radio">--}}
{{--                                        <span class="selectgroup-button">L</span>--}}
{{--                                    </label>--}}
{{--                                    <label class="selectgroup-item">--}}
{{--                                        <input type="radio" name="radio1" value="4" class="selectgroup-input-radio">--}}
{{--                                        <span class="selectgroup-button">XL</span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </fieldset>--}}
                        <h3>Task</h3>
                        <fieldset>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-nowrap">Name</th>
                                            <th class="text-nowrap">Estimated Start Date</th>
                                            <th class="text-nowrap">Estimated Completion Date</th>
                                            <th class="text-nowrap">Start Date</th>
                                            <th class="text-nowrap">Completion Date</th>
                                            <th class="text-nowrap">Total Budget</th>
                                            <th class="text-nowrap">Status</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Irwansyah Saputra</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                            <td>
                                                <div class="badge badge-success">Active</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Name*</label>--}}
{{--                                    <input type="text" name="task_name" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Estimated Start Date*</label>--}}
{{--                                    <input type="date" name="task_estimated_start_date" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Estimated Completion Date*</label>--}}
{{--                                    <input type="date" name="task_estimated_completion_date" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Start Date*</label>--}}
{{--                                    <input type="date" name="task_start_date" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Completion Date*</label>--}}
{{--                                    <input type="date" name="task_completion_date" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Total Budget*</label>--}}
{{--                                    <input name="task_total_budget" type="text" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Status</label>--}}
{{--                                <div class="selectgroup w-100">--}}
{{--                                    @foreach(config('app.STATUSES') as $label => $status_id)--}}
{{--                                        <label class="selectgroup-item">--}}
{{--                                            <input type="radio" name="radio1" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >--}}
{{--                                            <span class="selectgroup-button">{{ $label }}</span>--}}
{{--                                        </label>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </fieldset>
                        <h3>Payment</h3>
                        <fieldset>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-nowrap">Name</th>
                                            <th class="text-nowrap">Amount</th>
                                            <th class="text-nowrap">Date</th>
                                            <th class="text-nowrap">Payment Method</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Irwansyah Saputra</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Name*</label>--}}
{{--                                    <input type="text" name="name" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Amount*</label>--}}
{{--                                    <input type="text" name="amount" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Date*</label>--}}
{{--                                    <input type="date" name="date" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Payment Date*</label>--}}
{{--                                    <input type="date" name="payment_date" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </fieldset>
                        <h3>Inspection</h3>
                        <fieldset>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th class="text-nowrap">Name</th>
                                            <th class="text-nowrap">Schedule Date</th>
                                            <th class="text-nowrap">Date</th>
                                            <th class="text-nowrap">Status</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Irwansyah Saputra</td>
                                            <td>2017-01-09</td>
                                            <td>2017-01-09</td>
                                            <td>
                                                <div class="badge badge-success">Active</div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Name*</label>--}}
{{--                                    <input type="text" name="inspection_name" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Schedule Date*</label>--}}
{{--                                    <input type="date" name="inspection_schedule_date" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Date*</label>--}}
{{--                                    <input type="date" name="inspection_date" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="form-label">Status</label>--}}
{{--                                <div class="selectgroup w-100">--}}
{{--                                    @foreach(config('app.STATUSES') as $label => $status_id)--}}
{{--                                        <label class="selectgroup-item">--}}
{{--                                            <input type="radio" name="radio1" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >--}}
{{--                                            <span class="selectgroup-button">{{ $label }}</span>--}}
{{--                                        </label>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('assets/bundles/jquery-steps/jquery.steps.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/form-wizard.js') }}"></script>
@endpush

