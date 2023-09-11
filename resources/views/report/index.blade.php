@extends('custom-layout.master')
@section('title', 'Reports')

@push('css')
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title text-muted">{{ $project->name }} : Reports</h4>
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportCreateModal">Add New Report</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-nowrap">Name</th>
                                    <th class="text-nowrap">Created Time</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($reports))
                                    @foreach($reports as $report)
                                        <tr>
                                            <th scope="row">{{ (($reports->currentpage()-1) * $reports->perpage()) + $loop->index + 1 }}</th>
                                            <td class="text-nowrap">{{ $report->name }}</td>

                                            <td class="text-nowrap">
                                                <a href="" class="btn btn-warning btn-sm">View</a>
                                                <a href="{{ route('report.edit', [$project->id, $report->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted font-weight-bold">No Report Found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $reports->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('custom-layout.modal.report-modal')
@endsection
