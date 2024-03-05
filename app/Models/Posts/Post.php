<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    //ActionLogとのリレーション
    public function actionLogs()
    {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }

    //Userとのリレーション（多対多）
    public function userPostFavoriteRelations()
    {
        return $this->belongsToMany('App\Models\Users\User', 'post_favorites', 'post_id' , 'user_id');
    }

    //掲示板の投稿のいいね登録、削除処理
    public static function postFavoriteCreateOrDestroy($post_id, $post_favorite_id)
    {
        $post_detail = self::findOrFail($post_id);
        if($post_favorite_id){
            return $post_detail->userPostFavoriteRelations()->detach(Auth::id());//中間テーブルのレコード削除
        } else{
            return $post_detail->userPostFavoriteRelations()->attach(Auth::id());//中間テーブルのレコード登録
        }
    }

    //　投稿に対してログインしているユーザーがいいねしているかどうかの判断（nullだったらtrueを返す)
    public static function postFavoriteIsExistence($post_detail)
    {
        return is_null($post_detail->userPostFavoriteRelations->find(Auth::id()));
    }

//----------------------------------------------------
    //クエリ作成（N＋1対策）
    public static function postQuery()
    {
        return self::with([
            //リレーション名を書く。
            'user',
            'userPostFavoriteRelations',
            'postSubCategory',
            'postComments.user',
            'actionLogs'
            //postCommentsのuserメソッドとのリレーションで、postテーブルのuser_idと同じユーザーをuserからもってくる
        ]);
    }

    //投稿idから投稿データを1つ取得する
    public static function postDetail($id)
    {
        return self::postQuery()->findOrFail($id);
    }

    // ---------------------------------------------------
    //投稿一覧を表示するために投稿データを全て取得する
    public static function postLists()
    {
        return self::postQuery()->get();
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
