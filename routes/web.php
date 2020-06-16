<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/tweets', 'TweetController', [
        'only' => ['store', 'index']
    ]);

    Route::post('/profiles/{user:username}/follow', 'FollowsController@store');
    Route::get('/profiles/{user:username}/edit', 'ProfileController@edit');
    Route::patch('/profiles/{user:username}', 'ProfileController@update');
});

Route::get('/profiles/{user:username}', 'ProfileController@show')->name('profile');

Auth::routes();

