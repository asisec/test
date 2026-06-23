<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\PhoneVerification;
use App\Models\User;
use App\Services\SmsOtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use App\Mail\BasicMail;

class VerificationController extends Controller
{
    public function index()
    {
        return view('frontend.user.verification-center');
    }

    public function send(Request $request, SmsOtpService $smsOtpService): JsonResponse|RedirectResponse
    {
        $user = auth('web')->user();

        if (! $user) {
            return response()->json(['status' => false, 'message' => __('Unauthenticated')], 401);
        }

        $channel = $request->input('channel', 'sms');
        $rateKey = $channel === 'email' ? 'email-verification-send:' . $user->id : 'phone-verification-send:' . $user->id;

        $existingSend = RateLimiter::tooManyAttempts($rateKey, 1);

        if ($existingSend) {
            $seconds = RateLimiter::availableIn($rateKey);

            return $this->respond($request, false, __('Lütfen tekrar denemeden önce :seconds saniye bekleyin.', ['seconds' => $seconds]));
        }

        $code = (string) random_int(100000, 999999);

        if ($channel === 'email') {
            PhoneVerification::query()
                ->where('user_id', $user->id)
                ->where('type', 'email')
                ->where('is_used', false)
                ->update(['is_used' => true]);

            PhoneVerification::create([
                'user_id' => $user->id,
                'code' => $code,
                'type' => 'email',
                'expires_at' => now()->addMinutes(5),
                'is_used' => false,
            ]);

            try {
                Mail::to($user->email)->send(new BasicMail([
                    'subject' => __('Email Verification Code'),
                    'message' => __('Your verification code is :code', ['code' => $code]),
                ]));
            } catch (\Throwable $exception) {
                Log::error('Email Verification Error: ' . $exception->getMessage());

                return $this->respond($request, false, __('Email gönderilemedi. Lütfen tekrar deneyin.'));
            }

            RateLimiter::hit($rateKey, 120);

            return $this->respond($request, true, __('Doğrulama kodu e-posta adresinize gönderildi.'), [
                'expires_in' => 300,
            ]);
        }

        $phone = trim((string) $request->input('phone', $user->phone));

        if ($phone === '') {
            return $this->respond($request, false, __('Telefon numarası bulunamadı.'));
        }

        $normalizedPhone = $smsOtpService->normalizePhone($phone);

        $duplicatePhone = User::query()
            ->where('phone', $normalizedPhone)
            ->where('id', '!=', $user->id)
            ->exists();

        if ($duplicatePhone) {
            return $this->respond($request, false, __('Bu telefon numarası başka bir hesap tarafından kullanılıyor.'));
        }

        if ($user->phone !== $normalizedPhone) {
            $user->forceFill(['phone' => $normalizedPhone])->save();
        }

        PhoneVerification::query()
            ->where('user_id', $user->id)
            ->where('type', 'sms')
            ->where('is_used', false)
            ->update(['is_used' => true]);

        $verification = PhoneVerification::create([
            'user_id' => $user->id,
            'code' => $code,
            'type' => 'sms',
            'expires_at' => now()->addMinutes(5),
            'is_used' => false,
        ]);

        try {
            $response = $smsOtpService->send($normalizedPhone, __('TextileForum güvenlik kodunuz: :code. Lütfen kimseyle paylaşmayınız.', ['code' => $code]));

            if (! $response->successful()) {
                Log::error('SMS Error: ' . $response->body());
                $verification->delete();

                return $this->respond($request, false, __('SMS gönderilemedi. Lütfen tekrar deneyin.'));
            }
        } catch (\Throwable $exception) {
            Log::error('SMS Error: ' . $exception->getMessage());
            $verification->delete();

            return $this->respond($request, false, __('SMS gönderilemedi. Lütfen tekrar deneyin.'));
        }

        RateLimiter::hit($rateKey, 120);

        return $this->respond($request, true, __('Doğrulama kodu telefonunuza gönderildi.'), [
            'expires_in' => 300,
        ]);
    }

    public function verify(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
            'channel' => ['nullable', 'in:sms,email'],
        ]);

        $user = auth('web')->user();

        if (! $user) {
            return response()->json(['status' => false, 'message' => __('Unauthenticated')], 401);
        }

        $channel = $request->input('channel', 'sms');

        $verification = PhoneVerification::query()
            ->where('user_id', $user->id)
            ->where('type', $channel)
            ->where('code', (string) $request->input('code'))
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->latest('id')
            ->first();

        if (! $verification) {
            return $this->respond($request, false, __('Doğrulama kodu geçersiz veya süresi dolmuş.'));
        }

        $verification->forceFill(['is_used' => true])->save();
        if ($channel === 'sms') {
            User::where('id', $user->id)->update(['otp_verified' => 1]);
            RateLimiter::clear('phone-verification-send:'.$user->id);
        } else {
            User::where('id', $user->id)->update(['email_verified' => 1]);
            RateLimiter::clear('email-verification-send:'.$user->id);
        }

        return $this->respond($request, true, __('Telefon numaranız doğrulandı.'));
    }

    private function respond(Request $request, bool $success, string $message, array $payload = []): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(array_merge([
                'status' => $success ? 'success' : 'error',
                'message' => $message,
            ], $payload), $success ? 200 : 422);
        }

        return $success
            ? back()->with('success', $message)
            : back()->with('error', $message);
    }
}