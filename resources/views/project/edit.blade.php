@extends('custom-layout.master')
@section('title', 'Edit Project')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Project Edit</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('project.update', $project->id) }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="form-label" for="estimated_budget"> Estimated Budget
                                        <span class="text-danger">*</span></label>
                                    <input type="number" name="estimated_budget" class="form-control" value="{{ $project->estimated_budget }}" id="estimated_budget" min="1" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="name">Project Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $project->name }}" id="name" required>
                                </div>

                                <div class="form-group col-12 col-12 col-md-6">
                                    <label class="form-label" for="estimated_completion_date">Estimated Completion Date
                                        <span class="text-danger">*</span></label>
                                    <input type="text" name="estimated_completion_date" value="{{ $project->estimated_completion_date }}" class="form-control datepicker"
                                           id="estimated_completion_date" required>
                                </div>

                                <div class="selectgroup w-100 flex-wrap col-12">
                                    @foreach(config('app.STATUSES') as $label => $status_id)
                                        @php
                                            $status_color = config("app.STATUSES_COLORS.$label");
                                        @endphp
                                        <label class="selectgroup-item">
                                            <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio"  {{ $status_id == $project->status ? 'checked' : '' }}>
                                            <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <code class="mx-2 font-weight-bold" id="statusAlert"></code>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>

    <script>
        $(document).ready(function() {
            var statusRadio = $('input[name="status"]');
            var statusAlert = $('#statusAlert');
            var hasRunningTask = @json($project->has_running_task);

            statusRadio.on('change', function() {
                if (this.value == 3 && hasRunningTask) {
                    statusAlert.text('FYI : All tasks are not completed yet.');
                } else {
                    statusAlert.text('');
                }
            });
        });
    </script>
@endpush
