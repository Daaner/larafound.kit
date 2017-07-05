<ul class="menu">
  @if (Auth::guest())
    <li><a data-open="register_form">{{ trans('site.register') }}</a></li>
    @include('auth.register')
    <li class="login">
      <a data-open="login_form" title="{{ trans('site.login') }}" data-tooltip>
        <i class="fa fa-sign-in"></i>
      </a>
    </li>
    @include('auth.login')
  @endif

  @if (Auth::check())
    <li class="username">{{ Auth::user()->name }}</li>
    <li class="admin">
      <a href="{{ route('admin.dashboard') }}" target="_Blank" title="{{ trans('site.adm_panel') }}" data-tooltip>
        <i class="fa fa-cog fa-spin-h"></i>
      </a>
    </li>
    <li class="logout">
      <a id="logout" title="{{ trans('site.logout') }}" data-tooltip>
        <i class="fi-power"></i>
      </a>
      <span class="hide">
        {{ csrf_field() }}
      </span>
    </li>
  @endif
</ul>
