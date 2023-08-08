<div class="modal fade" id="inspectionCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inspection Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('inspection.store', $project->id) }}" method="post">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Schedule Date*</label>
                            <input type="date" name="scheduled_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Date</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <label>Dependency*</label>
                        <select class="form-control selectric" name="dependencies[]" multiple="">
                            @if(count($project->tasks))
                                @foreach($project->tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group form-float">
                        <label class="form-label">Status</label>
                        <div class="selectgroup w-100">
                            @foreach(config('app.STATUSES') as $label => $status_id)
                                @php
                                    $status_color = config("app.STATUSES_COLORS.$label");
                                @endphp
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >
                                    <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Comment</label>
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>
