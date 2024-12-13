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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title text-muted">Add Default Tasks</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskCreateModal">Add More Default Tasks</button>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('project.default-task.store', $project->id) }}" method="post" class="needs-validation" novalidate    >
                            @csrf
                            <div id="taskContainer">
                                @foreach($default_tasks as $index => $default_task)
                                    <div class="d-flex align-items-center task-element">
                                        <div class="pretty p-icon p-smooth">
                                            <input type="checkbox" name="tasks[{{ $index }}][checked]" class="task-checkbox" checked/>
                                            <div class="state p-success">
                                                <i class="icon material-icons">done</i>
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="form-row w-100 task-input">
                                            <div class="form-group col-6">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="tasks[{{ $index }}][name]" class="form-control" value="{{ $default_task->name }}" data-required="true" readonly required>

                                                <div class="invalid-feedback">
                                                    Task name is required
                                                </div>
                                            </div>
{{--                                            <div class="form-group col-4">--}}
{{--                                                <label class="form-label">Estimated Start Date <span class="text-danger">*</span></label>--}}
{{--                                                <input type="hidden" name="tasks[{{ $index }}][estimated_start_date]" value="{{ \Carbon\Carbon::today()->toDateString() }}" required>--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    Estimated start date is required--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="form-group col-6">
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
{{--                                @empty--}}
{{--                                    <div class="d-flex align-items-center task-element">--}}
{{--                                        <div class="pretty p-icon p-smooth">--}}
{{--                                            <input type="checkbox" name="tasks[0][checked]" class="task-checkbox" checked/>--}}
{{--                                            <div class="state p-success">--}}
{{--                                                <i class="icon material-icons">done</i>--}}
{{--                                                <label></label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-row w-100 task-input">--}}
{{--                                            <div class="form-group col-3">--}}
{{--                                                <label class="form-label">Name <span class="text-danger">*</span></label>--}}
{{--                                                <input type="text" name="tasks[0][name]" class="form-control" value="" data-required="true" required>--}}

{{--                                                <div class="invalid-feedback">--}}
{{--                                                    Task name is required--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            Changes--}}
{{--                                            <div class="form-group col-3">--}}
{{--                                                <label class="form-label">Estimated Start Date <span class="text-danger">*</span></label>--}}
{{--                                                <input type="text" name="tasks[0][estimated_start_date]" class="form-control datepicker" data-required="true" required>--}}

{{--                                                <div class="invalid-feedback">--}}
{{--                                                    Estimated start date is required--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="form-group col-3">--}}
{{--                                                <label class="form-label">Estimated Completion Date <span class="text-danger">*</span></label>--}}
{{--                                                <input type="text" name="tasks[0][estimated_completion_date]" class="form-control datepicker" data-required="true" required>--}}

{{--                                                <div class="invalid-feedback">--}}
{{--                                                    Estimated completion date must be after estimated start date--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                           Changes --}}
{{--                                            <div class="form-group col-3">--}}
{{--                                                <label class="form-label">Budget <span class="text-danger">*</span></label>--}}
{{--                                                <input name="tasks[0][total_budget]" type="number" class="form-control" value="" min="0" data-required="true" required>--}}

{{--                                                <div class="invalid-feedback">--}}
{{--                                                    Budget is required--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                --}}
                                @endforeach
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
@section('modal')
    <div class="modal fade" id="taskCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Default Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('settings.task.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>

                            <div class="invalid-feedback">
                                Task name is required
                            </div>
                        </div>
                        {{--                        Changes--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="form-label">Budget <span class="text-danger">*</span></label>--}}
                        {{--                            <input name="total_budget" type="number" class="form-control" min="0" required>--}}

                        {{--                            <div class="invalid-feedback">--}}
                        {{--                                Budget is required--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <label class="form-label">Status</label>--}}
                        {{--                            <div class="selectgroup w-100">--}}
                        {{--                                @foreach(config('app.STATUSES') as $label => $status_id)--}}
                        {{--                                    @php--}}
                        {{--                                        $status_color = config("app.STATUSES_COLORS.$label");--}}
                        {{--                                    @endphp--}}
                        {{--                                    <label class="selectgroup-item">--}}
                        {{--                                        <input type="radio" name="status" value="{{ $status_id }}" class="status-select selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}}>--}}
                        {{--                                        <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>--}}
                        {{--                                    </label>--}}
                        {{--                                @endforeach--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="form-group">
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_enabled" value="1" class="enabled-select selectgroup-input-radio" checked>
                                    <span class="selectgroup-button" data-class="bg-success">Enabled</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_enabled" value="0" class="enabled-select selectgroup-input-radio">
                                    <span class="selectgroup-button" data-class="bg-danger">Disabled</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"> Create Default Task </button>
                    </form>
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
