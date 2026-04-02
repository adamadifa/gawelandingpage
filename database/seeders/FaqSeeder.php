<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara berlangganan?',
                'answer' => 'Anda dapat memilih paket yang sesuai dengan kebutuhan Anda di halaman Pricing, lalu klik tombol "Coba Sekarang" atau hubungi tim administrasi kami melalui WhatsApp.',
                'sort_order' => 1
            ],
            [
                'question' => 'Apakah data saya aman?',
                'answer' => 'Sangat aman. Kami menggunakan enkripsi standar industri dan melakukan backup data harian untuk memastikan keamanan dan ketersediaan data Anda.',
                'sort_order' => 2
            ],
            [
                'question' => 'Bisakah saya upgrade paket di tengah jalan?',
                'answer' => 'Tentu saja. Anda bisa melakukan upgrade paket kapan saja melalui dashboard admin. Biaya akan disesuaikan secara prorata.',
                'sort_order' => 3
            ],
            [
                'question' => 'Apakah ada biaya tambahan untuk implementasi?',
                'answer' => 'Untuk paket Business dan Corporate, kami menyediakan bantuan implementasi awal secara gratis.',
                'sort_order' => 4
            ],
        ];

        foreach ($faqs as $faq) {
            \App\Models\Faq::create($faq);
        }
    }
}
