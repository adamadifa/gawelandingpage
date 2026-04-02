<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\FeatureSection::create([
            'title_badge' => 'Keunggulan Kami',
            'title_badge_icon' => '🔥',
            'headline' => 'Solusi Terpadu untuk Karyawan, Startup, dan Perusahaan Besar',
            'image_path' => 'images/features-phones.png',
            'is_active' => true,
        ]);
    }
}
