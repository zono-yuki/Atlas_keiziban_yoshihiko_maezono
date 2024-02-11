@extends('layout.logout.common')
@section('title','ログインページ')
@include('layout.logout.header')

@section('content')
<!-- ログインする -->

<div class="original-gradient">
   <div class="top-margin_login">
     <p class="thank_you">ログイン</p>
   </div>

  <form action="{{ route('login') }}" method="post" class="center-form m-auto mt-2">
   @csrf
   <div class="mt-3">
        <label for="email" class="d-block login-font">メールアドレス</label>
        <input type="email" name="email" id="email" class="d-block input_form">
        <label for="password" class="d-block mt-3 login-font">パスワード</label>
        <input type="password" name="password" id="password" class="d-block input_form">

   </div>
           <div class="text-center">
             <button type="submit" class="mt-4 button">ログイン</button>
           </div>


   </form>

    <!-- ユーザー登録画面へ -->
   <div class="top-margin_login_2">
     <p class="thank_you_2">新規ユーザー登録は<a href="{{ route('register.form') }}">こちら</a></p>
   </div>
</div>

@endsection

{{--@include('layout.logout.footer')--}}
