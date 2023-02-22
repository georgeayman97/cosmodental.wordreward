@extends('layouts.admin')

@section('header')
UPDATE GROUP &nbsp {{ $group->name }} 
@endsection
@section('content') 
<form id="createForm" action="{{route('group.update',$group->id)}}" method="POST">
    @csrf  
    @method('put')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="exampleInputEmail1 @error('name') is-invalid @enderror">Name</label>
            <input type="text" class="form-control" value="{{ old('name',$group->name)}}" id="name" name="name" placeholder="Enter Group Name">
            @error('name')
                <div class ="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="maximum_points">Maximum Points</label>
            <input type="number" class="form-control @error('maximum_points') is-invalid @enderror" value="{{ old('maximum_points',$group->maximum_points)}}" id="maximum_points" name="maximum_points" placeholder="Maximum Points">
            @error('maximum_points')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="payment_percentage">Payment Percentage %</label>
            <input type="number" class="form-control @error('payment_percentage') is-invalid @enderror" value="{{ old('payment_percentage',$group->payment_percentage)}}" id="payment_percentage" name="payment_percentage" placeholder="Payment Percentage">
            @error('payment_percentage')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="minimum_balance_to_allow_transfer">Minimum Balance To Allow Transfer</label>
            <input type="number" class="form-control @error('minimum_balance_to_allow_transfer') is-invalid @enderror" value="{{ old('minimum_balance_to_allow_transfer',$group->minimum_balance_to_allow_transfer)}}" id="minimum_balance_to_allow_transfer" name="minimum_balance_to_allow_transfer" placeholder="Minimum Balance To Allow Transfer">
            @error('minimum_balance_to_allow_transfer')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </div>
    </div>
</form>
@endsection