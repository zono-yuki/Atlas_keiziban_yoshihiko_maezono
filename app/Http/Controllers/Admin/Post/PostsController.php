<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // カテゴリー追加画面
    public function postCategoryIndex(){
        return view("post_category.admin.index");
    }
}
