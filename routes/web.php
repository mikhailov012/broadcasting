<?php

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

use App\Events\ChatMessage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::get('/test', function () {

    /** @var \App\User $user */
    $user = \Illuminate\Support\Facades\Auth::user();

    if ($user) {

        /** @var \App\Message $message */
        $message = $user->messages()->create([
            'message' => rand(1, 99999)
        ]);

//        event(new ChatMessage($message->fresh()));
        broadcast(new ChatMessage($message->fresh()));
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
