@extends('layouts.admin')

@section('title', 'Paket Langganan')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">Paket Langganan</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('landing') }}#pricing" 
       target="_blank"
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-teal-300 text-gray-600 hover:text-[#007A87] text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-external-link text-sm"></i>
        <span>Lihat Live Web</span>
    </a>

    <a href="{{ route('admin.pricing-plans.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Paket</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Top Statistics Row -->
    @php
        $totalPlans = $plans->count();
        $activePlans = $plans->where('is_active', true)->count();
        $featuredPlans = $plans->where('is_featured', true)->count();
        $paidPlans = $plans->where('monthly_price', '>', 0);
        $minPrice = $paidPlans->min('monthly_price') ?? 0;
        $maxPrice = $paidPlans->max('monthly_price') ?? 0;
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Stat 1 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-packages"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Total Paket</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-gray-900 leading-none">{{ $totalPlans }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Tier Terdaftar</span>
                </div>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-circle-check"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Status Aktif</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-emerald-600 leading-none">{{ $activePlans }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Tampil di Web</span>
                </div>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-star"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Paket Populer</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-amber-600 leading-none">{{ $featuredPlans }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Highlight Featured</span>
                </div>
            </div>
        </div>

        <!-- Stat 4 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-currency-dollar"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Rentang Harga</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-xs font-bold text-gray-900 leading-none">
                        @if($minPrice > 0)
                            Rp {{ number_format($minPrice/1000, 0) }}k - {{ number_format($maxPrice/1000, 0) }}k
                        @else
                            Gratis / Custom
                        @endif
                    </span>
                    <span class="text-[10px] font-semibold text-gray-400">/bln</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Notice Card -->
    <div class="card-clean p-4 border-l-4 border-l-[#007A87] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center shrink-0">
                <i class="ti ti-info-circle text-lg"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800">Manajemen Tier Langganan Landing Page</h4>
                <p class="text-[11px] text-gray-400">Urutan kartu diatur otomatis menurut nomor urutan (sort order). Paket yang ditandai "Featured" akan disorot dengan badge populer di halaman depan.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-sort-ascending"></i>
            <span>Sesuai Nomor Urutan</span>
        </span>
    </div>

    <!-- Pricing Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 items-stretch">
        @forelse($plans as $plan)
            <div class="card-clean p-5 flex flex-col justify-between relative group hover:border-teal-300 transition-all duration-200 {{ $plan->is_featured ? 'border-[#007A87]/70 ring-2 ring-[#007A87]/15 shadow-md' : '' }}">
                
                <!-- Featured Badge Ribbon -->
                @if($plan->is_featured)
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                        <span class="inline-flex items-center gap-1 py-0.5 px-3 rounded-full text-[10px] font-black bg-[#007A87] text-white shadow-xs uppercase tracking-wider">
                            <i class="ti ti-star-filled text-amber-300 text-[10px]"></i>
                            <span>Populer</span>
                        </span>
                    </div>
                @endif

                <div>
                    <!-- Header Bar: Tag Badge & Sort Order -->
                    <div class="flex items-center justify-between gap-2 mb-3">
                        @if($plan->badge)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-teal-50 border border-teal-200/60 text-[#007A87] text-[10px] font-bold">
                                {{ $plan->badge }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-gray-50 border border-gray-200/60 text-gray-400 text-[10px] font-medium">
                                Reguler
                            </span>
                        @endif

                        <span class="text-[10px] font-mono font-bold text-gray-400 bg-gray-50 px-2 py-0.5 rounded border border-gray-100" title="Nomor Urutan">
                            #{{ $plan->sort_order }}
                        </span>
                    </div>

                    <!-- Plan Title & Target Audience -->
                    <div class="mb-4">
                        <h3 class="text-base font-extrabold text-gray-900 group-hover:text-[#007A87] transition-colors leading-tight">
                            {{ $plan->name }}
                        </h3>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-1 font-medium">
                            {{ $plan->target_audience ?: 'Cocok untuk berbagai kebutuhan bisnis' }}
                        </p>
                    </div>

                    <!-- Price Box -->
                    <div class="mb-4 pb-3 border-b border-gray-100">
                        @if($plan->monthly_price > 0)
                            <div class="flex items-baseline gap-1">
                                <span class="text-xs font-bold text-gray-400">Rp</span>
                                <span class="text-2xl font-black text-gray-900 tracking-tight">
                                    {{ number_format($plan->monthly_price, 0, ',', '.') }}
                                </span>
                                <span class="text-[11px] font-medium text-gray-400">/bln</span>
                            </div>

                            @if($plan->yearly_price > 0)
                                <div class="mt-1 flex items-center gap-1.5 text-[11px] text-teal-700 font-medium">
                                    <i class="ti ti-calendar text-xs shrink-0 text-[#007A87]"></i>
                                    <span>Tahunan: <b class="text-gray-900">Rp {{ number_format($plan->yearly_price, 0, ',', '.') }}</b></span>
                                </div>
                            @endif

                            @if($plan->yearly_savings)
                                <div class="mt-1">
                                    <span class="inline-block text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200/60">
                                        🎉 {{ $plan->yearly_savings }}
                                    </span>
                                </div>
                            @endif
                        @else
                            <div>
                                <span class="text-lg font-black text-[#007A87]">Custom Pricing</span>
                                <p class="text-[11px] text-gray-400 mt-0.5">Sesuai penawaran & kontrak</p>
                            </div>
                        @endif
                    </div>

                    <!-- Technical Specs Badges -->
                    <div class="space-y-1.5 mb-4">
                        <div class="flex items-center gap-2 text-xs text-gray-600 bg-slate-50/80 p-2 rounded-lg border border-gray-100">
                            <i class="ti ti-users text-[#007A87] text-sm shrink-0"></i>
                            <span class="truncate font-medium">
                                {{ $plan->max_employees ? 'Maks ' . number_format($plan->max_employees) . ' Karyawan' : 'Kapasitas Unlimited' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-600 bg-slate-50/80 p-2 rounded-lg border border-gray-100">
                            <i class="ti ti-cpu text-[#007A87] text-sm shrink-0"></i>
                            <span class="truncate font-medium text-[11px]" title="{{ $plan->server_spec }}">
                                {{ $plan->server_spec ?: 'Infrastruktur Cloud Standar' }}
                            </span>
                        </div>
                    </div>

                    <!-- Features Checklist Preview -->
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center justify-between text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                            <span>Fitur & Layanan</span>
                            <span class="text-[#007A87] font-semibold">{{ $plan->features->count() }} Item</span>
                        </div>

                        <ul class="space-y-1.5">
                            @foreach($plan->features->take(4) as $feature)
                                <li class="flex items-start gap-2 text-xs text-gray-600">
                                    <i class="ti ti-circle-check-filled text-[#007A87] text-sm shrink-0 mt-0.5"></i>
                                    <span class="line-clamp-1 leading-snug">{{ $feature->feature_text }}</span>
                                </li>
                            @endforeach

                            @if($plan->features->count() > 4)
                                <li class="text-[11px] font-bold text-gray-400 pl-5">
                                    +{{ $plan->features->count() - 4 }} fitur lainnya disertakan
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>

                <!-- Bottom Bar: Status + Actions -->
                <div class="pt-3 border-t border-gray-100 flex items-center justify-between gap-2 mt-2">
                    <div>
                        @if($plan->is_active)
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>Aktif</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                <span>Draft</span>
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-1.5">
                        <a href="{{ route('admin.pricing-plans.edit', $plan->id) }}" 
                           class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-teal-50 hover:bg-[#007A87] text-[#007A87] hover:text-white border border-teal-200/60 text-xs font-bold transition-all shadow-2xs"
                           title="Edit Paket">
                            <i class="ti ti-edit text-xs"></i>
                            <span>Edit</span>
                        </a>

                        <button type="button" 
                                @click="$dispatch('confirm', {
                                    title: 'Hapus Paket Langganan',
                                    message: 'Apakah Anda yakin ingin menghapus paket «{{ $plan->name }}» beserta seluruh fiturnya?',
                                    type: 'danger',
                                    icon: 'ti ti-trash',
                                    callback: () => { document.getElementById('delete-form-{{ $plan->id }}').submit(); }
                                })" 
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-400 hover:text-rose-600 border border-gray-200 transition-colors shadow-2xs" 
                                title="Hapus Paket">
                            <i class="ti ti-trash text-sm"></i>
                        </button>
                    </div>

                    <form id="delete-form-{{ $plan->id }}" action="{{ route('admin.pricing-plans.destroy', $plan->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
        @empty
            <div class="col-span-full card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto mb-4 border border-teal-100 text-2xl shadow-sm">
                    <i class="ti ti-package-off"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Belum Ada Paket Langganan</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto mb-5 leading-relaxed">
                    Mulai buat paket langganan untuk menyajikan opsi paket harga kepada calon pelanggan di landing page.
                </p>
                <a href="{{ route('admin.pricing-plans.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Buat Paket Pertama</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
