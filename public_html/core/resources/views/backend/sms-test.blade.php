@extends('backend.admin-master')

@section('site-title')
    {{ __('OTP Test Simülatörü') }}
@endsection

@section('content')
    <div class="row g-4 mt-0">
        <div class="col-xl-8 col-lg-10 mt-0">
            <div class="dashboard__card bg__white padding-20 radius-10">
                <h2 class="dashboard__card__header__title mb-3">{{ __('Vatan SMS - OTP Test Simülatörü') }}</h2>

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
                            <label for="phone" class="form__input__single__label">{{ __('Alıcı Telefon Numarası') }}</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form__control radius-5" placeholder="Örn: 5551234567">
                        </div>

                        <div class="form__input__single">
                            <label for="message" class="form__input__single__label">{{ __('OTP Şifresi (Otomatik Üretildi)') }}</label>
                            <textarea name="message" id="message" rows="3" class="form__control radius-5" readonly>TextileForum güvenlik kodunuz: {{ $randomOtp ?? rand(100000, 999999) }}. Lütfen kimseyle paylaşmayınız.</textarea>
                            <small class="form-text text-muted">{{ __('Bu şifre her sayfa yenilendiğinde otomatik olarak generate edilir.') }}</small>
                        </div>
                    </div>

                    <div class="btn_wrapper mt-4">
                        <button type="submit" class="cmnBtn btn_5 btn_bg_blue radius-5">{{ __('OTP SMS Ateşle') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection