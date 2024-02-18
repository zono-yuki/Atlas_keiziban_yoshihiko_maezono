@extends('layout.login.common')
@section('title','サブカテゴリー登録完了ページ')
@include('layout.login.header')

@section('content')

<div class="original-gradient">
  <div class="flex-person">
    <div class="center-center">


      <div class="flex_thank_you">
        <p class="thank_you">サブカテゴリー登録完了!</p>
      </div>

      <!-- 戻るボタン -->
     <div class="text-center mt-5">
       <a href="{{ route('post_category.index') }}"><button type="submit" class="button">戻る</button></a>
     </div>
    </div>
  </div>
</div>

@endsection

@include('layout.login.footer')
