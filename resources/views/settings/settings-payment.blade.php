@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><h3>Payment</h3></div>

            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentCreateModal">Add Settings Payment
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Amount</th>
                        <th class="text-nowrap">Payment Method</th>
                        <th class="text-nowrap">Comment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($payment_show))
                        @foreach($payment_show as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->amount}}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->comment }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Settings Payment Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endpush

<div class="modal fade" id="paymentCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('settings.payment.store') }}" method="post">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Amount*</label>
                            <input type="text" name="amount"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Payment Method*</label>
                            <input type="text" name="payment_method" class="form-control" required>
                        </div>
                    </div>
                    {{--                            <div class="form-group form-float">--}}
                    {{--                                <label>Payment For</label>--}}
                    {{--                                <select class="form-control selectric" name="tasks[]" multiple="">--}}
                    {{--                                    @if(count($payment_task)) @endif--}}
                    {{--                                    @foreach($payment_task as $payment_for)--}}
                    {{--                                        <option value="{{ $payment_for->id }}"  {{ in_array($payment_for->id , $payment->dependent_payment_ids) ? 'selected' : '' }}>{{ $payment_for->name }}</option>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </select>--}}
                    {{--                            </div>--}}
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

