@extends('layouts.admin')

@section('title', 'Header & Visual FAQ')

@section('breadcrumbs')
<nav class="flex items-center gap-1.5 text-xs text-gray-400 font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] transition-colors flex items-center gap-1">
        <i class="ti ti-home"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px]"></i>
    <span class="text-gray-700 font-bold">FAQ Section</span>
</nav>
@endsection

@section('actions')
<div class="flex items-center gap-2.5">
    <a href="{{ route('admin.faqs.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-teal-300 text-gray-600 hover:text-[#007A87] text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-help text-sm"></i>
        <span>Kelola Tanya Jawab (Q&A)</span>
    </a>

    <a href="{{ route('landing') }}#faq" 
       target="_blank"
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 hover:border-teal-300 text-gray-600 hover:text-[#007A87] text-xs font-bold transition-all shadow-2xs">
        <i class="ti ti-external-link text-sm"></i>
        <span>Lihat Live Web</span>
    </a>

    <a href="{{ route('admin.faq-sections.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Versi</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Top Statistics Row -->
    @php
        $totalSections = $faq_sections->count();
        $activeSection = $faq_sections->where('is_active', true)->first();
        $totalFaqs = \App\Models\Faq::count();
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Stat 1 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-layout-board"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Total Versi Section</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-gray-900 leading-none">{{ $totalSections }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Versi Layout</span>
                </div>
            </div>
        </div>

        <!-- Stat 2 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-circle-check"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Status Publikasi</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-emerald-600 leading-none">{{ $activeSection ? '1 Aktif' : '0 Aktif' }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">di Landing Page</span>
                </div>
            </div>
        </div>

        <!-- Stat 3 -->
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg shrink-0">
                <i class="ti ti-help"></i>
            </div>
            <div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Daftar Pertanyaan FAQ</span>
                <div class="flex items-baseline gap-1.5 mt-0.5">
                    <span class="text-lg font-extrabold text-blue-600 leading-none">{{ $totalFaqs }}</span>
                    <span class="text-[11px] font-semibold text-gray-500">Item Pertanyaan Terbit</span>
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
                <h4 class="text-xs font-bold text-gray-800">Sistem Single-Active Section</h4>
                <p class="text-[11px] text-gray-400">Hanya 1 konfigurasi header & mockup FAQ yang aktif di landing page. Mengaktifkan versi baru akan secara otomatis menonaktifkan versi sebelumnya.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-layers-linked"></i>
            <span>Otomatis Sinkron</span>
        </span>
    </div>

    <!-- Sections List Grid -->
    <div class="grid grid-cols-1 gap-4">
        @forelse($faq_sections as $section)
            <div class="card-clean p-5 flex flex-col md:flex-row items-start md:items-center justify-between gap-5 relative group hover:border-teal-300 transition-all duration-200 {{ $section->is_active ? 'border-[#007A87]/70 ring-2 ring-[#007A87]/15 shadow-sm' : '' }}">
                
                <!-- Left: Visual Mockup Thumbnails + Details -->
                <div class="flex items-start gap-4 flex-1">
                    
                    <!-- Dual Mockup Visual Thumbnail -->
                    <div class="relative w-28 h-20 bg-slate-100 rounded-xl border border-gray-200/80 overflow-hidden shrink-0 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                        @if($section->primary_image)
                            <img src="{{ str_starts_with($section->primary_image, 'images/') ? asset($section->primary_image) : asset('storage/' . $section->primary_image) }}" 
                                 class="w-full h-full object-contain p-1"
                                 alt="Primary Mockup">
                        @else
                            <i class="ti ti-photo text-2xl text-gray-300"></i>
                        @endif

                        @if($section->secondary_image)
                            <div class="absolute bottom-1 right-1 w-8 h-12 bg-white rounded-md shadow-md border border-gray-100 overflow-hidden">
                                <img src="{{ str_starts_with($section->secondary_image, 'images/') ? asset($section->secondary_image) : asset('storage/' . $section->secondary_image) }}" 
                                     class="w-full h-full object-contain"
                                     alt="Support Mockup">
                            </div>
                        @endif
                    </div>

                    <!-- Texts & Badges -->
                    <div class="space-y-1.5 flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md bg-teal-50 border border-teal-200/60 text-[#007A87] text-[10px] font-bold">
                                <span>{{ $section->title_badge_icon }}</span>
                                <span>{{ $section->title_badge }}</span>
                            </span>

                            @if($section->is_active)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Aktif di Web</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    <span>Nonaktif</span>
                                </span>
                            @endif
                        </div>

                        <h3 class="text-sm font-extrabold text-gray-900 group-hover:text-[#007A87] transition-colors leading-tight">
                            {{ $section->headline }}
                        </h3>

                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                            {{ $section->description ?: 'Belum ada deskripsi pengantar FAQ.' }}
                        </p>

                        <div class="flex items-center gap-3 pt-1 text-[11px] text-gray-400">
                            <span class="flex items-center gap-1">
                                <i class="ti ti-photo text-xs text-teal-600"></i>
                                <span>Mockup Utama: <b>{{ $section->primary_image ? 'Tersedia' : 'Default' }}</b></span>
                            </span>
                            <span>•</span>
                            <span class="flex items-center gap-1">
                                <i class="ti ti-device-mobile text-xs text-teal-600"></i>
                                <span>Mockup Pendukung: <b>{{ $section->secondary_image ? 'Tersedia' : 'Default' }}</b></span>
                            </span>
                        </div>
                    </div>

                </div>

                <!-- Right: Action Buttons -->
                <div class="flex items-center gap-2 self-end md:self-center shrink-0 pt-2 md:pt-0 border-t md:border-t-0 border-gray-100 w-full md:w-auto justify-end">
                    <a href="{{ route('admin.faq-sections.edit', $section->id) }}" 
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-teal-50 hover:bg-[#007A87] text-[#007A87] hover:text-white border border-teal-200/60 text-xs font-bold transition-all shadow-2xs"
                       title="Edit Section">
                        <i class="ti ti-edit text-sm"></i>
                        <span>Edit</span>
                    </a>

                    <button type="button" 
                            @click="$dispatch('confirm', {
                                title: 'Hapus Versi FAQ Section',
                                message: 'Apakah Anda yakin ingin menghapus versi layout FAQ ini?',
                                type: 'danger',
                                icon: 'ti ti-trash',
                                callback: () => { document.getElementById('delete-form-{{ $section->id }}').submit(); }
                            })" 
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 hover:bg-rose-50 text-gray-400 hover:text-rose-600 border border-gray-200 transition-colors shadow-2xs" 
                            title="Hapus Section">
                        <i class="ti ti-trash text-sm"></i>
                    </button>

                    <form id="delete-form-{{ $section->id }}" action="{{ route('admin.faq-sections.destroy', $section->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
        @empty
            <div class="card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto mb-4 border border-teal-100 text-2xl shadow-sm">
                    <i class="ti ti-help-off"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-900 mb-1">Belum Ada Versi FAQ Section</h3>
                <p class="text-xs text-gray-400 max-w-sm mx-auto mb-5 leading-relaxed">
                    Mulai buat konfigurasi headline dan mockup untuk membungkus pertanyaan-pertanyaan FAQ di landing page.
                </p>
                <a href="{{ route('admin.faq-sections.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Buat Versi Pertama</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
