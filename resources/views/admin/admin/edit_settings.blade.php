@extends('layouts.admin')

@section('header')
EDIT {{ $setting->name }} Points
@endsection
@section('content') 
<form id="createForm" action="{{route('settings.update',$setting->id)}}" method="POST">
    @csrf  
    @method('put')
        <div class="form-group">
            <label for="exampleInputEmail1 @error('name') is-invalid @enderror">Name</label>
            <input type="text" class="form-control" value="{{ old('name',$setting->name)}}" id="name" name="name" placeholder="Enter Group Name">
            @error('name')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="default_points">Points</label>
            <input type="number" name="default_points" class="form-control" value="{{ old('default_points',$setting->default_points)}}" id="default_points" style="-webkit-appearance: none; margin: 0; -moz-appearance: textfield;" placeholder="default_points" required>
            @error('default_points')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    
    
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </div>
    </div>
</form>
@endsection