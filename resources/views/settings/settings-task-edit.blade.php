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
                        <h4 class="card-title text-muted"> Settings Task Edit</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.task.update', $default_task_id) }}" class="needs-validation" novalidate>
                            @method('PUT')
                            @csrf

                            <div class="form-group">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ $settings_task->name }}" class="form-control" required>

                                <div class="invalid-feedback">
                                    Task name is required
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Budget <span class="text-danger">*</span></label>
                                <input name="total_budget" type="number" class="form-control" value="{{ $settings_task->budget }}" min="1" required>

                                <div class="invalid-feedback">
                                    Budget is required
                                </div>
                            </div>
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
                                    <div class="selectgroup">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_enabled" value="1" class="enabled-select selectgroup-input-radio" {{ $settings_task->is_enabled == 1 ? 'checked' : "" }}>
                                            <span class="selectgroup-button" data-class="bg-success">Enabled</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="is_enabled" value="0" class="enabled-select selectgroup-input-radio" {{ $settings_task->is_enabled == 0 ? 'checked' : "" }}>
                                            <span class="selectgroup-button" data-class="bg-danger">Disabled</span>
                                        </label>
                                    </div>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                <div class="selectgroup w-100">--}}
{{--                                    <label class="selectgroup-item">--}}
{{--                                        <input type="radio" name="is_enabled" value="1" class="enabled-select selectgroup-input-radio" checked>--}}
{{--                                        <span class="selectgroup-button" data-class="bg-success">Enabled</span>--}}
{{--                                    </label>--}}
{{--                                    <label class="selectgroup-item">--}}
{{--                                        <input type="radio" name="is_enabled" value="0" class="enabled-select selectgroup-input-radio">--}}
{{--                                        <span class="selectgroup-button" data-class="bg-danger">Disabled</span>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <button type="submit" class="btn btn-primary"> Update </button>
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



