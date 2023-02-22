@extends('layouts.admin')

@section('header')
    <h4>GROUPS</h4>
    <button class="btn btn-primary" id="create-usergroup"><i class="fa fa-plus"></i> Create</button>
    @include('admin.user._modal_create_usergroup')
@endsection

@section('scripts')
    <script>
        $("#create-usergroup").on('click', e => {
            $('#usergroup-create-modal').modal('show')
        })
    </script>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <table class
                   ="table table-hover no-more-tables">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>MAX POINTS</th>
                    <th>Minimum Balance To Allow Transfer</th>
                    <th>Payment Percentage</th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->maximum_points }}</td>
                        <td>{{ $group->minimum_balance_to_allow_transfer }}</td>
                        <td>{{ $group->payment_percentage }} %</td>
                        <td><a class="btn btn-primary" href="{{ route('group.edit',['group'=>$group->id])}} ">Edit</a></td>
                        <!-- <td class="actions notitle notitle-center">--}}
{{--                            <form action="{{route('group.destroy',['group'=>$group->id])}}" method="post">--}}
{{--                                @method('DELETE')--}}
{{--                                @csrf--}}
{{--                                <button style="border: none; background: none;" type="submit"--}}
{{--                                        class="fa fa-trash text-danger"></button>--}}
{{--                            </form>--}}
{{--                        </td> -->
                    </tr>
                @endforeach
            </table>
            <ul class="pagination">
            </ul>
        </div>
    </div>
@endsection