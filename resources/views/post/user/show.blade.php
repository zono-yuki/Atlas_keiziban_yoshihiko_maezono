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
    <div class="flex_name_logout text-right mr-4 mb-3">
      <p class="thank_you mr-5"> <span class="login_name_color">{{ Auth::user() -> username }}</span>  <span class="login_name_san">さん</span></p>
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button>
      </a>
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

          <div class="view_flex">
            <p class="">{{ $post_detail->actionLogs->count() }} </p>
            <p class="ml-3">View</p>
          </div>

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
            <div class="comment_num">
              <p class="">コメント数</p>
              <p>{{ $post_detail->postComments->count() }}</p>
            </div>
            <p class="like_num">
              @if($post_detail->postFavoriteIsExistence($post_detail))
              <a class="post_favorite_key" post_id="{{ $post_detail->id }}" post_favorite_id="0" style="color:#FF0000; text-decoration: none;">
                <i class="far fa-heart"></i>
              </a>
              @else
              <a class="post_favorite_key" post_id="{{ $post_detail->id }}" post_favorite_id="1" style="color:#FF0000; text-decoration: none;">
                <i class="fas fa-heart"></i>
              </a>
              @endif
              <span class="ml-2 " style="color:#FF0000" id="post_favorite_count{{ $post_detail->id }}">
                {{ $post_detail->userPostFavoriteRelations->count() }}
              </span>
            </p>
          </div>

        </li>

      </ul>
    </div>


    <div class="show_comment_box">
      @foreach($post_detail->postComments as $post_comment)

      <div class="show_comment_top">
        <div class="show_comment_name">
          <p class="comment_name">{{ $post_comment -> user -> username }}さん</p>
          <p class="comment_event_at">{{ $post_comment -> event_at }}</p>
        </div>
        <div class="show_comment_edit">
          @if(Auth::user()->contributorAndAdmin($post_comment->user_id))
          <a href="{{ route('post_comment.edit', [$post_comment->id]) }}"><button type="submit" class="button_detail_update">コメント編集</button></a>
          @endif
        </div>
      </div>

      <div class="comment_show_sum">
        <p class="comment_show">{{ $post_comment -> comment }}</p>
        <p class="comment_sum text-danger">
          <!-- コメントいいね機能-->
              @if($post_comment->commentFavoriteIsExistence($post_comment))
              <a class="post_comment_favorite_key" post_comment_id="{{ $post_comment->id }}" post_comment_favorite_id="0" style="color:#FF0000; text-decoration: none;">
                <i class="far fa-heart"></i>
              </a>
              @else
              <a class="post_comment_favorite_key" post_comment_id="{{ $post_comment->id }}" post_comment_favorite_id="1" style="color:#FF0000; text-decoration: none;">
                <i class="fas fa-heart"></i>
              </a>
              @endif
              <span class="ml-2"id="post_comment_favorite_count{{ $post_comment->id }}">
                {{ $post_comment->userCommentFavoriteRelations->count() }}
              </span>
        </p>
      </div>


      <hr class="comment_hr">
      @endforeach
    </div>


    <!-- コメント入力欄 -->
    <form action="{{ route('post_comment.store',[$post_detail->id]) }}" method="post">
      @csrf
      <div class="">
        @if ($errors->has('comment'))
        @foreach($errors->get('comment') as $message)
        <p class="error-message"> {{ $message }} </p>
        @endforeach
        @endif
        <textarea type="text" name="comment" class="post_comment_text" cols="50" rows="5" placeholder="こちらからコメントできます♫
        "></textarea>
      </div>
      <div class="text-right">
        <button type="submit" class="button_comment">コメント</button>
      </div>
    </form>


    <!-- 戻るボタン -->
    <div class="text-center padding_bottom">
      <a href="{{ route('post.index') }}"><button type="submit" class="button_comment">戻る</button></a>
    </div>
  </div>
</div>
@endsection

@include('layout.login.footer')
