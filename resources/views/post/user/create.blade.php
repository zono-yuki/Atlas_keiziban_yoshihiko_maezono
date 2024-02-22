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
  <div class="post_top">
  <form action="{{ route('post.store') }}" method="post">
    @csrf
    <div class="post_sub_category">
      <div class="">
        <p class="post_thank_you">サブカテゴリー</p>
      </div>
      <select name="post_sub_category_id" class="select_sub_category_create">
        <option value="">----</option>
        @foreach($post_main_categories as $post_main_category)
          <optgroup label = "{{ $post_main_category -> main_category }}">
            @foreach($post_main_category -> postSubCategories as $post_sub_category)
              <option value="{{ $post_sub_category-> id }}">
                    {{ $post_sub_category -> sub_category }}
              </option>
            @endforeach
          </optgroup>
        @endforeach
      </select>
    </div>


    <div class="post_title">
      <div class="">
        <p class="post_thank_you">タイトル</p>
      </div>
      <input type="text" name="post" class="post_title_text">
    </div>


    <div class="post_create">
      <p class="post_thank_you">投稿内容</p>
      <textarea class="post_body_text" name="post" cols="100" rows="3" placeholder="投稿内容を入力してください。"></textarea>
    </div>

    <div class="post_button">
       <button type="submit" class="button_post_create">投稿</button>
    </div>

  </form>


  <!-- 戻るボタン -->
  <div class="return">
    <a href="{{ route('post.index') }}"><button type="submit" class="button">戻る</button></a>
  </div>
  </div>


</div>


@endsection

@include('layout.login.footer')
