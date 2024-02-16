<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Posts\PostMainCategory;//追加
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;//追加
use Illuminate\Http\Request;
use App\Http\Requests\MaincategoryFormRequest;

class PostMainCategoriesController extends Controller
{
    public function store(MaincategoryFormRequest $request){

        $main_category = new PostMainCategory;
        $data['main_category'] = $request->main_category;


        $main_category->fill($data)->save();

        // return redirect()->route('post_category.index');

        //登録完了画面へ
        return redirect()->route('main_category_add');
    }

    public function MainCategoryAdded()
    {
        return view('post_category.admin.main_category_added');
    }
}
