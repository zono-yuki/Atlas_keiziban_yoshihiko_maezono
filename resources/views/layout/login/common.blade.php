<!-- 全体の型 -->
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--  Bootstrap.css (CDN) --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
{{-- css --}}
<link rel="stylesheet" href="{{ asset('/css/login.css') }}">
</head>

<body>
@yield('header')

<div class="contents">
  <div class="main">
    @yield('content')
  </div>
</div>

@yield('footer')
</body>
</html>
