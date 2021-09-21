<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Discussion;
use App\Models\Answer;
use App\Models\Category;
class DiscussionController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index(){
        $users = DB::table('users')->orderBy('reputation', 'desc')->get(['name','reputation']);
        $categories = Category::all();
        if(request('category')){
            $category = DB::table('categories')->where('name', request('category'))->get()->first();
            $discussions = DB::table('discussions')->join('users', 'users.id', '=', 'discussions.user_id')->where('category_id', $category->id)->select('discussions.*', 'users.name as user_name')->paginate(5);
        }
        else{
            $discussions = DB::table('discussions')->join('users', 'users.id', '=', 'discussions.user_id')->select('discussions.*', 'users.name as user_name')->paginate(5);
        }
        return view('discussions.index', ['discussions' => $discussions, 'categories' => $categories, 'users' => $users]);
    }
    public function show($slug){
        $author = false;
        $userid = Auth::id();
        $categories = DB::table('categories')->get();
        $discussion = DB::table('discussions')->join('users', 'users.id', '=', 'discussions.user_id')->where('slug', $slug)->get(['discussions.*', 'users.name as user_name'])->first();
        if($discussion->user_id == $userid){
            $author = true;
        }
        $answers = DB::table('answers')->join('users', 'users.id', '=', 'answers.user_id')->where('discussion_id', $discussion->id )->get(['answers.*', 'users.name as user_name']);
        return view('discussions.show', ['discussion' => $discussion, 'categories' => $categories, 'answers' => $answers, 'author' => $author]);
    }
    public function users(){
        $categories = DB::table('categories')->get();
        $users = User::orderBy('reputation', 'desc')->get(['name','reputation']);
        $discussions = DB::table('discussions')->join('users', 'users.id', '=', 'discussions.user_id')->where('user_id', Auth::id())->get(['discussions.*', 'users.name as user_name']);
        if(request('sort')){
         if(request('sort') == 'Solved'){
            $discussions = DB::table('discussions')->join('users', 'users.id', '=', 'discussions.user_id')->where(['user_id' => Auth::id(), 'solved' => true])->get(['discussions.*', 'users.name as user_name']);
         }   
         else{
            $discussions = DB::table('discussions')->join('users', 'users.id', '=', 'discussions.user_id')->where(['user_id' => Auth::id(), 'solved' => false])->get(['discussions.*', 'users.name as user_name']);
         }
        }
        return view('discussions.usershow', ['discussions' => $discussions, 'categories' => $categories, 'users' => $users]);
    }
    public function solved($slug){
        $discussion = Discussion::where('slug', $slug)->get()->first();
        $discussion->update(['solved' => !$discussion->solved]);
        return $discussion;
    }
    public function create(){
        $categories = Category::all();
        $user = User::findOrFail(Auth::id());
        $user->increment('reputation', 10);
        return view('discussions.create', ['categories' => $categories]);
    }
    public function save(){
        $category = Category::findOrFail(request('category'));
        $discussion = new Discussion();
        $discussion->user_id = Auth::id();
        $discussion->title = request('title');
        $discussion->slug = Str::slug($discussion->title);
        $discussion->content = request('content');
        $discussion->category_id = $category->id;  
        $discussion->save();
        return redirect('/discussions');
    }
    public function vote($slug){
        $discussion = Discussion::where('slug', $slug)->get()->first();
        $user = User::findOrFail($discussion->user_id);
        if(request('vote') == 'up'){
            $discussion->increment('vote');
            $user->increment('reputation', 20);
        }
        else{
            $discussion->decrement('vote');
            $user->deccrement('reputation', 20);
        }
        return back();
    }
    public function answer(){
        $answer = new Answer();
        $answer->user_id = Auth::id();
        $answer->discussion_id = request('discussion_id');
        $answer->content = request('content');
        $answer->save();
        $user = User::findOrFail($answer->user_id);
        $user->increment('reputation', 10);
        return back();
    }
}
