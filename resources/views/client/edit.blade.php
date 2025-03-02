@extends('custom-layout.master')
@section('title', 'Edit Client')

@push('css')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Edit Researchers Data</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('client.update', $client->id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $client->name }}" required>

                                    <div class="invalid-feedback">
                                        Client name is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') ?? $client->email }}" required>

                                    <div class="invalid-feedback">
                                        Valid email is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    <code>Leave it blank if not want to change password</code>

                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="mobile">Mobile</label>
                                    <input type="tel" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') ?? $client->mobile }}">
                                </div>
                                <div class="form-group col-12 col-md-12">
                                    <label class="form-label" for="skills">Skills</label>
                                    <input type="text" class="form-control" name="skills" id="skills" value="{{ old('skills') ?? $client->skills }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Researchers</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
