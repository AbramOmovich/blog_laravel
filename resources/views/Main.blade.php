
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title','Как-бы блог')</title>

  <!-- Bootstrap core CSS -->
  <link href="/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="/public/css/sweetalert.css" rel="stylesheet">
  @yield('css')

  <!-- Custom styles for this template -->
  <link href="/public/css/blog.css" rel="stylesheet">


</head>

<body>

<div class="blog-masthead">
  <div class="container">
    <nav class="blog-nav">
      <a class="blog-nav-item
      @if(Route::is('Home')) {{ 'active' }} @endif"
         href="/">Home</a>
      <a class="blog-nav-item"  href="#">New features</a>
      <a class="blog-nav-item" href="#">Press</a>
      <a class="blog-nav-item" href="#">New hires</a>
      <a class="blog-nav-item" href="#">About</a>
      <!-- Authentication Links -->
      @if (Auth::guest())
        <a class="blog-nav-item pull-right" href="{{ route('login') }}">Войти</a>
        <a class="blog-nav-item pull-right" href="{{ route('register') }}">Регистрация</a>
      @else
        <div class="btn-group pull-right">
        <a class="blog-nav-item dropdown-toggle" href="#" id="userDrop" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}<span class="caret"></span></a>
        <ul class="dropdown-menu" aria-labelledby="userDrop">
          <li><a href="{{ route('user',['id' => Auth::id()]) }}">Профиль</a></li>
          <li><a href="#">Мои новости</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a></li>
        </ul>
        </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
      @endif
      </nav>
  </div>
</div>

<div class="container">

  <div class="blog-header">
      @if(Route::currentRouteName() != 'Home')
        <a href="/" style="text-decoration: none"><h1 class="blog-title" >Как-бы блог</h1></a>
      @else
          <h1 class="blog-title">Как-бы блог</h1>
      @endif
    <p class="lead blog-description">Блог для практики</p>
        <div class="col-sm-3 pull-right">

        </div>
  </div>

  <div class="row">
    <div class="col-sm-8 blog-main">

      @yield('message')
      @include('helpers.alert')

      @yield('Tag')

      @yield('Posts')

      @yield('Pagination')

    </div><!-- /.blog-main -->

    <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
      <div class="sidebar-module">
        @yield('sidebar')
      </div>

      <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>
      <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
          <li><a href="#">March 2014</a></li>
          <li><a href="#">February 2014</a></li>
          <li><a href="#">January 2014</a></li>
          <li><a href="#">December 2013</a></li>
          <li><a href="#">November 2013</a></li>
          <li><a href="#">October 2013</a></li>
          <li><a href="#">September 2013</a></li>
          <li><a href="#">August 2013</a></li>
          <li><a href="#">July 2013</a></li>
          <li><a href="#">June 2013</a></li>
          <li><a href="#">May 2013</a></li>
          <li><a href="#">April 2013</a></li>
        </ol>
      </div>
      <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </div><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</div><!-- /.container -->

<footer class="blog-footer">
  <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/sweetalert.min.js"></script>
@yield('script')
</body>
</html>