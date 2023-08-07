<div class="modal fade" id="clientCreateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-muted">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="clientCreateForm" action="{{ route('api.store-client') }}" method="post">
                    @csrf
                    <meta name="access-token" content="{{ $access_token }}">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label class="form-label" for="client_name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="client_name" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="mobile">Mobile</label>
                            <input type="tel" class="form-control" name="mobile" id="mobile">
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="company_name">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="clientCreateButton">Create Client</button>
                </form>
            </div>
        </div>
    </div>
</div>
