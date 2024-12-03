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
                            <a class="btn btn-primary" href="{{ route('project.create', ['client' => $client?->id]) }}">Add New Project</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($all_clients->count() > 1)
                            <div class="dropdown mb-4">
                                <button class="btn btn-primary dropdown-toggle btn-lg" type="button" data-toggle="dropdown">
                                    {{ $client ? 'Researchers : '.$client->name : 'Select Another Researchers' }}
                                </button>
                                <div class="dropdown-menu" style="max-height: 500px; min-width: fit-content; overflow-y: auto">
                                    @foreach($all_clients as $single_client)
                                        <a class="dropdown-item {{ $single_client->id == $client?->id ? 'active' : '' }}" href="{{ route('project.index', array_merge(request()->query(), ['client' => $single_client->id])) }}">
                                            {{ $single_client->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-nowrap">Name</th>
                                    <th class="text-nowrap">Researchers Name</th>
                                    <th class="text-nowrap">Estimated Completion Date</th>
{{--                                    <th class="text-nowrap">Estimated Budget</th>--}}
{{--                                    <th class="text-nowrap">Total Budget</th>--}}
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
{{--                                            <td class="text-nowrap">{{ '$'.number_format($project->estimated_budget) }}</td>--}}
{{--                                            <td class="text-nowrap">{{ '$'.number_format($project->total_budget) }}</td>--}}
                                            <td class="text-nowrap">
                                                <div class="badge {{ 'badge-'.$status_color}} {{ $show_incomplete_badge ? 'badge-dot' : ''}}">{{ $status }}</div>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('task.index', $project->id) }}" class="btn btn-primary btn-sm" target="_blank">Tasks</a>
{{--                                                <a href="{{ route('payment.index', $project->id) }}" class="btn btn-success btn-sm" target="_blank">Payments</a>--}}
{{--                                                <a href="{{ route('inspection.index', $project->id) }}" class="btn btn-info btn-sm" target="_blank">Inspections</a>--}}
                                                <a href="{{ route('report.index', $project->id) }}" class="btn btn-warning btn-sm" target="_blank">Reports</a>
                                            </td>

                                            <td class="text-nowrap">
                                                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit Project</a>
                                                <a href="{{ route('dashboard.client-index', ['project' => $project->id]) }}" class="btn btn-primary btn-sm">Dashboard</a>
{{--                                                <a href="{{ route('settings.element', ['project' => $project->id]) }}" class="btn btn-warning btn-sm">Dashboard Settings</a>--}}
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
