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
            'headline' => 'Automasi Administrasi HR Anda Hingga 90% dengan PresensiGPS V2',
            'sub_headline' => 'Platform Manajemen SDM Terpadu: Presensi Geofencing, Face Recognition AI, dan Smart Payroll Automation dalam satu pintu.',
            'cta_text' => 'Mulai Demo Gratis',
            'cta_url' => '/register',
            'cta_secondary_text' => 'Konsultasi Penawaran',
            'cta_secondary_url' => 'https://wa.me/628123456789',
            'is_active' => true,
        ]);
    }
}
