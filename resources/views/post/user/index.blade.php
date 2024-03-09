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
      @can('admin')
      <a class="create_margin" href="{{ route('post_category.index') }}">
        <button type="submit" class="button_category">カテゴリーを追加</button></a>
      @endcan
      {{-- @if(Auth::user()->admin_role == 1)
      @endif でもOK --}}

      <a class="create_margin" href="{{ route('post.create') }}">
        <button type="submit" class="button_category_blue">投稿</button>
      </a>

      <div class="create_margin">
        <form action="{{ route('post.index') }}" method="get">
          <input type="text" name="keyword">
          <button type="submit">キーワード検索</button>
        </form>
      </div>


      <div class="create_margin">
       <form action="{{ route('post.index') }}" method="get">
         <button type="submit" name="post_favorite" value="post_favorite" class="button_like">いいねした投稿</button>
       </form>
      </div>

      <p>
        <lavel>カテゴリー</lavel>
        <select name="post_sub_category_id" id="post_sub_category_change">
          <option value="">----</option>
          @foreach($post_main_categories as $post_main_category)
          <optgroup label="{{ $post_main_category -> main_category }}">
            @foreach($post_main_category->postSubCategories as $postSubCategory)
            <option value="{{ $postSubCategory->id }}" data-category_id="{{ $postSubCategory->id }}">
              {{ $postSubCategory -> sub_category }}
            </option>
            @endforeach
          </optgroup>
          @endforeach
        </select>
      </p>
    </section>
  </div>
</div>



@endsection

@include('layout.login.footer')
