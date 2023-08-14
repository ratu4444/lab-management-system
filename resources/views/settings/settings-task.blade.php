@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Tasks</h4>
            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskCreateModal">Add Settings Task
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Budget</th>
                        <th class="text-nowrap">Comment</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($task_show))
                        @foreach($task_show as $task)
                            @php
                                $status = array_search($task->status, config('app.STATUSES'));
                                $status_color = config("app.STATUSES_COLORS.$status")
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->name }}</td>
                                <td>
                                    <div class="badge {{ 'badge-'.$status_color }}">{{ $status }}</div>
                                </td>
                                <td>{{ $task->budget }}</td>
                                <td>{{ $task->comment }}</td>
{{--                                <td class="text-nowrap">--}}
{{--                                    <a href="{{ route('task.edit', $task->id) }}" class="btn btn-primary btn-sm" target="_blank">Edit</a>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Settings Task Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>
@endpush

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
                <form method="POST" action="{{ route('settings.task.store') }}">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name"  class="form-control" required>
                        </div>
                    </div>
{{--                    <div class="form-group form-float">--}}
{{--                        <div class="form-line">--}}
{{--                            <label class="form-label">Estimated Start Date*</label>--}}
{{--                            <input type="date" name="estimated_start_date"  class="form-control" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group form-float">--}}
{{--                        <div class="form-line">--}}
{{--                            <label class="form-label">Estimated Completion Date*</label>--}}
{{--                            <input type="date" name="estimated_completion_date"  class="form-control" required>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Budget*</label>
                            <input name="total_budget" type="number" class="form-control" required>
                        </div>
                    </div>
                    {{--                            @dd($task_dependency)--}}
                    {{--                            <div class="form-group form-float">--}}
                    {{--                                <label> Dependency</label>--}}
                    {{--                                <select class="form-control selectric" name="dependencies[]" id="taskDependencyDropdown" multiple="">--}}
                    {{--                                    @if(count($project_tasks))--}}
                    {{--                                        @foreach($project_tasks as $project_task)--}}
                    {{--                                            <option value="{{ $project_task->id }}" {{ in_array( $project_task->id, $task->dependent_task_ids,) ? 'selected' : '' }}>{{ $project_task->name }}</option>--}}
                    {{--                                        @endforeach--}}
                    {{--                                    @endif--}}
                    {{--                                </select>--}}
                    {{--                            </div>--}}
                    <div class="form-group form-flat">
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

