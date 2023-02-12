@extends('layouts.admin')

@section('header')
    Notify User
@endsection
@section('content')
    <form id="createForm" action="{{route('notify.user.create')}}" method="POST">
        @csrf
        @if($user->count() == 1)
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name @error('name') is-invalid @enderror">User Name</label>
                <input type="text" class="form-control" value="{{$user->name}}" id="name" name="name" readonly>
                <input type="hidden" class="form-control" value="{{$user->id}}" id="user_id" name="user_id">
            </div>
            <div class="form-group col-md-6">
                <label for="phone @error('phone') is-invalid @enderror">User Phone</label>
                <input type="text" class="form-control" value="{{$user->phone}}" id="name" name="phone" readonly>
            </div>
        </div>
        @else
        <div class="form-row">
            <div class="form-group col-md-3">
            <label for="name @error('name') is-invalid @enderror">Select User</label>
                <select class="selectpicker form-control" id="user_id" data-live-search="true" name="user_id" data-size="10" require>
                    @foreach ($user as $notifiableUser)
                        <option value="{{$notifiableUser->id}}" {{$notifiableUser->id == old('user') ? 'selected':''}}>{{$notifiableUser->phone}} & {{$notifiableUser->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="title">TITLE</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title')}}" id="title" name="title" placeholder="Enter Notification Title">
                @error('title')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="message">MESSAGE</label>
                <textarea  type="text" class="form-control @error('message') is-invalid @enderror"
                       value="{{ old('message')}}" id="message" name="message" placeholder="Enter Notification Message"></textarea>
                @error('message')
                <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Notify</button>
            </div>
        </div>
    </form>

@endsection