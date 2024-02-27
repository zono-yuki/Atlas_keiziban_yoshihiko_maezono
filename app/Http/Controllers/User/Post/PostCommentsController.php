<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    // コメント投稿処理
    public function store(Request $request, $id)
    {
        // dd($id);投稿idが飛んでくる。

        $user_id = Auth::user()->id;
        $post_id = $id;
        $comment = $request->input('comment');

        //post_Commentsテーブルに登録
        PostComment::insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $comment,
            'event_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //コメント投稿したら、投稿詳細画面に戻る。
        return redirect()->route('post.show',[$post_id]);
    }
}
