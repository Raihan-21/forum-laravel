<div class="menubar mr-5">
    <a href="/discussions"><div class="py-1 pl-3 menu w-100 {{last(request()->segments()) == 'discussions' ? 'selected' : ''}}">Home</div></a>
    @auth
    <a href="/discussions/myquestions"><div class="menu py-1 pl-3 {{last(request()->segments()) == 'myquestions' ? 'selected' : ''}}">My questions</div></a>
    @endauth
    <div class="py-1 pl-3 w100">
        <!-- Categories: -->
        <div>Categories:</div>
        <form action="/discussions">
        @foreach($categories as $category)
            <input type="submit" name="category" value="{{$category->name}}" class="menu py-1 w-100 border-0 {{request('category') == $category->name ? 'selected' : ''}}">
        @endforeach
        </form>

    </div>
</div>