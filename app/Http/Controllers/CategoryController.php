<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Settings\SiteSettings;

class CategoryController extends Controller
{
    public function show(ServiceCategory $category, SiteSettings $settings)
    {
        $category->load(['activeServices.packages']);

        return view('category', [
            'settings' => $settings,
            'category' => $category,
            'services' => $category->activeServices,
        ]);
    }
}