<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    //Userとのリレーション
    public function user()
    {
        //多対1の（多側からみたリレーション）
        return $this->belongsTo('App\Models\Users\User', 'user_id');
    }

    //PostSubCategoryとのリレーション
    public function postSubCategory()
    {
        //多対1の（多側からみたリレーション）
        return $this->belongsTo('App\Models\Posts\PostSubCategory', 'post_sub_category_id');
    }

    //PostCommentとのリレーション
    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }


//----------------------------------------------------
    //クエリ作成（N＋1対策）
    public static function postQuery()
    {
        return self::with([
            'user',
            'postSubCategory',
            'postComments.user',
            //postCommentsのuserメソッドとのリレーションで、postテーブルのuser_idと同じユーザーをuserからもってくる
        ]);
    }

    //投稿一覧を表示するために投稿データを全て取得する
    public static function postLists()
    {
        return self::postQuery()->get();
    }
// ---------------------------------------------------

    //投稿idから投稿データを1つ取得する
    public static function postDetail($id)
    {
        return self ::postQuery()->findOrFail($id);
    }

    // ---------------------------------------------------

    //投稿の更新処理
    public static function postUpdate($request, $post_detail)
    {
        $data['post_sub_category_id'] = $request->post_sub_category_id;
        $data['title'] = $request->title;
        $data['post'] = $request->post;
        return $post_detail->fill($data)->save();
    }

    //投稿の削除
    public static function postDestroy($id)
    {
        // 投稿を探す処理
        $post = Post::findOrFail($id);
        // 投稿の削除
        $post->delete();
    }

    //投稿に対してのコメントがあるかどうかの判断(nullならtrueを返す)
    public static function postCommentIsExistence($post_detail)
    {
        return $post_detail -> postComments ->isEmpty();
    }

}
