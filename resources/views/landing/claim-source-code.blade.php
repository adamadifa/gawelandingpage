<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Klaim Lisensi & Pembaruan Source Code — {{ $settings['brand_name'] ?? 'PresensiGPS' }}</title>
    <meta name="description" content="Formulir verifikasi dan klaim pembaruan versi terbaru Source Code On-Premise. Lampirkan bukti pembayaran dan berikan testimoni pengalaman Anda.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
            color: #0F172A;
        }
        .font-display { font-family: 'Outfit', sans-serif; }
    </style>
</head>

<body class="antialiased selection:bg-[#007A87] selection:text-white" x-data="{
    name: '{{ old('name', auth()->user()->name ?? '') }}',
    rating: {{ old('rating', 5) }},
    hoverRating: 0,
    platform: '{{ old('platform', 'lynk_id') }}',
    proofName: '',
    proofPreview: '',
    avatarPreview: ''
}">

    <!-- Top Navbar Minimal -->
    <nav class="h-20 bg-white/90 backdrop-blur-md border-b border-[#E2E8F0] sticky top-0 z-40">
        <div class="max-w-7xl mx-auto h-full px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#005B60] to-[#007A87] flex items-center justify-center text-white shadow-md shadow-[#007A87]/20 group-hover:scale-105 transition-transform">
                    <i class="ti ti-bolt text-xl"></i>
                </div>
                <div>
                    <span class="font-display font-black text-lg text-[#0F172A] tracking-tight block leading-none">
                        {{ $settings['brand_name'] ?? 'PresensiGPS' }}
                    </span>
                    <span class="text-[10px] text-[#007A87] font-extrabold uppercase tracking-widest mt-0.5 block">
                        Portal Verifikasi Source Code
                    </span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('member.dashboard') }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-bold text-gray-700 transition-colors">
                        <i class="ti ti-layout-dashboard text-sm"></i>
                        <span>Dashboard Member</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-gray-600 hover:text-[#007A87] transition-colors">
                        <span>Sudah Punya Akun?</span>
                        <span class="text-[#007A87] underline">Login</span>
                    </a>
                @endauth

                <a href="{{ route('landing') }}" 
                   class="inline-flex items-center gap-1 px-3.5 py-2 rounded-xl border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50 transition-colors">
                    <i class="ti ti-arrow-left text-sm"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content Body -->
    <main class="py-10 lg:py-14 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        <!-- Header Banner -->
        <div class="text-center max-w-3xl mx-auto mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-teal-50 border border-teal-200 text-[#007A87] text-xs font-bold uppercase tracking-wider mb-3">
                <i class="ti ti-certificate text-base"></i>
                <span>Verifikasi Pembelian On-Premise</span>
            </div>
            <h1 class="font-display text-2xl sm:text-4xl font-black text-[#0F172A] tracking-tight leading-tight">
                Klaim Pembaruan & Akses Repository Source Code
            </h1>
            <p class="text-sm sm:text-base text-gray-500 mt-2.5 leading-relaxed font-medium">
                Pernah membeli paket Source Code kami baik secara langsung maupun via platform (Mayar, Lynk.id, CodeCanyon, dll.)? Daftarkan akun Anda, lampirkan bukti pembayaran, dan berikan ulasan singkat untuk mendapatkan link update versi terbaru.
            </p>
        </div>

        <!-- Alert Error If Any -->
        @if ($errors->any())
            <div class="max-w-4xl mx-auto mb-8 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                <div class="flex items-center gap-2 font-bold mb-1 text-sm">
                    <i class="ti ti-alert-triangle text-lg text-rose-600"></i>
                    <span>Terdapat kesalahan pada formulir pendaftaran:</span>
                </div>
                <ul class="list-disc pl-5 space-y-0.5 text-rose-700 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('info'))
            <div class="max-w-4xl mx-auto mb-8 p-4 rounded-2xl bg-blue-50 border border-blue-200 text-blue-800 flex items-center justify-between text-xs font-bold">
                <div class="flex items-center gap-2">
                    <i class="ti ti-info-circle text-lg text-blue-600"></i>
                    <span>{{ session('info') }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start max-w-6xl mx-auto">
            
            <!-- Left Column: The Claim Form (8 Cols) -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-[#E2E8F0] shadow-sm p-6 sm:p-8">
                <form action="{{ route('source-code-claim.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-8">
                    @csrf

                    <!-- Section 1: Informasi Akun / Pembeli -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2.5 pb-3 border-b border-gray-100">
                            <span class="w-6 h-6 rounded-full bg-teal-50 text-[#007A87] font-bold text-xs flex items-center justify-center">1</span>
                            <h3 class="text-sm font-bold text-[#0F172A] uppercase tracking-wide">Data Akun & Identitas Member</h3>
                        </div>

                        @auth
                            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                            <div class="p-4 rounded-2xl bg-teal-50/60 border border-teal-200/80 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#007A87] text-white flex items-center justify-center font-bold text-sm">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                        <p class="text-[11px] text-gray-500">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 rounded-lg bg-white border border-teal-200 text-[#007A87] text-[10.5px] font-bold">
                                    Sedang Login
                                </span>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Nomor WhatsApp Aktif <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-600 font-bold text-xs">+</span>
                                    <input type="text" 
                                           name="whatsapp_number" 
                                           value="{{ old('whatsapp_number', auth()->user()->whatsapp_number ?? '') }}" 
                                           required 
                                           placeholder="6281234567890" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-8 pr-4 text-xs font-bold text-gray-900 font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                                </div>
                                <span class="text-[10.5px] text-gray-400 mt-1 block">Digunakan tim admin untuk konfirmasi dan tautan grup VIP.</span>
                            </div>
                        @else
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">
                                        Nama Lengkap <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required 
                                           placeholder="Contoh: Budi Pratama" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">
                                        Alamat Email <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           placeholder="budi@example.com" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">
                                        Nomor WhatsApp <span class="text-rose-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-emerald-600 font-bold text-xs">+</span>
                                        <input type="text" 
                                               name="whatsapp_number" 
                                               value="{{ old('whatsapp_number') }}" 
                                               required 
                                               placeholder="6281234567890" 
                                               class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-8 pr-4 text-xs font-bold text-gray-900 font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 mb-1">
                                        Kata Sandi (Password Akun) <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="password" 
                                           name="password" 
                                           required 
                                           placeholder="Minimal 8 karakter" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold text-gray-700 mb-1">
                                        Konfirmasi Kata Sandi <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="password" 
                                           name="password_confirmation" 
                                           required 
                                           placeholder="Ulangi kata sandi di atas" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Section 2: Riwayat Pembelian & Bukti Transaksi -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2.5 pb-3 border-b border-gray-100">
                            <span class="w-6 h-6 rounded-full bg-teal-50 text-[#007A87] font-bold text-xs flex items-center justify-center">2</span>
                            <h3 class="text-sm font-bold text-[#0F172A] uppercase tracking-wide">Data Riwayat Pembelian & Bukti</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Platform Asal -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Platform Pembelian Sebelumnya <span class="text-rose-500">*</span>
                                </label>
                                <select name="platform" 
                                        x-model="platform" 
                                        required 
                                        class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] cursor-pointer">
                                    <option value="lynk_id">Lynk.id</option>
                                    <option value="saweria">Saweria</option>
                                    <option value="other">Platform Lainnya</option>
                                </select>
                            </div>

                            <!-- Platform Lainnya (jika pilih other) -->
                            <div x-show="platform === 'other'" x-cloak>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Sebutkan Nama Platform Lainnya <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       name="platform_other" 
                                       value="{{ old('platform_other') }}" 
                                       placeholder="Contoh: Transfer Bank BCA / Beli di Event" 
                                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                            </div>

                            <!-- Order ID / Invoice ID -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Nomor Order / ID Transaksi / Invoice
                                </label>
                                <input type="text" 
                                       name="order_id" 
                                       value="{{ old('order_id') }}" 
                                       placeholder="Contoh: INV-98124 / Order #382" 
                                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                            </div>

                            <!-- Tanggal Pembelian dengan Flatpickr -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Tanggal Pembelian (Sesuai Invoice / Bukti)
                                </label>
                                <div class="relative" x-data x-init="
                                    flatpickr($refs.purchaseDatePicker, {
                                        dateFormat: 'Y-m-d',
                                        altInput: true,
                                        altFormat: 'j F Y',
                                        maxDate: 'today',
                                        locale: 'id',
                                        disableMobile: true,
                                        altInputClass: 'w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-9 pr-3 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] cursor-pointer'
                                    });
                                ">
                                    <i class="ti ti-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm z-10 pointer-events-none"></i>
                                    <input type="text" 
                                           x-ref="purchaseDatePicker"
                                           name="purchase_date" 
                                           value="{{ old('purchase_date') }}" 
                                           placeholder="Pilih tanggal pembelian..." 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-9 pr-3 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] cursor-pointer">
                                </div>
                            </div>

                            <!-- Nominal Pembayaran -->
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-1">
                                    Nominal Pembayaran (Rp)
                                </label>
                                <input type="number" 
                                       name="price_paid" 
                                       value="{{ old('price_paid') }}" 
                                       placeholder="Contoh: 1500000" 
                                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                            </div>
                        </div>

                        <!-- Upload Bukti Transaksi -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Unggah Bukti Transaksi (Struk / Invoice / Screenshot Chat) <span class="text-rose-500">*</span>
                            </label>
                            
                            <label for="proof_file" 
                                   class="w-full flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-200 hover:border-[#007A87] bg-[#F8FAFC] hover:bg-white rounded-2xl cursor-pointer transition-all group">
                                <input type="file" 
                                       id="proof_file" 
                                       name="proof_file" 
                                       required 
                                       accept="image/png,image/jpeg,image/webp,application/pdf"
                                       class="hidden"
                                       @change="
                                           if ($event.target.files && $event.target.files[0]) {
                                               const file = $event.target.files[0];
                                               proofName = file.name;
                                               if (file.type.startsWith('image/')) {
                                                   const reader = new FileReader();
                                                   reader.onload = (e) => proofPreview = e.target.result;
                                                   reader.readAsDataURL(file);
                                               } else {
                                                   proofPreview = '';
                                               }
                                           }
                                       ">
                                
                                <template x-if="proofPreview">
                                    <div class="mb-3">
                                        <img :src="proofPreview" class="max-h-36 rounded-xl object-contain border border-gray-200 shadow-sm">
                                    </div>
                                </template>

                                <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <i class="ti ti-upload text-xl"></i>
                                </div>
                                <span class="text-xs font-bold text-gray-800" x-text="proofName ? proofName : 'Klik untuk memilih bukti pembayaran'"></span>
                                <span class="text-[10.5px] text-gray-400 mt-1 font-medium">Format JPG, PNG, WebP, atau PDF (Maks. 4MB)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Section 3: Ulasan & Testimoni Wajib -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2.5 pb-3 border-b border-gray-100">
                            <span class="w-6 h-6 rounded-full bg-teal-50 text-[#007A87] font-bold text-xs flex items-center justify-center">3</span>
                            <h3 class="text-sm font-bold text-[#0F172A] uppercase tracking-wide">Testimoni & Ulasan Aplikasi</h3>
                        </div>

                        <!-- Rating Bintang Interaktif -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1.5">
                                Berikan Penilaian / Rating Bintang <span class="text-rose-500">*</span>
                            </label>
                            <input type="hidden" name="rating" :value="rating">
                            
                            <div class="flex items-center gap-2">
                                <template x-for="i in 5">
                                    <button type="button" 
                                            @click="rating = i" 
                                            @mouseenter="hoverRating = i" 
                                            @mouseleave="hoverRating = 0"
                                            class="p-1 text-2xl transition-transform hover:scale-125 focus:outline-none cursor-pointer"
                                            :class="(hoverRating || rating) >= i ? 'text-amber-400' : 'text-gray-300'">
                                        <i class="ti ti-star-filled"></i>
                                    </button>
                                </template>
                                <span class="ml-2 text-xs font-extrabold text-[#0F172A]" 
                                      x-text="rating === 5 ? '5/5 (Sangat Puas & Rekomended)' : (rating === 4 ? '4/5 (Puas)' : (rating === 3 ? '3/5 (Cukup)' : rating + '/5'))">
                                </span>
                            </div>
                        </div>

                        <!-- Nama Perusahaan / Usaha -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Nama Bisnis / Instansi / Usaha (Opsional)
                            </label>
                            <input type="text" 
                                   name="company" 
                                   value="{{ old('company') }}" 
                                   placeholder="Contoh: PT Digital Solusi Indonesia / Freelance Developer" 
                                   class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 px-3.5 text-xs font-semibold text-gray-900 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">
                            <span class="text-[10.5px] text-gray-400 mt-1 block">Akan ditampilkan bersama ulasan testimoni Anda.</span>
                        </div>

                        <!-- Teks Testimoni -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Ulasan / Testimoni Pengalaman Menggunakan Aplikasi <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="testimonial_content" 
                                      rows="4" 
                                      required 
                                      placeholder="Tuliskan kepuasan Anda mengenai kemudahan instalasi, kelengkapan source code, atau fitur absensi GPS & payroll..." 
                                      class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl p-3 text-xs text-gray-900 font-medium leading-relaxed placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87]">{{ old('testimonial_content') }}</textarea>
                            <span class="text-[10.5px] text-gray-400 mt-1 block font-medium">Ulasan ini akan ditinjau dan dapat ditampilkan di landing page kami sebagai social proof.</span>
                        </div>

                        <!-- Foto Profil Opsional -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">
                                Foto Profil / Avatar (Opsional untuk Testimoni)
                            </label>
                            <div class="flex items-center gap-4">
                                <label for="avatar" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-bold text-gray-700 cursor-pointer transition-colors">
                                    <i class="ti ti-camera text-sm text-[#007A87]"></i>
                                    <span>Pilih Foto</span>
                                    <input type="file" 
                                           id="avatar" 
                                           name="avatar" 
                                           accept="image/*" 
                                           class="hidden"
                                           @change="
                                               if ($event.target.files && $event.target.files[0]) {
                                                   const reader = new FileReader();
                                                   reader.onload = (e) => avatarPreview = e.target.result;
                                                   reader.readAsDataURL($event.target.files[0]);
                                               }
                                           ">
                                </label>
                                <template x-if="avatarPreview">
                                    <div class="flex items-center gap-2">
                                        <img :src="avatarPreview" class="w-9 h-9 rounded-full object-cover border border-teal-200">
                                        <span class="text-[11px] text-teal-700 font-semibold">Foto siap digunakan</span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Persetujuan Syarat -->
                    <div class="pt-2">
                        <label class="flex items-start gap-2.5 cursor-pointer">
                            <input type="checkbox" 
                                   name="terms" 
                                   value="1" 
                                   required 
                                   {{ old('terms') ? 'checked' : '' }}
                                   class="mt-0.5 rounded border-gray-300 text-[#007A87] focus:ring-[#007A87]">
                            <span class="text-xs text-gray-600 font-medium leading-relaxed">
                                Saya menyatakan bahwa bukti transaksi yang dilampirkan adalah valid atas kepemilikan lisensi saya, serta mengizinkan ulasan pengalaman saya diterbitkan secara wajar pada platform ini.
                            </span>
                        </label>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full py-3.5 px-6 rounded-2xl bg-[#007A87] hover:bg-[#005B60] text-white text-sm font-bold shadow-lg shadow-[#007A87]/25 hover:shadow-[#007A87]/35 transition-all flex items-center justify-center gap-2 cursor-pointer active:scale-98">
                            <i class="ti ti-send text-base"></i>
                            <span>Kirim Permohonan Verifikasi & Klaim Akses</span>
                        </button>
                    </div>

                </form>
            </div>

            <!-- Right Column: Verification Steps & FAQ (4 Cols) -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
                
                <!-- Card 1: Tahapan Verifikasi -->
                <div class="bg-white rounded-3xl border border-[#E2E8F0] shadow-sm p-6 space-y-5">
                    <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center font-bold text-sm">
                            <i class="ti ti-shield-check text-lg"></i>
                        </div>
                        <h4 class="text-xs font-bold text-[#0F172A] uppercase tracking-wider">Bagaimana Prosesnya?</h4>
                    </div>

                    <div class="space-y-4 text-xs">
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-teal-100 text-[#007A87] font-black text-[11px] flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <div>
                                <h5 class="font-bold text-gray-900">Isi Formulir & Bukti</h5>
                                <p class="text-gray-500 mt-0.5 leading-relaxed">Lampirkan tangkapan layar invoice/transfer dan tulis ulasan jujur Anda.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-teal-100 text-[#007A87] font-black text-[11px] flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <div>
                                <h5 class="font-bold text-gray-900">Verifikasi Admin (Maks 1x24 Jam)</h5>
                                <p class="text-gray-500 mt-0.5 leading-relaxed">Admin memeriksa bukti transaksi dan mencocokkan nomor invoice/rekening.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-teal-100 text-[#007A87] font-black text-[11px] flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <div>
                                <h5 class="font-bold text-gray-900">Akses Update Terbuka</h5>
                                <p class="text-gray-500 mt-0.5 leading-relaxed">Setelah disetujui, tombol download link SC terbaru dan grup VIP otomatis terbuka di member dashboard.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Keuntungan Member Terverifikasi -->
                <div class="bg-gradient-to-br from-[#005B60] via-[#006D75] to-[#007A87] text-white rounded-3xl p-6 shadow-md shadow-teal-900/10 space-y-4">
                    <div class="flex items-center gap-2">
                        <i class="ti ti-sparkles text-xl text-teal-200"></i>
                        <h4 class="text-xs font-black uppercase tracking-wider text-teal-100">Fasilitas Pemilik Lisensi</h4>
                    </div>

                    <ul class="space-y-2.5 text-xs text-teal-50">
                        <li class="flex items-center gap-2">
                            <i class="ti ti-check text-teal-300 text-sm"></i>
                            <span>Tautan unduhan source code versi teranyar</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ti ti-check text-teal-300 text-sm"></i>
                            <span>Catatan rilis (changelog) & panduan update</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ti ti-check text-teal-300 text-sm"></i>
                            <span>Akses grup diskusi & support komunitas VIP</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ti ti-check text-teal-300 text-sm"></i>
                            <span>Prioritas konsultasi instalasi & bug-fix</span>
                        </li>
                    </ul>
                </div>

                <!-- Card 3: Bantuan Langsung WhatsApp -->
                <div class="bg-white rounded-3xl border border-[#E2E8F0] shadow-sm p-6 text-center space-y-3">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto text-xl">
                        <i class="ti ti-brand-whatsapp"></i>
                    </div>
                    <div>
                        <h5 class="text-xs font-bold text-gray-900">Butuh Bantuan Verifikasi?</h5>
                        <p class="text-[11px] text-gray-400 mt-1 leading-relaxed">
                            Jika Anda kehilangan bukti transaksi atau membeli via tunai, hubungi tim kami langsung melalui WhatsApp.
                        </p>
                    </div>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text=Halo%20Admin,%20saya%20ingin%20verifikasi%20pembelian%20Source%20Code" 
                       target="_blank" 
                       class="inline-flex items-center justify-center gap-1.5 w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition-colors shadow-sm">
                        <i class="ti ti-brand-whatsapp text-sm"></i>
                        <span>Chat WhatsApp Admin</span>
                    </a>
                </div>

            </div>

        </div>

    </main>

    <!-- Footer Simple -->
    <footer class="py-8 border-t border-[#E2E8F0] text-center text-xs text-gray-400">
        <p>© {{ date('Y') }} {{ $settings['brand_name'] ?? 'PresensiGPS' }}. Seluruh hak cipta dilindungi.</p>
    </footer>

</body>
</html>
