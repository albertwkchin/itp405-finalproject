@extends('layout')

@section('title')
Edit
@stop

@section('content')

@foreach($errors->all() as $error)
<p>{{$error}}</p>
@endforeach

<h1>Edit User</h1>

<form method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="form-group">
        <label for="name">New Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{Request::old('name')}}">
    </div>
    <div class="form-group">
        <label for="email">New Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{Request::old('email')}}">
    </div>
    <div class="form-group">
        <label for="pasword">New Password</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="pasword_confirmation">Confirm New Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
    </div>

    <input type="submit" value="Submit" class="btn btn-primary">
</form>
@stop