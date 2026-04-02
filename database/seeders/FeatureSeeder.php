<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'icon' => 'map-2',
                'title' => 'Smart GPS Geofencing',
                'description' => 'Absensi akurat berbasis titik lokasi GPS dan verifikasi foto wajah (Anti-Fake GPS).',
                'sort_order' => 1
            ],
            [
                'icon' => 'receipt-2',
                'title' => 'Automated Payroll System',
                'description' => 'Hitung gaji, tunjangan, dan potongan BPJS secara otomatis hanya dalam hitungan detik.',
                'sort_order' => 2
            ],
            [
                'icon' => 'credit-card',
                'title' => 'Loan & Installment Hub',
                'description' => 'Manajemen pinjaman karyawan yang terintegrasi langsung dengan pemotongan gaji bulanan.',
                'sort_order' => 3
            ],
            [
                'icon' => 'building-skyscraper',
                'title' => 'Multi-Branch Management',
                'description' => 'Pantau banyak cabang sekaligus dalam satu dashboard admin yang simpel.',
                'sort_order' => 4
            ],
            [
                'icon' => 'device-mobile',
                'title' => 'Employee Self-Service',
                'description' => 'Karyawan bisa cek riwayat absen, saldo pinjaman, dan slip gaji langsung dari smartphone.',
                'sort_order' => 5
            ],
            [
                'icon' => 'chart-bar',
                'title' => 'Real-time Reporting & Analytics',
                'description' => 'Akses laporan absensi, keterlambatan, dan jam kerja lembur secara akurat kapan saja.',
                'sort_order' => 6
            ],
        ];

        foreach ($features as $feature) {
            \App\Models\Feature::create($feature);
        }
    }
}
