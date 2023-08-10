@extends('custom-layout.master')
@section('title', 'Dashboard')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
@endpush

@section('modal')
    <div class="modal fade" id="projectSelectionModal" tabindex="-1" role="dialog" aria-labelledby="projectSelectionModalTitle" data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectSelectionModalTitle">Select a Project</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.client-index') }}" method="get">
                        <select class="form-control selectric" name="project" required>
                            @if(count($projects))
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            @endif
                        </select>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary">See Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#projectSelectionModal').modal('show');
        });
    </script>
@endpush
