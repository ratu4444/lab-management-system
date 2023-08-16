<div class="modal fade" id="paymentCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payment.store', $project->id) }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>

                            <div class="invalid-feedback">
                                Payment name is required
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" min="1" required>

                            <div class="invalid-feedback">
                                Amount is required
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="text" name="date" class="form-control datepicker" required>

                            <div class="invalid-feedback">
                                Payment date is required
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <input type="text" name="payment_method" class="form-control" required>

                            <div class="invalid-feedback">
                                Payment method is required
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label>Payment For</label>
                        <select class="form-control selectric" name="tasks[]" multiple="">
                            @foreach($project->tasks as $task)
                                <option value="{{ $task->id }}" >{{ $task->name }}</option>
                            @endforeach
                        </select>
                    </div>

{{--                    <div class="form-group form-float">--}}
{{--                        <div class="form-line">--}}
{{--                            <label class="form-label">Comment</label>--}}
{{--                            <textarea name="comment" class="form-control"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <button type="submit" class="btn btn-primary">Create Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>
