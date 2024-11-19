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
                            <div id="inspectionContainer">
                                @forelse($default_inspections as $index => $default_inspection)
                                    <div class="d-flex align-items-center inspection-element">
                                        <div class="pretty p-icon p-smooth">
                                            <input type="checkbox" name="inspections[{{ $index }}][checked]" class="inspection-checkbox" checked/>
                                            <div class="state p-success">
                                                <i class="icon material-icons">done</i>
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row w-100 inspection-input">
                                            <div class="form-group col-6">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="inspections[{{ $index }}][name]" class="form-control" value="{{ $default_inspection->name }}" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Inspection name is required
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="form-label">Scheduled Date <span class="text-danger">*</span></label>
                                                <input type="text" name="inspections[{{ $index }}][scheduled_date]" class="form-control datepicker" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Scheduled Date is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="d-flex align-items-center inspection-element">
                                        <div class="pretty p-icon p-smooth">
                                            <input type="checkbox" name="inspections[0][checked]" class="inspection-checkbox" checked/>
                                            <div class="state p-success">
                                                <i class="icon material-icons">done</i>
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row w-100 inspection-input">
                                            <div class="form-group col-6">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="inspections[0][name]" class="form-control" value="" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Inspection name is required
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label class="form-label">Scheduled Date <span class="text-danger">*</span></label>
                                                <input type="text" name="inspections[0][scheduled_date]" class="form-control datepicker" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Scheduled Date is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="javascript:void(0)" class="btn btn-primary" id="addMoreButton">Add New Inspections</a>
                                <div>
                                    <a href="{{ route('task.index', $project->id) }}" class="btn btn-secondary mr-3">Skip</a>
                                    <button type="submit" class="btn btn-success">Finish</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script>
        $('#addMoreButton').click(function(e) {
            e.preventDefault();
            cloneField('.inspection-element', '.inspection-input', '#inspectionContainer');
        });

        $(document).on('change', '.inspection-checkbox',function() {
            checkboxAction($(this), '.inspection-element', '.inspection-input');
        });
    </script>
@endpush
