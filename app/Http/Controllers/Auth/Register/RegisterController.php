<?php

namespace App\Http\Controllers\Auth\Register;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // 新規登録画面を表示する
    public function registerForm()
    {
        return view('auth.register_form');
    }

    // 新規登録処理
    public function register(Request $request)
    {
        // dd($request->all());

        $user = new User;

        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        // bcryptとはハッシュ化すること

        // dd($data);

        $user->fill($data)->save();

        return redirect()->route('register.added');
    }

    public function registerAdded()
    {
        return view('auth.register_added');
    }
}
