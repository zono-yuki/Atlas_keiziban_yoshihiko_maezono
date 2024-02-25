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

<div class="inner">
  <div class="post_top">

  <!-- 編集フォーム -->
   <form action="{{ route('post.update', [$post_detail->id]) }}" method="post">
     @method('PUT')
     @csrf

     <div class="post_sub_category">
           @if ($errors->has('post_sub_category_id'))
           @foreach($errors->get('post_sub_category_id') as $message)
              <p class="error-message"> {{ $message }} </p>
           @endforeach
           @endif
       <div class="">
         <p class="post_thank_you">サブカテゴリー</p>
       </div>
       <select name="post_sub_category_id" class="select_sub_category_create">
           <option value="">----</option>
           @foreach($post_main_categories as $post_main_category)
               <optgroup label="{{ $post_main_category -> main_category }}">
               @foreach($post_main_category -> postSubCategories as $post_sub_category)
                  <option value="{{ $post_sub_category -> id }}"  @if(old('$post_sub_category_id'
                  , $post_sub_category -> id == $post_detail->post_sub_category_id)) selected @endif>
                         {{ $post_sub_category -> sub_category}}
                  </option>
               @endforeach
               </optgroup>
           @endforeach
       </select>
    </div>


      <div class="post_title">
        @if ($errors->has('title'))
        @foreach($errors->get('title') as $message)
        <p class="error-message"> {{ $message }} </p>
        @endforeach
        @endif
        <div class="">
          <p class="post_thank_you">タイトル</p>
        </div>
        <input type="text" name="title" value="{{ $post_detail->title }}" class="post_title_text">
      </div>


      <div class="post_create">
        @if ($errors->has('post'))
        @foreach($errors->get('post') as $message)
        <p class="error-message"> {{ $message }} </p>
        @endforeach
        @endif
        <p class="post_thank_you">投稿内容</p>
        <!-- <textarea type="text" class="post_body_text" name="post" value="{{ $post_detail -> post }}"cols="50" rows="9" placeholder="{{ $post_detail->post }}"></textarea> -->
        <textarea type="text" class="post_body_text" name="post" value="" cols="50" rows="9">{{ $post_detail -> post }}</textarea>

      </div>

      <div class="post_button">
        <button type="submit" class="button_post_create_blue">更新</button>
      </div>

   </form>

   <!-- 削除フォーム -->

   <form action="{{ route('post.destroy',[$post_detail->id]) }}" method="post">
      @method('DELETE')
      @csrf
      <!-- 投稿者か、管理者のみ表示。 -->
      @if(Auth::user()->contributorAndAdmin($post_detail->user_id))
        <div class="post_button">
          <button type="submit" class="button_post_create">削除</button>
        </div>
      @endif
   </form>


   <!-- 戻るボタン -->
   <div class="return">
       <a href="{{ route('post.show', [$post_detail->id]) }}"><button type="submit" class="button">戻る</button></a>
   </div>
  </div>
</div>





@endsection

@include('layout.login.footer')
