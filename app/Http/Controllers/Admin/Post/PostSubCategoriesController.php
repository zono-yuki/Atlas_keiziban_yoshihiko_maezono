<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory; //追加
use App\Models\Posts\PostSubCategory;//追加

class PostSubCategoriesController extends Controller
{
    public function store(Request $request)
    {

        // dd($request);

        $sub_category = new PostSubCategory;
        $data['post_main_category_id'] = $request->post_main_category_id;
        $data['sub_category'] = $request->sub_category;

        $sub_category->fill($data)->save();

        // return redirect()->route('post_category.index');

        //登録完了画面へ
        return redirect()->route('sub_category_add');
    }

    public function SubCategoryAdded()
    {
        return view('post_category.admin.sub_category_added');
    }
}
