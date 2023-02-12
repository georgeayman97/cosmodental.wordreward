<div class="modal fade" id="usergroup-create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Usergroup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('group.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Name: </label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Maximum Points: </label>
                        <input class="form-control" name="maximum_points" type="number"
                               min="{{ $groups->max('maximum_points') + 1 }}" required>
                    </div>
                    <div class="form-group">
                        <label for="minimum_balance_to_allow_transfer">Minimum Balance To Allow Transfer</label>
                        <input class="form-control" name="minimum_balance_to_allow_transfer" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>