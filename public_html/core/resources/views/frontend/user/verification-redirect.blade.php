@extends('frontend.layout.master')
@section('site_title', __('Telefon Doğrulama Gerekiyor'))

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
                        <h3 class="mb-3">{{ __('Telefon doğrulaması gerekli') }}</h3>
                        <p class="text-muted mb-4">
                            {{ __('İlan ekleyebilmek için telefon numaranızı doğrulamanız gerekmektedir. 3 saniye içinde doğrulama merkezine yönlendiriliyorsunuz...') }}
                        </p>
                        <div class="display-6 fw-bold text-primary mb-2" id="redirect-countdown">3</div>
                        <div class="text-muted">{{ __('Doğrulama merkezine yönlendiriliyor...') }}</div>
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