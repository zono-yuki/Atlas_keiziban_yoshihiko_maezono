@extends('layout.login.common')
@section('title','投稿編集画面')
@include('layout.login.header')

@section('content')
<!-- ログインする -->


<!-- ヘッダー -->
<header class="admin-header">
  <div class="original-gradient">
    <div class="mb-2 ml-5">
      <p class="thank_you">投稿編集画面</p>
    </div>
    <div class="text-right mr-4 mb-3">
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
    </div>
  </div>
</header>



<!-- 戻るボタン -->
<div class="text-center mt-5">
    <a href="{{ route('post.index') }}"><button type="submit" class="button">TOPへ戻る</button></a>
</div>

@endsection

@include('layout.login.footer')
