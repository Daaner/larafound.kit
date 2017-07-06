<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta content="true" name="HandheldFriendly">
  	<meta content="width" name="MobileOptimized">
  	<meta content="yes" name="apple-mobile-web-app-capable">

   <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
	<link rel="apple-touch-icon-precomposed" href="/favicon.ico"/>
	<meta name="msapplication-TileImage" content="/favicon.ico"/>

   <meta name="csrf-token" content="">

   <title>
      @hasSection ('title')
         @yield('title') - {{ trans('site.sitename') }}
      @else
         Laravel + ZURB Foundation
      @endif
   </title>

   <link href="/public/css/app.css" rel="stylesheet">

</head>
<body>
    <header>
        @include('block.header')
    </header>

    @if (session('status'))
      <section id="status">
        <div class="carret alert-success">
            {{ session('status') }}
        </div>
      </section>
    @endif

    <section id="content">
        @yield('content')
    </section>


    @include('block.lang')
    <footer>
        @include('block.footer')
    </footer>
    <script src="/public/js/app.js"></script>
</body>
</html>
