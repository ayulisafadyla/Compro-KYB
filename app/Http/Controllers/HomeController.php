<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get dynamic homepage sections
        $homeAbouts = \App\Models\HomeAbout::where('is_active', true)->orderBy('order')->get();
        $homeVideo = \App\Models\HomeVideo::where('is_active', true)->first();
        $homePhilosophies = \App\Models\HomePhilosophy::where('is_active', true)->orderBy('order')->get();

        // Get Hero banners
        $heroBanners = \App\Models\Banner::where('is_active', true)->orderBy('order')->get();

        // Get products and articles
        $categories = \App\Models\Category::with(['products' => function($q) {
            $q->where('is_active', true);
        }])->get();
        $recentArticles = \App\Models\Article::where('is_published', true)->latest()->take(3)->get();

        // Get about image
        $aboutImage = \App\Models\HomeAboutImage::first();

        // Get brands
        $brands = \App\Models\Brand::orderBy('order')->get();

        // Get FAQs and Contact Items
        $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
        $contactItems = \App\Models\ContactItem::where('is_active', true)->orderBy('order')->get();

        // Get Support Center Sections (AboutSections)
        $supportSections = \App\Models\AboutSection::where('is_active', true)->orderBy('order')->get();

        return view('home', compact('homeAbouts', 'homeVideo', 'homePhilosophies', 'heroBanners', 'categories', 'recentArticles', 'aboutImage', 'brands', 'faqs', 'contactItems', 'supportSections'));
    }
}
