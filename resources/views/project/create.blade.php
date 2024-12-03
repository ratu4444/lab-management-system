@extends('custom-layout.master')
@section('title', 'Create Project')

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
                        <h4 class="card-title text-muted">Create New Project</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('project.store') }}" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <div>
                                        {{--            Changes in name. Researchers instead of Client--}}
                                        <label for="clientDropdown">Researchers <span class="text-danger">*</span></label>
                                        <div class="row">
                                            @if($client_id)
                                                <div class="col-12">
                                                    <select class="form-control" name="client_id" id="clientDropdown" style="pointer-events: none" readonly>
                                                        @foreach($clients as $client)
                                                            <option value="{{ $client->id }}" selected>{{ $client->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <div class="col-12 col-sm-8 col-xl-10">
                                                    <select class="form-control" name="client_id" id="clientDropdown">
                                                        @foreach($clients as $client)
                                                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{--            Changes in name. Researchers instead of Client--}}
                                                <div class="col-12 col-sm-4 col-xl-2 mt-1 mt-sm-0">
                                                    <button class="btn btn-primary text-nowrap w-100 h-100" type="button" data-toggle="modal" data-target="#clientCreateModal">Add New Researchers</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label" for="name">Project Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>

                                    <div class="invalid-feedback">
                                        Project name is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="estimated_completion_date">Estimated Completion Date<span class="text-danger">*</span></label>
                                    <input type="text" name="estimated_completion_date" class="form-control datepicker" id="estimated_completion_date" value="{{ old('estimated_completion_date') }}" required>

                                    <div class="invalid-feedback">
                                        Estimated completion date is required
                                    </div>
                                </div>
{{--                                Changes--}}
{{--                                <div class="form-group col-12 col-md-6">--}}
{{--                                    <label class="form-label" for="estimated_budget">Estimated Budget <span class="text-danger">*</span></label>--}}
{{--                                    <input type="number" name="estimated_budget" class="form-control" id="estimated_budget" min="0" value="{{ old('estimated_budget') }}" required>--}}

{{--                                    <div class="invalid-feedback">--}}
{{--                                        Estimated budget is required--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-12">--}}
{{--                                    <label class="form-label">Status</label>--}}
{{--                                    <div class="selectgroup w-100 flex-wrap">--}}
{{--                                        @foreach(config('app.STATUSES') as $label => $status_id)--}}
{{--                                            @php--}}
{{--                                                $status_color = config("app.STATUSES_COLORS.$label");--}}
{{--                                            @endphp--}}
{{--                                            <label class="selectgroup-item">--}}
{{--                                                <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ old('status') ? (old('status') == $status_id ? 'checked' : '') : ($status_id == 1 ? 'checked' : '')}} >--}}
{{--                                                <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>--}}
{{--                                            </label>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group col-12">--}}
{{--                                    <label class="form-label" for="comment">Comment</label>--}}
{{--                                    <textarea name="comment" class="form-control" id="comment">{{ old('comment') }}</textarea>--}}
{{--                                </div>--}}
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('custom-layout.modal.client-modal')
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/form-submission.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>

    <script>
        $(document).ready(function() {
            selectButtonBgChange('.selectgroup-input-radio');
        });
    </script>
@endpush
