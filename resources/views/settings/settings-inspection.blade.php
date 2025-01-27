@extends('custom-layout.master')
@section('title', 'Default Inspections')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">

@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Default Inspection</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inspectionCreateModal">Add More Default Inspection</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-nowrap">Name</th>
{{--                            <th class="text-nowrap">Status</th>--}}
                            <th class="text-nowrap">Is Enabled?</th>
                            <th class="text-nowrap">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($settings_inspections))
                            @foreach($settings_inspections as $inspection)
                                @php
                                    $status = array_search($inspection->status, config('app.STATUSES'));
                                    $status_color = config("app.STATUSES_COLORS.$status")
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $inspection->name }}</td>
{{--                                    <td>--}}
{{--                                        <div class="badge {{ 'badge-'.$status_color }}">{{ $status }}</div>--}}
{{--                                    </td>--}}
                                    <td>
                                        <div class="badge {{ $inspection->is_enabled ? 'badge-success' : 'badge-danger' }}">{{ $inspection->is_enabled ? 'Yes' : 'No' }}</div>
                                    </td>

                                    <td><a class="btn btn-primary" href="{{ route('settings.inspection.edit', $inspection->id) }}">Edit</a></td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="100%" class="text-center text-muted font-weight-bold">No Default Inspection Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="inspectionCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Inspection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('settings.inspection.store') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>

                            <div class="invalid-feedback">
                                Inspection name is required
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
                        <button type="submit" class="btn btn-primary"> Create Default Inspection </button>
                    </form>
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
            // selectButtonBgChange('.status-select');
            selectButtonBgChange('.enabled-select');
        });
    </script>
@endpush

