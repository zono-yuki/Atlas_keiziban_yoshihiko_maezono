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

// Route::get('/', function () {
//     return view('welcome');
// });

//ログアウト中のページ(ログアウトしている人しか見れない)
Route::group(['middleware' => ['guest']], function (){
    //ログイン関連の処理
    Route::namespace('Auth')->group(function (){
        Route::namespace('login')->group(function (){
            //ログイン画面
            Route::get('/login','LoginController@loginForm')->name('login.form');
            //ログイン処理
            Route::post('/login', 'LoginController@login')->name('login');
        });
        Route::namespace('Register')->group(function () {
            //ユーザー登録画面
            Route::get('/register/form', 'RegisterController@registerForm')->name('register.form');
            //ユーザー登録処理
            Route::post('/register', 'RegisterController@register')->name('register');
            //ユーザー登録完了画面
            Route::get('/register/added', 'RegisterController@registerAdded')->name('register.added');
        });
    });
});
