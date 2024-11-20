<div class="modal fade" id="reportCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route(auth()->user()->is_client ? 'client-project.report.store' : 'report.store', $project->id) }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>

                        <div class="invalid-feedback">
                            Report name is required
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control" required>

                        <div class="invalid-feedback">
                            File is required
                        </div>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label class="form-label">Description</label>--}}
{{--                        <textarea name="description" class="form-control"></textarea>--}}
{{--                    </div>--}}

                    <button type="submit" class="btn btn-primary">Create Report</button>
                </form>
            </div>
        </div>
    </div>
</div>
