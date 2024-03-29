@extends('layout.logout.common')
@section('title','ユーザー登録ページ')
@include('layout.logout.header')

@section('content')

<div class="original-gradient">
  <div class="center__center">
      <div class="">
        <p class="thank_you">ユーザー登録</p>
      </div>

      <!-- バリデーションメッセージ -->
      @if ($errors->any())
        <div class="register_error">
          <ul class="error-ul">
            @foreach ($errors->all() as $error)
             <div class="text-center">
               <li class="error-message">{{ $error }}</li>
             </div>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('register') }}" method="post" class="center-form m-auto">
        @csrf
        <label for="username" class="d-block login-font">ユーザー名</label>
        <input type="text" name="username" id="username" class="d-block input_form">

        <label for="email" class="d-block login-font mt-3">メールアドレス</label>
        <input type="email" name="email" id="email" class="d-block input_form">

        <label for="password" class="d-block login-font mt-3">パスワード</label>
        <input type="password" name="password" id="password" class="d-block input_form">

        <label for="password_confirmation" class="d-block login-font mt-3">パスワード確認</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="d-block input_form">

        <div class="user-create_button">
          <a href="{{ route('login.form') }}">戻る</a>
          <button class="button" type="submit">登録</button>
        </div>
      </form>
  </div>


</div>

@endsection

{{--@include('layout.logout.footer') --}}
