<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroStatsCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HeroStatsCard::create([
            'title' => 'Kehadiran Hari Ini',
            'value' => '98.5%',
            'icon' => 'ti-circle-check',
            'color_theme' => 'indigo',
            'position_slot' => 'TR',
            'is_active' => true,
        ]);

        \App\Models\HeroStatsCard::create([
            'title' => 'Payroll Terproses',
            'value' => 'Rp 2.4M',
            'icon' => 'ti-coin',
            'color_theme' => 'emerald',
            'position_slot' => 'BL',
            'is_active' => true,
        ]);
    }
}
