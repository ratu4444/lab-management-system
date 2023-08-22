@extends('custom-layout.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted"></h4>
{{--            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#paymentCreateModal">Add New Payment</button>--}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap"> App Name</th>
                        <th class="text-nowrap">User Name</th>
                        <th class="text-nowrap">User Email</th>
                        <th class="text-nowrap">Is Expired</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($oauth_token))
                        @foreach($oauth_token as $info)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $info->app_name }}</td>
                                <td>{{ $info->user_name }}</td>
                                <td>{{ $info->user_email }}</td>
                                <td>
                                    <div class="badge {{ $info->is_expired ? 'badge-danger' : 'badge-success' }}">{{ $info->is_expired ? 'Yes': 'No' }}</div >
                                </td>
                                <td class="text-nowrap">
                                    @if ($info->is_expired)
                                        <a href="" class="btn btn-primary btn-sm">Relogin</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Payment Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
{{--                    <a class="btn btn-primary" href="{{ route('task.create', $project->id) }}">Previous</a>--}}
{{--                    <a class="btn btn-primary" href="{{ route('inspection.create', $project->id) }}">Next</a>--}}
                </div>
            </div>
        </div>

@endsection
