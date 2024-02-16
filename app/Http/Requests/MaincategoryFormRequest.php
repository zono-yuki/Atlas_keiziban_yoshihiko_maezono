<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaincategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //フォームリクエストを使う際は、ここをfalseからtrueに変えないと、403エラーになるので、trueに変える。
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
            'main_category' => 'required|string|min:1|max:100|unique:post_main_categories,main_category',
        ];
    }

    public function messages() //エラーメッセージ
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'main_category.required' => 'メインカテゴリーは入力必須です。',
            'main_category.min ' => 'メインカテゴリーは1文字以上で入力して下さい。',
            'main_category.max' => 'メインカテゴリーは100文字以下で入力して下さい。',
            'main_category.unique' => '登録済みのメインカテゴリーです。',

        ];
    }
}
