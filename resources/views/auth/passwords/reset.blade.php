<div class="reveal tiny" id="reset_form" data-animation-out="spin-out" data-reveal>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>

  @if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
  @endif

  <div class="row">
    <div class="small-12 columns">
      <h3>{{ trans('site.forgoting_header') }}</h3>
    </div>
    <div class="small-12 columns">
      <h4 id="reset-form_info" class="success callout text-center hide">123</h4>
    </div>
  </div>
    <form id="reset-form" data-abide novalidate>
      <div class="row">
      <div class="small-12 columns">
        <label for="email">{{ trans('site.email') }}
          <input type="email" name="email" value="{{ $email or old('email') }}" required autofocus>
          <span class="form-error">
            {{ trans('site.form_email_error') }}
          </span>
        </label>
      </div>

      <div class="small-12 columns hide" id="forgot-error"><p class="alert callout"></p></div>

      <fieldset class="small-12 columns text-center">
        <button class="button expanded" type="submit" value="Submit">{{ trans('site.send_pass') }}</button>
      </fieldset>
    </div>
    </form>

  <div class="row">
    <div class="small-12 text-center columns">
      <a  data-open="login_form" class="login bottom_form">{{ trans('site.login2') }}</a>
    </div>
  </div>

</div>
