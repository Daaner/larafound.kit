@if ($user)
    <li>
        <a href="/" target="_blank">
            <i class="fa fa-btn fa-external-link"></i>@lang('sleeping_owl::lang.links.index_page')
        </a>
    </li>
    <li class="dropdown">
        <a href="#" data-toggle="dropdown"><i class="fa fa-globe" aria-hidden="true"></i>{{ trans('admin.adm_lng')}}</a>
        <ul class="dropdown-menu" role="menu">
            @include('block.lang')
        </ul>
    </li>

    <li class="dropdown user user-menu" style="margin-right: 20px;">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <img src="{{ $user->avatar_url_or_blank }}" class="user-image" />
            <span class="hidden-xs">{{ $user->name }}</span>
        </a>
        <ul class="dropdown-menu">
            <li class="user-header">
                <img src="{{ $user->avatar_url_or_blank }}" class="img-circle" />
                <p>
                    {{ $user->name }}
                    <small>@lang('sleeping_owl::lang.auth.since', ['date' => $user->created_at->format('d.m.Y')])</small>
                </p>
            </li>
            <li class="user-footer">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-btn fa-sign-out"></i> @lang('sleeping_owl::lang.auth.logout')
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>

@endif
