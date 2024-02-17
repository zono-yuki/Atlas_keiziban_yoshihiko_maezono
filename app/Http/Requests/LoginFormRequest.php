<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'email' => 'required|string|min:11|max:100|email',

            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:1|max:30',
        ];
    }

    public function messages() //エラーメッセージ
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'email.required' => '※メールアドレスは入力必須です。',
            'email.min' => '※メールアドレスは11文字以上で入力して下さい。',
            'email.max' => '※メールアドレスは100文字以下で入力して下さい。',
            'email.email' => '※メールアドレスの形式で入力して下さい。',



            'password.required' => '※パスワードは入力必須です。',
            'password.regex' => '※パスワードは英数字のみで入力して下さい。',
            'password.min' => '※パスワードは1文字以上で入力して下さい。',
            'password.max' => '※パスワードは30文字以下で入力して下さい。',
        ];
    }
}
