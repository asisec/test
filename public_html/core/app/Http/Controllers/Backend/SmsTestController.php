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
            $response = Http::acceptJson()->asJson()->timeout(15)->post('https://example.com/vatan-sms/send', [
                'phone' => $validated['phone'],
                'message' => $validated['message'],
            ]);

            if ($response->successful()) {
                return back()->withInput()->with('sms_test_success', __('SMS test request sent successfully.'));
            }

            return back()->withInput()->with('sms_test_error', __('SMS test request failed. Please check the API response and request payload.'));
        } catch (\Throwable $exception) {
            report($exception);

            return back()->withInput()->with('sms_test_error', __('SMS test request could not be sent. Please try again.'));
        }
    }
}