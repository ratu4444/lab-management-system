@extends('custom-layout.master')
@section('title', 'Edit Profile')

@push('css')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-muted">Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? auth()->user()->name }}" required>

                                    <div class="invalid-feedback">
                                        Profile name is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') ?? auth()->user()->email }}" required>

                                    <div class="invalid-feedback">
                                        Valid email is required
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6 col-lg-4">
                                    <label class="form-label" for="mobile">Mobile</label>
                                    <input type="tel" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') ?? auth()->user()->mobile }}">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="avatar">Profile Picture</label>
                                    <input type="file" class="form-control" name="avatar" id="avatar" accept="image/*">
                                    <code class="small d-block mt-2">Leave it blank if not want to change Profile Picture</code>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    <code class="small d-block mt-2">Leave it blank if not want to change password</code>

                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
