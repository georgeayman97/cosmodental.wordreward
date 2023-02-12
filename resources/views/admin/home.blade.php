@extends('layouts.admin')

@section('header')
USERS
@endsection

@section('content')
    <div class="administrators index">
        
        <div class="box box-primary">
            <div class="box-body">
                <table cellpadding="0" cellspacing="0" class="table table-hover no-more-tables">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>GENDER</th>
                        <th>BIRTHDATE</th>
                        <th>MOBILE</th>
                        <th>STATUS</th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>{{ $user->birthdate }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->status }}</td>
                            <td class="actions notitle notitle-center"></td>
                        </tr>
                    @endforeach
                </table>

                <ul class="pagination">
                    @if($users->count() > 0)
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>
                    @endif
                </ul>
            </div>
        </div>


@endsection