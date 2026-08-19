@extends('frontend.layout.master')
@section('site_title')
    {{ deepl_translate(__('Password Reset')) }}
@endsection
@section('content')
    <div class="loginArea section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 login-Wrapper">
                    <h3 class="tittle mb-3"> {{deepl_translate(__('Password Reset')) }}</h3>
                    <x-validation.frontend-error/>
                    <form method="post" action="{{ route('user.forgot.password.reset') }}">
                        @csrf
                        <div class="col-lg-12">
                            <label class="infoTitle" for="password"> {{ deepl_translate(__('New Password')) }} </label>
                            <div class="input-form input-form2">
                                <input type="text" name="password" placeholder="{{ deepl_translate(__('Enter new password')) }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="infoTitle" for="confirm_password"> {{ deepl_translate(__('Confirm New Password')) }} </label>
                            <div class="input-form input-form2">
                                <input type="text" name="confirm_password" placeholder="{{ deepl_translate(__('Confirm New Password')) }}">
                            </div>
                        </div>
                        <div class="btn-wrapper mb-10">
                            <button type="submit" class="cmn-btn4 w-100">{{ deepl_translate(__('Submit')) }}</button>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>
@endsection
