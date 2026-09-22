<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $website = Service::where('slug', 'website-company-profile')->first();
        $ppt = Service::where('slug', 'ppt-presentasi')->first();

        $portfolios = [
            [
                'service_id' => $website?->id,
                'title' => 'Website CV Maju Jaya',
                'description' => 'Company profile untuk perusahaan konstruksi.',
                'client_name' => 'CV Maju Jaya',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'service_id' => $website?->id,
                'title' => 'Website Toko Sepatu Online',
                'description' => 'E-commerce sederhana untuk toko sepatu lokal.',
                'client_name' => 'Sepatu Kita',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'service_id' => $ppt?->id,
                'title' => 'PPT Seminar Proposal Skripsi',
                'description' => 'Desain slide untuk presentasi seminar proposal.',
                'client_name' => 'Anonim (Privasi)',
                'is_featured' => false,
                'order' => 3,
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}