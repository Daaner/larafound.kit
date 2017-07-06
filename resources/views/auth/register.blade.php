<div class="reveal tiny" id="register_form" data-reveal>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>

  <form id="register-form" data-abide novalidate>

    <div class="row">
      <div class="small-12 columns">
        <h3 class="text-center">
          {{ trans('site.register_header') }}
        </h3>
      </div>

      <div class="small-12 columns">
        <label for="name">{{ trans('site.name') }}
          <input type="text" name="name" id="name" pattern="login" required>
          <span class="form-error">
            {{ trans('site.form_name_error') }}
          </span>
        </label>
      </div>

      <div class="small-12 columns">
        <label for="login">{{ trans('site.name_login') }}
          <input type="text" name="username" id="username" pattern="login" required>
          <span class="form-error">
            {{ trans('site.form_login_error') }}
          </span>
        </label>
      </div>

      <div class="small-12 columns">
        <label for="email">{{ trans('site.email') }}
          <input type="email" name="email" id="email" pattern="email" required>
          <span class="form-error">
            {{ trans('site.form_email_error') }}
          </span>
        </label>
      </div>

      <div class="small-12 columns">
        <label for="password">{{ trans('site.password') }}
          <input type="password" id="password" name="password" pattern="password" autocomplete="off" required>
          <span class="form-error">
            {{ trans('site.form_password_error') }}
          </span>
        </label>
      </div>

      <div class="small-12 columns">
        <label for="password">{{ trans('site.password_again') }}
          <input type="password" data-equalto="password" id="password-confirm" name="password_confirmation" pattern="password" autocomplete="off" required>
          <span class="form-error">
            {{ trans('site.form_password_re_enter_error') }}
          </span>
        </label>
      </div>

      <div class="small-12 columns">
        <div data-abide-error class="alert callout" style="display: none;">
          <p>{{ trans('site.form_error') }}</p>
        </div>
      </div>
    </div>

    <div class="small-12 columns hide" id="register-error"><p class="alert callout"></p></div>

    <div class="row">
      <fieldset class="small-6 columns">
      <button class="button expanded" type="submit" value="Submit">{{ trans('site.form_btn_register') }}</button>
    </fieldset>
    <fieldset class="small-6 columns">
      <button class="button alert expanded" type="reset" value="Reset">{{ trans('site.form_btn_reset') }}</button>
    </fieldset>
    </div>
  </form>
</div>
