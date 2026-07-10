@extends('frontend.layout.master')
@section('site_title', __('Phone Verification Required'))

@section('content')
    <main class="section-padding2">
        <div class="container-1920 plr1">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-xl-6">
                    <div class="card border-0 shadow-sm text-center p-4 p-lg-5">
                        <div class="mb-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning-subtle text-warning" style="width:72px;height:72px;font-size:1.8rem;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                        </div>
                        <h3 class="mb-3">{{ __('Phone verification required') }}</h3>
                        <p class="text-muted mb-4">
                            {{ __('You must verify your phone number to post listings. Redirecting to the verification center in 3 seconds...') }}
                        </p>
                        <div class="display-6 fw-bold text-primary mb-2" id="redirect-countdown">3</div>
                        <div class="text-muted">{{ __('Redirecting to the verification center...') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        (function () {
            let remaining = 3;
            const countdown = document.getElementById('redirect-countdown');

            const timer = setInterval(function () {
                remaining -= 1;
                countdown.textContent = remaining;

                if (remaining <= 0) {
                    clearInterval(timer);
                    window.location.href = "{{ route('user.verification.center') }}";
                }
            }, 1000);
        })();
    </script>
@endsection