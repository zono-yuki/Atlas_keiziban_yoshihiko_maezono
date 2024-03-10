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


    //Postとのリレーション 1対多
    public function post()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }

    //掲示板の投稿があるかどうかの判断
    public function postIsExistence($post_sub_category)
    {
        return $post_sub_category->post->isEmpty();
    }

    //サブカテゴリーの削除処理
    public static function postSubCategoryDestroy($id)
    {
        $post_sub_category = PostSubCategory::findOrFail($id);
        if($post_sub_category -> postIsExistence($post_sub_category)){
            $post_sub_category -> delete();
        }
        // return \App::abort(404);
    }
}
