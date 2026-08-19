@extends('frontend.layout.master')
@section('site_title', deepl_translate(__('Security and Verification Center')))

@section('style')
    <style>
        .verification-timer {
            font-weight: 700;
            color: #0f172a;
        }

        .verification-badge {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .45rem .75rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: .875rem;
        }

        .verification-badge.success {
            background: rgba(25, 135, 84, .12);
            color: #198754;
        }

        .verification-badge.warning {
            background: rgba(220, 53, 69, .12);
            color: #dc3545;
        }

        .otp-panel {
            display: none;
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

                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-body p-4 p-lg-5">
                                        <h3 class="mb-2">{{ deepl_translate(__('Security and Verification Center')) }}</h3>
                                        <p class="text-muted mb-0">{{ deepl_translate(__('Manage your email and phone verification for account security.')) }}</p>
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-body p-4 p-lg-5">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                                            <div>
                                                <h5 class="mb-1">{{ deepl_translate(__('Email Verification Status')) }}</h5>
                                                <p class="text-muted mb-0">{{ deepl_translate(__('Used for password reset and account notifications.')) }}</p>
                                            </div>
                                            @if((int) auth('web')->user()->email_verified === 1)
                                                <span class="verification-badge success"><i class="fas fa-check-circle"></i> {{ deepl_translate(__('Verified')) }}</span>
                                            @else
                                                <span class="verification-badge warning"><i class="fas fa-times-circle"></i> {{ deepl_translate(__('Not Verified')) }}</span>
                                            @endif
                                        </div>

                                        @if((int) auth('web')->user()->email_verified !== 1)
                                            <div class="row g-3 align-items-end">
                                                <div class="col-lg-6">
                                                    <label class="form-label">{{ deepl_translate(__('Email Address')) }}</label>
                                                    <input type="email" id="verification-email" class="form-control" value="{{ auth('web')->user()->email }}" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <button type="button" id="send-email-code" class="btn btn-primary w-100">{{ deepl_translate(__('Send Verification Code')) }}</button>
                                                </div>
                                            </div>

                                            <div class="otp-panel mt-3" id="email-otp-panel">
                                                <div class="row g-3 align-items-end">
                                                    <div class="col-lg-4">
                                                        <label class="form-label">{{ deepl_translate(__('Email Code')) }}</label>
                                                        <input type="text" id="email-verification-code" class="form-control" maxlength="6" placeholder="123456">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="text-muted mb-1">{{ deepl_translate(__('Time remaining')) }}</div>
                                                        <div class="verification-timer" id="email-otp-timer">02:00</div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button type="button" id="verify-email-code" class="btn btn-primary w-100">{{ deepl_translate(__('Confirm Email Code')) }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0">
                                    <div class="card-body p-4 p-lg-5">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
                                            <div>
                                                <h5 class="mb-1">{{ deepl_translate(__('Phone Verification Status')) }}</h5>
                                                <p class="text-muted mb-0">{{ deepl_translate(__('Phone verification is required to post listings.')) }}</p>
                                            </div>
                                            @if((int) auth('web')->user()->otp_verified === 1)
                                                <span class="verification-badge success"><i class="fas fa-check-circle"></i> {{ deepl_translate(__('Verified')) }}</span>
                                            @else
                                                <span class="verification-badge warning"><i class="fas fa-times-circle"></i> {{ deepl_translate(__('Not Verified')) }}</span>
                                            @endif
                                        </div>

                                        @if((int) auth('web')->user()->otp_verified !== 1)
                                            <div class="row g-3 align-items-end">
                                                <div class="col-lg-6">
                                                    <label class="form-label">{{ deepl_translate(__('Phone Number')) }}</label>
                                                    <input type="tel" id="verification-phone" class="form-control" value="{{ auth('web')->user()->phone }}" placeholder="{{ deepl_translate(__('Enter your phone number')) }}">
                                                </div>
                                                <div class="col-lg-6">
                                                    <button type="button" id="send-phone-otp" class="btn btn-primary w-100">{{ deepl_translate(__('Send Verification Code')) }}</button>
                                                </div>
                                            </div>

                                            <div class="otp-panel mt-3" id="phone-otp-panel">
                                                <div class="row g-3 align-items-end">
                                                    <div class="col-lg-4">
                                                        <label class="form-label">{{ deepl_translate(__('Verification Code')) }}</label>
                                                        <input type="text" id="verification-code" class="form-control" maxlength="6" placeholder="123456">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="text-muted mb-1">{{ deepl_translate(__('Time remaining')) }}</div>
                                                        <div class="verification-timer" id="otp-timer">02:00</div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button type="button" id="verify-phone-otp" class="btn btn-primary w-100">{{ deepl_translate(__('Confirm')) }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-3" id="verification-message"></div>
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

            let emailCountdownTimer = null;
            let phoneCountdownTimer = null;
            let remainingEmailSeconds = 120;
            let remainingPhoneSeconds = 120;

            function renderMessage(type, message) {
                $('#verification-message').html('<div class="alert alert-' + type + ' mb-0">' + message + '</div>');
            }

            function startEmailCountdown() {
                clearInterval(emailCountdownTimer);
                remainingEmailSeconds = 120;
                $('#email-otp-panel').slideDown(180);
                $('#email-otp-timer').text('02:00');

                emailCountdownTimer = setInterval(function () {
                    remainingEmailSeconds -= 1;

                    if (remainingEmailSeconds <= 0) {
                        clearInterval(emailCountdownTimer);
                        $('#email-otp-timer').text('00:00');
                        return;
                    }

                    const minutes = String(Math.floor(remainingEmailSeconds / 60)).padStart(2, '0');
                    const seconds = String(remainingEmailSeconds % 60).padStart(2, '0');
                    $('#email-otp-timer').text(minutes + ':' + seconds);
                }, 1000);
            }

            function startPhoneCountdown() {
                clearInterval(phoneCountdownTimer);
                remainingPhoneSeconds = 120;
                $('#phone-otp-panel').slideDown(180);
                $('#otp-timer').text('02:00');

                phoneCountdownTimer = setInterval(function () {
                    remainingPhoneSeconds -= 1;

                    if (remainingPhoneSeconds <= 0) {
                        clearInterval(phoneCountdownTimer);
                        $('#otp-timer').text('00:00');
                        return;
                    }

                    const minutes = String(Math.floor(remainingPhoneSeconds / 60)).padStart(2, '0');
                    const seconds = String(remainingPhoneSeconds % 60).padStart(2, '0');
                    $('#otp-timer').text(minutes + ':' + seconds);
                }, 1000);
            }

            $(document).on('click', '#send-email-code', function () {
                const button = $(this);

                button.prop('disabled', true).text('{{ deepl_translate(__('Sending...')) }}');
                $('#verification-message').empty();

                $.ajax({
                    url: '{{ route('user.verification.send') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        channel: 'email'
                    },
                    success: function (response) {
                        renderMessage('success', response.message);
                        startEmailCountdown();
                    },
                    error: function (xhr) {
                        const response = xhr.responseJSON || {};
                        renderMessage('danger', response.message || '{{ deepl_translate(__('Failed to send email code. Please try again.')) }}');
                    },
                    complete: function () {
                        button.prop('disabled', false).text('{{ deepl_translate(__('Send Verification Code')) }}');
                    }
                });
            });

            $(document).on('click', '#verify-email-code', function () {
                const code = $('#email-verification-code').val();
                const button = $(this);

                button.prop('disabled', true).text('{{ deepl_translate(__('Checking...')) }}');

                $.ajax({
                    url: '{{ route('user.verification.verify') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        channel: 'email',
                        code: code
                    },
                    success: function (response) {
                        renderMessage('success', response.message);
                        clearInterval(emailCountdownTimer);
                        setTimeout(function () {
                            window.location.reload();
                        }, 900);
                    },
                    error: function (xhr) {
                        const response = xhr.responseJSON || {};
                        renderMessage('danger', response.message || '{{ deepl_translate(__('Invalid verification code.')) }}');
                    },
                    complete: function () {
                        button.prop('disabled', false).text('{{ deepl_translate(__('Confirm Email Code')) }}');
                    }
                });
            });

            $(document).on('click', '#send-phone-otp', function () {
                const phone = $('#verification-phone').val();
                const button = $(this);

                button.prop('disabled', true).text('{{ deepl_translate(__('Sending...')) }}');
                $('#verification-message').empty();

                $.ajax({
                    url: '{{ route('user.verification.send') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        channel: 'sms',
                        phone: phone
                    },
                    success: function (response) {
                        renderMessage('success', response.message);
                        startPhoneCountdown();
                    },
                    error: function (xhr) {
                        const response = xhr.responseJSON || {};
                        renderMessage('danger', response.message || '{{ deepl_translate(__('Failed to send SMS. Please try again.')) }}');
                    },
                    complete: function () {
                        button.prop('disabled', false).text('{{ deepl_translate(__('Send Verification Code')) }}');
                    }
                });
            });

            $(document).on('click', '#verify-phone-otp', function () {
                const code = $('#verification-code').val();
                const button = $(this);

                button.prop('disabled', true).text('{{ deepl_translate(__('Checking...')) }}');

                $.ajax({
                    url: '{{ route('user.verification.verify') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        channel: 'sms',
                        code: code
                    },
                    success: function (response) {
                        renderMessage('success', response.message);
                        clearInterval(phoneCountdownTimer);
                        setTimeout(function () {
                            window.location.reload();
                        }, 900);
                    },
                    error: function (xhr) {
                        const response = xhr.responseJSON || {};
                        renderMessage('danger', response.message || '{{ deepl_translate(__('Invalid verification code.')) }}');
                    },
                    complete: function () {
                        button.prop('disabled', false).text('{{ deepl_translate(__('Confirm')) }}');
                    }
                });
            });
        })(jQuery);
    </script>
@endsection