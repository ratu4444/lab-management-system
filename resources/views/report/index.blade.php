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
                                    <th class="text-nowrap">Status</th>
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
                                            <td>
                                                <div class="badge {{ $report->is_active ? 'badge-success' : 'badge-danger' }}">{{ $report->is_active ? 'Visible' : 'Hidden' }}</div>
                                            </td>
                                            <td class="text-nowrap">{{ $report->created_at }}</td>
                                            <td class="text-nowrap d-flex align-items-center">
                                                <button type="button" class="btn btn-primary btn-sm mx-1 pdfViewerBtn" data-title="{{ $report->name }}" data-file-path="{{ $report->file_path }}" data-file-type="{{ $report->file_type }}">View Report</button>
                                                @if ($report->created_by == auth()->id())
                                                    <a href="{{ route('report.edit', [$project->id, $report->id]) }}" class="btn btn-warning btn-sm mx-1">Edit Report</a>
                                                    <form action="{{ route('report.toggle-visibility', [$project->id, $report->id]) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm mx-1 {{ $report->is_active ? 'btn-info' : 'btn-success' }}">{{ $report->is_active ? 'Hide from Client' : 'Visible to Client' }}</button>
                                                    </form>
                                                    <form action="{{ route('report.destroy', [$project->id, $report->id]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger }}">Delete</button>
                                                    </form>
                                                @endif
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
    @include('custom-layout.modal.pdf-modal')
@endsection

@push('js')
    <script>
        $('.pdfViewerBtn').click(function () {
            var title = $(this).data('title');
            var path = $(this).data('file-path');
            var type = $(this).data('file-type');

            var pdfContainer = "<object data='"+path+"' type='"+type+"' class='rounded border-0 w-100' style='height:80vh'>";

            var pdfViewModal = $('#pdfViewModal');
            pdfViewModal.find('.modal-title').text(title);
            pdfViewModal.find('.modal-body').html(pdfContainer);

            pdfViewModal.modal('show');
        });
    </script>
@endpush
