@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">

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
                        <form class="" action="{{ route('settings.inspection.store') }}" method="post">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Name <span class="text-danger">*</span> </label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Schedule Date*</label>
                                    <input type="date" name="scheduled_date"  class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                            </div>
{{--                            <div class="form-group form-float">--}}
{{--                                <label>Dependency</label>--}}
{{--                                <select class="form-control selectric" name="dependencies[]" multiple="">--}}
{{--                                    @if(count($inspection_tasks))--}}
{{--                                        @foreach($inspection_tasks as $task)--}}
{{--                                            <option value="{{ $task->id }}" {{ in_array($task->id, $inspection->dependent_inspection_ids) ? 'selected' : '' }} >{{ $task->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                            </div>--}}
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
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/select-button-bg-changer.js') }}"></script>

    <script>
        $(document).ready(function() {
            selectButtonBgChange('.selectgroup-input-radio');
        });
    </script>
@endpush
