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
                            @foreach($default_payments as $index => $default_payment)
                                <div class="d-flex align-items-center">
                                    <div class="pretty p-icon p-smooth">
                                        <input type="checkbox" name="payments[{{ $index }}][checked]" checked/>
                                        <div class="state p-success">
                                            <i class="icon material-icons">done</i>
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row w-100">
                                        <div class="form-group col-4">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="payments[{{ $index }}][name]" class="form-control" value="{{ $default_payment->name }}" style="pointer-events: none" readonly required>

                                            <div class="invalid-feedback">
                                                Payment name is required
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-label">Date <span class="text-danger">*</span></label>
                                            <input type="text" name="payments[{{ $index }}][date]" class="form-control datepicker" required>

                                            <div class="invalid-feedback">
                                                Date is required
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-label">Amount <span class="text-danger">*</span></label>
                                            <input name="payments[{{ $index }}][amount]" type="number" class="form-control bg-light" value="{{ $default_payment->amount ?? 1 }}" min="1" required>

                                            <div class="invalid-feedback">
                                                Amount is required
                                            </div>
                                        </div>
                                        <input type="hidden" name="payments[{{ $index }}][payment_method]" value="{{ $default_payment->payment_method }}">
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">Add Payments</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush
