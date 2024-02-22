<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;

class PostsController extends Controller
{
    // 掲示板一覧ページを表示する
    public function index()
    {
        return view("post.user.index");
    }

    // 投稿ページを表示する
    public function create()
    {
        return view("post.user.create",[
            'post_main_categories' => PostMainCategory::postMainCategoryLists(),
        ]);
    }

    // 投稿処理
    public function store()
    {
        
    }
}
