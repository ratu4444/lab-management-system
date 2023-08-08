@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">

@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h3>Inspection</h3>
            </div>
            <div>
                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#inspectionCreateModal">
                    Add New Inspection
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Scheduled Date</th>
                        <th class="text-nowrap">Date</th>
                        <th class="text-nowrap">Status</th>
                    </tr>
                    <tr>
                    @if(count($project->inspections))
                        @foreach($project->inspections as $inspection)
                            @php
                                $status = array_search($inspection->status, config('app.STATUSES'));
                                $status_color = config("app.STATUSES_COLORS.$status")
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inspection->name }}</td>
                                <td>{{ $inspection->scheduled_date}}</td>
                                <td>{{  $inspection->date}}</td>
                                <td>
                                    <div class="badge {{ 'badge-'.$status_color }}">{{ $status }}</div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Task Found</td>
                        </tr>
                    @endif
                </table>
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
@endpush
