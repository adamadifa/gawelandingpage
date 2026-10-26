@extends('layouts.admin')

@section('title', 'Feature Section Landing Page')
@section('subtitle', 'Kelola headline utama, badge intro, dan mockup visual utama yang membungkus daftar fitur aplikasi.')

@section('breadcrumbs')
<div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-[#E2E8F0]/70 text-xs text-[#64748B] shadow-2xs font-medium">
    <a href="{{ route('admin.dashboard') }}" class="hover:text-[#007A87] flex items-center gap-1">
        <i class="ti ti-home text-sm"></i>
        <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-gray-400">Landing Page CMS</span>
    <i class="ti ti-chevron-right text-[10px] text-gray-300"></i>
    <span class="text-[#0F172A] font-semibold">Feature Section</span>
</div>
@endsection

@section('actions')
<div class="flex items-center gap-2">
    <!-- Item Fitur Link -->
    <a href="{{ route('admin.features.index') }}" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-layout-grid text-[#007A87] text-sm"></i>
        <span>Daftar Item Fitur</span>
    </a>

    <!-- Live Preview -->
    <a href="{{ route('landing') }}#features" target="_blank" 
       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 text-xs font-bold shadow-2xs transition-all">
        <i class="ti ti-external-link text-sm text-[#007A87]"></i>
        <span>Lihat Live Web</span>
    </a>

    <!-- Add New Section -->
    <a href="{{ route('admin.feature-sections.create') }}" 
       class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
        <i class="ti ti-plus text-sm"></i>
        <span>Tambah Versi</span>
    </a>
</div>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Stat Highlights -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-[#007A87] border border-teal-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-stack-2 text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total Versi</p>
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $feature_sections->count() }} <span class="text-xs font-medium text-gray-400">Section</span></h4>
            </div>
        </div>

        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-circle-check text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Status Publikasi</p>
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $feature_sections->where('is_active', true)->count() }} <span class="text-xs font-medium text-emerald-600">Aktif di Web</span></h4>
            </div>
        </div>

        <div class="card-clean p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 border border-indigo-100/60 flex items-center justify-center shrink-0">
                <i class="ti ti-layout-grid text-lg"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Item Fitur Aktif</p>
                @php
                    $featureCount = \App\Models\Feature::count();
                @endphp
                <h4 class="text-lg font-bold text-gray-900 mt-0.5">{{ $featureCount }} <span class="text-xs font-medium text-gray-400">Fitur Tersedia</span></h4>
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
                <h4 class="text-xs font-bold text-gray-800">Manajemen Header Feature Section</h4>
                <p class="text-[11px] text-gray-400">Bagian ini menampilkan headline utama dan gambar mockup sentral yang membawahi daftar kartu fitur aplikasi.</p>
            </div>
        </div>
        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-[#007A87] bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-200/60 self-start sm:self-auto shrink-0">
            <i class="ti ti-sparkles"></i>
            <span>Maksimal 1 Aktif</span>
        </span>
    </div>

    <!-- Feature Section Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse($feature_sections as $section)
            <div class="card-clean overflow-hidden flex flex-col justify-between transition-all hover:border-teal-200 {{ $section->is_active ? 'ring-2 ring-[#007A87]/30 border-[#007A87]/50' : '' }}">
                
                <!-- Mockup Preview Banner -->
                <div class="relative h-52 bg-gradient-to-br from-slate-100 to-slate-200/70 overflow-hidden flex items-center justify-center p-4 group">
                    @if($section->image_path)
                        <img src="{{ str_starts_with($section->image_path, 'images/') ? asset($section->image_path) : asset('storage/' . $section->image_path) }}" 
                             class="h-full max-w-full object-contain drop-shadow-md group-hover:scale-105 transition-transform duration-500" 
                             alt="Mockup Visual">
                    @else
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <i class="ti ti-photo-off text-3xl mb-1"></i>
                            <span class="text-[11px] font-medium">Belum ada file mockup</span>
                        </div>
                    @endif

                    <!-- Top Floating Status -->
                    <div class="absolute top-3.5 left-3.5 right-3.5 flex items-center justify-between z-10">
                        @if($section->is_active)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/90 text-white text-[10px] font-extrabold uppercase tracking-wider rounded-lg backdrop-blur-xs shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                <span>SEDANG AKTIF DI WEB</span>
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-slate-900/70 text-gray-300 text-[10px] font-bold uppercase tracking-wider rounded-lg backdrop-blur-xs">
                                <span>NONAKTIF</span>
                            </span>
                        @endif

                        <span class="text-[10px] font-mono text-white/90 bg-black/50 px-2 py-0.5 rounded backdrop-blur-xs">
                            #ID-{{ $section->id }}
                        </span>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                    
                    <div class="space-y-2">
                        <!-- Badge -->
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-teal-50 border border-teal-200/70 text-xs font-bold text-[#007A87]">
                            <span>{{ $section->title_badge_icon }}</span>
                            <span>{{ $section->title_badge }}</span>
                        </div>

                        <!-- Headline -->
                        <h3 class="text-base font-bold text-gray-900 leading-snug">
                            {{ $section->headline }}
                        </h3>
                    </div>

                    <!-- Footer Actions -->
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-2.5">
                        
                        <a href="{{ route('admin.feature-sections.edit', $section->id) }}" 
                           class="flex-1 inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 text-xs font-bold transition-all shadow-2xs">
                            <i class="ti ti-edit text-sm text-[#007A87]"></i>
                            <span>Edit Versi</span>
                        </a>

                        @if(!$section->is_active)
                            <form action="{{ route('admin.feature-sections.update', $section->id) }}" method="POST" class="flex-1">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_active" value="1">
                                <input type="hidden" name="title_badge" value="{{ $section->title_badge }}">
                                <input type="hidden" name="title_badge_icon" value="{{ $section->title_badge_icon }}">
                                <input type="hidden" name="headline" value="{{ $section->headline }}">
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-1.5 px-3.5 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm shadow-[#007A87]/20 transition-all">
                                    <i class="ti ti-check text-sm"></i>
                                    <span>Jadikan Aktif</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('landing') }}#features" target="_blank" 
                               class="inline-flex items-center justify-center gap-1 px-3 py-2 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold hover:bg-emerald-100 transition-all">
                                <i class="ti ti-world text-sm"></i>
                                <span>Live Web</span>
                            </a>
                        @endif

                        <button type="button" 
                                @click="$dispatch('confirm', {
                                    title: 'Hapus Feature Section',
                                    message: 'Apakah Anda yakin ingin menghapus section Fitur #{{ $section->id }}? Tindakan ini tidak dapat dibatalkan.',
                                    type: 'danger',
                                    icon: 'ti ti-trash',
                                    callback: () => { document.getElementById('delete-form-{{ $section->id }}').submit(); }
                                })"
                                class="inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 text-xs font-bold transition-all">
                            <i class="ti ti-trash text-sm"></i>
                        </button>

                        <form id="delete-form-{{ $section->id }}" action="{{ route('admin.feature-sections.destroy', $section->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>

                    </div>

                </div>

            </div>
        @empty
            <div class="lg:col-span-2 card-clean p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-teal-50 text-[#007A87] flex items-center justify-center mx-auto text-3xl mb-3">
                    <i class="ti ti-stack-2"></i>
                </div>
                <h4 class="text-sm font-bold text-gray-800">Belum Ada Feature Section</h4>
                <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto">Tambahkan header Feature section untuk menampilkan visual mockup dan judul utama di landing page.</p>
                <a href="{{ route('admin.feature-sections.create') }}" 
                   class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#007A87] hover:bg-[#005B60] text-white text-xs font-bold shadow-sm transition-all">
                    <i class="ti ti-plus text-sm"></i>
                    <span>Tambah Versi Sekarang</span>
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
