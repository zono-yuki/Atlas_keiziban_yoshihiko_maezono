<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    //サブカテゴリーの削除
    public static function postSubCategoryDestroy($id)
    {
        // 対象のレコードを探す処理
        $post_sub_category = PostSubCategory::findOrFail($id);
        // レコードの削除
        $post_sub_category -> delete();
    }


}
