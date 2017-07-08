@component('mail::message')
# {{ trans('email.register_header') }}, {{ $user->username }}


{{ trans('email.register_info') }}


@component('mail::button', ['url' => route('register') . "/" . $user->token])
{{ trans('email.register_button') }}
@endcomponent

@component('mail::subcopy')
{{ trans('email.register_subinfo') }}
<a href="{{ route('register') .'/'. $user->token }}">{{ route('register') .'/'. $user->token }}</a>
@endcomponent

@endcomponent
