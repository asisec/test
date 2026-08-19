@extends('frontend.layout.master')
@section('site_title')
 {{ deepl_translate(__('User Register')) }}
@endsection
@section('style')
    <style>
        .loginArea .login-Wrapper .input-form.input-form2 input {
            padding: 8px 0 6px 56px;
        }
        span#phone_availability {
            font-size: 13px;
        }
    </style>
@endsection
@section('content')
    <div class="loginArea section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 p-0  order-lg-1 order-1 loginLeft-img">
                    <div class="loginLeft-img">
                        <div class="login-cap">
                            <h3 class="tittle">{{ get_static_option('register_page_title') ?? deepl_translate(__('Register')) }}</h3>
                            <p class="pera">{{ get_static_option('register_page_description') ?? deepl_translate(__('Buy or Sell any items.')) }}</p>
                        </div>
                        <div class="login-img">
                            {!! render_image_markup_by_attachment_id(get_static_option('register_page_image')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 order-lg-1 order-0 login-Wrapper">
                    @if(get_static_option('site_google_captcha_enable') == 'on')
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                    @endif
                    <x-validation.frontend-error/>
                    <form action="{{ route('user.register') }}" method="post">
                        @csrf
                    <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">{{ deepl_translate(__('First Name')) }}</label>
                                <div class="input-form input-form2">
                                    <input type="text" class="ps-3"  name="first_name" value="{{old('first_name')}}" id="first_name" placeholder="{{ deepl_translate(__('First Name')) }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">{{ deepl_translate(__('Last Name')) }}</label>
                                <div class="input-form input-form2">
                                    <input type="text" class="ps-3"  name="last_name" value="{{old('last_name')}}" id="last_name" placeholder="{{ deepl_translate(__('Last Name')) }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">{{ deepl_translate(__('Username')) }}</label>
                                <div class="input-form input-form2">
                                    <input type="text"  class="ps-3" name="username" value="{{old('username')}}"  id="username" placeholder="{{ deepl_translate(__('Type Username')) }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">{{ deepl_translate(__('Email')) }}</label>
                                <div class="input-form input-form2">
                                    <input type="email" name="email" value="{{old('email')}}" placeholder="{{deepl_translate(__('Type Email'))}}">
                                    <div class="icon">
                                        <i class="lar la-envelope icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">{{ deepl_translate(__('Phone Number')) }}</label>
                                <div class="input-form input-form2">
                                    <input type="hidden" id="country-code" name="country_code">
                                    <input type="tel" name="phone" value="{{old('phone')}}" id="phone" placeholder="{{deepl_translate(__('Type Phone'))}}">
                                    <span id="phone_availability"></span>

                                    <div class="d-none">
                                        <span id="error-msg" class="hide"></span>
                                        <p id="result" class="d-none"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <label class="infoTitle">{{ deepl_translate(__('Password')) }}</label>
                                <div class="input-form">
                                    <input type="password" name="password" id="password" placeholder="{{ deepl_translate(__('Type Password')) }}">
                                    <div class="icon"> <i class="las la-lock icon"></i></div>
                                    <div class="icon toggle-password">
                                       <i class="las la-eye"></i>
                                    </div>
                                </div>
                                <div id="password-criteria" style="margin-top: 10px; font-size: 13px;">
                                    <div id="criteria-length" style="color: #999; margin-bottom: 5px;">
                                        <span style="margin-right: 5px;">✓</span>{{ deepl_translate(__('Min 8 characters')) }}
                                    </div>
                                    <div id="criteria-uppercase" style="color: #999; margin-bottom: 5px;">
                                        <span style="margin-right: 5px;">✓</span>{{ deepl_translate(__('Uppercase letter')) }}
                                    </div>
                                    <div id="criteria-lowercase" style="color: #999; margin-bottom: 5px;">
                                        <span style="margin-right: 5px;">✓</span>{{ deepl_translate(__('Lowercase letter')) }}
                                    </div>
                                    <div id="criteria-number" style="color: #999;">
                                        <span style="margin-right: 5px;">✓</span>{{ deepl_translate(__('Number')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mt-3">
                                <label class="infoTitle">{{ deepl_translate(__('Confirm Password')) }}</label>
                                <div class="input-form">
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="{{ deepl_translate(__('Confirm Password')) }}">
                                    <div class="icon"> <i class="las la-lock icon"></i></div>
                                    <div class="icon toggle-password">
                                       <i class="las la-eye"></i>
                                    </div>
                                </div>
                            </div>

                            <span id="check_password_match" class="mb-2 mt-2"></span>

                            <!-- Terms and Conditions -->
                            <div class="col-lg-12 col-md-12">
                                <label class="checkWrap2 terms-conditions"> {{ deepl_translate(__('I agree with the')) }}
                                    <a href="{{ url('/'.get_static_option('select_terms_condition_page')) }}" target="_blank" class="text-primary"> {{ deepl_translate(__('Terms and Conditions')) }} </a>
                                    <input class="effectBorder check-input" type="checkbox" name="terms_conditions" id="terms_conditions" value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            @if(get_static_option('site_google_captcha_enable') == 'on')
                                <div class="col-md-12 my-3">
                                    <div class="g-recaptcha" data-sitekey="{{ get_static_option('recaptcha_2_site_key')}}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>
                            @endif

                            <div class="col-sm-12 mt-2">
                                <div class="btn-wrapper text-center">
                                    <button type="submit" class="cmn-btn4 w-100 user-register-form sign_up_now_button">{{ deepl_translate(__('Register')) }}
                                        <span id="user_register_load_spinner"></span>
                                    </button>
                                    <!--social login -->
                                    @if(!empty(get_static_option('register_page_social_login_show_hide')))
                                        @if(get_static_option('enable_google_login') || get_static_option('enable_facebook_login'))
                                            <div class="bar-wrap">
                                                <span class="bar"></span>
                                                <p class="or">{{ deepl_translate(__('or')) }}</p>
                                                <span class="bar"></span>
                                            </div>
                                        @endif

                                        @if(get_static_option('enable_google_login'))
                                            <a href="{{ route('login.google.redirect') }}" class="cmn-btn-outline4  mb-20 w-100">
                                                <img src="{{ asset('assets/frontend/img/icon/googleIocn.svg') }}" alt="images" class="icon"> {{ deepl_translate(__('Register With Google')) }}
                                            </a>
                                        @endif
                                        @if(get_static_option('enable_facebook_login'))
                                             <a href="{{ route('login.facebook.redirect') }}" class="cmn-btn-outline4 mb-20  w-100">
                                                 <img src="{{ asset('assets/frontend/img/icon/fbIcon.svg') }}" alt="images" class="icon">{{ deepl_translate(__('Register With Facebook')) }}
                                             </a>
                                        @endif
                                    @endif

                                    <p class="sinUp">
                                        <span>{{ deepl_translate(__('Already have an account?')) }} </span>
                                        <a href="{{ route('user.login') }}" class="singApp">{{ deepl_translate(__('Login')) }}</a>
                                    </p>

                                </div>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End-of login Area -->
@endsection
@section('scripts')
  <x-frontend.js.phone-number-check/>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                $(document).on('keyup', '#username', function() {
                    let username = $(this).val();
                    let usernameRegex = /^[a-zA-Z0-9]+$/;
                    if (usernameRegex.test(username) && username != '') {
                        $.ajax({
                            url: "{{ route('user.name.availability') }}",
                            type: 'post',
                            data: {
                                username: username
                            },
                            success: function(res) {
                                if (res.status == 'available') {
                                    $("#user_name_availability").html(
                                        "<span style='color: green;'>" + res.msg +
                                        "</span>");
                                } else {
                                    $("#user_name_availability").html(
                                        "<span style='color: red;'>" + res.msg +
                                        "</span>");
                                }
                            }
                        });
                    } else {
                        $("#user_name_availability").html(
                            "<span style='color: red;'>{{ deepl_translate(__('Enter valid username')) }}</span>");
                    }
                });

                $(document).on('keyup', '#email', function() {
                    let email = $(this).val();
                    let emailRegex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
                    if (emailRegex.test(email) && email != '') {
                        $.ajax({
                            url: "{{ route('user.email.availability') }}",
                            type: 'post',
                            data: {
                                email: email
                            },
                            success: function(res) {
                                if (res.status == 'available') {
                                    $("#email_availability").html(
                                        "<span style='color: green;'>" + res.msg +
                                        "</span>");
                                } else {
                                    $("#email_availability").html(
                                        "<span style='color: red;'>" + res.msg +
                                        "</span>");
                                }
                            }
                        });
                    } else {
                        $("#email_availability").html(
                            "<span style='color: red;'>{{ deepl_translate(__('Enter valid email')) }}</span>");
                    }
                });


                $(document).on('keyup', '#confirm_password', function() {
                    let password = $("#password").val();
                    let confirm_password = $("#confirm_password").val();
                    if(password.length >= 6 && confirm_password.length >= 6) {
                        if (password != confirm_password) {
                            $("#check_password_match").html("Password does not match !").css("color",
                                "red");
                        } else {
                            $("#check_password_match").html("Password match !").css("color", "green");
                        }
                    }else{
                        $("#check_password_match").html("")
                    }
                });

                $(document).on('keyup', '#password', function() {
                    let password = $("#password").val();
                    let confirm_password = $("#confirm_password").val();
                    if(password.length >= 6 && confirm_password.length >= 6){
                        if(confirm_password != ''){
                            if (password != confirm_password){
                                $("#check_password_match").html("Password does not match !").css("color","red");
                            }else{
                                $("#check_password_match").html("Password match !").css("color", "green");
                            }
                        }else{
                            $("#check_password_match").html("")
                        }
                    }

                });

                // Real-time password validation
                document.getElementById('password').addEventListener('input', function() {
                    let password = this.value;
                    
                    // Validation regex patterns
                    let hasLength = password.length >= 8;
                    let hasUppercase = /[A-Z]/.test(password);
                    let hasLowercase = /[a-z]/.test(password);
                    let hasNumber = /[0-9]/.test(password);
                    
                    // Update criteria display
                    updateCriteria('criteria-length', hasLength);
                    updateCriteria('criteria-uppercase', hasUppercase);
                    updateCriteria('criteria-lowercase', hasLowercase);
                    updateCriteria('criteria-number', hasNumber);
                });

                function updateCriteria(elementId, isMet) {
                    let element = document.getElementById(elementId);
                    if (isMet) {
                        element.style.color = '#28a745';
                        element.style.fontWeight = '500';
                    } else {
                        element.style.color = '#999';
                        element.style.fontWeight = 'normal';
                    }
                }

                //confirm signup
                $(document).on('click', '.sign_up_now_button', function() {

                    let first_name = $('#first_name').val();
                    let last_name = $('#last_name').val();
                    let username = $('#username').val();
                    let email = $('#email').val();
                    let phone = $('#phone').val();
                    let password = $('#password').val();
                    let confirm_password = $('#confirm_password').val();

                    let username_validation_text = $('#user_name_availability span').text();
                    let email_validation_text = $('#email_availability span').text();
                    let password_validation_text = $('#check_password_match').text();
                    let phone_validation_text = $('#phone_availability span').text();

                    if(first_name == '' || last_name == '' || username == '' || email == '' || phone == '' || password == '' || confirm_password == ''){
                        toastr_warning_js("{{ deepl_translate(__('Please fill all fields')) }}")
                        return false
                    }else if(username_validation_text == 'Sorry! Username name is not available' || username_validation_text == 'Enter valid username'){
                        toastr_warning_js("{{ deepl_translate(__('Please enter a valid username')) }}")
                        return false
                    }else if(email_validation_text == 'Sorry! Email has already taken' || email_validation_text == 'Enter valid email'){
                        toastr_warning_js("{{ deepl_translate(__('Please enter a valid email')) }}")
                        return false
                    }else if(phone_validation_text == 'Sorry! Phone Number has already taken' || phone_validation_text == 'Enter valid phone number'){
                        toastr_warning_js("{{ deepl_translate(__('Please enter a valid phone number')) }}")
                        return false
                    }else if(password.length < 6){
                        toastr_warning_js("{{ deepl_translate(__('Password must be 6 character at least')) }}")
                        return false
                    }else if(confirm_password.length < 6){
                        toastr_warning_js("{{ deepl_translate(__('Password must be 6 character at least')) }}")
                        return false
                    }else if(password_validation_text == 'Password does not match !'){
                        toastr_warning_js("{{ deepl_translate(__('Password does not match')) }}")
                        return false
                    }


                    // terms and condition check
                    if (!$('.terms-conditions .check-input').is(":checked")) {
                        toastr_warning_js("{{ deepl_translate(__('Please agree with terms and conditions')) }}")
                        return false;
                    }

                    $(this).attr("disabled", "disabled");
                    $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> {{deepl_translate(__("Registering"))}}');
                  // Submit the form
                    $(this).closest('form').trigger('submit');

                });

            });
        }(jQuery));
    </script>
@endsection
