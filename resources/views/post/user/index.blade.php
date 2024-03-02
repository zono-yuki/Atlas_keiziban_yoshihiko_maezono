@extends('layout.login.common')
@section('title','掲示板一覧ページ')
@include('layout.login.header')

@section('content')
<!-- ログインする -->


<!-- ヘッダー -->
<header class="admin-header">
  <div class="original-gradient">
    <div class="mb-2 ml-5">
      <p class="thank_you">掲示板投稿一覧</p>
    </div>
    <div class="text-right mr-4 mb-3">
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
    </div>
  </div>
</header>


<!-- 投稿とカテゴリー -->
<div class="inner">
  <div class="main_index">

    <!-- 投稿(左半分)-->
    <section class="left_index">

      @foreach($post_lists as $post_list)

      <div class="post_block">
        <ul class="posts_padding">
          <li class="posts_flex mb-2">
            <p>{{ $post_list->user->username }}さん</p>
            <p>{{ date("Y年m月d日 H:i",strtotime($post_list->event_at)) }}</p>
            <p>〇〇View</p>
          </li>

          <li class="mb-3">
            <p>{{ $post_list->title }}</p>
          </li>

          <li class="posts_flex">
            <p>{{ $post_list->postSubCategory->sub_category }}</p>
            <p class="text-danger">コメント数</p>
            <p class="text-danger">{{ $post_list->postComments->count() }}</p>
            <p class="text-danger">いいね数</p>
            <p><a href="{{ route('post.show' ,[$post_list->id]) }}">詳細ページへ</a></p>
          </li>

        </ul>
      </div>
      @endforeach
    </section>

    <!-- カテゴリー（右半分） -->
    <section class="right_index">
      @can('admin')
      <a class="create_margin" href="{{ route('post_category.index') }}">
        <button type="submit" class="button_category">カテゴリーを追加</button></a>
      @endcan
      {{-- @if(Auth::user()->admin_role == 1)
      @endif でもOK --}}
      <a class="create_margin" href="{{ route('post.create') }}">
        <button type="submit" class="button_category_blue">投稿</button>
      </a>
    </section>
  </div>
</div>



@endsection

@include('layout.login.footer')
