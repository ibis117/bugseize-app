<?php

use App\Actions\User\UserRecentExceptions;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Opekunov\Centrifugo\Centrifugo;

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

Route::get('/centrifuge', function () {
    $user = User::first();
//    Auth::loginUsingId($user->id);
    $centrifuge = new Centrifugo();
    $response = $centrifuge->broadcast(['alert'], [
        'message' => 'Hello'
    ]);

    dd($response);
//    return $centrifuge->generateConnectionToken($user->id);
});


Route::get('{path}', function () {
    return view('app');
})->where('path', '(.*)');
