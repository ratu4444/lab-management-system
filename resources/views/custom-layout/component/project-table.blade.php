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
                    $status_color = config("app.STATUSES_COLORS.$status")
                @endphp
                <tr>
                    <th scope="row">{{ (($projects->currentpage()-1) * $projects->perpage()) + $loop->index + 1 }}</th>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->client->name }}</td>
                    <td>{{ $project->estimated_completion_date }}</td>
                    <td>{{ $project->estimated_budget }}</td>
                    <td>{{ $project->total_budget ?? '-' }}</td>
                    <td>
                        <div class="badge {{ 'badge-'.$status_color }}">{{ $status }}</div>
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('task.create', $project->id) }}" class="btn btn-primary btn-sm" target="_blank">See Tasks</a>
                        <a href="{{ route('payment.create', $project->id) }}" class="btn btn-success btn-sm" target="_blank">See Payments</a>
                        <a href="{{ route('inspection.create', $project->id) }}" class="btn btn-warning btn-sm" target="_blank">See Inspections</a>
                    </td>

                    <td class="text-nowrap">
                        <a href="{{ route('edit.project', $project->id) }}" class="btn btn-primary btn-sm" target="_blank">Edit</a>
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
