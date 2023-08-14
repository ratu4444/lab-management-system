@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">

@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h3>Inspection</h3>
            </div>
            <div>
                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#inspectionCreateModal">
                    Add Settings Inspection
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Comment</th>
                    </tr>
                    <tr>
                    @if(count($inspection_show))
                        @foreach($inspection_show as $inspection)
                            @php
                                $status = array_search($inspection->status, config('app.STATUSES'));
                                $status_color = config("app.STATUSES_COLORS.$status")
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inspection->name }}</td>
                                <td>
                                    <div class="badge {{ 'badge-'.$status_color }}">{{ $status }}</div>
                                </td>
                                <td>{{ $inspection->comment }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Settings Task Found</td>
                        </tr>
                    @endif
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

<div class="modal fade" id="inspectionCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inspection Create Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('settings.inspection.store') }}" method="post">
                    @csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Name <span class="text-danger">*</span> </label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
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

