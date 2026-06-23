<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SmsOtpService
{
    public function normalizePhone(string $phone): string
    {
        $normalizedPhone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($normalizedPhone) === 10) {
            $normalizedPhone = env('SMS_DEFAULT_COUNTRY_CODE', '90') . $normalizedPhone;
        } elseif (strlen($normalizedPhone) === 11 && str_starts_with($normalizedPhone, '0')) {
            $normalizedPhone = env('SMS_DEFAULT_COUNTRY_CODE', '90') . substr($normalizedPhone, 1);
        }

        return $normalizedPhone;
    }

    public function send(string $phone, string $message): Response
    {
        return Http::acceptJson()
            ->asJson()
            ->timeout(15)
            ->post(env('SMS_OTP_ENDPOINT', 'https://api.toplusms.app/api/v1/otp'), [
                'api_key' => env('SMS_API_KEY'),
                'sender' => env('SMS_SENDER', 'TextileForum'),
                'message_type' => env('SMS_MESSAGE_TYPE', 'normal'),
                'message' => $message,
                'phones' => [$this->normalizePhone($phone)],
                'add_cancel_link' => filter_var(env('SMS_ADD_CANCEL_LINK', false), FILTER_VALIDATE_BOOL),
            ]);
    }
}