@extends('custom-layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title text-muted">Tasks</h4>
            <div class="">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskCreateModal">Add New Task</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Estimated Start Date</th>
                        <th class="text-nowrap">Estimated Completion Date</th>
                        <th class="text-nowrap">Budget</th>
                        <th class="text-nowrap">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($project->tasks))
                        @foreach($project->tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->estimated_start_date }}</td>
                                <td>{{ $task->estimated_completion_date }}</td>
                                <td>{{ $task->total_budget }}</td>
                                <td>
                                    <div class="badge badge-success">{{ $task->status }}</div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center text-muted font-weight-bold">No Task Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
@endpush
