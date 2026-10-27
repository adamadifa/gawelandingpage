@extends('layouts.admin')

@section('title', 'Data Pelanggan & Member')
@section('subtitle', 'Manajemen data member, paket langganan, riwayat pembayaran, status lisensi, dan akun akses sistem.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span>Master Data</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Pelanggan & Member</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Kelola Paket -->
    <a href="{{ route('admin.pricing-plans.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-tag text-[#007A87] text-sm"></i>
        <span>Kelola Paket</span>
    </a>

    <!-- Data Lisensi -->
    <a href="{{ route('admin.licenses.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-teal-700/20 transition-all">
        <i class="ti ti-key text-sm"></i>
        <span>Data Lisensi</span>
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
            
            <!-- Col 1: Total Transaksi -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:pr-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-teal-100/90">Total Transaksi</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Semua</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['total'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Semua Pengajuan</span>
                    <span>100%</span>
                </div>
            </div>

            <!-- Col 2: Transaksi Disetujui -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-teal-100/90">Disetujui</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Aktif</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['approved'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Lisensi Aktif</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['approved'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 3: Menunggu Verifikasi -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-teal-100/90">Menunggu Verifikasi</span>
                    <span class="px-2 py-0.5 rounded-md bg-amber-400/25 text-amber-200 text-[10px] font-bold">Pending</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['pending'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Perlu Approval</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['pending'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 4: Paket Bulanan -->
            <div class="border-b md:border-b-0 md:border-r border-white/15 pb-4 md:pb-0 md:px-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-teal-100/90">Paket Bulanan</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Bulanan</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['monthly'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Durasi Bulanan</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['monthly'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

            <!-- Col 5: Paket Tahunan -->
            <div class="md:pl-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-teal-100/90">Paket Tahunan</span>
                    <span class="px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] font-bold">Tahunan</span>
                </div>
                <div class="mt-2">
                    <h3 class="text-3xl font-black tracking-tight leading-none text-white">{{ $stats['yearly'] }}</h3>
                </div>
                <div class="flex items-center justify-between text-[11px] text-teal-100/70 mt-3 font-semibold">
                    <span>Durasi Tahunan</span>
                    <span>{{ $stats['total'] > 0 ? round(($stats['yearly'] / $stats['total']) * 100) : 0 }}%</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Filter & Search Toolbar Card -->
    <div class="card-clean p-4">
        <form method="GET" action="{{ route('admin.memberships.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center">
            
            <!-- Search Bar -->
            <div class="lg:col-span-5 relative">
                <i class="ti ti-search text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 text-base"></i>
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}" 
                       placeholder="Cari Nama Member / Email / No. Transaksi..." 
                       class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 pl-10 pr-4 text-xs font-medium text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all">
            </div>

            <!-- Filter Paket -->
            <div class="lg:col-span-2">
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
            <div class="lg:col-span-2">
                <select name="status" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all cursor-pointer">
                    <option value="all">Semua Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Aktif / Approved</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Approval</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak / Expired</option>
                </select>
            </div>

            <!-- Sort By -->
            <div class="lg:col-span-2">
                <select name="sort" 
                        onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl py-2 px-3 text-xs font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#007A87]/20 focus:border-[#007A87] transition-all cursor-pointer">
                    <option value="latest">Urut: Terbaru</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Urut: Nama</option>
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
            Menampilkan <span class="font-bold text-gray-800">{{ $transactions->firstItem() ?? 0 }} – {{ $transactions->lastItem() ?? 0 }}</span> dari <span class="font-bold text-gray-800">{{ $transactions->total() }}</span> member | 
            Aktif: <span class="font-bold text-emerald-600">{{ $stats['approved'] }}</span> | 
            Pending: <span class="font-bold text-amber-500">{{ $stats['pending'] }}</span>
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

    <!-- 1. KARTU LIST VIEW (Clean & Authentic to Database) -->
    <div x-show="viewMode === 'cards'" class="space-y-3">
        @forelse($transactions as $index => $trx)
            <div class="card-clean p-4 hover:border-teal-200 transition-all flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                
                <!-- Left Details -->
                <div class="flex items-start sm:items-center gap-3.5 flex-1 min-w-0">
                    
                    <!-- Index Number Badge -->
                    <div class="w-8 h-8 rounded-xl bg-gray-50 border border-gray-200/80 flex items-center justify-center font-bold text-gray-400 text-xs shrink-0">
                        {{ $transactions->firstItem() + $index }}
                    </div>

                    <!-- Avatar -->
                    <div class="relative shrink-0">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-[#005B60] to-[#007A87] text-white flex items-center justify-center font-bold text-base shadow-sm ring-2 ring-white">
                            {{ substr($trx->user->name, 0, 1) }}
                        </div>
                        @if($trx->status === 'approved')
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 text-white rounded-full flex items-center justify-center text-[9px] ring-2 ring-white" title="Transaksi Disetujui">
                                <i class="ti ti-check"></i>
                            </span>
                        @endif
                    </div>

                    <!-- Member Info & Meta -->
                    <div class="min-w-0 flex-1 space-y-1.5">
                        
                        <!-- Top Line: Name & Badge Tags -->
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('admin.memberships.show', $trx->id) }}" class="font-bold text-sm text-[#0F172A] hover:text-[#007A87] transition-colors leading-none truncate">
                                {{ $trx->user->name }}
                            </a>

                            <!-- Transaction / Invoice ID Pill -->
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200 font-mono">
                                #TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}
                            </span>

                            <!-- Pricing Plan Pill -->
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-teal-50 text-[#007A87] border border-teal-200/60">
                                {{ $trx->pricingPlan->name ?? 'Paket' }}
                            </span>

                            <!-- Plan Duration Pill -->
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-purple-50 text-purple-600 border border-purple-200/60">
                                {{ $trx->plan_type === 'yearly' ? 'Tahunan' : 'Bulanan' }}
                            </span>

                            <!-- Transaction Status Pill -->
                            @if($trx->status === 'approved')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200/80 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>Disetujui</span>
                                </span>
                            @elseif($trx->status === 'pending')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-200/80 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    <span>Menunggu Verifikasi</span>
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-rose-50 text-rose-600 border border-rose-200/80 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    <span>Ditolak</span>
                                </span>
                            @endif
                        </div>

                        <!-- Sub Line: Meta Details from Database -->
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 font-medium">
                            <!-- Email -->
                            <span class="flex items-center gap-1 text-gray-400">
                                <i class="ti ti-mail text-gray-400"></i>
                                <span class="text-gray-700 font-medium">{{ $trx->user->email }}</span>
                            </span>

                            <!-- Amount Tag -->
                            <span class="inline-flex items-center gap-1 bg-amber-50/80 border border-amber-200 px-2 py-0.5 rounded text-[11px] font-bold text-amber-800">
                                <i class="ti ti-cash text-xs text-amber-600"></i>
                                <span>Rp {{ number_format($trx->amount) }}</span>
                            </span>

                            <!-- Submit Date -->
                            <span class="flex items-center gap-1 text-gray-500">
                                <i class="ti ti-calendar text-gray-400"></i>
                                <span>Masuk: <strong class="text-gray-700">{{ $trx->created_at->format('d/m/Y H:i') }}</strong></span>
                            </span>

                            <!-- Linked License (If subscription exists) -->
                            @if($trx->subscription && $trx->subscription->license_code)
                                <span class="flex items-center gap-1 text-teal-800 bg-teal-50 border border-teal-200 px-2 py-0.5 rounded text-[11px] font-semibold">
                                    <i class="ti ti-key text-xs text-[#007A87]"></i>
                                    <span>Lisensi: <strong class="font-mono">{{ $trx->subscription->license_code }}</strong></span>
                                    @if($trx->subscription->ends_at)
                                        <span class="text-gray-400 font-normal">· Exp: {{ $trx->subscription->ends_at->format('d/m/Y') }}</span>
                                    @endif
                                </span>
                            @endif
                        </div>

                    </div>
                </div>

                <!-- Right Action Buttons (Real & Functional) -->
                <div class="flex items-center gap-2 shrink-0 justify-end pt-2 lg:pt-0 border-t lg:border-t-0 border-gray-100">
                    
                    <!-- Bukti Transfer Button -->
                    @if($trx->payment_proof)
                        <a href="{{ asset('storage/' . $trx->payment_proof) }}" target="_blank"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-800 text-xs font-semibold shadow-2xs transition-all"
                           title="Buka Struk / Bukti Pembayaran">
                            <i class="ti ti-receipt text-sm text-amber-600"></i>
                            <span>Bukti Bayar</span>
                        </a>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-gray-50 text-gray-400 text-xs font-medium border border-gray-200/60" 
                              title="Tidak ada lampiran bukti transfer">
                            <i class="ti ti-receipt-off text-sm"></i>
                            <span>Tanpa Bukti</span>
                        </span>
                    @endif

                    <!-- Verifikasi / Detail Button -->
                    @if($trx->status === 'pending')
                        <a href="{{ route('admin.memberships.show', $trx->id) }}" 
                           class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                            <i class="ti ti-list-check text-sm"></i>
                            <span>Verifikasi</span>
                        </a>
                    @else
                        <a href="{{ route('admin.memberships.show', $trx->id) }}" 
                           class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold transition-all">
                            <i class="ti ti-eye text-sm"></i>
                            <span>Detail</span>
                        </a>
                    @endif

                </div>

            </div>
        @empty
            <div class="card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto text-gray-400 text-3xl mb-3">
                    <i class="ti ti-receipt-off"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Tidak ada data transaksi yang ditemukan</h4>
                <p class="text-xs text-gray-400 mt-1">Coba sesuaikan kata kunci pencarian atau filter status Anda.</p>
            </div>
        @endforelse
    </div>

    <!-- 2. TABEL VIEW (Alternative Tabular View) -->
    <div x-show="viewMode === 'table'" x-cloak class="card-clean overflow-hidden">
        <div class="overflow-x-auto custom-scroll">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-gray-50/70 text-gray-400 text-[10px] font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="py-3 px-4 text-center">No</th>
                        <th class="py-3 px-4">Informasi Pelanggan</th>
                        <th class="py-3 px-4">Paket & Durasi</th>
                        <th class="py-3 px-4">Total Bayar</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4">Waktu Daftar</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 font-medium">
                    @forelse($transactions as $index => $trx)
                        <tr class="hover:bg-gray-50/60 transition-colors">
                            <td class="py-3 px-4 text-center font-bold text-gray-400">
                                {{ $transactions->firstItem() + $index }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] font-bold flex items-center justify-center text-xs">
                                        {{ substr($trx->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-1.5">
                                            <p class="font-bold text-gray-900 leading-tight">{{ $trx->user->name }}</p>
                                            <span class="text-[10px] text-gray-400 font-mono">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                        <p class="text-[11px] text-gray-400">{{ $trx->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-gray-800">{{ $trx->pricingPlan->name ?? 'Paket' }}</span>
                                <span class="text-[10px] text-gray-400 block uppercase">{{ $trx->plan_type === 'yearly' ? 'Tahunan' : 'Bulanan' }}</span>
                            </td>
                            <td class="py-3 px-4 font-bold text-gray-900">
                                Rp {{ number_format($trx->amount) }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if($trx->status === 'approved')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">
                                        Disetujui
                                    </span>
                                @elseif($trx->status === 'pending')
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-200">
                                        Menunggu Verifikasi
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-200">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-gray-500 text-[11px]">
                                {{ $trx->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="py-3 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if($trx->payment_proof)
                                        <a href="{{ asset('storage/' . $trx->payment_proof) }}" target="_blank"
                                           class="p-1.5 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200 text-xs transition-all"
                                           title="Lihat Bukti Bayar">
                                            <i class="ti ti-receipt text-sm"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.memberships.show', $trx->id) }}" 
                                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg {{ $trx->status === 'pending' ? 'bg-[#007A87] text-white hover:bg-[#006570]' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} font-bold text-[11px] transition-all">
                                        <span>{{ $trx->status === 'pending' ? 'Verifikasi' : 'Detail' }}</span>
                                        <i class="ti ti-chevron-right text-[10px]"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400">
                                Belum ada data member.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($transactions->hasPages())
        <div class="pt-2">
            {{ $transactions->links() }}
        </div>
    @endif

</div>
@endsection
