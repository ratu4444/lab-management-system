@extends('custom-layout.master')
@section('title', 'Edit Task')

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
                        <form method="POST" action="{{ route('task.update', [$project->id, $task->id]) }}" class="needs-validation" novalidate>
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $task->name }}" class="form-control" required>

                                    <div class="invalid-feedback">
                                        Task name is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label">Estimated Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="estimated_start_date" value="{{ $task->estimated_start_date }}" class="form-control" id="estimated_start_date" min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}"   required>

                                    <div class="invalid-feedback">
                                        Estimated start date is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label">Estimated Completion Date <span class="text-danger">*</span></label>
                                    <input type="date" name="estimated_completion_date" value="{{ $task->estimated_completion_date }}"  class="form-control" id="estimated_completion_date"  min="{{ \Carbon\Carbon::now()->addDays(2)->toDateString() }}" required>

                                    <div class="invalid-feedback">
                                        Estimated completion date must be after estimated start date
                                    </div>
                                </div>
{{--                                Changes--}}
{{--                                <div class="form-group col-12 col-md-6">--}}
{{--                                    <label class="form-label">Start Date</label>--}}
{{--                                    <input type="text" name="start_date" value="{{ $task->start_date }}" class="form-control datepicker" id="start_date">--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-12 col-md-6">--}}
{{--                                    <label class="form-label">Completion Date</label>--}}
{{--                                    <input type="text" name="completion_date" value="{{ $task->completion_date }}"  class="form-control datepicker" id="completion_date">--}}

{{--                                    <div class="invalid-feedback">--}}
{{--                                        Completion date must be after Start date--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-12 col-md-6">--}}
{{--                                    <label class="form-label">Budget <span class="text-danger">*</span></label>--}}
{{--                                    <input name="total_budget" type="number" value="{{ $task->total_budget}}" class="form-control" min="0" required>--}}

{{--                                    <div class="invalid-feedback">--}}
{{--                                        Budget is required--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-12 col-md-6">--}}
{{--                                    <label> Dependency</label>--}}
{{--                                    <select class="form-control selectric" name="dependencies[]" id="taskDependencyDropdown" multiple="">--}}
{{--                                        @foreach($project->tasks->where('id', '!=', $task->id) as $project_task)--}}
{{--                                            <option value="{{ $project_task->id }}" {{ in_array( $project_task->id, $task->dependent_task_ids,) ? 'selected' : '' }}>{{ $project_task->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-12 col-md-6">--}}
{{--                                    <label class="form-label">Status</label>--}}
{{--                                    <div class="selectgroup w-100">--}}
{{--                                        @foreach(config('app.STATUSES') as $label => $status_id)--}}
{{--                                            @php--}}
{{--                                                $status_color = config("app.STATUSES_COLORS.$label");--}}
{{--                                            @endphp--}}
{{--                                            <label class="selectgroup-item">--}}
{{--                                                <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == $task->status ? 'checked' : ''}} >--}}
{{--                                                <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>--}}
{{--                                            </label>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--    --}}{{--                                <div class="form-group">--}}
{{--    --}}{{--                                    <label class="form-label">Comment</label>--}}
{{--    --}}{{--                                    <textarea name="comment" class="form-control">{{ $task->comment }}</textarea>--}}
{{--    --}}{{--                                </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-12 col-md-6">--}}
{{--                                    <label class="form-label">Completion Percentage</label>--}}
{{--                                    <input name="completion_percentage" type="number" class="form-control" id="completion_percentage" value="{{ $task->completion_percentage }}" min="0" max="100">--}}

{{--                                    <div class="invalid-feedback">--}}
{{--                                        Completion percentage must be between 0-100--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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

    <script>
        $(document).ready(function() {
            $('#estimated_start_date, #estimated_completion_date').on('change', function () {
                var startElement = $('#estimated_start_date');
                var endElement = $('#estimated_completion_date');

                validateDates(startElement, endElement);
            });

            $('#start_date, #completion_date').on('change', function () {
                var startElement = $('#start_date');
                var endElement = $('#completion_date');

                validateDates(startElement, endElement);
            });

            $('input[name="status"]').on('change', function() {
                var statusValue = $(this).val();
                var percentageElement = $('#completion_percentage');
                var configStatuses = @json(config('app.STATUSES'));

                modifyCompletionPercentage(statusValue, percentageElement, configStatuses);
            });

            selectButtonBgChange('.selectgroup-input-radio');
        });
    </script>
@endpush


