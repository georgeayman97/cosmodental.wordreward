<div class="modal fade" id="usergroup-change-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="POST" action="{{ route('user.update',$user->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label" for="userName">Name : </label>
                        <input id="userName" name="name" value="{{ $user->name }}">
                    </div>
                    <div>
                        <label class="col-form-label" for="userGroups">Group : </label>
                        <select id="userGroups" name="user_group_level">
                            @foreach($userGroups as $userGroup)
                                <option value="{{ $userGroup->level }}">
                                    {{ $userGroup->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>