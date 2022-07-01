<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;

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


Route::resource('/newuser', UserController::class);

Route::resource('/board', BoardController::class);

Route::group(['namespace' => 'App\Http\Controllers'], function(){

    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function(){
        /**
         *  회원가입 라우트
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');
        /**
         *  로그인 라우트
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function(){
        /**
         * 로그아웃 라우트
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

    Route::post('/comment', 'CommentController@store')->name('comment.write');
    Route::delete('/comment/{id}','CommentController@destroy')->name('comment.delete');
});
