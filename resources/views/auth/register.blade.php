<div class="reveal tiny" id="register_form" data-reveal>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
  <form method="POST" id="register-form" action="{{ url('/register') }}" data-abide novalidate>
    <div class="row">
      <div class="small-12 columns">
        {{ csrf_field() }}
        <h3 class="text-center">
          {{ trans('site.register_header') }}
        </h3>
      </div>

      <div class="small-4 columns">
        <label for="middle-label" class="text-right middle">{{ trans('site.name') }}</label>
      </div>
      <div class="small-8 columns">
        <input type="text" id="name" pattern="name" required>
        <span class="form-error">
          {{ trans('site.form_name_error') }}
        </span>
      </div>

      <div class="small-4 columns">
        <label for="middle-label" class="text-right middle">{{ trans('site.email') }}</label>
      </div>
      <div class="small-8 columns">
        <input type="email" id="email" pattern="email" required>
        <span class="form-error">
          {{ trans('site.form_email_error') }}
        </span>
      </div>

      <div class="small-4 columns">
        <label for="middle-label" class="text-right middle">{{ trans('site.password') }}</label>
      </div>
      <div class="small-8 columns">
        <input type="password" id="password" pattern="password" autocomplete="off" required>
        <span class="form-error">
          {{ trans('site.form_password_error') }}
        </span>
      </div>

      <div class="small-4 columns">
        <label for="middle-label" class="text-right middle">{{ trans('site.password_again') }}</label>
      </div>
      <div class="small-8 columns">
        <input type="password" data-equalto="password" pattern="password" autocomplete="off" required>
          <span class="form-error">
            {{ trans('site.form_password_re_enter_error') }}
          </span>
      </div>

      <div class="small-12">
        <div data-abide-error class="alert callout" style="display: none;">
          <p>{{ trans('site.form_error') }}</p>
        </div>

      </div>

    </div>

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
