@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container profile">
    <div class="info d-flex mb-5">
        <img src="/img/profile-user.png" alt="image" class="profile-pic mr-2">
        <div>
            <div class="d-flex "><span class="username"><h1>{{$user->name}}</h1></span> <a href="/profile/edit">@if($user->id == Auth::id())<img src="img/edit.png" class="edit-img" alt="">@endif</a></div>
            <div><img src="/img/up-arrow.png" class="vote mr-2" alt=""><span>{{$user->reputation}}</span></div>
        </div>
    </div>
    <div>
        <h3>Stats</h3>
    </div>
    <div class="stat d-flex">
        <div class="question-count mr-3">
            <div>{{$discussions}}</div>
            <div>question</div>
        </div>
        <div class="answered mr-3">
            <div>{{$answered}}</div>
            <div>answered</div>
        </div>
        <div class="answer-count">
            <div>{{$answers}}</div>
            <div>answers contributed</div>
        </div>
    </div>

</div>
@endsection