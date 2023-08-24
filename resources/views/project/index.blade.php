@extends('custom-layout.master')
@section('title', 'Projects')

@push('css')
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
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
                                    <th class="text-nowrap">Name</th>
                                    <th class="text-nowrap">Client Name</th>
                                    <th class="text-nowrap">Estimated Completion Date</th>
                                    <th class="text-nowrap">Estimated Budget</th>
                                    <th class="text-nowrap">Total Budget</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">View</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($projects))
                                    @foreach($projects as $project)
                                        @php
                                            $status = array_search($project->status, config('app.STATUSES'));
                                            $status_color = config("app.STATUSES_COLORS.$status");
                                            $show_incomplete_badge = $project->status == config('app.STATUSES.Completed') && $project->has_running_task;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ (($projects->currentpage()-1) * $projects->perpage()) + $loop->index + 1 }}</th>
                                            <td class="text-nowrap">{{ $project->name }}</td>
                                            <td class="text-nowrap">{{ $project->client->name }}</td>
                                            <td class="text-nowrap">{{ $project->estimated_completion_date }}</td>
                                            <td class="text-nowrap">{{ '$'.number_format($project->estimated_budget) }}</td>
                                            <td class="text-nowrap">{{ '$'.number_format($project->total_budget) }}</td>
                                            <td class="text-nowrap">
                                                <div class="badge {{ 'badge-'.$status_color}} {{ $show_incomplete_badge ? 'badge-dot' : ''}}">{{ $status }}</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('task.create', $project->id) }}" class="btn btn-primary btn-sm" target="_blank">See Tasks</a>
                                                <a href="{{ route('payment.create', $project->id) }}" class="btn btn-success btn-sm" target="_blank">See Payments</a>
                                                <a href="{{ route('inspection.create', $project->id) }}" class="btn btn-warning btn-sm" target="_blank">See Inspections</a>
                                            </td>

                                            <td class="text-nowrap">
                                                <a href="{{ route('dashboard.client-index', ['project' => $project->id]) }}" class="btn btn-primary btn-sm">Project Dashboard</a>
                                                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="{{ route('settings.element', ['project' => $project->id]) }}" class="btn btn-warning btn-sm">Edit Dashboard Settings</a>
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