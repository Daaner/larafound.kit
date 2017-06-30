@extends('layouts.mainpage')

@section('content')


<br>
<br>
<br>

<div class="row error">
  <div class="small-12 column text-center callout">
    <h2>{{ trans('site.error_page') }} <span>404</span></h2>
    <h3 class="subheader">{{ trans('site.error_page_404') }}</h3>
    <p>{{ trans('site.error_page_redirect') }} <span id="time"></span> {{ trans('site.error_page_time') }}.</p>
    <p class="lead">{{ trans('site.error_page_link') }} <a href="/">{{ trans('site.error_page_link_to') }}</a>.</p>
  </div>
</div>

<script type="text/javascript">
  var i = 115;
  function time(){
     document.getElementById("time").innerHTML = i;
     i--;
     if (i < 0) location.href = "/";
  }
  time();
  setInterval(time, 1000);
</script>

@endsection
