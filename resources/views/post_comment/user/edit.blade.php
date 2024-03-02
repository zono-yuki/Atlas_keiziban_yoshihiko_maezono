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
    <div class="text-right mr-4 mb-3">
      <a class="logout_color" href="{{ route('logout') }}"> <button type="submit" class="mt-4 button">ログアウト</button></a>
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

    <form action="{{ route('post_comment.destroy',[$comment_detail->id]) }}" method="post">
      @method('DELETE')
      @csrf
      <!-- 投稿者か、管理者のみ表示。 -->
      @if(Auth::user()->contributorAndAdmin($comment_detail->user_id))
        <div class="post_button">
          <button type="submit" class="button_post_create">削除</button>
        </div>
      @endif
    </form>


   <!-- 戻るボタン -->
   <div class="return">
       <a href="{{ route('post.show', [$comment_detail->post_id]) }}"><button type="submit" class="button">戻る</button></a>
   </div>
  </div>
</div>





@endsection

@include('layout.login.footer')
