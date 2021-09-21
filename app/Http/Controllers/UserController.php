<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Discussion;
use App\Models\Category;

class UserController extends Controller
{
    //
    public function index(){
        $categories = Category::all();
        $user = User::findOrFail(Auth::id());
        $discussions = Discussion::where('user_id', $user->id)->get();
        return view('users.index', ['user' => $user, 'discussions' => $discussions, 'categories' => $categories]);
    }
}
