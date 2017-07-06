
//window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('what-input');
require('foundation-sites');

// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

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

$(document).ready(function(){

  function verify_csrf() {
    $.ajax ({
      url: '/csrf-token',
      type: 'GET',
      cache: false,
      async: false,
      success: function(data) {
        $('meta[name="csrf-token"]').attr('content', data);
      }
    });
  };


  var registerForm = $("#register-form");
  registerForm.on({
    'submit': function() {
      return false;
    },
    'formvalid.zf.abide': function(e) {
      verify_csrf();
      $("#register-error").addClass("hide");

      e.preventDefault();
      RegData = {
        'name': registerForm.find("input[name='name']" ).val(),
        'username': registerForm.find("input[name='username']" ).val(),
        'email': registerForm.find("input[name='email']" ).val(),
        'password': registerForm.find("input[name='password']" ).val(),
        'password_confirmation': registerForm.find("input[name='password_confirmation']" ).val(),
        '_token': $('meta[name="csrf-token"]').attr('content'),
      };

      $('#register-error p').html("");
      $("#register-error").addClass("hide");
      $.ajax({
        url: '/register',
        type: 'POST',
        cache: false,
        data: RegData,
        success: function(data) {
          if (data.token) {
            $("#register-error").removeClass("hide");
            $('#register-error p').html(data.token);
          }
          else if (data.name) {
            $("#register-error").removeClass("hide");
            $('#register-error p').html(data.name);
          }
          else if (data.email) {
            $("#register-error").removeClass("hide");
            $('#register-error p').html(data.email);
          }
          else if (data.username) {
            $("#register-error").removeClass("hide");
            $('#register-error p').html(data.username);
          }
          else if (data.password) {
            $("#register-error").removeClass("hide");
            $('#register-error p').html(data.password);
          }
          else if (data.error) {
            $("#register-error").removeClass("hide");
            $('#register-error p').html(data.error);
          } else {
            $('#register_form').foundation('close');
            $('#login').html(data);
            $('#login').foundation();
          }
        },
        error: function(data) {
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
    }
  });

  var loginForm = $("#login-form");
  loginForm.on({
    'submit': function() {
      return false;
    },
    'formvalid.zf.abide': function(e) {
      verify_csrf();
      $('#login-error').addClass('hide');

      e.preventDefault();
      loginData = {
        'login': loginForm.find("input[name='login']" ).val(),
        'password': loginForm.find("input[name='password']" ).val(),
        '_token': $('meta[name="csrf-token"]').attr('content'),
      };

      $.ajax({
        url: '/login',
        type: 'POST',
        cache: false,
        async: false,
        data: loginData,
        success: function(data) {
          if (data.token) {
            $('#login-error').removeClass('hide');
            $('#login-error p').html(data.token);
          }
          else if (data.tokenerror) {
            $('#login-error').removeClass('hide');
            $('#login-error p').html(data.tokenerror);
          }
          else if (data.error) {
            $('#login-error').removeClass('hide');
            $('#login-error p').html(data.error);
          } else {
            $('#login_form').foundation('close');
            $('#login').html(data);
            $('#login').foundation();
          }
        },
        error: function(data) {
          var obj = jQuery.parseJSON(data.responseText);
          if (obj.error) {
            $('#login-error').removeClass('hide');
            $('#login-error p').html(obj.error);
          }
          else if (data.tokenerror) {
            $('#login-error').removeClass('hide');
            $('#login-error p').html('data.tokenerror');
          }
        }
      });
    }
  });

  $("#login").on('click', 'a#logout', function(e){
    verify_csrf();
    e.preventDefault();
    $.ajax({
      url: '/logout',
      type: 'POST',
      cache: false,
      data: {'_token': $('meta[name="csrf-token"]').attr('content')},
      success: function(data) {
        location.reload();
      },
      error: function(data) {
        location.reload();
      }
    });
  });

});
