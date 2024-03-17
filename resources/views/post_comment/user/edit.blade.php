@extends('layout.login.common')
@section('title','コメント編集画面')
@include('layout.login.header')

@section('content')
<!-- ログインする -->


<!-- ヘッダー -->
<header class="admin-header">
  <div class="original-gradient">
    <div class="mb-2 ml-5">
      <p class="thank_you">コメント編集画面</p>
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

  <!-- コメント編集フォーム -->
   <form action="{{ route('post_comment.update', [$comment_detail->id]) }}" method="post">
     @method('PUT')
     @csrf
      <div class="post_create">
        @if ($errors->has('comment'))
        @foreach($errors->get('comment') as $message)
        <p class="error-message"> {{ $message }} </p>
        @endforeach
        @endif
        <p class="post_thank_you">コメント</p>
        <textarea type="text" class="post_body_text" name="comment" value="" cols="50" rows="9">{{ $comment_detail -> comment }}</textarea>
      </div>
      <div class="post_button">
        <button type="submit" class="button_post_create_blue">更新</button>
      </div>
   </form>

      <!-- 投稿者か、管理者のみ編集ボタンを表示。 -->
      @if(Auth::user()->contributorAndAdmin($comment_detail->user_id))
        <div class="post_button">
          <button type="button" class="button_post_destroy cancelModal" comment_created_at = "{{ $comment_detail->created_at }}" comment="{{ $comment_detail->comment }}" comment_id = "{{ $comment_detail->id }}">削除</button>
        </div>
      @endif


   <!-- 戻るボタン -->
   <div class="return pb-5">
       <a href="{{ route('post.show', [$comment_detail->post_id]) }}"><button type="submit" class="button_return">戻る</button></a>
   </div>
  </div>
</div>

<!-- 隠しモーダル -->
  <div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
      <div class="w-100 m-auto">

      <form action="{{ route('post_comment.destroy',[$comment_detail->id]) }}" method="post">
        @method('DELETE')
        @csrf
        <!-- コメント作成日時  -->
        <div class="m-auto comment_dan">
           <div class="modal-inner-created_at w-100 text-left">
             <p class="comment_delete_name">投稿日時::</p>
             <span type="text" class="w-100" name="post_created_at" value=""><span>
           </div>
        </div>

        <!-- コメント -->
        <div class="m-auto comment_dan">
           <div class="modal-inner-comment w-100 text-left">
            <p class="comment_delete_name">コメント内容::</p>
            <span type="text" class="w-100" name="post_body" value=""></span>
           </div>
        </div>

        <div class="m-auto comment_dan">
           <div class="w-100 text-left">
             <p class="comment_delete_name">このコメントを削除します？</p>
           </div>
        </div>

        <div class="mt-3">
          <div class="w-60 m-auto d-flex">
            <!-- 閉じるボタン -->
            <a class="js-modal-close button_modal_close" href="" >閉じる</a>
            <!-- 投稿のidを受け取る -->
            <input type="hidden" class="edit-modal-hidden" name="comment_id" value="">
            <!-- 削除ボタン -->
            <input type="submit" class="button_modal_delete" value="削除" onclick="return confirm('削除してもよろしいですか？')">
          </div>
        </div>
      </form>
      </div>
  </div>
</div>





@endsection

@include('layout.login.footer')
