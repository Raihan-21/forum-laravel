@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container index mr-5">
    <div class="header d-flex justify-content-between align-items-center mb-3">
        <h1>Discussions</h1>
        <a href="/discussions/create"><button class="btn btn-primary btn-sm">Ask a Question</button></a>
    </div>
    <div class="content questions bg-white mb-4">
        @foreach($discussions as $discussion)
        <div class="question mb-3">
        <a href="/discussions/{{ $discussion->slug }}"><h5>{{$discussion->title}}</h5></a>
            <div class="content">
                {{$discussion->content}}
            </div>
            <div class="user d-flex justify-content-between">
                <div class="left d-flex">
                    <img src="/img/profile-user.png" class="profile-pic mr-2" alt="">
                    <a href="/profile/{{$discussion->user_id}}">asked by <span class="username text-primary">{{$discussion->user_name}}</span></a>
                </div>
                <div class="right">
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$discussions->links('pagination::bootstrap-4')}}
</div>
@include('layouts.topuser')
@endsection