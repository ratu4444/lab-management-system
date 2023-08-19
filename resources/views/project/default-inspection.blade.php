@extends('custom-layout.master')
@section('title', 'Add Default Inspection')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/pretty-checkbox/pretty-checkbox.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Add Default Inspections</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('project.default-inspection.store', $project->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @foreach($default_inspections as $index => $default_inspection)
                                <div class="d-flex align-items-center">
                                    <div class="pretty p-icon p-smooth">
                                        <input type="checkbox" name="inspections[{{ $index }}][checked]" checked/>
                                        <div class="state p-success">
                                            <i class="icon material-icons">done</i>
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row w-100">
                                        <div class="form-group col-6">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="inspections[{{ $index }}][name]" class="form-control" value="{{ $default_inspection->name }}" style="pointer-events: none" readonly required>

                                            <div class="invalid-feedback">
                                                Inspection name is required
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label class="form-label">Scheduled Date <span class="text-danger">*</span></label>
                                            <input type="text" name="inspections[{{ $index }}][scheduled_date]" class="form-control datepicker" required>

                                            <div class="invalid-feedback">
                                                Scheduled Date is required
                                            </div>
                                        </div>
                                        <input type="hidden" name="inspections[{{ $index }}][status]" value="{{ $default_inspection->status }}">
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">Add Inspections</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush
