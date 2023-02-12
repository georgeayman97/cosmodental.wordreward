@props(['user','id','title','route','is_payment'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ $route }}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" id="recipient-name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="recipient-phone" class="col-form-label">Phone:</label>
                        <input type="text" class="form-control" value="{{ $user->phone }}" id="recipient-phone"
                               readonly>
                    </div>
                    @if(isset($is_payment))
                        <div class="form-group">
                            <label for="amount_paid">Amount Paid in EGP</label>
                            <input type="number" class="form-control"
                                   id="amount_paid" name="amount_paid"
                                   placeholder="Paid In EGP">
                        </div>
                    @else
                        <div class="form-group">
                            <label for="amount_paid">Points Amount</label>
                            <input type="number" class="form-control"
                                   id="points" name="points"
                                   placeholder="Points">
                        </div>
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>