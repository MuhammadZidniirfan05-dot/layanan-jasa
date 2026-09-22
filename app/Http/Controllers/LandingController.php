<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Settings\SiteSettings;

class LandingController extends Controller
{
    public function index(SiteSettings $settings)
    {
        return view('landing', [
            'settings' => $settings,
            'categories' => ServiceCategory::with(['activeServices'])->orderBy('order')->get(),
            'portfolios' => Portfolio::orderBy('order')->limit(6)->get(),
            'testimonials' => Testimonial::where('is_active', true)->orderBy('order')->get(),
            'faqs' => Faq::orderBy('order')->get(),
        ]);
    }
}