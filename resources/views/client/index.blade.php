@extends('custom-layout.master')
@section('title', 'Clients')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Researchers</h4>
                        <div>
                            <a class="btn btn-primary" href="{{ route('client.create') }}">Add New Researchers</a>
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
{{--                                    <th class="text-nowrap">Company Name</th>--}}
                                    <th class="text-nowrap">Total Projects</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($clients))
                                    @foreach($clients as $client)
                                        <tr>
                                            <th scope="row">{{ (($clients->currentpage()-1) * $clients->perpage()) + $loop->index + 1 }}</th>
                                            <td class="text-nowrap">{{ $client->name }}</td>
                                            <td class="text-nowrap">{{ $client->email }}</td>
                                            <td class="text-nowrap">{{ $client->mobile ?? '-' }}</td>
{{--                                            <td class="text-nowrap">{{ $client->company_name ?? '-' }}</td>--}}
                                            <td>{{ $client->projects_count }}</td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('project.index', ['client' => $client->id]) }}" class="btn btn-primary btn-sm {{ !$client->projects_count ? 'disabled' : '' }}">See Projects</a>
                                                <a href="{{ route('dashboard.client-index', ['client' => $client->id]) }}" class="btn btn-primary btn-sm {{ !$client->projects_count ? 'disabled' : '' }}">Project Dashboard</a>
                                                <a href="{{ route('project.create', ['client' => $client->id]) }}" class="btn btn-success btn-sm">Create New Projects</a>
                                                <a href="{{ route('client.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit Researchers</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted font-weight-bold">No Researchers Found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $clients->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
