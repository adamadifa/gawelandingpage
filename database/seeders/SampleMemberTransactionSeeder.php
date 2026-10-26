<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PricingPlan;
use App\Models\MembershipTransaction;
use App\Models\MembershipSubscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleMemberTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $plan = PricingPlan::first();
        if (!$plan) {
            $this->call(PricingPlanSeeder::class);
            $plan = PricingPlan::first();
        }

        $members = [
            [
                'name' => 'Adam Adifa',
                'email' => 'adam.adifa@example.com',
                'plan_type' => 'monthly',
                'status' => 'approved',
                'amount' => 150000,
                'days_ago' => 6
            ],
            [
                'name' => 'Adi Santoso',
                'email' => 'adi.santoso@example.com',
                'plan_type' => 'monthly',
                'status' => 'approved',
                'amount' => 250000,
                'days_ago' => 4
            ],
            [
                'name' => 'Asep Komarudin',
                'email' => 'asep.komarudin@example.com',
                'plan_type' => 'yearly',
                'status' => 'approved',
                'amount' => 1200000,
                'days_ago' => 2
            ],
            [
                'name' => 'Budi Pratama',
                'email' => 'budi.pratama@example.com',
                'plan_type' => 'monthly',
                'status' => 'pending',
                'amount' => 150000,
                'days_ago' => 1
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra.dewi@example.com',
                'plan_type' => 'yearly',
                'status' => 'pending',
                'amount' => 1200000,
                'days_ago' => 0
            ]
        ];

        foreach ($members as $m) {
            $user = User::firstOrCreate(['email' => $m['email']], [
                'name' => $m['name'],
                'password' => bcrypt('password'),
                'role' => 'member',
            ]);

            $trx = MembershipTransaction::create([
                'user_id' => $user->id,
                'pricing_plan_id' => $plan->id,
                'amount' => $m['amount'],
                'plan_type' => $m['plan_type'],
                'status' => $m['status'],
                'created_at' => now()->subDays($m['days_ago']),
            ]);

            if ($m['status'] === 'approved') {
                $days = $m['plan_type'] === 'yearly' ? 365 : 30;
                $licenseCode = 'GAWE-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));
                MembershipSubscription::create([
                    'user_id' => $user->id,
                    'pricing_plan_id' => $plan->id,
                    'transaction_id' => $trx->id,
                    'license_code' => $licenseCode,
                    'starts_at' => now()->subDays($m['days_ago']),
                    'ends_at' => now()->addDays($days),
                    'status' => 'active',
                    'app_url' => 'https://app.presensigps.com',
                    'app_status' => 'running',
                ]);
            }
        }
    }
}
