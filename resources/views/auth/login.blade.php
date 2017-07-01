<div class="reveal tiny" id="login_form" data-reveal>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>

  <form id="login-form" data-abide novalidate>
    <div class="row">
      <div class="small-12 columns">
        {{ csrf_field() }}
        <h3 class="text-center">
          {{ trans('site.login_header') }}
        </h3>
      </div>

      <div class="small-12 columns">
        <label for="login">{{ trans('site.login_name') }}
          <input type="text" name="login" pattern="login" required>
          <span class="form-error">
            {{ trans('site.form_login_error') }}
          </span>
        </label>
      </div>

      <div class="small-12 columns">
        <label>{{ trans('site.password') }}
          <input type="password" name="password" pattern="password" autocomplete="off" required>
          <span class="form-error">
            {{ trans('site.form_password_error') }}
          </span>
        </label>
      </div>

      <div class="small-3 columns">
        <div class="switch {{ config('app.locale') }}">
          <input class="switch-input" id="yes-no" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="switch-paddle" for="yes-no">
            <span class="show-for-sr">{{ trans('site.remember_me') }}</span>
            <span class="switch-active" aria-hidden="true">{{ trans('site.yes') }}</span>
            <span class="switch-inactive" aria-hidden="true">{{ trans('site.no') }}</span>
          </label>
        </div>
      </div>
      <div class="small-9">
        <p class="remember-me">{{ trans('site.remember_me') }}</p>
      </div>

      <div class="small-12 columns hide" id="login-error"><p class="alert callout"></p></div>

    </div>

    <div class="row">
      <fieldset class="small-12 columns text-center">
        <button class="button expanded" type="submit" value="Submit">{{ trans('site.login') }}</button>
        <a href="#" class="forgot">{{ trans('site.forgot_password') }}</a>
      </fieldset>
    </div>

  </form>
</div>
