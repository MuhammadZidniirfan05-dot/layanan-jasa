<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $website = ServiceCategory::where('slug', 'website')->first();
        $tugas = ServiceCategory::where('slug', 'tugas-kuliah')->first();
        $ppt = ServiceCategory::where('slug', 'presentasi-ppt')->first();

        $services = [
            [
                'service_category_id' => $website->id,
                'title' => 'Pembuatan Website Company Profile',
                'slug' => 'website-company-profile',
                'description' => 'Website profesional untuk memperkenalkan bisnis kamu, responsive dan cepat.',
                'starting_price' => 1500000,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'service_category_id' => $website->id,
                'title' => 'Pembuatan Toko Online',
                'slug' => 'toko-online',
                'description' => 'Website e-commerce lengkap dengan sistem pembayaran dan manajemen produk.',
                'starting_price' => 3000000,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'service_category_id' => $tugas->id,
                'title' => 'Pembuatan Makalah',
                'slug' => 'pembuatan-makalah',
                'description' => 'Makalah akademik sesuai kaidah penulisan ilmiah, bebas plagiarisme.',
                'starting_price' => 50000,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'service_category_id' => $tugas->id,
                'title' => 'Joki Tugas Pemrograman',
                'slug' => 'joki-tugas-pemrograman',
                'description' => 'Bantuan pengerjaan tugas pemrograman berbagai bahasa dan framework.',
                'starting_price' => 100000,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'service_category_id' => $ppt->id,
                'title' => 'Pembuatan PPT Presentasi',
                'slug' => 'ppt-presentasi',
                'description' => 'Desain slide presentasi menarik untuk tugas, seminar, atau bisnis.',
                'starting_price' => 30000,
                'is_active' => true,
                'order' => 1,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}