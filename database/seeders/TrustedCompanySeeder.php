<?php

namespace Database\Seeders;

use App\Models\TrustedCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrustedCompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'Tech Solusi', 'logo' => 'https://svgl.app/library/google.svg'],
            ['name' => 'Kopi Kenangan', 'logo' => 'https://svgl.app/library/microsoft.svg'],
            ['name' => 'Cargo Express', 'logo' => 'https://svgl.app/library/amazon.svg'],
            ['name' => 'Bank Mandiri', 'logo' => 'https://svgl.app/library/tesla.svg'],
            ['name' => 'Pertamina', 'logo' => 'https://svgl.app/library/netflix.svg'],
            ['name' => 'Telkomsel', 'logo' => 'https://svgl.app/library/adobe.svg'],
        ];

        foreach ($companies as $company) {
            TrustedCompany::create($company);
        }
    }
}
