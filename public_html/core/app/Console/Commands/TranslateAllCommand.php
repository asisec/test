<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TranslateAllCommand extends Command
{
    protected $signature = 'deepl:translate-all';
    protected $description = 'Pre-translate all database content (listings, categories, menus, pages, tags, widgets, locations) into TR, EN, and ZH';

    public function handle()
    {
        $this->info("🚀 Starting DeepL batch translation into TR, EN, ZH, and AR...");

        $targets = ['tr', 'en', 'zh', 'ar'];

        // 1. Menus
        $menus = DB::table('menus')->get(['content']);
        $menu_texts = [];
        foreach ($menus as $menu) {
            $items = json_decode($menu->content, true);
            if (is_array($items)) {
                foreach ($items as $item) {
                    if (isset($item['menulabel']) && !empty($item['menulabel'])) $menu_texts[] = $item['menulabel'];
                    if (isset($item['pname']) && !empty($item['pname'])) $menu_texts[] = $item['pname'];
                }
            }
        }
        $this->translateBatch(array_unique(array_filter($menu_texts)), $targets, "Menus");

        // 2. Categories
        $categories = DB::table('categories')->pluck('name')->toArray();
        $this->translateBatch(array_unique(array_filter($categories)), $targets, "Categories");

        // 3. Sub categories
        $subcategories = DB::table('sub_categories')->pluck('name')->toArray();
        $this->translateBatch(array_unique(array_filter($subcategories)), $targets, "Sub Categories");

        // 4. Child categories
        $child_categories = DB::table('child_categories')->pluck('name')->toArray();
        $this->translateBatch(array_unique(array_filter($child_categories)), $targets, "Child Categories");

        // 5. Tags
        $tags = DB::table('tags')->pluck('name')->toArray();
        $this->translateBatch(array_unique(array_filter($tags)), $targets, "Tags");

        // 6. Pages
        $pages = DB::table('pages')->pluck('title')->toArray();
        $this->translateBatch(array_unique(array_filter($pages)), $targets, "Pages");

        // 7. Countries, States, Cities
        $countries = DB::table('countries')->pluck('country')->toArray();
        $states = DB::table('states')->pluck('state')->toArray();
        $cities = DB::table('cities')->pluck('city')->toArray();
        $locations = array_merge($countries, $states, $cities);
        $this->translateBatch(array_unique(array_filter($locations)), $targets, "Locations");

        // 8. PageBuilder Widget Settings
        $widget_texts = [
            "Çeşitler", "Durum", "Paylaşıldığı Tarih", "Öne Çıkanlar", "Öncelikli İlan", 
            "Yeni", "Kullanılmış", "Bugün", "Dün", "Geçen Hafta", "İlan Ara", "Dokuma Makinaları",
            "Fiyat İçin İletişime Geçin", "Contact for Pricing", "Contact for Price", "Türkiye", "Location", "Distance"
        ];
        $page_builders = DB::table('page_builders')->get(['addon_settings']);
        foreach ($page_builders as $pb) {
            $settings = json_decode($pb->addon_settings, true);
            if (is_array($settings)) {
                foreach ($settings as $val) {
                    if (is_string($val) && !empty($val) && strlen($val) < 200 && !str_contains($val, '{') && !str_contains($val, '/')) {
                        $widget_texts[] = $val;
                    }
                }
            }
        }
        $this->translateBatch(array_unique(array_filter($widget_texts)), $targets, "Widget & Filter Settings");

        // 9. Listings (Title and Description)
        $listings = DB::table('listings')->get(['title', 'description']);
        $listing_texts = [];
        foreach ($listings as $listing) {
            if (!empty($listing->title)) $listing_texts[] = $listing->title;
            if (!empty($listing->description)) {
                $descText = trim(strip_tags($listing->description));
                if (!empty($descText) && strlen($descText) < 1000) {
                    $listing_texts[] = $descText;
                }
            }
        }
        $this->translateBatch(array_unique(array_filter($listing_texts)), $targets, "Listings");

        $this->info("✅ DeepL batch translation completed successfully!");
        return 0;
    }

    private function translateBatch(array $texts, array $targets, string $label)
    {
        if (empty($texts)) return;
        $this->info("Translating $label (" . count($texts) . " items)...");
        foreach ($targets as $lang) {
            foreach (array_chunk($texts, 30) as $chunk) {
                deepl_translate_batch($chunk, $lang);
                usleep(200000);
            }
        }
        $this->info("✔ $label translated.");
    }
}
