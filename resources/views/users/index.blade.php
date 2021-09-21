@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container profile">
    <div class="info d-flex mb-5">
        <img src="/img/profile-user.png" alt="image" class="profile-pic mr-2">
        <h4>{{$user->name}}</h4>
    </div>
    <div>
        <span>Stats</span>
        <span>Settings</span>
    </div>
    <div class="stat d-flex">
        <div class="question mr-3">
            <div>{{count($discussions)}}</div>
            <div>question</div>
        </div>
        <div class="answer">
            <div>0</div>
            <div>answered</div>
        </div>
    </div>

</div>
@endsection