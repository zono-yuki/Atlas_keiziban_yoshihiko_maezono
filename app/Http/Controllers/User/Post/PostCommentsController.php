<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostCommentFavorite;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentUpdateFormRequest;
use App\Http\Requests\CommentFormRequest;


class PostCommentsController extends Controller
{
    // コメント投稿処理
    public function store(CommentFormRequest $request, $id)
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

    //コメント編集画面を表示する/コメントIDが飛んでくる。
    public function edit($id)
    {
        //コメントIDから1つのデータを引っ張ってくる。
        $comment_detail = PostComment::commentDetail($id);
        // dd($comment_detail);

        //コメントの投稿者であるか、管理者であるかを確認する。
        if (User::contributorAndAdmin($comment_detail->user_id)) {
            //コメント投稿者か管理者であるので、コメント編集ページを表示する。
            return view(
                'post_comment.user.edit',['comment_detail' => $comment_detail,]
            );
        }
        //コメント投稿者か管理者でなければ、403エラーを表示させる。
        return \App::abort(403, 'あなたはコメントしていないので、入れません!!。Unauthorized action.');
    }

    //コメント編集処理
    public function update(CommentUpdateFormRequest $request ,$id)
    {
        //コメントidからコメントを取得する $idは投稿id
        $comment_detail = PostComment::commentDetail($id);

        //投稿者や管理者かどうかを選別する
        if (User::contributorAndAdmin($comment_detail->user_id)) {
            //コメントの更新処理を行う。
            $comment_detail->commentUpdate($request, $comment_detail);
            //詳細画面へ戻る
            return redirect()->route('post.show', [$comment_detail->post_id]);
        }
        //エラー画面を表示
        return \App::abort(403, 'Unauthorized action.');
    }

    //コメント削除処理
    public function destroy($id)
    {
        //コメントの投稿を探す処理（削除後に詳細画面に戻るために投稿idが必要）
        $comment_detail = PostComment::commentDetail($id);
        //削除処理
        PostComment::commentDestroy($id);
        return redirect()->route('post.show', [$comment_detail->post_id]);
    }
}
