<div class="modal fade" id="clientCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-muted">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="clientCreateForm" action="{{ route('api.store-client') }}" method="post">
                    @csrf
                    <meta name="access-token" content="{{ $access_token }}">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label class="form-label" for="client_name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="client_name" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="mobile">Mobile</label>
                            <input type="tel" class="form-control" name="mobile" id="mobile">
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="company_name">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="clientCreateButton">Create Client</button>
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
                <form class="w-100" method="post" action="{{ route('api.store-task') }}">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Estimated Start Date*</label>
                            <input type="date" name="estimated_start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Estimated Completion Date*</label>
                            <input type="date" name="estimated_completion_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Budget*</label>
                            <input name="total_budget" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label> Dependency*</label>
                            <select class="form-control selectric" id="taskDependencyDropdown" multiple="">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                                <option>Option 4</option>
                                <option>Option 5</option>
                                <option>Option 6</option>
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
                            <label class="form-label">Name</label>
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
                            <label class="form-label">Payment Method*</label>
                            <input type="date" name="payment_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label>Payment For*</label>
                        <select class="form-control selectric" multiple="">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                            <option>Option 6</option>
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
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
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
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label>Dependency*</label>
                        <select class="form-control selectric" multiple="">
                            <option>Option 1</option>
                            <option>Option 2</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                            <option>Option 6</option>
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
