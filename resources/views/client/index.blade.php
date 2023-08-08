@extends('custom-layout.master')
@section('title', 'Clients')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header d-flex justify-content-between">
                        <h4>All Clients</h4>
                        <div>
                            <a class="btn btn-primary" href="{{ route('client.create') }}">Add New Client</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('custom-layout.component.client-table')
                        <div class="mt-3">
                            {{ $clients->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
