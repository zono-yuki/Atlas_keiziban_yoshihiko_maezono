<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';

    protected $fillable = [
        'main_category',
    ];

    // PostSubCategoryとのリレーション
    public function postSubCategories()
    {
        return $this->hasMany('App\Models\Posts\PostSubCategory');
    }

    // クエリ作成  表示の速度に負荷がかかることを避ける。
    public static function postMainCategoryQuery()
    {
        return self::with('postSubCategories');
    }

    //  メインカテゴリー一覧取得（処理の時間短縮 & 一覧取得）
    public static function postMainCategoryLists()
    {
        return self::postMainCategoryQuery()->get();
    }

    //メインカテゴリーの削除
    public static function postMainCategoryDestroy($id)
    {
        // 対象のレコードを探す処理
        $post_main_category = PostMainCategory::findOrFail($id);
        // レコードの削除
        $post_main_category->delete();
    }

    //メインカテゴリーに紐づいたサブカテゴリーがあるかどうか判断する
    public static function postSubCategoryIsExistence($post_main_category)
    {
        return $post_main_category->postSubCategories->isEmpty();
    }
}
