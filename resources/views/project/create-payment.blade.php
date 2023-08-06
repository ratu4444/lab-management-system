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
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Amount</th>
                        <th class="text-nowrap">Date</th>
                        <th class="text-nowrap">Payment Method</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Irwansyah Saputra</td>
                        <td>2017-01-09</td>
                        <td>2017-01-09</td>
                        <td>2017-01-09</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
