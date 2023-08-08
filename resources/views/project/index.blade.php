@extends('custom-layout.master')
@section('title', 'Projects')

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
                        @include('custom-layout.component.project-table')
                        <div class="mt-3">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
