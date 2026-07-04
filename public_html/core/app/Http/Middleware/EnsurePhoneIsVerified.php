<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsurePhoneIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // SMS/Phone verification check disabled - users can proceed without verification
        // if (auth()->check() && auth()->user()->otp_verified != 1) {
        //     return response()->view('frontend.user.verification-redirect');
        // }

        return $next($request);
    }
}