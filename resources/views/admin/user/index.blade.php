@extends('layouts.admin')

@section('header')
    USERS
@endsection

@section('styles')
    <style>
        th {
            font-weight: bolder;
            font-size: larger;
        }

        td {
            font-weight: normal;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(".addPoints").on('click', e => {
            $('#points-modal-' + e.target.id).modal('show')
        })
        $(".redeemPoints").on('click', e => {
            $('#points-modal-' + e.target.id).modal('show')
        })
    </script>
@endsection

@section('content')
    @isset($groups)
        <div class="administrators index">
            <div class="box box-primary">
                <form>
                    <select name="user_group_level" class="form-control">
                        @foreach($groups as $group)
                            <option value="{{ $group->level }}" {{ $group->level != request()->user_group_level ?: 'selected' }}
                            >{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <div class="my-4">
                        <button class="btn btn-primary right">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    @endisset
    <div class="administrators index">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-hover no-more-tables">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>POINTS</th>
                        <th>GROUP</th>
                        <th>GENDER</th>
                        <th>BIRTHDATE</th>
                        <th>MOBILE</th>
                        <th>STATUS</th>
                        <th class="actions">Actions</th>
                    </tr>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1  }}</td>
                            <td><a href="{{ route('user.show', $user->id) }}"
                                >{{ $user->name }}</a>
                            </td>
                            <td>{{ $user->points }}</td>
                            <td>{{ $user->userGroup?->name }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->birthdate }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->status }}</td>
                            <td class="actions notitle notitle-center">
                                <ul class="list-unstyled">
                                    <li>
                                        <x-points-modal :user=$user
                                                        id="points-modal-user-add-{{ $user->id }}"
                                                        title="Add Points"
                                                        route="{{ route('user.add_points',$user->id) }}"
                                                        is_payment=true
                                        />
                                        <button class="btn btn-primary w-75 addPoints"
                                                id="user-add-{{ $user->id }}"
                                        >Add Points
                                        </button>
                                    </li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li>
                                        <x-points-modal :user=$user
                                                        id="points-modal-user-redeem-{{ $user->id }}"
                                                        title="Redeem Points"
                                                        route="{{ route('user.redeem_points', $user->id) }}"
                                        />
                                        <button class="btn btn-primary w-75 redeemPoints"
                                                id="user-redeem-{{ $user->id }}"
                                        >Redeem Points
                                        </button>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </table>
                @isset($groups)
                    <div class="paginating-container">
                        {{ $users->links() }}
                    </div>
                @endisset
            </div>
        </div>

@endsection