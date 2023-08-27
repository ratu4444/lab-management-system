@extends('custom-layout.master')
@section('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Tasks</h4>
                        <div>
                            <a class="btn btn-primary" href="{{ route('task.index', $project_id) }}">Add New Task</a>
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
                                @if(count($tasks))
                                    @foreach($tasks as $task)
                                        <tr>
                                            <th scope="row">{{ (($tasks->currentpage()-1) * $tasks->perpage()) + $loop->index + 1 }}</th>
                                            <td>{{ $task->name }}</td>
                                            <td>{{ $task->email }}</td>
                                            <td>{{ $task->mobile ?? '-' }}</td>
                                            <td>{{ $task->company_name ?? '-' }}</td>
                                            <td>{{ $task->projects_count }}</td>
                                            <td>
                                                @if($task->projects_count)
                                                    <a href="{{ route('project.index', ['task' => $task->id]) }}" class="btn btn-primary btn-sm">See Projects</a>
                                                @endif
                                                <a href="{{ route('project.create', ['task' => $task->id]) }}" class="btn btn-success btn-sm">Create New Projects</a>
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
                        <div class="mt-3">
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
