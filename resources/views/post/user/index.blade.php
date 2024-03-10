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
    <div class="flex_name_logout text-right mr-4 mb-3">
      <p class="thank_you mr-5"> {{ $user_name }} さん</p>
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
            <p class="posts_user_name">{{ $post_list->user->username }}さん</p>
            <p>{{ date("Y年m月d日 H:i",strtotime($post_list->event_at)) }}</p>
            <div class="view_flex">
              <p>{{ $post_list -> actionLogs -> count() }}</p>
              <p class="ml-2">View</p>
            </div>

          </li>

          <li class="mb-3">
            <p>{{ $post_list->title }}</p>
          </li>

          <li class="posts_flex">
            <p class="posts_category">{{ $post_list->postSubCategory->sub_category }}</p>
            <div class="posts_comment_flex">
              <p class="">コメント数</p>
              <p class="">{{ $post_list->postComments->count() }}</p>
            </div>
            <div class="posts_like_flex">
              <p class="text-danger">
              @if($post_list->postFavoriteIsExistence($post_list))
              <a class="post_favorite_key" post_id="{{ $post_list->id }}" post_favorite_id="0" style="color:#FF0000; text-decoration: none;">
                <i class="far fa-heart"></i>
              </a>
              @else
              <a class="post_favorite_key" post_id="{{ $post_list->id }}" post_favorite_id="1" style="color:#FF0000; text-decoration: none;">
                <i class="fas fa-heart"></i>
              </a>
              @endif
              <span class="ml-2"id="post_favorite_count{{ $post_list->id }}">
                {{ $post_list->userPostFavoriteRelations->count() }}
              </span>
              </p>
            </div>
            <p class="posts_detail_go"><a href="{{ route('post.show' ,[$post_list->id]) }}">詳細ページへ</a></p>

          </li>

        </ul>
      </div>
      @endforeach
    </section>

    <!-- カテゴリー（右半分） -->
    <section class="right_index">

      <!-- 管理者のみカテゴリー作成画面へ遷移できる -->
      @can('admin')
      <a class="create_margin" href="{{ route('post_category.index') }}">
        <button type="submit" class="button_category">カテゴリーを追加</button></a>
      @endcan
      {{-- @if(Auth::user()->admin_role == 1)
      @endif でもOK --}}

      <!-- 投稿ボタン -->
      <a class="create_margin" href="{{ route('post.create') }}">
        <button type="submit" class="button_category_blue">投稿</button>
      </a>

      <!-- キーワード検索 -->
      <div class="create_margin">
        <form action="{{ route('post.index') }}" method="get">
          <input type="text" name="keyword">
          <button type="submit" class="keyword_button mt-3">キーワード検索</button>
        </form>
      </div>

      <!-- いいねした投稿を検索 -->
      <div class="create_margin">
       <form action="{{ route('post.index') }}" method="get">
         <button type="submit" name="post_favorite" value="post_favorite" class="button_like">いいねした投稿</button>
       </form>
      </div>

      <!-- 自分の投稿を検索 -->
      <div class="create_margin">
       <form action="{{ route('post.index') }}" method="get">
         <button type="submit" name="post_mine" value="post_mine" class="button_mine">自分の投稿</button>
       </form>
      </div>

      <!-- サブカテゴリーから検索 -->

      <p class="posts_category_name">サブカテゴリーから検索</p>

      <ul class="pl-3">
        @foreach($post_main_categories as $post_main_category)
        <li class="main_category_font">
          <div class="flex-main_category">
            <div>
              {{ $post_main_category -> main_category}}
            </div>
          </div>
          <ul class="pl-3 mt-2">
            @foreach($post_main_category -> postSubCategories as $post_sub_category)
            <form action="{{ route('post.index') }}" method="get">
            <button type="submit" name="post_sub_category_id" value="{{ $post_sub_category->id }}" class="button_sub_category_index">{{ $post_sub_category -> sub_category }}</button>
            </form>
            @endforeach
          </ul>
        </li>
        <hr>
        @endforeach
      </ul>
    </section>
  </div>
</div>



@endsection

@include('layout.login.footer')
