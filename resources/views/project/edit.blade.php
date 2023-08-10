@extends('custom-layout.master')

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
                        <form method="POST" action="">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="form-label" for="estimated_budget"> Estimated Budget
                                        <span class="text-danger">*</span></label>
                                    <input type="number" name="estimated_budget" class="form-control" value="{{ $project->estimated_budget }}" id="estimated_budget" required>
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

                                <div class="form-group col-12">
                                    <label class="form-label" for="comment">Comment</label>
                                    <textarea name="comment" class="form-control" id="comment"> {{ $project->comment }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"> Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/form-submission.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>
@endpush
