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
                <form class="" action="{{ route('payment.store', $project_id) }}" method="post">
                    @csrf
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
                            <input type="text" name="payment_method" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label>Payment For*</label>
                        <select class="form-control selectric" name="payment_for" multiple="">
                            @if(count($tasks))
                                @foreach($tasks as $task)
                                    <option>{{ $task }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Comment</label>
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>
