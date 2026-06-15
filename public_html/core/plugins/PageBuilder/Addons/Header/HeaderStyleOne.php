<?php


namespace plugins\PageBuilder\Addons\Header;

use App\Models\Backend\Category;
use App\Models\Backend\Listing;
use plugins\PageBuilder\Fields\ColorPicker;
use plugins\PageBuilder\Fields\IconPicker;
use plugins\PageBuilder\Fields\Image;
use plugins\PageBuilder\Fields\Repeater;
use plugins\PageBuilder\Fields\Slider;
use plugins\PageBuilder\Fields\Switcher;
use plugins\PageBuilder\Fields\Text;
use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\PageBuilderBase;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;

class HeaderStyleOne extends PageBuilderBase
{
    use LanguageFallbackForPageBuilder;

    public function preview_image()
    {
        return 'header/01.jpg';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'top_title',
            'label' => __('Top Title'),
            'value' => $widget_saved_values['top_title'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'top_image',
            'label' => __('Top Image'),
            'value' => $widget_saved_values['top_image'] ?? null,
            'dimensions' => '24x25'
        ]);

        $output .= ColorPicker::get([
            'name' => 'header_background_color',
            'label' => __('Background Color'),
            'value' => $widget_saved_values['header_background_color'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
            'dimensions' => '1900x670'
        ]);


        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'banner_left_images_01',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'banner_left_images',
                    'label' => __('Left Banner Images (maximus add six images)')
                ],
            ]
        ]);

        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'banner_right_images_02',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'banner_right_images',
                    'label' => __('Right Banner Images (maximus add six images)')
                ],
            ]
        ]);

        $output .= Text::get([
            'name' => 'search_button_title',
            'label' => __('Search Button Title'),
            'value' => $widget_saved_values['search_button_title'] ?? null,
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 260,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 190,
            'max' => 500,
        ]);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

  public function frontend_render() : string
    {
        $settings = $this->get_settings();
        // Eğer panelden bir sayı girilmişse onu al, girilmemişse KESİN KURAL 12 tane göster.
        $items = !empty($settings['items']) ? $settings['items'] : 12; 

        $all_category = Category::where('status', 1)
            ->whereNotNull('home_header_order')
            ->orderBy('home_header_order', 'ASC')
            ->get()
            ->map(function ($category) use ($items) {
                $listingsQuery = $category->listings()
                    ->where('status', 1)
                    ->where('is_published', 1)
                    ->latest() // NEŞTER 1: published_at aptallığı silindi, created_at'e (en yeniye) geçildi!
                    ->with(['country', 'category', 'user', 'brand']); // Kodu temizledik, hepsi tek with'te.

                $category->listings_count = $listingsQuery->count();
                $category->listings = $listingsQuery->take($items)->get(); // NEŞTER 2: Sınır kesinlikle 10 (veya panelden gelen).
                
                $category->show_more = $category->listings_count > $items;
                return $category;
            });

        $latest_listings = Listing::where('status', 1)
            ->where('is_published', 1)
            ->latest() // NEŞTER 3: published_at silindi, en yeniler zirvede!
            ->with(['country', 'category', 'user', 'brand'])
            ->take($items) // NEŞTER 4: Sınır kesinlikle 12.
            ->get();

        return $this->renderBlade('headers.style-one',[
            'all_category' => $all_category,
            'latest_listings' => $latest_listings,
        ]);
    }
    public function addon_title()
    {
        return __('Header: 01');
    }
}
