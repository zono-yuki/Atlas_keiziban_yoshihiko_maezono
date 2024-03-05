<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use Illuminate\Support\Facades\Auth;

class PostFavoritesController extends Controller
{
    public function postFavorite(Request $request)
    {
        $post_id = $request->post_id;
        $post_favorite_id = $request->post_favorite_id;
        Post::postFavoriteCreateOrDestroy($post_id, $post_favorite_id);//中間テーブルのレコードの削除追加処理へ

        //　中間テーブルから、いいねの数を数えて返している
        $post_favorite_count = Post::postDetail($post_id)->userPostFavoriteRelations->count();

        return [$post_favorite_id, $post_favorite_count];
    }
}
