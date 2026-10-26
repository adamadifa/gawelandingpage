@extends('layouts.admin')

@section('title', 'Daftar Item Fitur')
@section('subtitle', 'Kelola kartu-kartu fitur unggulan yang melengkapi tampilan mockup aplikasi di landing page.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Landing Page CMS</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <a href="{{ route('admin.feature-sections.index') }}" class="hover:text-[#007A87]">
        <span>Feature Section</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Item Fitur</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Header Section Link -->
    <a href="{{ route('admin.feature-sections.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-device-mobile-message text-[#007A87] text-sm"></i>
        <span>Header Mockup</span>
    </a>

    <!-- Live Preview -->
    <a href="{{ route('landing') }}#features" target="_blank" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-external-link text-sm text-[#007A87]"></i>
        <span>Lihat Live Web</span>
    </a>

    <!-- Add New Feature -->
    <a href="{{ route('admin.features.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Fitur</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Stat Highlights -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] border border-teal-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-layout-grid text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Fitur</p>
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $features->count() }} <span class="text-xs font-medium text-gray-400">Item Terdaftar</span></h4>
            </div>
        </div>

        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-circle-check text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status Aktif</p>
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $features->where('is_active', true)->count() }} <span class="text-xs font-medium text-emerald-600">Ditampilkan</span></h4>
            </div>
        </div>

        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 border border-slate-200/60 flex items-center justify-center shrink-0">
                <i class="ti ti-eye-off text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status Draft</p>
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $features->where('is_active', false)->count() }} <span class="text-xs font-medium text-gray-400">Disembunyikan</span></h4>
            </div>
        </div>
    </div>

    <!-- Notice Header -->
    <div class="card-clean p-4 border-l-4 border-l-[#007A87] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center shrink-0">
                <i class="ti ti-info-circle text-lg"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-gray-800">Manajemen Kartu Fitur</h4>
                <p class="text-[11px] text-gray-400">Setiap kartu fitur akan ditampilkan mengelilingi visual mockup pada landing page sesuai nomor urutan.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-sort-ascending"></i>
            <span>Urutan Otomatis</span>
        </span>
    </div>

    <!-- Feature Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($features as $feature)
            @php
                $rawIcon = trim($feature->icon ?? '');
                if (empty($rawIcon)) {
                    $iconClass = 'ti ti-star';
                } elseif (str_starts_with($rawIcon, 'ti ti-')) {
                    $iconClass = $rawIcon;
                } elseif (str_starts_with($rawIcon, 'ti-')) {
                    $iconClass = 'ti ' . $rawIcon;
                } else {
                    $iconClass = 'ti ti-' . $rawIcon;
                }
            @endphp
            <div class="card-clean p-5 flex flex-col justify-between group hover:border-teal-200 transition-all">
                
                <div>
                    <!-- Top Bar: Icon + Actions -->
                    <div class="flex items-start justify-between gap-3 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-[#007A87] border border-teal-100/70 flex items-center justify-center text-xl shadow-2xs group-hover:scale-105 group-hover:bg-[#007A87] group-hover:text-white transition-all duration-300">
                            <i class="{{ $iconClass }}"></i>
                        </div>

                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.features.edit', $feature) }}" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-teal-50 text-gray-500 hover:text-[#007A87] border border-gray-200 transition-colors shadow-2xs" 
                               title="Edit Fitur">
                                <i class="ti ti-edit text-sm"></i>
                            </a>

                            <button type="button" 
                                    @click="$dispatch('confirm', {
                                        title: 'Hapus Fitur',
                                        message: 'Apakah Anda yakin ingin menghapus fitur «{{ $feature->title }}»?',
                                        type: 'danger',
                                        icon: 'ti ti-trash',
                                        callback: () => { document.getElementById('delete-form-{{ $feature->id }}').submit(); }
                                    })" 
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-500 hover:text-rose-600 border border-gray-200 transition-colors shadow-2xs" 
                                    title="Hapus Fitur">
                                <i class="ti ti-trash text-sm"></i>
                            </button>

                            <form id="delete-form-{{ $feature->id }}" action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>

                    <!-- Title & Description -->
                    <div class="space-y-1.5">
                        <h4 class="text-sm font-bold text-gray-900 leading-snug group-hover:text-[#007A87] transition-colors">
                            {{ $feature->title }}
                        </h4>
                        <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed">
                            {{ $feature->description }}
                        </p>
                    </div>
                </div>

                <!-- Card Bottom Metadata -->
                <div class="mt-5 pt-3.5 border-t border-gray-100 flex items-center justify-between text-xs">
                    <span class="inline-flex items-center gap-1 text-[10px] font-mono font-bold text-gray-500 bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200/80">
                        <i class="ti ti-arrows-sort text-[10px]"></i>
                        <span>Urutan: {{ $feature->sort_order }}</span>
                    </span>

                    @if($feature->is_active)
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Aktif</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-gray-400 bg-gray-50 px-2 py-0.5 rounded-md border border-gray-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                            <span>Draft</span>
                        </span>
                    @endif
                </div>

            </div>
        @empty
            <div class="col-span-full card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto text-3xl mb-3">
                    <i class="ti ti-layout-grid"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Belum Ada Item Fitur</h4>
                <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto">Tambahkan kartu fitur pertama Anda untuk ditampilkan mengelilingi mockup sentral aplikasi.</p>
                <a href="{{ route('admin.features.create') }}" 
                   class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Fitur Baru</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
