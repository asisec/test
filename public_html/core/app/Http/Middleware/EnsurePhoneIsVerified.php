<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Modules\CountryManage\app\Models\Country;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Determine user's country code via their assigned country_id
            $countryCode = null;
            if ($user->country_id) {
                $country = Country::select('country_code')->find($user->country_id);
                $countryCode = $country?->country_code;
            }

            // TR users must pass phone (OTP) verification
            if ($countryCode === 'TR') {
                if ($user->otp_verified != 1) {
                    return response()->view('frontend.user.verification-redirect');
                }
            } else {
                // Non-TR users must pass email verification instead
                if ($user->email_verified != 1) {
                    return response()->view('frontend.user.verification-redirect');
                }
            }
        }

        return $next($request);
    }
}
