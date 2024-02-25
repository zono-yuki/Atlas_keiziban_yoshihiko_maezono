@extends('layout.login.common')
@section('title','掲示板詳細')
@include('layout.login.header')

@section('content')
<!-- ログインする -->


<!-- ヘッダー -->
<header class="admin-header">
  <div class="original-gradient">
    <div class="mb-2 ml-5">
      <p class="thank_you">掲示板詳細</p>
    </div>
    <div class="text-right mr-4 mb-3">
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
    </div>
  </div>
</header>

<div class="inner">
  <div class="main_post">


      <div class="post_detail_block">
        <ul class="posts_detail_padding">
          <li class="posts_flex mb-3">
            <div class="post_name_at">
              <p>{{ $post_detail->user->username }}さん</p>
              <!-- 秒数消す -->
             <p>{{ date("Y年m月d日 H:i",strtotime($post_detail->event_at)) }}</p>
            </div>

            <p>〇〇View</p>
          </li>

          <li class="posts_flex mb-3">
            <p class="post_title_font">{{ $post_detail->title }}</p>

            <!-- 投稿者か管理者のみが編集ボタンが表示される -->
            @if(Auth::user()->contributorAndAdmin($post_detail->user_id))
              <a href="{{ route('post.edit',[$post_detail->id]) }}"><button type="submit" class="button_detail_update">編集</button></a>
            @endif

          </li>

          <li class="posts_flex mb-3">
            <p class="post_body_font">{{ $post_detail->post }}</p>
          </li>

          <li class="posts_flex">
            <p class="detail_sub_category">{{ $post_detail->postSubCategory->sub_category }}</p>
            <div class="comment_like">
              <p class="">コメント数</p>
              <p class="">いいね数</p>
            </div>

          </li>

        </ul>
      </div>


        <!-- 戻るボタン -->
        <div class="text-center mt-5">
          <a href="{{ route('post.index') }}"><button type="submit" class="button">戻る</button></a>
        </div>
  </div>
</div>



@endsection

@include('layout.login.footer')
