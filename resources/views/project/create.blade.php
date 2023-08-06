@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/prism/prism.css') }}">
@endpush

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
                                <button type="button" class="btn btn-primary d-flex justify-content-start" data-toggle="modal" data-target="#clientCreateModal">Add New Client</button>
                            </div>
                            <div class="mt-3 mb-5">
                                <label>Client*</label>
                                <select class="form-control" id="clientDropdown">
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h5> <b>Project</b> </h5>
                            <div class="form-group form-float mt-4">
                                <div class="form-line">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="project_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Completion Date*</label>
                                    <input type="date" name="project_estimated_completion_date" class="form-control" required >
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Budget*</label>
                                    <input type="number" name="project_estimated_budget" class="form-control" required>
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

                        <h3>Task</h3>
                        <fieldset>
                            <div class="mt-4">
                                <button type="button" class="btn btn-primary d-flex justify-content-start" data-toggle="modal" data-target="#taskCreateModal">Add New Task</button>
                            </div>
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

                        </fieldset>
                        <h3>Payment</h3>
                        <fieldset>
                            <div class="mt-4">
                                <button type="button" class="btn btn-primary d-flex justify-content-start" data-toggle="modal" data-target="#paymentCreateModal">Add New Payment</button>
                            </div>
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
                        </fieldset>
                        <h3>Inspection</h3>
                        <fieldset>
                            <div class="mt-4">
                                <button type="button" class="btn btn-primary d-flex justify-content-start" data-toggle="modal" data-target="#inspectionCreateModal">Add New Inspection</button>
                            </div>
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
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--    MODAL--}}

@endsection

@section('modal')
    @include('custom-layout.create-modal')
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('assets/bundles/jquery-steps/jquery.steps.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/form-wizard.js') }}"></script>
    <script src="{{ asset('assets/bundles/prism/prism.js') }}"></script>

    <script src="{{ asset('js/form-submission.js') }}"></script>
@endpush

