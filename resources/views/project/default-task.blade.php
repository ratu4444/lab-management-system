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
                            <div id="defaultTaskSection">
                                @foreach($default_tasks as $index => $default_task)
                                    <div class="d-flex align-items-center task-container">
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
                                                <input type="text" name="tasks[{{ $index }}][name]" class="form-control" value="{{ $default_task->name }}" required>

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
                                                <input name="tasks[{{ $index }}][total_budget]" type="number" class="form-control" value="{{ $default_task->budget ?? 1 }}" min="1" required>

                                                <div class="invalid-feedback">
                                                    Budget is required
                                                </div>
                                            </div>
                                            <input type="hidden" name="tasks[{{ $index }}][status]" value="{{ $default_task->status }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-between">
                            <button class="btn btn-primary" id="addNewTaskButton">Add New Tasks</button>
                            <button type="submit" class="btn btn-primary">Next</button>
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
        $('#addNewTaskButton').click(function(e) {
            e.preventDefault();
            var taskContainers = $('.task-container'); // Get all task containers
            var totalContainers = taskContainers.length;

            var taskContainer = taskContainers.first(); // Assuming there's only one task container template
            var clonedTask = taskContainer.clone();

            // Clear input values in the cloned task
            clonedTask.find('input[type="text"], input[type="number"]').val('');

            // Update the index in the cloned task's name attributes
            clonedTask.find('input[type="text"]').each(function(index, element) {
                var nameAttr = $(element).attr('name');
                var newNameAttr = nameAttr.replace(/\[\d+\]/g, '[' + totalContainers + ']');
                $(element).attr('name', newNameAttr);
            });

            // Append the cloned task after the form
            $('#defaultTaskSection').append(clonedTask);
        });
    </script>
@endpush
