@extends('custom-layout.master')
@section('title', 'Project Inspection')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Inspections</h4>
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#inspectionCreateModal">Add New Inspection</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Scheduled Date</th>
                            <th class="text-nowrap">Inspection Date</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($project->inspections))
                            @foreach($project->inspections as $inspection)
                                @php
                                    $status = array_search($inspection->status, config('app.STATUSES'));
                                    $status_color = config("app.STATUSES_COLORS.$status")
                                @endphp
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $inspection->name }}</td>
                                    <td>{{ $inspection->scheduled_date}}</td>
                                    <td>{{ $inspection->date}}</td>
                                    <td>
                                        <div class="badge {{ 'badge-'.$status_color }}">{{ $status }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('inspection.edit', $inspection->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="100%" class="text-center text-muted font-weight-bold">No Task Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary" href="{{ route('payment.create', $project->id) }}">Previous</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('modal')
    @include('custom-layout.modal.inspection-modal')
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>
@endpush
