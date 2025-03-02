@extends('custom-layout.master')
@section('title', 'Admins')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Admins</h4>
                        <div>
                            <a class="btn btn-primary" href="{{ route('control.admin.create') }}">Add New Admin</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-nowrap">Name</th>
                                    <th class="text-nowrap">Email</th>
                                    <th class="text-nowrap">Mobile</th>
                                    <th class="text-nowrap">Total Researcher</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($admins))
                                    @foreach($admins as $admin)
                                        <tr>
                                            <th scope="row">{{ (($admins->currentpage()-1) * $admins->perpage()) + $loop->index + 1 }}</th>
                                            <td class="text-nowrap">{{ $admin->name }}</td>
                                            <td class="text-nowrap">{{ $admin->email }}</td>
                                            <td class="text-nowrap">{{ $admin->mobile ?? '-' }}</td>
                                            <td>{{ $admin->clients_count }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('control.admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit Admin</a>
                                                <a href="{{ route('control.researcher.index', $admin->id) }}" class="btn btn-warning btn-sm">Show Reserchers</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted font-weight-bold">No Admin Found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $admins->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
