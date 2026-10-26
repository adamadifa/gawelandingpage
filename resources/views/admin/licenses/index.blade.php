@extends('layouts.admin')

@section('title', 'Data Lisensi Member')
@section('subtitle', 'Pantau lisensi aktif, masa berlaku langganan, dan status sistem aplikasi pelanggan.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Master Data</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Data Lisensi</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Transaksi Member -->
    <a href="{{ route('admin.memberships.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-receipt text-[#007A87] text-sm"></i>
        <span>Data Transaksi</span>
    </a>

    <!-- Kelola Paket -->
    <a href="{{ route('admin.pricing-plans.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-teal-700/20 transition-all">
        <i class="ti ti-tag text-sm"></i>
        <span>Kelola Paket</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-5" x-data="{ viewMode: 'cards' }">

    <!-- Top Stats Banner (Dark Teal Gradient) -->
    <div class="rounded-2xl p-6 bg-gradient-to-r from-[#005B60] via-[#006D75] to-[#007A87] text-white shadow-sm border border-teal-800/30 relative overflow-hidden">
        <!-- Subtle Pattern Backdrop -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.08),transparent_50%)] pointer-events-none"></div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 relative z-10">
            
            <!-- Col 1: Total Lisensi -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:pr-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">TOTAL LISENSI</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Semua</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['total'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Lisensi Diterbitkan</span>
                    <span>100%</span>
                </div>
            </div>

            <!-- Col 2: Lisensi Aktif -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">LISENSI AKTIF</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Aktif</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['active'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Masa Berlaku Valid</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['active'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 3: Segera Berakhir -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">SEGERA HABIS</span>
                    <span class="px-2 py-0.5 rounded-md bg-amber-400/25 text-amber-200 text-[10px] font-bold">&lt; 30 Hari</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['expiring_soon'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Perlu Perpanjangan</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['expiring_soon'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 4: Kedaluwarsa -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">KEDALUWARSA</span>
                    <span class="px-2 py-0.5 rounded-md bg-rose-400/25 text-rose-200 text-[10px] font-bold">Expired</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['expired'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Masa Habis</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['expired'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 5: Aplikasi Running -->
            <div class="md:pl-4">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-100/80">APLIKASI RUNNING</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Online</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['running_apps'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Sistem Terhubung</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['running_apps'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="card-clean p-4">
        <form method="GET" action="{{ route('admin.licenses.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center">
            
            <!-- Search Bar -->
            <div class="lg:col-span-5 relative">
                <i class="ti ti-search text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 text-base"></i>
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}" 
                       placeholder="Cari Kode Lisensi / Nama Member / Email / URL..." 
                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-10 pr-4 text-xs font-medium text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
            </div>

            <!-- Filter Paket -->
            <div class="lg:col-span-3">
                <select name="plan_id" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all cursor-pointer">
                    <option value="all">Semua Paket</option>
                    @foreach($pricing_plans as $plan)
                        <option value="{{ $plan->id }}" {{ request('plan_id') == $plan->id ? 'selected' : '' }}>
                            {{ $plan->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Status -->
            <div class="lg:col-span-3">
                <select name="status" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all cursor-pointer">
                    <option value="all">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif Valid</option>
                    <option value="expiring_soon" {{ request('status') == 'expiring_soon' ? 'selected' : '' }}>Segera Habis (&lt; 30 Hari)</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Kedaluwarsa (Expired)</option>
                </select>
            </div>

            <!-- Tombol Cari -->
            <div class="lg:col-span-1">
                <button type="submit" 
                        class="w-full bg-[#007A87] hover:bg-[#006570] text-white font-bold py-2 px-3 rounded-xl text-xs flex items-center justify-center gap-1.5 shadow-sm transition-all">
                    <i class="ti ti-search text-xs"></i>
                    <span>Cari</span>
                </button>
            </div>

        </form>
    </div>

    <!-- Info Sub-bar & View Switcher -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-gray-500 font-medium px-1">
        <div>
            Menampilkan <span class="font-bold text-gray-800">{{ $licenses->firstItem() ?? 0 }} – {{ $licenses->lastItem() ?? 0 }}</span> dari <span class="font-bold text-gray-800">{{ $licenses->total() }}</span> lisensi | 
            Aktif: <span class="font-bold text-emerald-600">{{ $stats['active'] }}</span> | 
            Expired: <span class="font-bold text-rose-500">{{ $stats['expired'] }}</span>
        </div>

        <!-- View Switcher [ Kartu List | Tabel ] -->
        <div class="inline-flex p-1 bg-white border border-gray-200 rounded-xl shadow-2xs gap-1">
            <button type="button" 
                    @click="viewMode = 'cards'" 
                    :class="viewMode === 'cards' ? 'bg-gray-100 text-gray-900 font-bold' : 'text-gray-500 hover:text-gray-800'"
                    class="px-3 py-1 rounded-lg text-xs flex items-center gap-1.5 transition-all">
                <i class="ti ti-layout-list text-sm"></i>
                <span>Kartu List</span>
            </button>
            <button type="button" 
                    @click="viewMode = 'table'" 
                    :class="viewMode === 'table' ? 'bg-gray-100 text-gray-900 font-bold' : 'text-gray-500 hover:text-gray-800'"
                    class="px-3 py-1 rounded-lg text-xs flex items-center gap-1.5 transition-all">
                <i class="ti ti-table text-sm"></i>
                <span>Tabel</span>
            </button>
        </div>
    </div>

    <!-- 1. KARTU LIST VIEW (Default Mode) -->
    <div x-show="viewMode === 'cards'" class="space-y-3">
        @forelse($licenses as $index => $license)
            @php
                $isExpired = $license->isExpired();
                $isExpiringSoon = !$isExpired && now()->addDays(30)->isAfter($license->ends_at);
            @endphp
            <div class="card-clean p-4 hover:border-teal-200 transition-all flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                
                <!-- Left Details -->
                <div class="flex items-start sm:items-center gap-3.5 flex-1 min-w-0">
                    
                    <!-- Index Number Badge -->
                    <div class="w-8 h-8 rounded-xl bg-gray-50 border border-gray-200/80 flex items-center justify-center font-bold text-gray-400 text-xs shrink-0">
                        {{ $licenses->firstItem() + $index }}
                    </div>

                    <!-- Avatar -->
                    <div class="relative shrink-0">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-[#005B60] to-[#007A87] text-white flex items-center justify-center font-bold text-base shadow-sm ring-2 ring-white">
                            {{ substr($license->user->name ?? 'U', 0, 1) }}
                        </div>
                        @if(!$isExpired)
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 text-white rounded-full flex items-center justify-center text-[9px] ring-2 ring-white" title="Lisensi Aktif">
                                <i class="ti ti-check"></i>
                            </span>
                        @endif
                    </div>

                    <!-- License Info & Meta -->
                    <div class="min-w-0 flex-1 space-y-1.5">
                        
                        <!-- Top Line: Code & Status Badges -->
                        <div class="flex flex-wrap items-center gap-2">
                            
                            <!-- License Code Badge with Copy button -->
                            <div class="inline-flex items-center gap-1.5 bg-slate-100 hover:bg-slate-200/70 border border-slate-200 px-2.5 py-0.5 rounded-lg transition-all group/code">
                                <i class="ti ti-key text-[#007A87] text-xs"></i>
                                <span class="font-mono font-bold text-xs text-gray-900 tracking-wider">
                                    {{ $license->license_code }}
                                </span>
                                <button type="button" 
                                        onclick="copyLicenseCode('{{ $license->license_code }}', this)" 
                                        class="text-gray-400 hover:text-[#007A87] transition-colors ml-0.5" 
                                        title="Salin Kode Lisensi">
                                    <i class="ti ti-copy text-xs"></i>
                                </button>
                            </div>

                            <!-- Pricing Plan Pill -->
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-teal-50 text-[#007A87] border border-teal-200/60">
                                {{ $license->pricingPlan->name ?? 'Paket' }}
                            </span>

                            @if($license->transaction)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-purple-50 text-purple-600 border border-purple-200/60">
                                    {{ $license->transaction->plan_type === 'yearly' ? 'Tahunan' : 'Bulanan' }}
                                </span>
                            @endif

                            <!-- Status Pill -->
                            @if($isExpired)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-200/80 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>Kedaluwarsa</span>
                                </span>
                            @elseif($isExpiringSoon)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-200/80 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    <span>Segera Habis (&lt; 30 Hari)</span>
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200/80 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Aktif Valid</span>
                                </span>
                            @endif
                        </div>

                        <!-- Sub Line: Meta Details -->
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 font-medium">
                            <!-- Member Owner -->
                            <span class="flex items-center gap-1 text-gray-700 font-semibold">
                                <i class="ti ti-user text-gray-400"></i>
                                <span>{{ $license->user->name ?? 'Pengguna' }}</span>
                                <span class="text-gray-400 font-normal">({{ $license->user->email ?? '-' }})</span>
                            </span>

                            <!-- Validity Period -->
                            <span class="flex items-center gap-1 text-gray-500">
                                <i class="ti ti-calendar-time text-gray-400"></i>
                                <span>Berlaku: <strong class="text-gray-700">{{ $license->starts_at->format('d/m/Y') }} – {{ $license->ends_at->format('d/m/Y') }}</strong></span>
                                <span class="text-[11px] {{ $isExpired ? 'text-rose-500 font-bold' : ($isExpiringSoon ? 'text-amber-600 font-bold' : 'text-gray-400') }}">
                                    ({{ $license->ends_at->diffForHumans() }})
                                </span>
                            </span>

                            <!-- Linked App URL -->
                            @if($license->app_url)
                                <a href="{{ $license->app_url }}" target="_blank" class="inline-flex items-center gap-1 text-[#007A87] hover:underline font-semibold text-[11px]">
                                    <i class="ti ti-world"></i>
                                    <span>{{ \Illuminate\Support\Str::limit(str_replace(['http://', 'https://'], '', $license->app_url), 26) }}</span>
                                </a>
                                <span class="px-1.5 py-0.2 rounded text-[9.5px] font-bold uppercase 
                                    {{ $license->app_status === 'running' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : ($license->app_status === 'pending' ? 'bg-amber-50 text-amber-600 border border-amber-200' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $license->app_status }}
                                </span>
                            @else
                                <span class="text-gray-400 text-[11px] flex items-center gap-1">
                                    <i class="ti ti-unlink text-gray-300"></i>
                                    <span>App belum diatur</span>
                                </span>
                            @endif
                        </div>

                    </div>
                </div>

                <!-- Right Action Buttons -->
                <div class="flex items-center gap-2 shrink-0 justify-end pt-2 lg:pt-0 border-t lg:border-t-0 border-gray-100">
                    
                    <!-- Copy Button -->
                    <button type="button" 
                            onclick="copyLicenseCode('{{ $license->license_code }}', this)" 
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 text-xs font-semibold shadow-2xs transition-all"
                            title="Salin Kode Lisensi">
                        <i class="ti ti-copy text-sm text-gray-500"></i>
                        <span>Salin Kode</span>
                    </button>

                    <!-- Link to Transaction Detail (if exists) -->
                    @if($license->transaction_id || $license->transaction)
                        <a href="{{ route('admin.memberships.show', $license->transaction_id ?? $license->transaction->id) }}" 
                           class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-xs font-semibold shadow-2xs transition-all"
                           title="Lihat Detail Transaksi">
                            <i class="ti ti-receipt text-sm text-teal-600"></i>
                            <span>Transaksi</span>
                        </a>
                    @endif

                    <!-- Visit App Button -->
                    @if($license->app_url)
                        <a href="{{ $license->app_url }}" target="_blank" 
                           class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all"
                           title="Buka Aplikasi Member">
                            <i class="ti ti-external-link text-sm"></i>
                            <span>Buka App</span>
                        </a>
                    @endif

                </div>

            </div>
        @empty
            <div class="card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto text-gray-400 text-3xl mb-3">
                    <i class="ti ti-key-off"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Tidak ada data lisensi yang ditemukan</h4>
                <p class="text-xs text-gray-400 mt-1">Coba sesuaikan kata kunci pencarian atau filter status lisensi.</p>
            </div>
        @endforelse
    </div>

    <!-- 2. TABEL VIEW (Tabular Mode) -->
    <div x-show="viewMode === 'table'" x-cloak class="card-clean overflow-hidden">
        <div class="overflow-x-auto custom-scroll">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-gray-50/70 text-gray-400 text-[10px] font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4">Kode Lisensi</th>
                        <th class="py-3 px-4">Informasi Pelanggan</th>
                        <th class="py-3 px-4">Paket & Durasi</th>
                        <th class="py-3 px-4">URL Aplikasi & Status</th>
                        <th class="py-3 px-4 text-center">Status Lisensi</th>
                        <th class="py-3 px-4">Masa Berlaku</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium">
                    @forelse($licenses as $index => $license)
                        @php
                            $isExpired = $license->isExpired();
                            $isExpiringSoon = !$isExpired && now()->addDays(30)->isAfter($license->ends_at);
                        @endphp
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="py-3 px-4 text-center font-bold text-gray-400">
                                {{ $licenses->firstItem() + $index }}
                            </td>
                            
                            <!-- Kode Lisensi -->
                            <td class="py-3 px-4">
                                <div class="inline-flex items-center gap-1.5 font-mono font-bold text-xs text-gray-900 bg-slate-100 px-2 py-0.5 rounded border border-slate-200">
                                    <span>{{ $license->license_code }}</span>
                                    <button type="button" 
                                            onclick="copyLicenseCode('{{ $license->license_code }}', this)" 
                                            class="text-gray-400 hover:text-[#007A87]" 
                                            title="Salin">
                                        <i class="ti ti-copy text-xs"></i>
                                    </button>
                                </div>
                            </td>

                            <!-- Informasi Pelanggan -->
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] font-bold flex items-center justify-center text-xs">
                                        {{ substr($license->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 leading-tight">{{ $license->user->name ?? '-' }}</p>
                                        <p class="text-[11px] text-gray-400">{{ $license->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Paket -->
                            <td class="py-3 px-4">
                                <span class="font-bold text-gray-800">{{ $license->pricingPlan->name ?? 'Paket' }}</span>
                                @if($license->transaction)
                                    <span class="text-[10px] text-gray-400 block uppercase font-semibold">
                                        {{ $license->transaction->plan_type === 'yearly' ? 'Tahunan' : 'Bulanan' }}
                                    </span>
                                @endif
                            </td>

                            <!-- Aplikasi & Status -->
                            <td class="py-3 px-4">
                                @if($license->app_url)
                                    <a href="{{ $license->app_url }}" target="_blank" class="text-[#007A87] font-semibold hover:underline flex items-center gap-1 text-[11px]">
                                        <i class="ti ti-world text-xs"></i>
                                        <span>{{ \Illuminate\Support\Str::limit(str_replace(['http://', 'https://'], '', $license->app_url), 20) }}</span>
                                    </a>
                                    <span class="text-[10px] text-gray-400 font-semibold block uppercase">
                                        Status: {{ $license->app_status }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-[11px] italic">Belum diatur</span>
                                @endif
                            </td>

                            <!-- Status Lisensi -->
                            <td class="py-3 px-4 text-center">
                                @if($isExpired)
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-200">
                                        Expired
                                    </span>
                                @elseif($isExpiringSoon)
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-200">
                                        &lt; 30 Hari
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                        Aktif
                                    </span>
                                @endif
                            </td>

                            <!-- Masa Berlaku -->
                            <td class="py-3 px-4">
                                <span class="text-gray-800 font-semibold text-[11px] block">
                                    s/d {{ $license->ends_at->format('d M Y') }}
                                </span>
                                <span class="text-[10px] {{ $isExpired ? 'text-rose-500 font-bold' : ($isExpiringSoon ? 'text-amber-600 font-bold' : 'text-gray-400') }}">
                                    {{ $license->ends_at->diffForHumans() }}
                                </span>
                            </td>

                            <!-- Aksi -->
                            <td class="py-3 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if($license->transaction_id || $license->transaction)
                                        <a href="{{ route('admin.memberships.show', $license->transaction_id ?? $license->transaction->id) }}" 
                                           class="p-1.5 rounded-lg bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200 text-xs transition-all"
                                           title="Lihat Detail Transaksi">
                                            <i class="ti ti-receipt text-sm text-[#007A87]"></i>
                                        </a>
                                    @endif

                                    @if($license->app_url)
                                        <a href="{{ $license->app_url }}" target="_blank"
                                           class="p-1.5 rounded-lg bg-teal-50 text-[#007A87] hover:bg-[#007A87] hover:text-white border border-teal-200 text-xs transition-all"
                                           title="Buka Aplikasi Member">
                                            <i class="ti ti-external-link text-sm"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-gray-400">
                                Belum ada data lisensi yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($licenses->hasPages())
        <div class="pt-2">
            {{ $licenses->links() }}
        </div>
    @endif

</div>

{{-- Copy to clipboard script --}}
@push('scripts')
<script>
    function copyLicenseCode(text, buttonEl) {
        if (!navigator.clipboard) {
            const input = document.createElement('textarea');
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            showCopiedFeedback(buttonEl);
            return;
        }

        navigator.clipboard.writeText(text).then(() => {
            showCopiedFeedback(buttonEl);
        }).catch(err => {
            console.error('Gagal menyalin kode: ', err);
        });
    }

    function showCopiedFeedback(buttonEl) {
        if (!buttonEl) return;
        const originalContent = buttonEl.innerHTML;
        buttonEl.innerHTML = '<i class="ti ti-check text-xs text-emerald-600"></i>';
        setTimeout(() => {
            buttonEl.innerHTML = originalContent;
        }, 1500);
    }
</script>
@endpush
@endsection
