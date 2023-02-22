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
                        <th>POINTS</th>
                        <th>ACTIONS</th>
                    </tr>
                    @foreach($settings as $key => $setting)
                        <tr>	
                            <td>{{ $key + 1  }}</td>
                            <td>{{ $setting->name }}</td>
                            <td>{{ $setting->default_points }}</td>
                            <td><a class="btn btn-primary" href="{{ route('settings.edit',$setting->id)}} ">Edit</a></td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

@endsection