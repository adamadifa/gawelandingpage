@extends('layouts.admin')

@section('title', 'Counter Stats Landing Page')
@section('subtitle', 'Kelola kartu metrik statistik melayang (floating badges) yang memperkuat kredibilitas produk di banner depan.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Landing Page CMS</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Counter Stats</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Hero Layout Link -->
    <a href="{{ route('admin.hero-sections.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-layout-board text-[#007A87] text-sm"></i>
        <span>Hero Layout</span>
    </a>

    <!-- Tambah Kartu -->
    <a href="{{ route('admin.hero-stats-cards.create') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-teal-700/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Kartu</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Top Notice Banner -->
    <div class="card-clean p-4 border-l-4 border-l-[#007A87] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center shrink-0">
                <i class="ti ti-numbers text-lg"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800">Kartu Metrik & Social Proof Hero</h4>
                <p class="text-[11px] text-gray-400">Kartu statistik ini tampil melayang (floating badge) di sekitar mockup banner utama hero section.</p>
            </div>
        </div>
        <div class="flex items-center gap-2 self-start sm:self-auto shrink-0">
            <span class="text-[11px] font-bold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-lg">
                Total: {{ $cards->count() }} Kartu
            </span>
            <span class="text-[11px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-lg">
                Aktif: {{ $cards->where('is_active', true)->count() }}
            </span>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @forelse($cards as $card)
            @php
                $colorThemes = [
                    'indigo' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-100', 'dot' => 'bg-indigo-500'],
                    'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100', 'dot' => 'bg-emerald-500'],
                    'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100', 'dot' => 'bg-amber-500'],
                    'rose' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-100', 'dot' => 'bg-rose-500'],
                    'sky' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-600', 'border' => 'border-sky-100', 'dot' => 'bg-sky-500'],
                    'teal' => ['bg' => 'bg-teal-50', 'text' => 'text-teal-600', 'border' => 'border-teal-100', 'dot' => 'bg-teal-500'],
                ];
                $theme = $colorThemes[$card->color_theme] ?? $colorThemes['emerald'];
            @endphp
            
            <div class="card-clean p-5 flex flex-col justify-between hover:border-teal-200 transition-all group">
                
                <!-- Card Header -->
                <div>
                    <div class="flex items-start justify-between pb-3 mb-3 border-b border-gray-100">
                        <div class="w-10 h-10 rounded-xl {{ $theme['bg'] }} {{ $theme['text'] }} {{ $theme['border'] }} border flex items-center justify-center text-lg shadow-2xs group-hover:scale-105 transition-transform">
                            <i class="ti {{ $card->icon }}"></i>
                        </div>

                        <!-- Action Icons -->
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.hero-stats-cards.edit', $card) }}" 
                               class="w-7 h-7 rounded-lg text-gray-400 hover:text-[#007A87] hover:bg-teal-50 flex items-center justify-center transition-colors"
                               title="Edit Kartu">
                                <i class="ti ti-edit text-sm"></i>
                            </a>

                            <button type="button" 
                                    onclick="confirmDialog({
                                        title: 'Hapus Kartu Statistik',
                                        message: 'Apakah Anda yakin ingin menghapus kartu statistik {{ $card->title }}?',
                                        type: 'danger',
                                        icon: 'ti ti-trash',
                                        callback: () => { document.getElementById('delete-form-{{ $card->id }}').submit(); }
                                    })" 
                                    class="w-7 h-7 rounded-lg text-gray-400 hover:text-rose-600 hover:bg-rose-50 flex items-center justify-center transition-colors"
                                    title="Hapus Kartu">
                                <i class="ti ti-trash text-sm"></i>
                            </button>

                            <form id="delete-form-{{ $card->id }}" action="{{ route('admin.hero-stats-cards.destroy', $card) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>

                    <!-- Metric Value & Title -->
                    <div class="space-y-1">
                        <h3 class="text-2xl font-black text-[#0F172A] tracking-tight leading-none">
                            {{ $card->value }}
                        </h3>
                        <p class="text-xs font-semibold text-gray-500 line-clamp-1">
                            {{ $card->title }}
                        </p>
                    </div>
                </div>

                <!-- Footer Slot & Status -->
                <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-semibold">
                    <span class="inline-flex items-center gap-1.5 text-[11px] text-gray-600">
                        <span class="w-1.5 h-1.5 rounded-full {{ $theme['dot'] }}"></span>
                        <span>Slot: <strong>{{ $card->position_slot }}</strong></span>
                    </span>

                    @if($card->is_active)
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-600 border border-emerald-200">
                            <span>Aktif</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-500">
                            <span>Draft</span>
                        </span>
                    @endif
                </div>

            </div>
        @empty
            <div class="col-span-full card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto text-gray-400 text-3xl mb-3">
                    <i class="ti ti-numbers"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Belum Ada Kartu Statistik</h4>
                <p class="text-xs text-gray-400 mt-1 mb-4">Tambahkan kartu statistik untuk mempercantik hero landing page.</p>
                <a href="{{ route('admin.hero-stats-cards.create') }}" 
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Kartu Baru</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
