@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">

@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><h3>Payment</h3></div>

            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentCreateModal">Add
                    New Payment
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
                        <th class="text-nowrap">Date</th>
                        <th class="text-nowrap">Payment Method</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($payments))
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->amount}}</td>
                                <td>{{  $payment->date}}</td>
                                <td>{{  $payment->payment_method }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Task Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary" href="{{ route('inspection.create', $project_id) }}">Next</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('custom-layout.modal.payment-modal')
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endpush
