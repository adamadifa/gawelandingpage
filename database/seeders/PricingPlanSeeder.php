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
        $plans = [
            [
                'name' => 'Paket STARTER',
                'badge' => 'UMKM & Startup Kecil',
                'target_audience' => 'Cocok untuk: UMKM & Startup Kecil',
                'max_employees' => 50,
                'monthly_price' => 400000,
                'yearly_price' => 4000000,
                'yearly_savings' => 'Hemat Rp 800rb',
                'server_spec' => 'NEO Lite XS 1.2 (1 vCPU, 2 GB RAM)',
                'is_featured' => false,
                'sort_order' => 1,
                'features' => [
                    'Jumlah Karyawan: Maksimal 50 Orang',
                    'Presensi GPS',
                    'Dashboard Admin Standar',
                    '1 Cabang',
                    'Termasuk 1 Domain (.com / .id)'
                ]
            ],
            [
                'name' => 'Paket BUSINESS',
                'badge' => 'Populer',
                'target_audience' => 'Cocok untuk: Perusahaan Menengah & Multi-Cabang',
                'max_employees' => 300,
                'monthly_price' => 900000,
                'yearly_price' => 9000000,
                'yearly_savings' => 'Hemat Rp 1.8jt',
                'server_spec' => 'NEO Lite SS 2.2 (Lebih stabil untuk traffic tinggi)',
                'is_featured' => true,
                'sort_order' => 2,
                'features' => [
                    'Jumlah Karyawan: Maksimal 300 Orang',
                    'Semua fitur Starter',
                    'Laporan Payroll',
                    'Multi-Cabang',
                    'Pinjaman/Kasbon',
                    'Termasuk 1 Domain (.com / .id)'
                ]
            ],
            [
                'name' => 'Paket CORPORATE',
                'badge' => 'Korporasi Besar',
                'target_audience' => 'Cocok untuk: Pabrik & Korporasi Besar',
                'max_employees' => 1000,
                'monthly_price' => 1650000,
                'yearly_price' => 16500000,
                'yearly_savings' => 'Hemat Rp 3.3jt',
                'server_spec' => 'NEO Lite MS 4.4 (High Performance)',
                'is_featured' => false,
                'sort_order' => 3,
                'features' => [
                    'Jumlah Karyawan: Maksimal 1.000 Orang',
                    'Semua fitur Business',
                    'Custom Report',
                    'Support Prioritas 24/7',
                    'Daily Backup',
                    'Termasuk 1 Domain (.com / .id)'
                ]
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
