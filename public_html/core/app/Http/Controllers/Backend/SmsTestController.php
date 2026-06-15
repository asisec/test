<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsTestController extends Controller
{
    public function index()
    {
        return view('backend.sms-test');
    }

    public function sendTestSms(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            // Telefon numarasını temizleyip 10 haneye düşürme (örnek: 5551234567)
            $telefon = preg_replace('/[^0-9]/', '', $validated['phone']);
            if (strlen($telefon) > 10 && substr($telefon, 0, 2) == '90') {
                $telefon = substr($telefon, 2);
            } elseif (strlen($telefon) == 11 && substr($telefon, 0, 1) == '0') {
                $telefon = substr($telefon, 1);
            }

            // TopluSMS / WaMessage OTP (Doğrulama) API İstek Formatı
            $response = Http::acceptJson()->asJson()->timeout(15)->post('https://api.toplusms.app/api/v1/otp', [
                'api_key' => '977edcca6820234098f19529',
                // 'sender' => 'TEXTILEFRM', // Mert abi başlığı onaylatınca başındaki // işaretlerini kaldır
                'message_type' => 'normal',
                'message' => $validated['message'],
                'phones' => [$telefon],
                'add_cancel_link' => false // OTP mesajlarında iptal linki olmaz
            ]);

            // Gelen JSON cevabını analiz etme
            if ($response->successful()) {
                return back()->withInput()->with('sms_test_success', __('OTP Test Başarıyla Ateşlendi! Cevap: ') . $response->body());
            }

            return back()->withInput()->with('sms_test_error', __('OTP Test Başarısız Oldu! Hata Cevabı: ') . $response->body());
            
        } catch (\Throwable $exception) {
            report($exception);
            return back()->withInput()->with('sms_test_error', __('API sunucusuna ulaşılamadı. Hata: ') . $exception->getMessage());
        }
    }
}