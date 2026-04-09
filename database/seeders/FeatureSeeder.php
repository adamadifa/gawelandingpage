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
                'title' => 'Modul Presensi & Keamanan',
                'description' => 'Geofencing GPS, Face Recognition AI, dan pengaturan shift fleksibel untuk mencegah kecurangan.',
                'sort_order' => 1
            ],
            [
                'icon' => 'receipt-2',
                'title' => 'Modul Payroll & Kompensasi',
                'description' => 'Automasi hitung gaji, BPJS, tunjangan, dan denda secara instan dengan slip gaji digital.',
                'sort_order' => 2
            ],
            [
                'icon' => 'credit-card',
                'title' => 'Modul Pinjaman Karyawan',
                'description' => 'Sistem pengajuan pinjaman online yang terintegrasi otomatis dengan pemotongan cicilan di slip gaji.',
                'sort_order' => 3
            ],
            [
                'icon' => 'calendar-event',
                'title' => 'Modul Izin, Cuti & Lembur',
                'description' => 'Pengajuan E-Permission, manajemen kuota cuti real-time, dan perhitungan lembur otomatis.',
                'sort_order' => 4
            ],
            [
                'icon' => 'chart-bar',
                'title' => 'Modul Performa & KPI',
                'description' => 'Penilaian kinerja berbasis indikator kustom (KPI), monitoring aktivitas, dan manajemen kontrak.',
                'sort_order' => 5
            ],
            [
                'icon' => 'messages',
                'title' => 'Modul Komunikasi & Notifikasi',
                'description' => 'Integrasi WhatsApp Gateway untuk notifikasi otomatis absen, izin, dan pengiriman slip gaji.',
                'sort_order' => 6
            ],
        ];

        foreach ($features as $feature) {
            \App\Models\Feature::create($feature);
        }
    }
}
