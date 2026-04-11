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
            ['key' => 'payment_bank_name', 'value' => 'Bank Central Asia (BCA)', 'type' => 'text'],
            ['key' => 'payment_bank_number', 'value' => '829 012 3456', 'type' => 'text'],
            ['key' => 'payment_bank_holder', 'value' => 'Adam Adifa', 'type' => 'text'],
            ['key' => 'payment_bank_logo', 'value' => null, 'type' => 'image'],
            ['key' => 'meta_description', 'value' => 'Kelola Absensi & Payroll Karyawan Lebih Efisien, Transparan, & Akurat dengan PresensiGPS. Aplikasi Absensi GPS Geofencing terbaik.', 'type' => 'textarea'],
            ['key' => 'meta_keywords', 'value' => 'absensi gps, payroll otomatis, manajemen karyawan, hr software, geofencing, presensi digital', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
