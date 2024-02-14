@extends('layout.login.common')
@section('title','カテゴリー追加ページ')
@include('layout.login.header')

@section('content')
<!-- ログインする -->

<!-- ヘッダー -->
<div class="original-gradient">
  <div class="">
    <p class="thank_you">カテゴリー追加画面</p>
  </div>
  <div class="text-right mr-4">
    <a  class= "logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
  </div>
</div>

<!-- カテゴリー -->
<div class="main_index">

<!-- 新規メインカテゴリーなど-->
  <section class="left_index">

  </section>

<!-- カテゴリー一覧 -->
  <section class="right_index">

  </section>
</div>

<!-- 戻るボタン -->
<div class="text-center">
  <a href="{{ route('post.index') }}"><button type="submit" class="button">戻る</button></a>
</div>


@endsection

@include('layout.login.footer')
