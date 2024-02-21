@extends('layout.login.common')
@section('title','カテゴリー追加ページ')
@include('layout.login.header')

@section('content')
<!-- ログインする -->


<!-- ヘッダー -->
<header class="admin_header">
  <div class="original-gradient">
    <div class="mb-2 ml-5">
      <p class="thank_you">新規投稿画面</p>
    </div>
    <div class="text-right mr-4 mb-3">
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
    </div>
  </div>
</header>

<div class="inner">



  <!-- 戻るボタン -->
  <div class="text-center mt-5">
    <a href="{{ route('post.index') }}"><button type="submit" class="button">戻る</button></a>
  </div>

</div>


@endsection

@include('layout.login.footer')
