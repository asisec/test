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
        if ($request->isMethod('get')) {
            return $next($request);
        }

        if (auth()->check() && auth()->user()->otp_verified != 1) {
            return redirect()->route('user.verification.center')->with('danger', 'İlan vermek için telefonunuzu doğrulamalısınız.');
        }

        return $next($request);
    }
}