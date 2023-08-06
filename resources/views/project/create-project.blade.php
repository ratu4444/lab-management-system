@extends('custom-layout.master')

@push('css')
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <form id="wizard_with_validation" method="POST" action="{{ route('project.store') }}">
                @csrf
                    <h5> <b>Client</b> </h5>

                <div  class="row align-items-center">
                    <div class="col-8 col-md-10">
                        <div class="mt-3 mb-5">
                            <label>Client*</label>
                            <select class="form-control" name="client_id" id="clientDropdown">
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#clientCreateModal">Add New Client</button>
                    </div>
                </div>

                    <h5> <b>Project</b> </h5>
                    <div class="form-group form-float mt-4">
                        <div class="form-line">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Estimated Completion Date*</label>
                            <input type="date" name="estimated_completion_date" class="form-control" required >
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <label class="form-label">Estimated Budget*</label>
                            <input type="number" name="estimated_budget" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <div class="selectgroup w-100">
                            @foreach(config('app.STATUSES') as $label => $status_id)
                                <label class="selectgroup-item">
                                    <input type="radio" name="status" value="{{ $status_id }}" class="selectgroup-input-radio" {{ $status_id == 1 ? 'checked' : ''}} >
                                    <span class="selectgroup-button">{{ $label }}</span>
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

                <button  type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
