<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Website', 'slug' => 'website', 'icon' => 'heroicon-o-globe-alt', 'order' => 1],
            ['name' => 'Tugas Kuliah', 'slug' => 'tugas-kuliah', 'icon' => 'heroicon-o-academic-cap', 'order' => 2],
            ['name' => 'Presentasi (PPT)', 'slug' => 'presentasi-ppt', 'icon' => 'heroicon-o-presentation-chart-bar', 'order' => 3],
            ['name' => 'Desain Grafis', 'slug' => 'desain-grafis', 'icon' => 'heroicon-o-paint-brush', 'order' => 4],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create($category);
        }
    }
}