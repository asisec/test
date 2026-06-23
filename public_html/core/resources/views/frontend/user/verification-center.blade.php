@extends('frontend.layout.master')
@section('site_title', __('Doğrulama Merkezi'))

@section('style')
    <style>
        .verification-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
            padding: 22px;
            margin-bottom: 18px;
        }

        .verification-label {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .verification-desc {
            color: #64748b;
            margin-bottom: 0;
        }

        .verification-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .verification-badge.success {
            background: rgba(34, 197, 94, 0.12);
            color: #15803d;
        }

        .verification-badge.warning {
            background: rgba(245, 158, 11, 0.12);
            color: #b45309;
        }

        .verification-form .form-control {
            min-height: 48px;
            border-radius: 12px;
        }

        .otp-panel {
            display: none;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px dashed rgba(15, 23, 42, 0.12);
        }

        .otp-timer {
            font-weight: 700;
            color: #0f172a;
        }
    </style>
@endsection

@section('content')
    <main class="section-padding2">
        <div class="container-1920 plr1">
            <div class="row">
                <div class="col-12">
                    <div class="profile-setting-wraper">
                        @include('frontend.user.layout.partials.user-profile-background-image')
                        <div class="down-body-wraper">
                            @include('frontend.user.layout.partials.sidebar')
                            <div class="main-body">
                                <x-validation.frontend-error />

                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="verification-card">
                                    <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                                        <div>
                                            <h3 class="mb-2">{{ __('Security & Verification Center') }}</h3>
                                            <p class="verification-desc">{{ __('Manage your email and phone verification in one place.') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="verification-card">
                                    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
                                        <div>
                                            <div class="verification-label">{{ __('Email Verification Status') }}</div>
                                            <p class="verification-desc">{{ __('Used for password recovery and account notifications.') }}</p>
                                        </div>
                                        @if((int) auth('web')->user()->email_verified === 1)
                                            <span class="verification-badge success">{{ __('Verified') }}</span>
                                        @else
                                            <span class="verification-badge warning">{{ __('Not Verified') }}</span>
                                        @endif
                                    </div>

                                    @if((int) auth('web')->user()->email_verified !== 1)
                                        <a href="{{ route('resend.verify.code') }}" class="cmn-btn4 radius-5">{{ __('Doğrulama Bağlantısı Gönder') }}</a>
                                    @endif
                                </div>

                                <div class="verification-card">
                                    <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap mb-3">
                                        <div>
                                            <div class="verification-label">{{ __('Phone Verification Status') }}</div>
                                            <p class="verification-desc">{{ __('Required before creating listings.') }}</p>
                                        </div>
                                        @if((int) auth('web')->user()->otp_verified === 1)
                                            <span class="verification-badge success">{{ __('Verified') }}</span>
                                        @else
                                            <span class="verification-badge warning">{{ __('Not Verified') }}</span>
                                        @endif
                                    </div>

                                    @if((int) auth('web')->user()->otp_verified !== 1)
                                        <div class="verification-form">
                                            <div class="row g-3">
                                                <div class="col-lg-6">
                                                    <label class="form-label">{{ __('Phone Number') }}</label>
                                                    <input type="tel" id="verification-phone" class="form-control" value="{{ auth('web')->user()->phone }}" placeholder="{{ __('Enter phone number') }}">
                                                </div>
                                                <div class="col-lg-6 d-flex align-items-end">
                                                    <button type="button" id="send-phone-otp" class="cmn-btn4 w-100">{{ __('Doğrulama Kodu Gönder') }}</button>
                                                </div>
                                            </div>

                                            <div class="otp-panel" id="otp-panel">
                                                <div class="row g-3 align-items-end">
                                                    <div class="col-lg-4">
                                                        <label class="form-label">{{ __('Verification Code') }}</label>
                                                        <input type="text" id="verification-code" class="form-control" maxlength="6" placeholder="123456">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="verification-desc mb-1">{{ __('Time remaining') }}</div>
                                                        <div class="otp-timer" id="otp-timer">02:00</div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button type="button" id="verify-phone-otp" class="cmn-btn4 w-100">{{ __('Onayla') }}</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3" id="verification-message"></div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        (function ($) {
            'use strict';

            let countdownTimer = null;
            let remainingSeconds = 120;

            function renderMessage(type, message) {
                $('#verification-message').html('<div class="alert alert-' + type + ' mb-0">' + message + '</div>');
            }

            function startCountdown() {
                clearInterval(countdownTimer);
                remainingSeconds = 120;
                $('#otp-panel').slideDown(180);
                $('#otp-timer').text('02:00');

                countdownTimer = setInterval(function () {
                    remainingSeconds -= 1;

                    if (remainingSeconds <= 0) {
                        clearInterval(countdownTimer);
                        $('#otp-timer').text('00:00');
                        return;
                    }

                    const minutes = String(Math.floor(remainingSeconds / 60)).padStart(2, '0');
                    const seconds = String(remainingSeconds % 60).padStart(2, '0');
                    $('#otp-timer').text(minutes + ':' + seconds);
                }, 1000);
            }

            $(document).on('click', '#send-phone-otp', function () {
                const phone = $('#verification-phone').val();
                const button = $(this);

                button.prop('disabled', true).text('{{ __('Gönderiliyor...') }}');
                $('#verification-message').empty();

                $.ajax({
                    url: '{{ route('user.verification.send') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        phone: phone
                    },
                    success: function (response) {
                        renderMessage('success', response.message);
                        startCountdown();
                    },
                    error: function (xhr) {
                        const response = xhr.responseJSON || {};
                        renderMessage('danger', response.message || '{{ __('SMS gönderilemedi. Lütfen tekrar deneyin.') }}');
                    },
                    complete: function () {
                        button.prop('disabled', false).text('{{ __('Doğrulama Kodu Gönder') }}');
                    }
                });
            });

            $(document).on('click', '#verify-phone-otp', function () {
                const code = $('#verification-code').val();
                const button = $(this);

                button.prop('disabled', true).text('{{ __('Kontrol ediliyor...') }}');

                $.ajax({
                    url: '{{ route('user.verification.verify') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        code: code
                    },
                    success: function (response) {
                        renderMessage('success', response.message);
                        clearInterval(countdownTimer);
                        setTimeout(function () {
                            window.location.reload();
                        }, 900);
                    },
                    error: function (xhr) {
                        const response = xhr.responseJSON || {};
                        renderMessage('danger', response.message || '{{ __('Doğrulama kodu geçersiz.') }}');
                    },
                    complete: function () {
                        button.prop('disabled', false).text('{{ __('Onayla') }}');
                    }
                });
            });
        })(jQuery);
    </script>
@endsection