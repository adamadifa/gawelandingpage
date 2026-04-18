@extends('layouts.admin')

@section('title', 'Data Lisensi')
@section('description', 'Kelola semua data lisensi dan langganan aktif pelanggan.')

@section('breadcrumbs')
<nav class="flex items-center gap-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest mb-1 font-poppins">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-600 transition-colors">Dashboard</a>
    <i class="ti ti-chevron-right text-[8px]"></i>
    <span class="text-brand-600 font-semibold tracking-widest">Data Lisensi</span>
</nav>
@endsection

@section('actions')
@endsection

@section('content')
<div class="w-full -mt-6 space-y-6 pb-0 font-poppins text-inter">

    {{-- Subscriptions Table Section --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-xl shadow-black/[0.02] overflow-hidden mt-6">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white">
            <div>
                <h2 class="text-lg font-bold text-gray-900 tracking-tight flex items-center gap-3 uppercase">
                    Daftar Lisensi
                </h2>
                <p class="text-xs text-gray-400 mt-1 font-semibold uppercase tracking-wider leading-none">Menampilkan semua status langganan dan lisensi pengguna.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="ti ti-filter text-gray-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <select class="pl-10 pr-10 py-2.5 bg-gray-50/50 border border-gray-100 rounded-xl text-xs font-bold text-gray-600 focus:ring-4 focus:ring-brand-100/30 focus:border-brand-600 transition-all appearance-none cursor-pointer">
                        <option>Semua Status</option>
                        <option>Active</option>
                        <option>Expired</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[10px] font-bold uppercase tracking-widest border-b border-gray-50">
                        <th class="px-8 py-6">Informasi Pelanggan</th>
                        <th class="px-6 py-6 text-center">Paket</th>
                        <th class="px-6 py-6 border-x border-gray-50/50">License & Aplikasi</th>
                        <th class="px-6 py-6 text-center">Status</th>
                        <th class="px-6 py-6">Tanggal Expired</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($licenses as $license)
                    <tr class="group hover:bg-brand-50/30 transition-all duration-300">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center font-bold text-brand-600 text-lg border-2 border-white shadow-sm ring-1 ring-brand-100">
                                    {{ substr($license->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 text-sm leading-tight mb-1 group-hover:text-brand-600 transition-colors uppercase tracking-tight">{{ $license->user->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-none">{{ $license->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            <div class="inline-flex flex-col items-center">
                                <span class="text-[13px] font-bold text-gray-800 uppercase tracking-tight">{{ $license->pricingPlan->name }}</span>
                                @if($license->transaction)
                                    <span class="text-[9px] font-bold uppercase tracking-[0.1em] mt-1 px-2 py-0.5 rounded-lg border border-gray-100 {{ $license->transaction->plan_type === 'yearly' ? 'bg-brand-50 text-brand-600 border-brand-100' : 'bg-gray-50 text-gray-400' }}">
                                        {{ $license->transaction->plan_type }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-6 border-x border-gray-50/50">
                            <div class="flex items-center gap-2 mb-1.5 code-contain text-[11px] font-mono font-bold text-gray-800 tracking-wider">
                                {{ $license->license_code }}
                            </div>
                            @if($license->app_url)
                                <a href="{{ $license->app_url }}" target="_blank" class="text-[10px] font-bold text-brand-600 hover:text-brand-700 hover:underline uppercase tracking-widest leading-none flex items-center gap-1">
                                    <i class="ti ti-link"></i> {{ \Illuminate\Support\Str::limit(str_replace(['http://', 'https://'], '', $license->app_url), 20) }}
                                </a>
                            @else
                                <span class="text-[10px] text-gray-400 font-medium uppercase tracking-widest leading-none">Belum di set</span>
                            @endif
                        </td>
                        <td class="px-6 py-6 text-center">
                            @php
                                $isExpiringSoon = !$license->isExpired() && now()->addDays(30)->isAfter($license->ends_at);
                            @endphp
                            @if($license->isExpired())
                                <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-widest ring-1 ring-rose-100">
                                    <i class="ti ti-alert-circle"></i> Expired
                                </span>
                            @elseif($license->status == 'active')
                                <div class="flex flex-col items-center gap-1.5">
                                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-widest ring-1 ring-emerald-100">
                                        <i class="ti ti-circle-check"></i> Active
                                    </span>
                                    @if($isExpiringSoon)
                                    <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-600 px-2.5 py-1 rounded-lg text-[9px] font-bold uppercase tracking-widest ring-1 ring-amber-200">
                                        <i class="ti ti-clock-exclamation"></i> &lt; 30 Hari
                                    </span>
                                    @endif
                                </div>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-gray-50 text-gray-600 px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-widest ring-1 ring-gray-200">
                                    {{ $license->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-6">
                            @php
                                $dateColorClass = $license->isExpired() ? 'text-rose-500' : ($isExpiringSoon ? 'text-amber-500' : 'text-gray-900');
                            @endphp
                            <div class="text-[11px] font-bold {{ $dateColorClass }} leading-tight uppercase tracking-widest">
                                {{ $license->ends_at->format('d M Y') }}
                                <span class="block text-[9px] text-gray-400 font-bold mt-1 tracking-widest">{{ $license->ends_at->format('H:i') }} WIB</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-24 text-center">
                            <div class="flex flex-col items-center opacity-20">
                                <i class="ti ti-key-off text-7xl mb-4"></i>
                                <p class="font-bold text-xl uppercase tracking-widest">Belum ada data lisensi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($licenses->hasPages())
        <div class="px-8 py-6 bg-gray-50/30 border-t border-gray-50">
            {{ $licenses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
