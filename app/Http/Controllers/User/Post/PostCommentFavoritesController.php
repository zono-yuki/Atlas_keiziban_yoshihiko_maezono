<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Users\User;

class PostCommentFavoritesController extends Controller
{
    public function postCommentFavorite(Request $request)
    {
        $post_comment_id = $request->post_comment_id;
        $post_comment_favorite_id = $request->post_comment_favorite_id;
        PostComment::postCommentFavoriteCreateOrDestroy($post_comment_id, $post_comment_favorite_id);//中間テーブルのレコードの削除追加処理へ

        //　中間テーブルから、いいねの数を数えて返している
        $post_comment_favorite_count = PostComment::commentDetail($post_comment_id)->userCommentFavoriteRelations->count();

        return [$post_comment_favorite_id, $post_comment_favorite_count];
    }
}
