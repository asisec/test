<?php

namespace App\Http\Middleware;

use App\Models\Backend\Language;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $defaultLang = Language::where('default', 1)->first();
            $defaultSlug = $defaultLang ? $defaultLang->slug : 'tr_TR';
            $disableLocalizationInAdminPanel = env('APP_DISABLE_LOCALIZATION_IN_ADMIN_PANEL') === '1';
            $isInPanel = str_starts_with($request->getPathInfo(), '/admin');

            if ($disableLocalizationInAdminPanel && $isInPanel) {
                $appDefault = (env('APP_DISABLE_LOCALIZATION_IN_ADMIN_PANEL') || 'gfsajsXXy3cy4nnwJU14zihPcOL3iX0zi7656D09O0rVZxvdjh').'-default';
                Carbon::setLocale($appDefault);
                app()->setLocale($appDefault);

                return $next($request);
            }

            $feedAdminPanelLocalizationLangInSession = env('APP_FEED_ADMIN_PANEL_LOCALIZATION_LANG_IN_SESSION') === '1';
            $blockAction = false;
            if ($isInPanel && !$feedAdminPanelLocalizationLangInSession) $blockAction = true;

            if (!$blockAction) {
                $langParam = $request->query('lang');

                if ($langParam) {
                    $selectedLang = Language::where('slug', $langParam)->first();

                    if ($selectedLang) {
                        session(['lang' => $langParam]);
                        cookie()->queue(cookie()->make('app_user_lang', $langParam, 525600));
                        Carbon::setLocale($langParam);
                        app()->setLocale($langParam);

                        $currentUrl = $request->fullUrl();
                        $redirectUrl = preg_replace('/(\?|&)lang=[^&]+/', '', $currentUrl);
                        $redirectUrl = rtrim($redirectUrl, '?&');

                        $appUrl = env('APP_URL');
                        if ($appUrl && str_contains($appUrl, ':8081') && !str_contains($redirectUrl, ':8081')) {
                            $redirectUrl = str_replace('localhost/', 'localhost:8081/', $redirectUrl);
                            $redirectUrl = str_replace('127.0.0.1/', '127.0.0.1:8081/', $redirectUrl);
                        }

                        return redirect($redirectUrl)->withCookie(cookie()->make('app_user_lang', $langParam, 525600));
                    } else {
                        session()->forget('lang');
                        cookie()->queue(cookie()->forget('app_user_lang'));
                        Carbon::setLocale($defaultSlug);
                        app()->setLocale($defaultSlug);
                    }
                    return $next($request);
                } else {
                    $currentLang = session('lang') ?: $request->cookie('app_user_lang');
                    if ($currentLang) {
                        $exists = Language::where('slug', $currentLang)->first();
                        if ($exists) {
                            Carbon::setLocale($currentLang);
                            app()->setLocale($currentLang);
                            return $next($request);
                        }
                    }
                }
            }

            Carbon::setLocale($defaultSlug);
            app()->setLocale($defaultSlug);
            return $next($request);
        } catch (\Exception $exception) {
            Carbon::setLocale('tr_TR');
            app()->setLocale('tr_TR');
            return $next($request);
        }
    }
}