<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Answer;
use App\Models\Discussion;


class AnswerController extends Controller
{
    //
    public function accept($id){
        $answer = Answer::findOrFail($id);
        $user = User::findOrFail($answer->user_id);
        if($answer->accepted == 0){
            $user->increment('reputation', 50);
        }
        else{
            $user->decrement('reputation', 50);
        }
        $answer->update(['accepted' => !$answer->accepted]);

        $discussion = Discussion::where('slug', request('slug'))->get()->first();
        $discussion->update(['solved' => !$discussion->solved]);
        return back();
    }
    public function vote($id){
        $answer = Answer::findOrFail($id);
        $user = User::findOrFail($answer->user_id);
        if(request('vote') == 'up'){
            $answer->increment('vote');
            $user->increment('reputation', 20);
        }
        else{
            $answer->decrement('vote');
            $user->decrement('reputation', 20);
        }
        return back();
    }
}
