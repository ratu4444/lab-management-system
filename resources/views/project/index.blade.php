@extends('custom-layout.master')
@section('title', 'Projects')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Projects</h4>
                        <div>
                            <a class="btn btn-primary" href="{{ route('project.create', ['client' => $client_id]) }}">Add New Project</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Estimated Completion Date</th>
                                    <th>Estimated Budget</th>
                                    <th>Total Budget</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($projects))
                                    @foreach($projects as $project)
                                        <tr>
                                            <th scope="row">{{ (($projects->currentpage()-1) * $projects->perpage()) + $loop->index + 1 }}</th>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->estimated_completion_date }}</td>
                                            <td>{{ $project->estimated_budget }}</td>
                                            <td>{{ $project->total_budget ?? '-' }}</td>
                                            <td>{{ $project->status }}</td>
                                            <td class="py-3">
                                                <div class="text-nowrap">
                                                    <a href="{{ route('task.index', $project->id) }}" class="btn btn-primary btn-sm">See Tasks</a>
                                                    <a href="{{ route('payment.index', $project->id) }}" class="btn btn-primary btn-sm">See Payments</a>
                                                    <a href="{{ route('inspection.index', $project->id) }}" class="btn btn-primary btn-sm">See Inspections</a>
                                                </div>

                                                <div class="text-nowrap mt-1">
                                                    <a href="{{ route('task.create', $project->id) }}" class="btn btn-success btn-sm">Add Task</a>
                                                    <a href="{{ route('payment.create', $project->id) }}" class="btn btn-success btn-sm">Add Payment</a>
                                                    <a href="{{ route('inspection.create', $project->id) }}" class="btn btn-success btn-sm">Add Inspection</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted font-weight-bold">No Project Found</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
