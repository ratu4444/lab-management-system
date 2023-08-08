@extends('custom-layout.master')
@push('css')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Projects</h4>
                    </div>
                    <div class="card-body">
                        @include('custom-layout.component.project-table')
                        {{ $projects->appends(request()->except('project_page'))->links() }}
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Clients</h4>
                    </div>
                    <div class="card-body">
                        @include('custom-layout.component.client-table')
                        {{ $clients->appends(request()->except('client_page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
