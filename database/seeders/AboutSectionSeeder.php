<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AboutSection::create([
            'title_badge' => 'Tentang Aplikasi',
            'title_badge_icon' => '🔥',
            'headline' => 'Laporan & Analisis Data Karyawan Lebih Mudah',
            'description' => 'PresensiGPS tidak hanya mencatat kehadiran, tapi juga memberikan wawasan mendalam tentang produktivitas tim Anda melalui dashboard analitik yang intuitif dan real-time.',
            'main_image' => 'images/about-person.png',
            'floating_image' => 'images/about-analytics.png',
            'cta_text' => 'Pelajari Selengkapnya',
            'cta_url' => '#pricing',
            'feature_items' => [
                'Dashboard Analitik Terpusat & Real-time',
                'Data Akurat dengan Teknologi Geofencing',
                'Coba Demo Gratis 14 Hari Sekarang!'
            ],
            'is_active' => true,
        ]);
    }
}
