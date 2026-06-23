<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Models\PhoneVerification;
use App\Models\User;
use App\Services\SmsOtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class VerificationController extends Controller
{
    public function center()
    {
        return view('frontend.user.verification-center');
    }

    public function send(Request $request, SmsOtpService $smsOtpService): JsonResponse|RedirectResponse
    {
        $user = auth('web')->user();

        if (! $user) {
            return response()->json(['status' => false, 'message' => __('Unauthenticated')], 401);
        }

        $existingSend = RateLimiter::tooManyAttempts('phone-verification-send:'.$user->id, 1);

        if ($existingSend) {
            $seconds = RateLimiter::availableIn('phone-verification-send:'.$user->id);

            return $this->respond($request, false, __('Lütfen tekrar denemeden önce :seconds saniye bekleyin.', ['seconds' => $seconds]));
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

        $code = (string) random_int(100000, 999999);

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
                $verification->delete();

                return $this->respond($request, false, __('SMS gönderilemedi. Lütfen tekrar deneyin.'));
            }
        } catch (\Throwable $exception) {
            report($exception);
            $verification->delete();

            return $this->respond($request, false, __('SMS gönderilemedi. Lütfen tekrar deneyin.'));
        }

        RateLimiter::hit('phone-verification-send:'.$user->id, 120);

        return $this->respond($request, true, __('Doğrulama kodu telefonunuza gönderildi.'), [
            'expires_in' => 300,
        ]);
    }

    public function verify(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = auth('web')->user();

        if (! $user) {
            return response()->json(['status' => false, 'message' => __('Unauthenticated')], 401);
        }

        $verification = PhoneVerification::query()
            ->where('user_id', $user->id)
            ->where('type', 'sms')
            ->where('code', (string) $request->input('code'))
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->latest('id')
            ->first();

        if (! $verification) {
            return $this->respond($request, false, __('Doğrulama kodu geçersiz veya süresi dolmuş.'));
        }

        $verification->forceFill(['is_used' => true])->save();
        User::where('id', $user->id)->update(['otp_verified' => 1]);
        RateLimiter::clear('phone-verification-send:'.$user->id);

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