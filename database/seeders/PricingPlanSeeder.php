<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fullFeatures = [
            'Presensi GPS & Face Recognition AI',
            'Sistem Geofencing & Multi-Cabang',
            'Tracking Kunjungan & Visit Lapangan',
            'Manajemen Shift & Jadwal Kerja',
            'Automasi Gaji (Bulanan & Harian)',
            'Integrasi BPJS & Tunjangan Multi-Kategori',
            'Sistem Denda & Potongan Otomatis',
            'Slip Gaji Digital (PDF)',
            'Manajemen Pinjaman & Cicilan Otomatis',
            'E-Permission (Izin, Sakit, Cuti, Dinas)',
            'Lembur Otomatis & Approval Berjenjang',
            'KPI Employee & Penilaian Kinerja',
            'Monitoring Aktivitas & Log Harian',
            'Manajemen Kontrak, Mutasi & Resign',
            'Rekap Presensi & Payroll (Excel/PDF)',
            'Dashboard Statistik & Analytics',
            'WhatsApp Gateway (Notifikasi Otomatis)',
            'User Role Control & Audit Trail'
        ];

        $plans = [
            [
                'name' => 'Starter',
                'badge' => 'UMKM & Startup',
                'target_audience' => 'Cocok untuk: 1 - 50 User',
                'max_employees' => 50,
                'monthly_price' => 499000,
                'yearly_price' => 4990000,
                'yearly_savings' => 'Hemat Rp 998rb (2 Bulan Gratis)',
                'server_spec' => 'Biznet GIO Neo Lite MS 4.2',
                'is_featured' => false,
                'sort_order' => 1,
                'features' => $fullFeatures
            ],
            [
                'name' => 'Business',
                'badge' => 'Populer',
                'target_audience' => 'Cocok untuk: 51 - 200 User',
                'max_employees' => 200,
                'monthly_price' => 1499000,
                'yearly_price' => 14990000,
                'yearly_savings' => 'Hemat Rp 2.9jt (2 Bulan Gratis)',
                'server_spec' => 'Biznet GIO Neo Lite MM 8.4',
                'is_featured' => true,
                'sort_order' => 2,
                'features' => $fullFeatures
            ],
            [
                'name' => 'Enterprise',
                'badge' => 'High Growth',
                'target_audience' => 'Cocok untuk: 201 - 500 User',
                'max_employees' => 500,
                'monthly_price' => 3499000,
                'yearly_price' => 34990000,
                'yearly_savings' => 'Hemat Rp 6.9jt (2 Bulan Gratis)',
                'server_spec' => 'Biznet GIO Neo Lite Pro MS 4.2',
                'is_featured' => false,
                'sort_order' => 3,
                'features' => $fullFeatures
            ],
            [
                'name' => 'Corporate',
                'badge' => 'Skala Besar',
                'target_audience' => 'Cocok untuk: 500+ User',
                'max_employees' => 999999,
                'monthly_price' => 0,
                'yearly_price' => 0,
                'yearly_savings' => 'Hubungi Kami',
                'server_spec' => 'Biznet GIO Neo Lite Pro ML 16.8',
                'is_featured' => false,
                'sort_order' => 4,
                'features' => array_merge($fullFeatures, [
                    'SLA Guarantee 99.9%',
                    'Dedicated Server Resources',
                    'Custom Fitur Khusus',
                    'On-Premise Deployment Opsional'
                ])
            ],
        ];

        foreach ($plans as $planData) {
            $features = $planData['features'];
            unset($planData['features']);
            
            $plan = \App\Models\PricingPlan::create($planData);
            
            foreach ($features as $index => $featureText) {
                $plan->features()->create([
                    'feature_text' => $featureText,
                    'is_included' => true,
                    'sort_order' => $index
                ]);
            }
        }
    }
}
