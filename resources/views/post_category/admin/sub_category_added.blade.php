@extends('layout.login.common')
@section('title','サブカテゴリー登録完了ページ')
@include('layout.login.header')

@section('content')

<div class="original-gradient_add">
    <div class="add_back">
      <div class="flex_thank_you">
        <p class="thank_you_add mt-0">サブカテゴリー登録完了!</p>
      </div>
      <!-- 戻るボタン -->
     <div class="text-center mt-5 pb-5">
       <a href="{{ route('post_category.index') }}"><button type="submit" class="button">OK!!</button></a>
     </div>
    </div>
  </div>
</div>

@endsection

@include('layout.login.footer')
