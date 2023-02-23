@extends('layouts.admin')

@section('header')
    Points Controls
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
                        <th>TITLE</th>
                        <th>MESSAGE</th>
                        <th>ACTIONS</th>
                    </tr>
                    @foreach($messages as $key => $message)
                        <tr>	
                            <td>{{ $key + 1  }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->title }}</td>
                            <td>{{ $message->msg }}</td>
                            <td><a class="btn btn-primary" href="{{ route('messages.edit',$message->id)}} ">Edit</a></td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

@endsection