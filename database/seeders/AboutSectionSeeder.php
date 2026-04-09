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
            'title_badge' => 'Mengapa PresensiGPS V2?',
            'title_badge_icon' => '🛡️',
            'headline' => 'Transparansi Data & Kedisiplinan Tanpa Celah',
            'description' => 'Menggabungkan teknologi Face Recognition AI dan GPS Geofencing dengan sistem payroll otomatis yang kompleks untuk memangkas waktu administrasi HR hingga 90%.',
            'main_image' => 'images/about-person.png',
            'floating_image' => 'images/about-analytics.png',
            'cta_text' => 'Pelajari Selengkapnya',
            'cta_url' => '#pricing',
            'feature_items' => [
                'High-Precision Attendance (Face AI + GPS)',
                'Smart Payroll & Integrated Finance',
                'Insightful Monitoring & WhatsApp Gateway'
            ],
            'is_active' => true,
        ]);
    }
}
