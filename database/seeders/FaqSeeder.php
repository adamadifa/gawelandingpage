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
                'question' => 'Apakah karyawan bisa melakukan manipulasi lokasi atau menggunakan Fake GPS?',
                'answer' => 'Tidak bisa. Sistem kami dilengkapi dengan fitur Anti-Fake GPS dan deteksi lokasi yang sangat ketat melalui titik koordinat nyata. Selain itu, setiap absensi wajib divalidasi dengan Face Recognition (Pengenalan Wajah) menggunakan AI, sehingga tidak ada lagi celah untuk "titip absen" atau manipulasi lokasi dari jarak jauh.',
                'sort_order' => 1
            ],
            [
                'question' => 'Bagaimana jika perusahaan saya memiliki banyak cabang dan jadwal shift yang berbeda-beda?',
                'answer' => 'PresensiGPS V2 sangat fleksibel. Anda dapat mendaftarkan banyak lokasi cabang dengan radius geofencing masing-masing. Sistem juga mendukung Multi-Shift (Pagi, Siang, Malam) hingga shift lintas hari, yang dapat diatur per grup atau per departemen dengan sangat mudah melalui panel admin.',
                'sort_order' => 2
            ],
            [
                'question' => 'Apakah benar perhitungan gaji (Payroll) sudah sepenuhnya otomatis?',
                'answer' => 'Benar sekali. Di akhir bulan, Anda tidak perlu lagi merekap data kehadiran secara manual. Sistem akan secara otomatis menghitung Gaji Pokok, Tunjangan Tetap/Tidak Tetap, Overtime (Lembur), Iuran BPJS, hingga potongan otomatis cicilan pinjaman. Anda hanya perlu melakukan verifikasi satu kali untuk men-generate semua slip gaji karyawan secara masal.',
                'sort_order' => 3
            ],
            [
                'question' => 'Bagaimana cara karyawan memantau sisa pinjaman atau jatah cuti mereka?',
                'answer' => 'Transparansi adalah kunci. Setiap karyawan memiliki akses ke Dashboard Pribadi melalui ponsel mereka. Di sana, mereka bisa memantau sisa kuota cuti tahunan, status pengajuan izin yang disetujui, hingga rincian saldo pinjaman dan riwayat cicilan mereka tanpa perlu bertanya ke bagian admin HR.',
                'sort_order' => 4
            ],
            [
                'question' => 'Seberapa aman data perusahaan dan data pribadi karyawan di aplikasi ini?',
                'answer' => 'Keamanan data adalah prioritas utama kami. Aplikasi menggunakan enkripsi data standar industri untuk melindungi informasi sensitif. Selain itu, sistem hak akses (Role & Permission Control) memastikan bahwa hanya admin yang berwenang yang dapat mengakses data finansial seperti gaji, laporan internal, dan data sensitif perusahaan lainnya.',
                'sort_order' => 5
            ],
        ];

        foreach ($faqs as $faq) {
            \App\Models\Faq::create($faq);
        }
    }
}
