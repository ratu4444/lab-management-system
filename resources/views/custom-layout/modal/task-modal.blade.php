<div class="modal fade" id="taskCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Task Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="w-100" method="post" action="{{ route('task.store', $project->id) }}">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Estimated Start Date*</label>
                            <input type="date" name="estimated_start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Estimated Completion Date*</label>
                            <input type="date" name="estimated_completion_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Budget*</label>
                            <input name="total_budget" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label> Dependency*</label>
                        <select class="form-control selectric" name="dependencies[]" id="taskDependencyDropdown" multiple="">
                            @if(count($project->tasks))
                                @foreach($project->tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group form-flat">
                        <label class="form-label">Status</label>
                        <div class="selectgroup w-100">
                            @foreach(config('app.STATUSES') as $label => $status_id)
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >
                                    <span class="selectgroup-button">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label class="form-label">Comment</label>
                                <textarea name="comment" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>
