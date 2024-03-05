<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class PostComment extends Model
{
    protected $table = 'post_comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

    //Userとのリレーション
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User', 'user_id');
    }

    //Userとのリレーション（多対多）
    public function userCommentFavoriteRelations()
    {
        return $this->belongsToMany('App\Models\Users\User', 'post_comment_favorites', 'post_comment_id' , 'user_id');
    }

    //投稿に対するコメントのいいね登録、削除処理
    public static function postCommentFavoriteCreateOrDestroy($post_comment_id, $post_comment_favorite_id)
    {
        $post_comment_detail = self::findOrFail($post_comment_id);
        if($post_comment_favorite_id){
            return $post_comment_detail->userCommentFavoriteRelations()->detach(Auth::id());//中間テーブルのレコード削除
        } else{
            return $post_comment_detail->userCommentFavoriteRelations()->attach(Auth::id());//中間テーブルのレコード登録
        }
    }

    //　コメントに対してログインしているユーザーがいいねしているかどうかの判断（nullだったらtrueを返す)
    public static function commentFavoriteIsExistence($post_comment_detail)
    {
        return is_null($post_comment_detail->userCommentFavoriteRelations->find(Auth::id()));
    }

    //----------------------------------------------------
    //クエリ作成（N＋1対策）
    public static function commentQuery()
    {
        return self::with([
            'user',
            'userCommentFavoriteRelations',
        ]);
    }
    //コメントidからコメントデータを1つ取得する
    public static function commentDetail($id)
    {
        return self::commentQuery()->findOrFail($id);
    }
    // ---------------------------------------------------

    //コメントの更新処理
    public static function commentUpdate($request,$comment_detail)
    {
        // dd($comment_detail);
        $data['comment'] = $request->comment;
        return $comment_detail->fill($data)->save();
    }

    //コメントの削除
    public static function commentDestroy($id)
    {
        // コメントを飛んできたコメントidから探す処理
        $comment = PostComment::findOrFail($id);
        // コメントの削除
        $comment->delete();
    }
}
