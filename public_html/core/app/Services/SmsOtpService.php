<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SmsOtpService
{
    public function normalizePhone(string $phone): string
    {
        $normalizedPhone = preg_replace('/[^0-9]/', '', $phone);

        $normalizedPhone = ltrim($normalizedPhone, '0');

        if (strlen($normalizedPhone) === 10) {
            $normalizedPhone = env('SMS_DEFAULT_COUNTRY_CODE', '90') . $normalizedPhone;
        } elseif (strlen($normalizedPhone) === 12 && str_starts_with($normalizedPhone, env('SMS_DEFAULT_COUNTRY_CODE', '90'))) {
            return $normalizedPhone;
        }

        return $normalizedPhone;
    }

    public function send(string $phone, string $message): Response
    {
        $telefon = $this->normalizePhone($phone);

        return Http::acceptJson()->asJson()->timeout(15)->post('https://api.toplusms.app/api/v1/otp', [
            'api_key' => '977edcca6820234098f19529',
            'sender' => 'MERT YILDRM',
            'message_type' => 'normal',
            'message' => $message,
            'phones' => [
                $telefon
            ],
            'add_cancel_link' => false,
        ]);
    }
}