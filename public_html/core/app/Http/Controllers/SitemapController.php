<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class SitemapController extends Controller {
    public function index() {
        $xmlHeader = '<?xml version="1.0" encoding="UTF-8"?>';
        return response()->view('frontend.sitemap', compact('xmlHeader'))->header('Content-Type', 'text/xml');
    }
}