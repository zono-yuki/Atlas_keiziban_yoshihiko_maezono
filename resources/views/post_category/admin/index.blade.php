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

  <!-- 新規メインカテゴリー登録フォーム -->
  <form action="{{ route('main_store') }}" method="post" class="category_new_form">
   @csrf
    <div class="">
      <p class="thank_you">新規メインカテゴリー</p>
    </div>
    <input type="text" name="main_category" class="text_category">
    <button type="submit" class="button_category_create">登録</button>
  </form>


  </section>

<!-- カテゴリー一覧 -->
  <section class="right_index">
    <div class="">
      <p class="thank_you">カテゴリー一覧</p>
    </div>

  </section>
</div>

<!-- 戻るボタン -->
<div class="text-center mt-5">
  <a href="{{ route('post.index') }}"><button type="submit" class="button">戻る</button></a>
</div>


@endsection

@include('layout.login.footer')
