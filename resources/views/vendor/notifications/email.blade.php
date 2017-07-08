@component('mail::message')

# {{ trans('email.forgot_header') }}


{{ trans('email.forgot_info') }}
{{ route('site') }}

{{ trans('email.forgot_info2') }}:

@component('mail::button', ['url' => $actionUrl])
{{ trans('email.forgot_button') }}
@endcomponent

{{ trans('email.forgot_info3') }}

@component('mail::subcopy')
{{ trans('email.forgot_subinfo') }}: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent

@endcomponent
