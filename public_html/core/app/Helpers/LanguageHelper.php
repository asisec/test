<?php

namespace App\Helpers;


use App\Models\Backend\Language;

class LanguageHelper
{
    private static $language = null;
    private static $default = null;
    private static $user_lang_slug = null;
    private static $default_slug = null;
    private static $user_lang = null;
    private static $all_language = null;

    public function __construct()
    {
        self::lang_instance();
    }

    private static function lang_instance()
    {
        if (self::$language === null) {
            self::$language = new Language();
        }
        return self::$language;
    }

    public static function user_lang()
    {
        if (self::$user_lang === null) {
            $activeSlug = app()->getLocale() ?: session()->get('lang') ?: request()->cookie('app_user_lang');
            if (!empty($activeSlug)) {
                self::$user_lang = self::lang_instance()->where('slug', $activeSlug)->first();
            }
            if (!self::$user_lang) {
                self::$user_lang = self::default();
            }
        }
        return self::$user_lang;
    }

    public static function default()
    {
        try {
            if (self::$default === null) {
                $default = self::lang_instance()->where('default', '1')->first();
                self::$default = $default;
            }
            return self::$default;
        }catch (\Exception $exception){

        }
        return self::$default;
    }

    public static function default_slug()
    {
        try {
            if (self::$default_slug === null) {
                $default = self::lang_instance()->where('default', '1')->first();
                self::$default_slug = $default ? $default->slug : 'tr_TR';
            }
        }catch (\Exception $exception){

        }

        return self::$default_slug;
    }
    public static function default_dir()
    {
        try {
            if (self::$default === null) {
                $default = self::lang_instance()->where('default', '1')->first();
                self::$default = $default;
            }
        }catch (\Exception $exception){

        }

        return self::$default ? self::$default->direction : 'ltr';
    }
    public static function user_lang_slug(){
        try {
            if (self::$user_lang_slug === null) {
                $activeSlug = app()->getLocale() ?: session()->get('lang') ?: request()->cookie('app_user_lang');
                $default = self::lang_instance()->where('default', '1')->first();
                self::$user_lang_slug = $activeSlug ?: ($default ? $default->slug : 'tr_TR');
            }
        }catch (\Exception $exception){

        }

        return self::$user_lang_slug;
    }
    public static function user_lang_dir()
    {
        return self::user_lang()->direction;
    }

    public static function all_languages(string $type = 'publish')
    {
        if (self::$all_language === null) {
            self::$all_language = self::lang_instance()->where(['status' => 'publish'])->get();
        }
        return self::$all_language;
    }
}
