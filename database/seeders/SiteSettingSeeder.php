<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'brand_name', 'value' => 'PresensiGPS', 'type' => 'text'],
            ['key' => 'tagline', 'value' => 'Solusi Absensi & Payroll Modern', 'type' => 'text'],
            ['key' => 'whatsapp_number', 'value' => '628123456789', 'type' => 'text'],
            ['key' => 'email_contact', 'value' => 'hello@presensigps.com', 'type' => 'text'],
            ['key' => 'address', 'value' => 'Jakarta, Indonesia', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::create($setting);
        }
    }
}
