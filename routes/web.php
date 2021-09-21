<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('welcome');
});
Route::get('/discussions', [DiscussionController::class, 'index']);
Route::get('/discussions/create', [DiscussionController::class, 'create']);
Route::get('/discussions/myquestions', [DiscussionController::class, 'users'])->middleware('auth');
Route::post('/discussions', [DiscussionController::class, 'save']);
Route::post('/discussions/vote/{slug}', [DiscussionController::class, 'vote']);
Route::get('/discussions/{slug}', [DiscussionController::class, 'show']);
Route::post('/discussions/{slug}', [DiscussionController::class, 'solved']);
Route::post('/answers', [DiscussionController::class, 'answer']);
Route::post('/answers/{id}', [AnswerController::class, 'accept']);
Route::post('/answers/vote/{id}', [AnswerController::class, 'vote']);
Route::get('/profile', [UserController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
