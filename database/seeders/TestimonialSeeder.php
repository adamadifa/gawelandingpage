<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Budi Santoso',
                'position' => 'HR Manager di PT. Tech Solusi',
                'content' => 'Sejak menggunakan PresensiGPS, proses rekapitulasi absen yang biasanya memakan waktu berhari-hari kini selesai dalam hitungan menit. Sangat membantu!',
                'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=4F46E5&color=fff',
                'rating' => 5,
            ],
            [
                'name' => 'Siti Aminah',
                'position' => 'Owner Kedai Kopi Kenangan',
                'content' => 'Fitur Geofencing-nya sangat akurat. Saya tidak perlu khawatir lagi karyawan titip absen karena mereka harus berada di radius toko.',
                'avatar' => 'https://ui-avatars.com/api/?name=Siti+Aminah&background=10B981&color=fff',
                'rating' => 5,
            ],
            [
                'name' => 'Andi Wijaya',
                'position' => 'Direktur Operasional Cargo Express',
                'content' => 'Manajemen payroll dan pinjaman karyawan jadi jauh lebih transparan. Karyawan juga senang karena bisa pantau sisa pinjaman mereka sendiri.',
                'avatar' => 'https://ui-avatars.com/api/?name=Andi+Wijaya&background=F59E0B&color=fff',
                'rating' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
