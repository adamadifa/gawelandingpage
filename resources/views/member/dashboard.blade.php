@extends('layouts.member')

@section('title', 'Dashboard Member')
@section('subtitle', 'Pantau lisensi aktif aplikasi, status sistem operasional, dan histori transaksi pembayaran Anda.')

@section('actions')
<div class="flex items-center gap-2 w-full sm:w-auto">
    <a href="{{ route('member.source-code') }}" 
       class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-3 sm:px-3.5 py-1.5 sm:py-2 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-semibold shadow-2xs transition-all">
        <i class="ti ti-code text-[#007A87] text-sm"></i>
        <span>Akses Source Code</span>
    </a>

    <a href="{{ route('landing') }}#pricing" 
       class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-3 sm:px-4 py-1.5 sm:py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-semibold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Beli Lisensi</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-5 sm:space-y-6" x-data="{ 
    openDetail: false, 
    selectedTrx: null,
    copiedKey: null,
    copyCode(code) {
        navigator.clipboard.writeText(code);
        this.copiedKey = code;
        setTimeout(() => this.copiedKey = null, 2500);
    }
}">

    <!-- Welcome Greeting (Tanpa Card) -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 sm:gap-3 pt-0.5">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-gray-900 tracking-tight">
                Selamat datang kembali, {{ auth()->user()->name }}
            </h2>
            <p class="text-xs text-gray-500 mt-0.5 font-normal">
                Kelola lisensi aktif aplikasi, pantau status server, dan unduh pembaruan source code Anda di sini.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2 shrink-0">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-teal-50 border border-teal-200/70 text-[#007A87] text-[11px] sm:text-xs font-medium">
                <i class="ti ti-check text-xs"></i>
                <span>{{ $activeCount }} lisensi aktif</span>
            </span>

            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white border border-gray-200 text-gray-600 text-[11px] sm:text-xs font-medium shadow-2xs">
                <i class="ti ti-calendar text-xs text-gray-400"></i>
                <span>Member sejak {{ auth()->user()->created_at->format('M Y') }}</span>
            </span>
        </div>
    </div>

    <!-- Stats Banner (Konsisten dengan Pelanggan & Member) -->
    <div class="rounded-2xl p-3.5 sm:p-6 bg-gradient-to-r from-[#005B60] via-[#006D75] to-[#007A87] text-white shadow-sm border border-teal-800/30 relative overflow-hidden">
        <!-- Subtle Pattern Backdrop -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.08),transparent_50%)] pointer-events-none"></div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-4 relative z-10">
            
            <!-- Col 1: Total Investasi -->
            <div class="p-3 sm:p-0 rounded-xl sm:rounded-none bg-white/10 sm:bg-transparent border border-white/10 sm:border-0 sm:border-r sm:border-white/15 sm:pr-4 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-1">
                    <span class="text-[11px] sm:text-xs font-semibold text-teal-100/90 truncate">Total Investasi</span>
                    <span class="hidden xs:inline-block px-1.5 sm:px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] sm:text-[11px] font-semibold shrink-0">Tersimpan</span>
                </div>
                <div class="my-1.5 sm:my-2.5">
                    <h3 class="text-base sm:text-2xl lg:text-3xl font-black tracking-tight leading-none text-white truncate">
                        Rp {{ number_format($totalSpent) }}
                    </h3>
                </div>
                <div class="flex items-center justify-between text-[10px] sm:text-[11.5px] text-teal-100/70 font-medium">
                    <span class="truncate">{{ $transactions->where('status', 'approved')->count() }} transaksi</span>
                    <span class="text-emerald-300 font-semibold flex items-center gap-1 shrink-0">
                        <i class="ti ti-circle-check text-xs"></i> <span class="hidden sm:inline">Terverifikasi</span>
                    </span>
                </div>
            </div>

            <!-- Col 2: Lisensi Aktif -->
            <div class="p-3 sm:p-0 rounded-xl sm:rounded-none bg-white/10 sm:bg-transparent border border-white/10 sm:border-0 lg:border-r sm:border-white/15 sm:px-4 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-1">
                    <span class="text-[11px] sm:text-xs font-semibold text-teal-100/90 truncate">Lisensi Aktif</span>
                    <span class="hidden xs:inline-block px-1.5 sm:px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] sm:text-[11px] font-semibold shrink-0">Unit</span>
                </div>
                <div class="my-1.5 sm:my-2.5">
                    <h3 class="text-base sm:text-2xl lg:text-3xl font-black tracking-tight leading-none text-white">
                        {{ $activeCount }} <span class="text-xs font-normal text-teal-200/80 ml-0.5">unit</span>
                    </h3>
                </div>
                <div class="flex items-center justify-between text-[10px] sm:text-[11.5px] text-teal-100/70 font-medium">
                    <span class="truncate">{{ $subscriptions->where('app_status', 'running')->count() }} online</span>
                    <a href="#active-licenses" class="text-teal-200 hover:text-white font-semibold flex items-center gap-0.5 transition-colors shrink-0">
                        <span>Lihat</span>
                        <i class="ti ti-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Col 3: Riwayat Pembayaran -->
            <div class="p-3 sm:p-0 rounded-xl sm:rounded-none bg-white/10 sm:bg-transparent border border-white/10 sm:border-0 sm:border-r sm:border-white/15 sm:px-4 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-1">
                    <span class="text-[11px] sm:text-xs font-semibold text-teal-100/90 truncate">Riwayat Bayar</span>
                    <span class="hidden xs:inline-block px-1.5 sm:px-2 py-0.5 rounded-md bg-white/15 text-white text-[10px] sm:text-[11px] font-semibold shrink-0">Pesanan</span>
                </div>
                <div class="my-1.5 sm:my-2.5">
                    <h3 class="text-base sm:text-2xl lg:text-3xl font-black tracking-tight leading-none text-white">
                        {{ $transactions->total() }} <span class="text-xs font-normal text-teal-200/80 ml-0.5">trx</span>
                    </h3>
                </div>
                <div class="flex items-center justify-between text-[10px] sm:text-[11.5px] text-teal-100/70 font-medium">
                    <span class="truncate">Semua tagihan</span>
                    <a href="#transaction-history" class="text-teal-200 hover:text-white font-semibold flex items-center gap-0.5 transition-colors shrink-0">
                        <span>Detail</span>
                        <i class="ti ti-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- Col 4: Status Keanggotaan -->
            <div class="p-3 sm:p-0 rounded-xl sm:rounded-none bg-white/10 sm:bg-transparent border border-white/10 sm:border-0 sm:pl-4 flex flex-col justify-between">
                <div class="flex items-center justify-between gap-1">
                    <span class="text-[11px] sm:text-xs font-semibold text-teal-100/90 truncate">Status Member</span>
                    <span class="px-1.5 sm:px-2 py-0.5 rounded-md bg-emerald-400/25 text-emerald-200 text-[10px] sm:text-[11px] font-semibold shrink-0">Aktif</span>
                </div>
                <div class="my-1.5 sm:my-2.5">
                    <h3 class="text-sm sm:text-lg lg:text-xl font-bold tracking-tight leading-none text-white truncate">
                        {{ auth()->user()->isAdmin() ? 'Super Admin' : 'Terverifikasi' }}
                    </h3>
                </div>
                <div class="flex items-center justify-between text-[10px] sm:text-[11.5px] text-teal-100/70 font-medium">
                    <span class="truncate">Akun valid & aktif</span>
                    <span class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></span>
                </div>
            </div>

        </div>
    </div>

    <!-- 2-Column Layout (Left 8 Cols, Right 4 Cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Active Subscriptions & Transaction History (8 Cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Section: Layanan & Lisensi Aktif -->
            <div id="active-licenses" class="space-y-3.5">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">
                            Layanan & Lisensi Aktif ({{ $subscriptions->count() }})
                        </h3>
                    </div>

                    <a href="{{ route('landing') }}#pricing" class="text-xs font-semibold text-[#007A87] hover:underline flex items-center gap-1">
                        <span>Beli lisensi baru</span>
                        <i class="ti ti-chevron-right text-[11px]"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($subscriptions as $sub)
                        <div class="bg-white border border-[#E2E8F0] rounded-2xl p-5 space-y-4 shadow-2xs hover:border-gray-300 transition-all">
                            
                            <!-- Header: Plan Name & Badge -->
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] border border-teal-100 flex items-center justify-center font-bold text-lg shrink-0">
                                        @if($sub->pricingPlan->icon_type == 'image' && $sub->pricingPlan->icon)
                                            <img src="{{ asset('storage/' . $sub->pricingPlan->icon) }}" class="w-6 h-6 object-contain">
                                        @else
                                            <i class="ti ti-crown"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900 leading-tight">{{ $sub->pricingPlan->name }}</h4>
                                        <span class="text-xs text-gray-500 font-normal block mt-0.5">
                                            Berlaku s/d {{ \Carbon\Carbon::parse($sub->ends_at)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>

                                <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-semibold border border-emerald-200 shrink-0">
                                    Aktif
                                </span>
                            </div>

                            <!-- System Status Bar -->
                            <div class="p-2.5 rounded-xl bg-[#F8FAFC] border border-gray-100 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ $sub->app_status == 'running' ? 'bg-emerald-500 animate-pulse' : ($sub->app_status == 'maintenance' ? 'bg-amber-500' : 'bg-slate-300') }}"></span>
                                    <span class="text-xs font-medium text-gray-700">
                                        Status: {{ $sub->app_status == 'running' ? 'Running online' : ($sub->app_status == 'maintenance' ? 'Dalam pemeliharaan' : 'Offline / Setup') }}
                                    </span>
                                </div>
                                
                                @if($sub->app_status == 'running' && $sub->app_url)
                                    <a href="{{ $sub->app_url }}" target="_blank" class="text-xs font-semibold text-[#007A87] hover:underline flex items-center gap-1">
                                        <span>Buka app</span>
                                        <i class="ti ti-external-link text-[11px]"></i>
                                    </a>
                                @endif
                            </div>

                            <!-- License Code with 1-Click Copy -->
                            <div class="p-2.5 rounded-xl bg-gray-50 border border-gray-200/80 flex items-center justify-between">
                                <div class="overflow-hidden min-w-0 pr-2">
                                    <span class="text-[10.5px] font-medium text-gray-400 block mb-0.5">Kode Lisensi Unit</span>
                                    <span class="text-xs font-mono font-bold text-gray-800 tracking-wider truncate block">{{ $sub->license_code }}</span>
                                </div>
                                <button type="button" 
                                        @click="copyCode('{{ $sub->license_code }}')" 
                                        class="px-2.5 py-1 rounded-lg bg-white border border-gray-200 hover:border-[#007A87] hover:text-[#007A87] text-gray-600 text-xs font-semibold transition-all cursor-pointer shrink-0">
                                    <i :class="copiedKey === '{{ $sub->license_code }}' ? 'ti ti-check text-emerald-600' : 'ti ti-copy'"></i>
                                    <span x-text="copiedKey === '{{ $sub->license_code }}' ? 'Disalin' : 'Salin'"></span>
                                </button>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-2 pt-1 border-t border-gray-100">
                                <a href="{{ route('checkout.index', $sub->pricing_plan_id) }}?subscription_id={{ $sub->id }}" 
                                   class="py-2 px-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs text-center transition-colors">
                                    Perpanjang
                                </a>

                                @if($sub->app_status == 'running' && $sub->app_url)
                                    <a href="{{ $sub->app_url }}" 
                                       target="_blank" 
                                       class="py-2 px-3 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white font-semibold text-xs text-center transition-colors shadow-2xs">
                                        Buka Sistem
                                    </a>
                                @else
                                    <button disabled 
                                            class="py-2 px-3 rounded-xl bg-gray-100 text-gray-400 font-semibold text-xs text-center cursor-not-allowed">
                                        Belum Aktif
                                    </button>
                                @endif
                            </div>

                        </div>
                    @empty
                        <div class="sm:col-span-2 bg-white border border-[#E2E8F0] rounded-2xl p-8 text-center space-y-4 shadow-2xs">
                            <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center mx-auto text-2xl">
                                <i class="ti ti-id-badge-off"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800">Belum Ada Lisensi Berlangganan</h4>
                                <p class="text-xs text-gray-500 mt-1 max-w-sm mx-auto leading-relaxed font-normal">
                                    Dapatkan lisensi aplikasi absensi GPS & payroll untuk bisnis Anda dengan memilih paket yang sesuai.
                                </p>
                            </div>
                            <a href="{{ route('landing') }}#pricing" 
                               class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-semibold transition-all shadow-xs">
                                <i class="ti ti-shopping-cart text-sm"></i>
                                <span>Pilih Paket Langganan</span>
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Section: Riwayat Transaksi Pembayaran -->
            <div id="transaction-history" class="space-y-3.5">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">
                            Riwayat Pembayaran
                        </h3>
                    </div>
                    <span class="text-xs text-gray-400 font-normal">Daftar invoice dan mutasi pesanan</span>
                </div>

                <!-- Mobile Card List View (Phones) -->
                <div class="sm:hidden space-y-3">
                    @forelse($transactions as $trx)
                        <div class="p-3.5 rounded-2xl bg-white border border-[#E2E8F0] shadow-2xs space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <div class="w-8 h-8 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center font-bold text-sm shrink-0">
                                        <i class="ti ti-crown"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="font-bold text-xs text-gray-900 block leading-tight truncate">{{ $trx->pricingPlan->name ?? 'Paket Bisnis' }}</span>
                                        <span class="text-[10.5px] text-gray-400 block capitalize">{{ $trx->plan_type }} plan</span>
                                    </div>
                                </div>

                                <div>
                                    @if($trx->status == 'approved')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10.5px] font-semibold border border-emerald-200 shrink-0">
                                            <i class="ti ti-check text-xs"></i> Berhasil
                                        </span>
                                    @elseif($trx->status == 'pending')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 text-[10.5px] font-semibold border border-amber-200 shrink-0">
                                            <i class="ti ti-clock text-xs"></i> Menunggu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-rose-50 text-rose-700 text-[10.5px] font-semibold border border-rose-200 shrink-0">
                                            <i class="ti ti-x text-xs"></i> Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="pt-2 border-t border-gray-100 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-1 text-[11px] text-gray-500">
                                    <i class="ti ti-calendar text-xs text-gray-400"></i>
                                    <span>{{ $trx->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div class="font-bold text-gray-900 font-mono text-xs">
                                    Rp {{ number_format($trx->amount) }}
                                </div>
                            </div>

                            <button type="button" 
                                    @click="selectedTrx = {{ json_encode([
                                        'id' => $trx->id,
                                        'plan_name' => $trx->pricingPlan->name ?? 'Paket Bisnis',
                                        'amount' => number_format($trx->amount),
                                        'status' => $trx->status,
                                        'plan_type' => $trx->plan_type,
                                        'date' => $trx->created_at->format('d M Y, H:i'),
                                        'payment_proof' => $trx->payment_proof ? asset('storage/' . $trx->payment_proof) : null,
                                        'admin_note' => $trx->admin_note,
                                    ]) }}; openDetail = true;"
                                    class="w-full py-2 px-3 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-700 font-semibold text-xs flex items-center justify-center gap-1.5 transition-colors cursor-pointer border border-gray-200/80">
                                <i class="ti ti-eye text-sm text-gray-500"></i>
                                <span>Lihat Rincian Transaksi</span>
                            </button>
                        </div>
                    @empty
                        <div class="bg-white border border-[#E2E8F0] rounded-2xl p-6 text-center text-gray-400">
                            <i class="ti ti-inbox text-2xl mb-1 block"></i>
                            <span class="text-xs">Belum ada riwayat transaksi pembayaran.</span>
                        </div>
                    @endforelse

                    @if($transactions->hasPages())
                        <div class="p-3 bg-white rounded-2xl border border-gray-100">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>

                <!-- Desktop / Tablet Table View -->
                <div class="hidden sm:block bg-white border border-[#E2E8F0] rounded-2xl overflow-hidden shadow-2xs">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-[#F8FAFC] border-b border-gray-200 text-xs font-semibold text-gray-600">
                                    <th class="py-3 px-4">Layanan & Paket</th>
                                    <th class="py-3 px-4">Tanggal</th>
                                    <th class="py-3 px-4">Total Tagihan</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($transactions as $trx)
                                    <tr class="hover:bg-gray-50/70 transition-colors">
                                        <td class="py-3.5 px-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center font-bold text-sm shrink-0">
                                                    <i class="ti ti-crown"></i>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-gray-900 block leading-tight">{{ $trx->pricingPlan->name ?? 'Paket Bisnis' }}</span>
                                                    <span class="text-[11px] text-gray-400 block capitalize">{{ $trx->plan_type }} plan</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-600 font-normal">
                                            {{ $trx->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="py-3.5 px-4 font-bold text-gray-900 font-mono">
                                            Rp {{ number_format($trx->amount) }}
                                        </td>
                                        <td class="py-3.5 px-4">
                                            @if($trx->status == 'approved')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-medium border border-emerald-200">
                                                    <i class="ti ti-check text-xs"></i> Berhasil
                                                </span>
                                            @elseif($trx->status == 'pending')
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-700 text-xs font-medium border border-amber-200">
                                                    <i class="ti ti-clock text-xs"></i> Menunggu
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-700 text-xs font-medium border border-rose-200">
                                                    <i class="ti ti-x text-xs"></i> Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-4 text-right">
                                            <button type="button" 
                                                    @click="selectedTrx = {{ json_encode([
                                                        'id' => $trx->id,
                                                        'plan_name' => $trx->pricingPlan->name ?? 'Paket Bisnis',
                                                        'amount' => number_format($trx->amount),
                                                        'status' => $trx->status,
                                                        'plan_type' => $trx->plan_type,
                                                        'date' => $trx->created_at->format('d M Y, H:i'),
                                                        'payment_proof' => $trx->payment_proof ? asset('storage/' . $trx->payment_proof) : null,
                                                        'admin_note' => $trx->admin_note,
                                                    ]) }}; openDetail = true;"
                                                    class="p-1.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 text-xs font-semibold transition-colors cursor-pointer"
                                                    title="Lihat Detail Transaksi">
                                                <i class="ti ti-eye text-sm"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-400">
                                            <i class="ti ti-inbox text-2xl mb-1 block"></i>
                                            <span class="text-xs">Belum ada riwayat transaksi pembayaran.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($transactions->hasPages())
                        <div class="p-4 border-t border-gray-100">
                            {{ $transactions->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Right Column: Profile & Fast Support (4 Cols) -->
        <div class="lg:col-span-4 space-y-4 sm:space-y-5 lg:sticky lg:top-24">
            
            <!-- Card 1: Hub Source Code On-Premise -->
            <div class="bg-white border border-[#E2E8F0] rounded-2xl p-4 sm:p-5 space-y-3.5 sm:space-y-4 shadow-2xs">
                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center font-bold">
                            <i class="ti ti-code text-base"></i>
                        </div>
                        <h4 class="text-xs font-bold text-gray-900">Akses Source Code</h4>
                    </div>
                    <span class="px-2 py-0.5 rounded-md bg-teal-50 text-[#007A87] text-[11px] font-medium">On-Premise</span>
                </div>

                @if(auth()->user()->hasApprovedSourceCode())
                    <div class="p-3 sm:p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 space-y-1.5">
                        <div class="flex items-center gap-1.5 font-bold text-xs">
                            <i class="ti ti-badge-check text-emerald-600 text-base"></i>
                            <span>Lisensi Terverifikasi</span>
                        </div>
                        <p class="text-xs text-emerald-800 leading-relaxed font-normal">
                            Anda memiliki akses penuh untuk mengunduh versi terbaru dan catatan rilis SC.
                        </p>
                    </div>

                    <a href="{{ route('member.source-code') }}" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white font-semibold text-xs transition-all shadow-xs">
                        <i class="ti ti-download text-sm"></i>
                        <span>Buka Download Hub SC</span>
                    </a>
                @else
                    <p class="text-xs text-gray-500 leading-relaxed font-normal">
                        Beli source code via Lynk.id / Saweria / Transfer? Ajukan verifikasi untuk membuka tautan pembaruan versi terbaru.
                    </p>

                    <a href="{{ route('source-code-claim.create') }}" 
                       class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white font-semibold text-xs transition-all shadow-xs">
                        <i class="ti ti-certificate text-sm"></i>
                        <span>Klaim Pembaruan SC</span>
                    </a>
                @endif
            </div>

            <!-- Card 2: Profil & Info Akun Member -->
            <div class="bg-white border border-[#E2E8F0] rounded-2xl p-4 sm:p-5 space-y-3.5 sm:space-y-4 shadow-2xs">
                <div class="flex items-center gap-2 pb-3 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-teal-50 text-[#007A87] flex items-center justify-center font-bold">
                        <i class="ti ti-user text-base"></i>
                    </div>
                    <h4 class="text-xs font-bold text-gray-900">Identitas Akun</h4>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-teal-50 text-[#007A87] border border-teal-200 flex items-center justify-center font-bold text-base uppercase shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden min-w-0">
                        <h4 class="text-xs font-bold text-gray-900 leading-tight truncate">{{ auth()->user()->name }}</h4>
                        <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                        <span class="inline-block mt-0.5 text-[10.5px] text-gray-500 font-medium">
                            Member terdaftar
                        </span>
                    </div>
                </div>

                <div class="pt-2 border-t border-gray-100 space-y-2 text-xs">
                    <div class="flex justify-between py-1 border-b border-gray-50 text-gray-500">
                        <span>Bergabung Sejak</span>
                        <span class="font-medium text-gray-800">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between py-1 text-gray-500">
                        <span>Status Email</span>
                        <span class="font-medium text-emerald-600 flex items-center gap-1">
                            <i class="ti ti-circle-check text-xs"></i> Terverifikasi
                        </span>
                    </div>
                </div>

                <div class="pt-1">
                    <a href="{{ route('profile.edit') }}" 
                       class="w-full inline-flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs transition-colors">
                        <i class="ti ti-settings text-sm"></i>
                        <span>Kelola Profil Akun</span>
                    </a>
                </div>
            </div>

            <!-- Card 3: Bantuan Teknis & CS WhatsApp -->
            <div class="bg-white border border-[#E2E8F0] rounded-2xl p-4 sm:p-5 space-y-3 shadow-2xs">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100">
                    <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                        <i class="ti ti-headset text-base"></i>
                    </div>
                    <h4 class="text-xs font-bold text-gray-900">Bantuan Teknis</h4>
                </div>

                <p class="text-xs text-gray-500 leading-relaxed font-normal">
                    Mengalami kendala saat login aplikasi, aktivasi lisensi, atau pertanyaan teknis instalasi? Hubungi tim support kami.
                </p>

                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '' }}?text=Halo%20Admin,%20saya%20member%20membutuhkan%20bantuan%20teknis" 
                   target="_blank" 
                   class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition-all shadow-xs">
                    <i class="ti ti-brand-whatsapp text-sm"></i>
                    <span>Chat WhatsApp Support</span>
                </a>
            </div>

        </div>

    </div>

    <!-- MODAL: Detail Transaksi Pembayaran -->
    <div x-cloak 
         x-show="openDetail" 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-3 sm:p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="bg-white rounded-2xl max-w-lg w-full p-4 sm:p-6 space-y-4 sm:space-y-5 shadow-xl border border-gray-100 max-h-[90vh] overflow-y-auto"
             @click.outside="openDetail = false">
            
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-base shrink-0">
                        <i class="ti ti-receipt-2"></i>
                    </div>
                    <h3 class="text-xs sm:text-sm font-bold text-gray-900">Rincian Transaksi</h3>
                </div>
                <button type="button" @click="openDetail = false" class="text-gray-400 hover:text-gray-600 cursor-pointer p-1">
                    <i class="ti ti-x text-lg"></i>
                </button>
            </div>

            <template x-if="selectedTrx">
                <div class="space-y-3.5 sm:space-y-4 text-xs">
                    
                    <div class="p-3.5 sm:p-4 rounded-xl bg-gray-50 border border-gray-100 space-y-2">
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500">ID Transaksi</span>
                            <span class="font-bold font-mono text-gray-900" x-text="'#TRX-' + selectedTrx.id"></span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500">Paket Langganan</span>
                            <span class="font-bold text-gray-900 text-right truncate" x-text="selectedTrx.plan_name + ' (' + selectedTrx.plan_type + ')'"></span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-500">Waktu Pembayaran</span>
                            <span class="font-medium text-gray-800 text-right" x-text="selectedTrx.date"></span>
                        </div>
                        <div class="flex justify-between gap-2 pt-2 border-t border-gray-200/80">
                            <span class="text-gray-700 font-semibold">Total Pembayaran</span>
                            <span class="font-bold text-[#007A87] text-sm" x-text="'Rp ' + selectedTrx.amount"></span>
                        </div>
                    </div>

                    <!-- Bukti Transfer -->
                    <template x-if="selectedTrx.payment_proof">
                        <div>
                            <span class="text-xs font-semibold text-gray-700 block mb-1">Bukti Transfer:</span>
                            <div class="p-2 rounded-xl bg-gray-50 border border-gray-200 text-center">
                                <a :href="selectedTrx.payment_proof" target="_blank">
                                    <img :src="selectedTrx.payment_proof" class="max-h-48 sm:max-h-64 mx-auto rounded-lg shadow-2xs hover:scale-102 transition-transform object-contain" alt="Bukti Transfer">
                                </a>
                            </div>
                        </div>
                    </template>

                    <!-- Catatan Admin jika ada -->
                    <template x-if="selectedTrx.admin_note">
                        <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-amber-900">
                            <span class="font-bold block text-xs">Catatan Verifikasi:</span>
                            <p class="text-xs mt-0.5" x-text="selectedTrx.admin_note"></p>
                        </div>
                    </template>

                </div>
            </template>

            <div class="pt-2 flex justify-end">
                <button type="button" @click="openDetail = false" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-xs font-semibold text-gray-700 cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
