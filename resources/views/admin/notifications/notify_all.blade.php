@extends('layouts.admin')

@section('header')
    Notify Group
@endsection
@section('content')
    <form id="createForm" action="{{route('notify.all.create')}}" method="POST">
        @csrf
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