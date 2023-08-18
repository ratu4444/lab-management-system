@extends('custom-layout.master')
@section('title', 'Edit Inspection')

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
                        <h4 class="card-title text-muted">Inspection Edit</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inspection.update', [$project->id, $inspection->id]) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('put')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ $inspection->name }}" class="form-control" required>

                                    <div class="invalid-feedback">
                                        Inspection name is required
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Scheduled Date <span class="text-danger">*</span></label>
                                    <input type="text" name="scheduled_date" value="{{ $inspection->scheduled_date }}" class="form-control datepicker" id="scheduled_date" required>

                                    <div class="invalid-feedback">
                                        Schedule date is required
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Inspected Date</label>
                                    <input type="text" name="inspected_date" value="{{ $inspection->date }}" class="form-control datepicker" id="inspected_date">

                                    <div class="invalid-feedback">
                                        Inspected date must be after scheduled date
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <label>Dependency</label>
                                <select class="form-control selectric" name="dependencies[]" multiple="">
                                    @foreach($project->tasks as $task)
                                        <option value="{{ $task->id }}" {{ in_array($task->id, $inspection->dependent_task_ids) ? 'selected' : '' }} >{{ $task->name }}</option>
                                    @endforeach
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
                                            <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == $inspection->status ? 'checked' : ''}} >
                                            <span class="selectgroup-button" data-class="{{ "bg-$status_color" }}">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
{{--                            <div class="form-group form-float">--}}
{{--                                <div class="form-line">--}}
{{--                                    <label class="form-label">Comment</label>--}}
{{--                                    <textarea name="comment" class="form-control">{{ $inspection->comment }}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
            $('#scheduled_date, #inspected_date').on('change', function () {
                var startElement = $('#scheduled_date');
                var endElement = $('#inspected_date');

                validateDates(startElement, endElement);
            });

            selectButtonBgChange('.selectgroup-input-radio');
        });
    </script>
@endpush
