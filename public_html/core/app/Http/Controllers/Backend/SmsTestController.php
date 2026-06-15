<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsTestController extends Controller
{
    public function index()
    {
        // 6 haneli test OTP'mizi oluşturuyoruz
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
            // Telefon numarasını sadece rakamlara çeviriyoruz
            $telefon = preg_replace('/[^0-9]/', '', $validated['phone']);
            
            // Dokümantasyondaki "905xxxx" standardını sağlamak için düzenliyoruz
            if (strlen($telefon) == 10) {
                $telefon = '90' . $telefon;
            } elseif (strlen($telefon) == 11 && substr($telefon, 0, 1) == '0') {
                $telefon = '90' . substr($telefon, 1);
            }

            // WaMessage (TopluSMS) OTP Endpoint'i - Kitabına %100 Uygun Format
            $response = Http::acceptJson()->asJson()->timeout(15)->post('https://api.toplusms.app/api/v1/otp', [
                'api_key' => '977edcca6820234098f19529',
                'sender' => 'MERT YILDRM', // Başlık onaylanınca sistem otomatik çalışacak
                'message_type' => 'normal',
                'message' => $validated['message'],
                'phones' => [
                    $telefon
                ],
                'add_cancel_link' => false // OTP olduğu için false bırakıyoruz
            ]);

            // Cevap analizi
            if ($response->successful()) {
                return back()->withInput()->with('sms_test_success', __('OTP Test Başarılı! Sunucu Cevabı: ') . $response->body());
            }

            return back()->withInput()->with('sms_test_error', __('OTP Test Başarısız! Hata Cevabı: ') . $response->body());
            
        } catch (\Throwable $exception) {
            report($exception);
            return back()->withInput()->with('sms_test_error', __('API Sunucusuna Ulaşılamadı: ') . $exception->getMessage());
        }
    }
}