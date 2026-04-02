<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            HeroSectionSeeder::class,
            FeatureSeeder::class,
            PricingPlanSeeder::class,
            FaqSeeder::class,
            TestimonialSeeder::class,
            TrustedCompanySeeder::class,
            HeroStatsCardSeeder::class,
        ]);
    }
}
