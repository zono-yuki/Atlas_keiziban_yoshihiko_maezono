<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Http\Requests\PostFormRequest;
use App\Http\Requests\PostUpdateFormRequest;


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

    //掲示板詳細画面を表示する/投稿IDが飛んでくる。
    public function show($id)//投稿のID
    {
        return view('post.user.show', [
            'post_detail' => Post::postDetail($id),
        ]);
    }

    //投稿編集画面を表示する/投稿IDが飛んでくる。
    public function edit($id)
    {
        //投稿IDから1つのデータを引っ張ってくる。
        $post_detail = Post::postDetail($id);

        //投稿者か管理者かを確認する。
        if(User::contributorAndAdmin($post_detail->user_id))
        {
            //投稿者か管理者であるので、投稿編集ページを表示する。
            return view('post.user.edit',
            ['post_detail' => $post_detail,
            'post_main_categories' => PostMainCategory::postMainCategoryLists(),
            ]);
        }
        //投稿者か管理者でなければ、403エラーを表示させる。
        return \App::abort(403, 'あなたは誰でしょうか？入れません!!。Unauthorized action.');
    }

    //投稿編集update処理
    public function update(PostUpdateFormRequest $request, $id)
    {
        //投稿idから投稿を取得する $idは投稿id
        $post_detail = Post::postDetail($id);

        //投稿者や管理者かどうかを選別する
        if(User::contributorAndAdmin($post_detail->user_id)){
            //更新処理を行う。
            $post_detail->postUpdate($request,$post_detail);
            //詳細画面へ戻る
            return redirect()->route('post.show', [$id]);
        }
        //エラー画面を表示
        return \App::abort(403, 'Unauthorized action.');
    }

    //投稿削除処理（投稿者、管理者のみ）
    public function destroy($id)
    {
        Post::postDestroy($id);
        return redirect()->route('post.index');
    }

}
