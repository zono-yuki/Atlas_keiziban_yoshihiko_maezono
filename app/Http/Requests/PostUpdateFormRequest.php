<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateFormRequest extends FormRequest
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
            'post_sub_category_id' => 'required|exists:post_sub_categories,id',
            'title' => 'required|string|min:1|max:100',
            'post' => 'required|string|min:1|max:5000',
        ];
    }

    public function messages() //エラーメッセージ
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'post_sub_category_id.required' => 'サブカテゴリーは入力必須です。',
            'post_sub_category_id.exists' => '登録されているサブカテゴリーを選択してください。',

            'title.required' => 'タイトルは入力必須です。',
            'title.min' => 'タイトルは1文字以上で入力して下さい。',
            'title.max' => 'タイトルは100文字以下で入力して下さい。',

            'post.required' => '投稿内容は入力必須です。',
            'post.min' => '投稿内容は1文字以上で入力して下さい。',
            'post.max' => '投稿内容は100文字以下で入力して下さい。',
        ];
    }
}
