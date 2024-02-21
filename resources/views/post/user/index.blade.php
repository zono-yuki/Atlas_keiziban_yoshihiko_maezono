@extends('layout.login.common')
@section('title','掲示板一覧ページ')
@include('layout.login.header')

@section('content')
<!-- ログインする -->


<!-- ヘッダー -->
<header class="login-header">
  <div class="original-gradient">
    <div class="">
      <p class="thank_you ml-5">掲示板投稿一覧</p>
    </div>
    <div class="text-right mr-4">
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
    </div>
  </div>
</header>


<!-- 投稿とカテゴリー -->
<div class="inner">
  <div class="main_index">
    <!-- 投稿-->
    <section class="left_index">
      <p class="thank_you">投稿一覧</p>
    </section>
    <!-- カテゴリー -->
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
