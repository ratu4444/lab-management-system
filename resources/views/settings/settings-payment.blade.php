@extends('custom-layout.master')
@section('title', 'Default Payments')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Default Payments</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentCreateModal">Add More Default Payments</button>
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
                            <th class="text-nowrap">Is Enabled?</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($settings_payments))
                            @foreach($settings_payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->name }}</td>
                                    <td>{{ '$'.number_format($payment->amount) }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>
                                        <div class="badge {{ $payment->is_enabled ? 'badge-success' : 'badge-danger' }}">{{ $payment->is_enabled ? 'Yes' : 'No' }}</div>
                                    </td>
                                    <td><a class="btn btn-primary" href="{{ route('settings.payment.edit', $payment->id) }}">Edit</a></td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="100%" class="text-center text-muted font-weight-bold">No Default Payment Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
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
                    <form action="{{ route('settings.payment.store') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>

                            <div class="invalid-feedback">
                                Payment name is required
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount" class="form-control" min="1" required>

                            <div class="invalid-feedback">
                                Amount is required
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <input type="text" name="payment_method" class="form-control" required>

                            <div class="invalid-feedback">
                                Payment method is required
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_enabled" value="1" class="enabled-select selectgroup-input-radio" checked>
                                    <span class="selectgroup-button" data-class="bg-success">Enabled</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_enabled" value="0" class="enabled-select selectgroup-input-radio">
                                    <span class="selectgroup-button" data-class="bg-danger">Disabled</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"> Create Default Payment </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>

    <script>
        $(document).ready(function() {
            selectButtonBgChange('.enabled-select');
        });
    </script>
@endpush

