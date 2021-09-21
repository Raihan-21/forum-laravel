@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container discussion-details">
    <div class="header d-flex justify-content-between align-items-center mb-3">
        <h1>{{$discussion->title}}</h1>
        <a href="/discussions/create"><button class="btn btn-primary btn-sm">Ask a Question</button></a>
    </div>
    <div class="question mb-4 d-flex">
        <div class="stats mr-3">
            <form action="/discussions/vote/{{$discussion->slug}}" method="POST">
                 @csrf
                <input type="submit" name="vote" value="up" class="vote" id="upvote">
                <div class="vote-count">{{$discussion->vote}}</div>
                <input type="submit" name="vote" value="down" class="vote" id="downvote">
            </form>
        </div>
        <div class="content">
            <div class="user d-flex mb-3">
                <img src="/img/profile-user.png" alt="image" class="profile-pic mr-2">
                <div>{{$discussion->user_name}}</div>
            </div>
            <div class="">
                {{$discussion->content}}
            </div>
        </div>

    </div>
    <div class="answers">
        <h2>{{count($answers)}} Answers</h2>
        @foreach($answers as $answer)
        <div class="answer d-flex pb-3 mb-3 {{$answer->accepted ? 'accept' : ''}}">
            <div class="stats mr-3">
                <form action="/answers/vote/{{$answer->id}}" method="POST">
                    @csrf
                    <input type="submit" name="vote" value="up" class="vote" id="upvote">
                    <div class="vote-count {{$author ? 'author' : ''}}">{{$answer->vote}}</div>
                    <input type="submit" name="vote" value="down" class="vote" id="downvote">
                </form>
                @if($author)
                <form action="/answers/{{$answer->id}}" method="POST" class="acc-form mt-3">
                    @csrf
                    <input type="hidden" name="slug" value="{{$discussion->slug}}">
                    <button type="submit" class="solve-btn {{$discussion->solved ? 'solved' : '' }}"></button>
                </form>
                @endif
            </div>
            <div class="content d-flex flex-column">
                <div class="user d-flex mb-3">
                    <img src="/img/profile-user.png" alt="image" class="profile-pic mr-2">
                    <div class="mr-2" style="line-height: 2rem;">{{$answer->user_name}}</div>
                    @if($answer->accepted)
                    <div class="accept-info px-2">Accepted Answer</div>
                    @endif
                </div>
                <div>{{$answer->content}}</div>
            </div>     
        </div>
        @endforeach
    </div>
    <form action="/answers" method="POST" class="mt-3">
        @csrf
        <h3>Your answer</h3>
        <input type="hidden" name="discussion_id" value="{{$discussion->id}}">
        <textarea type="text" name="content" placeholder="Type your answer..." class="rounded-lg border-1 mb-3" rows="7"  autocomplete="off"></textarea>
        <button type="submit" class="btn-primary rounded-lg" style="width: 10%;">Submit</button>
    </form>
</div>
@endsection