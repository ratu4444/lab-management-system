@extends('custom-layout.master')
@section('title', 'Create New Client')

@push('css')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Create New Client</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('client.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="client_name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="client_name" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="mobile">Mobile</label>
                                    <input type="tel" class="form-control" name="mobile" id="mobile">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="company_name">Company Name</label>
                                    <input type="text" class="form-control" name="company_name" id="company_name">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Create Client</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
