<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'項目名' => '検証ルール｜検証ルール｜検証ルール',
            'username' => 'required|string|min:1|max:30',
            'email' => 'required|string|min:11|max:100|unique:users,email|email', //usersテーブルのmailカラムで一意メールアドレスの形式であるかどうか
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:1|max:30|confirmed:password',
            'password_confirmation' => 'required|regex:/^[a-zA-Z0-9]+$/|min:1|max:30'
        ];
    }

    public function messages() //エラーメッセージ
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'username.required' => 'ユーザー名は入力必須です。',
            'username.min ' => 'ユーザー名は1文字以上で入力して下さい。',
            'username.max' => 'ユーザー名は30文字以下で入力して下さい。',

            'email.required' => 'メールアドレスは入力必須です。',
            'email.min' => 'メールアドレスは11文字以上で入力して下さい。',
            'email.max' => 'メールアドレスは100文字以下で入力して下さい。',
            'email.unique' => '登録済みのメールアドレスは使用不可です。',
            'email.email' => 'メールアドレスの形式で入力して下さい。',

            'password.required' => 'パスワードは入力必須です。',
            'password.regex' => 'パスワードは英数字のみで入力して下さい。',
            'password.min' => 'パスワードは1文字以上で入力して下さい。',
            'password.max' => 'パスワードは30文字以下で入力して下さい。',
            'password.confirmed' => 'パスワードが一致しません。',

            'password_confirmation.required' => 'パスワード（確認）は入力必須です。',
        ];
    }
}
