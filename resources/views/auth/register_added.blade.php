@extends('layout.logout.common')
@section('title','登録完了ページ')
@include('layout.logout.header')

@section('content')

<div class="original-gradient">
  <div class="center__center">
    <div class="center-center">

      <div class="flex_thank_you_2">
        <p class="thank_you">Thank You</p>
      </div>
      <div class="flex_thank_you">
        <p class="thank_you">登録ありがとうございます</p>
      </div>

      <div class="button">
        <a href="{{ route('login.form') }}" class="text_thank_you">ログイン画面へ</a>
      </div>

    </div>

  </div>
</div>

@endsection

{{-- @include('layout.logout.footer') --}}
