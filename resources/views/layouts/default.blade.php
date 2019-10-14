<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','Blog')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <meta name="csrf-token" content="{{ csrf_token()}}">
  </head>
  <body id="app">
    @include('layouts._header')
    <div class="container">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
    </div>
  </body>
  <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
  @yield('scriptAfterJs')
</html>
