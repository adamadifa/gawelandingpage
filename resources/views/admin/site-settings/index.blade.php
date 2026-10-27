@extends('layouts.admin')

@section('title', 'Site Settings — Konfigurasi Global')
@section('subtitle', 'Kelola parameter identitas brand, informasi kontak, rekening pembayaran, dan optimasi SEO landing page.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Pengaturan</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Site Settings</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Quick link to view live website -->
    <a href="{{ route('landing') }}" 
       target="_blank" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-external-link text-sm text-[#007A87]"></i>
        <span>Lihat Website</span>
    </a>
</div>
@endsection

@section('content')
@php
    $settingMeta = [
        'brand_name' => [
            'title' => 'Nama Brand / Platform',
            'category' => 'branding',
            'category_label' => 'Branding',
            'category_color' => 'teal',
            'icon' => 'ti ti-brand-appgallery',
            'desc' => 'Nama brand utama yang tampil pada bilah navigasi (navbar), footer, faktur pesanan, dan email sistem.',
            'placeholder' => 'Contoh: GAWE / PresensiGPS',
        ],
        'tagline' => [
            'title' => 'Slogan / Tagline Brand',
            'category' => 'branding',
            'category_label' => 'Branding',
            'category_color' => 'teal',
            'icon' => 'ti ti-sparkles',
            'desc' => 'Kalimat promosi singkat pendukung proposisi nilai produk di bawah nama brand atau hero banner.',
            'placeholder' => 'Contoh: Solusi Absensi & Payroll Modern',
        ],
        'brand_logo' => [
            'title' => 'Logo Utama Brand',
            'category' => 'branding',
            'category_label' => 'Branding',
            'category_color' => 'teal',
            'icon' => 'ti ti-photo',
            'desc' => 'Aset visual logo resmi format PNG, SVG, atau WebP transparan (direkomendasikan rasio horizontal atau 1:1).',
            'placeholder' => 'Pilih file logo brand',
        ],
        'whatsapp_number' => [
            'title' => 'Nomor WhatsApp Admin / CS',
            'category' => 'contact',
            'category_label' => 'Kontak',
            'category_color' => 'emerald',
            'icon' => 'ti ti-brand-whatsapp',
            'desc' => 'Nomor saluran WhatsApp Customer Support resmi. Gunakan format internasional tanpa spasi/simbol plus (contoh: 628123456789).',
            'placeholder' => 'Contoh: 6281234567890',
        ],
        'email_contact' => [
            'title' => 'Alamat Email Resmi',
            'category' => 'contact',
            'category_label' => 'Kontak',
            'category_color' => 'emerald',
            'icon' => 'ti ti-mail',
            'desc' => 'Email korespondensi resmi untuk pertanyaan calon pembeli, konfirmasi pembayaran, dan komunikasi pengguna.',
            'placeholder' => 'Contoh: support@perusahaan.com',
        ],
        'address' => [
            'title' => 'Alamat Kantor / Operasional',
            'category' => 'contact',
            'category_label' => 'Kontak',
            'category_color' => 'emerald',
            'icon' => 'ti ti-map-pin',
            'desc' => 'Lokasi kantor fisik atau domisili usaha yang dicantumkan pada bagian footer dan informasi kontak situs.',
            'placeholder' => 'Contoh: Jl. Jenderal Sudirman No. 12, Jakarta Selatan, Indonesia',
        ],
        'payment_bank_name' => [
            'title' => 'Nama Bank Pembayaran',
            'category' => 'payment',
            'category_label' => 'Pembayaran',
            'category_color' => 'blue',
            'icon' => 'ti ti-building-bank',
            'desc' => 'Nama lembaga perbankan tujuan transfer dana langganan paket lisensi member.',
            'placeholder' => 'Contoh: Bank Central Asia (BCA) / BNI / Mandiri',
        ],
        'payment_bank_number' => [
            'title' => 'Nomor Rekening Bank',
            'category' => 'payment',
            'category_label' => 'Pembayaran',
            'category_color' => 'blue',
            'icon' => 'ti ti-credit-card',
            'desc' => 'Nomor rekening bank tujuan transfer yang ditampilkan pada petunjuk pembayaran langganan.',
            'placeholder' => 'Contoh: 829 012 3456',
        ],
        'payment_bank_holder' => [
            'title' => 'Nama Pemilik Rekening (A/N)',
            'category' => 'payment',
            'category_label' => 'Pembayaran',
            'category_color' => 'blue',
            'icon' => 'ti ti-user-check',
            'desc' => 'Nama lengkap pemegang rekening sesuai dengan buku tabungan perbankan.',
            'placeholder' => 'Contoh: Adam Adifa / PT Inovasi Digital',
        ],
        'payment_bank_logo' => [
            'title' => 'Logo Bank Pembayaran',
            'category' => 'payment',
            'category_label' => 'Pembayaran',
            'category_color' => 'blue',
            'icon' => 'ti ti-photo-check',
            'desc' => 'Gambar ikon atau logo resmi bank yang akan ditampilkan di instruksi checkout pembayaran.',
            'placeholder' => 'Pilih file logo bank',
        ],
        'meta_description' => [
            'title' => 'Meta Description (SEO)',
            'category' => 'seo',
            'category_label' => 'SEO & Meta',
            'category_color' => 'indigo',
            'icon' => 'ti ti-seo',
            'desc' => 'Ringkasan isi website yang ditampilkan mesin pencari Google saat muncul di halaman pencarian (120-160 karakter).',
            'placeholder' => 'Tuliskan deskripsi meta website...',
        ],
        'meta_keywords' => [
            'title' => 'Meta Keywords (SEO)',
            'category' => 'seo',
            'category_label' => 'SEO & Meta',
            'category_color' => 'indigo',
            'icon' => 'ti ti-tags',
            'desc' => 'Daftar kata kunci pencarian yang dipisahkan oleh tanda koma untuk membantu crawling mesin pencari.',
            'placeholder' => 'absensi online, software payroll, hris indonesia, aplikasi kehadiran',
        ],
    ];

    // Helper counts for badges
    $totalConfigs = $site_configs->count();
    $brandingCount = $site_configs->filter(function($s) use ($settingMeta) {
        return ($settingMeta[$s->key]['category'] ?? 'branding') === 'branding';
    })->count();
    $contactCount = $site_configs->filter(function($s) use ($settingMeta) {
        return ($settingMeta[$s->key]['category'] ?? '') === 'contact';
    })->count();
    $paymentCount = $site_configs->filter(function($s) use ($settingMeta) {
        return ($settingMeta[$s->key]['category'] ?? '') === 'payment';
    })->count();
    $seoCount = $site_configs->filter(function($s) use ($settingMeta) {
        return ($settingMeta[$s->key]['category'] ?? '') === 'seo';
    })->count();

    // Key values dictionary for previews
    $configDict = $site_configs->pluck('value', 'key')->toArray();
@endphp

<div class="space-y-6" x-data="{ 
    activeTab: 'all', 
    searchQuery: '',
    copied: false,
    copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        this.copied = true;
        setTimeout(() => this.copied = false, 2000);
    }
}">

    <!-- Alert Errors If Any -->
    @if ($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
            <div class="flex items-center gap-2 font-bold mb-1">
                <i class="ti ti-alert-triangle text-base"></i>
                <span>Terdapat kesalahan validasi input:</span>
            </div>
            <ul class="list-disc pl-5 space-y-0.5 text-rose-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Top KPI / Overview Hero Banner (Consistent Dark Teal Gradient) -->
    <div class="rounded-2xl p-6 bg-gradient-to-r from-[#005B60] via-[#006D75] to-[#007A87] text-white shadow-sm border border-teal-800/30 relative overflow-hidden">
        <!-- Subtle Pattern Backdrop -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.08),transparent_50%)] pointer-events-none"></div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 relative z-10">
            
            <!-- Col 1: Total Parameter -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:pr-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">TOTAL PARAMETER</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Aktif</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $totalConfigs }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Pengaturan Global</span>
                    <span class="flex items-center gap-1 text-teal-200"><i class="ti ti-check text-xs"></i> Tersinkron</span>
                </div>
            </div>

            <!-- Col 2: Identitas Brand -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">BRAND UTAMA</span>
                    <span class="px-2 py-0.5 rounded-md bg-teal-400/20 text-teal-100 text-[10px] font-bold">Identitas</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-2xl font-black tracking-tight leading-none text-white truncate" title="{{ $configDict['brand_name'] ?? 'PresensiGPS' }}">
                        {{ $configDict['brand_name'] ?? 'PresensiGPS' }}
                    </h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span class="truncate">{{ $configDict['tagline'] ?? 'Sistem Modern' }}</span>
                </div>
            </div>

            <!-- Col 3: CS WhatsApp & Kontak -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">HOTLINE WHATSAPP</span>
                    <span class="px-2 py-0.5 rounded-md bg-emerald-400/25 text-emerald-100 text-[10px] font-bold">Online</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-2xl font-black tracking-tight leading-none text-white font-mono truncate">
                        +{{ $configDict['whatsapp_number'] ?? '628...' }}
                    </h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span class="truncate">{{ $configDict['email_contact'] ?? '-' }}</span>
                </div>
            </div>

            <!-- Col 4: Bank Rekening -->
            <div class="md:pl-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">REKENING PEMBAYARAN</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Manual Transfer</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-xl font-black tracking-tight leading-none text-white truncate" title="{{ $configDict['payment_bank_name'] ?? 'Bank BCA' }}">
                        {{ $configDict['payment_bank_name'] ?? 'Bank Rekening' }}
                    </h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span class="font-mono text-teal-200">{{ $configDict['payment_bank_number'] ?? '-' }}</span>
                    <span class="truncate text-teal-100/80">A/N {{ $configDict['payment_bank_holder'] ?? '-' }}</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Filter Toolbar & Category Navigation -->
    <div class="card-clean p-4">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            
            <!-- Category Tabs (Alpine-driven) -->
            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 lg:pb-0 custom-scroll text-xs">
                
                <!-- Tab: Semua -->
                <button type="button"
                        @click="activeTab = 'all'"
                        :class="activeTab === 'all' 
                            ? 'bg-[#007A87] text-white shadow-sm shadow-[#007A87]/20 font-bold' 
                            : 'bg-gray-100/80 text-gray-600 hover:bg-gray-200/70 hover:text-gray-900 font-semibold'"
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    <i class="ti ti-apps text-sm"></i>
                    <span>Semua Konfigurasi</span>
                    <span :class="activeTab === 'all' ? 'bg-white/20 text-white' : 'bg-gray-200 text-gray-700'" 
                          class="px-1.5 py-0.2 rounded-full text-[10px] font-bold">
                        {{ $totalConfigs }}
                    </span>
                </button>

                <!-- Tab: Branding & Identitas -->
                <button type="button"
                        @click="activeTab = 'branding'"
                        :class="activeTab === 'branding' 
                            ? 'bg-[#007A87] text-white shadow-sm shadow-[#007A87]/20 font-bold' 
                            : 'bg-gray-100/80 text-gray-600 hover:bg-gray-200/70 hover:text-gray-900 font-semibold'"
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    <i class="ti ti-brand-appgallery text-sm"></i>
                    <span>Identitas Brand</span>
                    <span :class="activeTab === 'branding' ? 'bg-white/20 text-white' : 'bg-gray-200 text-gray-700'" 
                          class="px-1.5 py-0.2 rounded-full text-[10px] font-bold">
                        {{ $brandingCount }}
                    </span>
                </button>

                <!-- Tab: Kontak & CS -->
                <button type="button"
                        @click="activeTab = 'contact'"
                        :class="activeTab === 'contact' 
                            ? 'bg-[#007A87] text-white shadow-sm shadow-[#007A87]/20 font-bold' 
                            : 'bg-gray-100/80 text-gray-600 hover:bg-gray-200/70 hover:text-gray-900 font-semibold'"
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    <i class="ti ti-headset text-sm"></i>
                    <span>Kontak & CS</span>
                    <span :class="activeTab === 'contact' ? 'bg-white/20 text-white' : 'bg-gray-200 text-gray-700'" 
                          class="px-1.5 py-0.2 rounded-full text-[10px] font-bold">
                        {{ $contactCount }}
                    </span>
                </button>

                <!-- Tab: Rekening Pembayaran -->
                <button type="button"
                        @click="activeTab = 'payment'"
                        :class="activeTab === 'payment' 
                            ? 'bg-[#007A87] text-white shadow-sm shadow-[#007A87]/20 font-bold' 
                            : 'bg-gray-100/80 text-gray-600 hover:bg-gray-200/70 hover:text-gray-900 font-semibold'"
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    <i class="ti ti-building-bank text-sm"></i>
                    <span>Info Rekening</span>
                    <span :class="activeTab === 'payment' ? 'bg-white/20 text-white' : 'bg-gray-200 text-gray-700'" 
                          class="px-1.5 py-0.2 rounded-full text-[10px] font-bold">
                        {{ $paymentCount }}
                    </span>
                </button>

                <!-- Tab: SEO & Meta -->
                <button type="button"
                        @click="activeTab = 'seo'"
                        :class="activeTab === 'seo' 
                            ? 'bg-[#007A87] text-white shadow-sm shadow-[#007A87]/20 font-bold' 
                            : 'bg-gray-100/80 text-gray-600 hover:bg-gray-200/70 hover:text-gray-900 font-semibold'"
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    <i class="ti ti-seo text-sm"></i>
                    <span>SEO & Metadata</span>
                    <span :class="activeTab === 'seo' ? 'bg-white/20 text-white' : 'bg-gray-200 text-gray-700'" 
                          class="px-1.5 py-0.2 rounded-full text-[10px] font-bold">
                        {{ $seoCount }}
                    </span>
                </button>

            </div>

            <!-- Search Field -->
            <div class="relative w-full lg:w-72 shrink-0">
                <i class="ti ti-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" 
                       x-model="searchQuery" 
                       placeholder="Cari parameter setting..." 
                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-9 pr-8 text-xs font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                <button type="button" 
                        x-show="searchQuery.length > 0" 
                        @click="searchQuery = ''" 
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 p-0.5">
                    <i class="ti ti-x text-xs"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Main Content Layout (Left: Settings Grid, Right: Live Previews & Tips) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left: Settings Forms List (8 cols) -->
        <div class="lg:col-span-8 space-y-4">
            
            @foreach($site_configs as $setting)
            @php
                $meta = $settingMeta[$setting->key] ?? [
                    'title' => ucwords(str_replace('_', ' ', $setting->key)),
                    'category' => 'branding',
                    'category_label' => 'Umum',
                    'category_color' => 'teal',
                    'icon' => 'ti ti-settings',
                    'desc' => 'Konfigurasi parameter sistem untuk ' . str_replace('_', ' ', $setting->key) . '.',
                    'placeholder' => 'Masukkan nilai parameter...',
                ];
                $settingCategory = $meta['category'];
                $searchKeywords = strtolower($setting->key . ' ' . $meta['title'] . ' ' . $setting->value);
            @endphp

            <div class="card-clean p-5 lg:p-6 transition-all duration-300"
                 x-show="(activeTab === 'all' || activeTab === '{{ $settingCategory }}') && (searchQuery === '' || '{{ $searchKeywords }}'.includes(searchQuery.toLowerCase()))"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0">
                
                <form action="{{ route('admin.site-settings.update', $setting->id) }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="space-y-4"
                      id="form-setting-{{ $setting->id }}">
                    @csrf
                    @method('PUT')

                    <!-- Card Header: Title, Icon, Badge & Key Indicator -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center shrink-0 border border-teal-100">
                                <i class="{{ $meta['icon'] }} text-lg"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-xs font-bold text-[#0F172A]">{{ $meta['title'] }}</h3>
                                    <span class="px-2 py-0.5 rounded-md bg-teal-50 text-[#007A87] text-[9.5px] font-bold uppercase tracking-wider">
                                        {{ $meta['category_label'] }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <code class="text-[10px] font-mono text-gray-400 bg-gray-50 border border-gray-100 px-1.5 py-0.5 rounded font-semibold">
                                        {{ $setting->key }}
                                    </code>
                                    <span class="text-[10px] text-gray-300">•</span>
                                    <span class="text-[10.5px] text-gray-400 font-medium">Tipe: {{ strtoupper($setting->type) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Status pill or quick badge -->
                        <div class="hidden sm:flex items-center gap-1.5 text-xs text-gray-400 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Tersimpan</span>
                        </div>
                    </div>

                    <!-- Helpful Description -->
                    <p class="text-xs text-[#64748B] leading-relaxed">
                        {{ $meta['desc'] }}
                    </p>

                    <!-- Input Fields According to Type -->
                    <div class="pt-1">
                        @if($setting->type == 'image')
                            <!-- Image Upload Box with Live Interactive Preview -->
                            <div class="space-y-3" x-data="{ 
                                hasNewImage: false, 
                                previewUrl: '{{ $setting->value ? asset('storage/' . $setting->value) : '' }}',
                                fileName: ''
                            }">
                                <!-- Hidden input for validation fallback -->
                                <input type="hidden" name="value" value="{{ $setting->value }}">

                                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                                    
                                    <!-- Current / Selected Image Preview -->
                                    <div class="sm:col-span-4">
                                        <div class="h-28 rounded-xl bg-gray-50 border-2 border-dashed border-gray-200 flex flex-col items-center justify-center p-2 relative overflow-hidden group">
                                            <template x-if="previewUrl">
                                                <div class="w-full h-full flex flex-col items-center justify-center">
                                                    <img :src="previewUrl" 
                                                         class="max-w-full max-h-20 object-contain mx-auto transition-transform group-hover:scale-105" 
                                                         alt="{{ $meta['title'] }}">
                                                    <span class="mt-1 px-1.5 py-0.5 rounded bg-slate-900/70 text-white text-[9px] font-semibold tracking-wider uppercase backdrop-blur-xs" 
                                                          x-text="hasNewImage ? 'Siap Simpan' : 'Gambar Aktif'">
                                                    </span>
                                                </div>
                                            </template>
                                            <template x-if="!previewUrl">
                                                <div class="text-center p-3">
                                                    <div class="w-8 h-8 rounded-lg bg-gray-100 text-gray-400 flex items-center justify-center mx-auto mb-1">
                                                        <i class="ti ti-photo-off text-base"></i>
                                                    </div>
                                                    <span class="text-[10px] text-gray-400 font-semibold block">Belum ada gambar</span>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Upload Control & File Selection -->
                                    <div class="sm:col-span-8 space-y-2">
                                        <label for="input-{{ $setting->id }}" 
                                               class="w-full flex flex-col items-center justify-center p-4 border border-gray-200 hover:border-[#007A87] bg-[#F8FAFC] hover:bg-white rounded-xl cursor-pointer transition-all group">
                                            <input type="file" 
                                                   id="input-{{ $setting->id }}" 
                                                   name="image_value" 
                                                   accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                                   class="hidden"
                                                   @change="
                                                       if ($event.target.files && $event.target.files[0]) {
                                                           const file = $event.target.files[0];
                                                           fileName = file.name;
                                                           hasNewImage = true;
                                                           const reader = new FileReader();
                                                           reader.onload = (e) => previewUrl = e.target.result;
                                                           reader.readAsDataURL(file);
                                                       }
                                                   ">
                                            <div class="flex items-center gap-2 text-xs font-bold text-[#007A87] group-hover:text-[#005B60]">
                                                <i class="ti ti-upload text-base"></i>
                                                <span x-text="hasNewImage ? 'Ganti File Dipilih' : 'Unggah File Gambar Baru'"></span>
                                            </div>
                                            <p class="text-[10.5px] text-gray-400 mt-1 font-medium text-center">
                                                Format PNG, JPG, WebP, atau SVG (Maks. 2MB)
                                            </p>
                                        </label>

                                        <template x-if="hasNewImage">
                                            <div class="flex items-center justify-between px-3 py-1.5 rounded-lg bg-teal-50 border border-teal-200 text-teal-800 text-[11px] font-semibold">
                                                <div class="flex items-center gap-1.5 truncate">
                                                    <i class="ti ti-file-check text-sm text-[#007A87]"></i>
                                                    <span class="truncate" x-text="fileName"></span>
                                                </div>
                                                <button type="button" 
                                                        @click="hasNewImage = false; previewUrl = '{{ $setting->value ? asset('storage/' . $setting->value) : '' }}'; document.getElementById('input-{{ $setting->id }}').value = '';" 
                                                        class="text-rose-500 hover:text-rose-700 text-xs ml-2 cursor-pointer"
                                                        title="Batal pilih file baru">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                        </template>
                                    </div>

                                </div>
                            </div>

                        @elseif($setting->type == 'textarea')
                            <!-- Textarea Input Field -->
                            <div class="space-y-1.5">
                                <textarea name="value" 
                                          rows="3" 
                                          required 
                                          placeholder="{{ $meta['placeholder'] }}"
                                          class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl p-3 text-xs text-gray-900 font-semibold leading-relaxed placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all resize-y">{{ $setting->value }}</textarea>
                                
                                <div class="flex items-center justify-between text-[10.5px] text-gray-400 font-medium">
                                    <span>Gunakan teks yang jelas dan komunikatif.</span>
                                    <span>{{ strlen($setting->value ?? '') }} karakter saat ini</span>
                                </div>
                            </div>

                        @else
                            <!-- Standard Text Input with Specific Prefix Icons -->
                            <div class="relative">
                                @if($setting->key == 'whatsapp_number')
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-600 font-bold text-xs">
                                        <i class="ti ti-brand-whatsapp text-sm mr-1"></i>
                                        <span>+</span>
                                    </div>
                                    <input type="text" 
                                           name="value" 
                                           value="{{ $setting->value }}" 
                                           required 
                                           placeholder="6281234567890" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-12 pr-4 text-xs font-bold text-gray-900 font-mono placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                                @elseif($setting->key == 'email_contact')
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <i class="ti ti-mail text-sm"></i>
                                    </div>
                                    <input type="email" 
                                           name="value" 
                                           value="{{ $setting->value }}" 
                                           required 
                                           placeholder="cs@perusahaan.com" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-10 pr-4 text-xs font-bold text-gray-900 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                                @elseif($setting->key == 'payment_bank_number')
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <i class="ti ti-credit-card text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           name="value" 
                                           value="{{ $setting->value }}" 
                                           required 
                                           placeholder="829 012 3456" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-10 pr-4 text-xs font-bold text-gray-900 font-mono placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                                @else
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <i class="{{ $meta['icon'] }} text-sm"></i>
                                    </div>
                                    <input type="text" 
                                           name="value" 
                                           value="{{ $setting->value }}" 
                                           required 
                                           placeholder="{{ $meta['placeholder'] }}" 
                                           class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2.5 pl-10 pr-4 text-xs font-bold text-gray-900 placeholder-gray-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Action Button Row -->
                    <div class="pt-2 flex items-center justify-between border-t border-gray-100">
                        <div class="text-[11px] text-gray-400 font-medium">
                            <span>ID: #{{ $setting->id }}</span>
                        </div>

                        <button type="submit" 
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all active:scale-95 cursor-pointer">
                            <i class="ti ti-device-floppy text-sm"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>

                </form>

            </div>
            @endforeach

            <!-- Empty Search State -->
            <div x-cloak
                 x-show="searchQuery !== ''" 
                 class="card-clean p-8 text-center space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto">
                    <i class="ti ti-search-off text-2xl"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Tidak ada parameter yang cocok</h4>
                <p class="text-xs text-gray-400 max-w-sm mx-auto">
                    Tidak ditemukan parameter pengaturan dengan kata kunci "<span class="font-bold text-gray-700" x-text="searchQuery"></span>".
                </p>
                <button type="button" 
                        @click="searchQuery = ''; activeTab = 'all'" 
                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-xs font-semibold text-gray-700 transition-colors">
                    <i class="ti ti-refresh text-xs"></i>
                    <span>Reset Filter</span>
                </button>
            </div>

        </div>

        <!-- Right: Live Previews & Helpful Tips (4 cols) -->
        <div class="lg:col-span-4 space-y-5 lg:sticky lg:top-24">
            
            <!-- Widget 1: Mockup Live Header Brand Preview -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center">
                            <i class="ti ti-layout-navbar text-base"></i>
                        </div>
                        <h4 class="text-xs font-bold text-[#0F172A]">Pratinjau Navbar Brand</h4>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-teal-50 text-[#007A87] text-[10px] font-bold">Live</span>
                </div>

                <!-- Mini Navbar Card -->
                <div class="p-3.5 rounded-xl bg-slate-900 text-white shadow-md space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            @if(!empty($configDict['brand_logo']))
                                <img src="{{ asset('storage/' . $configDict['brand_logo']) }}" 
                                     alt="Logo" 
                                     class="h-7 w-auto object-contain max-w-[80px]">
                            @else
                                <div class="w-7 h-7 rounded-lg bg-gradient-to-tr from-[#005B60] to-[#007A87] flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                    <i class="ti ti-bolt text-sm"></i>
                                </div>
                            @endif
                            <div>
                                <span class="text-xs font-black tracking-tight text-white block leading-none">
                                    {{ $configDict['brand_name'] ?? 'PresensiGPS' }}
                                </span>
                                <span class="text-[9px] text-teal-200 font-medium block truncate max-w-[140px] mt-0.5">
                                    {{ $configDict['tagline'] ?? 'Solusi Modern' }}
                                </span>
                            </div>
                        </div>

                        <span class="text-[10px] px-2 py-0.5 rounded bg-white/10 text-teal-200 font-bold">
                            Live App
                        </span>
                    </div>

                    <!-- Mini CTA Preview -->
                    <div class="pt-2 border-t border-white/10 flex items-center justify-between text-[10.5px]">
                        <span class="text-gray-400">Tombol Kontak:</span>
                        <a href="https://wa.me/{{ $configDict['whatsapp_number'] ?? '' }}" 
                           target="_blank" 
                           class="text-emerald-400 font-bold hover:underline flex items-center gap-1">
                            <i class="ti ti-brand-whatsapp text-xs"></i>
                            <span>WhatsApp CS</span>
                        </a>
                    </div>
                </div>

                <p class="text-[11px] text-gray-400 leading-normal">
                    Identitas brand dan slogan otomatis diterapkan di header, footer, invoice, dan seluruh komunikasi landing page.
                </p>
            </div>

            <!-- Widget 2: Mockup Rekening Pembayaran (Member Checkout Preview) -->
            <div class="card-clean p-5 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <i class="ti ti-receipt-2 text-base"></i>
                        </div>
                        <h4 class="text-xs font-bold text-[#0F172A]">Pratinjau Struk Transfer</h4>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold">Member</span>
                </div>

                <!-- Bank Card Mockup -->
                <div class="p-4 rounded-xl bg-gradient-to-br from-slate-50 to-gray-100 border border-gray-200 space-y-3 relative overflow-hidden">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            @if(!empty($configDict['payment_bank_logo']))
                                <img src="{{ asset('storage/' . $configDict['payment_bank_logo']) }}" 
                                     alt="Bank Logo" 
                                     class="h-6 w-auto object-contain max-w-[60px]">
                            @else
                                <div class="w-6 h-6 rounded-md bg-blue-600 text-white flex items-center justify-center text-xs">
                                    <i class="ti ti-building-bank"></i>
                                </div>
                            @endif
                            <span class="text-xs font-bold text-gray-800">
                                {{ $configDict['payment_bank_name'] ?? 'Bank BCA' }}
                            </span>
                        </div>
                        <span class="text-[9.5px] font-bold uppercase tracking-wider text-gray-400">Transfer Bank</span>
                    </div>

                    <div class="bg-white p-2.5 rounded-lg border border-gray-200/80 flex items-center justify-between">
                        <div>
                            <span class="text-[9.5px] text-gray-400 font-semibold block uppercase tracking-wider">No. Rekening</span>
                            <span class="text-sm font-extrabold font-mono text-[#0F172A] tracking-wider block">
                                {{ $configDict['payment_bank_number'] ?? '829 012 3456' }}
                            </span>
                        </div>
                        <button type="button" 
                                @click="copyToClipboard('{{ $configDict['payment_bank_number'] ?? '' }}')" 
                                class="px-2.5 py-1 rounded-md bg-gray-100 hover:bg-[#007A87] hover:text-white text-gray-700 text-[10.5px] font-bold transition-colors flex items-center gap-1 cursor-pointer">
                            <i :class="copied ? 'ti ti-check' : 'ti ti-copy'"></i>
                            <span x-text="copied ? 'Tersalin' : 'Salin'"></span>
                        </button>
                    </div>

                    <div class="flex items-center justify-between text-[11px] text-gray-500 font-medium pt-1">
                        <span>Atas Nama:</span>
                        <span class="font-bold text-gray-800">{{ $configDict['payment_bank_holder'] ?? '-' }}</span>
                    </div>
                </div>

                <p class="text-[11px] text-gray-400 leading-normal">
                    Kotak di atas merepresentasikan instruksi pembayaran manual yang dilihat oleh calon member setelah memilih paket langganan.
                </p>
            </div>

            <!-- Widget 3: Quick Action & Best Practices Tips -->
            <div class="card-clean p-5 space-y-3.5 bg-gradient-to-br from-teal-50/40 via-white to-white">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-6 h-6 rounded-md bg-teal-100 text-[#007A87] flex items-center justify-center text-xs">
                        <i class="ti ti-bulb"></i>
                    </div>
                    <h4 class="text-xs font-bold text-[#0F172A]">Panduan & Rekomendasi</h4>
                </div>

                <ul class="space-y-2.5 text-xs text-gray-600">
                    <li class="flex items-start gap-2">
                        <i class="ti ti-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                        <span><strong>Format WhatsApp:</strong> Pastikan awali dengan kode negara tanpa simbol tambah, contoh: <code class="bg-gray-100 px-1 rounded text-teal-800">628123456789</code>.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ti ti-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                        <span><strong>Format Logo:</strong> Gunakan format <strong>PNG transparan</strong> atau <strong>SVG</strong> agar menyatu dengan latar belakang gelap/terang.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ti ti-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                        <span><strong>Optimasi SEO:</strong> Buat meta description berkisar 120 hingga 160 karakter untuk keterbacaan optimal di Google Search.</span>
                    </li>
                </ul>

                <div class="pt-2 border-t border-gray-100">
                    <a href="https://wa.me/{{ $configDict['whatsapp_number'] ?? '' }}" 
                       target="_blank" 
                       class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-800 font-bold text-xs transition-colors">
                        <i class="ti ti-brand-whatsapp text-sm"></i>
                        <span>Uji Kontak WhatsApp Sekarang</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
