<div class="modal fade" id="clientCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Client Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="">
                <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name*</label>
                            <input type="text" class="form-control" name="client_name" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Email*</label>
                            <input type="text" class="form-control" name="client_email" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Mobile*</label>
                            <input type="tel" class="form-control" name="client_mobile">
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Password*</label>
                            <input type="password" class="form-control" name="client_password" id="password" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="client_company_name">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="taskCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="w-100">
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
                        <label>Client*</label>
                        <select class="form-control">
{{--                            @foreach($clients as $client)--}}
                                <option>Dependency</option>
{{--                            @endforeach--}}
                        </select>
                    </div>
                    <div class="form-group form-flat">
                        <label class="form-label">Status</label>
                        <div class="selectgroup w-100">
                            @foreach(config('app.STATUSES') as $label => $status_id)
                                <label class="selectgroup-item">
                                    <input type="radio" name="radio1" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >
                                    <span class="selectgroup-button">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="paymentCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Paymet Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="">
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
                    <div class="form-group form-float">
                        <label>Client*</label>
                        <select class="form-control">
                            {{--                            @foreach($clients as $client)--}}
                            <option>Dependency</option>
                            {{--                            @endforeach--}}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inspectionCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inspection Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="">
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
                        <label>Client*</label>
                        <select class="form-control">
                            {{--                            @foreach($clients as $client)--}}
                            <option>Dependency</option>
                            {{--                            @endforeach--}}
                        </select>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Status</label>
                        <div class="selectgroup w-100">
                            @foreach(config('app.STATUSES') as $label => $status_id)
                                <label class="selectgroup-item">
                                    <input type="radio" name="radio1" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >
                                    <span class="selectgroup-button">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>
