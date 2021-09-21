@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container index mr-5">
    <div class="header mb-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>My questions</h1>
            <a href="/discussions/create"><button class="btn btn-primary btn-sm">Ask a Question</button></a>
        </div>
        <form class="tabs">
            <a href="/discussions/myquestions" class="tab {{request('sort') ? '' : 'sorted'}}">All</a>
            <input type="submit" name="sort"  value="Solved" class="tab {{request('sort') == 'Solved' ? 'sorted' : ''}}"> 
            <input type="submit" name="sort" value="Unsolved" class="tab {{request('sort') == 'Unsolved' ? 'sorted' : ''}}">
        </form>
    </div>
    <div class="content questions bg-white">
        @foreach($discussions as $discussion)
        <div class="question mb-3">
        <a href="/discussions/{{ $discussion->slug }}"><h5>{{$discussion->title}}</h5></a>
            <div class="content">
                {{$discussion->content}}
            </div>
            <div class="user d-flex">
                <img src="/img/profile-user.png" class="profile-pic mr-2" alt="">
                <div>asked by {{$discussion->user_name}}</div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@include('layouts.topuser')
@endsection
<!-- -->