<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\Post;
use App\Http\Requests\PostFormRequest;

class PostsController extends Controller
{
    // 掲示板一覧ページを表示する
    public function index()
    {
        // dd(Post::postLists());
        return view('post.user.index', [
            'post_lists' => Post::postLists(),
        ]);
    }

    // 投稿ページを表示する
    public function create()
    {
        return view("post.user.create",[
            'post_main_categories' => PostMainCategory::postMainCategoryLists(),
        ]);
    }

    // 投稿処理
    public function store(PostFormRequest $request)
    {
        // dd($request);
        $user_id = Auth::user() -> id;
        $post_sub_category_id = $request->input('post_sub_category_id');
        $title = $request->input('title');
        $post = $request->input('post');

        //Postテーブルに登録
        Post::insert([
            'user_id' => $user_id,
            'post_sub_category_id' => $post_sub_category_id,
            'title' => $title,
            'post' => $post,
            'event_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('post.index');
    }

    public function show($id)//投稿のID
    {
        return view('post.user.show', [
            'post_detail' => Post::postDetail($id),
        ]);
    }
}
