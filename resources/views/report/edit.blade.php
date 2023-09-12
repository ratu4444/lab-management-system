@extends('custom-layout.master')
@section('title', 'Edit Report')

@push('css')
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title text-muted">Edit Report</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('report.update', [$report->project_id, $report->id]) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ $report->name }}" required>

                                <div class="invalid-feedback">
                                    Report name is required
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">File</label>
                                <input type="file" name="file" class="form-control">
                                <code>Leave it blank if not want to change</code>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Report</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
