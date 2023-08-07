@extends('custom-layout.master')

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
                        <form method="POST" action="{{ route('project.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <div class="">
                                        <label for="clientDropdown">Client <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-12 col-sm-8 col-xl-10">
                                                <select class="form-control" name="client_id" id="clientDropdown">
                                                    @foreach($clients as $client)
                                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-sm-4 col-xl-2 mt-1 mt-sm-0">
                                                <button class="btn btn-primary text-nowrap w-100 h-100" type="button" data-toggle="modal" data-target="#clientCreateModal">Add New Client</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label" for="name">Project Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="estimated_completion_date">Estimated Completion Date <span class="text-danger">*</span></label>
                                    <input type="text" name="estimated_completion_date" class="form-control datepicker" id="estimated_completion_date" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="estimated_budget">Estimated Budget <span class="text-danger">*</span></label>
                                    <input type="number" name="estimated_budget" class="form-control" id="estimated_budget" required>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label">Status</label>
                                    <div class="selectgroup w-100 flex-wrap">
                                        @foreach(config('app.STATUSES') as $label => $status_id)
                                            <label class="selectgroup-item">
                                                <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >
                                                <span class="selectgroup-button">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-label" for="comment">Comment</label>
                                    <textarea name="comment" class="form-control" id="comment"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Project</button>
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
    <script src="{{ asset('js/form-submission.js') }}"></script>
@endpush
