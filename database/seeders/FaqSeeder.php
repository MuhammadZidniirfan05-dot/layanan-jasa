<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama waktu pengerjaan?',
                'answer' => 'Tergantung jenis jasa, mulai dari 1 hari untuk tugas kuliah hingga 1-2 minggu untuk website.',
                'order' => 1,
            ],
            [
                'question' => 'Apakah bisa revisi?',
                'answer' => 'Bisa, setiap paket sudah termasuk jatah revisi sesuai ketentuan masing-masing layanan.',
                'order' => 2,
            ],
            [
                'question' => 'Bagaimana cara pembayarannya?',
                'answer' => 'Pembayaran dilakukan secara manual via transfer setelah kesepakatan detail pekerjaan melalui WhatsApp.',
                'order' => 3,
            ],
            [
                'question' => 'Apakah data saya aman/rahasia?',
                'answer' => 'Tentu, semua data dan pekerjaan klien kami jaga kerahasiaannya.',
                'order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}