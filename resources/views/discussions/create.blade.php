@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Ask a question</h2>
    <form action="/discussions" method="POST" class="form">
        @csrf
        <label for="title">Ttile</label>
        <input type="text" name="title" class="cancel" required>
        <label for="category">Category</label>
        <select name="category" id="">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <label for="content">Your Question</label>
        <textarea name="content" id="" cols="30" rows="10" placeholder="Your question..." class="cancel"></textarea>
        <button type="submit">Submit</button>
    </form>
</div>
@endsection