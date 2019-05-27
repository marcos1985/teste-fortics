<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('titulo')</title>

    <link rel="stylesheet" href="{{asset('bs4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('temas/yeti.min.css')}}">

  </head>
  <body style="margin-top: 70px;">

    @include('top-menu')

    <div class="container-fluid">
      @yield('conteudo')
    </div>

    <script src="{{asset('jquery/jquery.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('bs4/js/bootstrap.min.js')}}" charset="utf-8"></script>

  </body>
</html>
