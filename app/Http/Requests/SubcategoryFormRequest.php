<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryFormRequest extends FormRequest
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
            'post_main_category_id' => 'required',

            'sub_category' => 'required|string|min:1|max:100|unique:post_sub_categories,sub_category',


        ];
    }


    public function messages() //エラーメッセージ
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'post_main_category_id.required' => 'メインカテゴリーは入力必須です。',

            'sub_category.required' => 'サブカテゴリーは入力必須です。',
            'sub_category.min ' => 'サブカテゴリーは1文字以上で入力して下さい。',
            'sub_category.max' => 'サブカテゴリーは100文字以下で入力して下さい。',
            'sub_category.unique' => '登録済みのサブカテゴリーです。',
        ];
    }
}
