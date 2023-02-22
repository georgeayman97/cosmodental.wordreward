@extends('layouts.admin')

@section('header')
EDIT {{ $user->name }} ACCOUNT
@endsection
@section('content') 
<form id="createForm" action="{{route('user.updateUser',$user->id)}}" method="POST">
    @csrf  
    @method('put')
        <div class="form-group">
            <label for="exampleInputEmail1 @error('name') is-invalid @enderror">Name</label>
            <input type="text" class="form-control" value="{{ old('name',$user->name)}}" id="name" name="name" placeholder="Enter Group Name">
            @error('name')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="number" name="phone" class="form-control" value="{{ old('phone',$user->phone)}}" id="phone" style="-webkit-appearance: none; margin: 0; -moz-appearance: textfield;" placeholder="Phone" required>
            @error('phone')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email',$user->email)}}" id="email" placeholder="Email">
            @error('email')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            @error('password')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
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