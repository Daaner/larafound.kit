<ul class="menu">
  @if (Auth::guest())
    <li><a data-open="register_form">{{ trans('site.register') }}</a></li>
    @include('auth.register')
    <li class="login"><a data-open="login_form" title="{{ trans('site.login') }}" data-tooltip><i class="fa fa-sign-in"></i></a></li>
    @include('auth.login')
  @endif

  @if (Auth::check())
    <li class="username">{{ Auth::user()->name }}</li>
    <li class="logout">
      <a href="#logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="{{ trans('site.logout') }}" data-tooltip>
        <i class="fa fa-sign-out"></i>
      </a>
    </li>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
  @endif
</ul>
