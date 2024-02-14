<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // 掲示板一覧ページを表示する
    public function index()
    {
        return view("post.user.index");
    }
}
