@extends('custom-layout.master')
@section('title', 'Clients')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Clients</h4>
                        <div>
                            <a class="btn btn-primary" href="{{ route('client.create') }}">Add New Client</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Company Name</th>
                                    <th>Total Projects</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($clients))
                                    @foreach($clients as $client)
                                        <tr>
                                            <th scope="row">{{ (($clients->currentpage()-1) * $clients->perpage()) + $loop->index + 1 }}</th>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->mobile ?? '-' }}</td>
                                            <td>{{ $client->company_name ?? '-' }}</td>
                                            <td>{{ $client->projects_count }}</td>
                                            <td>
                                                <a href="{{ route('project.index', ['client_id' => $client->id]) }}" class="btn btn-primary btn-sm">See Projects</a>
                                                <a href="{{ route('project.create', ['client_id' => $client->id]) }}" class="btn btn-success btn-sm">Create New Projects</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted font-weight-bold">No Client Found</td>
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
