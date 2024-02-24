@extends('layout.login.common')
@section('title','カテゴリー追加ページ')
@include('layout.login.header')

@section('content')
<!-- ログインする -->


<!-- ヘッダー -->
<header class="admin_header">
  <div class="original-gradient">
    <div class="mb-2 ml-5">
      <p class="thank_you">カテゴリー追加画面【管理者専用画面】</p>
    </div>
    <div class="text-right mr-4 mb-3">
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
    </div>
  </div>
</header>

<div class="inner">
  <!-- カテゴリー -->
  <div class="main_index">

    <!-- 新規メインカテゴリーなど-->
    <section class="category_left_index">

      <!-- 新規メインカテゴリー登録フォーム -->
      <form action="{{ route('main_store') }}" method="post" class="category_new_form">
        @csrf
        <div class="">
          <p class="thank_you">新規メインカテゴリー</p>
        </div>

        <!-- メインカテゴリーのエラーメッセージを表示する -->
        @if ($errors->has('main_category'))
        @foreach($errors->get('main_category') as $message)
        <p class="error-message"> {{ $message }} </p>
        @endforeach
        @endif

        <input type="text" name="main_category" class="text_category">
        <button type="submit" class="button_category_create">登録</button>

      </form>




      <!-- サブカテゴリー登録フォーム -->
      <form action="{{ route('post_sub_category.store') }}" method="post" class="sub_category_new_form">
        @csrf

        <!-- メインカテゴリーのエラーメッセージを表示する -->
        @if ($errors->has('post_main_category_id'))
        @foreach($errors->get('post_main_category_id') as $message)
        <p class="error-message"> {{ $message }} </p>
        @endforeach
        @endif

        <div class="">
          <p class="sub_category_thank_you">メインカテゴリー</p>
        </div>
        <select name="post_main_category_id" class="select_sub_category">
          <option value="">-----</option>
          <!-- メインカテゴリーを繰り返す valueではidをとばす -->
          @foreach($post_main_categories as $post_main_category)
          <option value="{{ $post_main_category->id }}">
            {{ $post_main_category -> main_category }}
          </option>
          @endforeach
        </select>

        <!-- サブカテゴリーのエラーメッセージを表示する -->
        @if ($errors->has('sub_category'))
        @foreach($errors->get('sub_category') as $message)
        <p class="error-message"> {{ $message }} </p>
        @endforeach
        @endif

        <div class="">
          <p class="sub_category_thank_you">サブカテゴリー</p>
        </div>
        <input type="text" name="sub_category" class="text_category">
        <button type="submit" class="button_category_create">登録</button>

      </form>


    </section>

    <!-- カテゴリー一覧 -->
    <section class="category_right_index">
      <div class="">
        <p class="thank_you">カテゴリー一覧</p>
      </div>

      <ul class="pl-3">
        @foreach($post_main_categories as $post_main_category)
        <li class="main_category_font">
          <div class="flex-main_category">
            <div>
              {{ $post_main_category -> main_category}}
            </div>
            <div>
              <form action="{{ route('post_main_category.destroy',[$post_main_category->id]) }}" method="post" name="post_main_category_delete{{$post_main_category->id}}">
                @method('DELETE')
                @csrf
                <!-- メインカテゴリー削除機能 -->
                @if($post_main_category->postSubCategoryIsExistence($post_main_category))
                <a href="javascript:post_main_category_delete{{$post_main_category->id}}.submit()"><button type="submit" class="button_category_delete_main">削除</button></a>
                @endif
              </form>
            </div>
          </div>


          <ul class="pl-3 mt-2">
            @foreach($post_main_category -> postSubCategories as $post_sub_category)
            <div class="flex-subcategory_delete">
              <li class="sub_category_font">{{ $post_sub_category -> sub_category }}</li>

              <form action="{{ route('post_sub_category.destroy',[$post_sub_category->id]) }}" method="post" name="post_sub_category_delete{{ $post_sub_category->id }}">
                @method('DELETE')
                @csrf
                <a href="javascript:post_sub_category_delete{{ $post_sub_category->id }}.submit()"><button type="submit" class="button_category_delete">削除</button></a>
              </form>

            </div>

            @endforeach
          </ul>
        </li>
        <hr>
        @endforeach
      </ul>

    </section>
  </div>

  <!-- 戻るボタン -->
  <div class="text-center mt-5">
    <a href="{{ route('post.index') }}"><button type="submit" class="button">戻る</button></a>
  </div>

</div>


@endsection

@include('layout.login.footer')
