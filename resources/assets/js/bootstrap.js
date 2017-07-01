
//window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('what-input');
require('foundation-sites');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).foundation();

Foundation.Abide.defaults.patterns['login'] = /^([a-zA-Zа-яА-Я0-9\s\@\.\_\-()]){3,}$/;
Foundation.Abide.defaults.patterns['password'] = /^(.){6,}$/;


/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// window.axios = require('axios');
//
// window.axios.defaults.headers.common = {
//     'X-CSRF-TOKEN': window.Laravel.csrfToken,
//     'X-Requested-With': 'XMLHttpRequest'
// };

var registerForm = $("#register-form");
registerForm.submit(function(e) {
    e.preventDefault();
    var formData2 = registerForm.serialize();
    $('#register-error p').html("");
    $("#register-error").addClass("hide");
    $.ajax({
        url: '/register',
        type: 'POST',
        data: formData2,
        success: function(data) {
            if (data.error) {
                $("#register-error").removeClass("hide");
                $('#register-error p').html(data.error);
            } else {
                $('#register_form').foundation('close');
                // location.reload(true);
            }
        },
        error: function(data) {
            console.log(data.responseText);
            var obj = jQuery.parseJSON(data.responseText);
            if (obj.email) {
                $("#register-error").removeClass("hide");
                $('#register-error p').html(obj.email);
            }
            if (obj.password) {
                $("#register-error").addClass("hide");
                $('#register-error p').html(obj.password);
            }
            if (obj.error) {
                $("#register-error").addClass("hide");
                $('#register-error p').html(obj.error);
            }
        }
    });
});


var loginForm = $("#login-form");
loginForm.on({
  'submit': function() {
    $("#login-error").addClass("hide");
    return false;
  },
  'formvalid.zf.abide': function(e) {
    e.preventDefault();
    var formData = loginForm.serialize();
    $('#login-error p').html("");
    $("#login-error").addClass("hide");

    $.ajax({
      url: '/login',
      type: 'POST',
      data: formData,
      success: function(data) {
        if (data.error) {
          $("#login-error").removeClass("hide");
          $('#login-error p').html(data.error);
        } else {
          $('#login_form').foundation('close');
          // location.reload(true);
        }
      },
      error: function(data) {
        var obj = jQuery.parseJSON(data.responseText);
        console.log(obj);
        if (obj.error) {
          $("#login-error").addClass("hide");
          $('#login-error p').html(obj.error);
        }
      }
    });

  }
});
