<?php

namespace App\Providers;

use App\Facades\ModuleDataFacade;
use App\Helpers\ModuleMetaData;
use App\Models\Backend\Language;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('ModuleDataFacade',function(){
            return new ModuleMetaData();
        });

        $this->app->extend('translator', function ($translator, $app) {
            $trans = new class($translator->getLoader(), $translator->getLocale()) extends \Illuminate\Translation\Translator {
                public function get($key, array $replace = [], $locale = null, $fallback = true) {
                    $locale = $locale ?: $this->locale;
                    
                    // Call parent to see if Laravel has a translation
                    $line = parent::get($key, [], $locale, $fallback);
                    
                    if (is_string($line) && function_exists('deepl_translate')) {
                        // Don't translate raw dot keys (e.g. validation.required)
                        if ($line === $key && strpos($key, '.') !== false && strpos($key, ' ') === false) {
                            // Leave as is
                        } else {
                            $line = deepl_translate($line, $locale);
                        }
                    }
                    
                    if (is_string($line)) {
                        return $this->makeReplacements($line, $replace);
                    }
                    return parent::get($key, $replace, $locale, $fallback);
                }
            };
            $trans->setFallback($translator->getFallback());
            return $trans;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        try {
            $all_language = Language::all();
        }catch (\Exception $e){
            $all_language = null;
        }

        Paginator::useBootstrap();
        if (get_static_option('site_force_ssl_redirection') === 'on'){
            URL::forceScheme('https');
        }
        Paginator::useBootstrap();
        $this->loadViewsFrom(__DIR__.'/../../plugins/PageBuilder/views','pagebuilder');
    }
}
