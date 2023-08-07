@extends('custom-layout.master')

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div><h3>Payment</h3></div>

            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskCreateModal">Add New Payment</button>
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
{{--                    @if(count($task->payments))--}}
{{--                        @foreach($task->payments as $payment)--}}
                            <tr>
{{--                                <td>{{ $loop->iteration }}</td>--}}
{{--                                <td>{{ $task->name }}</td>--}}
{{--                                <td>{{ $task->estimated_start_date }}</td>--}}
{{--                                <td>{{ $task->estimated_completion_date }}</td>--}}
{{--                                <td>{{ $task->total_budget }}</td>--}}
{{--                                <td>--}}
{{--                                    <div class="badge badge-success">{{ $task->status }}</div>--}}
{{--                                </td>--}}
                            </tr>
{{--                        @endforeach--}}
{{--                    @else--}}
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Task Found</td>
                        </tr>
{{--                    @endif--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('custom-layout.modal.create-payment')
@endsection
