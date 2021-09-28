<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Rules\ConfirmPass;
use App\Models\Discussion;
use App\Models\Category;

class UserController extends Controller
{
    //
    public function index($id){
        $categories = DB::table('categories')->get();
        $user = User::findOrFail($id);
        $discussions = DB::table('discussions')->where('user_id', $user->id)->get();
        $discussions = count($discussions);
        $answered = DB::table('discussions')->where('user_id', $user->id)->where('solved', 1)->get();
        $answered = count($answered);
        $answers = DB::table('answers')->where('user_id', $user->id)->get();
        $answers = count($answers);
        return view('users.index', ['user' => $user, 'discussions' => $discussions,'answered' => $answered, 'answers' => $answers, 'categories' => $categories]);
    }
    public function edit() {
        $user = User::findOrFail(Auth::id());
        $categories = DB::table('categories')->get();
        return view('users.edit', ['user' => $user, 'categories' => $categories]);
    }
    public function update(){
        $user = User::findOrFail(Auth::id());
        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if(!$validated){
            $name = request()->old('name');
            $email = request()->old('email');
        }
        else{
            $user->name = request('name');
            $user->email = request('email');
            $user->save();
            return back();
        }
    }
    public function editPass(){
        $user = User::findOrFail(Auth::id());
        $categories = DB::table('categories')->get();
        return view('users.editpass', ['user' => $user, 'categories' => $categories]);
    }
    public function updatePass(){
        $user = User::findOrFail(Auth::id());
        $validated = request()->validate([
            'currentpassword' => ['required', new ConfirmPass($user->password)],
            'newpassword' => 'required|confirmed'
        ]);
        if($validated){
            $user->password = Hash::make(request('newpassword'));
            $user->save();
            return back();
            }
        }
}
