@extends('custom-layout.master')
@section('title', 'Project Payment')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Payments</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentCreateModal">Add New Payment</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Amount</th>
                        <th class="text-nowrap">Date</th>
                        <th class="text-nowrap">Payment Method</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($project->payments))
                        @foreach($project->payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>{{ '$'.number_format($payment->amount) }}</td>
                                <td>{{ $payment->date}}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Payment Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary" href="{{ route('task.create', $project->id) }}">Previous</a>
                    <a class="btn btn-primary" href="{{ route('inspection.create', $project->id) }}">Next</a>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('project.index') }}" class="d-flex align-items-center text-muted font-15 font-weight-bold">
        <i class="far fa-arrow-alt-circle-left font-25 mr-2"></i>
        Back to Project List
    </a>
@endsection

@section('modal')
    @include('custom-layout.modal.payment-modal')
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush
