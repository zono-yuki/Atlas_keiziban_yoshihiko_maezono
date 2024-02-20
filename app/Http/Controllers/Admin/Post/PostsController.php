<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Posts\PostMainCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // カテゴリー追加画面
    public function postCategoryIndex(){
        //viewで表示する時に、PostMainCategoryテーブルの情報を第二引数では渡す。['渡す先での変数名' => 今回渡す値]
        return view('post_category.admin.index',['post_main_categories' => PostMainCategory::postMainCategoryLists(),
        ]);
    }
}
