@extends('layouts.admin')

@section('header')
Use Points For   {{$user->name}}
@endsection
@section('content') 
<form id="createForm" action="{{route('points.removepoints')}}" method="POST">
    @csrf  
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 @error('name') is-invalid @enderror">User Name</label>
            <input type="text" class="form-control" value="{{$user->name}}" id="name" name="name" readonly>
            <input type="hidden" class="form-control" value="{{$user->id}}" id="id" name="id" >
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 @error('phone') is-invalid @enderror">User Phone</label>
            <input type="text" class="form-control" value="{{$user->phone}}" id="name" name="phone" readonly>
        </div>
        
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="amount_paid">Points to Redeem</label>
            <input type="number" class="form-control @error('points') is-invalid @enderror" value="{{ old('points')}}" id="points" name="points" placeholder="Points to Redeem">
            @error('points')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <!-- <div class="form-group col-md-6">
        <label for="exampleInputFile">File input</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> -->
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary mt-3">Add Points</button>
        </div>
    </div>
</form>
@endsection