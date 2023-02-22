@extends('layouts.admin')

@section('header')
    Staff
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


@section('content')
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
                        <th>ACTIONS</th>
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
                            <td><a class="btn btn-primary" href="{{ route('user.edit',$user->id)}} ">Edit</a></td>

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