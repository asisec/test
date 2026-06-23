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
        if ($request->is('admin/*')) {
            return $next($request);
        }

        $user = auth('web')->user();

        if (! $user) {
            return redirect()->route('user.login');
        }

        if ($request->isMethod('get') || (int) $user->otp_verified === 1) {
            return $next($request);
        }

        return redirect()
            ->route('user.verification.center')
            ->with('error', __('İlan oluşturabilmek için lütfen telefon numaranızı doğrulayın.'));
    }
}