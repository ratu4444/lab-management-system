@extends('custom-layout.master')
@section('title', 'Add Default Payment')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Add Default Payments</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('project.default-payment.store', $project->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div id="paymentContainer">
                                @foreach($default_payments as $index => $default_payment)
                                    <div class="d-flex align-items-center payment-element">
                                        <div class="pretty p-icon p-smooth">
                                            <input type="checkbox" name="payments[{{ $index }}][checked]" class="payment-checkbox" checked/>
                                            <div class="state p-success">
                                                <i class="icon material-icons">done</i>
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row w-100 payment-input">
                                            <div class="form-group col-3">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="payments[{{ $index }}][name]" class="form-control" value="{{ $default_payment->name }}" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Payment name is required
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label class="form-label">Date <span class="text-danger">*</span></label>
                                                <input type="text" name="payments[{{ $index }}][date]" class="form-control datepicker" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Date is required
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label class="form-label">Amount <span class="text-danger">*</span></label>
                                                <input name="payments[{{ $index }}][amount]" type="number" class="form-control" value="{{ $default_payment->amount ?? 1 }}" min="1" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Amount is required
                                                </div>
                                            </div>

                                            <div class="form-group col-3">
                                                <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                                                <input name="payments[{{ $index }}][payment_method]" type="text" class="form-control" value="{{ $default_payment->payment_method }}" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Payment Method is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="javascript:void(0)" class="btn btn-primary" id="addMoreButton">Add New Payments</a>
                                <div>
                                    <a href="{{ route('project.default-inspection', $project->id) }}" class="btn btn-secondary mr-3">Skip</a>
                                    <button type="submit" class="btn btn-success">Submit And Go Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script>
        $('#addMoreButton').click(function(e) {
            e.preventDefault();
            cloneField('.payment-element', '.payment-input', '#paymentContainer');
        });

        $(document).on('change', '.payment-checkbox',function() {
            checkboxAction($(this), '.payment-element', '.payment-input');
        });
    </script>
@endpush
