@extends('layout.login.common')
@section('title','掲示板一覧ページ')
@include('layout.login.header')

@section('content')
<!-- ログインする -->

<!-- ヘッダー -->
<div class="original-gradient">
  <div class="">
    <p class="thank_you">掲示板投稿一覧</p>
  </div>
  <div class="text-right mr-4">
    <a  class= "logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
  </div>
</div>

<!-- 投稿とカテゴリー -->
<div class="main_index">
<!-- 投稿-->
  <section class="left_index">
    <p>投稿</p>
  </section>
<!-- カテゴリー -->
  <section class="right_index">
    @can('admin')
    <a href="{{ route('post_category.index') }}">
    <button type="submit" class="button_category">カテゴリーを追加</button></a>
    @endcan

    {{-- @if(Auth::user()->admin_role == 1)
    @endif でもOK --}}
  </section>
</div>


@endsection

@include('layout.login.footer')
