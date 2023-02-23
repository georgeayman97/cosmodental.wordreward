@extends('layouts.admin')

@section('header')
EDIT {{ $msg->name }} Message
@endsection
@section('content')
<form id="createForm" action="{{route('messages.update',$msg->id)}}" method="POST">
    @csrf  
    @method('put')
        <div class="form-group">
            <label for="exampleInputEmail1 @error('name') is-invalid @enderror">Name</label>
            <input type="text" class="form-control" value="{{ old('name',$msg->name)}}" id="name" name="name" placeholder="Enter Name" readonly>
            @error('name')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title',$msg->title) }}" id="title" style="-webkit-appearance: none; margin: 0; -moz-appearance: textfield;" placeholder="Title" required>
            @error('title')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="msg">Message</label>
            <input type="text" name="msg" class="form-control" value="{{ old('msg',$msg->msg)}}" id="msg" style="-webkit-appearance: none; margin: 0; -moz-appearance: textfield;" placeholder="msg" required>
            @error('msg')
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