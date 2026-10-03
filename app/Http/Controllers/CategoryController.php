<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Settings\SiteSettings;
use Illuminate\Http\Request; // Tambahkan ini jika belum ada

class CategoryController extends Controller
{
    public function show(ServiceCategory $category, SiteSettings $settings)
    {
        // PERUBAHAN DI SINI:
        // Kita tambahkan closure untuk mengurutkan packages berdasarkan 'order'
        $category->load([
            'activeServices',
            'activeServices.packages' => function ($query) {
                $query->orderBy('order', 'asc'); // Pastikan nama kolomnya 'order' sesuai database Anda
            }
        ]);

        return view('category', [
            'settings' => $settings,
            'category' => $category,
            'services' => $category->activeServices,
        ]);
    }
}