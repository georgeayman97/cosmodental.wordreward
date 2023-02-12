@extends('layouts.admin')

@section('header')
CREATE GROUP
@endsection
@section('content') 
<form id="createForm" action="{{route('group.store')}}" method="POST">
    @csrf  
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 @error('name') is-invalid @enderror">Name</label>
            <input type="text" class="form-control" value="{{ old('name')}}" id="name" name="name" placeholder="Enter Group Name">
            @error('container_type_id')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label>After Group</label>
            <select class="form-control select2 @error('referred_user_group_id') is-invalid @enderror" value="{{ old('referred_user_group_id')}}" name="referred_user_group_id" style="width: 100%;" title="SELECT">
                @foreach($groups as $group)
                    <option value="{{$group->id}}">{{ $group->name }}</option>
                @endforeach
            </select>
            @error('referred_user_group_id')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="minimum_transfer_points">Minimum Transfer Points</label>
            <input type="number" class="form-control @error('minimum_transfer_points') is-invalid @enderror" value="{{ old('minimum_transfer_points')}}" id="minimum_transfer_points" name="minimum_transfer_points" placeholder="Minimum Balance To Allow Transfer">
            @error('minimum_transfer_points')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="minimum_balance_to_allow_transfer">Minimum Balance To Allow Transfer</label>
            <input type="number" class="form-control @error('minimum_balance_to_allow_transfer') is-invalid @enderror" value="{{ old('minimum_balance_to_allow_transfer')}}" id="minimum_balance_to_allow_transfer" name="minimum_balance_to_allow_transfer" placeholder="Minimum Balance To Allow Transfer">
            @error('minimum_balance_to_allow_transfer')
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
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </div>
    </div>
</form>
@endsection