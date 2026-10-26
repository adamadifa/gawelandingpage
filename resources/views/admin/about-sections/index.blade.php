@extends('layouts.admin')

@section('title', 'About Section Landing Page')
@section('subtitle', 'Kelola cerita, badge intro, headline keunggulan, checklist fitur, dan media gambar pada section About landing page.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Landing Page CMS</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">About Section</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Live Preview -->
    <a href="{{ route('landing') }}#about" target="_blank" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-external-link text-sm text-[#007A87]"></i>
        <span>Lihat Live Web</span>
    </a>

    <!-- Add New Section -->
    <a href="{{ route('admin.about-sections.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Section</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Stat Highlights -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] border border-teal-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-layout-board-split text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Modul</p>
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $about_sections->count() }} <span class="text-xs font-medium text-gray-400">Section</span></h4>
            </div>
        </div>

        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-circle-check text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status Publikasi</p>
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $about_sections->where('is_active', true)->count() }} <span class="text-xs font-medium text-emerald-600">Aktif di Web</span></h4>
            </div>
        </div>

        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-list-check text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Poin Fitur</p>
                @php
                    $totalItems = $about_sections->sum(function($sec) {
                        return is_array($sec->feature_items) ? count($sec->feature_items) : 0;
                    });
                @endphp
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $totalItems }} <span class="text-xs font-medium text-gray-400">Poin Terdaftar</span></h4>
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
                <h4 class="text-xs font-bold text-gray-800">Manajemen Section About</h4>
                <p class="text-[11px] text-gray-400">Hanya 1 section About yang aktif secara bersamaan pada landing page pengunjung.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-sparkles"></i>
            <span>Auto Single Active</span>
        </span>
    </div>

    <!-- About Sections Grid / Cards -->
    <div class="space-y-4">
        @forelse($about_sections as $about)
            <div class="card-clean p-5 lg:p-6 transition-all hover:border-teal-200 {{ $about->is_active ? 'ring-2 ring-[#007A87]/30 border-[#007A87]/50' : '' }}">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    
                    <!-- Col 1: Images Preview (3 Cols) -->
                    <div class="lg:col-span-3">
                        <div class="relative bg-slate-100 rounded-2xl overflow-hidden aspect-[4/3] border border-gray-200/80 shadow-2xs group">
                            @if($about->main_image)
                                <img src="{{ str_starts_with($about->main_image, 'images/') ? asset($about->main_image) : asset('storage/' . $about->main_image) }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                     alt="Main Image">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                    <i class="ti ti-photo text-3xl"></i>
                                    <span class="text-[10px] mt-1 font-medium">Tanpa Foto Utama</span>
                                </div>
                            @endif

                            <!-- Floating badge overlay if exists -->
                            @if($about->floating_image)
                                <div class="absolute bottom-2 right-2 w-16 h-12 rounded-xl bg-white/95 backdrop-blur-sm p-1 shadow-lg border border-white/60 overflow-hidden">
                                    <img src="{{ str_starts_with($about->floating_image, 'images/') ? asset($about->floating_image) : asset('storage/' . $about->floating_image) }}" 
                                         class="w-full h-full object-cover rounded-lg" 
                                         alt="Floating Card">
                                </div>
                            @endif

                            <!-- ID Tag -->
                            <div class="absolute top-2.5 left-2.5">
                                <span class="text-[10px] font-mono font-bold text-white bg-black/60 px-2 py-0.5 rounded-md backdrop-blur-xs">
                                    #{{ $about->id }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Col 2: Content & Details (6 Cols) -->
                    <div class="lg:col-span-6 space-y-3">
                        
                        <!-- Badge & Status -->
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-teal-50 border border-teal-200/70 text-xs font-bold text-[#007A87]">
                                <span>{{ $about->title_badge_icon }}</span>
                                <span>{{ $about->title_badge }}</span>
                            </span>

                            @if($about->is_active)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold rounded-lg">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span>Aktif di Web</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-500 border border-slate-200 text-[11px] font-semibold rounded-lg">
                                    <i class="ti ti-eye-off text-xs"></i>
                                    <span>Nonaktif</span>
                                </span>
                            @endif
                        </div>

                        <!-- Headline & Description -->
                        <div>
                            <h3 class="text-base lg:text-lg font-bold text-gray-900 hover:text-[#007A87] transition-colors leading-snug">
                                {{ $about->headline }}
                            </h3>
                            <p class="text-xs text-gray-500 line-clamp-2 mt-1 leading-relaxed">
                                {{ $about->description }}
                            </p>
                        </div>

                        <!-- Feature Checklist Pills -->
                        @if(!empty($about->feature_items) && is_array($about->feature_items))
                            <div class="space-y-1.5 pt-1">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Poin Keunggulan ({{ count($about->feature_items) }} Item):</span>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach(array_slice($about->feature_items, 0, 4) as $item)
                                        <span class="inline-flex items-center gap-1 text-[11px] font-medium text-gray-700 bg-slate-50 border border-slate-200 px-2 py-0.5 rounded-lg">
                                            <i class="ti ti-check text-emerald-600 text-xs"></i>
                                            <span class="truncate max-w-[200px]">{{ $item }}</span>
                                        </span>
                                    @endforeach
                                    @if(count($about->feature_items) > 4)
                                        <span class="text-[10px] text-gray-400 font-bold self-center">
                                            +{{ count($about->feature_items) - 4 }} lainnya
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- CTA Details -->
                        @if($about->cta_text)
                            <div class="pt-1 flex items-center gap-2 text-xs text-gray-500">
                                <i class="ti ti-link text-[#007A87]"></i>
                                <span>Tombol CTA: <strong class="text-gray-800">{{ $about->cta_text }}</strong></span>
                                <span class="text-gray-300">•</span>
                                <span class="text-[11px] font-mono text-gray-400 truncate max-w-[150px]">{{ $about->cta_url ?: '-' }}</span>
                            </div>
                        @endif

                    </div>

                    <!-- Col 3: Actions (3 Cols) -->
                    <div class="lg:col-span-3 flex lg:flex-col justify-end gap-2 border-t lg:border-t-0 lg:border-l border-gray-100 pt-4 lg:pt-0 lg:pl-6">
                        
                        <a href="{{ route('admin.about-sections.edit', $about->id) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 text-xs font-bold transition-all shadow-2xs">
                            <i class="ti ti-edit text-sm text-[#007A87]"></i>
                            <span>Edit Konten</span>
                        </a>

                        @if(!$about->is_active)
                            <form action="{{ route('admin.about-sections.update', $about->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_active" value="1">
                                <input type="hidden" name="title_badge" value="{{ $about->title_badge }}">
                                <input type="hidden" name="title_badge_icon" value="{{ $about->title_badge_icon }}">
                                <input type="hidden" name="headline" value="{{ $about->headline }}">
                                <input type="hidden" name="description" value="{{ $about->description }}">
                                <input type="hidden" name="cta_text" value="{{ $about->cta_text }}">
                                <input type="hidden" name="cta_url" value="{{ $about->cta_url }}">
                                @foreach($about->feature_items ?? [] as $feat)
                                    <input type="hidden" name="feature_items[]" value="{{ $feat }}">
                                @endforeach
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-teal-50 hover:bg-teal-100 text-[#007A87] border border-teal-200 text-xs font-bold transition-all">
                                    <i class="ti ti-check text-sm"></i>
                                    <span>Jadikan Aktif</span>
                                </button>
                            </form>
                        @endif

                        <button type="button" 
                                @click="$dispatch('confirm', {
                                    title: 'Hapus About Section',
                                    message: 'Apakah Anda yakin ingin menghapus section About #{{ $about->id }}? Tindakan ini tidak dapat dibatalkan.',
                                    type: 'danger',
                                    icon: 'ti ti-trash',
                                    callback: () => { document.getElementById('delete-form-{{ $about->id }}').submit(); }
                                })"
                                class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-bold transition-all">
                            <i class="ti ti-trash text-sm"></i>
                            <span class="lg:hidden">Hapus</span>
                        </button>

                        <form id="delete-form-{{ $about->id }}" action="{{ route('admin.about-sections.destroy', $about->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>

                    </div>

                </div>
            </div>
        @empty
            <div class="card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto text-3xl mb-3">
                    <i class="ti ti-layout-board-split"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Belum Ada About Section</h4>
                <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto">Tambahkan modul About pertama Anda untuk menguraikan fitur andalan aplikasi di landing page.</p>
                <a href="{{ route('admin.about-sections.create') }}" 
                   class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Section Sekarang</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
