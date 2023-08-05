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
                        <h3>User</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name*</label>
                                    <input type="text" class="form-control" name="user_name" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Email*</label>
                                    <input type="text" class="form-control" name="email" required>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Mobile*</label>
                                    <input type="number" class="form-control" name="mobile">
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Password*</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Company Name*</label>
                                    <input type="text" class="form-control" name="company_name">
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <div class="form-label">Is Client*</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                        <span class="custom-switch-indicator d-flex justify-content-start"></span>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <h3>Project</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="project_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Completion Date*</label>
                                    <input type="date" name="project_estimated_completion_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Budget*</label>
                                    <input type="number" name="project_estimated_budget" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Total Budget*</label>
                                    <input name="project_total_budget" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Status*</label>
                                    <input  type="text" name="project_status" class="form-control" required>
                                </div>
                            </div>
                        </fieldset>
                        <h3>Task</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="task_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Start Date*</label>
                                    <input type="date" name="task_estimated_start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Completion Date*</label>
                                    <input type="date" name="task_estimated_completion_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Start Date*</label>
                                    <input type="date" name="task_start_date" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Completion Date*</label>
                                    <input type="date" name="task_completion_date" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Total Budget*</label>
                                    <input name="task_total_budget" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Status*</label>
                                    <input  type="textr" name="task_status" class="form-control" required>
                                </div>
                                <div class="help-info">The warning step will show up if age is less than 18</div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Completion Percentage*</label>
                                    <input type="number" name="completion_percentage" min="0" max="100" class="form-control"  required>
                                </div>
                            </div>
                        </fieldset>
                        <h3>Payment</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Amount*</label>
                                    <input type="text" name="amount" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date*</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Payment Date*</label>
                                    <input type="date" name="payment_date" class="form-control" required>
                                </div>
                            </div>
                        </fieldset>
                        <h3>Inspection</h3>
                        <fieldset>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name*</label>
                                    <input type="text" name="inspection_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Schedule Date*</label>
                                    <input type="date" name="inspection_schedule_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date*</label>
                                    <input type="date" name="inspection_date" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Status*</label>
                                    <input type="text" name="inspection_status" class="form-control" required>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/form-wizard.js') }}"></script>
@endpush

