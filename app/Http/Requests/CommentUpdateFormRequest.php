<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateFormRequest extends FormRequest
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
            'comment' => 'required|string|min:1|max:2500',
        ];
    }

    public function messages() //エラーメッセージ
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'comment.required' => 'コメントは入力必須です。',
            'comment.min' => 'コメントは1文字以上で入力して下さい。',
            'comment.max' => 'コメントは100文字以下で入力して下さい。',
        ];
    }
}
