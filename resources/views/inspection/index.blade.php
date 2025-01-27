@extends('custom-layout.master')
@section('title', 'Project Inspection')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">{{ $project->name }} : Inspections</h4>
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
                            <th class="text-nowrap">Inspected Date</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($inspections))
                            @foreach($inspections as $inspection)
                                @php
                                    $status = array_search($inspection->status, config('app.STATUSES'));
                                    $status_color = config("app.STATUSES_COLORS.$status")
                                @endphp
                                <tr>
                                    <th scope="row">{{ (($inspections->currentpage()-1) * $inspections->perpage()) + $loop->index + 1 }}</th>
                                    <td>{{ $inspection->name }}</td>
                                    <td>{{ $inspection->scheduled_date}}</td>
                                    <td>{{ $inspection->date}}</td>
                                    <td>
                                        <div class="badge {{ 'badge-'.$status_color }}">{{ $status }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('inspection.edit', [$project->id, $inspection->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="100%" class="text-center text-muted font-weight-bold">No Inspection Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $inspections->links() }}
            </div>
            <div class="d-flex justify-content-start">
                <a class="btn btn-primary" href="{{ route('payment.index', $project->id) }}">Previous</a>
            </div>
        </div>
    </div>

    <a href="{{ route('dashboard.client-index', ['project' => $project->id]) }}" class="d-flex align-items-center text-muted font-15 font-weight-bold">
        <i class="far fa-arrow-alt-circle-left font-25 mr-2"></i>
        Back to Project Dashboard
    </a>
@endsection

@section('modal')
    @include('custom-layout.modal.inspection-modal')
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>

    <script>
        $(document).ready(function() {
            selectButtonBgChange('.selectgroup-input-radio');
        });
    </script>
@endpush
