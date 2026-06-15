@extends('backend.admin-master')

@section('site-title')
    {{ __('SMS Test Interface') }}
@endsection

@section('content')
    <div class="row g-4 mt-0">
        <div class="col-xl-8 col-lg-10 mt-0">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <h2 class="dashboard__card__header__title mb-3">{{ __('SMS Test Interface') }}</h2>

                <x-validation.error/>

                @if(session('sms_test_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('sms_test_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('sms_test_error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('sms_test_error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.sms.test.send') }}" method="POST">
                    @csrf
                    <div class="form__input__flex">
                        <div class="form__input__single">
                            <label for="phone" class="form__input__single__label">{{ __('Phone Number') }}</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form__control radius-5" placeholder="+905551234567">
                            <small class="form-text text-muted">{{ __('Use the full international phone number format.') }}</small>
                        </div>

                        <div class="form__input__single">
                            <label for="message" class="form__input__single__label">{{ __('Test Message') }}</label>
                            <textarea name="message" id="message" rows="5" class="form__control radius-5" placeholder="{{ __('Enter your test SMS message here.') }}">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <div class="btn_wrapper mt-4">
                        <button type="submit" class="cmnBtn btn_5 btn_bg_blue radius-5">{{ __('Send Test SMS') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection