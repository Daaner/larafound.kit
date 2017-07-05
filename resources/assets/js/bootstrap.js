
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
Foundation.Abide.defaults.patterns['password'] = /^(.){1,}$/;


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

  var registerForm = $("#register-form");
  registerForm.on({
    'submit': function() {
      $("#register-error").addClass("hide");
      return false;
    },
    'formvalid.zf.abide': function(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();
      var formDataReg = registerForm.serialize();
      $('#register-error p').html("");
      $("#register-error").addClass("hide");
      $.ajax({
        url: '/register',
        type: 'POST',
        cache: false,
        data: formDataReg,
        success: function(data) {
          if (data.name) {
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
      $("#login-error").addClass("hide");
      return false;
    },
    'formvalid.zf.abide': function(e) {
      e.preventDefault();
      var formDataLogin = loginForm.serialize();
      $('#login-error p').html("");
      $("#login-error").addClass("hide");
      var fdata = {
        'login': loginForm.find("input[name='login']" ).val(),
        'password': loginForm.find("input[name='password']" ).val(),
        '_token': loginForm.find('input[name="_token"]').val()
      };
      $.ajax({
        url: '/login',
        type: 'POST',
        cache: false,
        data: fdata,
        success: function(data) {
          if (data.error) {
            $("#login-error").removeClass("hide");
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
            $("#login-error").addClass("hide");
            $('#login-error p').html(obj.error);
          }
        }
      });
    }
  });

  $("#login").on('click', 'a#logout', function(e){
    e.preventDefault();
    $.ajax({
      url: '/logout',
      type: 'POST',
      cache: false,
      data: {'_token': $('#login input[name="_token"]').val()},
      success: function(data) {
        location.reload();
      },
      error: function(data) {
        // location.reload();
      }
    });
  });

});
