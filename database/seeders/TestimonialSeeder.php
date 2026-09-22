<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Rina Amelia',
                'role' => 'Mahasiswa Teknik Informatika',
                'message' => 'Pengerjaannya cepat dan hasilnya rapi banget, sangat membantu di tengah deadline!',
                'rating' => 5,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Pemilik CV Maju Jaya',
                'message' => 'Website perusahaan saya jadi lebih profesional, komunikasi juga enak.',
                'rating' => 5,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Dewi Lestari',
                'role' => 'Mahasiswa Manajemen',
                'message' => 'PPT-nya bagus, sesuai request, revisi juga cepat direspon.',
                'rating' => 4,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}