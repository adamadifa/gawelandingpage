<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HeroSection::create([
            'headline' => 'Kelola Absensi & Payroll Karyawan Lebih Efisien, Transparan, & Akurat.',
            'sub_headline' => 'Solusi satu pintu untuk Presensi GPS Geofencing, Penggajian Otomatis, dan Manajemen Pinjaman Karyawan tanpa ribet.',
            'cta_text' => 'Coba Sekarang Gratis',
            'cta_url' => '/register',
            'cta_secondary_text' => 'Konsultasi Penawaran',
            'cta_secondary_url' => 'https://wa.me/628123456789',
            'is_active' => true,
        ]);
    }
}
