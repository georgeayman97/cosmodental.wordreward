@extends('layouts.admin')

@section('header')
    Create New Admin
@endsection
@section('content')
    <form id="createForm" action="{{route('register.admin')}}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="number" name="phone" class="form-control" id="phone" style="-webkit-appearance: none; margin: 0; -moz-appearance: textfield;" placeholder="Phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="custom-select form-control-border" id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection