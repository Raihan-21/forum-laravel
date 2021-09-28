@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container profile">
    <h1>Change Info</h1>
    <form action="/profile/edit" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" value="{{$errors->any() ? old('name') : $user->name}}">
        <div class="error">@error('name') {{$message}} @enderror</div>
        <label for="email">Email</label>
        <input type="text" name="email" value="{{$errors->any() ? old('email') : $user->email}}">
        <div class="error">@error('email') {{$message}} @enderror</div>
        <button type="submit" class="my-3 bg-primary rounded-lg text-white">Save</button>
    </form>
    <a href="/profile/edit/password">Change Password</a>
</div>
@endsection