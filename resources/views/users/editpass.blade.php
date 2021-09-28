@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container profile">
    <h1>Change Password</h1>
    <form action="/profile/edit/password" method="POST">
        @csrf
        <label for="currentpassword">Current Password</label>
        <input type="password" name="currentpassword" id="">
        <div class="error">@error('currentpassword') {{$message}} @enderror</div>
        <label for="newpassword">New Password</label>
        <input type="password" name="newpassword" id="">
        <div class="error">@error('newpassword') {{$message}} @enderror</div>
        <label for="newpassword_confirmation">Confirm Password</label>
        <input type="password" name="newpassword_confirmation" id="">
        <div class="error">@error('newpassword_confirmation') {{$message}} @enderror</div>
        <button type="submit" class="mt-3">Save</button>
    </form>
</div>
@endsection