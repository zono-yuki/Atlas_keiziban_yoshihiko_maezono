<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Posts\PostMainCategory;//追加
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;//追加
use Illuminate\Http\Request;

class PostMainCategoriesController extends Controller
{
    public function store(Request $request){

        $main_category = new PostMainCategory;
        $data['main_category'] = $request->main_category;


        $main_category->fill($data)->save();

        return redirect()->route('post_category.index');
    }
}
