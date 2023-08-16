<div class="modal fade" id="taskCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('task.store', $project->id) }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>

                        <div class="invalid-feedback">
                            Task name is required
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Estimated Start Date <span class="text-danger">*</span></label>
                        <input type="text" name="estimated_start_date" class="form-control datepicker" id="estimated_start_date" required>

                        <div class="invalid-feedback">
                            Estimated start date is required
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Estimated Completion Date <span class="text-danger">*</span></label>
                        <input type="text" name="estimated_completion_date" class="form-control datepicker" id="estimated_completion_date" required>

                        <div class="invalid-feedback">
                            Estimated completion date must be after estimated start date
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Budget <span class="text-danger">*</span></label>
                        <input name="total_budget" type="number" class="form-control" min="1" required>

                        <div class="invalid-feedback">
                            Budget is required
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Dependency</label>
                        <select class="form-control selectric" name="dependencies[]" id="taskDependencyDropdown" multiple="">
                            @if(count($project->tasks))
                                @foreach($project->tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="selectgroup w-100">
                            @foreach(config('app.STATUSES') as $label => $status_id)
                                @php
                                    $status_color = config("app.STATUSES_COLORS.$label");
                                @endphp
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}}>
                                    <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label">Comment</label>--}}
{{--                            <textarea name="comment" class="form-control"></textarea>--}}
{{--                        </div>--}}
                    </div>
                    <div class="form-group">
                        <label class="form-label">Completion Percentage</label>
                        <input name="completion_percentage" type="number" class="form-control" id="completion_percentage" min="0" max="100">

                        <div class="invalid-feedback">
                            Completion percentage must be between 0-100
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Task</button>
                </form>
            </div>
        </div>
    </div>
</div>
