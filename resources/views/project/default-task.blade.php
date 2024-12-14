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
                            <div id="taskContainer">
                                @forelse($default_tasks as $index => $default_task)
                                    <div class="d-flex align-items-center task-element">
                                        <div class="pretty p-icon p-smooth">
                                            <input type="checkbox" name="tasks[{{ $index }}][checked]" class="task-checkbox" checked/>
                                            <div class="state p-success">
                                                <i class="icon material-icons">done</i>
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row w-100 task-input">
                                            <div class="form-group col-4">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="tasks[{{ $index }}][name]" class="form-control" value="{{ $default_task->name }}" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Task name is required
                                                </div>
                                            </div>
                                            <div class="form-group col-4">
                                                <label class="form-label">Estimated Start Date <span class="text-danger">*</span></label>
                                                <input type="date" name="tasks[{{ $index }}][estimated_start_date]" class="form-control" data-required="true"  min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" required>

                                                <div class="invalid-feedback">
                                                    Estimated start date is required
                                                </div>
                                            </div>
                                            <div class="form-group col-4">
                                                <label class="form-label">Estimated Completion Date <span class="text-danger">*</span></label>
                                                <input type="date" name="tasks[{{ $index }}][estimated_completion_date]" class="form-control" data-required="true"  min="{{ \Carbon\Carbon::now()->addDays(2)->toDateString() }}" required>

                                                <div class="invalid-feedback">
                                                    Estimated completion date must be after estimated start date
                                                </div>
                                            </div>
{{--                                            Changes--}}
{{--                                            <div class="form-group col-3">--}}
{{--                                                <label class="form-label">Budget <span class="text-danger">*</span></label>--}}
{{--                                                <input name="tasks[{{ $index }}][total_budget]" type="number" class="form-control" value="{{ $default_task->budget ?? 1 }}" min="0" data-required="true" required>--}}

{{--                                                <div class="invalid-feedback">--}}
{{--                                                    Budget is required--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                @empty
                                    <div class="d-flex align-items-center task-element">
                                        <div class="pretty p-icon p-smooth">
                                            <input type="checkbox" name="tasks[0][checked]" class="task-checkbox" checked/>
                                            <div class="state p-success">
                                                <i class="icon material-icons">done</i>
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row w-100 task-input">
                                            <div class="form-group col-3">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="tasks[0][name]" class="form-control" value="" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Task name is required
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label class="form-label">Estimated Start Date <span class="text-danger">*</span></label>
                                                <input type="text" name="tasks[0][estimated_start_date]" class="form-control datepicker" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Estimated start date is required
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label class="form-label">Estimated Completion Date <span class="text-danger">*</span></label>
                                                <input type="text" name="tasks[0][estimated_completion_date]" class="form-control datepicker" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Estimated completion date must be after estimated start date
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label class="form-label">Budget <span class="text-danger">*</span></label>
                                                <input name="tasks[0][total_budget]" type="number" class="form-control" value="" min="0" data-required="true" required>

                                                <div class="invalid-feedback">
                                                    Budget is required
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

{{--                                Changes--}}
                            <div class="d-flex justify-content-end">
{{--                                <a href="javascript:void(0)" class="btn btn-primary" id="addMoreButton">Add New Tasks</a>--}}
                                <div>
{{--                                    Changes--}}
{{--                                    <a href="{{ route('project.default-payment', $project->id) }}" class="btn btn-secondary mr-3">Skip</a>--}}
                                    <button type="submit" class="btn btn-success">Submit And Go Next</button>
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
            cloneField('.task-element', '.task-input', '#taskContainer');
        });

        $(document).on('change', '.task-checkbox',function() {
            checkboxAction($(this), '.task-element', '.task-input');
        });
    </script>
@endpush
