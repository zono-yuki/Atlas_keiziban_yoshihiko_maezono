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
    <div class="flex_name_logout text-right mr-4 mb-3">
      <p class="thank_you mr-5"> <span class="login_name_color">{{ Auth::user() -> username }}</span>  <span class="login_name_san">さん</span></p>
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button>
      </a>
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

   <!-- 削除フォーム-->

      <!-- 投稿者か、管理者のみ表示。 -->
      @if(Auth::user()->contributorAndAdmin($post_detail->user_id))
        <div class="post_button">
          <button type="button" class="button_post_destroy cancelModal" post_created_at = "{{ $post_detail->created_at }}" post_title="{{ $post_detail->title }}" post_body="{{ $post_detail->post }}" post_id = "{{ $post_detail->id }}">削除</button>
        </div>
      @endif

   {{--
      @if($post_detail->postCommentIsExistence($post_detail))
      <form action="{{ route('post.destroy',[$post_detail->id]) }}" method="post">
      @method('DELETE')
      @csrf
      <!-- 投稿者か、管理者のみ表示。 -->
      @if(Auth::user()->contributorAndAdmin($post_detail->user_id))
        <div class="post_button">
          <button type="submit" class="button_post_destroy">削除</button>
        </div>
      @endif
      </form>
   @endif--}}


   <!-- 戻るボタン -->
   <div class="return pb-5">
       <a href="{{ route('post.show', [$post_detail->id]) }}"><button type="submit" class="button_comment">戻る</button></a>
   </div>
  </div>
 </div>


 <!-- 隠しモーダル -->
  <div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
      <div class="w-100 m-auto">

      <form action="{{ route('post.destroy',[$post_detail->id]) }}" method="post">
        @method('DELETE')
        @csrf
        <!-- 投稿作成日時  -->
        <div class="m-auto">
           <div class="modal-inner-created_at w-100 text-center">
             <span type="text" class="w-100" name="post_created_at" value=""><span>
           </div>
        </div>


        <!-- タイトル  -->
        <div class="m-auto">
           <div class="modal-inner-title w-100 text-center">
             <span type="text" class="w-100" name="post_title" value=""><span>
           </div>
        </div>


        <!-- 投稿内容 -->
        <div class="m-auto">
           <div class="modal-inner-body w-100 text-center">
            <span type="text" class="w-100" name="post_body" value=""></span>
           </div>
        </div>


        <div class="mt-3">
          <div class="w-60 m-auto d-flex">
            <!-- 閉じるボタン -->
            <a class="js-modal-close button_modal_close" href="" >閉じる</a>
            <!-- 投稿のidを受け取る -->
            <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
            <!-- 削除ボタン -->
            <input type="submit" class="button_modal_delete" value="削除">
          </div>
        </div>
      </form>


      </div>
  </div>
</div>

{{--<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">

    <!-- 投稿を編集する処理へ飛ばす -->
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">

        <!-- タイトル  -->
        <div class="modal-inner-title w-50 m-auto">
          <span type="text" name="post_title" value="" class="w-100"><span>
        </div>

        <!-- 投稿内容 -->
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>

        <div class="w-50 m-auto edit-modal-btn d-flex">

          <!-- 閉じるボタン -->
          <a class="js-modal-close btn btn-danger btn-lg d-block" href="">閉じる</a>

          <!-- 投稿のidを受け取る -->
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">

          <!-- 編集ボタン -->
          <input type="submit" class="btn btn-primary btn-lg d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>--}}






@endsection

@include('layout.login.footer')
