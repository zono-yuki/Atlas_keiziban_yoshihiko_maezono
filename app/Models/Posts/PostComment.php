<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

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

    //----------------------------------------------------
    //クエリ作成（N＋1対策）
    public static function commentQuery()
    {
        return self::with([
            'user',
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
