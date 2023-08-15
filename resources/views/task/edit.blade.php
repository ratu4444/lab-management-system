@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">

@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Task Edit</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('task.update', $task->id) }}">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $task->name }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Start Date*</label>
                                    <input type="date" name="estimated_start_date" value="{{ $task->estimated_start_date }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Estimated Completion Date*</label>
                                    <input type="date" name="estimated_completion_date" value="{{ $task->estimated_completion_date }}"  class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Budget*</label>
                                    <input name="total_budget" type="text" value="{{ $task->total_budget}}" class="form-control" required>
                                </div>
                            </div>
{{--                                                                @dd($task_dependency)--}}
                            <div class="form-group form-float">
                                <label> Dependency</label>
                                <select class="form-control selectric" name="dependencies[]" id="taskDependencyDropdown" multiple="">
                                    @if(count($project_tasks))
                                        @foreach($project_tasks as $project_task)
                                                    <option value="{{ $project_task->id }}" {{ in_array( $project_task->id, $task->dependent_task_ids,) ? 'selected' : '' }}>{{ $project_task->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group form-flat">
                                <label class="form-label">Status</label>
                                <div class="selectgroup w-100">
                                    @foreach(config('app.STATUSES') as $label => $status_id)
                                        @php
                                            $status_color = config("app.STATUSES_COLORS.$label");
                                        @endphp
                                        <label class="selectgroup-item">
                                            <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == $task->status ? 'checked' : ''}} >
                                            <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label class="form-label">Comment</label>
                                        <textarea name="comment" class="form-control">{{ $task->comment }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>
@endpush


