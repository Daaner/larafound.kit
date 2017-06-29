<header>
  <div class="top-bar stacked-for-large">
    <div class="top-bar-left">
      <ul class="dropdown menu" data-dropdown-menu>
        <li class="menu-text">Laravel + Foundation</li>
        <li>
          <a href="#">Item 1</a>
          <ul class="menu">
            <li><a href="#">Item 1A</a></li>
            <li><a href="#">Item 1B</a></li>
            <li><a href="#">Item 1C</a></li>
          </ul>
        </li>
        <li><a href="#">Item 2</a></li>
        <li><a href="#">Item 3</a>
          <ul class="vertical menu">
            <li>
              <a href="#">Item 1A</a>
              <ul class="vertical menu">
                <li><a href="#">Item 1A</a></li>
                <li><a href="#">Item 1B</a></li>
                <li><a href="#">Item 1C</a></li>
                <li><a href="#">Item 1D</a></li>
                <li><a href="#">Item 1E</a></li>
              </ul>
            </li>
            <li><a href="#">Item 1B</a></li>
          </ul>
        </li>
        <li><a href="#">Item 4</a></li>
      </ul>
    </div>

    <div class="top-bar-right">
      <ul id="login" class="menu">
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
    </div>
  </div>
</header>
