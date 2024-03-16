@extends('layout.login.common')
@section('title','メインカテゴリー登録完了ページ')
@include('layout.login.header')

@section('content')

<div class="original-gradient_add">
    <div class="center__center">
      <div class="flex_thank_you">
        <p class="thank_you_add mt-0">メインカテゴリー登録完了!</p>
      </div>
      <!-- 戻るボタン -->
     <div class="text-center mt-5 pb-5">
       <a href="{{ route('post_category.index') }}"><button type="submit" class="button">OK!!</button></a>
     </div>
    </div>
</div>

@endsection

@include('layout.login.footer')
