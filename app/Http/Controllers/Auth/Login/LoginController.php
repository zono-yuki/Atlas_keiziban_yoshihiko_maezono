<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;

class LoginController extends Controller
{
    // ログイン画面を表示する
    public function loginForm(){

        return view("auth.login");
    }



    public function  login(LoginFormRequest $request)
    {
        $data['email'] = $request->email;
        $data['password'] = $request->password;

        // dd($data);
        if(Auth::attempt($data)){
            // usersテーブルからemailとPsswordが合っているか確認している
            return redirect()->route('post.index');
            // もし合っていれば、ログイン後のページに遷移する
        }
        return back()
        ->with('login_error', '※メールアドレスまたはパスワードが違います。');
        // もし間違っていたら、元のページに戻り、メッセージを返す。
    }

    public function logout()
    {
        Auth::logout();//ログアウト処理
        return redirect()->route('login.form');
    }








}
