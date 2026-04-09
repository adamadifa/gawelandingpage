<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\FaqSection::create([
            'title_badge' => 'Pusat Bantuan (FAQ)',
            'title_badge_icon' => '🛡️',
            'headline' => 'Pertanyaan yang Sering Diajukan',
            'description' => 'Temukan jawaban atas pertanyaan umum mengenai manfaat utama, fitur keamanan, dan kemudahan operasional PresensiGPS V2.',
            'primary_image' => 'images/faq-mockup.png', 
            'secondary_image' => 'images/hero-phone.png', 
            'is_active' => true,
        ]);
    }
}
