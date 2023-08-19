@extends('custom-layout.master')
@section('title', 'Add Default Task')

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
                        <h4 class="card-title text-muted">Add Default Tasks</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('project.default-task.store', $project->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @foreach($default_tasks as $index => $default_task)
                                <div class="d-flex align-items-center">
                                    <div class="pretty p-icon p-smooth">
                                        <input type="checkbox" name="tasks[{{ $index }}][checked]" checked/>
                                        <div class="state p-success">
                                            <i class="icon material-icons">done</i>
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="form-row w-100">
                                        <div class="form-group col-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" name="tasks[{{ $index }}][name]" class="form-control" value="{{ $default_task->name }}" style="pointer-events: none" readonly required>

                                            <div class="invalid-feedback">
                                                Task name is required
                                            </div>
                                        </div>
                                        <div class="form-group col-3">
                                            <label class="form-label">Estimated Start Date <span class="text-danger">*</span></label>
                                            <input type="text" name="tasks[{{ $index }}][estimated_start_date]" class="form-control datepicker" required>

                                            <div class="invalid-feedback">
                                                Estimated start date is required
                                            </div>
                                        </div>
                                        <div class="form-group col-3">
                                            <label class="form-label">Estimated Completion Date <span class="text-danger">*</span></label>
                                            <input type="text" name="tasks[{{ $index }}][estimated_completion_date]" class="form-control datepicker" required>

                                            <div class="invalid-feedback">
                                                Estimated completion date must be after estimated start date
                                            </div>
                                        </div>
                                        <div class="form-group col-3">
                                            <label class="form-label">Budget <span class="text-danger">*</span></label>
                                            <input name="tasks[{{ $index }}][total_budget]" type="number" class="form-control bg-light" value="{{ $default_task->budget ?? 1 }}" min="1" required>

                                            <div class="invalid-feedback">
                                                Budget is required
                                            </div>
                                        </div>
                                        <input type="hidden" name="tasks[{{ $index }}][status]" value="{{ $default_task->status }}">
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">Add Tasks</button>
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
