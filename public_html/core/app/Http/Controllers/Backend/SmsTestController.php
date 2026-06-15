<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsTestController extends Controller
{
    public function index()
    {
        // 6 Haneli Rastgele OTP Kodu Üretiyoruz
        $randomOtp = rand(100000, 999999);
        return view('backend.sms-test', compact('randomOtp'));
    }

    public function sendTestSms(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        try {
            // Telefon numarasını temizleyip 10 haneye düşürme
            $telefon = preg_replace('/[^0-9]/', '', $validated['phone']);
            if (strlen($telefon) > 10 && substr($telefon, 0, 2) == '90') {
                $telefon = substr($telefon, 2);
            } elseif (strlen($telefon) == 11 && substr($telefon, 0, 1) == '0') {
                $telefon = substr($telefon, 1);
            }

            // TopluSMS YENİ NESİL OTP API
            $response = Http::acceptJson()->asJson()->timeout(15)->post('https://api.toplusms.app/api/v1/otp', [
                'api_key' => '977edcca6820234098f19529',
                'sender' => 'TEXTILEFRM', // 'required' hatasını aşmak için test başlığını ekledik!
                'message_type' => 'normal',
                'message' => $validated['message'],
                'phones' => [$telefon],
                'add_cancel_link' => false
            ]);

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