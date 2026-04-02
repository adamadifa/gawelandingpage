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
            'title_badge' => 'FAQs',
            'title_badge_icon' => '🔥',
            'headline' => 'Frequently Ask Questions',
            'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly',
            'primary_image' => 'images/faq-mockup.png', // This will be the back landscape image
            'secondary_image' => 'images/hero-phone.png', // Reusing hero phone as temp secondary
            'is_active' => true,
        ]);
    }
}
