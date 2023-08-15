@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">

@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Payment Edit</h4>
                    </div>
                    <div class="card-body">
                        <form class="" action="{{ route('payment.update', $payment->id) }}" method="post">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $payment->name }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Amount*</label>
                                    <input type="text" name="amount" value="{{ $payment->amount }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date*</label>
                                    <input type="date" name="date" value="{{ $payment->date }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Payment Method*</label>
                                    <input type="text" name="payment_method" value="{{ $payment->payment_method }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label>Payment For</label>
                                <select class="form-control selectric" name="tasks[]" multiple="">
                                    @foreach($project_tasks as $task)
                                        <option value="{{ $task->id }}"  {{ in_array($task->id , $payment->dependent_payment_ids) ? 'selected' : '' }}>{{ $task->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Comment</label>
                                    <textarea name="comment" class="form-control">{{ $payment->comment }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/form-submission.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>
@endpush


